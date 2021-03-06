@extends('print')

@section('content')
    <div id="contentwrapper">
        <div class="print_content">
            <div id="contentwrapper">

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Biaya APS
                    </h3>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
                        </div>
                    @endif

                    
                    @if(isset($registrasi))
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span12">
                                    <h3 align="center">{{ $rs_title }}</h3>
                                    <h4 align="center">{{ $rs_alamat }}</h4>
                                </div>
                            </div>
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td width="15%">
                                        No Registrasi
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->id }}
                                    </td>
                                    <td width="10%">

                                    </td>
                                    <td width="15%">
                                        Tanggal
                                    </td>
                                    <td width="30%">
                                        @if(isset($registrasi->tanggal))
                                            {{ $registrasi->tanggal }}
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
                                        Penjamin
                                    </td>
                                    <td width="30%">
                                        {{ $pasien->CaraBayar }}
                                    </td>
                                </tr>
                                <tr>
                                    <td width="15%">
                                        Unit
                                    </td>
                                    <td width="30%">
                                        {{ $pasien->NamaPenunjang }}
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

                                        if($pasien->CaraBayar == 'BPJS' || $pasien->CaraBayar=='KIS'){
                                            $idJenis = '1';
                                        }
                                        else{
                                            $idJenis = '2';
                                        }

                                    ?>

                                    @if(isset($tindakan))
                                        <h4>Biaya Tindakan</h4>
                                        @if( count($tindakan) > 0 )
                                            <table width="100%" border="1" colspan="2" class="report">
                                                <tr>
                                                    <td align="center" width="15%">Tanggal</td>
                                                    <td align="center" width="60%">Tindakan</td>
                                                    <td align="center" width="10%">Jenis Rawat</td>
                                                    <td align="center" width="25%">Tarif</td>
                                                </tr>
                                                @foreach($tindakan as $t)
                                                    @if($t->StatusBayar == 1)
                                                        <?php $disabled = "disabled ='disabled' "; ?>
                                                        <?php $bgcolor  = "bgcolor='yellow'"; ?>
                                                    @else
                                                        <?php $disabled = ""; ?>
                                                        <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                                        <?php $bgcolor  = ""; ?>
                                                    @endif
                                                        
                                                    <tr {{ $bgcolor }}>
                                                        <td>{{ $t->TanggalTindak }}</td>
                                                        <td>{{ $t->Tindakan }}</td>
                                                        <td>{{ $t->JenisRawat }}</td>
                                                        <td align="right">{{ number_format($t->Tarif) }}</td>
                                                    </tr>
                                                        
                                                @endforeach
                                            </table>
                                        @endif
                                        <br />
                                    @endif

                                    @if(isset($obat))
                                        <h4>Biaya Obat</h4>
                                        @if( count($obat) > 0 )
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="10">
                                                    <input checked="checked" id="chk_obat1" type="checkbox" name="chk_obat1" value="1">
                                                </td>
                                                <td align="center" width="60%">Nama Obat</td>
                                                <td align="center" width="10%">Harga</td>
                                                <td align="center" width="">Jumlah</td>
                                                <td align="center" width="20%">Total</td>
                                            </tr>
                                            <?php $ujr = 0; ?>
                                            
                                            @foreach($obat as $o)
                                                @if($o->StatusBayarDetail == 1)
                                                    <?php $disabled = "disabled ='disabled' "; ?>
                                                    <?php $bgcolor  = "bgcolor='yellow'"; ?>
                                                @else
                                                    <?php $disabled = ""; ?>
                                                    <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                                    <?php $bgcolor  = ""; ?>
                                                @endif
                                                <tr @if($cetak_obat=='total')
                                                        style="display:none;"
                                                    @endif

                                                    {{ $bgcolor }}
                                                    >
                                                    <td>                                                        
                                                        @if($o->StatusBayarDetail != 1)
                                                        <input checked="checked" {{ $disabled }} type="checkbox" name="chk_obat[]" class="check-all check-obat"
                                                        data-id="{{ $o->id }}"
                                                            value="{{ $o->TotalHarga }}">
                                                        @endif
                                                    </td>
                                                    <td>{{ $o->NamaObat }}</td>
                                                    <td align="right">{{ number_format($o->Harga) }}</td>
                                                    <td align="right">{{ $o->Jumlah }}</td>
                                                    <td align="right">{{ number_format($o->TotalHarga) }}</td>
                                                </tr>
                                            @endforeach

                                            @if( $id_penjualan != 0 )
                                                <?php $data_penjualan = DB::table('apo_penjualan')->where('id' , $id_penjualan)->first(); 
                                                    if( isset($data_penjualan->id) ){
                                                        $ujr    = $data_penjualan->ujr;
                                                        $subtotal_obat  = $data_penjualan->subtotal;
                                                        $total_obat     = $data_penjualan->total;

                                                        if( $data_penjualan->StatusBayar == 1 ){
                                                            $subtotal_obat  = 0;
                                                            $total_obat     = 0;
                                                        }
                                                    }
                                                    else{
                                                        $ujr = 0;
                                                    }
                                                ?>
                                            @endif

                                            <tr>
                                                <td colspan="4">Subtotal</td>
                                                <td id="subtotal_obat" align="right">
                                                    {{ number_format($subtotal_obat) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <input checked="checked" readonly="readonly" type="checkbox" 
                                                        name="chk_ujr[]" class="check-all" 
                                                        disabled="disabled" 
                                                        id="chk_ujr" 
                                                        data-id="0"
                                                        value="{{ $ujr }}">UJR
                                                </td>
                                                <td align="right">{{ number_format($ujr) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Total Obat</td>
                                                <td id="total_obat" align="right">{{ number_format($total_obat) }}</td>
                                            </tr>
                                        </table>
                                        @endif
                                        <input type="hidden" id="hd_total_obat" value="{{ $total_obat }}">

                                        <br />
                                    @endif
                                    <?php $total = $total_ruangan + $total_tindakan + $total_obat + $total_administrasi 
                                                + $total_konsul; ?>
                                    <table width="100%" border="1" colspan="2" class="report">
                                        <tr>
                                        <td width="80%">Total Keseluruhan</td>
                                        <td align="right" width="20%">
                                            <span id="total_keseluruhan">{{ number_format( $total ) }}</span>
                                        </td>
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
