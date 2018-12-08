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
                            <a href="{{ url('sep/rujukan/daftar_pasien') }}">Data Pasien</a>
                        </li>
                        <li>
                            Rujukan
                        </li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Data Pasien Rujukan Tanggal <font color="#0000FF">{{ $tanggal }}</font><br />
						Sebanyak : <font color="#009900">{{ $banyak_data }}</font> Pasien
                    </h3>
                    <table id="tbl_obat" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                            <col class="con6" />
                            <col class="con7" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">No</th>
								<th align="center" valign="middle" class="head1">No Rujukan</th>
                                <th align="center" valign="middle" class="head2">No Kartu BPJS</th>
                                <th align="center" valign="middle" class="head3">NIK</th>
                                <th align="center" valign="middle" class="head4">Nama Peserta</th>
                                <th align="center" valign="middle" class="head6">RS Rujukan</th>
                                <th align="center" valign="middle" class="head7">Poli</th>
								<th align="center" valign="middle" class="head7">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php for($i=0;$i<$banyak_data;$i++){?>
                                <tr>
                                   <td>{{ $i+1 }}</td>
								   <td>{{ $show['list'][$i]['noKunjungan'] }}</td>
                                   <td>{{ $show['list'][$i]['peserta']['noKartu'] }}</td>
                                   <td>{{ $show['list'][$i]['peserta']['nik'] }}</td>
                                   <td>{{ $show['list'][$i]['peserta']['nama'] }}</td>
                                   <td>{{ $show['list'][$i]['provRujukan']['nmProvider'] }}</td>
                                   <td>{{ $show['list'][$i]['poliRujukan']['nmPoli'] }}</td>
								   {{ Form::open(array('url' => 'sep/rujukan_view/data/rujukan' ,'method' => 'POST')) }}
								   <input type="hidden" name="nomor" id="nomor" value="{{ $show['list'][$i]['noKunjungan'] }}" />
                                   <td align="center"> <input type="submit" name="detail" value="detail" /></td>
								   {{ Form::close() }}
                                </tr>
                        <?php } ?>                                       
                        </tbody>
                    </table>
                </div>
	        </div>
	   	</div>
	</div>

@stop