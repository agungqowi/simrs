<?php

class KelasRuanganController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Kelas Ruangan';
	public $table 		= 'tbkelasruangan';
	public $slug 		= 'kelas_ruangan';
	public $controller 	= 'KelasRuanganController';
	public $primary 	= 'IdKelas';
	public $unique 		= array( );
	public $table_trans = 'tbruangan';
	public $field_trans = 'IdKelas';

	public function getColumns(){
		$column = array();

		$column['IdKelas'] 		= 'Id Kelas';
		$column['NamaKelas'] 	= 'Nama Kelas';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaKelas';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaKelas';
		$array['label'] 	= 'Nama Kelas';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}