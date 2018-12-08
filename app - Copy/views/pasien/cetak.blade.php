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

                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div id="logo" style="position:absolute;">
                            </div>
                            <h3 align="center">{{ $rs_title }}</h3>
                            <h4 align="center">{{ $rs_alamat }}</h4>
                        </div>
                    </div>
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                    <div class="row-fluid" id="printarea">
                        <div class="row-fluid formSep">
                            <h3 align="center">Data Pasien</h3>
                            <hr />
                            <table width="100%">
                                <tr>
                                    <td width="35%">No RM</td>
                                    <td>:</td>
                                    <td  width="60%">{{ $pasien->NoRM }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $pasien->Nama }}</td>
                                </tr>
                                <tr>
                                    <td>No KTP</td>
                                    <td>:</td>
                                    <td>{{ $pasien->NoKTP }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>
                                        @if( $pasien->Jkel == 'L' )
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td>:</td>
                                    <td>
                                        <?php $tgls = explode('-' , $pasien->TanggalLahir); ?>
                                        {{ $pasien->TempatLahir.', '.$tgls[2].'/'.$tgls[1].'/'.$tgls[0] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $pasien->Jalan }}</td>
                                </tr>
                                <tr>
                                    <td>No Telp</td>
                                    <td>:</td>
                                    <td>{{ $pasien->NoTelp }}</td>
                                </tr>
                                <tr>
                                    <td>Suku</td>
                                    <td>:</td>
                                    <td>{{ $pasien->Suku }}</td>
                                </tr>

                                @if(empty($pasien->Agama) || $pasien->Agama == 'null')
                                    <?php $agama = ''; ?>
                                @else
                                    <?php $agama = $pasien->Agama; ?>
                                @endif


                                <tr>
                                    <td>Agama</td>
                                    <td>:</td>
                                    <td>{{ $agama }}</td>
                                </tr>

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
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>:</td>
                                    <td>{{ $pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>:</td>
                                    <td>{{ $pasien->Pendidikan }}</td>
                                </tr>

                                @if(empty($pasien->Status) || $pasien->Status == 'null')
                                    <?php $status = ''; ?>
                                @else
                                    <?php $status = $pasien->Status; ?>
                                @endif

                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>{{ $status }}</td>
                                </tr>
                            </table>
                            <hr />
                            <h3 align="center">Data Penjamin</h3>
                            <hr />
                            <table width="100%">
                                @if(empty($pasien->GolPasien) || $pasien->GolPasien == 'null')
                                    <?php $GolPasien = ''; ?>
                                @else
                                    <?php $GolPasien = $pasien->GolPasien; ?>
                                @endif
                                <tr>
                                    <td width="35%">Gol Pasien</td>
                                    <td>:</td>
                                    <td  width="60%">{{ $GolPasien }}</td>
                                </tr>
                                @if( $pasien->GolPasien == 'BPJS')
                                    @if(empty($pasien->SubGolPasien) || $pasien->SubGolPasien == 'null')
                                        <?php $SubGolPasien = ''; ?>
                                    @else
                                        <?php $SubGolPasien = $pasien->SubGolPasien; ?>
                                    @endif
                                    <tr>
                                        <td width="35%">Sub Golongan</td>
                                        <td>:</td>
                                        <td  width="60%">{{ $SubGolPasien }}</td>
                                    </tr>
                                    <tr>
                                        <td width="35%">Hak Kelas</td>
                                        <td>:</td>
                                        <td  width="60%">{{ $pasien->KelasAskes }}</td>
                                    </tr>
                                    <tr>
                                        <td width="35%">No BPJS</td>
                                        <td>:</td>
                                        <td  width="60%">{{ $pasien->NoBPJS }}</td>
                                    </tr>

                                    @if( $pasien->SubGolPasien == 'Dinas')
                                        <tr>
                                            <td width="35%">Gol Dinas</td>
                                            <td>:</td>
                                            <td  width="60%">{{ $pasien->GolDinas }}</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">Hubungan</td>
                                            <td>:</td>
                                            <td  width="60%">{{ $pasien->Hub }}</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">Pangkat</td>
                                            <td>:</td>
                                            <td  width="60%">{{ $pasien->PangkatGol }}</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">NIK/NRP</td>
                                            <td>:</td>
                                            <td  width="60%">{{ $pasien->NRPNIP }}</td>
                                        </tr>
                                    @endif
                                @else

                                @endif
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
