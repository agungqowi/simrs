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
				<h3 class="heading">License Rumah Sakit</h3>
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
				            <td>Nama Rumah Sakit</td>
				            <td>: <input type="text" name="license" class="inputrl11" value="<?php echo $data->license; ?>"></td>
				        </tr>
				        <tr>
				            <td>License Code</td>
				            <td>: <input type="text" name="license_code" class="inputrl11" value="<?php echo $data->license_code; ?>"></td>
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
