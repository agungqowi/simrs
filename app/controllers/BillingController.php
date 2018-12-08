<?php

class BillingController extends \BaseController {

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

	public function rawat_jalan()
	{
		$ruangan = Ruangan::all();
		return View::make('billing.rawat_jalan' , array('ruangan' => $ruangan));
	}

	public function rawat_jalan_post()
	{
		$no_reg = Input::get('no_reg');
		$registrasi = DB::table('tbpasienjalan')->where('NoRegJalan','=',$no_reg)->first();
		$ruangan = Ruangan::all();
		
		if($registrasi)
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
		else
			$pasien = new \stdClass(); 
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)
					->get();
		$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->first();
		if( isset($penjualan->id) ){
			$obat 			= DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
			$id_penjualan 	= $penjualan->id;
		}
		else{
			$obat 			= DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
			 $id_penjualan	= 0;
		}
		
		//var_dump($registrasi);
		return View::make('billing.rawat_jalan_view' , 
			array(
				'registrasi' => $registrasi , 
				'pasien' => $pasien , 
				'dokter' => $dokter ,
				'obat' => $obat ,
				'tindakan' => $tindakan,
				'id_penjualan'	=> $id_penjualan ,
				'cetak_obat' => Input::get('cetak_obat')
			)
		);
	}

	public function rawat_jalan_print($no_reg="",$mode)
	{
		if($no_reg!=""){
			$registrasi = DB::table('tbpasienjalan')->where('NoRegJalan','=',$no_reg)->first();
			$ruangan = Ruangan::all();
			
			if($registrasi)
				$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
			else
				$pasien = new \stdClass(); 
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$admin = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->where('Tipe' , 'admin')
						->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->where('Tipe' ,'!=' , 'admin')
						->get();
			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->first();
			if( isset($penjualan->id) ){
				$obat 			= DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
				$id_penjualan 	= $penjualan->id;
			}
			else{
				$obat 			= DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
				$id_penjualan 	= 0;
			}
			//var_dump($registrasi);
			return View::make('billing.rawat_jalan_print' , 
				array(
					'registrasi' => $registrasi , 
					'pasien' => $pasien , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'tindakan' => $tindakan,
					'admin' => $admin,
					'id_penjualan'	=> $id_penjualan ,
					'cetak_obat' => $mode,
					'helper'=>new SimHelper
				)
			);
		}
		
	}

	public function rawat_inap()
	{
		$ruangan = Ruangan::all();
		return View::make('billing.rawat_inap' , array('ruangan' => $ruangan));
	}

	public function rawat_inap_view()
	{
		$no_reg = Input::get('no_reg');
		$registrasi = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->first();
		$inap = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->get();
		$keluar = DB::table('tbkeluar')->where('NoReg' , $no_reg)->get();
		$out = DB::table('tbkeluar')->where('NoReg' , $no_reg)->orderBy('TanggalKeluar','desc')->first();
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbtindakanranap')->where('NoReg' , $no_reg)->orderBy('GOL')->get();
		$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->first();
		if( isset($penjualan->id) ){
			$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
		}
		else{
			$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
		}
		//var_dump($registrasi);
		if($registrasi){
			return View::make('billing.rawat_inap_view' , 
				array(
					'registrasi' => $registrasi , 
					'inap' => $inap , 
					'keluar' => $keluar , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'out'	=> $out,
					'tindakan' => $tindakan,
					'cetak_obat' => Input::get('cetak_obat')
				)
			);
		}
		else{
			echo 'Informasi pasien tidak ditemukan';
		}
	}

	public function rawat_inap_print($no_reg="",$mode)
	{
		if($no_reg != ""){
			$registrasi = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->first();
			$keluar = DB::table('tbkeluar')->where('NoReg' , $no_reg)->get();
			$out = DB::table('tbkeluar')->where('NoReg' , $no_reg)->orderBy('TanggalKeluar','desc')->first();
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbtindakanranap')->where('NoReg' , $no_reg)->orderBy('GOL')->get();
			$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->first();
			if( isset($penjualan->id) ){
				$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
			}
			else{
				$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
			}
			$inap = DB::table('tbpasieninap')->join('tbpasien','tbpasieninap.NoRM' , '=' ,'tbpasien.NoRM')
			->where('NoReg','=',$no_reg)->get();
			//var_dump($registrasi);
			if($registrasi){
				return View::make('billing.rawat_inap_print' , 
					array(
						'registrasi' => $registrasi , 
						'keluar' => $keluar , 
						'inap' => $inap , 
						'dokter' => $dokter ,
						'obat' => $obat ,
						'out'	=> $out,
						'tindakan' => $tindakan,
						'cetak_obat' => $mode,
						'helper'=>new SimHelper
					)
				);
			}
			else{
				echo 'Informasi pasien tidak ditemukan';
			}
		}		
	}

	public function ugd()
	{
		return View::make('billing.ugd');
	}

	public function ugd_view()
	{
		$no_reg = Input::get('no_reg');
		$registrasi = DB::table('tbpasienugd')->where('NoRegUGD','=',$no_reg)->first();
		$ruangan = Ruangan::all();
		
		if($registrasi)
			$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
		else
			$pasien = new \stdClass(); 
		$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
		$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
		$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->first();
		if( isset($penjualan->id) ){
			$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
		}
		else{
			$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
		}
		//var_dump($registrasi);
		return View::make('billing.ugd_view' , 
			array(
				'registrasi' => $registrasi , 
				'pasien' => $pasien , 
				'dokter' => $dokter ,
				'obat' => $obat ,
				'tindakan' => $tindakan,
				'cetak_obat' => Input::get('cetak_obat')
			)
		);
	}

	public function ugd_print($no_reg,$mode)
	{
		if($no_reg != ""){
			$registrasi = DB::table('tbpasienugd')->where('NoRegUGD','=',$no_reg)->first();
			$ruangan = Ruangan::all();
			
			if($registrasi)
				$pasien = DB::table('tbpasien')->where('NoRM' , $registrasi->NoRM)->first();
			else
				$pasien = new \stdClass(); 
			$dokter = DB::table('tbdetaildokter')->where('NoReg' , $no_reg)->get();
			$tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $no_reg)->get();
			$$penjualan 	= DB::table('apo_penjualan')->where('NoReg' , $no_reg)->first();
			if( isset($penjualan->id) ){
				$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
			}
			else{
				$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
			}
			//var_dump($registrasi);
			return View::make('billing.ugd_print' , 
				array(
					'registrasi' => $registrasi , 
					'pasien' => $pasien , 
					'dokter' => $dokter ,
					'obat' => $obat ,
					'tindakan' => $tindakan,
					'cetak_obat' => $mode
				)
			);
		}
		
	}

	public function jasa_dokter()
	{
		return View::make('billing.jasa_dokter' );
	}


	public function downPayment($id=0)
	{	
		$data 						= new stdClass();
		$data->no_rm 				= '';
		$data->no_reg 				= '';
		$data->nama 				= '';
		$data->jenis_pasien 		= '';
		$data->tanggal_masuk 		= '';
		$data->tanggal_deposit 		= '';
		$data->jumlah 				= '';
		$data->keterangan 			= '';
		$data->metode_pembayaran 	= '';

		if($id != 0){
			$get 	= DB::table('bill_deposit')->where( 'id' , $id )->first();

			if(isset($get->id)){
				$data = $get;
			}
		}

		$metode 	= DB::table('bill_metode')->get();

		return View::make('billing.down_payment' , array('no_id' => $id ,'metode' => $metode , 'data' => $data));
	}

	public function saveDownPayment()
	{
		$data 						= array();

		$data['no_reg']				= Input::get('no_reg');
		$data['no_rm'] 				= Input::get('no_rm');
		$data['nama'] 				= Input::get('txt_nama');
		$data['tanggal_deposit'] 	= Input::get('tanggal_bayar');
		$data['jumlah']				= Input::get('jumlah');
		$data['metode_pembayaran']	= Input::get('metode_pembayaran');
		$data['jenis']				= 'DP';

		$table 	= 'bill_deposit';
		$flag	= 0;
		$pesan 	= "";

		foreach($data as $da => $ta){
			if(empty($ta)){
				$flag++;

				$pesan .= $da."<br />";
			}
		}

		if( $flag > 0 ){
			$pesan 	= "Mohon isi data berikut : <br />".$pesan;
			return Redirect::to('billing/dp')->with('error', $pesan)->withInput();
		}
		else{
			$no_id 					= Input::get('no_id');
			$data['jenis_pasien'] 	= Input::get('txt_jenis_pasien');
			$data['tanggal_masuk'] 	= Input::get('txt_tanggal_masuk');
			$data['keterangan'] 	= Input::get('keterangan');
			if( $no_id ){
				$update 	= DB::table($table)->where('id' , $no_id)->update($data);
				$pesan		= 'Pembayaran berhasil diperbaharui';
				return Redirect::to('billing/dp/'.$no_id)->with('success', $pesan);
			}
			else{
				$insert 	= DB::table($table)->insertGetId($data);
				$pesan		= 'Pembayaran berhasil ditambahkan';
				return Redirect::to('billing/dp/'.$insert)->with('success', $pesan);
			}
		}
	}

	public function aps_obat_print($no_reg, $mode){
		if($no_reg != ""){
			$penjualan 	= DB::table('apo_penjualan')->where('id' , $no_reg)->first();
			if( isset($penjualan->id) ){
				$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
			}
			else{
				$obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
			}
			
			if($penjualan){
				return View::make('billing.aps_obat_print' , 
					array(
						'registrasi' 	=> $penjualan , 
						'obat' 			=> $obat ,
						'cetak_obat' 	=> $mode
					)
				);
			}
			else{
				echo 'Informasi pasien tidak ditemukan';
			}
		}
	}
}
