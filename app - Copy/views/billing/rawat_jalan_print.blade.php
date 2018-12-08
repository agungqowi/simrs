@extends('print')

@section('content')
    <div id="contentwrapper">
        <div class="print_content">
            <div class="row-fluid">
                <div class="span12">

                    <div class="row-fluid formSep">
                        <div class="span12">
                            <h3 align="center">{{ $rs_title }}</h3>
                            <h4 align="center">{{ $rs_alamat }}</h4>
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
                                    <td width="15%">
                                        No Registrasi
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->NoRegJalan }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Tanggal
                                    </td>
                                    <td width="30%">
                                        @if(isset($registrasi->Tanggal))
                                            {{ $registrasi->Tanggal }}
                                        @endif
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="15%">
                                        No RM
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->NoRM }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Penjamin
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->CaraBayar }}
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td width="15%">
                                        Nama
                                    </td>
                                    <td width="30%">
                                        {{ $pasien->Nama }}
                                        @if( $umur == "0" )

                                        @else
                                            {{ '('.$umur.')' }}
                                        @endif
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Dokter
                                    </td>
                                    <td width="30%">
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
                                <tr valign="top">
                                    <td width="15%">
                                        Alamat
                                    </td>
                                    <td colspan="3">
                                        {{ $pasien->Jalan }}
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

                                    @if(isset($admin) && count($admin) > 0)
                                        <h4>Biaya Admin</h4>
                                        <table width="100%" border="0" colspan="2" class="report">
                                            <tr>
                                                <td align="left" width="70%">Nama</td>
                                                <td align="right" width="30%">Tarif</td>
                                            </tr>
                                            @foreach($admin as $t)
                                                <tr>
                                                    <td>{{ $t->Tindakan }}</td>
                                                    <td align="right">{{ number_format($t->Tarif) }}</td>
                                                </tr>
                                                <?php $total_administrasi = $total_administrasi + $t->Tarif; ?>
                                            @endforeach
                                        </table>
                                    @endif

                                    @if(isset($tindakan) && count($tindakan) > 0)
                                        <h4>Biaya Tindakan</h4>
                                        <table width="100%" border="0" colspan="2" class="report">
                                            <tr>
                                                <td align="left" width="65%">Tindakan</td>
                                                <td align="left" width="10%">Gol</td>
                                                <td align="right" width="25%">Tarif</td>
                                            </tr>
                                            @foreach($tindakan as $t)
                                                <tr>
                                                    <td>{{ $t->Tindakan }}</td>
                                                    <td>{{ $t->Gol }}</td>
                                                    <td align="right">{{ number_format($t->Tarif) }}</td>
                                                </tr>
                                                <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                            @endforeach
                                        </table>
                                    @endif
                                    @if(isset($obat) && count($obat) > 0)
                                        <h4>Biaya Obat</h4>
                                        <table width="100%" border="0" colspan="2" class="report">
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
                                    <table width="100%" border="0" colspan="2" class="report">
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
                            <div style="float:right;width:300px;">
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
                                    <h4> <?php echo $tanggal.' '.$bulan[$m].' '.$tahun; ?><br />
                                    Kasir
                                    </h4>
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
