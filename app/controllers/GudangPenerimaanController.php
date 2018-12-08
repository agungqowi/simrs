<?php

class GudangPenerimaanController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Penerimaan Barang';
	public $table 		= 'apo_penerimaan';
	public $slug 		= 'gudang_penerimaan';
	public $controller 	= 'GudangPenerimaanController';
	public $primary 	= 'id';

	public $disable_add  	= true;
	public $disable_edit 	= true;
	public $disable_delete 	= true; 


	public function getColumns(){
		$column = array();

		$column['TanggalPenerimaan'] 	= array('title'=>'Tanggal Penerimaan','type'=>'date');
		$column['NoPemesanan'] 			= 'No PO';
		$column['BarangTerima'] 		= 'Daftar Barang Datang';

		return $column;
	}

	public function belum(){
		$title 			= 'Barang belum datang';
		$datatable_url 	= URL::to('gudang_penerimaan/belum_table');
		$column 		= $this->belumColumns();

		$filters 		= array( );

		return View::make('crud.custom_list', array(
			'title' 			=> $title,
			'column' 			=> $column,
			'filter' 			=> $filters,
			'datatable_url' 	=> $datatable_url,
			'slug'				=> 'gudang_penerimaan/belum' ,
			'disable_action' 	=> false
		) );
	}

	public function belumTable(){
		$table 			= 'apo_pemesanan';
		$primary 		= 'id';
		$leftjoin 		= $order = $wheres = $filters = null;

		$this->primary 			= $primary;

		$this->disable_edit 	= true;
		$this->disable_delete 	= true;

		$this->custom_action 	= array(
								array( 'target' => 'gudang_penerimaan/belum/{primary}', 'icon' => 'splashy-document_a4_okay' , 
										'alt' => 'Proses Terima')
							);
		

		$join 			= array(
						);
		$select 		= array( 	'*'  );

		$columns 		= $this->belumColumns();

		$order 			= array('id' ,'DESC');

		$filters 		= array( );
		$wheres 		= array( array('status' ,'=' , 0) );

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

	public function belumColumns(){
		$column = array();

		$column['no_pemesanan']  		= 'No Pemesanan';
		$column['tanggal_pemesanan'] 	= array( 'title' => 'Tanggal Pemesanan' , 'type' => 'date' );
		$column['namasupp'] 			= 'Nama Supplier';
		$column['detail_pemesanan'] 	= 'Barang';

		return $column;
	}

	public function belumForm($id=0){
		$data 		= DB::table('apo_pemesanan')->where('id' , $id)->first();

		if(isset($data->id)){
			$detail 	= DB::table('apo_pemesanan_detail')->where('id_pemesanan' , $id)->get();

			return View::make('gudang.penerimaan' , array(
				'data' 			=> $data , 
				'detail' 		=> $detail ,
				'id_pemesanan' 	=> $id
 			));
		}
		else{
			die('Data tidak ditemukan');
		}
	}

	public function simpanForm($id=0){
		$tanggal_terima 	= DateTime::createFromFormat('d/m/Y', Input::get('tanggal_terima'));

		$masuk 				= Input::get('masuk');

		$status 			= 1;
		$barangs			= array();
		$barang 			= "";
		$no_pemesanan 		= "";
		foreach($masuk as $m => $s){
			$data 	= DB::table('apo_pemesanan_detail')->where('id_detail' , $m)
					->where('id_pemesanan',$id)->first();
			if(isset($data->id_detail)){
				$jumlah_terima 	= intval($data->jumlah_terima) + intval($s) ;
				$sisa 			= intval($data->sisa) - $jumlah_terima;
				if($sisa >= 0){
					$update 		= DB::table('apo_pemesanan_detail')->where('id_detail',$m)->update(
								array(
									'jumlah_terima' => $jumlah_terima ,
									'sisa' 			=> $sisa
								)
					);

					$barangs[]		= $data->namaobat.' ('.$s.')';

					if($sisa > 0){
						$status = 2;
					}

					$data2 		= DB::table('apo_pemesanan')->where('id' , $id)->first();
					if(isset($data2->no_pemesanan))
						$no_pemesanan = $data2->no_pemesanan;

					//Update stok

					$total_terima 	= intval($s) * intval($data->perbandingan);
					$obat 			= DB::table('apo_obat')->where('kodobat' , $data->kodobat)->first();
					if(isset($obat->kodobat)){
						$stok 			= intval($obat->stok) + intval($total_terima);
						$update_stok 	= DB::table('apo_obat')->where('kodobat' , $data->kodobat)->
											update( array('stok' => $stok ));
					}
					
				}
				
			}
		}

		$barang 		= implode("<br />",$barangs);

		$insert 		= DB::table('apo_penerimaan')->insert(
									array(
										'TanggalPenerimaan' => $tanggal_terima ,
										'IdPemesanan' 		=> $id ,
										'NoPemesanan' 		=> $no_pemesanan ,
										'BarangTerima'		=> $barang ,
										'status'			=> $status
									)
		);

		$update2 		= DB::table('apo_pemesanan')->where('id' , $id)->update( array('status' => $status) );

		return Redirect::to('gudang_penerimaan')->with('success', 'Penerimaan berhasil dan Stok obat berhasil ditambahkan');
	}
}