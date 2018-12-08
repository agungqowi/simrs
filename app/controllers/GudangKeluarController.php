<?php

class GudangKeluarController extends \BaseController {

	public $pref = "";
    public $database = "gudangpembelian";
	public $title = 'Pembelian';
	public $slug = 'beli'; 
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($pref='askes')
	{
		$this->setPref($pref);
		$jenis_obat = DB::connection($this->database)->table($this->pref.'gudang')->get();
		$pelanggan = DB::connection($this->database)->table($this->pref.'pelanggan')->get();
		return View::make('gudang.general.transaksi.create' , array(
			'jenis_obat' => $jenis_obat , 
			'pref' => $this->pref,
			'title' => $this->title,
			'pelanggan' => $pelanggan,
			'slug' => $this->slug
		));
	}

	public function setPref($pref)
	{
		if($pref == 'beli'){
			$this->pref = '';
			$this->title = 'Pembelian';
			$this->slug = 'beli';
            $this->database = 'gudangpembelian';
		}
		else{
			$this->pref = '';
			$this->title = 'Dropping';
			$this->slug = 'dropping';
            $this->database = 'gudangdropping';
		}
	}

	public function getdata($pref="askes")
	{		
		$this->setPref($pref);
		$term = Input::get('term');
		$results = array();
		$queries = DB::connection($this->database)->table($this->pref.'obat2')->join($this->pref.'gudang', $this->pref.'obat2.kodegudang', '=', $this->pref.'gudang.kodegudang')->where('namaobat', 'LIKE', '%'.$term.'%')->take(10)->get();

		foreach ($queries as $query){
			$results[] = [ 	'id' => $query->kodobat,
							'value' => $query->namaobat,
							'kodobat' => $query->kodobat,
							'kodegudang' => $query->kodegudang,
							'namagudang' => $query->namagudang,
							'stok' => $query->stok,
							'harga' => $query->harga,
            				'komposisi' => $query->komposisi,
            				'satuan' => $query->satuan,
							'masa' => date( "d/m/Y", strtotime($query->masa)),
            				'hargabeli' => $query->hargabeli
						];
		}
		return Response::json($results);
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable($pref="beli")
	{
		$this->setPref($pref);
		$perawat = DB::connection($this->database)->table($this->pref.'transaksi');
		return Datatable::query($perawat)
			->addColumn('kodobat',function($model)
        	{
            	return '<a href="'.url('gudang_obat/'.$model->kodobat.'/edit').'">'.$model->kodobat.'</a>';
        	})
			->showColumns('namaobat','komposisi','satuan', 'stok','harga')
			->addColumn('actions',function($model)
        	{
            	return '<a href="'.url('gudang_obat/'.$model->kodobat.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->kodobat."','Obat askes'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('kodobat','namaobat','stok')
			->orderColumns('kodobat','namaobat','stok')->make();
	}

	public function tambah_transaksi($pref='askes')
	{
		$this->setPref($pref);
		$rules = array(
			'id_obat'    	=> 'required|min:1', 
			'pelanggan'    	=> 'required|min:1', 
			'jumlah'    	=> 'required|min:1', 
			'harga'    		=> 'required|min:1', 
			'harga_beli'    => 'required|min:1', 
			'total'    		=> 'required|min:1', 
			'no_bukti'    	=> 'required|integer', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$messages = $validator->messages();
			foreach ($messages->all() as $message) 
			{
				echo $message;
			}
			
		} else { 
			$jumlah = intval(Input::get('jumlah'));
			$stok = Input::get('stok');
			if( $stok >=  $jumlah){
				$pesanan = DB::connection($this->database)->table($this->pref.'pesanan')->orderBy('keluarid','desc')->first();
				if($pesanan){
					$keluar_id = intval($pesanan->keluarid);
					$keluar_id++;
				}
				else{
					$keluar_id = 1;
				}

				$resep = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_bukti'));

				DB::connection($this->database)->table($this->pref.'pesanan')->insert(
					array( 'keluarid' => $keluar_id , 'nofak' => Input::get('no_bukti') , 'tglfak' =>  $resep->format('Y-m-d'),
							'nomorbp' => Input::get('no_bukti') , 'kodeplg' => Input::get('pelanggan')
					)
				);

				
				DB::connection($this->database)->table($this->pref.'transaksi')->insert(
					array(
						'keluarid' =>  $keluar_id,
						'nofak' => Input::get('no_bukti'),
						'kodobat' => Input::get('id_obat'),
						'jumlah' => Input::get('jumlah'),
						'terbilang' => $this->terbilang( Input::get('jumlah') )
					)
				);

				$new_stok = Input::get('stok') - $jumlah;
				$obat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', Input::get('id_obat') )->update(array('stok' => $new_stok));

				$laporan = DB::connection($this->database)->table($this->pref.'lapstok')->orderBy('no','desc')->first();
				if($laporan){
					$next = intval($laporan->no);
					$next++;
				}
				else{
					$next = 1;
				}
				DB::connection($this->database)->table($this->pref.'lapstok')->insert(
					array('no' => $next, 'kodobat' => Input::get('id_obat') , 'noba' => '-' , 'noppm' => Input::get('no_bukti') ,
						'nobp' => Input::get('no_bukti') , 'dariuntuk' => Input::get('pelanggan') , 'masuk' => '0' ,
						'keluar' => $jumlah , 'sisa' => $new_stok , 'tanggal' => $resep->format('Y-m-d')
					)
				);
			
// ===============================
/* check active db
if(DB::connection()->getDatabaseName())
{
   echo "conncted sucessfully to database ".DB::connection()->getDatabaseName();
}
*/
/*				$listkolomobat = DB::getSchemaBuilder()->getColumnListing($this->prep.'obat2');
				if(in_array('idobatgudang',$listkolomobat)){				
					if( Input::get('pelanggan') == 'P-DEPO3') $this->prep = 'as';
					else $this->prep = 'di';
					
					$ada_obat = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', Input::get('id_obat') )->first();
					
					if($ada_obat){
						$stok_baru = $ada_obat->stok + $jumlah;		
						$coba1 = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $ada_obat->idobatgudang )->update(
							array('stok' => $stok_baru , 'harga' => Input::get('harga'), 'hargabeli' => Input::get('harga_beli') )
						);
					}
					else{
						$cek_kode_obat = DB::connection()->table($this->prep.'obat2')->orderBy('kodobat', 'desc')->first();
						$id_baru = intval($cek_kode_obat->kodobat);
						$id_baru++;
						//$kadaluarsa = DateTime::createFromFormat('d/m/Y', Input::get('masa'));
						
						$insert_obat = DB::connection()->table($this->prep.'obat2')->insert(
							array(
								'kodobat' => $id_baru,
								'idobatgudang' => Input::get('id_obat'),
								//'kodejenis' => Input::get('jenis_obat'),
								'namaobat' => Input::get('nama_obat'),
								//'komposisi' => Input::get('komposisi'),
								'satuan' => Input::get('satuan'),
								'harga' => Input::get('harga'),
								'hargabeli' => Input::get('harga_beli'),
								//'masa' => $kadaluarsa->format('Y-m-d'),
								'stok' => $jumlah
							)
						);
						
						
						$id_obat = $id_baru;
						$stok_baru = $jumlah; 
					}
				
					$masuk = DB::connection()->table($this->prep.'masuk')->orderBy('masukid','desc')->first();
					if($masuk){
						$masuk_id = intval($masuk->masukid);
						$masuk_id++;
					}
					else{
						$masuk_id = 1;
					}
	
					DB::connection()->table($this->prep.'masuk')->insert(
						array(	'masukid' => $masuk_id , 'tglnota' => $resep->format('Y-m-d') , 
								'kodesupp' => 'GUDANG' , 'nomorba' => Input::get('no_bukti'))
					);
	
					$laporan = DB::connection()->table($this->prep.'lapstok')->orderBy('no','desc')->first();
					if($laporan){
						$next = intval($laporan->no);
						$next++;
					}
					else{
						$next = 1;
					}
					
					$listkolomlapstok = DB::getSchemaBuilder()->getColumnListing($this->prep.'lapstok');
					if(in_array('idobatgudang',$listkolomlapstok)){				
						DB::connection()->table($this->prep.'lapstok')->insert(
							array('no' => $next, 'kodobat' => $id_obat , 'noba' => '-' , 'noppm' => '-' ,
								'nobp' => Input::get('no_bukti') , 'dariuntuk' => 'GUDANG' , 'keluar' => '0' , 'idobatgudang' => $id_obat,
								'masuk' => $jumlah , 'sisa' => $stok_baru , 'tanggal' => $resep->format('Y-m-d')
							)
						);
					}
					
				}
*/
// ===============================  */
				
				echo 'sukses';
			}
			else{
				echo 'Stok tidak mencukupi';
			}
		}
	}

	public function list_transaksi($pref,$id)
	{
		$this->setPref($pref);
		$data = DB::connection($this->database)->table($this->pref.'lapstok')
						->join($this->pref.'obat2',$this->pref.'lapstok.kodobat' ,'=' ,$this->pref.'obat2.kodobat')
						->join($this->pref.'gudang', $this->pref.'obat2.kodegudang', '=', $this->pref.'gudang.kodegudang')
						->where('nobp','=' ,$id)->get();
		return $data;
	}

	public function check_transaksi($pref = 'askes')
	{
		$this->setPref($pref);
		$kodobat = Input::get('id_obat');
		
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_bukti'));
		$tanggal = $date->format('Y-m-d');
		
		$nobp = Input::get('no_bukti');
		$keluar = Input::get('jumlah');
		$dariuntuk = Input::get('pelanggan');
		
		$data = DB::connection($this->database)->table($this->pref.'lapstok')
				->where('nobp','=' ,$nobp)
				->where('kodobat','=' ,$kodobat)
				->where('tanggal','=' ,$tanggal)
				->where('keluar','=' ,$keluar)
				->where('dariuntuk','=' ,$dariuntuk)->get();
		
		if($data)
			return 'ada';
		else
			return 'kosong';
	}

	public function hapus_transaksi($pref="askes")
	{
		$this->setPref($pref);
		$no = Input::get('no');
		$nobp = Input::get('nobp');
		//get data from lapstok
		$select = DB::connection($this->database)->table($this->pref.'lapstok')->where('no' , '=' , $no)->where('nobp' , '=' , $nobp)->first();
		//get data from obat -> updating the stok
		$obat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $select->kodobat )->first();
		$new_stok = $obat->stok + $select->keluar;
		//update the obat stok
		$k = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $select->kodobat )->update(array('stok' => $new_stok));
		//delete data in lapstok
		$data = DB::connection($this->database)->table($this->pref.'lapstok')->where('no' , '=' , $no)->where('nobp' , '=' , $nobp)->delete();
		
/*		if( $select->dariuntuk == 'P-DEPO3') $this->prep = 'as';
		else $this->prep = 'di';
		$listkolomobat = DB::getSchemaBuilder()->getColumnListing($this->prep.'obat2');
		if(in_array('idobatgudang',$listkolomobat)){		
			$ada_obat = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $select->kodobat )->first();
			
			$stok_baru = $ada_obat->stok - $select->keluar;		
			$coba1 = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $select->kodobat )->update(
						array('stok' => $stok_baru)
					);
		}
*/		
		echo 'sukses';
	}

	public function edit_transaksi($pref='askes')
	{
		$this->setPref($pref);
		$no_trx = Input::get('no_trx');
		$kode_obat_edit = Input::get('id_obat_edit');
		$kode_obat_edit_asli = Input::get('id_obat_edit_asli');
		$jumlah_edit = Input::get('jumlah_edit');
		$jumlah_edit_asli = Input::get('jumlah_edit_asli');
		$harga_edit = Input::get('harga_edit');
		$stok_awal_edit = Input::get('stok_edit');
		//$komposisi_edit = Input::get('komposisi_edit');
		$total_edit = Input::get('total_edit');
		$harga_beli_edit = Input::get('harga_beli_edit');
		$satuan_edit = Input::get('satuan_edit');
		//$jenis_obat_edit = Input::get('jenis_obat_edit');
		$nama_obat_edit = Input::get('nama_obat_edit');
		
		
		//$date = DateTime::createFromFormat('d/m/Y', Input::get('masa_edit'));
		//$masa = $date->format('Y-m-d');
		
		$select = DB::connection($this->database)->table($this->pref.'lapstok')->where('no' , '=' , $no_trx)->first();	
			
		if( $select->dariuntuk == 'P-DEPO3') $this->prep = 'as';
		else $this->prep = 'di';
						
		$new_stok = $stok_awal_edit - $jumlah_edit;
		$updobat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $kode_obat_edit )->update(
				array(	//'kodegudang' => $jenis_obat_edit,
						//'komposisi' => $komposisi_edit,
						'satuan' => $satuan_edit,
						'stok' => $new_stok,
						//'masa' => $masa,
						'harga' => $harga_edit,
						'hargabeli' => $harga_beli_edit
				)
		);
		
		if($updobat){
			if($kode_obat_edit_asli == $kode_obat_edit){
/*				$listkolomobat = DB::getSchemaBuilder()->getColumnListing($this->prep.'obat2');
				if(in_array('idobatgudang',$listkolomobat)){
					$ada_obat = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $select->kodobat )->first();
					$sub = $jumlah_edit_asli - $jumlah_edit;
					$stok_baru = $ada_obat->stok + $sub;
					$coba1 = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $select->kodobat )->update(
								array(	'stok' => $stok_baru,
										//'masa' => $masa,
										'satuan' => $satuan_edit,
										//'komposisi' => $komposisi_edit,
										//'kodejenis' => $jenis_obat_edit
								)
							);
				}
*/		
				$updlapstok = DB::connection($this->database)->table($this->pref.'lapstok')->where('no', $no_trx )->update(
						array(	'keluar' => $jumlah_edit,
								'sisa' => $new_stok,
								'masuk' => '0'
						)
					);
			}
			else{
/*				$listkolomobat = DB::getSchemaBuilder()->getColumnListing($this->prep.'obat2');
				if(in_array('idobatgudang',$listkolomobat)){
					//Apotek : get data from obat -> retrun the old id stok
					$ada_obat = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $kode_obat_edit_asli )->first();
					$stok_baru = $ada_obat->stok - $jumlah_edit_asli;
					$coba1 = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $kode_obat_edit_asli )->update(array(	'stok' => $stok_baru));
				}
*/				
				//Gudang : get data from obat -> retrun the old id stok
				$obat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $kode_obat_edit_asli )->first();
				$new_stok2 = $obat->stok + $jumlah_edit_asli;
				$k = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $kode_obat_edit_asli)->update(array('stok' => $new_stok2));
				
/*				$listkolomobat = DB::getSchemaBuilder()->getColumnListing($this->prep.'obat2');
				if(in_array('idobatgudang',$listkolomobat)){
					//Apotek : add new obat
					$ada_obat = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $kode_obat_edit )->first();
					
					if($ada_obat){
						$stok_baru = $ada_obat->stok + $jumlah_edit;
						$coba1 = DB::connection()->table($this->prep.'obat2')->where('idobatgudang', $ada_obat->idobatgudang )->update(
							array('stok' => $stok_baru , 'harga' => $harga_edit, 'hargabeli' => $harga_beli_edit )
						);
					}
					else{
						$cek_kode_obat = DB::connection()->table($this->prep.'obat2')->orderBy('kodobat', 'desc')->first();
						$id_baru = intval($cek_kode_obat->kodobat);
						$id_baru++;
						
						$insert_obat = DB::connection()->table($this->prep.'obat2')->insert(
							array(
								'kodobat' => $id_baru,
								'idobatgudang' => $kode_obat_edit,
								//'kodejenis' => $jenis_obat_edit,
								'namaobat' => $nama_obat_edit,
								//'komposisi' => $komposisi_edit,
								'satuan' => $satuan_edit,
								'harga' => $harga_edit,
								'hargabeli' => $harga_beli_edit,
								//'masa' => $masa,
								'stok' => $jumlah_edit
							)
						);
					}

					$updlapstok = DB::connection($this->database)->table($this->pref.'lapstok')->where('no', $no_trx )->update(
							array(	'kodobat' => $kode_obat_edit,
									'keluar' => $jumlah_edit,
									'masuk' => '0',
									'sisa' => $new_stok 
							)
						);
				}
*/
			}
		}
		
		
		if( isset($updlapstok) && $updlapstok)
			echo 'sukses';
		else
			echo 'Proses Update Gagal, Silahkan Ulangi Lagi.';

	}

	public function terbilang($x)
	{
	  	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	  	if ($x < 12)
	    	return " " . $abil[$x];
	  	elseif ($x < 20)
	    	return $this->terbilang($x - 10) . "belas";
	  	elseif ($x < 100)
	    	return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
	  	elseif ($x < 200)
	    	return " seratus" . $this->terbilang($x - 100);
	  	elseif ($x < 1000)
	   		return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
	  	elseif ($x < 2000)
	    	return " seribu" . $this->terbilang($x - 1000);
	  	elseif ($x < 1000000)
	    	return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
	  	elseif ($x < 1000000000)
	    	return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
	}




}
