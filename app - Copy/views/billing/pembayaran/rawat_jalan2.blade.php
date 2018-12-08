@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
@stop

@section('content')
    <div id="contentwrapper">
        <div class="main_content">
            <nav>
                <div id="jCrumbs" class="breadCrumb module">
                    <ul>
                        <li>
                            <a href="{{ action('DashboardController@index') }}"><i class="icon-home"></i></a>
                        </li>
                        <li>
                            <a href="{{ url('billing/rawat_jalan') }}">Pembayaran</a>
                        </li>
                        <li>
                            Rawat Jalan
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Biaya Rawat Jalan
                        <span style="float:right;">
                            <a href="{{ url('billing/rawat_jalan_print/'.$registrasi->NoRegJalan.'/semua') }}" target="_BLANK" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                        </span>
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

                                        if($registrasi->CaraBayar == 'BPJS' || $registrasi->CaraBayar=='KIS'){
                                            $idJenis = '1';
                                        }
                                        else{
                                            $idJenis = '2';
                                        }

                                        $admin  = DB::table('tbtindakan')->where('Otomatis' , '1')->get();
                                    ?>

                                    @if( count($admin) > 0 )
                                        <h4>Administrasi</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                        @foreach($admin as $ad)
                                        <tr>
                                            <td width="10">
                                                <input type="checkbox" class="check-all" name="chk_admin[]" value="{{ $ad->Tarif }}">
                                            </td>
                                            <td>
                                                {{ $ad->Tindakan }}
                                            </td>
                                            <td width="10%" align="right">
                                                {{ number_format( $ad->Tarif ) }}
                                            </td>
                                            <?php $total_administrasi = $total_administrasi + floatVal($ad->Tarif); ?>
                                        </tr>
                                        @endforeach
                                        </table>
                                    @endif

                                    @if(count($id_dokter) > 0)
                                    <h4>Biaya Konsul</h4>
                                    <table width="100%" border="1" colspan="2" class="report">
                                    
                                        @foreach($id_dokter as $id)
                                            <tr>
                                            <?php
                                            $dok    = DB::table('tbdaftardokter')->where('IdDokter' , $id)->first();
                                            if( !isset($dok->Spesialisasi) ){ $kat = 1; }
                                            else if( empty($dok->Spesialisasi) ){ $kat = 1; }
                                            else if( $dok->Spesialisasi == '0' || $dok->Spesialisasi == '1'){
                                                $kat = 1;
                                            }
                                            else{
                                                $kat = 2;
                                            }
                                            $tarif  = DB::table('tarif_dokter_bulk')->where('IdKategoriDokter' , $kat)->
                                            where('IdJenis' , $idJenis)->first();

                                            if( isset($tarif->IdKategoriDokter) ){
                                                    $total_konsul   += $tarif->TarifKonsul;
                                            }
                                            
                                            if($kat == 1){ $k = "Umum / Gigi"; }
                                            else $k = "Spesialis";
                                            ?>
                                            <td width="10">
                                                <input type="checkbox" class="check-all" name="chk_konsul[]" value="{{ $tarif->TarifKonsul }}">
                                            </td>
                                            <td>
                                                Konsultansi Dokter {{ $k }}
                                            </td>
                                            <td width="10%" align="right">
                                            {{ number_format( $tarif->TarifKonsul ) }}
                                            </td>
                                            </tr>
                                        @endforeach
                                    
                                    </table>
                                    @endif

                                    @if(isset($tindakan))
                                        <h4>Biaya Tindakan</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td width="10"></td>
                                                <td align="center" width="15%">Tanggal</td>
                                                <td align="center" width="60%">Tindakan</td>
                                                <td align="center" width="10%">Jenis Rawat</td>
                                                <td align="center" width="25%">Tarif</td>
                                            </tr>
                                            @foreach($tindakan as $t)
                                                <tr>
                                                    <td width="10">
                                                        <input type="checkbox" class="check-all" name="chk_tindakan[]" value="{{ $t->Tarif }}">
                                                    </td>
                                                    <td>{{ $t->TanggalTindak }}</td>
                                                    <td>{{ $t->Tindakan }}</td>
                                                    <td>{{ $t->JenisRawat }}</td>
                                                    <td align="right">{{ number_format($t->Tarif) }}</td>
                                                </tr>
                                                <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                            @endforeach
                                        </table>
                                        <br />
                                    @endif
                                    @if(isset($obat))
                                        <h4>Biaya Obat</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td width="10"></td>
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
                                                    <td width="10">
                                                        <input type="checkbox" class="check-all" name="chk_tindakan[]" value="{{ $t->Tarif }}">
                                                    </td>
                                                    <td>{{ $o->TanggalResep }}</td>
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
                                    <?php $total = $total_ruangan + $total_tindakan + $total_obat + $total_administrasi 
                                                + $total_konsul; ?>
                                    <table width="100%" border="1" colspan="2" class="report">
                                        <tr>
                                        <td width="80%">Total Keseluruhan</td>
                                        <td align="right" width="20%">{{ number_format( $total ) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <table width="100%">
                                <tr>
                                    <td><h4>Total Tagihan</h4></td>
                                    <td>:</td>
                                    <td align="right"><h4>{{ number_format($total) }}</h4></td>
                                    <input type="hidden" id="total_all" value="{{ $total }}">
                                </tr> 

                                <tr>
                                    <td><h4>Pembayaran</h4></td>
                                    <td>:</td>
                                    <td align="right">
                                        @if($registrasi->StatusBayar == 1)
                                            <input disabled="disabled" type="text" name="pembayaran" id="pembayaran">
                                        @else
                                            <input type="text" name="pembayaran" id="pembayaran">
                                        @endif
                                        
                                    </td>
                                </tr> 
                                <tr>
                                    <td><h4>Kembali</h4></td>
                                    <td>:</td>
                                    <td align="right">
                                        <input type="text" name="kembali" id="kembali" disabled="disabled">
                                    </td>
                                </tr>
                                <tr>
                                    <td><button id="btn_bayar" type="button" class="btn btn-primary">Bayar</button></td>
                                </tr> 
                                <tr>
                                    <td><h4>Status</h4></td>
                                    <td>:</td>
                                    <td> <strong>
                                        @if($registrasi->StatusBayar == 1)
                                            Sudah bayar
                                        @else
                                            Belum bayar
                                        @endif
                                        </strong>
                                    </td>
                                </tr>

                            </table>
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
            $('#pembayaran').focus();

            $('#pembayaran').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    doPayment();                
                }
                    
            });

            $('#btn_bayar').click(function(){
                konfirmasiPembayaran();
            })
        });

        function doPayment(){
            var pembayaran  = parseInt( $('#pembayaran').val() );
            var total       = parseInt( $('#total_all').val() );

            var id_reg      = '{{ $registrasi->NoRegJalan }}';

            if( pembayaran < total ){
                alert('Mohon masukkan jumlah pembayaran yang sesuai');
                $('#pembayaran').focus();
            }
            else{
                var kembali     = parseInt(pembayaran) - parseInt(total);
                $('#kembali').val(kembali);

                $('#btn_bayar').focus();
                
            }
        }

        function konfirmasiPembayaran(){
            var pembayaran  = parseInt( $('#pembayaran').val() );
            var total       = parseInt( $('#total_all').val() );

            var id_reg      = '{{ $registrasi->NoRegJalan }}';

            if( pembayaran < total ){
                alert('Mohon masukkan jumlah pembayaran yang sesuai');
                $('#pembayaran').focus();
            }
            else{
                var kembali     = parseInt(pembayaran) - parseInt(total);
                $('#kembali').val(kembali);
                var r = confirm("Tekan OK untuk menyelesaikan transaksi");
                if (r == true) {
                    $.ajax({
                        url: "{{ url('pembayaran/proses_rj') }}",
                        type: "POST",
                        data : "id_reg="+id_reg+"&total="+total+"&pembayaran="+pembayaran,
                        success:function(res){
                            if(res == 'gagal'){
                                 $.sticky("Pembayaran Gagal", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });

                                 $('#btn_bayar').focus();
                            }
                            else if( res =='sukses'){
                                $.sticky("Pembayaran Berhasil", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                                setTimeout(function(){location.reload()}, 3000);;
                            }
                            
                        }
                    });
                }   
            }
            
        }

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
