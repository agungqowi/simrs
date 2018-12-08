<?php

class GroupController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Group';
	public $table 		= 'groups';
	public $slug 		= 'group';
	public $controller 	= 'GroupController';
	public $primary 	= 'id';
	public $unique 		= array(  );
	public $table_trans = 'users';
	public $field_trans = 'group_id';

	public $form_span 	= '12';

	public function getColumns(){
		$column = array();

		$column['name'] 	= 'Nama Group';
		$column['slug'] 	= 'Alias';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'name';
		$array['type'] 		= 'text';
		$array['name'] 		= 'name';
		$array['label'] 	= 'Nama Group';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 	= $this->getComplexDropdownTable( 'tbmenu' , 'id' , array('parent' => 0) , array( array('urutan' , 'ASC') ) );
		$array 	= array();
		$array['id'] 		= 'permissions';
		$array['type'] 		= 'multiple_menu';
		$array['name'] 		= 'permissions';
		$array['label'] 	= 'Permission';
		$array['separator'] = 'parent';
		$array['options'] 	=  $options;
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'tbpoli' , 'IdPoli' , 'NamaPoli' );
		$array 	= array();
		$array['id'] 		= 'poli';
		$array['type'] 		= 'multiple';
		$array['name'] 		= 'poli';
		$array['label'] 	= 'Poli';
		$array['options'] 	=  $options;
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'tbruangan' , 'IdRuang' , 'NamaRuangan' );
		$array 	= array();
		$array['id'] 		= 'ruangan';
		$array['type'] 		= 'multiple';
		$array['name'] 		= 'ruangan';
		$array['label'] 	= 'Ruangan';
		$array['options'] 	=  $options;
		array_push($forms , $array);


		$options 	= $this->getDropdownTable( 'tbtindakanjenis' , 'id' , 'nama_jenis' );
		$array 	= array();
		$array['id'] 		= 'tindakan';
		$array['type'] 		= 'multiple';
		$array['name'] 		= 'tindakan';
		$array['label'] 	= 'Kategori Tindakan';
		$array['options'] 	=  $options;
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}