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
                                        <td>No RM</td>
                                        <td>Nama</td>
                                        <td>Gol Pasien</td>
                                        <td>Tanggal</td>
                                        <td>Poli</td>
                                    </tr>
                                <?php $loop = 0;$cpoli=""; ?>
                                @foreach($pasien as $p)
                                    @if($cpoli!=$p->Poli)
                                        @if($loop == 0)
                                            <tr style="background:#CCCCCC">
                                                <td colspan="5" style="background:#CCCCCC">Poli : {{ $p->Poli }}</td>
                                            </tr>
                                        @else
                                            <tr style="background:#CCCCCC">
                                                <td colspan="5" style="background:#CCCCCC">Jumlah Pasien : {{ number_format($loop) }}</td>
                                            </tr>
                                            <tr style="background:#CCCCCC">
                                                <td colspan="5" style="background:#CCCCCC">Poli : {{ $p->Poli }}</td>
                                            </tr>
                                            <?php $loop = 0 ; ?>
                                        @endif

                                        <?php $cpoli = $p->Poli; ?>
                                    @endif                              
                                    <tr>
                                        <td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->GolPasien }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                        <td>{{ $p->Poli }}</td>
                                    </tr>
                                    <?php $loop++; ?>                                       
                                @endforeach

                                    <tr style="background:#CCCCCC">
                                        <td colspan="5" style="background:#CCCCCC">Jumlah Pasien : {{ number_format($loop) }}</td>
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
