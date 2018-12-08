<?php

class VerifikasiController extends Controller {

	public function pembayaranRJ(){
		$check	= DB::table('tbpasienjalan')->where('Tanggal' , '2018-03-02')->where('StatusBayar' , '0')->get();

			if( count($check) > 0 ){
				foreach($check as $c){
					$check_tindakan = DB::table('tbdetailtindakan')->where('IdReg' , $c->IdRegJalan)
									->where('StatusBayar' , '0')->get();

					if( count($check_tindakan) < 1 ){
						$kode_billing 	= 0;
						foreach($check_tindakan as $d){
							$kode_billing	= $d->KodeBilling;
						}
						$pembayaran 	= $c->Total;
						$update = DB::table('tbpasienjalan')->where('IdRegJalan' , $c->IdRegJalan)->update(
							array(
									'Pembayaran' 		=> $pembayaran ,
									'StatusBayar'		=> '1',
									'KodeBillingTotal'	=> $kode_billing
							)
						);

					}
					else{

					}

				}
			}
	}

}
