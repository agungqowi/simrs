<?php

class ApiController extends Controller {

	public $database = 'bpjsrs';

	public function pasien($id="0"){
		header('Access-Control-Allow-Origin: *'); 
		$data = DB::table('tbpasien')->where('NoRM' , $id)->first();
		if( isset($data->NoRM) ){
			echo json_encode($data);
		}
		else{
			echo 'error';
		}
	}

	public function sepList($id="0"){
		header('Access-Control-Allow-Origin: *'); 
		$data = DB::connection($this->database)->table('datsjp')->where('NOKAPST' , $id)
		->orderBy('TGLSJP','desc')->get();
		echo json_encode($data);
	}

	public function tarif($id="0"){
		header('Access-Control-Allow-Origin: *');
		$flag = 0;
		$no_reg="";
		$data = DB::table('tbpasieninap')->where('Sep','LIKE',$id)->first();
		if( isset($data->NoReg) ){
			$no_reg = $data->NoReg;
			$tipe = "RI";
		}
		else{
			$data = DB::table('tbpasienjalan')->where('Sep','LIKE',$id)->first();
			if( isset($data->NoRegJalan) ){
				$no_reg = $data->NoRegJalan;
				$tipe = "RJ";
			}
			else{
				$data = DB::table('tbpasienugd')->where('Sep','LIKE',$id)->first();
				if( isset($data->NoRegUGD) ){
					$no_reg = $data->NoRegUGD;
					$tipe = "UGD";
				}
			}
		}
		
		if($no_reg == ""){
			$return = array('tarif' => "" , 'dokter' => "");
		}
		else{
			$dokter = DB::table('tbdetaildokter')->where('NoReg','LIKE',$no_reg)->where('Kategori','LIKE','DPJP')->first();
			if(isset($dokter->NamaDokter)){
				$_dokter = $dokter->NamaDokter;
			}
			else
				$_dokter = "";


			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();

			$total = 0;
			$total_tindakan = 0;
			$total_obat = 0;
			$total_ruangan = 0;
			$total_administrasi = 0;

			if($tipe == 'RI'){
				$keluar = DB::table('tbpasieninap')->where('NoReg' , $no_reg)->get();
				foreach($keluar as $k){
					$total_ruangan = $total_tindakan + $k->TotalBiaya;
				}
			}
			else if($tipe == 'RJ'){
				$total_administrasi = 40000;
			}
			foreach($tindakan as $t){
				$total_tindakan = $total_tindakan + $t->Tarif;
			}

			foreach($obat as $o){
				$total_obat = $total_obat + $o->TotalHarga;
			}

			$total = $total_tindakan + $total_ruangan + $total_obat + $total_administrasi;
			$return = array('tarif' => $total , 'dokter' => $_dokter);

		}

		echo json_encode($return);
	}
}