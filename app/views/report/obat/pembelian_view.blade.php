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
                            <a href="{{ url('report/distribusi_obat/'.$slug) }}">Laporan</a>
                        </li>
                        <li>
                            <a href="{{ url('report/distribusi_obat/'.$slug) }}">Pembelian Obat & Alkes</a>
                        </li>
                        <li>
                            {{ $title }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Pembelian Obat & Alkes
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
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
						@if(count($data) > 0)
							<div class="row-fluid" id="printarea">
								<div class="span12">
									<h3 align="center">{{ $rs_title }}</h3>
                                	<h4 align="center">{{ $rs_alamat }}</h4>
									<br />
									<h3>Laporan  Pembelian Obat & Alkes</h3>
									<div>
										<table>
											<tr>
												<td>Dari Tanggal</td>
												<td>:</td>
												<td>{{ $dari_tanggal }}</td>
											</tr>
											<tr>
												<td>Sampai Tanggal</td>
												<td>:</td>
												<td>{{ $sampai_tanggal }}</td>
											</tr>

										</table>
									</div><br />
									<table width="100%" border="1" class="report">
										<tr style="background:#CCCCCC; font-weight:bold;">
											<td align="center">No</td>
											<td align="center">Tanggal</td>
											<td align="center">Obat / Alkes</td>
                                            <td align="center">Supplier</td>
                                            <td align="center">Pembayaran</td>
											<td align="center">Harga Beli</td>
                                            <td align="center">Jumlah</td>
                                            <td align="center">PPN</td>
                                            <td align="center">Diskon</td>
											<td align="center">Total</td>
										</tr>
									<?php $loop = 0;$total_all = 0;$total_supp=0;?>
									@foreach($data as $p)                                    
									<?php $loop++; ?>
                                        <?php $total = ( floatval($p->hargabeli) * intval($p->jumlah) ) + floatval($p->ppn) - floatval($p->diskon); ?>
										<?php $total_all = $total_all + $total ; ?>
                                        <tr>
											<td>{{ $loop }}</td>
											<td>{{ $p->tgl }}</td>
											<td>{{ $p->namaobat }}</td>
                                            <td>{{ $p->namasupp }}</td>
											<td>{{ $p->jenis_pembayaran }}</td>
											<td align="right">{{ number_format( $p->hargabeli ) }}</td>
                                            <td align="right">{{ number_format( $p->jumlah ) }}</td>
                                            <td align="right">{{ number_format( $p->ppn ) }}</td>
                                            <td align="right">{{ number_format( $p->diskon ) }}</td>
                                            <td align="right">{{ number_format( $total ) }}</td>
										</tr>
									@endforeach
										<tr style="background:#CCCCCC">
											<td align="right" colspan="10">Jumlah : {{ number_format($total_all) }}</td>
										</tr>
									</table>
								</div>
							</div>
                        @else
                            <h3>Data tidak ditemukan</h3>
                        @endif
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
