<?php

class AssetMerkController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Merk Asset';
	public $table 		= 'asset_merk';
	public $slug 		= 'asset_merk';
	public $controller 	= 'AssetMerkController';
	public $primary 	= 'id';
	public $table_trans = 'asset_inventori';
	public $field_trans = 'id_merk';

	public function getColumns(){
		$column = array();

		$column['kode_merk'] 	= 'Kode Merk';
		$column['nama_merk'] 	= 'Nama Merk';
		$column['deskripsi'] 		= 'Catatan';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_merk';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_merk';
		$array['label'] 	= 'Kode Merk';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_merk';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_merk';
		$array['label'] 	= 'Nama Merk';
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