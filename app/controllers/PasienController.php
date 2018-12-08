<?php

class PasienController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function update($id)
	{
		//
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
	public function datatable()
	{
		$pasien = DB::table('tbpasien');
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
			->showColumns('Jkel','TempatLahir','TanggalLahir')
			->addColumn('Jalan' ,function($model){
				return $model->Jalan.' '.$model->Kecamatan.' '.$model->KotaKab;
			})
			->showColumns('GolPasien','NoBPJS','NoKTP')
			->searchColumns('NoRM','Nama','NoKTP','NoBPJS')
			->orderColumns('NoRM','Nama','TanggalLahir')->make();
	}

	public function datatableId()
	{
		$pasien = DB::table('tbpasien');
		return Datatable::query($pasien)
			->addColumn('nor',function($model)
        	{
            	return '<a class="btn" onclick="pilih_pasien('."'".$model->id."'".')" href="#">Pilih</a>';
        	})
        	->addColumn('NoRM',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->id."'".')" href="#">'.$model->NoRM.'</a>';
        	})
        	->addColumn('Nama',function($model)
        	{
            	return '<a onclick="pilih_pasien('."'".$model->id."'".')" href="#">'.$model->Nama.'</a>';
        	})
			->showColumns('Jkel','TempatLahir','TanggalLahir')
			->addColumn('Jalan' ,function($model){
				return $model->Jalan.' '.$model->Kecamatan.' '.$model->KotaKab;
			})
			->showColumns('GolPasien','NoBPJS','NoKTP')
			->searchColumns('NoRM','Nama','NoKTP','NoBPJS')
			->orderColumns('NoRM','Nama','TanggalLahir')->make();
	}

	public function tambah_baru(){
			$last = DB::table('tbpasien')->orderBy('NoRM' , 'desc')->first();

			$norm = Input::get('txt2_no_rm');
			$baru = "ya";
			if( $norm == '' ){
				if( isset($last->NoRM) && !empty($last->NoRM) ){
					$norm = intval($last->NoRM);
					$norm++;

					while( strlen($norm) < 6 ){
						$norm = "0".$norm;
					}
				}
				else{
					$norm = "000001";
				}
			}
			else{
				$check = $last = DB::table('tbpasien')->where('NoRM' , $norm)->first();

				if( isset($check->NoRM) && !empty($check->NoRM) ){
					$baru = "no";
				}
				else{

				}
			}

			if( $baru == 'ya' ){
				$pasien = new Pasien;
				//$pasien->NoRM = Input::get('txt2_no_rm');
				$pasien->NoRM = $norm;

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


				$pasien->NamaPJ 	= Input::get('new_NamaPJ');
				$pasien->AlamatPJ 	= Input::get('new_AlamatPJ');
				$pasien->HubPJ 		= Input::get('new_HubPJ');
				$pasien->TelpPJ 	= Input::get('new_TelpPJ');
				$pasien->save();

				/*
				$insertedId = $pasien->id;

				$no_rm 		= $insertedId;
				$p = Pasien::find($no_rm);
				while( strlen($no_rm) < 6 ){
					$no_rm = "0".$no_rm;
				}
				echo $no_rm;
				//die();
				$p->NoRM = $no_rm;
				$p->save();
				*/

				$result = array( 'status' => 'berhasil' , 'norm' => $norm );
			}
			else{
				$result = array( 'status' => 'gagal' , 'norm' => $norm );
			}

			echo json_encode($result);
			die();			
	}

	public function tambah_tindakan()
	{

		$id_reg 	= Input::get('id_reg');
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
		$tindakan->IdReg =  $id_reg;

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
		$tindakan->HargaSatuan = $tarif;
		$tindakan->Qty = 1;
		$tindakan->Tarif = $tarif;
		$tindakan->Adm = $adm;
		$tindakan->Fas = $fas;
		$tindakan->Bek = $bek;
		$tindakan->Gol = $gol;

		$tindakan->save();

		
		if( isset($id_reg) ){
			$pasien 	= DB::table('tbpasienjalan')->where('IdRegJalan' , $id_reg)->update(
				array( 'StatusBayar' => '0')
			);
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
			$key = 'Tanggal';
		}
		else if($type=='ugd'){
			$table = 'tbpasienugd';
			$key = 'Tanggal';
		}
		else{
			$table = 'tbpasieninap';
			$key = 'Tanggal';
		}
		
		$norm = trim($norm);
		/*$data = DB::table('tbmasukrs')->join('tbpasienjalan', $table.'.'.$key ,'=','tbmasukrs.NoReg')
				->where('tbmasukrs.NoRM' , '=' , $norm)
				->select('tbmasukrs.JamMasuk' ,'tbmasukrs.NoReg' ,'tbmasukrs.TglMasuk' , $table.'.*')->orderBy('TglMasuk','desc')->get();
		*/
		$datas 	= array();
		$data = DB::table($table)->where('NoRM',$norm)->orderBy($key,'desc')->get();
		if(count($data) > 0){
			foreach($data as $d){
				$ar				= array();
				$ar['Poli']		= $d->Poli;
				$dates 			= explode( '-' , $d->Tanggal );
				$tanggal 		= $dates[2].'/'.$dates[1].'/'.$dates[0];
				$ar['Tanggal'] 	= $tanggal;

				$datas[]		= $ar;
			}
		}
		else{
			$datas 	= $data;
		}
		echo(json_encode($datas));
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
				
				$pasien->NoKTP = Input::get('new_txt_no_ktp');
				$pasien->Nama = strtoupper( Input::get('new_txt_nama') );
				$pasien->Jkel = Input::get('new_cmb_jenkel');
				$pasien->TempatLahir = Input::get('new_txt_tempat_lahir');
				$txt_tanggal 	= Input::get('new_txt_tanggal_lahir');
				if( empty($txt_tanggal) ){

					$tgl_lahir = '1970-01-01';
				}
				else{
					$tgls 		= explode('/', Input::get('new_txt_tanggal_lahir'));
					if( isset($tgls[2]) ){
						$tgl_lahir 	= $tgls[2].'-'.$tgls[1].'-'.$tgls[0];
					}
					else{
						$tgl_lahir = '1970-01-01';
					}
				}
				

				$pasien->TanggalLahir 	= $tgl_lahir;
				$pasien->Suku 			= Input::get('new_txt_suku');
				$pasien->Agama 			= Input::get('new_cmb_agama');
				$pasien->Pekerjaan 		= Input::get('new_txt_pekerjaan');
				$pasien->Pendidikan		= Input::get('new_cmb_pendidikan');
				$pasien->Status 		= Input::get('new_cmb_status');
				$pasien->Jalan 			= Input::get('new_txt_alamat');
				$pasien->Kelurahan 		= Input::get('new_txt_kelurahan');
				$pasien->Kecamatan 		= Input::get('new_txt_kecamatan');
				$pasien->KotaKab 		= Input::get('new_txt_kota');
				$pasien->Provinsi 		= Input::get('new_txt_provinsi');
				$pasien->NoTelp 		= Input::get('new_txt_no_telp');
				$pasien->GolPasien 		= Input::get('new_cmb_golongan_pasien');
				/** For RST **/
				$pasien->SubGolPasien = Input::get('new_cmb_sub_golongan');
				if(Input::get('new_cmb_golongan_pasien') == 'BPJS')
				{
					if(Input::get('new_cmb_sub_golongan') == 'Askes')
					{
						$pasien->GolAskes = Input::get('new_cmb_askes_golongan');
						$pasien->GolNoAskes = Input::get('new_txt_bpjs_kartu');
						$pasien->NoBPJS = Input::get('new_txt_bpjs_kartu');
					}
					else if(Input::get('new_cmb_sub_golongan') == 'Dinas')
					{
						$pasien->GolDinas 		= Input::get('new_cmb_dinas_golongan');
						$pasien->Hub 			= Input::get('new_cmb_dinas_hubungan');
						$pasien->Jenishub 		= Input::get('new_cmb_dinas_jenis_hubungan');
						$pasien->PangkatGol 	= Input::get('new_cmb_dinas_pangkat');
						$pasien->NRPNIP 		= Input::get('new_txt_dinas_nip');
						$pasien->GolKes 		= Input::get('new_cmb_golongan_kesatuan');
						$pasien->Kesatuan 		= Input::get('new_txt_dinas_kesatuan');
						$pasien->NoBPJS 		= Input::get('new_txt_bpjs_kartu');
					}
					else if(Input::get('new_cmb_sub_golongan') == 'BPJS Mandiri')
					{
						$pasien->NoBPJS 		= Input::get('new_txt_bpjs_kartu');
					}
					else if(Input::get('new_cmb_sub_golongan') == 'Jamkesmas')
					{
						$pasien->NoBPJS 		= Input::get('new_txt_bpjs_kartu');
						$pasien->NoJamkesmas 	= Input::get('new_txt_bpjs_kartu');
					}
					else{
						$pasien->NoBPJS = Input::get('new_txt_bpjs_kartu');
					}

					$pasien->KelasAskes 	= Input::get('new_cmb_kelas_bpjs');
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

				$pasien->NamaPJ 	= Input::get('new_NamaPJ');
				$pasien->AlamatPJ 	= Input::get('new_AlamatPJ');
				$pasien->HubPJ 		= Input::get('new_HubPJ');
				$pasien->TelpPJ 	= Input::get('new_TelpPJ');

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

	public function cetakKartu(){
		return View::make('pasien.cetak_kartu');
	}

	public function barcode($id){
		//header('Content-type:image/png');
		echo DNS1D::getBarcodePNG($id, "C39+",1,43);
		//die();
	}

	public function getBarcode($id){
		return DNS1D::getBarcodePNG($id, "C39+",1,43);
	}

	public function editRm(){
		return View::make('pasien.edit_rm');
	}

	public function updateRm(){
		$norm 	= Input::get('norm');
		$newrm 	= Input::get('newrm');

		$newrm = intval($newrm);

		while(strlen($newrm) < 6){
			$newrm = "0".$newrm;
		}

		$check = DB::table('tbpasien')->where('NoRM' , $newrm)->get();

		$return = array();

		if( isset($check) && count($check) > 0 ){
			$return['status'] 	= 'gagal';
			$return['pesan'] 	= 'Nomor RM Telah digunakan pasien lain';
		}
		else{
			DB::table('tbpasien')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbmasukrs')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbkeluar')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbpasieninap')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbpasienjalan')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbpasienugd')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbdetaildiagnosis')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbdetaildokter')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbdetailobat')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			DB::table('tbdetailtindakan')->where('NoRM' , $norm)->update(
				array(
					'NoRM' => $newrm
				)
			);

			

			$return['status'] 	= 'berhasil';
			$return['pesan'] 	= 'Data berhasil terupdate';
		}

		echo( json_encode($return) );
		die();
	}

	public function label($norm){
		$pasien 	= DB::table('tbpasien')->where('NoRM' , $norm)->first();

		$txt1 = $txt2 = $txt3 = "";
		if( isset($pasien->NoRM)){
			$txt1 = strtoupper( $pasien->Nama );
			$txt2 = $pasien->NoRM;
			$txt3 = strtoupper( $pasien->TanggalLahir );

			$tgl 	= explode('-' , $txt3); 
			$txt3 	= $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
		}
		$pdf = new TCPDF('L', PDF_UNIT, array(50, 20), true, 'UTF-8', false);
		//$pdf = new TCPDF();
		//set the logo
		// set default footer font
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		
		$pdf->SetMargins(5, 3, 5, true);
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
		$font = $pdf->addTTFfont(public_path()."/fonts/tahoma.ttf");
		//set the default font
		$txt1 	= substr($txt1, 0,15);
		$pdf->SetFont('helvetica', 'B', 12);
		//create new page
		$pdf->AddPage();

		$pdf->Write(0, $txt1, '', 0, 'C', true, 0, false, false, 0);


		$pdf->SetFont('helvetica', 'B', 27);
		$pdf->AddPage();
		$pdf->Write(0, $txt2, '', 0, 'C', true, 0, false, false, 0);

		$pdf->AddPage();


		$pdf->SetFont('helvetica', 'B', 21);
		$pdf->Write(12, $txt3, '', 0, 'C', true, 0, false, false, 0);

		$pdf->Output('cetak_label_'.$txt2.'.pdf', 'I');
	}

	public function labelMap($norm){
		$pasien 	= DB::table('tbpasien')->where('NoRM' , $norm)->first();

		$txt1 = $txt2 = $txt3 = "";
		if( isset($pasien->NoRM)){
			$txt1 	= $pasien->Nama;
			$txt2 	= $pasien->NoRM;
			$tgl 	= explode('-',$pasien->TanggalLahir);
			$txt3 	= $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
		}
		$pdf = new TCPDF('L', PDF_UNIT, array(50, 20), true, 'UTF-8', false);
		//$pdf = new TCPDF();
		//set the logo
		// set default footer font
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		
		$pdf->SetMargins(4, 1, 4, true);
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
		$pdf->SetFont('helvetica', 'B', 10);
		//create new page
		$pdf->AddPage();

		$txt1 	= substr($txt1, 0,20);

		$html = "Nama  : ".$txt1;
		$html .= "<br />No RM  : ".$txt2;
		$html .= "<br />TL  : ".$txt3;
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('cetak_label_map_'.$txt2.'.pdf', 'I');
	}
	
	public function cetak($norm){
		$pasien 	= DB::table('tbpasien')->where('NoRM' , $norm)->first();

		$txt1 = $txt2 = $txt3 = "";
		if( isset($pasien->NoRM)){
			return View::make('pasien.cetak' , array('pasien' => $pasien));
		}
		else{
			die('Data tidak ditemukan');
		}
	}

	public function kartu($norm){
		$pasien 	= DB::table('tbpasien')->where('NoRM' , $norm)->first();

		$txt1 = $txt2 = $txt3 = "";
		if( isset($pasien->NoRM)){
			$txt1 	= $pasien->Nama;
			$txt2 	= $pasien->NoRM;
			$tgl 	= explode('-',$pasien->TanggalLahir);
			$txt3 	= $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
		}
		$pdf = new TCPDF('L', PDF_UNIT, array(85, 53), true, 'UTF-8', false);
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
		$pdf->SetFontSize(9);
		//create new page
		$pdf->AddPage();

		//$txt1 = substr($txt1, 0,13);

		$html = "";
		$html .= "<br /><br /><br /><br /><br />Hallo, namaku<br />"."<b style='font-style:bold;'>".$txt1."</b>";
		$html .= "<br /><table><tr><td>";
		$html .= "<br /><br />"."Tanggal lahirku<br />"."<b>".$txt3."</b>";
		$html .= "<br /><br />"."Nomor Rekam Medikku<br />"."<b>".$txt2."</b>";
		$html .= "</td>";

		$html  .= "<td align='right'>";
		$barcode 	= $this->getBarcode($norm);
		$html .= "<br /><br /><br />";
		$html 		.= '&nbsp;<img style="float:right;" width="100px" src="data:image/png;base64,'.$barcode.'" alt="barcode"   />';
		$html .= "</td></tr></table>";
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('cetak_kartu_'.$txt2.'.pdf', 'I');
	}
	
}