<?php

class AkunRekeningController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Akun Rekening';
	public $table 		= 'akun_rekening';
	public $slug 		= 'akun_rekening';
	public $controller 	= 'AkunRekeningController';
	public $primary 	= 'id';
	public $table_trans = 'akun_transaksi';
	public $field_trans = 'id_akun';

	public function getColumns(){
		$column = array();

		$column['kode_akun'] 	= 'Kode Akun';
		$column['nama_akun'] 	= 'Nama Akun';
		$column['tipe'] 		= 'Tipe';
		$column['balance'] 		= 'Balance';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_akun';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_akun';
		$array['label'] 	= 'Kode Akun';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_akun';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_akun';
		$array['label'] 	= 'Nama Akun';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 			= array('Harta' => 'Harta' , 'Utang' => 'Utang' , 'Modal' => 'Modal' , 
							'Pendapatan Tindakan' => 'Pendapatan Tindakan' , 
							'Pendapatan Lainnya' => 'Pendapatan Lainnya' , 
							'Pendapatan Tarif Ruangan' => 'Pendapatan Tarif Ruangan' , 
							'Pendapatan Obat Apotek Askes' => 'Pendapatan Obat Apotek Askes' , 
							'Pendapatan Obat Apotek Swasta' => 'Pendapatan Obat Apotek Swasta' ,
							'Beban' =>'Beban'
					);
		$array 	= array();
		$array['id'] 		= 'tipe';
		$array['type'] 		= 'select';
		$array['name'] 		= 'tipe';
		$array['label'] 	= 'Tipe';
		$array['required'] 	= 'required';
		$array['options'] 	= $options;
		array_push($forms , $array);

		$options 			= array('D' => 'Debet' , 'K' => 'Kredit');
		$array 	= array();
		$array['id'] 		= 'balance';
		$array['type'] 		= 'select';
		$array['name'] 		= 'balance';
		$array['label'] 	= 'Balance';
		$array['required'] 	= 'required';
		$array['options'] 	= $options;
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}