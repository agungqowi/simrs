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
			<h3 class="heading">Laporan RL 5.1 Pengunjung<span style="float:right;">
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
				<tr><th>NO</th><th>NAMA KEGIATAN</th><th>JUMLAH</th></tr>
				<tr><td>1</td><td>2</td><td>3</td></tr>
			</thead>
			<tbody>
								<tr align="center"><td width="20px">1</td><td width="220px">Pengunjung Baru</td><td align="right">0</td></tr>
				<tr align="center"><td width="20px">2</td><td width="220px">Pengunjung Lama</td><td align="right">1</td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop