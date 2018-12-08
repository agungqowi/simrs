<?php

class PoliController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Poli';
	public $table 		= 'tbpoli';
	public $slug 		= 'poli';
	public $controller 	= 'PoliController';
	public $primary 	= 'IdPoli';
	public $unique 		= array(  );
	public $table_trans = 'tbpasienjalan';
	public $field_trans = 'IdPoli';

	public $form_span 	= '12';

	/*
	public $custom_action 	= array(
								array( 'target' => 'poli/dokter/{primary}', 'icon' => 'splashy-contact_blue')
							);
	*/
	public function getColumns(){
		$column = array();

		$column['NamaPoli'] 	= 'Poli';
		$column['KodePoli'] 	= 'Kode Poli';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaPoli';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaPoli';
		$array['label'] 	= 'Nama Poli';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'KodePoli';
		$array['type'] 		= 'text';
		$array['name'] 		= 'KodePoli';
		$array['label'] 	= 'Kode Poli';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$where 		= array(
						array( 'jenis' , '=' , '1')
		);
		$options 	= $this->getDropdownTable( 'tbspesialis' , 'id' , 'nama' , $where );
		$array 	= array();
		$array['id'] 		= 'Spesialis';
		$array['type'] 		= 'multiple';
		$array['name'] 		= 'Spesialis';
		$array['label'] 	= 'Spesialisasi';
		$array['options'] 	=  $options;
		array_push($forms , $array);

		$options 		= array( '0' => 'Spesialis' , '1' => 'Umum' ,'2' => 'IGD' ,'3' => 'Penunjang' );
		$array 	= array();
		$array['id'] 		= 'TipePoli';
		$array['type'] 		= 'select';
		$array['name'] 		= 'TipePoli';
		$array['label'] 	= 'Tipe Poli';
		$array['options'] 	=  $options;
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}

	public function dokter($id = 0){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaPoli';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaPoli';
		$array['label'] 	= 'Nama Poli';
		$array['required'] 	= 'required';
		$array['disabled'] 	= 'disabled';
		array_push($forms , $array);

		$custom_url = false;
		$custom_add = $disable_add = $disable_edit = $disable_delete = true;

		if(isset($this->disable_add))
			$disable_add = $this->disable_add;

		if(isset($this->disable_edit))
			$disable_edit = $this->disable_edit;

		if(isset($this->disable_delete))
			$disable_delete = $this->disable_delete;

		if(isset($this->custom_add))
			$custom_add = $this->custom_add;

		return View::make('crud.create' ,
			array(	
				'forms' 			=> $forms,
				'title'				=> $this->title,
				'slug'				=> $this->slug,
				'url'				=> $custom_url,
				'form_span'			=> $this->form_span,
				'controller'		=> $this->controller,
				'disable_edit'		=> $disable_edit,
				'disable_delete' 	=> $disable_delete,
				'disable_add'		=> $disable_add,
				'custom_add'		=> $custom_add
			)
		);
	}
}