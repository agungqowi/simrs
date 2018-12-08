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
                            <a href="{{ url('sep/list_sep') }}">Data Riwayat</a>
                        </li>
                        <li>
                            Kunjungan Peserta
                        </li>
                    </ul>
                </div>
            </nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Data Riwayat Kunjungan Peserta
                    </h3>
                    	@if(isset($show2['noKartu']))
						<div class="row-fluid">
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>Data Peserta</h4></label>
								</div>
								<div class="control-group">
									<label class="control-label">No Kartu BPJS</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show2['noKartu'] }}" />
									</div>
								</div>
							</div>  
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>
								<div class="control-group">
									<label class="control-label">NIK</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show2['nik'] }}" />
									</div>
								</div>
							</div>  
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Peserta</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show2['nama'] }}" />
									</div>
								</div>
							</div>  
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Lahir</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ DateTime::createFromFormat('Y-m-d H:i:s', $show2['tglLahir'])->format('d/m/Y') }}" />
									</div>
								</div>
							</div>
						</div>
						@endif
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
								<th align="center" valign="middle" class="head1">No SEP</th>
                                <th align="center" valign="middle" class="head2">Tanggal SEP</th>
                                <th align="center" valign="middle" class="head3">Tanggal Pulang</th>
                                <th align="center" valign="middle" class="head4">Jenis Pelayanan</th>
                                <th align="center" valign="middle" class="head6">Kode Poli</th>
                                <th align="center" valign="middle" class="head7">Nama Poli</th>
								<th align="center" valign="middle" class="head7">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php for($i=0;$i<$banyak_data;$i++){?>
                                <tr>
                                   <td>{{ $i+1 }}</td>
								   <td>{{ $show['list'][$i]['noSep'] }}</td>
                                   <td>{{ DateTime::createFromFormat('Y-m-d H:i:s', $show['list'][$i]['tglSep'])->format('d-m-Y') }}</td>
								   <?php if($show['list'][$i]['tglPulang']=='1900-01-01 00:00:00') $tglTampil = '-';
								   else $tglTampil = DateTime::createFromFormat('Y-m-d H:i:s', $show['list'][$i]['tglPulang'])->format('d-m-Y'); ?>
                                   <td>{{ $tglTampil }}</td>
                                   <td>{{ $show['list'][$i]['jnsPelayanan'] }}</td>
                                   <td>{{ $show['list'][$i]['poliTujuan']['kdPoli'] }}</td>
                                   <td>{{ $show['list'][$i]['poliTujuan']['nmPoli'] }}</td>
                                   <td align="center"> 
								   {{ Form::open(array('url' => 'sep/detail_view/sep' ,'method' => 'POST')) }}
								   <input type="hidden" name="nomor" id="nomor" value="{{ $show['list'][$i]['noSep'] }}" />
                                   <input type="submit" name="detail" value="detail" />
								   {{ Form::close() }}
								   <a href="{{ url('sep/pdf_sep/'.$show['list'][$i]['noSep']) }}" class="btn">Pdf</a>
								   </td>
                                </tr>
                        <?php } ?>                                       
                        </tbody>
                    </table>
                </div>
	        </div>
	   	</div>
	</div>

@stop