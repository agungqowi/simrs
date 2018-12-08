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
                            <!--a href="{//{ $parent }//}">Laporan</a-->
							<a href="{{ url('report/tanggal_inap/rincian_rawat_inap') }}">Laporan</a>
                        </li>
                        <li>
                            {{ $pagetitle }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan {{ $pagetitle }}
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/tanggal_inap/rincian_rawat_inap_excel/Excel5') }}?ruangan={{ $ruangan }}&dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/tanggal_inap/rincian_rawat_inap_excel/Excel2007') }}?ruangan={{ $ruangan }}&dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span>
                        </h3>

                        <div class="row-fluid" id="printarea">
                            <div class="span12">
                                @foreach($title as $t)
                                    <div 
                                        @if(isset($t['align']))
                                            align="{{ $t['align'] }}"
                                        @endif
                                        >{{ $t['text'] }}</div>
                                @endforeach
                                <div class="clearfix"></div>
                                <br />
                                <table  @if(isset($table['class']))
                                            class="{{ $table['class'] }}"
                                        @endif
                                     width="100%" border="1">
                                    <thead>
                                     @if(isset($thead))
                                        @foreach($thead as $tr)
                                            <tr>
                                            @foreach($tr as $th)
                                                <th @if(isset($th['colspan'])) colspan="{{ $th['colspan'] }}" @endif
                                                    @if(isset($th['rowspan'])) rowspan="{{ $th['rowspan'] }}" @endif
                                                    @if(isset($th['class'])) class="{{ $th['class'] }}" @endif
                                                >
                                                    {{ $th['text']}}
                                                </th>
                                            @endforeach
                                            </tr>
                                        @endforeach
                                    @endif
                                    </thead>
                                    <tbody>
                                        @if(isset($data))
                                            <?php $i = 0; ?>
                                            @foreach($data as $tb)
                                                <?php $i++; ?>
                                                <tr>
                                                @if(isset($tbody))
                                                    @foreach($tbody as $td)
                                                        <td>
                                                        @if(isset($td['type']) && $td['type'] == 'static')
                                                            {{ $td['content'] }}
                                                        @elseif($td['content'] == '__NO__')
                                                            {{ $i }}
                                                        @elseif( ( isset($td['default']) && isset($td['where']) ) && $tb->$td['content'] == $td['where'] )
                                                            {{ $td['default'] }}
                                                        @else
                                                            {{ $tb->$td['content'] }}
                                                        @endif
                                                        </td>

                                                        
                                                    @endforeach
                                                @endif
                                                </tr>

                                                
                                            @endforeach
                                            @if(isset($total))
                                                <tr>
                                                    <td colspan="{{ count($tbody)-1 }}">{{ $total }}</td>
                                                    <td>{{ $i }}</td>
                                                </tr>
                                            @endif
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
            
            setInterval(function () { w.print(); }, 1000);
        }
    </script>
@stop
