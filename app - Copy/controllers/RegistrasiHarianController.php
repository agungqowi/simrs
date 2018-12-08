<?php

class RegistrasiHarianController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Registrasi Harian';
	public $table 		= 'tbpasienjalan';
	public $slug 		= 'registrasi_harian';
	public $controller 	= 'RegistrasiHarianController';
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
		$column['Poli'] 		= 'Poli';
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

	public function destroy($id)
	{
		$detail = DB::table('tbpasienjalan')->where('IdRegJalan' , $id)->first();
		if( isset($detail->IdRegJalan) ){
			$tanggal 	= date('Y-m-d');
			if($detail->Tanggal == $tanggal && $detail->StatusBayar == 0){
				DB::table('tbpasienjalan')->where('IdRegJalan' , $id)->delete();
				return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' berhasil dihapus');
			}
			else{
				return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' tidak diizinkan untuk dihapus');
			}
		}
		else{
			return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' tidak ditemukan');
		}
	}

	public function rawatInap(){
		$title 			= 'Registrasi Harian Rawat Inap';
		$datatable_url 	= URL::to('registrasi_harian/rawat_inap_table');
		$column 		= $this->rawatInapColumns();

		$filters 		= array( 
										'dari_tanggal' => 'tbpasieninap.Tanggal',
										'sampai_tanggal' => 'tbpasieninap.Tanggal'
						);

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'registrasi_harian/rawat_inap_table' ,
			'disable_action' 	=> false
		) );
	}

	public function rawatInapTable(){
		$table 			= 'tbpasieninap';
		$primary 		= 'IdInap';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'rawat_inap/pasien/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
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
										'dari_tanggal' => 'tbpasieninap.Tanggal',
										'sampai_tanggal' => 'tbpasieninap.Tanggal'
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

		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		if( isset($group->ruangan) && !empty($group->ruangan) && $group->ruangan != null){
			$ruangan 		= json_decode($group->ruangan);
			if( !empty($ruangan)){
				$whereins 		= array(
									array('tbpasieninap.IdRuangan' , $ruangan)
							);
				$param['whereins'] 	= $whereins;
			}
			

			
		}

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

	public function igd(){
		$title 			= 'Registrasi Harian IGD';
		$datatable_url 	= URL::to('registrasi_harian/igd_table');
		$column 		= $this->igdColumns();

		$filters 		= array( 
										'dari_tanggal' => 'tbpasieninap.Tanggal',
										'sampai_tanggal' => 'tbpasieninap.Tanggal'
						);

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'registrasi_harian/rawat_inap_table' ,
			'disable_action' 	=> false
		) );
	}

	public function igdTable(){
		$table 			= 'tbpasienugd';
		$primary 		= 'NoRegUGD';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'ugd/pasien/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
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
										'dari_tanggal' => 'tbpasienugd.Tanggal',
										'sampai_tanggal' => 'tbpasienugd.Tanggal'
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

	public function igdColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'KotaKab';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['Jam'] 			= 'Jam';
		$column['CaraBayar'] 	= 'Cara Bayar';
		$column['StatusPulang'] = array(
										'title' => 'Status' , 
										'type'	=> 'select' ,
										'value' => array('0'=>'Dirawat' ,'1' => 'Pulang' , '2' => 'Rujuk ke Poli')
								);

		return $column;
	}
}