<?php

class UgdController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		return Redirect::to('ugd/register');
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


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'txt2_nama'    => 'required|min:3', // make sure the email is an actual email
			'txt2_tanggal_masuk' => 'required|min:3',
			'txt2_jam_masuk' => 'required|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			$return = array('pesan'=>'Error, masukkan data tanggal dan jam masuk');
			echo json_encode($return);
			die();
		} else {
			
			$norm = Input::get('txt2_no_rm');
			$pasien_check = Pasien::where('NoRM','=',Input::get('txt2_no_rm'))->first();
			if($pasien_check){
				$pasien = Pasien::where('NoRM','=',Input::get('txt2_no_rm'))->first();
			}
			else{
				$pasien = new Pasien;
				$pasien->NoRM = Input::get('txt2_no_rm');
				$pasien->NoKTP = Input::get('new_txt_no_ktp');

				$pasien->Nama = Input::get('new_txt_nama');
				$pasien->Jkel = Input::get('new_cmb_jenkel');
				$pasien->TempatLahir = Input::get('new_txt_tempat_lahir');
				$date = DateTime::createFromFormat('d/m/Y', Input::get('new_txt_tanggal_lahir'));
				$pasien->TanggalLahir = $date->format('Y-m-d');
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

			}

			//$check_pasien = RawatInap::where('NoRM' , '=' , $norm)->count();
			/*
			$check_pasien = DB::table('tbpasienugd')->leftJoin('tbkeluar' , 'tbpasienugd.NoRegUGD' , '=' , 'tbkeluar.NoRegUGD')
						->select('tbpasienugd.IdInap','tbpasienugd.NoRM','tbkeluar.TanggalKeluar as tgl_keluar')
						->where('tbpasienugd.NoRM' , $norm)->orderBy('tbpasienugd.IdInap','desc')->first();
			
			if($check_pasien){
				$tgl_keluar = $check_pasien->tgl_keluar;
			}
			else{
				$tgl_keluar = '1';
			}
			*/
			$tgl_keluar 	= 1;
			$date 			= DateTime::createFromFormat('d/m/Y', Input::get('txt2_tanggal_masuk'));
			$tanggal_masuk 	= $date->format('Y-m-d');
			$check_pasien 	= DB::table('tbpasienugd')->where('NoRM' , $norm )->where('Tanggal',$tanggal_masuk)->first();

			if(isset($check_pasien->NoRM)){
				$tgl_keluar = '';
			}
			
			if($tgl_keluar == ''){
				$return = array('pesan'=>'Gagal menambahkan pasien, Pasien sudah terdaftar di hari yang sama (BPJS)');
				echo json_encode($return);
				die();
			}
			else{
				$pasien_masuk = new PasienMasuk;
				$pasien_masuk->NoReg = time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$pasien_masuk->NoRM = $norm;
				
				$pasien_masuk->TglMasuk = $date->format('Y-m-d');
				$pasien_masuk->JamMasuk = Input::get('txt2_jam_masuk');
				$pasien_masuk->JenisRawat = 'UGD';
				$pasien_masuk->Keterangan = Input::get('txt2_keterangan');
				$pasien_masuk->save();

				$ugd = new Ugd;
				$ugd->NoRM = $norm;
				$ugd->Tanggal = $pasien_masuk->TglMasuk;
				$ugd->IdDokter = Input::get('cmb2_dokter');
				$ugd->Jam = Input::get('txt2_jam_masuk');
				$ugd->NoRegUGD = $pasien_masuk->NoReg;
				$ugd->CaraBayar = Input::get('cmb_cara_bayar');
				$ugd->save();

				$return = array('pesan'=>'sukses' , 'noreg' => $pasien_masuk->NoReg);

				echo json_encode($return);
				die();
			}
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('ugd.edit' );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('ugd.edit' );
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'title'    => 'required|min:3', // make sure the email is an actual email
			'ugd' => 'required|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('ugd/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$ugd = ugd::find($id);
			$ugd->title = Input::get('title');
			$ugd->ugd = Input::get('ugd');
			$ugd->user_id = Auth::user()->id;
			$ugd->save();

			return Redirect::to('ugd')->with('success', 'ugd Updated Successfully.');
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

	public function ugd()
	{
		return View::make('ugd.ugd' );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function register()
	{
		$dokter = Dokter::all();
		return View::make('ugd.register' ,  array('dokter' => $dokter) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function pasien()
	{
		return View::make('ugd.pasien' );
	}


	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRegUGD."'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','NoRegUGD','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasienugd.NoRM','Nama','Tanggal')
			->orderColumns('tbpasienugd.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable_keluar()
	{
		$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('.
            			"'".$model->NoRM."',".
            			"'".$model->NoRegUGD."',".
            			"'".str_replace("'", "", $model->Nama)."',".
            			"'".$model->Tanggal."'".
            		')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            			"'".$model->NoRM."',".
            			"'".$model->NoRegUGD."',".
            			"'".str_replace("'", "", $model->Nama)."',".
            			"'".$model->Tanggal."'".
            		')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            			"'".$model->NoRM."',".
            			"'".$model->NoRegUGD."',".
            			"'".$model->Nama."',".
            			"'".$model->Tanggal."'".
            		')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','NoRegUGD','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasienugd.NoRM','Nama','Tanggal')
			->orderColumns('tbpasienugd.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table()
	{
		$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','NoRegUGD','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasienugd.NoRM','Nama','Tanggal')
			->orderColumns('tbpasienugd.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_byreg()
	{
		$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','NoRegUGD','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasienugd.NoRM','Nama','Tanggal')
			->orderColumns('tbpasienugd.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_full()
	{
		$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','NoRegUGD','Sep','GolPasien','NoBPJS')
			->searchColumns('tbpasienugd.NoRM','Nama','Tanggal','Sep','GolPasien','NoBPJS')
			->orderColumns('tbpasienugd.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_bynorm($id)
	{
		$pasien = DB::table('tbpasienugd')->join('tbpasien', 'tbpasienugd.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienugd.NoRM',$id);
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien_ugd('."'".$model->NoRegUGD."','ugd'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRegUGD',function($model)
        	{
            	return '<a onclick="pilih_pasien_ugd('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->NoRegUGD.'</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien_ugd('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien_ugd('."'".$model->NoRegUGD."','ugd'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal')
			->searchColumns('tbpasienugd.NoRM','Nama','Tanggal')
			->orderColumns('tbpasienugd.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function hapus_pasien()
	{
		$idreg = Input::get('idreg');
		$delete = DB::table('tbpasienugd')->where('IdRegUGD', '=', $idreg)->delete();
		echo $delete;
	}


	/**
	 * @param void
	 * @return array
	 */
	public function hapus_dokter()
	{
		$no_reg = Input::get('noreg');
		$id_dokter =  Input::get('id_dokter');
		DB::table('tbdetaildokter')->where('NoReg', '=', $no_reg)->where('IDDokter', '=', $id_dokter)->delete();
	}

	public function pasienProses($reg)
	{
		$poli 	= Poli::all();
		$lab1 	= DB::table('lab_pemeriksaan')->where('group_jasa' , '0101')->get();
		foreach($lab1 as $la){
			$la2 = DB::table('lab_pemeriksaan')->where('group_jasa' , $la->kode_jasa)->get();
			$lab[$la->kode_jasa] = array( 'title' => $la->nama_jasa, 'content' => $la2 );
		}

		$radiologi 	= array();
		$rad1 = DB::table('radiologi_pemeriksaan')->where('gr_rad' , '-')->get();
		foreach($rad1 as $ra){
			$rad2 = DB::table('radiologi_pemeriksaan')->where('gr_rad' , $ra->kd_rad)->get();
			$rad3 = array();
			$radiologi[$ra->kd_rad] = array( 'title' => $ra->nama_rad, 'content' => $rad2 );
		}

		if(!empty($reg)){
			//DB::table('tbpasienugd')->where('NoRegUGD' , $reg)->update( array('status'=>'1') );
		}

		return View::make('ugd.pasien' ,  array( 'reg' => $reg , 'poli' => $poli , 'lab' => $lab , 'rad' => $radiologi) );
	}

	/**
	 * @param void
	 * @return array
	 */
	public function tambah_dokter()
	{
		$check_dokter = DetailDokter::where('IDDokter' , '=' , Input::get('id_dokter'))->where('NoReg','=',Input::get('noreg'))->count();
		if($check_dokter > 0){

		}
		else{
			$detail_dokter = new DetailDokter;
			$detail_dokter->IDDokter = Input::get('id_dokter');
			$detail_dokter->NoReg = Input::get('noreg');
			$detail_dokter->Nama = Input::get('nama');
			$detail_dokter->NoRM = Input::get('norm');
			$detail_dokter->Kategori = Input::get('kategori');

			$dokter = Dokter::where('IdDokter' , '=' , Input::get('id_dokter'))->get();
			foreach ($dokter as $d) {
				$detail_dokter->NamaDokter = $d->NamaDokter;
				$detail_dokter->Spesialisasi= $d->Spesialisasi;
			}

			$detail_dokter->save();
		}
		

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

	public function tambah_tindakan()
	{
		$tindakan = new DetailTindakan;
		$tindakan->NoRM = Input::get('norm');
		$tindakan->JenisRawat = 'Rawat Inap';
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

	public function hapus_tindakan()
	{
		$hapus_tindakan = Input::get('id_tindakan');
		$data = DB::table('tbdetailtindakan')->where('IdDetailTindak' , '=' , $hapus_tindakan)->delete();
		echo $data;
	}

	public function list_diagnosa($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbdetaildiagnosis')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function tambah_diagnosa()
	{
		
		$diagnosa = DB::table('tbdetaildiagnosis')->insert(
			array(
				'NoReg' => Input::get('noreg'),
				'NoRM' => Input::get('norm'),
				'Nama' => Input::get('nama'),
				'IdDiag' => Input::get('id_diagnosa'),
				'ShortDiagnoisDesc' => Input::get('short'),
				'LongDiagnosisDesc' => Input::get('long')
			)
		);
	}

	public function hapus_diagnosa()
	{
		$id_diagnosa = Input::get('id_diagnosa');
		$id_reg = Input::get('noreg');
		$data = DB::table('tbdetaildiagnosis')->where('IdDiag' , '=' , $id_diagnosa)->where('NoReg' , '=' , $id_reg)->delete();
		echo $data;
	}

	public function cetakStruk($id){
		$data 		= DB::table('tbpasienugd')->where('NoRegUGD',$id)->first();
		if( !isset($data->NoRegUGD))
			die('');

		$norm 		= $data->NoRM;
		$pasien 	= DB::table('tbpasien')->where('NoRM' , $norm)->first();

		$count 		= DB::table('tbpasienugd')->where('Tanggal' , $data->Tanggal)->where('IdRegUGD' , '<=',$data->IdRegUGD)->count();
		$cek  		= DB::table('tbmasukrs')->where('NoRM',$norm)->where('TglMasuk' ,'<' , $data->Tanggal)->count();

		$txt1 = $txt2 = $txt3 = "";
		if( isset($pasien->NoRM)){
			$txt1 	= $pasien->Nama;
			$txt2 	= $pasien->NoRM;
			$tgl 	= explode('-',$pasien->TanggalLahir);
			$txt3 	= $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
		}
		$pdf = new TCPDF('P', PDF_UNIT, array(100, 120), true, 'UTF-8', false);
		//$pdf = new TCPDF();
		//set the logo
		// set default footer font
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		
		$pdf->SetMargins(5, 2, 5, true);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 0);
		//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		//set the header and footer availability
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		//set the default font
		$font = $pdf->addTTFfont(public_path()."/fonts/tahoma.ttf");
		$pdf->SetFont($font, '', 9);
		//create new page
		$pdf->AddPage();

		if(strlen($count) == 1 ){
			$count = "00".$count;
		}
		else if(strlen($count) == 2){
			$count = "0".$count;
		}

		$pas 	= 'L';
		if( $cek == 0 ){
			$pas = 'B';
		}

		$html = '<div align="center" style="font-size:13px;text-align:center;"><u>'.$this->rs_title."</u><br />Struk IGD</div>";
		$html .= "<br />No RM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$txt2;
		$html .= "<br />Antrian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$count;
		$html .= "<br />Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$data->Tanggal;
		$html .= "<br />Nama  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   : ".$txt1."  ($pas)";
		$html .= "<br />Jenis Pembayaran  : ".$data->CaraBayar;
		$html .= "<br />Poli  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: IGD";
		$html .= "<br />Pelayanan  &nbsp;&nbsp;: ";
		$html .= "<br /><br /><br /><br /><br />Tindakan  : ";
		$html .= "<br /><br /><br /><br /><br /><br />Pemeriksaan Penunjang  : ";
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('cetak_struk.pdf', 'I');
	}

	public function list_lab($id=0){
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('lab_dataperiksa')->where('no_reg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function hapus_lab(){
		$id 		= Input::get('id');
		$check 		= DB::table('lab_dataperiksa')->where('id' , '=' , $id)->first();

		$return 			= array();
		$return['status'] 	= 'success';
		$return['pesan'] 	= 'Permintaan lab tidak diizinkan untuk dihapus';
		if( isset($check->status) ){
			if($check->status == '0'){
				$data 		= DB::table('lab_dataperiksa')->where('id' , '=' , $id)->delete();
				$detail 	= DB::table('lab_detailperiksa')->where('id_pemeriksaan' , '=' , $id)->delete();

				$return['status'] 	= 'success';
				$return['pesan'] 	= 'Permintaan lab berhasil dihapus';
			}
			
		}
		
		echo json_encode($return);
	}


	public function list_rad($id=0){
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('radiologi_dataperiksa')->where('no_reg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function hapus_rad(){
		$id 		= Input::get('id');
		$check 		= DB::table('radiologi_dataperiksa')->where('id' , '=' , $id)->first();

		$return 			= array();
		$return['status'] 	= 'success';
		$return['pesan'] 	= 'Permintaan radiologi tidak diizinkan untuk dihapus';
		if( isset($check->status) ){
			if($check->status == '0'){
				$data 		= DB::table('radiologi_dataperiksa')->where('id' , '=' , $id)->delete();
				$detail 	= DB::table('radiologi_detailperiksa')->where('id_pemeriksaan' , '=' , $id)->delete();

				$return['status'] 	= 'success';
				$return['pesan'] 	= 'Permintaan radiologi berhasil dihapus';
			}
			
		}
		
		echo json_encode($return);
	}

}
