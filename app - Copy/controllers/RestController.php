<?php

class RestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		
	}

	public function pasien($id='')
	{
		if($id==''){
			echo 'false';
		}
		else{
			$pasien = Pasien::where('NoRM', '=', $id)->take(10)->get()->toJson();;
			echo($pasien);
		}
	}

	public function pasienById($id='')
	{
		if($id==''){
			echo 'false';
		}
		else{
			$pasien = Pasien::where('id', '=', $id)->take(10)->get()->toJson();;
			echo($pasien);
		}
	}

	public function rawat_inap($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('tbpasieninap.NoRM', '=', $id)->take(10)->get();
			echo(json_encode($pasien));
		}
	}

	public function rawat_inap_byid($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('tbpasieninap.IdInap', '=', $id)->take(10)->get();
			echo(json_encode($pasien));
		}
	}

	public function rawat_inap_byreg($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('tbpasieninap.NoReg', '=', $id)->take(10)->get();
			echo(json_encode($pasien));
		}
	}

	public function rawat_inap_belum($id=0)
	{
		//Jika gak ada id maka ditolak
		if($id==0){
			echo 'false';
		}
		else{ 
			$check = $this->check_keluar($id);
			$check = false;
			// JIka sudah terdaftar di table keluar maka ditolak
			if($check){
				echo 'false';
			}
			else{
				//dapatkan nomor rekam medik
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('IdInap', '=', $id)->take(10)->get();
				echo(json_encode($pasien));
				
			}
			
		}
	}

	public function rawat_inap_norm($id=0)
	{
		//Jika gak ada maka ditolak
		if($id==0){
			echo 'false';
		}
		else{
			//get last id register
			$register = DB::table('tbpasieninap')->where('NoRM','=',$id)->orderBy('IdInap','desc')->first();
			$id_register = $register->NoReg;
			$check = $this->check_keluar($id_register);
			// JIka sudah terdaftar di table keluar maka ditolak
			$check = false;
			if($check){
				echo 'false';
			}
			else{
				//dapatkan nomor rekam medik
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('NoReg', '=', $id_register)->take(10)->get();
				echo(json_encode($pasien));
				
			}
		}
	}

	public function rawat_jalan($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienjalan.IdRegJalan', '=', $id)->take(10)->get();
			echo(json_encode($pasien));
		}
	}

	public function rawat_jalan_byreg($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienjalan.NoRegJalan', '=', $id)->take(10)->get();
			echo(json_encode($pasien));
		}
	}

	public function dokter_rawat_inap($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbdetaildokter')->leftJoin('tbspesialis','tbdetaildokter.Spesialisasi' ,'=' , 'tbspesialis.id')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function dokter_rawat_jalan($id=0)
	{
		if($id == 0){
			echo 'false';
		}
		else{
			$data 	= DB::table('tbpasienjalan')->where('NoRegJalan' , '=' , $id)->get();
			echo json_encode($data);
		}
	}

	public function ugd($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienugd.NoRegUGD', '=', $id)->take(10)->get();
			echo(json_encode($pasien));
		}
	}

	public function ugd_byreg($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienugd.NoRegUGD', '=', $id)->take(10)->get();
			echo(json_encode($pasien));
		}
	}

	public function check_keluar($id)
	{
		$pasien = DB::table('tbkeluar')->where('NoReg' , '=' , $id)->first();
		return $pasien;
	}


	public function get_by_desa(){
		
	}

	public function kelurahan(){
		
		$dokter = DB::table('w_desa')->join('w_kecamatan' , 'w_kecamatan.id' , '=' , 'w_desa.district_id')
					->join('w_kabupaten' , 'w_kabupaten.id' ,'=' ,'w_kecamatan.regency_id')
					->join('w_provinsi' , 'w_provinsi.id' ,'=' ,'w_kabupaten.province_id')
					->select('w_desa.id as desa_id' , 'w_kecamatan.id as kecamatan_id' , 'w_kabupaten.id as kabupaten_id , w_provinsi.id as provinsi_id' , 'w_desa.name as desa_name' , 'w_kecamatan.name as kecamatan_name' , 'w_kabupaten.name as kabupaten_name' , 'w_provinsi.name as provinsi_name')
					->orderBy('w_kabupaten.orderKab','ASC')
					->orderBy('w_provinsi.orderProv' , 'ASC')
		;

		return Datatable::query($dokter)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_desa('."'".$model->desa_id."','".$model->desa_name."','".$model->kecamatan_name."','".$model->kabupaten_name."','".$model->provinsi_name."'".')" href="javascript:void(0)">Pilih</a>';
        	})
        	->addColumn('desa_name',function($model)
        	{
            	return '<a onclick="pilih_desa('."'".$model->desa_id."','".$model->desa_name."','".$model->kecamatan_name."','".$model->kabupaten_name."','".$model->provinsi_name."'".')" href="javascript:void(0)">'.$model->desa_name.'</a>';
        	})
        	->addColumn('kecamatan_name',function($model)
        	{
            	return '<a onclick="pilih_desa('."'".$model->desa_id."','".$model->desa_name."','".$model->kecamatan_name."','".$model->kabupaten_name."','".$model->provinsi_name."'".')" href="javascript:void(0)">'.$model->kecamatan_name.'</a>';
        	})
        	->addColumn('kabupaten_name',function($model)
        	{
            	return '<a onclick="pilih_desa('."'".$model->desa_id."','".$model->desa_name."','".$model->kecamatan_name."','".$model->kabupaten_name."','".$model->provinsi_name."'".')" href="javascript:void(0)">'.$model->kabupaten_name.'</a>';
        	})
        	->addColumn('provinsi_name',function($model)
        	{
            	return '<a onclick="pilih_desa('."'".$model->desa_id."','".$model->desa_name."','".$model->kecamatan_name."','".$model->kabupaten_name."','".$model->provinsi_name."'".')" href="javascript:void(0)">'.$model->provinsi_name.'</a>';
        	})
			->searchColumns('w_desa.name','w_kecamatan.name' , 'w_kabupaten.name')
			->orderColumns('desa_name','kecamatan_name','kabupaten_name' ,'provinsi_name')
			->make();
	}
}