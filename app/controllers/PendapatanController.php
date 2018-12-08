<?php

class PendapatanController extends \BaseController {

	public function tanggal($slug = 'rawat_inap'){
		if($slug == 'rawat_inap'){
			$title = "Rawat Inap";
		}
		else if($slug == 'rawat_jalan'){
			$title = 'Rawat Jalan';
		}
		else{
			$slug = 'ugd';
			$title = 'UGD';
		}
		return View::make('pendapatan.tanggal',
			array(
					'slug' => $slug,
					'title' => $title
			)
		);
	}


	public function rawatJalanInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasienjalan.NoRM' , '=' , 'tbpasien.NoRM')
				->whereBetween('tbpasienjalan.Tanggal',array( $dari,$sampai ) )
				->where('tbpasienjalan.StatusBayar' , '!=' , '0')
				->select('tbpasienjalan.*','tbpasien.*')
				->groupBy('tbpasienjalan.NoRegJalan')
				->get();

		return View::make('pendapatan.rawat_jalan' , array('ruangan' => $ruangan , 'dokter' => $dokter , 
							'pasien'=>$pasien , 'helper'=>new SimHelper));
	}

	public function rawatInapInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' , 'tbpasien.NoRM')
				->whereBetween('tbpasieninap.TanggalPulang',array( $dari,$sampai ) )
				->select('tbpasieninap.*','tbpasien.*')
				->groupBy('tbpasieninap.NoReg')
				->get();
		return View::make('pendapatan.rawat_inap' , array('ruangan' => $ruangan , 'dokter' => $dokter , 
							'pasien'=>$pasien , 'helper'=>new SimHelper));
	}

	public function ugdInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$dokter = Dokter::all();
		$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasienugd.NoRM' , '=' , 'tbpasien.NoRM')
				->whereBetween('tbpasienugd.Tanggal',array( $dari,$sampai ) )
				->where('tbpasienugd.NoRegInap' , '=' , '')
				->groupBy('tbpasienugd.NoRegUGD')
				->get();
		return View::make('pendapatan.ugd' , array( 
							'pasien'=>$pasien , 'helper'=>new SimHelper));
	}
}