<?php

class TarifDokterController extends \CrudController {

	public $title 		= 'Dokter';
	public $table 		= 'tbdaftardokter';
	public $slug 		= 'dokter';
	public $controller 	= 'DokterController';
	public $primary 	= 'IdDokter';
	public $table_trans = 'tbdetaildokter';
	public $field_trans = 'IDDokter';

	public $join 	= array(							 
								array( 'tbspesialis' , 'tbdaftardokter.Spesialisasi' , 'tbspesialis.id' )
						);

	public function getColumns(){
		$column = array();

		$column['NamaDokter'] 	= 'Nama';
		$column['nama'] 		= 'Spesialis';
		$column['NoTelp'] 		= 'Telp';
		$column['Status'] 		= 'Status';

		return $column;
	}

	public function index(){
		$dokter 		= DB::table('dokter_jenis')->get();
		$pasien			= DB::table('tarif_jenis_pasien')->get();
		return View::make( 'tarif.bulk' , 
			array(
					'dokter'	=> $dokter ,
					'pasien'	=> $pasien ,
			)
		);
	}

	public function bulk(){
		$dokter 		= DB::table('dokter_jenis')->get();
		$pasien			= DB::table('tarif_jenis_pasien')->get();
		return View::make( 'tarif.bulk' , 
			array(
					'dokter'	=> $dokter ,
					'pasien'	=> $pasien ,
			)
		);
	}

	public function bulkPost(){
		$dokter 		= DB::table('dokter_jenis')->get();
		$pasien			= DB::table('tarif_jenis_pasien')->get();
		$tarif_field = array(
                            'TarifKonsul'   => 'Tarif Konsul', 
                            'TarifVisite'   => 'Tarif Visite',
                            'PKonsul'       => '% Konsul' , 
                            'PVisite'       => '% Visite', 
                            'PTindakan'     => '% Tindakan', 
                            'PPenunjang'    => '% Penunjang' ,
                            'PUsg'          => '% USG' ,
                            'PEmergency'    => '% Emergency');

		$tarif = array();
		foreach($_POST['tarif'] as $ta => $ri){
			$ta 	= str_replace("'", "", $ta);
			foreach($ri as $r => $i){
				$r 	= str_replace("'", "", $r);
				foreach($i as $a => $b){
					$a	= str_replace("'", "", $a);
					$tarif['tarif_'.$ta.'_'.$r."_".$a] = $b;
				}
			}
		}
		print_r($tarif);
		//die();
		foreach($dokter as $d){

			foreach($pasien as $p){

				$data	= array();
				foreach($tarif_field as $t => $f){
					$field 		= "tarif_".$d->Id."_".$p->Id."_".$t;
					$data[$t] 	= $tarif[$field];
				}

				$check = DB::table('tarif_dokter_bulk')->where('IdKategoriDokter' , $d->Id)
						->where('IdJenis' , $p->Id)->first();

				if( isset($check->Id)){
					$update = DB::table('tarif_dokter_bulk')->where('Id' , $check->Id)->update($data);
				}
				else{
					$datainsert 						= $data;
					$datainsert['IdKategoriDokter'] 	= $d->Id;
					$datainsert['IdJenis']				= $p->Id;

					$insert = DB::table('tarif_dokter_bulk')->insert($datainsert);
				}

				if($d->Id == 1){
					$listDokter 	= DB::table('tbdaftardokter')->where('Spesialisasi' , 1)->get();
				}
				else{
					$listDokter 	= DB::table('tbdaftardokter')->where('Spesialisasi' , '!=' , 1)->get();
				}
				
				foreach($listDokter as $l){
					$checkDokter 	= DB::table('tarif_dokter')->where('IdDokter' , $l->IdDokter)
										->where('IdJenis' , $p->Id)->first();

					if( isset($checkDokter->Id) ){
						$update = DB::table('tarif_dokter')->where('Id' , $checkDokter->Id)->update($data);
					}
					else{
						$datainsert 				= $data;
						$datainsert['IdDokter'] 	= $l->IdDokter;
						$datainsert['IdJenis']		= $p->Id;

						$insert = DB::table('tarif_dokter')->insert($datainsert);
					}
				}
			}
		}
		
		
		return Redirect::to('tarif_dokter/bulk')->with('success', 'Berhasil update tarif dokter');
	}

}
