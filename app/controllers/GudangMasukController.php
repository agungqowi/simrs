<?php

class GudangMasukController extends \BaseController {

	public $pref = "beli";
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
		$supplier = DB::connection($this->database)->table($this->pref.'supplier')->get();
		return View::make('gudang.general.masuk.create' , array(
			'jenis_obat' => $jenis_obat , 
			'supplier' => $supplier,
			'pref' => $this->pref,
			'title' => $this->title,
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

	public function check_transaksi($pref = 'askes')
	{
		$this->setPref($pref);
		$kodobat = Input::get('id_obat');
		
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		$tanggal = $date->format('Y-m-d');
		
		$noba = Input::get('no_bukti');
		$masuk = Input::get('jumlah');
		$dariuntuk = Input::get('kode_supplier');
		
		$data = DB::connection($this->database)->table($this->pref.'lapstok')
				->where('noba','=' ,$noba)
				->where('kodobat','=' ,$kodobat)
				->where('tanggal','=' ,$tanggal)
				->where('masuk','=' ,$masuk)
				->where('dariuntuk','=' ,$dariuntuk)->get();
		
		if($data)
			return 'ada';
		else
			return 'kosong';
	}

	public function tambah_transaksi($pref='askes')
	{
		$this->setPref($pref);
		$id_obat = Input::get('id_obat');

		if($id_obat == 'NEW'){
			$rules = array(
				'no_bukti'    => 'required|min:3', 
				'id_obat'    => 'required|min:1', 
				'jumlah'    => 'required|min:1', 
				'harga'    => 'required|min:1',
				'harga_beli'    => 'required|min:1',
				'kode_supplier'    => 'required|min:1', 
			);
		}
		else{
			$rules = array(
				'no_bukti'    => 'required|min:3', 
				'id_obat'    => 'required|min:1', 
				'jumlah'    => 'required|min:1', 
				'harga'    => 'required|min:1',
				'harga_beli'    => 'required|min:1', 
				'total'    => 'required|min:1', 
				'kode_supplier'    => 'required|min:1', 
			);
		}
		

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
			if($jumlah > 0 || $id_obat == 'NEW'){

				$date = DateTime::createFromFormat('d/m/Y', Input::get('masa'));
				$masa = $date->format('Y-m-d');
				$new_stok = Input::get('stok_awal') + $jumlah;
				if($id_obat == 'NEW'){
					$t = DB::connection($this->database)->table($this->pref.'obat2')->orderBy('kodobat', 'desc')->first();
					$ari = intval($t->kodobat);
					$ari++;

					DB::connection($this->database)->table($this->pref.'obat2')->insert( array(
						'kodobat' => $ari,
						'kodegudang' => Input::get('jenis_obat'),
						'namaobat' => Input::get('nama_obat'),
						'komposisi' => Input::get('komposisi'),
						'satuan' => Input::get('satuan'),
						'harga' => Input::get('harga'),
						'hargabeli' => Input::get('harga_beli'),
						'masa' => $masa,
						'stok' => $jumlah,
					));
					$id_obat = $ari;
				}
				else{
					$obat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $id_obat )->update(
							array(	
									'kodegudang' => Input::get('jenis_obat'),
									'komposisi' => Input::get('komposisi'),
									'satuan' => Input::get('satuan'),
									'stok' => $new_stok ,
									'masa' => $masa ,
									'harga' => Input::get('harga'),
									'hargabeli' => Input::get('harga_beli')
									)
					);
				}

				$tgl_masuk = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));

				//trx masuk
				$masuk = DB::connection($this->database)->table($this->pref.'masuk')->orderBy('masukid','desc')->first();
				if($masuk){
					$masuk_id = intval($masuk->masukid);
					$masuk_id++;
				}
				else{
					$masuk_id = 1;
				}
				
				DB::connection($this->database)->table($this->pref.'masuk')->insert(
					array(	'masukid' => $masuk_id , 'tglnota' => $tgl_masuk->format('Y-m-d') , 
							'kodesupp' => Input::get('kode_supplier') , 'nomorba' => Input::get('no_bukti'))
				);

				

				$laporan = DB::connection($this->database)->table($this->pref.'lapstok')->orderBy('no','desc')->first();
				if($laporan){
					$next = intval($laporan->no);
					$next++;
				}
				else{
					$next = 1;
				}
				DB::connection($this->database)->table($this->pref.'lapstok')->insert(
					array('no' => $next, 'kodobat' => $id_obat , 'noba' => Input::get('no_bukti') , 'noppm' => '-' ,
						'nobp' => '-' , 'dariuntuk' => Input::get('nama_supplier') , 'keluar' => '0' ,
						'masuk' => $jumlah , 'sisa' => $new_stok , 'tanggal' => $tgl_masuk->format('Y-m-d')
					)
				);
				echo 'sukses';
			}
			else{
				echo 'Jumlah Pembelian yang dimasukkan salah';
			}
			
		}
	}

	public function edit_transaksi($pref='askes')
	{
		$this->setPref($pref);
		$no_trx = Input::get('no_trx');
		$kode_obat_edit = Input::get('kode_obat_edit');
		$kode_obat_edit_asli = Input::get('kode_obat_edit_asli');
		$jumlah_edit = Input::get('jumlah_edit');
		$harga_edit = Input::get('harga_edit');
		$stok_awal_edit = Input::get('stok_awal_edit');
		//$masa_edit = Input::get('masa_edit');
		$komposisi_edit = Input::get('komposisi_edit');
		$total_edit = Input::get('total_edit');
		$harga_beli_edit = Input::get('harga_beli_edit');
		$satuan_edit = Input::get('satuan_edit');
		$jenis_obat_edit = Input::get('jenis_obat_edit');
		
		$date = DateTime::createFromFormat('d/m/Y', Input::get('masa_edit'));
		$masa = $date->format('Y-m-d');
				
		$new_stok = Input::get('stok_awal_edit') + $jumlah_edit;
		$updobat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $kode_obat_edit )->update(
				array(	'kodegudang' => $jenis_obat_edit,
						'komposisi' => $komposisi_edit,
						'satuan' => $satuan_edit,
						'stok' => $new_stok,
						'masa' => $masa,
						'harga' => $harga_edit,
						'hargabeli' => $harga_beli_edit
				)
		);
			
		if($updobat){
			if($kode_obat_edit_asli == $kode_obat_edit){
				$updlapstok = DB::connection($this->database)->table($this->pref.'lapstok')->where('no', $no_trx )->update(
						array(	'masuk' => $jumlah_edit,
								'sisa' => $new_stok 
						)
					);
			}
			else{
	
				$select = DB::connection($this->database)->table($this->pref.'lapstok')->where('no' , '=' , $no_trx)->first();
				//get data from obat -> updating the stok
				$obat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $select->kodobat )->first();
				$new_stok2 = $obat->stok - $select->masuk;
				//update the obat stok
				$k = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $select->kodobat )->update(array('stok' => $new_stok2));
				
				$updlapstok = DB::connection($this->database)->table($this->pref.'lapstok')->where('no', $no_trx )->update(
						array(	'kodobat' => $kode_obat_edit,
								'masuk' => $jumlah_edit,
								'sisa' => $new_stok 
						)
					);
			}
		}
		
		
		if($updlapstok)
			echo 'sukses';
		else
			echo 'Proses Update Gagal, Silahkan Ulangi Lagi.';
	}

	public function list_transaksi($pref="beli")
	{
		$this->setPref($pref);
		$no_bukti = Input::get('no_bukti');
		$data = DB::connection($this->database)->table($this->pref.'lapstok')
				->join($this->pref.'obat2',$this->pref.'lapstok.kodobat' ,'=' ,$this->pref.'obat2.kodobat')
				->join($this->pref.'gudang', $this->pref.'obat2.kodegudang', '=', $this->pref.'gudang.kodegudang')
				->where('noba','=' ,$no_bukti)->get();
		return $data;
	}

	public function hapus_transaksi($pref="askes")
	{
		$this->setPref($pref);
		$no = Input::get('no');
		$noba = Input::get('noba');
		//get data from lapstok
		$select = DB::connection($this->database)->table($this->pref.'lapstok')->where('no' , '=' , $no)->where('noba' , '=' , $noba)->first();
		//get data from obat -> updating the stok
		$obat = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $select->kodobat )->first();
		$new_stok = $obat->stok - $select->masuk;
		//update the obat stok
		$k = DB::connection($this->database)->table($this->pref.'obat2')->where('kodobat', $select->kodobat )->update(array('stok' => $new_stok));
		//delete data in lapstok
		$data = DB::connection($this->database)->table($this->pref.'lapstok')->where('no' , '=' , $no)->where('noba' , '=' , $noba)->delete();
		echo 'sukses';
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
