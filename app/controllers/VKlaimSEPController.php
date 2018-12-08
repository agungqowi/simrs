<?php

class VklaimSEPController extends \VklaimController {

	public function insertSEP( ){
		$data				= array();
		$data['noKartu']	= '0000970037177';
		$data['tglSep']		= date('Y-m-d');
		$data['ppkPelayanan']	= '0442R001';
		$data['jnsPelayanan']	= '2';
		$data['klsRawat']	= '3';
		$data['noMR']	= '029571';
		$data['rujukan']['asalRujukan']	= '1';
		$data['rujukan']['tglRujukan']	= date('Y-m-d');
		$data['rujukan']['noRujukan']	= '11111';
		$data['rujukan']['ppkRujukan']	= '25150604';
		$data['catatan']	= '0000970037177';
		$data['diagAwal']	= "A00.1";
		$data['poli']['tujuan']	= 'INT';
		$data['poli']['eksekutif']	= '0';
		$data['cob']['cob']	= '0';
		$data['katarak']['katarak']	= '0';
		$data['jaminan']['lakaLantas']	= '0';
		$data['jaminan']['penjamin']['penjamin']	= '0';
		$data['jaminan']['penjamin']['tglKejadian']	= date('Y-m-d');
		$data['jaminan']['penjamin']['keterangan']	= '';
		$data['jaminan']['penjamin']['suplesi']['suplesi']	= '0';
		$data['jaminan']['penjamin']['suplesi']['noSepSuplesi']	= '0';
		$data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdPropinsi']	= '0';
		$data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKabupaten']	= '0';
		$data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKecamatan']	= '0';
		$data['noKartu']	= '0000970037177';
		$data['noKartu']	= '0000970037177';
		$data['skdp']['noSurat']	= '000002';
		$data['skdp']['kodeDPJP']	= '0000970037177';
		$data['noTelp']		= '0000970037177';
		$data['user']		= 'admin';

		$kirim				= array();
		$kirim['t_sep']		= $data;

		$post 				= json_encode($kirim);
		$url 				= '/SEP/1.1/insert';
		$return 			= $this->insertPOST($url,$kirim,'post');

		echo $return;
	}

	public function insertSEPSample( ){
		$data				= array();
		$data['noKartu']	= '0000970037177';
		$data['tglSep']		= date('Y-m-d');
		$data['ppkPelayanan']	= '0442R001';
		$data['jnsPelayanan']	= '2';
		$data['klsRawat']	= '3';
		$data['noMR']	= '029571';
		$data['rujukan']['asalRujukan']	= '1';
		$data['rujukan']['tglRujukan']	= date('Y-m-d');
		$data['rujukan']['noRujukan']	= '11111';
		$data['rujukan']['ppkRujukan']	= '25150604';
		$data['catatan']	= '0000970037177';
		$data['diagAwal']	= "A00.1";
		$data['poli']['tujuan']	= 'INT';
		$data['poli']['eksekutif']	= '0';
		$data['cob']['cob']	= '0';
		$data['katarak']['katarak']	= '0';
		$data['jaminan']['lakaLantas']	= '0';
		$data['jaminan']['penjamin']['penjamin']	= '0';
		$data['jaminan']['penjamin']['tglKejadian']	= date('Y-m-d');
		$data['jaminan']['penjamin']['keterangan']	= '';
		$data['jaminan']['penjamin']['suplesi']['suplesi']	= '0';
		$data['jaminan']['penjamin']['suplesi']['noSepSuplesi']	= '0';
		$data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdPropinsi']	= '0';
		$data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKabupaten']	= '0';
		$data['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKecamatan']	= '0';
		$data['noKartu']	= '0000970037177';
		$data['noKartu']	= '0000970037177';
		$data['skdp']['noSurat']	= '000002';
		$data['skdp']['kodeDPJP']	= '0000970037177';
		$data['noTelp']		= '0000970037177';
		$data['user']		= 'admin';

		$kirim				= array();
		$kirim['t_sep']		= $data;

		$post 				= json_encode($kirim);
		$url 				= '/SEP/1.1/insert';
		$return 			= $this->insertPOST($url,$kirim,'post');

		echo $return;
	}

	public function cariSEP($sep){
		$url 		= '/SEP/'.$sep;
		$return 	= $this->getData($url,'','get');

		echo $return;
	}

	public function hapusSEP(){		
		$data 			= array();
		$data['t_sep']['noSep']	= Input::get('sep');
		$data['t_sep']['user']	= Auth::user()->name;
		$url 			= '/SEP/Delete';
		$return 		= $this->insertCustom($url,$data,'DELETE');

		echo $return;
	}

}