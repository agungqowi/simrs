<?php

class SispegPensiunController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Data Pensiun';
	public $table 		= 'sispeg_pensiun';
	public $slug 		= 'sispeg_pensiun';
	public $controller 	= 'SispegPensiunController';
	public $primary 	= 'id';
	public $unique 		= array( 'id_pegawai' );

	public $join 		= array(
							array('sispeg_pegawai' , 'sispeg_pegawai.id' ,  'sispeg_pensiun.id_pegawai')
		);

	public $select 		= array('sispeg_pensiun.*' , 'sispeg_pegawai.nama' ,  'sispeg_pegawai.alamat' , 'sispeg_pegawai.tanggal_lahir');

	public $oninsert 	= array(
								'update' => array(
										'sispeg_pegawai' ,
										array( 'status' => array( 'static' => 'pensiun' ) ) ,
										array( 'id' => array( 'element' => 'id_pegawai' ) )
								)
								
							);

	public $ondestroy 	= array(
								'update' => array(
										'sispeg_pegawai' ,
										array( 'status' => array( 'static' => 'aktif' ) ) ,
										array( 'id' => 
											array( 'table' => 
												array( 'sispeg_pensiun' ,'id_pegawai' ,
													array( 'id' => array('id' => 'id') ) 
												) 
											) 
										)
								)
								
							);

	public function getColumns(){
		$column = array();
		$column['nama'] 			= 'Nama';
		$column['alamat'] 			= 'Alamat';
		$column['tanggal_lahir'] 	= 'Tanggal Lahir';
		$column['tanggal_pensiun'] 	= 'Tanggal Pensiun';
		$column['catatan'] 			= 'Catatan';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$options_kategori 	= $this->getDropdownTable( 'sispeg_pegawai' , 'id' , 'nama');
		$array 	= array();
		$array['id'] 		= 'id_pegawai';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'id_pegawai';
		$array['label'] 	= 'Nama Pegawai';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'tanggal_pensiun';
		$array['type'] 		= 'nowdate';
		$array['name'] 		= 'tanggal_pensiun';
		$array['label'] 	= 'Tanggal Pensiun';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'catatan';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'catatan';
		$array['label'] 	= 'Catatan';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}

	

}