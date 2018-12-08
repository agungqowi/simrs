<?php

class AssetKategoriController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Kategori Asset';
	public $table 		= 'asset_kategori';
	public $slug 		= 'asset_kategori';
	public $controller 	= 'AssetKategoriController';
	public $primary 	= 'id';
	public $table_trans = 'asset_inventori';
	public $field_trans = 'id_kategori';

	public function getColumns(){
		$column = array();

		$column['kode_kategori'] 	= 'Kode Kategori';
		$column['nama_kategori'] 	= 'Nama Kategori';
		$column['deskripsi'] 		= 'Deskripsi';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_kategori';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_kategori';
		$array['label'] 	= 'Kode Kategori';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_kategori';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_kategori';
		$array['label'] 	= 'Nama Kategori';
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