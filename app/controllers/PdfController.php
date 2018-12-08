<?php

class PdfController extends \BaseController {

	public function setDb()
	{
       $this->database = 'bpjsrs';
	}

	public function genCode()
	{
	   	$data = "1000";
	   	$secretKey = "1112";
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
	
	public function sepPdf($nomor)
	{
		$this->genCode();
		$konten = '';
		$url = Config::get('settings.url')."/sep/".$nomor;
		$method = 'GET';
		$tipe = 'json';
		$data = $this->getData($url,$konten,$method,$tipe);
		//get data
		$show = $data['response']['sep'];
		if($show['peserta']['sex']=='L') $jk = 'Laki-Laki'; else $jk = 'Perempuan';
		$logo = public_path()."/img/logo_bpjs.png";
		/* PDF Settings */
		$html = '

		<table width="77%" border="0">
			<tr>
				<td width="37%" rowspan="2"><img src="'.$logo.'" /></td>
				<td width="63%" align="center" style="font-size:15px">SURAT ELEGIBILITAS PESERTA<br />'.$this->rs_title.'</td>
			</tr>
		</table>
		<br /><br />
		<table width="100%" border="0">
			<tr>
				<td width="15%" height="17px">No. SEP</td>
				<td width="2%">: </td>
				<td width="35%" style="font-size:15px"> '.$show["noSep"].'</td>
				<td width="11%"></td>
				<td width="2%"></td>
				<td width="35%"></td>
			</tr>
			<tr>
				<td height="17px">Tgl. SEP</td>
				<td>: </td>
				<td> '.date( "d/m/Y", strtotime($show["tglSep"])).'</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td height="17px">No. Kartu</td>
				<td>: </td>
				<td> '.$show["peserta"]["noKartu"].'</td>
				<td style="padding-left:20px">Peserta</td>
				<td>: </td>
				<td> '.$show["peserta"]["jenisPeserta"]["nmJenisPeserta"].'</td>
			</tr>
			<tr>
				<td height="17px">Nama Peserta</td>
				<td>: </td>
				<td> '.$show["peserta"]["nama"].'</td>
				<td>&nbsp;</td>
				<td></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td height="17px">Tgl. Lahir</td>
				<td>: </td>
				<td> '.date( "d/m/Y", strtotime($show["peserta"]["tglLahir"])).'</td>
				<td style="padding-left:20px">COB</td>
				<td>: </td>
				<td> </td>
			</tr>
			<tr>
				<td height="17px">Jns. Kelamin</td>
				<td>: </td>
				<td> '.$jk.'</td>
				<td style="padding-left:20px">Jns. Rawat</td>
				<td>: </td>
				<td> '.$show["jnsPelayanan"].'</td>
			</tr>
			<tr>
				<td height="17px">Poli Tujuan</td>
				<td>: </td>
				<td> '.$show["poliTujuan"]["nmPoli"].'</td>
				<td style="padding-left:20px">Kls. Rawat</td>
				<td>: </td>
				<td> '.$show["klsRawat"]["nmKelas"].'</td>
			</tr>
			<tr>
				<td height="17px">Asal Faskes Tk. I</td>
				<td>: </td>
				<td> '.$show["provRujukan"]["nmProvider"].'</td>
				<td></td>
				<td></td>
				<td style="padding-left:20px"></td>
			</tr>
		</table>
		<table width="100%" border="0">
			<tr>
				<td width="15%" height="17px">Diagnosa Awal</td>
				<td width="2%">: </td>
				<td width="42%"> '.$show["diagAwal"]["nmDiag"].'</td>
				<td width="14%">Pasien/<br />Keluarga Pasien</td>
				<td width="2%"></td>
				<td width="25%">Petugas<br />BPJS Kesehatan</td>
			</tr>
			<tr>
				<td height="17px">Catatan</td>
				<td>: </td>
				<td> '.$show["catatan"].'</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:9px"><i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.</i></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:9px"><i>*SEP bukan sebagai bukti penjaminan peserta</i></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:10px" height="17px">'.date('d/m/Y h:i:s').' </td>
				<td style="padding-left:20px"><hr style="border-color: #333333 -moz-use-text-color #FFFFFF;" width="85%" /></td>
				<td></td>
				<td style="padding-left:20px"><hr style="border-color: #333333 -moz-use-text-color #FFFFFF;" width="50%" /></td>
			</tr>
		</table>			

		';
		//set logo
		$file_info = new SplFileInfo($logo);
		$ekstensi = strtoupper($file_info->getExtension());
		
		//set the PDF filename
		$namafile = 'sep.'.$nomor;
		/* PDF Processing */
		$pdf = new TCPDF('L', PDF_UNIT, array(210, 94), true, 'UTF-8', false);
		//$pdf = new TCPDF();
		//set the logo
		$image_file = K_PATH_IMAGES.'img/logo_bpjs.png';
		// set default footer font
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		
		$pdf->SetMargins(5, 7, 5, true);
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
		$pdf->SetFont('helvetica', '', 9);
		//create new page
		$pdf->AddPage();
		//set the logo
        //$pdf->Image($image_file, 13, 5, '', '10', $ekstensi, '', 'T', true, 300, '', false, false, 0, false, false, false);
		//writing the data
		$pdf->writeHTML($html, true, false, true, false, '');
		// reset pointer to the last page
		$pdf->lastPage();

		//save the file
		$filename = storage_path() . '/'.$namafile.'.pdf';
		$pdf->output($filename, 'F');

		return Response::download($filename);
		
	}

	


}