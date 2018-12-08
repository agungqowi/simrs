<?php

class ApotekOpnameController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Stok Opname Apotek';
	public $table 		= 'apo_detailobat';
	public $slug 		= 'apotek_opname';
	public $controller 	= 'ApotekOpnameController';
	public $primary 	= 'kodobat';
	public $table_trans = 'tbdetailobat';
	public $field_trans = 'IdObat';


	public $where 		= array( 
								 array( 'tempat' ,'=' , 'apotek_askes' )
						);

	public $disable_add 	= true;
	public $disable_delete 	= true;
	public $disable_edit 	= true;
	public $disable_action 	= true;

	public $select 		= array('apo_detailobat.*' , 'apo_detailobat.stok as stok_op');

	public $js_include 	= "apotek/general/js/stok";

	public function getColumns(){
		$column = array();

		$column['namaobat'] 		= 'Nama Obat';
		$column['satuan'] 			= 'Satuan';
		$column['het'] 		 		= array('title' => 'HET' , 'type' => 'inputtext' , 'class' => 'het-op');
		$column['stok_op'] 		 	= array('title' => 'SO Obat' , 'type' => 'inputtext' , 'class' => 'stok-op');
		$column['stok'] 		 	= 'Stok Komputer';

		return $column;
	}

	public function getSearchColumn(){
		$column 	= array('namaobat' , 'satuan');

		return $column;
	}

	public function updateStok(){
		$id 	= Input::get('id');
		$stok 	= Input::get('value');

		$update = DB::table('apo_detailobat')->where('kodobat' , $id)->where('tempat' , 'apotek_askes')->
					update(
						array('stok' => $stok)
					);
	}

	public function updateHet(){
		$id 	= Input::get('id');
		$het 	= Input::get('value');

		$update = DB::table('apo_detailobat')->where('kodobat' , $id)->where('tempat' , 'apotek_askes')->
					update(
						array('het' => $het)
					);
	}
}