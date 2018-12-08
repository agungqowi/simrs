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
                            <a href="{{ $parent }}">Laporan</a>
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
										<?php $no = 0;
										$ListSubGol = array( 
												'BPJS' => array(
													'Dinas' => array(
																'TNI AU' => array ('PNS','Militer','Keluarga'),
																'TNI AL' => array ('PNS','Militer','Keluarga'),
																'TNI AD' => array ('PNS','Militer','Keluarga'), 
																'POLISI' => array ('PNS','Militer','Keluarga'), 
																'POLRI' => array ('PNS','Militer','Keluarga')
																),
													'Askes',
													'Jamkesmas',
													'Mandiri',
													'Lain-lain'),
												'Jamkesda' => array('-'),
												'Swasta' => array('Bringin Life','Gandum','Indolacto','In Health','Krebet','Molindo','Nayaka','PG Krebet',
																  'PT. Cakra/Pindad','PT. KAI', 'Umum', 'Telkom', 'Harlend')
											);
										$jumA = 0;$jumB = 0;$jumC = 0;$jumD = 0;$jumE = 0;$jumF = 0;$jumG = 0;$jumH = 0;
										$jumI = 0;$jumJ = 0;$jumK = 0;$jumL = 0;$jumM = 0;$jumN = 0;$jumO = 0;$jumP = 0;
										$no = 0;
										?>
										
										
										
									@foreach($arrData as $iddiag => $data)
										<tr>
											<td><?=$iddiag?></td>
											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AD']['Militer']) ? $data['BPJS']['Dinas']['TNI AD']['Militer'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AD']['PNS']) ? $data['BPJS']['Dinas']['TNI AD']['PNS'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AD']['Keluarga']) ? $data['BPJS']['Dinas']['TNI AD']['Keluarga'] : 0?></td>

											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AL']['Militer']) ? $data['BPJS']['Dinas']['TNI AL']['Militer'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AL']['PNS']) ? $data['BPJS']['Dinas']['TNI AL']['PNS'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AL']['Keluarga']) ? $data['BPJS']['Dinas']['TNI AL']['Keluarga'] : 0?></td>

											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AU']['Militer']) ? $data['BPJS']['Dinas']['TNI AU']['Militer'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AU']['PNS']) ? $data['BPJS']['Dinas']['TNI AU']['PNS'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['Dinas']['TNI AU']['Keluarga']) ? $data['BPJS']['Dinas']['TNI AU']['Keluarga'] : 0?></td>

											<?php
												$subpolri = (isset($data['BPJS']['Dinas']['POLISI']['Militer']) ? $data['BPJS']['Dinas']['POLISI']['Militer'] : 0) +
															(isset($data['BPJS']['Dinas']['POLRI']['Militer']) ? $data['BPJS']['Dinas']['POLRI']['Militer'] : 0) +
															(isset($data['BPJS']['Dinas']['POLISI']['PNS']) ? $data['BPJS']['Dinas']['POLISI']['PNS'] : 0) +
															(isset($data['BPJS']['Dinas']['POLRI']['PNS']) ? $data['BPJS']['Dinas']['POLRI']['PNS'] : 0) +
															(isset($data['BPJS']['Dinas']['POLISI']['Keluarga']) ? $data['BPJS']['Dinas']['POLISI']['Keluarga'] : 0) +
															(isset($data['BPJS']['Dinas']['POLRI']['Keluarga']) ? $data['BPJS']['Dinas']['POLRI']['Keluarga'] : 0);
												
											?>
											<td align="right"><?=$subpolri < 0 ? 0 : $subpolri?></td>

											<td align="right"><?=isset($data['BPJS']['Askes']['-']['-']) ? $data['BPJS']['Askes']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['Jamkesmas']['-']['-']) ? $data['BPJS']['Jamkesmas']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Jamkesda']['-']['-']['-']) ? $data['Jamkesda']['-']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['BPJS']['%Mandiri']['-']['-']) ? $data['BPJS']['%Mandiri']['-']['-'] : 0?></td>

									
                                           	<td align="right"><?=isset($data['Swasta']['Umum']['-']['-']) ? $data['Swasta']['Umum']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['PT. KAI']['-']['-']) ? $data['Swasta']['PT. KAI']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['Gandum']['-']['-']) ? $data['Swasta']['Gandum']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['Krebet']['-']['-']) ? $data['Swasta']['Krebet']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['In Health']['-']['-']) ? $data['Swasta']['In Health']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['Bringin Life']['-']['-']) ? $data['Swasta']['Bringin Life']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['Telkom']['-']['-']) ? $data['Swasta']['Telkom']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['PT. Cakra/Pindad']['-']['-']) ? $data['Swasta']['PT. Cakra/Pindad']['-']['-'] : 0?></td>
											<td align="right"><?=isset($data['Swasta']['Harlend']['-']['-']) ? $data['Swasta']['Harlend']['-']['-'] : 0?></td>
											
                                           	<td align="right"><?=isset($cnt[$iddiag]) ? $cnt[$iddiag] : 0?></td>
											
										<?php $x = array_keys($arrDataumur[$iddiag]);
											  $jmlarray = count($x);
											  $pos = array();
											  
												$subA = 0;$subB = 0;$subC = 0;$subD = 0;$subE = 0;$subF = 0;$subG = 0;$subH = 0;
												$subI = 0;$subJ = 0;$subK = 0;$subL = 0;$subM = 0;$subN = 0;$subO = 0;$subP = 0;

											  for($i=0; $i<$jmlarray; $i++){
											  	$pos[$i] = $x[$i] < 1 ? $arrDataumur[$iddiag][$x[$i]] : 0;
												$pos[$i+1] = $x[$i] < 1 ? $arrDataumur[$iddiag][$x[$i]] : 0;
												$pos[$i+2] = ($x[$i] >= 1 && $x[$i] < 5) ? $arrDataumur[$iddiag][$x[$i]] : 0;
												$pos[$i+3] = ($x[$i] >= 5 && $x[$i] < 15) ? $arrDataumur[$iddiag][$x[$i]] : 0;
												$pos[$i+4] = ($x[$i] >= 15 && $x[$i] < 26) ? $arrDataumur[$iddiag][$x[$i]] : 0;
												$pos[$i+5] = ($x[$i] >= 26 && $x[$i] < 45) ? $arrDataumur[$iddiag][$x[$i]] : 0;
												$pos[$i+6] = ($x[$i] >= 45 && $x[$i] < 65) ? $arrDataumur[$iddiag][$x[$i]] : 0;
												$pos[$i+7] = $x[$i] > 65 ? $arrDataumur[$iddiag][$x[$i]] : 0;
												
												$subA += $pos[$i];
												$subB += $pos[$i+1];
												$subC += $pos[$i+2];
												$subD += $pos[$i+3];
												$subE += $pos[$i+4];
												$subF += $pos[$i+5];
												$subG += $pos[$i+6];
												$subH += $pos[$i+7];
											  }
											  
										?>
											<td align="right">{{ $subA }}</td>
											<td align="right">{{ $subB }}</td>
											<td align="right">{{ $subC }}</td>
											<td align="right">{{ $subD }}</td>
											<td align="right">{{ $subE }}</td>
											<td align="right">{{ $subF }}</td>
											<td align="right">{{ $subG }}</td>
											<td align="right">{{ $subH }}</td>
											<td align="right"><?=isset($cntumur[$iddiag]) ? $cntumur[$iddiag] : 0?></td>
											
											
											
										<?php $x = array_keys($arrDataJK[$iddiag]);
											  $jmlarray = count($x);
											  $pos = array();
											  
												$subA = 0;$subB = 0;

											  for($i=0; $i<$jmlarray; $i++){
											  	$pos[$i] = $x[$i] == 'L' ? $arrDataJK[$iddiag][$x[$i]] : 0;
												$pos[$i+1] = $x[$i] == 'P' ? $arrDataJK[$iddiag][$x[$i]] : 0;
												
												$subA += $pos[$i];
												$subB += $pos[$i+1];
											  }
											  
										?>
											<td align="right">{{ $subA }}</td>
											<td align="right">{{ $subB }}</td>
											<td align="right"><?=isset($cntJK[$iddiag]) ? $cntJK[$iddiag] : 0?></td>
											
											<td align="right"><?=isset($cntAll[$iddiag]) ? $cntAll[$iddiag] : 0?></td>
											
										</tr>
										<?php $no++; ?>
									@endforeach
										
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
