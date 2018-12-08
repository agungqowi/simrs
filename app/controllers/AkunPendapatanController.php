<?php

class AkunPendapatanController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Akun Pendapatan';
	public $table 		= 'akun_rekening';
	public $slug 		= 'akun_pendapatan';
	public $controller 	= 'AkunPendapatanController';
	public $primary 	= 'id';
	public $table_trans = 'akun_transaksi';
	public $field_trans = 'id_akun';

	public $leftjoin 	= array(							
								array( 'tbtindakanjenis' , 'tbtindakanjenis.id' , 'akun_rekening.id_jenis' )
						);

	public $select 		= array( 'akun_rekening.*' , 'tbtindakanjenis.nama_jenis' );

	public $where 		= array(  array( 'tipe' , '=' , 'Pendapatan Tindakan' ) );

	public function getColumns(){
		$column = array();

		$column['kode_akun'] 	= 'Kode Akun';
		$column['nama_akun'] 	= 'Nama Akun';
		$column['tipe'] 		= 'Tipe';
		$column['balance'] 		= 'Balance';
		$column['nama_jenis'] 	= 'Sumber';

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

		$options 			= array( 
							'Pendapatan Tindakan' => 'Pendapatan Tindakan'
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

		$options 	= $this->getDropdownTable( 'tbtindakanjenis' , 'id' , 'nama_jenis');
		$array 	= array();
		$array['id'] 		= 'id_jenis';
		$array['type'] 		= 'selectdb';
		$array['name'] 		= 'id_jenis';
		$array['label'] 	= 'Sumber Pendapatan';
		$array['options'] 	= $options;
		$array['forms'] 	= array( 'nama_jenis' => 'Nama Jenis' );
		$array['tables'] 	= array( 'tbtindakanjenis' , 'id' , 'nama_jenis' );
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}