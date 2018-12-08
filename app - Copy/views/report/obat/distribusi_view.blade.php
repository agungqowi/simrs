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
                            <a href="{{ url('report/distribusi_obat/'.$slug) }}">Distribusi Obat</a>
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
                        <h3 class="heading">Laporan Distribusi Obat & Alkes
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
									<h3>Laporan  Distribusi Obat & Alkes</h3>
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
											<td align="center">Obat</td>
											<td align="center">Tujuan</td>
											<td align="center">Jumlah</td>
										</tr>
									<?php $loop = 0?>
									@foreach($data as $p)                                    
									<?php $loop++; ?>
										<tr>
											<td>{{ $loop }}</td>
											<td>{{ $p->tgl }}</td>
											<td>{{ $p->namaobat }}</td>
											<td>{{ $p->ke }}</td>
											<td align="right">{{ $p->jumlah }}</td>
										</tr>
									@endforeach
										<tr style="background:#CCCCCC">
											<td colspan="5">Jumlah : {{ number_format($loop) }}</td>
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
