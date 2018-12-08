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
				<h3 class="heading">Data Dasar Rumah Saki</h3>
				@if(Session::has('success'))
				    <div class="alert alert-success">
						<a class="close" data-dismiss="alert">×</a>
				        {{ Session::get('success') }}
				    </div>
				@endif

				<form enctype="multipart/form-data" method="post" action="">
				<input type="hidden" name="tahun" value="<?php echo date('Y'); ?>">
			
			
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
				            <td>: <input type="text" name="nama_rumah_sakit" value="<?php echo $rs_title; ?>" class="inputrl11"></td>
				        </tr>
				        <tr>
				            <td>3b.</td>
				            <td>Logo RS</td>
				            <td>: <img style="max-height:80px;" src="<?php echo url('img/'.$data->logo)  ?>"><br /><input type="file" name="logo" class="inputrl11" /><br /><br /></td>
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
				            <td>: <input type="text" name="alamat_lokasi_rs" value="<?php echo $data->alamat_lokasi_rs; ?>" class="inputrl11"></td>
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
