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
                            <a href="{{ url('sep/rujukan/data_ppk') }}">Data PPK</a>
                        </li>
                        <li>
                            Rujukan
                        </li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Daftar PPK Rujukan dengan Nama <font color="#0000FF">{{ $nama }}</font><br />
						Sebanyak : <font color="#009900">{{ $banyak_data }}</font>
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
								<th align="center" valign="middle" class="head1">Kode Provider</th>
                                <th align="center" valign="middle" class="head2">Nama Provider</th>
                                <th align="center" valign="middle" class="head3">Kode Cabang</th>
                                <th align="center" valign="middle" class="head4">Nama Cabang</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php for($i=0;$i<$banyak_data;$i++){?>
                                <tr>
                                   <td>{{ $i+1 }}</td>
								   <td>{{ $show['list'][$i]['kdProvider'] }}</td>
                                   <td>{{ $show['list'][$i]['nmProvider'] }}</td>
                                   <td>{{ $show['list'][$i]['kdCabang'] }}</td>
                                   <td>{{ $show['list'][$i]['nmCabang'] }}</td>
                                </tr>
                        <?php } ?>                                       
                        </tbody>
                    </table>
                </div>
	        </div>
	   	</div>
	</div>

@stop