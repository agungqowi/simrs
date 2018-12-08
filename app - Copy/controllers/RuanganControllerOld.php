<?php

class RuanganControllerOld extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('ruangan.list');
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
		$ruangan = DB::table('tbruangan');
		return Datatable::query($ruangan)
			->addColumn('IdRuang',function($model)
        	{
            	//return '<a href="'.url('obat/'.$model->IdRuang.'/edit').'">'.$model->IdRuang.'</a>';
            	return $model->IdRuang;
        	})
			->showColumns('NamaRuangan','Kelas','NoKamar','NoTT' , 'Status')
			->searchColumns('IdRuang','NamaRuangan','Kelas','Status')
			->orderColumns('IdRuang','NamaRuangan','Kelas','Status')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletable($options="")
	{	
		$bypass = Config::get('settings.bypass');
		if($bypass == '1'){
			$ruangan = DB::table('tbruangan')->orderBy('IdRuang');
		}
		else{
			$ruangan = DB::table('tbruangan')->orderBy('IdRuang')->where('Status', '=', '0');
		}
		
		if($options == 'pindah'){
			return Datatable::query($ruangan)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pindah_ruangan('."'".$model->IdRuang."',".
            		"'".$model->NamaRuangan."',".
            		"'".$model->Kelas."',".
            		"'".$model->NoKamar."'".
            	')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('IdRuang','NamaRuangan','Kelas','NoKamar')
			->searchColumns('IdRuang','NamaRuangan','Kelas')
			->orderColumns('IdRuang','NamaRuangan')->make();
		}
		else{
			return Datatable::query($ruangan)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_ruangan('."'".$model->IdRuang."',".
            		"'".$model->NamaRuangan."',".
            		"'".$model->Kelas."',".
            		"'".$model->NoKamar."'".
            	')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('IdRuang','NamaRuangan','Kelas','NoKamar')
			->searchColumns('IdRuang','NamaRuangan','Kelas')
			->orderColumns('IdRuang','NamaRuangan')->make();
		}
		
		
	}


	public function combobox()
	{
		$ruangan = DB::table( 'tbruangan' )->groupBy('NamaRuangan','Kelas','NoKamar')->where('Status', '=', '0')->orderBy('IdRuang')->get();
		echo(json_encode($ruangan));
	}

}
