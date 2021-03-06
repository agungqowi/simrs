<?php

class LabController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$ruangan = Ruangan::all();
		return View::make('penunjang.general' , array('title' => 'Laboratorium' , 'slug' => 'lab'));
	}

	public function kategori($id)
	{
		$list = DB::table('lab_pemeriksaan')->where('id_kategori' , $id)->orderBy('numbering' , 'ASC')->get();
		echo json_encode($list);
	}

	public function hasil()
	{
		$lab_kategori 	= DB::table('lab_kategori')->get();
		$ruangan = Ruangan::all();
		return View::make('lab.hasil' , array('title' => 'Laboratorium' , 'slug' => 'lab' ,'lab_kategori' => $lab_kategori));
	}

	public function simpanHasil(){
		$noreg  	= Input::get('hasil_noreg');
		$nama  		= Input::get('hasil_nama');
		$norm  		= Input::get('hasil_norm');

		$tanggal  	= Input::get('hasil_tanggal');
		$jam  		= Input::get('hasil_jam');

		$kesimpulan = Input::get('kesimpulan');
		$id_pemeriksa = Input::get('pemeriksa');
		$hasil 		= Input::get('hasil');
		$catatan 	= Input::get('catatan');
		$id_lab  	= Input::get('id_lab');
		$id_dokter 			= Input::get('id_dokter');
		$dokter				= Input::get('txt_pilih_dokter');

		$cek 	= DB::table('lab_dataperiksa')->where('id' , $id_lab)->first();

		$cats 	= array();

		// Input data ke table dataperiksa terlebih dahulu sebelum ke tabel detail
		if( isset($cek->id) && !empty($cek->id) ){
			$id = $cek->id;

			$data = array('kesimpulan' => $kesimpulan , 'jam' => $jam , 'tanggal_periksa' => $tanggal);
			if( $cek->status == '0' || $cek->status == '1'){
				$data['status'] = '2';
			}
			
			if( $id_pemeriksa == 0 ){
				$pemeriksa = "";
			}	
			else{
				$pems 	= DB::table('lab_operator')->where('id',$id_pemeriksa)->first();
				if( isset($pems->Nama) ){
					$pemeriksa = $pems->Nama;
				}
				else{
					$pemeriksa = "";
				}
			}		
			$data['IdDokterLab'] = $id_dokter;
			$data['NamaDokterLab'] = $dokter;
			$data['id_pemeriksa']		= $id_pemeriksa;
			$data['pemeriksa']		= $pemeriksa;
			
			DB::table('lab_dataperiksa')->where('id',$id)->update($data);
		}
		else{

		}
		
		if( isset($hasil) && count($hasil) > 0 ){
			foreach($hasil as $key => $value){

				$cek_hasil = DB::table('lab_detailperiksa')->where('id' , $key)->first();

				if( isset($cek_hasil->id) && !empty($cek_hasil->id) ){

					$data_hasil = array( 'hasil' => $value , 'catatan' => $catatan[$key] ) ;

					DB::table('lab_detailperiksa')->where('id' , $cek_hasil->id)
					->update($data_hasil);

				}
				else{

				}
			}

		}
	}

	public function ambilData(){
		$noreg = Input::get('noreg');

		$cek 	= DB::table('lab_dataperiksa')->where('no_reg' , $noreg)->first();

		if( isset($cek->id) && $cek->id ){
			$data['status'] = 'ada';
			$data['data']	= $cek;

			echo json_encode($data);
		}
		else{
			echo json_encode( array('status' => 'nol') );
		}
	}

	public function dataPeriksa($id){
		$cek 	= DB::table('lab_dataperiksa')->where('id' , $id)->first();

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

		$cek 	= DB::table('lab_detailperiksa')->where('id_dataperiksa' , $id)->get();

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

		$data_lab 			= Input::get('lab');
		$jenis_rawat		= Input::get('jenis_rawat');
		$asal 				= Input::get('asal');
		$nama 				= Input::get('nama');
		$id_reg 			= Input::get('id_reg_jalan');

		$date 				= DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal 			= $date->format('Y-m-d');

		$return 			= array();

		$data 				= array();
		if($id_pemeriksaan == '' || $id_pemeriksaan = 0){
			$data['no_reg'] 	= $noreg;
			$data['no_rm'] 		= $norm;
			$data['jenis_rawat']= $jenis_rawat;
			$data['asal'] 		= $asal;
			$data['nama'] 		= $nama;
			$data['tanggal'] 	= $tanggal;
			$data['id_reg'] 	= $id_reg;
			$kategoris 			= array();
			$tarif 				= array();
			$kategori 			= "";
			if(count($data_lab)){
				foreach ($data_lab as $c) {
					$ka 	= DB::table('lab_pemeriksaan')->where('kode_jasa',$c)->first();
					if( isset($ka->nama_jasa) ){
						$kategoris[] 	= $ka->nama_jasa;
						$tarif[] 		= $ka->kode_tarif;
					}
				}

				$kategori 		= implode(' , ', $kategoris);
			}

			$data['kategori'] 	= $kategori;
			$id_data 			= DB::table('lab_dataperiksa')->insertGetId( $data );

			if(count($data_lab)){
				foreach ($data_lab as $d) {
					$da 	= DB::table('lab_pemeriksaan')->where('kode_jasa',$d)->first();
					if( isset($da->pemeriksaan) && $da->pemeriksaan == '1' ){
						$data_detail 	= array();
						$data_detail['id_pemeriksaan'] 	= $d;
						$data_detail['id_dataperiksa'] 	= $id_data;

						DB::table('lab_detailperiksa')->insert( $data_detail );
					}
					else{
						
						$childs 	= DB::table('lab_pemeriksaan')->where('group_jasa', $da->kode_jasa)->get();
						if( isset($childs) && count($childs) > 0){
							foreach( $childs as $ch ){
								if( $ch->pemeriksaan == '1' ){
									$data_detail 	= array();
									$data_detail['id_pemeriksaan'] 	= $ch->kode_jasa;
									$data_detail['id_dataperiksa'] 	= $id_data;

									DB::table('lab_detailperiksa')->insert( $data_detail );
								}								
							}
						}
					}
					
				}

				foreach($tarif as $ti){
					if( $jenis_rawat == 'RI' ){
						$tindakan 					= new TindakanRanap;
					}
					else
						$tindakan 					= new DetailTindakan;


					
					$tindakan->NoRM 			= $norm;
					$tindakan->JenisRawat 		= 'lab';
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
			$return['pesan'] 	= 'Permintaan lab berhasil';
		}
		else{

		}

		echo json_encode($return);
		die();
	}

	public function periksa($id){
		$data 	 	= DB::table('lab_dataperiksa')->where('id',$id)->first();
		$ruangan 	= Ruangan::all();
		if( isset($data->id) ){
			if( $data->status == '0' ){
				$update 	= DB::table('lab_dataperiksa')->where('id', $id)->update(
					array(
							'status' 	=> '1'
					)
				);
			}

			if( $data->jenis_rawat == 'APS'){
				$pasien 	= DB::table('pasien_aps')->where('id',$data->id_reg)->first();
				return View::make('penunjang.laboratorium_aps' , array(
					'id' 		=> $id ,
					'title' 	=> 'Laboratorium' ,
					'slug' 		=> 'lab' ,
					'pasien'	=> $pasien,
					'data' 		=> $data
				));
			}
			else{
				return View::make('penunjang.laboratorium' , array(
					'id' 		=> $id ,
					'title' 	=> 'Laboratorium' ,
					'slug' 		=> 'lab' ,
					'data' 		=> $data
				));
			}
			
		}
		else{

		}

	}

	public function listPeriksa($id){
		$data 	= DB::table('lab_detailperiksa')->where('id_dataperiksa', $id)->get();

		if( count($data) > 0 ){
			$return 	= array();
			foreach($data as $da){
				$detail 	 			= array();
				$d 	 					= DB::table('lab_pemeriksaan')->where('kode_jasa', $da->id_pemeriksaan)->first();
				
				if( isset($d->nama_jasa) ){
					$detail['nama_jasa'] 	= $d->nama_jasa;
					$detail['satuan'] 		= $d->unit;
				}

				$nilai_normal 			= array();
				if( isset($d->nilai_normal_pr_bayi) ){
					$nilai_normal[] 	= $d->nilai_normal_pr_bayi." (Bayi perempuan)";
					$nilai_normal[] 	= $d->nilai_normal_lk_bayi." (Bayi laki-laki)";
					$nilai_normal[] 	= $d->nilai_normal_pr_balita." (Balita perempuan)";
					$nilai_normal[] 	= $d->nilai_normal_lk_balita." (Balita laki-laki)";
					$nilai_normal[] 	= $d->nilai_normal_pr_anak." (Anak perempuan)";
					$nilai_normal[] 	= $d->nilai_normal_lk_anak." (Anak laki-laki)";
					$nilai_normal[] 	= $d->nilai_normal_pr_dewasa." (Dewasa perempuan)";
					$nilai_normal[] 	= $d->nilai_normal_lk_dewasa." (Dewasa laki-laki)";
				}
				$detail['nilai_normal'] = implode("<br />",$nilai_normal);
				if( isset($d->nilai_normal) )
					$detail['nilai_normal'] = $d->nilai_normal;
				$detail['hasil'] 		= $da->hasil;
				$detail['catatan'] 		= $da->catatan;
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

	public function cetakHasil($id){
		$data 	= DB::table('lab_dataperiksa')->where('id',$id)->first();
		$detail = DB::table('lab_detailperiksa')->where('id_dataperiksa',$id)->get();
		if(isset($data->no_rm)){
			$pasien = DB::table('tbpasien')->where('NoRM',$data->no_rm)->first();
		}
		else{
			$pasien = array();
		}

		$tes = array(
				'id' 		=> $id ,
				'detail' 	=> $detail ,
				'data' 		=> $data ,
				'pasien'	=> $pasien
			);

		//print_r($tes); exit;
		
		return View::make('lab.cetak_hasil' , $tes);
	}

	/**
	 * @param void
	 * @return array
	 */
	public function tambah_dokter()
	{
		$check_dokter = DetailDokter::where('IDDokter' , '=' , Input::get('id_dokter'))->where('NoReg','=',Input::get('noreg'))->count();
		if($check_dokter > 0){

		}
		else{
			$dokter 		= Dokter::where('IdDokter' , '=' , Input::get('id_dokter'))->get();
			$namadokter 	= "";
			foreach ($dokter as $d) {
				$namadokter = $d->NamaDokter;
			}

			$biaya_konsul	= 0;
			$pasien_jalan = DB::table('tbpasienjalan')->where('IdRegJalan' , Input::get('noreg'))->first();
			if( isset($pasien_jalan->IdPoli)){
				$poli 	= DB::table('tbpoli')->where('IdPoli' , $pasien_jalan->IdPoli)->first();
				$dokter = DB::table('tbdaftardokter')->where('IdDokter' ,Input::get('id_dokter'))->first();
				$pasien_masuk 	= DB::table('tbmasukrs')->where('NoReg' , $pasien_jalan->NoRegJalan)->first();
				if(isset($poli->NamaPoli)){
					$nama_poli 	= $poli->NamaPoli;

					$tipe_poli 	= $poli->TipePoli;

					if( $tipe_poli == '3' ){
						if(isset($dokter->Spesialisasi)){
							//jika dokter umum
							if($dokter->Spesialisasi == 0 || $dokter->Spesialisasi == 1){
								$jams 	= explode(':' , $pasien_masuk->JamMasuk );
								$jam 	= intval($jams[0]);
								if( $jam < 8 || $jam >= 15 ){
									$luar_jam = 1;
								}
								else{
									$luar_jam = 0;
								}

								$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
												->where('Spesialisasi' , 1)->where('LuarJam',Input::get('jam_kerja'))->first();

								if(isset($konsul->Tarif)){
									$biaya_konsul 	= $konsul->Tarif;
								}
							}
							else{
								$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
												->where('Spesialisasi' , 2)->first();

								if(isset($konsul->Tarif)){
									$biaya_konsul 	= $konsul->Tarif;
								}
								
							}
						}
					}
					else if($tipe_poli == 1){

					}
					else{
						$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
												->where('Spesialisasi' , 2)->first();

						if(isset($konsul->Tarif)){
							$biaya_konsul 	= $konsul->Tarif;
						}
					}
				}
			}
				
			/*
			$detail_dokter = new DetailDokter;
			$detail_dokter->IDDokter = Input::get('id_dokter');
			$detail_dokter->NoReg = Input::get('noreg');
			$detail_dokter->Nama = Input::get('nama');
			$detail_dokter->NoRM = Input::get('norm');
			$detail_dokter->Kategori = Input::get('kategori');

			

			$detail_dokter->save();
			*/
			DB::table('tbpasienjalan')->where('IdRegJalan' , Input::get('noreg'))->update(
				array(
						'IdDokter' 		=> Input::get('id_dokter') ,
						'Dokter' 		=> $namadokter ,
						'BiayaKonsul'	=> $biaya_konsul ,
						'LuarJam'		=> Input::get('jam_kerja')
				)
			);
		}

	}

	/**
	 * @param void
	 * @return array
	 */
	public function hapusDokter()
	{
		$no_reg = Input::get('noreg');
		$id_dokter =  Input::get('id_dokter');
		DB::table('tbdetaildokter')->where('NoReg', '=', $no_reg)->where('IDDokter', '=', $id_dokter)->delete();
	}

	public function listDokter($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbdetaildokter')->leftJoin('tbspesialis','tbdetaildokter.Spesialisasi' ,'=' , 'tbspesialis.id')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function tambahPemeriksaan(){
		$id_lab 	= Input::get('id_lab');
		$id_detail	= Input::get('id_detail');

		if( !empty($id_detail) ){
			$cek_lab 	= DB::table('lab_dataperiksa')->where('id',$id_lab)->first();

			if( isset($cek_lab->id) ){
				$cek_periksa 	= DB::table('lab_detailperiksa')->where('id_pemeriksaan',$id_detail)
									->where('id_dataperiksa',$id_lab)->first();
				if( isset($cek_periksa) && isset($cek_periksa->id) ){
					$status 	= 'ada';
				}
				else{
					$status 	= 'berhasil';
					$data 		= array();
					$data['id_pemeriksaan']		= $id_detail;
					$data['id_dataperiksa']		= $id_lab;

					$insert 	= DB::table('lab_detailperiksa')->insert( $data );
				}
				
			}
			else{
				$status 	= 'Data pemeriksaan tidak ditemukan';
			}
		}
		else{
			$status 	= 'Data lab tidak ditemukan';
		}

		$return		= array('status' => $status);
		echo json_encode($return);
	}

	function hapusPeriksa(){
		$id 	= Input::get('id');
		$id_lab	= Input::get('id_lab');

		$hapus 	= DB::table('lab_detailperiksa')->where('id',$id)->where('id_dataperiksa',$id_lab)->delete();

		if( $hapus ){
			$status 	= 'berhasil';
		}
		else{
			$status 	= $hapus;
		}

		$return		= array('status' => $status);
		echo json_encode($return);
	}
}