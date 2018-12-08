<?php

class MenuController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Menu';
	public $table 		= 'tbmenu';
	public $slug 		= 'menu';
	public $controller 	= 'MenuController';
	public $primary 	= 'id';


	public function getColumns(){
		$column = array();

		$column['id'] 			= 'ID';
		$column['nama_menu'] 	= 'Nama';
		$column['icon'] 		= 'Icon';
		$column['url'] 			= 'URL';
		$column['role'] 		= 'Role';
		$column['parent'] 		= 'Parent';
		$column['status'] 		= 'Status';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama_menu';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_menu';
		$array['label'] 	= 'Nama Menu';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'icon';
		$array['type'] 		= 'text';
		$array['name'] 		= 'icon';
		$array['label'] 	= 'Icon';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'role';
		$array['type'] 		= 'text';
		$array['name'] 		= 'role';
		$array['label'] 	= 'Role';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'url';
		$array['type'] 		= 'text';
		$array['name'] 		= 'url';
		$array['label'] 	= 'URL';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'status';
		$array['type'] 		= 'select';
		$array['name'] 		= 'status';
		$array['label'] 	= 'Status';
		$array['options'] 	= array('1' => 'aktif' , '0' => 'tidak aktif');
		array_push($forms , $array);

		$where 		= array( array('parent' ,'=' , '0') );
		$options 	= $this->getDropdownTable( 'tbmenu' , 'id' , 'nama_menu' , $where );
		$array 	= array();
		$array['id'] 		= 'parent';
		$array['type'] 		= 'select';
		$array['name'] 		= 'parent';
		$array['label'] 	= 'Parent';
		$array['options'] 	= $options;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'urutan';
		$array['type'] 		= 'number';
		$array['name'] 		= 'urutan';
		$array['label'] 	= 'Urutan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'menu_atas';
		$array['type'] 		= 'select';
		$array['name'] 		= 'menu_atas';
		$array['label'] 	= 'Menu Atas';
		$array['options'] 	= array('1' => 'Tampil' , '0' => 'Tidak tampil');
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'menu_samping';
		$array['type'] 		= 'select';
		$array['name'] 		= 'menu_samping';
		$array['label'] 	= 'Menu Samping';
		$array['options'] 	= array('1' => 'Tampil' , '0' => 'Tidak tampil');
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}