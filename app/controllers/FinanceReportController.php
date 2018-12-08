<?php

class FinanceReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function tanggal($slug = 'apotek'){
		$tanggal 	= "tanggal";
		if($slug == 'lab'){
			$title = "Laboratorium";
		}
		else if($slug == 'konsul'){
			$tanggal 	= "tanggal_dokter";
			$title = 'Periksa Dokter';
		}
		else if($slug == 'konsultelp'){
			$tanggal 	= "tanggal_dokter";
			$title = 'Konsul Dokter via Telp';
		}
		else if($slug == 'visite'){
			$tanggal 	= "tanggal_dokter";
			$title 		= 'Visite Dokter';
		}
		else if($slug == 'harian'){
			$title = "Rincian Harian";
		}
		else if($slug == 'bulanan'){
			$title = "Rekap Harian";
		}
		else{
			$slug = 'ugd';
			$title = 'UGD';
		}
		return View::make('finance.report.'.$tanggal,
			array(
					'slug' => $slug,
					'title' => $title
			)
		);
	}


	public function labInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$data 	= DB::table('tbdetailtindakan')->join('tbpasien','tbpasien.NoRM','=' ,'tbdetailtindakan.NoRM')
				->join('tbpasienjalan','tbpasienjalan.NoRegJalan' ,'=' ,'tbdetailtindakan.NoReg')
				->where('Gol' , 'LABORATORIUM')
				->whereBetween( 'TanggalTindak', array($dari,$sampai) )->orderBy('TanggalMasuk','ASC')
				->orderBy('NoReg' ,'ASC')->get();

		$data2 	= DB::table('tbtindakanranap')->join('tbpasien','tbpasien.NoRM','=' ,'tbtindakanranap.NoRM')
				->join('tbpasieninap','tbpasieninap.NoReg' ,'=' ,'tbtindakanranap.NoReg')
				->where('Gol' , 'LABORATORIUM')
				->whereBetween( 'TanggalTindak', array($dari,$sampai) )->orderBy('TanggalMasuk','ASC')
				->orderBy('tbtindakanranap.NoReg' ,'ASC')->get();

		return View::make( 'finance.report.lab' , array('data' => $data ,'data2' => $data2 ,'dari' => $dari,'sampai' => $sampai) );
	}

	public function konsulInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$dokter 	= Input::get('dokter');
		$cara_bayar = Input::get('cara_bayar');

		if( $dokter == 0 ){
			$data 	= DB::table('tbdetailtindakan')->join('tbpasien','tbpasien.NoRM','=' ,'tbdetailtindakan.NoRM')
				->join('tbpasienjalan','tbpasienjalan.NoRegJalan' ,'=' ,'tbdetailtindakan.NoReg')
				->whereIn( 'IdTindakan' , array(3,4,13) )
				->whereBetween( 'TanggalTindak', array($dari,$sampai) );
		}
		else{
			$data 	= DB::table('tbdetailtindakan')->join('tbpasien','tbpasien.NoRM','=' ,'tbdetailtindakan.NoRM')
				->join('tbpasienjalan','tbpasienjalan.NoRegJalan' ,'=' ,'tbdetailtindakan.NoReg')
				->whereIn('tbdetailtindakan.IdTindakan' , array(3,4,13))
				->where('tbdetailtindakan.IdDokter' , $dokter)
				->whereBetween( 'TanggalTindak', array($dari,$sampai) );
		}

		if( $cara_bayar != "0" ){
			$data 	= $data->where('tbpasienjalan.CaraBayar' , $cara_bayar);
		}

		$data 	= $data->orderBy('TanggalMasuk','ASC')
				->orderBy('NoReg' ,'ASC')->get();

		return View::make( 'finance.report.konsul' , array('data' => $data ,'dari' => $dari,'sampai' => $sampai , 'dokter' => $dokter , 'cara_bayar' => $cara_bayar) );

	}

	public function konsulTelpInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$dokter 	= Input::get('dokter');
		$cara_bayar = Input::get('cara_bayar');

		if( $dokter == 0 ){
			$data 	= DB::table('tbdetailtindakan')->join('tbpasien','tbpasien.NoRM','=' ,'tbdetailtindakan.NoRM')
				->join('tbpasienjalan','tbpasienjalan.NoRegJalan' ,'=' ,'tbdetailtindakan.NoReg')
				->whereIn( 'IdTindakan' , array(14,124) )
				->whereBetween( 'TanggalTindak', array($dari,$sampai) );
		}
		else{
			$data 	= DB::table('tbdetailtindakan')->join('tbpasien','tbpasien.NoRM','=' ,'tbdetailtindakan.NoRM')
				->join('tbpasienjalan','tbpasienjalan.NoRegJalan' ,'=' ,'tbdetailtindakan.NoReg')
				->whereIn('tbdetailtindakan.IdTindakan' , array(14,124))
				->where('tbdetailtindakan.IdDokter' , $dokter)
				->whereBetween( 'TanggalTindak', array($dari,$sampai) );
		}

		if( $cara_bayar != "0" ){
			$data 	= $data->where('tbpasienjalan.CaraBayar' , $cara_bayar);
		}

		$data 	= $data->orderBy('TanggalMasuk','ASC')
				->orderBy('NoReg' ,'ASC')->get();

		return View::make( 'finance.report.konsultelp' , array('data' => $data ,'dari' => $dari,'sampai' => $sampai , 'dokter' => $dokter , 'cara_bayar' => $cara_bayar) );

	}

	public function visiteInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		$dokter 	= Input::get('dokter');
		$cara_bayar = Input::get('cara_bayar');

		if( $dokter == 0 ){
			$data 	= DB::table('tbtindakanranap')->join('tbpasien','tbpasien.NoRM','=' ,'tbtindakanranap.NoRM')
				->join('tbpasieninap','tbpasieninap.NoReg' ,'=' ,'tbtindakanranap.NoReg')
				->where( 'IdKategoriTindakan' , '21' )
				->whereBetween( 'TanggalTindak', array($dari,$sampai) );
		}
		else{
			$data 	= DB::table('tbtindakanranap')->join('tbpasien','tbpasien.NoRM','=' ,'tbtindakanranap.NoRM')
				->join('tbpasieninap','tbpasieninap.NoReg' ,'=' ,'tbtindakanranap.NoReg')
				->where('IdKategoriTindakan' , 21)
				->where('tbtindakanranap.IdDokter' , $dokter)
				->whereBetween( 'TanggalTindak', array($dari,$sampai) );
		}

		if( $cara_bayar != "0" ){
			$data 	= $data->where('tbpasieninap.CaraBayar' , $cara_bayar);
		}

		$data 	= $data->orderBy('TanggalMasuk','ASC')
				->orderBy('tbtindakanranap.NoReg' ,'ASC')->get();

		return View::make( 'finance.report.visite' , array('data' => $data ,'dari' => $dari,'sampai' => $sampai , 'dokter' => $dokter , 'cara_bayar' => $cara_bayar) );

	}

	public function harianInput(){
		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari'));
		$dari = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai'));
		$sampai = $date->format('Y-m-d');

		return View::make( 'finance.report.harian' , array('dari' => $dari,'sampai' => $sampai) );
	}

}