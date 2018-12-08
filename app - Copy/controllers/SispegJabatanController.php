<?php

class SispegJabatanController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Jabatan';
	public $table 		= 'sispeg_jabatan';
	public $slug 		= 'sispeg_jabatan';
	public $controller 	= 'SispegJabatanController';
	public $primary 	= 'id';
	public $table_trans = 'sispeg_pegawai';
	public $field_trans = 'id_jabatan';

	public function getColumns(){
		$column = array();

		$column['id'] 			= 'ID';
		$column['kode_jabatan'] 	= 'Kode Jabatan';
		$column['nama_jabatan'] 	= 'Nama Jabatan';
		$column['deskripsi'] 		= 'Deskripsi';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_jabatan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_jabatan';
		$array['label'] 	= 'Kode Jabatan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_jabatan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_jabatan';
		$array['label'] 	= 'Nama Jabatan';
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