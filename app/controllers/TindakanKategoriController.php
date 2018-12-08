<?php

class TindakanKategoriController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Kategori Tindakan';
	public $table 		= 'tbkategoritindakan';
	public $slug 		= 'kategori_tindakan';
	public $controller 	= 'TindakanKategoriController';
	public $primary 	= 'id';
	public $table_trans = 'tbtindakan';
	public $field_trans = 'IdKategoriTindakan';

	public $leftjoin 	= array(							
								array( 'tbtindakanjenis' , 'tbtindakanjenis.id' , 'tbkategoritindakan.id_jenis' )
						);

	public $select 		= array( 'tbkategoritindakan.*' , 'tbtindakanjenis.nama_jenis' );

	public function getColumns(){
		$column = array();

		$column['nama'] 		= 'Nama Kategori';
		$column['nama_jenis'] 	= 'Jenis Rawat';
		$column['deskripsi'] 	= 'Deskripsi';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama';
		$array['label'] 	= 'Nama Kategori';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'tbtindakanjenis' , 'id' , 'nama_jenis');
		$array 	= array();
		$array['id'] 		= 'id_jenis';
		$array['type'] 		= 'selectdb';
		$array['name'] 		= 'id_jenis';
		$array['label'] 	= 'Jenis Rawat';
		$array['options'] 	= $options;
		$array['forms'] 	= array( 'nama_jenis' => 'Nama Jenis' );
		$array['tables'] 	= array( 'tbtindakanjenis' , 'id' , 'nama_jenis' );
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'deskripsi';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'deskripsi';
		$array['label'] 	= 'Deskripsi';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}