<?php

class SwastaTransaksiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jenis_obat = DB::table('swjenisobat')->get();
		return View::make('apotek.swasta.transaksi.create' , array('jenis_obat' => $jenis_obat));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$jenis_obat = DB::table('swjenisobat')->get();
		return View::make('apotek.swasta.transaksi.create' , array('jenis_obat' => $jenis_obat));
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
			return Redirect::to('swasta_transaksi/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$t = DB::table('swobat')->orderBy('kodobat', 'desc')->first();
			$ari = intval($t->kodobat);
			$ari++;
			$obat = new DinasObat;
			$obat->kodobat = $ari;
			$obat->kodejenis = Input::get('jenis_obat');
			$obat->namaobat = Input::get('nama_obat');
			$obat->komposisi = Input::get('komposisi');
			$obat->satuan = Input::get('satuan');
			$obat->harga = Input::get('harga');
			$obat->masa = date( "Y-m-d", strtotime(Input::get('masa')) );
			$obat->stok = Input::get('stok');
			$obat->save();

			return Redirect::to('swasta_transaksi')->with('success', 'Data Obat berhasil ditambahkan');
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
		$jenis_obat = DB::table('swjenisobat')->get();
		$obat = DB::table('swobat')->where('kodobat', $id)->first();
		return View::make('apotek.swasta.obat.edit' , array( 'obat' => $obat , 'jenis_obat' => $jenis_obat ));
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
			return Redirect::to('dinas_obat/'.$id.'/edit')
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

			DinasObat::where('kodobat', '=', $id)->update($obat);

			return Redirect::to('dinas_obat')->with('success', 'Data Obat berhasil diubah');
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
		$t1 = DB::table('swtransaksi')->where('kodobat' , '=' , $id)->count();
		if($t1 > 0){
			return Redirect::to('dinas_obat')->with('success', 'Data Obat tidak diizinkan untuk dihapus');
		}
		else{
			DB::table('swobat')->where('kodobat' , '=' , $id)->delete();
			return Redirect::to('dinas_obat')->with('success', 'Data Obat berhasil dihapus');
		}
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$perawat = DB::table('swtransaksi')->join('tbmasukrs', 'swtransaksi.noreg', '=', 'tbmasukrs.NoReg')->join();
		return Datatable::query($perawat)
			->addColumn('kodobat',function($model)
        	{
            	return '<a href="'.url('dinas_obat/'.$model->kodobat.'/edit').'">'.$model->kodobat.'</a>';
        	})
			->showColumns('namaobat','komposisi','satuan','namajenis' , 'stok','harga')
			->addColumn('actions',function($model)
        	{
            	return '<a href="'.url('dinas_obat/'.$model->kodobat.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->kodobat."','Obat dinas'".')"><i class="splashy-gem_remove"></i></a>';
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
			echo 'Isi semua field yang diberi tanda bintang';
		} else {
			$transaksi = new SwastaTransaksi;
			$transaksi->keluarid = Input::get('no_resep');
			$transaksi->nofak = Input::get('no_resep');
			$transaksi->kodobat = Input::get('id_obat');
			$transaksi->jumlah = Input::get('jumlah');
			$transaksi->terbilang = $this->terbilang( Input::get('jumlah') );
			$transaksi->total = Input::get('total');
			$transaksi->noreg = Input::get('no_reg');

			$transaksi->save();
			echo 'sukses';
		}
	}

	public function list_transaksi($id)
	{
		$data = DB::table('swtransaksi')->join('swobat','swtransaksi.kodobat','=','swobat.kodobat')->where('swtransaksi.NoReg','=',$id)->get();
		return $data;
	}

	public function hapus_transaksi()
	{
		$no_resep = Input::get('no_resep');
		$kode_obat = Input::get('id_obat');
		$data = DB::table('swtransaksi')->where('keluarid' , '=' , $no_resep)->where('kodobat' , '=' , $kode_obat)->delete();
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
