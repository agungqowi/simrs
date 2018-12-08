<?php

class DinasObatController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('apotek.dinas.obat.list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	
		$jenis_obat = DB::table('dijenisobat')->get();
		return View::make('apotek.dinas.obat.create' , array('jenis_obat' => $jenis_obat));
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
			return Redirect::to('dinas_obat/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$t = DB::table('diobat')->orderBy('kodobat', 'desc')->first();
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

			return Redirect::to('dinas_obat')->with('success', 'Data Obat berhasil ditambahkan');
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
		$jenis_obat = DB::table('dijenisobat')->get();
		$obat = DB::table('diobat')->where('kodobat', $id)->first();
		return View::make('apotek.dinas.obat.edit' , array( 'obat' => $obat , 'jenis_obat' => $jenis_obat ));
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
		$t1 = DB::table('ditransaksi')->where('kodobat' , '=' , $id)->count();
		if($t1 > 0){
			return Redirect::to('dinas_obat')->with('success', 'Data Obat tidak diizinkan untuk dihapus');
		}
		else{
			DB::table('diobat')->where('kodobat' , '=' , $id)->delete();
			return Redirect::to('dinas_obat')->with('success', 'Data Obat berhasil dihapus');
		}
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$perawat = DB::table('diobat')->join('dijenisobat', 'diobat.kodejenis', '=', 'dijenisobat.kodejenis');
		return Datatable::query($perawat)
			->addColumn('kodobat',function($model)
        	{
            	return '<a href="'.url('dinas_obat/'.$model->kodobat.'/edit').'">'.$model->kodobat.'</a>';
        	})
			->showColumns('namaobat','komposisi','satuan','namajenis' , 'stok','harga')
			->addColumn('actions',function($model)
        	{
            	return '<a href="'.url('dinas_obat/'.$model->kodobat.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->kodobat."','Obat Dinas'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('kodobat','namaobat','namajenis','stok')
			->orderColumns('kodobat','namaobat','namajenis','stok')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function editdatatable()
	{
		$perawat = DB::table('diobat')->join('dijenisobat', 'diobat.kodejenis', '=', 'dijenisobat.kodejenis');
		return Datatable::query($perawat)
			->addColumn('pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_obat('.
            				"'".$model->kodobat."',".
            				"'".$model->namaobat."',".
            				"'".$model->harga."'".
            			')" href="#">Pilih</a>';
        	})
			->showColumns('kodobat','namaobat','komposisi','satuan','namajenis' , 'harga')
			->searchColumns('kodobat','namaobat','namajenis')
			->orderColumns('kodobat','namaobat','namajenis')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletable()
	{
		$perawat = DB::table('tbperawat');
		return Datatable::query($perawat)
			->addColumn('PerawatID',function($model)
        	{
            	return '<a class="btn" onclick="tambahkan_perawat('."'".$model->PerawatID."'".')" href="javascript:void(0)">Tambah</a>';
        	})
			->showColumns('NamaPerawat')
			->searchColumns('PerawatID','NamaPerawat')
			->orderColumns('PerawatID','NamaPerawat')->make();
	}




}
