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
				<h3 class="heading">RL 3.11 Kesehatan Jiwa<span style="float:right;">
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
				<table class="table table-striped table-bordered" cellspacing="1" cellpadding="1" class="tb" width="95%">
			<thead>
				<tr><th>NO</th><th>JENIS PELAYANAN</th><th>JUMLAH</th></tr>
				<tr><td>1</td><td>2</td><td>3</td></tr>
			</thead>
			<tbody>
				<tr><td>1</td><td>Psikotes</td><td></td></tr>
				<tr><td>2</td><td>Konsultasi</td><td></td></tr>
				<tr><td>3</td><td>Terapi Medikamentosa</td><td></td></tr>
				<tr><td>4</td><td>Elektro Medik</td><td></td></tr>
				<tr><td>5</td><td>Psikoterapi</td><td></td></tr>
				<tr><td>6</td><td>Play Therapy</td><td></td></tr>
				<tr><td>7</td><td>Rehabilitasi Medik Psikiatrik</td><td></td></tr>
				<tr><td>99</td><td>Total</td><td></td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop