<?php

class RawatJalan04092017Controller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		//$rawat_jalan = User::find( Auth::user()->id )->rawat_jalan;
		//return View::make('rawat_jalan.list', array('rawat_jalan' => $rawat_jalan));
		return Redirect::to('rawat_jalan/register');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('rawat_jalan.create' );
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
			
			$new_no_rm = Input::get('new_no_rm');
			$norm = Input::get('txt2_no_rm');
			$pasien_check = Pasien::where('NoRM','=',Input::get('txt2_no_rm'))->first();
			if($pasien_check){
				$pasien = Pasien::where('NoRM','=',Input::get('txt2_no_rm'))->first();
			}
			else{
				$pasien = new Pasien;
				$pasien->NoRM = Input::get('txt2_no_rm');

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
			$pasien->save();

			}
			$check_pasien 	= 0;
			$carabayar 		= Input::get('cmb_cara_bayar');

			if( $carabayar == 'BPJS' ){
				$date 		= DateTime::createFromFormat('d/m/Y', Input::get('txt2_tanggal_masuk'));
				$TglMasuk 	= $date->format('Y-m-d');

				$pas = DB::table('tbpasienjalan')->where('NoRM' , '=' , $norm)
				->where('Tanggal' , '=' , $TglMasuk)
				->where('CaraBayar' , '=' , 'BPJS')
				->first();

				if(isset($pas->NoRM)){
					$check_pasien = 1;
				}
			}
			else{
				$check_pasien = 0;
			}
			
			

			if($check_pasien > 0){
				$return = array('pesan'=>'Gagal menambahkan pasien, Pasien sudah terdaftar di hari yang sama (BPJS)');
				echo json_encode($return);
				die();
			}
			else{
				$pasien_masuk = new PasienMasuk;
				$no_reg_jalan = time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$pasien_masuk->NoReg = $no_reg_jalan;
				$pasien_masuk->NoRM = $norm;
				$date = DateTime::createFromFormat('d/m/Y', Input::get('txt2_tanggal_masuk'));
				$pasien_masuk->TglMasuk = $date->format('Y-m-d');
				$pasien_masuk->JamMasuk = Input::get('txt2_jam_masuk');
				$pasien_masuk->JenisRawat = 'Rawat Jalan';
				$pasien_masuk->PengunjungBL = Input::get('cmb2_pengunjung');
				$pasien_masuk->KunjunganBL = Input::get('cmb2_kunjungan');
				$pasien_masuk->Keterangan = Input::get('txt2_keterangan');
				$pasien_masuk->save();

				$rawat_jalan = new RawatJalan;
				$rawat_jalan->NoRM = $norm;
				$rawat_jalan->Tanggal = $pasien_masuk->TglMasuk;
				$rawat_jalan->IdPoli = Input::get('cmb2_poli');
				$rawat_jalan->IdDokter = Input::get('cmb2_dokter');

				$id_dokter 	= Input::get('cmb2_dokter');
				$dokter = DB::table('tbdaftardokter')->where('IdDokter' , $id_dokter)->first();

				if(isset($dokter->NamaDokter)){
					$rawat_jalan->Dokter = $dokter->NamaDokter;
				}

				$nama_poli 	= "";
				$poli = DB::table('tbpoli')->where('IdPoli',$rawat_jalan->IdPoli)->first();

				$biaya_admin 	= 0;
				$biaya_konsul 	= 0;
				$tipe_pasien 	= Input::get('tipe_pasien');

				$tindakan 	= array();
				if(isset($poli->NamaPoli)){
					$nama_poli 	= $poli->NamaPoli;

					$tipe_poli 	= $poli->TipePoli;

					if( $tipe_poli == '3' ){
						if(isset($dokter->Spesialisasi)){
							//jika dokter umum
							if($dokter->Spesialisasi == 0 || $dokter->Spesialisasi == 1){
								$jams 	= explode(':' , $pasien_masuk->JamMasuk );
								$jam 	= intval($jams[0]);
								if( $jam < 8 || $jam >= 15 ){
									$luar_jam = 1;
								}
								else{
									$luar_jam = 0;
								}

								$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
												->where('Spesialisasi' , 1)->where('LuarJam',$luar_jam)->first();

								if(isset($konsul->IdTindakan)){
									$tb = DB::table('tbtindakan')->where('IdTindakan' , $konsul->IdTindakan)->first();
									if( isset($tb->IdTindakan)){
										$tindakan[] 	= array('id' => $konsul->IdTindakan , 'nama' => $tb->Tindakan , 
										'tipe' => 'konsul' );

										$biaya_konsul 	= $tb->Tarif;
									}
									
								}
							}
							else{
								$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
												->where('Spesialisasi' , 2)->first();

								if(isset($konsul->IdTindakan)){
									$tb = DB::table('tbtindakan')->where('IdTindakan' , $konsul->IdTindakan)->first();
									if( isset($tb->IdTindakan)){
										$tindakan[] 	= array('id' => $konsul->IdTindakan , 'nama' => $tb->Tindakan , 
										'tipe' => 'konsul' );

										$biaya_konsul 	= $tb->Tarif;
									}
									
								}
								
							}
						}
					}
					else if($tipe_poli == 1){

					}
					else{
						$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
												->where('Spesialisasi' , 2)->first();

						if(isset($konsul->IdTindakan)){
							$tb = DB::table('tbtindakan')->where('IdTindakan' , $konsul->IdTindakan)->first();
							if( isset($tb->IdTindakan)){
								$tindakan[] 	= array('id' => $konsul->IdTindakan , 'nama' => $tb->Tindakan , 
										'tipe' => 'konsul' );

								$biaya_konsul 	= $tb->Tarif;
							}
						}
					}
				}
				$rawat_jalan->Poli = $nama_poli;

				$otomatis 	= DB::table('tbtindakan')->where('Otomatis' , 1)->get();

				
				if( count($otomatis) > 0 ){
					foreach($otomatis as $o){
						if($tipe_pasien == 'lama'){
							if($o->JenisPasien == 1){

							}
							else{
								$biaya_admin = $biaya_admin + floatval($o->Tarif);

								$tindakan[] 	= array('id' => $o->IdTindakan , 'nama' => $o->Tindakan , 
									'tipe' => 'admin' );
							}
						}
						else{
							if($o->JenisPasien == 2){

							}
							else{
								$biaya_admin = $biaya_admin + floatval($o->Tarif);

								$tindakan[] 	= array('id' => $o->IdTindakan , 'nama' => $o->Tindakan , 
									'tipe' => 'admin' );
							}
						}
					}
				}
				try{
					$rawat_jalan->CaraBayar 	= Input::get('cmb_cara_bayar');
					$rawat_jalan->CaraMasuk 	= Input::get('cmb_cara_masuk');
					$rawat_jalan->jam_daftar 	= Input::get('txt2_jam_masuk');
					$rawat_jalan->TipePasien 	= Input::get('tipe_pasien');
					$rawat_jalan->NoRegJalan 	= $no_reg_jalan;
					$rawat_jalan->BiayaKonsul 	= $biaya_konsul;
					$rawat_jalan->BiayaAdmin 	= $biaya_admin;
					$rawat_jalan->save();
				}catch(\Exception $e){
			       // do task when error
			       echo $e->getMessage();   // insert query
			    }

				//masukkan tindakan dan dapatkan id reg
				$get 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $no_reg_jalan)
							->orderBy('IdRegJalan','DESC')->first();

				$id_reg = 0;
				if(isset($get->IdRegJalan))
					$id_reg 	= $get->IdRegJalan;

				if( count($tindakan) > 0 ){
					foreach($tindakan as $ti){
						$tindakan = new DetailTindakan;
						$tindakan->NoRM = $norm;
						$tindakan->JenisRawat = $nama_poli;
						$tindakan->TanggalMasuk = $date->format('Y-m-d');
						$tindakan->TanggalTindak = $date->format('Y-m-d');
						$tindakan->IdTindakan = $ti['id'];
						$tindakan->Tindakan = $ti['nama'];
						$tindakan->NoReg =  $no_reg_jalan;

						$id_tindak = $ti['id'];
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
							$bek 	= 0;
						}
						$tindakan->Tarif 	= $tarif;
						$tindakan->Adm 		= $adm;
						$tindakan->Fas 		= $fas;
						$tindakan->Bek 		= $bek;
						$tindakan->Gol 		= $gol;
						$tindakan->IdReg 	= $id_reg;
						$tindakan->Tipe 	= $ti['tipe'];

						$tindakan->save();
					}
					
				}

				$poli = array();
				$poli['Nama'] = Input::get('new_txt_nama');
				$poli['NoRM'] = $norm;
				$poli['NoRegJalan'] = $no_reg_jalan;
				$poli['Gol'] = Input::get('new_cmb_golongan_pasien');
				$poli['SubGol'] = Input::get('new_cmb_sub_golongan');
				$poli['Tanggal'] = $date->format('Y-m-d');
				$poli['JumlahKunjungan'] = DB::table('tbmasukrs')->where('NoRM',$norm)->count();

				$date1 = $pasien->TanggalLahir;
				$date2 = date('Y-m-d');

				$diff = abs(strtotime($date2) - strtotime($date1));

				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

				$poli['Umur'] = $years;
				$poli['Jenkel'] = Input::get('new_cmb_jenkel');

				$tanggal = explode('-',$pasien_masuk->TglMasuk);

				$kategori = 'Umum';
				if(Input::get('new_cmb_golongan_pasien') == 'BPJS')
				{
					if(Input::get('new_cmb_sub_golongan') == 'Askes')
					{
						$poli['GolAskes'] = Input::get('new_cmb_askes_golongan');
						$kategori = 'askes';
					}
					else if(Input::get('new_cmb_sub_golongan') == 'Dinas')
					{
						$poli['GolDinas'] = Input::get('new_cmb_dinas_golongan');
						$poli['Hub'] = Input::get('new_cmb_dinas_hubungan');
						if($poli['GolDinas'] == 'TNI AD'){
							if($poli['Hub'] == 'PNS'){
								$kategori = 'tniadpns';
							}
							else if($poli['Hub'] == 'Militer'){
								$kategori = 'tniadmil';
							}
							else if($poli['Hub'] == 'Anak' || $poli['Hub'] == 'Suami' || $poli['Hub'] == 'Istri'){
								$kategori = 'tniadkel';
							}
						}
						else if($poli['GolDinas'] == 'TNI AL'){
							if($poli['Hub'] == 'PNS'){
								$kategori = 'tnialpns';
							}
							else if($poli['Hub'] == 'Militer'){
								$kategori = 'tnialmil';
							}
							else if($poli['Hub'] == 'Anak' || $poli['Hub'] == 'Suami' || $poli['Hub'] == 'Istri'){
								$kategori = 'tnialkel';
							}
						}
						else if($poli['GolDinas'] == 'TNI AU'){
							if($poli['Hub'] == 'PNS'){
								$kategori = 'tniaupns';
							}
							else if($poli['Hub'] == 'Militer'){
								$kategori = 'tniaumil';
							}
							else if($poli['Hub'] == 'Anak' || $poli['Hub'] == 'Suami' || $poli['Hub'] == 'Istri'){
								$kategori = 'tniaukel';
							}
						}
						
						$poli['Pangkat'] = Input::get('new_cmb_dinas_pangkat');
					}
					else{
						$kategori = 'bpjs_mandiri';
					}
				}
				else if(Input::get('new_cmb_golongan_pasien') == 'Swasta')
				{
					$poli['NamaPerusahaan'] = Input::get('new_cmb_perusahaan');
					$poli['GolSwasta'] = Input::get('new_cmb_swasta_golongan');
					if($poli['NamaPerusahaan'] == '-'){
						$kategori = 'swasta_umum';
					}
					else{
						$perusahaan = preg_replace('/\s+/', '', $poli['NamaPerusahaan']);
						$kategori = 'swasta_'.'_'.strtolower($perusahaan);
					}
					
				}
				else if(Input::get('new_cmb_golongan_pasien') == 'Jamkesda')
				{
					$kategori = 'jamkesda';
				}
				else{
					$kategori = 'swasta_umum';
				}

				$hari = intval($tanggal[2]);
				$hari = 't'.$hari;
				$check = DB::table('lapbulanpoli')->where(
					'Bulan' , intval($tanggal[1]) )->where(
					'Tahun' , $tanggal[0] )->where(
					'Kategori' , $kategori )->where(
					'IdPoli' , Input::get('cmb2_poli') )->where(
					'Poli' , $nama_poli )->first();
				if($check){
					$lap = LapBulanPoli::find($check->id);
					$new_hari = intval($check->$hari);
					$new_hari++;
					$lap->$hari =  $new_hari;
				}
				else{
					$lap = new LapBulanPoli;
					$lap->Bulan = intval($tanggal[1]);
					$lap->Tahun = $tanggal[0];
					$lap->IdPoli = Input::get('cmb2_poli');
					$lap->Poli = $nama_poli;
					$lap->Kategori = $kategori;
					$lap->$hari = 1;
				}
				$lap->save();
				
				

				DB::table('lapharianpoli')->insert(
					$poli
				);

				$return = array('pesan'=>'sukses' , 'noreg' => $no_reg_jalan);

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
		return View::make('rawat_jalan.edit' );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('rawat_jalan.edit' );
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
			'rawat_jalan' => 'required|min:3' 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('rawat_jalan/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$rawat_jalan = rawat_jalan::find($id);
			$rawat_jalan->title = Input::get('title');
			$rawat_jalan->rawat_jalan = Input::get('rawat_jalan');
			$rawat_jalan->user_id = Auth::user()->id;
			$rawat_jalan->save();

			return Redirect::to('rawat_jalan')->with('success', 'rawat_jalan Updated Successfully.');
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

	public function rawat_jalan()
	{
		return View::make('rawat_jalan.rawat_jalan' );
	}

	/**
	 * @param void
	 * @return array
	 */
	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		if( isset($group->poli) && !empty($group->poli)){
			$poli = json_decode($group->poli);
			if( count($poli) > 0){
				$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->whereIn('IdPoli',$poli)
				->orderBy('tbpasienjalan.Tanggal','DESC')->orderBy('tbpasienjalan.jam_daftar','ASC');
			}
			else{
				$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')
				->where('tbpasien.id' , 0)->orderBy('tbpasienjalan.Tanggal','DESC')->orderBy('tbpasienjalan.jam_daftar','ASC');
			}
			
		}
		else{
			$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->where('tbpasien.id' , 0)
			->orderBy('tbpasienjalan.Tanggal','DESC')->orderBy('tbpasienjalan.jam_daftar','ASC');
		}

		return Datatable::query($pasien)
        	->addColumn('NoRM',function($model)
        	{
            	return '<a class="" href="'.url()."/rawat_jalan/pasien/".$model->IdRegJalan.'">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a class="" href="'.url()."/rawat_jalan/pasien/".$model->IdRegJalan.'">'.$model->Nama.'</a>';
        	})
        	->addColumn('Tanggal',function($model)
        	{
        		$tanggal = explode('-', $model->Tanggal);
            	return $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' / '.$model->jam_daftar;
        	})
			->showColumns('Poli','Kelurahan','KotaKab','NoRegJalan')
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" href="'.url()."/rawat_jalan/pasien/".$model->IdRegJalan.'">Proses</a>';
        	})
			->searchColumns('tbpasienjalan.NoRM','Nama','Tanggal','Poli')
			->orderColumns('tbpasienjalan.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable_keluar()
	{
		$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->orderBy('Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoRegJalan."',".
            		"'".preg_replace("/[^A-Za-z0-9 ]/", '', $model->Nama)."',".
            		"'".$model->Poli."',".
            		"'".$model->Tanggal."'".
            	')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoRegJalan."',".
            		"'".preg_replace("/[^A-Za-z0-9 ]/", '', $model->Nama)."',".
            		"'".$model->Poli."',".
            		"'".$model->Tanggal."'".
            	')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('.
            		"'".$model->NoRM."',".
            		"'".$model->NoRegJalan."',".
            		"'".preg_replace("/[^A-Za-z0-9 ]/", '', $model->Nama)."',".
            		"'".$model->Poli."',".
            		"'".$model->Tanggal."'".
            	')" href="#">'.$model->Nama.'</a>';
        	})
        	->addColumn('Tanggal',function($model)
        	{
            	return $model->Tanggal;
        	})
			->showColumns('Poli','NoRegJalan')
			->searchColumns('tbpasienjalan.NoRM','Nama')
			->orderColumns('tbpasienjalan.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatableAntrian()
	{
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$date  = date('Y-m-d');
		if( isset($group->poli) && !empty($group->poli)){
			$poli = json_decode($group->poli);
			if( count($poli) > 0){
				$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->whereIn('IdPoli',$poli)
				->where('tbpasienjalan.status' , 0)->where('tbpasienjalan.Tanggal' , '=' , $date)
				->orderBy('tbpasienjalan.Tanggal','DESC')->orderBy('tbpasienjalan.jam_daftar','ASC');
			}
			else{
				$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->where('tbpasien.id' , 0)->where('tbpasienjalan.status' , 0)->where('tbpasienjalan.Tanggal' , '=' , $date)
				->orderBy('tbpasienjalan.Tanggal','DESC')->orderBy('tbpasienjalan.jam_daftar','ASC');
			}
			
		}
		else{
			$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->where('tbpasien.id' , 0)->where('tbpasienjalan.status' , 0)->where('tbpasienjalan.Tanggal' , '=' , $date)
			->orderBy('tbpasienjalan.Tanggal','DESC')->orderBy('tbpasienjalan.jam_daftar','ASC');
		}

		return Datatable::query($pasien)
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->IdRegJalan."'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->IdRegJalan."'".')" href="#">'.$model->Nama.'</a>';
        	})
        	->addColumn('Tanggal',function($model)
        	{
        		$tanggal = explode('-', $model->Tanggal);
            	return $tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' / '.$model->jam_daftar;
        	})
			->showColumns('Poli','Jalan','Kelurahan','KotaKab','NoRegJalan')
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" href="'.url()."/rawat_jalan/pasien/".$model->IdRegJalan.'">Proses</a>'.
            	'<a class="btn" onclick="batalkan('."'".$model->NoRegJalan."'".')" href="#">Batalkan</a>';
        	})
			->searchColumns('tbpasienjalan.NoRM','Nama','Tanggal','Poli')
			->orderColumns('tbpasienjalan.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table()
	{
		$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->orderBy('tbpasienjalan.Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRM."','jalan'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRM."','jalan'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRM."','jalan'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Poli','Jalan','Kelurahan','KotaKab','NoRegJalan')
			->searchColumns('tbpasienjalan.NoRM','Nama','Tanggal','Poli')
			->orderColumns('tbpasienjalan.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_byreg()
	{
		$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->orderBy('tbpasienjalan.Tanggal','DESC');;
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRegJalan."','jalan'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegJalan."','jalan'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegJalan."','jalan'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Poli' , 'NoRegJalan' ,'Jalan','Kelurahan','KotaKab','NoRegJalan')
			->searchColumns('tbpasienjalan.NoRM','Nama','Tanggal','Poli')
			->orderColumns('tbpasienjalan.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_full()
	{
		$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->NoRegJalan."','jalan'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegJalan."','jalan'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->NoRegJalan."','jalan'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Poli' , 'NoRegJalan' ,'Sep','GolPasien','NoBPJS','Jalan')
			->searchColumns('tbpasienjalan.NoRM','Nama','Tanggal','Poli')
			->orderColumns('tbpasienjalan.NoRM','Nama','Tanggal')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function popup_table_bynorm($id)
	{
		$pasien = DB::table('tbpasienjalan')->join('tbpasien', 'tbpasienjalan.NoRM', '=', 'tbpasien.NoRM')->where('tbpasienjalan.NoRM' , $id);
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien_jalan('."'".$model->NoRegJalan."','jalan'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRegJalan',function($model)
        	{
            	return '<a onclick="pilih_pasien_jalan('."'".$model->NoRegJalan."','jalan'".')" href="#">'.$model->NoRegJalan.'</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien_jalan('."'".$model->NoRegJalan."','jalan'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien_jalan('."'".$model->NoRegJalan."','jalan'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Tanggal','Poli')
			->searchColumns('tbpasienjalan.NoRM','Nama','Tanggal','Poli')
			->orderColumns('tbpasienjalan.NoRM','Nama','Tanggal')->make();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function register()
	{
		$poli = Poli::all();
		$dokter = Dokter::all();
		return View::make('rawat_jalan.register' ,  array('poli' => $poli , 'dokter' => $dokter) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function pasien()
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

		return View::make('rawat_jalan.pasien' ,  array('poli' => $poli , 'lab' => $lab , 'rad' => $radiologi) );
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
			DB::table('tbpasienjalan')->where('IdRegJalan' , $reg)->update( array('status'=>'1') );
		}

		return View::make('rawat_jalan.pasien' ,  array( 'reg' => $reg , 'poli' => $poli , 'lab' => $lab , 'rad' => $radiologi) );
	}

	

	public function antrian()
	{
		return View::make( 'rawat_jalan.antrian' );
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
			$dokter 		= Dokter::where('IdDokter' , '=' , Input::get('id_dokter'))->get();
			$namadokter 	= "";
			foreach ($dokter as $d) {
				$namadokter = $d->NamaDokter;
			}

			$biaya_konsul	= 0;
			$pasien_jalan = DB::table('tbpasienjalan')->where('IdRegJalan' , Input::get('noreg'))->first();
			if( isset($pasien_jalan->IdPoli)){
				$poli 	= DB::table('tbpoli')->where('IdPoli' , $pasien_jalan->IdPoli)->first();
				$dokter = DB::table('tbdaftardokter')->where('IdDokter' ,Input::get('id_dokter'))->first();
				$pasien_masuk 	= DB::table('tbmasukrs')->where('NoReg' , $pasien_jalan->NoRegJalan)->first();

				$tindakan 	= array();
				if(isset($poli->NamaPoli)){
					$nama_poli 	= $poli->NamaPoli;

					$tipe_poli 	= $poli->TipePoli;

					if(isset($poli->NamaPoli)){
						$nama_poli 	= $poli->NamaPoli;

						$tipe_poli 	= $poli->TipePoli;

						if( $tipe_poli == '3' ){
							if(isset($dokter->Spesialisasi)){
								//jika dokter umum
								if($dokter->Spesialisasi == 0 || $dokter->Spesialisasi == 1){
									$jams 	= explode(':' , $pasien_masuk->JamMasuk );
									$jam 	= intval($jams[0]);
									if( $jam < 8 || $jam >= 15 ){
										$luar_jam = 1;
									}
									else{
										$luar_jam = 0;
									}

									$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
													->where('Spesialisasi' , 1)->where('LuarJam',$luar_jam)->first();

									if(isset($konsul->IdTindakan)){
										$tb = DB::table('tbtindakan')->where('IdTindakan' , $konsul->IdTindakan)->first();
										if( isset($tb->IdTindakan)){
											$tindakan[] 	= array('id' => $konsul->IdTindakan , 'nama' => $tb->Tindakan , 
											'tipe' => 'konsul' );

											$biaya_konsul 	= $tb->Tarif;
										}
										
									}
								}
								else{
									$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
													->where('Spesialisasi' , 2)->first();

									if(isset($konsul->IdTindakan)){
										$tb = DB::table('tbtindakan')->where('IdTindakan' , $konsul->IdTindakan)->first();
										if( isset($tb->IdTindakan)){
											$tindakan[] 	= array('id' => $konsul->IdTindakan , 'nama' => $tb->Tindakan , 
											'tipe' => 'konsul' );

											$biaya_konsul 	= $tb->Tarif;
										}
										
									}
									
								}
							}
						}
						else if($tipe_poli == 1){

						}
						else{
							$konsul 	= DB::table('tbtarifkonsul')->where('TipePoli' , $tipe_poli)
													->where('Spesialisasi' , 2)->first();

							if(isset($konsul->IdTindakan)){
								$tb = DB::table('tbtindakan')->where('IdTindakan' , $konsul->IdTindakan)->first();
								if( isset($tb->IdTindakan)){
									$tindakan[] 	= array('id' => $konsul->IdTindakan , 'nama' => $tb->Tindakan , 
											'tipe' => 'konsul' );

									$biaya_konsul 	= $tb->Tarif;
								}
							}
						}

						$norm 		= Input::get('norm');

						if( count($tindakan) > 0 ){
							foreach($tindakan as $ti){
								$tindakan = new DetailTindakan;
								$tindakan->NoRM = $norm;
								$tindakan->JenisRawat = $nama_poli;
								$tindakan->TanggalMasuk = $pasien_jalan->Tanggal;
								$tindakan->TanggalTindak = $pasien_jalan->Tanggal;
								$tindakan->IdTindakan = $ti['id'];
								$tindakan->Tindakan = $ti['nama'];
								$tindakan->NoReg =  $pasien_jalan->NoRegJalan;

								$id_tindak = $ti['id'];
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
									$bek 	= 0;
								}
								$tindakan->Tarif 	= $tarif;
								$tindakan->Adm 		= $adm;
								$tindakan->Fas 		= $fas;
								$tindakan->Bek 		= $bek;
								$tindakan->Gol 		= $gol;
								$tindakan->IdReg 	= $pasien_jalan->IdRegJalan;
								$tindakan->Tipe 	= $ti['tipe'];

								$tindakan->save();
							}
							
						}
					}
				}

			}
				
			/*
			$detail_dokter = new DetailDokter;
			$detail_dokter->IDDokter = Input::get('id_dokter');
			$detail_dokter->NoReg = Input::get('noreg');
			$detail_dokter->Nama = Input::get('nama');
			$detail_dokter->NoRM = Input::get('norm');
			$detail_dokter->Kategori = Input::get('kategori');

			

			$detail_dokter->save();
			*/
			DB::table('tbpasienjalan')->where('IdRegJalan' , Input::get('noreg'))->update(
				array(
						'IdDokter' 		=> Input::get('id_dokter') ,
						'Dokter' 		=> $namadokter ,
						'BiayaKonsul'	=> $biaya_konsul
				)
			);
		}

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
	public function hapus_pasien()
	{
		$idreg = Input::get('idreg');
		$delete = DB::table('tbpasienjalan')->where('IdRegJalan', '=', $idreg)->delete();
		echo $delete;
	}

	public function list_tindakan($id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$user = Auth::user();
			$group = Group::find( $user->group_id );
			$slug = $group->slug;
           	$ids = str_replace("poli_", "", $slug);
			$permissions = $group->permissions;

	        if($permissions == 'all')
	        	$ids = 'all';
           	if($ids == 'all'){
           		$pasien = DB::table('tbdetailtindakan')->where('NoReg', '=', $id)->get();
           	}
           	else{
           		$pasien = DB::table('tbdetailtindakan')->where('NoReg', '=', $id)->where('GOL' ,'LIKE', '%'.$ids.'%' )->get();
           	}
			
			echo(json_encode($pasien));
		}
	}

	public function tambah_tindakan()
	{
		$tindakan = new DetailTindakan;
		$tindakan->NoRM = Input::get('norm');
		$tindakan->JenisRawat = 'Rawat Jalan';
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

	public function get_single_poli(){
		$field = Input::get('field');
		$id_poli = Input::get('id_poli');
		$poli = DB::table('tbpoli')->where('IdPoli',$id_poli)->first();
		echo $poli->$field;
	}

	public function list_poli($id){
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasienjalan')->where('NoRegJalan', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function tambah_poli(){
		$noreg = Input::get('noreg');
		$id_poli = Input::get('id_poli');
		$pasien = DB::table('tbpasienjalan')->where('NoRegJalan', '=', $noreg)->where('IdPoli','=',$id_poli)->first();
		if(isset($pasien->NoRegJalan)){
			die('ada');
		}
		else{
			$jalan = DB::table('tbpasienjalan')->where('NoRegJalan', '=', $noreg)->first();
			$poli = DB::table('tbpoli')->where('IdPoli',$id_poli)->first();
			if(isset($poli->NamaPoli))
				$nama_poli = $poli->NamaPoli;
			else
				$nama_poli = "";
			
			if(isset($jalan->NoRegJalan)){
				$rawat_jalan = new RawatJalan;
				$rawat_jalan->NoRM = $jalan->NoRM;
				$rawat_jalan->Tanggal = $jalan->Tanggal;
				$rawat_jalan->IdPoli = $id_poli;

				
				$rawat_jalan->Poli = $nama_poli;
				$rawat_jalan->NoRegJalan = $jalan->NoRegJalan;
				$rawat_jalan->save();
				die('sukses');
			}
			else{
				die('Terjadi kesalahan input');
			}
			
		}
	}

	public function hapus_poli(){
		$id_reg 	= Input::get('idreg');
		$no_reg 	= Input::get('no_reg');

		if( isset($id_reg) && !empty($id_reg) ){
			// check jika bukan single

			$check 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $no_reg)->get();

			if( count($check) > 1 ){
				DB::table('tbpasienjalan')->where('IdRegJalan' , $id_reg)->delete();
				echo 'Data berhasil dihapus';

				die();
			}
			else{
				die('Mohon tambahkan poli lain terlebih dahulu');
			}
		}
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

	public function cetakStruk($id){
		$data 		= DB::table('tbpasienjalan')->where('NoRegJalan',$id)->first();
		if( !isset($data->NoRegJalan))
			die('');

		$norm 		= $data->NoRM;
		$pasien 	= DB::table('tbpasien')->where('NoRM' , $norm)->first();

		$count 		= DB::table('tbpasienjalan')->where('Tanggal' , $data->Tanggal)->where('IdRegJalan' , '<=',$data->IdRegJalan)->count();
		$cek  		= DB::table('tbpasienjalan')->where('NoRM',$norm)->where('IdRegJalan' , '<=',$data->IdRegJalan)->count();

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

		$html = '<div align="center" style="font-size:13px;text-align:center;"><u>'.$this->rs_title."</u><br />Struk Rawat Jalan</div>";
		$html .= "<br />No RM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$txt2;
		$html .= "<br />Antrian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$count;
		$html .= "<br />Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ".$data->Tanggal;
		$html .= "<br />Nama  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   : ".$txt1."  ($pas)";
		$html .= "<br />Jenis Pembayaran  : ".$data->CaraBayar;
		$html .= "<br />Poli  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$data->Poli;
		$html .= "<br />Pelayanan  &nbsp;&nbsp;: ";
		$html .= "<br /><br /><br /><br /><br />Tindakan  : ";
		$html .= "<br /><br /><br /><br /><br /><br />Pemeriksaan Penunjang  : ";
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('cetak_struk.pdf', 'I');
	}

	public function rujuk_ruangan(){
		$id_ruangan 	= Input::get('id_ruangan');
		$id_reg 		= Input::get('id');

		$check 		= DB::table('tbpasieninap')->where('NoRegJalan' , $id_reg)->first();
		if( isset($check->NoRegJalan) ){
			$return = array('status'=>'gagal' , 'pesan' => 'Gagal merujuk pasien ke rawat inap, pasien telah dirujuk sebelumnya');

			echo json_encode($return);
		}
		else{
			$data 		= DB::table('tbpasienjalan')->where('NoRegJalan',$id_reg)->first();
			if( isset($data->NoRegJalan)) {		
				$norm 					= $data->NoRM;
				$pasien_masuk  			= new PasienMasuk;
				$pasien_masuk->NoReg 	= time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$pasien_masuk->NoRM 	= $norm;
				$pasien_masuk->TglMasuk = date('Y-m-d');
				$pasien_masuk->JamMasuk = date('h:i:s');
				$pasien_masuk->JenisRawat = 'Rawat Inap';
				$pasien_masuk->Keterangan = "";
				$pasien_masuk->save();

				$rawat_inap = new RawatInap;
				$rawat_inap->IdInap 	= time().mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
				$rawat_inap->NoRM 		= $norm;
				$rawat_inap->Tanggal 	= $pasien_masuk->TglMasuk;
				$rawat_inap->Jam 		= $pasien_masuk->JamMasuk;
				$rawat_inap->CaraBayar 	= $data->CaraBayar;

				$rawat_inap->IdRuangan = $id_ruangan;
				if(  $id_ruangan != '-' ||   $id_ruangan !='' ){
					$ruangan = Ruangan::where('IdRuang' , '=' ,  $id_ruangan)->get();
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
				$ruang = DB::table('tbruangan')->where('IdRuang' ,  $id_ruangan)
						->update(array('Status' => 1));
				$rawat_inap->NoReg = $pasien_masuk->NoReg;
				$rawat_inap->NoRegJalan = $id_reg;
				$rawat_inap->save();

				$return = array('status'=>'sukses' , 'pesan' => 'Pasien berhasil dirujuk ke rawat inap');

				echo json_encode($return);
				die();
			}
			else{
				$return = array('pesan'=>'Data pasien tidak ditemukan' , 'status' => 'gagal');

				echo json_encode($return);
				die();
			}
		}
	}

	public function list_rawatinap($id=0){
		$data 	= DB::table('tbpasieninap')->where('NoRegJalan' , $id)->get();
		if( count($data) > 0 ){
			$ruangan 	= $kelas 	= $no = "";
			foreach($data as $d){
				$ruangan 	= $d->Ruangan;
				$kelas 		= $d->Kelas;
				$no 		= $d->NoKamar;
			}
			$return = array('status' => true, 'ruangan' => $ruangan , 'pesan' => 'Pasien telah dirujuk rawat inap ke Ruangan '.$ruangan.' '.$kelas.' No Kamar :'.$no);

			echo json_encode($return);
			die();
		}
		else{
			$return = array('status' => false);

			echo json_encode($return);
			die();
		}
	}
}
