<?php

class GController extends GAController {

	protected $menu_parent = '';
	protected $menu_current = '';
	public function __construct()
	{
		$this->beforeFilter('acl');
		if(Auth::check()) {
			$users = User::all();
			$user = Auth::user();
			$group = Group::find( $user->group_id );

			View::share('user', $user);
			View::share('users', $users);
			View::share('group', $group);
		}

		$dasar 	= DB::table('data_dasar')->first();
		$dasar->license 	= "0822".$dasar->license."7777";
		$license 	= substr(md5($dasar->license),0,16);
		$this->rs_title 	= $dasar->nama_rumah_sakit;
		View::share('menu_parent' , $this->menu_parent);	
		View::share('menu_current' , $this->menu_current);		
		View::share('rs_title' , $dasar->nama_rumah_sakit);		
		View::share('rs_logo' , $dasar->logo);	
		View::share('license' , $license);	
		View::share('nlicense' , $dasar->license_code);
		View::share('rs_title_license' , $this->rs_title.' Medical Center');
		$path = base_path();

		//$myfile = fopen($path."/alamat.txt", "r");
		//$alamat = fgets($myfile);
		//fclose($myfile);
		View::share('rs_alamat' , $dasar->alamat_lokasi_rs.', '.$dasar->kab_kota );
	}

}
