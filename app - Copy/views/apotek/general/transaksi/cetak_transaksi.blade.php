@extends('print_big')

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
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <table width="100%" border="0" align="center">
                                <tr valign="top">
                                    <td width="15%">
                                        No Reg
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->NoReg }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Tanggal
                                    </td>
                                    <td width="30%">
                                        @if(isset($registrasi->tanggal_transaksi ))
                                            {{ $registrasi->tanggal_transaksi }}
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
                                        {{ $registrasi->Nama }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Jenis Rawat
                                    </td>
                                    <td width="30%">{{ $registrasi->JenisRawat }}
                                    </td>
                                </tr>
                            </table>
                            <br />
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php 
                                        $total_obat = 0; 

                                        if($registrasi->CaraBayar == 'BPJS' || $registrasi->CaraBayar=='KIS'){
                                            $idJenis = '1';
                                        }
                                        else{
                                            $idJenis = '2';
                                        }

                                    ?>
                                    @if(isset($obat))
                                        <table width="100%" border="0" colspan="2" class="report">
                                            <tr>
                                                <td align="left" width="15%">Tanggal</td>
                                                <td align="left" width="60%">Nama Obat</td>
                                                <td align="right" width="10%">Harga</td>
                                                <td align="right" width="5%">Jml</td>
                                                <td align="right" width="20%">Total</td>
                                            </tr>
                                            @foreach($obat as $o)
                                                <tr 
                                                    >
                                                    <td>{{ $o->TanggalResep }}</td>
                                                    <td>{{ $o->NamaObat }}</td>
                                                    <td align="right">{{ number_format($o->Harga) }}</td>
                                                    <td align="right">{{ $o->Jumlah }}</td>
                                                    <td align="right">{{ number_format($o->TotalHarga) }}</td>
                                                </tr>
                                                <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                            @endforeach

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
                                                <td align="right" colspan="4">Subtotal</td>
                                                <td align="right">{{ number_format($subtotal_obat) }}</td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="4">UJR</td>
                                                <td align="right">{{ number_format($ujr) }}</td>
                                            </tr>
                                            <tr>
                                                <td align="right" colspan="4">Total Obat</td>
                                                <td align="right">{{ number_format($total_obat) }}</td>
                                            </tr>
                                        </table>
                                        <br />
                                    @endif
                                </div>
                                
                            </div>
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
                                    <?php echo $tanggal.' '.$bulan[$m].' '.$tahun; ?><br />
                                    <h4>
                                    Petugas Apotek
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
