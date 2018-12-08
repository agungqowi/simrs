<?php

class DokterController extends \CrudController {

	public $title 		= 'Dokter';
	public $table 		= 'tbdaftardokter';
	public $slug 		= 'dokter';
	public $controller 	= 'DokterController';
	public $primary 	= 'IdDokter';

	public $join 	= array(							 
								array( 'tbspesialis' , 'tbdaftardokter.Spesialisasi' , 'tbspesialis.id' )
						);

	public function getColumns(){
		$column = array();

		$column['NamaDokter'] 	= 'Nama';
		$column['nama'] 		= 'Spesialis';
		$column['NoTelp'] 		= 'Telp';
		$column['Status'] 		= 'Status';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaDokter';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaDokter';
		$array['label'] 	= 'Nama Dokter';
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
		$dokter = DB::table('tbdaftardokter')->join('tbspesialis' , 'tbspesialis.id' , '=' ,'tbdaftardokter.Spesialisasi');
		return Datatable::query($dokter)
			->addColumn('IdDokter',function($model)
        	{
            	return '<a class="btn" onclick="pilih_dokter('."'".$model->IdDokter."','".$model->NamaDokter."'".')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('NamaDokter','nama')
			->searchColumns('IdDokter','NamaDokter','nama')
			->orderColumns('IdDokter','NamaDokter','nama')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletabletindakan()
	{
		$dokter = DB::table('tbdaftardokter')->join('tbspesialis' , 'tbdaftardokter.Spesialisasi' ,'=' ,'tbspesialis.id');
		return Datatable::query($dokter)
			->addColumn('IdDokter',function($model)
        	{
            	return '<a class="btn" onclick="pilih_dokterTindakan('."'".$model->IdDokter."','".$model->NamaDokter."'".')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('NamaDokter','nama')
			->searchColumns('IdDokter','NamaDokter','nama')
			->orderColumns('IdDokter','NamaDokter','nama')->make();
	}




}
