<?php

class JasaDokterController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ugd.create' );
	}

	public function rawat_jalan()
	{
		return View::make('jasa_dokter.rawat_jalan');
	}

	public function rawat_jalan_view()
	{
		/*
		$no_reg = Input::get('no_reg');
		$registrasi = DB::table('tbpasienjalan')->where('NoRegJalan','=',$no_reg)->first();
		$ruangan = Ruangan::all();
		
		if($registrasi)
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
		else
			$pasien = new \stdClass(); 
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
		$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
		$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
		//var_dump($registrasi);
		return View::make('jasa_dokter.rawat_jalan_view' , 
			array(
				'registrasi' => $registrasi , 
				'pasien' => $pasien , 
				'dokter' => $dokter ,
				'obat' => $obat ,
				'klaim' => $klaim ,
				'tindakan' => $tindakan
			)
		);
		*/

		$dari = Input::get('dari');

		$sampai = Input::get('sampai');


		return View::make('jasa_dokter.per_rawat_jalan' , 
			array(
				'dari' => $dari,
				'sampai' => $sampai
			)
		);
	}

	public function rawat_jalan_print($no_reg="")
	{
		if($no_reg!=""){
			$registrasi = DB::table('tbpasienjalan')->where('NoRegJalan','=',$no_reg)->first();
			$ruangan = Ruangan::all();
			
			if($registrasi)
				$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
			else
				$pasien = new \stdClass(); 
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
			$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
			//var_dump($registrasi);
			return View::make('jasa_dokter.rawat_jalan_print' , 
				array(
					'registrasi' => $registrasi , 
					'pasien' => $pasien , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'klaim' => $klaim ,
					'tindakan' => $tindakan
				)
			);
		}
		
	}

	public function rawat_inap()
	{
		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		return View::make('jasa_dokter.rawat_inap' , array('ruangan' => $ruangan , 'dokter' => $dokter));
	}

	public function rawat_inap_klaim()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' , 'tbpasien.NoRM')
				->leftJoin('tbtotalklaim', 'tbpasieninap.NoReg' ,'=' , 'tbtotalklaim.NoReg')
				->where('tbpasieninap.tanggal','<=',$sampai)
				->where('tbpasieninap.tanggal' ,'>=' , $dari)
				->select('tbpasieninap.*','tbpasien.*','tbtotalklaim.TotalKlaim')
				->groupBy('tbpasieninap.NoReg')
				->get();
		return View::make('jasa_dokter.rawat_inap_klaim' , array('ruangan' => $ruangan , 'dokter' => $dokter , 
							'pasien'=>$pasien , 'helper'=>new SimHelper));
	}

	public function rawat_inap_view()
	{
		/*
		$klaim = Input::get('klaim');
		foreach($klaim as $k=>$l){
			$k = str_replace("'", "", $k);
			$cek_klaim = DB::table('tbtotalklaim')->where('NoReg',$k)->first();
			if($cek_klaim){
				DB::table('tbtotalklaim')->where('NoReg',$k)->update(
					array('TotalKlaim' => $l)
				);
			}
			else{
				DB::table('tbtotalklaim')->insert(
					array('TotalKlaim' => $l , 'NoReg' => $k)
				);
			}
		}
		$no_reg = Input::get('no_reg');
		$registrasi = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->first();
		$keluar = DB::table('tbkeluar')->where('NoReg' , $no_reg)->first();
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
		$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
		$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
		//var_dump($registrasi);
		return View::make('jasa_dokter.rawat_inap_view' , 
			array(
				'registrasi' => $registrasi , 
				'keluar' => $keluar , 
				'dokter' => $dokter ,
				'obat' => $obat ,
				'klaim' => $klaim ,
				'tindakan' => $tindakan
			)
		);
		*/

		$dari = Input::get('dari');

		$sampai = Input::get('sampai');


		return View::make('jasa_dokter.per_rawat_inap' , 
			array(
				'dari' => $dari,
				'sampai' => $sampai
			)
		);
	}

	public function rawat_inap_print($no_reg="")
	{
		if($no_reg != ""){
			$registrasi = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
				->where('NoReg','=',$no_reg)->first();
			$keluar = DB::table('tbkeluar')->where('NoReg' , $no_reg)->first();
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
			$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
			//var_dump($registrasi);
			return View::make('jasa_dokter.rawat_inap_print' , 
				array(
					'registrasi' => $registrasi , 
					'keluar' => $keluar , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'klaim' => $klaim ,
					'tindakan' => $tindakan
				)
			);
		}		
	}

	public function ugd()
	{
		return View::make('jasa_dokter.ugd');
	}

	public function ugd_view()
	{
		/*
		$no_reg = Input::get('no_reg');
		$registrasi = DB::table('tbpasienugd')->where('NoRegUGD','=',$no_reg)->first();
		$ruangan = Ruangan::all();
		
		if($registrasi)
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
		else
			$pasien = new \stdClass(); 
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
		$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
		$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
		//var_dump($registrasi);
		return View::make('jasa_dokter.ugd_view' , 
			array(
				'registrasi' => $registrasi , 
				'pasien' => $pasien , 
				'dokter' => $dokter ,
				'obat' => $obat ,
				'klaim' => $klaim ,
				'tindakan' => $tindakan
			)
		);
		*/
		$dari = Input::get('dari');

		$sampai = Input::get('sampai');


		return View::make('jasa_dokter.per_ugd' , 
			array(
				'dari' => $dari,
				'sampai' => $sampai
			)
		);
	}

	public function ugd_print($no_reg)
	{
		if($no_reg != ""){
			$registrasi = DB::table('tbpasienugd')->where('NoRegUGD','=',$no_reg)->first();
			$ruangan = Ruangan::all();
			
			if($registrasi)
				$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
			else
				$pasien = new \stdClass(); 
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
			$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
			//var_dump($registrasi);
			return View::make('jasa_dokter.ugd_print' , 
				array(
					'registrasi' => $registrasi , 
					'pasien' => $pasien , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'klaim' => $klaim ,
					'tindakan' => $tindakan
				)
			);
		}
		
	}

	public function check_klaim($id)
	{
		$klaim = DB::table('tbtotalklaim')->where('NoReg',$id)->first();
		if(isset($klaim->IdKlaim)){
			$return = array('IdKlaim' => $klaim->IdKlaim, 'TotalKlaim' => $klaim->TotalKlaim);
		}
		else{
			$return = array('IdKlaim' => 0, 'TotalKlaim' => 0);
		}
		echo json_encode($return);
	}

	public function simpan_klaim()
	{
		$no_reg = Input::get('no_reg');
		$total_klaim = Input::get('total_klaim');

		$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
		if(isset($klaim->IdKlaim)){
			DB::table('tbtotalklaim')->where( 'NoReg' , $no_reg )
				->update(
					array( 'TotalKlaim' => $total_klaim )
				);
		}
		else{
			DB::table('tbtotalklaim')->insert(
				array(
					'NoReg' => $no_reg,
					'TotalKlaim' => $total_klaim
				)
			);
		}
	}

	public function jasa_dokter()
	{
		return View::make('jasa_dokter.jasa_dokter' );
	}

	public function dokter()
	{
		$dokter = Dokter::all();
		return View::make('jasa_dokter.per_dokter' , 
			array(
				'dokter' => $dokter ,
			)
		);
	}

	public function dokter_view()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$dokter = Input::get('dokter');

		return View::make('jasa_dokter.per_dokter_view' , 
			array(
				'dokter' => $dokter ,
				'dari' => $dari,
				'sampai' => $sampai
			)
		);
	}
}
