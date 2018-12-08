<?php

class SispegPegawaiController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Pegawai';
	public $table 		= 'sispeg_pegawai';
	public $slug 		= 'sispeg_pegawai';
	public $controller 	= 'SispegPegawaiController';
	public $primary 	= 'id';
	public $table_trans = 'asmasuk';
	public $field_trans = 'kodesupp';

	public $leftjoin 	= array(							
								array( 'sispeg_jabatan' , 'sispeg_jabatan.id' , 'sispeg_pegawai.id_jabatan' ) , 
								array( 'sispeg_pangkat' , 'sispeg_pangkat.id' , 'sispeg_pegawai.id_pangkat' ) , 
						);

	public $select 		= array( 'sispeg_pegawai.*' , 'sispeg_pangkat.nama_pangkat' , 'sispeg_jabatan.nama_jabatan' );
	public function getColumns(){
		$column = array();

		$column['id'] 				= 'ID';
		$column['nama'] 			= 'Nama';
		$column['nama_jabatan'] 	= 'Jabatan';
		$column['nama_pangkat'] 	= 'Pangkat';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama';
		$array['label'] 	= 'Nama';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'id_ktp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'id_ktp';
		$array['label'] 	= 'Nomor NIK';
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'sispeg_pangkat' , 'id' , 'nama_pangkat');
		$array 	= array();
		$array['id'] 		= 'id_pangkat';
		$array['type'] 		= 'selectdb';
		$array['name'] 		= 'id_pangkat';
		$array['label'] 	= 'Pangkat';
		$array['options'] 	= $options;
		$array['forms'] 	= array( 'nama_pangkat' => 'Nama Pangkat' );
		$array['tables'] 	= array( 'sispeg_pangkat' , 'id' , 'nama_pangkat' );
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'sispeg_jabatan' , 'id' , 'nama_jabatan');
		$array 	= array();
		$array['id'] 		= 'id_jabatan';
		$array['type'] 		= 'selectdb';
		$array['name'] 		= 'id_jabatan';
		$array['label'] 	= 'Jabatan';
		$array['forms'] 	= array( 'nama_jabatan' => 'Nama Jabatan' );
		$array['tables'] 	= array( 'sispeg_jabatan' , 'id' , 'nama_jabatan' );
		$array['options'] 	= $options;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'alamat';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'alamat';
		$array['label'] 	= 'Alamat';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'telp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'telp';
		$array['label'] 	= 'Telp';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'tempat_lahir';
		$array['type'] 		= 'text';
		$array['name'] 		= 'tempat_lahir';
		$array['label'] 	= 'Tempat Lahir';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'tanggal_lahir';
		$array['type'] 		= 'date';
		$array['name'] 		= 'tanggal_lahir';
		$array['label'] 	= 'Tanggal Lahir';
		array_push($forms , $array);

		$options 	= array( 'islam' => 'Islam' , 'protestan' => 'Protestan' , 'katolik' => 'Katolik' , 'hindu' => 'Hindu' , 'budha' => 'Budha');
		$array 	= array();
		$array['id'] 		= 'agama';
		$array['type'] 		= 'select';
		$array['name'] 		= 'agama';
		$array['label'] 	= 'Agama';
		$array['options'] 	= $options;
		array_push($forms , $array);

		$options 	= array( 'sma' => 'SMA/Sederajat' , 'd1' => 'D1' , 'd3' =>'D3' , 's1' => 'S1' , 's2' => 'S2' , 's3' => 'S3' );
		$array 	= array();
		$array['id'] 		= 'pendidikan_terakhir';
		$array['type'] 		= 'select';
		$array['name'] 		= 'pendidikan_terakhir';
		$array['label'] 	= 'Pendidikan Terakhir';
		$array['options'] 	= $options;
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}