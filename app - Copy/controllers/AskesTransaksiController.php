<?php

class AskesTransaksiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jenis_obat = DB::table('asjenisobat')->get();
		return View::make('apotek.askes.transaksi.create' , array('jenis_obat' => $jenis_obat));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$jenis_obat = DB::table('asjenisobat')->get();
		return View::make('apotek.askes.transaksi.create' , array('jenis_obat' => $jenis_obat));
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
		$rules = array(
			'no_reg'    => 'required|min:3', 
			'id_obat'    => 'required|min:1', 
			'jumlah'    => 'required|min:1', 
			'harga'    => 'required|min:1', 
			'total'    => 'required|min:1', 
			'no_resep'    => 'required|integer', 
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
				$pesanan = DB::table('aspesanan')->orderBy('keluarid','desc')->first();
				if($pesanan){
					$keluar_id = intval($pesanan->keluarid);
					$keluar_id++;
				}
				else{
					$keluar_id = 1;
				}

				$resep = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_resep'));

				DB::table('aspesanan')->insert(
					array( 'keluarid' => $keluar_id , 'nofak' => Input::get('no_resep') , 'tglfak' =>  $resep->format('Y-m-d'),
							'nomorbp' => Input::get('no_resep') , 'norm' => Input::get('no_rm')
					)
				);

				$transaksi = new AskesTransaksi;
				$transaksi->keluarid = $keluar_id;
				$transaksi->nofak = Input::get('no_resep');
				$transaksi->kodobat = Input::get('id_obat');
				$transaksi->jumlah = Input::get('jumlah');
				$transaksi->terbilang = $this->terbilang( Input::get('jumlah') );
				$transaksi->total = Input::get('total');
				$transaksi->noreg = Input::get('no_reg');
				$transaksi->save();

				$detail = new DetailObat;
				$detail->IdResep = $keluar_id;
				$detail->NoRM = Input::get('no_rm');
				$detail->JenisRawat = Input::get('jenis_rawat');
				$detail->NoResep = Input::get('no_resep');
				$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
				$detail->TanggalMasuk = $date->format('Y-m-d');				
				$detail->TanggalResep = $resep->format('Y-m-d');
				$detail->IdObat = Input::get('id_obat');
				$detail->NamaObat = Input::get('nama_obat');
				$detail->Harga = Input::get('harga');
				$detail->Jumlah = Input::get('jumlah');
				$detail->TotalHarga = Input::get('total');
				$detail->NoReg = Input::get('no_reg');
				$detail->Apotek = "Askes";
				$detail->save();

				$new_stok = Input::get('stok') - $jumlah;
				$obat = DB::table('asobat')->where('kodobat', Input::get('id_obat') )->update(array('stok' => $new_stok));

				$laporan = DB::table('aslapstok')->orderBy('no','desc')->first();
				if($laporan){
					$next = intval($laporan->no);
					$next++;
				}
				else{
					$next = 1;
				}
				DB::table('aslapstok')->insert(
					array('no' => $next, 'kodobat' => Input::get('id_obat') , 'noba' => '-' , 'noppm' => Input::get('no_resep') ,
						'nobp' => Input::get('no_resep') , 'dariuntuk' => Input::get('nama_lengkap') , 'masuk' => '0' ,
						'keluar' => $jumlah , 'sisa' => $new_stok , 'tanggal' => $detail->TanggalResep
					)
				);
				echo 'sukses';
			}
			else{
				echo 'Stok tidak mencukupi';
			}
		}
	}

	public function list_transaksi($id)
	{
		$data = DB::table('tbdetailobat')->where('NoReg','=',$id)->get();
		return $data;
	}

	public function hapus_transaksi()
	{
		$id_resep = Input::get('id_resep');
		$data = DB::table('tbdetailobat')->where('IdResep' , '=' , $id_resep)->delete();

		DB::table('aspesanan')->where('keluarid' , '=' , $id_resep)->delete();
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
