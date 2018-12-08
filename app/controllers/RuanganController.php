<?php

class RuanganController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Ruangan';
	public $table 		= 'tbruangan';
	public $slug 		= 'ruangan';
	public $controller 	= 'RuanganController';
	public $primary 	= 'IdRuang';
	public $unique 		= array( );
	public $table_trans = 'tbruangan';
	public $field_trans = 'IdKelas';
	public $join		= array(  
								array( 'tbkategoriruangan' ,'tbkategoriruangan.IdKategori' , 'tbruangan.IdKategori' ) 
						);
	public $leftjoin 	= array(
								array( 'tbkelasruangan' , 'tbkelasruangan.IdKelas' , 'tbruangan.IdKelas' )
						);

	public function getColumns(){
		$column = array();

		$column['NamaRuangan'] 	= 'Nama Ruangan';
		$column['NamaKelas'] 	= 'Kelas';
		$column['NamaKategori'] = 'Kategori';
		$column['NoKamar'] 		= 'No Kamar';
		$column['NoTT'] 		= 'No TT';
		$column['Tarif'] 		= 'Tarif';
		$column['Status'] 		= 'Status';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NamaRuangan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NamaRuangan';
		$array['label'] 	= 'Nama Ruangan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 			= $this->getDropdownTable( 'tbkelasruangan' , 'IdKelas' , 'NamaKelas');
		$array 	= array();
		$array['id'] 		= 'IdKelas';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdKelas';
		$array['label'] 	= 'Kelas';
		$array['options'] 	= $options;
		array_push($forms , $array);

		$options 			= $this->getDropdownTable( 'tbkategoriruangan' , 'IdKategori' , 'NamaKategori');
		$array 	= array();
		$array['id'] 		= 'IdKategori';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdKategori';
		$array['label'] 	= 'Kategori';
		$array['required'] 	= 'required';
		$array['options'] 	= $options;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'NoKamar';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NoKamar';
		$array['label'] 	= 'No Kamar';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'NoTT';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NoTT';
		$array['label'] 	= 'No TT';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Tarif';
		$array['type'] 		= 'number';
		$array['name'] 		= 'Tarif';
		$array['label'] 	= 'Tarif';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Status';
		$array['type'] 		= 'select';
		$array['name'] 		= 'Status';
		$array['label'] 	= 'Status';
		$array['required'] 	= 'required';
		$array['options'] 	= array( '0' => 'Tersedia' , '1' => 'Penuh');
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
	public function simpletable($options="")
	{	
		$bypass = Config::get('settings.bypass');
		$ruangan = DB::table('tbruangan');
		$ruangan->leftJoin( 'tbkelasruangan' , 'tbkelasruangan.IdKelas' , '=' , 'tbruangan.IdKelas' );
		$ruangan->join( 'tbkategoriruangan' , 'tbkategoriruangan.IdKategori' , '=' , 'tbruangan.IdKategori' );
		$ruangan->orderBy('IdRuang');
		if($bypass == '1'){

		}
		else{
			$ruangan->where('Status', '=', '0');
		}
		
		if($options == 'pindah'){
			return Datatable::query($ruangan)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pindah_ruangan('."'".$model->IdRuang."',".
            		"'".$model->NamaRuangan."',".
            		"'".$model->NamaKelas."',".
            		"'".$model->NoKamar."'".
            	')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('IdRuang','NamaRuangan','NamaKelas','NoKamar')
			->searchColumns('IdRuang','NamaRuangan','NamaKelas')
			->orderColumns('IdRuang','NamaRuangan')->make();
		}
		else{
			return Datatable::query($ruangan)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_ruangan('."'".$model->IdRuang."',".
            		"'".$model->NamaRuangan."',".
            		"'".$model->NamaKelas."',".
            		"'".$model->NoKamar."'".
            	')" href="javascript:void(0)">Pilih</a>';
        	})
			->showColumns('IdRuang','NamaRuangan','NamaKelas','NoKamar','Tarif')
			->searchColumns('IdRuang','NamaRuangan','NamaKelas')
			->orderColumns('IdRuang','NamaRuangan')->make();
		}
		
		
	}
}