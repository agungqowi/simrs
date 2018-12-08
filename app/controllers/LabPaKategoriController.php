<?php

class LabPaKategoriController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Kategori Pemeriksaan PA';
	public $table 		= 'lab_pa_kategori';
	public $slug 		= 'lab_pa_kategori';
	public $controller 	= 'LabPaKategoriController';
	public $primary 	= 'id';
	public $table_trans = 'lab_pemeriksaan';
	public $field_trans = 'id_kategori';

	public function getColumns(){
		$column = array();

		$column['id'] 	= 'ID';
		$column['nama_kategori'] 	= 'Nama Kategori';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama_kategori';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_kategori';
		$array['label'] 	= 'Nama Kategori';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}