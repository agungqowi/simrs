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
                            APS
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Biaya APS
                        <span style="float:right;">
                            <a href="{{ url('pembayaran/penunjang_print/'.$pasien->id.'/semua') }}" target="_BLANK" class="btn btn-primary">
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
                        <div class="span8">
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
                                                    <td width="10">
                                                        <input checked="checked" id="chk_tindakan" type="checkbox" name="chk_tindakan1" value="1">
                                                    </td>
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
                        <div class="span4">
                            <?php 
                                $sudah = 0;
                                if( $pasien->StatusBayar == 1 ){
                                    $sudah  = 1;
                                } 
                            ?>
                            <table width="100%">
                                <tr>
                                    <td><h4>Total Tagihan</h4></td>
                                    <td>:</td>
                                    <td align="right"><h4 id="h4_total">{{ number_format($total) }}</h4></td>
                                    <input type="hidden" id="total_all" value="{{ $total }}">
                                </tr> 

                                <tr>
                                    <td><h4>Pembayaran</h4></td>
                                    <td>:</td>
                                    <td align="right">
                                        @if($sudah == 1)
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

                                    @if($sudah > 0)
                                        <td border="1"><b>LUNAS</b></td>
                                    @else
                                        <td>BELUM BAYAR</td>
                                        <td>:</td>
                                        <td>&nbsp;&nbsp;<button id="btn_bayar" type="button" class="btn btn-primary">Bayar</button>
                                        </td>
                                    @endif
                                    
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

            $('.check-all').each(function(){
                $(this).change(function(){
                    changeTotal();
                });
            });

            $('.check-obat').each(function(){
                $(this).change(function(){
                    changeObat();
                });
            });


        });

        function changeObat(){
            var subtotal_obat  = 0;
            $('.check-obat').each(function(){
                if( $(this).prop( "checked" ) ){
                    subtotal_obat += parseInt( $(this).val() )
                    console.log(subtotal_obat);
                }
            });

            var ujr         = parseInt( $('#chk_ujr').val() );

            $('#subtotal_obat').html( number_format(subtotal_obat) );

            var total_obat  = subtotal_obat + ujr;

            $('#total_obat').html( number_format(total_obat) );
            $('#hd_total_obat').val( total_obat );
        }

        function changeTotal(){
            var total_all   = 0;
            $('.check-all').each(function(){
                if( $(this).prop( "checked" ) ){
                    total_all += parseInt( $(this).val() )
                    console.log(total_all);
                }
            });



            $('#total_all').val( total_all );

            $('#h4_total').html( number_format(total_all) );
            $('#total_keseluruhan').html( number_format(total_all) );
        }

        function number_format (number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        function doPayment(){
            var pembayaran  = parseInt( $('#pembayaran').val() );
            var total       = parseInt( $('#total_all').val() );

            var id_reg      = '{{ $registrasi->id }}';

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
            var total_obat  = parseInt( $('#hd_total_obat').val() );

            var id_reg      = '{{ $registrasi->id }}';
            var id_pasien   = '{{ $pasien->id }}';

            if( pembayaran < total ){
                alert('Mohon masukkan jumlah pembayaran yang sesuai');
                $('#pembayaran').focus();
            }
            else{
                var kembali     = parseInt(pembayaran) - parseInt(total);
                $('#kembali').val(kembali);

                var _data = { 'admin[]' : [] , 'konsul[]' : [] , 'tindakan[]' : [] ,'obat[]' : [] , "id_reg" : id_reg ,"total_obat" : total_obat , "total" : total , "pembayaran" : pembayaran , "id_pasien" : id_pasien};

                $('.check-admin').each(function(){
                    if( $(this).prop( "checked" ) ){
                        _data['admin[]'].push( $(this).attr('data-id') );
                    }
                });


                $('.check-konsul').each(function(){
                    if( $(this).prop( "checked" ) ){
                        _data['konsul[]'].push( $(this).attr('data-id') );
                    }
                })


                $('.check-tindakan').each(function(){
                    if( $(this).prop( "checked" ) ){
                        _data['tindakan[]'].push( $(this).attr('data-id') );
                    }
                });

                $('.check-obat').each(function(){
                    if( $(this).prop( "checked" ) ){
                        _data['obat[]'].push( $(this).attr('data-id') );
                    }
                })
                var r = confirm("Tekan OK untuk menyelesaikan transaksi");

                console.log(_data);
                if (r == true) {
                    $.ajax({
                        url: "{{ url('pembayaran/proses_penunjang') }}",
                        type: "POST",
                        data : _data,
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