@extends('print')

@section('css')
    @parent
    <style type="text/css">
        body{
            font-size:10px;
            line-height: 10px;
        }
    </style>
@stop

@section('content')
    <div id="contentwrapper">
        <div class="print_content">

            <div class="row-fluid">
                <div class="span12">
                    <div class="heading">Biaya Rawat Inap
                    </div>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
                        </div>
                    @endif

                    <?php $reg = array(); ?>
                    @if(isset($registrasi))
                        @foreach($inap as $re)
                            <?php $reg[ $re->Tanggal ] = $re->Ruangan; ?>
                        @endforeach
                        <?php 
                            $umur     = 0;
                            $tgl_lahir  = $registrasi->TanggalLahir;
                            if( $tgl_lahir == '0000-00-00' ){
                                $umur    = 0;
                            }
                            else{
                                $umur   = $helper->umurTahun( $tgl_lahir, $registrasi->Tanggal );
                            }
                        ?>
                    <div id="printarea" class="row-fluid">
                        <div class="span12">
                            <div align="center">{{ $rs_title }}</div>
                            <div align="center">{{ $rs_alamat }}</div><br /><br />
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td width="35%">
                                        No Registrasi
                                    </td>
                                    <td>
                                        {{ $registrasi->NoReg }}
                                    </td>
                                </tr>                                  
                                <tr>
                                    <td width="35%">
                                        No RM
                                    </td>
                                    <td>
                                        {{ $registrasi->NoRM }}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        Nama
                                    </td>
                                    <td>
                                        {{ $registrasi->Nama }}
                                        @if( $umur == "0" )

                                        @else
                                            {{ '('.$umur.')' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        Alamat
                                    </td>
                                    <td>
                                        {{ $registrasi->Jalan }}
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="35%">
                                        Dokter DPJP
                                    </td>
                                    <td>
                                        @if(isset($dokter))
                                            @foreach($dokter as $d)
                                                @if($d->Kategori == 'DPJP')
                                                    {{ $d->NamaDokter."<br />" }}
                                                @endif
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        Dokter Konsul
                                    </td>
                                    <td>
                                        @if(isset($dokter))
                                            <?php $konsul = array();$total_konsul = array(); ?>
                                            @foreach($dokter as $d)
                                                @if($d->Kategori == 'Konsul')
                                                    @if(in_array($d->NamaDokter , $konsul))
                                                        <?php $total_konsul[$d->NamaDokter]++; ?>
                                                    @else
                                                        <?php $konsul[] = $d->NamaDokter; ?>
                                                        <?php $total_konsul[$d->NamaDokter] = 1; ?>
                                                    @endif
                                                @endif
                                            @endforeach

                                            @foreach($konsul as $k)
                                                {{ $k." (".$total_konsul[$k]." kali)"."<br />" }}
                                            @endforeach
                                        @else
                                            -
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
                                        $gol = "";
                                        $ruangan = true;
                                        $gol_loop = 0;
                                        $total_gol = 0;
                                        $total_visite   = 0;
                                        $total_tindakan_jalan   = 0;
                                        $total_obat_jalan       = 0;
                                    ?>
                                    @if(isset($tindakan_jalan))
                                        <div><b>Biaya Tindakan Poli / UGD</b></div>
                                        @if( count($tindakan_jalan) > 0 )
                                            <table width="100%" border="0" colspan="2" class="report">
                                                <tr>
                                                    <td align="" width="15%">Tanggal</td>
                                                    <td align="" width="60%">Tindakan</td>
                                                    <td align="" width="10%">Jenis Rawat</td>
                                                    <td align="right" width="25%">Tarif</td>
                                                </tr>
                                            @foreach($tindakan_jalan as $t)
                                               
                                                    
                                                <tr>
                                                    <td>{{ $t->TanggalTindak }}</td>
                                                    <td>{{ $t->Tindakan }}</td>
                                                    <td>{{ $t->JenisRawat }}</td>
                                                    <td align="right">{{ number_format($t->Tarif) }}</td>
                                                </tr>
                                                <?php $total_tindakan_jalan     = $total_tindakan_jalan + $t->Tarif; ?>
                                            @endforeach
                                            </table>
                                        @endif
                                        <br />
                                    @endif
                                    @if($ruangan)
                                        <div><b>Biaya Ruangan</b></div>

                                        <table width="100%" border="0" colspan="2" class="report">
                                            <tr>
                                                <td width="60%">Keterangan</td>
                                                <td width="10%" align="right">Quantity</td>
                                                <td width="15%" align="right">Harga</td>
                                                <td width="15%" align="right">Total</td>
                                            </tr>
                                            @foreach($inap as $k)
                                                <?php
                                                    $tanggal_masuk      = $k->Tanggal;
                                                    if( $k->TanggalPulang == '0000-00-00' ){
                                                        $tanggal_pulang     = date('Y-m-d');
                                                    }
                                                    else{
                                                        $tanggal_pulang     = $k->TanggalPulang;
                                                    }
                                                    
                                                    $diff = abs(strtotime( $tanggal_pulang ) - strtotime( $tanggal_masuk ));
                                                    $years = floor($diff / (365*60*60*24));
                                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                    //$days++;
                                                    if( $tanggal_masuk == $tanggal_pulang ){
                                                        $days = 1;
                                                    }
                                                    $tarif = $k->TarifRuangan;
                                                    $biaya_ruangan =  intVal( $tarif ) *  intVal( $days );
                                                ?>
                                                @if(isset($reg[$k->Tanggal]))
                                                    <?php $ruangan = $reg[$k->Tanggal]; ?>
                                                @else
                                                    <?php $ruangan = ""; ?>
                                                @endif
                                                <tr>
                                                    <td>Tarif Ruangan {{ $ruangan }} ({{ $k->Tanggal.' s/d '.$tanggal_pulang }})
                                                    </td>
                                                    <td align="right">{{ $days }}</td>
                                                    <td align="right">{{ number_format( $tarif ) }}</td>
                                                    <td align="right">{{ number_format( $biaya_ruangan ) }}</td>
                                                </tr>
                                                <?php 
                                                    $total_ruangan = $total_ruangan + $biaya_ruangan;

                                                ?>
                                            @endforeach
                                            
                                            
                                            <!--
                                            <tr>
                                                <td colspan="3">Total Biaya Ruangan</td>
                                                <td align="right">{{ number_format($total_ruangan) }}</td>
                                            </tr>
                                            -->
                                        </table>
                                        <br />
                                    @endif
                                    @if(count($tindakan) > 0)
                                        @foreach($tindakan as $t)
                                            @if($gol != $t->Gol)
                                                @if($gol_loop != 0)
                                                    <tr>
                                                        <td colspan="2">Total Biaya Tindakan</td>
                                                        <td align="right">{{ number_format($total_gol) }}</td>
                                                    </tr>
                                                </table>
                                                <br />
                                                @endif
                                                <div><b>Biaya Tindakan {{ $t->Gol }}</b></div>
                                                <table width="100%" border="0" colspan="2" class="report">
                                                    <tr>
                                                        <td width="15%">Tanggal</td>
                                                        <td width="60%">Tindakan</td>
                                                        <td align="right" width="25%">Tarif</td>
                                                    </tr>

                                                <?php $total_gol = 0 ?>
                                            @else

                                            @endif

                                            <tr>
                                                <td>{{ $t->TanggalTindak }}</td>
                                                <td>{{ $t->Tindakan }}</td>
                                                <td align="right">{{ number_format($t->Tarif) }}</td>
                                            </tr>
                                            <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                            <?php $total_gol = $total_gol + $t->Tarif; ?>
                                            <?php $gol_loop++; $gol=$t->Gol;?>
                                            
                                        @endforeach
                                                    <tr>
                                                        <td colspan="2">Total Biaya Tindakan</td>
                                                        <td align="right">{{ number_format($total_gol) }}</td>
                                                    </tr>
                                                </table>
                                                <br />
                                    @endif
                                    <?php $ujr  = 0; ?>
                                    @if( isset($obatjalan) && count($obatjalan) > 0 )
                                        <div><b>Biaya Obat Poli / UGD</b></div>
                                        <table width="100%" border="0" colspan="2" class="report">
                                            <tr style="display:none;">
                                                <td width="15%">Tanggal</td>
                                                <td width="60%">Nama Obat</td>
                                                <td align="right" width="10%">Harga</td>
                                                <td align="right" width="5%">Jumlah</td>
                                                <td align="right" width="20%">Total</td>
                                            </tr>
                                        @foreach( $obatjalan as $p )
                                            @if(isset($p->id))
                                            <?php $obat     = DB::table('apo_penjualan_detail')->where('id_penjualan' , $p->id)->get(); ?>
                                            @foreach($obat as $o)
                                                <tr 
                                                    @if($cetak_obat=='total') 
                                                        style="display:none;"
                                                    @endif
                                                    >
                                                    <td>{{ $o->TanggalResep }}</td>
                                                    <td>{{ $o->NamaObat }}</td>
                                                    <td align="right">{{ number_format($o->Harga) }}</td>
                                                    <td align="right">{{ $o->Jumlah }}</td>
                                                    <td align="right">{{ number_format($o->TotalHarga) }}</td>
                                                </tr>
                                                <?php $total_obat_jalan = $total_obat_jalan + $o->TotalHarga; ?>
                                            @endforeach
                                                @if($p->ujr != 0)
                                                    <?php $ujr    = $ujr + intVal( $p->ujr ); ?>
                                                @endif
                                            @endif
                                        @endforeach
                                            @if($ujr > 0)
                                                <tr>
                                                    <td colspan="4">Subtotal Biaya Obat</td>
                                                    <td align="right">{{ number_format($total_obat_jalan) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">UJR</td>
                                                    <td align="right">{{ number_format($ujr) }}</td>
                                                </tr>
                                                <?php $total_obat_jalan   = intVal($total_obat_jalan) + intVal($ujr); ?>
                                                <tr>
                                                    <td colspan="4">Total Biaya Obat</td>
                                                    <td align="right">{{ number_format($total_obat_jalan) }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="4">Total Biaya Obat</td>
                                                    <td align="right">{{ number_format($total_obat_jalan) }}</td>
                                                </tr>
                                            @endif
                                            
                                        </table>
                                        <br />
                                    @endif
                                    @if( isset($penjualan) && count($penjualan) > 0 )
                                        <div><b>Biaya Obat</b></div>
                                        <table width="100%" border="0" colspan="2" class="report">
                                            <tr style="display:none;">
                                                <td width="15%">Tanggal</td>
                                                <td width="60%">Nama Obat</td>
                                                <td align="right" width="10%">Harga</td>
                                                <td align="right" width="5%">Jumlah</td>
                                                <td align="right" width="20%">Total</td>
                                            </tr>
                                        @foreach( $penjualan as $p )
                                            @if(isset($p->id))
                                            <?php $obat     = DB::table('apo_penjualan_detail')->where('id_penjualan' , $p->id)->get(); ?>
                                            @foreach($obat as $o)
                                                <tr 
                                                    @if($cetak_obat=='total') 
                                                        style="display:none;"
                                                    @endif
                                                    >
                                                    <td>{{ $o->TanggalResep }}</td>
                                                    <td>{{ $o->NamaObat }}</td>
                                                    <td align="right">{{ number_format($o->Harga) }}</td>
                                                    <td align="right">{{ $o->Jumlah }}</td>
                                                    <td align="right">{{ number_format($o->TotalHarga) }}</td>
                                                </tr>
                                                <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                            @endforeach
                                                @if($p->ujr != 0)
                                                    <?php $ujr    = $ujr + intVal( $p->ujr ); ?>
                                                @endif
                                            @endif
                                        @endforeach
                                            @if($ujr > 0)
                                                <tr>
                                                    <td colspan="4">Subtotal Biaya Obat</td>
                                                    <td align="right">{{ number_format($total_obat) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">UJR</td>
                                                    <td align="right">{{ number_format($ujr) }}</td>
                                                </tr>
                                                <?php $total_obat   = intVal($total_obat) + intVal($ujr); ?>
                                                <tr>
                                                    <td colspan="4">Total Biaya Obat</td>
                                                    <td align="right">{{ number_format($total_obat) }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="4">Total Biaya Obat</td>
                                                    <td align="right">{{ number_format($total_obat) }}</td>
                                                </tr>
                                            @endif
                                            
                                        </table>
                                        <br />
                                    @endif
                                    <?php $total = $total_tindakan_jalan + $total_obat_jalan + $total_ruangan + $total_tindakan + $total_obat + $total_visite; ?>
                                    <div><b>Total Keseluruhan</b></div>
                                    <table width="100%" border="0" colspan="2" class="report">
                                        <tr>
                                        <td width="80%">Total Keseluruhan</td>
                                        <td align="right" width="20%">{{ number_format( $total ) }}</td>
                                        </tr>
                                    </table>
                                    <br />
                                    <div style="float:right;">
                                        <div align="center">
                                            <?php

                                            $bulan  = array(
                                                                                '01' => 'Januari' ,
                                                                                '02' => 'Februari' ,
                                                                                '03' => 'Maret' ,
                                                                                '04' => 'April' ,
                                                                                '05' => 'Mei' ,
                                                                                '06' => 'Juni' ,
                                                                                '07' => 'Juli' ,
                                                                                '08' => 'Agustus' ,
                                                                                '09' => 'September' ,
                                                                                '10' => 'Oktober' ,
                                                                                '11' => 'November' ,
                                                                                '12' => 'Desember'

                                                                );
                                            $tanggal    = date('d');
                                            $m          = date('m');
                                            $tahun      = date('Y');
                                            ?>

                                            <br /><br />
                                            <b> <?php echo $tanggal.' '.$bulan[$m].' '.$tahun; ?><br /><br />
                                            Kasir
                                            </b>
                                        </div>
                                    </div>
                                    <div style="float:left;width:150px;">
                                        <div align="center">
                                            <br /><br /><br /><br />
                                            <br /><br /><br /><br />ttd
                                            <br /><br /><br /><br />
                                            {{ $registrasi->Nama }}
                                        </div>
                                    </div>
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
@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    <script type="text/javascript">
        $(document).ready(function(){

        });

        function pilih_pasien(no_rm,id_reg,nama,poli,tanggal){
            $('#no_rm').val(no_rm);
            $('#no_reg').val(id_reg);
            $('#txt_nama').val(nama);
            $('#txt_poli').val(poli);
            $('#txt_tanggal').val(tanggal);

            $('#cari_pasien').modal('hide');
            $('#btn_pasien_rawat').attr('disabled',false);
        }
    </script>
@stop
