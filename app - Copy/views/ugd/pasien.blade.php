@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
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
        					<a href="{{ action('DashboardController@index') }}">Info Pasien</a>
        				</li>
        				<li>
        					IGD
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Form Pasien IGD
	        			<div style="float:right;" class="">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#cari_pasien"><i class="splashy-zoom"></i> Cari Pasien</button>
                        </div>
	        		</h3>
	        		@if( $errors->first('title') || $errors->first('note') )
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('title') }}
							{{ $errors->first('note') }}
						</div>
	        		@endif
                    
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid">
                        <div class="span6">
    	        			<div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input readonly type="text" id="no_rm" name="txt_no_rm" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" id="txt_nama" name="txt_nama" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <div class="controls">
                                    <select id="cmb_jenkel" name="cmb_jenkel" class="no-primary">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" id="txt_tanggal_masuk" name="txt_tanggal_masuk" class="tanggal span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tempat Lahir</label>
                                <div class="controls">
                                    <input type="text" id="txt_tempat_lahir" name="txt_tempat_lahir" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <div class="controls">
                                    <input type="text" id="txt_tanggal_lahir" name="txt_tanggal_lahir" class="tanggal span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Golongan Pasien</label>
                                <div class="controls">
                                    <select id="cmb_golongan_pasien" name="cmb_golongan_pasien" class="no-primary">
                                        <option>BPJS</option>
                                        <option>Swasta</option>
                                        <option>Jamkesda</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            
                            <div class="control-group">
                                <label class="control-label">Alamat</label>
                                <div class="controls">
                                    <input type="text" id="txt_alamat" name="txt_alamat" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kelurahan</label>
                                <div class="controls">
                                    <input type="text" id="txt_kelurahan" name="txt_kelurahan" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kecamatan</label>
                                <div class="controls">
                                    <input type="text" name="txt_kecamatan" id="txt_kecamatan" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kota</label>
                                <div class="controls">
                                    <input type="text" id="txt_kota" name="txt_kota" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Provinsi</label>
                                <div class="controls">
                                    <input type="text" id="txt_provinsi" name="txt_provinsi" class="span10 no-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid formSep">
                   		<div class="span12">
                   			<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#doktertab" data-toggle="tab">Dokter</a></li>
									<li><a href="#tindakantab" data-toggle="tab">Tindakan</a></li>
									<li><a href="#diagnosatab" data-toggle="tab">Diagnosa</a></li>
                                    <li><a href="#orderlab" data-toggle="tab">Order Lab</a></li>
                                    <li><a href="#orderradiologi" data-toggle="tab">Order Radiologi</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="doktertab">
                                        <div>
                                            <div class="control-group">
                                                <label class="control-label">Pilih Dokter</label>
                                                <div class="controls">
                                                    <input type="hidden" id="id_dokter">
                                                    <input type="text" name="txt_pilih_dokter" id="txt_pilih_dokter" disabled="disabled" class="span5">
                                                    <button type="button" id="btn_dokter_tambah" data-toggle="modal" data-target="#cari_dokter" class="btn btn-success extra-fields" disabled="disabled">...</button>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Kategori</label>
                                                <div class="controls">
                                                    <select id="kategori_dokter">
                                                        <option value="DPJP">DPJP</option>
                                                        <option value="Konsul">Konsul</option>
                                                        <option value="Rawat Bersama">Rawat Bersama</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <button type="button" id="btn_dokter_simpan" onclick="tambah_dokter()" class="btn btn-success extra-fields" disabled="disabled">Simpan</button>
                                                </div>
                                            </div>
                                        </div> <br />
                                        <table id="dokter_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Dokter</th>
                                                    <th>Spesialisasi</th>
                                                    <th>Kategori</th>
                                                    <th>x</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
									<div class="tab-pane" id="tindakantab">
                                        <div>
                                            <button type="button" id="btn_tindakan_pilih" data-toggle="modal" data-target="#cari_tindakan" class="btn btn-success extra-fields" disabled="disabled">Tambah Tindakan</button>
                                        </div> <br />
                                        <table id="tindakan_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Tindakan</th>
                                                    <th>Tanggal</th>
                                                    <th>Gol</th>
                                                    <th>Jenis Rawat</th>
                                                    <th>x</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
									<div class="tab-pane" id="diagnosatab">
										<div>
                                            <div class="control-group">
                                                <label class="control-label">Pilih Diagnosa</label>
                                                <div class="controls">
                                                    <input type="text" id="id_diagnosa" disabled="disabled" size="6" style="width:70px">
                                                    <input type="text" name="txt_pilih_diagnosa" id="txt_pilih_diagnosa" disabled="disabled" class="span5">
                                                    <button type="button" id="btn_diagnosa_tambah" data-toggle="modal" data-target="#cari_diagnosa" class="btn btn-success extra-fields" disabled="disabled">...</button>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Tanggal Diagnosa</label>
                                                <div class="controls">
                                                    <input type="text" name="tanggal_diagnosa" id="tanggal_diagnosa" class="nowdate">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Status</label>
                                                <div class="controls">
                                                    <select id="status_diagnosa">
                                                        <option value="">-</option>
                                                        <option value="Diagnosa Awal">Diagnosa Awal</option>
                                                        <option value="Diagnosa Akhir">Diagnosa Akhir</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" id="long_diagnosa">
                                            <div class="control-group">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <button type="button" id="btn_diagnosa_simpan" onclick="tambah_diagnosa()" class="btn btn-success extra-fields" disabled="disabled">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <table id="diagnosa_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID Diagnosis</th>
                                                    <th>Keterangan</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th>Jenis Rawat</th>
                                                    <th>x</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
									</div>
                                    <div class="tab-pane" id="orderlab">
                                        <div>
                                            <button type="button" id="btn_order_lab_modal" class="btn btn-success extra-fields" disabled="disabled">Order Laboratorium</button>
                                        </div> <br />

                                        <table id="orderlab_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Pemeriksaan</th>
                                                    <th>Status</th>
                                                    <th>x</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        @if(isset($lab))
                                        <div id="orderlab_content" class="modal hide fade modal-admin" 
                                            style="padding:10px;max-height: 500px;overflow-y: auto;" >
                                            <h4 align="center" id="orderlab_pesan"></h4><br />
                                            <form id="form_orderlab" name="form_orderlab" method="POST">
                                            <div class="control-group">
                                                <label class="control-label">Tanggal Permintaan Lab</label>
                                                <div class="controls">
                                                    <input type="text" name="tanggal_lab" id="tanggal_lab" class="nowdate">
                                                </div>
                                            </div>
                                            <div class="control-group">                                                
                                                <label class="control-label">Jenis Pemeriksaan</label>
                                                <div class="controls">
                                                    <input type="hidden" name="lab_noreg" id="lab_noreg">
                                                    <input type="hidden" name="id_pemeriksaan" id="id_pemeriksaan">
                                                    <input type="hidden" id="ids_pemeriksaan" />
                                                    <div id="accordionlab" class="accordion">
                                                        <div class="accordion-group">
                                                        @foreach($lab as $la => $lb)
                                                            <div class="accordion-heading">
                                                                <a href="#lab-{{ $la }}" data-parent="#accordionlab" data-toggle="collapse" class="accordion-toggle">
                                                                    {{ $lb['title'] }}
                                                                </a>
                                                            </div>
                                                            @if(isset($lb['content']))
                                                                <div class="accordion-body collapse" id="lab-{{ $la }}">
                                                                    <div class="accordion-inner">
                                                                    @foreach($lb['content'] as $lc)                                                
                                                                        <input class="data-lab" name="data_lab[]" value="{{ $lc->kode_jasa }}" type="checkbox"> {{ $lc->nama_jasa }}<br />
                                                                    @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif                                            
                                                        @endforeach                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <button type="button" id="btn_order_lab" class="btn btn-success extra-fields" disabled="disabled">Proses Permintaan</button> &nbsp;
                                                    <span id="orderlab_error"></span>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        @endif
                                                                                    
                                    </div>
                                    <div class="tab-pane" id="orderradiologi">
                                        <div>
                                            <button type="button" id="btn_order_rad_modal" class="btn btn-success extra-fields" disabled="disabled">Order Radiologi</button>
                                        </div> <br />

                                        <table id="orderrad_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Pemeriksaan</th>
                                                    <th>Status</th>
                                                    <th>x</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div id="orderrad_content" class="modal hide fade modal-admin" 
                                            style="padding:10px;max-height: 500px;overflow-y: auto;" >
                                            <h4 align="center" id="orderrad_pesan"></h4><br />
                                            <form id="form_orderrad" name="form_orderrad" method="POST">
                                            <div class="control-group">
                                                <label class="control-label">Tanggal Permintaan Radiologi</label>
                                                <div class="controls">
                                                    <input type="text" name="tanggal_rad" id="tanggal_rad" class="nowdate">
                                                </div>
                                            </div>
                                            <div class="control-group">                                                
                                                <label class="control-label">Jenis Pemeriksaan</label>
                                                <div class="controls">
                                                    <input type="hidden" name="rad_noreg" id="rad_noreg">
                                                    <input type="hidden" name="id_radiologi" id="id_radiologi">
                                                    <input type="hidden" id="ids_radiologi" />
                                                    @if(isset($rad))
                                                        <div id="accordionradiologi" class="accordion">
                                                        <div class="accordion-group">
                                                        @foreach($rad as $ra => $rb)
                                                            <div class="accordion-heading">
                                                                <a href="#rad-{{ $ra }}" data-parent="#accordionradiologi" data-toggle="collapse" class="accordion-toggle">
                                                                    {{ $rb['title'] }}
                                                                </a>
                                                            </div>
                                                            @if(isset($rb['content']))
                                                                <div class="accordion-body collapse" id="rad-{{ $ra }}">
                                                                    <div class="accordion-inner">
                                                                    @foreach($rb['content'] as $rc)                                                
                                                                        <input class="data-rad" name="data_rad[]" value="{{ $rc->kd_rad }}" type="checkbox"> {{ $rc->nama_rad }}<br />
                                                                    @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif                                            
                                                        @endforeach                                            
                                                            
                                                        </div>

                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="control-group">                                                
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <button type="button" id="btn_order_rad" class="btn btn-success extra-fields" disabled="disabled">Proses Order Radiologi</button>&nbsp;
                                                    <span id="orderrad_error"></span>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    
								</div>
							</div>
                   		</div>
                   	</div>
                   	
                    <div class="row-fluid formsep">
                        <div class="span12">
                            <div class="">
                                <button type="button" id="btn_hapus" disabled="disabled" class="btn btn-danger extra-fields"><i class="splashy-error_x"></i> Hapus Pasien</button>
                            </div>
                        </div>
                    </div>
					{{ Form::close() }}

	        	</div>
        	</div>
		</div>
		<div class="modal hide fade modal-admin" id="cari_pasien" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_pasien" class="table table-striped table-bordered table-hover">
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
                                oTable = jQuery('#tbl_pasien').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('ugd/datatable') }}",
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
		<div class="modal hide fade" id="cari_dokter" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Dokter</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_dokter" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">Nama Dokter</th>
                                    <th align="center" valign="middle" class="head2">Spesialisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_dokter').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('dokter/simpletable') }}",
                                    "bServerSide": true
                                
                                });
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal hide fade modal-admin" id="cari_tindakan" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Tindakan</h4>
                    </div>
                    <div class="modal-body">
                        <div id="tindakan_message" class="alert"><div class="content"></div></div>
                        <div class="control-group">
                            <span>Tanggal</span>
                            <input type="text" class="nowdate" id="txt_tanggal_tindakan" name="txt_tanggal_tindakan" />
                        </div>
                        <table id="tbl_tindakan" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">IdTindak</th>
                                    <th align="center" valign="middle" class="head2">Tindakan</th>
                                    <th align="center" valign="middle" class="head3">Gol</th>
                                    <th align="center" valign="middle" class="head4">Kel</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_tindakan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('tindakan/simpletable') }}",
                                    "bServerSide": true
                                
                                });
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

        <div class="modal hide fade" id="cari_diagnosa" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Diagnosa</h4>
                    </div>
                    <div class="modal-body">
                        <table id="tbl_diagnosa" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">Id Diagnosis</th>
                                    <th align="center" valign="middle" class="head2">Short Diagnosis Desc</th>
                                    <th align="center" valign="middle" class="head3">Long Diagnosis Desc</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_diagnosa').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('diagnosa/simpletable') }}",
                                    "bServerSide": true
                                
                                });
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

@stop

@section('js')
	@parent
	{{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('js/forms/jquery.inputmask.min.js') }}
	@include('js/ugd_pasien')
	
@stop