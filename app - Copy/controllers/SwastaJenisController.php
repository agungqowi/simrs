<?php

class SwastaJenisController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Jenis Obat';
	public $table 		= 'swjenisobat';
	public $slug 		= 'swasta_jenis';
	public $controller 	= 'SwastaJenisController';
	public $primary 	= 'kodejenis';
	public $unique 		= array( 'kodejenis' );
	public $table_trans = 'swobat';
	public $field_trans = 'kodejenis';

	public function getColumns(){
		$column = array();

		$column['kodejenis'] 	= 'Kode Jenis';
		$column['namajenis'] 	= 'Jenis Obat';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kodejenis';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kodejenis';
		$array['label'] 	= 'Kode Jenis Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'namajenis';
		$array['type'] 		= 'text';
		$array['name'] 		= 'namajenis';
		$array['label'] 	= 'Jenis Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}