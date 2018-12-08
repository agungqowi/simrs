<?php

class VKlaimHelper
{
	public function getSignature($data,$secretKey){
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
   		$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
	}
}