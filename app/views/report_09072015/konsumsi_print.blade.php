@extends('print')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
@stop

@section('content')
    <div id="contentwrapper">
        <div class="print_content">
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Konsumsi Harian Pasien
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
                                <h3>Kebutuhan Jumlah Makan Pasien</h3>
                                <div>
                                    <table>
                                        <tr>
                                            <td>Per Tanggal</td>
                                            <td>:</td>
                                            <td>{{ $tanggal }}</td>
                                        </tr>
                                    </table>
                                </div><br />
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr>
                                        <td>No</td>
                                        <td>No RM</td>
                                        <td>Nama</td>
                                        <td>Gol Pasien</td>
                                        <td>Ruangan</td>
                                        <td>Kelas</td>
                                        <td>Tanggal Masuk</td>
                                    </tr>
                                <?php $loop = 0;$cpoli=""; ?>
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
 											<tr style="border-left:#FFFFFF; border-right:#FFFFFF; border-left-style:solid; border-right-style:solid;">
												<td colspan="7"></td>
											</tr>
                                            <tr style="background:#CCCCCC">
                                                <td colspan="7" style="background:#CCCCCC">Ruangan : {{ $p->Ruangan }}</td>
                                            </tr>
                                            <?php $loop = 0 ; ?>
                                        @endif

                                        <?php $cpoli = $p->Ruangan; ?>
                                    @endif   
									<?php $loop++; ?>                           
                                    <tr>
                                        <td>{{ $loop }}</td>
                                        <td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->GolPasien }}</td>
                                        <td>{{ $p->Ruangan }}</td>
                                        <td>{{ $p->Kelas }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                    </tr>
                                                                           
                                @endforeach

                                    <tr style="background:#CCCCCC">
                                        <td colspan="7" style="background:#CCCCCC">Jumlah Pasien : {{ number_format($loop) }}</td>
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
@stop
