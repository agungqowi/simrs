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
				<h3 class="heading">RL 3.7 Radiologi<span style="float:right;">
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
				<tr><th>NO</th><th>JENIS KEGIATAN</th><th>JUMLAH</th></tr>
				<tr><td>1</td><td>2</td><td>3</td></tr>
			</thead>
			<tbody>
				<tr><td colspan="3">RADIODIAGNOSTIK</td></tr>
				<tr><td>1</td><td>Foto tanpa bahan kontras</td><td></td></tr>
				<tr><td>2</td><td>Foto dengan bahan kontras	</td><td></td></tr>
				<tr><td>3</td><td>Foto dengan rol film	</td><td></td></tr>
				<tr><td>4</td><td>Flouroskopi	</td><td></td></tr>
				<tr><td>5</td><td>Foto Gigi : </td><td></td></tr>
				<tr><td>6</td><td>C.T. Scan : </td><td></td></tr>
				<tr><td>7</td><td>Lymphografi</td><td></td></tr>
				<tr><td>8</td><td>Angiograpi</td><td></td></tr>
				<tr><td>9</td><td>Lain-Lain</td><td></td></tr>
				<tr><td colspan="3">RADIOTHERAPI</td></tr>
				<tr><td>1</td><td>Jumlah Kegiatan Radiotherapi</td><td></td></tr>
				<tr><td>2</td><td>Lain-Lain</td><td></td></tr>
				<tr><td colspan="3">KEDOKTERAN NUKLIR</td></tr>
				<tr><td>1</td><td>Jumlah Kegiatan Diagnostik</td><td></td></tr>
				<tr><td>2</td><td>Jumlah Kegiatan Therapi</td><td></td></tr>
				<tr><td>3</td><td>Lain-Lain</td><td></td></tr>
				<tr><td colspan="3">IMAGING / PENCITRAAN</td></tr>
				<tr><td>1</td><td>USG</td><td></td></tr>
				<tr><td>2</td><td>MRI</td><td></td></tr>
				<tr><td>3</td><td>Lain-Lain</td><td></td></tr>
				<tr><td>99</td><td>TOTAL</td><td></td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop