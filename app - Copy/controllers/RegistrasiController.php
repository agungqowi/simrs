<?php

class RegistrasiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$registrasi = User::find( Auth::user()->id )->registrasi;
		return View::make('registrasi.list', array('registrasi' => $registrasi));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('registrasi.create' );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'title'    => 'required|min:3', // make sure the email is an actual email
			'registrasi' => 'required|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('registrasi/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$registrasi = new registrasi;
			$registrasi->title = Input::get('title');
			$registrasi->registrasi = Input::get('registrasi');
			$registrasi->user_id = Auth::user()->id;
			$registrasi->save();

			return Redirect::to('registrasi')->with('success', 'registrasi Created Successfully.');
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
		$registrasi = registrasi::find($id);

		return View::make('registrasi.show')->with('registrasi', $registrasi);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the registrasi
		$registrasi = registrasi::find($id);

		// show the edit form and pass the registrasi
		return View::make('registrasi.edit')->with('registrasi', $registrasi);
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
			'title'    => 'required|min:3', // make sure the email is an actual email
			'registrasi' => 'required|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('registrasi/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$registrasi = registrasi::find($id);
			$registrasi->title = Input::get('title');
			$registrasi->registrasi = Input::get('registrasi');
			$registrasi->user_id = Auth::user()->id;
			$registrasi->save();

			return Redirect::to('registrasi')->with('success', 'registrasi Updated Successfully.');
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

	public function rawat_inap()
	{
		return View::make('registrasi.rawat_inap' );
	}


}
