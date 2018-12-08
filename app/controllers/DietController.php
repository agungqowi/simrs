<?php

class DietController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Diet';
	public $table 		= 'tbdiet';
	public $slug 		= 'diet';
	public $controller 	= 'DietController';
	public $primary 	= 'id';

	//public $table_trans = 'tbpasien';
	//public $field_trans = 'GolSwasta';

	public function getColumns(){
		$column = array();

		$column['NamaDiet'] 		= 'Nama Diet';
		$column['Keterangan'] 	= 'Keterangan';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaDiet';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaDiet';
		$array['label'] 	= 'Nama Diet';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Keterangan';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'Keterangan';
		$array['label'] 	= 'Keterangan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}