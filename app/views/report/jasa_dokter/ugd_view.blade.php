@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
	<style>
		#tbl_pasien th, td:nth-child(6) {
			text-align: center;
			vertical-align:middle;
		}
		#tbl_pasien td:nth-child(4), td:nth-child(5) {
			text-align: right;
			vertical-align:middle;
		}
	</style>
@stop

@section('content')
    <div id="contentwrapper">
        <div class="main_content">
            <nav>
                <div id="jCrumbs" class="breadCrumb module">
                    <ul>
                        <li>
                            <a href="{{ action('DashboardController@index') }}"><i class="icon-home"></i></a>
                        </li>
                        <li>
                            <a href="{{ url('report/jasa_dokter/ugd') }}">Laporan Jasa Dokter</a>
                        </li>
                        <li>
                            UGD
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Jasa Dokter UGD ({{ $mulai.' - '.$sampai }})
                        <span style="float:right;">
                            <a href="{{ url('report/jasa_dokter_print/ugd') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/jasa_dokter_excel/ugd/xls') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/jasa_dokter_excel/ugd/xlsx') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span>
                        </h3>
                        <div class="row-fluid">
                            <div class="span12">
                                
                            </div>
                        </div>
                        <br />
                        <div class="row-fluid formSep">
                            <div class="span12"> 
							   <table id="tbl_pasien" class="table table-striped table-bordered table-hover">
									<colgroup>
										<col class="con0" />
										<col class="con1" />
										<col class="con2" />
										<col class="con3" />
										<col class="con4" />
										<col class="con5" />
										
									</colgroup>
									<thead>
										<tr>
											<th align="center" valign="middle" class="head0">Tanggal</th>
											<th align="center" valign="middle" class="head1">Nama</th>
											
											<th align="center" valign="middle" class="head3">Dokter</th>
											<th align="center" valign="middle" class="head4">Klaim</th>
											<th align="center" valign="middle" class="head5">Jasa Dokter</th>
											<th align="center" valign="middle" class="head6">Detail</th>
										</tr>
									</thead>
									<tbody>
										@foreach($jasa as $ja)
										<tr>
											<td>{{ $ja->Tanggal }}</td>
											<td>{{ $ja->Nama }}</td>
											
											<td>{{ $ja->NamaDokter }}</td>
											<td align="right">{{ number_format($ja->Klaim) }}</td>
											<?php
												$selisih = $ja->Klaim - ($ja->Obat + $ja->Tindakan); 
												$jasa = (($selisih * 0.4) * 0.78) * 0.66;
											?>
											<td align="right">{{ $jasa < 0 ? '0' : number_format($jasa) }}</td>
											<td><a onclick="detail_jasa('{{ $ja->NoRegUGD }}')" href="javascript:void(0)"><i class="splashy-zoom"></i></a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<script type="text/javascript">
									$(document).ready(function(){						
										oTable = $('#tbl_pasien').dataTable({
											"sPaginationType": "full_numbers"
										});
									});									
								</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
        });

		function detail_jasa(noreg){
			window.open("{{ url('report/jasa_dokter_detail/ugd') }}/"+noreg, "_blank");
		}
    </script>
@stop
