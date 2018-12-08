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
				<h3 class="heading">RL 3.13 Obat<span style="float:right;">
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

				<h4>A. Pengadaan Obat</h4>
				<table class="table table-striped table-bordered" cellspacing="1" cellpadding="1" class="tb" width="95%">
				<thead>
					<tr><th>NO</th><th>GOLONGAN OBAT</th><th>JUMLAH ITEM OBAT</th><th>JUMLAH ITEM OBAT YANG TERSEDIA di RUMAH SAKIT</th><th>JUMLAH ITEM OBAT FORMULATORIUM TERSEDIA DIRUMAH SAKIT</th></tr>
					<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
				</thead>
				<tbody>
					<tr><td>1</td><td>OBAT GENERIK</td><td></td><td></td><td></td></tr>
					<tr><td>2</td><td>Obat Non Generik Formulatorium</td><td></td><td></td><td></td></tr>
					<tr><td>3</td><td>Obat Non Generik</td><td></td><td></td><td></td></tr>
					<tr><td>99</td><td>TOTAL</td><td></td><td></td><td></td></tr>
					
				</tbody>
				</table>

				<h4>B. Penulisan dan Pelayanan Resep</h4>
				<table class="table table-striped table-bordered" cellspacing="1" cellpadding="1" class="tb" width="95%">
				<thead>
					<tr><th>NO</th><th>GOLONGAN OBAT</th><th>RAWAT JALAN</th><th>IGD</th><th>RAWAT INAP</th></tr>
					<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
				</thead>
				<tbody>
									<tr><td>1</td><td>OBAT GENERIK</td><td></td><td>0</td><td></td></tr>
					<tr><td>2</td><td>Obat Non Generik Formulatorium</td><td>0</td><td>0</td><td>0</td></tr>
					<tr><td>3</td><td>Obat Non Generik</td><td></td><td>0</td><td></td></tr>
					<tr><td>99</td><td>TOTAL</td><td></td><td></td><td></td></tr>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop