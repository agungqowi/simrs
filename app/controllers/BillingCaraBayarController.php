<?php

class BillingCaraBayarController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Cara Bayar (Pasien Rawat Jalan)';
	public $table 		= 'tbpasienjalan';
	public $slug 		= 'billing_carabayar';
	public $controller 	= 'BillingCaraBayarController';
	public $primary 	= 'IdRegJalan';

	public $order 		= array('IdRegJalan' , 'DESC');

	public $join 		= array(
							array('tbpasien' , 'tbpasienjalan.NoRM' , 'tbpasien.NoRM')
						);

	public $where 		= array(
							array('StatusBayar' ,'=' , '0')
						);

	public $select 		= array('tbpasienjalan.*' , 'tbpasien.Nama');

	public $custom_action 	= array(
							array( 'icon' => 'splashy-box_edit' , 'target' => 'billing_carabayar/rawat_jalan/{primary}' ,
								'alt' => 'Ubah cara bayar')
						);

	public $disable_add 	= true;
	public $disable_edit 	= true;
	public $disable_delete	= true;

	public function getColumns(){
		$column = array();

		$column['NoRM'] 	 		= 'No RM';
		$column['Nama'] 			= 'Nama';
		$column['Tanggal'] 		 	= array('title'=>'Tanggal Masuk' , 'type' => 'date');
		$column['Poli'] 			= 'Poli';
		$column['CaraBayar'] 		= 'Cara Bayar';

		return $column;
	}

	public function getSearchColumn(){
		$column 	= array('tbpasienjalan.NoRM' , 'Nama');

		return $column;
	}

	public function rawatJalan($id=''){
		$data = DB::table('tbpasienjalan')->join('tbpasien' ,'tbpasien.NoRM' , '=' , 'tbpasienjalan.NoRM')
				->where('tbpasienjalan.IdRegJalan' , $id)
				->first();
		return View::make('billing.cara_bayar.rawat_jalan' , array(
			'data' 	=> $data
		));
	}

	public function postRawatJalan(){
		$noreg 			= Input::get('no_reg');
		$cara_bayar		= Input::get('cara_bayar');
		$cara_bayar2 	= Input::get('cara_bayar2');

		DB::table('tbpasienjalan')->where('IdRegJalan' , $noreg)->update( array('CaraBayar' => $cara_bayar2) );

		$pasienjalan 	=	DB::table('tbpasienjalan')->where('IdRegJalan',$noreg)->first();

		$norm 			= $nama = $poli = "";

		if(isset($pasienjalan->NoRM)){
			$norm 	= $pasienjalan->NoRM;
			
			$pasien = DB::table('tbpasien')->where('NoRM' , $norm)->first();

			if(isset($pasien->Nama)){
				$nama 	= $pasien->Nama;
			}
		}

		if(isset($pasienjalan->Poli)){
			$poli 	= $pasienjalan->Poli;
		}

		


		$insert 	= array(
								'NoReg' 	=> $noreg ,
								'NoRM'		=> $norm ,
								'Nama'		=> $nama ,
								'JenisRawat'=> 'Poli '.$poli ,
								'CaraBayarAsal' 	=> $cara_bayar ,
								'CaraBayarSekarang' => $cara_bayar2 ,
								'TanggalUbah'		=> date('Y-m-d h:i:s')
		);

		DB::table('bill_carabayar')->insert($insert);
	}

	public function igd(){
		$title 			= 'Cara Bayar (IGD)';
		$datatable_url 	= URL::to('billing_carabayar/igd_datatable');
		$column 		= $this->igdColumns();

		$filters 		= array();

		$this->disable_action = false;

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'disable_action' 	=> $this->disable_action,
			'slug'				=> 'billing_carabayar/igd_datatable'
		) );
	}

	public function igdDatatable(){
		$table 			= 'tbpasienugd';
		$primary 		= 'NoRegUGD';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'billing_carabayar/igd/{primary}', 'icon' => 'splashy-box_edit' , 
										'alt' => 'Ubah Cara Bayar')
							);

		$join 			= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasienugd.NoRM' )
						);
		$select 		= array( 	'tbpasien.*', 
									'tbpasienugd.CaraBayar' , 
									'tbpasienugd.NoRegUGD' ,'tbpasienugd.Tanggal' ,
									'tbpasienugd.Jam' , 'tbpasienugd.StatusPulang'  );

		$columns 		= $this->igdColumns();

		$order 			= array('Tanggal' ,'DESC');

		$filters 		= array( 
						);

		$wheres 		= array( array('StatusBayar' , '-' , '0') );

		$param					= array();
		$param['table']			= $table;
		$param['joins']			= $join;
		$param['select']		= $select;
		$param['primary']		= $primary;
		$param['order']			= $order;
		$param['wheres']		= $wheres;
		$param['columns']		= $columns;
		$param['leftjoin']		= $leftjoin;
		$param['filters']		= $filters;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function igdColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'KotaKab';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['Jam'] 			= 'Jam';
		$column['CaraBayar'] 	= 'Cara Bayar';

		return $column;
	}

	public function igdDetail($id=''){
		$data = DB::table('tbpasienugd')->join('tbpasien' ,'tbpasien.NoRM' , '=' , 'tbpasienugd.NoRM')
				->where('tbpasienugd.NoRegUGD' , $id)
				->first();
		return View::make('billing.cara_bayar.igd' , array(
			'data' 	=> $data
		));
	}

	public function postIgd(){
		$noreg 			= Input::get('no_reg');
		$cara_bayar		= Input::get('cara_bayar');
		$cara_bayar2 	= Input::get('cara_bayar2');

		DB::table('tbpasienugd')->where('NoRegUGD' , $noreg)->update( array('CaraBayar' => $cara_bayar2) );

		$pasien2 	=	DB::table('tbpasienugd')->where('NoRegUGD',$noreg)->first();

		$norm 			= $nama = $jenis = "";

		if(isset($pasien2->NoRM)){
			$norm 	= $pasien2->NoRM;
			
			$pasien = DB::table('tbpasien')->where('NoRM' , $norm)->first();

			if(isset($pasien->Nama)){
				$nama 	= $pasien->Nama;
			}
		}
		
		$jenis 		= "IGD";


		$insert 	= array(
								'NoReg' 			=> $noreg ,
								'NoRM'				=> $norm ,
								'Nama'				=> $nama ,
								'JenisRawat' 		=> $jenis ,
								'CaraBayarAsal' 	=> $cara_bayar ,
								'CaraBayarSekarang' => $cara_bayar2 ,
								'TanggalUbah'		=> date('Y-m-d h:i:s')
		);

		DB::table('bill_carabayar')->insert($insert);
	}

	public function rawatInap(){
		$title 			= 'Cara Bayar (Rawat Inap)';
		$datatable_url 	= URL::to('billing_carabayar/rawat_inap_datatable');
		$column 		= $this->rawatInapColumns();

		$filters 		= array( 
						);

		$this->disable_action = false;

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'disable_action' 	=> $this->disable_action,
			'slug'				=> 'billing_carabayar/rawat_inap_datatable'
		) );
	}

	public function rawatInapTable(){
		$table 			= 'tbpasieninap';
		$primary 		= 'IdInap';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'billing_carabayar/rawat_inap/{primary}', 'icon' => 'splashy-box_edit' , 
										'alt' => 'Ubah Cara Bayar')
							);

		$join 			= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasieninap.NoRM' )
						);
		$select 		= array( 	'tbpasien.*' , 'tbpasieninap.Ruangan' ,'tbpasieninap.Kelas' , 
									'tbpasieninap.CaraBayar' , 
									'tbpasieninap.IdInap' ,'tbpasieninap.Tanggal' ,
									'tbpasieninap.Jam' , 'tbpasieninap.StatusPulang'  );

		$columns 		= $this->rawatInapColumns();

		$order 			= array('Tanggal' ,'DESC');

		$filters 		= array( 
						);

		$wheres 		= array( array('StatusBayar' , '-' , '0') );

		$param					= array();
		$param['table']			= $table;
		$param['joins']			= $join;
		$param['select']		= $select;
		$param['primary']		= $primary;
		$param['order']			= $order;
		$param['wheres']		= $wheres;
		$param['columns']		= $columns;
		$param['leftjoin']		= $leftjoin;
		$param['filters']		= $filters;
		$param['search'] 		= array('tbpasieninap.NoRM','Nama');

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function rawatInapColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'KotaKab';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['Jam'] 			= 'Jam';
		$column['Ruangan'] 		= 'Ruangan';
		$column['Kelas'] 		= 'Kelas';
		$column['CaraBayar'] 	= 'Cara Bayar';
		$column['StatusPulang'] = array(
										'title' => 'Status' , 
										'type'	=> 'select' ,
										'value' => array('0'=>'Diruangan' ,'1' => 'Pulang' , '2' => 'Pindah')
								);

		return $column;
	}

	public function rawatInapDetail($id=''){
		$data = DB::table('tbpasieninap')->join('tbpasien' ,'tbpasien.NoRM' , '=' , 'tbpasieninap.NoRM')
				->where('tbpasieninap.IdInap' , $id)
				->first();
		if(isset($data->NoRM)){
			return View::make('billing.cara_bayar.rawat_inap' , array(
				'data' 	=> $data
			));
		}
		else{
			//die('data tidak ditemukan');
		}
		
	}

	public function postRawatInap(){
		$noreg 			= Input::get('no_reg');
		$cara_bayar		= Input::get('cara_bayar');
		$cara_bayar2 	= Input::get('cara_bayar2');

		DB::table('tbpasieninap')->where('NoReg' , $noreg)->update( array('CaraBayar' => $cara_bayar2) );

		$pasien2 	=	DB::table('tbpasieninap')->where('NoReg',$noreg)->first();

		$norm 			= $nama = $jenis = "";

		if(isset($pasien2->NoRM)){
			$norm 	= $pasien2->NoRM;
			
			$pasien = DB::table('tbpasien')->where('NoRM' , $norm)->first();

			if(isset($pasien->Nama)){
				$nama 	= $pasien->Nama;
			}
		}
		
		if(isset($pasien2->Ruangan)){
			$jenis 		= $pasien2->Ruangan;
		}


		$insert 	= array(
								'NoReg' 	=> $noreg ,
								'NoRM'		=> $norm ,
								'Nama'		=> $nama ,
								'JenisRawat'=> "Ruangan ".$jenis ,
								'CaraBayarAsal' 	=> $cara_bayar ,
								'CaraBayarSekarang' => $cara_bayar2 ,
								'TanggalUbah'		=> date('Y-m-d h:i:s')
		);

		DB::table('bill_carabayar')->insert($insert);
	}


	public function riwayat(){
		$title 			= 'Riwayat Cara Bayar';
		$datatable_url 	= URL::to('billing_carabayar/riwayat_datatable');
		$column 		= $this->riwayatColumns();

		$filters 		= array();

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'billing_carabayar/riwayat_datatable'
		) );
	}

	public function riwayatDatatable(){
		$table 			= 'bill_carabayar';
		$primary 		= 'id';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;
		$this->disable_action 	= true;

		$join 			= null;

		$select 		= array( '*' );

		$columns 		= $this->riwayatColumns();

		$order 			= array('TanggalUbah' ,'DESC');

		$filters 		= array( 
						);

		$param					= array();
		$param['table']			= $table;
		$param['joins']			= $join;
		$param['select']		= $select;
		$param['primary']		= $primary;
		$param['order']			= $order;
		$param['wheres']		= $wheres;
		$param['columns']		= $columns;
		$param['leftjoin']		= $leftjoin;
		$param['filters']		= $filters;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function riwayatColumns(){
		$column = array();

		$column['NoRM'] 				= 'No RM';
		$column['Nama'] 				= 'Nama';
		$column['JenisRawat'] 			= 'Jenis Rawat';
		$column['CaraBayarAsal']		= 'Cara Bayar Sebelumnya';
		$column['CaraBayarSekarang']	= 'Cara Bayar Sekarang';
		$column['TanggalUbah'] 			= array( 'title' => 'Tanggal Sistem' , 'type' => 'datetime' );

		return $column;
	}
}