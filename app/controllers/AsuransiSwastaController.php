<?php

class AsuransiSwastaController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Asuransi';
	public $table 		= 'tbasuransi';
	public $slug 		= 'asuransi_swasta';
	public $controller 	= 'AsuransiSwastaController';
	public $primary 	= 'id';
	public $table_trans = 'tbpasien';
	public $field_trans = 'GolSwasta';

	public function getColumns(){
		$column = array();

		$column['nama_asuransi'] 	= 'Nama Asuransi';
		$column['telp'] 			= 'Telp';
		$column['email'] 			= 'Email';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama_asuransi';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_asuransi';
		$array['label'] 	= 'Nama Asuransi';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Telp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'telp';
		$array['label'] 	= 'Telp';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'alamat';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'alamat';
		$array['label'] 	= 'Alamat';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'email';
		$array['type'] 		= 'text';
		$array['name'] 		= 'email';
		$array['label'] 	= 'Email';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}