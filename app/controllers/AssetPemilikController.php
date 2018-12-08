<?php

class AssetPemilikController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Penanggung Jawab Asset';
	public $table 		= 'asset_pemilik';
	public $slug 		= 'asset_pemilik';
	public $controller 	= 'AssetPemilikController';
	public $primary 	= 'id';
	public $table_trans = 'sispeg_pegawai';
	public $field_trans = 'id_jabatan';

	public function getColumns(){
		$column = array();

		$column['kode_pemilik'] 	= 'Kode Pemilik';
		$column['nama_pemilik'] 	= 'Nama Pemilik';
		$column['deskripsi'] 		= 'Catatan';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_pemilik';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_pemilik';
		$array['label'] 	= 'Kode Pemilik';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_pemilik';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_pemilik';
		$array['label'] 	= 'Nama Pemilik';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'deskripsi';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'deskripsi';
		$array['label'] 	= 'Catatan';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}