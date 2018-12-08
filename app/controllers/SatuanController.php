<?php

class SatuanController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Satuan';
	public $table 		= 'apo_satuan';
	public $slug 		= 'satuan';
	public $controller 	= 'SatuanController';
	public $primary 	= 'id';


	public function getColumns(){
		$column = array();

		$column['id'] 				= 'ID';
		$column['NamaSatuan'] 		= 'Nama';
		$column['QtyPerbandingan']	= 'Isi (x Satuan terkecil)';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaSatuan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaSatuan';
		$array['label'] 	= 'Nama Satuan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'QtyPerbandingan';
		$array['type'] 		= 'number';
		$array['name'] 		= 'QtyPerbandingan';
		$array['label'] 	= 'Isi (x satuan terkecil)';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}