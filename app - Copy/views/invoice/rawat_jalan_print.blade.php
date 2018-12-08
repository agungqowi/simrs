@extends('print')

@section('content')
    <div id="contentwrapper">
        <div class="print_content">
            <div class="row-fluid">
                <div class="span12">

                    <div class="row-fluid">
                        <div class="span12">
                            <h3 align="center">{{ $rs_title }}</h3>
                            <h4 align="center">{{ $rs_alamat }}</h4>
                        </div>
                    </div>
                    @if(isset($registrasi))
                    <div class="row-fluid">
                        <div class="span12">
                            <table width="100%" border="0" align="center">
                                <tr>
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
                                <tr>
                                    <td width="15%">
                                        No RM
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->NoRM }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Poli
                                    </td>
                                    <td width="30%">
                                        @if(isset($registrasi->Poli))
                                            {{ $registrasi->Poli }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%">
                                        Nama
                                    </td>
                                    <td width="30%">
                                        {{ $pasien->Nama }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Dokter
                                    </td>
                                    <td width="30%">
                                        @if(isset($dokter))
                                            @foreach($dokter as $d)
                                                {{ $d->NamaDokter."<br />" }}
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
                                        $total_administrasi = 40000;
                                    ?>
                                    @if(isset($total_administrasi))
                                        <h4>Biaya Administrasi</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="75%">Nama</td>
                                                <td align="center" width="25%">Tarif</td>
                                            </tr>
                                            <tr>
                                                <td align="center" width="75%">Konsul Dokter Ahli</td>
                                                <td align="right" width="25%">{{ number_format($total_administrasi) }}</td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if(isset($tindakan))
                                        <h4>Biaya Tindakan</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="15%">Tanggal</td>
                                                <td align="center" width="60%">Tindakan</td>
                                                <td align="center" width="10%">Gol</td>
                                                <td align="center" width="25%">Tarif</td>
                                            </tr>
                                            @foreach($tindakan as $t)
                                                <tr>
                                                    <td>{{ $t->TanggalTindak }}</td>
                                                    <td>{{ $t->Tindakan }}</td>
                                                    <td>{{ $t->Gol }}</td>
                                                    <td align="right">{{ number_format($t->Tarif) }}</td>
                                                </tr>
                                                <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                            @endforeach
                                            <tr>
                                                <td colspan="3">Total Biaya Tindakan</td>
                                                <td align="right">{{ number_format($total_tindakan) }}</td>
                                            </tr>
                                        </table>
                                        <br />
                                    @endif
                                    @if(isset($obat))
                                        <h4>Biaya Obat</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="15%">Tanggal</td>
                                                <td align="center" width="60%">Nama Obat</td>
                                                <td align="center" width="10%">Harga</td>
                                                <td align="center" width="5%">Jumlah</td>
                                                <td align="center" width="20%">Total</td>
                                            </tr>
                                            @foreach($obat as $o)
                                                <tr @if($cetak_obat=='total') 
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
                                            <tr>
                                                <td colspan="4">Total Biaya Obat</td>
                                                <td align="right">{{ number_format($total_obat) }}</td>
                                            </tr>
                                        </table>
                                        <br />
                                    @endif
                                    <?php $total = $total_ruangan + $total_tindakan + $total_obat +  $total_administrasi; ?>
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
