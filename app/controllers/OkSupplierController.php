<?php

class OkSupplierController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Apotek Ok Supplier';
	public $table 		= 'oksupplier';
	public $slug 		= 'ok_supplier';
	public $controller 	= 'OkSupplierController';
	public $primary 	= 'kodesupp';
	public $unique 		= array( 'kodesupp' );
	public $table_trans = 'asmasuk';
	public $field_trans = 'kodesupp';

	public function getColumns(){
		$column = array();

		$column['kodesupp'] 	= 'Kode Supplier';
		$column['namasupp'] 	= 'Nama';
		$column['alamat'] 		= 'Alamat';
		$column['notelp'] 		= 'No Telp';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kodesupp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kodesupp';
		$array['label'] 	= 'Kode Supplier';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'namasupp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'namasupp';
		$array['label'] 	= 'Nama Supplier';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'alamat';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'alamat';
		$array['label'] 	= 'Alamat';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'notelp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'notelp';
		$array['label'] 	= 'Nomor Telpon';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}