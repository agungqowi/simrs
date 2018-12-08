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
                            <a href="{{ url('invoice/rawat_inap') }}">Pembayaran</a>
                        </li>
                        <li>
                            Rawat Inap
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Biaya Rawat Inap
                        <span style="float:right;">
                             <a href="{{ url('invoice/rawat_inap_print/'.$registrasi->NoReg.'/'.$cetak_obat) }}" target="_BLANK" class="btn btn-primary">
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

                    <?php $reg = array(); ?>
                    @if(isset($registrasi))
                        @foreach($inap as $re)
                            <?php $reg[ $re->Tanggal ] = $re->Ruangan; ?>
                        @endforeach
                    <div id="printarea" class="row-fluid">
                        <div class="span8">
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
                                </tr>
                                <tr>
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
                                </tr>
                                <tr>
                                    <td width="15%">
                                        Nama
                                    </td>
                                    <td width="30%">
                                        {{ $registrasi->Nama }}
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
                                </tr>
                                <tr valign="top">
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
                                <tr valign="top">
                                    <td width="15%">
                                        Dokter Rawat Bersama
                                    </td>
                                    <td width="30%">
                                        @if(isset($dokter))
                                            @foreach($dokter as $d)
                                                @if($d->Kategori == 'Rawat Bersama')
                                                    {{ $d->NamaDokter."<br />" }}
                                                @endif
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
                                        $total_visite = 0;
                                        $total_tindakan_jalan = 0;
                                        $total_obat_jalan       = 0;
                                    ?>
                                    @if(isset($tindakan_jalan))
                                        <h4>Biaya Tindakan Poli / UGD</h4>
                                        @if( count($tindakan_jalan) > 0 )
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
                                            @foreach($tindakan_jalan as $t)
                                                @if($t->StatusBayar == 1)
                                                    <?php $disabled = "disabled ='disabled' "; ?>
                                                    <?php $bgcolor  = "bgcolor='yellow'"; ?>
                                                @else
                                                    <?php $disabled = ""; ?>
                                                    <?php $total_tindakan_jalan = $total_tindakan_jalan + $t->Tarif; ?>
                                                    <?php $bgcolor  = ""; ?>
                                                @endif
                                                    
                                                <tr {{ $bgcolor }}>
                                                    <td width="10">=
                                                        <input checked="checked" {{ $disabled }} type="checkbox" name="chk_tindakan[]" class="check-all check-tindakan"
                                                        data-id="{{ $t->IdDetailTindak }}"
                                                            value="{{ $t->Tarif }}">=
                                                    </td>
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
                                        <h4>Biaya Obat Rawat Inap</h4>
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
                                    <?php $total =  $total_ruangan + $total_tindakan_jalan + 
                                                    $total_tindakan + $total_obat_jalan +
                                                    $total_obat + $total_visite; ?>
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
    {{ HTML::script('js/jquery.printElement.min.js') }}
    <script type="text/javascript">


        function do_print(){
            var css = "";
            $('link').each(function(){
                css += '<link media="all" type="text/css" rel="stylesheet" href="' + $(this).attr('href') + '">';
            })
            w=window.open(null, 'Print_Page', 'scrollbars=yes');
            w.document.write( css + $('#printarea').html() );
            w.document.close();
            
            setTimeout(function () { w.print(); }, 1000);
        }
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

            var id_reg      = '{{ $registrasi->NoReg }}';

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

            var id_reg      = '{{ $registrasi->NoReg }}';

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
                        url: "{{ url('pembayaran/proses_ri') }}",
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
