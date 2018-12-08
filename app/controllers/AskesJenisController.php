<?php

class AskesJenisController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Jenis Barang';
	public $table 		= 'apo_jenisobat';
	public $slug 		= 'askes_jenis';
	public $controller 	= 'AskesJenisController';
	public $primary 	= 'id';
	public $unique 		= array( 'kodejenis' );
	public $table_trans = 'apo_obat';
	public $field_trans = 'kodejenis';

	public function getColumns(){
		$column = array();

		$column['kodejenis'] 	= 'Kode Jenis';
		$column['namajenis'] 	= 'Jenis Barang';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kodejenis';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kodejenis';
		$array['label'] 	= 'Kode Jenis Barang';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'namajenis';
		$array['type'] 		= 'text';
		$array['name'] 		= 'namajenis';
		$array['label'] 	= 'Jenis Barang';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}