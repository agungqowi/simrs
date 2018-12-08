<?php

class GudangPoController extends \BaseController {

	public $pref = "as";
	public $title = 'Askes';
	public $slug = 'askes';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($pref='askes')
	{
		$this->pref = "apo_";
		$jenis_obat = DB::table($this->pref.'jenisobat')->get();
		$supplier = DB::table($this->pref.'supplier')->get();
		return View::make('gudang.po' , array(
			'jenis_obat' => $jenis_obat , 
			'supplier' => $supplier,
			'pref' => $this->pref,
			'title' => $this->title,
			'slug' => $this->slug
		));
	}

	public function setPref($pref)
	{
		if($pref == 'dinas'){
			$this->pref = 'di';
			$this->title = 'Dinas';
			$this->slug = 'dinas';
		}
		else if($pref == 'swasta'){
			$this->pref = 'sw';
			$this->title = 'Swasta';
			$this->slug = 'swasta';
		}
        else if($pref == 'ok'){
            $this->pref = 'ok';
            $this->title = 'OK';
            $this->slug = 'ok';
        }
		else{
			$this->pref = 'as';
			$this->title = 'Askes';
			$this->slug = 'askes';
		}
	}


	/**
	 * @param void
	 * @return array
	 */
	public function datatable($pref='askes')
	{
		$this->setPref($pref);
		$perawat = DB::table($this->pref.'transaksi')->join('tbmasukrs', $this->pref.'transaksi.noreg', '=', 'tbmasukrs.NoReg')->join();
		return Datatable::query($perawat)
			->addColumn('kodobat',function($model)
        	{
            	return '<a href="'.url('askes_obat/'.$model->kodobat.'/edit').'">'.$model->kodobat.'</a>';
        	})
			->showColumns('namaobat','komposisi','satuan','namajenis' , 'stok','harga')
			->addColumn('actions',function($model)
        	{
            	return '<a href="'.url('askes_obat/'.$model->kodobat.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->kodobat."','Obat askes'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('kodobat','namaobat','namajenis','stok')
			->orderColumns('kodobat','namaobat','namajenis','stok')->make();
	}

	public function check_pasien($id)
	{
		$check = DB::table('tbmasukrs')->join('tbpasien','tbmasukrs.NoRM','=','tbpasien.NoRM')->where('tbmasukrs.NoRM' , '=' , $id)->orderBy('tbmasukrs.NoReg','desc')->first();
		if($check){
			$no_reg = $check->NoReg;
			$check_exist = DB::table('tbkeluar')->where('NoReg' , '=' , $no_reg)->first();
			if($check_exist){
				echo 'false';
			}
			else{
				echo(json_encode($check));
			}
		}
		else{
			echo 'false';
		}
		
	}

	public function tambah_transaksi($pref='askes')
	{
		$this->pref = "apo_";
		$id_obat = Input::get('kode_obat');

		if($id_obat == 'NEW'){
			$rules = array(
				'jumlah'    => 'required|min:1', 
				'harga_beli'    => 'required|min:1',
				'kode_supplier'    => 'required|min:1', 
			);
		}
		else{
			$rules = array(				
				'jumlah'    => 'required|min:1', 
				'harga_beli'    => 'required|min:1',
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

				$tipe = Input::get('tipe');
				$date = DateTime::createFromFormat('d/m/Y', Input::get('masa'));
				if(!empty($date))
					$masa = $date->format('Y-m-d');
				else
					$masa = date('Y-m-d');

				$tgl_masuk = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));

				if($tipe == 'edit'){
					$no = Input::get('id_transaksi');

					$select = DB::table('apo_pembelian')->where('id' , '=' , $no)->get();
					$j = 0;
					foreach($select as $s){
						$obat = DB::table('apo_obat')->where('kodobat', $s->kodobat )->first();
						if( isset($stok->jumlah) ){
							$new_stok = $obat->stok - $s->jumlah;
							$k=DB::table($this->pref.'obat')->where('kodobat', $s->kodobat )->update(
								array(
									'stok' => $new_stok ,
									'masa' => $masa
								)
							);
						}
						
						$j++;
					}
					DB::table('apo_pembelian')->where('id' , $no)
						-> update(
							array(	'kodobat' => $id_obat , 'hargabeli' => Input::get('harga_beli') , 
									'jumlah'  => $jumlah,
									'tanggal_beli' => $tgl_masuk->format('Y-m-d') , 'ppn' => Input::get('ppn') ,
									'diskon' => Input::get('diskon') , 'jenis_pembayaran' => Input::get('jenis_pembayaran') ,
									'kodesupp' => Input::get('kode_supplier') , 'tanggal_expire' => $masa )
						);

					echo 'sukses';
				}
				else{
					
					$new_stok = Input::get('stok_awal') + $jumlah;

					if($id_obat == 'NEW'){
						$t = DB::table('apo_obat')->orderBy('kodobat', 'desc')->first();
						$ari = intval($t->kodobat);
						$ari++;

						$obat = array();
						
						$obat['kodobat'] = $ari;
						$obat['kodejenis'] = Input::get('jenis_obat');
						$obat['namaobat'] = Input::get('nama_obat');
						$obat['komposisi'] = Input::get('komposisi');
						$obat['satuan'] = Input::get('satuan');
						$obat['hargabeli'] = Input::get('harga_beli');
						$obat['masa'] = $masa;
						$obat['stok'] = $jumlah;

						$insert = DB::table('apo_obat')->insert($obat);

						$id_obat = $ari;

						$new_stok = $jumlah;

						$nama_obat = Input::get('nama_obat');
					}
					else{
						$old_obat = DB::table('apo_obat')->where('kodobat', $id_obat )->first();
						if( isset($old_obat->kodobat) ){
							$old_stok = $old_obat->stok;
							$new_stok = $old_stok+$jumlah;
							$obat = DB::table('apo_obat')->where('kodobat', $id_obat )->update(
									array(
										'stok' => $new_stok , 'masa' => $masa ,'hargabeli' => Input::get('harga_beli') ,
										'ppn'	=> Input::get('ppn')

									)
							);

							$nama_obat = $old_obat->namaobat;
						}
						else{
							die( 'error' );
						}
					}				

					$tgl_masuk = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));

					DB::table('apo_pembelian')->insert(
						array(	'kodobat' => $id_obat , 'hargabeli' => Input::get('harga_beli') , 
								'jumlah'  => $jumlah,
								'tanggal_beli' => $tgl_masuk->format('Y-m-d') , 'ppn' => Input::get('ppn') ,
								'diskon' => Input::get('diskon') , 'jenis_pembayaran' => Input::get('jenis_pembayaran') ,
								'kodesupp' => Input::get('kode_supplier') , 'tanggal_expire' => $masa)
					);

					
					echo 'sukses';
				}

				
			}
			else{
				echo 'Jumlah Pembelian yang dimasukkan salah';
			}
			
		}
	}

	public function list_transaksi($pref="askes")
	{
		$tanggal = $_REQUEST['tanggal_masuk'];
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		if( !empty($date) )
			$tanggal = $date->format('Y-m-d');
		$data = DB::table('apo_pembelian')->join('apo_obat','apo_pembelian.kodobat' ,'=' ,'apo_obat.kodobat')
				->select('apo_pembelian.*' , 'apo_obat.kodejenis' , 'apo_obat.namaobat' , 'apo_obat.komposisi' , 'apo_obat.satuan' , 'apo_obat.stok')
				->where('tanggal_beli','=' ,$tanggal)->get();
		return $data;
	}

	public function hapus_transaksi($pref="askes")
	{	
		$this->pref = "apo_";
		$no = Input::get('no');

		$select = DB::table('apo_pembelian')->where('id' , '=' , $no)->get();
		$j = 0;
		foreach($select as $s){
			echo $s->kodobat;
			$obat = DB::table('apo_obat')->where('kodobat', $s->kodobat )->first();
			if( isset($obat->stok) ){
				$new_stok = intval( $obat->stok ) - intval( $s->jumlah );
				$k=DB::table($this->pref.'obat')->where('kodobat', $s->kodobat )->update(
					array(
						'stok' => $new_stok
					)
				);
			}
			$j++;
		}
		DB::table('apo_pembelian')->where('id' , '=' , $no)->delete();
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
