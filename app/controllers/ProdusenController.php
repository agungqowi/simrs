<?php

class ProdusenController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Produsen';
	public $table 		= 'apo_produsen';
	public $slug 		= 'produsen';
	public $controller 	= 'ProdusenController';
	public $primary 	= 'id';
	public $table_trans = 'apo_obat';
	public $field_trans = 'kode_produsen';

	public function getColumns(){
		$column = array();

		$column['nama_produsen'] 	= 'Nama Produsen';
		$column['notelp'] 			= 'Telp';
		$column['alamat'] 			= 'Alamat';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama_produsen';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_produsen';
		$array['label'] 	= 'Nama Produsen';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Telp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'notelp';
		$array['label'] 	= 'Telp';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'alamat';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'alamat';
		$array['label'] 	= 'Alamat';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}