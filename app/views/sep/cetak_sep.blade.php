@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
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
                            <a href="{{ url('sep/cetak_sep') }}">Cetak SEP</a>
                        </li>
                        <li>
                            SEP
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Cetak SEP
                        <div class="cari-group">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#cari_rawat_inap"><i class="splashy-zoom"></i> Rawat Inap</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#cari_rawat_jalan"><i class="splashy-zoom"></i> Rawat Jalan</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#cari_ugd"><i class="splashy-zoom"></i> UGD</button>
                        </div>
                    </h3>
                    <div id="pesan_error" class="alert alert-error" style="display:none;font-weight:bold;"></div>
					@if( isset($pesan) && $pesan != '' )
						<div id="" class="alert alert-error" style="font-weight:bold">{{ $pesan }}</div>
					@endif
	        	</div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Cari Nomor SEP</label>
                                <div class="controls">
                                    <input type="text" id="no_sep" name="no_sep" class="span5">
                                    <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                </div>
                            </div>
                            <br />
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    Atau
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Input Nomor SEP</label>
                                <div class="controls">
                                    <input type="text" id="no_sep" name="no_sep" class="span5">
                                </div>
                            </div>
						</div>
                    </div>
                {{ Form::close() }}
	   	</div>
	</div>

        <div class="modal hide fade modal-admin" id="cari_rawat_inap" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_pasien_inap" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                                <col class="con5" />
                                <col class="con6" />
                                <col class="con7" />
                                <col class="con8" />
                                <col class="con9" />
                                <col class="con10" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal</th>
                                    <th align="center" valign="middle" class="head4">Ruangan</th>
                                    <th align="center" valign="middle" class="head5">Kelas</th>
                                    <th align="center" valign="middle" class="head6">No Kamar</th>
                                    <th align="center" valign="middle" class="head7">NoReg</th>
                                    <th align="center" valign="middle" class="head8">Jalan</th>
                                    <th align="center" valign="middle" class="head9">Kelurahan</th>
                                    <th align="center" valign="middle" class="head10">Kota / Kab</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_pasien_inap').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('rawat_inap/popup_table') }}",
                                    "bServerSide": true
                                
                                });
                            // custom values are available via $values array
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal hide fade modal-admin" id="cari_rawat_jalan" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_pasien_jalan" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                                <col class="con6" />
                                <col class="con7" />
                                <col class="con8" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal Masuk</th>
                                    <th align="center" valign="middle" class="head4">Poli</th
                                    <th align="center" valign="middle" class="head6">Jalan</th>
                                    <th align="center" valign="middle" class="head7">Kelurahan</th>
                                    <th align="center" valign="middle" class="head8">Kota / Kab</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_pasien_jalan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('rawat_jalan/popup_table_byreg') }}",
                                    "bServerSide": true
                                
                                });
                            // custom values are available via $values array
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal hide fade modal-admin" id="cari_ugd" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_ugd" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con6" />
                                <col class="con7" />
                                <col class="con8" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal</th>
                                    <th align="center" valign="middle" class="head6">Jalan</th>
                                    <th align="center" valign="middle" class="head7">Kelurahan</th>
                                    <th align="center" valign="middle" class="head8">Kota / Kab</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_ugd').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('ugd/popup_table') }}",
                                    "bServerSide": true
                                
                                });
                            // custom values are available via $values array
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
        </div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        var oTable;
        $(document).ready(function() {
            $('#reg1_form').submit(function(){
                return false;
            })
        });

        function cariSep(){
            var _sep = $('#no_sep').val();
        }
    </script>
@stop