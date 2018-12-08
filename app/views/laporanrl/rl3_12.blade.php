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
				<h3 class="heading">RL 3.12 Keluarga Berencana<span style="float:right;">
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
				<tr><th rowspan="2">NO</th><th rowspan="2">METODA</th><th colspan="2">KONSELING</th><th colspan="4">KB BARU DENGAN CARA MASUK</th><th colspan="3">KB BARU DENGAN KONDISI</th><th rowspan="2">KUNJUNGAN ULANG</th><th colspan="2">KELUHAN EFEK SAMPING</th></tr>
				<tr><th>ANC</th><th>PASCA PERSALINAN</th><th>BUKAN RUJUKAN</th><th>RUJUKAN R.INAP</th><th>RUJUKAN R.JALAN</th><th>TOTAL</th><th>PASCA PERSALINAN / NIFAS</th><th>ABORTUS</th><th>LAINNYA</th><th>JUMLAH</th><th>DIRUJUK</th></tr>
				<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td></tr>
			</thead>
			<tbody>
				<tr><td>1</td><td>I U D</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>2</td><td>P i l</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3</td><td>Kondom</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>4</td><td>Obat Vaginal</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>5</td><td>MO Pria</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>6</td><td>MO Wanita</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>7</td><td>Suntikan</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>8</td><td>Implant</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>99</td><td>TOTAL</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop