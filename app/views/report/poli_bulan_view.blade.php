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
                            <a href="{{ url('report/rawat_jalan') }}">Laporan</a>
                        </li>
                        <li>
                            Rawat Jalan
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Rawat Jalan
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/poli_bulan_excel/Excel5') }}?poli={{ $nama_poli }}&bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/poli_bulan_excel/Excel2007') }}?poli={{ $nama_poli }}&bulan={{ $bulan }}&tahun={{ $tahun }}" class="btn btn-primary">
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
							
                                
                                <h4 align="center">REKAPITULASI HARIAN POLIKLINIK {{ strtoupper($nama_poli) }} BULAN {{ $nama_bulan }} TAHUN {{ $tahun }}</h4>
                                <br />
                                <table width="100%" border="1">
                                    <thead>
                                    <tr align="center">
                                        <th colspan="2">STATUS PX</th>
                                        <th colspan="31">TANGGAL</th>
                                        <th rowspan="2">TOTAL</th>
                                    </tr>
                                    <?php $total_bottom=array();  ?>
                                    <tr align="center">
                                        <th colspan="2">KUNJUNGAN</th>
                                        <?php for($i=1;$i<=31;$i++): ?>
                                            <th width="25">{{ $i }}</th>
                                            <?php $total_bottom[$i] = 0 ?>
                                        <?php endfor; ?>
                                    </tr>
                                    </thead>
                                    <?php $laps = array();$total=array();?>
                                    @foreach($lap as $l)
                                       <?php $laps[$l->Kategori] = $l; ?>
                                    @endforeach
                                    <tbody>
                                        <?php 
                                            $gol_militer = array('AD'=>'tniad' , 'AL'=>'tnial' , 'AU' => 'TNIAU'); 
                                            $subgol_militer = array('mil'=>'Militer' , 'kel' => 'Keluarga' , 'pns'=>'PNS');
                                        ?>
                                        @foreach($gol_militer as $gol=>$g)
                                            @foreach($subgol_militer as $sub=>$s)
                                                <tr align="center">
                                                @if($sub == 'mil')
                                                    <td rowspan="3">{{ $gol }}</td>
                                                @endif
                                                    <td>{{ $s }}</td>
                                                    <?php $total[$g.$sub] = 0; ?>
                                                    @if(isset($laps[$g.$sub]))
                                                        <?php for($i=1;$i<=31;$i++): ?>
                                                            <?php $j="t".$i; ?>
                                                            <td width="25">{{ $laps[$g.$sub]->$j }}</td>
                                                            <?php $total[$g.$sub] = $total[$g.$sub] + $laps[$g.$sub]->$j; ?>
                                                            <?php $total_bottom[$i]=$total_bottom[$i]+$laps[$g.$sub]->$j; ?>
                                                        <?php endfor; ?>
                                                    @else
                                                        <?php for($i=1;$i<=31;$i++): ?>
                                                            <td width="25">0</td>
                                                        <?php endfor; ?>
                                                    @endif
                                                    <td>{{ $total[$g.$sub] }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach

                                        <?php
                                            $ngol = array( 
                                                'bpjs' => array(
                                                            'name' => 'BPJS',
                                                            'content' => array(
                                                                'askes' => array( 'name' => 'Askes'),
                                                                'bpjs_mandiri' => array('name' => 'Mandiri'),
                                                                'jamkesmas' => array('name'  => 'Jamkesmas')
                                                            )
                                                ),
                                                'jamkesda' => array(
                                                                'name' => 'Jamkesda'
                                                ),
                                                'swasta' => array(
                                                                'name' => 'Swasta',
                                                                'content' => array(
                                                                    'swasta_nayaka' => array( 'name' => 'Nayaka' ),
                                                                    'swasta_inhealth' => array( 'name' => 'In Health' ),
                                                                    'swasta_gandum' => array( 'name' => 'Gandum' ),
                                                                    'swasta_krebet' => array( 'name' => 'Krebet' ),
                                                                    'swasta_molindo' => array( 'name' => 'Molindo' ),
                                                                    'swasta_indolacto' => array( 'name' => 'Indolacto' ),
                                                                    'swasta_pt.kai' => array( 'name' => 'KAI' ),
                                                                    'swasta_bringinlive' => array( 'name' => 'Bringin Live' ),
                                                                    'swasta_pt.cakra/pindad' => array( 'name' => 'Cakra/Pindad' ),
                                                                    'swasta_umum' => array( 'name' => 'Umum' ),
                                                                )   
                                                )

                                            );
                                            
                                        ?>

                                        @foreach($ngol as $ng => $n)
                                            @if(isset($n['content']))
                                                <?php $flag = 0; ?>
                                                @foreach($n['content'] as $c=>$co)
                                                    <tr align="center">
                                                        @if($flag == 0)
                                                            <td rowspan="{{ count($n['content']) }}">{{ $n['name']}}</td>
                                                        @endif
                                                        <td>{{ $co['name']}}</td>
                                                        <?php $total[$c] = 0; ?>
                                                        @if(isset($laps[$c]))
                                                            <?php for($i=1;$i<=31;$i++): ?>
                                                                <?php $j="t$i"; ?>
                                                                <td width="25">{{ $laps[$c]->$j }}</td>
                                                                <?php $total[$c] = $total[$c] + $laps[$c]->$j; ?>
                                                                <?php $total_bottom[$i]=$total_bottom[$i]+$laps[$c]->$j; ?>
                                                            <?php endfor; ?>
                                                        @else
                                                            <?php for($i=1;$i<=31;$i++): ?>
                                                                <td width="25">0</td>
                                                            <?php endfor; ?>
                                                        @endif
                                                        <td>{{ $total[$c] }}</td>
                                                    </tr>
                                                    
                                                    <?php $flag++; ?>
                                                @endforeach
                                            @else
                                                <tr align="center">
                                                    <td colspan="2">{{ $n['name'] }}</td>
                                                    <?php $total[$ng] = 0; ?>
                                                    @if(isset($laps[$ng]))
                                                        <?php for($i=1;$i<=31;$i++): ?>
                                                            <?php $j="t$i"; ?>
                                                            <td width="25">{{ $laps[$ng]->$j }}</td>
                                                            <?php $total[$ng] = $total[$ng] + $laps[$ng]->$j; ?>
                                                            <?php $total_bottom[$i]=$total_bottom[$i]+$laps[$ng]->$j; ?>
                                                        <?php endfor; ?>
                                                    @else
                                                        <?php for($i=1;$i<=31;$i++): ?>
                                                            <td width="25">0</td>
                                                        <?php endfor; ?>
                                                    @endif
                                                    <td>{{ $total[$ng] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        <tr align="center">
                                            <td colspan="2">Total</td>
                                            <?php $total_all = 0; ?>
                                            @for($i=1;$i<=31;$i++)
                                                <td width="25">{{ $total_bottom[$i] }}</td>
                                                <?php $total_all = $total_all +  $total_bottom[$i]; ?>
                                            @endfor
                                            <td>
                                            {{ $total_all }}
                                            </td>
                                        </tr>
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
