<?php

class OkObatController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Data Obat';
	public $table 		= 'asobat';
	public $slug 		= 'ok_obat';
	public $controller 	= 'OkObatController';
	public $primary 	= 'kodobat';
	public $unique 		= array( 'kodobat' );
	public $table_trans = 'tbdetailobat';
	public $field_trans = 'IdObat';

	public function getColumns(){
		$column = array();

		$column['kodobat'] 		= 'Kode Obat';
		$column['namaobat'] 	= 'Nama Obat';
		$column['komposisi'] 	= 'Komposisi';
		$column['satuan'] 		= 'Satuan';
		$column['harga'] 		= 'Harga';
		$column['stok'] 		= 'Stok';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kodobat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kodobat';
		$array['label'] 	= 'Kode Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'namaobat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'namaobat';
		$array['label'] 	= 'Nama Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'asjenisobat' , 'kodejenis' , 'namajenis');
		$array 	= array();
		$array['id'] 		= 'kodejenis';
		$array['type'] 		= 'select';
		$array['name'] 		= 'kodejenis';
		$array['label'] 	= 'Jenis Obat';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'satuan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'satuan';
		$array['label'] 	= 'Satuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'harga';
		$array['type'] 		= 'number';
		$array['name'] 		= 'harga';
		$array['label'] 	= 'Harga Jual';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'hargabeli';
		$array['type'] 		= 'number';
		$array['name'] 		= 'hargabeli';
		$array['label'] 	= 'Harga Beli';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'masa';
		$array['type'] 		= 'date';
		$array['name'] 		= 'masa';
		$array['label'] 	= 'Masa';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'stok';
		$array['type'] 		= 'text';
		$array['name'] 		= 'stok';
		$array['label'] 	= 'Stok';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}