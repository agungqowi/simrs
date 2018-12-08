@extends('print')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}

    <style type="text/css">
        body{
            font-size:13px;
        }

        table.fullborder td{
            border:1px solid #000;
        }
        table.border tr{
            padding:10px;
        }
    </style>
    
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
                        @if(isset($data->id) && isset($pasien->NoRM))
                            <div class="span12">
                                <div id="logo" style="position:absolute;">
                                <img src="{{ url('img/'.$rs_logo) }}" style="height:50px">
                                </div>
                                <h3 align="center">{{ $rs_title }}</h3>
                                <h4 align="center" style="padding-left:50px">{{ $rs_alamat }}</h4>
                                <hr />
                                <h3 align="center">Unit Radiologi</h3>
                            </div>
                            <div class="span12">
                                <table class="fullborder" width="100%">
                                    <tr>
                                        <td>No RM : </td>
                                        <td colspan="3">{{ $pasien->NoRM }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Nama : </td>
                                        <td width="30%">{{ $pasien->Nama }}</td>
                                        <td width="15%">Tanggal : </td>
                                        <?php $tanggal  = explode( '-', $data->tanggal_periksa); ?>
                                        <td width="30%">{{ $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0] }} {{ $data->jam }}</td>
                                    </tr>
                                    <tr>
                                        <td>Umur : </td>
                                        <td>
                                            <?php
                                                list($year,$month,$day) = explode("-",$pasien->TanggalLahir);
                                                $year_diff  = date("Y") - $year;
                                                $month_diff = date("m") - $month;
                                                $day_diff   = date("d") - $day;
                                                if ($month_diff < 0) $year_diff--;
                                                elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;

                                                echo $year_diff
                                            ?> tahun
                                        </td>
                                        <td>Nomor :</td>
                                        <td>{{ $id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan</td>
                                        <td colspan="3">{{ $data->kategori }}</td>
                                    </tr>
                                </table>
                                <br />
                                {{ $data->kesimpulan }}
                                <br /><br />
                                <div style="float:right;margin-right:30px;" align="right">
                                    <div style="width:200px;" align="center">
                                    <h4>Unit Radiologi</h4>

                                    <br /><br /><br /><br /><br />
                                    {{ $data->NamaDokterRad }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection