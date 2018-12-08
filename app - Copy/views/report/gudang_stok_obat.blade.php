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
                            <a href="{{ url('report/stok_obat/'.$slug) }}">Laporan</a>
                        </li>
                        <li>
                            <a href="{{ url('report/stok_obat/'.$slug) }}">Stok Obat</a>
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
                        <h3 class="heading">Laporan Stok Obat Gudang
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <div style="display: none;">
                                <a href="{{ url('report/stokObat_excel/'.$slug.'/xls') }}" class="btn btn-primary">
                                    <i class="splashy-calendar_week_add"></i> Excel 2003
                                </a>
                                <a href="{{ url('report/stokObat_excel/'.$slug.'/xlsx') }}" class="btn btn-primary">
                                    <i class="splashy-calendar_week_add"></i> Excel 2007
                                </a>
                            </div>
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
                                <h3>Laporan Stok Obat {{ $title }}</h3>
                                <br />
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center">No</td>
                                        <td align="center">Nama Obat</td>
                                        <td align="center">Komposisi</td>
                                        <td align="center">Satuan</td>
                                        <td align="center">Harga Beli</td>
                                        <td align="center">Stok</td>
                                        <td align="center">Total</td>
                                    </tr>
								<?php $loop = 0; $total_obat=0;?>
                                @foreach($stok_obat as $p)
                                    @if($p->stok_obat > 0 )                                 
                                        <?php $loop++; $total = floatVal($p->harga_tampil) * floatval($p->stok_obat); 
                                            $total_obat = $total_obat + $total; ?>
    								    <tr>
                                            <td>{{ $loop }}</td>
                                            <td>{{ $p->namaobat }}</td>
                                            <td>{{ $p->komposisi }}</td>
                                            <td>{{ $p->satuan }}</td>
                                            <td align="right">{{ number_format($p->harga_tampil) }}</td>
                                            <td align="right">{{ $p->stok_obat }}</td>
                                            <td align="right">{{ number_format($total) }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                    <tr style="background:#CCCCCC">
                                        <td colspan="6">Total</td>
                                        <td align="right">{{ number_format($total_obat) }}</td>
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
