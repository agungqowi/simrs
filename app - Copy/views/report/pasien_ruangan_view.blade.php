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
                            <a href="{{ url('report/pasien_ruangan') }}">Laporan</a>
                        </li>
                        <li>
                            Pasien Rawat Inap
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Pasien Rawat Inap
                        <span style="float:right;">
                            <a target="_BLANK" href="{{ url('report/pasien_ruangan_print') }}?ruangan={{ $ruangan }}" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a target="_BLANK" href="{{ url('report/pasien_ruangan_excel/xls') }}?ruangan={{ $ruangan }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a target="_BLANK" href="{{ url('report/pasien_ruangan_excel/xlsx') }}?ruangan={{ $ruangan }}" class="btn btn-primary">
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
                        @if(count($pasien) > 0)
                            <div class="span12">
                                
                                <h3 align="center">{{ $rs_title }}</h3>
                                <h4 align="center">{{ $rs_alamat }}</h4>
                                <br />
                                <h3>Laporan Pasien di Ruangan</h3><br />
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr>
                                        <td>No</td>
										<td>No RM</td>
                                        <td>Nama</td>
                                        <td>Gol Pasien</td>
                                        <td>Tanggal Masuk</td>
                                        <td>Jam Masuk</td>
                                        <td>Ruangan</td>
                                    </tr>
                                <?php $loop = 0;$cpoli=""; $no=0;?>
                                @foreach($pasien as $p)
                                    @if($cpoli!=$p->Ruangan)
                                        @if($loop == 0)
                                            <tr style="background:#CCCCCC">
                                                <td colspan="7" style="background:#CCCCCC">Ruangan : {{ $p->Ruangan }}</td>
                                            </tr>
                                        @else
                                            <tr style="background:#CCCCCC">
                                                <td colspan="7" style="background:#CCCCCC">Jumlah Pasien : {{ number_format($loop) }}</td>
                                            </tr>
                                            <tr style="background:#CCCCCC">
                                                <td colspan="7" style="background:#CCCCCC">Ruangan : {{ $p->Ruangan }}</td>
                                            </tr>
                                            <?php $loop = 0 ; $no=0;?>
                                        @endif

                                        <?php $cpoli = $p->Ruangan; ?>
                                    @endif                              
                                    	<?php $no++; ?>
									<tr>
                                        <td>{{ $no }}</td>
										<td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->CaraBayar }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                        <td>{{ $p->Jam }}</td>
                                        <td>{{ $p->Ruangan }}</td>
                                    </tr>
                                    <?php $loop++; ?>                                       
                                @endforeach

                                    <tr style="background:#CCCCCC">
                                        <td colspan="7" style="background:#CCCCCC">Jumlah Pasien : {{ number_format($loop) }}</td>
                                    </tr>
                                    <tr style="background:#CCCCCC">
                                        <td colspan="7" style="background:#CCCCCC"><b>Total Seluruh Pasien : {{ count($pasien) }}</b></td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <h3>Data tidak ditemukan</h3>
                        @endif
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
