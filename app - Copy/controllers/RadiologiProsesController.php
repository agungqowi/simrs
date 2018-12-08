<?php

class RadiologiProsesController  extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Dalam Proses Pemeriksaan';
	public $table 		= 'radiologi_dataperiksa';
	public $slug 		= 'radiologi_proses';
	public $controller 	= 'RadiologiProsesController ';
	public $primary 	= 'id';


	public $select 		= array('radiologi_dataperiksa.*');

	public $where 		= array(
								array('status' , '=' , '1')
							);

	public $order 		= array('id' , 'ASC');

	public $disable_edit 	= true;
	public $disable_add 	= true;

	public $custom_action 	= array(
								array( 'target' => 'radiologi/periksa/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Masukan Hasil')
							);

	public function getColumns(){
		$column = array();

		$column['tanggal'] 			= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['nama'] 			= 'Nama';
		$column['asal'] 			= 'Jenis Rawat';
		$column['kategori'] 		= 'Pemeriksaan';

		return $column;
	}
}