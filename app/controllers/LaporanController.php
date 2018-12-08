<?php

class LaporanController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){	

	}

	public function rl($id=""){
		$check = DB::table('data_dasar')->where('id' , 1)->first();
		if( isset($check->id) && !empty($check->id) ){

		}
		else{
			$insert = DB::table('data_dasar')->insert(['id' => 1]);
			$check = DB::table('data_dasar')->where('id' , 1)->first();
		}

		$view = $id;

		$jenis = DB::table('data_jenisrs')->get();
		$swasta = DB::table('data_pjswasta')->get();
		$tahapan = DB::table('data_akreditasi')->get();

		return View::make('laporanrl.'.$view , array( 'data' => $check ,'jenis'=>$jenis,'swasta'=>$swasta,'tahapan'=>$tahapan) );
	}


	public function post_rl($id=""){

	}

	public function rl1_1(){
		$check = DB::table('data_dasar')->where('id' , 1)->first();
		if( isset($check->id) && !empty($check->id) ){

		}
		else{
			$insert = DB::table('data_dasar')->insert(['id' => 1]);
			$check = DB::table('data_dasar')->where('id' , 1)->first();
		}


		$jenis = DB::table('data_jenisrs')->get();
		$swasta = DB::table('data_pjswasta')->get();
		$tahapan = DB::table('data_akreditasi')->get();

		return View::make('laporanrl.rl1_1' , array( 'data' => $check ,'jenis'=>$jenis,'swasta'=>$swasta,'tahapan'=>$tahapan) );
	}

	public function post_rl1_1($id=""){
		$check = DB::table('data_dasar')->where('id' , 1)->first();

		$input = Input::all();
		$data = array();
		foreach($input as $key => $value){
			if( $key != 'tahun' && $key != 'submit' ){
				$data[$key] = $value;
			}
		}

		DB::table('data_dasar')->where('id' , 1)->update($data);
		return Redirect::to('laporanrl/rl1_1')->with('success', 'Berhasil mengubah data dasar rumah sakit');
	}

}
