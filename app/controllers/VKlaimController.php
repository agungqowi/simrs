<?php

use GuzzleHttp\Middleware;

class VklaimController extends \BaseController {

	public function cariPesertaByNik($nik){
		$date 	= date('Y-m-d');
		$url 	= '/Peserta/nik/'.$nik.'/tglSEP/'.$date;

		$return 	= $this->getData($url,'','get');

		echo $return;
	}

	public function cariPesertaByBPJS($kartu){
		$date 	= date('Y-m-d');
		$url 	= '/Peserta/nokartu/'.$kartu.'/tglSEP/'.$date;

		$return 	= $this->getData($url,'','get');

		echo $return;
		
	}

	public function cariRujukanRS($no_rujukan){
		$date 		= date('Y-m-d');
		$url 		= '/Rujukan/RS/'.$no_rujukan;

		$return 	= $this->getData($url,'','get');

		echo $return;
	}

	/**
	 	Parameter 1 : nama atau kode faskes
		Parameter 2 : Jenis Faskes (1. Faskes 1, 2. Faskes 2/RS)
	*/
	public function cariFaskes($param1="-", $param2="-"){
		$url 		= '/referensi/faskes/'.$param1.'/'.$param2;
		$return 	= $this->getData($url,'','get');

		echo $return;

	}

	/**
	 	Parameter 1 : Jenis Pelayanan (1. Rawat Inap, 2. Rawat Jalan)
		Parameter 2 : Tgl.Pelayanan/SEP (yyyy-mm-dd)
		Parameter 3 : Kode Spesialis/Subspesialis
	*/
	public function cariDPJP($param1="-", $param2="-",$param3='-'){
		$url 		= '/referensi/dokter/pelayanan/'.$param1.'/tglPelayanan/'.$param2.'/Spesialis/'.$param3;
		$return 	= $this->getData($url,'','get');

		echo $return;

	}

	public function getData($url,$konten,$method,$tipe='json') {
		date_default_timezone_set('UTC');
		$xconsid 	= Config::get('settings.vklaim_xcons-id');
		$endpoint 	= Config::get('settings.vklaim_endpoint');
		$url 		= $endpoint.$url;
		$tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		$secretKey 	= Config::get('settings.vklaim_secretkey');
	   	$signature 	= hash_hmac('sha256', $xconsid."&".$tStamp, $secretKey, true);
	   	$encodedSignature = base64_encode($signature);

		$opts = array(
			  	'http'		=>array(
				'method'	=>$method,
				'header'	=>	"Content-type: application/".$tipe."\r\n" .
						  		"X-cons-id: ".$xconsid."\r\n" .
						  		"X-timestamp:".$tStamp."\r\n" .
						  		"X-signature: ".$signature."\r\n",
				'content' 	=> $konten
			  )
		);
		
		/*
		// persiapkan curl
	    $ch = curl_init($url); 

	    // set url 
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "X-cons-id: ".$xconsid,
		    "X-timestamp:".$tStamp,
		    "X-signature: ".$encodedSignature
		));

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    // $output contains the output string 
	    $output = curl_exec($ch); 

	    // tutup curl 
	    curl_close($ch);    
	    */
	    try {
		    $client = new GuzzleHttp\Client();
			$res = $client->request($method,$url, [
	            'headers' => [
	                'X-cons-id' 	=> $xconsid,
	                'X-timestamp' 	=> $tStamp,
	                'X-signature'	=> $encodedSignature
	            ] ]);
        	$return = $res->getBody() ;
		}
		catch (RequestException $e) {
		    if ($e->getResponse()->getStatusCode() == '400') {
		          $return = $e->getResponse();
		    }

		} catch (\Exception $e) {
			//print_r($e);
			//echo $e->getResponse()->getStatusCode();
			$return = $e->getResponse();
		}
	   	// echo 'signature '.$encodedSignature."<br />";
	    // echo 'timestamp '.$tStamp."<br />";
	    
	      

		return $return;
	}

	public function insertPost($url,$konten,$tipe='json') {
		date_default_timezone_set('UTC');
		$xconsid 	= Config::get('settings.vklaim_xcons-id');
		$endpoint 	= Config::get('settings.vklaim_endpoint');
		$url 		= $endpoint.$url;
		$tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		$secretKey 	= Config::get('settings.vklaim_secretkey');
	   	$signature 	= hash_hmac('sha256', $xconsid."&".$tStamp, $secretKey, true);
	   	$encodedSignature = base64_encode($signature);

		$data_string = json_encode(array("request" =>$konten));
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/x-www-form-urlencoded',
			"X-cons-id: ".$xconsid,
		    "X-timestamp:".$tStamp,
		    "X-signature: ".$encodedSignature
		));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$return = curl_exec($ch);

		curl_close($ch);

		//echo $data_string;
	   	/*
	    try {
		    $client = new GuzzleHttp\Client();
		    $tapMiddleware = Middleware::tap(function ($request) {
			    echo $request->getHeaderLine('Content-Type');
			    // application/json
			    echo $request->getBody();
			    // {"foo":"bar"}
			});
			$res = $client->request('POST',$url, [
	            'headers' => [
	                'X-cons-id' 	=> $xconsid,
	                'X-timestamp' 	=> $tStamp,
	                'X-signature'	=> $encodedSignature,
	                'Content-Type' => 'application/x-www-form-urlencoded'
	            ], 
	            'json' => ['request'=>$konten] ,
	            'timeout' => 10]);
        	$return = $res->getBody() ;
		}
		catch (RequestException $e) {
		    if ($e->getResponse()->getStatusCode() == '400') {
		          $return = $e->getResponse();
		    }

		} catch (\Exception $e) {
			//print_r($e);
			//echo $e->getResponse()->getStatusCode();
			$return = $e->getMessage();
		}
		*/
	   	// echo 'signature '.$encodedSignature."<br />";
	    // echo 'timestamp '.$tStamp."<br />";
	    
	      

		return $return;
	}

	public function insertCustom($url,$konten,$method='PUT') {
		date_default_timezone_set('UTC');
		$xconsid 	= Config::get('settings.vklaim_xcons-id');
		$endpoint 	= Config::get('settings.vklaim_endpoint');
		$url 		= $endpoint.$url;
		$tStamp 	= strval(time()-strtotime('1970-01-01 00:00:00'));
		$secretKey 	= Config::get('settings.vklaim_secretkey');
	   	$signature 	= hash_hmac('sha256', $xconsid."&".$tStamp, $secretKey, true);
	   	$encodedSignature = base64_encode($signature);

		$data_string = json_encode(array("request" =>$konten));
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/x-www-form-urlencoded',
			"X-cons-id: ".$xconsid,
		    "X-timestamp:".$tStamp,
		    "X-signature: ".$encodedSignature
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$return = curl_exec($ch);

		curl_close($ch);

		return $return;
	}
}