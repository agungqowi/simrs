<?php

class InformasiController extends \BaseController {

	public function tt(){
		$ruangan = DB::table('tbruangan')->leftJoin('tbkelasruangan','tbkelasruangan.IdKelas','=','tbruangan.IdKelas')->get();
		return View::make( 'informasi.tt' , array('ruangan' => $ruangan) );
	}
}