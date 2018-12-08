<?php

class LabKategoriController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Kategori Pemeriksaan';
	public $table 		= 'lab_pemeriksaan';
	public $slug 		= 'lab_kategori';
	public $controller 	= 'LabKategoriController';
	public $primary 	= 'kode_jasa';
	public $table_trans = 'lab_pemeriksaan';
	public $field_trans = 'group_jasa';

	public $where 		= array(
								array('group_jasa' , '=' , '0')
	);

	public function getColumns(){
		$column = array();

		$column['kode_jasa'] 	= 'Kode';
		$column['nama_jasa'] 	= 'Nama';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama_jasa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_jasa';
		$array['label'] 	= 'Nama Kategori';
		$array['required'] 	= 'required';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}