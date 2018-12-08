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
			<h3 class="heading">RL 3.10 Pelayanan Khusus<span style="float:right;">
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
				<tr><td>1</td><td>Elektro Encephalografi (EEG)</td><td></td></tr>
				<tr><td>2</td><td>Elektro Kardiographi (EKG)</td><td></td></tr>
				<tr><td>3</td><td>Elektro Myographi (EMG)</td><td></td></tr>
				<tr><td>4</td><td>Echo Cardiographi (ECG)</td><td></td></tr>
				<tr><td>5</td><td>Endoskopi (semua bentuk)</td><td></td></tr>
				<tr><td>6</td><td>Hemodialisa</td><td></td></tr>
				<tr><td>7</td><td>Densometri Tulang</td><td></td></tr>
				<tr><td>8</td><td>Koreksi Fraktur/Dislokasi non Bedah</td><td></td></tr>
				<tr><td>9</td><td>Pungsi</td><td></td></tr>
				<tr><td>10</td><td>Spirometri</td><td></td></tr>
				<tr><td>11</td><td>Tes Kulit/Alergi/Histamin</td><td></td></tr>
				<tr><td>12</td><td>Topometri</td><td></td></tr>
				<tr><td>13</td><td>Tredmill/ Exercise Test</td><td></td></tr>
				<tr><td>14</td><td>Akupuntur</td><td></td></tr>
				<tr><td>15</td><td>Hiperbarik</td><td></td></tr>
				<tr><td>16</td><td>Herbal / jamu</td><td></td></tr>
				<tr><td>88</td><td>Lain-Lain</td><td></td></tr>
				<tr><td>99</td><td>Total</td><td></td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop