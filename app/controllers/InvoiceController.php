<?php

class InvoiceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$ugd = User::find( Auth::user()->id )->ugd;
		return View::make('ugd.list', array('ugd' => $ugd));
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
		$ruangan = Ruangan::all();
		return View::make('invoice.rawat_jalan' , array('ruangan' => $ruangan));
	}

	public function rawat_jalan_post()
	{
		$no_reg = Input::get('no_reg');
		$registrasi = DB::table('tbpasienjalan')->where('NoRegJalan','=',$no_reg)->first();
		$ruangan = Ruangan::all();
		
		if($registrasi)
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
		else
			$pasien = new \stdClass(); 
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)
					->where('Gol' , 'NOT LIKE' , 'Administrasi')
					->get();
		$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
		//var_dump($registrasi);
		return View::make('invoice.rawat_jalan_view' , 
			array(
				'registrasi' => $registrasi , 
				'pasien' => $pasien , 
				'dokter' => $dokter ,
				'obat' => $obat ,
				'tindakan' => $tindakan,
				'cetak_obat' => Input::get('cetak_obat')
			)
		);
	}

	public function rawat_jalan_print($no_reg="",$mode)
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
			//var_dump($registrasi);
			return View::make('invoice.rawat_jalan_print' , 
				array(
					'registrasi' => $registrasi , 
					'pasien' => $pasien , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'tindakan' => $tindakan,
					'cetak_obat' => $mode
				)
			);
		}
		
	}

	public function rawat_inap()
	{
		$ruangan = Ruangan::all();
		return View::make('invoice.rawat_inap' , array('ruangan' => $ruangan));
	}

	public function rawat_inap_view()
	{
		$no_reg = Input::get('no_reg');
		if($no_reg != ""){
			$registrasi = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->first();
			$keluar = DB::table('tbkeluar')->where('NoReg' , $no_reg)->get();
			$out = DB::table('tbkeluar')->where('NoReg' , $no_reg)->orderBy('TanggalKeluar','desc')->first();
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbtindakanranap')->where('NoReg' , $no_reg)->orderBy('GOL')->get();

			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->get();
			$inap = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->get();
			if( isset($registrasi->NoRegJalan) ){
				$tindakanjalan 	= DB::table('tbdetailtindakan')->where('NoReg' , $registrasi->NoRegJalan)->get();
				$obatjalan		= DB::table('apo_penjualan')->where('NoReg', $registrasi->NoRegJalan)->get();
			}
			else{
				$tindakanjalan	= array();
				$obatjalan		= array();
			}
		//var_dump($registrasi);
			if($registrasi){
				return View::make('invoice.rawat_inap_view' , 
					array(
						'registrasi' => $registrasi , 
						'keluar' => $keluar , 
						'inap' => $inap , 
						'dokter' => $dokter ,
						'penjualan' => $penjualan ,
						'out'	=> $out,
						'tindakan' => $tindakan,
						'tindakan_jalan'	=> $tindakanjalan,
						'obatjalan'			=> $obatjalan,
						'cetak_obat' => Input::get('cetak_obat')
					)
				);
			}
			else{
				echo 'Informasi pasien tidak ditemukan';
			}
		}
	}

	public function rawat_inap_print($no_reg="",$mode)
	{
		if($no_reg != ""){
			$registrasi = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->first();
			$keluar = DB::table('tbkeluar')->where('NoReg' , $no_reg)->get();
			$out = DB::table('tbkeluar')->where('NoReg' , $no_reg)->orderBy('TanggalKeluar','desc')->first();
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbtindakanranap')->where('NoReg' , $no_reg)->orderBy('GOL')->get();

			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->get();
			$inap = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->get();
			if( isset($registrasi->NoRegJalan) ){
				$tindakanjalan 	= DB::table('tbdetailtindakan')->where('NoReg' , $registrasi->NoRegJalan)->get();
				$obatjalan		= DB::table('apo_penjualan')->where('NoReg', $registrasi->NoRegJalan)->get();
			}
			else{
				$tindakanjalan	= array();
				$obatjalan		= array();
			}
			//var_dump($registrasi);
			if($registrasi){
				return View::make('invoice.rawat_inap_print' , 
					array(
						'registrasi' => $registrasi , 
						'keluar' => $keluar , 
						'inap' => $inap , 
						'dokter' => $dokter ,
						'penjualan' => $penjualan ,
						'out'	=> $out,
						'tindakan' => $tindakan,
						'tindakan_jalan'	=> $tindakanjalan,
						'obatjalan'			=> $obatjalan,
						'cetak_obat' => $mode,
						'helper' =>new SimHelper
					)
				);
			}
			else{
				echo 'Informasi pasien tidak ditemukan';
			}
		}		
	}

	public function ugd()
	{
		return View::make('invoice.ugd');
	}

	public function ugd_view()
	{
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
		//var_dump($registrasi);
		return View::make('invoice.ugd_view' , 
			array(
				'registrasi' => $registrasi , 
				'pasien' => $pasien , 
				'dokter' => $dokter ,
				'obat' => $obat ,
				'tindakan' => $tindakan,
				'cetak_obat' => Input::get('cetak_obat')
			)
		);
	}

	public function ugd_print($no_reg,$mode)
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
			//var_dump($registrasi);
			return View::make('invoice.ugd_print' , 
				array(
					'registrasi' => $registrasi , 
					'pasien' => $pasien , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'tindakan' => $tindakan,
					'cetak_obat' => $mode
				)
			);
		}
		
	}

	public function jasa_dokter()
	{
		return View::make('invoice.jasa_dokter' );
	}

}
