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
                            <a href="{{ url('report/penyakit') }}">Penyakit</a>
                        </li>
                        <li>
                            Pasien
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Penyakit Pasien
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/penyakit_excel/xls') }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/penyakit_excel/xlsx') }}" class="btn btn-primary">
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
                                <h3>Laporan {{ $take }} Penyakit Pasien Teratas</h3>
                                <br />
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center">No</td>
                                        <td align="center">Id Diagnosis</td>
                                        <td align="center">Nama Dignosis</td>
                                        <td align="center">Keterangan</td>
                                        <td align="center">Jumlah</td>
                                    </tr>
								<?php $loop = 0?>
                                @foreach($penyakit as $p)                                    
                                <?php $loop++; ?>
								    <tr>
                                        <td>{{ $loop }}</td>
                                        <td>{{ $p->IdDiag }}</td>
                                        <td>{{ $p->ShortDiagnoisDesc }}</td>
                                        <td>{{ $p->LongDiagnosisDesc }}</td>
                                        <td>{{ $p->jumlah }}</td>
                                    </tr>
                                @endforeach
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
