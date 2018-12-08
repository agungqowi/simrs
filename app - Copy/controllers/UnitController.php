<?php

class UnitController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$ugd = User::find( Auth::user()->id )->ugd;
		return View::make('ugd.list', array('ugd' => $ugd));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ugd.create' );
	}

	public function hemodialisa()
	{
		return View::make('penunjang.general_withdokter' , array('title' => 'Hemodialisa' , 'slug' => 'hemodialisa' ,'parent' => 'Unit Khusus'));
	}

	public function icu()
	{
		return View::make('penunjang.general_withdokter' , array('title' => 'ICU' , 'slug' => 'icu' ,'parent' => 'Unit Khusus'));
	}

	public function ok()
	{
		return View::make('unit.ok' , array('title' => 'OK' , 'slug' => 'ok' ,'parent' => 'Unit Khusus'));
	}


}
