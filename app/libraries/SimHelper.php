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

	public function umur($tgl_lahir,$tgl_sekarang){
		$tgl=explode("-",$tgl_lahir);
		$tgl_lahir=$tgl['2'];
		$bln_lahir=$tgl['1'];
		$thn_lahir=$tgl['0'];

		$tgl2=explode("-",$tgl_sekarang);
		$tanggal_today 	= $tgl2['2'];
		$bulan_today 	= $tgl2['1'];
		$tahun_today 	= $tgl2['0'];
		//menghitung jumlah hari sejak tahun 0 masehi
		$harilahir=cal_to_jd(CAL_GREGORIAN,$bln_lahir,$tgl_lahir,$thn_lahir);  
		//menghitung jumlah hari sejak tahun 0 masehi
		$hariini=cal_to_jd(CAL_GREGORIAN,$bulan_today,$tanggal_today,$tahun_today);  
		//menghitung selisih hari antara tanggal sekarang dengan tanggal lahir
		$umur=$hariini-$harilahir;
		$tahun=$umur/365;//menghitung usia tahun
		$sisa=$umur%365;//sisa pembagian dari tahun untuk menghitung bulan
		$bulan=$sisa/30;//menghitung usia bulan
		$hari=$sisa%30;//menghitung sisa hari
		$lahir= "$tgl_lahir-$bln_lahir-$thn_lahir";
		$today= "$tanggal_today-$bulan_today-$tahun_today";
		$selisih=floor($tahun)." Thn, ".floor($bulan)." Bln, ".$hari." Hari";
		return $selisih;
	}

	public function umurTahun($tgl_lahir,$tgl_sekarang){
		$tgl=explode("-",$tgl_lahir);
		$tgl_lahir=$tgl['2'];
		$bln_lahir=$tgl['1'];
		$thn_lahir=$tgl['0'];

		$tgl2=explode("-",$tgl_sekarang);
		$tanggal_today 	= $tgl2['2'];
		$bulan_today 	= $tgl2['1'];
		$tahun_today 	= $tgl2['0'];
		//menghitung jumlah hari sejak tahun 0 masehi
		$harilahir=cal_to_jd(CAL_GREGORIAN,$bln_lahir,$tgl_lahir,$thn_lahir);  
		//menghitung jumlah hari sejak tahun 0 masehi
		$hariini=cal_to_jd(CAL_GREGORIAN,$bulan_today,$tanggal_today,$tahun_today);  
		//menghitung selisih hari antara tanggal sekarang dengan tanggal lahir
		$umur=$hariini-$harilahir;
		$tahun=$umur/365;//menghitung usia tahun
		$sisa=$umur%365;//sisa pembagian dari tahun untuk menghitung bulan
		$bulan=$sisa/30;//menghitung usia bulan
		$hari=$sisa%30;//menghitung sisa hari
		$lahir= "$tgl_lahir-$bln_lahir-$thn_lahir";
		$today= "$tanggal_today-$bulan_today-$tahun_today";
		$selisih =floor($tahun)." Thn";
		return $selisih;
	}
}