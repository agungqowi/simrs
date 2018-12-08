<?php

class SispegPangkatController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Pangkat';
	public $table 		= 'sispeg_pangkat';
	public $slug 		= 'sispeg_pangkat';
	public $controller 	= 'SispegPangkatController';
	public $primary 	= 'id';
	public $table_trans = 'sispeg_pegawai';
	public $field_trans = 'id_pangkat';

	public function getColumns(){
		$column = array();

		$column['id'] 			= 'ID';
		$column['kode_pangkat'] 	= 'Kode Pangkat';
		$column['nama_pangkat'] 	= 'Nama Pangkat';
		$column['deskripsi'] 		= 'Deskripsi';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_pangkat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_pangkat';
		$array['label'] 	= 'Kode Pangkat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_pangkat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_pangkat';
		$array['label'] 	= 'Nama Pangkat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'deskripsi';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'deskripsi';
		$array['label'] 	= 'Deskripsi';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}