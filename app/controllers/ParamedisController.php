<?php

class ParamedisController extends \CrudController {

	public $title 		= 'Paramedis';
	public $table 		= 'tbparamedis';
	public $slug 		= 'paramedis';
	public $controller 	= 'ParamedisController';
	public $primary 	= 'Id';
	public $table_trans = 'tbdetaildokter';
	public $field_trans = 'IDDokter';

	public function getColumns(){
		$column = array();

		$column['NamaParamedis']= 'Nama';
		$column['NoTelp'] 		= 'Telp';
		$column['Status'] 		= 'Status';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaParamedis';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaParamedis';
		$array['label'] 	= 'Nama';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbspesialis' , 'id' , 'nama');
		$array 	= array();
		$array['id'] 		= 'Spesialisasi';
		$array['type'] 		= 'select2';
		$array['name'] 		= 'Spesialisasi';
		$array['label'] 	= 'Spesialisasi';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'NoTelp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NoTelp';
		$array['label'] 	= 'Telp';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Status';
		$array['type'] 		= 'select';
		$array['name'] 		= 'Status';
		$array['label'] 	= 'Status';
		$array['options'] 	= array('aktif' => 'aktif' , 'nonaktif' => 'nonaktif');
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletable()
	{
		$dokter = DB::table('tbparamedis')->join('tbspesialis' , 'tbspesialis.id' , '=' ,'tbparamedis.Spesialisasi');
		return Datatable::query($dokter)
			->addColumn('Id',function($model)
        	{
            	return '<a class="btn" onclick="pilih_dokter('."'".$model->Id."','".$model->NamaParamedis."'".')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('NamaParamedis','nama')
			->searchColumns('IdDokter','NamaParamedis','nama')
			->orderColumns('IdDokter','NamaParamedis','nama')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletabletindakan()
	{
		$dokter = DB::table('tbparamedis');
		return Datatable::query($dokter)
			->addColumn('Id',function($model)
        	{
            	return '<a class="btn" onclick="pilih_perawatTindakan('."'".$model->Id."','".$model->NamaParamedis."'".')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('NamaParamedis')
			->searchColumns('Id','NamaParamedis')
			->orderColumns('Id','NamaParamedis')->make();
	}




}
