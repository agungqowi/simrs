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
                            <a href="{{ url('report/laba_rugi_obat/'.$slug) }}">Laporan</a>
                        </li>
                        <li>
                            <a href="{{ url('report/laba_rugi_obat/'.$slug) }}">Laba Rugi</a>
                        </li>
                        <li>
                            Apotek {{ $title }}
                        </li>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Laba Rugi Apotek {{ $title }}
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/labaRugiObat_excel/'.$slug.'/xls') }}?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/labaRugiObat_excel/'.$slug.'/xlsx') }}?bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
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
									<h3>Laporan Laba Rugi Apotek {{ $title }}</h3>
									<div>
										<table>
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
										</table>
									</div><br /><br />
                                <table width="100%" border="1" class="report">
                                    <tr style="font-weight:bold;">
                                        <td colspan="7">PENDAPATAN DANA/ PENJUALAN OBAT</td>
                                    </tr>
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center">No</td>
                                        <td align="center">Nama Obat</td>
                                        <td align="center">Jenis Obat</td>
                                        <td align="center">Satuan</td>
										<td align="center">Jumlah</td>
                                        <td align="center">Harga Jual</td>
                                        <td align="center">Total</td>
                                    </tr>
									<?php $loop = 0; $no = 1; $total_keluar = 0; ?>
								@if(count($jual) > 0)
									@foreach($jual as $p)               
										<tr>
											<td>{{ $no }}</td>
											<td>{{ $p->namaobat }}</td>
											<td>{{ $p->namajenis }}</td>
											<td>{{ $p->satuan }}</td>
											<td align="right">{{ number_format($p->output_sum) }}</td>
											<td align="right">{{ number_format($p->harga) }}</td>
											<td align="right">{{ number_format($p->sub_keluar) }}</td>
										</tr>
										<?php $no++; 
										$total_keluar = $total_keluar + $p->sub_keluar;
										?>                                       
									@endforeach
								@else
									<tr>
										<td colspan="7" align="center"><h4>Tidak Ada Transaksi Penjualan</h4></td>
									</tr>
								@endif
                                    <tr style="background:#CCCCCC">
                                        <td colspan="6" align="right">Jumlah Total Penjualan</td>
										<td align="right">{{ number_format($total_keluar) }}</td>
                                    </tr>
                                </table>
								<br/>
                                <table width="100%" border="1" class="report">
                                    <tr style="font-weight:bold;">
                                        <td colspan="7">PENGELUARAN DANA/ PEMBELIAN OBAT</td>
                                    </tr>
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center">No</td>
                                        <td align="center">Nama Obat</td>
                                        <td align="center">Jenis Obat</td>
                                        <td align="center">Satuan</td>
										<td align="center">Jumlah</td>
                                        <td align="center">Harga Beli</td>
                                        <td align="center">Total</td>
                                    </tr>
									<?php $loop = 0; $no = 1; $total_masuk = 0; ?>
								@if(count($beli) > 0)
									@foreach($beli as $p)               
										<tr>
											<td>{{ $no }}</td>
											<td>{{ $p->namaobat }}</td>
											<td>{{ $p->namajenis }}</td>
											<td>{{ $p->satuan }}</td>
											<td align="right">{{ number_format($p->input_sum) }}</td>
											<td align="right">{{ number_format($p->hargabeli) }}</td>
											<td align="right">{{ number_format($p->sub_masuk) }}</td>
										</tr>
										<?php $no++; 
										$total_masuk = $total_masuk + $p->sub_masuk;
										?>                                       
									@endforeach
								@else
									<tr>
										<td colspan="7" align="center"><h4>Tidak Ada Transaksi Pembelian</h4></td>
									</tr>
								@endif
                                    <tr style="background:#CCCCCC">
                                        <td colspan="6" align="right">Jumlah Total Pembelian</td>
										<td align="right">{{ number_format($total_masuk) }}</td>
                                    </tr>
                                </table>
								<br/>
                                <table width="100%" border="1" class="report">
                                    <tr style="font-weight:bold;">
                                        <td >LABA BULAN {{ $nama_bulan }} {{ $tahun }}</td>
                                    </tr>
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td >PENJUALAN - PEMBELIAN : {{ number_format($total_keluar-$total_masuk) }}</td>
                                    </tr>
								</table>
								<br/>
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
