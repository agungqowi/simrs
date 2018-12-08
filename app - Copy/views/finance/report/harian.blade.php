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
                            <a href="{{ url('finance_report/tanggal/harian') }}">Laporan</a>
                        </li>
                        <li>
                            Pendapatan Rincian Harian
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Pendapatan Rincian Harian
                        <span style="float:right;">
                            <a target="_blank" href="javascript:do_print()" class="btn btn-primary">
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
                                <h3>Pendapatan Rincian Harian</h3>
                                <div>
                                    <table>
                                        <tr>
                                            <td>Dari Tanggal</td>
                                            <td>:</td>
                                            <td>{{ $dari }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sampai Tanggal</td>
                                            <td>:</td>
                                            <td>{{ $sampai }}</td>
                                        </tr>
                                    </table>
                                </div><br />
                                <?php $jenis     = DB::table('tbtindakanjenis')->get(); $kat = array(); ?>
                                <?php $total_jalan = 0; $total_inap=0; $total=0; ?>
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr>
                                        <td rowspan="2">No</td>
                                        <td rowspan="2">Tanggal</td>
                                        <td rowspan="2">No RM</td>
                                        <td rowspan="2">Nama</td>
                                        <td rowspan="2">Dokter</td>
                                        @foreach( $jenis as $j )
                                            <?php 
                                                $cj     = DB::table('tbkategoritindakan')->where('id_jenis',$j->id)->get(); 
                                                $tj     = count($cj);
                                                $kat[]  = $cj;
                                            ?>
                                            @if($tj > 0)
                                                <td align="center" colspan="{{ $tj }}">{{ $j->nama_jenis }}</td>
                                            @else
                                                <td align="center" rowspan="2">{{ $j->nama_jenis }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach( $kat as $ka )
                                            @if( count($ka) > 0 )
                                                @foreach($ka as $k)
                                                    <td align="center">{{ $k->nama }}</td>
                                                @endforeach                                                
                                            @endif
                                        @endforeach
                                    </tr>
                                <?php $loop = 0; $cpoli="";  ?>
                                
                                </table>
                                <br />
                                
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
