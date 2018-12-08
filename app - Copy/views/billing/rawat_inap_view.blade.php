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
                            <a href="{{ url('billing/rawat_inap') }}">Pembayaran</a>
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
                             <a href="{{ url('billing/rawat_inap_print/'.$registrasi->NoReg.'/'.$cetak_obat) }}" target="_BLANK" class="btn btn-primary">
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
                        <div class="span12">
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
                                    ?>
                                    @if($ruangan)
                                        <h4>Biaya Visite</h4>
                                        <table>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="60%">Dokter</td>
                                                <td align="center" width="10%">Tanggal</td>
                                                <td align="center" width="15%">Jam</td>
                                                <td align="right" width="15%">Biaya</td>
                                            </tr>
                                            <?php $visite   = DB::table('dokter_visite')->where('NoReg' , $registrasi->NoReg)->get(); ?>
                                            @if(count($visite) > 0)
                                                @foreach($visite as $v)
                                                <tr>
                                                    <td align="center" width="60%">{{ $v->NamaDokter }}</td>
                                                    <td align="center" width="10%">{{ $v->Tanggal }}</td>
                                                    <td align="center" width="15%">{{ $v->Jam }}</td>
                                                    <td align="right" width="15%">{{ $v->Tarif }}</td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </table>

                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr>
                                                <td align="center" width="60%">Keterangan</td>
                                                <td align="center" width="10%">Quantity</td>
                                                <td align="center" width="15%">Harga</td>
                                                <td align="center" width="15%">Total</td>
                                            </tr>
                                            @foreach($keluar as $k)
                                                <?php $tarif = $k->TotalBiayaRuang / $k->LamaTinggal; ?>
                                                @if(isset($reg[$k->TanggalMasuk]))
                                                    <?php $ruangan = $reg[$k->TanggalMasuk]; ?>
                                                @else
                                                    <?php $ruangan = ""; ?>
                                                @endif
                                                <tr>
                                                    <td>Tarif Ruangan {{ $ruangan }} ({{ $k->TanggalMasuk.' s/d '.$k->TanggalKeluar }})
                                                    </td>
                                                    <td align="right">{{ $k->LamaTinggal }}</td>
                                                    <td align="right">{{ number_format( $tarif ) }}</td>
                                                    <td align="right">{{ number_format( $k->TotalBiayaRuang ) }}</td>
                                                </tr>
                                                <?php 
                                                    $total_ruangan = $total_ruangan + $k->TotalBiayaRuang;

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
                                    @if(isset($obat))
                                        <h4>Biaya Obat</h4>
                                        <table width="100%" border="1" colspan="2" class="report">
                                            <tr style="display:none;">
                                                <td align="center" width="15%">Tanggal</td>
                                                <td align="center" width="60%">Nama Obat</td>
                                                <td align="center" width="10%">Harga</td>
                                                <td align="center" width="5%">Jumlah</td>
                                                <td align="center" width="20%">Total</td>
                                            </tr>
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
                                            <tr>
                                                <td colspan="4">Total Biaya Obat</td>
                                                <td align="right">{{ number_format($total_obat) }}</td>
                                            </tr>
                                        </table>
                                        <br />
                                    @endif
                                    <?php $total = $total_ruangan + $total_tindakan + $total_obat; ?>
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
