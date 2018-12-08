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
				<h3 class="heading">RL 4A Penyakit Rawat Inap<span style="float:right;">
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

				<table cellspacing="1" class="table table-striped table-bordered" cellpadding="1">
  <tbody><tr>
    <th width="55" rowspan="5">NOURUT</th>
    <th width="49" rowspan="5">NODTD</th>
    <th width="148" rowspan="5">NO.DAFTARTERPERINCI</th>
    <th width="174" rowspan="5">GOLONGAN SEBAB-SEBAB SAKIT</th>
    <th colspan="8" rowspan="3">PASIEN KELUAR (HIDUP &amp;&nbsp; MATI) MENURUT GOLONGAN UMUR</th>
    <th colspan="2">PASIEN KEL</th>
    <th width="55">&nbsp;</th>
    <th width="58">JML</th>
  </tr>
  <tr>
    <th colspan="2">(H &amp; M) ME-</th>
    <th width="55">JML</th>
    <th width="58">PASIEN</th>
  </tr>
  <tr>
    <th colspan="2">NURUT SEX</th>
    <th width="55">PASIEN</th>
    <th width="58">KEL.</th>
  </tr>
  <tr>
    <th width="28">0-28</th>
    <th width="38">28 HR-</th>
    <th width="26">1-4</th>
    <th width="26">5-14</th>
    <th width="30">15-24</th>
    <th width="30">25-44</th>
    <th width="30">45-64</th>
    <th width="32">65+</th>
    <th width="45">&nbsp;</th>
    <th width="27">&nbsp;</th>
    <th width="55">KELUAR</th>
    <th width="58">MATI</th>
  </tr>
  <tr>
    <th width="28">HR</th>
    <th width="38">&lt;1TH</th>
    <th width="26">TH</th>
    <th width="26">TH</th>
    <th width="30">TH</th>
    <th width="30">TH</th>
    <th width="30">TH</th>
    <th width="32">TH</th>
    <th width="45">LK</th>
    <th width="27">PR</th>
    <th width="55">(13+14)</th>
    <th width="58">&nbsp;</th>
  </tr>
  <tr>
    <th width="55">1</th>
    <th width="49">2</th>
    <th width="148">3</th>
    <th width="174">4</th>
    <th width="28">5</th>
    <th width="38">6</th>
    <th width="26">7</th>
    <th width="26">8</th>
    <th width="30">9</th>
    <th width="30">10</th>
    <th width="30">11</th>
    <th width="32">12</th>
    <th width="45">13</th>
    <th width="27">14</th>
    <th width="55">15</th>
    <th width="58">16</th>
  </tr></tbody></table>
			</div>
		</div>
	</div>
</div>
@stop