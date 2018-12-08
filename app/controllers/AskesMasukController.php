<?php

class AskesMasukController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($pref="as")
	{
		$jenis_obat = DB::table('asjenisobat')->get();
		$supplier = DB::table($pref.'supplier')->get();
		return View::make('apotek.askes.masuk.create' , array('jenis_obat' => $jenis_obat , 'supplier' => $supplier));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($pref="as")
	{	
		$jenis_obat = DB::table($pref.'jenisobat')->get();
		$supplier = DB::table($pref.'supplier')->get();
		return View::make('apotek.askes.masuk.create' , array('jenis_obat' => $jenis_obat , 'supplier' => $supplier));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'nama_obat'    => 'required|min:3', 
			'komposisi'    => 'required|min:1', 
			'satuan'    => 'required|min:1', 
			'harga'    => 'required|min:1', 
			'masa'    => 'required|min:1', 
			'stok'    => 'required|integer', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('askes_transaksi/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$t = DB::table('asobat')->orderBy('kodobat', 'desc')->first();
			$ari = intval($t->kodobat);
			$ari++;

			
			$obat = new AskesObat;
			$obat->kodobat = $ari;
			$obat->kodejenis = Input::get('jenis_obat');
			$obat->namaobat = Input::get('nama_obat');
			$obat->komposisi = Input::get('komposisi');
			$obat->satuan = Input::get('satuan');
			$obat->harga = Input::get('harga');
			$obat->masa = date( "Y-m-d", strtotime(Input::get('masa')) );
			$obat->stok = Input::get('stok');
			$obat->save();



			return Redirect::to('askes_transaksi')->with('success', 'Data Obat berhasil ditambahkan');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jenis_obat = DB::table('asjenisobat')->get();
		$obat = DB::table('asobat')->where('kodobat', $id)->first();
		return View::make('apotek.askes.obat.edit' , array( 'obat' => $obat , 'jenis_obat' => $jenis_obat ));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'nama_obat'    => 'required|min:3', 
			'komposisi'    => 'required|min:1', 
			'satuan'    => 'required|min:1', 
			'harga'    => 'required|min:1', 
			'masa'    => 'required|min:1', 
			'stok'    => 'required|integer', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('askes_obat/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$obat = array();
			$obat['kodejenis'] = Input::get('jenis_obat');
			$obat['namaobat'] = Input::get('nama_obat');
			$obat['komposisi'] = Input::get('komposisi');
			$obat['satuan'] = Input::get('satuan');
			$obat['harga'] = Input::get('harga');
			$obat['masa'] = date( "Y-m-d", strtotime(Input::get('masa')) );
			$obat['stok'] = Input::get('stok');

			AskesObat::where('kodobat', '=', $id)->update($obat);

			return Redirect::to('askes_obat')->with('success', 'Data Obat berhasil diubah');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//Cek apakah sudah pernah ada transaksi jika iya, dokter tidak bisa dihapus
		$t1 = DB::table('astransaksi')->where('kodobat' , '=' , $id)->count();
		if($t1 > 0){
			return Redirect::to('askes_obat')->with('success', 'Data Obat tidak diizinkan untuk dihapus');
		}
		else{
			DB::table('asobat')->where('kodobat' , '=' , $id)->delete();
			return Redirect::to('askes_obat')->with('success', 'Data Obat berhasil dihapus');
		}
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$perawat = DB::table('astransaksi')->join('tbmasukrs', 'astransaksi.noreg', '=', 'tbmasukrs.NoReg')->join();
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

	public function tambah_transaksi()
	{
		$id_obat = Input::get('id_obat');

		if($id_obat == 'NEW'){
			$rules = array(
				'no_bukti'    => 'required|min:3', 
				'id_obat'    => 'required|min:1', 
				'jumlah'    => 'required|min:1', 
				'harga'    => 'required|min:1',
				'kode_supplier'    => 'required|min:1', 
			);
		}
		else{
			$rules = array(
				'no_bukti'    => 'required|min:3', 
				'id_obat'    => 'required|min:1', 
				'jumlah'    => 'required|min:1', 
				'harga'    => 'required|min:1', 
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
				$masuk = DB::table('asmasuk')->orderBy('masukid','desc')->first();
				if($masuk){
					$masuk_id = intval($masuk->masukid);
					$masuk_id++;
				}
				else{
					$masuk_id = 1;
				}

				

				$date = DateTime::createFromFormat('d/m/Y', Input::get('masa'));
				$masa = $date->format('Y-m-d');
				$new_stok = Input::get('stok_awal') + $jumlah;
				if($id_obat == 'NEW'){
					$t = DB::table('asobat')->orderBy('kodobat', 'desc')->first();
					$ari = intval($t->kodobat);
					$ari++;
					$obat = new AskesObat;
					$obat->kodobat = $ari;
					$obat->kodejenis = Input::get('jenis_obat');
					$obat->namaobat = Input::get('nama_obat');
					$obat->komposisi = Input::get('komposisi');
					$obat->satuan = Input::get('satuan');
					$obat->harga = Input::get('harga');
					$obat->masa = $masa;
					$obat->stok = Input::get('stok_awal');
					$obat->save();

					$id_obat = $ari;
				}
				else{
					$obat = DB::table('asobat')->where('kodobat', $id_obat )->update(
							array('stok' => $new_stok , 'masa' => $masa , 'harga' => Input::get('harga'))
					);
				}

				

				$tgl_masuk = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));

				DB::table('asmasuk')->insert(
					array(	'masukid' => $masuk_id , 'tglnota' => $tgl_masuk->format('Y-m-d') , 
							'kodesupp' => Input::get('kode_supplier') , 'nomorba' => Input::get('no_bukti'))
				);

				

				$laporan = DB::table('aslapstok')->orderBy('no','desc')->first();
				if($laporan){
					$next = intval($laporan->no);
					$next++;
				}
				else{
					$next = 1;
				}
				DB::table('aslapstok')->insert(
					array('no' => $next, 'kodobat' => $id_obat , 'noba' => Input::get('no_bukti') , 'noppm' => '-' ,
						'nobp' => '-' , 'dariuntuk' => Input::get('nama_supplier') , 'keluar' => '0' ,
						'masuk' => $jumlah , 'sisa' => $new_stok , 'tanggal' => $tgl_masuk->format('Y-m-d')
					)
				);
				echo 'sukses';
			}
			else{
				echo 'Jumlah yang dimasukkan salah';
			}
			
		}
	}

	public function list_transaksi()
	{
		$no_bukti = Input::get('no_bukti');
		$tgl = DateTime::createFromFormat('d/m/Y',Input::get('tanggal_masuk'));
		$tanggal_masuk = $tgl->format('Y-m-d');
		$data = DB::table('aslapstok')->join('asobat','aslapstok.kodobat' ,'=' ,'asobat.kodobat')->where('tanggal','=',$tanggal_masuk)
				->where('noba','=' ,$no_bukti)->get();
		return $data;
	}

	public function hapus_transaksi()
	{
		$id_resep = Input::get('id_resep');
		$data = DB::table('tbdetailobat')->where('IdResep' , '=' , $id_resep)->delete();
		return $data;
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
