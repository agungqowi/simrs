@extends('layout')

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
                            <a href="{{ url('report/jasa_dokter/rawat_jalan_tanggal') }}">Laporan Jasa Dokter</a>
                        </li>
                        <li>
                            Rawat Jalan
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Jasa Dokter Rawat Jalan ({{ $mulai.' - '.$sampai }})
                        <span style="float:right;">
                            <a href="{{ url('report/jasa_dokter_print/rawat_jalan_tanggal') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/jasa_dokter_excel/rawat_jalan_tanggal/xls') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/jasa_dokter_excel/rawat_jalan_tanggal/xlsx') }}?dari_tanggal={{ $mulai }}&sampai_tanggal={{ $sampai }}" class="btn btn-primary">
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
							   <table class="table table-striped table-bordered table-hover">
										<tr>
											<td style="text-align: center;"><b>Tanggal</b></td>
											<td style="text-align: center;"><b>Total Klaim</b></td>
											<td style="text-align: center;"><b>Total Biaya Obat</b></td>
											<td style="text-align: center;"><b>Total Biaya Tindakan</b></td>
											<td style="text-align: center;"><b>Selisih</b></td>
										</tr>
										@foreach($jasa as $ja)
										<tr>
											<?php
												$date = DateTime::createFromFormat('Y-m-d', $ja->Tanggal);
												$tanggal = $date->format('d/m/Y');
											?>
											<td style="text-align: center;">{{ $tanggal }}</td>
											<td style="text-align: right;">{{ number_format($ja->Klaim) }}</td>
											<td style="text-align: right;">{{ number_format($ja->Obat) }}</td>
											<td style="text-align: right;">{{ number_format($ja->Tindakan) }}</td>
											<?php
												$selisih = $ja->Klaim - ($ja->Obat + $ja->Tindakan); 
											?>
											<td style="text-align: right;">{{ $selisih < 0 ? '0' : number_format($selisih) }}</td>
										</tr>
										@endforeach
								</table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
