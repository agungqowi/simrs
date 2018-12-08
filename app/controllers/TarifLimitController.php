<?php

class TarifLimitController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Limit Tarif Paket';
	public $table 		= 'tarif_limit';
	public $slug 		= 'tarif_limit';
	public $controller 	= 'TarifLimitController';
	public $primary 	= 'id';

	public $join 		= array(							
								array( 'tbtindakan' , 'tbtindakan.IdTindakan' , 'tarif_limit.IdTindakan' ) 
						);

	public $select 		= array( 'tarif_limit.*' , 'tbtindakan.Tindakan' );
	public function getColumns(){
		$column = array();

		$column['Tindakan'] 		= 'Nama Tarif';
		$column['Obat'] 			= 'Obat';
		$column['Lab'] 				= 'Lab';
		$column['PersentaseObat'] 	= 'Persentase Obat';
		$column['PersentaseLab'] 	= 'Persentase Lab';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$options 	= $this->getDropdownTable( 'tbtindakan' , 'IdTindakan' , 'Tindakan', 
						array( 
							array('TipeTindakan' , '=' ,'P') 
						) );

		$array 	= array();
		$array['id'] 		= 'IdTindakan';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdTindakan';
		$array['label'] 	= 'Tarif';
		$array['options'] 	= $options;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Lab';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Lab';
		$array['label'] 	= 'Lab';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Obat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Obat';
		$array['label'] 	= 'Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 				= array();
		$array['id'] 		= 'PersentaseLab';
		$array['type'] 		= 'text';
		$array['name'] 		= 'PersentaseLab';
		$array['label'] 	= 'Persentase Lab';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 				= array();
		$array['id'] 		= 'PersentaseObat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'PersentaseObat';
		$array['label'] 	= 'Persentase Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}
}