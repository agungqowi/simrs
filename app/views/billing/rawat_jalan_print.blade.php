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

                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div align="center"><b>{{ $rs_title }}</b></div>
                            <div align="center">{{ $rs_alamat }}</div>
                        </div>
                    </div>
                    @if(isset($registrasi))
                    <?php 
                        $umur     = 0;
                        $tgl_lahir  = $pasien->TanggalLahir;
                        if( $tgl_lahir == '0000-00-00' ){
                            $umur    = 0;
                        }
                        else{
                            $umur   = $helper->umurTahun( $tgl_lahir, $registrasi->Tanggal );
                        }
                    ?>
                        
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <table width="100%" border="0" align="center">
                                <tr valign="top">
                                    <td>
                                        No Registrasi
                                    </td>
                                    <td>
                                        {{ $registrasi->NoRegJalan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal
                                    </td>
                                    <td>
                                        @if(isset($registrasi->Tanggal))
                                            {{ $registrasi->Tanggal }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        No RM
                                    </td>
                                    <td>
                                        {{ $registrasi->NoRM }} - {{ $registrasi->CaraBayar }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama
                                    </td>
                                    <td>
                                        {{ $pasien->Nama }}
                                        @if( $umur == "0" )

                                        @else
                                            {{ '('.$umur.')' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Dokter
                                    </td>
                                    <td>
                                        <?php $polis = DB::table('tbpasienjalan')->where('NoRegJalan' , $registrasi->NoRegJalan)->get(); ?>
                                        <?php $poli = $dokter = $id_dokter =array(); ?>
                                        @if( count($polis) > 0 )
                                            @foreach($polis as $po)
                                                <?php
                                                $poli[]     = $po->Dokter. ' ('.$po->Poli.')';
                                                $id_dokter[]= $po->IdDokter;
                                                $dokter[]   = $po->Dokter;
                                                ?>
                                            @endforeach
                                        @endif

                                        @if( count($poli) > 0 )
                                            {{ implode('<br />' , $poli ) }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <br />
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php 
                                        $total_konsul   = 0;
                                        $total_tindakan = 0;
                                        $total_obat = 0; 
                                        $total_ruangan = 0;
                                        $total_administrasi = 0;

                                        if($registrasi->CaraBayar == 'BPJS' || $registrasi->CaraBayar=='KIS'){
                                            $idJenis = '1';
                                        }
                                        else{
                                            $idJenis = '2';
                                        }

                                    ?>

                                    @if(isset($tindakan) && count($tindakan) > 0)
                                        <b>Biaya Tindakan</b>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td align="left" width="65%">Tindakan</td>
                                                <td align="right" width="35%">Tarif</td>
                                            </tr>
                                            @foreach($tindakan as $t)
                                                <tr>
                                                    <td>{{ $t->Tindakan }}</td>
                                                    <td align="right">{{ number_format($t->Tarif) }}</td>
                                                </tr>
                                                <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                            @endforeach
                                        </table>
                                    @endif
                                    @if(isset($obat) && count($obat) > 0)
                                        <b>Biaya Obat</b>
                                        <table width="100%" border="0">
                                            <tr>
                                                <td align="left" width="60%">Nama Obat</td>
                                                <td align="right" width="10%">Harga</td>
                                                <td align="right" width="10%">Jml</td>
                                                <td align="right" width="20%">Total</td>
                                            </tr>
                                            <?php $ujr = 0; ?>
                                            
                                            @foreach($obat as $o)
                                                <tr @if($cetak_obat=='total') 
                                                        style="display:none;"
                                                    @endif
                                                    >
                                                    <td>{{ $o->NamaObat }}</td>
                                                    <td align="right">{{ number_format($o->Harga) }}</td>
                                                    <td align="right">{{ $o->Jumlah }}</td>
                                                    <td align="right">{{ number_format($o->TotalHarga) }}</td>
                                                </tr>
                                                <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                            @endforeach

                                            <?php $subtotal_obat = $total_obat; ?>
                                            
                                            @if( $id_penjualan != 0 )
                                                <?php $data_penjualan = DB::table('apo_penjualan')->where('id' , $id_penjualan)->first(); 
                                                    if( isset($data_penjualan->ujr) ){
                                                        $ujr    = $data_penjualan->ujr;
                                                        $subtotal_obat  = $data_penjualan->subtotal;
                                                        $total_obat     = $data_penjualan->total;
                                                    }
                                                    else{
                                                        $ujr = 0;
                                                    }
                                                ?>
                                            @endif
                                            <tr height="10">
                                            <td></td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="3">Subtotal</td>
                                                <td align="right">{{ number_format($subtotal_obat) }}</td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="3">UJR</td>
                                                <td align="right">{{ number_format($ujr) }}</td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="3">Total Obat</td>
                                                <td align="right">{{ number_format($total_obat) }}</td>
                                            </tr>
                                        </table>
                                        <br />
                                    @endif
                                    <?php $total = $total_ruangan + $total_tindakan + $total_obat + $total_administrasi 
                                                + $total_konsul; ?>
                                    <table width="100%" border="0">
                                        <tr>
                                        <td align="right" width="80%">Total Keseluruhan</td>
                                        <td align="right" width="20%">{{ number_format( $total ) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                
                            </div>
                            @if($registrasi->StatusBayar == 1)
                                        <div class="lunas">
                                            LUNAS
                                        </div>
                                    @endif
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
                                            {{ $pasien->Nama }}
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
