<?php

class GudangOpnameController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Stok Opname Gudang';
	public $table 		= 'apo_obat';
	public $slug 		= 'gudang_opname';
	public $controller 	= 'GudangOpnameController';
	public $primary 	= 'kodobat';
	public $table_trans = 'tbdetailobat';
	public $field_trans = 'IdObat';

	public $disable_add 	= true;
	public $disable_delete 	= true;
	public $disable_edit 	= true;
	public $disable_action 	= true;

	public $select 		= array('apo_obat.*' , 'apo_obat.stok as stok_op');

	public $js_include 	= "gudang/stok";

	public function getColumns(){
		$column = array();

		$column['namaobat'] 		= 'Nama Obat';
		$column['satuan'] 			= 'Satuan';
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

		$update = DB::table('apo_obat')->where('kodobat' , $id)->
					update(
						array('stok' => $stok)
					);
	}
}