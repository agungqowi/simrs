@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
@stop

@section('content')
	<div id="contentwrapper">
		<div class="main_content">
			<nav>
        		<div id="jCrumbs" class="breadCrumb module">
        			<ul>
        				<li>
        					<a href="{{ url('/') }}"><i class="icon-home"></i></a>
        				</li>
                        <li>
                            <a href="{{ url('history_pasien') }}">Rekam Medis</a>
                        </li>
                        <li>
                            Pasien
                        </li>
        			</ul>
        		</div>
        	</nav>
        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Data Pasien
                    </h3>
	        	</div>
            </div>
            <div class="row-fluid">
                <div class="span12">
					<div id="error_msg" class="alert alert-error" style="display:none; font-weight:bold;" align="center">
					</div>
					<div id="info_msg" class="alert alert-info" style="display:none; font-weight:bold;" align="center">
					</div>
					
                    <table id="tbl_data" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                            <col class="con6" />
                            <col class="con7" />
                            <col class="con8" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">ID</th>
                                <th align="center" valign="middle" class="head2">Nama</th>
                                <th align="center" valign="middle" class="head3">JK</th>
                                <th align="center" valign="middle" class="head4">Tmp. Lahir</th>
                                <th align="center" valign="middle" class="head5">Tgl. Lahir</th>
                                <th align="center" valign="middle" class="head6">No BPJS</th>
                                <th align="center" valign="middle" class="head7">Alamat</th>
								<th align="center" valign="middle" class="head8">Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
					
                    <script type="text/javascript">
                        $(document).ready(function(){
                           var oTable = $('#tbl_data').dataTable({
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('history_pasien/datatable') }}",
                                "bServerSide": true,
                                "aoColumnDefs" : [
                                    {
                                        "aTargets" : [ 7 ],
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
	
    <div class="modal hide fade modal-admin" id="detail_data" tabindex="-1" role="dialog" aria-labelledby="detail_dataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="detail_dataLabel">Ringkasan Rekam medis</h4>
                </div>
                <div class="modal-body">
                {{ Form::open(array('url' => '' , 'id'=>'reg3_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="control-group">
                                <label class="control-label">Nama</label>
                                <div class="controls">
									<input type="text" id="Nama_det" name="Nama_det" class="span12 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Alamat</label>
                                <div class="controls">
                                    <input type="text" id="Jalan_det" name="Jalan_det" class="span12" />
                                </div>
                            </div>
						</div>
						<div class="span4">
                            <div class="control-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <div class="controls">
                                    <input type="text" id="Jkel_det" name="Jkel_det" class="span12 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">No. Telp.</label>
                                <div class="controls">
                                    <input type="text" id="NoTelp_det" name="NoTelp_det" class="span12 no-primary">
                                </div>
                            </div>
						</div>
					</div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Tmp. Lahir</label>
                                <div class="controls">
                                    <input type="text" id="TempatLahir_det" name="TempatLahir_det" class="span12" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tgl. Lahir</label>
                                <div class="controls">
                                    <input type="text" id="TanggalLahir_det" name="TanggalLahir_det" class="span12" />
                                </div>
                            </div>
						</div>
						<div class="span4">	
                            <div class="control-group">
                                <label class="control-label">Usia</label>
                                <div class="controls">
                                    <input type="text" id="Usia_det" name="Usia_det" class="span12" readonly="readonly" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Agama</label>
                                <div class="controls">
                                    <input type="text" id="Agama_det" name="Agama_det" class="span12 no-primary" />
                                </div>
                            </div>
						</div>
						<div class="span4">							
                            <div class="control-group">
                                <label class="control-label">Status</label>
                                <div class="controls">
                                    <input type="text" id="Status_det" name="Status_det" class="span12 no-primary" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Pekerjaan</label>
                                <div class="controls">
                                    <input type="text" id="Pekerjaan_det" name="Pekerjaan_det" class="span12 no-primary" />
                                </div>
                            </div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<table id="tbl_riwayat" class="table table-striped table-bordered table-hover">
								<colgroup>
									<col class="con1" />
									<col class="con2" />
									<col class="con3" />
									<col class="con4" />
								</colgroup>
								<thead>
									<tr>
										<th align="center" valign="middle" class="head1">Tahun</th>
										<th align="center" valign="middle" class="head2">Jumlah Rawat Inap</th>
										<th align="center" valign="middle" class="head3">Jumlah Rawat Jalan</th>
										<th align="center" valign="middle" class="head4">Jumlah Rawat UGD</th>
									</tr>
								</thead>
								<tbody id="isi_riwayat">
								</tbody>
							</table>
						</div>
                    </div>
                </div>
                <div class="modal-footer">
					<a id="view_det" class="btn btn-info"><i class="splashy-zoom"></i> Detail Rekam medis</a>
					<button id="close_modal_det" type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Close</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
	
@stop

@section('js')
    @parent
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
	{{ HTML::script('lib/datatables/fnReloadAjax.js') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
	{{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
			$('#close_modal_det').click(function() {
				 hide_modal('detail_data');
			});
        });

        function detail_data(NoRM,Nama,Jkel,TempatLahir,TanggalLahir,Usia,Jalan,Kelurahan,Kecamatan,KotaKab,Provinsi,Agama,Pekerjaan,NoTelp,Status){
            
			$.ajax({
				url: "{{ url('history_pasien/count_year') }}",
				type: "POST",
				data : 	"NoRM="+NoRM,
				success:function(res){
					$('#isi_riwayat').html(res);
					$('#detail_data').modal('show');
				}
			});

			$('#view_det').attr('href','history_pasien/view/'+NoRM);
			$('#Nama_det').val(Nama);
			if(Jkel=='L')$('#Jkel_det').val('Laki-laki');
			else $('#Jkel_det').val('Perempuan');
			$('#TempatLahir_det').val(TempatLahir);
			$('#TanggalLahir_det').val(TanggalLahir);
			$('#Usia_det').val(Usia);
			$('#Jalan_det').val(Jalan+' '+Kelurahan+' '+Kecamatan+' '+KotaKab+' '+Provinsi);
			$('#Agama_det').val(Agama);
			$('#Pekerjaan_det').val(Pekerjaan);
			$('#NoTelp_det').val(NoTelp);
			$('#Status_det').val(Status);
        }

        function show_modal(name){
            $('#'+name).modal('show');
        }

        function hide_modal(name){
            $('#'+name).modal('hide');
        }

        function cetak_alert_modal_add(str){
            $('#error_msg_modal_add').show();
            $('#error_msg_modal_add').html(str);
        }

        function cetak_alert_modal_edit(str){
            $('#error_msg_modal_edit').show();
            $('#error_msg_modal_edit').html(str);
        }

        function cetak_info(str){
            $('#info_msg').show();
            $('#info_msg').html(str);
        }

        function cetak_alert(str){
            $('#error_msg').show();
            $('#error_msg').html(str);
        }
		
		function trim(s){
			string = s;
			string = string.replace(/^s+|s+$/g,"");
			while(string.indexOf("  ")>0){
				string = string.split("  ").join(" ");
			}
			return string;
		}
    </script>
@stop