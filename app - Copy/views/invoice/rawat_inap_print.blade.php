@extends('print')

@section('content')
    <div id="contentwrapper">
        <div class="print_content">

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Biaya Rawat Inap
                    </h3>
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
                            <h3 align="center">{{ $rs_title }}</h3>
                            <h4 align="center">{{ $rs_alamat }}</h4>
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td width="15%">
                                        No Registrasi
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->NoReg }}
                                    </td>
                                    <td width="10%"></td>
                                    <td width="15%">
                                        SEP
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->Sep }}
                                    </td>
                                </tr>                                    
                                <tr>
                                    <td width="15%">
                                        No RM
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->NoRM }}
                                    </td>
                                    <td width="10%"></td>
                                    <td width="15%">
                                        Nama
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->Nama }}
                                        @if( $umur == "0" )

                                        @else
                                            {{ '('.$umur.')' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%">
                                        Alamat
                                    </td>
                                    <td colspan="3">
                                        {{ $registrasi->Jalan }}
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="15%">
                                        Dokter DPJP
                                    </td>
                                    <td width="30%">
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
                                    <td width="10%"></td>
                                    <td width="15%">
                                        Dokter Konsul
                                    </td>
                                    <td width="30%">
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
                                        <h4>Biaya Tindakan Poli / UGD</h4>
                                        @if( count($tindakan_jalan) > 0 )
                                            <table width="100%" border="1" colspan="2" class="report">
                                                <tr>
                                                    <td align="center" width="15%">Tanggal</td>
                                                    <td align="center" width="60%">Tindakan</td>
                                                    <td align="center" width="10%">Jenis Rawat</td>
                                                    <td align="center" width="25%">Tarif</td>
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
                                        <h4>Biaya Ruangan</h4>

                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="60%">Keterangan</td>
                                                <td align="center" width="10%">Quantity</td>
                                                <td align="center" width="15%">Harga</td>
                                                <td align="center" width="15%">Total</td>
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
                                                <h4>Biaya Tindakan {{ $t->Gol }}</h4>
                                                <table width="100%" border="1" colspan="2" class="report">
                                                    <tr>
                                                        <td align="center" width="15%">Tanggal</td>
                                                        <td align="center" width="60%">Tindakan</td>
                                                        <td align="center" width="25%">Tarif</td>
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
                                        <h4>Biaya Obat Poli / UGD</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr style="display:none;">
                                                <td align="center" width="15%">Tanggal</td>
                                                <td align="center" width="60%">Nama Obat</td>
                                                <td align="center" width="10%">Harga</td>
                                                <td align="center" width="5%">Jumlah</td>
                                                <td align="center" width="20%">Total</td>
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
                                        <h4>Biaya Obat</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr style="display:none;">
                                                <td align="center" width="15%">Tanggal</td>
                                                <td align="center" width="60%">Nama Obat</td>
                                                <td align="center" width="10%">Harga</td>
                                                <td align="center" width="5%">Jumlah</td>
                                                <td align="center" width="20%">Total</td>
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
                                    <h4>Total Keseluruhan</h4>
                                    <table width="100%" border="1" colspan="2" class="report">
                                        <tr>
                                        <td width="80%">Total Keseluruhan</td>
                                        <td align="right" width="20%">{{ number_format( $total ) }}</td>
                                        </tr>
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
