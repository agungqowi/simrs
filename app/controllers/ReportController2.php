<?php

class ReportController2 extends \BaseController {

	/**
	 * Display a listing of the resource. 
	 *
	 * @return Response
	 */
	public function index()
	{	
	}

// start ============================= JASA DOKTER =============================== 
	public function jasa_dokter($bag)
	{	
		if($bag == 'rawat_jalan')
			return View::make('report.jasa_dokter.rawat_jalan');
		elseif($bag == 'rawat_jalan_dokter')
			return View::make('report.jasa_dokter.rawat_jalan_dokter');
		elseif($bag == 'rawat_jalan_tanggal')
			return View::make('report.jasa_dokter.rawat_jalan_tanggal');
		elseif($bag == 'rawat_inap')
			return View::make('report.jasa_dokter.rawat_inap');
		elseif($bag == 'rawat_inap_dokter')
			return View::make('report.jasa_dokter.rawat_inap_dokter');
		elseif($bag == 'ugd')
			return View::make('report.jasa_dokter.ugd');
		else
			return View::make('report.jasa_dokter.ugd_dokter');
	}

	public function jasa_dokter_view($bag)
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$mulai = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai = $date->format('Y-m-d');

		//$bulan = Input::get('bulan');
		//$tahun = Input::get('tahun');
		//$mulai = $tahun.'-'.$bulan.'-01';
		//$sampai = $tahun.'-'.$bulan.'-31';
		ini_set('max_execution_time', 420);
		
		if($bag == 'rawat_jalan'){
			$jasa = DB::table('tbpasienjalan')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienjalan.NoRegJalan')
				->select(['NoRegJalan','Tanggal','Nama','Poli','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienjalan.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienjalan.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
			
			return View::make('report.jasa_dokter.rawat_jalan_view', 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_jalan_dokter'){
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasienjalan')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienjalan.NoRegJalan')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienjalan.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienjalan.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Dokter')->get();
		
			return View::make('report.jasa_dokter.rawat_jalan_view_dokter', 
				array(
					'dokter' => $dokter,
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_jalan_tanggal'){
			$jasa = DB::table('tbpasienjalan')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienjalan.NoRegJalan')
				->select(['Tanggal',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienjalan.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienjalan.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->groupby('Tanggal')
				->orderBy('Tanggal')->get();

			return View::make('report.jasa_dokter.rawat_jalan_view_tanggal', 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_inap'){
			$jasa = DB::table('tbpasieninap')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasieninap.NoReg')
				->select(['tbpasieninap.NoReg','Tanggal','Nama','Ruangan','Kelas','NoKamar','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasieninap.NoReg),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasieninap.NoReg),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
			
			return View::make('report.jasa_dokter.rawat_inap_view', 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_inap_dokter'){
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasieninap')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasieninap.NoReg')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasieninap.NoReg),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasieninap.NoReg),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Dokter')->get();
		
			return View::make('report.jasa_dokter.rawat_inap_view_dokter', 
				array(
					'dokter' => $dokter,
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'ugd'){
			$jasa = DB::table('tbpasienugd')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienugd.NoRegUGD')
				->select(['NoRegUGD','Tanggal','Nama','NamaDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienugd.NoRegUGD),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienugd.NoRegUGD),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();

			return View::make('report.jasa_dokter.ugd_view', 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		else{
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasienugd')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienugd.NoRegUGD')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienugd.NoRegUGD),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienugd.NoRegUGD),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('NamaDokter')->get();

			return View::make('report.jasa_dokter.ugd_view_dokter', 
				array(
					'dokter' => $dokter,
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
	}

	public function jasa_dokter_detail($bag,$no_reg)
	{
		if($bag == 'rawat_jalan'){
			$registrasi = DB::table('tbpasienjalan')->where('NoRegJalan','=',$no_reg)->first();
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
			$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
			$klaim = is_null($klaim) ? $klaim['TotalKlaim'] : $klaim->TotalKlaim;
			
			return View::make('report.jasa_dokter.rawat_jalan_detail' , 
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
		elseif($bag == 'rawat_jalan_dokter'){
			$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
			$mulai = $date->format('Y-m-d');
	
			$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
			$sampai = $date->format('Y-m-d');

			//$bulan = Input::get('bulan');
			//$tahun = Input::get('tahun');
			
			//$mulai = $tahun.'-'.$bulan.'-01';
			//$sampai = $tahun.'-'.$bulan.'-31';
	
			ini_set('max_execution_time', 420);
			
			$jasa = DB::table('tbpasienjalan')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienjalan.NoRegJalan')
				->select(['Tanggal','Nama','Poli','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienjalan.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienjalan.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->where('IdDokter',$no_reg)
				->orderBy('Tanggal')->orderBy('Nama')->get();

			return View::make('report.jasa_dokter.rawat_jalan_dokter_detail', 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_inap'){
			$registrasi = DB::table('tbpasieninap')->where('NoReg','=',$no_reg)->first();
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
			$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
			$klaim = is_null($klaim) ? $klaim['TotalKlaim'] : $klaim->TotalKlaim;
			
			return View::make('report.jasa_dokter.rawat_inap_detail' , 
				array(
					'registrasi' => $registrasi , 
					'pasien' => $pasien , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'klaim' => $klaim ,
					'tindakan' => $tindakan,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);			
		}	
		elseif($bag == 'rawat_inap_dokter'){
			$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
			$mulai = $date->format('Y-m-d');
	
			$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
			$sampai = $date->format('Y-m-d');

			//$bulan = Input::get('bulan');
			//$tahun = Input::get('tahun');
			
			//$mulai = $tahun.'-'.$bulan.'-01';
			//$sampai = $tahun.'-'.$bulan.'-31';
	
			ini_set('max_execution_time', 420);
			
			$jasa = DB::table('tbpasieninap')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasieninap.NoReg')
				->select(['Tanggal','Nama','Ruangan','Kelas','NoKamar','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasieninap.NoReg),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasieninap.NoReg),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->where('IdDokter',$no_reg)
				->orderBy('Tanggal')->orderBy('Nama')->get();

			return View::make('report.jasa_dokter.rawat_inap_dokter_detail', 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);			
		}	
		elseif($bag == 'ugd'){
			$registrasi = DB::table('tbpasienugd')->where('NoRegUGD','=',$no_reg)->first();
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$obat = DB::table('tbdetailobat')->where('NoReg' , $no_reg)->get();
			$klaim = DB::table('tbtotalklaim')->where('NoReg',$no_reg)->first();
			$klaim = is_null($klaim) ? $klaim['TotalKlaim'] : $klaim->TotalKlaim;
			
			return View::make('report.jasa_dokter.ugd_detail' , 
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
		else{
			$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
			$mulai = $date->format('Y-m-d');
	
			$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
			$sampai = $date->format('Y-m-d');

			//$bulan = Input::get('bulan');
			//$tahun = Input::get('tahun');
			
			//$mulai = $tahun.'-'.$bulan.'-01';
			//$sampai = $tahun.'-'.$bulan.'-31';
	
			ini_set('max_execution_time', 420);
			
			$jasa = DB::table('tbpasienugd')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienugd.NoRegUGD')
				->select(['Tanggal','Nama','NamaDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienugd.NoRegUGD),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienugd.NoRegUGD),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->where('IdDokter',$no_reg)
				->orderBy('Tanggal')->orderBy('Nama')->get();

			return View::make('report.jasa_dokter.ugd_dokter_detail', 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}	
	}

	public function jasa_dokter_print($bag)
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$mulai = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai = $date->format('Y-m-d');

		//$bulan = Input::get('bulan');
		//$tahun = Input::get('tahun');
		//$mulai = $tahun.'-'.$bulan.'-01';
		//$sampai = $tahun.'-'.$bulan.'-31';
		ini_set('max_execution_time', 420);

		if($bag == 'rawat_jalan'){
			$tipe = 'tbpasienjalan';
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.NoRegJalan')
				->select(['NoRegJalan','Tanggal','Nama','Poli','Diagnosis','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
	
			return View::make('report.jasa_dokter.rawat_jalan_print' , 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_jalan_dokter'){
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasienjalan')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienjalan.NoRegJalan')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienjalan.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienjalan.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Dokter')->get();
		
			return View::make('report.jasa_dokter.rawat_jalan_print_dokter', 
				array(
					'dokter' => $dokter,
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);		
		}
		elseif($bag == 'rawat_jalan_tanggal'){
			$tipe = 'tbpasienjalan';
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.NoRegJalan')
				->select(['Tanggal',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->groupby('Tanggal')
				->orderBy('Tanggal')->get();
	
			return View::make('report.jasa_dokter.rawat_jalan_print_tanggal' , 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_inap'){
			$tipe = 'tbpasieninap';
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.Noreg')
				->select(['NoRegJalan','Tanggal','Nama','Ruangan','Kelas','NoKamar','Diagnosis','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.Noreg),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.Noreg),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
	
			return View::make('report.jasa_dokter.rawat_inap_print' , 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		elseif($bag == 'rawat_inap_dokter'){
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasieninap')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasieninap.NoReg')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasieninap.NoReg),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasieninap.NoReg),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Dokter')->get();
		
			return View::make('report.jasa_dokter.rawat_inap_print_dokter', 
				array(
					'dokter' => $dokter,
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);		
		}
		elseif($bag == 'ugd'){
			$tipe = 'tbpasienugd';
			
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.NoRegUGD')
				->select(['NoRegUGD','Tanggal','Nama','Diagnosis','NamaDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegUGD),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegUGD),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
	
			return View::make('report.jasa_dokter.ugd_print' , 
				array(
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);
		}
		else{
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasienugd')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienugd.NoRegUGD')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienugd.NoRegUGD),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienugd.NoRegUGD),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('NamaDokter')->get();
		
			return View::make('report.jasa_dokter.ugd_print_dokter', 
				array(
					'dokter' => $dokter,
					'jasa' => $jasa,
					'mulai' => Input::get('dari_tanggal'),
					'sampai' => Input::get('sampai_tanggal')
				)
			);		
		}
		
		
	}

	public function jasa_dokter_excel($bag,$mode)
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$mulai = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai = $date->format('Y-m-d');

		//$bulan = Input::get('bulan');
		//$tahun = Input::get('tahun');
		//$nama_bulan = $this->namaBulan($bulan);
		//$mulai = $tahun.'-'.$bulan.'-01';
		//$sampai = $tahun.'-'.$bulan.'-31';
		ini_set('max_execution_time', 420);

		if($bag == 'rawat_jalan'){
			$tipe = 'tbpasienjalan';
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.NoRegJalan')
				->select(['Tanggal','Nama','Poli','Diagnosis','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegJalan),0) AS Tindakan'),
					DB::raw('GREATEST(((ifnull(tbtotalklaim.TotalKlaim,0) - 
								ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegJalan),0) -
								ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegJalan),0)) * 0.4 * 0.78 * 0.66), 0) AS Selisih')				
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
	
			$title = 'Laporan Jasa Dokter Rawat Jalan';
			$colnames = array('Tanggal','Nama','Poli','Diagnosis','Dokter','Klaim','Biaya Obat','Biaya Tindakan','Jasa Dokter');
			$format = array('G' => '0','H' => '0','I' => '0','J' => '0');
			$summary = 'Jumlah Pasien';
			$this->makeExcel($jasa,$title,$colnames,$format,$mode,Input::get('dari_tanggal'),Input::get('sampai_tanggal'),$summary); 
		}
		elseif($bag == 'rawat_jalan_tanggal'){
			$tipe = 'tbpasienjalan';
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.NoRegJalan')
				->select(['Tanggal',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegJalan),0) AS Tindakan'),
					DB::raw('GREATEST(((ifnull(tbtotalklaim.TotalKlaim,0) - 
								ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegJalan),0) -
								ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegJalan),0)) * 0.4 * 0.78 * 0.66), 0) AS Selisih')				
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->groupby('Tanggal')
				->orderBy('Tanggal')->get();
	
			$title = 'Laporan Jasa Dokter Rawat Jalan';
			$colnames = array('Tanggal','Total Klaim',' Total Biaya Obat','Total Biaya Tindakan','Selisih');
			$format = array('C' => '0','D' => '0','E' => '0','F' => '0');
			$summary = 'Jumlah Hari';
			$this->makeExcel($jasa,$title,$colnames,$format,$mode,Input::get('dari_tanggal'),Input::get('sampai_tanggal'),$summary); 
		}
		elseif($bag == 'rawat_jalan_dokter'){
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
			
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasienjalan')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienjalan.NoRegJalan')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienjalan.NoRegJalan),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienjalan.NoRegJalan),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Dokter')->get();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			
			$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
			
			$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(10, 10);
	
			// Merge cells
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', '');
	
			$objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
			$objPHPExcel->getActiveSheet()->mergeCells('A4:F4');
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);
	
			$objPHPExcel->getActiveSheet()->mergeCells('A6:F6');
			$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Laporan Jasa Dokter Rawat Jalan');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Dari Tanggal');
			$objPHPExcel->getActiveSheet()->setCellValue('B7', ': '.Input::get('dari_tanggal'));
					
			$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Sampai Tanggal');
			$objPHPExcel->getActiveSheet()->setCellValue('B8', ': '.Input::get('sampai_tanggal'));
	
			$objPHPExcel->getActiveSheet()->getStyle('A6:D8')->getFont()->setSize(12);
	
			// Header Table
			$list_header = array('No','Nama Dokter','Total Klaim','Total Biaya Obat','Total Biaya Tindakan','Total Jasa Dokter');
			$jum_header = count($list_header);
			
			$n = 0;
			$a = range("A","F");
			foreach($a as $c){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($c.'10', $list_header[$n]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($c)->setAutoSize(true);
				$n++;
			}
			
			$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);
	
			$objPHPExcel->getActiveSheet()->getStyle('A10:F10')->applyFromArray(
					array(
						'font'    => array(
							'bold'      => true
						),
						'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						),
						'borders' => array(
							'allborders'   => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						),
						'fill' => array(
							'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
							'rotation'   => 90,
							'startcolor' => array(
								'argb' => 'FFA0A0A0'
							),
							'endcolor'   => array(
								'argb' => 'FFFFFFFF'
							)
						)
					)
			);
			
			$tot_klaim=0;
			$tot_obat=0;
			$tot_tind=0;
			$num = 0;
			$norow = 10;
			
			foreach($dokter as $dok){
				$norow++;
				$tot_klaim=0;
				$tot_obat=0;
				$tot_tind=0;
				$num++;

				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, $num)
					->setCellValue('B'.$norow, $dok->NamaDokter);
				
				foreach($jasa as $ja){
					if($ja->IdDokter == $dok->IdDokter){
						$tot_klaim += $ja->Klaim;
						$tot_obat += $ja->Obat;
						$tot_tind += $ja->Tindakan;
					}
				}
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$norow, $tot_klaim)
					->setCellValue('D'.$norow, $tot_obat)
					->setCellValue('E'.$norow, $tot_tind);
					
				$selisih = $tot_klaim-($tot_obat+$tot_tind); 
				$jasa_dok = (($selisih * 0.4) * 0.78) * 0.66;
				$jasa_dokter = $jasa_dok < 0 ? '0' : $jasa_dok;

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$norow, $jasa_dokter);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->getNumberFormat()
					->setFormatCode(
						PHPExcel_Style_NumberFormat::FORMAT_NUMBER
					);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->applyFromArray(
					array(
						'borders' => array(
							'allborders'     => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);
			}
			
			$norow = $norow+1;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':F'.$norow);
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$norow, 'Jumlah Dokter : '.$num);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
			
			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			if($mode=='Excel5') $eks = 'xls'; else $eks = 'xlsx';
			$filename = "Laporan Jasa Dokter Rawat Jalan (".Input::get('dari_tanggal')." - ".Input::get('sampai_tanggal').").".$eks;
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
			//$mode = Excel5 : Ms. Office Excel 2003
			//		  Excel2007 : Ms. Office Excel 2007
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
			$objWriter->save('php://output');
			
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			
		}
		elseif($bag == 'rawat_inap'){
			$tipe = 'tbpasieninap';
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.NoReg')
				->select(['Tanggal','Nama',
					DB::raw('CONCAT(Ruangan,"/ ",Kelas,"/ ",NoKamar)'),
					'Diagnosis','Dokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoReg),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoReg),0) AS Tindakan'),
					DB::raw('GREATEST(((ifnull(tbtotalklaim.TotalKlaim,0) - 
								ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoReg),0) -
								ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoReg),0)) * 0.4 * 0.78 * 0.66), 0) AS Selisih')				
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
	
			$title = 'Laporan Jasa Dokter Rawat Inap';
			$colnames = array('Tanggal','Nama','Ruangan/ Kls/ No Kamar','Diagnosis','Dokter','Klaim','Biaya Obat','Biaya Tindakan','Jasa Dokter');
			$format = array('G' => '0','H' => '0','I' => '0','J' => '0');
			$summary = 'Jumlah Pasien';
			$this->makeExcel($jasa,$title,$colnames,$format,$mode,Input::get('dari_tanggal'),Input::get('sampai_tanggal'),$summary); 
		}
		elseif($bag == 'rawat_inap_dokter'){

			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasieninap')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasieninap.NoReg')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasieninap.NoReg),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasieninap.NoReg),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Dokter')->get();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			
			$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
			
			$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(10, 10);
	
			// Merge cells
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', '');
	
			$objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
			$objPHPExcel->getActiveSheet()->mergeCells('A4:F4');
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);
	
			$objPHPExcel->getActiveSheet()->mergeCells('A6:F6');
			$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Laporan Jasa Dokter Rawat Inap');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Dari Tanggal');
			$objPHPExcel->getActiveSheet()->setCellValue('B7', ': '.Input::get('dari_tanggal'));
					
			$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Sampai Tanggal');
			$objPHPExcel->getActiveSheet()->setCellValue('B8', ': '.Input::get('sampai_tanggal'));
	
			$objPHPExcel->getActiveSheet()->getStyle('A6:D8')->getFont()->setSize(12);
	
			// Header Table
			$list_header = array('No','Nama Dokter','Total Klaim','Total Biaya Obat','Total Biaya Tindakan','Total Jasa Dokter');
			$jum_header = count($list_header);
			
			$n = 0;
			$a = range("A","F");
			foreach($a as $c){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($c.'10', $list_header[$n]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($c)->setAutoSize(true);
				$n++;
			}
			
			$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);
	
			$objPHPExcel->getActiveSheet()->getStyle('A10:F10')->applyFromArray(
					array(
						'font'    => array(
							'bold'      => true
						),
						'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						),
						'borders' => array(
							'allborders'   => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						),
						'fill' => array(
							'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
							'rotation'   => 90,
							'startcolor' => array(
								'argb' => 'FFA0A0A0'
							),
							'endcolor'   => array(
								'argb' => 'FFFFFFFF'
							)
						)
					)
			);
			
			$tot_klaim=0;
			$tot_obat=0;
			$tot_tind=0;
			$num = 0;
			$norow = 10;
			
			foreach($dokter as $dok){
				$norow++;
				$tot_klaim=0;
				$tot_obat=0;
				$tot_tind=0;
				$num++;

				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, $num)
					->setCellValue('B'.$norow, $dok->NamaDokter);
				
				foreach($jasa as $ja){
					if($ja->IdDokter == $dok->IdDokter){
						$tot_klaim += $ja->Klaim;
						$tot_obat += $ja->Obat;
						$tot_tind += $ja->Tindakan;
					}
				}
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$norow, $tot_klaim)
					->setCellValue('D'.$norow, $tot_obat)
					->setCellValue('E'.$norow, $tot_tind);
					
				$selisih = $tot_klaim-($tot_obat+$tot_tind); 
				$jasa_dok = (($selisih * 0.4) * 0.78) * 0.66;
				$jasa_dokter = $jasa_dok < 0 ? '0' : $jasa_dok;

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$norow, $jasa_dokter);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->getNumberFormat()
					->setFormatCode(
						PHPExcel_Style_NumberFormat::FORMAT_NUMBER
					);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->applyFromArray(
					array(
						'borders' => array(
							'allborders'     => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);
			}
			
			$norow = $norow+1;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':F'.$norow);
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$norow, 'Jumlah Dokter : '.$num);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
			
			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			if($mode=='Excel5') $eks = 'xls'; else $eks = 'xlsx';
			$filename = "Laporan Jasa Dokter Rawat Inap (".Input::get('dari_tanggal')." - ".Input::get('sampai_tanggal').").".$eks;
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
			//$mode = Excel5 : Ms. Office Excel 2003
			//		  Excel2007 : Ms. Office Excel 2007
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
			$objWriter->save('php://output');

		}
		elseif($bag == 'ugd'){
			$tipe = 'tbpasienugd';
			$jasa = DB::table($tipe)
				->leftjoin('tbpasien','tbpasien.NoRM','=', $tipe.'.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=', $tipe.'.NoRegUGD')
				->select(['Tanggal','Nama','Diagnosis','NamaDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegUGD),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegUGD),0) AS Tindakan'),
					DB::raw('GREATEST(((ifnull(tbtotalklaim.TotalKlaim,0) - 
								ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = '.$tipe.'.NoRegUGD),0) -
								ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = '.$tipe.'.NoRegUGD),0)) * 0.4 * 0.78 * 0.66), 0) AS Selisih')				
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('Tanggal')->orderBy('Nama')->get();
	
			$title = 'Laporan Jasa Dokter UGD';
			$colnames = array('Tanggal','Nama','Diagnosis','Dokter','Klaim','Biaya Obat','Biaya Tindakan','Jasa Dokter');
			$format = array('F' => '0','G' => '0','H' => '0','I' => '0');
			$summary = 'Jumlah Pasien';
			$this->makeExcel($jasa,$title,$colnames,$format,$mode,Input::get('dari_tanggal'),Input::get('sampai_tanggal'),$summary); 
		}
		else{
			$dokter = DB::table('tbdaftardokter')->orderBy('NamaDokter')->get();
			$jasa = DB::table('tbpasienugd')
				->leftjoin('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->leftjoin('tbtotalklaim','tbtotalklaim.NoReg','=','tbpasienugd.NoRegUGD')
				->select(['IdDokter',
					DB::raw('ifnull(tbtotalklaim.TotalKlaim,0) AS Klaim'),
					DB::raw('ifnull((select sum(TotalHarga) from tbdetailobat where Noreg = tbpasienugd.NoRegUGD),0) AS Obat'),
					DB::raw('ifnull((select sum(Tarif) from tbdetailtindakan where Noreg = tbpasienugd.NoRegUGD),0) AS Tindakan')
				])
				->where('Tanggal','>=',$mulai)
				->where('Tanggal','<=',$sampai)
				->orderBy('NamaDokter')->get();
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			
			$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
			
			$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(10, 10);
	
			// Merge cells
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', '');
	
			$objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
			$objPHPExcel->getActiveSheet()->mergeCells('A4:F4');
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);
	
			$objPHPExcel->getActiveSheet()->mergeCells('A6:F6');
			$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Laporan Jasa Dokter Rawat UGD');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Dari Tanggal');
			$objPHPExcel->getActiveSheet()->setCellValue('B7', ': '.Input::get('dari_tanggal'));
					
			$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Sampai Tanggal');
			$objPHPExcel->getActiveSheet()->setCellValue('B8', ': '.Input::get('sampai_tanggal'));
	
			$objPHPExcel->getActiveSheet()->getStyle('A6:D8')->getFont()->setSize(12);
	
			// Header Table
			$list_header = array('No','Nama Dokter','Total Klaim','Total Biaya Obat','Total Biaya Tindakan','Total Jasa Dokter');
			$jum_header = count($list_header);
			
			$n = 0;
			$a = range("A","F");
			foreach($a as $c){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($c.'10', $list_header[$n]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($c)->setAutoSize(true);
				$n++;
			}
			
			$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);
	
			$objPHPExcel->getActiveSheet()->getStyle('A10:F10')->applyFromArray(
					array(
						'font'    => array(
							'bold'      => true
						),
						'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						),
						'borders' => array(
							'allborders'   => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						),
						'fill' => array(
							'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
							'rotation'   => 90,
							'startcolor' => array(
								'argb' => 'FFA0A0A0'
							),
							'endcolor'   => array(
								'argb' => 'FFFFFFFF'
							)
						)
					)
			);
			
			$tot_klaim=0;
			$tot_obat=0;
			$tot_tind=0;
			$num = 0;
			$norow = 10;
			
			foreach($dokter as $dok){
				$norow++;
				$tot_klaim=0;
				$tot_obat=0;
				$tot_tind=0;
				$num++;

				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, $num)
					->setCellValue('B'.$norow, $dok->NamaDokter);
				
				foreach($jasa as $ja){
					if($ja->IdDokter == $dok->IdDokter){
						$tot_klaim += $ja->Klaim;
						$tot_obat += $ja->Obat;
						$tot_tind += $ja->Tindakan;
					}
				}
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('C'.$norow, $tot_klaim)
					->setCellValue('D'.$norow, $tot_obat)
					->setCellValue('E'.$norow, $tot_tind);
					
				$selisih = $tot_klaim-($tot_obat+$tot_tind); 
				$jasa_dok = (($selisih * 0.4) * 0.78) * 0.66;
				$jasa_dokter = $jasa_dok < 0 ? '0' : $jasa_dok;

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$norow, $jasa_dokter);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->getNumberFormat()
					->setFormatCode(
						PHPExcel_Style_NumberFormat::FORMAT_NUMBER
					);

				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->applyFromArray(
					array(
						'borders' => array(
							'allborders'     => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);
			}
			
			$norow = $norow+1;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':F'.$norow);
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$norow, 'Jumlah Dokter : '.$num);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':F'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
			
			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			if($mode=='Excel5') $eks = 'xls'; else $eks = 'xlsx';
			$filename = "Laporan Jasa Dokter UGD (".Input::get('dari_tanggal')." - ".Input::get('sampai_tanggal').").".$eks;
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
			//$mode = Excel5 : Ms. Office Excel 2003
			//		  Excel2007 : Ms. Office Excel 2007
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
			$objWriter->save('php://output');
			
		}
	}
// end =============================== JASA DOKTER =============================== 

// start ============================= PENAMAAN BULAN =============================== 
	public function namaBulan($bulan){
		switch ($bulan) {
			case '1' : 	$nama_bulan = "Januari"; 	break;
			case '2' : 	$nama_bulan = "Februari"; 	break;
			case '3' : 	$nama_bulan = "Maret"; 		break;
			case '4' : 	$nama_bulan = "April"; 		break;
			case '5' : 	$nama_bulan = "Mei"; 		break;
			case '6' : 	$nama_bulan = "Juni"; 		break;
			case '7' : 	$nama_bulan = "Juli"; 		break;
			case '8' : 	$nama_bulan = "Agustus"; 	break;
			case '9' : 	$nama_bulan = "September"; 	break;
			case '10' : $nama_bulan = "Oktober"; 	break;
			case '11' :	$nama_bulan = "November"; 	break;
			case '12' :	$nama_bulan = "Desember"; 	break;
		}
		return $nama_bulan;
	}
// end =============================== PENAMAAN BULAN =============================== 

// start =============================== EKSPOR KE EXCEL =============================== 
	public function makeExcel($data,$title,$colnames,$format,$mode,$bulan,$tahun,$summary){
		//count object of $data to determine the length of cells and first table
		$for_row = count($data)+10;
		$first_row = 10; //start the data
		$nama_file = $title.' ('.$bulan.' - '.$tahun.')';

		//convert object into array
		$data = array_map(function($object){ return (array) $object; }, $data);
		//count the number of data header
		$jumlah = count($colnames)+1;
		//convert into alphabet for determining the cell merging
		switch ($jumlah) {
			case '1' : 	$sel = "A"; 	break;
			case '2' : 	$sel = "B"; 	break;
			case '3' : 	$sel = "C"; 	break;
			case '4' : 	$sel = "D"; 	break;
			case '5' : 	$sel = "E"; 	break;
			case '6' : 	$sel = "F"; 	break;
			case '7' : 	$sel = "G"; 	break;
			case '8' : 	$sel = "H"; 	break;
			case '9' : 	$sel = "I"; 	break;
			case '10' : $sel = "J"; 	break;
			case '11' : $sel = "K"; 	break;
			case '12' : $sel = "L"; 	break;
			case '13' : $sel = "M"; 	break;
			case '14' : $sel = "N"; 	break;
			case '15' : $sel = "O"; 	break;
		}
		//start creating the file
		$buat = Excel::create($nama_file, function ($excel) use($data,$for_row,$first_row,$sel,$title,$colnames,$format,$bulan,$tahun,$summary){
			$excel->sheet('Sheet1', function ($sheet) use($data,$for_row,$first_row,$sel,$title,$colnames,$format,$bulan,$tahun,$summary){
				//set the cell format, eg.text, number, date, etc
				$sheet->setColumnFormat($format);
				// Set top, right, bottom, left of page
				$sheet->setPageMargin(array(0.5, 0.5, 1.25, 0.5));
				//$sheet->setOrientation('landscape');

				// cells manipulation methods on row 1
				$sheet->mergeCells('A1:'.$sel.'1');
				$sheet->row(1, function ($row) {
					$row->setFontFamily('Calibri');
					$row->setFontSize(11);
				});
				$sheet->row(1, array(''));
		
				// cells manipulation methods on row 3
				$sheet->mergeCells('A3:'.$sel.'3');
				$sheet->row(3, function ($row) {
					$row->setFontFamily('Calibri');
					$row->setFontSize(15);
					$row->setFontWeight('bold');
					$row->setAlignment('center');
				});
				$sheet->row(3, array($this->rs_title));
				
				// cells manipulation methods on row 4
				$sheet->mergeCells('A4:'.$sel.'4');
				$sheet->row(4, function ($row) {
					$row->setFontFamily('Calibri');
					$row->setFontSize(15);
					$row->setAlignment('center');
				});
				$sheet->row(4, array($this->rs_alamat));
				
				// cells manipulation methods on row 6
				$sheet->mergeCells('A6:'.$sel.'6');
				$sheet->row(6, function ($row) {
					$row->setFontFamily('Calibri');
					$row->setFontSize(12);
					$row->setFontWeight('bold');
				});
				$sheet->row(6, array($title));
				
				//swow the start date and end date, if any
				// cells manipulation methods on row 7
				$sheet->mergeCells('A7:'.$sel.'7');
				$sheet->row(7, function ($row) {
					$row->setFontFamily('Calibri');
					$row->setFontSize(11);
				});
				$sheet->row(7, array('Dari Tanggal : '.$bulan));
					
				// cells manipulation methods on row 8
				$sheet->mergeCells('A8:'.$sel.'8');
				$sheet->row(8, function ($row) {
					$row->setFontFamily('Calibri');
					$row->setFontSize(11);
				});
				$sheet->row(8, array('Sampai Tanggal : '.$tahun));
					
				// cells manipulation methods on row 9
				$sheet->row(9, array(''));
				
				// setting column names for data (data header or table header)
				//$sheet->appendRow(array_keys($users[0])); //to make default data header is from query
				$no = array('No');
				$sheet->row($first_row, array_merge($no, $colnames));
				// Set height for a single row
				$sheet->setHeight($first_row, 20);
				// set the last row cell manipulation (before data or table header)
				$sheet->row($sheet->getHighestRow(), function ($row) {
					$row->setFontWeight('bold');
					$row->setFontFamily('Calibri');
					$row->setFontSize(11);
				});
				$sheet->cells('A'.$first_row.':'.$sel.$first_row, function($cells) {
					$cells->setAlignment('center');
					$cells->setValignment('center');
					$cells->setBackground('#cccccc');
				});
				
				// display data as next rows
				$num = 0;
				foreach ($data as $d) {
					$num++;
					$no = array($num);
					$sheet->appendRow(array_merge($no, $d));
				}
				
				//set cell of summary data
				$sheet->mergeCells('A'.($for_row+1).':'.$sel.($for_row+1));
				$sheet->setHeight(($for_row+1), 20);
				$sheet->row(($for_row+1), function ($row) {
					$row->setFontWeight('bold');
				});
				$sheet->row(($for_row+1), array($summary.' : '.($num)));
				$sheet->cells('A'.($for_row+1).':'.$sel.($for_row+1), function($cells) {
					$cells->setValignment('center');
					$cells->setBackground('#cccccc');
				});
				
				//set the border of table data
				$sheet->setBorder('A'.$first_row.':'.$sel.($for_row+1), 'thin');
				//set the cell manipulation of table data
				$sheet->cells('A'.$first_row.':'.$sel.($for_row+1), function($cells) {
					$cells->setFontFamily('Calibri');
				});
			});
			/* if u want more sheet
			$excel->sheet('Second sheet', function($sheet) {
				....
			});
			*/
		});
		
		return $buat->export($mode);
		 //->export('xls'); //office < 2007
		 //->download('xls');
		 //->export('xlsx');	office 2007
		 //->download('xlsx');
		 //->export('csv');
		 //->download('csv');
	}
// end =============================== EKSPOR KE EXCEL =============================== 
}
