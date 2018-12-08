<?php

class AkunMutasiController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Mutasi';
	public $table 		= 'akun_transaksi';
	public $slug 		= 'akun_transaksi';
	public $controller 	= 'AkunMutasiController';
	public $primary 	= 'id';
	public $table_trans = 'akun_transaksi';
	public $field_trans = 'id_akun';

	public function getColumns(){
		$column = array();

		$column['kode_akun'] 	= 'Kode Akun';
		$column['nama_akun'] 	= 'Nama Akun';
		$column['deskripsi'] 	= 'Deskripsi';
		$column['reff'] 		= 'Reff';
		$column['trans_tipe'] 	= 'D/K';
		$column['jumlah'] 		= 'jumlah';
		$column['trans_date'] 	= 'Tanggal Transaksi';

		return $column;
	}

	public function index()
	{	
		$tanggal = date('Y-m-d');
		if( isset($_GET['tanggal']) )
			$tanggal = $_GET['tanggal'];
		$data 		= $this->getTableData( $this->table , array(), array( 'trans_date' => $tanggal ) );
		$column 	= $this->getColumns();
		return View::make('akuntansi.mutasi', 
			array(
				'data' 		=> $data , 
				'column' 	=> $column ,
				'tanggal'	=> $tanggal ,
				'title'		=> $this->title,
				'slug'		=> $this->slug,
				'controller'=> $this->controller,
				'edit'		=> true,
				'delete' 	=> true,
				'add'		=> true
			)
		);
	}
}