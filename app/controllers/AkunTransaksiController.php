<?php

class AkunTransaksiController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Transaksi';
	public $table 		= 'akun_transaksi';
	public $slug 		= 'akun_transaksi';
	public $controller 	= 'AkunTransaksiController';
	public $primary 	= 'id';
	public $table_trans = 'akun_transaksi';
	public $field_trans = 'id_akun';

	public function getColumns(){
		$column = array();

		$column['kode_akun'] 	= 'Kode Akun';
		$column['nama_akun'] 	= 'Nama Akun';
		$column['deskripsi'] 	= 'Deskripsi';
		$column['reff'] 		= 'Reff';
		$column['trans_tipe'] 	= 'D/K';
		$column['jumlah'] 		= 'jumlah';
		$column['trans_date'] 	= 'Tanggal Transaksi';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$options 	= $this->getComplexDropdownTable( 'akun_rekening' , 'id' );
		$array 	= array();
		$array['id'] 		= 'id_rekening';
		$array['type'] 		= 'selectcomplex';
		$array['name'] 		= 'id_rekening';
		$array['label'] 	= 'Akun';
		$array['class'] 	= 'select2';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		$array['keys'] 		=  array('value' => 'id' , 'data-id' => 'kode_akun' , 'data-content' => 'nama_akun');		
		$array['content'] 	=  array( 'kode_akun' , 'nama_akun' );
		$array['change']	=  array('data-id' => '#kode_akun' , 'data-content' => '#nama_akun');
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'kode_akun';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_akun';
		$array['label'] 	= 'Kode Akun';
		$array['disabled'] 	= 'disabled';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_akun';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_akun';
		$array['label'] 	= 'Nama Akun';
		$array['disabled'] 	= 'disabled';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'trans_date';
		$array['type'] 		= 'nowdate';
		$array['name'] 		= 'trans_date';
		$array['label'] 	= 'Transaksi Tanggal';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'reff';
		$array['type'] 		= 'text';
		$array['name'] 		= 'reff';
		$array['label'] 	= 'Nomor Referensi';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'deskripsi';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'deskripsi';
		$array['label'] 	= 'Deskripsi';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 			= array('D' => 'Debet' , 'K' => 'Kredit');
		$array 	= array();
		$array['id'] 		= 'trans_tipe';
		$array['type'] 		= 'select';
		$array['name'] 		= 'trans_tipe';
		$array['label'] 	= 'D/K';
		$array['required'] 	= 'required';
		$array['options'] 	= $options;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'jumlah';
		$array['type'] 		= 'text';
		$array['name'] 		= 'jumlah';
		$array['label'] 	= 'Jumlah';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}