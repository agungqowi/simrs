<?php

class PendaftaranHarianController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Harian';
	public $table 		= 'tbpasienjalan';
	public $slug 		= 'pendaftaran_harian';
	public $controller 	= 'PendaftaranHarianController';
	public $primary 	= 'IdRegJalan';

	public $select 		= array( 	'tbpasien.*' , 'tbpasienjalan.Poli' ,'tbpasienjalan.Dokter' , 'tbpasienjalan.CaraBayar' , 
									'tbpasienjalan.IdRegJalan' , 'tbpasienjalan.NoRegJalan' ,'tbpasienjalan.Tanggal' ,
									'tbpasienjalan.jam_daftar' , 'tbpasienjalan.status as status_jalan'  );

	public $join 	= array(							 
								array( 'tbpasien' , 'tbpasien.NoRM' , 'tbpasienjalan.NoRM' )
						);

	public $custom_action 	= array(
								array( 'target' => 'pendaftaran_harian/register/{primary}', 'icon' => 'splashy-pencil' , 
										'alt' => 'Ubah Pendaftaran')
							);

	public $disable_add 	= true;
	public $disable_delete 	= false;
	public $disable_edit 	= true;

	public $filter 			= array( 
										'dari_tanggal' => 'tbpasienjalan.Tanggal',
										'sampai_tanggal' => 'tbpasienjalan.Tanggal' );

	public function getColumns(){
		$column = array();

		$column['NoRM'] 		= 'No RM';
		$column['Nama'] 		= 'Nama';
		$column['Jalan'] 		= 'KotaKab';
		$column['Tanggal'] 		= array( 'title' => 'Tanggal' , 'type' => 'date' );
		$column['jam_daftar'] 	= 'Jam';
		$column['Poli'] 		= 'Poli';
		$column['Dokter'] 		= 'Dokter';
		$column['CaraBayar'] 	= 'Cara Bayar';
		$column['status_jalan'] 		= array(
										'title' => 'Status' , 
										'type'	=> 'select' ,
										'value' => array('0'=>'Menunggu' ,'1' => 'Diperiksa','2' => 'Selesai')
								);

		return $column;
	}

	public function getSearchColumn(){
		$column = array('tbpasien.NoRM','Nama','Jalan');
		return $column;
	}

	public function destroy($id)
	{
		$detail = DB::table('tbpasienjalan')->where('IdRegJalan' , $id)->first();
		if( isset($detail->IdRegJalan) ){
			$tanggal 	= date('Y-m-d');
			if($detail->Tanggal == $tanggal && $detail->status == 0){
				DB::table('tbpasienjalan')->where('IdRegJalan' , $id)->delete();
				return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' berhasil dihapus');
			}
			else{
				return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' tidak diizinkan untuk dihapus');
			}
		}
		else{
			return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' tidak ditemukan');
		}
	}

	public function register($id=0)
	{
		$data 	= DB::table('tbpasienjalan')->join('tbpasien' , 'tbpasien.NoRM' ,'=' , 'tbpasienjalan.NoRM')->where('IdRegJalan' , $id)->first();

		$poli 	= Poli::orderBy('NamaPoli' , 'ASC')->get();
		$dokter = Dokter::orderBy('NamaDokter' , 'ASC')->get();

		if( isset($data->IdRegJalan) ){
			return View::make('rawat_jalan.pindah_poli' , array('data' => $data , 'dokter' => $dokter , 'poli' => $poli));
		}
	}

	public function editRegister($id = 0){
		$data 	= DB::table('tbpasienjalan')->join('tbpasien' , 'tbpasien.NoRM' ,'=' , 'tbpasienjalan.NoRM')->where('IdRegJalan' , $id)->first();
		$update	= 0;
		if( isset($data->IdRegJalan) ){
			$id_poli 	= Input::get('poli');
			$id_dokter 	= Input::get('dokter');

			$poli 		= DB::table('tbpoli')->where('IdPoli' ,$id_poli)->first();			
			$dokter 	= DB::table('tbdaftardokter')->where('IdDokter' ,$id_dokter)->first();
			$date 		= DateTime::createFromFormat('d/m/Y', Input::get('tanggal'));
			if( isset($poli->NamaPoli) && isset($dokter->NamaDokter) ){
				$update 	= DB::table('tbpasienjalan')->where('IdRegJalan' , $id)->update(
					array(
						'Tanggal'	=> $date->format('Y-m-d') ,
						'IdPoli'	=> $id_poli ,
						'Poli'		=> $poli->NamaPoli ,
						'IdDokter'	=> $id_dokter ,
						'Dokter'	=> $dokter->NamaDokter
					)
				);
			}
		}

		if($update){
			return Redirect::to('pendaftaran_harian/register/'.$id)->with('success', 'Data pendaftaran pasien berhasil diubah');
		}
		else{
			return Redirect::to('pendaftaran_harian/register/'.$id)
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		}
	}

	public function form_edit(){
		$forms	= array();

		$array 	= array();
		$array['id'] 		= 'NoRM';
		$array['type'] 		= 'text';
		$array['name'] 		= 'NoRM';
		$array['label'] 	= 'No RM';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Nama';
		$array['type'] 		= 'text';
		$array['name'] 		= 'Nama';
		$array['label'] 	= 'Nama';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'Tanggal';
		$array['type'] 		= 'nowdate';
		$array['name'] 		= 'Tanggal';
		$array['label'] 	= 'Tanggal';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbpoli' , 'IdPoli' , 'NamaPoli' , 
						array() , array('NamaPoli' , 'ASC'));
		$array 	= array();
		$array['id'] 		= 'IdPoli';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdPoli';
		$array['label'] 	= 'Poli';
		$array['required'] 	= 'required';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);

		$options_kategori 	= $this->getDropdownTable( 'tbdaftardokter' , 'IdDokter' , 'NamaDokter' , 
						array() , array('NamaDokter' , 'ASC'));
		$array 	= array();
		$array['id'] 		= 'IdDokter';
		$array['type'] 		= 'select';
		$array['name'] 		= 'IdDokter';
		$array['label'] 	= 'Dokter';
		$array['options'] 	= $options_kategori;
		array_push($forms , $array);
		return $forms;
	}
}