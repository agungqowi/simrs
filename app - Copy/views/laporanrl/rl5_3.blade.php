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
			<h3 class="heading">Laporan RL 5.3 10 Penyakit Teratas Rawat Inap<span style="float:right;">
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
			<table cellspacing="1" cellpadding="1" class="table table-striped table-bordered"  width="95%">
			<thead>
				<tr><th rowspan="2">NO URUT</th><th rowspan="2">ICD</th><th rowspan="2">DESKRIPSI</th><th colspan="2">Pasien Keluar (Hidup &amp; Mati) Menurut Jenis Kelamin</th><th rowspan="2">Jumlah Pasien Keluar Hidup</th><th rowspan="2">Jumlah Pasien Keluar Mati</th></tr>
				<tr><th>LK</th><th>PR</th></tr>
				<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>
			</thead>
			<tbody>
							</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop