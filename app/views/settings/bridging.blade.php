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
				<h3 class="heading">Bridging RS SEP BPJS</h3>
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
				            <td>Status</td>
				            <td>: 
				            <select name="status">
				            	<option value="0">-Tidak Aktif-</option>
				            	<?php $selected = ""; ?>
				            	@if($data->status == 1)
				            		<?php $selected = " selected = 'selected' "; ?>
				            	@endif
				            	<option {{ $selected }} value="1">- Aktif -</option>		            	
				            </select>
				            
				            </td>
				        </tr>
				        <tr>
				            <td>Kode PPK</td>
				            <td>: <input type="text" name="id_ppk" class="inputrl11" value="<?php echo $data->id_ppk; ?>"></td>
				        </tr>
				        <tr>
				            <td>Nama PPK</td>
				            <td>: <input type="text" name="nama_ppk" class="inputrl11" value="<?php echo $data->nama_ppk; ?>"></td>
				        </tr>
				        <tr>
				            <td>URL</td>
				            <td>: <input type="text" name="url" class="inputrl11" value="<?php echo $data->url; ?>"></td>
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
