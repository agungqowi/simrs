@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}

    <style type="text/css">
    #tablepadding td , #tablepadding th{padding:5px;}
    </style>
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
                            <a href="{{ $parent }}">Laporan</a>
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
                        <h3 class="heading">Laporan {{ $title }}
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/tanggal_inap/rekap_golongan_excel/Excel5') }}?poli={{ $poli }}&ruangan={{ $ruangan }}&jenis_pelayanan={{ $jenis_pelayanan }}&dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/tanggal_inap/rekap_golongan_excel/Excel2007') }}?poli={{ $poli }}&ruangan={{ $ruangan }}&jenis_pelayanan={{ $jenis_pelayanan }}&dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
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
                                
                                <h4 align="center">{{ $subtitle }}</h4>
                                <br />
                                <table id="tablepadding" border="1">
                                    <thead>
                                    <tr align="center">
                                        <th colspan="2">STATUS PX</th>
                                        <th rowspan="2">TOTAL</th>
                                    </tr>
                                     <?php $array = array(); ?>
                                    <?php $total_bottom=array();  ?>
                                    <tr align="center">
                                        <th>GOLONGAN</th>
                                        <th>SUB GOLONGAN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($pasien) && count($pasien) > 0)
                                        @foreach($pasien as $p)
                                            @if(isset($array[$p->GolPasien][$p->SubGolPasien]))
                                                <?php $array[$p->GolPasien][$p->SubGolPasien]++; ?>
                                            @else
                                                <?php $array[$p->GolPasien][$p->SubGolPasien] = 1; ?>
                                            @endif
                                        @endforeach
                                    @endif

                                    @if(isset($array) && count($array) > 0)
                                        <?php $total = 0; ?>
                                        @foreach($array as $a=>$ar)
                                            @foreach($ar as $a1=>$a2)
                                                <tr>
                                                    <td>{{ $a }}</td>
                                                    <?php $total = $total + $a2; ?>
                                                    <td>{{ $a1 }}</td>
                                                    <td>{{ $a2 }}</td>
                                                </tr>
                                            @endforeach                  
                                        @endforeach
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td>{{ $total }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
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
            
            setTimeout(function () { w.print(); }, 1000);
        }
    </script>
@stop
