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
                            <a href="{{ url('report/jasa_dokter/ugd') }}">Laporan Jasa Dokter</a>
                        </li>
                        <li>
                            Detail Pasien UGD
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Detail Laporan Jasa Dokter UGD
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

                    <div class="row-fluid" id="printarea">
                        <div class="span12">
							
                            <h3 align="center">{{ $rs_title }}</h3>
                            <h4 align="center">{{ $rs_alamat }}</h4>
                        </div>
                    	<br />
                    @if(isset($registrasi))
                    
                        
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td width="15%">
                                        No Registrasi
                                    </td>
                                    <td width="30%">: 
                                       {{ $registrasi->NoRegUGD }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Tanggal
                                    </td>
                                    <td width="30%">: 
                                        @if(isset($registrasi->Tanggal ))
                                           {{ $registrasi->Tanggal  }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%">
                                        No RM
                                    </td>
                                    <td width="30%">: 
                                      {{ $registrasi->NoRM  }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Poli
                                    </td>
                                    <td width="30%">: 
                                        @if(isset($registrasi->Poli ))
                                           {{ $registrasi->Poli  }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%">
                                        Nama
                                    </td>
                                    <td width="30%">: 
                                       {{ $pasien->Nama }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Dokter
                                    </td>
                                    <td width="30%">: 
                                         @if(count($dokter)>0)
                                            @foreach($dokter as $d)
                                                {{ $d->NamaDokter."<br />" }}
                                            @endforeach
                                        @else
                                            {{ $registrasi->NamaDokter  }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <br />
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php 
                                        $total_tindakan = 0;
                                        $total_obat = 0; 
                                        $total_ruangan = 0; 
                                        $ruangan = true;

                                        $jasa_medis_pengelola = 0.40;
                                        $jasa_operasional = 0.60;

                                        $jasa_medis_paramedis = 0.78;
                                        $jasa_pengelola = 0.22;

                                        $jasa_medis = 0.66;
                                        $jasa_paramedis = 0.34;

                                        $show_all = true;
                                    ?>
                                    <table width="100%" border="1" colspan="2" class="report">
                                        <tr>
                                            <td colspan="3">Klaim</td>
                                            <td align="right">{{ number_format( $klaim ) }}</td>
                                        </tr>
                                    </table><br />
                                    <table width="100%" border="1" colspan="2" class="report">
                                    @if(isset($tindakan))
                                        @foreach($tindakan as $t)
                                            <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">Biaya Tindakan</td>
                                            <td align="right">{{ number_format($total_tindakan) }}</td>
                                        </tr>
                                    @endif
                                    @if(isset($obat))
                                        @foreach($obat as $o)
                                            <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">Biaya Obat</td>
                                            <td align="right">{{ number_format($total_obat) }}</td>
                                        </tr>
                                    @endif
                                    <?php $total = $total_ruangan + $total_tindakan + $total_obat; $selisih = ($klaim - $total) < 0 ? 0 : ($klaim - $total);?>
                                        <tr>
                                        <td  colspan="3">Biaya Keseluruhan</td>
                                        <td align="right">{{ number_format( $total ) }}</td>
                                        </tr>
                                    </table>
                                    <br />
                                    <?php
                                        $biaya_medis_pengelola = $jasa_medis_pengelola * $selisih;                                        
                                        $biaya_operasional = $jasa_operasional * $selisih;

                                        $biaya_medis_paramedis = $biaya_medis_pengelola * $jasa_medis_paramedis;
                                        $biaya_pengelola = $jasa_pengelola*$biaya_medis_pengelola;
                                        $biaya_medis = $jasa_medis * $biaya_medis_paramedis;
                                        $biaya_paramedis = $jasa_paramedis * $biaya_medis_paramedis;
                                    ?>
                                    @if($show_all)
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td colspan="3">Selisih</td>
                                                <td align="right">{{ number_format($selisih) }}</td>
                                            </tr>
                                        </table>
                                        <br />
                                    @endif
                                    <table width="100%" border="1" colspan="2" class="report">
                                        @if($show_all)
                                        <tr>
                                            <td colspan="3">Jasa Medis Pengelola</td>
                                            <td align="right">{{ number_format($biaya_medis_pengelola) }}</td>
                                        </tr>
                                        @endif
                                        @if($show_all)
                                        <tr>
                                            <td colspan="3"> - Jasa Medis Paramedis</td>
                                            <td align="right" style="padding-right:30px">{{ number_format($biaya_medis_paramedis) }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3">&nbsp;&nbsp;&nbsp;-- Jasa Medis</td>
                                            <td align="right" style="padding-right:60px">{{ number_format($biaya_medis) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">&nbsp;&nbsp;&nbsp;-- Jasa Paramedis</td>
                                            <td align="right" style="padding-right:60px">{{ number_format($biaya_paramedis) }}</td>
                                        </tr>
                                        @if($show_all)
                                        <tr>
                                            <td colspan="3"> - Jasa Pengelola</td>
                                            <td align="right" style="padding-right:30px">{{ number_format($biaya_pengelola) }}</td>
                                        </tr>
                                        @endif
                                        @if($show_all)
                                        <tr>
                                            <td colspan="3">Jasa Operasional</td>
                                            <td align="right">{{ number_format($biaya_operasional) }}</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        Data tidak ditemukan
                    @endif
                    
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
