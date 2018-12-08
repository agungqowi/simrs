@extends('layout')

@section('css')
	@parent
	<style type="text/css">
	input.inputrl11 ,select.selectbox{
		margin-top: 1px;
		margin-bottom: 1px;
	}
	input.inputrl11{
		height: 15px;
    	padding: 5px;
	}
	#form_rl tr{
	}

	#form_rl td{
	}
	</style>
@stop

@section('content')
<div id="contentwrapper">
    <div class="main_content">
		<div class="row-fluid">
			<div class="span12">
				<h3 class="heading">RL 1.1 Data Dasar Rumah Sakit<span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span></h3>
				@if(Session::has('success'))
				    <div class="alert alert-success">
						<a class="close" data-dismiss="alert">×</a>
				        {{ Session::get('success') }}
				    </div>
				@endif

				<form method="post" action="">
					<table cellpadding="0" class="tb" width="95%" cellspacing="0">
						<tbody><tr><td width="20%"><strong><h2>TAHUN</h2></strong></td><td>
							<select name="tahun">
								<option value="<?php echo date('Y'); ?>"> <?php echo date('Y'); ?> </option>						
							</select>
						</td></tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><td colspan="2"><h2>RL 1.1 Data Dasar Rumah Sakit</h2></td></tr>
					</tbody>
				</table>
			
			
				<table id="form_rl" cellspacing="1" cellpadding="1" class="tb" width="95%">
				    <tbody>
				        <tr>
				            <td>1.</td>
				            <td>Nomor Kode RS</td>
				            <td>: <input type="text" name="nomor_kode_rs" class="inputrl11" value="<?php echo $data->nomor_kode_rs; ?>"></td>
				        </tr>
				        <tr>
				            <td>2.</td>
				            <td>Tanggal Registrasi</td>
				            <td>: <input type="text" name="tanggal_registrasi" value="<?php echo $data->tanggal_registrasi; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>3.</td>
				            <td>Nama Rumah Sakit</td>
				            <td>: <input type="text" name="nama_rumah_sakit" value="<?php echo $rs_title ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>4.</td>
				            <td>Jenis Rumah Sakit</td>
				            <td>: <select name="jenis_rumah_sakit" id="jenis_rumah_sakit" class="selectbox">
				            		<option value="">-Pilih Jenis RS-</option>
				            		@foreach($jenis as $j)
				            			@if($j->id == $data->jenis_rumah_sakit)
				            				<option selected="selected" value="{{ $j->id }}">{{ $j->jenis }}</option>
				            			@else
				            				<option value="{{ $j->id }}">{{ $j->jenis }}</option>
				            			@endif
				            		@endforeach
				            	</select>
				            </td>
				        </tr>
				        <tr>
				            <td>5.</td>
				            <td>Kelas Rumah Sakit</td>
				            <td>: <input type="text" name="kelas_rumah_sakit" value="<?php echo $data->kelas_rumah_sakit; ?>" class="inputrl11"></td></td>
				        </tr>
				        <tr>
				            <td>6.</td>
				            <td>Nama Direktur RS</td>
				            <td>: <input type="text" name="nama_direktur_rs" value="<?php echo $data->nama_direktur_rs; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>7.</td>
				            <td>Nama Penyelenggara RS</td>
				            <td>: <input type="text" name="nama_penyelenggara_rs" value="<?php echo $data->nama_penyelenggara_rs; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>8.</td>
				            <td>Alamat / Lokasi RS</td>
				            <td></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>8.1 Kab / Kota</td>
				            <td>: <input type="text" name="kab_kota" value="<?php echo $data->kab_kota; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>8.2 Kode Pos</td>
				            <td>: <input type="text" name="kode_pos" value="<?php echo $data->kode_pos; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>8.3 Telepon</td>
				            <td>: <input type="text" name="telepon" value="<?php echo $data->telepon; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>8.4 Fax</td>
				            <td>: <input type="text" name="fax" value="<?php echo $data->fax; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>8.5 Email</td>
				            <td>: <input type="text" name="email" value="<?php echo $data->email; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>8.6 No Telp Bag. Umum / Humas RS</td>
				            <td>: <input type="text" name="nomor_telp_bag_umum" value="<?php echo $data->nomor_telp_bag_umum; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>8.7 Website</td>
				            <td>: <input type="text" name="website" value="<?php echo $data->website; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>9.</td>
				            <td>Luas Rumah Sakit</td>
				            <td></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>9.1 Tanah</td>
				            <td>: <input type="text" name="tanah" value="<?php echo $data->tanah; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>9.2 Bangunan</td>
				            <td>: <input type="text" name="bangunan" value="<?php echo $data->bangunan; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>10.</td>
				            <td>Surat Izin Penetapan</td>
				            <td></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>10.1 Nomor</td>
				            <td>: <input type="text" name="nomor" value="<?php echo $data->nomor; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>10.2 Tanggal</td>
				            <td>: <input type="text" name="tanggal" value="<?php echo $data->tanggal; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>10.3 Oleh</td>
				            <td>: <input type="text" name="oleh" value="<?php echo $data->oleh; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>10.4 Sifat</td>
				            <td>: <input type="text" name="sifat" value="<?php echo $data->sifat; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>10.5 Masa Berlaku s/d thn</td>
				            <td>: <input type="text" name="masa_berlaku_thn" value="<?php echo $data->masa_berlaku_thn; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>11.</td>
				            <td>Status Penyelnggara Swasta</td>
				            <td>: <select name="status_penyelenggara_swasta" id="status_penyelenggara_swasta" class="selectbox">
				              <option value=""> -- Status Penyelenggara -- </option>
				            		@foreach($swasta as $s)
				            			@if($s->id == $data->status_penyelenggara_swasta)
				            				<option selected="selected" value="{{ $s->id }}">{{ $s->nama }}</option>
				            			@else
				            				<option value="{{ $s->id }}">{{ $s->nama }}</option>
				            			@endif
				            		@endforeach
				              </select></td>
				        </tr>
				        <tr>
				            <td>12.</td>
				            <td>Akreditasi RS</td>
				            <td>: <select name="akreditasi_rs" id="akreditasi_rs" class="selectbox">
				            	<option value=""> -- Akreditasi RS -- </option>
				            	<option <?php if($data->akreditasi_rs == 'sudah'){ echo 'selected="selected"'; } ?> value="sudah"> Sudah </option>
				            	<option <?php if($data->akreditasi_rs == 'belum'){ echo 'selected="selected"'; } ?> value="belum"> Belum </option>
				            </select></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>12.1 Pentahapan</td>
				            <td>: <select name="pentahapan" id="pentahapan" class="selectbox">
				              												<option value=""> -- Pentahapan Akreditasi -- </option>
				                                                            <option value="1"> 5 Pelayanan</option><option value="2"> 12 Pelayanan</option><option value="3"> 16 Pelayanan</option>              											</select></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>12.2 Status</td>
				            <td>: <select name="STATUS" id="STATUS" class="selectbox">
				            		<option value=""> -- Status Akreditasi -- </option>				            			
					            	<option <?php if($data->STATUS == 'sudah'){ echo 'selected="selected"'; } ?> value="sudah"> Sudah </option>
					            	<option <?php if($data->STATUS == 'belum'){ echo 'selected="selected"'; } ?> value="belum"> Belum </option>
									</select></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>12.3 Tanggal Akreditasi</td>
				            <td>: <input type="text" name="tanggal_akreditasi" value="<?php echo $data->tanggal_akreditasi; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>13.</td>
				            <td>Tempat Tidur</td>
				            <td></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>13.1 VVIP</td>
				            <td>: <input type="text" name="vvip" value="<?php echo $data->vvip; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>13.2 VIP</td>
				            <td>: <input type="text" name="vip" value="<?php echo $data->vip; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>13.3 I</td>
				            <td>: <input type="text" name="i" value="<?php echo $data->i; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>13.4 II</td>
				            <td>: <input type="text" name="ii" value="<?php echo $data->ii; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>13.5 III</td>
				            <td>: <input type="text" name="iii" value="<?php echo $data->iii; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>14.</td>
				            <td>Tenaga Medis</td>
				            <td></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.A</td>
				            <td>: <input type="text" name="dokter_spa" value="<?php echo $data->dokter_spa; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.OG</td>
				            <td>: <input type="text" name="dokter_spog" value="<?php echo $data->dokter_spog; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.Pd</td>
				            <td>: <input type="text" name="dokter_sppd" value="<?php echo $data->dokter_sppd; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.B</td>
				            <td>: <input type="text" name="dokter_spb" value="<?php echo $data->dokter_spb; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.Rad</td>
				            <td>: <input type="text" name="dokter_sprad" value="<?php echo $data->dokter_sprad; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.RM</td>
				            <td>: <input type="text" name="dokter_sprm" value="<?php echo $data->dokter_sprm; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.An</td>
				            <td>: <input type="text" name="dokter_span" value="<?php echo $data->dokter_span; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.Jp</td>
				            <td>: <input type="text" name="dokter_spjp" value="<?php echo $data->dokter_spjp; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.M</td>
				            <td>: <input type="text" name="dokter_spm" value="<?php echo $data->dokter_spm; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.THT</td>
				            <td>: <input type="text" name="dokter_sptht" value="<?php echo $data->dokter_sptht; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Sp.Kj</td>
				            <td>: <input type="text" name="dokter_spkj" value="<?php echo $data->dokter_spkj; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Umum</td>
				            <td>: <input type="text" name="dokter_umum" value="<?php echo $data->dokter_umum; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Gigi</td>
				            <td>: <input type="text" name="dokter_gigi" value="<?php echo $data->dokter_gigi; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Dokter Gigi Spesialis</td>
				            <td>: <input type="text" name="dokter_gigi_spesialis" value="<?php echo $data->dokter_gigi_spesialis; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Perawat</td>
				            <td>: <input type="text" name="perawat" value="<?php echo $data->perawat; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Bidan</td>
				            <td>: <input type="text" name="bidan" value="<?php echo $data->bidan; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Farmasi</td>
				            <td>: <input type="text" name="farmasi" value="<?php echo $data->farmasi; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td></td>
				            <td>14.1 Tenaga Kesehatan Lainnya</td>
				            <td>: <input type="text" name="tenaga_kesehatan_lainnya" value="<?php echo $data->tenaga_kesehatan_lainnya; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>15.</td>
				            <td>Tenaga Non Kesehatan</td>
				            <td>: <input type="text" name="tenaga_non_kesehatan" value="<?php echo $data->tenaga_non_kesehatan; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td colspan="3"> <input type="submit" class="btn btn-primary" name="submit" value="Simpan"></td>
				        </tr>
				    </tbody>
				</table>
				
			</form>
			</div>
		</div>
	</div>
</div>
@stop
