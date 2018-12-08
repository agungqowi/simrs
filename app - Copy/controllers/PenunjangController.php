<?php

class PenunjangController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		$ugd = User::find( Auth::user()->id )->ugd;
		return View::make('ugd.list', array('ugd' => $ugd));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ugd.create' );
	}

	public function laboratorium()
	{
		$ruangan = Ruangan::all();
		return View::make('penunjang.general' , array('title' => 'Laboratorium' , 'slug' => 'lab'));
	}

	public function radiologi()
	{
		return View::make('penunjang.radiologi' , array('title' => 'Radiologi' , 'slug' => 'radiologi'));
	}

	public function pa()
	{
		return View::make('penunjang.pa' , array('title' => 'Lab Patologi Anatomi' , 'slug' => 'pa'));
	}

	public function fisioterapi()
	{
		return View::make('penunjang.general_withdokter' , array('title' => 'Fisioterapi' , 'slug' => 'fisioterapi'));
	}

	public function fisioterapi_dokter()
	{
		return View::make('penunjang.general_withdokter' , array('title' => 'Fisioterapi' , 'slug' => 'fisioterapi'));
	}

	public function list_tindakan($slug,$id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbdetailtindakan')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function list_tindakan_inap($slug,$id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbtindakanranap')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function list_tindakan_aps($slug,$id=0)
	{
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbtindakanaps')->where('NoReg', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function tambah_tindakan()
	{
		$opt 	= Input::get('opt');
		$id_reg 	= Input::get('id_reg');

		if( $opt == 'RI' ){
			$tindakan = new TindakanRanap;
		}
		else if( $opt == 'APS' ){
			$tindakan = new TindakanAPS;
		}
		else{
			$tindakan = new DetailTindakan;
			$tindakan->IdReg =  $id_reg;
		}

		
		$tindakan->NoRM = Input::get('norm');
		$tindakan->JenisRawat = Input::get('jenis_rawat');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		$tindakan->TanggalMasuk = $date->format('Y-m-d');
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_tindakan'));
		$tindakan->TanggalTindak = $date->format('Y-m-d');
		$tindakan->IdTindakan = Input::get('id_tindakan');
		$tindakan->Tindakan = Input::get('tindakan');
		$tindakan->NoReg =  Input::get('noreg');

		$id_tindak = Input::get('id_tindakan');
		$t = DB::table('tbtindakan')->join('tbkategoritindakan' , 'tbkategoritindakan.ID' , '=' ,'tbtindakan.IdKategoriTindakan')
		->where('IdTindakan',$id_tindak)->first();
		if(isset($t->Tarif)){
			$penjamin 	= Input::get('penjamin');
			if( $penjamin == 'BPJS'){
				$tarif = $t->TarifBPJS;
			}
			else{
				$tarif = $t->Tarif;
			}
			
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

		
		if( isset($id_reg) && $opt == 'RJ' ){
			$pasien 	= DB::table('tbpasienjalan')->where('IdRegJalan' , $id_reg)->update(
				array( 'StatusBayar' => '0')
			);
		}
		
	}

	public function hapus_tindakan_aps(){
		$id_tindakan 	= Input::get('id_tindakan');
		$hapus 	= DB::table('tbtindakanaps')->where('IdDetailTindak' , $id_tindakan)->delete();
	}

}
