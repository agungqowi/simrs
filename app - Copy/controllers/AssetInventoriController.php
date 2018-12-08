<?php

class AssetInventoriController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Inventori Barang';
	public $table 		= 'asset_inventori';
	public $slug 		= 'asset_inventori';
	public $controller 	= 'AssetInventoriController';
	public $primary 	= 'id';
	public $table_trans = 'asmasuk';
	public $field_trans = 'kodesupp';

	public $leftjoin 	= array(							
								array( 'asset_kategori' , 'asset_kategori.id' , 'asset_inventori.id_kategori' ) , 
								array( 'asset_merk' , 'asset_merk.id' , 'asset_inventori.id_merk' ) , 
						);

	public $select 		= array( 'asset_inventori.*' , 'asset_merk.nama_merk' , 'asset_kategori.nama_kategori' );
	public function getColumns(){
		$column = array();

		$column['kode_barang'] 		= 'Kode Barang';
		$column['nama_barang'] 		= 'Nama Barang';
		$column['jumlah'] 			= 'Jumlah Barang';
		$column['nama_merk'] 		= 'Merk';
		$column['nama_kategori'] 	= 'Kategori';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'kode_barang';
		$array['type'] 		= 'text';
		$array['name'] 		= 'kode_barang';
		$array['label'] 	= 'Kode Barang';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_barang';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_barang';
		$array['label'] 	= 'Nama Barang';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'asset_kategori' , 'id' , 'nama_kategori');
		$array 	= array();
		$array['id'] 		= 'id_kategori';
		$array['type'] 		= 'selectdb';
		$array['name'] 		= 'id_kategori';
		$array['label'] 	= 'Kategori';
		$array['options'] 	= $options;
		$array['forms'] 	= array( 'nama_kategori' => 'Nama Kategori' );
		$array['tables'] 	= array( 'asset_kategori' , 'id' , 'nama_kategori' );
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'asset_merk' , 'id' , 'nama_merk');
		$array 	= array();
		$array['id'] 		= 'id_merk';
		$array['type'] 		= 'selectdb';
		$array['name'] 		= 'id_merk';
		$array['label'] 	= 'Merk';
		$array['forms'] 	= array( 'nama_merk' => 'Nama Merk' );
		$array['tables'] 	= array( 'asset_merk' , 'id' , 'nama_merk' );
		$array['options'] 	= $options;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'jumlah';
		$array['type'] 		= 'text';
		$array['name'] 		= 'jumlah';
		$array['label'] 	= 'Jumlah Awal';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'deskripsi';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'deskripsi';
		$array['label'] 	= 'Deskripsi';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}