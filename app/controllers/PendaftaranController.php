<?php

class PendaftaranController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	function getReg($no_reg){
		$reg 	= DB::table('tbpasienjalan')->where('IdRegJalan' , $no_reg)->first();

		if( isset($reg->NoRegJalan)){
			$tanggals 		= explode('-' , $reg->Tanggal);
			$reg->Tanggal 	= $tanggals[2].'/'.$tanggals[1].'/'.$tanggals[0];


			$tanggals		= explode('-' , $reg->TanggalRujukan);
			if( count($tanggals) > 1 ){
				$reg->TanggalRujukan 	= $tanggals[2].'/'.$tanggals[1].'/'.$tanggals[0];
			}
			else{
				$reg->TanggalRujukan 	= '00/00/0000';
			}
			
			$return 		= array('status' => 'success' , 'data' => $reg);
			
		}
		else{
			$return = array('status' => 'fail');
		}

		echo json_encode($return);
	}

	function aps(){
		$poli 	= DB::table('tbpoli')->where('TipePoli' ,'3')->get();
		return View::make('pendaftaran.aps' , array('poli' => $poli) );
	}

	function doAps(){
		$pasien 			= array();
		$pasien['Nama']		= strtoupper( Input::get('txt_nama') );
		$pasien['JenKel'] 	= Input::get('cmb_jenkel');
		$pasien['Alamat'] 	= Input::get('txt_alamat');
		$txt_tanggal 	= Input::get('txt_tanggal_lahir');
		$alamat 	= Input::get('txt_alamat');

		if( empty($txt_tanggal) ){
			$tgl_lahir = '1970-01-01';
		}
		else{
			$tgls 		= explode('/', Input::get('txt_tanggal_lahir'));
			if( isset($tgls[2]) ){
				$tgl_lahir 	= $tgls[2].'-'.$tgls[1].'-'.$tgls[0];
			}
			else{
				$tgl_lahir = '1970-01-01';
			}
		}

		$pasien['TanggalLahir']	= $tgl_lahir;
		$pasien['Kelurahan'] 	= Input::get('txt_kelurahan');
		$pasien['Kecamatan'] 	= Input::get('txt_kecamatan');
		$pasien['KotaKab'] 		= Input::get('txt_kota');
		$pasien['Provinsi'] 	= Input::get('txt_provinsi');
		$pasien['NoTelp'] 		= Input::get('txt_no_telp');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('txt2_tanggal_masuk'));
		$pasien['TglMasuk'] = $date->format('Y-m-d');
		$pasien['JamMasuk'] = Input::get('txt2_jam_masuk');

		$id_poli 			= Input::get('cmb2_poli');
		$nama_poli 			= "";


		$poli = DB::table('tbpoli')->where('IdPoli',$id_poli)->first();

		$biaya_admin 	= 0;
		$biaya_konsul 	= 0;
				
		$tipe_pasien 	= Input::get('tipe_pasien');
		if( $tipe_pasien == 'BPJS' ){
			$tipe_p = 1;
		}
		else{
			$tipe_p = 0;
		}
		
		if(isset($poli->NamaPoli)){
			$nama_poli 	= $poli->NamaPoli;

			$tipe_poli 	= $poli->TipePoli;
		}

		$pasien['IdPenunjang']		= $id_poli;
		$pasien['NamaPenunjang']	= $nama_poli;
		$pasien['CaraBayar']		= Input::get('cmb_cara_bayar');

		$insert 	= DB::table('pasien_aps')->insertGetId($pasien);

		if( $insert > 0 ){
			$return 	= array( 'id' => $insert , 'pesan' => 'Pendaftaran pasien berhasil' );
			$data 		= array();
			$data['no_rm'] 	= '000000';
			$data['id_reg'] = $insert;
			$data["no_reg"] = $insert;
			$data['jenis_rawat'] 	= "APS";
			$data['asal'] 			= "APS";
			$data['nama'] 			= $pasien['Nama'];
			$data['tanggal'] 		= $pasien['TglMasuk'];

			$nama_poli 		= strtoupper($nama_poli);

			$table 		= DB::table('penunjang_data')->where('id' , $id_poli)
						->first();
			if( isset($table->NamaTable) ){
				$insert_p = DB::table($table->NamaTable)->insertGetId($data);
			}
			else{
				$insert_p = DB::table('radiologi_dataperiksa')->insertGetId($data);
			}

			$check_tindakan 	= DB::table('tbtindakan')->join('tbkategoritindakan' , 'tbkategoritindakan.ID' , '=' ,'tbtindakan.IdKategoriTindakan')->where('OtomatisPenunjang' , '1')->get();
			if( isset($check_tindakan) && count($check_tindakan) > 0 ){
				foreach($check_tindakan as $c){
					$dt 	= array();
					$dt['NoRM'] 	= '000000';
					$dt['JenisRawat'] 	= $nama_poli;
					$dt['TanggalMasuk'] 	= $pasien['TglMasuk'];
					$dt['TanggalTindak'] 	= $pasien['TglMasuk'];
					$dt['IdTindakan'] 	= $c->IdTindakan;
					$dt['Tindakan'] 	= $c->Tindakan;
					$dt['IdKategoriTindakan'] 	= $c->IdKategoriTindakan;
					$dt['HargaSatuan'] 	= $c->Tarif;
					$dt['Qty'] 			= 1;
					$dt['Tarif'] 		= $c->Tarif;
					$dt['Gol'] 			= $nama_poli;
					$dt['HargaSatuan'] 	= $c->Tarif;
					$dt['NoReg'] 	= $insert_p;

					$in_t 	= DB::table('tbtindakanaps')->insert(
						$dt
					);
				}
			}
		}
		else{
			$return 	= array( 'id' => 0 , 'pesan' => 'Pendaftaran gagal' );
		}
		
		echo json_encode($return);
		die();
	}

	function apsPasien(){
		$tanggal 	= date('Y-m-d');
		$data 		= DB::table('pasien_aps')->where('TglMasuk' , $tanggal)->orderBy('id' , 'DESC')->get();
		echo(json_encode($data));
	}


}