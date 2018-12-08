<?php

class SepController extends \BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function setDb()
	{
       $this->database = 'mysql';
	}

	public function dataPeserta()
	{
		return View::make('sep.data_peserta');
	}

	public function dataPesertaView()
	{
		$this->setDb();
		$peserta = DB::connection($this->database)->table('datnkapst')
											->join('refklsrwt', 'datnkapst.KDKLSRAWAT', '=', 'refklsrwt.KdKlsRwt')
											->join('refpisa', 'datnkapst.PISAPST', '=', 'refpisa.PISAPST')
											->join('refppk', 'datnkapst.PPKPST', '=', 'refppk.KDPPK');
								
		return Datatable::query($peserta)
			->showColumns('NOKAPST','NIK','NMPST')
			->addColumn('TGLLHRPST', function($model)
			{
				return DateTime::createFromFormat('Y-m-d H:i:s', $model->TGLLHRPST)->format('d/m/Y');
				
			})
			->addColumn('JKPST', function($model)
			{
				if($model->JKPST == 'L') $jk = 'Laki-Laki';
				else $jk = 'Perempuan';
				return $jk;
			})
			->addColumn('KDKLSRAWAT',function($model)
        	{
            	return $model->NmKlsRwt;
        	})
			->addColumn('actions',function($model)
        	{
				if($model->JKPST == 'L') $jk = 'Laki-Laki';
				else $jk = 'Perempuan';
				return '<a href="javascript:void(0)" onclick="detail_data('."'".$model->NOKAPST."',
																		'".date( "d/m/Y", strtotime($model->TGLCETAK))."',
																		'".$model->NIK."',
																		'".$model->NMPST."',
																		'".$model->NMPISAPST."',
																		'".$jk."',
																		'".date( "d/m/Y", strtotime($model->TGLLHRPST))."',
																		'".$model->NmKlsRwt."',
																		'".$model->NMPPK."'".')"><i class="splashy-zoom"></i></a>&nbsp;&nbsp;';
        	})
			->searchColumns('NOKAPST','NIK','NMPST')
			->orderColumns('NMPST')->make();
	}

	private function setTipePeserta($tipe)
	{
		if($tipe == 'bpjs'){
			$this->title = 'No Kartu BPJS';
			$this->slug = 'bpjs';
			$this->ref = '';
		}
		else{
			$this->title = 'No NIK';
			$this->slug = 'nik';
			$this->ref = 'nik/';
		}
	}
	
	public function peserta($tipe)
	{
		$this->setTipePeserta($tipe);
		return View::make('sep.peserta',
			array(
				'title' => $this->title,
				'slug' => $this->slug
			));
	}
	
	public function pesertaView($tipe)
	{
		$this->setTipePeserta($tipe);
		$nomor = Input::get('nomor');
		$this->genCode();
		$konten = '';
		//$url = "http://api.asterix.co.id/SepWebRest/peserta/".$this->ref.$nomor;
		$url = Config::get('settings.url')."/peserta/".$this->ref.$nomor;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		
		if($this->slug=='bpjs'){
			$show = $data['response']['peserta'];
			$dasar = $show['noKartu'];
		}
		else{
			$show = $data['response']['list'][0];
			$dasar = $show['nik'];
		}
		
		return View::make('sep.peserta_view' , 
			array(
				'show' => $show,
				'meta' => $data['metaData']['code'],
				'title' => $this->title,
				'slug' => $this->slug,
				'tipe' => $tipe,
				'dasar' => $dasar
			)
		);
	}

	public function pesertaInfo($nomor="")
	{
		$this->genCode();
		$konten = '';
		//$url = "http://api.asterix.co.id/SepWebRest/peserta/".$this->ref.$nomor;
		$url = Config::get('settings.url')."/peserta/".$nomor;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);		
		

		if( isset($data['response']['peserta'])){
			$show = $data['response']['peserta'];
			$dasar = $show['noKartu'];
		}
		else{
			$show = array('response' => '404');
			$dasar = '';
		}
		echo json_encode( $show );
	}

	private function setTipeRujukan($tipe)
	{
		if($tipe == 'bpjs'){
			$this->title = 'No Kartu BPJS';
			$this->slug = 'bpjs';
			$this->ref = 'peserta/';
		}
		elseif($tipe == 'nik'){
			$this->title = 'No NIK';
			$this->slug = 'nik';
			$this->ref = 'peserta/';
		}
		else{
			$this->title = 'No Rujukan';
			$this->slug = 'rujukan';
			$this->ref = '';
		}
	}
	
	public function rujukan($tipe)
	{
		$this->setTipeRujukan($tipe);
		return View::make('sep.rujukan',
			array(
				'title' => $this->title,
				'slug' => $this->slug
			));
	}
	
	public function rujukanView($tipe)
	{
		$this->setTipeRujukan($tipe);
		$nomor = Input::get('nomor');
		$this->genCode();
		$konten = '';
		$url = "http://api.asterix.co.id/SepWebRest/rujukan/".$this->ref.$nomor;
		//$url = Config::get('settings.url')."/rujukan/".$this->ref.$nomor;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		
		if($tipe=='bpjs'){
			$show = $data['response']['item'];
			//$dasar = $show['peserta']['noKartu'];
		}
		elseif($tipe=='nik'){
			$show = $data['response']['item'];
			//$dasar = $show['peserta']['nik'];
		}
		else{
			$show = $data['response']['item'];
			//$dasar = $show['noKunjungan'];
		}
		
		if($show['peserta']['sex']=='L') $jk = 'Laki-Laki'; else $jk = 'Perempuan';
				$this->setDb();
				
		$peserta = DB::connection($this->database)->table('refpisa')->where('PISAPST', $show['peserta']['pisa'])->first();
								
		return View::make('sep.rujukan_view' , 
			array(
				'show' => $show,
				'meta' => $data['metaData']['code'],
				'title' => $this->title,
				'slug' => $this->slug,
				'tipe' => $tipe,
				'dasar' => $nomor,
				'jk' => $jk,
				'pisa' => $peserta->NMPISAPST
			)
		);
	}

	public function cobaList()
	{
		return View::make('sep.coba_list');
	}

	public function daftarPasien()
	{
		return View::make('sep.daftar_pasien');
	}

	public function daftarPasienView()
	{
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
		$tanggal = $date->format('Y-m-d');
		$jumlah = Input::get('jumlah');
		$this->genCode();
		$konten = '';
		$url = "http://api.asterix.co.id/SepWebRest/rujukan/tglrujuk/".$tanggal."/query?start=1&limit=".$jumlah;
		//$url = "http://api.asterix.co.id/SepWebRest/rujukan/tglrujuk/2015-03-24/query?start=1&limit=10";
		//$url = Config::get('settings.url')."/rujukan/tglrujuk/".$tanggal."/query?start=1&limit=".$jumlah;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		$show = $data['response'];
		
		if($show['count']>$show['limit']) $banyak_data = $show['limit'];
		else $banyak_data = $show['count'];
			
		return View::make('sep.daftar_pasien_view' , 
			array(
				'show' => $show,
				'meta' => $data['metaData']['code'],
				'tanggal' => $date->format('d-m-Y'),
				'banyak_data' => $banyak_data
			)
		);
	}

	public function ppkNew()
	{
		return View::make('sep.ppk_new');
	}

	public function ppkNewView()
	{
		$this->setDb();
		$peserta = DB::connection($this->database)->table('refppk')->join('refdati2', 'refppk.Dati2PPK', '=', 'refdati2.KdDati2');
		return Datatable::query($peserta)
			->showColumns('KDPPK','NMPPK')
			->addColumn('NMJLNPPK', function($model)
			{
				if(($model->RTPPK == '') || ($model->RTPPK == '0') || ($model->RTPPK == 'nul') || ($model->RTPPK == '-')){
					return $model->NMJLNPPK;
				}
				else {
					return $model->NMJLNPPK.' RT:'.$model->RTPPK.' RW:'.$model->RWPPK;
				}
			})
			->addColumn('NmDati2', function($model)
			{
				return $model->NmDati2;
			})
			->searchColumns('KDPPK','NMPPK','NMJLNPPK')
			->orderColumns('NMPPK')->make();
	}

	public function diagnosaSearch()
	{
		$this->setDb();
		$peserta = DB::connection('mysql')->table('refdiagnosis');
		return Datatable::query($peserta)
			->addColumn('pilih',function($model)
        	{
				return '<a class="btn" onclick="pilih_diagnosa('.
						"'".$model->IdDiag."',".
						"'".$model->IdDiag.' - '.$model->ShortDiagnoisDesc."'".
						')" href="#">Pilih</a>';
        	})
			->showColumns('IdDiag','ShortDiagnoisDesc')
			->searchColumns('IdDiag','ShortDiagnoisDesc')
			->orderColumns('Code')->make();
	}

	public function poliSearch()
	{
		$this->setDb();
		$peserta = DB::connection('mysql')->table('refpoli');
		return Datatable::query($peserta)
			->addColumn('pilih',function($model)
        	{
				return '<a class="btn" onclick="pilih_poli('.
						"'".$model->KDPOLI."',".
						"'".$model->NMPOLI."'".
						')" href="#">Pilih</a>';
        	})
			->showColumns('KDPOLI','NMPOLI')
			->searchColumns('NMPOLI')
			->orderColumns('NMPOLI')->make();
	}

	public function ppkPelayananSearch()
	{
		$this->setDb();
		$peserta = DB::connection('mysql')->table('refppk')->join('refdati2', 'refppk.Dati2PPK', '=', 'refdati2.KdDati2');
		return Datatable::query($peserta)
			->addColumn('pilih',function($model)
        	{
				return '<a class="btn" onclick="pilih_ppk_pelayanan('.
						"'".$model->KDPPK."',".
						"'".$model->KDPPK.' - '.$model->NMPPK."'".
						')" href="#">Pilih</a>';
        	})
			->showColumns('KDPPK','NMPPK')
			->addColumn('NMJLNPPK', function($model)
			{
				if(($model->RTPPK == '') || ($model->RTPPK == '0') || ($model->RTPPK == 'nul') || ($model->RTPPK == '-')){
					return $model->NMJLNPPK;
				}
				else {
					return $model->NMJLNPPK.' RT:'.$model->RTPPK.' RW:'.$model->RWPPK;
				}
			})
			->addColumn('NmDati2', function($model)
			{
				return $model->NmDati2;
			})
			->searchColumns('KDPPK','NMPPK','NMJLNPPK')
			->orderColumns('NMPPK')->make();
	}

	public function ppkRujukanSearch()
	{
		$this->setDb();
		$peserta = DB::connection('mysql')->table('refppk')->leftJoin('refdati2', 'refppk.Dati2PPK', '=', 'refdati2.KdDati2');
		return Datatable::query($peserta)
			->addColumn('pilih',function($model)
        	{
				return '<a class="btn" onclick="pilih_ppk_rujukan('.
						"'".$model->KDPPK."',".
						"'".$model->KDPPK.' - '.$model->NMPPK."'".
						')" href="#">Pilih</a>';
        	})
			->showColumns('KDPPK','NMPPK')
			->addColumn('NMJLNPPK', function($model)
			{
				if(($model->RTPPK == '') || ($model->RTPPK == '0') || ($model->RTPPK == 'nul') || ($model->RTPPK == '-')){
					return $model->NMJLNPPK;
				}
				else {
					return $model->NMJLNPPK.' RT:'.$model->RTPPK.' RW:'.$model->RWPPK;
				}
			})
			->addColumn('NmDati2', function($model)
			{
				return $model->NmDati2;
			})
			->searchColumns('KDPPK','NMPPK','NMJLNPPK')
			->orderColumns('NMPPK')->make();
	}

	public function ppkData()
	{
		return View::make('sep.ppk_data');
	}

	public function ppkDataView()
	{
		$nama = Input::get('nama');
		$jumlah = Input::get('jumlah');
		$this->genCode();
		$konten = '';
		$method = 'GET';
		$url = Config::get('settings.url')."/ref/provider/query?nama=".$nama."&start=1&limit=".$jumlah;
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		$show = $data['response'];
		
		if($show['count']>$show['limit']) $banyak_data = $show['limit'];
		else $banyak_data = $show['count'];
		
		return View::make('sep.ppk_data_view' , 
			array(
				'show' => $show,
				'meta' => $data['metaData']['code'],
				'nama' => $nama,
				'banyak_data' => $banyak_data
			)
		);
	}

	public function sepCreate()
	{
		$this->setDb();
		$jenis_pelayanan = DB::connection($this->database)->table('refjnspelsjp')->get();
		$kelas_rawat = DB::connection($this->database)->table('refklsrwt')->get();
		$pesan = '';
		return View::make('sep.create_sep' , 
				array(
					'jenis_pelayanan' => $jenis_pelayanan,
					'kelas_rawat' => $kelas_rawat,
					'pesan' => $pesan
				)
			);
	}

	public function sepCreateProcess()
	{
		$no_kartu = Input::get('no_kartu');

		$masa_sep = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_sep'));
		$tanggal_sep = $masa_sep->format('Y-m-d H:i:s');
		
		$masa_rujukan = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_rujukan'));
		$tanggal_rujukan = $masa_rujukan->format('Y-m-d H:i:s');

		$no_rujukan = Input::get('no_rujukan');
		$ppk_rujukan = Input::get('ppk_rujukan');
		$ppk_pelayanan = Input::get('ppk_pelayanan');
		$jenis_pelayanan = Input::get('jenis_pelayanan');
		$catatan = Input::get('catatan');
		$diagnosa_awal = Input::get('diagnosa_awal');
		$poli = Input::get('poli');
		$kelas_rawat = Input::get('kelas_rawat');
		$user = Input::get('user');
		$no_mr = Input::get('no_mr');
		
		$this->genCode();
		$method = 'POST';
		$konten = "<request>
					<data>
					<t_sep>
					<noKartu>".$no_kartu."</noKartu>
					<tglSep>".$tanggal_sep."</tglSep>
					<tglRujukan>".$tanggal_rujukan."</tglRujukan>
					<noRujukan>".$no_rujukan."</noRujukan>
					<ppkRujukan>".$ppk_rujukan."</ppkRujukan>
					<ppkPelayanan>".$ppk_pelayanan."</ppkPelayanan>
					<jnsPelayanan>".$jenis_pelayanan."</jnsPelayanan>
					<catatan>".$catatan."</catatan>
					<diagAwal>".$diagnosa_awal."</diagAwal>
					<poliTujuan>".$poli."</poliTujuan>
					<klsRawat>".$kelas_rawat."</klsRawat>
					<user>".$user."</user>
					<noMr>".$no_mr."</noMr>
					</t_sep>
					</data>
					</request>";
			
		$url = Config::get('settings.url')."/sep/";
		//$url = "http://api.asterix.co.id/SepWebRest/sep/create/";
		$tipe = 'xml';
		$data = $this->getData($url,$konten,$method,$tipe);
		if(($data['metaData']['code'] == '200') || ($data['metaData']['code'] == '400')){
			$show = $data['response'];
			echo $show;
		}
		else{
			echo 'Pembuatan SEP Baru tidak berhasil, silahkan ulangi lagi. ('.$data['metaData']['code'].')';
		}
	}

	public function sepDetail()
	{
		return View::make('sep.detail');
	}
	
	public function sepDetailView($sep_created)
	{
		if($sep_created == 'sep') $nomor = Input::get('nomor');
		else $nomor = $sep_created;
		
		$this->genCode();
		$konten = '';
		$url = Config::get('settings.url')."/sep/".$nomor;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		$show = $data['response']['sep'];

		if($show['peserta']['sex']=='L') $jk = 'Laki-Laki'; else $jk = 'Perempuan';
				$this->setDb();

		$peserta = DB::connection($this->database)->table('refpisa')->where('PISAPST', $show['peserta']['pisa'])->first();
		
		if(isset($peserta->NMPISAPST)){
			return View::make('sep.detail_view' , 
				array(
					'show' => $show,
					'meta' => $data['metaData']['code'],
					'nomor' => $show['noSep'],
					'jk' => $jk,
					'pisa' => $peserta->NMPISAPST
				)
			);
		}
		
	}

	public function updateTanggalPulang()
	{
		$pesan = '';
		return View::make('sep.update_tanggal_pulang' , 
				array(
					'pesan' => $pesan
				)
			);
	}

	public function updateTanggalPulangProcess()
	{
		$no_sep = Input::get('no_sep');

		$masa_sep = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_pulang'));
		$tanggal_pulang = $masa_sep->format('Y-m-d H:i:s');
		
		$ppk_pelayanan = Input::get('ppk_pelayanan');
		
		$this->genCode();
		$method = 'PUT';
		$konten = "<request>
					<data>
					<t_sep>
					<noSep>".$no_sep."</noSep>
   					<tglPlg>".$tanggal_pulang."</tglPlg>
					<ppkPelayanan>".$ppk_pelayanan."</ppkPelayanan>
					</t_sep>
					</data>
					</request>";
			
		$url = Config::get('settings.url')."/sep/updtglplg/";
		$tipe = 'xml';
		$data = $this->getData($url,$konten,$method,$tipe);
		if(($data['metaData']['code'] == '200') || ($data['metaData']['code'] == '400')){
			$show = $data['response'];
			echo $show;
		}
		else{
			echo 'Update tanggal pulang tidak berhasil, silahkan ulangi lagi';
		}
	}

	public function sepDelete()
	{
		$pesan = '';
		return View::make('sep.delete_sep' , 
				array(
					'pesan' => $pesan
				)
			);
	}

	public function sepDeleteProcess()
	{
		$no_sep = Input::get('no_sep');
		$no_kartu = Input::get('no_kartu');
		$ppk_pelayanan = Input::get('ppk_pelayanan');
		
		$this->genCode();
		$method = 'DELETE';
		$konten = "<request>
					<data>
					<t_sep>
   					<noKartu>".$no_kartu."</noKartu>
					<noSep>".$no_sep."</noSep>
					<ppkPelayanan>".$ppk_pelayanan."</ppkPelayanan>
					</t_sep>
					</data>
					</request>";
			
		$url = Config::get('settings.url')."/sep/";
		$tipe = 'xml';
		$data = $this->getData($url,$konten,$method,$tipe);
		if(($data['metaData']['code'] == '200') || ($data['metaData']['code'] == '400')){
			$show = $data['response'];
			echo $show;
		}
		else{
			echo 'Hapus data SEP tidak berhasil, silahkan ulangi lagi';
		}
	}

	public function listSep()
	{
		return View::make('sep.list_sep');
	}

	public function listSepView($no_kartu)
	{
		$this->genCode();
		$konten = '';
		$url = Config::get('settings.url')."/sep/peserta/".$no_kartu;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		$show = $data['response'];
		//print_r($data);
		//$url2 = "http://api.asterix.co.id/SepWebRest/peserta/".$no_kartu;
		$url2 = Config::get('settings.url')."/peserta/".$no_kartu;
		$data2 = $this->getData($url2,$konten,$method,$tipe);
		
		if(isset($data2['response']['peserta']))
			$show2 = $data2['response']['peserta'];
		else
			$show2 = "";
		
		//print_r($data2);
		if($show['count']>$show['limit']) $banyak_data = $show['limit'];
		else $banyak_data = $show['count'];
		
		
		return View::make('sep.list_view' , 
			array(
				'show' => $show,
				'show2' => $show2,
				'meta' => $data['metaData']['code'],
				'banyak_data' => $banyak_data
			)
		);
		
	}

	public function listSepJson($no_kartu)
	{
		$this->genCode();
		$konten = '';
		$url = Config::get('settings.url')."/sep/peserta/".$no_kartu;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		$show = $data['response'];
		//print_r($data);
		//$url2 = "http://api.asterix.co.id/SepWebRest/peserta/".$no_kartu;
		$url2 = Config::get('settings.url')."/peserta/".$no_kartu;
		$data2 = $this->getData($url2,$konten,$method,$tipe);
		
		if(isset($data2['response']['peserta']))
			$show2 = $data2['response']['peserta'];
		else
			$show2 = "";
		
		//print_r($data2);
		if(isset($show['count'])){
			if($show['count']>$show['limit']) $banyak_data = $show['limit'];
			else $banyak_data = $show['count'];
		}
		else{
			$banyak_data = 0;
		}
		
		print_r($show);
		if(isset($show['list']))
			echo json_encode($show['list']); 
		else
			echo json_encode( array());
		/*
		return View::make('sep.list_view' , 
			array(
				'show' => $show,
				'show2' => $show2,
				'meta' => $data['metaData']['code'],
				'banyak_data' => $banyak_data
			)
		);
		*/
		
	}

	public function genCode()
	{
	   	$data 		= Config::get('settings.vklaim_xcons-id');
	   	$secretKey 	= Config::get('settings.vklaim_secretkey');
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
	   	$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
	   	$encodedSignature = base64_encode($signature);
		$this->X_cons_id = $data;
		$this->X_timestamp = $tStamp;
		$this->X_signature = $encodedSignature;
		return;
	}

	public function getData($url,$konten,$method,$tipe)
	{
		$opts = array(
			  'http'=>array(
				'method'=>$method,
				'header'=>"Content-type: application/".$tipe."\r\n" .
						  "X-cons-id: ".$this->X_cons_id."\r\n" .
						  "X-timestamp:".$this->X_timestamp."\r\n" .
						  "X-signature: ".$this->X_signature."\r\n",
				'content' => $konten
			  )
		);
		
		$context = stream_context_create($opts);
		$data = json_decode(@file_get_contents($url, false, $context),true);
		return $data;
	}

	public function updateNorm()
	{
		$pesan = '';
		return View::make('sep.update_norm' ,
			array( 'pesan' => $pesan)
		);
	}

	public function sepPrint($nomor)
	{
		$this->genCode();
		$konten = '';
		$url = Config::get('settings.url')."/sep/".$nomor;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		$show = $data['response']['sep'];

		if($show['peserta']['sex']=='L') $jk = 'Laki-Laki'; else $jk = 'Perempuan';
		
		$this->setDb();
		$peserta = DB::connection($this->database)->table('refpisa')->where('PISAPST', $show['peserta']['pisa'])->first();
		
		return View::make('sep.sep_print' , 
			array(
				'show' => $show,
				'meta' => '200',
				'nomor' => $show['noSep'],
				'jk' => $jk,
				'pisa' => $peserta->NMPISAPST
			)
		);
	}

	public function sepPrint2($nomor)
	{
		$this->genCode();
		$konten = '';
		$url = Config::get('settings.url')."/sep/".$nomor;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		$show = $data['response']['sep'];

		if($show['peserta']['sex']=='L') $jk = 'Laki-Laki'; else $jk = 'Perempuan';
		
		$this->setDb();
		$peserta = DB::connection($this->database)->table('refpisa')->where('PISAPST', $show['peserta']['pisa'])->first();
		
		return View::make('sep.sep_print2' , 
			array(
				'show' => $show,
				'meta' => $data['metaData']['code'],
				'nomor' => $show['noSep'],
				'jk' => $jk,
				'pisa' => $peserta->NMPISAPST
			)
		);
	}

	public function updateSep(){
		$no_reg = Input::get('no_reg');
		$type = Input::get('jenis_pelayanan');
		$sep = Input::get('sep');

		if($type == 'Rawat Jalan'){
			$table = 'tbpasienjalan';
			$field = 'NoRegJalan';
		}
		else if($type == 'Rawat Inap'){
			$table = 'tbpasieninap';
			$field = 'NoReg';
		}
		else{
			$table = 'tbpasienugd';
			$field = 'NoRegUGD';
		}
		$update = DB::table($table)->where($field , $no_reg)->update(array('Sep' => $sep));

		echo $update;
	}

	public function cetakSep()
	{
		return View::make('sep.cetak_sep');
	}

	public function getPpkData()
	{
		$this->setDb();
		$term = Input::get('term');
		$results = array();
		$queries = DB::connection($this->database)->table('refppk')->join('refdati2', 'refppk.Dati2PPK', '=', 'refdati2.KdDati2')
			->where('KDPPK', 'LIKE', '%'.$term.'%')
			->orWhere('NMPPK', 'LIKE', '%'.$term.'%')->take(10)->get();
		foreach ($queries as $query){
			$results[] = [ 'id' => $query->KDPPK, 'value' => $query->KDPPK.' - '.$query->NMPPK ];
		}
		return Response::json($results);
	}

	public function getDiagnosaData()
	{
		$this->setDb();
		$term = Input::get('term');
		$results = array();
		$queries = DB::connection($this->database)->table('refdiagnosis')
			->where('IdDiag', 'LIKE', '%'.$term.'%')
			->orWhere('ShortDiagnoisDesc', 'LIKE', '%'.$term.'%')->take(10)->get();
		foreach ($queries as $query){
			$results[] = [ 'id' => $query->IdDiag, 'value' => $query->IdDiag.' - '.$query->ShortDiagnoisDesc ];
		}
		return Response::json($results);
	}

}