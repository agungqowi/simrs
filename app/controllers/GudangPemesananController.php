<?php

class GudangPemesananController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Surat Pesanan';
	public $table 		= 'apo_pemesanan';
	public $slug 		= 'gudang_pemesanan';
	public $controller 	= 'GudangPemesananController';
	public $primary 	= 'id';
	public $table_trans = 'apo_pemesanan_detail';
	public $field_trans = 'id_pemesanan';

	public $order 		= array('id' , 'DESC');


	public function getColumns(){
		$column = array();

		$column['no_pemesanan'] 	= 'No Pemesanan';
		$column['tanggal_pemesanan']= 'Tanggal Pemesanan';
		$column['namasupp'] 		= 'Nama Supplier';
		$column['detail_pemesanan'] = 'Daftar Barang';

		return $column;
	}

	public function create()
	{
		$this->pref = "apo_";
		$jenis_obat = DB::table($this->pref.'jenisobat')->get();
		$supplier = DB::table($this->pref.'supplier')->get();
		return View::make('gudang.pemesanan' , array(
			'jenis_obat' 	=> $jenis_obat , 
			'supplier' 		=> $supplier,
			'pref' 			=> $this->pref,
			'title' 		=> $this->title,
			'slug' 			=> $this->slug,
			'id_pemesanan'	=> 0
		));
	}

	public function tambah_transaksi()
	{
		$no_surat 			= Input::get('no_surat');
		$tanggal_pemesanan 	= DateTime::createFromFormat('d/m/Y', Input::get('tanggal_pemesanan'));
		$kode_supplier 		= Input::get('kode_supplier');
		$nama_supplier 		= Input::get('nama_supplier');
		$kode_obat 			= Input::get('kode_obat');
		$nama_obat 			= Input::get('nama_obat');
		$satuan 			= Input::get('satuan');
		$id_satuan_beli 	= Input::get('satuan_beli');
		$jumlah 			= Input::get('jumlah');
		$id_pemesanan 		= Input::get('id_pemesanan');
		$id_transaksi 		= Input::get('id_transaksi');
		$satuan_beli 		= "";
		$perbandingan 		= 1;

		$return = $id_pemesanan;

		$satuans 			= DB::table('apo_satuan')->where('id',$id_satuan_beli)->first();
		if(isset($satuans->NamaSatuan)){
			$satuan_beli 	= $satuans->NamaSatuan;
			$perbandingan 	= $satuans->QtyPerbandingan;
		}


		if( $id_pemesanan == 0 ){
			$return 	= DB::table('apo_pemesanan')->insertGetId(
							array(
								'no_pemesanan' 		=> $no_surat,
								'tanggal_pemesanan' => $tanggal_pemesanan,
								'kodesupp' 			=> $kode_supplier,
								'namasupp' 			=> $nama_supplier
							)
				);

			if( !empty($kode_obat) && ($jumlah != 0 && $jumlah != '') ){
				$insert 	= DB::table('apo_pemesanan_detail')->insertGetId(
							array(
								'id_pemesanan' 	=> $return ,
								'kodobat' 	=> $kode_obat ,
								'namaobat' 	=> $nama_obat ,
								'satuan' 	=> $satuan ,
								'id_satuan_beli' 	=> $id_satuan_beli ,
								'satuan_beli'		=> $satuan_beli ,
								'perbandingan' 		=> $perbandingan ,
								'jumlah' 	=> $jumlah,
								'sisa' 	=> $jumlah
							)
				);
			}
			

			$pesan 		= "Berhasil menambahkan pemesanan";
		}
		else{
			$up 	= DB::table('apo_pemesanan')->where('id' , $id_pemesanan)->update(
							array(
								'no_pemesanan' 		=> $no_surat,
								'tanggal_pemesanan' => $tanggal_pemesanan,
								'kodesupp' 			=> $kode_supplier,
								'namasupp' 			=> $nama_supplier
							)
			);

			$pesan 		= "Berhasil mengubah data pemesanan";
			if( $id_transaksi == 0 ){
				if( !empty($kode_obat) && ($jumlah != 0 && $jumlah != '') ){
					$insert 	= DB::table('apo_pemesanan_detail')->insertGetId(
								array(
									'id_pemesanan' 	=> $return ,
									'kodobat' 	=> $kode_obat ,
									'namaobat' 	=> $nama_obat ,
									'satuan' 	=> $satuan ,									
									'id_satuan_beli' 	=> $id_satuan_beli ,
									'satuan_beli'		=> $satuan_beli ,
									'perbandingan' 		=> $perbandingan ,
									'jumlah' 	=> $jumlah	,
									'sisa' 	=> $jumlah						
								)
					);
					$pesan 		= "Berhasil menambahkan pemesanan";
				}

				
			}
			else{
				if( !empty($kode_obat) && ($jumlah != 0 && $jumlah != '') ){
					$data = array(
									'id_pemesanan' 	=> $return ,
									'kodobat' 	=> $kode_obat ,
									'namaobat' 	=> $nama_obat ,
									'satuan' 	=> $satuan ,
									'id_satuan_beli' 	=> $id_satuan_beli ,
									'satuan_beli'		=> $satuan_beli ,
									'perbandingan' 		=> $perbandingan ,
									'jumlah' 	=> $jumlah	,
									'sisa' 	=> $jumlah								
							);
				}

				$update 	= DB::table('apo_pemesanan_detail')->where('id_detail' , $id_transaksi)->update($data);

				$pesan 		= "Berhasil mengubah pemesanan";
			}
		}

		$list 		= DB::table('apo_pemesanan_detail')->where('id_pemesanan' , $return)->get();
		$barangs 	= array();
		foreach($list as $l){
			$barangs[] 	= $l->namaobat." (".$l->jumlah.")";
		}

		$barang 	= implode("<br />",$barangs);

		DB::table('apo_pemesanan')->where('id' , $return)->update( array('detail_pemesanan' => $barang));

		$json_return 	= json_encode( array('pesan' => 'sukses' ,'id_pemesanan' => $return) );
		echo $json_return;
	}

	public function list_transaksi()
	{	
		$id_pemesanan 	= Input::get('id_pemesanan');
		$data = DB::table('apo_pemesanan_detail')
				->select('*')
				->where('id_pemesanan','=' ,$id_pemesanan)->get();
		return $data;
	}

	public function edit($id=0)
	{
		$this->pref = "apo_";
		$jenis_obat = DB::table($this->pref.'jenisobat')->get();
		$supplier = DB::table($this->pref.'supplier')->get();
		return View::make('gudang.pemesanan' , array(
			'jenis_obat' 	=> $jenis_obat , 
			'supplier' 		=> $supplier,
			'pref' 			=> $this->pref,
			'title' 		=> $this->title,
			'slug' 			=> $this->slug,
			'id_pemesanan'	=> $id
		));
	}

	public function detail()
	{
		$id 	= Input::get('id');
		$data 	= DB::table('apo_pemesanan')->where('id',$id)->first();
		echo json_encode($data);
	}

	public function hapus_transaksi(){
		$id 	= Input::get('id_transaksi');
		$data 	= DB::table('apo_pemesanan_detail')->where('id_detail',$id)->delete();
		echo json_encode($data);

	}
}