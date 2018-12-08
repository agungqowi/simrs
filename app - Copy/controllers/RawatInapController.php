<?php

class RawatInapController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		return Redirect::to('rawat_inap/register');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('rawat_inap.create' );
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
			/*
			return Redirect::to('rawat_inap/register')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
			*/
			die('error');
		} else {
			$new_no_rm = Input::get('new_no_rm');
			$norm = Input::get('txt2_no_rm');
			$pasien_check = Pasien::where('NoRM','=',Input::get('txt2_no_rm'))->first();
			if($pasien_check){
				$pasien = Pasien::where('NoRM','=',Input::get('txt2_no_rm'))->first();
			}
			else{
				$pasien = new Pasien;
				$pasien->NoRM = Input::get('txt2_no_rm');
				//$norm = $pasien->NoRM;

				$pasien->Nama = Input::get('new_txt_nama');
				$pasien->NoKTP = Input::get('new_txt_no_ktp');
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
				$rawat_inap->NoRegJalan = Input::get('txt2_id_register_poli');
				$rawat_inap->NoRegUGD = Input::get('txt2_id_register_ugd');
				$rawat_inap->save();

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
		return View::make('rawat_inap.register' ,  array('ruangan' => $ruangan->get() ,'dokter' => $dokter ) );
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


		$dokter 	= Dokter::all();
		$perawat 	= Perawat::all();

		$lab 	= array();

		$lab1 	= DB::table('lab_pemeriksaan')->where('group_jasa' , '0')->get();
		foreach($lab1 as $la){
			$la2 = DB::table('lab_pemeriksaan')->where('group_jasa' , $la->kode_jasa)->get();
			$lab[$la->kode_jasa] = array( 'title' => $la->nama_jasa, 'content' => $la2 );
		}

		$cara_pulang 		= DB::table('status_carapulang')->get();
		$kondisi_pulang 	= DB::table('status_kondisipulang')->get();
		$rad1 = DB::table('radiologi_pemeriksaan')->where('gr_rad' , '-')->get();
		foreach($rad1 as $ra){
			$rad2 = DB::table('radiologi_pemeriksaan')->where('gr_rad' , $ra->kd_rad)->get();
			$rad3 = array();
			$radiologi[$ra->kd_rad] = array( 'title' => $ra->nama_rad, 'content' => $rad2 );
		}
		
		return View::make('rawat_inap.pasien' ,  
						array( 
								'reg' 			=> $reg , 
								'ruangan' 		=> $ruangan->get() , 
								'lab' 			=> $lab , 
								'rad' 			=> $radiologi ,
								'cara_pulang'	=> $cara_pulang,
								'kondisi_pulang'=> $kondisi_pulang,
								'dokter' => $dokter , 'perawat' => $perawat
					) 

		);
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

	/**
	 * @param void
	 * @return array
	 */
	public function tambah_dokter()
	{
		$check_dokter = DetailDokter::where('IDDokter' , '=' , Input::get('id_dokter'))->where('NoReg','=',Input::get('noreg'))->count();
		$check_dokter = 0;

		if($check_dokter > 0){

		}
		else{
			$kategori 		= Input::get('kategori');
			$detail_dokter 	= new DetailDokter;
			$detail_dokter->IDDokter = Input::get('id_dokter');
			$detail_dokter->NoReg = Input::get('noreg');
			$detail_dokter->Nama = Input::get('nama');
			$detail_dokter->NoRM = Input::get('norm');
			$detail_dokter->Kategori = $kategori;

			$spesialisasi 	= 0;
			$namadokter 	= "";
			$dokter = Dokter::where('IdDokter' , '=' , Input::get('id_dokter'))->get();
			foreach ($dokter as $d) {
				$detail_dokter->NamaDokter = $d->NamaDokter;
				$spesialisasi= $d->Spesialisasi;

				$namadokter 	= $d->NamaDokter;
			}

			$db = DB::table('tbspesialis')->where('id' , $spesialisasi)->first();
			if( isset($db->nama) ){
				$detail_dokter->Spesialisasi = $db->nama;
			}
			else{
				$detail_dokter->Spesialisasi = "";
			}

			$detail_dokter->save();

			if($kategori == 'DPJP'){
				DB::table('tbpasieninap')->where('NoReg',Input::get('noreg'))->update(
					array(
							'IdDokter' 	=> Input::get('id_dokter') ,
							'Dokter' 	=> $namadokter
					)
				);
			}
		}
		

	}

	public function list_tindakan($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbtindakanranap')
			->where('NoReg', '=', $id)->get();
			
			echo(json_encode($pasien));
		}
	}

	public function tambah_tindakan()
	{
		$tindakan = new TindakanRanap;
		$tindakan->NoRM = Input::get('norm');
		$tindakan->JenisRawat = Input::get('jenis_rawat');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		$tindakan->TanggalMasuk = $date->format('Y-m-d');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_tindakan'));
		$tindakan->TanggalTindak = $date->format('Y-m-d');
		$tindakan->JamTindak = Input::get('jam_tindakan');
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
			$bek = 0;
			$IdKategoriTindakan = "";
			$gol = "";
		}

		$id_dokter 	= Input::get('id_dokter');
		$id_perawat = Input::get('id_perawat');

		if( $id_dokter == 0 || $id_dokter == "" ){
			$nama_dokter 	= "";
		}
		else{
			$dokter 	= DB::table('tbdaftardokter')->where('IdDokter' , $id_dokter)->first();
			if( isset($dokter->NamaDokter) ){
				$nama_dokter 	= $dokter->NamaDokter;
			}
		}

		if( $id_perawat == 0 || $id_perawat == "" ){
			$nama_perawat 	= "";
		}
		else{
			$perawat 	= DB::table('tbparamedis')->where('Id' , $id_perawat)->first();
			if( isset($perawat->NamaParamedis) ){
				$nama_perawat 	= $perawat->NamaParamedis;
			}
		}

		$tindakan->HargaSatuan 	= $tarif;

		$qty 					= intVal( Input::get('qty') );
		if( $qty < 1 ){
			$qty 	= 1;
		}

		$tindakan->Qty  		= $qty;

		$total 					= $qty * intval( $tarif );
		$tindakan->Tarif 		= $total;

		$tindakan->Adm = $adm;
		$tindakan->Fas = $fas;
		$tindakan->Bek = $bek;
		$tindakan->IdKategoriTindakan = $IdKategoriTindakan;
		$tindakan->Gol = $gol;

		
		$tindakan->IdDokter 			= $id_dokter;
		$tindakan->NamaDokter 			= $nama_dokter;
		$tindakan->IdPerawat 			= $id_perawat;
		$tindakan->Namaperawat 			= $nama_perawat;

		$tindakan->save();
	}

	public function hapus_tindakan()
	{
		$hapus_tindakan = Input::get('id_tindakan');
		$data = DB::table('tbtindakanranap')->where('IdDetailTindak' , '=' , $hapus_tindakan)->delete();
		echo $data;
	}

	public function pasien_pulang(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_pulang'));
		$tanggal_pulang = $date->format('Y-m-d');
		$jam_pulang = Input::get('jam_pulang');
		$id_register = Input::get('id_register');
		$cara_pulang = Input::get('cara_pulang');
		$kondisi_pulang = Input::get('kondisi_pulang');
		$id_ruangan = Input::get('id_ruangan');
		$no_rm = Input::get('no_rm');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		$tanggal_masuk = $date->format('Y-m-d');
		$id_inap = Input::get('id_inap');

		$date1 = Input::get('tanggal_masuk');
		$date2 = Input::get('tanggal_pulang');

		$diff = abs(strtotime( $tanggal_pulang ) - strtotime( $tanggal_masuk ));

		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$days++;

		$id_keluar = time().mt_rand(0,9).mt_rand(0,9);

		$exist = DB::table('tbkeluar')->where('IdInap',$id_inap)->get();

		$pulang = strtotime( $tanggal_pulang );
		$masuk = strtotime( $tanggal_masuk );

		/** Jika sudah pernah pindah */
		if($exist){
			$new = false;
		}
		else{
			$new = true;
		}

		$ruangan = DB::table('tbtarifruangan')->where('IdRuang' , $id_ruangan)->first();
		if($ruangan)
			$tarif = $ruangan->Tarif;
		else
			$tarif = 0;

		$total_tarif = $tarif * $days;

		if($pulang >= $masuk){
			if($new){
				$check_pulang = DB::table('tbkeluar')->where('NoReg',$id_register)->where('Status' , 'pulang')->first();
				if($check_pulang){
					DB::table('tbkeluar')->where('IdKeluar' , $check_pulang->IdKeluar)->update(
						array( 'NoRM' => $no_rm  , 'TanggalMasuk' => $tanggal_masuk , 'TanggalKeluar' => $tanggal_pulang ,
							'JamKeluar' => $jam_pulang , 'CaraKeluar' => $cara_pulang , 'KondisiKeluar' => $kondisi_pulang ,
							'NoReg' => $id_register , 'IdKeluar' => $id_keluar , 'LamaTinggal' => $days , 
							'TotalBiayaRuang' => $total_tarif , 'Status' => 'pulang' , 'idInap' => $id_inap
						)
					);
				}
				else{
					DB::table('tbkeluar')->insert(
						array( 'NoRM' => $no_rm  , 'TanggalMasuk' => $tanggal_masuk , 'TanggalKeluar' => $tanggal_pulang ,
							'JamKeluar' => $jam_pulang , 'CaraKeluar' => $cara_pulang , 'KondisiKeluar' => $kondisi_pulang ,
							'NoReg' => $id_register , 'IdKeluar' => $id_keluar , 'LamaTinggal' => $days , 
							'TotalBiayaRuang' => $total_tarif , 'Status' => 'pulang'
						)
					);
				}

				$nama_cara_pulang	= "";

				$cara 	= DB::table('status_carapulang')->where('id',$cara_pulang)->first();
				if( isset($cara->keterangan) ){
					$nama_cara_pulang 	= $cara->keterangan;
				}

				DB::table('tbpasieninap')->where('NoReg' , $id_register)->update( 
					array(
						'StatusPulang'=>1,
						'TanggalPulang' => $tanggal_pulang,
						'CaraPulang' => $nama_cara_pulang,
						'KondisiPulang' => $cara_pulang,
						'Lama' => $days,
						'TotalBiaya' => $total_tarif
					)
				);
				
				
				$status = "0";
				$ruang = DB::table('tbruangan')->where('IdRuang' , $id_ruangan)
								->update(array('Status' => '0'));
			}
			else{
				/* tambah record tbkeluar */
				DB::table('tbkeluar')->where('IdInap',$id_inap)->update(
					array(
						'TanggalKeluar' => $tanggal_pulang ,
						'IdInap' => $id_inap , 
						'LamaTinggal' => $days , 
						'TotalBiayaRuang' => $total_tarif , 
						'IdKeluar' => time().mt_rand(0,9).mt_rand(0,9),
						'Status' => 'pulang',
						'CaraKeluar' => $cara_pulang , 
						'KondisiKeluar' => $kondisi_pulang 
					)
				);

				DB::table('tbpasieninap')->where('IdInap' , $id_inap)->update( 
					array(
						'StatusPulang'=>1,
						'TanggalPulang' => $tanggal_pulang,						
						'CaraPulang' => $cara_pulang,
						'KondisiPulang' => $kondisi_pulang,
						'Lama' => $days,
						'TotalBiaya' => $total_tarif,
					)
				);
			}
		}
		else{
			echo 'false';
		}

		//echo $ruang;		
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

	public function tambah_koreksi_ruangan()
	{
		/* Ambil variable */
		$no_rm = Input::get('norm');
		$nama = Input::get('nama');
		$noreg = Input::get('noreg');
		$id_ruangan_lama = Input::get('id_ruangan_lama');
		$nama_ruangan_lama = Input::get('nama_ruangan_lama');
		$id_ruangan_baru = Input::get('id_ruangan_baru');
		$nama_ruangan_baru = Input::get('nama_ruangan_baru');
		$kelas = Input::get('kelas_ruangan_baru');
		$no = Input::get('no_ruangan_baru');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal = $date->format('Y-m-d');
		/**cek variable**/

		$cek = true;
		/**jika lolos lanjutkan eksekusi**/
		if($cek){
			/* insert data ke tbpindahruangan */
			DB::table('tbpindahruangan')->insert(
				array(
					'IdPindah' => $noreg,
					'NoRM' => $no_rm,
					'Tanggal' => $tanggal,
					'Nama' => $nama,
					'IdRuanganLama' => $id_ruangan_lama,
					'RuanganLama' => $nama_ruangan_lama,
					'IdRuanganBaru' => $id_ruangan_baru,
					'RuanganBaru' => $nama_ruangan_baru,
					'NoReg' => $noreg
				)
			);

			/* Update data tbrawatinap */

			$tarif  = 0;
			$data_ruangan = DB::table('tbruangan')->where('IdRuang',$id_ruangan_baru)->first();
			if( isset($data_ruangan->Tarif) ){
				$tarif  = $data_ruangan->Tarif;
			}


			DB::table('tbpasieninap')->where('NoReg',$noreg)->update(
				array(
					'IdRuangan' 	=> $id_ruangan_baru,
					'Ruangan' 		=> $nama_ruangan_baru,
					'Kelas' 		=> $kelas,
					'NoKamar' 		=> $no,
					'TarifRuangan' 	=> $tarif
				)
			);

			/* update status tbruangan lama dan baru*/

			DB::table('tbruangan')->where('IdRuang',$id_ruangan_lama)->update(
				array(
					'Status' => 0
				)
			);

			DB::table('tbruangan')->where('IdRuang',$id_ruangan_baru)->update(
				array(
					'Status' => 1
				)
			);
		}

		//jika tidak laporkan kesalahan
	}

	public function tambah_pindah_ruangan()
	{
		/* Ambil variable */
		$no_rm = Input::get('norm');
		$nama = Input::get('nama');
		$noreg = Input::get('noreg');
		$id_ruangan_lama = Input::get('id_ruangan_lama');
		$nama_ruangan_lama = Input::get('nama_ruangan_lama');
		$id_ruangan_baru = Input::get('id_ruangan_baru');
		$nama_ruangan_baru = Input::get('nama_ruangan_baru');
		$kelas = Input::get('kelas_ruangan_baru');
		$no = Input::get('no_ruangan_baru');
		$date_masuk = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		$tanggal_masuk = $date_masuk->format('Y-m-d');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal = $date->format('Y-m-d');
		$id_inap = Input::get('id_inap');
		
		$cek = true;
		$now = time();
		$intdate = strtotime($tanggal);
		/*check if exist on tbpindahruangan*/
		$exist = DB::table('tbkeluar')->where('IdInap',$id_inap)->get();

		/** Jika sudah pernah pindah */
		if($exist){
			$new = false;
		}
		else{
			$new = true;
		}

		/* tanggal pindah harus >= tanggal masuk */
		$tanggal1 = strtotime($tanggal_masuk);

		/* lama */
		$tanggal2 = strtotime($tanggal);

		$next_date = date('Y-m-d', strtotime('+1 day', $tanggal2));

		/* baru */
		//$tanggal_old 	= strtotime($tanggal);
		//$tanggal2 		= date('Y-m-d' , strtotime('-1 day' , $tanggal_old));
		//$next_date 		= $tanggal_old;

		if( $tanggal2 >= $tanggal1 ){
			/** jika baru **/
			if($new){

				/* Update data tbrawatinap */
				DB::table('tbpasieninap')->where('IdInap',$id_inap)->where('IdRuangan',$id_ruangan_lama)->update(
					array(
						'StatusPulang' => 1,
						'CaraPulang' => 'pindah',
						'TanggalPulang' => $tanggal
					)
				);

				/* Hitung lama dan tarif berjalan */
				$diff = abs($tanggal2 - $tanggal1);

				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$days++;

				$id_keluar = time().mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);

				
				$ruangan = DB::table('tbtarifruangan')->where('IdRuang' , $id_ruangan_lama)->first();
				if($ruangan)
					$tarif = $ruangan->Tarif;
				else
					$tarif = 0;

				$total_tarif = $tarif * $days;

				/* tambah record tbkeluar */
				DB::table('tbkeluar')->insert(
					array(
						'NoRM' => $no_rm  , 
						'TanggalMasuk' => $tanggal_masuk , 
						'TanggalKeluar' => $tanggal ,
						'JamKeluar' => '00:00:00' , 
						'CaraKeluar' => 'pindah' , 
						'KondisiKeluar' => 'pindah' ,
						'NoReg' => $noreg , 
						'IdInap' => $id_inap , 
						'LamaTinggal' => $days , 
						'TotalBiayaRuang' => $total_tarif , 
						'Status' => 'pindah',
						'IdKeluar' => time().mt_rand(0,9).mt_rand(0,9)
					)
				);

				/** Tambah record ke pindah ruangan */
				DB::table('tbpindahruangan')->insert(
					array(
						'IdPindah' => time().mt_rand(0,9).mt_rand(0,9),
						'NoRM' => $no_rm,
						'Tanggal' => $tanggal,
						'Nama' => $nama,
						'IdRuanganLama' => $id_ruangan_lama,
						'RuanganLama' => $nama_ruangan_lama,
						'IdRuanganBaru' => $id_ruangan_baru,
						'RuanganBaru' => $nama_ruangan_baru,
						'NoReg' => $noreg,
						'IdInap' => $id_inap
					)
				);

				

				$rawat_inap = new RawatInap;
				$rawat_inap->IdInap = time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$rawat_inap->NoRM = $no_rm;
				$rawat_inap->Tanggal = $next_date;
				$rawat_inap->IdRuangan = $id_ruangan_baru;
				if(Input::get('id_ruangan_baru') != '-' || Input::get('id_ruangan_baru')!='' ){
					$ruangan = Ruangan::where('IdRuang' , '=' , Input::get('id_ruangan_baru'))->get();
					foreach ($ruangan as $r) {
						$rawat_inap->Ruangan = $r->NamaRuangan;
						$rawat_inap->Kelas= $r->Kelas;
						$rawat_inap->NoKamar = $r->NoKamar;
						$tarif_ruangan = DB::table('tbtarifruangan')->where('IdRuang',$r->IdRuang)->first();
						$rawat_inap->TarifRuangan = $r->Tarif;
						$rawat_inap->BiayaAdm = $r->Administrasi;
						$rawat_inap->BiayaMakan = $r->BiayaMakan;
						$rawat_inap->BiayaKamar = $r->BiayaKamar;
					}
				}
				$rawat_inap->NoReg = $noreg;
				$rawat_inap->save();


				/* update status tbruangan lama dan baru*/

				DB::table('tbruangan')->where('IdRuang',$id_ruangan_lama)->update(
					array(
						'Status' => 0
					)
				);

				DB::table('tbruangan')->where('IdRuang',$id_ruangan_baru)->update(
					array(
						'Status' => 1
					)
				);
			}
			else{ //Jika sudah pernah pindah
				/* Hitung lama dan tarif berjalan */
				$diff = abs($tanggal2 - $tanggal1);

				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$days++;

				$id_keluar = time().mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);

				
				$ruangan = DB::table('tbtarifruangan')->where('IdRuang' , $id_ruangan_lama)->first();
				if($ruangan)
					$tarif = $ruangan->Tarif;
				else
					$tarif = 0;

				$total_tarif = $tarif * $days;

				/* tambah record tbkeluar */
				DB::table('tbkeluar')->where('IdInap',$id_inap)->update(
					array(
						'TanggalKeluar' => $tanggal ,
						'IdInap' => $id_inap , 
						'LamaTinggal' => $days , 
						'TotalBiayaRuang' => $total_tarif , 
						'IdKeluar' => time().mt_rand(0,9).mt_rand(0,9)
					)
				);

				/** Tambah record ke pindah ruangan */
				DB::table('tbpindahruangan')->where('IdInap',$id_inap)->update(
					array(
						'IdPindah' => time().mt_rand(0,9).mt_rand(0,9),
						'NoRM' => $no_rm,
						'Tanggal' => $tanggal,
						'Nama' => $nama,
						'IdRuanganLama' => $id_ruangan_lama,
						'RuanganLama' => $nama_ruangan_lama,
						'IdRuanganBaru' => $id_ruangan_baru,
						'RuanganBaru' => $nama_ruangan_baru,
						'NoReg' => $noreg
					)
				);


				$inap = array(
							'Tanggal' => $next_date,
							'IdRuangan' => $id_ruangan_baru
						);

				$last_inap = DB::table('tbpasieninap')->where('NoReg',$noreg)->orderBy('IdInap','asc')->get();
				$flag = 0;
				$new_inap = $id_inap;
				foreach($last_inap as $l){
					if($flag == 1){
						$new_inap = $l->IdInap;
						$flag = 0;
					}
					if($l->IdInap == $id_inap){
						$flag = 1;
					}
				}


				if(Input::get('id_ruangan_baru') != '-' || Input::get('id_ruangan_baru')!='' ){
					$ruangan = Ruangan::where('IdRuang' , '=' , Input::get('id_ruangan_baru'))->get();
					foreach ($ruangan as $r) {
						$inap['Ruangan'] = $r->NamaRuangan;
						$inap['Kelas']= $r->Kelas;
						$inap['NoKamar'] = $r->NoKamar;
						$tarif_ruangan = DB::table('tbtarifruangan')->where('IdRuang',$r->IdRuang)->first();
						$inap['TarifRuangan'] = $tarif_ruangan->Tarif;
						$inap['BiayaAdm'] = $tarif_ruangan->Administrasi;
						$inap['BiayaMakan'] = $tarif_ruangan->BiayaMakan;
						$inap['BiayaKamar'] = $tarif_ruangan->BiayaKamar;
						$inap['BiayaDokter'] = $tarif_ruangan->JasaDokter;
						$inap['BiayaPerawat'] = $tarif_ruangan->JasaPerawat;
					}
				}

				DB::table('tbpasieninap')->where('IdInap',$new_inap)->update(
					$inap
				);



				/* update status tbruangan lama dan baru*/

				DB::table('tbruangan')->where('IdRuang',$id_ruangan_lama)->update(
					array(
						'Status' => 0
					)
				);

				DB::table('tbruangan')->where('IdRuang',$id_ruangan_baru)->update(
					array(
						'Status' => 1
					)
				);
			}
		}
		else{
			echo 'false';
		}
		
		

		//jika tidak laporkan kesalahan
	}

	public function list_ruangan($id){
		/* Get data from table tbpindahruangan */
		if($id==0){
			echo 'false';
		}
		else{
			$ruangan = DB::table('tbpindahruangan')->where('NoReg', '=', $id)->get();
			echo(json_encode($ruangan));
		}
	}

	public function listDokterVisite($id){
		/* Get data from table tbpindahruangan */
		if($id==0){
			echo 'false';
		}
		else{
			$data = DB::table('tbdetaildokter')->where('NoReg', '=', $id)->get();
			echo(json_encode($data));
		}
	}

	public function updateTanggalKeluar(){
		$start_from = '2014-08-01';
		$pasien = RawatInap::where('TanggalPulang' , '=' , '0000-00-00')->where('Tanggal', '>' , $start_from)->get();
		foreach($pasien as $p){
			$keluar = DB::table('tbkeluar')->where('TanggalMasuk','=',$p->Tanggal)->where('NoReg' , '=' , $p->NoReg)->first();
			if($keluar){
				$update = DB::table('tbpasieninap')->where('IdInap' , '=' , $p->IdInap)->update(
					array(
							'TanggalPulang' => $keluar->TanggalKeluar,
							'CaraPulang' => $keluar->CaraKeluar,
							'KondisiPulang' => $keluar->KondisiKeluar,
							'Lama' => $keluar->LamaTinggal,
							'TotalBiaya' => $keluar->TotalBiayaRuang
					)
				);

				print_r($keluar);
				echo '<hr />';
			}
		}
	}

	public function listVisite($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$data = DB::table('dokter_visite')->where('NoReg', '=', $id)->get();
			echo(json_encode($data));
		}
	}

	public function tambahVisite()
	{
		$nama 			= "";
		$persentase 	= $tarif = 0;
		$dokter 		= DB::table('tbdaftardokter')->where( 'IdDokter' , Input::get('dokter_visite') )->first();
		if( isset($dokter->NamaDokter) ){
			$nama 	= $dokter->NamaDokter;
		}

		$inap 	= DB::table('tbpasieninap')->join('tbruangan' , 'tbpasieninap.IdRuangan' , '=' ,'tbruangan.IdRuang')
					->where('NoReg' , Input::get('noreg') )->first();

		$id_kelas 	= 0;
		if(isset($inap->IdKelas)){
			$id_kelas = $inap->IdKelas;
		}
		$biaya 	= DB::table('tarif_dokter_visite')->where('IdKategoriDokter' , '2')->where('IdKelas', $id_kelas)->first();

		if(isset($biaya->Tarif)){
			$tarif 	= $biaya->Tarif;
		}

		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_visite'));
		$tanggal = $date->format('Y-m-d');

		$tambah = DB::table('dokter_visite')->insert(
			array(
				'NoReg' 		=> Input::get('noreg'),
				'IdDokter' 		=> Input::get('dokter_visite'),
				'NamaDokter' 	=> $nama,
				'Tarif' 		=> $tarif,
				'Persentase' 	=> $persentase,
				'Jam' 			=> Input::get('jam_visite'),
				'Catatan' 		=> Input::get('catatan_visite'),
				'Tanggal'		=> $tanggal
			)
		);
	}

	public function hapusVisite()
	{
		$id = Input::get('id');
		$data = DB::table('dokter_visite')->where('id' , '=' , $id)->delete();
		echo $data;
	}

	public function cetakStruk($id){
		$data 		= DB::table('tbpasieninap')->where('NoReg',$id)->first();
		if( !isset($data->NoReg))
			die('');

		$norm 		= $data->NoRM;
		$pasien 	= DB::table('tbpasien')->where('NoRM' , $norm)->first();

		$count 		= DB::table('tbpasieninap')->where('Tanggal' , $data->Tanggal)->where('IdInap' , '<=',$data->IdInap)->count();
		$cek  		= DB::table('tbpasieninap')->where('NoRM',$norm)->where('IdInap' , '<=',$data->IdInap)->count();

		$txt1 = $txt2 = $txt3 = "";
		if( isset($pasien->NoRM)){
			$txt1 	= $pasien->Nama;
			$txt2 	= $pasien->NoRM;
			$tgl 	= explode('-',$pasien->TanggalLahir);
			$txt3 	= $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
		}
		$pdf = new TCPDF('L', PDF_UNIT, array(100, 70), true, 'UTF-8', false);
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

		$html = '<div align="center" style="font-size:13px;text-align:center;"><u>'.$this->rs_title."</u><br />Struk Rawat Inap</div>";
		$html .= "<br />No RM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$txt2;
		$html .= "<br />Nama  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   : ".$txt1."  ($pas)";
		$html .= "<br />Tanggal &nbsp;&nbsp;&nbsp;&nbsp; : ".$data->Tanggal;
		$html .= "<br />Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$data->Jam;
		$html .= "<br />Ruang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$data->Ruangan;
		$html .= "<br />Kelas  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   : ".$data->Kelas;
		$html .= "<br />Dokter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$data->Dokter;
		$html .= "<br />Cara Bayar &nbsp; : ".$data->CaraBayar;
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
