<?php

class CrudHelper
{
	function nowDate(){
		
	}

	function TanggalBaca($tanggal = '0000-00-00'){
		$tanggals 	= explode('-' , $tanggal);
		return $tanggals[2].'/'.$tanggals[1].'/'.$tanggals[0];
	}
}