<?php

class ReportController extends \BaseController {

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


// start =============================== RAWAT JALAN =============================== 
	public function rawat_jalan()
	{	
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		$single = false;
		//echo $slug;
		if (strpos($slug,'poli_') !== false) {
			$single = true;
            $id = str_replace("poli_", "", $slug);
            $poli = db::table('tbpoli')->where('NamaPoli' ,'LIKE' ,'%'.$id.'%')->first();
        }
        else{
        	$poli = Poli::all();
        }
		return View::make('report.rawat_jalan', array('poli' => $poli,'single' => $single));
	}

	public function rawat_jalan_view()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$poli = Input::get('poli');
		if($poli == "all"){
			$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Poli' , '!=' , '')
			->orderBy('Poli')->orderBy('Tanggal')->orderBy('jam_daftar', 'ASC')
			->get();
		}
		else{
			$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Poli' , '=' , $poli)
			->orderBy('tbpasien.GolPasien')->orderBy('Tanggal','ASC')->orderBy('jam_daftar', 'ASC')
			->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.rawat_jalan_view' , 
			array(
				'pasien' => $pasien,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal,
				'poli' => $poli
			)
		);
	}

	public function rawat_jalan_print()
	{
		$dari_tanggal = Input::get('dari_tanggal');

		$sampai_tanggal = Input::get('sampai_tanggal');

		$poli = Input::get('poli');
		if($poli == "all"){
			$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Poli' , '!=' , '')
			->orderBy('Poli')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->get();
		}
		else{
			$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Poli' , '=' , $poli)
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.rawat_jalan_print' , 
			array(
				'pasien' => $pasien,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal,
				'poli' => $poli
			)
		);
	}

	public function rawat_jalan_excel($mode)
	{
		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');
		$poli = Input::get('poli');

		if($poli == "all"){
			$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Tanggal','Poli'])
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Poli' , '!=' , '')
			->orderBy('Poli')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->get();
		}
		else{
			$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Tanggal','Poli'])
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Poli' , '=' , $poli)
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->get();
		}
		
		$title = 'Laporan Rawat Jalan';
		$colnames = array('No RM', 'Nama', 'Gol Pasien', 'Tanggal', 'Poli');
		$format = array('B' => '0');
		$summary = 'Jumlah Pasien';
		$this->makeExcel($pasien,$title,$colnames,$format,$mode,$dari_tanggal,$sampai_tanggal,$summary);
	}
// end =============================== RAWAT JALAN =============================== 

// start ============================= RAWAT INAP =============================== 
	public function rawat_inap()
	{	
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		$single = false;
		//echo $slug;
		if (strpos($slug,'ruangan_') !== false) {
			$single = true;
            $id = str_replace("ruangan_", "", $slug);
            $ruangan = db::table('tbruangan')->where('NamaRuangan' ,'LIKE' ,'%'.$id.'%')->first();
        }
        else{
        	$ruangan = DB::table('tbruangan')->groupBy('NamaRuangan')->get();
        }
		
		return View::make('report.rawat_inap' , array('ruangan' => $ruangan , 'single' => $single));
	}

	public function rawat_inap_view()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');
		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
			//->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
			//->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.rawat_inap_view' , 
			array(
				'pasien' => $pasien,
				'ruangan' => $ruangan,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal
			)
		);
	}

	public function rawat_inap_print()
	{
		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');
		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
			//->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
			//->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.rawat_inap_print' , 
			array(
				'pasien' => $pasien,
				'ruangan' => $ruangan,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal
			)
		);
	}

	public function rawat_inap_excel($mode)
	{
		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');
		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Tanggal','Ruangan','Kelas','NoKamar'])
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Tanggal','Ruangan','Kelas','NoKamar'])
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		
		$title = 'Laporan Rawat Inap';
		$colnames = array('No RM', 'Nama', 'Gol Pasien', 'Tanggal', 'Ruangan', 'Kelas', 'No Kamar');
		$format = array('B' => '0');
		$summary = 'Jumlah Pasien';
		$this->makeExcel($pasien,$title,$colnames,$format,$mode,$dari_tanggal,$sampai_tanggal,$summary);
	}
// end =============================== RAWAT INAP =============================== 

// start ============================= PASIEN RUANGAN =============================== 
	public function pasien_ruangan()
	{	
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		$single = false;
		//echo $slug;
		if (strpos($slug,'ruangan_') !== false) {
			$single = true;
            $id = str_replace("ruangan_", "", $slug);
            $ruangan = db::table('tbruangan')->where('NamaRuangan' ,'LIKE' ,'%'.$id.'%')->first();
        }
        else{
        	$ruangan = DB::table('tbruangan')->groupBy('NamaRuangan')->get();
        }
		
		return View::make('report.pasien_ruangan' , array('ruangan' => $ruangan , 'single' => $single));
	}

	public function pasien_ruangan_view()
	{
		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('IdRuangan' , '!=' , '')
			->where('StatusPulang' , '0')
			//->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('Ruangan' , '=' , $ruangan)
			->where('StatusPulang' , '0')
			//->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.pasien_ruangan_view' , 
			array(
				'pasien' => $pasien,
				'ruangan' => $ruangan
			)
		);
	}

	public function pasien_ruangan_print()
	{
		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('IdRuangan' , '!=' , '')
			->where('StatusPulang' , '0')
			//->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('Ruangan' , '=' , $ruangan)
			->where('StatusPulang' , '0')
			//->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.pasien_ruangan_print' , 
			array(
				'pasien' => $pasien,
				'ruangan' => $ruangan
			)
		);
	}

	public function pasien_ruangan_excel($mode)
	{
		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Tanggal','Ruangan','Kelas','NoKamar'])
			->where('IdRuangan' , '!=' , '')
			->where('StatusPulang' , '0')
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Tanggal','Ruangan','Kelas','NoKamar'])
			->where('Ruangan' , '=' , $ruangan)
			->where('StatusPulang' , '0')
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('Tanggal')->orderBy('NoKamar')->get();
		}
		
		$title = 'Laporan Pasien di Ruangan';
		$colnames = array('No RM', 'Nama', 'Gol Pasien', 'Tanggal Masuk', 'Ruangan', 'Kelas', 'No Kamar');
		$format = array('B' => '0');
		$summary = 'Jumlah Pasien';

		$dari_tanggal = "";
		$sampai_tanggal = "";
		$this->makeExcel($pasien,$title,$colnames,$format,$mode,$dari_tanggal,$sampai_tanggal,$summary);
	}
// end =============================== PASIEN RUANGAN =============================== 

// start ============================= KONSUMSI PASIEN =============================== 
	public function konsumsi()
	{	
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		$single = false;
		//echo $slug;
		if (strpos($slug,'ruangan_') !== false) {
			$single = true;
            $id = str_replace("ruangan_", "", $slug);
            $ruangan = db::table('tbruangan')->where('NamaRuangan' ,'LIKE' ,'%'.$id.'%')->first();
        }
        else{
        	$ruangan = DB::table('tbruangan')->groupBy('NamaRuangan')->get();
        }
		
		return View::make('report.konsumsi' , array('ruangan' => $ruangan , 'single' => $single));
	}

	public function konsumsi_view()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal = $date->format('Y-m-d');

		$ruangan = Input::get('ruangan');

		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('Tanggal', $tanggal)->where('IdRuangan' , '!=' , '')->where('StatusPulang' , '0')
			//->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('Tanggal', $tanggal)->where('Ruangan' , '=' , $ruangan)->where('StatusPulang' , '0')
			//->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('NoKamar')->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.konsumsi_view' , 
			array(
				'pasien' => $pasien,
				'ruangan' => $ruangan,
				'tanggal' => $tanggal
			)
		);
	}

	public function konsumsi_print()
	{
		$tanggal = Input::get('tanggal');
		$ruangan = Input::get('ruangan');
		
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('Tanggal', $tanggal)->where('IdRuangan' , '!=' , '')->where('StatusPulang' , '0')
			//->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->where('Tanggal', $tanggal)->where('Ruangan' , '=' , $ruangan)->where('StatusPulang' , '0')
			//->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('NoKamar')->get();
		}
		
		//var_dump($registrasi);
		return View::make('report.konsumsi_print' , 
			array(
				'pasien' => $pasien,
				'ruangan' => $ruangan,
				'tanggal' => $tanggal
			)
		);
	}

	public function konsumsi_excel($mode)
	{
		$tanggal = Input::get('tanggal');
		$ruangan = Input::get('ruangan');
		$sampai_tanggal = '';
		
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Ruangan','Kelas','Tanggal'])
			->where('Tanggal', $tanggal)->where('IdRuangan' , '!=' , '')->where('StatusPulang' , '0')
			->orderBy('Ruangan')->orderBy('tbpasien.Nama')->orderBy('NoKamar')->get();
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Ruangan','Kelas','Tanggal'])
			->where('Tanggal', $tanggal)->where('Ruangan' , '=' , $ruangan)->where('StatusPulang' , '0')
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->orderBy('NoKamar')->get();
		}
		
		$title = 'Kebutuhan Jumlah Makan Pasien';
		$colnames = array('No RM', 'Nama', 'Gol Pasien', 'Ruangan', 'Kelas', 'Tanggal Masuk');
		$format = array('B' => '0');
		$summary = 'Jumlah Pasien';
		$this->makeExcel($pasien,$title,$colnames,$format,$mode,$tanggal,$sampai_tanggal,$summary);
	}
// end =============================== KONSUMSI PASIEN =============================== 

// start ============================= RAWAT UGD =============================== 
	public function ugd()
	{	
		return View::make('report.ugd');
	}

	public function ugd_view()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
		//var_dump($registrasi);
		return View::make('report.ugd_view' , 
			array(
				'pasien' => $pasien,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal
			)
		);
	}

	public function ugd_excel($mode)
	{
		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');

		$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
			->select(['tbpasien.NoRM','Nama','GolPasien','Tanggal'])
			->whereBetween('Tanggal', array($dari_tanggal, $sampai_tanggal))
			->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();
		
		$title = 'Laporan UGD';
		$colnames = array('No RM', 'Nama', 'Gol Pasien', 'Tanggal');
		$format = array('B' => '0');
		$summary = 'Jumlah Pasien';
		$this->makeExcel($pasien,$title,$colnames,$format,$mode,$dari_tanggal,$sampai_tanggal,$summary);
	}
// end =============================== RAWAT UGD =============================== 

// start ============================= HEMODIALISA =============================== 
	public function hemodialisa()
	{	
		$ugd = User::find( Auth::user()->id )->ugd;
		return View::make('report.hemodialisa', array('ugd' => $ugd));
	}
// end =============================== HEMODIALISA =============================== 

// start ============================= POLI BULAN =============================== 
	public function poli_bulan()
	{
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		$single = false;
		//echo $slug;
		if (strpos($slug,'poli_') !== false) {
			$single = true;
            $id = str_replace("poli_", "", $slug);
            $poli = db::table('tbpoli')->where('NamaPoli' ,'LIKE' ,'%'.$id.'%')->first();
        }
        else{
        	//$poli = Poli::all();
			$poli = Poli::orderby('NamaPoli')->get();
        }
		
		return View::make('report.poli_bulan' , array('poli' => $poli , 'single' => $single));
	}

	public function poli_bulan_view()
	{
		$poli = Input::get('poli');
		$lap = LapBulanPoli::where('Poli',$poli)->where('bulan',intval(Input::get('bulan')))->where('tahun', Input::get('tahun'))->get();
		return View::make('report.poli_bulan_view' , array(
			'lap' => $lap ,
			'nama_poli' => $poli,
			'bulan' => Input::get('bulan'),
			'nama_bulan' => strtoupper($this->namaBulan(Input::get('bulan'))),
			'tahun' => Input::get('tahun')
		));

	}

	public function poli_bulan_excel($mode='xls')
	{
		$poli = Input::get('poli');
		$bulan = strtoupper($this->namaBulan(Input::get('bulan')));
		$tahun = Input::get('tahun');
		$lap = LapBulanPoli::where('Poli',$poli)->where('bulan',intval(Input::get('bulan')))->where('tahun', Input::get('tahun'))->get();
		/*
		foreach($lap as $l){
			echo $l->Kategori.'<br />';
			if($l->Kategori == 'askes'){
				$n = 0;
				$a = range("C","Z");
				foreach($a as $c){
					$n++;
					$j = "t".$n;
					echo 'kolom : '.$c.' Nilai : '.$j.' : '.$l->$j;
					echo '<br />';
				}
				
				$b = range("A","G");
				foreach($b as $d){
					$n++;
					$j = "t".$n;
					echo 'kolom : '.'A'.$d.' Nilai : '.$j.' : '.$l->$j;
					echo '<br />';
				}
			}   
		}
		*/
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		/*
		$objPHPExcel->getActiveSheet()->getProtection()->setPassword('datakreatif');
		$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
		$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
		*/
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
		
		// Repeat Rows  
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(8, 9);

		// Merge cells
		$row = 1;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':AH'.$row);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, '');
		
		$row = $row + 2;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':AH'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $this->rs_title);
		
		$row++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':AH'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $this->rs_title);
		
		$row = $row + 2;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':AH'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'REKAPITULASI HARIAN POLIKLINIK '.strtoupper($poli).' ('.$bulan.' '.$tahun.')');

		// Header Table 
		$row = $row + 2;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'STATUS PX');
		
		$objPHPExcel->getActiveSheet()->mergeCells('C'.$row.':AG'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, 'TANGGAL');

		$objPHPExcel->getActiveSheet()->mergeCells('AH'.$row.':AH'.($row+1));
		$objPHPExcel->getActiveSheet()->getStyle('AH'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('AH'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, 'TOTAL');
		
		$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
		
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':AH'.($row+1))->applyFromArray(
				array(
					'font'    => array(
						'bold'      => true
					),
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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

		$row++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'KUNJUNGAN');
		
		$n = 0;
		$a = range("C","Z");
		foreach($a as $c){
			$n++;
			$objPHPExcel->getActiveSheet()->getStyle($c.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle($c.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $n);
			$objPHPExcel->getActiveSheet()->getColumnDimension($c)->setWidth(3.71);
		}
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		
		$b = range("A","G");
		foreach($b as $d){
			$n++;
			$objPHPExcel->getActiveSheet()->getStyle('A'.$d.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$d.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $n);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A'.$d)->setWidth(3.71);

		}

		$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
		$start_border = $row+1;
		
		$gol = array('AD','AL','AU');
		$gol2 = array('tniad','tnial','tniau');
		for($i=0; $i<3; $i++){
			$row++;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.($row).':A'.($row+2));
			$objPHPExcel->getActiveSheet()->getStyle('A'.($row))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($row))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.($row), $gol[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($row), 'Militer');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == $gol2[$i].'mil'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
			
			$row++;
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($row), 'Keluarga');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == $gol2[$i].'kel'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
			
			$row++;
			$objPHPExcel->getActiveSheet()->setCellValue('B'.($row), 'PNS');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == $gol2[$i].'pns'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
		}


		$row++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':A'.($row+2));
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'BPJS');
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Askes');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == 'askes'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
		
		$row++;
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Mandiri');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == 'bpjs_mandiri'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
		
		$row++;
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Jamkesmas');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == 'jamkesmas'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
		
		$row++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.($row));
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Jamkesda');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == 'Jamkesda'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');


		$row++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':A'.($row+9));
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Swasta');
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Nayaka');
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == 'swasta_nayaka'){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');

		$swasta = array('In Health','Gandum','Krebet','Molindo','Indolacto','KAI','Bringin Live','Cakra/Pindad','Umum');
		$swasta2 = array('swasta_inhealth','swasta_gandum','swasta_krebet','swasta_molindo','swasta_indolacto','swasta_pt.kai','swasta_bringinlive','swasta_pt.cakra/pindad','swasta_umum');
		$f = 0;
		foreach($swasta as $sw){
			$row++;
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $sw);
			$content = 0;
			foreach($lap as $l){
			   if($l->Kategori == $swasta2[$f]){
			   		$content = 1;
					$n = 0;
					$a = range("C","Z");
					foreach($a as $c){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue($c.$row, $l->$j);
					}
					
					$b = range("A","G");
					foreach($b as $d){
						$n++;
						$j = "t".$n;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, $l->$j);
					}
			   }
			   else $content = 0;
			   $f++;
			}
			if($content == 0){
				foreach($a as $c){
					$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '0');
				}
					
				$b = range("A","G");
				foreach($b as $d){
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '0');
				}
			}
			$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
		}
		$end_border = $row;
		
		$objPHPExcel->getActiveSheet()->getStyle('A'.$start_border.':AH'.$end_border)->applyFromArray(
				array(
					'borders' => array(
						'allborders'   => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
		);
		
		$row++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.($row));
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Total');
		$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(22);
		
		$a = range("C","Z");
		foreach($a as $c){
			$objPHPExcel->getActiveSheet()->setCellValue($c.$row, '=SUM('.$c.$start_border.':'.$c.$end_border.')');
		}
					
		$b = range("A","G");
		foreach($b as $d){
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$d.$row, '=SUM(A'.$d.$start_border.':A'.$d.$end_border.')');
		}
		$objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, '=SUM(C'.$row.':AG'.$row.')');
		
		$objPHPExcel->getActiveSheet()->getStyle('AH'.$start_border.':AH'.$end_border)->applyFromArray(
				array(
					'font'    => array(
						'bold'      => true
					),
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
					),
					'borders' => array(
						'allborders'   => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
		);

		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':AH'.$row)->applyFromArray(
				array(
					'font'    => array(
						'bold'      => true
					),
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
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

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		if($mode=='Excel5') $eks = 'xls'; else $eks = 'xlsx';
		$filename = "Lap_Rekap_Poli_".$poli."_(".$bulan."-".$tahun.").".$eks;
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//$mode = Excel5 : Ms. Office Excel 2003
		//		  Excel2007 : Ms. Office Excel 2007
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
		$objWriter->save('php://output');

	}
// end =============================== POLI BULAN =============================== 

// start ============================= SETTING PREF =============================== 
	public function setPref($pref)
	{
		if($pref == 'dinas'){
			$this->pref = 'di';
			$this->title = 'Dinas';
			$this->slug = 'dinas';
		}
		else{
			$this->pref = 'as';
			$this->title = 'Askes';
			$this->slug = 'askes';
		}
	}
// end =============================== SETTING PREF =============================== 

// start ============================= STOK OBAT APOTEK =============================== 
	public function stokObat($pref='askes')
	{	
		$this->pref = "apo_";
		if($pref == 'gudang'){
			$stok_obat = DB::table($this->pref.'obat')->leftjoin($this->pref.'jenisobat', $this->pref.'obat.kodejenis', '=', $this->pref.'jenisobat.kodejenis')
						->select($this->pref.'obat.*' ,$this->pref.'jenisobat.namajenis' , $this->pref.'obat.stok as stok_obat' ,$this->pref.'obat.hargabeli as harga_tampil')
												  ->orderBy('namaobat','asc')->get();
			$this->title = "Gudang";
			$this->slug = 'gudang';

			return View::make('report.gudang_stok_obat' ,
				array(
					'stok_obat' => $stok_obat,
					'title' => $this->title,
					'slug' => $this->slug
				)
			);
		}
		else{
			$stok_obat = DB::table($this->pref.'detailobat')
						->leftjoin($this->pref.'obat',$this->pref.'detailobat.kodobat' ,'=',$this->pref.'obat.kodobat')
						->select($this->pref.'detailobat.*', $this->pref.'obat.hargabeli as harga_tampil')
						->orderBy('namaobat','asc')->get();
			$this->title = "Apotek";
			$this->slug = $pref;

			return View::make('report.apotek_stok_obat' ,
				array(
					'stok_obat' => $stok_obat,
					'title' => $this->title,
					'slug' => $this->slug
				)
			);
		}
		
		
	}

	public function stokObat_excel($pref='askes',$mode)
	{	
		$this->pref = "apo_";
		if($pref == 'gudang'){
			$data = DB::table($this->pref.'obat')->join($this->pref.'jenisobat', $this->pref.'obat.kodejenis', '=', $this->pref.'jenisobat.kodejenis')
						->select('namaobat', 'komposisi', 'satuan' ,$this->pref.'jenisobat.namajenis' , $this->pref.'obat.stok as stok_obat' ,$this->pref.'obat.hargabeli as harga_tampil')
												  ->orderBy('namaobat','asc')->get();
			$this->title = "Gudang";
			$this->slug = 'gudang';
		}
		else{
			$data = DB::table($this->pref.'obat')->leftJoin($this->pref.'detailobat' , $this->pref.'detailobat.kodobat', '=', $this->pref.'obat.kodobat')
						->join($this->pref.'jenisobat', $this->pref.'obat.kodejenis', '=', $this->pref.'jenisobat.kodejenis')
						->select('namaobat', 'komposisi', 'satuan' ,$this->pref.'jenisobat.namajenis' , $this->pref.'detailobat.stok as stok_obat' ,$this->pref.'detailobat.harga_jual_umum as harga_tampil')
						->where($this->pref.'detailobat.tempat' , $pref)->orderBy('namaobat','asc')->get();
			$this->title = "Apotek";
			$this->slug = $pref;
		}
				
		$title = 'Laporan Stok Obat '.$this->title;
		$colnames = array('Nama Obat', 'Komposisi', 'Satuan', 'Jenis Obat', 'Stok', 'Harga');
		$format = array('E' => '0','F' => '0');
		$datestart = '';
		$dateend = '';
		$summary = 'Jumlah Obat';
		$this->makeExcel($data,$title,$colnames,$format,$mode,$datestart,$dateend,$summary);
			
	}
// end =============================== STOK OBAT APOTEK =============================== 

// start ============================= TOP 10 PENYAKIT PASIEN =============================== 
	public function penyakit()
	{	
		$penyakit = DB::table('tbdetaildiagnosis')->leftjoin('refdiagnosis', 'tbdetaildiagnosis.IdDiag', '=', 'refdiagnosis.IdDiag')
						->select(['tbdetaildiagnosis.IdDiag', 'refdiagnosis.ShortDiagnoisDesc',
						'refdiagnosis.LongDiagnosisDesc', DB::raw('COUNT(tbdetaildiagnosis.IdDiag) AS jumlah')])
						->where('tbdetaildiagnosis.IdDiag' ,'!=' , '')
						->groupby('tbdetaildiagnosis.IdDiag')->orderBy('jumlah','desc')->take(10)->get();
		//var_dump($penyakit);
		return View::make('report.penyakit_pasien' ,
			array(
				'penyakit' => $penyakit
			)
		);
	}

	public function penyakit_excel($mode)
	{	
		$data = DB::table('tbdetaildiagnosis')->leftjoin('refdiagnosis', 'tbdetaildiagnosis.IdDiag', '=', 'refdiagnosis.IdDiag')
						->select(['tbdetaildiagnosis.IdDiag', 'refdiagnosis.ShortDiagnoisDesc',
						'refdiagnosis.LongDiagnosisDesc', DB::raw('COUNT(tbdetaildiagnosis.IdDiag) AS jumlah')])
						->where('tbdetaildiagnosis.IdDiag' ,'!=' , '')
						->groupby('tbdetaildiagnosis.IdDiag')->orderBy('jumlah','desc')->take(10)->get();
				
		$title = 'Laporan 10 Penyakit Pasien Teratas';

		$colnames = array('Id Diagnosis', 'Nama Dignosis', 'Keterangan', 'Jumlah');
		$format = array('B' => '0');
		$datestart = '';
		$dateend = '';
		$summary = 'Jumlah Diagnosis';
		$this->makeExcel($data,$title,$colnames,$format,$mode,$datestart,$dateend,$summary);
			
	}
// end =============================== TOP 10 PENYAKIT PASIEN =============================== 

// start ============================= REKAP DATA PASIEN MASUK RS =============================== 
	public function rekap_data()
	{	
		return View::make('report.rekap_data');
	}

	public function rekap_data_view()
	{	
		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');
		
		$rekap = DB::table('tbmasukrs')->leftjoin('tbpasien', 'tbmasukrs.NoRM', '=', 'tbpasien.NoRM')
					->select(['TglMasuk', 'GolPasien', 'SubGolPasien', DB::raw('COUNT(*) AS jumlah')]);
		
		if($bulan == 0){
			if($tahun == 0){
				$rekapA = '';
			}
			else{
				$rekapA = $rekap->whereRaw('year(TglMasuk)='.$tahun);
			}
		}
		elseif($tahun == 0){
			$rekapA = $rekap->whereRaw('month(TglMasuk)='.$bulan);
		}
		else{
			$rekapA = $rekap->whereRaw('month(TglMasuk)='.$bulan)
					 ->whereRaw('year(TglMasuk)='.$tahun);
		}
		
			$rekapB = $rekap->groupby('GolPasien')
							->groupby('SubGolPasien')
							->orderBy('GolPasien')
							->orderBy('SubGolPasien')
							->get();
		
		if($bulan == 0)
			$nama_bulan = '';
		else
			$nama_bulan = $this->namaBulan($bulan);
		/*var_dump($bulan,$tahun,$rekap);*/
		
		$golpas = ' ';
		$num = 0;
		$total = 0;
		
		return View::make('report.rekap_data_view' ,
			array(
				'rekap' => $rekapB,
				'bulan' => $bulan,
				'tahun' => $tahun,
				'nama_bulan' => $nama_bulan,
				'golpas' => $golpas,
				'num' => $num,
				'total' => $total
			)
		);
	}

	public function rekap_data_excel($mode)
	{	
		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');
		
		$rekap = DB::table('tbmasukrs')->leftjoin('tbpasien', 'tbmasukrs.NoRM', '=', 'tbpasien.NoRM')
					->select(['TglMasuk', 'GolPasien', 'SubGolPasien', DB::raw('COUNT(*) AS jumlah')]);
		
		if($bulan == 0){
			if($tahun == 0){
				$rekapA = '';
			}
			else{
				$rekapA = $rekap->whereRaw('year(TglMasuk)='.$tahun);
			}
		}
		elseif($tahun == 0){
			$rekapA = $rekap->whereRaw('month(TglMasuk)='.$bulan);
		}
		else{
			$rekapA = $rekap->whereRaw('month(TglMasuk)='.$bulan)
					 ->whereRaw('year(TglMasuk)='.$tahun);
		}
		
			$rekapB = $rekap->groupby('GolPasien')
							->groupby('SubGolPasien')
							->orderBy('GolPasien')
							->orderBy('SubGolPasien')
							->get();
		
		if($bulan == 0)
			$nama_bulan = '';
		else
			$nama_bulan = $this->namaBulan($bulan);
			
		/*var_dump($nama_bulan,$bulan,$tahun,$rekap);*/
		
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
		$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '');

		$objPHPExcel->getActiveSheet()->mergeCells('A3:D3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:D4');
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);

		$objPHPExcel->getActiveSheet()->mergeCells('A6:D6');
		$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Laporan Rekap Data Pasien Masuk RS');
		
		if($bulan==0){
			if($tahun==0){
				$objPHPExcel->getActiveSheet()->setCellValue('A7', '');
				$objPHPExcel->getActiveSheet()->setCellValue('B7', '');
				
				$objPHPExcel->getActiveSheet()->setCellValue('A8', '');
				$objPHPExcel->getActiveSheet()->setCellValue('B8', '');
			}
			else{
				$objPHPExcel->getActiveSheet()->setCellValue('A7', '');
				$objPHPExcel->getActiveSheet()->setCellValue('B7', '');
				
				$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('B8', ': '.$tahun);
			}
		}
		elseif($tahun==0){
			$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Bulan');
			$objPHPExcel->getActiveSheet()->setCellValue('B7', ': '.$nama_bulan);
				
			$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Tahun');
			$objPHPExcel->getActiveSheet()->setCellValue('B8', ': Semua Tahun');
		}
		else{
			$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Bulan');
			$objPHPExcel->getActiveSheet()->setCellValue('B7', ': '.$nama_bulan);
				
			$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Tahun');
			$objPHPExcel->getActiveSheet()->setCellValue('B8', ': '.$tahun);
		}

		$objPHPExcel->getActiveSheet()->getStyle('A6:D8')->getFont()->setSize(12);

		// Header Table
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A10', 'No')
			->setCellValue('B10', 'Golongan Pasien')
			->setCellValue('C10', 'Sub Golongan Pasien')
			->setCellValue('D10', 'Jumlah Pasien');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);

		$objPHPExcel->getActiveSheet()->getStyle('A10:D10')->applyFromArray(
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
		
		// Protect cells (need a password in any editing worksheet.
		// Needs to be set to true in order to enable any worksheet protection!
		//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		//$objPHPExcel->getActiveSheet()->protectCells('A3:E13', 'PHPExcel');
		$golpas = ' ';
		$num = 0;
		$total = 0;
		$norow = 10;
  		
		foreach($rekapB as $pas => $ien){
			$norow++;
			if($ien->GolPasien == $golpas){
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, '')
					->setCellValue('B'.$norow, '')
					->setCellValue('C'.$norow, $ien->SubGolPasien)
					->setCellValue('D'.$norow, $ien->jumlah);
					
				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':D'.$norow)->applyFromArray(
					array(
						'borders' => array(
							'allborders'     => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);
			}
			else{
				$num++;
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, $num)
					->setCellValue('B'.$norow, $ien->GolPasien)
					->setCellValue('C'.$norow, $ien->SubGolPasien)
					->setCellValue('D'.$norow, $ien->jumlah);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':D'.$norow)->applyFromArray(
						array(
							'borders' => array(
								'allborders'     => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
						)
					);
			}
			$total = $total + $ien->jumlah;
			$golpas = $ien->GolPasien;
		}

		$norow = $norow+2;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':D'.$norow);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$norow, 'Jumlah Total Pasien : '.$total);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':D'.$norow)->applyFromArray(
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
	//	$filename = "Lap_Rekap_Data_Pasien_(".$nama_bulan." ".$tahun.").".$eks;
		$filename = "Lap_Rekap_Data_Pasien.".$eks;
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//$mode = Excel5 : Ms. Office Excel 2003
		//		  Excel2007 : Ms. Office Excel 2007
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
		$objWriter->save('php://output');
	}
// end =============================== REKAP DATA PASIEN MASUK RS =============================== 

// start ================================== UNIT GIZI ===================================== 
	public function gizi()
	{	
		return View::make('report.gizi');
	}

	public function gizi_view()
	{	
		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');

		$rekap = DB::table('tbpasieninap')
				->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')
				->leftJoin('tbmasukrs', function($join){
					$join->on('tbpasieninap.NoRM', '=', 'tbmasukrs.NoRM');
					$join->on('tbpasieninap.Tanggal', '=', 'tbmasukrs.TglMasuk');
				})
				->leftJoin('tbtarifruangan', function($join){
					$join->on('tbpasien.GolPasien', '=', 'tbtarifruangan.GolPasien');
					$join->on('tbpasieninap.Kelas', '=', 'tbtarifruangan.Kelas');
					$join->on('tbpasieninap.IdRuangan', '=', 'tbtarifruangan.IdRuang');
				})
				->select(['tbpasieninap.NoRM', 'Nama', 'tbpasien.GolPasien', 'tbpasien.SubGolPasien', 'Ruangan', 'tbpasieninap.Kelas',
							'NoKamar', 'Tanggal', 'JamMasuk', 'TanggalPulang', 'JamPulang',
							DB::raw('DATEDIFF(TanggalPulang,Tanggal) AS Lama'), 'tbtarifruangan.BiayaMakan',
							DB::raw('(DATEDIFF(TanggalPulang,Tanggal) * tbtarifruangan.BiayaMakan) AS total')])
				->where('StatusPulang',1);
		
		if($bulan == 0){
			if($tahun == 0){
				$rekapA = '';
			}
			else{
				$rekapA = $rekap->whereRaw('year(Tanggal)='.$tahun);
			}
		}
		elseif($tahun == 0){
				$rekapA = $rekap->whereRaw('month(Tanggal)='.$bulan);
		}
		else{
				$rekapA = $rekap->whereRaw('month(Tanggal)='.$bulan)
								->whereRaw('year(Tanggal)='.$tahun);
		}
		
		$rekapB = 	$rekap->orderBy('Tanggal')
					->orderBy('Nama')
					->orderBy('tbpasien.GolPasien')
					->orderBy('tbpasien.SubGolPasien')
					->orderBy('Ruangan')
					->orderBy('tbpasieninap.Kelas')
					->orderBy('NoKamar')
					->get();
		
		if($bulan == 0)
			$nama_bulan = '';
		else
			$nama_bulan = $this->namaBulan($bulan); 
		
		$no = 0;				
		/*var_dump($nama_bulan,$bulan,$tahun,$rekapB);*/
		return View::make('report.gizi_view' ,
			array(
				'rekap' => $rekapB,
				'bulan' => $bulan,
				'tahun' => $tahun,
				'nama_bulan' => $nama_bulan,
				'no' => $no
			)
		); 
	}

	public function gizi_excel($mode)
	{	
		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');

		if($bulan == 0)
			$nama_bulan = '';
		else
			$nama_bulan = $this->namaBulan($bulan); 
		
		$rekap = DB::table('tbpasieninap')
				->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')
				->leftJoin('tbmasukrs', function($join){
					$join->on('tbpasieninap.NoRM', '=', 'tbmasukrs.NoRM');
					$join->on('tbpasieninap.Tanggal', '=', 'tbmasukrs.TglMasuk');
				})
				->leftJoin('tbtarifruangan', function($join){
					$join->on('tbpasien.GolPasien', '=', 'tbtarifruangan.GolPasien');
					$join->on('tbpasieninap.Kelas', '=', 'tbtarifruangan.Kelas');
					$join->on('tbpasieninap.IdRuangan', '=', 'tbtarifruangan.IdRuang');
				})
				->select(['tbpasieninap.NoRM', 'Nama', 
							DB::raw('CONCAT(tbpasien.GolPasien, "/ ", tbpasien.SubGolPasien) AS gol_pasien'),
							'Ruangan',
							DB::raw('CONCAT(tbpasieninap.Kelas, "/ ", NoKamar) AS kelas_kamar'),
							'Tanggal', 'JamMasuk', 'TanggalPulang', 'JamPulang',
							DB::raw('DATEDIFF(TanggalPulang,Tanggal) AS Lama'),
							'tbtarifruangan.BiayaMakan',
							DB::raw('(DATEDIFF(TanggalPulang,Tanggal) * tbtarifruangan.BiayaMakan) AS total')])
				->where('StatusPulang',1);
		
		if($bulan == 0){
			if($tahun == 0){
				$rekapA = '';
				$month = '';
				$year = 'Tahun : Semua Tahun';
			}
			else{
				$rekapA = $rekap->whereRaw('year(Tanggal)='.$tahun);
				$month = '';
				$year = 'Tahun : '.$tahun;
			}
		}
		elseif($tahun == 0){
			$rekapA = $rekap->whereRaw('month(Tanggal)='.$bulan);
			$month = 'Bulan : '.$nama_bulan;
			$year = 'Tahun : Semua Tahun';
		}
		else{
			$rekapA = $rekap->whereRaw('month(Tanggal)='.$bulan)
							->whereRaw('year(Tanggal)='.$tahun);
			$month = 'Bulan : '.$nama_bulan;
			$year = 'Tahun : '.$tahun;
		}
		
		$data = $rekap->orderBy('Tanggal')
					->orderBy('Nama')
					->orderBy('tbpasien.GolPasien')
					->orderBy('tbpasien.SubGolPasien')
					->orderBy('Ruangan')
					->orderBy('tbpasieninap.Kelas')
					->orderBy('NoKamar')
					->get();
				
		$title = 'Laporan Unit Gizi';
 	 	 	 	 	 	 	 	 	 	 	
		$colnames = array('No RM', 'Nama', 'Gol Pasien', 'Ruangan', 'Kelas/ No Kamar', 'Tanggal Masuk', 'Jam Masuk', 'Tanggal Keluar', 'Jam Keluar', 'Lama (Hari)', 'Makan/ Hari', 'Total');
		$format = array('B' => '0');
		$datestart = $month;
		$dateend = $year;
		$summary = 'Jumlah Total Pasien';
		$this->makeExcel($data,$title,$colnames,$format,$mode,$datestart,$dateend,$summary);
			
	}

// start =============================== UNIT GIZI ====================================== 

// start ============================= REKAP DATA PASIEN POLI =============================== 
	public function rekap_poli()
	{	
		return View::make('report.rekap_poli');
	}

	public function rekap_poli_view()
	{	
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal = $date->format('Y-m-d');
		
		$rekap_poli = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
						->select(['Tanggal','IdPoli','Poli','tbpasien.GolPasien','tbpasien.SubGolPasien', DB::raw('COUNT(*) AS jumlah')])
						->where('tbpasienjalan.Tanggal',$tanggal)
						->groupby('tbpasienjalan.Poli')
						->groupby('tbpasien.GolPasien')
						->groupby('tbpasien.SubGolPasien')
						->get();
						
		$list_poli = DB::table('tbpoli')->orderBy('NamaPoli')->get();

		foreach($rekap_poli as $rek => $row){
			if(empty($row->Poli)) continue;
			$arrData[$row->Poli][$row->GolPasien][$row->SubGolPasien]= $row->jumlah;
			
			if(!isset($cnt[$row->Poli])){
				$cnt[$row->Poli] = $row->jumlah;
			}else{
				$cnt[$row->Poli] +=  $row->jumlah;
			}
		}
		
		foreach($list_poli as $rek => $row){
			if(!isset($arrData[$row->NamaPoli])){
				$arrData[$row->NamaPoli] = 0;
			}
		}
		
		ksort($arrData);
		
		return View::make('report.rekap_poli_view' ,
			array(
				'arrData' => $arrData,
				'cnt' => $cnt,
				'date' => Input::get('tanggal'),
				'tanggal' => $tanggal
			)
		);
	}

	public function rekap_poli_excel($mode)
	{	
		$tanggal = Input::get('tanggal');
		
		$rekap_poli = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
						->select(['IdPoli','Poli','GolPasien','SubGolPasien', DB::raw('COUNT(*) AS jumlah')])
						->where('Tanggal',$tanggal)
						->groupby('Poli')
						->groupby('GolPasien')
						->groupby('SubGolPasien')
						->get();
						
		$list_poli = DB::table('tbpoli')->orderBy('NamaPoli')->get();

		foreach($rekap_poli as $rek => $row){
			if(empty($row->Poli)) continue;
			$arrData[$row->Poli][$row->GolPasien][$row->SubGolPasien]= $row->jumlah;
			
			if(!isset($cnt[$row->Poli])){
				$cnt[$row->Poli] = $row->jumlah;
			}else{
				$cnt[$row->Poli] +=  $row->jumlah;
			}
		}
		
		foreach($list_poli as $rek => $row){
			if(!isset($arrData[$row->NamaPoli])){
				$arrData[$row->NamaPoli] = 0;
			}
		}
		
		ksort($arrData);
			
		/*var_dump($nama_bulan,$bulan,$tahun,$rekap);*/
		
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
		$objPHPExcel->getActiveSheet()->mergeCells('A1:R1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '');

		$objPHPExcel->getActiveSheet()->mergeCells('A3:R3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:R4');
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);

		$objPHPExcel->getActiveSheet()->mergeCells('A6:R6');
		$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Laporan Rekap Data Pasien Poli');
		
		$objPHPExcel->getActiveSheet()->mergeCells('A7:R7');
		$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Per Tanggal '.$tanggal);
		$objPHPExcel->getActiveSheet()->setCellValue('A8', '');

		$objPHPExcel->getActiveSheet()->getStyle('A6:R8')->getFont()->setSize(12);

		// Header Table
		$objPHPExcel->getActiveSheet()->mergeCells('A9:A11');
		$objPHPExcel->getActiveSheet()->mergeCells('B9:B11');
		$objPHPExcel->getActiveSheet()->mergeCells('R9:R11');
		$objPHPExcel->getActiveSheet()->mergeCells('C9:Q9');
		$objPHPExcel->getActiveSheet()->mergeCells('C10:F10');
		$objPHPExcel->getActiveSheet()->mergeCells('H10:Q10');
		$objPHPExcel->getActiveSheet()->mergeCells('G10:G11');
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A9', 'No')
			->setCellValue('B9', 'Poli')
			->setCellValue('C9', 'Golongan Pasien')
			->setCellValue('R9', 'Jumlah');

		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('C10', 'BPJS')
			->setCellValue('G10', 'Jamkesda')
			->setCellValue('H10', 'Swasta');

		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('C11', 'Askes')
			->setCellValue('D11', 'Dinas')
			->setCellValue('E11', 'Mandiri')
			->setCellValue('F11', 'Lain-lain')
			->setCellValue('H11', 'Bringin Life')
			->setCellValue('I11', 'Gandum')
			->setCellValue('J11', 'Indolacto')
			->setCellValue('K11', 'In Health')
			->setCellValue('L11', 'Krebet')
			->setCellValue('M11', 'Molindo')
			->setCellValue('N11', 'Nayaka')
			->setCellValue('O11', 'PG Krebet')
			->setCellValue('P11', 'PT. Cakra/Pindad')
			->setCellValue('Q11', 'PT. KAI');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(false);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(false);

		$objPHPExcel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->getRowDimension('11')->setRowHeight(20);

		$objPHPExcel->getActiveSheet()->getStyle('A9:R11')->applyFromArray(
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
		

		$no = 0;
		$norow = 11;
		$ListSubGol = array( 
				'BPJS' => array('Askes','Dinas','Mandiri','Lain-lain'),
				'Jamkesda' => array('-'),
				'Swasta' => array('Bringin Life','Gandum','Indolacto','In Health','Krebet','Molindo','Nayaka','PG Krebet','PT. Cakra/Pindad','PT. KAI')
			);
		$jumA = 0;$jumB = 0;$jumC = 0;$jumD = 0;$jumE = 0;$jumF = 0;$jumG = 0;$jumH = 0;
		$jumI = 0;$jumJ = 0;$jumK = 0;$jumL = 0;$jumM = 0;$jumN = 0;$jumO = 0;$jumP = 0;

		foreach($arrData as $namaPoli => $dataPoli){
			$no++;
			$norow++;

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$norow, $no)
				->setCellValue('B'.$norow, $namaPoli)				
				->setCellValue('C'.$norow, (isset($dataPoli['BPJS']['Askes']) ? $dataPoli['BPJS']['Askes'] : 0))
				->setCellValue('D'.$norow, (isset($dataPoli['BPJS']['Dinas']) ? $dataPoli['BPJS']['Dinas'] : 0))
				->setCellValue('E'.$norow, (isset($dataPoli['BPJS']['Mandiri']) ? $dataPoli['BPJS']['Mandiri'] : 0))
				->setCellValue('F'.$norow, (isset($dataPoli['BPJS']['Lain-lain']) ? $dataPoli['BPJS']['Lain-lain'] : 0))
				->setCellValue('G'.$norow, (isset($dataPoli['Jamkesda']['-']) ? $dataPoli['Jamkesda']['-'] : 0))
				->setCellValue('H'.$norow, (isset($dataPoli['Swasta']['Bringin Life']) ? $dataPoli['Swasta']['Bringin Life'] : 0))
				->setCellValue('I'.$norow, (isset($dataPoli['Swasta']['Gandum']) ? $dataPoli['Swasta']['Gandum'] : 0))
				->setCellValue('J'.$norow, (isset($dataPoli['Swasta']['Indolacto']) ? $dataPoli['Swasta']['Indolacto'] : 0))
				->setCellValue('K'.$norow, (isset($dataPoli['Swasta']['In Health']) ? $dataPoli['Swasta']['In Health'] : 0))
				->setCellValue('L'.$norow, (isset($dataPoli['Swasta']['Krebet']) ? $dataPoli['Swasta']['Krebet'] : 0))
				->setCellValue('M'.$norow, (isset($dataPoli['Swasta']['Molindo']) ? $dataPoli['Swasta']['Molindo'] : 0))
				->setCellValue('N'.$norow, (isset($dataPoli['Swasta']['Nayaka']) ? $dataPoli['Swasta']['Nayaka'] : 0))
				->setCellValue('O'.$norow, (isset($dataPoli['Swasta']['PG Krebet']) ? $dataPoli['Swasta']['PG Krebet'] : 0))
				->setCellValue('P'.$norow, (isset($dataPoli['Swasta']['PT. Cakra/Pindad']) ? $dataPoli['Swasta']['PT. Cakra/Pindad'] : 0))
				->setCellValue('Q'.$norow, (isset($dataPoli['Swasta']['PT. KAI']) ? $dataPoli['Swasta']['PT. KAI'] : 0))				
				->setCellValue('R'.$norow, (isset($cnt[$namaPoli]) ? $cnt[$namaPoli] : 0));	
				

	/*		$a = range("C","Q");
			foreach($a as $c){
				foreach($ListSubGol as $a => $b){
					for($i=0; $i<COUNT($b); $i++){
						$objPHPExcel->getActiveSheet()->setCellValue($c.$norow, (isset($dataPoli[$a][$b[$i]]) ? $dataPoli[$a][$b[$i]] : 0));
					}
				}
			}
	*/				
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':R'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
			
			$jumA += isset($dataPoli['BPJS']['Askes']) ? $dataPoli['BPJS']['Askes'] : 0;
            $jumB += isset($dataPoli['BPJS']['Dinas']) ? $dataPoli['BPJS']['Dinas'] : 0;
            $jumC += isset($dataPoli['BPJS']['Mandiri']) ? $dataPoli['BPJS']['Mandiri'] : 0;
            $jumD += isset($dataPoli['BPJS']['Lain-lain']) ? $dataPoli['BPJS']['Lain-lain'] : 0;
			$jumE += isset($dataPoli['Jamkesda']['-']) ? $dataPoli['Jamkesda']['-'] : 0;
            $jumF += isset($dataPoli['Swasta']['Bringin Live']) ? $dataPoli['Swasta']['Bringin Live'] : 0;
            $jumG += isset($dataPoli['Swasta']['Gandum']) ? $dataPoli['Swasta']['Gandum'] : 0;
            $jumH += isset($dataPoli['Swasta']['Indolacto']) ? $dataPoli['Swasta']['Indolacto'] : 0;
            $jumI += isset($dataPoli['Swasta']['In Health']) ? $dataPoli['Swasta']['In Health'] : 0;
            $jumJ += isset($dataPoli['Swasta']['Krebet']) ? $dataPoli['Swasta']['Krebet'] : 0;
            $jumK += isset($dataPoli['Swasta']['Molindo']) ? $dataPoli['Swasta']['Molindo'] : 0;
            $jumL += isset($dataPoli['Swasta']['Nayaka']) ? $dataPoli['Swasta']['Nayaka'] : 0;
            $jumM += isset($dataPoli['Swasta']['PG Krebet']) ? $dataPoli['Swasta']['PG Krebet'] : 0;
            $jumN += isset($dataPoli['Swasta']['PT. Cakra/Pindad']) ? $dataPoli['Swasta']['PT. Cakra/Pindad'] : 0;
            $jumO += isset($dataPoli['Swasta']['PT. KAI']) ? $dataPoli['Swasta']['PT. KAI'] : 0;
            $jumP += isset($cnt[$namaPoli]) ? $cnt[$namaPoli] : 0;
		}

		$norow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':B'.$norow);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$norow, 'Total Pasien')
			->setCellValue('C'.$norow, $jumA)
			->setCellValue('D'.$norow, $jumB)
			->setCellValue('E'.$norow, $jumC)
			->setCellValue('F'.$norow, $jumD)
			->setCellValue('G'.$norow, $jumE)
			->setCellValue('H'.$norow, $jumF)
			->setCellValue('I'.$norow, $jumG)
			->setCellValue('J'.$norow, $jumH)
			->setCellValue('K'.$norow, $jumI)
			->setCellValue('L'.$norow, $jumJ)
			->setCellValue('M'.$norow, $jumK)
			->setCellValue('N'.$norow, $jumL)
			->setCellValue('O'.$norow, $jumM)
			->setCellValue('P'.$norow, $jumN)
			->setCellValue('Q'.$norow, $jumO)
			->setCellValue('R'.$norow, $jumP);

		$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':R'.$norow)->applyFromArray(
			array(
				'font'    => array(
					'bold'      => true
				),
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
	//	$filename = "Lap_Rekap_Data_Pasien_(".$nama_bulan." ".$tahun.").".$eks;
		$filename = "Lap_Rekap_Data_Pasien.".$eks;
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//$mode = Excel5 : Ms. Office Excel 2003
		//		  Excel2007 : Ms. Office Excel 2007
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
		$objWriter->save('php://output');
	}
// end =============================== TOP 10 PENYAKIT PASIEN =============================== 

// start ============================= KELUAR MASUK OBAT APOTEK =============================== 
	public function keluarMasukObat($pref='askes')
	{	
		$this->setPref($pref);
		return View::make('report.apotek_keluar_masuk_obat' , 
			array(
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function keluarMasukObat_view($pref='askes')
	{
		$this->setPref($pref);

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$pasien2 = DB::table($this->pref.'lapstok')
			->leftjoin($this->pref.'obat',$this->pref.'obat.kodobat','=',$this->pref.'lapstok.kodobat')
			->leftjoin($this->pref.'jenisobat',$this->pref.'jenisobat.kodejenis','=',$this->pref.'obat.kodejenis')
			->leftjoin($this->pref.'supplier',$this->pref.'supplier.kodesupp','=',$this->pref.'lapstok.dariuntuk')
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal));

		$trx = Input::get('pilihan_transaksi');
		
		if($trx == 1){ //value="1" = Transaksi Obat Masuk
			$pasien = $pasien2->where('noba' , '!=' , '-')->where('noppm' , '=' , '-')->where('nobp' , '=' , '-')
							  ->orderBy('tanggal')->get();
			$subtitle = 'Obat Masuk';
			$from = 'Dari';
		}
		elseif($trx == 2){ //value="2" = Transaksi Obat Keluar
			$pasien = $pasien2->where('noba' , '-')->where('noppm' , '!=' , '-')->where('nobp' , '!=' , '-')
							  ->orderBy('tanggal')->get();
			$subtitle = 'Obat Keluar';
			$from = 'Untuk';
		}
		else{
			$pasien = $pasien2->orderBy('tanggal')->get();
			$subtitle = 'Keluar Masuk Obat';
			$from = 'DariUntuk';
		}

		return View::make('report.apotek_keluar_masuk_obat_view' , 
			array(
				'pasien' => $pasien,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal,
				'title' => $this->title,
				'slug' => $this->slug,
				'trx' => $trx,
				'subtitle' => $subtitle,
				'from' => $from
			)
		);
	}

	public function keluarMasukObat_excel($pref='askes',$mode)
	{
		$this->setPref($pref);
		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');
		$trx = Input::get('pilihan_transaksi');

		$pasien2 = DB::table($this->pref.'lapstok')
			->leftjoin($this->pref.'obat',$this->pref.'obat.kodobat','=',$this->pref.'lapstok.kodobat')
			->leftjoin($this->pref.'jenisobat',$this->pref.'jenisobat.kodejenis','=',$this->pref.'obat.kodejenis')
			->leftjoin($this->pref.'supplier',$this->pref.'supplier.kodesupp','=',$this->pref.'lapstok.dariuntuk');

		if($trx == 1){ //value="1" = Transaksi Obat Masuk
			$pasien = $pasien2->select(['tanggal','noba','namaobat','namajenis','satuan',DB::raw('IFNULL(namasupp,dariuntuk)'),'masuk','sisa'])
							  ->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
							  ->where('noba' , '!=' , '-')->where('noppm' , '=' , '-')->where('nobp' , '=' , '-')
							  ->orderBy('tanggal')->get();
			$title = 'Laporan Obat Masuk Apotek '.$this->title;
			$colnames = array('Tanggal', 'NoBA', 'Nama Obat', 'Jenis Obat', 'Satuan', 'Dari', 'Jumlah Masuk', 'Stok');
			$format = array('E' => '0','F' => '0');
		}
		elseif($trx == 2){ //value="2" = Transaksi Obat Keluar
			$pasien = $pasien2->select(['tanggal','noppm','nobp','namaobat','namajenis','satuan',DB::raw('IFNULL(namasupp,dariuntuk)'),'keluar','sisa'])
							  ->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
							  ->where('noba' , '-')->where('noppm' , '!=' , '-')->where('nobp' , '!=' , '-')
							  ->orderBy('tanggal')->get();
			$title = 'Laporan Obat Keluar Apotek '.$this->title;
			$colnames = array('Tanggal', 'NoPPM', 'NoBP', 'Nama Obat', 'Jenis Obat', 'Satuan', 'Untuk', 'Jumlah Keluar', 'Stok');
			$format = array('E' => '0','F' => '0');
		}
		else{ //Transaksi Obat Keluar dan Masuk
			$pasien = $pasien2->select(['tanggal','noba','noppm','nobp','namaobat','namajenis','satuan',DB::raw('IFNULL(namasupp,dariuntuk)'),'masuk','keluar','sisa'])
							  ->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
							  ->orderBy('tanggal')->get();
			$title = 'Laporan Keluar Masuk Obat Apotek '.$this->title;
			$colnames = array('Tanggal', 'NoBA', 'NoPPM', 'NoBP', 'Nama Obat', 'Jenis Obat', 'Satuan', 'DariUntuk', 'Jumlah Masuk', 'Jumlah Keluar', 'Stok');
			$format = array('E' => '0','F' => '0');
		}

		$summary = 'Jumlah Obat';
		$this->makeExcel($pasien,$title,$colnames,$format,$mode,$dari_tanggal,$sampai_tanggal,$summary);
		
	}
// end =============================== KELUAR MASUK OBAT APOTEK =============================== 

// start ============================= LABA RUGI OBAT APOTEK =============================== 
	public function labaRugiObat($pref='askes')
	{	
		$this->setPref($pref);
		return View::make('report.apotek_laba_rugi_obat' , 
			array(
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function labaRugiObat_view($pref='askes')
	{
		$this->setPref($pref);
		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');

		$jual = DB::table($this->pref.'lapstok')
			->select([
				  '*', 
				  DB::raw('SUM(keluar) as output_sum'),
				  DB::raw('SUM(keluar)*'.$this->pref.'obat.harga as sub_keluar')
			])
			->join($this->pref.'obat',$this->pref.'obat.kodobat','=',$this->pref.'lapstok.kodobat')
			->join($this->pref.'jenisobat',$this->pref.'jenisobat.kodejenis','=',$this->pref.'obat.kodejenis')
			->where('noba' , '-')->where('noppm' , '!=' , '-')->where('nobp' , '!=' , '-')
			->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
			->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
			->orderBy($this->pref.'obat.namaobat')
			->groupBy($this->pref.'lapstok.kodobat')->get();

		$beli = DB::table($this->pref.'lapstok')
			->select([
				  '*', 
				  DB::raw('SUM(masuk) as input_sum'), 
				  DB::raw('SUM(masuk)*'.$this->pref.'obat.hargabeli as sub_masuk')
			])
			->join($this->pref.'obat',$this->pref.'obat.kodobat','=',$this->pref.'lapstok.kodobat')
			->join($this->pref.'jenisobat',$this->pref.'jenisobat.kodejenis','=',$this->pref.'obat.kodejenis')
			->where('noba' , '!=' , '-')->where('noppm' , '=' , '-')->where('nobp' , '=' , '-')
			->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
			->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
			->orderBy($this->pref.'obat.namaobat')
			->groupBy($this->pref.'lapstok.kodobat')->get();
		
		return View::make('report.apotek_laba_rugi_obat_view' , 
			array(
				'jual' => $jual,
				'beli' => $beli,
				'nama_bulan' => $this->namaBulan($bulan),
				'bulan' => $bulan,
				'tahun' => $tahun,
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function labaRugiObat_excel($pref='askes',$mode)
	{
		$this->setPref($pref);
		$bulan = Input::get('bulan');
		$nama_bulan = $this->namaBulan($bulan);
		$tahun = Input::get('tahun');

		$jual = DB::table($this->pref.'lapstok')
			->join($this->pref.'obat',$this->pref.'obat.kodobat','=',$this->pref.'lapstok.kodobat')
			->join($this->pref.'jenisobat',$this->pref.'jenisobat.kodejenis','=',$this->pref.'obat.kodejenis')
			->select([
				  'namaobat','namajenis','satuan', 
				  DB::raw('SUM(keluar) as output_sum'),
				  'harga',
				  DB::raw('SUM(keluar)*'.$this->pref.'obat.harga as sub_keluar')
			])
			->where('noba' , '-')->where('noppm' , '!=' , '-')->where('nobp' , '!=' , '-')
			->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
			->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
			->orderBy($this->pref.'obat.namaobat')
			->groupBy($this->pref.'lapstok.kodobat')->get();

		$beli = DB::table($this->pref.'lapstok')
			->join($this->pref.'obat',$this->pref.'obat.kodobat','=',$this->pref.'lapstok.kodobat')
			->join($this->pref.'jenisobat',$this->pref.'jenisobat.kodejenis','=',$this->pref.'obat.kodejenis')
			->select([
				  'namaobat','namajenis','satuan', 
				  DB::raw('SUM(masuk) as input_sum'),
				  'hargabeli',
				  DB::raw('SUM(masuk)*'.$this->pref.'obat.hargabeli as sub_masuk')
			])
			->where('noba' , '!=' , '-')->where('noppm' , '=' , '-')->where('nobp' , '=' , '-')
			->where(DB::raw('YEAR(tanggal)'), '=', $tahun)
			->where(DB::raw('MONTH(tanggal)'), '=', $bulan)
			->orderBy($this->pref.'obat.namaobat')
			->groupBy($this->pref.'lapstok.kodobat')->get();
		
		$total_keluar = 0;
		$total_masuk = 0;
		foreach($jual as $p){$total_keluar = $total_keluar + $p->sub_keluar;}
		foreach($beli as $p){$total_masuk = $total_masuk + $p->sub_masuk;}
		$total_semua = number_format($total_keluar-$total_masuk);
		
		$colnamesJual = array('Nama Obat', 'Jenis Obat', 'Satuan', 'Jumlah', 'Harga Jual', 'Total');
		$colnamesBeli = array('Nama Obat', 'Jenis Obat', 'Satuan', 'Jumlah ', 'Harga Beli', 'Total');
		
		$title = 'Laporan Laba Rugi Obat Apotek '.$this->title;
		$format = array('E' => '0','F' => '0');
		$summary = 'LABA BULAN '.$nama_bulan.' '.$tahun;
	//	$this->makeExcel($pasien,$title,$colnames,$format,$mode,$bulan,$tahun,$summary);
	//public function makeExcel($data,$title,$colnames,$format,$mode,$month,$year,$summary){
		//count object of $data to determine the length of cells and first table
		if($bulan==''){
			$first_rowJual = 8; //start the data
			$for_rowJual = count($jual)+8;
			$first_rowBeli = 8 + $for_rowBeli; //start the data
			$for_rowBeli = $for_rowJual+count($beli)+3;
			$nama_file = $title;
		}
		else {
			$first_rowJual = 10; //start the data
			$for_rowJual = count($jual)+10;
			$first_rowBeli = $for_rowJual+count($beli)+2; //start the data
			$for_rowBeli = $first_rowBeli+count($beli);
			$nama_file = $title.' ('.$nama_bulan.' '.$tahun.')';
		}
		//convert object into array
		$dataJual = array_map(function($object){ return (array) $object; }, $jual);
		$dataBeli = array_map(function($object){ return (array) $object; }, $beli);
		//count the number of data header
		//number of columns => $colnamesJual = $colnamesBeli
		$jumlah = count($colnamesJual)+1;
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
		}
	/*	
		var_dump($dataJual); echo'<br />';
		var_dump($dataBeli); echo'<br />';
		var_dump($first_rowJual); echo'<br />';
		var_dump($for_rowJual); echo'<br />';
		var_dump($first_rowBeli); echo'<br />';
		var_dump($for_rowBeli); echo'<br />';
		var_dump($sel); echo'<br />';
		var_dump($title); echo'<br />';
		var_dump($colnamesJual); echo'<br />';
		var_dump($colnamesBeli); echo'<br />';
		var_dump($format); echo'<br />';
		var_dump($nama_bulan); echo'<br />';
		var_dump($tahun); echo'<br />';
		var_dump($summary); echo'<br />';
	*/	
		//start creating the file
		$buat = Excel::create($nama_file, function ($excel) use($dataJual,$dataBeli,$for_rowJual,$first_rowJual,$for_rowBeli,$first_rowBeli,$sel,$title,$colnamesJual,$colnamesBeli,$format,$nama_bulan,$tahun,$summary,$total_keluar,$total_masuk,$total_semua){
			$excel->sheet('Sheet1', function ($sheet) use($dataJual,$dataBeli,$for_rowJual,$first_rowJual,$for_rowBeli,$first_rowBeli,$sel,$title,$colnamesJual,$colnamesBeli,$format,$nama_bulan,$tahun,$summary,$total_keluar,$total_masuk,$total_semua){
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
				if($nama_bulan==''){
					// cells manipulation methods on row 7
					$sheet->row(7, array(''));
				}
				else{
					// cells manipulation methods on row 7
					$sheet->mergeCells('A7:'.$sel.'7');
					$sheet->row(7, function ($row) {
						$row->setFontFamily('Calibri');
						$row->setFontSize(11);
					});
					$sheet->row(7, array('Bulan : '.$nama_bulan));
					
					// cells manipulation methods on row 8
					$sheet->mergeCells('A8:'.$sel.'8');
					$sheet->row(8, function ($row) {
						$row->setFontFamily('Calibri');
						$row->setFontSize(11);
					});
					$sheet->row(8, array('Tahun : '.$tahun));
					
					// cells manipulation methods on row 9
					$sheet->row(9, array(''));
				}
				
				// setting column names for data (data header or table header)
				//$sheet->appendRow(array_keys($users[0])); //to make default data header is from query
				$no = array('No');
				$sheet->row($first_rowJual, array_merge($no, $colnamesJual));
				// Set height for a single row
				$sheet->setHeight($first_rowJual, 20);
				// set the last row cell manipulation (before data or table header)
				$sheet->row($first_rowJual, function ($row) {
					$row->setFontWeight('bold');
					$row->setFontFamily('Calibri');
					$row->setFontSize(11);
				});
				$sheet->cells('A'.$first_rowJual.':'.$sel.$first_rowJual, function($cells) {
					$cells->setAlignment('center');
					$cells->setValignment('center');
					$cells->setBackground('#cccccc');
				});
				
				// display data as next rows
				$num = 0;
				foreach ($dataJual as $d) {
					$num++;
					$no = array($num);
					$sheet->appendRow(array_merge($no, $d));
				}
				
				//set cell of summary data
				$sheet->mergeCells('A'.($for_rowJual+1).':'.$sel.($for_rowJual+1));
				$sheet->setHeight(($for_rowJual+1), 20);
				$sheet->row(($for_rowJual+1), function ($row) {
					$row->setFontWeight('bold');
				});
				$sheet->row(($for_rowJual+1), array('Jumlah Total Penjualan : '.number_format($total_keluar)));
				$sheet->cells('A'.($for_rowJual+1).':'.$sel.($for_rowJual+1), function($cells) {
					$cells->setValignment('center');
					$cells->setBackground('#cccccc');
				}); 

				//beli
				$no2 = array('No');
				$sheet->row(($first_rowBeli), array_merge($no2, $colnamesBeli));
				// Set height for a single row
				$sheet->setHeight(($first_rowBeli), 20);
				// set the last row cell manipulation (before data or table header)
				$sheet->row(($first_rowBeli), function ($row) {
					$row->setFontWeight('bold');
					$row->setFontFamily('Calibri');
					$row->setFontSize(11);
				});
				$sheet->cells('A'.($first_rowBeli).':'.$sel.($first_rowBeli), function($cells) {
					$cells->setAlignment('center');
					$cells->setValignment('center');
					$cells->setBackground('#cccccc');
				});
				
				// display data as next rows
				$num = 0;
				foreach ($dataBeli as $d) {
					$num++;
					$no2 = array($num);
					$sheet->appendRow(array_merge($no2, $d));
				}
				
				//set cell of summary data
				$sheet->mergeCells('A'.($for_rowBeli+1).':'.$sel.($for_rowBeli+1));
				$sheet->setHeight(($for_rowBeli+1), 20);
				$sheet->row(($for_rowBeli+1), function ($row) {
					$row->setFontWeight('bold');
				});
				$sheet->row(($for_rowBeli+1), array('Jumlah Total Pembelian : '.number_format($total_masuk)));
				$sheet->cells('A'.($for_rowBeli+1).':'.$sel.($for_rowBeli+1), function($cells) {
					$cells->setValignment('center');
					$cells->setBackground('#cccccc');
				}); 
				
				//set the border of table data
				$sheet->setBorder('A'.$first_rowJual.':'.$sel.($for_rowJual+1), 'thin');
				//set the cell manipulation of table data
				$sheet->cells('A'.$first_rowJual.':'.$sel.($for_rowJual+1), function($cells) {
					$cells->setFontFamily('Calibri');
				});

				//set the border of table data
				$sheet->setBorder('A'.$first_rowBeli.':'.$sel.($for_rowBeli+1), 'thin');
				//set the cell manipulation of table data
				$sheet->cells('A'.$first_rowBeli.':'.$sel.($for_rowBeli+1), function($cells) {
					$cells->setFontFamily('Calibri');
				}); 
				
				//Last Cell
				$sheet->mergeCells('A'.($for_rowBeli+3).':'.$sel.($for_rowBeli+3));
				$sheet->setHeight(($for_rowBeli+3), 20);
				$sheet->row(($for_rowBeli+3), function ($row) {
					$row->setFontWeight('bold');
				});
				$sheet->row(($for_rowBeli+3), array('LABA BULAN '.$nama_bulan.' '.$tahun));
				$sheet->cells('A'.($for_rowBeli+3).':'.$sel.($for_rowBeli+3), function($cells) {
					$cells->setValignment('center');
				}); 
				//set the border of table data
				$sheet->setBorder('A'.($for_rowBeli+3).':'.$sel.($for_rowBeli+3), 'thin');
				//set the cell manipulation of table data
				$sheet->cells('A'.($for_rowBeli+3).':'.$sel.($for_rowBeli+3), function($cells) {
					$cells->setFontFamily('Calibri');
				}); 
				
				$sheet->mergeCells('A'.($for_rowBeli+4).':'.$sel.($for_rowBeli+4));
				$sheet->setHeight(($for_rowBeli+4), 20);
				$sheet->row(($for_rowBeli+4), function ($row) {
					$row->setFontWeight('bold');
				});
				$sheet->row(($for_rowBeli+4), array('PENJUALAN - PEMBELIAN : '.($total_semua)));
				$sheet->cells('A'.($for_rowBeli+4).':'.$sel.($for_rowBeli+4), function($cells) {
					$cells->setValignment('center');
					$cells->setBackground('#cccccc');
				}); 
				//set the border of table data
				$sheet->setBorder('A'.($for_rowBeli+4).':'.$sel.($for_rowBeli+4), 'thin');
				//set the cell manipulation of table data
				$sheet->cells('A'.($for_rowBeli+4).':'.$sel.($for_rowBeli+4), function($cells) {
					$cells->setFontFamily('Calibri');
				}); 
			});
			/*
			 if u want more sheet
			$excel->sheet('Second sheet', function($sheet) {
				....
			});*/
			
		});
		
		return $buat->export($mode);
		 //->export('xls'); //office < 2007
		 //->download('xls');
		 //->export('xlsx');	office 2007
		 //->download('xlsx');
		 //->export('csv');
		 //->download('csv');
	}
// end =============================== LABA RUGI OBAT APOTEK =============================== 

//start ============================ RINCIAN OBAT KELUAR ==================================

	public function rincianKeluarObat($pref = 'askes'){
		$this->setPref($pref);
		return View::make('report.apotek_rincian_keluar_obat' , 
			array(
				'title' => $this->title,
				'slug' => $this->slug,
				'obat' => DB::table($this->pref.'obat')->get()			
			)
		);
	}

	public function rincianKeluarObat_view($pref = 'askes'){
		$this->setPref($pref);

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$kodobat = Input::get('nama_obat');

		$pasien2 = DB::table($this->pref.'lapstok')
			->join($this->pref.'obat',$this->pref.'obat.kodobat','=',$this->pref.'lapstok.kodobat')
			->join($this->pref.'jenisobat',$this->pref.'jenisobat.kodejenis','=',$this->pref.'obat.kodejenis')
			->leftjoin($this->pref.'supplier',$this->pref.'supplier.kodesupp','=',$this->pref.'lapstok.dariuntuk')
			->where($this->pref.'obat.kodobat' , $kodobat)
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal));

		$obat = DB::table($this->pref.'obat')->where('kodobat',$kodobat)->first();

		$trx = Input::get('pilihan_transaksi');
		
		
		$pasien = $pasien2->where('noba' , '-')->where('noppm' , '!=' , '-')->where('nobp' , '!=' , '-')
							  ->orderBy('tanggal')->get();
		$subtitle = 'Rincian Obat Keluar';
		$from = 'Untuk';

		return View::make('report.apotek_rincian_keluar_obat_view' , 
			array(
				'pasien' => $pasien,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal,
				'title' => $this->title,
				'slug' => $this->slug,
				'trx' => $trx,
				'subtitle' => $subtitle,
				'from' => $from,
				'obat'	=> $obat

			)
		);
	}

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

// start ============================= EKSPOR KE EXCEL =============================== 
/*
	Function Name 	: makeExcel
	Descr.			: Export data into Excel
	Parameter		: $data		: object (The result of query)
					  $title	: string (Kind of report)
					  $colnames	: array	 (Column names of data/ data header)
					  $format	: array	 (Cells format in Excel)
					  $mode		: string (Type of Excel(2003/2007/csv))
					  $summary	: string (Label of summary)
	Return			: File (Excel)
	Created by		: nanang
	Updated at		: March 12th, 2015 11:00
*/
	public function makeExcel($data,$title,$colnames,$format,$mode,$datestart,$dateend,$summary){
		//count object of $data to determine the length of cells and first table
		if($datestart==''){
			$for_row = count($data)+8;
			$first_row = 8; //start the data
			$nama_file = $title;
		}
		elseif($datestart!='' && $dateend==''){
			$for_row = count($data)+10;
			$first_row = 10; //start the data
			$nama_file = $title.' (Per Tanggal : '.$datestart.')';
		}
		else {
			$for_row = count($data)+10;
			$first_row = 10; //start the data
			$nama_file = $title.' ('.$datestart.' - '.$dateend.')';
		}
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
		$buat = Excel::create($nama_file, function ($excel) use($data,$for_row,$first_row,$sel,$title,$colnames,$format,$datestart,$dateend,$summary){
			$excel->sheet('Sheet1', function ($sheet) use($data,$for_row,$first_row,$sel,$title,$colnames,$format,$datestart,$dateend,$summary){
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
					$row->setFontSize(12);
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
				if($datestart==''){
					// cells manipulation methods on row 7
					$sheet->row(7, array(''));
				}
				elseif(strpos($dateend,'Tahun') !== false){
					// cells manipulation methods on row 7
					$sheet->mergeCells('A7:'.$sel.'7');
					$sheet->row(7, function ($row) {
						$row->setFontFamily('Calibri');
						$row->setFontSize(11);
					});
					$sheet->row(7, array($datestart));
					
					// cells manipulation methods on row 8
					$sheet->mergeCells('A8:'.$sel.'8');
					$sheet->row(8, function ($row) {
						$row->setFontFamily('Calibri');
						$row->setFontSize(11);
					});
					$sheet->row(8, array($dateend));
					
					// cells manipulation methods on row 9
					$sheet->row(9, array(''));
				}
				elseif($datestart!='' && $dateend==''){
					// cells manipulation methods on row 7
					$sheet->mergeCells('A7:'.$sel.'7');
					$sheet->row(7, function ($row) {
						$row->setFontFamily('Calibri');
						$row->setFontSize(11);
					});
					$sheet->row(7, array('Per Tanggal : '.$datestart));
					
					// cells manipulation methods on row 8
					$sheet->row(8, array(''));
					
					// cells manipulation methods on row 9
					$sheet->row(9, array(''));
				}
				else{
					// cells manipulation methods on row 7
					$sheet->mergeCells('A7:'.$sel.'7');
					$sheet->row(7, function ($row) {
						$row->setFontFamily('Calibri');
						$row->setFontSize(11);
					});
					$sheet->row(7, array('Dari Tanggal : '.$datestart));
					
					// cells manipulation methods on row 8
					$sheet->mergeCells('A8:'.$sel.'8');
					$sheet->row(8, function ($row) {
						$row->setFontFamily('Calibri');
						$row->setFontSize(11);
					});
					$sheet->row(8, array('Sampai Tanggal : '.$dateend));
					
					// cells manipulation methods on row 9
					$sheet->row(9, array(''));
				}
				
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

// start ============================= OBAT KELUAR APOTEK =============================== 
	public function obatKeluar()
	{	
		return View::make('report.obat_keluar_apotek');
	}

	public function obatKeluar_view()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		//$pasien = DB::table('tbdetailobat')->leftjoin('tbpasien','tbpasien.NoRM','=','tbdetailobat.NoRM')
		//	->select([DB::raw('SUM(TotalHarga) as SubTotal'),'tbdetailobat.NoRM','Nama','TanggalMasuk','JenisRawat','GolPasien','NoResep','TanggalResep'])
		//	->whereBetween('TanggalMasuk', array($dari_tanggal, $sampai_tanggal))->groupby('NoResep')->orderBy('TanggalMasuk')->get();
/*		
		$pasien = DB::table('tbdetailobat')
			->leftjoin('tbpasien','tbpasien.NoRM','=','tbdetailobat.NoRM')
			->select([
				DB::raw("case when tbdetailobat.NoResep <> @noresep then tbdetailobat.NoRM else '' end as NoRM"),
				DB::raw("case when tbdetailobat.NoResep <> @noresep then Nama else '' end as Nama"),
				DB::raw("case when tbdetailobat.NoResep <> @noresep then TanggalMasuk else '' end as TanggalMasuk"),
				DB::raw("case when tbdetailobat.NoResep <> @noresep then JenisRawat else '' end as JenisRawat"),
				DB::raw("case when tbdetailobat.NoResep <> @noresep then GolPasien else '' end as GolPasien"),
				DB::raw("case when tbdetailobat.NoResep <> @noresep then NoResep else '' end as NoResep"),
				DB::raw("case when tbdetailobat.NoResep <> @noresep then TanggalResep else '' end as TanggalResep"),
			 	'NamaObat','Harga','Jumlah','TotalHarga'])
			->whereBetween('TanggalMasuk', array($dari_tanggal, $sampai_tanggal))->orderBy('TanggalResep','NoResep')->get();
			//var_dump($pasien);
		foreach($pasien as $pas => $ien){
			echo $ien->NoRM.' '.$ien->Nama.' '.$ien->TanggalMasuk.' '.$ien->JenisRawat.' '.$ien->GolPasien.' '.$ien->NoResep.' '.$ien->TanggalResep.' '.$ien->NamaObat.' '.$ien->Harga.' '.$ien->Jumlah.' '.$ien->TotalHarga.'<br />';
		}
	*/	
	
		$pasien = DB::table('tbdetailobat')
			->leftjoin('tbpasien','tbpasien.NoRM','=','tbdetailobat.NoRM')
			->select(['tbdetailobat.NoRM','Nama','TanggalMasuk','JenisRawat','GolPasien','NoResep','TanggalResep','NamaObat','Harga','Jumlah','TotalHarga'])
			->whereBetween('TanggalResep', array($dari_tanggal, $sampai_tanggal))
			->orderBy('TanggalResep','asc')
			->orderBy('tbdetailobat.NoRM','asc')
			->orderBy('NoResep','asc')->get();
  		
		$nores = '';
		$sub = '';
		$sub2 = '';
		$sub3 = '';
		$sub4 = '';
		end($pasien);
		$lastElementKey = key($pasien)+1;;
		$no = 0;
		$num = 0;
		$nums = '';
		
		return View::make('report.obat_keluar_apotek_view' , 
			array(
				'pasien' => $pasien,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal,
				'dari_tanggal2' => Input::get('dari_tanggal'),
				'sampai_tanggal2' => Input::get('sampai_tanggal'),
				'nores' => $nores,
				'sub' => $sub,
				'sub2' => $sub2,
				'sub4' => $sub4,
				'lastElementKey' => $lastElementKey,
				'no' => $no,
				'num' => $num
			)
		);
	}

	public function obatKeluar_excel($mode)
	{

		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');

		$date = DateTime::createFromFormat('Y-m-d', $dari_tanggal);
		$dari_tanggal2 = $date->format('d/m/Y');

		$date = DateTime::createFromFormat('Y-m-d', $sampai_tanggal);
		$sampai_tanggal2 = $date->format('d/m/Y');
		
		$pasien = DB::table('tbdetailobat')
			->leftjoin('tbpasien','tbpasien.NoRM','=','tbdetailobat.NoRM')
			->select(['tbdetailobat.NoRM','Nama','TanggalMasuk','JenisRawat','GolPasien','NoResep','TanggalResep','NamaObat','Harga','Jumlah','TotalHarga'])
			->whereBetween('TanggalResep', array($dari_tanggal, $sampai_tanggal))
			->orderBy('TanggalResep','asc')
			->orderBy('tbdetailobat.NoRM','asc')
			->orderBy('NoResep','asc')->get();
  		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->getProtection()->setPassword('datakreatif');
		$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be enabled in order to enable any of the following!
		$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(10, 10);

		// Merge cells
		$objPHPExcel->getActiveSheet()->mergeCells('A1:L1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '');

		$objPHPExcel->getActiveSheet()->mergeCells('A3:L3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:L4');
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);

		$objPHPExcel->getActiveSheet()->mergeCells('A6:L6');
		$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Laporan Obat Keluar Apotek');
		$objPHPExcel->getActiveSheet()->mergeCells('A7:L7');
		$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Dari Tanggal : '.$dari_tanggal2);
		$objPHPExcel->getActiveSheet()->mergeCells('A8:L8');
		$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Sampai Tanggal : '.$sampai_tanggal2);
		$objPHPExcel->getActiveSheet()->getStyle('A6:L8')->getFont()->setSize(12);

		// Header Table
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A10', 'No')
			->setCellValue('B10', 'No RM')
			->setCellValue('C10', 'Nama')
			->setCellValue('D10', 'Tgl. Masuk')
			->setCellValue('E10', 'Jenis Rawat')
			->setCellValue('F10', 'Gol. Pasien')
			->setCellValue('G10', 'No Resep')
			->setCellValue('H10', 'Tgl. Resep')
			->setCellValue('I10', 'Nama Obat')
			->setCellValue('J10', 'Harga')
			->setCellValue('K10', 'Satuan')
			->setCellValue('L10', 'Sub Total');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);

		$objPHPExcel->getActiveSheet()->getStyle('A10:L10')->applyFromArray(
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
		
		// Protect cells (need a password in any editing worksheet.
		// Needs to be set to true in order to enable any worksheet protection!
		//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		//$objPHPExcel->getActiveSheet()->protectCells('A3:E13', 'PHPExcel');
		$nores = '';
		$sub = '';
		$sub2 = '';
		$sub3 = '';
		$sub4 = '';
		end($pasien);
		$lastElementKey = key($pasien)+1;;
		$no = 0;
		$num = 0;
		$nums = '';
		$norow = 10; //starting the data row

		foreach($pasien as $pas => $ien){
		$no++;
		$norow++;
			if($ien->NoResep==$nores){
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':H'.$norow);
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, '')
					->setCellValue('I'.$norow, $ien->NamaObat)
					->setCellValue('J'.$norow, $ien->Harga)
					->setCellValue('K'.$norow, $ien->Jumlah)
					->setCellValue('L'.$norow, $ien->TotalHarga);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
					array(
						'borders' => array(
							'allborders'     => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);

				$sub2 += $sub;
				$sub4 = $sub2 + $ien->TotalHarga;
				if($nums!=$num){
					$norow = $norow+1;
					$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':K'.$norow);
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$norow, 'Total')
						->setCellValue('L'.$norow, $sub4);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
						array(
							'borders' => array(
								'allborders'     => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
						)
					);
				}
			}
			else{
				$sub2 += $sub;
				if($nores != ''){
					$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':K'.$norow);
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$norow, 'Total')
						->setCellValue('L'.$norow, $sub2);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
						array(
							'borders' => array(
								'allborders'     => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
						)
					);
					$norow = $norow+1;
					$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':L'.$norow);
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$norow, '');
					$norow = $norow+1;
				}
				$sub = '';
				$sub2 = '';
				$num++;
				
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, $num)
					->setCellValue('B'.$norow, $ien->NoRM)
					->setCellValue('C'.$norow, $ien->Nama)
					->setCellValue('D'.$norow, $ien->TanggalMasuk)
					->setCellValue('E'.$norow, $ien->JenisRawat)
					->setCellValue('F'.$norow, $ien->GolPasien)
					->setCellValue('G'.$norow, $ien->NoResep)
					->setCellValue('H'.$norow, $ien->TanggalResep)
					->setCellValue('I'.$norow, $ien->NamaObat)
					->setCellValue('J'.$norow, $ien->Harga)
					->setCellValue('K'.$norow, $ien->Jumlah)
					->setCellValue('L'.$norow, $ien->TotalHarga);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
						array(
							'borders' => array(
								'allborders'     => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
						)
					);
			}
			$nums = $num;
			$nores = $ien->NoResep;
			$sub = $ien->TotalHarga;
			if($lastElementKey == $no){
				$norow = $norow+1;
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':K'.$norow);
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$norow, 'Total')
					->setCellValue('L'.$norow, $sub + $sub2);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
					array(
						'borders' => array(
							'allborders'     => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);
			}
			
		}
		
		$norow = $norow+2;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':L'.$norow);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$norow, 'Jumlah Transaksi : '.$num);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
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
		$filename = "Lap_Obat_Keluar_(".$dari_tanggal2."-".$sampai_tanggal2.").".$eks;
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//$mode = Excel5 : Ms. Office Excel 2003
		//		  Excel2007 : Ms. Office Excel 2007
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
		$objWriter->save('php://output');
	}

// end =============================== OBAT KELUAR APOTEK =============================== 

// start ============================= RINCIAN RAWAT INAP =============================== 
	public function rincian_rawat_inap()
	{	
		$user = Auth::user();
        $ruangan = DB::table('tbruangan')->groupBy('NamaRuangan')->get();
		return View::make('report.bulan_inap.rincian_rawat_inap' , array('ruangan' => $ruangan));
	}


	public function rincian_rawat_inap_view(){

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur'))
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
			->orderBy('tbpasieninap.Tanggal')->get();

			$k_ruangan = "";
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur'))
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
			->orderBy('tbpasieninap.Tanggal')->orderBy('tbpasien.Nama')->get();

			$k_ruangan = " RUANGAN ".strtoupper($ruangan);
		}

		return View::make('report.bulan_inap.rincian_rawat_inap_view' , 
			array(
				'ruangan' => $ruangan,
				'dari_tanggal' => $dari_tanggal,
				'sampai_tanggal' => $sampai_tanggal,
				'parent' => url('report/bulan_inap/rincian_rawat_inap'),
				'pagetitle' => 'Data Pasien Rawat Inap', 
				'title' => array(
							array('text' => $this->rs_title ,'align' => 'left'),
							array('text' => ''),
							array('text' => 'DATA PASIEN INAP '.$k_ruangan.' RUMAH SAKIT' , 'align' => 'center'),
							array('text' => 'Tanggal : '.$dari_tanggal.' S/D '.$sampai_tanggal , 'align' => 'center')
				),
				'table' => array('class' => 'headpadding10 report'),
				'thead'	=> array(
							array(
								array( 'text' => 'No Urut'),
								array( 'text' => 'No RM'),
								array( 'text' => 'Nama'),
								array( 'text' => 'Umur'),
								array( 'text' => 'Agama'),
								array( 'text' => 'Jenis Kelamin'),
								array( 'text' => 'TGL MRS'),
								array( 'text' => 'Gol'),
								array( 'text' => 'Sub Gol'),
								array( 'text' => 'Dirawat di ruang'),
								array( 'text' => 'Tgl KRS'),
								array( 'text' => 'Alasan Pulang'),
								array( 'text' => 'Keterangan Lain')
							)
				),
				'tbody' => array( 
								array( 'content' => '__NO__'),
								array( 'content' => 'NoRM'),
								array( 'content' => 'Nama'),
								array( 'content' => 'umur'),
								array( 'content' => 'Agama'),
								array( 'content' => 'Jkel'),
								array( 'content' => 'Tanggal'),
								array( 'content' => 'GolPasien'),
								array( 'content' => 'SubGolPasien'),
								array( 'content' => 'Ruangan'),
								array( 'content' => 'TanggalPulang', 'default' => '-' , 'where' => '0000-00-00'),
								array( 'content' => 'CaraPulang'),
								array( 'content' => '-' ,'type' => 'static')
				),
				'data' => $pasien,
				'total' => 'Total Pasien'
			)
		);
	}

	public function rincian_rawat_inap_excel($mode)
	{
		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');

		$date = DateTime::createFromFormat('Y-m-d', $dari_tanggal);
		$dari_tanggal2 = $date->format('d/m/Y');

		$date = DateTime::createFromFormat('Y-m-d', $sampai_tanggal);
		$sampai_tanggal2 = $date->format('d/m/Y');

		$ruangan = Input::get('ruangan');

		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur'))
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
			->orderBy('tbpasieninap.Tanggal')->get();

			$k_ruangan = "";
			$l_ruangan = "";
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur'))
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
			->orderBy('tbpasieninap.Tanggal')->orderBy('tbpasien.Nama')->get();

			$k_ruangan = " RUANGAN ".strtoupper($ruangan);
			$l_ruangan = "Ruangan_".ucfirst($ruangan)."_";
		}
  		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		//$objPHPExcel->getActiveSheet()->getProtection()->setPassword('datakreatif');
		//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be true in order to enable any of the following!
		//$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
		//$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
		//$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(10, 10);

		// Merge cells
		$objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '');

		$objPHPExcel->getActiveSheet()->mergeCells('A3:M3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:M4');
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);

		$objPHPExcel->getActiveSheet()->mergeCells('A6:M6');
		$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'DATA PASIEN INAP '.$k_ruangan);
		$objPHPExcel->getActiveSheet()->mergeCells('A7:M7');
		$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Dari Tanggal : '.$dari_tanggal2);
		$objPHPExcel->getActiveSheet()->mergeCells('A8:M8');
		$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Sampai Tanggal : '.$sampai_tanggal2);
		$objPHPExcel->getActiveSheet()->getStyle('A6:M8')->getFont()->setSize(12);

		// Header Table
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A10', 'No Urut')
			->setCellValue('B10', 'No RM')
			->setCellValue('C10', 'Nama')
			->setCellValue('D10', 'Umur')
			->setCellValue('E10', 'Agama')
			->setCellValue('F10', 'Jenis Kelamin')
			->setCellValue('G10', 'TGL MRS')
			->setCellValue('H10', 'Golongan')
			->setCellValue('I10', 'Sub Golongan')
			->setCellValue('J10', 'Dirawat di ruang')
			->setCellValue('K10', 'Tanggal KRS')
			->setCellValue('L10', 'Alasan Pulang')
			->setCellValue('M10', 'Keterangan Lain');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);

		$objPHPExcel->getActiveSheet()->getStyle('A10:M10')->applyFromArray(
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
		
		$no = 0;
		$norow = 10; //starting the data row

		foreach($pasien as $pas => $ien){
			$no++;
			$norow++;
	
			$tglpulang = $ien->TanggalPulang == '0000-00-00' ? '-' : $ien->TanggalPulang;
			
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$norow, $no)
				->setCellValue('B'.$norow, $ien->NoRM)
				->setCellValue('C'.$norow, $ien->Nama)
				->setCellValue('D'.$norow, $ien->umur)
				->setCellValue('E'.$norow, $ien->Agama)
				->setCellValue('F'.$norow, $ien->Jkel)
				->setCellValue('G'.$norow, $ien->Tanggal)
				->setCellValue('H'.$norow, $ien->GolPasien)
				->setCellValue('I'.$norow, $ien->SubGolPasien)
				->setCellValue('J'.$norow, $ien->Ruangan)
				->setCellValue('K'.$norow, $tglpulang)
				->setCellValue('L'.$norow, $ien->CaraPulang)
				->setCellValue('M'.$norow, '-');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':M'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
		}
		
		$norow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':M'.$norow);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$norow, 'Jumlah Pasien : '.$no);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
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
		$filename = "Lap_Data_Pasien_Inap_".$l_ruangan."(".$dari_tanggal2."-".$sampai_tanggal2.").".$eks;
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//$mode = Excel5 : Ms. Office Excel 2003
		//		  Excel2007 : Ms. Office Excel 2007
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
		$objWriter->save('php://output');
	}
// end =============================== RINCIAN RAWAT JALAN =============================== 

// start ============================= REKAP GOLONGAN RAWAT INAP =============================== 
	public function rekap_golongan($jenis)
	{	
		$user = Auth::user();
        $ruangan = DB::table('tbruangan')->groupBy('NamaRuangan')->get();
        $poli = DB::table('tbpoli')->orderby('NamaPoli')->get();

        if($jenis == 'rawat_inap'){
        	$title = 'Rawat Inap';
        }
        else if($jenis == 'ugd'){
        	$title = 'UGD';
        }
        else{
        	$title = 'Rawat Jalan';
        }
		return View::make('report.tanggal_inap.rekap_golongan',
					 array( 
					 		'ruangan' => $ruangan,
					 		'poli' => $poli,
					 		'jenis' => $jenis,
							'title' => 'Rekap Golongan '.$title,
		));
	}


	public function rekap_golongan_view(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$jenis_pelayanan = Input::get('jenis_pelayanan');
		$ruangan = Input::get('ruangan');
		$poli = Input::get('poli');
		
		if($jenis_pelayanan == 'rawat_inap'){
			if($ruangan == "all"){
				$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
				->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}
			else{
				$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
				->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();

				$k_ruangan = ' RUANGAN '.strtoupper($ruangan);
			}

			$title = 'RAWAT INAP';
		}
		else if($jenis_pelayanan == 'rawat_jalan'){
			if($poli == "all"){
				$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}
			else{
				$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();

				$nama = DB::table('tbpoli')->where('IdPoli',$poli)->first();
				$k_ruangan = ' POLI '.strtoupper($nama->NamaPoli);
			}

			$title = 'RAWAT JALAN';
		}
		else{
			if($poli == "all"){
				$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}
			else{
				$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}

			$title = "UGD";
		}

		return View::make('report.tanggal_inap.rekap_golongan_view' , 
				array(
					'pasien' => $pasien,
					'ruangan' => $ruangan,
					'poli' => $poli,
					'jenis_pelayanan' => $jenis_pelayanan,
					'dari_tanggal' => $dari_tanggal,
					'sampai_tanggal' => $sampai_tanggal,
					'parent' => url('report/rekap_golongan/'.$jenis_pelayanan),
					'title' => 'REKAP GOLONGAN '.$title,
					'subtitle' => 'LAPORAN REKAPITULASI GOLONGAN PASIEN '.$title.' <br />DARI TANGGAL '.Input::get('dari_tanggal').' S/D '.Input::get('sampai_tanggal').$k_ruangan
				)
			);
	} 
	
	public function rekap_golongan_excel($mode)
	{

		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');

		$date = DateTime::createFromFormat('Y-m-d', $dari_tanggal);
		$dari_tanggal2 = $date->format('d/m/Y');

		$date = DateTime::createFromFormat('Y-m-d', $sampai_tanggal);
		$sampai_tanggal2 = $date->format('d/m/Y');

		$jenis_pelayanan = Input::get('jenis_pelayanan');
		$ruangan = Input::get('ruangan');
		$poli = Input::get('poli');
		
		if($jenis_pelayanan == 'rawat_inap'){
			if($ruangan == "all"){
				$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
				->orderBy('IdRuangan')->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}
			else{
				$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
				->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();

				$k_ruangan = ' RUANGAN '.strtoupper($ruangan);
			}

			$title = 'RAWAT INAP';
		}
		else if($jenis_pelayanan == 'rawat_jalan'){
			if($poli == "all"){
				$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}
			else{
				$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasien.NoRM','=','tbpasienjalan.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();

				$nama = DB::table('tbpoli')->where('IdPoli',$poli)->first();
				$k_ruangan = ' POLI '.strtoupper($nama->NamaPoli);
			}

			$title = 'RAWAT JALAN';
		}
		else{
			if($poli == "all"){
				$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}
			else{
				$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasien.NoRM','=','tbpasienugd.NoRM')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->orderBy('tbpasien.GolPasien')->orderBy('tbpasien.Nama')->get();

				$k_ruangan = "";
			}

			$title = "UGD";
		}
  		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		//$objPHPExcel->getActiveSheet()->getProtection()->setPassword('datakreatif');
		//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be true in order to enable any of the following!
		//$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
		//$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
		//$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(10, 10);

		// Merge cells
		$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '');

		$objPHPExcel->getActiveSheet()->mergeCells('A3:C3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:C4');
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);

		$objPHPExcel->getActiveSheet()->mergeCells('A6:C6');
		$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'LAPORAN REKAP GOLONGAN PASIEN '.$title.' '.$k_ruangan);
		$objPHPExcel->getActiveSheet()->mergeCells('A7:C7');
		$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Dari Tanggal : '.$dari_tanggal2);
		$objPHPExcel->getActiveSheet()->mergeCells('A8:C8');
		$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Sampai Tanggal : '.$sampai_tanggal2);
		$objPHPExcel->getActiveSheet()->getStyle('A6:C8')->getFont()->setSize(12);

		// Header Table
		$objPHPExcel->getActiveSheet()->mergeCells('A10:B10');
		$objPHPExcel->getActiveSheet()->setCellValue('A10', 'STATUS PX');
		$objPHPExcel->getActiveSheet()->mergeCells('C10:C11');
		$objPHPExcel->getActiveSheet()->setCellValue('C10', 'TOTAL');
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A11', 'GOLONGAN')
			->setCellValue('B11', 'SUB GOLONGAN');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);

		$objPHPExcel->getActiveSheet()->getStyle('A10:C11')->applyFromArray(
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
		
       $array = array();
       $total_bottom=array();

       if(isset($pasien) && count($pasien) > 0){
           foreach($pasien as $p){
                 if(isset($array[$p->GolPasien][$p->SubGolPasien])){
                     $array[$p->GolPasien][$p->SubGolPasien]++;
                 }
				 else{
                     $array[$p->GolPasien][$p->SubGolPasien] = 1;
                 }
           }
       }
									
		$norow = 11; //starting the data row

        if(isset($array) && count($array) > 0){
            $total = 0;
            foreach($array as $a=>$ar){
                 foreach($ar as $a1=>$a2){
                    $norow++;
					$total = $total + $a2;
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A'.$norow, $a)
						->setCellValue('B'.$norow, $a1)
						->setCellValue('C'.$norow, $a2);
					$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':C'.$norow)->applyFromArray(
						array(
							'borders' => array(
								'allborders'     => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
						)
					);
                 }                  
            }
			
			$norow++;
 			$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':B'.$norow);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$norow, 'Total');
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$norow, $total);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':C'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
        }

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		if($mode=='Excel5') $eks = 'xls'; else $eks = 'xlsx';
		$filename = "Lap_Rekap_Gol_".$jenis_pelayanan."_(".$dari_tanggal2."-".$sampai_tanggal2.").".$eks;
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//$mode = Excel5 : Ms. Office Excel 2003
		//		  Excel2007 : Ms. Office Excel 2007
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
		$objWriter->save('php://output');
	}
	
// end =============================== REKAP GOLONGAN RAWAT JALAN =============================== 


// start ============================= MORBIDITAS =============================== 
	public function morbiditas()
	{	
		$user = Auth::user();
        $poli = Poli::all();
		return View::make('report.morbiditas' , array('poli' => $poli));
	}

	public function morbiditas_view(){
		$bulan = Input::get('bulan');
		$tahun = Input::get('tahun');
		$poli = Input::get('poli') == 'all' ? "Semua Poli" : Input::get('poli');

		$number = array();
		for($i=1;$i<=38;$i++){
			$number[]['text'] = $i;
		}

		$mulai = $tahun.'-'.$bulan.'-01';
		$sampai = $tahun.'-'.$bulan.'-31';

		if($poli == 'Semua Poli'){
			$morbiditasGol = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','IdDiag',
								'tbpasien.GolPasien',
								'tbpasien.SubGolPasien',
								'tbpasien.GolDinas',
								'tbpasien.Hub',
								DB::raw('COUNT(*) AS jumlah')])
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->groupby('tbpasien.GolPasien')
							->groupby('tbpasien.SubGolPasien')
							->groupby('tbpasien.GolDinas')
							->groupby('tbpasien.Hub')
							->get();
							
			$morbiditasUmur = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','TanggalLahir','IdDiag',
								DB::raw("DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tbpasien.TanggalLahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tbpasien.TanggalLahir, '00-%m-%d')) AS umur"),
								DB::raw("DATEDIFF(NOW(), tbpasien.TanggalLahir) AS usia"),
								DB::raw('COUNT(*) AS jumlah')])
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->groupby('umur')
							->get();
							
			$morbiditasJK = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','JKel','IdDiag',DB::raw('COUNT(*) AS jumlah')])
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->groupby('JKel')
							->get();
							
			$morbiditas = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','IdDiag',DB::raw('COUNT(*) AS jumlah')])
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->get();
							
		}	
		else{
			$morbiditasGol = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','IdDiag',
								'tbpasien.GolPasien',
								'tbpasien.SubGolPasien',
								'tbpasien.GolDinas',
								'tbpasien.Hub',
								DB::raw('COUNT(*) AS jumlah')])
							->where('tbpasienjalan.Poli',$poli)
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->groupby('tbpasien.GolPasien')
							->groupby('tbpasien.SubGolPasien')
							->groupby('tbpasien.GolDinas')
							->groupby('tbpasien.Hub')
							->get();
							
			$morbiditasUmur = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','TanggalLahir','IdDiag',
								DB::raw("DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(tbpasien.TanggalLahir, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(tbpasien.TanggalLahir, '00-%m-%d')) AS umur"),
								DB::raw("DATEDIFF(NOW(), tbpasien.TanggalLahir) AS usia"),
								DB::raw('COUNT(*) AS jumlah')])
							->where('tbpasienjalan.Poli',$poli)
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->groupby('umur')
							->get();
							
			$morbiditasJK = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','JKel','IdDiag',DB::raw('COUNT(*) AS jumlah')])
							->where('tbpasienjalan.Poli',$poli)
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->groupby('JKel')
							->get();
							
			$morbiditas = DB::table('tbpasienjalan')->leftjoin('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
							->select(['Tanggal','IdDiag',DB::raw('COUNT(*) AS jumlah')])
							->where('tbpasienjalan.Poli',$poli)
							->whereBetween('tbpasienjalan.Tanggal', array($mulai, $sampai))
							->groupby('tbpasienjalan.IdDiag')
							->get();
							
		}	

		$arrData = array();
		$cnt = array();

		foreach($morbiditasGol as $rek => $row){
			if(empty($row->IdDiag)) continue;
			$arrData[$row->IdDiag][$row->GolPasien][$row->SubGolPasien][$row->GolDinas][$row->Hub]= $row->jumlah;
			
			if(!isset($cnt[$row->IdDiag])){
				$cnt[$row->IdDiag] = $row->jumlah;
			}else{
				$cnt[$row->IdDiag] +=  $row->jumlah;
			}
		}

		$arrDataumur = array();
		$cntumur = array();

		foreach($morbiditasUmur as $rek => $row){
			if(empty($row->IdDiag)) continue;
			$arrDataumur[$row->IdDiag][$row->umur]= $row->jumlah;
			
			if(!isset($cntumur[$row->IdDiag])){
				$cntumur[$row->IdDiag] = $row->jumlah;
			}else{
				$cntumur[$row->IdDiag] +=  $row->jumlah;
			}
		}

		$arrDataJK = array();
		$cntJK = array();
		foreach($morbiditasJK as $rek => $row){
			if(empty($row->IdDiag)) continue;
			$arrDataJK[$row->IdDiag][$row->JKel]= $row->jumlah;
			
			if(!isset($cntJK[$row->IdDiag])){
				$cntJK[$row->IdDiag] = $row->jumlah;
			}else{
				$cntJK[$row->IdDiag] +=  $row->jumlah;
			}
		}
		
		$arrDataAll = array();
		$cntAll = array();
		foreach($morbiditas as $rek => $row){
			if(empty($row->IdDiag)) continue;
			$arrDataAll[$row->IdDiag]= $row->jumlah;
			
			if(!isset($cntAll[$row->IdDiag])){
				$cntAll[$row->IdDiag] = $row->jumlah;
			}else{
				$cntAll[$row->IdDiag] +=  $row->jumlah;
			}
		}
		
		if( !empty($arrData) )
			ksort($arrData);

		return View::make('report.general' , 
			array(
				//'parent' => url('report/rawat_jalan'),
				'arrDataAll' => $arrDataAll,
				'cntAll' => $cntAll,
				'arrDataJK' => $arrDataJK,
				'cntJK' => $cntJK,
				'arrDataumur' => $arrDataumur,
				'cntumur' => $cntumur,
				'arrData' => $arrData,
				'cnt' => $cnt,
				//'morbiditas' => $arrDataAll,
				'parent' => url('report/tanggal/morbiditas'),
				'pagetitle' => 'Data Keadaan morbiditas', 
				'title' => array(
							array('text' => $this->rs_title ,'align' => 'left'),
							array('text' => ''),
							array('text' => 'DATA KEADAAN MORDIBITAS PASIEN RAWAT JALAN RUMAH SAKIT' , 'align' => 'center'),
							array('text' => 'Klinik : '.$poli , 'align' => 'center'),
							array('text' => 'Bulan : '.$this->namaBulan($bulan).' - Tahun : '.$tahun , 'align' => 'center')
				),
				'table' => array(
							'class' => 'small_column'
				),
				'thead' => array(
							array(
								array('text' => 'No Urut DX' , 'rowspan' => 4),
								array('text' => 'PASIEN MENURUT GOLONGAN' , 'colspan' => 24),
								array('text' => 'PASIEN KELUAR MENURUT GOL UMUR' , 'colspan' => 8, 'rowspan' => 2),
								array('text' => 'Jml' , 'rowspan' => 4),
								array('text' => 'Jumlah Kasus Baru' , 'rowspan' => 2,'colspan' => 3),
								array('text' => 'Jml Knjngn' , 'rowspan' => 4)
							),
							array(
								array('text' => 'BPJS', 'colspan' => 14),
								array('text' => 'Um' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'KAI' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'Gndum' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'PG Krbt' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'In Health' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'Brngn Lf' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'Telkom' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'Pindad' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'Harlend' ,'class' => 'vertical' , 'rowspan' => 3),
								array('text' => 'Jml' , 'rowspan' => 3),
							),
							array(
								array('text' => 'TNI AD' , 'colspan' => 3),
								array('text' => 'TNI AL' , 'colspan' => 3),
								array('text' => 'TNI AU' , 'colspan' => 3),	
								array('text' => 'Polri' , 'rowspan' => 2,'class' => 'vertical'),	
								array('text' => 'Ask' , 'rowspan' => 2,'class' => 'vertical'),	
								array('text' => 'Mask' , 'colspan' => 2),	
								array('text' => 'Mandiri' , 'rowspan' => 2,'class' => 'vertical'),								
								array('text' => '0-28'),
								array('text' => '29HR'),
								array('text' => '1-4'),
								array('text' => '5-14'),
								array('text' => '15-25'),
								array('text' => '26-44'),
								array('text' => '45-64'),
								array('text' => '>65'),
								array('text' => 'Mnrt Sex' , 'colspan' => 2, 'rowspan' => 1),
								array('text' => 'Jml' , 'rowspan' => 2),
							),
							array(
								array('text' => 'MIL'),
								array('text' => 'PNS'),
								array('text' => 'KEL'),
								array('text' => 'MIL'),
								array('text' => 'PNS'),
								array('text' => 'KEL'),
								array('text' => 'MIL'),
								array('text' => 'PNS'),
								array('text' => 'KEL'),
								array('text' => 'JKM' ,'class' => 'vertical'),
								array('text' => 'JKD' ,'class' => 'vertical'),
								array('text' => 'Hr'),
								array('text' => '< 1TH'),
								array('text' => 'TH'),
								array('text' => 'TH'),
								array('text' => 'TH'),
								array('text' => 'TH'),
								array('text' => 'TH'),
								array('text' => 'TH'),
								array('text' => 'LK'),
								array('text' => 'PR'),
							),
							$number

				),
			)
		);
	}

	public function morbiditas_excel($mode)
	{
		$dari_tanggal = Input::get('dari_tanggal');
		$sampai_tanggal = Input::get('sampai_tanggal');

		$date = DateTime::createFromFormat('Y-m-d', $dari_tanggal);
		$dari_tanggal2 = $date->format('d/m/Y');

		$date = DateTime::createFromFormat('Y-m-d', $sampai_tanggal);
		$sampai_tanggal2 = $date->format('d/m/Y');

		$ruangan = Input::get('ruangan');

		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur'))
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
			->orderBy('tbpasieninap.Tanggal')->get();

			$k_ruangan = "";
			$l_ruangan = "";
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur'))
			->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
			->orderBy('tbpasieninap.Tanggal')->orderBy('tbpasien.Nama')->get();

			$k_ruangan = " RUANGAN ".strtoupper($ruangan);
			$l_ruangan = "Ruangan_".ucfirst($ruangan)."_";
		}
  		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		
		//$objPHPExcel->getActiveSheet()->getProtection()->setPassword('datakreatif');
		//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // This should be true in order to enable any of the following!
		//$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
		//$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
		//$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(1.25);
		
		$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(10, 10);

		// Merge cells
		$objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '');

		$objPHPExcel->getActiveSheet()->mergeCells('A3:M3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:M4');
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);

		$objPHPExcel->getActiveSheet()->mergeCells('A6:M6');
		$objPHPExcel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'DATA PASIEN INAP '.$k_ruangan);
		$objPHPExcel->getActiveSheet()->mergeCells('A7:M7');
		$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Dari Tanggal : '.$dari_tanggal2);
		$objPHPExcel->getActiveSheet()->mergeCells('A8:M8');
		$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Sampai Tanggal : '.$sampai_tanggal2);
		$objPHPExcel->getActiveSheet()->getStyle('A6:M8')->getFont()->setSize(12);

		// Header Table
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A10', 'No Urut')
			->setCellValue('B10', 'No RM')
			->setCellValue('C10', 'Nama')
			->setCellValue('D10', 'Umur')
			->setCellValue('E10', 'Agama')
			->setCellValue('F10', 'Jenis Kelamin')
			->setCellValue('G10', 'TGL MRS')
			->setCellValue('H10', 'Golongan')
			->setCellValue('I10', 'Sub Golongan')
			->setCellValue('J10', 'Dirawat di ruang')
			->setCellValue('K10', 'Tanggal KRS')
			->setCellValue('L10', 'Alasan Pulang')
			->setCellValue('M10', 'Keterangan Lain');
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(22);

		$objPHPExcel->getActiveSheet()->getStyle('A10:M10')->applyFromArray(
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
		
		$no = 0;
		$norow = 10; //starting the data row

		foreach($pasien as $pas => $ien){
			$no++;
			$norow++;
	
			$tglpulang = $ien->TanggalPulang == '0000-00-00' ? '-' : $ien->TanggalPulang;
			
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$norow, $no)
				->setCellValue('B'.$norow, $ien->NoRM)
				->setCellValue('C'.$norow, $ien->Nama)
				->setCellValue('D'.$norow, $ien->umur)
				->setCellValue('E'.$norow, $ien->Agama)
				->setCellValue('F'.$norow, $ien->Jkel)
				->setCellValue('G'.$norow, $ien->Tanggal)
				->setCellValue('H'.$norow, $ien->GolPasien)
				->setCellValue('I'.$norow, $ien->SubGolPasien)
				->setCellValue('J'.$norow, $ien->Ruangan)
				->setCellValue('K'.$norow, $tglpulang)
				->setCellValue('L'.$norow, $ien->CaraPulang)
				->setCellValue('M'.$norow, '-');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':M'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
		}
		
		$norow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$norow.':M'.$norow);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$norow, 'Jumlah Pasien : '.$no);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':L'.$norow)->applyFromArray(
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
		$filename = "Lap_Data_Pasien_Inap_".$l_ruangan."(".$dari_tanggal2."-".$sampai_tanggal2.").".$eks;
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//$mode = Excel5 : Ms. Office Excel 2003
		//		  Excel2007 : Ms. Office Excel 2007
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
		$objWriter->save('php://output');
	}
// end =============================== MORBIDITAS ===============================

	public function penunjangTanggal($target){
		return View::make('report.penunjang_tanggal' , array('target' => $target));
	}

	// === penunjang
	public function penunjang($id)
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$data = DB::table('tbdetailtindakan')->join('tbpasien' , 'tbdetailtindakan.NoRM' , '=' ,'tbpasien.NoRM')
				->where('Gol','LIKE' , "%$id%")->whereBetween('TanggalMasuk', array($dari_tanggal,$sampai_tanggal))
				->groupBy('NoReg')->orderBy('TanggalMasuk','asc')->get();


		return View::make('report.penunjang' , array(
			'dari_tanggal' => $dari_tanggal,
			'sampai_tanggal' => $sampai_tanggal,
			'title' => $id,
			'pasien' => $data
		));
	}


	public function tanggal_inap($target){
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		$single = false;

		if (strpos($slug,'ruangan_') !== false) {
			$single = true;
            $id = str_replace("ruangan_", "", $slug);
            $ruangan = db::table('tbruangan')->where('NamaRuangan' ,'LIKE' ,'%'.$id.'%')->first();
        }
        else{
        	$ruangan = DB::table('tbruangan')->groupBy('NamaRuangan')->get();
        }
		
		return View::make('report.tanggal_inap' , array('ruangan' => $ruangan , 'single' => $single ,'target' => $target));
	}

	public function rincianRawatInap(){

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$ruangan = Input::get('ruangan');
		if($ruangan == "all"){
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->leftjoin('tbdetaildiagnosis' , 'tbdetaildiagnosis.NoReg' , '=' , 'tbpasieninap.NoReg')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur') , 
				DB::raw('GROUP_CONCAT(tbdetaildiagnosis.ShortDiagnoisDesc) AS Diagnosa'))
			->whereBetween('tbpasieninap.tanggal', array($dari_tanggal, $sampai_tanggal))->where('IdRuangan' , '!=' , '')
			->orderBy('tbpasieninap.StatusPulang','ASC')
			->groupBy('tbpasieninap.IdInap')
			->orderBy('tbpasieninap.Tanggal')->get();

			$k_ruangan = "";
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasien.NoRM','=','tbpasieninap.NoRM')
			->leftjoin('tbdetaildiagnosis' , 'tbdetaildiagnosis.NoReg' , '=' , 'tbpasieninap.NoReg')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur') , 
				DB::raw('GROUP_CONCAT(tbdetaildiagnosis.ShortDiagnoisDesc) AS Diagnosa'))
			->whereBetween('tbpasieninap.tanggal', array($dari_tanggal, $sampai_tanggal))->where('Ruangan' , '=' , $ruangan)
			->orderBy('tbpasieninap.StatusPulang','ASC')
			->groupBy('tbpasieninap.IdInap')
			->orderBy('tbpasieninap.Tanggal')->orderBy('tbpasien.Nama')->get();

			$k_ruangan = " RUANGAN ".strtoupper($ruangan);
		}

		return View::make('report.general_small' , 
			array(
				'parent' => url('report/bulan_inap/rincian_rawat_inap'),
				'pagetitle' => 'Data Pasien Rawat Inap', 
				'judul' => array(
							array('text' => $this->rs_title ,'align' => 'left'),
							array('text' => ''),
							array('text' => 'DATA PASIEN INAP '.$k_ruangan.' RUMAH SAKIT' , 'align' => 'center'),
							array('text' => 'Tanggal : '.$dari_tanggal.' S/D '.$sampai_tanggal , 'align' => 'center')
				),
				'table' => array('class' => 'headpadding10 report'),
				'thead'	=> array(
							array(
								array( 'text' => 'No Urut'),
								array( 'text' => 'No RM'),
								array( 'text' => 'Nama'),
								array( 'text' => 'Umur'),
								array( 'text' => 'Agama'),
								array( 'text' => 'JK'),
								array( 'text' => 'TGL MRS'),
								array( 'text' => 'JAM MRS'),
								array( 'text' => 'Gol'),
								array( 'text' => 'Sub'),
								array( 'text' => 'Ruangan'),
								array( 'text' => 'Diagnosa'),
								array( 'text' => 'Tgl KRS'),
								array( 'text' => 'Alasan Pulang'),
								array( 'text' => 'Keterangan Lain')
							)
				),
				'tbody' => array( 
								array( 'content' => '__NO__'),
								array( 'content' => 'NoRM'),
								array( 'content' => 'Nama'),
								array( 'content' => 'umur'),
								array( 'content' => 'Agama'),
								array( 'content' => 'Jkel'),
								array( 'content' => 'Tanggal'),
								array( 'content' => 'Jam'),
								array( 'content' => 'GolPasien'),
								array( 'content' => 'SubGolPasien'),
								array( 'content' => 'Ruangan'),
								array( 'content' => 'Diagnosa'),
								array( 'content' => 'TanggalPulang', 'default' => '-' , 'where' => '0000-00-00'),
								array( 'content' => 'CaraPulang'),
								array( 'content' => '-' ,'type' => 'static')
				),
				'data' => $pasien,
				'total' => 'Total Pasien'
			)
		);
	}

	public function tanggal($target){
		return View::make('report.tanggal' , array('target' => $target));
	}
}
