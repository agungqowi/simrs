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
				<h3 class="heading">RL 3.14 Rujukan<span style="float:right;">
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
				<tr><th rowspan="2">NO</th><th rowspan="2">JENIS SPESIALISASI</th><th colspan="6">RUJUKAN</th><th colspan="3">DIRUJUK</th></tr>
				<tr><th>DITERIMA DARI PUSKESMAS</th><th>DITERIMA DARI FASILITAS KES. LAIN</th><th>DITERIMA DARI RS LAIN</th><th>DIKEMBALIKAN KE PUSKESMAS</th><th>DIKEMBALIKAN KE FASILITAS KES. LAIN</th><th>DIKEMBALIKAN KE RS LAIN</th><th>PASIEN RUJUKAN</th><th>PASIEN DATANG SENDIRI</th><th>DITERIMA KEMBALI</th></tr>
				<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td></tr>
			</thead>
			<tbody>
				<tr><td align="center">1</td><td>Penyakit Dalam</td>
						<td align="right">0</td>
						<td align="right">0</td>
						<td align="right">0</td>
						<td align="right">0</td>
						<td align="right">0</td>
						<td align="right">0</td>
						<td align="right">0</td>
						<td align="right">1</td>
						<td align="right">0</td></tr><tr><td>99</td><td>TOTAL</td>
					<td align="right">0</td>
					<td align="right">0</td>
					<td align="right">0</td>
					<td align="right">0</td>
					<td align="right">0</td>
					<td align="right">0</td>
					<td align="right">0</td>
					<td align="right">1</td>
					<td align="right">0</td></tr>			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop