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
                            <a href="{{ url('report/penunjang_tanggal/'.$title) }}">Laporan</a>
                        </li>
                        <li>
                            {{  ucfirst( $title ) }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan {{  ucfirst( $title ) }}
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

                        <div class="row-fluid" id="printarea">
                            <div class="span12">
                                <h3 align="center">{{ $rs_title }}</h3>
                                <h4 align="center">{{ $rs_alamat }}</h4>
                                <br />
                                <h3>Laporan {{  ucfirst( $title ) }}</h3>
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
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr>
                                        <td>No</td>
                                        <td>No RM</td>
                                        <td>Nama</td>
                                        <td>Gol Pasien</td>
                                        <td>Sub Gol Pasien</td>
                                        <td>Tanggal</td>
                                    </tr>
                                    <?php $array = array(); ?>
                                    @if(isset($pasien) && count($pasien) > 0)
                                        <?php $i=1; ?>
                                        @foreach($pasien as $p)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $p->NoRM }}</td>
                                            <td>{{ $p->Nama }}</td>
                                            <td>{{ $p->GolPasien }}</td>
                                            <td>{{ $p->SubGolPasien }}</td>
                                            <td>{{ $p->TanggalMasuk }}</td>
                                        </tr>
                                            @if(isset($array[$p->GolPasien.' :: '.$p->SubGolPasien]))
                                                <?php $array[$p->GolPasien.' :: '.$p->SubGolPasien]++; ?>
                                            @else
                                                <?php $array[$p->GolPasien.' :: '.$p->SubGolPasien] = 1; ?>
                                            @endif
                                            <?php $i++; ?>
                                        @endforeach
                                    @else
                                    <tr>
                                    <td colspan="4" align="center">Data tidak ditemukan</td>
                                    </tr>
                                    @endif
                                    
                                </table>
                                <br />
                                @if(isset($array) && count($array) > 0)
                                    <?php $total = 0; ?>
                                    <table border="1" colspan="2" class="report">
                                        @foreach($array as $a=>$ar)
                                            <tr>
                                                <td>{{ $a }}</td>
                                                <td>{{ $ar }}</td>
                                            </tr>
                                            <?php $total = $total + $ar; ?>
                                        @endforeach

                                        <tr>
                                            <td>Total</td>
                                            <td>{{ $total }}</td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
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
