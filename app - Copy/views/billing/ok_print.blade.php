@extends('print')

@section('content')
    <div id="contentwrapper">
        <div class="print_content">
            <div class="row-fluid">
                <div class="span12">
                    @if(isset($registrasi))
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span12">
                                    <h3 align="center">{{ $rs_title }}</h3>
                                    <h4 align="center">{{ $rs_alamat }}</h4>
                                </div>
                            </div>
                            <h5 align="center">UNIT OK</h5>
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
                                            {{ $registrasi->Tanggal }} {{ $registrasi->jam_daftar }}
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
                                        {{ $registrasi->CaraBayar }}
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
                                        $ujr    = 0;

                                        if($registrasi->CaraBayar == 'BPJS' || $registrasi->CaraBayar=='KIS'){
                                            $idJenis = '1';
                                        }
                                        else{
                                            $idJenis = '2';
                                        }

                                    ?>
                                    <?php 
                                        $limit_obat         = 0;
                                        $limit_lab          = 0;
                                        $persentase_obat    = 0;
                                        $persentase_lab     = 0;

                                        $total_lab          = 0;
                                        $tindakan_lab       = array();

                                    ?>
                                    @if(isset($tindakan))
                                        <h4>Biaya Tindakan</h4>
                                        @if( count($tindakan) > 0 )
                                            <table width="100%" border="1" colspan="2" class="report">
                                                <tr>
                                                    <td width="10">
                                                        <input checked="checked" id="chk_tindakan" type="checkbox" name="chk_tindakan1" value="1">
                                                    </td>
                                                    <td align="center" width="15%">Tanggal</td>
                                                    <td align="center" width="60%">Tindakan</td>
                                                    <td align="center" width="10%">Jenis Rawat</td>
                                                    <td align="center" width="25%">Tarif</td>
                                                </tr>
                                            @foreach($tindakan as $t)
                                                <?php $jenis_rawat  = strtoupper($t->JenisRawat); ?>
                                                @if( $jenis_rawat == 'LAB' || $jenis_rawat == 'LABORATORIUM' )
                                                    <?php $total_lab    = $total_lab + floatVal( $t->Tarif ); ?>
                                                @else
                                                    @if($t->StatusBayar == 1)
                                                        <?php $disabled = "disabled ='disabled' "; ?>
                                                        <?php $bgcolor  = "bgcolor='yellow'"; ?>
                                                    @else
                                                        <?php $disabled = ""; ?>
                                                        <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                                        <?php $bgcolor  = ""; ?>
                                                    @endif

                                                    <?php
                                                        $id_tindakan    = $t->IdTindakan;

                                                        $check      = DB::table('tarif_limit')->where('IdTindakan' , $id_tindakan)->first();

                                                        if( isset($check->IdTindakan) ){
                                                            $limit_lab      = $check->Lab;
                                                            $limit_obat     = $check->Obat;

                                                            $persentase_lab     = $check->PersentaseLab;
                                                            $persentase_obat    = $check->PersentaseObat;
                                                        }
                                                    ?>
                                                        
                                                    <tr {{ $bgcolor }}>
                                                        <td width="10">
                                                            @if($t->StatusBayar != 1)
                                                            <input checked="checked" {{ $disabled }} type="checkbox" name="chk_tindakan[]" class="check-all check-tindakan"
                                                            data-id="{{ $t->IdDetailTindak }}"
                                                                value="{{ $t->Tarif }}">
                                                            @endif
                                                        </td>
                                                        <td>{{ $t->TanggalTindak }}</td>
                                                        <td>{{ $t->Tindakan }}</td>
                                                        <td>{{ $t->JenisRawat }}</td>
                                                        <td align="right">{{ number_format($t->Tarif) }}</td>
                                                    </tr>
                                                @endif
                                                    
                                            @endforeach
                                            </table>
                                        @endif
                                        <br />
                                    @endif

                                    @if( isset($penjualan) && count($penjualan) > 0 )
                                        
                                        @foreach( $penjualan as $p )
                                            @if(isset($p->id))
                                            <?php $obat     = DB::table('apo_penjualan_detail')->where('id_penjualan' , $p->id)->get(); ?>
                                            @foreach($obat as $o)
                                                <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                            @endforeach
                                                @if($p->ujr != 0)
                                                    <?php $ujr    = $ujr + intVal( $p->ujr ); ?>
                                                @endif
                                            @endif
                                        @endforeach
                                            
                                        @if($ujr > 0)
                                            <?php $total_obat   = intVal($total_obat) + intVal($ujr); ?>
                                        @endif

                                        <?php
                                            if( $limit_obat > 0 ){
                                                $obat       = $total_obat * (1 - floatval($persentase_obat) );
                                                if( $obat > $limit_obat ){
                                                    $obat   = $obat - $limit_obat;
                                                    $total_obat     = $obat * (1+floatval($persentase_obat));
                                                }
                                                else{
                                                    $total_obat     = 0;
                                                }
                                            }

                                        ?>
                                        @if($total_obat > 0)
                                            <h4>Biaya Obat</h4>
                                            <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td width="80%">Total Obat</td>
                                                <td align="right">{{ number_format($total_obat) }}</td>
                                            </tr>
                                            </table>
                                            <br />
                                        @endif
                                    @endif

                                    @if( $total_lab > 0 )
                                        <?php
                                            if( $limit_lab > 0 ){
                                                $lab       = $total_lab * (1 - floatval($persentase_lab) );
                                                if( $lab > $limit_lab ){
                                                    $lab        = $lab - $limit_lab;
                                                    $total_lab  = $lab * (1+floatval($persentase_lab));
                                                }
                                                else{
                                                    $total_lab     = 0;
                                                }
                                            }

                                        ?>
                                        @if($total_lab > 0)
                                            <h4>Biaya Lab</h4>
                                            <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td width="80%">Total Lab</td>
                                                <td align="right">{{ number_format($total_lab) }}</td>
                                            </tr>
                                            </table>
                                            <br />
                                        @endif
                                    @endif 

                                    <?php $total = $total_ruangan + $total_lab + $total_tindakan + $total_obat + $total_administrasi 
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
