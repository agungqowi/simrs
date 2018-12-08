<?php

class GudangReturController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Retur Barang';
	public $table 		= 'apo_retur';
	public $slug 		= 'gudang_retur';
	public $controller 	= 'GudangReturController';
	public $primary 	= 'id';
	public $disable_edit= true;

	public function getColumns(){
		$column = array();

		$column['tanggal_retur'] 	= 'Tanggal Retur';
		$column['nama_supplier'] 	= 'Nama Supplier';
		$column['kodobat'] 			= 'Kode Obat';
		$column['nama_obat'] 		= 'Nama Obat';
		$column['jumlah'] 			= 'Jumlah';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'tanggal_retur';
		$array['type'] 		= 'nowdate';
		$array['name'] 		= 'tanggal_retur';
		$array['label'] 	= 'Tanggal Retur';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'apo_supplier' , 'kodesupp' , 'namasupp');
		$array 	= array();
		$array['id'] 		= 'kodesupp';
		$array['type'] 		= 'select';
		$array['name'] 		= 'kodesupp';
		$array['label'] 	= 'Supplier';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'apo_obat' , 'kodobat' , 'namaobat');
		$array 	= array();
		$array['id'] 		= 'kodobat';
		$array['type'] 		= 'select';
		$array['name'] 		= 'kodobat';
		$array['label'] 	= 'Obat';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);


		$array 	= array();
		$array['id'] 		= 'jumlah';
		$array['type'] 		= 'number';
		$array['name'] 		= 'jumlah';
		$array['label'] 	= 'jumlah';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$forms 	= $this->form_add();
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
		}

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to( $this->slug.'/create' )
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$data['nama_supplier'] 	= $this->getSingleData('apo_supplier', array( 'kodesupp' => Input::get('kodesupp') ) , 'namasupp' );
			$data['nama_obat'] 	= $this->getSingleData('apo_obat', array( 'kodobat' => Input::get('kodobat') ) , 'namaobat' );


			$stok 	= $this->getSingleData('apo_obat', array( 'kodobat' => Input::get('kodobat') ) , 'stok' );

			$Stok 	= intval($stok);
			$jumlah = intval($data['jumlah']);
			//check stok
			if($stok >= $jumlah){
				$id = $this->inputDataBaru( $this->table , $data );
				$baru 	= $stok-$jumlah;
				$res = $this->updateDataBaru( 'apo_obat' , array('stok' => $baru) , array( 'kodobat' => Input::get('kodobat') ) );
				return Redirect::to($slug)->with('success', 'Berhasil menambahkan '.$this->title);
			}
			else{
				return Redirect::to($slug.'/create')->with('error', 'Gagal menambahkan '. $this->title.', stok tidak mencukupi untuk di retur. Stok barang '.$stok)
					->withInput();
			}

			
		}
	}

	public function destroy($id)
	{
		$count = 0;
		//Cek apakah sudah pernah ada transaksi jika iya, dokter tidak bisa dihapus
		if( isset( $this->table_trans) )
			$count = $this->getCountData( $this->table_trans , array( $this->field_trans => $id ) );

		if($count > 0){
			return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' tidak diizinkan untuk dihapus');
		}
		else{
			$single = $this->getSingleData( $this->table , array( $this->primary => $id ) );

			$data = array(  
						'tanggal_retur' => $single->tanggal_retur ,
						'kodesupp'		=> $single->kodesupp ,
						'nama_supplier' => $single->nama_supplier ,
						'kodobat' 		=> $single->kodobat ,
						'nama_obat' 	=> $single->nama_obat ,
						'jumlah' 		=> $single->jumlah ,
						'alasan' 		=> $single->alasan ,
						'retur_id' 		=> $single->id ,
			);

			$this->inputDataBaru( $this->table.'_hapus' , $data );

			$stok 	= $this->getSingleData( 'apo_obat', array( 'kodobat' => $single->kodobat ) , 'stok' );

			if( isset($stok) ){
				$Stok 	= intval($stok);
				$baru 	= $stok + $single->jumlah;
				$res = $this->updateDataBaru( 'apo_obat' , array('stok' => $baru) , array( 'kodobat' => $single->kodobat ) );
			}
			else{
				
			}

			$this->deleteSingleData( $this->table , array( $this->primary => $id ) );
			return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' berhasil dihapus');
		}
	}
}