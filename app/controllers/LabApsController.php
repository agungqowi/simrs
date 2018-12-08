<?php

class LabApsController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Pasien APS';
	public $table 		= 'lab_dataperiksa';
	public $slug 		= 'lab_antrian';
	public $controller 	= 'LabAntrianController';
	public $primary 	= 'id';


	public $select 		= array('lab_dataperiksa.*');

	public $where 		= array(
								array('status' , '=' , '0')
							);

	public $order 		= array('id' , 'ASC');

	public $disable_edit 	= true;
	public $disable_add 	= true;

	public $custom_action 	= array(
								array( 'target' => 'lab/periksa/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
							);

	public function getColumns(){
		$column = array();

		$column['tanggal'] 			= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['nama'] 			= 'Nama';
		$column['asal'] 			= 'Jenis Rawat';
		$column['kategori'] 		= 'Pemeriksaan';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$options 	= $this->getDropdownTable( 'lab_kategori' , 'id' , 'nama_kategori');
		$array['id'] 		= 'id_kategori';
		$array['type'] 		= 'selectdb';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'id_kategori';
		$array['label'] 	= 'Kategori';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';		
		$array['forms'] 	= array( 'nama_kategori' => 'Nama Kategori' );
		$array['tables'] 	= array( 'lab_kategori' , 'id' , 'nama_kategori' );
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_periksa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_periksa';
		$array['label'] 	= 'Nama Pemeriksaan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_rujukan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_rujukan';
		$array['label'] 	= 'Nilai Rujukan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'satuan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'satuan';
		$array['label'] 	= 'Satuan';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}