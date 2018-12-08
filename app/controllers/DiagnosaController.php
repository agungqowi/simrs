<?php

class DiagnosaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('diagnosa.list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('diagnosa.create');
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
		$perawat = DB::table('refdiagnosis');
		return Datatable::query($perawat)
			->addColumn('IdDiag',function($model)
        	{
            	//return '<a href="'.url('diagnosa/'.$model->IdDiag.'/edit').'">'.$model->IdDiag.'</a>';
            	return $model->IdDiag;
        	})
			->showColumns('ShortDiagnoisDesc','LongDiagnosisDesc')
			->searchColumns('IdDiag','ShortDiagnoisDesc','LongDiagnosisDesc')
			->orderColumns('IdDiag','ShortDiagnoisDesc','LongDiagnosisDesc')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletable()
	{
		$perawat = DB::table('refdiagnosis');
		return Datatable::query($perawat)
			->addColumn('Pilih Diag',function($model)
        	{
            	return '<a class="btn" onclick="pilih_diagnosa('.
            		"'".$model->IdDiag."',".
            		"'".$model->ShortDiagnoisDesc."',".
            		"'".$model->LongDiagnosisDesc."'".
            	')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('IdDiag','ShortDiagnoisDesc' , 'LongDiagnosisDesc')
			->searchColumns('IdDiag','ShortDiagnoisDesc','LongDiagnosisDesc')
			->orderColumns('IdDiag','ShortDiagnoisDesc','LongDiagnosisDesc')->make();
	}

	public function tambahDDiagnosa(){

		$noreg 			= Input::get('noreg');
		$id_diagnosa	= Input::get('id_diagnosa');
		$nama			= Input::get('nama');
		$norm			= Input::get('norm');
		$short			= Input::get('short');
		$long			= Input::get('long');
		$date 			= DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal 		= $date->format('Y-m-d');
		$status			= Input::get('status');
		$jenis_rawat	= Input::get('jenis_rawat');
		$keterangan		= Input::get('keterangan');

		$data 			= array();
		$insert	= DB::table('tbdetaildiagnosis')->insert(
			array(
					'NoReg' 			=> $noreg,
					'IdDiag' 			=> $id_diagnosa,
					'Nama' 				=> $nama,
					'NoRM' 				=> $norm,
					'ShortDiagnoisDesc' 	=> $short,
					'LongDiagnosisDesc' 	=> $long,
					'tanggal' 		=> $tanggal,
					'status' 		=> $status,
					'Keterangan' 		=> $keterangan,
					'JenisRawat' 	=> $jenis_rawat
			)
		);
	}

	public function listDiagnosa($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbdetaildiagnosis')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function hapusDiagnosa()
	{
		$id_diagnosa = Input::get('id_diagnosa');
		$id_reg = Input::get('noreg');
		$data = DB::table('tbdetaildiagnosis')->where('id' , '=' , $id_diagnosa)->where('NoReg' , '=' , $id_reg)->delete();
		echo $data;
	}




}
