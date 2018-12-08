<?php

class ApotekKeluarController extends \CrudController {

	public $pref = "as";
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Transaksi Penjualan';
	public $table 		= 'apo_penjualan';
	public $slug 		= 'apotek_keluar';
	public $controller 	= 'ApotekKeluarController';
	public $primary 	= 'id';

	public $order 		= array('id' , 'DESC');

	public $filter 			= array( 
										'dari_tanggal' => 'apo_penjualan.tanggal_transaksi',
										'sampai_tanggal' => 'apo_penjualan.tanggal_transaksi' );

	public function getColumns(){
		$column = array();

		$column['tanggal_transaksi'] 	= array( 'title' => 'Tanggal Transaksi' , 'type' => 'date' );
		$column['jenis_penjualan']		= 'Jenis Pelayanan';
		$column['Nama']					= 'Nama';
		$column['CaraBayar']			= 'Cara Bayar';
		$column['subtotal']				= array( 'title' => 'Subtotal' , 'type' => 'currency' );
		$column['ujr']					= array( 'title' => 'UJR' , 'type' => 'currency' );
		$column['total'] 				= array( 'title' => 'Total' , 'type' => 'currency' );
		$column['tanggal_input'] 	= array( 'title' => 'Tanggal Sistem' , 'type' => 'datetime' );

		return $column;
	}

	public function create($pref='askes')
	{
		$this->setPref($pref);
		$jenis_obat = DB::table('apo_jenisobat')->get();
		return View::make('apotek.general.transaksi.create' , array(
			'pref' 			=> $this->pref,
			'title' 		=> $this->title,
			'slug' 			=> $this->slug,
			'jenis_obat' 	=> $jenis_obat,
			'id_penjualan'	=> 0
		));
	}

	public function getdata($pref="askes")
	{
		$this->setPref($pref);
		$term = Input::get('term');
		$results = array();
		$queries = DB::table('apo_obat')->where('namaobat', 'LIKE', '%'.$term.'%')->take(10)->get();
		foreach ($queries as $query){
			$results[] = [ 'id' => $query->kodobat, 'value' => $query->namaobat, 'stok' => $query->stok, 'harga' => $query->harga, 'kodobat' => $query->kodobat ];
		}
		return Response::json($results);
	}

	public function setPref($pref)
	{
		if($pref == 'dinas'){
			$this->pref = 'di';
			$this->title = 'Dinas';
			$this->slug = 'dinas';
		}
		else if($pref == 'swasta'){
			$this->pref = 'sw';
			$this->title = 'Swasta';
			$this->slug = 'swasta';
		}
        else if($pref == 'ok'){
            $this->pref = 'ok';
            $this->title = 'OK';
            $this->slug = 'ok';
        }
        else if($pref == 'umum'){
            $this->pref = 'umum';
            $this->title = 'Umum';
            $this->slug = 'umum';
        }
		else{
			$this->pref = 'as';
			$this->title = 'Apotek Farmasi';
			$this->slug = 'apotek_askes';
		}
	}

	public function edit($id_penjualan)
	{
		$this->setPref('askes');
		$jenis_obat = DB::table('apo_jenisobat')->get();
		$data 		= DB::table('apo_penjualan')->where('id' , $id_penjualan)->first();
		return View::make('apotek.general.transaksi.create' , array(
			'pref' 			=> $this->pref,
			'title' 		=> $this->title,
			'slug' 			=> $this->slug,
			'jenis_obat' 	=> $jenis_obat,
			'id_penjualan'	=> $id_penjualan
		));
	}

	/**
	 * @param void
	 * @return array
	 */
	/*
	public function datatable($pref="askes")
	{
		$this->setPref($pref);
		$perawat = DB::table($this->pref.'transaksi')->join('tbmasukrs', $this->pref.'transaksi.noreg', '=', 'tbmasukrs.NoReg')->join();
		return Datatable::query($perawat)
			->addColumn('kodobat',function($model)
        	{
            	return '<a href="'.url('apotek_obat/'.$model->kodobat.'/edit').'">'.$model->kodobat.'</a>';
        	})
			->showColumns('namaobat','komposisi','satuan','namajenis' , 'stok','harga')
			->addColumn('actions',function($model)
        	{
            	return '<a href="'.url('apotek_obat/'.$model->kodobat.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->kodobat."','Obat askes'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('kodobat','namaobat','namajenis','stok')
			->orderColumns('kodobat','namaobat','namajenis','stok')->make();
	}
	*/

	public function check_pasien($id)
	{
		$check = DB::table('tbmasukrs')->join('tbpasien','tbmasukrs.NoRM','=','tbpasien.NoRM')->where('tbmasukrs.NoRM' , '=' , $id)->orderBy('tbmasukrs.NoReg','desc')->first();
		if($check){
			$no_reg = $check->NoReg;
			$check_exist = DB::table('tbkeluar')->where('NoReg' , '=' , $no_reg)->first();
			if($check_exist){
				echo 'false';
			}
			else{
				echo(json_encode($check));
			}
		}
		else{
			echo 'false';
		}
		
	}

	public function tambah_transaksi($pref='askes')
	{
		$this->setPref($pref);
		$rules = array(
			'no_reg'    => 'required|min:1', 
			'id_obat'    => 'required|min:1', 
			'jumlah'    => 'required|min:1', 
			'harga'    => 'required|min:1', 
			'total'    => 'required|min:1', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$messages = $validator->messages();
			foreach ($messages->all() as $message) 
			{
				echo $message;
			}
			
		} else {
			$jumlah 		= intval(Input::get('jumlah'));
			$stok 			= Input::get('stok');
			$id_penjualan 	= 0;
			if( $stok >=  $jumlah){

				$id_penjualan 	= Input::get('id_penjualan');

				$resep 			= DateTime::createFromFormat('d/m/Y', Input::get('tanggal_resep'));

				if( Input::get('jenis_rawat') == 'umum' ){
					$jenis_rawat = "umum";
				}
				else{
					$jenis_rawat = Input::get('jenis_rawat').' NO RM:'.Input::get('no_rm');
				}

				$tanggal_masuk 			= Input::get('tanggal_masuk');
				$TanggalMasuk 			= date('Y-m-d');
				if( isset($tanggal_masuk) && !empty($tanggal_masuk) ){
					$date 			= DateTime::createFromFormat('d/m/Y', $tanggal_masuk);
					$TanggalMasuk 	= $date->format('Y-m-d');	
				}
				$data_penjualan = array(
										'tanggal_transaksi' => $resep->format('Y-m-d') ,
										'jenis_penjualan'	=> $jenis_rawat,
										'NoRM'				=> Input::get('no_rm') ,
										'Nama'				=> Input::get('nama_lengkap') ,
										'JenisRawat' 		=> Input::get('jenis_rawat'),
										'CaraBayar' 		=> Input::get('penjamin'),
										'TanggalMasuk' 		=> $TanggalMasuk ,
										'NoReg'				=> Input::get('no_reg') ,

				);	
				if( $id_penjualan == 0 ){
					$id_penjualan 	= DB::table('apo_penjualan')->insertGetId($data_penjualan);
				}
				else{
					
				}

				$norm 		= Input::get('no_rm');

				$kodobat 	= Input::get('id_obat');
				$stoks 		= DB::table('apo_detailobat')->where('kodobat' , $kodobat)->first();
				if( isset($stoks->stok) && !empty($stoks->stok) ){
					$stok_awal 	= $stoks->stok;

					$new_stok = intval( $stok_awal ) - $jumlah;

					if( $new_stok >= 0 ){
						$check_obat		= DB::table('apo_penjualan_detail')
											->where('id_penjualan' , $id_penjualan)
											->where('IdObat' , Input::get('id_obat'))
											->first();
						if( isset($check_obat->id) ){
							$detail  	= DetailObat::find($check_obat->id);
							$jumlah  	= intVal( Input::get('jumlah') ) + intVal($check_obat->Jumlah);
							$total 		= $jumlah * floatval( Input::get('harga') );
						}
						else{
							$detail 	= new DetailObat;
							$jumlah 	= Input::get('jumlah');
							$total 		= Input::get('total');
						}

						$obat 			= DB::table('apo_obat')->where('kodobat' , $kodobat)->first();
						if( isset($obat->masa) ){
							$expire 	= $obat->masa;
						}
						else{
							$expire 	= '0000-00-00';
						}
						
						$detail->id_penjualan 	= $id_penjualan;									
						$detail->TanggalResep 	= $resep->format('Y-m-d');
						$detail->IdObat 		= Input::get('id_obat');
						$detail->NamaObat 		= Input::get('nama_obat');
						$detail->Harga 			= Input::get('harga');
						$detail->Dosis 			= Input::get('dosis');
						$detail->Tipe 			= Input::get('kategori_obat');
						$detail->TanggalExpire	= $expire;
						$detail->Jumlah 		= $jumlah;
						$detail->TotalHarga 	= $total;
						$detail->Apotek 		= $this->slug;
						$detail->save();

						$obat = DB::table('apo_detailobat')->where('id',$stoks->id )->update(array('stok' => $new_stok));

						$data_a 	= DB::table('apo_penjualan_detail')->where('id_penjualan' , $id_penjualan)->get();
						$total_a 	= 0;
						$racik 		= 0;
						$paten 		= 0;
						foreach( $data_a as $a ){
							$total_a 	= $total_a + ($a->TotalHarga);
							if( $a->Tipe == 'R1' || $a->Tipe == 'R2' || $a->Tipe == 'R3' || $a->Tipe == 'R4'){
								$racik++;
							}

							if( $a->Tipe === 'P' ){
								$paten++;
							}
						}
						$data_penjualan['subtotal'] 	= $total_a;

						$kategori 	= Input::get('kategori_obat');
						$penjamin 	= Input::get('penjamin');

						$cek_ujr 	= DB::table('tarif_resep')->where('id','=','1')->first();
						if( isset($cek_ujr->obat_umum) ){
							$h_paten 	= 0;
							$h_racik 	= 0;
							if( $penjamin == 'BPJS' ){
								$h_paten	= $cek_ujr->obat_bpjs;
								$h_racik 	= $cek_ujr->racikan_bpjs;
							}
							else{
								$h_paten	= $cek_ujr->obat_umum;
								$h_racik 	= $cek_ujr->racikan_umum;
							}

							if( $cek_ujr->satuan_obat == 'transaksi' ){
								if( $cek_ujr->penambahan == '0' ){
									if( $racik > 0 ){
										$ujr 	= $h_racik;
									}
									else{
										$ujr 	= $h_paten;
									}
								}
							}
							else{
								if( $cek_ujr->penambahan == '0' ){
									if( $racik > 0 ){
										$ujr 	= $racik * $h_racik;
									}
									else{
										$ujr 	= $paten * $h_paten;
									}
								}
								else{
									$ujr 	= ($racik * $h_racik) + ($paten + $h_paten);
								}
							}
						}

						if( $norm == '000000' ){
							$ujr 		= 0;
						}

						$data_penjualan['ujr'] 			= $ujr;
						$data_penjualan['total'] 		= $total_a + $ujr;
						DB::table('apo_penjualan')->where('id',$id_penjualan)->update($data_penjualan);

						$pesan = 'sukses';
					}
					else{
						$pesan = 'Stok tidak mencukupi';
					}
				}
				else{
					$pesan = 'Stok tidak mencukupi';
				}
				
			}
			else{
				$pesan = 'Stok tidak mencukupi';
			}

			echo json_encode( array( 'pesan' => $pesan , 'id_penjualan' => $id_penjualan ) );
		}


	}

	public function dataPenjualan($id){
		$data 		= DB::table('apo_penjualan')
					->select('apo_penjualan.*')
					->where('apo_penjualan.id' , $id)->first();
		if( isset($data->id) ){
			echo json_encode(
				array(
						'NoRM' 			=> $data->NoRM ,
						'Nama' 			=> $data->Nama ,
						'NoReg'			=> $data->NoReg,
						'JenisRawat'	=> $data->JenisRawat ,
						'CaraBayar'		=> $data->CaraBayar ,
						'TanggalMasuk'	=> $data->TanggalMasuk
				)
			);
		}
		else{
			echo 'false';
		}
	}

	public function list_transaksi($pref,$id)
	{
		$this->setPref($pref);
		$data = DB::table('apo_penjualan_detail')->where('id_penjualan','=',$id)
		->select('*' , DB::raw('DATE_FORMAT(TanggalResep, "%d/%m/%Y") AS tgl'))->orderby('TanggalResep','desc')->get();
		return $data;
	}

	public function total_penjualan($pref,$id){
		$this->setPref($pref);
		$return 	= array();
		$data = DB::table('apo_penjualan')->where('id' , '=' , $id)->first();
		if( isset($data->id) ){
			$return['subtotal'] 	= number_format( $data->subtotal );
			$return['diskon'] 		= number_format( $data->diskon );
			$return['ujr'] 			= number_format( $data->ujr );
			$return['total_all'] 	= number_format( $data->total );

			

		}
		else{

		}

		echo json_encode($return);
	}

	public function check_transaksi($pref = 'askes')
	{
		$jumlah 	= Input::get('jumlah');
		$kodeobat 	= Input::get('id_obat');
		$noreg 		= Input::get('id_penjualan');
		$data = DB::table('apo_penjualan_detail')->where('id_penjualan','=',$noreg)
				->where('IdObat' , $kodeobat)->where('Jumlah',$jumlah)->get();

		if($data)
			return 'ada';
		else
			return 'kosong';
	}

	public function edit_transaksi($pref='askes')
	{
		$this->setPref($pref);
		
		$IdResep = Input::get('IdResep');
		$IdObat_asli = Input::get('IdObat_asli');
		$IdObat = Input::get('IdObat');
		$NamaObat = Input::get('NamaObat');
		$Harga = Input::get('Harga');
		$Jumlah = Input::get('Jumlah');
		$TotalHarga = Input::get('TotalHarga');
		
		if($IdObat_asli == $IdObat){
			$select = DB::table('tbdetaapo_ilobat')->where('id' , '=' , $id)->get();
			foreach($select as $s){
				$j 			= $s->Jumlah;
				$stoks 		= DB::table('apo_detailobat')->where('kodobat' , $kodobat)->where('tempat',$this->slug)->first();
				if( isset($stoks->stok) ){
					$stok_awal 	= $stoks->stok;
					$new_stok = intval( $stok_awal ) - intval( $j ) + intval($Jumlah);

					$obat = DB::table('apo_detailobat')->where('id',$stoks->id )->update(array('stok' => $new_stok));
				}
			}
			
			$upddetailobat = DB::table('tbdetailobat')->where('IdResep' , '=' , $IdResep)->where('IdObat' , '=' , $IdObat)
						->update(array(
							'IdObat' => $IdObat,
							'NamaObat' => $NamaObat,
							'Harga' => $Harga,
							'Jumlah' => $Jumlah,
							'TotalHarga' => $TotalHarga
						));
			if($upddetailobat)
				echo 'sukses';
			else
				echo 'Proses Update Gagal, Silahkan Ulangi Lagi.';
		}
		else{
			$select = DB::table('tbdetailobat')->where('IdResep' , '=' , $IdResep)->where('IdObat' , '=' , $IdObat_asli)->get();
			foreach($select as $s){
				$obat = DB::table($this->pref.'obat')->where('kodobat', $s->IdObat )->first();
				$new_stok = $obat->stok + $s->Jumlah;
				DB::table($this->pref.'obat')->where('kodobat', $s->IdObat )->update(array('stok' => $new_stok));
			}
			
			$obat = DB::table($this->pref.'obat')->where('kodobat', $IdObat )->first();
			$new_stok2 = $obat->stok - $Jumlah;
			DB::table($this->pref.'obat')->where('kodobat', $IdObat )->update(array('stok' => $new_stok2));

			$upddetailobat = DB::table('tbdetailobat')->where('IdResep' , '=' , $IdResep)->where('IdObat' , '=' , $IdObat_asli)
						->update(array(
							'IdObat' => $IdObat,
							'NamaObat' => $NamaObat,
							'Harga' => $Harga,
							'Jumlah' => $Jumlah,
							'TotalHarga' => $TotalHarga
						));
			if($upddetailobat)
				echo 'sukses';
			else
				echo 'Proses Update Gagal, Silahkan Ulangi Lagi.';
		}
	}

	/**
	 * function hapus_transaksi
	 * - ubah stok ketika dihapus (stok bertambah)
	 * - hapus transaksi
	 * - ubah harga total
	 */

	public function hapus_transaksi($pref='askes')
	{
		$this->setPref($pref);
		$this->pref = "apo_";
		$id_resep = Input::get('id_resep');
		$kodobat = Input::get('kodobat');

		$id_penjualan 	= 0;
		$select = DB::table('apo_penjualan_detail')->where('id' , '=' , $id_resep)->get();
		foreach($select as $s){
			$jumlah 		= $s->Jumlah;
			$id_penjualan 	= $s->id_penjualan;
			$stoks 		= DB::table('apo_detailobat')->where('kodobat' , $kodobat)->where('tempat',$this->slug)->first();
			if( isset($stoks->stok) ){
				$stok_awal 	= $stoks->stok;
				$new_stok = intval( $stok_awal ) + intval( $jumlah );

				$obat = DB::table('apo_detailobat')->where('id',$stoks->id )->update(array('stok' => $new_stok));
			}
		}

		

		$data = DB::table('apo_penjualan_detail')->where('id' , '=' , $id_resep)->delete();

		$data_p 	= DB::table('apo_penjualan_detail')->where('id_penjualan' , '=' ,$id_penjualan)->get();
		$total_a 	= 0;
		$racik 		= 0;
		$paten 		= 0;
		foreach( $data_p as $a ){
			$total_a 	= $total_a + ($a->TotalHarga);
			if( $a->Tipe == 'R1' || $a->Tipe == 'R2' || $a->Tipe == 'R3' || $a->Tipe == 'R4'){
				$racik++;
			}

			if( $a->Tipe === 'P' ){
				$paten++;
			}
		}

		$penjualan 		= DB::table('apo_penjualan')->where('id' , $id_penjualan)->first();
		$penjamin 		= "umum";
		if( isset($penjualan->id) ){
			$penjamin = $penjualan->CaraBayar;
		}
		$data_penjualan		= array();
		$data_penjualan['subtotal'] 	= $total_a;

		$cek_ujr 	= DB::table('tarif_resep')->where('id','=','1')->first();
		if( isset($cek_ujr->obat_umum) ){
			$h_paten 	= 0;
			$h_racik 	= 0;
			
			if( $penjamin == 'BPJS' ){
				$h_paten	= $cek_ujr->obat_bpjs;
				$h_racik 	= $cek_ujr->racikan_bpjs;
			}
			else{
				$h_paten	= $cek_ujr->obat_umum;
				$h_racik 	= $cek_ujr->racikan_umum;
			}

			if( $cek_ujr->satuan_obat == 'transaksi' ){
				if( $cek_ujr->penambahan == '0' ){
					if( $racik > 0 ){
						$ujr 	= $h_racik;
					}
					else{
						$ujr 	= $h_paten;
					}
				}
			}
			else{
				if( $cek_ujr->penambahan == '0' ){
					if( $racik > 0 ){
						$ujr 	= $racik * $h_racik;
					}
					else{
						$ujr 	= $paten * $h_paten;
					}
				}
				else{
					$ujr 	= ($racik * $h_racik) + ($paten + $h_paten);
				}
			}
		}

		$data_penjualan['ujr'] 			= $ujr;
		$data_penjualan['total'] 		= $total_a + $ujr;
		DB::table('apo_penjualan')->where('id',$id_penjualan)->update($data_penjualan);
		
		return $id_penjualan;
	}

	public function cetakEtiket($id_penjualan){
		$pdf = new TCPDF('L', PDF_UNIT, array(65, 40), true, 'UTF-8', false);
		//$pdf = new TCPDF();
		//set the logo
		// set default footer font
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		
		$pdf->SetMargins(5, 4, 5, true);
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
		$pdf->SetFont('helvetica', '', 8);
		//create new page
		
		$penjualan 	= DB::table('apo_penjualan')->where('id' , $id_penjualan)->first();
		if( isset($penjualan->NoReg) ){
			$reg 		= DB::table('tbdetaildokter')->where('NoReg' , $penjualan->NoReg)->first();
			if( isset($reg->NamaDokter) ){
				$nama_dokter = $reg->NamaDokter;
			}
			else{
				$nama_dokter = "";
			}
		}

		$norm = $nama = $ttl = "";
		if( isset($penjualan->NoRM) ){
			$norm = $penjualan->NoRM;
			$pasien = DB::table('tbpasien')->where('NoRM',$penjualan->NoRM)->first();
			if( isset($pasien->Nama) ){
				$nama = $pasien->Nama;
			}

			if( isset($pasien->TanggalLahir) ){
				$tgl = explode('-',$pasien->TanggalLahir);
				$ttl = $tgl[2].'/'.$tgl[1].'/'.$tgl[0];
			}
		}
		
		$list_obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $id_penjualan)->get();
		if( count($list_obat) > 0 ){
			foreach($list_obat as $l){
				$pdf->AddPage();
				$tgl 	= explode('-' , $l->TanggalExpire);
				$expire = $tgl[2].'/'.$tgl[1].'/'.$tgl[0];
				$html = "<div align='center'><u>INSTALASI FARMASI ".$this->rs_title."</u><br />".$nama_dokter."</div>";
				
				$html .= "Nama : ".$nama."<br />";
				$html .= "No RM : ".$norm."<br />";
				$html .= "TTL &nbsp;: ".$ttl."<br />";
				$html .= "<br />".$l->NamaObat.' &nbsp;&nbsp;('.$l->Jumlah.')';
				$html .= "<br />Exp ".$expire;
				$html .= "<br />".$l->Dosis;
				$pdf->writeHTML($html, true, false, true, false, '');
			}
		}
		else{
			$pdf->AddPage();
			$txt = "Data obat tidak ditemukan";
			$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
		}
		
		$pdf->Output('cetak_etiket.pdf', 'I');
	}


	public function terbilang($x)
	{
	  	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	  	if ($x < 12)
	    	return " " . $abil[$x];
	  	elseif ($x < 20)
	    	return $this->terbilang($x - 10) . "belas";
	  	elseif ($x < 100)
	    	return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
	  	elseif ($x < 200)
	    	return " seratus" . $this->terbilang($x - 100);
	  	elseif ($x < 1000)
	   		return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
	  	elseif ($x < 2000)
	    	return " seribu" . $this->terbilang($x - 1000);
	  	elseif ($x < 1000000)
	    	return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
	  	elseif ($x < 1000000000)
	    	return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
	}

	public function pdfCreate($noreg)
	{
		$detail = DB::table('apo_penjualan')->select('TanggalMasuk','NoReg','JenisRawat','NoRM')->where('id','=',$noreg)->first();
		$pasien = DB::table('tbpasien')->where('NoRM','=',$detail->NoRM)->first();
		
		/* PDF Settings */
		//set the extention of picture logo
		//$file_image = 'img/logo.gif';
		$ekstensi = 'GIF';
		//count the number of column'NoResep','TanggalResep','NoRM','JenisRawat','NamaObat','Harga','Jumlah','TotalHarga'
		$list_kolom = array('TanggalResep','NamaObat','Harga','Jumlah','TotalHarga');
		$width_kolom = array(15,55,10,10,10);//make sure to get the sum is 100
		$num_headers = count($list_kolom);
		//set the Header of paper
		$html = '<table width="100%">
				<tr><td align="center"></td></tr>
				<tr><td align="center"><h2>'.$this->rs_title.'</h2></td></tr>
				<tr><td align="center"><h2>'.$this->rs_alamat.'</h2></td></tr>
				</table>
				<br /><hr /><br />';
		
		//set the paper orientation
		//define the width of data shown in paper (default A4). (All measurement in mm)
		//for potrait = 184, for landscape = 271 
		$orientation = 'P';
		$total_width = 184;

		//define the percentation of paper width for getting column width
		$percent = $total_width/100;
		//set the column width
		$w = array();
		for($i=0;$i<$num_headers; $i++){
			$w[] = $width_kolom[$i]*$percent;
		}
			
		//set the Header of paper will show on next page. 1 = shown, 0 = not shown.
		$show_paper_header = 1;
		//set the column header label
		$header = array('Tanggal Resep','Nama Obat','Harga','Jumlah','Total');

		//height of row
		$high = 6;
		//set the PDF filename
		$namafile = 'Transaksi_('.$detail->JenisRawat.'-'.$pasien->Nama.'-'.$detail->NoRM.')';
	
		/* PDF Processing */
		$pdf = new TCPDF($orientation);

		//set the logo
		$detailobat = DB::table('apo_penjualan_detail')->select($list_kolom)->where('id_penjualan','=',$noreg)->orderby('TanggalResep','desc')->orderby('NamaObat')->get();
		//$image_file = K_PATH_IMAGES.$file_image;
		// set default footer font
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->SetMargins(13, 13, 13);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		//set the header and footer availability
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(true);
		//set the default font
		$pdf->SetFont('helvetica', '', 9);
		//create new page
		$pdf->AddPage();
		//set the logo
        //$pdf->Image($image_file, 15, 5, '', '17', $ekstensi, '', 'T', true, 300, '', false, false, 0, false, false, false);
        //writing the Header of paper
		$pdf->writeHTML($html, true, false, true, false, '');
        //Writing the Title
		$the_title = '<table width="100%">
		<tr>
			<td width="20%">Nama Lengkap</td>
			<td width="3%" align="right"> : </td>
			<td width=""> '.$pasien->Nama.'</td>
		</tr>
		<tr>
			<td>No RM</td>
			<td width="3%" align="right"> : </td>
			<td> '.$detail->NoRM.'</td>
		</tr>
		<tr>
			<td>No Register</td>
			<td width="3%" align="right"> : </td>
			<td> '.$detail->NoReg.'</td>
		</tr>
		<tr>
			<td>Jenis Rawat</td><td align="right"> : </td><td> '.$detail->JenisRawat.'</td>
		</tr>
		<tr>
			<td>Tanggal Masuk</td><td align="right"> : </td><td> '.$detail->TanggalMasuk.'</td>
		</tr>
		</table>
		<br />';

		$pdf->writeHTML($the_title, true, false, true, false, '');
		// set header table color
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetLineWidth(0.2);
        $pdf->SetFont('', 'B');
        //Writing the Table Header        
        for($i = 0; $i < $num_headers; ++$i) {
			$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $pdf->Ln();		
       // Color and font restoration
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
		
		//Writing the Table Data
		//convert query result (object) into array
		$data = array_map(function($object){ return (array) $object; }, $detailobat);
        // make data table zebra colored
        $fill = 0;
		$dimensions = $pdf->getPageDimensions();
		$hasborder = false;
		
		foreach($data as $ro => $row) {
			$rowcount = 0;
			//count the number of required lines 
			$ukuran = array();
			for($i = 0; $i < $num_headers; ++$i) {
				$ukuran[] = $pdf->getNumLines($row[$list_kolom[$i]],$w[$i]);
			}
			//get the max lines for each row
			$rowcount = max($ukuran);
			$startY = $pdf->GetY();
		 
			if (($startY + $rowcount * $high) + $dimensions['bm'] > ($dimensions['hk'])) {
				if ($hasborder) {
					$hasborder = false;
				}
				else {
					//create new page if the data reach the end of paper and recreate paper header
					//draw bottom border on previous row
					$pdf->Cell(array_sum($w),0,'','T'); 
					$pdf->Ln();
					//create new page
					$pdf->AddPage();
					if($show_paper_header == 1){
						//set the logo
						//$pdf->Image($image_file, 15, 5, '25', '', $ekstensi, '', 'T', true, 300, '', false, false, 0, false, false, false);
						//writing the Header of paper
						$pdf->writeHTML($html, true, false, true, false, '');
						$pdf->writeHTML($the_title, true, false, true, false, '');
					}
					// set header table color
					$pdf->SetFillColor(79,167,255);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(0, 92, 185);
					$pdf->SetLineWidth(0.2);
					$pdf->SetFont('', 'B');
					//Writing the Table Header
					for($i = 0; $i < $num_headers; ++$i) {
						$pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
					}
					$pdf->Ln();
				   // Color and font restoration
					$pdf->SetFillColor(224, 235, 255);
					$pdf->SetTextColor(0);
					$pdf->SetFont('');
				}
				$borders = 'LTR';
			} elseif ((ceil($startY) + $rowcount * $high) + $dimensions['bm'] == floor($dimensions['hk'])) {
				//draw the cell with a bottom border
				$borders = 'LRB';	
				//stops the attempt to draw the bottom border on the next row
				$hasborder = true;
			} else {
				//normal cell
				$borders = 'LR';
			}
			//Writing the tabel data

			$pdf->Cell($w[0], 6, $row[$list_kolom[0]], $borders, 0, 'L', $fill);
			$pdf->Cell($w[1], 6, $row[$list_kolom[1]], $borders, 0, 'L', $fill);
			$pdf->Cell($w[2], 6, number_format( $row[$list_kolom[2]] ), $borders, 0, 'R', $fill);
			$pdf->Cell($w[3], 6, number_format( $row[$list_kolom[3]] ), $borders, 0, 'R', $fill);
			$pdf->Cell($w[4], 6, number_format( $row[$list_kolom[4]] ), $borders, 0, 'R', $fill);
		
			$pdf->Ln();
			$fill=!$fill;
		}
		//draw bottom border on last paper row
        $pdf->Cell(array_sum($w), 0, '', 'T');
		//save the file
		$filename = storage_path() . '/'.$namafile.'.pdf';
		$pdf->output($filename, 'I');
	}

	public function excelCreate($mode,$noreg)
	{	
		$detailobat = DB::table('apo_penjualan')->where('id',$noreg)->orderby('NoResep')->get();
		//$pasien = DB::table('tbpasien')->where('NoRM',$detailobat[0]->NoRM)->first();
						
	/*	
		var_dump($detailobat);
		echo '<br /><br />';
		print_r($detailobat);
		echo '<br /><br />';
		echo $detailobat[0]->NoRM;
		echo '<br />';
		echo $detailobat[0]->JenisRawat;
		echo '<br />';
		echo $detailobat[0]->TanggalMasuk;
		echo '<br />';
		echo $detailobat[0]->NoReg;
		echo '<br /><br />';
		var_dump($pasien);
		echo '<br /><br />';
		echo $pasien->Nama;
		
	*/	
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
		$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', '');

		$objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $this->rs_title);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:G4');
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(15);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', $this->rs_alamat);

		$objPHPExcel->getActiveSheet()->mergeCells('A6:B6');
		$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Nama Lengkap');
		$objPHPExcel->getActiveSheet()->mergeCells('C6:D6');
		$objPHPExcel->getActiveSheet()->setCellValue('C6', ': '.$detailobat[0]->Nama);
		$objPHPExcel->getActiveSheet()->mergeCells('E6:F6');
		$objPHPExcel->getActiveSheet()->setCellValue('E6', 'No RM');
		$objPHPExcel->getActiveSheet()->setCellValue('G6', ': '.$detailobat[0]->NoRM);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A7:B7');
		$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Jenis Rawat');
		$objPHPExcel->getActiveSheet()->mergeCells('C7:D7');
		$objPHPExcel->getActiveSheet()->setCellValue('C7', ': '.$detailobat[0]->JenisRawat);
		$objPHPExcel->getActiveSheet()->mergeCells('E7:F7');
		$objPHPExcel->getActiveSheet()->setCellValue('E7', 'Tanggal Masuk');
		$objPHPExcel->getActiveSheet()->setCellValue('G7', ': '.$detailobat[0]->TanggalMasuk);

		$objPHPExcel->getActiveSheet()->mergeCells('A8:B8');
		$objPHPExcel->getActiveSheet()->setCellValue('A8', 'No Register');
		$objPHPExcel->getActiveSheet()->mergeCells('C8:D8');
		$objPHPExcel->getActiveSheet()->setCellValue('C8', ': '.$detailobat[0]->NoReg);

		$objPHPExcel->getActiveSheet()->getStyle('A6:G8')->getFont()->setSize(12);

		// Header Table		
		$header = array('Tanggal Resep','Nama Obat','Harga','Jumlah','Total');
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A10', 'No')
			->setCellValue('B10', 'Tanggal Resep')
			->setCellValue('C10', 'Nama Obat')
			->setCellValue('D10', 'Harga')
			->setCellValue('E10', 'Jumlah')
			->setCellValue('F10', 'Total');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(false);

		$objPHPExcel->getActiveSheet()->getRowDimension('10')->setRowHeight(20);

		$objPHPExcel->getActiveSheet()->getStyle('A10:G10')->applyFromArray(
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
		$norow = 10;

		$detailobat2 = DB::table('apo_penjualan_detail')->where('id_penjualan',$noreg)->orderby('NamaObat')->get();

		foreach($detailobat2 as $det => $ail){
			$no++;
			$norow++;

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$norow, $no)		
				->setCellValue('B'.$norow, $ail->TanggalResep)
				->setCellValue('C'.$norow, $ail->NamaObat)
				->setCellValue('D'.$norow, $ail->Harga)
				->setCellValue('E'.$norow, $ail->Jumlah)
				->setCellValue('F'.$norow, $ail->TotalHarga);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$norow)->getNumberFormat()
					->setFormatCode( '[$Rp]_ \.* #,##0\ ' );

				$objPHPExcel->getActiveSheet()->getStyle('F'.$norow)->getNumberFormat()
					->setFormatCode( '[$Rp]_ \.* #,##0\ ' );	
				
			$objPHPExcel->getActiveSheet()->getStyle('A'.$norow.':G'.$norow)->applyFromArray(
				array(
					'borders' => array(
						'allborders'     => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
			
		}

		if( count($detailobat) > 0 ){
			if( $detailobat[0]->ujr != 0 ){
				$norow++; 
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('E'.$norow, 'UJR')
				->setCellValue('F'.$norow, $detailobat[0]->ujr);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$norow)->getNumberFormat()
					->setFormatCode( '[$Rp]_ \.* #,##0\ ' );
			}

			if( $detailobat[0]->total != 0 ){
				$norow++; 
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('E'.$norow, 'Total')
				->setCellValue('F'.$norow, $detailobat[0]->total);

				$objPHPExcel->getActiveSheet()->getStyle('F'.$norow)->getNumberFormat()
					->setFormatCode( '[$Rp]_ \.* #,##0\ ' );
			}

			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			if($mode=='Excel5') $eks = 'xls'; else $eks = 'xlsx';
		//	$filename = "Lap_Rekap_Data_Pasien_(".$nama_bulan." ".$tahun.").".$eks;
			$filename = "Transaksi_(".$detailobat[0]->JenisRawat."-".$detailobat[0]->Nama."-".$detailobat[0]->NoReg.").".$eks;
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
			//$mode = Excel5 : Ms. Office Excel 2003
			//		  Excel2007 : Ms. Office Excel 2007
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $mode);
			$objWriter->save('php://output');

		}
	}

	function updateNama(){
		$ch1	= DB::table('apo_penjualan')->where('NoRM' ,'!=' ,'')->where('NoRM' ,"!=" , '000000')->get();
		if(count($ch1) >  0){
			foreach($ch1 as $c){
				$pasien 	= DB::table('tbpasien')->where('NoRM' , $c->NoRM)->first();
				if(isset($pasien->Nama)){
					$update 	= DB::table('apo_penjualan')->where('id' ,$c->id)->update(
						array(
							'Nama'	=> $pasien->Nama
						)
					);
				}
			}
		}
	}

	function cetakTransaksi($id=""){
		$penjualan 	= DB::table('apo_penjualan')->where('id' , $id)->first();
		if( isset($penjualan->id) ){
			$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
			$id_penjualan 	= $penjualan->id;
			$data 	= DB::table('tbpasienjalan')->where('NoRegJalan' , $penjualan->NoReg)->first();
		}
		else{
			$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
			$data 	= array();
			$id_penjualan	= 0;
		}
			
			//var_dump($registrasi);
		return View::make('apotek.general.transaksi.cetak_transaksi' , 
			array(
					'obat' 			=> $obat ,
					'registrasi'	=> $penjualan,
					'id_penjualan'	=> $id_penjualan
			)
		);
	}

	
}
		
