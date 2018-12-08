@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
    {{ HTML::style('css/custom-theme/jquery-ui-1.10.0.custom.css') }}
    {{ HTML::script('lib/printlabel/jsLabel2PDF.js') }}
    {{ HTML::script('lib/printlabel/external/base64.js') }}
    {{ HTML::script('lib/printlabel/external/sprintf.js') }}
@stop

@section('content')
	<div id="contentwrapper">
		<div id="content_pendaftaran" class="main_content">
        	<div class="row-fluid">
	        	<div class="span12">
	        		@if( $errors->first('txt2_nama') || $errors->first('txt2_tanggal_masuk') )
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('txt2_nama') }}
							{{ $errors->first('txt2_tanggal_masuk') }}
						</div>
	        		@endif
                    <?php $success = Session::get('success'); ?>
                    @if( $success )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    <div class="span9" id="pasientab" style="margin-left:0;">
                        {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div style="display:none;" class="row-fluid">
                            <div class="control-group">
                                    <label class="control-label">Shift</label>
                                    <div class="controls">
                                        <input type="radio" name="shift" id="shift1" value="1" />1 &nbsp;
                                        <input type="radio" name="shift" id="shift2" value="2" />2 &nbsp;
                                        <input type="radio" name="shift" id="shift3" value="3" />3 &nbsp;
                                    </div>
                                </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <button class="btn btn-success btn-top" type="button" id="btn_pasien_baru"><i class="splashy-contact_grey_add"></i> Input Pasien Baru</button>
                            </div>
                            <div class="span12">
                                
                            </div>
                        </div>
                        
                        <div class="row-fluid formSep">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">Nama Lengkap</label>
                                    <div class="controls">
                                        <input type="text" id="txt_nama" name="txt_nama" class="span12 no-primary key-form" data-target="#txt_no_ktp">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Jenis Kelamin</label>
                                    <div class="controls">
                                        <select id="cmb_jenkel" name="cmb_jenkel" class="no-primary key-form" data-target="#txt_tempat_lahir">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <div class="controls">
                                        <input type="text" name="txt_tanggal_lahir" id="txt_tanggal_lahir" class="span12 no-primary key-form tanggal" data-target="#txt_suku" />
                                    </div> <!-- controls -->
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Jaminan Pasien</label>
                                    <div class="controls">
                                        <select id="cmb_golongan_pasien" name="cmb_golongan_pasien" class="no-primary">
                                            <option>Umum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">No Telp (Rumah / HP)</label>
                                    <div class="controls">
                                        <input id="txt_no_telp" name="txt_no_telp" type="text" class="span12 no-primary">
                                    </div>
                                </div>
                            </div> <!-- span6 -->

                            <div class="span6">                                        
                                <div class="control-group">
                                    <label class="control-label">Alamat</label>
                                    <div class="controls">
                                        <input id="txt_alamat" name="txt_alamat" type="text" class="span12 no-primary key-form" data-target="#btn_cari_kelurahan">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Kelurahan</label>
                                    <div class="controls">
                                        <input type="hidden" id="id_desa">
                                        <input id="txt_kelurahan" name="txt_kelurahan" type="text" class="span8" readonly>
                                        <button id="btn_cari_kelurahan" class="btn btn-warning btn-top no-primary" type="button" data-toggle="modal" data-target="#cari_kelurahan"><i class="splashy-zoom"></i></button>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Kecamatan</label>
                                    <div class="controls">
                                        <input id="txt_kecamatan" name="txt_kecamatan" type="text" class="span10" readonly>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Kota</label>
                                    <div class="controls">
                                        <input id="txt_kota" name="txt_kota" type="text" class="span10" readonly>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Provinsi</label>
                                    <div class="controls">
                                        <input id="txt_provinsi" name="txt_provinsi" type="text" class="span10" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                                
                                <div class="row-fluid formSep">
                                    <div class="span6">
                                        
                                        <div class="control-group">
                                            <label class="control-label">Tanggal Masuk</label>
                                            <div class="controls">
                                                <input id="txt2_tanggal_masuk" name="txt2_tanggal_masuk" type="text" class="span10 nowdate">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Jam Masuk</label>
                                            <div class="controls">
                                                <input id="txt2_jam_masuk"  name="txt2_jam_masuk" type="text" class="span10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">

                                        <div class="control-group">
                                            <label class="control-label">Unit Tujuan</label>
                                            <div class="controls">
                                                <select data-placeholder="Pilih Poli" id="cmb2_poli" name="cmb2_poli" >
                                                    @foreach($poli as $u => $s)
                                                        <option value="{{ $s->IdPoli }}">
                                                            {{ $s->NamaPoli }} 
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Cara Bayar</label>
                                            <div class="controls">
                                                <select id="cmb_cara_bayar" name="cmb_cara_bayar" class="no-primary">
                                                    <option value="Umum">Umum</option>
                                                </select>
                                            </div>
                                        </div>

                                        
                                        <div class="control-group">
                                            <label class="control-label">Keterangan</label>
                                            <div class="controls">
                                                <textarea id="txt2_keterangan" name="txt2_keterangan" class=" span10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="txt2_no_rm" name="txt2_no_rm" />   
                                    <input type="hidden" id="no_kartu" name="no_kartu" />        
                                    <input type="hidden" id="no_reg_jalan" name="no_reg_jalan" value="0" />
                                    
                                    <div id="hidden_fields">
                                        
                                    </div>
                                    <div id="pesan_error" class="alert alert-info" style="display:none;font-weight:bold;"></div>
                                    <div class="row-fluid"></div>

                                    

                                    
                                    
                                </div>
                            {{ Form::close() }}
                            </div>
                            <div class="span3">
                                <div class="row-fluid formSep">
                                    <h4>Pasien hari ini</h4>
                                </div>
                                <div class="row-fluid" style="max-height: 500px;overflow-y: auto;">
                                    <table id="tbl_pasien_hari" class="table-hover" style="width:100%;">
                                        <colgroup>
                                            <col class="con1" />
                                            <col class="con2" />
                                            <col class="con3" />
                                            <col class="con4" />
                                        </colgroup>
                                        <thead style="background-color: #CCC;">
                                            <tr>
                                                <th align="center" valign="middle" class="head2">Nama</th>
                                                <th align="center" valign="middle" class="head3">Unit</th>
                                                <th align="center" valign="middle" class="head4"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">Tidak ada riwayat yang ditampilkan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br /><br />
                                <div class="row-fluid formSep">                                    
                                    <h4>Riwayat Pasien</h4>
                                </div>
                                <div  class="row-fluid">
                                    <table id="tbl_history_pasien" style="width:100%;" cellspacing="5" cellpadding="10">
                                        <colgroup>
                                            <col class="con2" />
                                            <col class="con3" />
                                            <col class="con6" />
                                        </colgroup>
                                        <thead style="background-color: #CCC;">
                                            <tr>
                                                <th align="" valign="middle" class="head2">Tanggal</th>
                                                <th align="" valign="middle" class="head3">Poli</th>
                                                <th align="" valign="middle" class="head4"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">Tidak ada riwayat yang ditampilkan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div style="width:100%;position: fixed;bottom:-10px;z-index:999;background: #FFF;padding:10px;" class="control-group formSep">
                                        <div class="controls">
                                            <button disabled="disabled" type="button" id="btn_daftar" class="btn btn-primary">Daftar</button>
                                            <button type="button" id="btn_update" class="btn btn-success no-primary"><i class="splashy-calendar_month_edit"></i> Update Pasien</button>
                                            <button style="display:none;" type="button" id="btn_baru" disabled="disabled" class="btn btn-warning">Tambah</button>

                                            <button type="button" target="" id="btn_cetak3" disabled="disabled" class="btn btn-success"><i class="splashy-printer btn-cetak"></i> Cetak Struk</button>
                                            <button type="button" id="btn_hapus" class="btn btn-danger no-primary"><i class="splashy-error_x"></i> Hapus Pasien</button>
                                            <!--
                                            <button type="button" id="btn_cetak3" class="btn btn-success no-primary"><i class="splashy-printer"></i> Cetak RM</button>
                                            <button type="button" id="btn_cetak4" class="btn btn-success no-primary"><i class="splashy-printer"></i> Cetak Tracer</button>
                                            -->
                                        </div>
                                    </div>
                        </div>
                        
                    </div>
                    <!--
                    <div class="row-fluid">
                        <div class="span12">
                            <button type="button" id="btn_pasien_rawat" class="btn btn-primary no-primary"><i class="splashy-check"></i> Registrasi Rawat Jalan</button>
                            <button type="button" id="btn_update" class="btn btn-success no-primary"><i class="splashy-calendar_month_edit"></i> Update Data Pasien</button>
                            <button type="button" id="btn_riwayat" class="btn btn-success" disabled="disabled"><i class="splashy-printer"></i> Riwayat SEP</button>
                            <button type="button" id="btn_hapus" class="btn btn-danger no-primary"><i class="splashy-error_x"></i> Hapus Pasien</button>
                        </div>
                    </div>
                    
					-->                  
                    
                    
	        	</div>
        	</div>
            <!-- Modal -->
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
                                <col class="con4" />
                                <col class="con5" />
                                <col class="con6" />
                                <col class="con7" />
                                <col class="con8" />
                                <col class="con9" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Jkel</th>
                                    <th align="center" valign="middle" class="head4">TempatLahir</th>
                                    <th align="center" valign="middle" class="head5">TanggalLahir</th>
                                    <th align="center" valign="middle" class="head6">Alamat</th>
                                    <th align="center" valign="middle" class="head7">Gol</th>
                                    <th align="center" valign="middle" class="head8">NoBPJS</th>
                                    <th align="center" valign="middle" class="head9">KTP</th>
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
                                    "sAjaxSource": "{{ url('pasien/datatable') }}",
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
	</div>

    <div class="modal hide fade modal-admin" id="cari_rujukan" tabindex="-1" role="dialog" aria-labelledby="cari_rujukanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_rujukanLabel">Daftar PPK Rujukan</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_rujukan" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">Pilih</th>
                                <th align="center" valign="middle" class="head2">Kode Provider</th>
                                <th align="center" valign="middle" class="head3">Nama Provider</th>
                                <th align="center" valign="middle" class="head4">Alamat</th>
                                <th align="center" valign="middle" class="head5">Kota/ Kabupaten</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_rujukan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/ppkRujukanSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_rujukan_filter input").focus();
                                }
                                
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

    <div class="modal hide fade modal-admin" id="cari_diagnosa" tabindex="-1" role="dialog" aria-labelledby="cari_diagnosaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_diagnosaLabel">Daftar Diagnosa Awal</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_diagnosa" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">Pilih</th>
                                <th align="center" valign="middle" class="head2">Kode Diagnosa</th>
                                <th align="center" valign="middle" class="head3">Deskripsi Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_diagnosa').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/diagnosaSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_diagnosa_filter input").focus();
                                }
                                
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

    <div class="modal hide fade modal-admin" id="cari_kelurahan" tabindex="-1" role="dialog" aria-labelledby="cari_diagnosaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_diagnosaLabel">Daftar Kelurahan</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_kelurahan" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">Pilih</th>
                                <th align="center" valign="middle" class="head2">Desa / kelurahan</th>
                                <th align="center" valign="middle" class="head3">Kecamatan</th>
                                <th align="center" valign="middle" class="head4">Kota / Kab</th>
                                <th align="center" valign="middle" class="head5">Provinsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_kelurahan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('rest/kelurahan') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_diagnosa_filter input").focus();
                                }
                                
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

    <div style="display:none">
        <div id="print1" align="center">

        </div>
        <div id="print2" align="center">

        </div>
        <div id="print3" align="center">

        </div>
        <div id="print4" align="center">

        </div>

    </div>
@stop

@section('js')
	@parent
	{{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('lib/datepicker/bootstrap-datepicker.min.js') }}
    @include('pendaftaran/aps_js')
@stop
