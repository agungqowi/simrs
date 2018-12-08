<?php

class TindakanJenisController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Jenis Rawat Tindakan';
	public $table 		= 'tbtindakanjenis';
	public $slug 		= 'tindakan_jenis';
	public $controller 	= 'TindakanJenisController';
	public $primary 	= 'id';
	public $table_trans = 'tbkategoritindakan';
	public $field_trans = 'id_tindakan';

	public function getColumns(){
		$column = array();

		$column['kode_jenis'] 	= 'Kode Jenis';
		$column['nama_jenis'] 	= 'Nama Jenis';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_jenis';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_jenis';
		$array['label'] 	= 'Kode Jenis';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_jenis';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_jenis';
		$array['label'] 	= 'Nama Jenis';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}