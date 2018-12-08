<?php

class ObatController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('obat.list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('obat.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'txt_nama'    => 'required|min:3', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('obat/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$perawat = new Perawat;
			$perawat->PerawatID = date('Ymd').mt_rand();
			$perawat->NamaPerawat = Input::get('txt_nama');
			$perawat->NRP = Input::get('txt_nrp');
			$perawat->noTelp = Input::get('txt_no_telp');
			$perawat->Keterangan = Input::get('txt_keterangan');
			$perawat->save();

			return Redirect::to('perawat')->with('success', 'Data Perawat berhasil ditambahkan');
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
		$perawat = DB::table('tbperawat')->where('PerawatID', $id)->first();
		return View::make('perawat.edit' , array( 'perawat' => $perawat ));
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
			'txt_nama'    => 'required|min:3', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('perawat/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$perawat = array();
			$perawat['NamaPerawat'] = Input::get('txt_nama');
			$perawat['NRP'] = Input::get('txt_nrp');
			$perawat['noTelp'] = Input::get('txt_no_telp');
			$perawat['Keterangan'] = Input::get('txt_keterangan');

			Perawat::where('PerawatID', '=', $id)->update($perawat);

			return Redirect::to('perawat')->with('success', 'Data Perawat berhasil diubah');
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
		//
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$perawat = DB::table('tbobataskes');
		return Datatable::query($perawat)
			->addColumn('IdObat',function($model)
        	{
            	return '<a href="'.url('obat/'.$model->IdObat.'/edit').'">'.$model->IdObat.'</a>';
        	})
			->showColumns('NamaObat','Komposisi','Satuan','GolObat' , 'Stok','Harga')
			->searchColumns('IdObat','NamaObat','GolObat','Stok')
			->orderColumns('IdObat','NamaObat','GolObat','Stok')->make();
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
