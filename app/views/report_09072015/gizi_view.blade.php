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
                            <a href="{{ url('report/gizi') }}">Laporan</a>
                        </li>
                        <li>
                            Unit Gizi
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Unit Gizi
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/gizi_excel/xls') }}?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/gizi_excel/xlsx') }}?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
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
								<h4>Laporan Unit Gizi
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
                                        <td align="center" valign="middle">No RM</td>
                                        <td align="center" valign="middle">Nama</td>
                                        <td align="center" valign="middle">Gol Pasien</td>
                                        <td align="center" valign="middle">Ruangan</td>
                                        <td align="center" valign="middle">Kelas/ No Kamar</td>
                                        <td align="center" valign="middle">Tanggal Masuk</td>
                                        <td align="center" valign="middle">Jam Masuk</td>
                                        <td align="center" valign="middle">Tanggal Keluar</td>
                                        <td align="center" valign="middle">Jam Keluar</td>
                                        <td align="center" valign="middle">Lama (Hari)</td>
                                        <td align="center" valign="middle">Makan/ Hari</td>
                                        <td align="center" valign="middle">Total</td>
                                    </tr>
									@foreach($rekap as $pas => $ien)
										<?php $no++; ?>
											<tr>
												<td align="center">{{ $no }}</td>
												<td>{{ $ien->NoRM }}</td>
												<td>{{ $ien->Nama }}</td>
												<td>{{ $ien->GolPasien }}/ {{ $ien->SubGolPasien }}</td>
												<td>{{ $ien->Ruangan }}</td>
												<td>{{ $ien->Kelas }}/ {{ $ien->NoKamar }}</td>
												<td>{{ $ien->Tanggal }}</td>
												<td>{{ $ien->JamMasuk }}</td>
												<td>{{ $ien->TanggalPulang }}</td>
												<td>{{ $ien->JamPulang }}</td>
												<td>{{ $ien->Lama }}</td>
												<td align="right">{{ number_format($ien->BiayaMakan) }}</td>
												<td align="right">{{ number_format($ien->total) }}</td>
											</tr>
									@endforeach
										<tr style="background:#CCCCCC; font-weight:bold;">
											<td colspan="13">Jumlah Total Pasien : {{ $no }}</td>
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
