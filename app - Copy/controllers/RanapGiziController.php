<?php

class RanapGiziController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Form Permintaan Gizi';
	public $table 		= 'tbpasieninap';
	public $slug 		= 'gizi';
	public $controller 	= 'RanapGiziController';
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

	public function index($tanggal=""){
		
		$user = Auth::user();
		$group = Group::find( $user->group_id );
		$slug = $group->slug;
        $ruangan = $group->ruangan;

        if( isset($group->ruangan) && !empty($group->ruangan)){
			$ruangan = json_decode($group->ruangan);
			if( count($ruangan) > 0){
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')
					->whereIn('IdRuangan' , $ruangan);
			}
			else{
				$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')
				->where('tbpasien.id' , 0);
			}
			
		}
		else{
			$pasien = DB::table('tbpasieninap')->join('tbpasien', 'tbpasieninap.NoRM', '=', 'tbpasien.NoRM')
			->where('tbpasien.id' , 0);
		}

		$tanggal 		= Input::get('tanggal_gizi');
		$tanggal_pilih 	= $tanggal;
		if($tanggal == ""){
			$tanggal 		= date('Y-m-d');
			$tanggal_pilih	= date('d/m/Y');
		}
		else{
			$tgls 	= explode('/' , $tanggal);
			$tanggal 	= $tgls[2].'-'.$tgls[1].'-'.$tgls[0];
		}
		$pasien 	= $pasien->where('Tanggal','<=',$tanggal)->where('TanggalPulang','>=',$tanggal);
		$pasien 	= $pasien->get();

		return View::make('rawat_inap.gizi' , 
				array(
					'pasien' => $pasien , 
					'tanggal' => $tanggal ,
					'tanggal_pilih' => $tanggal_pilih));
	}

	public function getColumns(){
		$column = array();

		$column["tbpasien.NoRM"] 			= "No RM";
		$column["Nama"]				= 'Nama Pasien';
		$column['Ruangan']			= 'Ruangan';
		$column['tbpasieninap.Tanggal']		= 'Tgl Masuk';
		$column['Jam']				= 'Jam';
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

	public function orderGizi(){
		$id_inap	= Input::get('id');
		$tgl 		= Input::get('tanggal');
		$tgls 		= explode( '/' , $tgl );
		$pagi 		= Input::get('pagi');
		$siang 		= Input::get('siang');
		$sore 		= Input::get('sore');

		if( count($tgls) > 1 ){
			$tanggal 	= $tgls[2].'-'.$tgls[1].'-'.$tgls[0];

			$check 		= DB::table('pasien_makan')->where('IdInap' , $id_inap)->where('Tanggal',$tanggal)->first();

			$diet 		= DB::table('tbdiet')->get();
			$diets 		= array();
			foreach($diet as $d){
				$diets[$d->id] = $d->NamaDiet;
			}
			$diets[99]	= 'Belum order';

			$data 		= array();
			$data['PagiKode']	= $pagi;
			$data['PagiNama']	= $diets[$pagi];
			$data['SiangKode']	= $siang;
			$data['SiangNama']	= $diets[$siang];
			$data['SoreKode']	= $sore;
			$data['SoreNama']	= $diets[$sore];

			if( isset($check->id) && $check->id > 0 ){
				$update 	= DB::table('pasien_makan')->where('id' , $check->id)->update($data);
				$return 		= array('status' => 'success' , 'pesan' => 'Order gizi berhasil di update'  );
			}
			else{
				$data['Tanggal']	= $tanggal;
				$data['IdInap']		= $id_inap;

				$inap 			= DB::table('tbpasieninap')->where('IdInap' , $id_inap)->first();
				if( isset($inap->IdInap) ){
					$data['NoRM']	= $inap->NoRM;
					$data['Ruangan']= $inap->Ruangan;
					if( empty( $inap->Kelas ) ){
						$data['Kelas']	= "";
					}
					else{
						$data['Kelas']	= $inap->Kelas;
					}
					

					$pasien 	= DB::table('tbpasien')->where('NoRM' , $inap->NoRM)->first();
					if( isset($pasien->NoRM) ){
						$data['Nama']	= $pasien->Nama;
					}

				}

				$check_tanggal 	= DB::table('tbpasieninap')->where('Tanggal' ,'<=' ,$tanggal)
									->where('IdInap', $id_inap)
									->get();

				if( count($check_tanggal) > 0 ){
					$insert 		= DB::table('pasien_makan')->insert($data);
					$return 		= array('status' => 'success' , 'pesan' => 'Order gizi berhasil di tambah'  );
				}
				else{
					$return 		= array('status' => 'error' , 'pesan' => 'Order gizi tidak diizinkan ditanggal tersebut'  );
				}

				
			}
		}
		else{
			$return		= array( 'status' => 'error' , 'pesan' => 'Tanggal salah '.$tgl);
		}

		echo json_encode($return);
		die();
	}

	public function listGizi($id=0){
		if($id==0){
			echo 'false';
		}
		else{
			$pasien = DB::table('pasien_makan')->where('IdInap', '=', $id)->get();
			echo(json_encode($pasien));
		}
	}
}