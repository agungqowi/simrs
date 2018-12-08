<?php

class GudangStokController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Data Obat';
	public $table 		= 'apo_obat';
	public $slug 		= 'gudang_stok';
	public $controller 	= 'GudangStokController';
	public $primary 	= 'kodobat';
	public $table_trans = 'tbdetailobat';
	public $field_trans = 'IdObat';

	public $leftjoin		= array(
								array( 'apo_jenisobat' , 'apo_jenisobat.id' ,'apo_obat.kodejenis' )
							);

	public $custom_action 	= array(
								array( 'target' => 'gudang_obat/supplier/{primary}', 'icon' => 'splashy-tag' , 
										'alt' => 'Supplier')
							);

	public $filter 			= array( 
										'kategori_obat' => 'apo_obat.kodejenis',
							);

	public function getColumns(){
		$column = array();

		$column['namaobat'] 		= 'Nama Obat';
		$column['komposisi'] 		= 'Komposisi';
		$column['satuan'] 			= 'Satuan';
		$column['namajenis'] 		= 'Jenis';
		$column['hargabeli'] 		= 'Harga Beli';
		$column['ppn'] 				= 'PPN';
		$column['stok'] 			= 'Stok';
		$column['stok_minimal'] 	= 'Stok Minimal';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'namaobat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'namaobat';
		$array['label'] 	= 'Nama Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'apo_jenisobat' , 'kodejenis' , 'namajenis');
		$array 	= array();
		$array['id'] 		= 'kodejenis';
		$array['type'] 		= 'select';
		$array['name'] 		= 'kodejenis';
		$array['label'] 	= 'Jenis Obat';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'satuan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'satuan';
		$array['label'] 	= 'Satuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'hargabeli';
		$array['type'] 		= 'number';
		$array['name'] 		= 'hargabeli';
		$array['label'] 	= 'Harga Beli';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'ppn';
		$array['type'] 		= 'number';
		$array['name'] 		= 'ppn';
		$array['label'] 	= 'PPN';
		$array['required'] 	= 'required';
		array_push($forms , $array);
		

		$array 	= array();
		$array['id'] 		= 'masa';
		$array['type'] 		= 'nowdate';
		$array['name'] 		= 'masa';
		$array['label'] 	= 'Expire';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'stok';
		$array['type'] 		= 'text';
		$array['name'] 		= 'stok';
		$array['label'] 	= 'Stok Awal';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'stok_minimal';
		$array['type'] 		= 'text';
		$array['name'] 		= 'stok_minimal';
		$array['label'] 	= 'Stok Minimal';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'aturan_pakai';
		$array['type'] 		= 'text';
		$array['name'] 		= 'aturan_pakai';
		$array['label'] 	= 'Aturan Pakai';
		array_push($forms , $array);


		return $forms;
	}

	public function form_edit(){
		$forms	= array();
		
		$array 	= array();
		$array['id'] 		= 'namaobat';
		$array['type'] 		= 'text';
		$array['name'] 		= 'namaobat';
		$array['label'] 	= 'Nama Obat';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'apo_jenisobat' , 'kodejenis' , 'namajenis');
		$array 	= array();
		$array['id'] 		= 'kodejenis';
		$array['type'] 		= 'select';
		$array['name'] 		= 'kodejenis';
		$array['label'] 	= 'Jenis Obat';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'satuan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'satuan';
		$array['label'] 	= 'Satuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'hargabeli';
		$array['type'] 		= 'number';
		$array['name'] 		= 'hargabeli';
		$array['label'] 	= 'Harga Beli';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'masa';
		$array['type'] 		= 'nowdate';
		$array['name'] 		= 'masa';
		$array['label'] 	= 'Expire';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'stok';
		$array['type'] 		= 'text';
		$array['name'] 		= 'stok';
		$array['label'] 	= 'Stok';
		$array['required'] 	= 'required';
		$array['disabled'] 	= 'disabled';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'stok_minimal';
		$array['type'] 		= 'text';
		$array['name'] 		= 'stok_minimal';
		$array['label'] 	= 'Stok Minimal';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$options 	= $this->getDropdownTable( 'apo_produsen' , 'id' , 'nama_produsen');
		$array['id'] 		= 'kode_produsen';
		$array['type'] 		= 'selectdb';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'kode_produsen';
		$array['label'] 	= 'Produsen';
		$array['options'] 	= $options;
		$array['forms'] 	= array( 'nama_produsen' => 'Nama Produsen' );
		$array['tables'] 	= array( 'apo_produsen' , 'id' , 'nama_produsen' );
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'aturan_pakai';
		$array['type'] 		= 'text';
		$array['name'] 		= 'aturan_pakai';
		$array['label'] 	= 'Aturan Pakai';
		array_push($forms , $array);

		return $forms;
	}

	public function update($id)
	{
		$forms 	= $this->form_edit();
		$rules	= array();
		$data 	= array();

		$slug 	= $this->slug;
		foreach( $forms as $fo ){
			if( isset($fo['required']) && $fo['required'] == 'required' ){
				$rules[ $fo['name'] ] = 'required';
			}

			$data[ $fo['name'] ] = Input::get( $fo['name'] );

			if( $fo['type'] == 'date' ){
				$dates 					= explode( '/' , Input::get( $fo['name'] ) );
				if( isset($dates) && count($dates) > 1 )
					$data[ $fo['name'] ]  	= $dates['2'].'-'.$dates[1].'-'.$dates[0];
			}
			else if( $fo['type'] == 'password' ){
				$v = Input::get( $fo['name'] );
				if( !empty($v) )
					$data[ $fo['name'] ] = Hash::make( Input::get( $fo['name'] ) );
				else
					unset( $data[$fo['name']] );
			}
			else if( $fo['type'] == 'multiple' ){
				$vs = Input::get( $fo['name'] );
				if( empty($vs) ){
					$vs = array();
				}
				$data[ $fo['name'] ] = json_encode( $vs );
			}
			else if( $fo['type'] == 'multiple_menu' ){
				$vs = Input::get( $fo['name'] );
				if( empty($vs) ){
					$vs = array();
				}
				$data[ $fo['name'] ] = json_encode( $vs );
			}
		}

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to( $this->slug.'/'.$id.'/edit' )
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$input = true;

			if( isset($this->unique) && count( $this->unique ) > 0 ){
				$ori_data 		= $this->getSingleData( $this->table , array( $this->primary => $id ) ,"" );
				$data_unique	= array();

				$flag_unique	= 0;

				foreach( $this->unique as $un ){
					$data_unique[ $un ] = Input::get( $un );
					if( $ori_data->$un != $data[ $un ] ){
						$flag_unique = 1;
					}
				}
				//die();
				if( $flag_unique == 1 ){
					$exist = $this->getSingleData( $this->table , $data_unique ,"" );
					if( $exist )
						$input = false;
				}
				
			}

			if( $input ){
				$res = $this->updateDataBaru( $this->table , $data , array( $this->primary => $id ) );
				if( $res ){
					$namaobat 	= Input::get('namaobat');
					$satuan 	= Input::get('satuan');
					$masa 		= Input::get('masa');

					$up2 	= DB::table('apo_detailobat')->where( 'kodobat' , $id )->
								update(
									array(
										'namaobat'	=> $namaobat 	,
										'satuan'	=> $satuan 		, 
										'masa'		=> $masa
									)
								);

					return Redirect::to($slug.'/'.$id.'/edit')->with('success', 'Berhasil mengubah '.$this->title);
				}
				else{
					return Redirect::to($slug.'/'.$id.'/edit')->with('error', 'Gagal mengubah '. $this->title)
					->withInput(); // send back the input (not the password) so that we can repopulate the form;
				}
			}
			else{
				return Redirect::to($slug.'/'.$id.'/edit')->with('error', 'Error Duplikasi data '. $this->title)
				->withInput(); // send back the input (not the password) so that we can repopulate the form;
			}
			
		}
	}
}