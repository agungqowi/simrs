<?php

class BayiController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		return Redirect::to('bayi/register');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('bayi.create' );
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'txt2_tanggal_masuk' => 'required|min:3',
			'txt2_jam_masuk' => 'required|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			/*
			return Redirect::to('rawat_inap/register')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
			*/
			die('error');
		} else {
			$new_no_rm = Input::get('new_no_rm');
			$norm = Input::get('new_no_rm');
			$pasien_check = Pasien::where('NoRM','=',$new_no_rm)->first();
			if($pasien_check){
				$pasien = Pasien::where('NoRM','=',$new_no_rm)->first();
			}
			else{
				$pasien = new Pasien;
				$pasien->NoRM = $new_no_rm;
				//$norm = $pasien->NoRM;

				$pasien->Nama = Input::get('new_txt_nama');
				$pasien->NoKTP = Input::get('new_txt_no_ktp');
				$pasien->Jkel = Input::get('new_cmb_jenkel');
				$pasien->TempatLahir = Input::get('new_txt_tempat_lahir');
				$tgl_lahir = Input::get('new_cmb_tahun_lahir').'-'.Input::get('new_cmb_bulan_lahir').'-'.Input::get('new_cmb_tanggal_lahir');
					if(empty($tgl_lahir))
						$tgl_lahir = '0000-00-00';
				$pasien->TanggalLahir 	= $tgl_lahir;
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

				/* PJ */
				$pasien->NamaPJ 	= Input::get('new_NamaPJ');
				$pasien->AlamatPJ 	= Input::get('new_AlamatPJ');
				$pasien->HubPJ 		= Input::get('new_HubPJ');
				$pasien->TelpPJ 	= Input::get('new_TelpPJ');

				$pasien->save();

			}

			//$check_pasien = RawatInap::where('NoRM' , '=' , $norm)->count();
			$check_pasien = DB::table('tbpasieninap')->where('NoRM' , $norm)
							->where('StatusPulang' , '0')->first();

			if(isset($check_pasien->NoRM)){
				$tgl_keluar = '';
			}
			else{
				$tgl_keluar = '1';
			}
			
			if($tgl_keluar == ''){
				$return = array('pesan' =>'Gagal menambahkan pasien rawat inap, Pasien masih atau sudah berada di ruangan');
				echo json_encode($return);
				die();
			}
			else{
				$pasien_masuk = new PasienMasuk;
				$pasien_masuk->NoReg = time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$pasien_masuk->NoRM = $norm;
				$date = DateTime::createFromFormat('d/m/Y', Input::get('txt2_tanggal_masuk'));
				$pasien_masuk->TglMasuk = $date->format('Y-m-d');
				$pasien_masuk->JamMasuk = Input::get('txt2_jam_masuk');
				$pasien_masuk->JenisRawat = 'Rawat Inap';
				$pasien_masuk->Keterangan = Input::get('txt2_keterangan');
				$pasien_masuk->save();


				$rawat_inap = new RawatInap;
				$rawat_inap->IdInap = time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$rawat_inap->NoRM = $norm;
				$rawat_inap->Tanggal = $pasien_masuk->TglMasuk;
				$rawat_inap->Jam = Input::get('txt2_jam_masuk');
				$rawat_inap->CaraBayar = Input::get('cmb_cara_bayar');
				$rawat_inap->IdDokter = Input::get('cmb2_dokter');

				$id_dokter 	= Input::get('cmb2_dokter');
				$dokter = DB::table('tbdaftardokter')->where('IdDokter' , $id_dokter)->first();

				if(isset($dokter->NamaDokter)){
					$rawat_inap->Dokter = $dokter->NamaDokter;

					DB::table('tbdetaildokter')->insert(
						array(
							'NoReg' 		=> $pasien_masuk->NoReg ,
							'IdDokter'		=> $id_dokter ,
							'NamaDokter'	=> $dokter->NamaDokter,
							'Spesialisasi' 	=> $dokter->Spesialisasi ,
							'Kategori'		=> 'DPJP'
						)
					);
				}

				$rawat_inap->IdRuangan = Input::get('cmb2_ruangan');
				if(Input::get('cmb2_ruangan') != '-' || Input::get('cmb2_ruangan')!='' ){
					$ruangan = Ruangan::where('IdRuang' , '=' , Input::get('cmb2_ruangan'))->get();
					foreach ($ruangan as $r) {
						$rawat_inap->Ruangan = $r->NamaRuangan;
						$rawat_inap->Kelas= $r->Kelas;
						$rawat_inap->NoKamar = $r->NoKamar;
						$rawat_inap->TarifRuangan = $r->Tarif;
						$rawat_inap->BiayaAdm = $r->Administrasi;
						$rawat_inap->BiayaMakan = $r->BiayaMakan;
						$rawat_inap->BiayaKamar = $r->BiayaKamar;
						$rawat_inap->BiayaDokter = $r->JasaDokter;
						$rawat_inap->BiayaPerawat = $r->JasaPerawat;
					}
				}
				$ruang = DB::table('tbruangan')->where('IdRuang' , Input::get('cmb2_ruangan'))
						->update(array('Status' => 1));
				$rawat_inap->NoReg = $pasien_masuk->NoReg;
				$rawat_inap->save();

				$return = array('pesan'=>'sukses' , 'noreg' => $pasien_masuk->NoReg);

				$lahir 	= array();
				$lahir['NoRM']	= $new_no_rm;
				$lahir['NoReg']	= $pasien_masuk->NoReg;
				$lahir['CaraLahir']	= Input::get('cmb_asal');


				DB::table('pasien_lahir')->insert($lahir);

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
		return View::make('rawat_inap.edit' );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('rawat_inap.edit' );
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
			'rawat_inap' => 'required|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('rawat_inap/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$rawat_inap = rawat_inap::find($id);
			$rawat_inap->title = Input::get('title');
			$rawat_inap->rawat_inap = Input::get('rawat_inap');
			$rawat_inap->user_id = Auth::user()->id;
			$rawat_inap->save();

			return Redirect::to('rawat_inap')->with('success', 'rawat_inap Updated Successfully.');
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function register()
	{
		$bypass = Config::get('settings.bypass');
		$ruangan = DB::table( 'tbruangan' );
		$dokter = Dokter::all();
		$ruangan->join( 'tbkelasruangan' , 'tbkelasruangan.IdKelas' , '=' , 'tbruangan.IdKelas' );
		$ruangan->join( 'tbkategoriruangan' , 'tbkategoriruangan.IdKategori' , '=' , 'tbruangan.IdKategori' );
		if($bypass == '1'){
			$ruangan->groupBy('NamaRuangan' , 'tbruangan.IdKategori' ,'tbruangan.IdKelas','NoKamar')->orderBy('IdRuang');
		}
		else{
			$ruangan->groupBy('NamaRuangan' , 'tbruangan.IdKategori' ,'tbruangan.IdKelas','NoKamar')->where('Status', '=', '0')->orderBy('IdRuang');
		}
		return View::make('bayi.register' ,  array('ruangan' => $ruangan->get() ,'dokter' => $dokter ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function pasien($reg=0)
	{
		$ruangan = DB::table( 'tbruangan' );
		$ruangan->join( 'tbkelasruangan' , 'tbkelasruangan.IdKelas' , '=' , 'tbruangan.IdKelas' );
		$ruangan->join( 'tbkategoriruangan' , 'tbkategoriruangan.IdKategori' , '=' , 'tbruangan.IdKategori' );
		$ruangan->groupBy('NamaRuangan' , 'tbruangan.IdKategori' ,'tbruangan.IdKelas','NoKamar')->where('Status', '=', '0')->orderBy('IdRuang');

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
		
		return View::make('rawat_inap.pasien' ,  array( 'reg' => $reg , 'ruangan' => $ruangan->get() , 'lab' => $lab , 'rad' => $radiologi) );
	}


	/**
	 * @param void
	 * @return array
	 */
	public function datatable($ruangan='all')
	{
		if($ruangan == 'Mawar'){
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('Ruangan','=',$ruangan);
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM');
		}
		
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRM."'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRM."'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRM."'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Ruangan','Kelas','NoKamar','NoReg','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasieninap.NoRM','Nama','Tanggal','Ruangan')
			->orderColumns('tbpasieninap.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatablebelum($ruangan='all')
	{
		$user = Auth::user();
		$group = Group::find( $user->group_id );
		$slug = $group->slug;
        $ruangan = $group->ruangan;

        if( isset($group->ruangan) && !empty($group->ruangan)){
			$ruangan = json_decode($group->ruangan);
			if( count($ruangan) > 0){
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->whereIn('IdRuangan' , $ruangan)->orderBy('Tanggal','DESC');
			}
			else{
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('tbpasien.id' , 0)->orderBy('Tanggal','DESC');
			}
			
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('tbpasien.id' , 0)->orderBy('Tanggal','DESC');
		}

        
		
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->IdInap."','".$model->NoRM."'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->IdInap."','".$model->NoRM."'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->IdInap."','".$model->NoRM."'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Ruangan','Kelas','NoKamar','NoReg','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasieninap.NoRM','Nama','Tanggal','Ruangan')
			->orderColumns('tbpasieninap.NoRM','Nama','Tanggal')->make();
	}

	public function datatablebelum2($ruangan='all')
	{
		$user = Auth::user();
		$group = Group::find( $user->group_id );
		$slug = $group->slug;
        $ruangan = $group->ruangan;

        if( isset($group->ruangan) && !empty($group->ruangan)){
			$ruangan = json_decode($group->ruangan);
			if( count($ruangan) > 0){
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('StatusPulang',0)->whereIn('IdRuangan' , $ruangan)->orderBy('Tanggal','DESC');
			}
			else{
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('StatusPulang',0)->where('tbpasien.id' , 0)->orderBy('Tanggal','DESC');
			}
			
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('tbpasien.id' , 0)->orderBy('Tanggal','DESC');
		}

        
		
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->IdInap."','".$model->NoRM."'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->IdInap."','".$model->NoRM."'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->IdInap."','".$model->NoRM."'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Ruangan','Kelas','NoKamar','NoReg','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasieninap.NoRM','Nama','Tanggal','Ruangan')
			->orderColumns('tbpasieninap.NoRM','Nama','Tanggal')->make();
	}


	/**
	 * @param void
	 * @return array
	 */
	public function datatablebelumpulang($ruangan='all')
	{
		$user = Auth::user();
		$group = Group::find( $user->group_id );
		$slug = $group->slug;
		$ruangan = $group->ruangan;

        if( isset($group->ruangan) && !empty($group->ruangan)){
			$ruangan = json_decode($group->ruangan);
			if( count($ruangan) > 0){
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('StatusPulang',0)->whereIn('IdRuangan' , $ruangan)->orderBy('Tanggal','DESC');
			}
			else{
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('StatusPulang',0)->where('tbpasien.id' , 0)->orderBy('Tanggal','DESC');
			}
			
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->where('StatusPulang',0)->where('tbpasien.id' , 0)->orderBy('Tanggal','DESC');
		}


		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->Tanggal."',".
            		"'".$model->Tanggal."',".
            		"'".$model->GolPasien."'".
            	')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".$model->Nama."',".
            		"'".$model->Tanggal."',".
            		"'".$model->Tanggal."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->Tanggal."',".
            		"'".$model->Tanggal."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Ruangan','Kelas','NoKamar','NoReg','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasieninap.NoRM','Nama','Tanggal','Ruangan')
			->orderColumns('tbpasieninap.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable_keluar()
	{
		$pasien = DB::table('tbkeluar')->join('tbpasien', 'tbkeluar.NoRM', '=', 'tbpasien.NoRM')->orderBy('TanggalMasuk','DESC')->groupBy('NoReg');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->TanggalMasuk."',".
            		"'".$model->TanggalKeluar."',".
            		"'".$model->GolPasien."'".
            	')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".$model->Nama."',".
            		"'".$model->TanggalMasuk."',".
            		"'".$model->TanggalKeluar."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->TanggalMasuk."',".
            		"'".$model->TanggalKeluar."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->Nama.'</a>';
        	})
        	->addColumn('TanggalMasuk',function($model)
        	{
            	return date("d/m/Y", strtotime($model->TanggalMasuk));
        	})        	
        	->addColumn('TanggalKeluar',function($model)
        	{
            	return date("d/m/Y", strtotime($model->TanggalKeluar));
        	})
        	->showColumns('NoReg' , 'GolPasien')
			->searchColumns('tbkeluar.NoRM','Nama')
			->orderColumns('tbkeluar.NoRM','Nama')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable_keluar_next()
	{
		$pasien = DB::table('tbpasieninap')->leftJoin('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->Tanggal."',".
            		"'".$model->TanggalPulang."',".
            		"'".$model->GolPasien."'".
            	')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".$model->Nama."',".
            		"'".$model->Tanggal."',".
            		"'".$model->TanggalPulang."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->Tanggal."',".
            		"'".$model->TanggalPulang."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->Nama.'</a>';
        	})
        	->addColumn('Tanggal',function($model)
        	{
            	return $model->Tanggal;
        	})        	
        	->addColumn('TanggalPulang',function($model)
        	{
            	return $model->TanggalPulang;
        	})
        	->showColumns('NoReg' , 'GolPasien')
			->searchColumns('tbpasieninap.NoRM','Nama')
			->orderColumns('tbpasieninap.NoRM','Nama')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable_ruangan()
	{
		$pasien = DB::table('tbpasieninap')->leftJoin('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')
		->where('StatusPulang' , '=' , '0')
		->orderBy('Tanggal','DESC');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->Tanggal."',".
            		"'".$model->TanggalPulang."',".
            		"'".$model->GolPasien."'".
            	')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".$model->Nama."',".
            		"'".$model->Tanggal."',".
            		"'".$model->TanggalPulang."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoReg."',".
            		"'".str_replace("'", "", $model->Nama)."',".
            		"'".$model->Tanggal."',".
            		"'".$model->TanggalPulang."',".
            		"'".$model->GolPasien."'".
            	')" href="#">'.$model->Nama.'</a>';
        	})
        	->addColumn('Tanggal',function($model)
        	{
            	return $model->Tanggal;
        	})        	
        	->addColumn('TanggalPulang',function($model)
        	{
            	return $model->TanggalPulang;
        	})
        	->showColumns('NoReg' , 'GolPasien')
			->searchColumns('tbpasieninap.NoRM','Nama')
			->orderColumns('tbpasieninap.NoRM','Nama')->make();
	}


	/**
	 * @param void
	 * @return array
	 */
	public function popup_table()
	{
		$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRM."','inap'".')" href="javascript:void(0)">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRM."','inap'".')" href="javascript:void(0)">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRM."','inap'".')" href="javascript:void(0)">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Ruangan','Kelas','NoKamar','NoReg','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasieninap.NoRM','Nama','Tanggal','Ruangan')
			->orderColumns('tbpasieninap.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_byreg()
	{
		$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoReg."','inap'".')" href="javascript:void(0)">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoReg."','inap'".')" href="javascript:void(0)">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoReg."','inap'".')" href="javascript:void(0)">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Ruangan','Kelas','NoKamar','NoReg','Jalan','Kelurahan','KotaKab')
			->searchColumns('tbpasieninap.NoRM','Nama','Tanggal','Ruangan')
			->orderColumns('tbpasieninap.NoRM','Nama','Tanggal')->make();
	}


	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_full()
	{
		$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoReg."','inap'".')" href="javascript:void(0)">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoReg."','inap'".')" href="javascript:void(0)">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoReg."','inap'".')" href="javascript:void(0)">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Ruangan','Kelas','NoKamar','NoReg','Sep','GolPasien','NoBPJS')
			->searchColumns('tbpasieninap.NoRM','Nama','Tanggal','Ruangan','NoBPJS','Sep')
			->orderColumns('tbpasieninap.NoRM','Nama','Tanggal')->make();
	}

	public function list_pasien(){
		$tanggal 	= date('Y-m-d');
		$data 		= DB::table('pasien_lahir')->join('tbpasien' , 'pasien_lahir.NoRM' , '=' , 'tbpasien.NoRM')->
					where('TanggalLahir' , $tanggal)->orderBy('NoReg' , 'DESC')->get();
		echo(json_encode($data));
	}
}
