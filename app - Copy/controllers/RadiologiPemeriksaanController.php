<?php

class RadiologiPemeriksaanController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Table Pemeriksaan';
	public $table 		= 'radiologi_pemeriksaan';
	public $slug 		= 'radiologi_pemeriksaan';
	public $controller 	= 'RadiologiPemeriksaanController';
	public $primary 	= 'kd_rad';
	public $unique 		= array( 'kd_rad' );
	public $table_trans = 'radiologi_detailperiksa';
	public $field_trans = 'id_pemeriksaan';

	public $join 		= array(
							array('radiologi_pemeriksaan as L2' , 'L2.kd_rad' , 'radiologi_pemeriksaan.gr_rad')
	);

	public $where 		= array(
								array('radiologi_pemeriksaan.gr_rad' , '!=' , '-')
	);

	public $select 		= array('radiologi_pemeriksaan.*' , 'L2.nama_rad as kategori');

	public $filter 			= array( 
										'kategori_radiologi' => 'radiologi_pemeriksaan.gr_rad'
							);



	public function getColumns(){
		$column = array();

		$column['nama_rad'] 	= 'Nama Pemeriksaan';
		$column['kategori'] 	= 'Kategori';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kd_rad';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kd_rad';
		$array['label'] 	= 'Kode Pemeriksaan';
		$array['required'] 	= 'required';
		array_push($forms , $array);
		
		$array 	= array();
		$array['id'] 		= 'nama_rad';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_rad';
		$array['label'] 	= 'Nama Pemeriksaan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$where 	= array( array('gr_rad','=','-'));
		$options 	= $this->getDropdownTable( 'radiologi_pemeriksaan' , 'kd_rad' , 'nama_rad' , $where);
		$array['id'] 		= 'gr_rad';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'gr_rad';
		$array['label'] 	= 'Kategori';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kd_rad';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kd_rad';
		$array['label'] 	= 'Kode Pemeriksaan';
		$array['disabled'] 	= 'disabled';
		$array['required'] 	= 'required';
		array_push($forms , $array);
		
		$array 	= array();
		$array['id'] 		= 'nama_rad';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_rad';
		$array['label'] 	= 'Nama Pemeriksaan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$where 	= array( array('gr_rad','=','-'));
		$options 	= $this->getDropdownTable( 'radiologi_pemeriksaan' , 'kd_rad' , 'nama_rad' , $where);
		$array['id'] 		= 'gr_rad';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'gr_rad';
		$array['label'] 	= 'Kategori';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}
}