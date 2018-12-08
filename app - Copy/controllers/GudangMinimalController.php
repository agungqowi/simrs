<?php

class GudangMinimalController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Data Obat yang minimal';
	public $table 		= 'apo_obat';
	public $slug 		= 'gudang_minimal';
	public $controller 	= 'GudangMinimalController';
	public $primary 	= 'kodobat';
	public $table_trans = 'tbdetailobat';
	public $field_trans = 'IdObat';


	public $where 		= array( 
								 array( 'stok < stok_minimal' ,'raw' )
						);
	public $disable_add 	= true;
	public $disable_delete 	= true;
	public $disable_edit 	= true;
	public $disable_action 	= true;

	public function getColumns(){
		$column = array();

		$column['namaobat'] 		= 'Nama Obat';
		$column['komposisi'] 		= 'Komposisi';
		$column['satuan'] 			= 'Satuan';
		$column['stok'] 		 	= 'Stok Saat Ini';
		$column['stok_minimal']     = 'Stok Minimal';

		return $column;
	}

	public function edit($id)
	{
		// get the note
		$data 	= $this->getSingleData( 'apo_detailobat' , 	array( $this->primary => $id ) );
		$data2 	= $this->getSingleData( 'apo_obat' , 		array( 'kodobat' => $id ) );
		$primary= $this->primary;

		if( !isset($data->$primary) ){
			$datas = array(
						$this->primary => $id ,
						'harga_jual_umum' => 0 ,
						'harga_jual_asuransi' => 0 ,
						'harga_jual_pt' => 0 ,
						'harga_jual_bpjs' => 0
				);

			$data = (object) $datas;
		}

		$pembulatan 	= array(0,1,50,100);
		// show the edit form and pass the note
		if( isset($data->$primary) ){
			return View::make('apotek.general.daftar_obat' , 
				array(
					'data' 		=> $data,	
					'data2' 	=> $data2,	
					'pembulatan'=> $pembulatan,		
					'title'		=> $this->title,
					'slug'		=> $this->slug,
					'controller'=> $this->controller,
					'type'		=> 'edit',
					'form_span'	=> $this->form_span,
					'primary_id'=> $data->$primary,
					'disable_add' => $this->disable_add
				)
			);
		}
		else{
			return View::make('apotek.general.daftar_obat' , 
				array(	
					'data' 		=> $data,	
					'pembulatan'=> $pembulatan,		
					'title'		=> $this->title,
					'slug'		=> $this->slug,
					'controller'=> $this->controller,
					'type'		=> 'add',
					'form_span'	=> $this->form_span,
					'disable_add' => $this->disable_add
				)
			);
		}
		
	}

	public function form_edit(){
		$forms	= array();

		$options_kategori 	= $this->getDropdownTable( 'apo_obat' , 'kodobat' , 'namaobat');
		$array 	= array();
		$array['id'] 		= 'kodobat';
		$array['type'] 		= 'select';
		$array['name'] 		= 'kodobat';
		$array['label'] 	= 'Nama Obat';
		$array['required'] 	= 'required';
		$array['disabled'] 	= 'disabled';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'persentase_umum';
		$array['type'] 		= 'text';
		$array['name'] 		= 'persentase_umum';
		$array['label'] 	= 'Persentase Jual Umum';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'harga_jual_umum';
		$array['type'] 		= 'text';
		$array['name'] 		= 'harga_jual_umum';
		$array['label'] 	= 'Harga Jual Umum';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'harga_jual_asuransi';
		$array['type'] 		= 'text';
		$array['name'] 		= 'harga_jual_asuransi';
		$array['label'] 	= 'Harga Jual Asuransi';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'harga_jual_bpjs';
		$array['type'] 		= 'text';
		$array['name'] 		= 'harga_jual_bpjs';
		$array['label'] 	= 'Harga Jual BPJS';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'harga_jual_pt';
		$array['type'] 		= 'text';
		$array['name'] 		= 'harga_jual_pt';
		$array['label'] 	= 'Harga Jual PT';
		$array['required'] 	= 'required';
		array_push($forms , $array);
		return $forms;
	}

	public function update($id){
		$check = DB::table('apo_detailobat')->where('kodobat' , $id)->where('tempat' , 'apotek_askes')->first();

		$harga_jual_bpjs 	= Input::get('harga_jual_bpjs');
		$harga_jual_asuransi	= Input::get('harga_jual_asuransi');
		$harga_jual_umum 	= Input::get('harga_jual_umum');

		if( isset($check->id) ){
			DB::table('apo_detailobat')->where('id' , $check->id)->update(array(
				'harga_jual_umum' 	=> $harga_jual_umum , 
				'harga_jual_asuransi' => $harga_jual_asuransi ,
				'harga_jual_bpjs' 	=> $harga_jual_bpjs
			));
		}
		else{
			DB::table('apo_detailobat')->insert(array(
				'kodobat' 			=> $id , 
				'tempat' 			=> 'apotek_askes' , 
				'harga_jual_umum' 	=> $harga_jual_umum , 
				'harga_jual_asuransi' => $harga_jual_asuransi ,
				'harga_jual_bpjs' 	=> $harga_jual_bpjs
			));
		}
		return Redirect::to($this->slug)->with('success', 'Berhasil mengubah '.$this->title);
	}

	public function harga(){
		$harga 			= DB::table('apo_harga')->where('id', 1)->first();
		$pembulatan 	= array(0,1,50,100);
		return View::make('apotek.general.harga' , array( 'harga' => $harga , 'pembulatan' => $pembulatan ));
	}

	public function simpanHarga(){
		$array = array('hjp','hju' ,'hjb' , 'hja');
		$flag = 0;
		foreach($array as $a){
			$input = Input::get($a);
			if( $input >= 1 && $input <= 10 ){
				$harga[$a] = $input;
			}
			else{
				$flag++;
			}
		}

		if( $flag ){
			return Redirect::to('askes_obat/harga')->with('error', 'persentase harga yang diizinkan adalah 1 - 10');
		}
		else{
			
			$harga['pembulatan'] = Input::get('pembulatan');
			$update = DB::table('apo_harga')->where('id' , 1)->update(array(
				'hju' => Input::get('hju') ,
				'hjp' => Input::get('hjp') ,
				'hjb' => Input::get('hjb') ,
				'hja' => Input::get('hja') ,
				'pembulatan' => Input::get('pembulatan')
			));

			$obat = DB::table('apo_obat')->get();
			foreach ($obat as $key) {
				$id = $key->kodobat;
				$check = DB::table('apo_detailobat')->where('kodobat' , $id)->where('tempat' , 'apotek_askes')->first();

				$harga_jual_bpjs 	= $key->hargabeli * $harga['hjb'];
				$harga_jual_asuransi= $key->hargabeli * $harga['hja'];
				$harga_jual_umum 	= $key->hargabeli * $harga['hju'];
				$harga_jual_pt	 	= $key->hargabeli * $harga['hjp'];

				if($harga['pembulatan'] == 1){
					$harga_jual_bpjs 		= ceil( $harga_jual_bpjs );
					$harga_jual_asuransi 	= ceil( $harga_jual_asuransi );
					$harga_jual_umum 		= ceil( $harga_jual_umum );
					$harga_jual_pt 			= ceil( $harga_jual_pt );
				}
				else if($harga['pembulatan'] == 50){
					$harga_jual_bpjs 		= $this->ceiling( $harga_jual_bpjs ,50 );
					$harga_jual_asuransi 	= $this->ceiling( $harga_jual_asuransi ,50 );
					$harga_jual_umum 		= $this->ceiling( $harga_jual_umum ,50 );
					$harga_jual_pt 			= $this->ceiling( $harga_jual_pt ,50 );
				}
				else if($harga['pembulatan'] == 100){
					$harga_jual_bpjs 		= $this->ceiling( $harga_jual_bpjs ,100 );
					$harga_jual_asuransi 	= $this->ceiling( $harga_jual_asuransi ,100 );
					$harga_jual_umum 		= $this->ceiling( $harga_jual_umum ,100 );
					$harga_jual_pt 			= $this->ceiling( $harga_jual_pt ,100 );
				}

				if( isset($check->id) ){
					DB::table('apo_detailobat')->where('id' , $check->id)->update(array(
						'harga_jual_umum' 		=> $harga_jual_umum , 
						'harga_jual_asuransi' 	=> $harga_jual_asuransi ,
						'harga_jual_pt' 		=> $harga_jual_pt ,
						'harga_jual_bpjs' 		=> $harga_jual_bpjs ,
						'persentase_umum' 		=> Input::get('hju') , 
						'persentase_asuransi' 	=> Input::get('hja') ,
						'persentase_pt' 		=> Input::get('hjp') ,
						'persentase_bpjs' 		=> Input::get('hjb') ,
						'pembulatan_umum' 		=> Input::get('pembulatan') , 
						'pembulatan_asuransi' 	=> Input::get('pembulatan') ,
						'pembulatan_pt' 		=> Input::get('pembulatan') ,
						'pembulatan_bpjs' 		=> Input::get('pembulatan')

					));
				}
				else{
					DB::table('apo_detailobat')->insert(array(
						'kodobat' 				=> $id , 
						'tempat' 				=> 'apotek_askes' , 
						'harga_jual_umum' 		=> $harga_jual_umum , 
						'harga_jual_asuransi' 	=> $harga_jual_asuransi ,
						'harga_jual_pt' 		=> $harga_jual_pt ,
						'harga_jual_bpjs' 		=> $harga_jual_bpjs ,
						'persentase_umum' 		=> Input::get('hju') , 
						'persentase_asuransi' 	=> Input::get('hja') ,
						'persentase_pt' 		=> Input::get('hjp') ,
						'persentase_bpjs' 		=> Input::get('hjb') ,
						'pembulatan_umum' 		=> Input::get('pembulatan') , 
						'pembulatan_asuransi' 	=> Input::get('pembulatan') ,
						'pembulatan_pt' 		=> Input::get('pembulatan') ,
						'pembulatan_bpjs' 		=> Input::get('pembulatan')
					));
				}
			}

			return Redirect::to('askes_obat/harga')->with('success', 'Berhasil update persentase harga');
		}
	}

	function ceiling($number, $significance = 1)
    {
        return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
    }
}