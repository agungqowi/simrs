<?php

class RekamController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Rekam Medis';
	public $table 		= 'groups';
	public $slug 		= 'group';
	public $controller 	= 'RekamController';
	public $primary 	= 'id';
	public $unique 		= array(  );
	public $table_trans = 'users';
	public $field_trans = 'group_id';

	public $form_span 	= '12';

	public function form_edit(){
		return $this->form_add();
	}

	public function tracer(){
		return View::make('rekam.tracer' , 
			array(
				'title' 		=> $this->title,
				'slug' 			=> $this->slug
			)
		);
	}
}