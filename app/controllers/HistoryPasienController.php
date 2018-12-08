<?php

class HistoryPasienController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('history.pasien');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function viewInap($NoRM)
	{
		$inap = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('tbpasieninap.NoRM',$NoRM)->orderby('Tanggal', 'desc');
		return Datatable::query($inap)
			->addColumn('Tanggal',function($model)
        	{
				$tgl = DateTime::createFromFormat('Y-m-d', $model->Tanggal);
				$Tanggal = $tgl->format('d/m/Y');
				return $Tanggal;
        	})
			->showColumns('Ruangan','Kelas','NoKamar','Dokter','Diagnosis')
			//->showColumns('Ruangan','Kelas','NoKamar','NoReg','Diagnosis')
			->addColumn('Biaya',function($model)
        	{
				$biaya_total = $model->TarifRuangan + $model->BiayaAdm + $model->BiayaMakan + $model->BiayaKamar + $model->BiayaDokter + $model->BiayaPerawat;
				return $biaya_total;
        	})
        	->addColumn('Action',function($model)
        	{
				return '<a href="javascript:void(0)" onclick="detailRawatInap('."'".$model->NoRM."',
																		'".$model->NoReg."',
																		'".$model->Tanggal."',
																		'".$model->Ruangan."',
																		'".$model->Kelas."',
																		'".$model->NoKamar."',
																		'".$model->Dokter."',
																		'".$model->Dokter."',
																		'".$model->Diagnosis."'".')" title="Detail Perawatan" ><i class="splashy-zoom"></i></a>&nbsp;&nbsp;';
        	})			
			->searchColumns('tbpasieninap.NoRM')
			->orderColumns('tbpasieninap.NoRM')->make();
	}

	public function viewJalan($NoRM)
	{
		$jalan = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienjalan.NoRM',$NoRM)->orderby('Tanggal', 'desc');
		return Datatable::query($jalan)
			->addColumn('Tanggal',function($model)
        	{
				$tgl = DateTime::createFromFormat('Y-m-d', $model->Tanggal);
				$Tanggal = $tgl->format('d/m/Y');
				return $Tanggal;
        	})
			->showColumns('Poli','Dokter','Diagnosis')
        	->addColumn('Action',function($model)
        	{
				return '<a href="javascript:void(0)" onclick="detailRawatJalan('."'".$model->NoRM."',
																		'".$model->NoRegJalan."',
																		'".$model->Tanggal."',
																		'".$model->Poli."',
																		'".$model->Dokter."',
																		'".$model->Diagnosis."'".')" title="Detail Perawatan" ><i class="splashy-zoom"></i></a>&nbsp;&nbsp;';
        	})			
			->searchColumns('tbpasienjalan.NoRM')
			->orderColumns('tbpasienjalan.NoRM')->make();
	}

	public function viewUgd($NoRM)
	{
		$ugd = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienugd.NoRM',$NoRM)->orderby('Tanggal', 'desc');
		return Datatable::query($ugd)
			->addColumn('Tanggal',function($model)
        	{
				$tgl = DateTime::createFromFormat('Y-m-d', $model->Tanggal);
				$Tanggal = $tgl->format('d/m/Y');
				return $Tanggal;
        	})
			->showColumns('NamaDokter','Diagnosis')
        	->addColumn('Action',function($model)
        	{
				return '<a href="javascript:void(0)" onclick="detailRawatUgd('."'".$model->NoRM."',
																		'".$model->NoRegUGD."',
																		'".$model->Tanggal."',
																		'".$model->NamaDokter."',
																		'".$model->Diagnosis."'".')" title="Detail Perawatan" ><i class="splashy-zoom"></i></a>&nbsp;&nbsp;';
        	})			
			->searchColumns('tbpasienugd.NoRM')
			->orderColumns('tbpasienugd.NoRM')->make();
	}

	public function view($NoRM)
	{
		$inap = count(DB::table('tbpasieninap')->where('NoRM',$NoRM)->get());
		$jalan = count(DB::table('tbpasienjalan')->where('NoRM',$NoRM)->get());
		$ugd = count(DB::table('tbpasienugd')->where('NoRM',$NoRM)->get());
		
		$pasien = DB::table('tbpasien')->where('NoRM',$NoRM)->first();
		$usia = $this->umur($pasien->TanggalLahir);
		$tgllhr = DateTime::createFromFormat('Y-m-d', $pasien->TanggalLahir);
		$TanggalLahir = $tgllhr->format('d/m/Y');
		
		return View::make('history.pasien_view', array(
			'NoRM' => $NoRM,
			'pasien' => $pasien,
			'usia' => $usia,
			'TanggalLahir' => $TanggalLahir,
			'inap' => $inap,
			'jalan' => $jalan,
			'ugd' => $ugd
		));
		
	}

	public function viewRawat()
	{
		$NoRM = Input::get('NoRM_rawat');
		$NoReg = Input::get('NoReg_rawat');
		$Tanggal = Input::get('Tanggal_rawat');

		$Ruangan = Input::get('Ruangan_rawat');
		$Kelas = Input::get('Kelas_rawat');
		$NoKamar = Input::get('NoKamar_rawat');
		
		$jenis_rawat = Input::get('jenis_rawat');
		if($jenis_rawat == 'igd'){
			$tipe = 'Ugd';
		}
		else if( $jenis_rawat == 'jalan'){
			$tipe = 'Jalan';
		}
		else{
			$tipe = 'Inap';
		}
		
		$Dokter = Input::get('Dokter_rawat');
		$Diagnosis = DB::table('tbdetaildiagnosis')->where('NoReg' , $NoReg)->get();

		$Dokter = DB::table('tbdetaildokter')->where('NoReg' , $NoReg)->get();

		$pasien = DB::table('tbpasien')->where('NoRM',$NoRM)->first();
		$usia = $this->umur($pasien->TanggalLahir);
		$tgllhr = DateTime::createFromFormat('Y-m-d', $pasien->TanggalLahir);
		$TanggalLahir = $tgllhr->format('d/m/Y');

		return View::make('history.pasien_view_rawat', array(
			'NoRM' => $NoRM,
			'NoReg' => $NoReg,
			'Tanggal' => $Tanggal,
			'Ruangan' => $Ruangan,
			'Kelas' => $Kelas,
			'NoKamar' => $NoKamar,
			'Dokter' => $Dokter,
			'Diagnosis' => $Diagnosis,
			'pasien' => $pasien,
			'usia' => $usia,
			'TanggalLahir' => $TanggalLahir,
			'tipe' => $tipe
		));
		
	}

	public function viewRawatData()
	{
		$NoRM = Input::get('NoRM');
		$NoReg = Input::get('NoReg');
		$Tanggal = Input::get('Tanggal');
		
		$datetime1 = DB::table('tbdetailobat')
		->where('NoRM',$NoRM)
		->where('NoReg',$NoReg)
		->where('TanggalMasuk',$Tanggal)->orderby('TanggalResep','desc')->first();
		$datetime2 = DB::table('tbdetailtindakan')
		->where('NoRM',$NoRM)
		->where('NoReg',$NoReg)
		->where('TanggalMasuk',$Tanggal)->orderby('TanggalTindak','desc')->first();
		
		if($datetime1) $tgl1 = $datetime1->TanggalResep; else $tgl1 = $Tanggal;
		if($datetime2) $tgl2 = $datetime2->TanggalTindak; else $tgl2 = $Tanggal;
		
		$pasien = DB::table('tbdetailobat')
		->where('NoRM',$NoRM)
		->where('NoReg',$NoReg)
		->where('TanggalMasuk',$Tanggal)->get();
		$tindakan = DB::table('tbdetailtindakan')
		->where('NoRM',$NoRM)
		->where('NoReg',$NoReg)
		->where('TanggalMasuk',$Tanggal)->get();
		/*
		echo $NoRM ;
		echo '<br />';
		echo $NoReg ;
		echo '<br />';
		echo $Tanggal ;
		echo '<br />';
		var_dump($pasien);
		echo '<br />';
		var_dump($tindakan);
		echo '<br />';
		*/
		$getNumDays = round(abs(strtotime($tgl1) - strtotime($tgl2)) / 86400, 0) + 1;

		if($getNumDays>0) $list_date = $tgl2;
		else $list_date = $tgl1;
		
		$hasil = '';
		
		if(!$pasien AND !$tindakan){
			$hasil .= '<tr><td colspan="3">Data Tindakan dan Daftar Obat Tidak Ditemukan</td></tr>';
		}
		else{
			for($i=0; $i<$getNumDays; $i++){
				$hari = date('Y-m-d', strtotime("{$list_date} + ".$i." days"));
				
				$hari_disp = DateTime::createFromFormat('Y-m-d', $hari);
				$hari_display = $hari_disp->format('d/m/Y');
	
				$hasil .= '<tr><td>'.$hari_display.'</td>';
				
				$hasil .= '<td>';
				if($tindakan){
					foreach($tindakan as $an => $on){
						if($on->TanggalTindak==$hari){
							$hasil .= '- '.$on->Tindakan.'<br />';
						}
					}
				}
				else{
					$hasil .= '-';
				}
				$hasil .= '</td>';
				
				$hasil .= '<td>';
				if($pasien){
					foreach($pasien as $in => $un){
						if($un->TanggalResep==$hari){
							$hasil .= '- '.$un->NamaObat.' ('.$un->Jumlah.')<br />';
						}
					}
				}
				else{
					$hasil .= '-';
				}
				$hasil .= '</td>';
				
				$hasil .= '</tr>';
			}
		}
		//$hasil .= '';
		//echo $hasil;
		return $hasil;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'Nama'    => 'required|min:3', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('pasien')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$get_id = Pasien::orderBy('NoRM', 'desc')->firstOrFail();
			
			$new_id = $get_id->NoRM + 1;
			$null_add = '';
			for($f=1; $f <= (6-strlen($new_id)); $f++){
				$null_add .= '0'; 
			}
			
			/*echo $null_add.$new_id;*/
			
			$pasien = new Pasien;
			$pasien->NoRM = $null_add.$new_id;
			$pasien->Nama = Input::get('Nama');
			$pasien->Jkel = Input::get('Jkel');
			$pasien->TempatLahir = Input::get('TempatLahir');
			
			$tgllhr = DateTime::createFromFormat('d/m/Y', Input::get('TanggalLahir'));
			$pasien->TanggalLahir = $tgllhr->format('Y-m-d');
			
			$usia = $this->umur_pisah($tgllhr->format('Y-m-d'));
			$usiaa = explode('-',$usia);

			$pasien->UTahun = $usiaa['0'];
			$pasien->UBulan = $usiaa['1'];
			$pasien->UHari =  $usiaa['2'];
			
			$pasien->Jalan = Input::get('Jalan');
			$pasien->Kelurahan = Input::get('Kelurahan');
			$pasien->Kecamatan = Input::get('Kecamatan');
			$pasien->KotaKab = Input::get('KotaKab');
			$pasien->Provinsi = Input::get('Provinsi');
			$pasien->Suku = Input::get('Suku');
			$pasien->Agama = Input::get('Agama');
			$pasien->Pekerjaan = Input::get('Pekerjaan');
			$pasien->NoTelp = Input::get('NoTelp');
			$pasien->Status = Input::get('Status');
			$pasien->GolPasien = Input::get('GolPasien');
			$pasien->SubGolPasien = Input::get('SubGolPasien');
			$pasien->GolAskes = Input::get('GolAskes');
			$pasien->GolNoAskes = Input::get('GolNoAskes');
			$pasien->GolDinas = Input::get('GolDinas');
			$pasien->Hub = Input::get('Hub');
			$pasien->Jenishub = Input::get('Jenishub');
			$pasien->PangkatGol = Input::get('PangkatGol');
			$pasien->NRPNIP = Input::get('NRPNIP');
			$pasien->GolKes = Input::get('GolKes');
			$pasien->Kesatuan = Input::get('Kesatuan');
			$pasien->GolSwasta = Input::get('GolSwasta');
			$pasien->NamaPerusahaan = Input::get('NamaPerusahaan');
			$pasien->NoKartuSwasta = Input::get('NoKartuSwasta');
			$pasien->NoBPJS = Input::get('NoBPJS');
			$pasien->NoJamkesmas = Input::get('NoJamkesmas');
			$pasien->NoJamkesda = Input::get('NoJamkesda');
			$pasien->NoSEPDinas = Input::get('NoSEPDinas');
			$pasien->save();

			//return Redirect::to('dokter')->with('success', 'Data dokter berhasil ditambahkan');
			echo 'sukses';
			//var_dump($pasien);
		}

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
//	public function countYear($jenis,$NoRM,$Year)
	public function countYear()
	{
		$NoRM = Input::get('NoRM');

		$inap = DB::table('tbpasieninap')->select([DB::raw('YEAR(Tanggal) AS TH, count(YEAR(Tanggal)) as NUM')])->where('NoRM',$NoRM)
		->groupby(DB::raw('YEAR(Tanggal)'))->orderby(DB::raw('YEAR(Tanggal)'), 'desc')->get();
		$jalan = DB::table('tbpasienjalan')->select([DB::raw('YEAR(Tanggal) AS TH, count(YEAR(Tanggal)) as NUM')])->where('NoRM',$NoRM)
		->groupby(DB::raw('YEAR(Tanggal)'))->orderby(DB::raw('YEAR(Tanggal)'), 'desc')->get();
		$ugd = DB::table('tbpasienugd')->select([DB::raw('YEAR(Tanggal) AS TH, count(YEAR(Tanggal)) as NUM')])->where('NoRM',$NoRM)
		->groupby(DB::raw('YEAR(Tanggal)'))->orderby(DB::raw('YEAR(Tanggal)'), 'desc')->get();
		
		//$hasil = '<table border="1">';
		$hasil = '';
		
		for($i=0; $i>-4; $i--){
			$hasil .= '<tr>';
			$tahun = date('Y', strtotime($i.' Years'));
			$hasil .= '<td>'.$tahun.'</td>';
			$hasil .= '<td>';
			if($inap){
				foreach($inap as $in => $un){
					if($un->TH==$tahun){
						$hasil .= $un->NUM;
					}
					else{
						$hasil .= '-';
					}
				}
			}
			else{
				$hasil .= '-';
			}
			$hasil .= '</td>';
			$hasil .= '<td>';
			if($jalan){
				foreach($jalan as $an => $on){
					if($on->TH==$tahun){
						$hasil .= $on->NUM;
					}
					else{
						$hasil .= '-';
					}
				}
			}
			else{
				$hasil .= '-';
			}
			$hasil .= '</td>';
			$hasil .= '<td>';
			if($ugd){
				foreach($ugd as $en => $ue){
					if($ue->TH==$tahun){
						$hasil .= $ue->NUM;
					}
					else{
						$hasil .= '-';
					}
				}
			}
			else{
				$hasil .= '-';
			}
			$hasil .= '</td>';
			$hasil .= '</tr>';
		}
		$hasil .= '';
		//echo $hasil;
		return $hasil;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$rules = array(
			'Nama'    => 'required|min:3', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('pasien')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
		
			$pasien = array();
			$pasien['Nama'] = Input::get('Nama');
			$pasien['Jkel'] = Input::get('Jkel');
			$pasien['TempatLahir'] = Input::get('TempatLahir');
			
			$tgllhr = DateTime::createFromFormat('d/m/Y', Input::get('TanggalLahir'));
			$pasien['TanggalLahir'] = $tgllhr->format('Y-m-d');
			
			$usia = $this->umur_pisah($tgllhr->format('Y-m-d'));
			$usiaa = explode('-',$usia);

			$pasien['UTahun'] = $usiaa['0'];
			$pasien['UBulan'] = $usiaa['1'];
			$pasien['UHari'] = $usiaa['2'];

			$pasien['Jalan'] = Input::get('Jalan');
			$pasien['Kelurahan'] = Input::get('Kelurahan');
			$pasien['Kecamatan'] = Input::get('Kecamatan');
			$pasien['KotaKab'] = Input::get('KotaKab');
			$pasien['Provinsi'] = Input::get('Provinsi');
			$pasien['Suku'] = Input::get('Suku');
			$pasien['Agama'] = Input::get('Agama');
			$pasien['Pekerjaan'] = Input::get('Pekerjaan');
			$pasien['NoTelp'] = Input::get('NoTelp');
			$pasien['Status'] = Input::get('Status');
			$pasien['GolPasien'] = Input::get('GolPasien');
			$pasien['SubGolPasien'] = Input::get('SubGolPasien');
			$pasien['GolAskes'] = Input::get('GolAskes');
			$pasien['GolNoAskes'] = Input::get('GolNoAskes');
			$pasien['GolDinas'] = Input::get('GolDinas');
			$pasien['Hub'] = Input::get('Hub');
			$pasien['Jenishub'] = Input::get('Jenishub');
			$pasien['PangkatGol'] = Input::get('PangkatGol');
			$pasien['NRPNIP'] = Input::get('NRPNIP');
			$pasien['GolKes'] = Input::get('GolKes');
			$pasien['Kesatuan'] = Input::get('Kesatuan');
			$pasien['GolSwasta'] = Input::get('GolSwasta');
			$pasien['NamaPerusahaan'] = Input::get('NamaPerusahaan');
			$pasien['NoKartuSwasta'] = Input::get('NoKartuSwasta');
			$pasien['NoBPJS'] = Input::get('NoBPJS');
			$pasien['NoJamkesmas'] = Input::get('NoJamkesmas');
			$pasien['NoJamkesda'] = Input::get('NoJamkesda');
			$pasien['NoSEPDinas'] = Input::get('NoSEPDinas');

			Pasien::where('NoRM', '=', Input::get('id'))->update($pasien);

			//return Redirect::to('dokter')->with('success', 'Data dokter berhasil diubah');
			//var_dump($pasien);
			//echo $tgllhr->format('Y-m-d');
			echo 'sukses';
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	/**
	 * @param void
	 * @return array
	 */
	// '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'      =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
	// '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
	// '%m Month %d Day'                                            =>  3 Month 14 Day
	// '%d Day %h Hours'                                            =>  14 Day 11 Hours
	// '%d Day'                                                     =>  14 Days
	// '%h Hours %i Minute %s Seconds'                              =>  11 Hours 49 Minute 36 Seconds
	// '%i Minute %s Seconds'                                       =>  49 Minute 36 Seconds
	// '%h Hours                                                    =>  11 Hours
	// '%a Days                                                     =>  468 Days	 
	public function dateDifference($date, $differenceFormat)
	{
		$datetime1 = new DateTime();
		$datetime2 = date_create($date);
		$interval = date_diff($datetime1, $datetime2);
		return $interval->format($differenceFormat);
	}

	public function umur_pisah($tgl_lahir){
		$tgl=explode("-",$tgl_lahir);
		$tgl_lahir=$tgl['2'];
		$bln_lahir=$tgl['1'];
		$thn_lahir=$tgl['0'];
		$tanggal_today = date('d');
		$bulan_today=date('m');
		$tahun_today = date('Y');
		//menghitung jumlah hari sejak tahun 0 masehi
		$harilahir=cal_to_jd(CAL_GREGORIAN,$bln_lahir,$tgl_lahir,$thn_lahir);  
		//menghitung jumlah hari sejak tahun 0 masehi
		$hariini=cal_to_jd(CAL_GREGORIAN,$bulan_today,$tanggal_today,$tahun_today);  
		//menghitung selisih hari antara tanggal sekarang dengan tanggal lahir
		$umur=$hariini-$harilahir;
		$tahun=$umur/365;//menghitung usia tahun
		$sisa=$umur%365;//sisa pembagian dari tahun untuk menghitung bulan
		$bulan=$sisa/30;//menghitung usia bulan
		$hari=$sisa%30;//menghitung sisa hari
		$lahir= "$tgl_lahir-$bln_lahir-$thn_lahir";
		$today= "$tanggal_today-$bulan_today-$tahun_today";
		$selisih=floor($tahun)."-".floor($bulan)."-".$hari;
		return $selisih;
	}	 

	public function umur($tgl_lahir){
		$tgl=explode("-",$tgl_lahir);
		$tgl_lahir=$tgl['2'];
		$bln_lahir=$tgl['1'];
		$thn_lahir=$tgl['0'];
		$tanggal_today = date('d');
		$bulan_today=date('m');
		$tahun_today = date('Y');
		//menghitung jumlah hari sejak tahun 0 masehi
		$harilahir=cal_to_jd(CAL_GREGORIAN,$bln_lahir,$tgl_lahir,$thn_lahir);  
		//menghitung jumlah hari sejak tahun 0 masehi
		$hariini=cal_to_jd(CAL_GREGORIAN,$bulan_today,$tanggal_today,$tahun_today);  
		//menghitung selisih hari antara tanggal sekarang dengan tanggal lahir
		$umur=$hariini-$harilahir;
		$tahun=$umur/365;//menghitung usia tahun
		$sisa=$umur%365;//sisa pembagian dari tahun untuk menghitung bulan
		$bulan=$sisa/30;//menghitung usia bulan
		$hari=$sisa%30;//menghitung sisa hari
		$lahir= "$tgl_lahir-$bln_lahir-$thn_lahir";
		$today= "$tanggal_today-$bulan_today-$tahun_today";
		$selisih=floor($tahun)." Th, ".floor($bulan)." Bln, ".$hari." Hari";
		return $selisih;
	}	 
	
	public function datatable()
	{
		$pasien = DB::table('tbpasien');
		return Datatable::query($pasien)
			->addColumn('NoRM',function($model)
        	{
				$usia = $this->umur($model->TanggalLahir);
				$tgllhr = DateTime::createFromFormat('Y-m-d', $model->TanggalLahir);
				$TanggalLahir = $tgllhr->format('d/m/Y');
				return '<a href="javascript:void(0)" onclick="detail_data('."'".$model->NoRM."',
																		'".$model->Nama."',
																		'".$model->Jkel."',
																		'".$model->TempatLahir."',
																		'".$TanggalLahir."',
																		'".$usia."',
																		'".$model->Jalan."',
																		'".$model->Kelurahan."',
																		'".$model->Kecamatan."',
																		'".$model->KotaKab."',
																		'".$model->Provinsi."',
																		'".$model->Agama."',
																		'".$model->Pekerjaan."',
																		'".$model->NoTelp."',
																		'".$model->Status."'".')" title="Ringkasan Rekam medis" >'.$model->NoRM.'</a>&nbsp;&nbsp;';
        	})
			->showColumns('Nama','Jkel','TempatLahir')
			->addColumn('TanggalLahir',function($model)
        	{
				$tgllhr = DateTime::createFromFormat('Y-m-d', $model->TanggalLahir);
				$TanggalLahir = $tgllhr->format('d/m/Y');
				return $TanggalLahir;
        	})
			->showColumns('NoBPJS')
			->addColumn('Jalan',function($model)
        	{
				return $model->Jalan.' '.$model->Kelurahan.' '.$model->Kecamatan.' '.$model->KotaKab;
        	})
        	->addColumn('Action',function($model)
        	{
				$usia = $this->umur($model->TanggalLahir);
				$tgllhr = DateTime::createFromFormat('Y-m-d', $model->TanggalLahir);
				$TanggalLahir = $tgllhr->format('d/m/Y');
				return '<a target="_BLANK" href="pasien/cetak/'.$model->NoRM.'" title="Cetak Data Pasien"><i class="splashy-printer"></i></a>'.'&nbsp;&nbsp;<a href="history_pasien/view/'.$model->NoRM.'" title="Detail Rekam Medis" ><i class="splashy-zoom"></i></a>&nbsp;&nbsp;';
        	})			
			->searchColumns('NoRM','Nama','NRPNIP')
			->orderColumns('NoRM','Nama','TanggalLahir')->make();
	}

	public function tambah_tindakan()
	{
		$tindakan = new DetailTindakan;
		$tindakan->NoRM = Input::get('norm');
		$tindakan->JenisRawat = Input::get('jenis_rawat');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		$tindakan->TanggalMasuk = $date->format('Y-m-d');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_tindakan'));
		$tindakan->TanggalTindak = $date->format('Y-m-d');
		$tindakan->IdTindakan = Input::get('id_tindakan');
		$tindakan->Tindakan = Input::get('tindakan');
		$tindakan->NoReg =  Input::get('noreg');

		$id_tindak = Input::get('id_tindakan');
		$t = DB::table('tbtindakan')->join('tbkategoritindakan' , 'tbkategoritindakan.ID' , '=' ,'tbtindakan.IdKategoriTindakan')
		->where('IdTindakan',$id_tindak)->first();
		if(isset($t->Tarif)){
			$tarif = $t->Tarif;
			$adm = $t->Adm;
			$fas = $t->Fas;
			$bek = $t->Bek;
			$IdKategoriTindakan = $t->IdKategoriTindakan;
			$gol = $t->nama;
		}
		else{
			$tarif = 0;
			$adm = 0;
			$fas = 0;
			$IdKategoriTindakan = "";
			$gol = "";
		}
		$tindakan->Tarif = $tarif;
		$tindakan->Adm = $adm;
		$tindakan->Fas = $fas;
		$tindakan->Bek = $bek;
		$tindakan->Gol = $gol;

		$tindakan->save();
	}

	public function list_tindakan($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbdetailtindakan')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	/**
	 * @param void
	 * @return array
	 */
	public function hapus_tindakan()
	{
		$id_tindakan = Input::get('id_tindakan');
		DB::table('tbdetailtindakan')->where('IdDetailTindak', '=', $id_tindakan)->delete();
	}

	public function history($type,$norm)
	{
		if($type=='jalan'){
			$table = 'tbpasienjalan';
			$key = 'NoRegJalan';
		}
		else if($type=='ugd'){
			$table = 'tbpasienugd';
			$key = 'NoRegUGD';
		}
		else{
			$table = 'tbpasieninap';
			$key = 'NoReg';
		}
		
		/*$data = DB::table('tbmasukrs')->join('tbpasienjalan', $table.'.'.$key ,'=','tbmasukrs.NoReg')
				->where('tbmasukrs.NoRM' , '=' , $norm)
				->select('tbmasukrs.JamMasuk' ,'tbmasukrs.NoReg' ,'tbmasukrs.TglMasuk' , $table.'.*')->orderBy('TglMasuk','desc')->get();
		*/
		$data = DB::table($table)->where('NoRM',$norm)->orderBy($key,'desc')->get();
		echo(json_encode($data));
	}

	public function hapus_riwayat()
	{
		$type = Input::get('type');
		$id = Input::get('id');

		if($type=='jalan'){
			$table = 'tbpasienjalan';
			$key = 'NoRegJalan';
		}
		else if($type=='ugd'){
			$table = 'tbpasienugd';
			$key = 'NoRegUGD';
		}
		else{
			$table = 'tbpasieninap';
			$key = 'IdInap';
		}
		
		/*$data = DB::table('tbmasukrs')->join('tbpasienjalan', $table.'.'.$key ,'=','tbmasukrs.NoReg')
				->where('tbmasukrs.NoRM' , '=' , $norm)
				->select('tbmasukrs.JamMasuk' ,'tbmasukrs.NoReg' ,'tbmasukrs.TglMasuk' , $table.'.*')->orderBy('TglMasuk','desc')->get();
		*/
		$data = DB::table($table)->where($key,$id)->delete();
		echo $data;
		//echo(json_encode($data));
	}

	public function soft_delete()
	{
		$norm = Input::get('norm');
		$check = DB::table('tbpasien')->where('NoRM' , $norm)->first();
		if($check){
			$data = array();
			foreach($check as $c=>$e){
				$data[$c] = $e;
			}
			DB::table('tbpasienhapus')->insert($data);
			DB::table('tbpasien')->where('NoRM' , $norm)->delete();
		}
	}

	public function update_data()
	{
			$pasien_check = Pasien::where('NoRM','=',Input::get('txt2_no_rm'))->first();
			if(!$pasien_check){
				echo 'Data pasien tidak ditemukan';
			}
			else{
				$pasien = Pasien::find( Input::get('txt2_no_rm') );
				$pasien->NoRM = Input::get('txt2_no_rm');
				//$norm = $pasien->NoRM;

				$pasien->Nama = Input::get('new_txt_nama');
				$pasien->Jkel = Input::get('new_cmb_jenkel');
				$pasien->TempatLahir = Input::get('new_txt_tempat_lahir');
				$tgl_lahir = Input::get('new_txt_tanggal_lahir');
				if(empty($tgl_lahir))
					$tgl_lahir = '00/00/0000';
				$date = DateTime::createFromFormat('d/m/Y', $tgl_lahir);
				$pasien->TanggalLahir =  $date->format('Y-m-d');
				$pasien->Suku = Input::get('new_txt_suku');
				$pasien->Agama = Input::get('new_cmb_agama');
				$pasien->Pekerjaan = Input::get('new_txt_pekerjaan');
				$pasien->Status = Input::get('new_cmb_status');
				$pasien->Jalan = Input::get('new_txt_alamat');
				$pasien->Kelurahan = Input::get('new_txt_kelurahan');
				$pasien->Kecamatan = Input::get('new_txt_kecamatan');
				$pasien->KotaKab = Input::get('new_txt_kota');
				$pasien->Provinsi = Input::get('new_txt_provinsi');
				$pasien->NoTelp = Input::get('new_txt_no_telp');
				$pasien->GolPasien = Input::get('new_cmb_golongan_pasien');
				/** For RST **/
				$pasien->SubGolPasien = Input::get('new_cmb_sub_golongan');
				if(Input::get('new_cmb_golongan_pasien') == 'BPJS')
				{
					if(Input::get('new_cmb_sub_golongan') == 'Askes')
					{
						$pasien->GolAskes = Input::get('new_cmb_askes_golongan');
						$pasien->GolNoAskes = Input::get('new_txt_askes_kartu');
						$pasien->NoBPJS = Input::get('new_txt_askes_kartu');
					}
					else if(Input::get('new_cmb_sub_golongan') == 'Dinas')
					{
						$pasien->GolDinas = Input::get('new_cmb_dinas_golongan');
						$pasien->Hub = Input::get('new_cmb_dinas_hubungan');
						$pasien->Jenishub = Input::get('new_cmb_dinas_jenis_hubungan');
						$pasien->PangkatGol = Input::get('new_cmb_dinas_pangkat');
						$pasien->NRPNIP = Input::get('new_txt_dinas_nip');
						$pasien->GolKes = Input::get('new_cmb_golongan_kesatuan');
						$pasien->Kesatuan = Input::get('new_txt_dinas_kesatuan');
						$pasien->NoBPJS = Input::get('new_txt_dinas_kartu');
					}
					else if(Input::get('new_cmb_sub_golongan') == 'BPJS Mandiri')
					{
						$pasien->NoBPJS = Input::get('new_txt_mandiri_kartu');
					}
					else if(Input::get('new_cmb_sub_golongan') == 'Jamkesmas')
					{
						$pasien->NoBPJS = Input::get('new_txt_jamkesmas_kartu');
						$pasien->NoJamkesmas = Input::get('new_txt_jamkesmas_kartu');
					}
				}
				else if(Input::get('new_cmb_golongan_pasien') == 'Swasta')
				{
					$pasien->NamaPerusahaan = Input::get('new_cmb_perusahaan');
					$pasien->GolSwasta = Input::get('new_cmb_swasta_golongan');
					$pasien->NoKartuSwasta = Input::get('new_txt_swasta_kartu');
				}
				else if(Input::get('new_cmb_golongan_pasien') == 'Jamkesda')
				{
					$pasien->NoJamkesda = Input::get('new_txt_jamkesda_kartu');
				}
				$pasien->save();
				echo 'Data pasien berhasil diupdate';

			}

	}

	public function generate()
	{
		
		$data = DB::table('tbpasieninap')->where('StatusPulang','0')->where('Tanggal' , '<=','2014-06-30')->get();
		foreach($data as $d){
			$check = DB::table('tbkeluar')->where('NoReg' , $d->NoReg)
					->where('TanggalMasuk' , $d->Tanggal)->get();
			$check = 1;
			if($check){
				DB::table('tbpasieninap')->where('IdInap' , $d->IdInap)->update( array('StatusPulang' => '1') );
				echo 'generate'.$d->IdInap."<br />";
			}
		}
		
	}

	public function deleteData()
	{
		$hapus_data = DB::table('tbpasien')->where('NoRM', Input::get('id'))->delete();
		if($hapus_data){
			echo 'sukses';
		}
		else{
			echo 'Data Gagal Dihapus';
		}
	}


}