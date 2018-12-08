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
                            VK
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Biaya VK
                        <span style="float:right;">
                            <a href="{{ url('billing/vk_print/'.$registrasi->NoRegJalan.'/semua') }}" target="_BLANK" class="btn btn-primary">
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
                        <div class="span4">
                            <?php $sudah = 0; $belum = 0; ?>
                            @if(count($polis) > 0 )
                                @foreach($polis as $po)
                                    @if($po->StatusBayar == 1)
                                        <?php $sudah++; ?>
                                    @else
                                        <?php $belum++; ?>
                                    @endif
                                @endforeach
                            @endif
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
                                        @if($belum == 0)
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

                                    @if($sudah > 0 && $belum > 0)
                                        <td>KURANG BAYAR</td>
                                        <td>:</td>
                                        <td><button id="btn_bayar" type="button" class="btn btn-primary">Bayar</button>
                                        </td>
                                    @elseif($sudah > 0)
                                        <td border="1"><b>LUNAS</b></td>
                                    @elseif($belum > 0)
                                        <td>BELUM BAYAR</td>
                                        <td>:</td>
                                        <td>&nbsp;&nbsp;<button id="btn_bayar" type="button" class="btn btn-primary">Bayar</button>
                                        </td>
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
            var total_obat  = parseInt( $('#hd_total_obat').val() );

            var id_reg      = '{{ $registrasi->NoRegJalan }}';

            if( pembayaran < total ){
                alert('Mohon masukkan jumlah pembayaran yang sesuai');
                $('#pembayaran').focus();
            }
            else{
                var kembali     = parseInt(pembayaran) - parseInt(total);
                $('#kembali').val(kembali);

                var _data = { 'admin[]' : [] , 'konsul[]' : [] , 'tindakan[]' : [] ,'obat[]' : [] , "id_reg" : id_reg ,"total_obat" : total_obat , "total" : total , "pembayaran" : pembayaran};

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
                        url: "{{ url('pembayaran/proses_rj') }}",
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