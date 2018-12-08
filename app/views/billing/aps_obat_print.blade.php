@extends('print')

@section('content')
    <div id="contentwrapper">
        <div class="print_content">

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Biaya Obat
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
                    <div id="printarea" class="row-fluid">
                        <div class="span12">
                            <h3 align="center">{{ $rs_title }}</h3>
                            <h4 align="center">{{ $rs_alamat }}</h4>
                            <table width="100%" border="0" align="center">
                                
                            </table>
                            <br />
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php 
                                        $total_obat         = 0;
                                    ?>
                                    
                                    @if(isset($obat))
                                        <h4>Biaya Obat</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="60%">Nama Obat</td>
                                                <td align="center" width="10%">Harga</td>
                                                <td align="center" width="5%">Jumlah</td>
                                                <td align="center" width="20%">Total</td>
                                            </tr>
                                            @foreach($obat as $o)
                                                <tr>
                                                    <td>{{ $o->NamaObat }}</td>
                                                    <td align="right">{{ number_format($o->Harga) }}</td>
                                                    <td align="right">{{ $o->Jumlah }}</td>
                                                    <td align="right">{{ number_format($o->TotalHarga) }}</td>
                                                </tr>
                                                <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                            @endforeach
                                        </table>
                                        <br />
                                    @endif
                                    <?php $total = $total_obat; ?>
                                    <table width="100%" border="1" colspan="2" class="report">
                                        <tr>
                                        <td width="80%">Total Keseluruhan</td>
                                        <td align="right" width="20%">{{ number_format( $total ) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br /><br />
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
