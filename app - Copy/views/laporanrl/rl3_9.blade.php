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
			<h3 class="heading">RL 3.9 Pelayanan Rehab Medik<span style="float:right;">
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
				<tr><th>NO</th><th>JENIS TINDAKAN</th><th>JUMLAH</th><th>NO</th><th>JENIS TINDAKAN</th><th>JUMLAH</th></tr>
			</thead>
			<tbody>
				<tr><td>1</td><td>Medis</td><td>&nbsp;</td><td>3.6</td><td>Analisa Persiapan Kerja</td><td>&nbsp;</td></tr>
				<tr><td>1.1</td><td>Gait Analyzer</td><td>&nbsp;</td><td>3.7</td><td>Latihan Relaksasi</td><td>&nbsp;</td></tr>
				<tr><td>1.2</td><td>E M G</td><td>&nbsp;</td><td>3.8</td><td>Analisa &amp; Intervensi, Persepsi, Kognitif, Psikomotor</td><td>&nbsp;</td></tr>
				<tr><td>1.3</td><td>Uro Dinamic</td><td>&nbsp;</td><td>3.9</td><td>Lain Lain</td><td>&nbsp;</td></tr>
				<tr><td>1.4</td><td>Side Back</td><td>&nbsp;</td><td>4</td><td>Terapi Wicara</td><td>&nbsp;</td></tr>
				<tr><td>1.5</td><td>E N Tree</td><td>&nbsp;</td><td>4.1</td><td>Fungsi Bicara</td><td>&nbsp;</td></tr>
				<tr><td>1.6</td><td>Spyrometer</td><td>&nbsp;</td><td>4.2</td><td>Fungsi Bahasa / Laku</td><td>&nbsp;</td></tr>
				<tr><td>1.7</td><td>Static Bicycle</td><td>&nbsp;</td><td>4.3</td><td>Fungsi Menelan</td><td>&nbsp;</td></tr>
				<tr><td>1.8</td><td>Tread Mill</td><td>&nbsp;</td><td>4.4</td><td>Lain Lain</td><td>&nbsp;</td></tr>
				<tr><td>1.9</td><td>Body Platysmograf</td><td>&nbsp;</td><td>5</td><td>Psikologi</td><td>&nbsp;</td></tr>
				<tr><td>1.10</td><td>Lain Lain</td><td>&nbsp;</td><td>5.1</td><td>Psikolog Anak</td><td>&nbsp;</td></tr>
				<tr><td>2</td><td>Fisioterapi</td><td>&nbsp;</td><td>5.2</td><td>Psikolog Dewasa</td><td>&nbsp;</td></tr>
				<tr><td>2.1</td><td>Latihan Fisik</td><td>&nbsp;</td><td>5.3</td><td>Lain Lain</td><td>&nbsp;</td></tr>
				<tr><td>2.2</td><td>Aktinoterapi</td><td>&nbsp;</td><td>6</td><td>Sosial Medis</td><td>&nbsp;</td></tr>
				<tr><td>2.3</td><td>Elektroterapi</td><td>&nbsp;</td><td>6.1</td><td>Evaluasi Lingkungan Rumah</td><td>&nbsp;</td></tr>
				<tr><td>2.4</td><td>Hidroterapi</td><td>&nbsp;</td><td>6.2</td><td>Evaluasi Ekonomi</td><td>&nbsp;</td></tr>
				<tr><td>2.5</td><td>Traksi Lumbal &amp; Cervical</td><td>&nbsp;</td><td>6.3</td><td>Evaluasi Pekerjaan</td><td>&nbsp;</td></tr>
				<tr><td>2.6</td><td>Lain-Lain</td><td>&nbsp;</td><td>6.4</td><td>Lain-lain</td><td>&nbsp;</td></tr>
				<tr><td>3</td><td>Okupasiterapi</td><td>&nbsp;</td><td>7</td><td>Ortotik Prostetik</td><td>&nbsp;</td></tr>
				<tr><td>3.1</td><td>Snoosien Room</td><td>&nbsp;</td><td>7.1</td><td>Pembuatan  Alat Bantu</td><td>&nbsp;</td></tr>
				<tr><td>3.2</td><td>Sensori Integrasi</td><td>&nbsp;</td><td>7.2</td><td>Pembuatan Alat Anggota Tiruan</td><td>&nbsp;</td></tr>
				<tr><td>3.3</td><td>Latihan aktivitas kehidupan sehari-hari</td><td>&nbsp;</td><td>7.3</td><td>Lain-Lain</td><td>&nbsp;</td></tr>
				<tr><td>3.4</td><td>Proper Body Mekanik</td><td>&nbsp;</td><td>8</td><td>Kunjungan Rumah</td><td>&nbsp;</td></tr>
				<tr><td>3.5</td><td>Pembuatan Alat Lontar &amp; Adaptasi Alat</td><td>&nbsp;</td><td>99</td><td>TOTAL</td><td>&nbsp;</td></tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@stop