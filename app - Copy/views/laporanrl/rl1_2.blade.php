@extends('layout')

@section('css')
	@parent
	<style type="text/css">
	table input ,select.selectbox{
		margin-top: 1px;
		margin-bottom: 1px;
	}
	table input{
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
				<table cellpadding="0" class="tb" width="95%" cellspacing="0">
				<tr><td><h3 class="heading">INDIKATOR PELAYANAN RUMAH SAKIT<span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span></h3></td></tr>
				</table>

				<table cellpadding="0" class="tb" width="95%" cellspacing="0">
				<tbody><tr><td> Kode RS </td><td>: 
					<input type="text" name="kode_rs" class="inputrl12" disabled="disabled"></td></tr>
                <tr><td> Nama RS </td><td>: 
                	<input type="text" name="nama_rs" class="inputrl12" disabled="disabled"></td></tr>
                <tr><td> Tahun </td><td>: <input type="text" name="tahun" class="inputrl12" value="<?php echo date('Y'); ?>"></td></tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr><td colspan="2"><h3 class="heading">RL 1.2 Indikator Pelayanan Rumah Sakit<span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span></h3></td></tr>
			</tbody></table>

				<table class="table table-striped table-bordered" cellspacing="1" cellpadding="1" class="tb" width="95%">
            	<tbody><tr>
                	<th>Tahun</th>
                    <th>BOR</th>
                    <th>LOS</th>
                    <th>BTO</th>
                    <th>TOI</th>
                    <th>NDR</th>
                    <th>GDR</th>
                    <th>Rata-rata Kunjungan / Hari</th>
			  </tr>
			</tbody></table>

			</div>
		</div>
	</div>
</div>
@stop