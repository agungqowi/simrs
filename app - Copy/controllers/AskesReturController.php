<?php

class AskesReturController extends \BaseController {

	public $pref = "as";
	public $title = 'Askes';
	public $slug = 'askes';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($pref='askes')
	{
		$this->pref = "apo_";
		$jenis_obat = DB::table($this->pref.'jenisobat')->get();
		return View::make('apotek.general.retur' , array(
			'jenis_obat' => $jenis_obat , 
			'pref' => $this->pref,
			'title' => $this->title,
			'slug' => $this->slug
		));
	}

	public function setPref($pref)
	{
		if($pref == 'dinas'){
			$this->pref = 'di';
			$this->title = 'Dinas';
			$this->slug = 'dinas';
		}
		else if($pref == 'swasta'){
			$this->pref = 'sw';
			$this->title = 'Swasta';
			$this->slug = 'swasta';
		}
        else if($pref == 'ok'){
            $this->pref = 'ok';
            $this->title = 'OK';
            $this->slug = 'ok';
        }
		else{
			$this->pref = 'as';
			$this->title = 'Askes';
			$this->slug = 'askes';
		}
	}


	/**
	 * @param void
	 * @return array
	 */
	public function datatable($pref='askes')
	{
		$this->setPref($pref);
		$perawat = DB::table($this->pref.'transaksi')->join('tbmasukrs', $this->pref.'transaksi.noreg', '=', 'tbmasukrs.NoReg')->join();
		return Datatable::query($perawat)
			->addColumn('kodobat',function($model)
        	{
            	return '<a href="'.url('askes_obat/'.$model->kodobat.'/edit').'">'.$model->kodobat.'</a>';
        	})
			->showColumns('namaobat','komposisi','satuan','namajenis' , 'stok','harga')
			->addColumn('actions',function($model)
        	{
            	return '<a href="'.url('askes_obat/'.$model->kodobat.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
            	'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->kodobat."','Obat askes'".')"><i class="splashy-gem_remove"></i></a>';
        	})
			->searchColumns('kodobat','namaobat','namajenis','stok')
			->orderColumns('kodobat','namaobat','namajenis','stok')->make();
	}

	public function check_pasien($id)
	{
		$check = DB::table('tbmasukrs')->join('tbpasien','tbmasukrs.NoRM','=','tbpasien.NoRM')->where('tbmasukrs.NoRM' , '=' , $id)->orderBy('tbmasukrs.NoReg','desc')->first();
		if($check){
			$no_reg = $check->NoReg;
			$check_exist = DB::table('tbkeluar')->where('NoReg' , '=' , $no_reg)->first();
			if($check_exist){
				echo 'false';
			}
			else{
				echo(json_encode($check));
			}
		}
		else{
			echo 'false';
		}
		
	}

	public function tambah_transaksi($pref='askes')
	{
		$this->pref = "apo_";
		$id_obat = Input::get('kode_obat');

		if($id_obat == 'NEW'){
			$rules = array(
				'jumlah'    => 'required|min:1', 
				'kode_obat'    => 'required|min:1',
			);
		}
		else{
			$rules = array(				
				'jumlah'    => 'required|min:1', 
				'kode_obat'    => 'required|min:1',
			);
		}
		

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$messages = $validator->messages();
			foreach ($messages->all() as $message) 
			{
				echo $message;
			}
			
		} else {
			$jumlah = intval(Input::get('jumlah'));
			if($jumlah > 0 || $id_obat == 'NEW'){

				$tipe = Input::get('tipe');
				$date = DateTime::createFromFormat('d/m/Y', Input::get('masa'));
				if(!empty($date))
					$masa = $date->format('Y-m-d');
				else
					$masa = date('Y-m-d');

				$tgl_masuk 		= DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));

				$old_obat 		= DB::table('apo_obat')->where('kodobat', $id_obat )->first();
				$detail_obat 	= DB::table('apo_detailobat')->where('kodobat', $id_obat )->first();

				if( empty($old_obat) )
					die('Terjadi kesalahan');

				if( $jumlah > $detail_obat->stok )
					die('Stok tidak mencukupi');

				if($tipe == 'edit'){
					$no = Input::get('id_transaksi');

					$select = DB::table('apo_distribusi')->where('id' , '=' , $no)->get();
					$j = 0;
					foreach($select as $s){
						$obat = DB::table('apo_obat')->where('kodobat', $s->kodobat )->first();
						if( isset($obat->stok) ){
							$new_stok = intval( $obat->stok ) - intval( $s->jumlah ) + intval( $jumlah );
							$k=DB::table('apo_obat')->where('kodobat', $s->kodobat )->update(
								array(
									'stok' => $new_stok
								)
							);
						}

						$obat2 = DB::table('apo_detailobat')->where('kodobat', $s->kodobat )->where('tempat','apotek_askes')->first();
						if( isset($obat2->stok) ){
							$new_stok = intval( $obat2->stok ) + intval( $s->jumlah ) - intval($jumlah);
							$k=DB::table('apo_detailobat')->where('id', $obat2->id )->update(
								array(
									'stok' => $new_stok
								)
							);
						}
						
						$j++;
					}
					DB::table('apo_distribusi')->where('id' , $no)
						-> update(
							array(	
									'jumlah'  => $jumlah
							)
						);

					echo 'sukses';
				}
				else{

					if( isset($old_obat->kodobat) ){
						$old_stok = $old_obat->stok;
						$new_stok = $old_obat->stok + $jumlah;
						$obat = DB::table('apo_obat')->where('kodobat', $id_obat )->update(
							array(
								'stok' => $new_stok
							)
						);

						$nama_obat = $old_obat->namaobat;
					}
					else{
						die( 'error' );
					}

					$tgl_masuk = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));

					$check_detail = DB::table('apo_detailobat')->where('kodobat' , $id_obat)->where('tempat' , 'apotek_askes')->first();

					if( isset($check_detail) && !empty($check_detail->id)){
						$d_stok 	= intval($check_detail->stok) - $jumlah;
						$update_d 	= DB::table( 'apo_detailobat' )->where( 'id' , $check_detail->id )->update(
								array(
										'stok' => $d_stok
								)
							);

						DB::table('apo_distribusi')->insert(
							array(	'kodobat' => $id_obat , 'dari' => 'apotek_askes' , 'ke' => 'gudang' ,
									'jumlah'  => $jumlah,
									'tanggal' => $tgl_masuk->format('Y-m-d') , 'keterangan' => 'retur' , 
									'created_at' => date('Y-m-d H:i:s'))
						);
					}
					else{

					}
					

					
					echo 'sukses';
				}

				
			}
			else{
				echo 'Jumlah Pembelian yang dimasukkan salah';
			}
			
		}
	}

	public function list_transaksi($pref="askes")
	{
		$tanggal = $_REQUEST['tanggal_masuk'];
		$date = DateTime::createFromFormat('d/m/Y', Input::get('tanggal_masuk'));
		if( !empty($date) )
			$tanggal = $date->format('Y-m-d');
		$this->pref = "apo_";
		$data = DB::table('apo_distribusi')->join('apo_obat','apo_distribusi.kodobat' ,'=' ,'apo_obat.kodobat')
				->leftJoin('apo_detailobat' ,$this->pref.'obat.kodobat' ,'=' , 'apo_detailobat.kodobat')
				->select('apo_distribusi.*' , 'apo_obat.kodejenis' , 'apo_obat.namaobat' , 'apo_obat.komposisi' , 'apo_obat.satuan' , 'apo_obat.stok' ,'apo_detailobat.stok as stok_obat')
				->where('apo_distribusi.tanggal','=' ,$tanggal)->where('apo_distribusi.keterangan' ,'=' , 'retur')
				->where('apo_detailobat.tempat' , 'apotek_askes')->get();
		return $data;
	}

	public function hapus_transaksi($pref="askes")
	{	
		$this->pref = "apo_";
		$no = Input::get('no');

		$select = DB::table('apo_distribusi')->where('id' , '=' , $no)->get();
		$j = 0;
		foreach($select as $s){
			echo $s->kodobat;
			$obat = DB::table('apo_obat')->where('kodobat', $s->kodobat )->first();
			if( isset($obat->stok) ){
				$new_stok = intval( $obat->stok ) + intval( $s->jumlah );
				$k=DB::table($this->pref.'obat')->where('kodobat', $s->kodobat )->update(
					array(
						'stok' => $new_stok
					)
				);
			}

			$obat2 = DB::table('apo_detailobat')->where('kodobat', $s->kodobat )->where('tempat' , 'apotek_askes')->first();
			if( isset($obat2->stok) ){
				$new_stok = intval( $obat2->stok ) - intval( $s->jumlah );
				$k=DB::table('apo_detailobat')->where('kodobat', $s->kodobat )->update(
					array(
						'stok' => $new_stok
					)
				);
			}
			$j++;
		}
		DB::table('apo_distribusi')->where('id' , '=' , $no)->delete();
	}

	public function terbilang($x)
	{
	  	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	  	if ($x < 12)
	    	return " " . $abil[$x];
	  	elseif ($x < 20)
	    	return $this->terbilang($x - 10) . "belas";
	  	elseif ($x < 100)
	    	return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
	  	elseif ($x < 200)
	    	return " seratus" . $this->terbilang($x - 100);
	  	elseif ($x < 1000)
	   		return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
	  	elseif ($x < 2000)
	    	return " seribu" . $this->terbilang($x - 1000);
	  	elseif ($x < 1000000)
	    	return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
	  	elseif ($x < 1000000000)
	    	return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
	}




}
