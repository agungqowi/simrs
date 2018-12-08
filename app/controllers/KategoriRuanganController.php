<?php

class KategoriRuanganController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Kategori Ruangan';
	public $table 		= 'tbkategoriruangan';
	public $slug 		= 'kategori_ruangan';
	public $controller 	= 'KategoriRuanganController';
	public $primary 	= 'IdKategori';
	public $unique 		= array(  );
	public $table_trans = 'tbkelasruangan';
	public $field_trans = 'IdKategori';

	public function getColumns(){
		$column = array();

		$column['IdKategori']		= 'ID' ;
		$column['NamaKategori'] 	= 'Kategori';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaKategori';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaKategori';
		$array['label'] 	= 'Nama Kategori';
		$array['required'] 	= 'required';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}