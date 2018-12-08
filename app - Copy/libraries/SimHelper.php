<?php

class SimHelper
{

	public function getDokterByNoReg($no_reg)
	{
		$data = DetailDokter::where('NoReg',$no_reg)->get();
		return $data;
	}

	public function getRuanganByNoReg($no_reg)
	{	
		$data = DB::table('tbpasieninap')->where('NoReg',$no_reg)->get();
		return $data;
	}
}