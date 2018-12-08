<?php

class AkunStatementController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Detail Statement Account';
	public $table 		= 'akun_transaksi';
	public $slug 		= 'akun_statement';
	public $controller 	= 'AkunStatementController';
	public $primary 	= 'id';
	public $table_trans = 'akun_transaksi';
	public $field_trans = 'id_akun';

	public function getColumns(){
		$column = array();

		$column['trans_date'] 	= 'Tanggal Transaksi';
		$column['kode_akun'] 	= 'Kode Akun';
		$column['nama_akun'] 	= 'Nama Akun';
		$column['deskripsi'] 	= 'Deskripsi';
		$column['reff'] 		= 'Reff';
		$column['trans_tipe'] 	= 'D/K';
		$column['jumlah'] 		= 'Jumlah';
		$column['saldo'] 		= 'Saldo';

		return $column;
	}

	public function index()
	{	
		$mulai = date('Y-m-d');
		if( isset($_GET['mulai']) )
			$mulai = $_GET['mulai'];

		$sampai = date('Y-m-d');
		if( isset($_GET['sampai']) )
			$tanggal = $_GET['sampai'];

		$kode_akun = "";
		if( isset($_GET['kode_akun']) )
			$kode_akun = $_GET['kode_akun'];

		$data 		= $this->getTableDataComplex( $this->table , array(), array( 
						array('trans_date' ,'<=' , $sampai) ,
						array('trans_date' ,'>=' , $mulai),
						array('id_rekening' ,'=' , $kode_akun),
			) , array('trans_date' => 'ASC') );
		$column 	= $this->getColumns();
		$akun 		= DB::table('akun_rekening')->get();
		return View::make('akuntansi.statement', 
			array(
				'data' 		=> $data , 
				'akun' 		=> $akun , 
				'kode_akun' => $kode_akun , 
				'column' 	=> $column ,
				'mulai'		=> $mulai ,
				'sampai'		=> $sampai ,
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