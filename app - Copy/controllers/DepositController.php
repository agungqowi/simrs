<?php

class DepositController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Pembayaran';
	public $table 		= 'bill_deposit';
	public $slug 		= 'deposit';
	public $controller 	= 'DepositController';
	public $primary 	= 'id';

	public $custom_add 	= 'billing/dp';
	public $custom_edit	= 'billing/dp';

	public function getColumns(){
		$column = array();

		$column['no_reg'] 			= 'No Reg';
		$column['no_rm'] 			= 'No RM';
		$column['nama'] 			= 'Nama';
		$column['tanggal_deposit'] 	= array('type' =>'date' , 'title' => 'Tanggal Deposit');
		$column['jenis'] 			= 'Jenis Pembayaran';
		$column['metode_pembayaran']= 'Metode';
		$column['tanggal_input']	= array('type' => 'datetime' , 'title' => 'Tanggal Sistem');
		$column['jumlah'] 			= 'Jumlah';

		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'nama_rekanan';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_rekanan';
		$array['label'] 	= 'Nama Rekanan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Telp';
		$array['type'] 		= 'text';
		$array['name'] 		= 'telp';
		$array['label'] 	= 'Telp';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'alamat';
		$array['type'] 		= 'textarea';
		$array['name'] 		= 'alamat';
		$array['label'] 	= 'Alamat';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'email';
		$array['type'] 		= 'text';
		$array['name'] 		= 'email';
		$array['label'] 	= 'Email';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		return $this->form_add();
	}

	public function cetak($id=0){
		if($id != 0){
			$data 	= DB::table('bill_deposit')->where( 'id' , $id )->first();
			//var_dump($registrasi);
			if($data){
				return View::make('billing.down_payment_print' , 
					array(
						'data' => $data
					)
				);
			}
			else{
				echo 'Informasi pasien tidak ditemukan';
			}
		}		
	}
}