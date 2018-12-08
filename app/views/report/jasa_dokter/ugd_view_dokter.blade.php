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
		#tbl_pasien td:nth-child(2), td:nth-child(3), td:nth-child(4), td:nth-child(5) {
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
                            <a href="{{ url('report/jasa_dokter/ugd_dokter') }}">Laporan Jasa Dokter</a>
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
                            <a href="{{ url('report/jasa_dokter_print/ugd_dokter') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/jasa_dokter_excel/ugd_dokter/Excel5') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/jasa_dokter_excel/ugd_dokter/Excel2007') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
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
									<thead>
										<tr>
											<th align="center" valign="middle" class="head0">Nama Dokter</th>
											<th align="center" valign="middle" class="head1">Total Klaim</th>
											<th align="center" valign="middle" class="head2">Total Biaya Obat</th>
											<th align="center" valign="middle" class="head3">Total Biaya Tindakan</th>
											<th align="center" valign="middle" class="head4">Total Jasa Dokter</th>
											<th align="center" valign="middle" class="head5">Detail</th>
										</tr>
									</thead>
									<tbody>
										<?php $tot_klaim=0; $tot_obat=0; $tot_tind=0;?>
										@foreach($dokter as $dok)
											<?php $tot_klaim=0; $tot_obat=0; $tot_tind=0;?>
										<tr>
											<td>{{ $dok->NamaDokter }}</td>
											@foreach($jasa as $ja)
												@if($ja->IdDokter == $dok->IdDokter)
												<?php
													$tot_klaim += $ja->Klaim;
													$tot_obat += $ja->Obat;
													$tot_tind += $ja->Tindakan;
												?>
												@endif
											@endforeach
											<td align="right">{{ number_format($tot_klaim) }}</td>
											<td align="right">{{ number_format($tot_obat) }}</td>
											<td align="right">{{ number_format($tot_tind) }}</td>
											<?php
												$selisih = $tot_klaim-($tot_obat+$tot_tind); 
												$jasa_dokter = (($selisih * 0.4) * 0.78) * 0.66;
											?>
											<td align="right">{{ $jasa_dokter < 0 ? '0' : number_format($jasa_dokter) }}</td>
											<td><a onclick="detail_jasa('{{ $dok->IdDokter }}')" href="javascript:void(0)"><i class="splashy-zoom"></i></a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<script type="text/javascript">
									$(document).ready(function(){						
										$('#tbl_pasien').dataTable({
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

		function detail_jasa(iddok){
			window.open("{{ url('report/jasa_dokter_detail/ugd_dokter') }}/"+iddok+"?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}", "_blank");
		}
    </script>
@stop
