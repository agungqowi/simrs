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
                            <a href="{{ url('report/rawat_jalan') }}">Laporan</a>
                        </li>
                        <li>
                            Rawat Jalan
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Rawat Jalan
                        <span style="float:right;">
                            <a target="_BLANK" href="{{ url('report/rawat_jalan_print') }}?poli={{ $poli }}&dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <!--
                            <a target="_BLANK" href="{{ url('report/rawat_jalan_excel/xls') }}?poli={{ $poli }}&dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a target="_BLANK" href="{{ url('report/rawat_jalan_excel/xlsx') }}?poli={{ $poli }}&dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                            -->
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
                                <h3>Laporan Rawat Jalan</h3>
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
                                        @if($poli != 'all')
                                        <tr>
                                            <td>Poli</td>
                                            <td>:</td>
                                            <td>{{ $poli }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div><br />
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr>
                                        <td>No</td>
										<td>No RM</td>
                                        <td>Nama</td>
                                        <td>Tanggal</td>
                                        <td>Jam</td>
                                        <td>Cara Bayar</td>
                                        <td>Diagnosa</td>
                                        <td>Poli</td>
                                        <td>Dokter</td>
                                    </tr>
                                <?php $loop = 0;$cpoli=""; $no=0; $carabayar = array(); ?>
                                @foreach($pasien as $p)
                                    @if($cpoli!=$p->Poli)
                                        @if($loop == 0)
                                            <tr style="background:#CCCCCC">
                                                <td colspan="9" style="background:#CCCCCC">Poli : {{ $p->Poli }}</td>
                                            </tr>
                                        @else
                                            <tr style="background:#CCCCCC">
                                                <td colspan="9" style="background:#CCCCCC">Jumlah Pasien : {{ number_format($loop) }}</td>
                                            </tr>
                                            <tr style="background:#CCCCCC">
                                                <td colspan="9" style="background:#CCCCCC">Poli : {{ $p->Poli }}</td>
                                            </tr>
                                            <?php $loop = 0 ; $no=0;?>
                                        @endif

                                        <?php $cpoli = $p->Poli; ?>
                                    @endif

                                    <?php
                                        $diagnosa = "";
                                        $dokter   = "";

                                        $cb     = strtoupper($p->CaraBayar);
                                        if( isset($carabayar[$cb]) ){
                                            $carabayar[$cb]   = $carabayar[$cb] + 1;
                                        }
                                        else{
                                            $carabayar[$cb]   = 1;
                                        }

                                        //$data_dokter = DB::table('tb')

                                        $ds  = DB::table('tbdetaildiagnosis')->where('NoReg' , $p->NoRegJalan)
                                                    ->groupBy('IdDiag')->get();

                                        if(count($ds) > 0 ){
                                            foreach($ds as $dsa){
                                                $diagnosa .= $dsa->ShortDiagnoisDesc."<br />";
                                            }
                                        }
                                    ?>
										<?php $no++; ?>                           
                                    <tr>
                                        <td>{{ $no }}</td>
										<td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                        <td>{{ $p->jam_daftar }}</td>
                                        <td>{{ $p->CaraBayar }}</td>
                                        <td>{{ $diagnosa }}</td>
                                        <td>{{ $p->Poli }}</td>
                                        <td>{{ $p->Dokter }}</td>
                                    </tr>
                                    <?php $loop++; ?>                                       
                                @endforeach
									
                                    <tr style="background:#CCCCCC">
                                        <td colspan="9" style="background:#CCCCCC">Jumlah Pasien : {{ number_format($loop) }}</td>
                                    </tr>
                                    <tr style="background:#CCCCCC">
                                        <td colspan="9" style="background:#CCCCCC"><b>Total Seluruh Pasien : {{ count($pasien) }}</b></td>
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
