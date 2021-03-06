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
				<h3 class="heading">RL 3.5 Perinatologi<span style="float:right;">
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
				<tr><th rowspan="3">NO</th><th rowspan="3">JENIS KEGIATAN</th><th colspan="10">RUJUKAN</th><th rowspan="2" colspan="3">NON RUJUKAN</th><th rowspan="3">DIRUJUK</th></tr>
				<tr><th colspan="7">MEDIS</th><th colspan="3">NON MEDIS</th></tr>
				<tr><th>Rumah Sakit</th><th>Bidan</th><th>Puskesmas</th><th>FASKES LAINNYA</th><th>Jumlah Hidup</th><th>Jumlah Mati</th><th>Jumlah Total</th><th>Jumlah Hidup</th><th>Jumlah Mati</th><th>Jumlah Total</th><th>Jumlah Hidup</th><th>Jumlah Mati</th><th>Jumlah Total</th></tr>
				<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td></tr>
			</thead>
			<tbody>
				<tr><td>1</td><td>Bayi Lahir Hidup</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>1.1</td><td>&gt; 2500 gram</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>1.2</td><td>&lt; 2500 gram</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>2</td><td>Kematian Perinatal</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>2.1</td><td>Kelahiran Mati</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>2.2</td><td>Mati Neonatal &lt; 7 Hari</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3</td><td>Sebab Kematian </td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.1</td><td>Asphyxia</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.2</td><td>Trauma Kelahiran</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.3</td><td>BBLR</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.4</td><td>Tetanus Neonatorum</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.5</td><td>Kelainan Congenital</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.6</td><td>ISPA</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.7</td><td>Diare</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td>3.8</td><td>Lain - Lain</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				
				<tr><td></td><td>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop