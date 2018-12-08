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
				<h3 class="heading">RL 3.3 Gigi dan Mulut<span style="float:right;">
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
				<table cellspacing="1" class="table table-striped table-bordered" cellpadding="1" class="tb" width="95%">
			<thead>
				<tr><th>NO</th><th>JENIS KEGIATAN</th><th>JUMLAH</th></tr>
				<tr><td>1</td><td>2</td><td>3</td></tr>
			</thead>
			<tbody>
				<tr><td>1</td><td>Tumpatan Gigi Tetap</td><td></td></tr>
				<tr><td>2</td><td>Tumpatan Gigi Sulung</td><td></td></tr>
				<tr><td>3</td><td>Pengobatan Pulpa</td><td></td></tr>
				<tr><td>4</td><td>Pencabutan Gigi Tetap</td><td></td></tr>
				<tr><td>5</td><td>Pencabutan Gigi Sulung	</td><td></td></tr>
				<tr><td>6</td><td>Pengobatan Periodontal	</td><td></td></tr>
				<tr><td>7</td><td>Pengobatan Abses</td><td></td></tr>
				<tr><td>8</td><td>Pembersihan Karang Gigi</td><td></td></tr>
				<tr><td>9</td><td>Prothese Lengkap</td><td></td></tr>
				<tr><td>10</td><td>Prothese Sebagian</td><td></td></tr>
				<tr><td>11</td><td>Prothese Cekat</td><td></td></tr>
				<tr><td>12</td><td>Orthodonti</td><td></td></tr>
				<tr><td>13</td><td>Jacket/Bridge</td><td></td></tr>
				<tr><td>14</td><td>Bedah Mulut</td><td></td></tr>
				<tr><td>99</td><td>Total</td><td></td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop