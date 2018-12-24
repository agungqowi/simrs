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
                                <br />
                                <table cellpadding="7" cellspacing="7" class="border" width="95%">
                                <thead>
                                    <tr>
                                        <th>Nama Pemeriksaan</th>
                                        <th>Hasil</th>
                                        <th>Rujukan</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($detail) && count($detail) > 0 ){
                                    
                                    $all    = DB::table('lab_pemeriksaan')->where('group_jasa' ,'0')->get();
                                    $aprint =  "";                                   
                                    // parent 0
                                    foreach($all as $a){
                                        $print  = false;
                                        
                                        $ch1    = DB::table('lab_pemeriksaan')->where('group_jasa' ,$a->kode_jasa)->get();
                                        $cprint = array();
                                        $aprint = "<tr><td colspan='4'><b>".$a->nama_jasa."</b></td></tr>";
                                        //print_r($a->nama_jasa);exit();
                                        // isi detail level 0
                                        if( count($ch1) > 0 ){

                                            foreach ($ch1 as $cp1 ){
                                                foreach($detail as $dt){
                                                    if( $dt->id_pemeriksaan == $cp1->kode_jasa ) {
                                                        $aprint .= "<tr>";
                                                        $aprint .= "<td>&nbsp;&nbsp;".$cp1->nama_jasa."</b></td>";
                                                        $aprint .= "<td align='center'>".$dt->hasil."</td>";
                                                        $aprint .= "<td align='center'>".$cp1->nilai_normal."</td>";
                                                        $aprint .= "<td align='center'>".$cp1->unit."</td>";
                                                        $aprint .="</tr>";

                                                        $print=true;

                                                    }
                                                }
                                            }
                                        }

                                        // End detail level 0


                                        if( count($ch1) > 0 ){
                                            //parent 1
                                            foreach( $ch1 as $cp1 ){
                                                $lp1    = 0;
                                                if( isset($cp1->kode_jasa) ){
                                                    $ch2    = DB::table('lab_pemeriksaan')->where('group_jasa' ,$cp1->kode_jasa)->get();

                                                    if( count($ch2) > 0 ){

                                                        foreach( $ch2 as $cp2 ){
                                                            foreach($detail as $da){
                                                                
                                                               //echo $cp2->kode_jasa."  ";echo $cp2->nama_jasa."  ";echo $da->id_pemeriksaan."<br>";
                                                               if( $da->id_pemeriksaan == $cp2->kode_jasa ){
                                                                    $print  = true;

                                                                    //echo "Yes";exit();
                                                                    if( $lp1 == 0 ){
                                                                        $aprint .= "<tr>";
                                                                        $aprint .= "<td colspan='4'><b>&nbsp;".$cp1->nama_jasa."</b></td>";
                                                                        $aprint .="</tr>";
                                                                    }
                                                                    $lp1++;

                                                                    $aprint .= "<tr>";
                                                                    $aprint .= "<td>&nbsp;&nbsp;".$cp2->nama_jasa."</b></td>";
                                                                    $aprint .= "<td align='center'>".$da->hasil."</td>";
                                                                    $aprint .= "<td align='center'>".$cp2->nilai_normal."</td>";
                                                                    $aprint .= "<td align='center'>".$cp2->unit."</td>";
                                                                    $aprint .="</tr>";

                                                                }
                                                                else{
                                                                    //$print  = true;
                                                                   // echo "No";exit();
                                                                    //echo $cp2->nama_jasa."  ";echo $da->id_pemeriksaan."<br>";

                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                }
                                                else{
                                                    foreach($detail as $da){
                                                        if( $da->id_pemeriksaan == $ch1->kode_jasa ){
                                                            $print  = true;
                                                        }
                                                    }
                                                }


                                            }
                                        }
                                        
                                        if( $print ){
                                            echo $aprint;
                                        }
                                    }
                                    

                                    /*
                                    $cetak  = array();
                                    $cp1       =array();
                                    foreach($detail as $da){
                                        //echo "<tr>";
                                        $detail                 = array();
                                        $d                      = DB::table('lab_pemeriksaan')->where('kode_jasa', $da->id_pemeriksaan)->first();
                                        // parent diatasnya

                                        if( isset($d->nama_jasa) ){
                                            $jasa = array();
                                            $jasa['kode_jasa']  = $d->kode_jasa;
                                            $jasa['nama_jasa']  = $d->nama_jasa;
                                            $jasa['hasil']      = $da->hasil;
                                            $jasa['nilai_normal']   = $d->nilai_normal;
                                            $jasa['unit']           = $d->unit;

                                            $p1     = DB::table('lab_pemeriksaan')->where('kode_jasa' , $d->group_jasa)->first();

                                            if( isset($p1->nama_jasa) ){
                                                $cp1    = 
                                                $p1_jasa = array();
                                                $p1_jasa['kode_jasa']       = $p1->kode_jasa;
                                                $p1_jasa['nama_jasa']       = $p1->nama_jasa;

                                                $p2 = DB::table('lab_pemeriksaan')->where('kode_jasa' , $p1->group_jasa)->first();

                                                if( isset($p2->nama_jasa) ){
                                                    $cetak[ $p2->kode_jasa ][]  = array('meta' => $p2->nama_jasa , 'content' => $p1_jasa );
                                                }
                                                else{
                                                    $cetak[ $p1->kode_jasa ]    = 
                                                }
                                            }
                                        }
                                        else{

                                        }
                                    }
                                    */
                                }
                                
                                ?>
                                </tbody>
                                </table><br />
                                <b>Saran / Kesimpulan : </b>
                                <br />{{ $data->kesimpulan }}
                                <br /><br />
                                <div style="float:left;margin-right:30px;" align="left">
                                    <div style="width:200px;" align="center">
                                    <h4>Dokter Laboratorium</h4>

                                    <br /><br /><br /><br /><br />
                                    {{ $data->NamaDokterLab }}
                                    </div>
                                </div>
                                <div style="float:right;margin-right:30px;" align="left">
                                    <div style="width:200px;" align="left">
                                    <?php $data_dasar   = DB::table('data_dasar')->where('id','1')->first(); ?>
                                    @if( isset($data_dasar) && !empty($data_dasar->kab_kota))
                                        {{ $data_dasar->kab_kota }}
                                    @endif
                                    <h4>Pemeriksa</h4>

                                    <br /><br /><br />
                                    {{ $data->pemeriksa }}
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