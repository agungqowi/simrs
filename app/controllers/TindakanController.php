<?php

class TindakanController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Tarif tindakan dan Jasa Pelayanan';
	public $table 		= 'tbtindakan';
	public $slug 		= 'tindakan';
	public $controller 	= 'TindakanController';
	public $primary 	= 'IdTindakan';
	public $unique 		= array( );
	public $table_trans = 'tbdetailtindakan';
	public $field_trans = 'IdTindakan';

	public $join		= array( 
								array( 'tbkategoritindakan' ,'tbkategoritindakan.id' , 'tbtindakan.IdKategoriTindakan' ) 
						);
	public $leftjoin 	= array(							
								array( 'tbkelasruangan' , 'tbkelasruangan.IdKelas' , 'tbtindakan.IdKelas' ) , 
								array( 'tbtindakanjenis' , 'tbtindakanjenis.id' , 'tbkategoritindakan.id_jenis' ) , 

						);
	public $filter 			= array( 
										'kategori_tindakan' => 'tbtindakan.IdKategoriTindakan',
										'jenis_tindakan' => 'tbkategoritindakan.id_jenis'
							);

	public function getColumns(){
		$column = array();

		$column['IdTindakan'] 	= 'id';
		$column['Tindakan'] 	= 'Nama Pelayanan';
		$column['nama'] 		= 'Kategori';
		$column['nama_jenis'] 	= 'Jenis Rawat';
		$column['NamaKelas'] 	= 'Kelas';
		$column['Keterangan'] 	= 'Keterangan';
		$column['Tarif'] 		= 'Tarif';

		return $column;
	}

	public function getBulkColumns(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'Tindakan';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'Tindakan';
		$array['label'] 	= 'Nama Tindakan / Jasa Pelayanan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbkategoritindakan' , 'id' , 'nama');
		$array 	= array();
		$array['id'] 		= 'IdKategoriTindakan';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdKategoriTindakan';
		$array['label'] 	= 'Kategori Pelayanan';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbkelasruangan' , 'IdKelas' , 'NamaKelas');
		$array 	= array();
		$array['id'] 		= 'IdKelas';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdKelas';
		$array['label'] 	= 'Kelas';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Kel';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Kel';
		$array['label'] 	= 'Kelompok';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Tarif';
		$array['type'] 		= 'number';
		$array['name'] 		= 'Tarif';
		$array['label'] 	= 'Tarif';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'TarifBPJS';
		$array['type'] 		= 'number';
		$array['name'] 		= 'TarifBPJS';
		$array['label'] 	= 'Tarif BPJS';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'SaranaPrasarana';
		$array['type'] 		= 'number';
		$array['name'] 		= 'SaranaPrasarana';
		$array['label'] 	= 'Jasa Sarana';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Adm';
		$array['type'] 		= 'number';
		$array['name'] 		= 'Adm';
		$array['label'] 	= 'Manajemen';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'M';
		$array['type'] 		= 'number';
		$array['name'] 		= 'M';
		$array['label'] 	= 'dr Umum';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'RM';
		$array['type'] 		= 'number';
		$array['name'] 		= 'RM';
		$array['label'] 	= 'dr Spesialis';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'PM';
		$array['type'] 		= 'number';
		$array['name'] 		= 'PM';
		$array['label'] 	= 'Paramedis';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'AhliGizi';
		$array['type'] 		= 'number';
		$array['name'] 		= 'AhliGizi';
		$array['label'] 	= 'Ahli Gizi';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Instrumen';
		$array['type'] 		= 'number';
		$array['name'] 		= 'Instrumen';
		$array['label'] 	= 'BHP';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Haralkes';
		$array['type'] 		= 'number';
		$array['name'] 		= 'Haralkes';
		$array['label'] 	= 'Teknis';
		array_push($forms , $array);


		return $forms;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'Tindakan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Tindakan';
		$array['label'] 	= 'Nama Pelayanan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbkategoritindakan' , 'id' , 'nama' , 
						array() , array('nama' , 'ASC'));
		$array 	= array();
		$array['id'] 		= 'IdKategoriTindakan';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdKategoriTindakan';
		$array['label'] 	= 'Kategori Pelayanan';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbkelasruangan' , 'IdKelas' , 'NamaKelas');
		$array 	= array();
		$array['id'] 		= 'IdKelas';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdKelas';
		$array['label'] 	= 'Kelas';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Kel';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Kel';
		$array['label'] 	= 'Kelompok';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Satuan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Satuan';
		$array['label'] 	= 'Satuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Keterangan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Keterangan';
		$array['label'] 	= 'Keterangan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Tarif';
		$array['type'] 		= 'number';
		$array['name'] 		= 'Tarif';
		$array['label'] 	= 'Tarif';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'TarifBPJS';
		$array['type'] 		= 'number';
		$array['name'] 		= 'TarifBPJS';
		$array['label'] 	= 'Tarif BPJS';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'Otomatis';
		$array['type'] 		= 'select';
		$array['name'] 		= 'Otomatis';
		$array['label'] 	= 'Otomatis Poli Umum';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisSpesialis';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisSpesialis';
		$array['label'] 	= 'Otomatis Poli Spesialis';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisIGD';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisIGD';
		$array['label'] 	= 'Otomatis IGD';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisPenunjang';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisPenunjang';
		$array['label'] 	= 'Otomatis Penunjang';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisRI4';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisRI4';
		$array['label'] 	= 'Otomatis RI Kelas VIP';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisRI';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisRI';
		$array['label'] 	= 'Otomatis RI Kelas 1';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisRI2';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisRI2';
		$array['label'] 	= 'Otomatis RI Kelas 2';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisRI3';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisRI3';
		$array['label'] 	= 'Otomatis RI Kelas 3';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);


		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisVK';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisVK';
		$array['label'] 	= 'Otomatis VK';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisBPJS';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisBPJS';
		$array['label'] 	= 'Otomatis BPJS';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);


		$options_otomatis 	= array( 0 => 'Manual' , '1' => 'Otomatis' );
		$array 	= array();
		$array['id'] 		= 'OtomatisUmum';
		$array['type'] 		= 'select';
		$array['name'] 		= 'OtomatisUmum';
		$array['label'] 	= 'Otomatis Umum';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);


		$options_otomatis 	= array( 0 => 'Semua pasien' , '1' => 'Pasien Baru' ,'2' => 'Pasien Lama' );
		$array 	= array();
		$array['id'] 		= 'JenisPasien';
		$array['type'] 		= 'select';
		$array['name'] 		= 'JenisPasien';
		$array['label'] 	= 'Jenis Pasien (jika otomatis)';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_otomatis 	= array( 'F' => 'Flat' , 'P' => 'Parent' ,'C' => 'Child' );
		$array 	= array();
		$array['id'] 		= 'TipeTindakan';
		$array['type'] 		= 'select';
		$array['name'] 		= 'TipeTindakan';
		$array['label'] 	= 'Tipe Tarif';
		$array['options'] 	= $options_otomatis;
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbtindakan' , 'IdTindakan' , 'Tindakan' , 
				array( array('TipeTindakan' , '=' ,'P' ) ) );
		$array 	= array();
		$array['id'] 		= 'IdParent';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdParent';
		$array['label'] 	= 'Parent';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
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
		$slug = "";
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
		$dokter = DB::table('tbtindakan');
		if( isset($this->join) && count($this->join) > 0 ){
			foreach( $this->join as $join ){
				$dokter->join( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($this->leftjoin) && count($this->leftjoin) > 0 ){
			foreach( $this->leftjoin as $join ){
				$dokter->leftJoin( $join[0], $join[1], '=', $join[2] );
			}
		}

		return Datatable::query($dokter)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."'".')" href="javascript:void(0)">Pilih</a>';
        	})
        	->addColumn('IdTindak',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->IdTindakan.'</a>';
        	})
        	->addColumn('Tindakan',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->Tindakan.'</a>';
        	})
        	->addColumn('Gol',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->nama.'</a>';
        	})
        	->addColumn('Kel',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."'".')" href="javascript:void(0)">'.$model->NamaKelas.'</a>';
        	})
        	->addColumn('Tarif',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."'".')" href="javascript:void(0)">'.number_format( $model->Tarif ).'</a>';
        	})
			->searchColumns('Tindakan','nama','Kel')
			->orderColumns('Tindakan','nama','Kel')->make();
	}


	/**
	 * @param void
	 * @return array
	 */
	public function penunjangtable($id="")
	{	

		$dokter = DB::table('tbtindakan');
		if( isset($this->join) && count($this->join) > 0 ){
			foreach( $this->join as $join ){
				$dokter->join( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($this->leftjoin) && count($this->leftjoin) > 0 ){
			foreach( $this->leftjoin as $join ){
				$dokter->leftJoin( $join[0], $join[1], '=', $join[2] );
			}
		}

		
		if($id != ""){
			$jenis = DB::table('tbtindakanjenis')->where('kode_jenis' ,$id)->first();

			if( isset($jenis->id) && !empty($jenis->id) ){
				$kategori = DB::table('tbkategoritindakan')->where('id_jenis' , $jenis->id)->get();

				if( isset($kategori) && count($kategori) > 0 ){
					$ij = 0;
					foreach($kategori as $k){
						if($ij == 0){
							$dokter->where('IdKategoriTindakan' , $k->id);
						}
						else{
							$dokter->orWhere('IdKategoriTindakan' , $k->id);
						}

						$ij++;
					}
				}
			}
		}
		
		
		return Datatable::query($dokter)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">Tambah</a>';
        	})
        	->addColumn('IdTindak',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->IdTindakan.'</a>';
        	})
        	->addColumn('Tindakan',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->Tindakan.'</a>';
        	})
        	->addColumn('nama',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->nama.'</a>';
        	})
        	->addColumn('NamaKelas',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->NamaKelas.'</a>';
        	})
        	->addColumn('Tarif',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->Tarif.'</a>';
        	})
			->searchColumns('Tindakan','nama')
			->orderColumns('Tindakan','nama')->make();
	}

	public function penunjangbpjs($id="")
	{	

		$dokter = DB::table('tbtindakan');
		if( isset($this->join) && count($this->join) > 0 ){
			foreach( $this->join as $join ){
				$dokter->join( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($this->leftjoin) && count($this->leftjoin) > 0 ){
			foreach( $this->leftjoin as $join ){
				$dokter->leftJoin( $join[0], $join[1], '=', $join[2] );
			}
		}

		
		if($id != ""){
			$jenis = DB::table('tbtindakanjenis')->where('kode_jenis' ,$id)->first();

			if( isset($jenis->id) && !empty($jenis->id) ){
				$kategori = DB::table('tbkategoritindakan')->where('id_jenis' , $jenis->id)->get();

				if( isset($kategori) && count($kategori) > 0 ){
					$ij = 0;
					foreach($kategori as $k){
						if($ij == 0){
							$dokter->where('IdKategoriTindakan' , $k->id);
						}
						else{
							$dokter->orWhere('IdKategoriTindakan' , $k->id);
						}

						$ij++;
					}
				}
			}
		}
		
		
		return Datatable::query($dokter)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">Tambah</a>';
        	})
        	->addColumn('IdTindak',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->IdTindakan.'</a>';
        	})
        	->addColumn('Tindakan',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->Tindakan.'</a>';
        	})
        	->addColumn('nama',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->nama.'</a>';
        	})
        	->addColumn('NamaKelas',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->NamaKelas.'</a>';
        	})
        	->addColumn('Tarif',function($model)
        	{
            	return '<a onclick="pilih_tindakan('."'".$model->IdTindakan."','".$model->Tindakan."','".$model->nama."'".')" href="javascript:void(0)">'.$model->TarifBPJS.'</a>';
        	})
			->searchColumns('Tindakan','nama')
			->orderColumns('Tindakan','nama')->make();
	}

	public function inputBulk(){
		$id = 0;
		if( isset($_GET['categories']) && !empty($_GET['categories']))
			$id = $_GET['categories'];

		$j = 0;
		if( isset($_GET['jenis']) && !empty($_GET['jenis']))
			$j = $_GET['jenis'];

		if($id != 0 && $j != 0){
			$check = DB::table('tbkategoritindakan')->where('id' , $id)->first();
			if( isset($check->id_jenis) ){
				if($check->id_jenis == $j){
					
				}
				else{
					$id = 0;
				}
			}
			else{
				$id = 0;
			}
		}

		if( $id  == 0 ){
			if($j ==0){
				$data 		= $this->getTableData( $this->table , array() , array() , array('TIndakan' => 'ASC') );
			}
			else{
				$data 	= DB::table($this->table)->join('tbkategoritindakan',$this->table.'.IdKategoriTindakan' , '=' ,'tbkategoritindakan.id')
							->where('tbkategoritindakan.id_jenis','=',$j)->orderBy('TIndakan','ASC')->get();
			}
			
		}
		else{
			$data 		= $this->getTableData( $this->table , array() , array( 'IdKategoriTindakan' => $id ) , array('TIndakan' => 'ASC') );
		}
		
		$column 	= $this->getBulkColumns();
		$jenis 		= $this->getDropdownTable( 'tbtindakanjenis' , 'id' , 'nama_jenis');

		if($j == 0){
			$categories = $this->getDropdownTable( 'tbkategoritindakan' , 'id' , 'nama');
		}
		else{
			$categories = $this->getDropdownTable( 'tbkategoritindakan' , 'id' , 'nama' , 
				array(
					array( 'id_jenis' ,'=' , $j )
				)
			);
		}
		
		return View::make('crud.bulk_create', 
			array(
				'categories' 	=> $categories,
				'data' 			=> $data , 
				'column' 		=> $column ,
				'primary' 		=> $this->primary,
				'title'			=> $this->title,
				'slug'			=> $this->slug,
				'controller'	=> $this->controller,
				'category'		=> $id,
				'j'				=> $j,
				'jenis'			=> $jenis
			)
		);
	}

	public function rajalTable()
	{	
		$user = Auth::user();
		$group = DB::table('groups')->where('id',$user->group_id)->first();
		$slug = $group->slug;
		//echo $slug;
		$slug = "";
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
		$dokter = DB::table('tbtindakan');
		if( isset($this->join) && count($this->join) > 0 ){
			foreach( $this->join as $join ){
				$dokter->join( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($this->leftjoin) && count($this->leftjoin) > 0 ){
			foreach( $this->leftjoin as $join ){
				$dokter->leftJoin( $join[0], $join[1], '=', $join[2] );
			}
		}

		return Datatable::query($dokter)
			->addColumn('Pilih',function($model)
        	{
            	return '<a class="btn" onclick="pilih_tindakan('.
						"'".$model->IdTindakan."',".
						"'".$model->Tindakan."',".
						"'".$model->Satuan."',".
						"'".$model->Tarif."'".
				')" href="javascript:void(0)">Pilih</a>';
        	})
        	->addColumn('IdTindak',function($model)
        	{
            	return '<a onclick="pilih_tindakan('.
						"'".$model->IdTindakan."',".
						"'".$model->Tindakan."',".
						"'".$model->Satuan."',".
						"'".$model->Tarif."'".
				')" href="javascript:void(0)">'.$model->IdTindakan.'</a>';
        	})
        	->addColumn('Tindakan',function($model)
        	{
            	return '<a onclick="pilih_tindakan('.
						"'".$model->IdTindakan."',".
						"'".$model->Tindakan."',".
						"'".$model->Satuan."',".
						"'".$model->Tarif."'".
				')" href="javascript:void(0)">'.$model->Tindakan.'</a>';
        	})
        	->addColumn('Satuan',function($model)
        	{
            	return '<a onclick="pilih_tindakan('.
						"'".$model->IdTindakan."',".
						"'".$model->Tindakan."',".
						"'".$model->Satuan."',".
						"'".$model->Tarif."'".
				')" href="javascript:void(0)">'.$model->Satuan.'</a>';
        	})
        	->addColumn('Gol',function($model)
        	{
            	return '<a onclick="pilih_tindakan('.
						"'".$model->IdTindakan."',".
						"'".$model->Tindakan."',".
						"'".$model->Satuan."',".
						"'".$model->Tarif."'".
				')" href="javascript:void(0)">'.$model->nama.'</a>';
        	})
        	->addColumn('Kel',function($model)
        	{
            	return '<a onclick="pilih_tindakan('.
						"'".$model->IdTindakan."',".
						"'".$model->Tindakan."',".
						"'".$model->Satuan."',".
						"'".$model->Tarif."'".
				')" href="javascript:void(0)">'.$model->NamaKelas.'</a>';
        	})
        	->addColumn('Tarif',function($model)
        	{
            	return '<a onclick="pilih_tindakan('.
						"'".$model->IdTindakan."',".
						"'".$model->Tindakan."',".
						"'".$model->Satuan."',".
						"'".$model->Tarif."'".
				')" href="javascript:void(0)">'.number_format( $model->Tarif ).'</a>';
        	})
			->searchColumns('Tindakan','nama','Kel')
			->orderColumns('Tindakan','nama','Kel')->make();
	}

}