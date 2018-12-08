<?php

class GiziController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Pasien di Ruangan';
	public $table 		= 'tbpasieninap';
	public $slug 		= 'gizi';
	public $controller 	= 'GiziController';
	public $primary 	= 'IdInap';

	//public $table_trans = 'tbpasien';
	//public $field_trans = 'GolSwasta';

	public $join 		= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasieninap.NoRM' )
						);

	public $leftjoin 	= array(
							array('tbdiet' , 'tbdiet.id' , 'tbpasieninap.IdDiet')
						);

	public $select 		= array( 	'tbpasien.*' , 'tbpasieninap.Ruangan' ,'tbpasieninap.Kelas' , 
									'tbpasieninap.CaraBayar' , 
									'tbpasieninap.IdInap' ,'tbpasieninap.Tanggal' ,
									'tbdiet.NamaDiet' ,
									'tbpasieninap.Jam' , 'tbpasieninap.StatusPulang'  );

	public $where 		= array(
								array('tbpasieninap.StatusPulang' ,'=' , '0')
						);

	public $custom_action 	= array(
								array( 'target' => 'gizi/rawat_inap/{primary}', 'icon' => 'splashy-calendar_month' , 
										'alt' => 'Proses')
								);
	
	public $disable_edit 	= true;
	public $disable_add 	= true;
	public $disable_delete 	= true;

	public function getColumns(){
		$column = array();

		$column["NoRM"] 			= "No RM";
		$column["Nama"]				= 'Nama Pasien';
		$column['Ruangan']			= 'Ruangan';
		$column['Kelas']			= 'Kelas';
		$column['NamaDiet'] 		= 'Nama Diet';

		return $column;
	}

	public function rawat_inap($id = 0){
		$data 	= DB::table('tbpasieninap')->where('IdInap' , $id)->first();
		if( isset($data->IdInap) ){
			return View::make('penunjang.diet' , 
					array(
						'data' 	=> $data 
					)
			);
		}
		else{
			return View::make('404');
		}
	}

	public function list_diet($id = 0){
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbdiet' , 'tbdiet.id' , '=' ,'tbpasieninap.IdDiet')
					->where('IdInap', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}

	public function tambah_diet(){
		$id_inap 	= Input::get('id_inap');
		$id_diet 	= Input::get('id_diet');

		if( $id_inap != '' && $id_diet != '' ){
			$update 	= DB::table('tbpasieninap')->where('IdInap' , $id_inap)->update(
				array( 'IdDiet' => $id_diet )
			);

			$return = array('status' => 'success' , 'pesan' => 'Data diet berhasil diupdate' );
		}
		else{
			$return = array('status' => 'fail' , 'pesan' => 'Data diet gagal diupdate' );
		}

		echo json_encode($return);
		die();
	}

	public function hapus_diet(){
		$id_inap 	= Input::get('id_inap');
		$id_diet 	= Input::get('id_diet');

		if( $id_inap != '' && $id_diet != '' ){
			$update 	= DB::table('tbpasieninap')->where('IdInap' , $id_inap)->update(
				array( 'IdDiet' => '0' )
			);

			$return = array('status' => 'success' , 'pesan' => 'Data diet berhasil dihapus' );
		}
		else{
			$return = array('status' => 'fail' , 'pesan' => 'Data diet gagal dihapus' );
		}
	}
}