<?php

class ApotekMasukController extends \BaseController {

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
		$this->setPref($pref);
		$jenis_obat = DB::table($this->pref.'jenisobat')->get();
		$supplier = DB::table($this->pref.'supplier')->get();
		return View::make('apotek.general.masuk.create' , array(
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
		$this->setPref($pref);
		$id_obat = Input::get('id_obat');

		if($id_obat == 'NEW'){
			$rules = array(
				'id_obat'    => 'required|min:1', 
				'jumlah'    => 'required|min:1', 
				'harga'    => 'required|min:1',
				'harga_beli'    => 'required|min:1',
				'kode_supplier'    => 'required|min:1', 
			);
		}
		else{
			$rules = array(
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
				$masuk = DB::table($this->pref.'masuk')->orderBy('masukid','desc')->first();
				if($masuk){
					$masuk_id = intval($masuk->masukid);
					$masuk_id++;
				}
				else{
					$masuk_id = 1;
				}

				$tipe = Input::get('tipe');
				if($tipe == 'edit'){
					$no = Input::get('id_transaksi');
					$noba = "";
					$select = DB::table($this->pref.'lapstok')->where('no' , '=' , $no)->where('noba' , '=' , $noba)->get();
					$j = 0;
					foreach($select as $s){
						$obat = DB::table($this->pref.'obat')->where('kodobat', $s->kodobat )->first();
						$new_stok = $obat->stok - $s->masuk;
						$k=DB::table($this->pref.'obat')->where('kodobat', $s->kodobat )->update(array('stok' => $new_stok));
						$j++;
					}
					$data = DB::table($this->pref.'lapstok')->where('no' , '=' , $no)->where('noba' , '=' , $noba)->delete();
				}

				$date = DateTime::createFromFormat('d/m/Y', Input::get('masa'));
				$masa = $date->format('Y-m-d');
				$new_stok = Input::get('stok_awal') + $jumlah;

				if($id_obat == 'NEW'){
					$t = DB::table($this->pref.'obat')->orderBy('kodobat', 'desc')->first();
					$ari = intval($t->kodobat);
					$ari++;
					if($pref == 'dinas'){
						$obat = new DinasObat;
					}
					else if($pref == 'swasta'){
						$obat = new SwastaObat;
					}
					else{
						$obat = new AskesObat;
					}
					
					$obat->kodobat = $ari;
					$obat->kodejenis = Input::get('jenis_obat');
					$obat->namaobat = Input::get('nama_obat');
					$obat->komposisi = Input::get('komposisi');
					$obat->satuan = Input::get('satuan');
					$obat->harga = Input::get('harga');
					$obat->hargabeli = Input::get('harga_beli');
					$obat->masa = $masa;
					$obat->stok = $jumlah;
					$obat->save();

					$id_obat = $ari;

					$new_stok = $jumlah;
				}
				else{
					$old_obat = DB::table($this->pref.'obat')->where('kodobat', $id_obat )->first();
					$old_stok = $old_obat->stok;
					$new_stok = $old_stok+$jumlah;
					$id_obat = Input::get('id_obat');
					$obat = DB::table($this->pref.'obat')->where('kodobat', $id_obat )->update(
							array('stok' => $new_stok , 'masa' => $masa ,
							'harga' => Input::get('harga'), 'hargabeli' => Input::get('harga_beli') )
					);
				}

				

				$tgl_masuk = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));

				DB::table($this->pref.'masuk')->insert(
					array(	'masukid' => $masuk_id , 'tglnota' => $tgl_masuk->format('Y-m-d') , 
							'kodesupp' => Input::get('kode_supplier') , 'nomorba' => "")
				);

				

				$laporan = DB::table($this->pref.'lapstok')->orderBy('no','desc')->first();
				if($laporan){
					$next = intval($laporan->no);
					$next++;
				}
				else{
					$next = 1;
				}
				DB::table($this->pref.'lapstok')->insert(
					array('no' => $next, 'kodobat' => $id_obat , 'noba' => "" , 'noppm' => '-' ,
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

	public function list_transaksi($pref="askes")
	{
		$this->setPref($pref);
		$tanggal = $_REQUEST['tanggal_masuk'];
		$data = DB::table($this->pref.'lapstok')->join($this->pref.'obat',$this->pref.'lapstok.kodobat' ,'=' ,$this->pref.'obat.kodobat')
				->where('tanggal','=' ,$tanggal)->get();
		return $data;
	}

	public function hapus_transaksi($pref="askes")
	{
		$this->setPref($pref);
		$no = Input::get('no');
		$noba = Input::get('noba');
		$select = DB::table($this->pref.'lapstok')->where('no' , '=' , $no)->where('noba' , '=' , $noba)->get();
		$j = 0;
		foreach($select as $s){
			$obat = DB::table($this->pref.'obat')->where('kodobat', $s->kodobat )->first();
			$new_stok = $obat->stok - $s->masuk;
			$k=DB::table($this->pref.'obat')->where('kodobat', $s->kodobat )->update(array('stok' => $new_stok));
			$j++;
		}
		$data = DB::table($this->pref.'lapstok')->where('no' , '=' , $no)->where('noba' , '=' , $noba)->delete();
		return $j;
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
