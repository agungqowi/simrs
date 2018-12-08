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
                        <li>
                            Cetak 
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Jasa Dokter Rawat Jalan ({{ $mulai.' - '.$sampai }})
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                        </span>
                        </h3>
							<div class="row-fluid" id="printarea">
								<div class="span12">
									
									<h3 align="center">{{ $rs_title }}</h3>
									<h4 align="center">{{ $rs_alamat }}</h4>
									<br />
									<h3>Laporan Jasa Dokter Rawat Jalan</h3>
									<div>
										<table>
											<tr>
												<td>Dari Tanggal</td>
												<td>:</td>
												<td>{{ $mulai }}</td>
											</tr>
											<tr>
												<td>Sampai Tanggal</td>
												<td>:</td>
												<td>{{ $sampai }}</td>
											</tr>
										</table>
									</div><br />
									<table width="100%" border="1" class="report">
										<tr style="background:#CCCCCC; font-weight:bold;">
											<td align="center">No</td>
											<td style="text-align: center;">Tanggal</td>
											<td style="text-align: center;">Total Klaim</td>
											<td style="text-align: center;">Total Biaya Obat</td>
											<td style="text-align: center;">Total Biaya Tindakan</td>
											<td style="text-align: center;">Selisih</td>
										</tr>
									<?php $loop = 0?>
									@foreach($jasa as $ja)                                    
									<?php $loop++; 
										  $date = DateTime::createFromFormat('Y-m-d', $ja->Tanggal);
										  $tanggal = $date->format('d/m/Y');
									?>
										<tr>
											<td>{{ $loop }}</td>
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
										<tr style="background:#CCCCCC">
											<td colspan="10">Jumlah Hari : {{ number_format($loop) }}</td>
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
