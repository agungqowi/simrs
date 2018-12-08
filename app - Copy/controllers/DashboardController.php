<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()) {
			$user = Auth::user();
			$projects = User::find( $user->id )->projects;
			$ruangan = Ruangan::all();
			$today = date('Y-m-d');
			$pasien_all = Pasien::where('NoRM' , '!=' , '')->count();
			$pasien_inap = DB::table('tbpasieninap')->where('Tanggal' , '=' , $today)->count();
			$pasien_jalans = DB::table('tbpasienjalan')->select('NoRegJalan')->distinct()
			->where('Tanggal' , '=' , $today)->get();
			$pasien_jalan = count($pasien_jalans);
			$pasien_ugd = RawatJalan::where('Tanggal' , '=' , $today)->groupBy('NoRegJalan')->count();

			$menu_d = array(
							'pasien' => array(
											'title' => 'Pasien',
											'url' => 'history_pasien',
											'icon' => 'multi-agents.png',
											'span_class' => 'label label-info',
											'span_content' => $pasien_all
										),
							'penyakit_teratas' => array(
											'title' => 'Lap Penyakit',
											'url' => 'report/bulan/penyakit',
											'icon' => 'badge.png',
											'span_class' => '',
											'span_content' => ''
										),
							'stok_obat' => array(
											'title' => 'Lap Stok Obat',
											'url' => 'report/stok_obat/askes',
											'icon' => 'bar-chart-02.png',
											'span_class' => '',
											'span_content' => ''
										),
			);
			return View::make('dashboard', array('user' => $user , 'ruangan' => $ruangan, 'pasien_all' => $pasien_all,
				'pasien_inap' => $pasien_inap , 'pasien_jalan' => $pasien_jalan , 'pasien_ugd' => $pasien_ugd,
				'menu_d' => $menu_d
			) );
		}
		else{
			return Redirect::to('login');
		}	
	}

	public function cari()
	{
		$param = Input::get('param');
		$text = Input::get('text');

		$search = DB::table('tbpasieninap')->join('tbpasien' , 'tbpasieninap.NoRM' , '=' , 'tbpasien.NoRM')
			->select('tbpasien.*','tbpasieninap.*' , DB::raw('YEAR(CURDATE()) - YEAR(tbpasien.TanggalLahir) AS umur'))
			->where('tbpasien.'.$param , 'LIKE' ,'%'.$text.'%')
			->orderBy('tbpasieninap.Tanggal','desc')->limit(20)->get();
		
		if($search){
			echo(json_encode($search));
		}
		else{
			$error = array('gagal' => 'yes');
			echo json_encode($error);
		}
		
	}

	public function pengaturan(){
		$check = DB::table('data_dasar')->where('id' , 1)->first();
		if( isset($check->id) && !empty($check->id) ){

		}
		else{
			$insert = DB::table('data_dasar')->insert(['id' => 1]);
			$check = DB::table('data_dasar')->where('id' , 1)->first();
		}


		$jenis = DB::table('data_jenisrs')->get();
		$swasta = DB::table('data_pjswasta')->get();
		$tahapan = DB::table('data_akreditasi')->get();

		return View::make('settings.rs' , array( 'data' => $check ,'jenis'=>$jenis,'swasta'=>$swasta,'tahapan'=>$tahapan) );
	}

	public function savePengaturan($id=""){
		$check = DB::table('data_dasar')->where('id' , 1)->first();

		$input = Input::all();
		$data = array();
		foreach($input as $key => $value){
			if( $key != 'tahun' && $key != 'submit' ){
				if($key == 'logo' ){
					$target_dir = public_path()."/img/";
					$target_file = $target_dir . basename($_FILES[$key]["name"]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					if($_FILES[$key]["error"] == 0) {
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
							
						}
						else{
							$check = getimagesize($_FILES[$key]["tmp_name"]);
						    if($check !== false) {
						        $uploadOk = 1;
						    } else {
						        $uploadOk = 0;
						    }

						    if ($uploadOk == 0) {
							// if everything is ok, try to upload file
							} else {
							    if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
							    	$data[$key] = basename($_FILES[$key]["name"]);
							    } else {

							    }
							}
						}
					}
				}
				else{
					$data[$key] = $value;
				}
				
			}
		}

		DB::table('data_dasar')->where('id' , 1)->update($data);
		return Redirect::to('pengaturan')->with('success', 'Berhasil mengubah data dasar rumah sakit');
	}

	public function license(){
		$check = DB::table('data_dasar')->where('id' , 1)->first();
		if( isset($check->id) && !empty($check->id) ){

		}
		else{
			$insert = DB::table('data_dasar')->insert(['id' => 1]);
			$check = DB::table('data_dasar')->where('id' , 1)->first();
		}

		return View::make('settings.license' , array( 'data' => $check ) );
	}

	public function saveLicense($id=""){
		$check = DB::table('data_dasar')->where('id' , 1)->first();

		$input = Input::all();
		$data = array();
		foreach($input as $key => $value){
			if( $key != 'tahun' && $key != 'submit' ){
				if($key == 'logo' ){

				}
				else{
					$data[$key] = $value;
				}
				
			}
		}

		DB::table('data_dasar')->where('id' , 1)->update($data);
		return Redirect::to('license')->with('success', 'Berhasil mengubah license');
	}


	public function bridging(){
		$check = DB::table('setting_bridging')->where('id' , 1)->first();
		if( isset($check->id) && !empty($check->id) ){

		}
		else{
			$insert = DB::table('setting_bridging')->insert(['id' => 1]);
			$check = DB::table('setting_bridging')->where('id' , 1)->first();
		}

		return View::make('settings.bridging' , array( 'data' => $check ) );
	}

	public function saveBridging($id=""){
		$check = DB::table('setting_bridging')->where('id' , 1)->first();

		$input = Input::all();
		$data = array();
		foreach($input as $key => $value){
			if( $key != 'tahun' && $key != 'submit' ){
				if($key == 'logo' ){

				}
				else{
					$data[$key] = $value;
				}
				
			}
		}

		DB::table('setting_bridging')->where('id' , 1)->update($data);
		return Redirect::to('pengaturan/bridging')->with('success', 'Berhasil mengubah Bridging');
	}

}
