<?php

class KlaimBpjsController extends \BaseController {
	public function rawat_jalan()
	{
		$ruangan = Ruangan::all();
		return View::make('jasa_dokter.rawat_jalan' , array('ruangan' => $ruangan));
	}

	public function rawat_jalan_view()
	{
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
	}

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
		return View::make('klaim_bpjs.tanggal',
			array(
					'slug' => $slug,
					'title' => $title
			)
		);
	}

	public function rawat_inap(){
		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		return View::make('klaim_bpjs.rawat_inap' , array('ruangan' => $ruangan , 'dokter' => $dokter));
	}

	public function rawatInapInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' , 'tbpasien.NoRM')
				->leftJoin('tbtotalklaim', 'tbpasieninap.NoReg' ,'=' , 'tbtotalklaim.NoReg')
				->where('tbpasieninap.TanggalPulang','<=',$sampai)
				->where('tbpasieninap.TanggalPulang' ,'>=' , $dari)
				->where('tbpasien.GolPasien' , '=' , 'BPJS')
				->select('tbpasieninap.*','tbpasien.*','tbtotalklaim.TotalKlaim')
				->groupBy('tbpasieninap.NoReg')
				->get();
		return View::make('klaim_bpjs.rawat_inap_input' , array('ruangan' => $ruangan , 'dokter' => $dokter , 
							'pasien'=>$pasien , 'helper'=>new SimHelper));
	}

	public function rawatInapInputPost(){
		$klaim = Input::get('klaim');
		foreach($klaim as $k=>$l){
			$rincian = array();
			$rincian['TotalObat'] = DB::table('tbdetailobat')->where('NoReg' , $k)->sum('TotalHarga');
			$k = str_replace("'", "", $k);
			$cek_klaim = DB::table('tbtotalklaim')->where('NoReg',$k)->first();
			if($cek_klaim){
				DB::table('tbtotalklaim')->where('NoReg',$k)->update(
					array(
						'TotalKlaim' => $l,
						'Jenis' => 'Rawat Inap',
						'Rincian' => json_encode($rincian)
					)
				);
			}
			else{
				if($l != 0){
					DB::table('tbtotalklaim')->insert(
						array(
								'TotalKlaim' => $l , 
								'NoReg' => $k,
								'Jenis' => 'Rawat Inap',
								'Rincian' => json_encode($rincian)
						)
					);
				}				
			}
		}
		
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');
		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		$pasien = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' , 'tbpasien.NoRM')
				->leftJoin('tbtotalklaim', 'tbpasieninap.NoReg' ,'=' , 'tbtotalklaim.NoReg')
				->where('tbpasieninap.TanggalPulang','<=',$sampai)
				->where('tbpasieninap.TanggalPulang' ,'>=' , $dari)
				->where('tbpasien.GolPasien' , '=' , 'BPJS')
				->select('tbpasieninap.*','tbpasien.*','tbtotalklaim.TotalKlaim')
				->groupBy('tbpasieninap.NoReg')
				->get();
		Session::flash('success', 'Data klaim berhasil diupdate'); 
		return View::make('klaim_bpjs.rawat_inap_input' , array('ruangan' => $ruangan , 'dokter' => $dokter , 
							'pasien'=>$pasien , 'helper'=>new SimHelper))->with('success', 'Data klaim berhasil diupdate');;
	}

	public function rawatInapInputOne(){
		$klaim = Input::get('klaim');
		$k = Input::get('noreg');
		$l = Input::get('klaim');
		//foreach($klaim as $k=>$l){
			$rincian = array();			
			$rincian['TotalObat'] = DB::table('tbdetailobat')->where('NoReg' , $k)->sum('TotalHarga');
			$total_obat = DB::table('tbdetailobat')->where('NoReg' , $k)->sum('TotalHarga');
			$k = str_replace("'", "", $k);
			$cek_klaim = DB::table('tbtotalklaim')->where('NoReg',$k)->first();
			if($cek_klaim){
				DB::table('tbtotalklaim')->where('NoReg',$k)->update(
					array(
						'TotalKlaim' => $l,
						'Jenis' => 'Rawat Inap',
						'Rincian' => json_encode($rincian)
					)
				);
			}
			else{
				if($l != 0){
					DB::table('tbtotalklaim')->insert(
						array(
								'TotalKlaim' => $l , 
								'NoReg' => $k,
								'Jenis' => 'Rawat Inap',
								'Rincian' => json_encode($rincian)
						)
					);
				}				
			}
		//}
		
		echo 'success';
	}

	public function rawatJalanInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$ruangan = Ruangan::groupBy('NamaRuangan')->get();
		$dokter = Dokter::all();
		$pasien = DB::table('tbpasienjalan')->join('tbpasien','tbpasienjalan.NoRM' , '=' , 'tbpasien.NoRM')
				->leftJoin('tbtotalklaim', 'tbpasienjalan.NoRegJalan' ,'=' , 'tbtotalklaim.NoReg')
				->whereBetween('tbpasienjalan.Tanggal',array( $dari,$sampai ) )
				->where('tbpasien.GolPasien' , '=' , 'BPJS')
				->where('tbpasienjalan.NoRegInap' , '=' , '')
				->select('tbpasienjalan.*','tbpasien.*','tbtotalklaim.TotalKlaim')
				->groupBy('tbpasienjalan.NoRegJalan')
				->get();
		return View::make('klaim_bpjs.rawat_jalan_input' , array('ruangan' => $ruangan , 'dokter' => $dokter , 
							'pasien'=>$pasien , 'helper'=>new SimHelper));
	}

	public function rawatJalanInputOne(){
		$klaim = Input::get('klaim');
		$k = Input::get('noreg');
		$l = Input::get('klaim');
		//foreach($klaim as $k=>$l){
			$rincian = array();			
			$rincian['TotalObat'] = DB::table('tbdetailobat')->where('NoReg' , $k)->sum('TotalHarga');
			$total_obat = DB::table('tbdetailobat')->where('NoReg' , $k)->sum('TotalHarga');
			$k = str_replace("'", "", $k);
			$cek_klaim = DB::table('tbtotalklaim')->where('NoReg',$k)->first();
			if($cek_klaim){
				DB::table('tbtotalklaim')->where('NoReg',$k)->update(
					array(
						'TotalKlaim' => $l,
						'Jenis' => 'Rawat Jalan',
						'Rincian' => json_encode($rincian)
					)
				);
			}
			else{
				if($l != 0){
					DB::table('tbtotalklaim')->insert(
						array(
								'TotalKlaim' => $l , 
								'NoReg' => $k,
								'Jenis' => 'Rawat Jalan',
								'Rincian' => json_encode($rincian)
						)
					);
				}				
			}
		//}
		
		echo 'success';
	}

	public function ugdInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$dokter = Dokter::all();
		$pasien = DB::table('tbpasienugd')->join('tbpasien','tbpasienugd.NoRM' , '=' , 'tbpasien.NoRM')
				->leftJoin('tbtotalklaim', 'tbpasienugd.NoRegUGD' ,'=' , 'tbtotalklaim.NoReg')
				->whereBetween('tbpasienugd.Tanggal',array( $dari,$sampai ) )
				->where('tbpasien.GolPasien' , '=' , 'BPJS')
				->where('tbpasienugd.NoRegInap' , '=' , '')
				->select('tbpasienugd.*','tbpasien.*','tbtotalklaim.TotalKlaim')
				->groupBy('tbpasienugd.NoRegUGD')
				->get();
		return View::make('klaim_bpjs.ugd_input' , array( 
							'pasien'=>$pasien , 'helper'=>new SimHelper));
	}

	public function ugdInputOne(){
		$klaim = Input::get('klaim');
		$k = Input::get('noreg');
		$l = Input::get('klaim');
		//foreach($klaim as $k=>$l){
			$rincian = array();			
			$rincian['TotalObat'] = DB::table('tbdetailobat')->where('NoReg' , $k)->sum('TotalHarga');
			$total_obat = DB::table('tbdetailobat')->where('NoReg' , $k)->sum('TotalHarga');
			$k = str_replace("'", "", $k);
			$cek_klaim = DB::table('tbtotalklaim')->where('NoReg',$k)->first();
			if($cek_klaim){
				DB::table('tbtotalklaim')->where('NoReg',$k)->update(
					array(
						'TotalKlaim' => $l,
						'Jenis' => 'Rawat Jalan',
						'Rincian' => json_encode($rincian)
					)
				);
			}
			else{
				if($l != 0){
					DB::table('tbtotalklaim')->insert(
						array(
								'TotalKlaim' => $l , 
								'NoReg' => $k,
								'Jenis' => 'Rawat Jalan',
								'Rincian' => json_encode($rincian)
						)
					);
				}				
			}
		//}
		
		echo 'success';
	}
}