<?php

class DokterOldController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('dokter.list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('dokter.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'txt_nama_dokter'    => 'required|min:3', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('dokter/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$dokter = new Dokter;
			$dokter->NamaDokter = Input::get('txt_nama_dokter');
			$dokter->NRP = Input::get('txt_nrp');
			$dokter->Spesialisasi = Input::get('txt_spesialisasi');
			$dokter->NoTelp = Input::get('txt_no_telp');
			$dokter->Keterangan = Input::get('txt_keterangan');
			$dokter->save();

			return Redirect::to('dokter')->with('success', 'Data dokter berhasil ditambahkan');
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
		$dokter = DB::table('tbdaftardokter')->where('IdDokter', $id)->first();
		return View::make('dokter.edit' , array( 'dokter' => $dokter ));
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
			'txt_nama_dokter'    => 'required|min:3', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('dokter/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$dokter = array();
			$dokter['NamaDokter'] = Input::get('txt_nama_dokter');
			$dokter['PangkatCorps'] = Input::get('txt_pangkat_korps');
			$dokter['NRP'] = Input::get('txt_nrp');
			$dokter['Spesialisasi'] = Input::get('txt_spesialisasi');
			$dokter['NoTelp'] = Input::get('txt_no_telp');
			$dokter['Keterangan'] = Input::get('txt_keterangan');

			Dokter::where('IdDokter', '=', $id)->update($dokter);

			return Redirect::to('dokter')->with('success', 'Data dokter berhasil diubah');
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
		$t1 = DB::table('tbdetaildokter')->where('IDDokter' , '=' , $id)->count();
		if($t1 > 0){
			return Redirect::to('dokter')->with('success', 'Data dokter tidak diizinkan untuk dihapus');
		}
		else{
			$t2 = DB::table('tbdetailpemeriksaan')->where('iddokter' , '=' , $id)->count();
			if($t2 > 0){
				return Redirect::to('dokter')->with('success', 'Data dokter tidak diizinkan untuk dihapus');
			}
			else{
				DB::table('tbdaftardokter')->where('IdDokter' , '=' , $id)->delete();
				return Redirect::to('dokter')->with('success', 'Data dokter berhasil dihapus');
			}
		}
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$dokter = DB::table('tbdaftardokter');
		return Datatable::query($dokter)
			->addColumn('IdDokter',function($model)
        	{
            	return '<a href="'.url('dokter/'.$model->IdDokter.'/edit').'">'.$model->IdDokter.'</a>';
        	})
			->showColumns('NamaDokter','NRP','Spesialisasi',
                            'NoTelp','Keterangan')
			->addColumn('Action',function($model)
        	{
            	return '<a href="'.url('dokter/'.$model->IdDokter.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->IdDokter."','Dokter'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('IdDokter','NamaDokter','NRP','Spesialisasi')
			->orderColumns('IdDokter','NamaDokter','NRP','Spesialisasi')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletable()
	{
		$dokter = DB::table('tbdaftardokter')->join('tbspesialis' , 'tbspesialis.id' , '=' ,'tbdaftardokter.Spesialisasi');
		return Datatable::query($dokter)
			->addColumn('IdDokter',function($model)
        	{
            	return '<a class="btn" onclick="pilih_dokter('."'".$model->IdDokter."','".$model->NamaDokter."'".')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('NamaDokter','nama')
			->searchColumns('IdDokter','NamaDokter','nama')
			->orderColumns('IdDokter','NamaDokter','nama')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletabletindakan()
	{
		$dokter = DB::table('tbdaftardokter')->join('tbspesialis' , 'tbdaftardokter.Spesialisasi' ,'=' ,'tbspesialis.id');
		return Datatable::query($dokter)
			->addColumn('IdDokter',function($model)
        	{
            	return '<a class="btn" onclick="pilih_dokterTindakan('."'".$model->IdDokter."','".$model->NamaDokter."'".')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('NamaDokter','nama')
			->searchColumns('IdDokter','NamaDokter','nama')
			->orderColumns('IdDokter','NamaDokter','nama')->make();
	}




}
