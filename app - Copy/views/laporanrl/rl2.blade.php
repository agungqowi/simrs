@extends('layout')

@section('css')
	@parent
	<style type="text/css">
	input.textbox ,select.selectbox{
		margin-top: 1px;
		margin-bottom: 1px;
		width: 20px;
	}
	input.textbox{
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
			<h3 class="heading">RL 2 Ketenagaan<span style="float:right;">
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
				<tr><th rowspan="2">NO KODE</th><th rowspan="2">KUALIFIKASI PENDIDIKAN</th><th colspan="2">KEADAAN</th><th colspan="2">KEBUTUHAN</th><th colspan="2">KEKURANGAN</th></tr>
            	<tr><th>Laki - Laki</th><th>Perempuan</th><th>Laki - Laki</th><th>Perempuan</th><th>Laki - Laki</th><th>Perempuan</th></tr>
			</thead>
			<tbody>
				<tr><td colspan="8"> TENAGA MEDIS </td></tr><tr></tr><tr><td align="center">1</td><td colspan="7">Dokter Umum</td></tr><tr></tr><tr><td align="center">1.1</td><td>Dokter Umum</td>
											<td><input type="text" name="tenaga_1_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.2</td><td>Dokter PPDS</td>
											<td><input type="text" name="tenaga_1_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.3</td><td>Dokter Spes Bedah</td>
											<td><input type="text" name="tenaga_1_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.4</td><td>Dokter Spes Penyakit Dalam</td>
											<td><input type="text" name="tenaga_1_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.5</td><td>Dokter Spes Kes Anak</td>
											<td><input type="text" name="tenaga_1_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.6</td><td>Dokter Spes Obgin</td>
											<td><input type="text" name="tenaga_1_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.7</td><td>Dokter Spes Radiologi</td>
											<td><input type="text" name="tenaga_1_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.8</td><td>Dokter Spes Onkologi Radiasi</td>
											<td><input type="text" name="tenaga_1_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.9</td><td>Dokter Spes Kedokteran Nuklir</td>
											<td><input type="text" name="tenaga_1_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.10</td><td>Dokter Spes Anesthesi</td>
											<td><input type="text" name="tenaga_1_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.11</td><td>Dokter Spes Patologi Klinik</td>
											<td><input type="text" name="tenaga_1_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.12</td><td>Dokter Spes Jiwa</td>
											<td><input type="text" name="tenaga_1_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_12[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.13</td><td>Dokter Spes Mata</td>
											<td><input type="text" name="tenaga_1_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_13[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.14</td><td>Dokter Spes THT</td>
											<td><input type="text" name="tenaga_1_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_14[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.15</td><td>Dokter Spes Kulit Kelamin</td>
											<td><input type="text" name="tenaga_1_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_15[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.16</td><td>Dokter Spes Kardiologi</td>
											<td><input type="text" name="tenaga_1_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_16[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.17</td><td>Dokter Spes Paru</td>
											<td><input type="text" name="tenaga_1_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_17[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.18</td><td>Dokter Spes Saraf</td>
											<td><input type="text" name="tenaga_1_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_18[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.19</td><td>Dokter Spes Bedah Saraf</td>
											<td><input type="text" name="tenaga_1_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_19[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.20</td><td>Dokter Spes Bedah Orthopedi</td>
											<td><input type="text" name="tenaga_1_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_20[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.21</td><td>Dokter Spes Urologi</td>
											<td><input type="text" name="tenaga_1_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_21[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.22</td><td>Dokter Spes Patologi Anatomi</td>
											<td><input type="text" name="tenaga_1_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_22[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.23</td><td>Dokter Spes Patologi Forensik</td>
											<td><input type="text" name="tenaga_1_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_23[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.24</td><td>Dokter Spes Rehabilitasi Medik</td>
											<td><input type="text" name="tenaga_1_24[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_24[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_24[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_24[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_24[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_24[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.25</td><td>Dokter Spes Bedah Plastik</td>
											<td><input type="text" name="tenaga_1_25[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_25[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_25[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_25[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_25[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_25[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.26</td><td>Dokter Spes Ked Olah Raga</td>
											<td><input type="text" name="tenaga_1_26[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_26[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_26[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_26[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_26[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_26[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.27</td><td>Dokter Spes Mikrobiologi Klinik</td>
											<td><input type="text" name="tenaga_1_27[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_27[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_27[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_27[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_27[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_27[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.28</td><td>Dokter Spes Parasitologi Klinik</td>
											<td><input type="text" name="tenaga_1_28[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_28[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_28[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_28[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_28[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_28[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.29</td><td>Dokter Spes Gizi Medik</td>
											<td><input type="text" name="tenaga_1_29[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_29[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_29[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_29[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_29[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_29[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.30</td><td>Dokter Spes Farma Klinik</td>
											<td><input type="text" name="tenaga_1_30[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_30[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_30[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_30[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_30[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_30[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.31</td><td>Dokter Spes Lainnya</td>
											<td><input type="text" name="tenaga_1_31[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_31[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_31[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_31[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_31[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_31[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.32</td><td>Dokter Sub Spesialis Lainnya</td>
											<td><input type="text" name="tenaga_1_32[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_32[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_32[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_32[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_32[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_32[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.33</td><td>Dokter Gigi</td>
											<td><input type="text" name="tenaga_1_33[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_33[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_33[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_33[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_33[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_33[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.34</td><td>Dokter Gigi Spesialis</td>
											<td><input type="text" name="tenaga_1_34[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_34[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_34[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_34[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_34[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_34[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.35</td><td>DokterDokter Gigi MHAMARS</td>
											<td><input type="text" name="tenaga_1_35[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_35[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_35[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_35[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_35[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_35[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.36</td><td>DokterDokter Gigi S2S3 Kes Masy</td>
											<td><input type="text" name="tenaga_1_36[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_36[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_36[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_36[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_36[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_36[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">1.37</td><td>S3 Dokter Konsultan</td>
											<td><input type="text" name="tenaga_1_37[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_37[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_37[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_37[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_37[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_1_37[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2</td><td colspan="7">Tenaga Keperawatan</td></tr><tr></tr><tr><td align="center">2.1</td><td>S3 Keperawatan</td>
											<td><input type="text" name="tenaga_2_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.2</td><td>S2 Keperawatan</td>
											<td><input type="text" name="tenaga_2_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.3</td><td>S1 Keperawatan</td>
											<td><input type="text" name="tenaga_2_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.4</td><td>D4 Keperawatan</td>
											<td><input type="text" name="tenaga_2_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.5</td><td>Perawat Vokasional</td>
											<td><input type="text" name="tenaga_2_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.6</td><td>Perawat Spesialis</td>
											<td><input type="text" name="tenaga_2_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.7</td><td>Pembantu Keperawatan</td>
											<td><input type="text" name="tenaga_2_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.8</td><td>S3 Kebidanan</td>
											<td><input type="text" name="tenaga_2_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.9</td><td>S2 Kebidanan</td>
											<td><input type="text" name="tenaga_2_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.10</td><td>S1 Kebidanan</td>
											<td><input type="text" name="tenaga_2_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.11</td><td>D3 Kebidanan</td>
											<td><input type="text" name="tenaga_2_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">2.12</td><td>Tenaga Keperawatan Lainnya</td>
											<td><input type="text" name="tenaga_2_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_2_12[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3</td><td colspan="7">Kefarmasian</td></tr><tr></tr><tr><td align="center">3.1</td><td>S3 Farmasi Apoteker</td>
											<td><input type="text" name="tenaga_3_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.2</td><td>S2 Farmasi Apoteker</td>
											<td><input type="text" name="tenaga_3_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.3</td><td>Apoteker</td>
											<td><input type="text" name="tenaga_3_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.4</td><td>S1 Farmasi Farmakologi Kimia</td>
											<td><input type="text" name="tenaga_3_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.5</td><td>AKAFARMA</td>
											<td><input type="text" name="tenaga_3_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.6</td><td>AKFAR</td>
											<td><input type="text" name="tenaga_3_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.7</td><td>Analis Farmasi</td>
											<td><input type="text" name="tenaga_3_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.8</td><td>Asisten Apoteker SMF</td>
											<td><input type="text" name="tenaga_3_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.9</td><td>ST Lab Kimia Farmasi</td>
											<td><input type="text" name="tenaga_3_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">3.10</td><td>Tenaga Kefarmasian Lainnya</td>
											<td><input type="text" name="tenaga_3_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_3_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4</td><td colspan="7">Kesehatan Masyarakat</td></tr><tr></tr><tr><td align="center">4.1</td><td>S3 Kesehatan Masyarakat</td>
											<td><input type="text" name="tenaga_4_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.2</td><td>S3 Epidemiologi</td>
											<td><input type="text" name="tenaga_4_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.3</td><td>S3 Psikologi</td>
											<td><input type="text" name="tenaga_4_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.4</td><td>S2 Kesehatan Masyarakat</td>
											<td><input type="text" name="tenaga_4_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.5</td><td>S2 Epidemiologi</td>
											<td><input type="text" name="tenaga_4_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.6</td><td>S2 Biomedik</td>
											<td><input type="text" name="tenaga_4_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.7</td><td>S2 Psikologi</td>
											<td><input type="text" name="tenaga_4_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.8</td><td>S1 Kesehatan Masyarakat</td>
											<td><input type="text" name="tenaga_4_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.9</td><td>S1 Psikologi</td>
											<td><input type="text" name="tenaga_4_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.10</td><td>D3 Kesehatan Masyarakat</td>
											<td><input type="text" name="tenaga_4_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.11</td><td>D3 Sanitarian</td>
											<td><input type="text" name="tenaga_4_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.12</td><td>D1 Sanitarian</td>
											<td><input type="text" name="tenaga_4_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_12[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">4.13</td><td>Tenaga Kesehatan Masy Lainnya</td>
											<td><input type="text" name="tenaga_4_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_4_13[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">5</td><td colspan="7">Gizi</td></tr><tr></tr><tr><td align="center">5.1</td><td>S3 Gizi Dietisien</td>
											<td><input type="text" name="tenaga_5_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">5.2</td><td>S2 Gizi Dietisien</td>
											<td><input type="text" name="tenaga_5_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">5.3</td><td>S1 Gizi Dietisien</td>
											<td><input type="text" name="tenaga_5_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">5.4</td><td>D4 Gizi Dietisien</td>
											<td><input type="text" name="tenaga_5_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">5.5</td><td>Akademi D3 Gizi Dietisien</td>
											<td><input type="text" name="tenaga_5_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">5.6</td><td>D1 Gizi Dietisien</td>
											<td><input type="text" name="tenaga_5_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">5.7</td><td>Tenaga Gizi Lainnya</td>
											<td><input type="text" name="tenaga_5_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_5_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">6</td><td colspan="7">Keterapian Fisik</td></tr><tr></tr><tr><td align="center">6.1</td><td>S1 Fisio Terapis</td>
											<td><input type="text" name="tenaga_6_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">6.2</td><td>D3 Fisio Terapis</td>
											<td><input type="text" name="tenaga_6_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">6.3</td><td>D3 Okupasi Terapis</td>
											<td><input type="text" name="tenaga_6_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">6.4</td><td>D3 Terapi wicara</td>
											<td><input type="text" name="tenaga_6_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">6.5</td><td>D3 Orthopedi</td>
											<td><input type="text" name="tenaga_6_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">6.6</td><td>D3 Akupuntur</td>
											<td><input type="text" name="tenaga_6_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">6.7</td><td>Tenaga Keterapian Fisik Lainnya</td>
											<td><input type="text" name="tenaga_6_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_6_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7</td><td colspan="7">Keteknisan Medis</td></tr><tr></tr><tr><td align="center">7.1</td><td>S3 Opto Elektronika Apl Laser</td>
											<td><input type="text" name="tenaga_7_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.2</td><td>S2 Opto Elektronika Apl Laser</td>
											<td><input type="text" name="tenaga_7_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.3</td><td>Radiografer</td>
											<td><input type="text" name="tenaga_7_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.4</td><td>Radioterapis Non Dokter</td>
											<td><input type="text" name="tenaga_7_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.5</td><td>D4 Fisika Medik</td>
											<td><input type="text" name="tenaga_7_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.6</td><td>D3 Teknik Gigi</td>
											<td><input type="text" name="tenaga_7_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.7</td><td>D3 Teknik Radiologi Radioterapi</td>
											<td><input type="text" name="tenaga_7_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.8</td><td>D3 Refraksionis Optisien</td>
											<td><input type="text" name="tenaga_7_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.9</td><td>D3 Perekam Medis</td>
											<td><input type="text" name="tenaga_7_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.10</td><td>D3 Teknik Elektromedik</td>
											<td><input type="text" name="tenaga_7_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.11</td><td>D3 Analis Kesehatan</td>
											<td><input type="text" name="tenaga_7_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.12</td><td>D3 Informasi Kesehatan</td>
											<td><input type="text" name="tenaga_7_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_12[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.13</td><td>D3 Kardiovaskular</td>
											<td><input type="text" name="tenaga_7_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_13[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_13[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.14</td><td>D3 Orthotik Prostetik</td>
											<td><input type="text" name="tenaga_7_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_14[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_14[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.15</td><td>D1 Teknik Tranfusi</td>
											<td><input type="text" name="tenaga_7_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_15[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_15[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.16</td><td>Teknisi Gigi</td>
											<td><input type="text" name="tenaga_7_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_16[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_16[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.17</td><td>Tenaga IT dengan Teknologi Nano</td>
											<td><input type="text" name="tenaga_7_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_17[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_17[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.18</td><td>Teknisi Patologi Anatomi</td>
											<td><input type="text" name="tenaga_7_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_18[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_18[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.19</td><td>Teknisi Kardiovaskuler</td>
											<td><input type="text" name="tenaga_7_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_19[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_19[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.20</td><td>Teknisi Elektromedis</td>
											<td><input type="text" name="tenaga_7_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_20[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_20[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.21</td><td>Akupuntur Terapi</td>
											<td><input type="text" name="tenaga_7_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_21[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_21[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.22</td><td>Analis Kesehatan</td>
											<td><input type="text" name="tenaga_7_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_22[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_22[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">7.23</td><td>Tenaga Keterapian fisik Lainnya</td>
											<td><input type="text" name="tenaga_7_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_23[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_7_23[]" class="textbox" size="10" value="0"></td></tr><tr><td colspan="8"> TENAGA NON MEDIS </td></tr><tr></tr><tr><td align="center">8</td><td colspan="7">Doktoral</td></tr><tr></tr><tr><td align="center">8.1</td><td>S3 Biologi</td>
											<td><input type="text" name="tenaga_8_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.2</td><td>S3 Kimia</td>
											<td><input type="text" name="tenaga_8_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.3</td><td>S3 Ekonomi Akuntansi</td>
											<td><input type="text" name="tenaga_8_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.4</td><td>S3 Administrasi</td>
											<td><input type="text" name="tenaga_8_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.5</td><td>S3 Hukum</td>
											<td><input type="text" name="tenaga_8_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.6</td><td>S3 Tehnik</td>
											<td><input type="text" name="tenaga_8_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.7</td><td>S3 Kes Sosial</td>
											<td><input type="text" name="tenaga_8_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.8</td><td>S3 Fisika</td>
											<td><input type="text" name="tenaga_8_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.9</td><td>S3 Komputer</td>
											<td><input type="text" name="tenaga_8_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.10</td><td>S3 Statistik</td>
											<td><input type="text" name="tenaga_8_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">8.11</td><td>Doktoral Lainnya S3</td>
											<td><input type="text" name="tenaga_8_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_8_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9</td><td colspan="7">Pasca Sarjana</td></tr><tr></tr><tr><td align="center">9.1</td><td>S2 Biologi</td>
											<td><input type="text" name="tenaga_9_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.2</td><td>S2 Kimia</td>
											<td><input type="text" name="tenaga_9_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.3</td><td>S2 Ekonomi Akuntansi</td>
											<td><input type="text" name="tenaga_9_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.4</td><td>S2 Administrasi</td>
											<td><input type="text" name="tenaga_9_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.5</td><td>S2 Hukum</td>
											<td><input type="text" name="tenaga_9_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.6</td><td>S2 Tehnik</td>
											<td><input type="text" name="tenaga_9_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.7</td><td>S2 Kesejahteraan Sosial</td>
											<td><input type="text" name="tenaga_9_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.8</td><td>S2 Fisika</td>
											<td><input type="text" name="tenaga_9_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.9</td><td>S2 Komputer</td>
											<td><input type="text" name="tenaga_9_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.10</td><td>S2 Statistik</td>
											<td><input type="text" name="tenaga_9_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.11</td><td>S2 Administrasi Kes Masy</td>
											<td><input type="text" name="tenaga_9_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">9.12</td><td>Pasca Sarjana Lainnya S2</td>
											<td><input type="text" name="tenaga_9_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_12[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_9_12[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10</td><td colspan="7">Sarjana</td></tr><tr></tr><tr><td align="center">10.1</td><td>Sarjana Biologi</td>
											<td><input type="text" name="tenaga_10_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.2</td><td>Sarjana Kimia</td>
											<td><input type="text" name="tenaga_10_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.3</td><td>Sarjana Ekonomi Akuntansi</td>
											<td><input type="text" name="tenaga_10_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.4</td><td>Sarjana Administrasi</td>
											<td><input type="text" name="tenaga_10_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.5</td><td>Sarjana Hukum</td>
											<td><input type="text" name="tenaga_10_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.6</td><td>Sarjana Tehnik</td>
											<td><input type="text" name="tenaga_10_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.7</td><td>Sarjana Kes Sosial</td>
											<td><input type="text" name="tenaga_10_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.8</td><td>Sarjana Fisika</td>
											<td><input type="text" name="tenaga_10_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.9</td><td>Sarjana Komputer</td>
											<td><input type="text" name="tenaga_10_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.10</td><td>Sarjana Statistik</td>
											<td><input type="text" name="tenaga_10_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">10.11</td><td>Sarjana Lainnya S1</td>
											<td><input type="text" name="tenaga_10_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_10_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11</td><td colspan="7">Sarjana Muda</td></tr><tr></tr><tr><td align="center">11.1</td><td>Sarjana Muda Biologi</td>
											<td><input type="text" name="tenaga_11_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.2</td><td>Sarjana Muda Kimia</td>
											<td><input type="text" name="tenaga_11_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.3</td><td>Sarjana Muda Ekonomi Akuntansi</td>
											<td><input type="text" name="tenaga_11_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.4</td><td>Sarjana Muda Administrasi</td>
											<td><input type="text" name="tenaga_11_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.5</td><td>Sarjana Muda Hukum</td>
											<td><input type="text" name="tenaga_11_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.6</td><td>Sarjana Muda Tehnik</td>
											<td><input type="text" name="tenaga_11_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.7</td><td>Sarjana Muda Kes Sosial</td>
											<td><input type="text" name="tenaga_11_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.8</td><td>Sarjana Muda Statistik</td>
											<td><input type="text" name="tenaga_11_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_8[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.9</td><td>Sarjana Muda Komputer</td>
											<td><input type="text" name="tenaga_11_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_9[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_9[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.10</td><td>Sarjana Muda Sekretaris</td>
											<td><input type="text" name="tenaga_11_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_10[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_10[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">11.11</td><td>Sarjana Muda D3 Lainnya</td>
											<td><input type="text" name="tenaga_11_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_11[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_11_11[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12</td><td colspan="7">SMU Sederajat Lainnya</td></tr><tr></tr><tr><td align="center">12.1</td><td>SMA SMU</td>
											<td><input type="text" name="tenaga_12_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_1[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_1[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12.2</td><td>SMEA</td>
											<td><input type="text" name="tenaga_12_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_2[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_2[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12.3</td><td>STM</td>
											<td><input type="text" name="tenaga_12_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_3[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_3[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12.4</td><td>SMKK</td>
											<td><input type="text" name="tenaga_12_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_4[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_4[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12.5</td><td>SPSA</td>
											<td><input type="text" name="tenaga_12_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_5[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_5[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12.6</td><td>SMTP</td>
											<td><input type="text" name="tenaga_12_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_6[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_6[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12.7</td><td>SD kebawah</td>
											<td><input type="text" name="tenaga_12_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_7[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_7[]" class="textbox" size="10" value="0"></td></tr><tr><td align="center">12.8</td><td>SMTA Lainnya</td>
											<td><input type="text" name="tenaga_12_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_8[]" class="textbox" size="10" value="0"></td>
											<td><input type="text" name="tenaga_12_8[]" class="textbox" size="10" value="0"></td></tr>			</tbody>
			</table>

			<input type="button" name="simpan" value="Simpan" class="btn btn-primary" >
			</div>
		</div>
	</div>
</div>
@stop