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
                            <a href="{{ url('report/konsumsi') }}">Laporan</a>
                        </li>
                        <li>
                            Pendapatan Lab
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Pendapatan Lab
                        <span style="float:right;">
                            <a target="_blank" href="javascript:do_print()" class="btn btn-primary">
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

                        <div class="row-fluid" id="printarea">
                            <div class="span12">
                                
                                <h3 align="center">{{ $rs_title }}</h3>
                                <h4 align="center">{{ $rs_alamat }}</h4>
                                <br />
                                <h3>Pendapatan Lab</h3>
                                <div>
                                    <table>
                                        <tr>
                                            <td>Dari Tanggal</td>
                                            <td>:</td>
                                            <td>{{ $dari }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sampai Tanggal</td>
                                            <td>:</td>
                                            <td>{{ $sampai }}</td>
                                        </tr>
                                    </table>
                                </div><br />
                                <?php $total_jalan = 0;$total_inap=0;$total=0; ?>
                                @if(count($data) > 0)
                                <h4>Rawat Jalan</h4>
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr>
                                        <td>No</td>
                                        <td>Tanggal</td>
                                        <td>No RM</td>
                                        <td>Nama</td>
                                        <td>Poli</td>
                                        <td>Cara Bayar</td>
                                        <td>Pemeriksaan</td>
                                        <td>Tarif</td>
                                    </tr>
                                <?php $loop = 0;$cpoli="";  ?>
                                @foreach($data as $p)
                                    <?php
                                        $lanjut     = 0;
                                        if( $loop == 0 ) {
                                            $reg        = $p->NoReg;
                                            $tanggal    = $p->TanggalTindak;
                                            $lanjut     = 1;
                                            $loop++; 
                                        }
                                        else{
                                            if( $reg == $p->NoReg && $tanggal == $p->TanggalTindak ){
                                                $lanjut = 0;
                                            }
                                            else{                                                
                                                $reg        = $p->NoReg;
                                                $tanggal    = $p->TanggalTindak;
                                                $lanjut = 1;
                                                $loop++; 
                                            }
                                        }
                                    ?>
                                    @if($lanjut == 1)
                                        <tr>
                                            <td>{{ $loop }}</td>
                                            <td>{{ $p->TanggalTindak }}</td>
                                            <td>{{ $p->NoRM }}</td>
                                            <td>{{ $p->Nama }}</td>
                                            <td>{{ $p->Poli }}</td>
                                            <td>{{ $p->CaraBayar }}</td>
                                            <td>{{ $p->Tindakan }}</td>
                                            <td align="right">{{ number_format( $p->Tarif ) }}</td>
                                        </tr>
                                    @else
                                        <tr >
                                            <td style="background:#CCCCCC" colspan="6"></td>
                                            <td>{{ $p->Tindakan }}</td>
                                            <td align="right">{{ number_format( $p->Tarif ) }}</td>
                                        </tr>
                                    @endif

                                    <?php $total_jalan = $total_jalan + floatval($p->Tarif); ?>                        
                                @endforeach

                                    <tr style="background:#CCCCCC">
                                        <td colspan="7" style="background:#CCCCCC">Total Pendapatan dari RJ</td>
                                        <td align="right">{{ number_format($total_jalan) }}</td>
                                    </tr>
                                </table>
                                <br />
                                @endif

                                @if(count($data2) > 0)
                                <h4>Rawat Inap</h4>
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr>
                                        <td>No</td>
                                        <td>Tanggal</td>
                                        <td>No RM</td>
                                        <td>Nama</td>
                                        <td>Poli</td>
                                        <td>Cara Bayar</td>
                                        <td>Pemeriksaan</td>
                                        <td>Tarif</td>
                                    </tr>
                                <?php $loop = 0;$cpoli="";  ?>
                                @foreach($data2 as $p)
                                    <?php
                                        $lanjut     = 0;
                                        if( $loop == 0 ) {
                                            $reg        = $p->NoReg;
                                            $tanggal    = $p->TanggalTindak;
                                            $lanjut     = 1;
                                            $loop++; 
                                        }
                                        else{
                                            if( $reg == $p->NoReg && $tanggal == $p->TanggalTindak ){
                                                $lanjut = 0;
                                            }
                                            else{                                                
                                                $reg        = $p->NoReg;
                                                $tanggal    = $p->TanggalTindak;
                                                $lanjut = 1;
                                                $loop++; 
                                            }
                                        }
                                    ?>
                                    @if($lanjut == 1)
                                        <tr>
                                            <td>{{ $loop }}</td>
                                            <td>{{ $p->TanggalTindak }}</td>
                                            <td>{{ $p->NoRM }}</td>
                                            <td>{{ $p->Nama }}</td>
                                            <td>{{ $p->Ruangan }}</td>
                                            <td>{{ $p->CaraBayar }}</td>
                                            <td>{{ $p->Tindakan }}</td>
                                            <td align="right">{{ number_format( $p->Tarif ) }}</td>
                                        </tr>
                                    @else
                                        <tr >
                                            <td style="background:#CCCCCC" colspan="6"></td>
                                            <td>{{ $p->Tindakan }}</td>
                                            <td align="right">{{ number_format( $p->Tarif ) }}</td>
                                        </tr>
                                    @endif

                                    <?php $total_inap = $total_inap + floatval($p->Tarif); ?>                        
                                @endforeach

                                    <tr style="background:#CCCCCC">
                                        <td colspan="7" style="background:#CCCCCC">Total Pendapatan dari RI</td>
                                        <td align="right">{{ number_format($total_inap) }}</td>
                                    </tr>
                                </table>
                                @endif
                                <?php $total = $total_inap + $total_jalan; ?>
                                <table  width="100%" border="1" colspan="2" class="report">
                                    <tr style="background:#CCCCCC">
                                        <td width="80%" style="background:#CCCCCC">Total Pendapatan</td>
                                        <td align="right">{{ number_format($total) }}</td>
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
