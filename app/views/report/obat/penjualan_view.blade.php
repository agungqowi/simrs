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
                            <a href="{{ url('report/distribusi_obat/'.$slug) }}">Laporan</a>
                        </li>
                        <li>
                            <a href="{{ url('report/distribusi_obat/'.$slug) }}">Penjualan Obat & Alkes</a>
                        </li>
                        <li>
                            {{ $title }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Penjualan Obat & Alkes
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
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
                        @if(count($data) > 0)
                            <div class="row-fluid" id="printarea">
                                <div class="span12">
                                    <h3 align="center">{{ $rs_title }}</h3>
                                    <h4 align="center">{{ $rs_alamat }}</h4>
                                    <br />
                                    <h3>Laporan  Penjualan Obat & Alkes</h3>
                                    <div>
                                        <table>
                                            <tr>
                                                <td>Dari Tanggal</td>
                                                <td>:</td>
                                                <td>{{ $dari_tanggal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sampai Tanggal</td>
                                                <td>:</td>
                                                <td>{{ $sampai_tanggal }}</td>
                                            </tr>

                                        </table>
                                    </div><br />
                                    <table width="100%" border="1" class="report">
                                        <tr style="background:#CCCCCC; font-weight:bold;">
                                            <td align="center">No</td>
                                            <td align="center">Tanggal</td>
                                            <td align="center">Jenis Rawat</td>
                                            <td align="center">No RM</td>
                                            <td align="center">Nama</td>
                                            <td align="center">Kode Obat</td>
                                            <td align="center">Obat / Alkes</td>
                                            <td align="center">Harga</td>
                                            <td align="center">Jumlah</td>
                                            <td align="center">Total</td>
                                        </tr>
                                    <?php $loop = 0;$total_all = 0;$total_supp=0;$noreg="";?>
                                    @foreach($data as $p)
                                        <?php $total_all = $total_all + floatval($p->TotalHarga ) ; ?>
                                        <tr>
                                        @if( $noreg != $p->id_penjualan )
                                            <?php $noreg    = $p->id_penjualan; ?>
                                            <?php $loop++; ?>
                                            <td width="20">{{ $loop }}</td>
                                            <td width="80">{{ $p->tgl }}</td>
                                            <td width="100">{{ $p->JenisRawat }}</td>
                                            <td width="60">{{ $p->NoRM }}</td>
                                            <td>{{ $p->Nama }}</td>
                                            <td width="20">{{ $p->IdObat }}</td>
                                            <td>{{ $p->NamaObat }}</td>
                                        @else
                                            <td></td>
                                            <td colspan="4"></td>
                                            <td>{{ $p->IdObat }}</td>
                                            <td>{{ $p->NamaObat }}</td>
                                        @endif
                                            <td align="right">{{ number_format( $p->Harga ) }}</td>
                                            <td align="right">{{ number_format( $p->Jumlah ) }}</td>
                                            <td align="right">{{ number_format( $p->TotalHarga ) }}</td>
                                        </tr>
                                    @endforeach
                                        <tr style="background:#CCCCCC">
                                            <td align="right" colspan="10">Jumlah : {{ number_format($total_all) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @else
                            <h3>Data tidak ditemukan</h3>
                        @endif
                    </div>
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
            
            setInterval(function () { w.print(); }, 1000);
        }
    </script>
@stop
