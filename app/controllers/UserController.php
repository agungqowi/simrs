<?php

class UserController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'User';
	public $table 		= 'users';
	public $slug 		= 'user';
	public $controller 	= 'UserController';
	public $primary 	= 'id';
	public $unique 		= array( 'username' );

	public $leftjoin 	= array(
							array('groups' , 'groups.id' , 'users.group_id')
		);

	public $select 		= array('users.*' ,'groups.name');

	public function getColumns(){
		$column = array();

		$column['username'] 	= 'Username';
		$column['email'] 		= 'Email';
		$column['users.name'] 		= 'Nama';
		$column['groups.name'] 	= 'Group';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'username';
		$array['type'] 		= 'text';
		$array['name'] 		= 'username';
		$array['label'] 	= 'Username';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'password';
		$array['type'] 		= 'password';
		$array['name'] 		= 'password';
		$array['label'] 	= 'Password';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'name';
		$array['type'] 		= 'text';
		$array['name'] 		= 'name';
		$array['label'] 	= 'Nama';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'email';
		$array['type'] 		= 'text';
		$array['name'] 		= 'email';
		$array['label'] 	= 'Email';
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'groups' , 'id' , 'name' );
		$array 	= array();
		$array['id'] 		= 'group_id';
		$array['type'] 		= 'select';
		$array['name'] 		= 'group_id';
		$array['label'] 	= 'Group';
		$array['required'] 	= 'required';
		$array['options'] 	=  $options;
		array_push($forms , $array);

		$options 	= array('1' => 'Aktif' , '0' => 'Banned');
		$array 	= array();
		$array['id'] 		= 'active';
		$array['type'] 		= 'select';
		$array['name'] 		= 'active';
		$array['label'] 	= 'Aktif / Banned';
		$array['required'] 	= 'required';
		$array['options'] 	=  $options;
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'username';
		$array['type'] 		= 'text';
		$array['name'] 		= 'username';
		$array['label'] 	= 'Username';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'password';
		$array['type'] 		= 'password';
		$array['name'] 		= 'password';
		$array['label'] 	= 'Password (Dikosongkan jika tidak ingin diganti)';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'name';
		$array['type'] 		= 'text';
		$array['name'] 		= 'name';
		$array['label'] 	= 'Nama';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'email';
		$array['type'] 		= 'text';
		$array['name'] 		= 'email';
		$array['label'] 	= 'Email';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 	= $this->getDropdownTable( 'groups' , 'id' , 'name' );
		$array 	= array();
		$array['id'] 		= 'group_id';
		$array['type'] 		= 'select';
		$array['name'] 		= 'group_id';
		$array['label'] 	= 'Group';
		$array['required'] 	= 'required';
		$array['options'] 	=  $options;
		array_push($forms , $array);

		$options 	= array('1' => 'Aktif' , '0' => 'Banned');
		$array 	= array();
		$array['id'] 		= 'active';
		$array['type'] 		= 'select';
		$array['name'] 		= 'active';
		$array['label'] 	= 'Aktif / Banned';
		$array['required'] 	= 'required';
		$array['options'] 	=  $options;
		array_push($forms , $array);


		return $forms;
	}
}