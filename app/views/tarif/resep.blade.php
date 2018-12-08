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
				<h3 class="heading">Tarif Resep</h3>
				@if(Session::has('success'))
				    <div class="alert alert-success">
						<a class="close" data-dismiss="alert">×</a>
				        {{ Session::get('success') }}
				    </div>
				@endif

				<form enctype="multipart/form-data" method="post" action="">			
			
				<table id="form_rl" cellspacing="1" cellpadding="1" class="tb" width="95%">
				    <tbody>				    	
				        <tr>
				            <td>Obat Paten BPJS</td>
				            <td>: <input type="text" name="obat_bpjs" class="obat_bpjs" value="<?php echo $data->obat_bpjs; ?>"></td>
				        </tr>			    	
				        <tr>
				            <td>Obat Paten Umum</td>
				            <td>: <input type="text" name="obat_umum" class="obat_umum" value="<?php echo $data->obat_umum; ?>"></td>
				        </tr>

				        <tr>
				            <td>Satuan (Obat)</td>
				            <td>: 
				            <select name="satuan_obat">
				            	<option value="transaksi">Per Transaksi</option>
				            	<?php $selected = ""; ?>
				            	@if($data->satuan_obat == 'obat')
				            		<?php $selected = " selected = 'selected' "; ?>
				            	@endif
				            	<option {{ $selected }} value="obat">Per Obat</option>		            	
				            </select>
				            
				            </td>
				        </tr>

				        <tr>
				            <td>Obat Racikan BPJS</td>
				            <td>: <input type="text" name="racikan_bpjs" class="racikan_bpjs" value="<?php echo $data->racikan_bpjs; ?>"></td>
				        </tr>			    	
				        <tr>
				            <td>Obat Racikan Umum</td>
				            <td>: <input type="text" name="racikan_umum" class="racikan_umum" value="<?php echo $data->racikan_umum; ?>"></td>
				        </tr>
				        <tr>
				            <td>Satuan (Racikan)</td>
				            <td>: 
				            <select name="satuan_racikan">
				            	<option value="transaksi">Per Transaksi</option>
				            	<?php $selected = ""; ?>
				            	@if($data->satuan_racikan == 'obat')
				            		<?php $selected = " selected = 'selected' "; ?>
				            	@endif
				            	<option {{ $selected }} value="obat">Per Obat</option>		            	
				            </select>
				            
				            </td>
				        </tr>
				        <tr>
				            <td>Multi R (Jika ada obat Paten + Racikan)</td>
				            <td>: 
				            <select name="penambahan">
				            	<option value="0">Hanya 1 R</option>
				            	<?php $selected = ""; ?>
				            	@if($data->penambahan == '1')
				            		<?php $selected = " selected = 'selected' "; ?>
				            	@endif
				            	<option {{ $selected }} value="1">Multi R</option>		            	
				            </select>
				            
				            </td>
				        </tr>

				        <tr>
				            <td>Pasien APS</td>
				            <td>: 
				            <select name="aps">
				            	<option value="0">Tidak</option>
				            	<?php $selected = ""; ?>
				            	@if($data->penambahan == '1')
				            		<?php $selected = " selected = 'selected' "; ?>
				            	@endif
				            	<option {{ $selected }} value="1">Ada Biaya R</option>		            	
				            </select>
				            
				            </td>
				        </tr>

				        <tr>
				            <td colspan="2"> <input type="submit" class="btn btn-primary" name="submit" value="Simpan"></td>
				        </tr>
				    </tbody>
				</table>
				
			</form>
			</div>
		</div>
	</div>
</div>
@stop
