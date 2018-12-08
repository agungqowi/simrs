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
                            <a href="{{ url('report/jasa_dokter/rawat_inap_dokter') }}">Laporan Jasa Dokter</a>
                        </li>
                        <li>
                            Rawat Inap
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Jasa Dokter Rawat Inap ({{ $mulai.' - '.$sampai }})
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
									<h3>Laporan Jasa Dokter Rawat Inap</h3>
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
											<td align="center" valign="middle" class="head0">No</td>
											<td align="center" valign="middle" class="head0">Nama Dokter</td>
											<td align="center" valign="middle" class="head1">Total Klaim</td>
											<td align="center" valign="middle" class="head2">Total Biaya Obat</td>
											<td align="center" valign="middle" class="head3">Total Biaya Tindakan</td>
											<td align="center" valign="middle" class="head4">Total Jasa Dokter</td>
										</tr>
										<?php $tot_klaim=0; $tot_obat=0; $tot_tind=0; $no=0;?>
										@foreach($dokter as $dok)
											<?php $tot_klaim=0; $tot_obat=0; $tot_tind=0; $no++;?>
										<tr>
											<td>{{ $no }}</td>
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
										</tr>
										@endforeach
										<tr style="background:#CCCCCC">
											<td colspan="6">Jumlah Dokter : {{ $no }}</td>
										</tr>
								</table>
								<br />
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
