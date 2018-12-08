<?php

class VKController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'VK';
	public $table 		= 'tbpasienjalan';
	public $slug 		= 'vk';
	public $controller 	= 'VKController';
	public $primary 	= 'IdRegJalan';

	public $select 		= array( 	'tbpasien.*' , 'tbpasienjalan.Poli' ,'tbpasienjalan.Dokter' , 'tbpasienjalan.CaraBayar' , 
									'tbpasienjalan.IdRegJalan' , 'tbpasienjalan.NoRegJalan' ,'tbpasienjalan.Tanggal' ,
									'tbpasienjalan.jam_daftar' , 'tbpasienjalan.status as status_jalan'  );

	public $join 	= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasienjalan.NoRM' ) ,						 
								array( 'tbpoli' , 'tbpoli.IdPoli' , 'tbpasienjalan.IdPoli' )
						);

	public $custom_action 	= array(
								array( 'target' => 'rawat_jalan/pasien/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
							);

	public $where 	= array(
								array( 'tbpoli.TipePoli' , '=' , '4')
							);


	public $disable_add 	= true;
	public $disable_delete 	= false;
	public $disable_edit 	= true;

	public $filter 			= array( 
										'dari_tanggal' 	=> 'tbpasienjalan.Tanggal',
										'sampai_tanggal' => 'tbpasienjalan.Tanggal',
										'poli' => 'tbpasienjalan.IdPoli', 
										'dokter' => 'tbpasienjalan.IdDokter');

	public function getColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'KotaKab';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['jam_daftar'] 	= 'Jam';
		$column['Dokter'] 		= 'Dokter';
		$column['CaraBayar'] 	= 'Cara Bayar';
		$column['status_jalan'] 		= array(
										'title' => 'Status' , 
										'type'	=> 'select' ,
										'value' => array('0'=>'Menunggu' ,'1' => 'Diperiksa','2' => 'Selesai')
								);

		return $column;
	}

	public function getSearchColumn(){
		$column = array('tbpasien.NoRM','Nama','Jalan' );
		return $column;
	}

}