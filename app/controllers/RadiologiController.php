<?php

class RadiologiController extends \BaseController {

	public function index(){
		$jenis 	= DB::table('radiologi_pemeriksaan')->get();
		return View::make('penunjang.radiologi' , array('title' => 'Radiologi' , 'slug' => 'radiologi' , 'jenis' => $jenis));
	}

	public function simpanHasil(){
		$noreg 	= Input::get('hasil_noreg');
		$nama 	= Input::get('hasil_nama');
		$norm 	= Input::get('hasil_norm');
		$tipe 	= Input::get('hasil_tipe');

		$tanggal = Input::get('hasil_tanggal');
		$jam = Input::get('hasil_jam');

		$keterangan 		= Input::get('keterangan');
		$hasil 				= Input::get('hasil');
		$periksa 			= Input::get('periksa');
		$kesimpulan 		= Input::get('kesimpulan');
		$id_dokter 			= Input::get('id_dokter');
		$dokter				= Input::get('txt_pilih_dokter');

		$cek 	= DB::table('radiologi_dataperiksa')->where('no_reg' , $noreg)->first();

		$cats 	= array();

		// Input data ke table dataperiksa terlebih dahulu sebelum ke tabel detail
		if( isset($cek->id) && !empty($cek->id) ){
			$id = $cek->id;

			$data = array('keterangan' => $keterangan , 'jam' => $jam , 
				'kesimpulan' => $kesimpulan ,
				'IdDokterRad' => $id_dokter ,
				'NamaDokterRad'	=> $dokter,
				'tanggal_periksa' => $tanggal ,'asal' => $tipe);

			if( $cek->status == '0' || $cek->status == '1'){
				$data['status'] = '2';
			}
			
			DB::table('radiologi_dataperiksa')->where('id',$id)->update($data);

			
		}
		else{

		}
		
		if( isset($hasil) && count($hasil) > 0 ){
			foreach($hasil as $key => $value){

				$cek_hasil = DB::table('radiologi_detailperiksa')->where('id_dataperiksa' , $id)->where('id_pemeriksaan' , $periksa[$key])->first();

				if( isset($cek_hasil->id) && !empty($cek_hasil->id) ){

					$data_hasil = array( 'hasil' => $value ) ;

					DB::table('radiologi_detailperiksa')->where('id' , $cek_hasil->id)
					->update($data_hasil);

				}
			}
		}
	}

	public function ambilData(){
		$noreg = Input::get('noreg');

		$cek 	= DB::table('radiologi_dataperiksa')->where('no_reg' , $noreg)->first();

		if( isset($cek->id) && $cek->id ){
			$data['status'] = 'ada';
			$data['data']	= $cek;

			echo json_encode($data);
		}
		else{
			echo json_encode( array('status' => 'nol') );
		}
	}

	public function ambilDetail(){
		$id = Input::get('id');

		$cek 	= DB::table('radiologi_detailperiksa')->where('id_dataperiksa' , $id)->get();

		if( isset($cek) && count($cek) > 0 ){
			$data['status'] = 'ada';
			$data['data']	= $cek;

			echo json_encode($data);
		}
		else{
			echo json_encode( array('status' => 'nol') );
		}
	}

	public function kirimPermintaan(){
		$noreg 				= Input::get('noreg');
		$norm 				= Input::get('norm');
		$id_pemeriksaan 	= Input::get('id_pemeriksaan');

		$data_rad 			= Input::get('rad');
		$asal 				= Input::get('asal');
		$jenis_rawat		= Input::get('jenis_rawat');
		$nama 				= Input::get('nama');

		$date 				= DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal 			= $date->format('Y-m-d');

		$return 			= array();

		$data 				= array();
		if($id_pemeriksaan == '' || $id_pemeriksaan = 0){
			$data['no_reg'] 	= $noreg;
			$data['no_rm'] 		= $norm;
			$data['asal'] 		= $asal;
			$data['nama'] 		= $nama;
			$data['jenis_rawat']= $jenis_rawat;
			$data['tanggal'] 	= $tanggal;
			$kategoris 			= array();
			$tarif 				= array();
			$kategori 			= "";
			if(count($data_rad)){
				foreach ($data_rad as $c) {
					$ka 	= DB::table('radiologi_pemeriksaan')->where('kd_rad',$c)->first();
					if( isset($ka->nama_rad) ){
						$kategoris[] = $ka->nama_rad;
						$tarif[] 		= $ka->kode_tarif;
					}
				}

				$kategori 		= implode(' , ', $kategoris);
			}

			$data['kategori'] 	= $kategori;
			$id_data 			= DB::table('radiologi_dataperiksa')->insertGetId( $data );

			if(count($data_rad)){
				foreach ($data_rad as $d) {
					$data_detail 	= array();
					$data_detail['id_pemeriksaan'] 	= $d;
					$data_detail['id_dataperiksa'] 	= $id_data;

					DB::table('radiologi_detailperiksa')->insert( $data_detail );
				}

				foreach($tarif as $ti){
					if( $jenis_rawat == 'RI' ){
						$tindakan 					= new TindakanRanap;
					}
					else
						$tindakan 					= new DetailTindakan;


					
					$tindakan->NoRM 			= $norm;
					$tindakan->JenisRawat 		= 'radiologi';
					$tindakan->TanggalMasuk 	= $tanggal;
					$tindakan->TanggalTindak 	= $tanggal;
					$tindakan->IdTindakan 		= $ti;
					$tindakan->NoReg 			= $noreg;

					$id_tindak = $ti;
					$t = DB::table('tbtindakan')->leftjoin('tbkategoritindakan' , 'tbkategoritindakan.ID' , '=' ,'tbtindakan.IdKategoriTindakan')
					->where('IdTindakan',$id_tindak)->first();
					if(isset($t->Tarif)){
						$tarif = $t->Tarif;
						$adm = $t->Adm;
						$fas = $t->Fas;
						$bek = $t->Bek;
						$IdKategoriTindakan = $t->IdKategoriTindakan;
						$gol = $t->nama;
						$tindakan->Tindakan 	= $t->Tindakan;
					}
					else{
						$tarif = 0;
						$adm = 0;
						$fas = 0;
						$IdKategoriTindakan = "";
						$gol = "";
						$bek 	= "";
						$tindakan->Tindakan 	= "";
					}

					$id_dokter 	= 0;
					$id_perawat = 0;

					if( $id_dokter == 0 || $id_dokter == "" ){
						$nama_dokter 	= "";
					}
					else{
						$dokter 	= DB::table('tbdaftardokter')->where('IdDokter' , $id_dokter)->first();
						if( isset($dokter->NamaDokter) ){
							$nama_dokter 	= $dokter->NamaDokter;
						}
					}

					if( $id_perawat == 0 || $id_perawat == "" ){
						$nama_perawat 	= "";
					}
					else{
						$perawat 	= DB::table('tbparamedis')->where('Id' , $id_perawat)->first();
						if( isset($perawat->NamaParamedis) ){
							$nama_perawat 	= $perawat->NamaParamedis;
						}
					}

					$tindakan->HargaSatuan 	= $tarif;
					$tindakan->Adm 			= $adm;
					$tindakan->Fas 			= $fas;
					$tindakan->Bek 			= $bek;
					$tindakan->Gol 			= $gol;
					$tindakan->IdDokter 			= $id_dokter;
					$tindakan->NamaDokter 			= $nama_dokter;
					$tindakan->IdPerawat 			= $id_perawat;
					$tindakan->Namaperawat 			= $nama_perawat;

					$qty 					= 1;
					if( $qty < 1 ){
						$qty 	= 1;
					}

					$tindakan->Qty  		= $qty;

					$total 					= $qty * intval( $tarif );
					$tindakan->Tarif 		= $total;

					if( $total == 0 || $tindakan->Tindakan == '' ){

					}
					else{
						$tindakan->save();
					}
					
				}
			}

			$return['status'] 	= 'success';
			$return['pesan'] 	= 'Permintaan radiologi rontgen berhasil';
		}
		else{

		}

		echo json_encode($return);
		die();
	}

	public function periksa($id){
		$data 	 	= DB::table('radiologi_dataperiksa')->where('id',$id)->first();
		$ruangan 	= Ruangan::all();
		if( isset($data->id) ){
			if( $data->status == '0' ){
				$update 	= DB::table('radiologi_dataperiksa')->where('id', $id)->update(
					array(
							'status' 	=> '1'
					)
				);
			}

			if( $data->jenis_rawat == 'APS' ){
				$pasien 		= DB::table('pasien_aps')->where('id' , $data->id_reg)->first();
				return View::make('penunjang.radiologi_aps' , array(
					'id' 		=> $id ,
					'title' 	=> 'Radiologi' ,
					'slug' 		=> 'radiologi' ,
					'pasien'	=> $pasien ,
					'data' 		=> $data
				));
			}
			else{
				return View::make('penunjang.radiologi' , array(
					'id' 		=> $id ,
					'title' 	=> 'Radiologi' ,
					'slug' 		=> 'radiologi' ,
					'data' 		=> $data
				));
			}
			
		}
		else{

		}

	}

	public function listPeriksa($id){
		$data 	= DB::table('radiologi_detailperiksa')->where('id_dataperiksa', $id)->get();

		if( count($data) > 0 ){
			$return 	= array();
			foreach($data as $da){
				$detail 	 			= array();
				$d 	 					= DB::table('radiologi_pemeriksaan')->where('kd_rad', $da->id_pemeriksaan)->first();
				
				if( isset($d->nama_rad) ){
					$detail['nama_rad'] 	= $d->nama_rad;
				}
				$detail['hasil'] 		= $da->hasil;
				$detail['id'] 			= $da->id;
				$detail['id_pemeriksaan'] 	= $da->id_pemeriksaan;

				$return[] 				= $detail;
			}
		}
		else{
			$return = false;
		}

		echo json_encode($return);
		die();
	}

	public function dataPeriksa($id){
		$cek 	= DB::table('radiologi_dataperiksa')->where('id' , $id)->first();

		if( isset($cek->id) && $cek->id ){
			$data['status'] = 'ada';
			$data['data']	= $cek;

			echo json_encode($data);
		}
		else{
			echo json_encode( array('status' => 'nol') );
		}
	}

	public function cetakHasil($id){
		$data 	= DB::table('radiologi_dataperiksa')->where('id',$id)->first();
		$detail = DB::table('radiologi_detailperiksa')->where('id_dataperiksa',$id)->get();
		if(isset($data->no_rm)){
			$pasien = DB::table('tbpasien')->where('NoRM',$data->no_rm)->first();
		}
		else{
			$pasien = array();
		}
		
		return View::make('radiologi.cetak_hasil' , array(
				'id' 		=> $id ,
				'detail' 	=> $detail ,
				'data' 		=> $data ,
				'pasien'	=> $pasien
			));
	}
}