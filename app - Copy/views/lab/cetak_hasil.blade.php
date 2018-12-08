@extends('print')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}

    <style type="text/css">
        body{
            font-size:13px;
        }

        table.border{
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
                                <h3 align="center">Hasil Pemeriksaan Laboratorium</h3>
                            </div>
                            <div class="span12" style="margin: 0 10px">
                                <table>
                                    <tr>
                                        <td width="100px">No RM</td>
                                        <td width="22px">:</td>
                                        <td>{{ $pasien->NoRM }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td>:</td>
                                        <td>{{ $pasien->Nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Umur</td>
                                        <td>:</td>
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
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>{{ $pasien->Jkel }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Periksa</td>
                                        <td>:</td>
                                        <?php $tanggal  = explode( '-', $data->tanggal_periksa); ?>
                                        <td>{{ $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jam</td>
                                        <td>:</td>
                                        <td>{{ $data->jam }}</td>
                                    </tr>
                                </table>
                                <br /><br />
                                <table cellpadding="7" cellspacing="7" class="border" width="700px">
                                <thead>
                                    <tr>
                                        <th>Nama Pemeriksaan</th>
                                        <th>Satuan</th>
                                        <th>Hasil</th>
                                        <th>Rujukan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($detail) && count($detail) > 0 ){
                                    foreach($detail as $da){
                                        echo "<tr>";
                                        $detail                 = array();
                                        $d                      = DB::table('lab_pemeriksaan')->where('kode_jasa', $da->id_pemeriksaan)->first();
                                        
                                        if( isset($d->nama_jasa) ){
                                            echo "<td>".$d->nama_jasa."</td>";
                                            echo "<td>".$d->unit."</td>";
                                        }
                                        else{
                                            echo "<td></td><td></td>";
                                        }

                                        $nilai_normal           = array();
                                        echo "<td align='center'>".$da->hasil."</td>";
                                        echo "<td align='center'>".$d->nilai_normal."</td>";

                                        echo "</tr>";
                                    }
                                }
                                
                                ?>
                                </tbody>
                                </table>
                                <br /><br />
                                <div style="float:right;margin-right:30px;" align="right">
                                    <div style="width:200px;" align="center">
                                    <h4>Unit Laboratorium</h4>

                                    <br /><br /><br /><br /><br />
                                    {{ $data->NamaDokterLab }}
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