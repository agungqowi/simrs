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
                            <a href="{{ url('report/jasa_dokter/rawat_jalan') }}">Laporan Jasa Dokter</a>
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
											<td align="center">Tanggal</td>
											<td align="center">Nama</td>
											<td align="center">Poli</td>
											<td align="center">Diagnosis</td>
											<td align="center">Dokter</td>
											<td align="center">Klaim</td>
											<td align="center">Biaya Obat</td>
											<td align="center">Biaya Tindakan</td>
											<td align="center">Jasa Dokter</td>
										</tr>
									<?php $loop = 0?>
									@foreach($jasa as $p)                                    
									<?php $loop++; ?>
										<tr>
											<td>{{ $loop }}</td>
											<td>{{ $p->Tanggal }}</td>
											<td>{{ $p->Nama }}</td>
											<td>{{ $p->Poli }}</td>
											<td>{{ $p->Diagnosis }}</td>
											<td>{{ $p->Dokter }}</td>
											<td align="right">{{ number_format($p->Klaim) }}</td>
											<td align="right">{{ number_format($p->Obat) }}</td>
											<td align="right">{{ number_format($p->Tindakan) }}</td>
											<?php
												$selisih = $p->Klaim - ($p->Obat + $p->Tindakan); 
												$jasa = (($selisih * 0.4) * 0.78) * 0.66;
											?>
											<td align="right">{{ $jasa < 0 ? '0' : number_format($jasa) }}</td>
										</tr>
									@endforeach
										<tr style="background:#CCCCCC">
											<td colspan="10">Jumlah Pasien : {{ number_format($loop) }}</td>
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
