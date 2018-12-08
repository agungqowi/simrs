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
                            <a href="{{ url('report/keluar_masuk_obat/'.$slug) }}">Laporan</a>
                        </li>
                        <li>
                            <a href="{{ url('report/keluar_masuk_obat/'.$slug) }}">{{ $subtitle }}</a>
                        </li>
                        <li>
                            Apotek {{ $title }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan {{ $subtitle }} Apotek {{ $title }}
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
						@if(count($pasien) > 0)
							<div class="row-fluid" id="printarea">
								<div class="span12">
									<h3 align="center">{{ $rs_title }}</h3>
									<br />
									<h3>Laporan {{ $subtitle }} Apotek {{ $title }}</h3>
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
											<tr>
												<td>Kode Obat</td>
												<td>:</td>
												<td>{{ $obat->kodobat }}</td>
											</tr>
											<tr>
												<td>Nama Obat</td>
												<td>:</td>
												<td>{{ $obat->namaobat }}</td>
											</tr>
											<tr>
												<td>Satuan</td>
												<td>:</td>
												<td>{{ $obat->satuan }}</td>
											</tr>

										</table>
									</div><br />
									<table width="100%" border="1" class="report">
										<tr style="background:#CCCCCC; font-weight:bold;">
											<td align="center">No</td>
											<td align="center">Tanggal</td>
											@if($trx=='1')
											<td align="center">NoBA</td>
											@elseif($trx=='2')
											<td align="center">NoPPM</td>
											<td align="center">NoBP</td>
											@else
											<td align="center">NoBA</td>
											<td align="center">NoPPM</td>
											<td align="center">NoBP</td>
											@endif 
											<td align="center">{{ $from }}</td>
											@if($trx=='1')
											<td align="center">Jumlah Masuk</td>
											@elseif($trx=='2')
											<td align="center">Jumlah Keluar</td>
											@else
											<td align="center">Jumlah Masuk</td>
											<td align="center">Jumlah Keluar</td>
											@endif 
											<td align="center">Stok</td>
										</tr>
									<?php $loop = 0?>
									@foreach($pasien as $p)                                    
									<?php $loop++; ?>
										<tr>
											<td>{{ $loop }}</td>
											<td>{{ $p->tanggal }}</td>
											@if($trx=='1')
											<td>{{ $p->noba }}</td>
											@elseif($trx=='2')
											<td>{{ $p->noppm }}</td>
											<td>{{ $p->nobp }}</td>
											@else
											<td>{{ $p->noba }}</td>
											<td>{{ $p->noppm }}</td>
											<td>{{ $p->nobp }}</td>
											@endif 
											@if($p->namasupp)
											<td>{{ $p->namasupp }}</td>
											@else
											<td>{{ $p->dariuntuk }}</td>
											@endif 
											@if($trx=='1')
											<td align="right">{{ $p->masuk }}</td>
											@elseif($trx=='2')
											<td align="right">{{ $p->keluar }}</td>
											@else
											<td align="right">{{ $p->masuk }}</td>
											<td align="right">{{ $p->keluar }}</td>
											@endif 
											<td align="right">{{ $p->sisa }}</td>
										</tr>
									@endforeach
										<tr style="background:#CCCCCC">
											<td colspan="11">Jumlah Obat : {{ number_format($loop) }}</td>
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
