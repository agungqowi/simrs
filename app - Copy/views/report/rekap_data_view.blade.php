@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
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
                            <a href="{{ url('report/rekap_data') }}">Rekap Data</a>
                        </li>
                        <li>
                            Pasien Masuk RS
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Rekap Data Pasien Masuk RS
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/rekap_data_excel/Excel5') }}?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/rekap_data_excel/Excel2007') }}?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span>
                        </h3>
                        @if( $errors->first('title') || $errors->first('note') )
                            <div class="alert alert-error">
                                <a class="close" data-dismiss="alert">×</a>
                                {{ $errors->first('title') }}
                                {{ $errors->first('note') }}
                            </div>
                        @endif

                        <div class="row-fluid" id="printarea">
                            <div class="span12">
                                
                                <h3 align="center">{{ $rs_title }}</h3>
                                <h4 align="center">{{ $rs_alamat }}</h4>
                                <br />
								<h4>Laporan Rekap Data Pasien Masuk RS
								<table>
								@if($bulan==0)
									@if($tahun==0)
									@else
									<tr>
										<td>Tahun</td>
										<td>:</td>
										<td>{{ $tahun }}</td>
									</tr>
									@endif
								@elseif($tahun==0)
									<tr>
										<td>Bulan</td>
										<td>:</td>
										<td>{{ $nama_bulan }}</td>
									</tr>
									<tr>
										<td>Tahun</td>
										<td>:</td>
										<td>Semua Tahun</td>
									</tr>
								@else
									<tr>
										<td>Bulan</td>
										<td>:</td>
										<td>{{ $nama_bulan }}</td>
									</tr>
									<tr>
										<td>Tahun</td>
										<td>:</td>
										<td>{{ $tahun }}</td>
									</tr>
								@endif
								</table>
								</h4>
                                <br />
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center" valign="middle">No</td>
                                        <td align="center" valign="middle">Golongan Pasien</td>
                                        <td align="center" valign="middle">Sub Golongan Pasien</td>
                                        <td align="center" valign="middle">Jumlah Pasien</td>
                                    </tr>
									@foreach($rekap as $pas => $ien)
										@if($ien->GolPasien == $golpas)
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>{{ $ien->SubGolPasien }}</td>
												<td align="right">{{ $ien->jumlah }}</td>
											</tr>
										@else
										<?php $num++; ?>
											<tr>
												<td align="center">{{ $num }}</td>
												<td>{{ $ien->GolPasien }}</td>
												<td>{{ $ien->SubGolPasien }}</td>
												<td align="right">{{ $ien->jumlah }}</td>
											</tr>
										@endif
										<?php 	$total = $total + $ien->jumlah;
												$golpas = $ien->GolPasien; ?>
									@endforeach
										<tr style="background:#CCCCCC; font-weight:bold;">
											<td colspan="4">Jumlah Total Pasien : {{ number_format($total) }}</td>
										</tr>
									</table>
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
    {{ HTML::script('js/jquery.printElement.min.js') }}
    <script type="text/javascript">


        function do_print(){
            var css = "";
            $('link').each(function(){
                css += '<link media="all" type="text/css" rel="stylesheet" href="' + $(this).attr('href') + '">';
            })
            w=window.open(null, 'Print_Page', 'scrollbars=yes');
            w.document.write( css + $('#printarea').html() );
            w.document.close();
            
            setInterval(function () { w.print(); }, 1000);
        }
    </script>
@stop
