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
			<h3 class="heading">RL 3.15 Cara Bayar<span style="float:right;">
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
				<tr><th rowspan="2">NO</th><th rowspan="2">CARA PEMBAYARAN</th><th colspan="2">PASIEN RAWAT INAP</th><th rowspan="2">JUMLAH PASIEN RAWAT JALAN</th><th colspan="3">JUMLAH PASIEN RAWAT JALAN</th></tr>
				<tr><th>JUMLAH PASIEN KELUAR</th><th>JUMLAH LAMA DIRAWAT</th><th>LABORATORIUM</th><th>RADIOLOGI</th><th>LAIN LAIN</th></tr>
				<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td></tr>
			</thead>
			<tbody>
				<tr><td>1</td><td>Membayar :</td><td colspan="6">&nbsp;</td></tr>
				<tr><td>1.1</td><td>Penuh</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>1.2</td><td>Keringanan</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>2</td><td>Asuransi :</td><td colspan="6">&nbsp;</td></tr>
				<tr><td>2.1</td><td>Asuransi Lain</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>2.2</td><td>JAMKESMAS / JAMKESDA</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>2.3</td><td>Kontrak</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>3</td><td>Gratis :</td><td colspan="6">&nbsp;</td></tr>
				<tr><td>3.1</td><td>Kartu Sehat</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>3.2</td><td>Keterangan Tidak Mampu</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>3.3</td><td>Lain Lain</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
				<tr><td>99</td><td>TOTAL</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop