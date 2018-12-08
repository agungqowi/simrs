<?php

class PembayaranController extends \BaseController {

	public $slug 		= 'pembayaran';
	public function rjBelum(){
		$title 			= 'Daftar Pasien Rawat Jalan (Belum bayar)';
		$datatable_url 	= URL::to('pembayaran/rj_belum_table');
		$column 		= $this->rjBelumColumns();

		$filters 		= array( );

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'pembayaran/rj_belum_table' ,
			'disable_action' 	=> false
		) );
	}

	public function rjBelumTable(){
		$table 			= 'tbpasienjalan';
		$primary 		= 'NoRegJalan';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'pembayaran/detail_rj/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
							);		

		$join 			= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasienjalan.NoRM' )
						);
		$select 		= array( 	'tbpasien.*' , 'tbpasienjalan.Poli' , 
									'tbpasienjalan.CaraBayar' , 'tbpasienjalan.Tanggal' , 
									'tbpasienjalan.IdRegJalan' ,'tbpasienjalan.NoRegJalan' );

		$columns 		= $this->rjBelumColumns();

		$order 			= array('Tanggal' ,'DESC');

		$filters 		= array( );

		$wheres 		= array(
							array( 'tbpasienjalan.StatusBayar' ,'=' ,'0' ) ,
							array( 'tbpasienjalan.CaraBayar' , '=' , 'Umum')
						);

		$column 				= array('tbpasien.NoRM','tbpasien.Nama','tbpasienjalan.Poli');
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
		$param['search']		= $column;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function rjBelumColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'Alamat';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['Poli'] 		= 'Poli';
		$column['CaraBayar'] 	= 'Cara Bayar';

		return $column;
	}

	public function detailRj($id=0){
		$data 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $id)->first();

		if( isset($data->NoRegJalan) ){
			$pasien = DB::table('tbpasien')->where('NoRM' , $data->NoRM)->first();

			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $id)->get();
			$admin = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' , 'admin')
						->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' ,'!=' , 'admin')
						->get();
			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $id)->first();
			if( isset($penjualan->id) ){
				$obat 			= DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
				$id_penjualan 	= $penjualan->id;
			}
			else{
				$obat 			= DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
				$id_penjualan	= 0;
			}
			
			//var_dump($registrasi);
			return View::make('billing.pembayaran.rawat_jalan' , 
				array(
					'registrasi'	=> $data , 
					'pasien' 		=> $pasien , 
					'dokter' 		=> $dokter ,
					'obat' 			=> $obat ,
					'tindakan' 		=> $tindakan,
					'admin' 		=> $admin,
					'id_penjualan'	=> $id_penjualan ,
					'cetak_obat' 	=> Input::get('cetak_obat')
				)
			);
		}
		else{
			return View::make('404');
		}
	}

	public function prosesRj(){
		$id_reg 	= Input::get('id_reg');
		$total 		= Input::get('total');
		$pembayaran = Input::get('pembayaran');
		$admin 		= Input::get('admin');
		$konsul 	= Input::get('konsul');
		$tindakan	= Input::get('tindakan');
		$obat		= Input::get('obat');
		$total_obat	= Input::get('total_obat');

		if( $total > $pembayaran ){
			echo 'gagal';
		}
		else{
				$kode_billing 	= DB::table('bill_pembayaran')->insert(
					array(
						'NoReg'			=> $id_reg ,
						'Total'			=> $total,
						'Pembayaran'	=> $pembayaran ,
						'Admin'			=> json_encode($admin) ,
						'Konsul'		=> json_encode($konsul) ,
						'Tindakan'		=> json_encode($tindakan)

					)
				);

				if(count($admin) > 0){
					foreach($admin as $a){
						DB::table('tbdetailtindakan')->where('IdDetailTindak' , $a)->update(
							array( 
									'StatusBayar' 	=> '1' ,
									'KodeBilling'	=> $kode_billing
							)
						);
					}
				}

				if(count($tindakan) > 0){
					foreach($tindakan as $a){
						DB::table('tbdetailtindakan')->where('IdDetailTindak' , $a)->update(
							array( 
									'StatusBayar' 	=> '1' ,
									'KodeBilling'	=> $kode_billing
							)
						);
					}
				}
				
				if(count($konsul) > 0){
					foreach($konsul as $k){
						DB::table('tbpasienjalan')->where('IdRegJalan' , $k)->update(
							array( 
									'PembayaranKonsul' 	=> 2 ,
									'KodeBillingKonsul'	=> $kode_billing
							)
						);
					}
				}

				if(count($obat) > 0){
					$ob 	= 0;
					foreach($obat as $o){
						if( $o != '0' ){
							DB::table('apo_penjualan_detail')->where('id' , $o)->update(
								array( 
										'StatusBayarDetail' 	=> '1' ,
										'KodeBillingDetail'		=> $kode_billing
								)
							);
							$ob++;
						}
						
					}

					if( $ob > 0 ){
						$check 	= DB::table('apo_penjualan')->where('NoReg' , $id_reg)->get();
						if( count($check) > 0 ){
							foreach($check as $c){
								$flag_obat 	= 0;
								$sudah 	= DB::table('apo_penjualan_detail')
									->where('id_penjualan' , $c->id)
									->where('StatusBayarDetail' , '1')
									->get();


								$belum 	= DB::table('apo_penjualan_detail')
									->where('id_penjualan' ,$c->id)
									->where('StatusBayarDetail' , '0')
									->get();

								if( count($sudah) > 0 && count($belum) > 0 ){
									$up_obat 	= DB::table('apo_penjualan')->where('id' , $c->id)->update(
										array( 'StatusBayar' => 2 )
									);
								}
								else if(count($sudah) > 0){
									$up_obat 	= DB::table('apo_penjualan')->where('id' , $c->id)->update(
										array( 'StatusBayar' => 1 )
									);
								}
								else{
									$up_obat 	= DB::table('apo_penjualan')->where('id' , $c->id)->update(
										array( 'StatusBayar' => 0 )
									);
								}
							}
						}
					}
				}
		

			$check	= DB::table('tbpasienjalan')->where('NoRegJalan' , $id_reg)->where('StatusBayar' , '0')->get();

			if( count($check) > 0 ){
				foreach($check as $c){
					$check_tindakan = DB::table('tbdetailtindakan')->where('IdReg' , $c->IdRegJalan)
									->where('StatusBayar' , '0')->get();

					if( count($check_tindakan) < 1 ){
						$pembayaran 	= $c->Total;
						$update = DB::table('tbpasienjalan')->where('IdRegJalan' , $c->IdRegJalan)->update(
							array(
									'Pembayaran' 	=> $pembayaran ,
									'StatusBayar'	=> '1'
							)
						);

					}
					else{

					}

				}
			}
			
			echo 'sukses';
		}

		die();
	}

	public function riBelum(){
		$title 			= 'Pembayaran Rawat Inap';
		$datatable_url 	= URL::to('pembayaran/ri_belum_table');
		$column 		= $this->rawatInapColumns();

		$filters 		= array( 
						);

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'pembayaran/ri_belum_table' ,
			'disable_action' 	=> false
		) );
	}

	public function riBelumTable(){
		$table 			= 'tbpasieninap';
		$primary 		= 'NoReg';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'pembayaran/detail_ri/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
							);		

		$join 			= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasieninap.NoRM' )
						);
		$select 		= array( 	'tbpasien.*' , 'tbpasieninap.Ruangan' ,'tbpasieninap.Kelas' , 
									'tbpasieninap.CaraBayar' , 'tbpasieninap.NoReg' ,
									'tbpasieninap.IdInap' ,'tbpasieninap.Tanggal' ,
									'tbpasieninap.Jam' , 'tbpasieninap.StatusPulang'  );

		$columns 		= $this->rawatInapColumns();

		$order 			= array('Tanggal' ,'DESC');

		$filters 		= array( 
						);

		$wheres 		= array(
							array( 'tbpasieninap.StatusBayar' ,'=' ,'0' ) ,
							array( 'tbpasieninap.CaraBayar' , '=' , 'Umum')
						);

		$column 				= array('tbpasien.NoRM','tbpasien.Nama','tbpasieninap.Ruangan');
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
		$param['search']		= $column;

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

	public function detailRi($no_reg)
	{
		$registrasi = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->first();
		$inap = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->get();
		$keluar = DB::table('tbkeluar')->where('NoReg' , $no_reg)->get();
		$out = DB::table('tbkeluar')->where('NoReg' , $no_reg)->orderBy('TanggalKeluar','desc')->first();
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbtindakanranap')->where('NoReg' , $no_reg)->where('Tipe' ,'!=' , 'admin')
					->orderBy('GOL')->get();
		if( isset($registrasi->NoRegJalan) ){
			$tindakanjalan 	= DB::table('tbdetailtindakan')->where('NoReg' , $registrasi->NoRegJalan)->get();
			$obatjalan		= DB::table('apo_penjualan')->where('NoReg', $registrasi->NoRegJalan)->get();
		}
		else{
			$tindakanjalan	= array();
			$obatjalan		= array();
		}
		$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->get();
		//var_dump($registrasi);
		if($registrasi){
			return View::make('billing.pembayaran.rawat_inap' , 
				array(
					'registrasi' 		=> $registrasi , 
					'inap' 				=> $inap , 
					'keluar' 			=> $keluar , 
					'dokter' 			=> $dokter ,
					'penjualan' 		=> $penjualan ,
					'out'				=> $out,
					'tindakan_jalan'	=> $tindakanjalan,
					'obatjalan'			=> $obatjalan,
					'tindakan' 			=> $tindakan,
					'cetak_obat' 		=> 'semua'
				)
			);
		}
		else{
			echo 'Informasi pasien tidak ditemukan';
		}
	}

	public function prosesRi(){
		$id_reg 		= Input::get('id_reg');
		$total 			= Input::get('total');
		$pembayaran 	= Input::get('pembayaran');

		if( $total > $pembayaran ){
			echo 'gagal';
		}
		else{
			$kode_billing 	= DB::table('bill_pembayaran')->insert(
					array(
						'NoReg'			=> $id_reg ,
						'Total'			=> $total,
						'Pembayaran'	=> $pembayaran

					)
				);

			$update = DB::table('tbpasieninap')->where('NoReg' , $id_reg)->update(
				array(
						'Total' 		=> $total ,
						'Pembayaran' 	=> $pembayaran ,
						'StatusBayar'	=> '1'
				)
			);

			echo 'sukses';
		}

		die();
	}


	public function rjSudah(){
		$title 			= 'Daftar Pasien Rawat Jalan (Sudah bayar)';
		$datatable_url 	= URL::to('pembayaran/rj_sudah_table');
		$column 		= $this->rjSudahColumns();

		$filters 		= array( );

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'pembayaran/rj_sudah-table' ,
			'disable_action' 	=> false
		) );
	}

	public function rjSudahTable(){
		$table 			= 'tbpasienjalan';
		$primary 		= 'NoRegJalan';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		
		$this->custom_action 	= array(
								array( 'target' => 'pembayaran/detail_rj/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
							);		


		$join 			= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasienjalan.NoRM' )
						);
		$select 		= array( 	'tbpasien.*' , 'tbpasienjalan.Poli' , 
									'tbpasienjalan.CaraBayar' , 'tbpasienjalan.Tanggal' , 
									'tbpasienjalan.IdRegJalan' ,'tbpasienjalan.NoRegJalan' );

		$columns 		= $this->rjBelumColumns();

		$order 			= array('Tanggal' ,'DESC');

		$filters 		= array( );

		$wheres 		= array(
							array( 'tbpasienjalan.StatusBayar' ,'!=' ,'0' ) ,
							array( 'tbpasienjalan.CaraBayar' , '=' , 'Umum')
						);

		$column 				= array('tbpasien.NoRM','tbpasien.Nama','tbpasienjalan.Poli');
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
		$param['search']		= $column;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function rjSudahColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'Alamat';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['Poli'] 		= 'Poli';
		$column['CaraBayar'] 	= 'Cara Bayar';

		return $column;
	}

	public function flagObat(){
		$check 	= DB::table('tbpasienjalan')->where('StatusBayar' , '1')->get();

		if( count($check) > 0 ){
			foreach( $check as $c ){
				$obat 	= DB::table('apo_penjualan')->where('NoReg' , $c->NoRegJalan)->get();
				if( count( $obat ) > 0 ){
					foreach( $obat as $o ){
						$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $c->NoRegJalan)->update(
							array( 'StatusBayar' => '1')
						);

						$obat_detail 	= DB::table('apo_penjualan_detail')->where('id_penjualan' , $o->id)->update(
							array( 'StatusBayarDetail' => '1')
						);
					}
				}

				

				
			}
		}
	}

	public function apsBelum(){
		$title 			= 'Pasien APS Obat (Belum bayar)';
		$datatable_url 	= URL::to('pembayaran/aps_belum_table');
		$column 		= $this->apsBelumColumns();

		$filters 		= array( );

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'pembayaran/aps_belum_table' ,
			'disable_action' 	=> false
		) );
	}

	public function apsBelumTable(){
		$table 			= 'apo_penjualan';
		$primary 		= 'id';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'pembayaran/detail_obat/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
							);		

		$join 			= array();
		$select 		= array('*');

		$columns 		= $this->apsBelumColumns();

		$order 			= array('tanggal_input' ,'DESC');

		$filters 		= array( );

		$wheres 		= array(
							array( 'NoRM' 			,'=' ,'000000' ),
							array( 'StatusBayar' 	,'=' ,'0' ),
						);

		$column 				= array('Nama','tanggal_input');
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
		$param['search']		= $column;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function apsBelumColumns(){
		$column = array();

		$column['tanggal_input']= array( 'title' => 'Tanggal' , 'type' => 'datetime' );
		$column['Nama'] 		= 'Nama';
		$column['CaraBayar'] 	= 'Penjamin';
		$column['subtotal'] 	= 'Subtotal';
		$column['ujr'] 			= 'UJR';
		$column['total'] 		= 'Total';

		return $column;
	}

	public function detailObat($id){
		$penjualan 	= DB::table('apo_penjualan')->where('id' , $id)->first();
		if( isset($penjualan->id) ){
			$obat 			= DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
			$id_penjualan 	= $penjualan->id;
			return View::make('billing.pembayaran.obat_aps' , 
				array(
					'obat'				=> $obat,
					'penjualan'			=> $penjualan,
					'id_penjualan'		=> $penjualan->id,
					'cetak_obat' 		=> 'semua'
				)
			);
		}
		else{
			return View::make('404');
		}
	}

	public function prosesObat(){
		$id_reg 		= Input::get('id_reg');
		$total 			= Input::get('total');
		$pembayaran 	= Input::get('pembayaran');

		if( $total > $pembayaran ){
			echo 'gagal';
		}
		else{
			$kode_billing 	= DB::table('bill_pembayaran')->insert(
					array(
						'NoReg'			=> $id_reg ,
						'Total'			=> $total,
						'Pembayaran'	=> $pembayaran

					)
				);

			$update = DB::table('apo_penjualan')->where('id' , $id_reg)->update(
				array(
						'total' 		=> $total ,
						'total_input' 	=> $pembayaran ,
						'StatusBayar'	=> '1'
				)
			);

			$update = DB::table('apo_penjualan_detail')->where('id_penjualan' , $id_reg)->update(
				array(
						'KodeBillingDetail' 	=> $kode_billing ,
						'StatusBayarDetail'		=> '1'
				)
			);

			echo 'sukses';
		}

		die();
	}

	public function vkBelum(){
		$title 			= 'Daftar Pasien VK (Belum bayar)';
		$datatable_url 	= URL::to('pembayaran/vk_table');
		$column 		= $this->vkBelumColumns();

		$filters 		= array( );

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'pembayaran/vk_table' ,
			'disable_action' 	=> false
		) );
	}

	public function vkBelumTable(){
		$table 			= 'tbpasienjalan';
		$primary 		= 'NoRegJalan';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'pembayaran/detail_vk/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
								);		

		$join 			= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasienjalan.NoRM' ),
								array( 'tbpoli' , 'tbpoli.IdPoli' , 'tbpasienjalan.IdPoli' )
						);
		$select 		= array( 	'tbpasien.*' , 'tbpasienjalan.Poli' , 
									'tbpasienjalan.CaraBayar' , 'tbpasienjalan.Tanggal' , 
									'tbpasienjalan.IdRegJalan' ,'tbpasienjalan.NoRegJalan' );

		$columns 		= $this->vkBelumColumns();

		$order 			= array('Tanggal' ,'DESC');

		$filters 		= array( );

		$wheres 		= array(
							array( 'tbpasienjalan.StatusBayar' ,'=' ,'0' ) ,
							array( 'tbpoli.TipePoli' ,'=' ,'4' )
						);

		$column 				= array('tbpasien.NoRM','tbpasien.Nama','tbpasienjalan.Poli');
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
		$param['search']		= $column;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function vkBelumColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'Alamat';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['Poli'] 		= 'Poli';
		$column['CaraBayar'] 	= 'Cara Bayar';

		return $column;
	}

	public function detailVK($id){
		$data 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $id)->first();

		if( isset($data->NoRegJalan) ){
			$pasien = DB::table('tbpasien')->where('NoRM' , $data->NoRM)->first();

			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $id)->get();
			$admin = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' , 'admin')
						->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' ,'!=' , 'admin')
						->get();
			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $id)->get();
			
			//var_dump($registrasi);
			return View::make('billing.pembayaran.vk' , 
				array(
					'registrasi'	=> $data , 
					'pasien' 		=> $pasien , 
					'dokter' 		=> $dokter ,
					'penjualan' 	=> $penjualan ,
					'tindakan' 		=> $tindakan,
					'admin' 		=> $admin,
					'cetak_obat' 	=> Input::get('cetak_obat')
				)
			);
		}
		else{
			return View::make('404');
		}
	}

	public function vkPrint($id){
		$data 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $id)->first();

		if( isset($data->NoRegJalan) ){
			$pasien = DB::table('tbpasien')->where('NoRM' , $data->NoRM)->first();

			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $id)->get();
			$admin = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' , 'admin')
						->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' ,'!=' , 'admin')
						->get();
			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $id)->get();
			
			//var_dump($registrasi);
			return View::make('billing.vk_print' , 
				array(
					'registrasi'	=> $data , 
					'pasien' 		=> $pasien , 
					'dokter' 		=> $dokter ,
					'penjualan' 	=> $penjualan ,
					'tindakan' 		=> $tindakan,
					'admin' 		=> $admin,
					'cetak_obat' 	=> Input::get('cetak_obat')
				)
			);
		}
		else{
			return View::make('404');
		}
	}

	public function penunjangBelum(){
		$title 			= 'Pasien APS Penunjang';
		$datatable_url 	= URL::to('pembayaran/penunjang_belum_table');
		$column 		= $this->penunjangBelumColumns();

		$filters 		= array( );

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'pembayaran/penunjang_belum_table' ,
			'disable_action' 	=> false
		) );
	}

	public function penunjangBelumTable(){
		$table 			= 'pasien_aps';
		$primary 		= 'id';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 
										'target' => 'pembayaran/detail_penunjang/{primary}', 
										'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
								);		

		$join 			= array();
		$select 		= array('*');

		$columns 		= $this->penunjangBelumColumns();

		$order 			= array('TglMasuk' ,'DESC');

		$filters 		= array( );

		$wheres 		= array(
							array( 'StatusBayar' ,'=' ,'0' ) 
						);

		$column 				= array('Nama');
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
		$param['search']		= $column;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function penunjangBelumColumns(){
		$column = array();

		$column['Nama'] 		= 'Nama';
		$column['Alamat'] 		= 'Alamat';
		$column['TglMasuk'] 	= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['NamaPenunjang'] 		= 'Penunjang';
		$column['CaraBayar'] 	= 'Cara Bayar';

		return $column;
	}

	public function detailPenunjang($id){
		$pasien 	= DB::table('pasien_aps')->where('id' , $id)->first();
		$tindakan 	= array();

		if( isset($pasien->id) ){
			$check 	= DB::table('penunjang_data')->where('id' , $pasien->IdPenunjang)->first();
			if( isset($check->NamaTable) ){
				$data 	= DB::table($check->NamaTable)->where('id_reg' , $pasien->id)
						->where('jenis_rawat' ,'APS')->first();

				if( isset($data->id) ){
					$tindakan 	= DB::table('tbtindakanaps')->where('NoReg' , $data->id)->get();
				}

				//print_r($check);
				//print_r($pasien);
				//die();
			}

			return View::make('billing.pembayaran.penunjang' , 
				array(
					'registrasi'	=> $data , 
					'tindakan' 		=> $tindakan,
					'pasien' 		=> $pasien,
					'cetak_obat' 	=> Input::get('cetak_obat')
				)
			);
		}
		else{
			return View::make('404');
		}
	}

	public function prosesPenunjang(){
		$id_reg 	= Input::get('id_reg');
		$id_pasien 	= Input::get('id_pasien');
		$total 		= Input::get('total');
		$pembayaran = Input::get('pembayaran');
		$tindakan	= Input::get('tindakan');

		if( $total > $pembayaran ){
			echo 'gagal';
		}
		else{
				$kode_billing 	= DB::table('bill_pembayaran')->insert(
					array(
						'NoReg'			=> $id_reg ,
						'Total'			=> $total,
						'Pembayaran'	=> $pembayaran ,
						'Tindakan'		=> json_encode($tindakan)

					)
				);


			$tindakan 	= DB::table('tbtindakanaps')->where('NoReg' , $id_reg)->get();
			
			$total 		= 0;
			if( count($tindakan) > 0 ){
				foreach($tindakan as $a){
					DB::table('tbtindakanaps')->where('IdDetailTindak' , $a->IdTindakan)->update(
						array( 
										'StatusBayar' 	=> '1' ,
										'KodeBilling'	=> $kode_billing
							)
					);
					$total 	= $total + floatval($a->Tarif);
				}

					
			}
			
			$pasien 	= DB::table('pasien_aps')->where( 'id' , $id_pasien )->update(
				array(
					'StatusBayar'	=> '1' ,
					'Total'			=> $total
				)
			);
			echo 'sukses';
		}

		die();
	}

	public function penunjangPrint($id,$mode){
		$pasien 	= DB::table('pasien_aps')->where('id' , $id)->first();
		$tindakan 	= array();
		if( isset($pasien->id) ){
			$check 	= DB::table('penunjang_data')->where('id' , $pasien->IdPenunjang)->first();
			if( isset($check->NamaTable) ){
				$data 	= DB::table($check->NamaTable)->where('id_reg' , $pasien->id)
						->where('jenis_rawat' ,'APS')->first();

				if( isset($data->id) ){
					$tindakan 	= DB::table('tbtindakanaps')->where('NoReg' , $data->id)->get();
				}
			}

			return View::make('billing.penunjang_print' , 
				array(
					'registrasi'	=> $data , 
					'tindakan' 		=> $tindakan,
					'pasien' 		=> $pasien,
					'cetak_obat' 	=> Input::get('cetak_obat')
				)
			);
		}
		else{
			return View::make('404');
		}
	}


	/* ============== OK =================== */

	public function okBelum(){
		$title 			= 'Daftar Pasien OK (Belum bayar)';
		$datatable_url 	= URL::to('pembayaran/ok_table');
		$column 		= $this->okBelumColumns();

		$filters 		= array( );

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'pembayaran/ok_table' ,
			'disable_action' 	=> false
		) );
	}

	public function okBelumTable(){
		$table 			= 'tbpasienjalan';
		$primary 		= 'NoRegJalan';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'pembayaran/detail_ok/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
								);		

		$join 			= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasienjalan.NoRM' ),
								array( 'tbpoli' , 'tbpoli.IdPoli' , 'tbpasienjalan.IdPoli' )
						);
		$select 		= array( 	'tbpasien.*' , 'tbpasienjalan.Poli' , 
									'tbpasienjalan.CaraBayar' , 'tbpasienjalan.Tanggal' , 
									'tbpasienjalan.IdRegJalan' ,'tbpasienjalan.NoRegJalan' );

		$columns 		= $this->okBelumColumns();

		$order 			= array('Tanggal' ,'DESC');

		$filters 		= array( );

		$wheres 		= array(
							array( 'tbpasienjalan.StatusBayar' ,'=' ,'0' ) ,
							array( 'tbpoli.TipePoli' ,'=' ,'5' )
						);

		$column 				= array('tbpasien.NoRM','tbpasien.Nama','tbpasienjalan.Poli');
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
		$param['search']		= $column;

		$datatable 			= $this->getDatatable($param);
		return $datatable;
	}

	public function okBelumColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'Alamat';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['Poli'] 		= 'Poli';
		$column['CaraBayar'] 	= 'Cara Bayar';

		return $column;
	}

	public function detailOK($id){
		$data 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $id)->first();

		if( isset($data->NoRegJalan) ){
			$pasien = DB::table('tbpasien')->where('NoRM' , $data->NoRM)->first();

			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $id)->get();
			$admin = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' , 'admin')
						->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' ,'!=' , 'admin')
						->get();
			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $id)->get();
			
			//var_dump($registrasi);
			return View::make('billing.pembayaran.ok' , 
				array(
					'registrasi'	=> $data , 
					'pasien' 		=> $pasien , 
					'dokter' 		=> $dokter ,
					'penjualan' 	=> $penjualan ,
					'tindakan' 		=> $tindakan,
					'admin' 		=> $admin,
					'cetak_obat' 	=> Input::get('cetak_obat')
				)
			);
		}
		else{
			return View::make('404');
		}
	}

	public function okPrint($id){
		$data 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $id)->first();

		if( isset($data->NoRegJalan) ){
			$pasien = DB::table('tbpasien')->where('NoRM' , $data->NoRM)->first();

			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $id)->get();
			$admin = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' , 'admin')
						->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $id)->where('Tipe' ,'!=' , 'admin')
						->get();
			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $id)->get();
			
			//var_dump($registrasi);
			return View::make('billing.ok_print' , 
				array(
					'registrasi'	=> $data , 
					'pasien' 		=> $pasien , 
					'dokter' 		=> $dokter ,
					'penjualan' 	=> $penjualan ,
					'tindakan' 		=> $tindakan,
					'admin' 		=> $admin,
					'cetak_obat' 	=> Input::get('cetak_obat')
				)
			);
		}
		else{
			return View::make('404');
		}
	}
}