<?php

class EKlaimController extends \BaseController {

	public function importPasien(){
		$ambil 	= DB::connection('inacbg')->table('xocp_persons')->get();
		foreach($ambil as $a){
			$data	= array();
			$data['id']		= $a->person_id;
			$data['NoRM']		= $a->person_id;
			$data['Nama']	= $a->person_nm;
			$tgl_lahir 		= explode(' ',$a->birth_dttm);
			if( isset($tgl_lahir[0]) ){
				$data['TanggalLahir']	= $tgl_lahir[0];

			}
			$data['TempatLahir'] 	= $a->birth_place;
			if( $a->adm_gender_cd == 'm' ){
				$data['Jkel']			= 'L';
			}
			else{
				$data['Jkel']			= 'P';
			}
			
			DB::table('tbpasien')->insert( $data );
		}
	}

	public function updateRM(){
		$ambil 	= DB::connection('inacbg')->table('xocp_his_patient')->get();
		foreach($ambil as $a){
			$data	= array();
			$data['NoRM']		= $a->patient_mrn;

			$norm 				= trim($a->patient_mrn);
			$nobpjs 				= trim($a->nokartu);

			$check 	= DB::table('tbpasien')->where('NoRM' , $a->patient_mrn)->first();
			$update = DB::table('tbpasien')->where('NoRM' , $a->patient_mrn)->update(
							array(
								'GolPasien'	=> 'BPJS',
								'NoBPJS' 	=> $nobpjs
							)
						);
			
			echo "ID ".$a->person_id.' == Nama '.$a->patient_mrn.'--'.$update."<br />";

			//print_r($check);
			
		}
	}

	public function importRajal(){
		$ambil 	= DB::connection('inacbg')->table('xocp_his_patient_admission')->get();
		foreach($ambil as $a){
			$p 	= DB::connection('inacbg')->table('xocp_his_patient')->where('patient_id' , $a->patient_id)->first();
			if( isset($p->person_id) ){
				$data	= array();
				$data['NoRM']		= $p->patient_mrn;
				$data['Sep']		= $a->no_sep;
				$tgl_lahir 		= explode(' ',$a->admission_dttm);
				if( isset($tgl_lahir[0]) ){
					$data['Tanggal']	= $tgl_lahir[0];

				}
				$data['IdPoli']		= 0;
				$data['Poli']		= '';
				$no_reg_jalan = time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$data['NoRegJalan'] = $no_reg_jalan;
				$data['IdDokter'] 	= $a->attending_doctor_id;
				$data['Dokter'] 	= $a->attending_doctor_nm;
				
				DB::table('tbpasienjalan')->insert( $data );
			}
			
			//print_r($check);
			
		}
	}
}