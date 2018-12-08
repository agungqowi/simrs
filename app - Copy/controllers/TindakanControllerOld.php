<?php

class TindakanControllerOld extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('tindakan.list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tindakan.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'jenis_tindakan'    => 'required|min:3', 
			'kelompok'    => 'required', 
			'tarif'    => 'required', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('tindakan/create')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$t = DB::table('tbtindakan')->orderBy('IdTindak', 'desc')->first();
			$ar = substr($t->IdTindak,4);
			$ari = intval($ar);
			$ari++;
			$jeda = 6-strlen($ari);
			$IdTindak = $ari;
			if($jeda > 0){
				for($i=0;$i<$jeda;$i++){
					$IdTindak = "0".$IdTindak;
				}
			}
			$tindakan = new Tindakan;
			$tindakan->IdTindakan = "TIND".$IdTindak;
			$tindakan->Tindakan = Input::get('jenis_tindakan');
			$tindakan->Tarif = Input::get('tarif');
			$tindakan->Kel = Input::get('kelompok');
			$tindakan->Gol = Input::get('golongan');
			$tindakan->save();

			return Redirect::to('tindakan')->with('success', 'Data Tindakan berhasil ditambahkan');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tindakan = DB::table('tbtindakan')->where('IdTindak', $id)->first();
		return View::make('tindakan.edit' , array( 'tindakan' => $tindakan ));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'jenis_tindakan'    => 'required|min:3', 
			'kelompok'    => 'required', 
			'tarif'    => 'required', 
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('tindakan/'.$id.'/edit')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$tindakan = array();
			$tindakan['Tindakan'] = Input::get('jenis_tindakan');
			$tindakan['Tarif'] = Input::get('tarif');
			$tindakan['Kel'] = Input::get('kelompok');
			$tindakan['Gol'] = Input::get('golongan');

			Tindakan::where('IdTindak', '=', $id)->update($tindakan);

			return Redirect::to('tindakan')->with('success', 'Data Tindakan berhasil diubah');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//Cek apakah sudah pernah ada transaksi jika iya, dokter tidak bisa dihapus
		$t1 = DB::table('tbdetailtindakan')->where('IdTindak' , '=' , $id)->count();
		if($t1 > 0){
			return Redirect::to('tindakan')->with('success', 'Data Tindakan tidak diizinkan untuk dihapus');
		}
		else{
			DB::table('tbtindakan')->where('IdTindak' , '=' , $id)->delete();
			return Redirect::to('tindakan')->with('success', 'Data Tindakan berhasil dihapus');
		}
	}

	/**
	 * @param void
	 * @return array
	 */
	public function datatable()
	{
		$tindakan = DB::table('tbtindakan');
		return Datatable::query($tindakan)
			->addColumn('IdTindak',function($model)
        	{
            	return '<a href="#">'.$model->IdTindak.'</a>';
        	})
			->showColumns('Tindakan','Gol','Kel','Tarif','Adm','Fas')
			->addColumn('Action',function($model)
        	{
            	return '<a href="'.url('tindakan/'.$model->IdTindak.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->IdTindak."','Tindakan'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('Tindakan','Gol','Kel')
			->orderColumns('Tindakan','Gol','Kel')->make();
	}

	/**
	 * @param void
	 * @return array
	 */
	public function simpletable()
	{	
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		//echo $slug;
		if (strpos($slug,'poli_') !== false) {
            $id = str_replace("poli_", "", $slug);
            $dokter = DB::table('tbtindakan')->where('Gol','LIKE','%'.$id.'%');
        }
        else if (strpos($slug,'ruangan_') !== false) {
           	$id = str_replace("ruangan_", "", $slug);
           	if( $id == 'tulip I' || $id == 'icu' ){
           		$dokter = DB::table('tbtindakan')->where('Gol','LIKE',$id);
           	}
           	else{
           		$dokter = DB::table('tbtindakan')->where('Gol','LIKE','%'.$id.'%');
           	}
           	
        }
        else{
        	$id = 'all';
        	$dokter = DB::table('tbtindakan');
        }
		
		return Datatable::query($dokter)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."'".')" href="javascript:void(0)">Tambah</a>';
        	})
        	->addColumn('IdTindak',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->IdTindak.'</a>';
        	})
        	->addColumn('Tindakan',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->Tindakan.'</a>';
        	})
        	->addColumn('Gol',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->Gol.'</a>';
        	})
        	->addColumn('Kel',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->Kel.'</a>';
        	})
			->searchColumns('Tindakan','Gol','Kel')
			->orderColumns('Tindakan','Gol','Kel')->make();
	}


	/**
	 * @param void
	 * @return array
	 */
	public function penunjangtable($id="")
	{	
		$dokter = DB::table('tbtindakan')->where('Gol',$id);
		
		return Datatable::query($dokter)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."','".$model->Gol."'".')" href="javascript:void(0)">Tambah</a>';
        	})
        	->addColumn('IdTindak',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."','".$model->Gol."'".')" href="javascript:void(0)">'.$model->IdTindak.'</a>';
        	})
        	->addColumn('Tindakan',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."','".$model->Gol."'".')" href="javascript:void(0)">'.$model->Tindakan.'</a>';
        	})
        	->addColumn('Gol',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."','".$model->Gol."'".')" href="javascript:void(0)">'.$model->Gol.'</a>';
        	})
        	->addColumn('Kel',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindak."','".$model->Tindakan."','".$model->Gol."'".')" href="javascript:void(0)">'.$model->Kel.'</a>';
        	})
			->searchColumns('Tindakan','Gol','Kel')
			->orderColumns('Tindakan','Gol','Kel')->make();
	}



}
