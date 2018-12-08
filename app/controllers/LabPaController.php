<?php

class LabPaController extends \BaseController {

	
	public function hasil()
	{
		
	}

	public function simpanHasil(){
		$noreg = Input::get('hasil_noreg');
		$nama = Input::get('hasil_nama');
		$norm = Input::get('hasil_norm');
		$tanggal = Input::get('hasil_tanggal');
		$jam = Input::get('hasil_jam');

		$kesimpulan = Input::get('kesimpulan');
		$makroskopik = Input::get('makroskopik');
		$mikroskopik = Input::get('mikroskopik');

		$cek 	= DB::table('lab_pa_dataperiksa')->where('no_reg' , $noreg)->first();

		$cats 	= array();

		// Input data ke table dataperiksa terlebih dahulu sebelum ke tabel detail
		if( isset($cek->id) && !empty($cek->id) ){
			$id = $cek->id;

			$data = array('kesimpulan' => $kesimpulan , 'jam' => $jam , 'tanggal' => $tanggal ,
				'makroskopik' => $makroskopik , 'mikroskopik' => $mikroskopik);
			DB::table('lab_pa_dataperiksa')->where('id',$id)->update($data);
		}
		else{
			$data 	= array( 'no_reg' => $noreg , 'no_rm' => $norm , 'nama' => $nama , 
				'makroskopik' => $makroskopik , 'mikroskopik' => $mikroskopik ,
				'kesimpulan' => $kesimpulan , 'jam' => $jam , 'tanggal' => $tanggal );
			$id = DB::table('lab_pa_dataperiksa')->insertGetId(
				$data
			);
		}
	}

	public function ambilData(){
		$noreg = Input::get('noreg');

		$cek 	= DB::table('lab_pa_dataperiksa')->where('no_reg' , $noreg)->first();

		if( isset($cek->id) && $cek->id ){
			$data['status'] = 'ada';
			$data['data']	= $cek;

			echo json_encode($data);
		}
		else{
			echo json_encode( array('status' => 'nol') );
		}
	}

}