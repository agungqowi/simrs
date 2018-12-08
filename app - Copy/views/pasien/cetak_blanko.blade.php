@extends('print')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
@stop

@section('content')
    <div id="contentwrapper">
        <div class="print_content">
            <div class="row-fluid">
                <div class="span12">

                    <div class="row-fluid">
                        <div class="span12" style="border-bottom: 3px solid #000;">
                            <div id="logo" style="position:absolute;">
                            </div>
                            <h3 align="center">{{ $rs_title }}</h3>
                            <h4 align="center">{{ $rs_alamat }}</h4>
                        </div>
                    </div>
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                    <div class="row-fluid" id="printarea">
                        <div class="row-fluid">
                            <h4 align="center">Kartu Rawat Jalan</h4>
                            <table width="100%" border="1">
                                <tr>
                                    <td width="10%">No RM</td>
                                    <td width="35%">{{ $pasien->NoRM }}</td>
                                    <td width="10%">Nama</td>
                                    <td width="45%">{{ $pasien->Nama }} ({{ $pasien->Jkel }} )</td>
                                </tr>
                                <tr>
                                    <td>TTL</td>
                                    <td>
                                        <?php $tgls = explode('-' , $pasien->TanggalLahir); ?>
                                        {{ $pasien->TempatLahir.', '.$tgls[2].'/'.$tgls[1].'/'.$tgls[0] }}
                                    </td>
                                    <td>No Telp</td>
                                    <td>{{ $pasien->NoTelp }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td colspan="3">{{ $pasien->Jalan }}</td>
                                </tr>
                                @if(empty($pasien->Agama) || $pasien->Agama == 'null')
                                    <?php $agama = ''; ?>
                                @else
                                    <?php $agama = $pasien->Agama; ?>
                                @endif

                                @if( empty($pasien->Pekerjaan) || $pasien->Pekerjaan == '' || $pasien->Pekerjaan == 0 )
                                    <?php $pekerjaan = ""; ?>
                                @else
                                    <?php 
                                        $db = DB::table('tbpekerjaan')->where('id' , $pasien->Pekerjaan)->first(); 
                                        if(isset($db->id)){
                                            $pekerjaan = $db->Nama;
                                        }
                                        else{
                                            $pekerjaan = "";
                                        }
                                    ?>
                                @endif
                                @if(empty($pasien->Status) || $pasien->Status == 'null')
                                    <?php $status = ''; ?>
                                @else
                                    <?php $status = $pasien->Status; ?>
                                @endif
                                <tr>
                                    <td>Agama</td>
                                    <td>{{ $agama }}</td>
                                    <td>Pekerjaan</td>
                                    <td>{{ $pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>{{ $pasien->Pendidikan }}</td>
                                    <td>Status</td>
                                    <td>{{ $status }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row-fluid">
                        <table style="height:300px;" width="100%" border="1">
                        <thead>
                            <tr>
                                <th width="10%">Tanggal / Jam</th>
                                <th width="30%">ANAMNESA</th>
                                <th width="25%">DIAGNOSA</th>
                                <th width="15%">KODE ICD</th>
                                <th width="20%">TERAPI TTD DAN NAMA DOKTER</th>
                            </tr>
                            <tr height="500px">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </thead>
                        </table>
                        </div>
                    </div>
                    {{ Form::close() }}
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
