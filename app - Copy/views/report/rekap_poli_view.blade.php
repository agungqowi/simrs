@extends('layout')

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
                            <a href="{{ url('report/rekap_poli') }}">Rekap Poli</a>
                        </li>
                        <li>
                            Pasien
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Rekap Data Pasien Poli
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/rekap_poli_excel/Excel5') }}?tanggal={{ $tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/rekap_poli_excel/Excel2007') }}?tanggal={{ $tanggal }}" class="btn btn-primary">
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
                                
                                <h3 align="center">{{ $rs_title }}</h3>
                                <h4 align="center">{{ $rs_alamat }}</h4>
                                <br />
                                <h4>Laporan Rekap Data Pasien Poli Per Tanggal {{ $date }}</h4>
                                <br />
                                <table width="100%" border="1" colspan="2" class="report">
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center" valign="middle" rowspan="3">No</td>
                                        <td align="center" valign="middle" rowspan="3">Poli</td>
                                        <td align="center" colspan="15">Golongan Pasien</td>
                                        <td align="center" valign="middle" rowspan="3">Jumlah</td>
                                    </tr>
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center" colspan="4">BPJS</td>
                                        <td align="center" valign="middle" rowspan="2">Jamkesda</td>
                                        <td align="center" colspan="10">Swasta</td>
                                    </tr>
                                    <tr style="background:#CCCCCC; font-weight:bold;">
                                        <td align="center">Askes</td>
                                        <td align="center">Dinas</td>
                                        <td align="center">Mandiri</td>
                                        <td align="center">Lain-Lain</td>
                                        <td align="center">Bringin Life</td>
                                        <td align="center">Gandum</td>
                                        <td align="center">Indolacto</td>										
                                        <td align="center">In Health</td>
                                        <td align="center">Krebet</td>
                                        <td align="center">Molindo</td>
                                        <td align="center">Nayaka</td>
                                        <td align="center">PG Krebet</td>
                                        <td align="center">PT. Cakra/ Pindad</td>
                                        <td align="center">PT. KAI</td>
                                    </tr>
									<?php $no = 0;
									$ListSubGol = array( 
											'BPJS' => array('Askes','Dinas','Mandiri','Lain-lain'),
											'Jamkesda' => array('-'),
											'Swasta' => array('Bringin Life','Gandum','Indolacto','In Health','Krebet','Molindo','Nayaka','PG Krebet','PT. Cakra/Pindad','PT. KAI')
										);
									$jumA = 0;$jumB = 0;$jumC = 0;$jumD = 0;$jumE = 0;$jumF = 0;$jumG = 0;$jumH = 0;
									$jumI = 0;$jumJ = 0;$jumK = 0;$jumL = 0;$jumM = 0;$jumN = 0;$jumO = 0;$jumP = 0;
									?>
									@foreach($arrData as $namaPoli => $dataPoli)
									<?php $no++; ?>
									<tr>
										<td align="right">{{ $no }}</td>
										<td>{{ $namaPoli }}</td>
										@foreach($ListSubGol as $a => $b)
											@for($i=0; $i<COUNT($b); $i++)
											    <td align="right">{{ isset($dataPoli[$a][$b[$i]]) ? $dataPoli[$a][$b[$i]] : 0 }}</td>
											@endfor
										@endforeach
                                        <td align="right">{{ isset($cnt[$namaPoli]) ? $cnt[$namaPoli] : 0 }}</td>
									</tr>
									<?php
										$jumA += isset($dataPoli['BPJS']['Askes']) ? $dataPoli['BPJS']['Askes'] : 0;
                                        $jumB += isset($dataPoli['BPJS']['Dinas']) ? $dataPoli['BPJS']['Dinas'] : 0;
                                        $jumC += isset($dataPoli['BPJS']['Mandiri']) ? $dataPoli['BPJS']['Mandiri'] : 0;
                                        $jumD += isset($dataPoli['BPJS']['Lain-lain']) ? $dataPoli['BPJS']['Lain-lain'] : 0;
										$jumE += isset($dataPoli['Jamkesda']['-']) ? $dataPoli['Jamkesda']['-'] : 0;
                                        $jumF += isset($dataPoli['Swasta']['Bringin Life']) ? $dataPoli['Swasta']['Bringin Life'] : 0;
                                        $jumG += isset($dataPoli['Swasta']['Gandum']) ? $dataPoli['Swasta']['Gandum'] : 0;
                                        $jumH += isset($dataPoli['Swasta']['Indolacto']) ? $dataPoli['Swasta']['Indolacto'] : 0;
                                        $jumI += isset($dataPoli['Swasta']['In Health']) ? $dataPoli['Swasta']['In Health'] : 0;
                                        $jumJ += isset($dataPoli['Swasta']['Krebet']) ? $dataPoli['Swasta']['Krebet'] : 0;
                                        $jumK += isset($dataPoli['Swasta']['Molindo']) ? $dataPoli['Swasta']['Molindo'] : 0;
                                        $jumL += isset($dataPoli['Swasta']['Nayaka']) ? $dataPoli['Swasta']['Nayaka'] : 0;
                                        $jumM += isset($dataPoli['Swasta']['PG Krebet']) ? $dataPoli['Swasta']['PG Krebet'] : 0;
                                        $jumN += isset($dataPoli['Swasta']['PT. Cakra/Pindad']) ? $dataPoli['Swasta']['PT. Cakra/Pindad'] : 0;
                                        $jumO += isset($dataPoli['Swasta']['PT. KAI']) ? $dataPoli['Swasta']['PT. KAI'] : 0;
                                        $jumP += isset($cnt[$namaPoli]) ? $cnt[$namaPoli] : 0;
									?>
									@endforeach
									<tr>
										<td align="center" colspan="2">Total</td>
                                        <td align="right">{{ $jumA }}</td>
                                        <td align="right">{{ $jumB }}</td>
                                        <td align="right">{{ $jumC }}</td>
                                        <td align="right">{{ $jumD }}</td>
										<td align="right">{{ $jumE }}</td>
                                        <td align="right">{{ $jumF }}</td>
                                        <td align="right">{{ $jumG }}</td>
                                        <td align="right">{{ $jumH }}</td>
                                        <td align="right">{{ $jumI }}</td>
                                        <td align="right">{{ $jumJ }}</td>
                                        <td align="right">{{ $jumK }}</td>
                                        <td align="right">{{ $jumL }}</td>
                                        <td align="right">{{ $jumM }}</td>
                                        <td align="right">{{ $jumN }}</td>
                                        <td align="right">{{ $jumO }}</td>
                                        <td align="right">{{ $jumP }}</td>
									</tr>
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
