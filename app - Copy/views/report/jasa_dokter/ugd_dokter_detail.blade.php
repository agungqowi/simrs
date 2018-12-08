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
                        <h3 class="heading">Detail Laporan Jasa Dokter UGD
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                        </span>
						</h3>
						<div id="printarea">
							<div class="row-fluid">
								<div class="span12">
									<h3 align="center">Rumah Sakit Tentara
									</h3>
									<h4 align="center">{{ $rs_alamat }}</h4>
								</div>
							</div>
							<div class="row-fluid">
								<div class="span12">
									<table width="100%">
										<tr>
											<td width="11%"><b>Tanggal</b></td>
											<td><b>:</b></td>
											<td><b>{{ $mulai.' - '.$sampai }}</b></td>
										</tr>
										<tr>
											<td><b>Nama Dokter</b></td>
											<td><b>:</b></td>
											<td><b>{{ $jasa[0]->NamaDokter }}</b></td>
										</tr>
									</table>
								</div>
							</div>
							<br />
							<div class="row-fluid formSep">
								<div class="span12"> 
									<table width="100%" border="1" class="report">
										<tr style="background:#CCCCCC; font-weight:bold;">
												<td align="center" valign="middle">Tanggal</td>
												<td align="center" valign="middle">Nama</td>
												
												<td align="center" valign="middle">Klaim</td>
												<td align="center" valign="middle">Obat</td>
												<td align="center" valign="middle">Tindakan</td>
												<td align="center" valign="middle">Jasa Dokter</td>
											</tr>
											<?php $total_jasa = 0; ?>
											@foreach($jasa as $ja)
											<tr>
												<td>{{ $ja->Tanggal }}</td>
												<td>{{ $ja->Nama }}</td>
												
												<td align="right">{{ number_format($ja->Klaim) }}</td>
												<td align="right">{{ number_format($ja->Obat) }}</td>
												<td align="right">{{ number_format($ja->Tindakan) }}</td>
												<?php
													$selisih = $ja->Klaim - ($ja->Obat + $ja->Tindakan); 
													$jasa = (($selisih * 0.4) * 0.78) * 0.66;
												?>
												<td align="right">{{ $jasa < 0 ? '0' : number_format($jasa) }}</td>
												<?php $total_jasa += $jasa; ?>
											</tr>
											@endforeach
											<tr style="background:#CCCCCC; font-weight:bold;">
												<td colspan="5">Total Jasa Dokter</td>
												<td align="right">{{ $total_jasa < 0 ? '0' : number_format($total_jasa) }}</td>
											</tr>
									</table>
								</div>
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
