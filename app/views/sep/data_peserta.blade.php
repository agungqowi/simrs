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
                            <a href="{{ url('sep/data_peserta') }}">Daftar Peserta</a>
                        </li>
        				<li>
        					BPJS
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Daftar Peserta BPJS
                    </h3>
	        	</div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <?php $success = Session::get('success'); ?>
                   	@if( Session::get('success') )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
					<div id="pesan_error2" class="alert alert-error" style="display:none; font-weight:bold;">
					</div>

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
                                <th align="center" valign="middle" class="head1">No Kartu BPJS</th>
                                <th align="center" valign="middle" class="head2">NIK</th>
                                <th align="center" valign="middle" class="head3">Nama Peserta</th>
                                <th align="center" valign="middle" class="head5">Tanggal Lahir</th>
                                <th align="center" valign="middle" class="head4">Jenis Kelamin</th>
                                <th align="center" valign="middle" class="head6">Kelas Rawat</th>
								<th align="center" valign="middle" class="head7">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            oTable = $('#tbl_obat').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/data_peserta_view') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_obat_filter input").focus();
                                },
                                "aoColumnDefs" : [
                                    {
                                        "aTargets" : [ 6 ],
                                        "sClass" : "center"
                                    }
                                ]
                                
                            });
                        });
                    </script>
                </div>
	        </div>
	   	</div>
	</div>
	
    <div class="modal hide fade modal-admin" id="detail_data" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pasienLabel">Detail Data Peserta</h4>
                </div>
                <div class="modal-body">
					 <div id="pesan_error" class="alert alert-error" style="display:none; font-weight:bold;">
					 </div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
						<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label class="control-label">Nama Peserta</label>
									<div class="controls">
										<input type="text" id="nama" name="nama" class="span12 no-primary" />
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label">No Kartu BPJS</label>
									<div class="controls">
										<input type="text" id="no_kartu" name="no_kartu" class="span12 no-primary" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Tanggal Cetak Kartu</label>
									<div class="controls">
										<input type="text" id="tgl_cetak" name="tgl_cetak" class="span12 no-primary" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Kelas Rawat</label>
									<div class="controls">
										<input type="text" id="nm_kls_tanggung" name="nm_kls_tanggung" class="span12 no-primary" />
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label">NIK</label>
									<div class="controls">
										<input type="text" id="nik" name="nik" class="span12 no-primary" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Kel. Peserta (PISA)</label>
									<div class="controls">
										<input type="text" id="pisa" name="pisa" class="span12 no-primary" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Lahir</label>
									<div class="controls">
										<input type="text" id="tgl_lahir" name="tgl_lahir" class="span12 no-primary" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Kelamin</label>
									<div class="controls">
										<input type="text" id="jk" name="jk" class="span12 no-primary" />
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label class="control-label">Nama Provider</label>
									<div class="controls">
										<input type="text" id="nm_prov" name="nm_prov" class="span12 no-primary" />
									</div>
								</div>  
							</div>                          
						</div>
                <div class="modal-footer">
					<button id="btn_reset" type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Close</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@stop

@section('js')
    @parent
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
	{{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
			$('#btn_reset').click(function() {
				 $('#detail_data').modal('hide');
			});
        });
																		
        function detail_data(no_kartu,tgl_cetak,nik,nama,pisa,jk,tgl_lahir,nm_kls_tanggung,nm_prov){
            $('#detail_data').modal('show');
            $("#detail_data").draggable();
			$('#no_kartu').val(no_kartu);
            $('#tgl_cetak').val(tgl_cetak);
			$('#nik').val(nik);
			$('#nama').val(nama);
            $('#pisa').val(pisa);
			$('#jk').val(jk);
            $('#tgl_lahir').val(tgl_lahir);
			//$('#kd_jenis_pst').val(kd_jenis_pst);
            //$('#nm_jenis_pst').val(nm_jenis_pst);
            //$('#kd_kls_tanggung').val(kd_kls_tanggung);
			$('#nm_kls_tanggung').val(nm_kls_tanggung);
            //$('#kd_prov').val(kd_prov);
			$('#nm_prov').val(nm_prov);
            //$('#kd_cabang').val(kd_cabang);
			//$('#nm_cabang').val(nm_cabang);
        }
    </script>
@stop