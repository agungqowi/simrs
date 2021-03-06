@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
	{{ HTML::style('css/custom-theme/jquery-ui-1.10.0.custom.css') }}
    <style type="text/css">
        input:focus{ 
            background-color: #FFFF99;
        }
        button:focus{
            border: 2px dotted blue;
        }
		.ui-autocomplete-loading { background:url('{{ url('img/load_gif.gif') }}') no-repeat right center }
	</style>
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
                            <a href="{{ url('apotek_keluar/'.$slug) }}">Apotek</a>
                        </li>
                        <li>
                            <a href="{{ url('apotek_keluar/'.$slug) }}">{{ $title }}</a>
                        </li>
                        <li>
                            Transaksi Keluar
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Transaksi Keluar
                        <div style="float:right;" class="">
                            <button onclick="location.reload();" class="btn btn-success btn-top" id="btn_pasien_baru"><i class="splashy-contact_grey_add"></i> Input Baru</button>
                    	</div>
                    </h3>
                    <?php $validation=array('nama_obat' , 'komposisi' , 'satuan' , 'harga' , 'masa' , 'stok'); ?>
                    @foreach($validation as $v)
                        @if( $errors->first($v) )
    	        			<div class="alert alert-error">
    							<a class="close" data-dismiss="alert">×</a>
    							{{ $errors->first($v) }}
    						</div>
    	        		@endif
                    @endforeach
                    <div id="pesan_error" class="alert alert-error" style="display:none;">
                        
                    </div>
	        	</div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Tanggal Resep<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" class="span6 nowdate" name="tanggal_resep" id="tanggal_resep">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Jenis Rawat<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="select_jenis_rawat" id="select_jenis_rawat" class="span6">
                                        <option value="">-</option>
                                        <option>Rawat Jalan</option>
                                        <option>Rawat Inap</option>
                                        <option value="UGD">IGD</option>
                                        <option>Umum</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Cari Pasien berdasarkan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="select_cari" id="select_cari" class="span6">
                                        <option value="">-</option>
                                        <option value="norm">No RM</option>
                                        <option value="nama">Nama</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">No Register<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="no_register" name="no_register" class="span3 no-primary">
                                    <button id="btnRawatJalan" type="button" class="btn btn-warning"><i class="splashy-zoom"></i> Rawat Jalan</button>
                                    <button id="btnRawatInap" type="button" class="btn btn-warning"><i class="splashy-zoom"></i> Rawat Inap</button>
                                    <button id="btnUgd" type="button" class="btn btn-warning"><i class="splashy-zoom"></i> UGD</button>
                                    @if($title == 'Swasta')
                                        <button type="button" class="btn btn-warning" data-toggle="modal" id="btn_umum"><i class="splashy-zoom"></i> Umum</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid formsep">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input type="text" id="no_rm" name="txt_no_rm" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Rawat</label>
                                <div class="controls">
                                    <input type="text" id="jenis_rawat" name="jenis_rawat" class="span10 no-primary">
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" id="tanggal_masuk" name="tanggal_masuk" class="tanggal span10 no-primary">
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row-fluid" id="obat_edit" style="display:none">
						<div class="span12">
								<input type="hidden" name="IdResep_edit" id="IdResep_edit" />
								<input type="hidden" name="IdObat_edit_asli" id="IdObat_edit_asli" />
								
								<input type="hidden" name="id_resep" id="id_resep" />
								<!--div class="row-fluid">
									<div class="span4">
										<div class="control-group">
											<label class="control-label">No Resep</label>
											<div class="controls">
												<input type="text" id="NoResep_edit" name="NoResep_edit" class="span12" readonly="" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">No RM</label>
											<div class="controls">
												<input type="text" id="NoRM_edit" name="NoRM_edit" class="span12" readonly="" />
											</div>
										</div>
									</div>
									<div class="span8">
										<div class="control-group">
											<label class="control-label">Tanggal Resep</label>
											<div class="controls">
												<input type="text" class="span12" name="TanggalResep_edit" id="TanggalResep_edit" readonly="" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Nama Lengkap</label>
											<div class="controls">
												<input type="text" class="span12" name="NamaLengkap_edit" id="NamaLengkap_edit" readonly="" />
											</div>
										</div>
									</div>
								</div>
								<hr /-->
								<div class="row-fluid">
									<div class="span4">
										<div class="control-group" style="margin-right:-100px;">
											<label class="control-label">Nama Obat</label>
											<div class="controls">
												<button class="btn btn-warning" id="edit_trx_btn_obat" type="button"><i class="splashy-zoom"></i></button>
												<input type="text" id="NamaObat_edit" name="NamaObat_edit" class="span9" placeholder="Ketik Nama Obat" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Kode Obat</label>
											<div class="controls">
												<input type="text" id="IdObat_edit" name="IdObat_edit" class="span12 no-primary" style="width:155%;" />
											</div>
										</div>
									</div>
									<div class="span4">
										<div class="control-group" style="display:none" id="stok_div">
											<label class="control-label">Stok</label>
											<div class="controls">
												<input type="text" class="span12" name="Stok_edit" id="Stok_edit" readonly="" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Harga</label>
											<div class="controls">
												<input type="text" id="Harga_edit" name="Harga_edit" class="span12" readonly="" />
											</div>
										</div>
									</div>
									<div class="span4">
										<div class="control-group">
											<label class="control-label">Jumlah</label>
											<div class="controls">
												<input type="text" class="span10" name="Jumlah_edit" id="Jumlah_edit">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Total</label>
											<div class="controls">
												<input type="text" class="span10" name="TotalHarga_edit" id="TotalHarga_edit" readonly="" />
											</div>
										</div>
									</div>
								</div>
								<div class="row-fluid formsep">
									<div class="span2"> </div>
									<div class="span4">
										<div class="alert alert-info" style="display:none" id="LebihDariStok">
											<strong>Jumlah Barang Melebihi Stok</strong>
										</div>
									</div>
									<div class="span6">
										<div align="right" class="">
											<button type="button" class="btn btn-primary" onclick="simpan_edit_trx()"><i class="splashy-check"></i> Update</button>
											<button type="button" class="btn btn-danger" onclick="batal_edit()"><i class="splashy-document_a4_marked"></i> Batal</button>
										</div>
									</div>
								</div>
						</div>
					</div>
					<div class="row-fluid" id="obat_baru">
						<div class="span12">
							<div class="row-fluid">
								<div class="span4">
									<div class="control-group" style="margin-right:-100px;">
										<label class="control-label">Nama Obat</label>
										<div class="controls">
											<button class="btn btn-warning" id="btn_obat" type="button"><i class="splashy-zoom"></i></button>
											<input type="text" id="nama_obat" name="nama_obat" class="span9" placeholder="Ketik Nama Obat" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Kode Obat</label>
										<div class="controls">
											<input type="text" id="id_obat" name="id_obat" class="span12 no-primary" style="width:155%;" />
										</div>
									</div>
								</div>
								<div class="span4">
									<div class="control-group">
										<label class="control-label">Harga</label>
										<div class="controls">
											<input type="text" id="harga" name="harga" class="span10 no-primary" style="text-align: right">
										</div>
									</div>                            
									<div class="control-group">
										<label class="control-label">Stok</label>
										<div class="controls">
											<input type="text" id="stok" name="stok" class="span10 no-primary" style="text-align: right">
										</div>
									</div>  
								</div>
								<div class="span4">
									<div class="control-group">
										<label class="control-label">Jumlah<span class="f_req">*</span></label>
										<div class="controls">
											<input type="text" id="jumlah" name="jumlah" class="span10 edit-primary" style="text-align: right">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Total</label>
										<div class="controls">
											<input type="text" id="total" name="total" class="span10 no-primary" style="text-align: right">
										</div>
									</div>
								</div>
							</div>
							<div class="row-fluid formsep">
								<div class="span12">
									<div class="row-fluid">
										<div class="span6">
											<div align="left" id="pdf_excel" style="display:none">
												<!--
												<button type="button" class="btn btn-info" onclick="buat_pdf()" value="create_pdf"><i class="splashy-document_a4_edit"></i> Create PDF</button>
												-->
												<button type="button" class="btn btn-success" onclick="buat_excel('Excel5')" value="create_pdf"><i class="splashy-calendar_week_add"></i> Excel 2003</button>
												<button type="button" class="btn btn-success" onclick="buat_excel('Excel2007')" value="create_pdf"><i class="splashy-calendar_week_add"></i> Excel 2007</button>
											</div>  
											<div align="left" id="load_list" style="display:none">
												<img src="{{ url('img/load_gif.gif') }}" /> Memuat Data Resep dan Obat ...
											</div>
										</div>
										<div class="span6">
											<div align="right">
												<button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
												<button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="row-fluid">
                        <div class="span12">
							<div id="pesan_error2" class="alert alert-info" style="display:none;">
							</div>
						</div>
					</div>
					
                    <div class="row-fluid">
                        <div class="span12">
                        <table id="resep_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal Resep</th>
                                    <th>No RM</th>
                                    <th>Jenis Rawat</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    
                {{ Form::close() }}
	   	</div>
	</div>
    <div class="modal hide fade modal-admin" id="edit_trx" tabindex="-1" role="dialog" aria-labelledby="edit_trxLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit_trxLabel">Daftar Obat</h4>
                    </div>
                    <div class="modal-body">
					
							<div class="row-fluid">
								<div class="span12">
									<div id="pesan_error_edit_trx" class="alert alert-error" style="display:none;">
									</div>
								</div>
							</div>
<!--	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		 -->		
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
              </div>
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
                                    "sAjaxSource": "{{ url('rawat_inap/popup_table_byreg') }}",
                                    "bServerSide": true,
                                    "fnInitComplete": function() {
                                        $("#tbl_pasien_inap_filter input").focus();
                                    }
                                
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
                                    <th align="center" valign="middle" class="head3">Tanggal</th>
                                    <th align="center" valign="middle" class="head4">Poli</th>
                                    <th align="center" valign="middle" class="head5">No Reg</th>
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
                                    "bServerSide": true,
                                    "fnInitComplete": function() {
                                        $("#tbl_pasien_jalan_filter input").focus();
                                    }
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
                                    <th align="center" valign="middle" class="head4">No Reg</th>
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
                                    "sAjaxSource": "{{ url('ugd/popup_table_byreg') }}",
                                    "bServerSide": true,
                                    "fnInitComplete": function() {
                                        $("#tbl_ugd_filter input").focus();
                                    }
                                
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
        
    <div class="modal hide fade modal-admin" id="cari_obat_edit" tabindex="-1" role="dialog" aria-labelledby="cari_obat_editLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_obat_editLabel">Pencarian Obat</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_obat_edit" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con0" />
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
                                <th align="center" valign="middle" class="head0">Pilih</th>
                                <th align="center" valign="middle" class="head1">ID Obat</th>
                                <th align="center" valign="middle" class="head2">Nama Obat</th>
                                <th align="center" valign="middle" class="head3">Komposisi</th>
                                <th align="center" valign="middle" class="head4">Satuan</th>
                                <th align="center" valign="middle" class="head5">Stok</th>
                                <th align="center" valign="middle" class="head6">Jenis Obat</th>
                                <th align="center" valign="middle" class="head7">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function(){
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal hide fade modal-admin" id="cari_obat" tabindex="-1" role="dialog" aria-labelledby="cari_obatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_obatLabel">Pencarian Obat</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_obat" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con0" />
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
                                <th align="center" valign="middle" class="head0">Pilih</th>
                                <th align="center" valign="middle" class="head1">ID Obat</th>
                                <th align="center" valign="middle" class="head2">Nama Obat</th>
                                <th align="center" valign="middle" class="head3">Komposisi</th>
                                <th align="center" valign="middle" class="head4">Satuan</th>
                                <th align="center" valign="middle" class="head5">Stok</th>
                                <th align="center" valign="middle" class="head6">Jenis Obat</th>
                                <th align="center" valign="middle" class="head7">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function(){
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
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        var oTable;
        $(document).ready(function() {
			$(function(){
				$( "#nama_obat" ).autocomplete({
					source: "{{URL('apotek_keluar/getdata/'.$slug)}}",
					minLength: 3,
					select: function(event, ui) {
						$('#id_obat').val(ui.item.kodobat);
						$('#nama_obat').val(ui.item.id);
						$('#stok').val(ui.item.stok);
						$('#harga').val(ui.item.harga);
						$('#jumlah').focus();
					}
				});
			}); 
			
			$(function(){
				$( "#NamaObat_edit" ).autocomplete({
					source: "{{URL('apotek_keluar/getdata/'.$slug)}}",
					minLength: 3,
					select: function(event, ui) {
						$('#stok_div').show();
						
						var jumlah = parseInt( $('#Jumlah_edit').val() );
						if(jumlah > parseInt(ui.item.stok)){
							$('#LebihDariStok').show();
							$('#Jumlah_edit').val(ui.item.stok);
						}
						else{
							$('#LebihDariStok').hide();
						}
		
						$('#IdObat_edit').val(ui.item.kodobat);
						$('#NamaObat_edit').val(ui.item.id);
						$('#Stok_edit').val(ui.item.stok);
						$('#Harga_edit').val(ui.item.harga);
						$('#Jumlah_edit').focus();
						
						var totalnya = harga * $('#Jumlah_edit').val();
						$('#TotalHarga_edit').val(totalnya);
					}
				});
			}); 

            $('#tanggal_resep').focus();
            $('#btn_umum').click(function(){
                $('#no_rm').val('000000');
                $('#nama_lengkap').val('Pasien Umum');
                $('#tanggal_masuk').val('');
                $('#jenis_rawat').val('');
                $('#no_register').val('');
            })
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

            $('.edit-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

            $('#Jumlah_edit').on('input', function() {
                var stok_edit = parseInt($('#Stok_edit').val());
                var jumlah_edit = parseInt($('#Jumlah_edit').val());
				if(jumlah_edit > stok_edit){
					$('#LebihDariStok').show();
					$('#Jumlah_edit').val(stok_edit);
				}
				else{
					$('#LebihDariStok').hide();
					var harga_edit = $('#Harga_edit').val();
					var val_edit = jumlah_edit * harga_edit;
					$('#TotalHarga_edit').val( val_edit );
				}
            });

            $('#jumlah').on('input', function() {
                var jumlah = $('#jumlah').val();
                var harga = $('#harga').val();
                var val = jumlah * harga;
                $('#total').val( val );
            });

            $('#jumlah').keypress(function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#tanggal_resep').val() != '' ){
                        tambah_transaksi();
                    }
                } 
            })

            $('#Jumlah_edit').keypress(function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    simpan_edit_trx();
                } 
            })
			
            $('#simpan').click(function(){
                tambah_transaksi();
            });

            $('#select_jenis_rawat').on('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#select_jenis_rawat').val() != '' ){
                        $('#select_cari').focus();
                    }
                            
                }                    
            });

            

            $('#tanggal_resep').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#tanggal_resep').val() != '' ){
                        $('#btnRawatJalan').focus();
                    }
                            
                }
            });

            $('#tanggal_resep').change(function(){
                list_transaksi();
            })

            $('#btnRawatJalan').click(function(){
                $('#cari_rawat_jalan').modal('show');
            });

            $('#cari_rawat_jalan').on('shown', function () {
                $("#tbl_pasien_jalan_filter input").focus();
            });

            $('#btnRawatInap').click(function(){
                $('#cari_rawat_inap').modal('show');
            });

            $('#cari_rawat_inap').on('shown', function () {
                $("#tbl_pasien_inap_filter input").focus();
            });

            $('#btnUgd').click(function(){
                $('#cari_ugd').modal('show');
            });

            $('#cari_ugd').on('shown', function () {
                $("#tbl_ugd_filter input").focus();
            });

            $('#edit_trx_btn_obat').click(function(){
                $('#cari_obat_edit').modal('show');
            });

            $('#cari_obat_edit').on('shown', function () {
                $("#tbl_obat_edit input").focus();
            });

            $('#btn_obat').click(function(){
                $('#cari_obat').modal('show');
            });

            $('#cari_obat').on('shown', function () {
                $("#tbl_obat_filter input").focus();
            });

            load_datatable();
        });

        function load_datatable(){
            oTable = $('#tbl_obat').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                "sPaginationType": "full_numbers",
                "bProcessing": false,
                "sAjaxSource": "{{ url('apotek_obat/detaildatatable/'.$slug ) }}",
                "bServerSide": true,
                "aoColumnDefs" : [
                    {
                        "aTargets" : [ 5 ],
                        "sClass" : "align-right"
                    },
                    {
                        "aTargets" : [ 7 ],
                        "sClass" : "align-right"
                    }
                ],
                "fnInitComplete": function() {
                    $("#tbl_obat_filter input").focus();
                }
            });
							oTable = $('#tbl_obat_edit').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
								"sPaginationType": "full_numbers",
								"bProcessing": false,
								"sAjaxSource": "{{ url('apotek_obat/detaildatatable_edit/'.$slug ) }}",
								"bServerSide": true,
								"aoColumnDefs" : [
									{
										"aTargets" : [ 5 ],
										"sClass" : "align-right"
									},
									{
										"aTargets" : [ 7 ],
										"sClass" : "align-right"
									}
								],
								"fnInitComplete": function() {
									$("#tbl_obat_edit_filter input").focus();
								}
							});
        }

		function batal_edit(){
			$('#obat_baru').show();
			$('#obat_edit').hide();
		}

        function pilih_pasien(id,opt){
            $('.edit-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

            if(opt == 'ugd'){
                $('#cari_ugd').modal('hide');
            }
            else if(opt=='jalan'){
                $('#cari_rawat_jalan').modal('hide');
            }
            else{
                $('#cari_rawat_inap').modal('hide');
            }
            
            //$('#no_rm').val(id);
            pasien_find(id,opt);

            //$('#btn_obat').focus();
            $('#nama_obat').focus();
			
            //pasien_find(id)
        }

        function pasien_find(val,opt){
            if(opt == 'jalan'){
                target_url = "{{ url('rest/rawat_jalan') }}";
            }
            else if(opt == 'ugd'){
                target_url = "{{ url('rest/ugd_byreg') }}";
            }
            else {
                target_url = "{{ url('rest/rawat_inap_byreg') }}";
            } 
            $.ajax({
                url: target_url + '/'+val,
                dataType: "json",
                success: function(res){
                    if(res == false)
                        alert('Data transaksi pasien tidak ditemukan');
                    else{
                        $('#pesan_error').hide();
                        $('#id_reg').val(res[0].NoReg);
                        $('#no_rm').val(res[0].NoRM);
                        $('#nama_lengkap').val(res[0].Nama);
                        if( res[0].Tanggal != '' || res[0].Tanggal != '-'){
                            var _tglArray = res[0].Tanggal.split("-");
                            $('#tanggal_masuk').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
                        }
                        else{
                            $('#tanggal_masuk').val(' ');
                        }
                        if(opt == 'jalan'){
                            $('#jenis_rawat').val('Rawat Jalan');
                            $('#no_register').val( res[0].NoRegJalan );
                            $('#cari_rawat_jalan').modal('hide');
                        }
                        else if(opt == 'ugd'){
                            $('#jenis_rawat').val('UGD')
                            $('#no_register').val( res[0].NoRegUGD );
                            $('#cari_ugd').modal('hide');;
                        }
                        else {
                            $('#jenis_rawat').val('Rawat Inap');
                            $('#no_register').val( res[0].NoReg );
                            $('#cari_rawat_inap').modal('hide');
                        } 
                        
                        $('.edit-primary').each(function(){
                            $(this).attr('disabled',false);
                        });

                        list_transaksi();
                    }

                },
                error:function(res){
                    alert('Connection failed');
                }
            });
            
            
        }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        function pilih_obat_edit(id,nama,jenis,komposisi,satuan,masa,stok,harga){
            $('#stok_div').show();
			if(stok == 0){
                alert('Stok obat kosong');
            }
            else{
                
                var jumlah = parseInt( $('#Jumlah_edit').val() );
				if(jumlah > parseInt(stok)){
					$('#LebihDariStok').show();
					$('#Jumlah_edit').val(stok);
				}
				else{
					$('#LebihDariStok').hide();
				}
				$('#IdObat_edit').val(id);
                $('#NamaObat_edit').val(nama);
                $('#Harga_edit').val(harga);
                $('#Stok_edit').val(parseInt(stok));

                $('#Jumlah_edit').attr('disabled',false);

                $('#cari_obat_edit').modal('hide');
                $('#Jumlah_edit').focus();
				
				var totalnya = harga * $('#Jumlah_edit').val();
				$('#TotalHarga_edit').val(totalnya);
            }
        }

        function pilih_obat(id,nama,jenis,komposisi,satuan,masa,stok,harga){
            if(stok == 0){
                alert('Stok obat kosong');
            }
            else{
                $('#id_obat').val(id);
                $('#nama_obat').val(nama);
                $('#harga').val(harga);
                $('#stok').val(stok);

                $('#jumlah').attr('disabled',false);

                $('#cari_obat').modal('hide');
                $('#jumlah').focus();
            }
        }

        function list_transaksi(){
            var id_reg = $('#no_register').val();
            if(id_reg == '')
                id_reg = 'zxasqwopsds';
			$('#pdf_excel').hide();
			$('#load_list').show();
            $.ajax({
                url: "{{ url('apotek_keluar/list_transaksi/'.$slug) }}"+'/'+id_reg,
                dataType: "json",
                success: function(res){
                    $('#resep_list tbody').html('');
                    if(res == false){
						$('#load_list').hide();
                    }
                    else{
						$.each(res, function (key, data) {
                            $('#resep_list tbody').append('<tr><td>'+data.NoResep+'</td>'+
                                    '<td>'+data.TanggalResep+'</td>'+
                                    '<td>'+data.NoRM+'</td>'+
                                    '<td>'+data.JenisRawat+'</td>'+
                                    '<td>'+data.NamaObat+'</td>'+
                                    '<td class="align-right">'+data.Harga+'</td>'+
                                    '<td class="align-right">'+data.Jumlah+'</td>'+
                                    '<td class="align-right">'+data.TotalHarga+'</td>'+
                                    '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.IdResep+"',"+
                                        "'"+data.IdObat+"',"+
                                        "'"+data.NoRM+"',"+
                                        "'"+data.TanggalResep+"'"+')">'+
                                    	'<i class="splashy-error_x"></i>'+
                                		'</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="edit_transaksi('+"'"+data.IdResep+"',"+
                                        "'"+data.NoResep+"',"+
                                        "'"+data.TanggalResep+"',"+
                                        "'"+data.NoRM+"',"+
                                        "'"+data.IdObat+"',"+
                                        "'"+data.NamaObat+"',"+
                                        "'"+data.Harga+"',"+
                                        "'"+data.Jumlah+"',"+
                                        "'"+data.TotalHarga+"'"+')">'+
                                    	'<i class="splashy-folder_modernist_edit"></i>'+
                                		'</a></td></tr>');
                        });
						$('#load_list').hide();
                        $('#pdf_excel').show();
                    }
                },
                error:function(res){
                    alert('Connection failed');
                }
            });
            $('#tbl_obat').dataTable().fnReloadAjax();
        }

        function tambah_transaksi(){
            var no_reg = $('#no_register').val();
            var id_obat = $('#id_obat').val();
            var jumlah = parseInt( $('#jumlah').val() );
            var harga = $('#harga').val();
            var total = $('#total').val();
            var tanggal_resep = $('#tanggal_resep').val()
            var no_rm = $('#no_rm').val();
            var tanggal_masuk = $('#tanggal_masuk').val();
            var jenis_rawat = $('#jenis_rawat').val();
            var nama_obat = $('#nama_obat').val();
            var stok = parseInt( $('#stok').val() );
            var nama_lengkap = $('#nama_lengkap').val();
			cetak_alert2('Proses input data ...');
            $('#pesan_error').hide();

            if(tanggal_resep == ''){
                cetak_alert('Tanggal Resep tidak boleh kosong');
                $('#tanggal_resep').focus();
            }
            else if(no_rm == ''){
                cetak_alert('Pasien tidak boleh kosong');
            }
            else if(stok < jumlah){
                cetak_alert('Stok obat tidak mencukupi untuk quantity sebanyak '+jumlah+', stok obat saat ini '+stok);
                $('#stok').focus();
            }
            else if(jumlah == '' || jumlah == '0'){
                cetak_alert('Jumlah barang tidak boleh kosong');
                $('#jumlah').focus();
            }
            else{

                $.ajax({
                    url: "{{ url('apotek_keluar/check_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah,
                    success:function(resa){
                        if(resa == 'ada'){
                            var r = confirm("Transaksi obat dengan jumlah yang sama sudah ada,  apakah anda ingin tetap meneruskan?");
                            if (r == true) {
								
                                $.ajax({
                                    url: "{{ url('apotek_keluar/tambah_transaksi/'.$slug) }}",
                                    type: "POST",
                                    data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&tanggal_masuk="+tanggal_masuk+
                                            "&total="+total+"&no_rm="+no_rm+"&jenis_rawat="+jenis_rawat+
                                            "&tanggal_resep="+tanggal_resep+"&nama_obat="+nama_obat+"&stok="+stok+"&nama_lengkap="+nama_lengkap,
                                    success:function(res){
                                        if(res == 'sukses'){
											list_transaksi();
                                            $('#pesan_error2').hide();
											cetak_alert('Data berhasil ditambahkan');
                                            $('#id_obat').val('');
                                            $('#nama_obat').val('');
                                            $('#harga').val('');
                                            $('#total').val('');
                                            $('#stok').val('');
                                            $('#jumlah').val('');
											setTimeout(function(){$("#pesan_error").hide()}, 4000);
                                            //$('#tbl_obat').dataTable().fnReloadAjax();
                                        }
                                        else{
                                            $('#pesan_error2').hide();
											cetak_alert(res);
                                        }
                                        $('#nama_obat').focus();
                                    }
                                });
                            }
                            else{
                            	$('#pesan_error2').hide();
                            }
                        }
                        else{
                            
							$.ajax({
                                url: "{{ url('apotek_keluar/tambah_transaksi/'.$slug) }}",
                                type: "POST",
                                data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&tanggal_masuk="+tanggal_masuk+
                                        "&total="+total+"&no_rm="+no_rm+"&jenis_rawat="+jenis_rawat+
                                        "&tanggal_resep="+tanggal_resep+"&nama_obat="+nama_obat+"&stok="+stok+"&nama_lengkap="+nama_lengkap,
                                success:function(res){
                                    if(res == 'sukses'){
										list_transaksi();
                                        $('#pesan_error2').hide();
										cetak_alert('Data berhasil ditambahkan');
                                        $('#id_obat').val('');
                                        $('#nama_obat').val('');
                                        $('#harga').val('');
                                        $('#total').val('');
                                        $('#stok').val('');
                                        $('#jumlah').val('');
                                        //$('#tbl_obat').dataTable().fnReloadAjax();
										setTimeout(function(){$("#pesan_error").hide()}, 4000);
                                    }
                                    else{
                                        $('#pesan_error2').hide();
										cetak_alert(res);
                                    }
                                    $('#nama_obat').focus();
                                }
                            });
                        }
                    }
                });
                
            }
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		

        function edit_transaksi(IdResep,NoResep,TanggalResep,NoRM,IdObat,NamaObat,Harga,Jumlah,TotalHarga){ 
			
			$('#obat_baru').hide();
			$('#obat_edit').show();
			$('#Jumlah_edit').focus();
			//$('#edit_trx').modal('show');
			$('#IdResep_edit').val(IdResep);
			$('#IdObat_edit_asli').val(IdObat);
			//$('#NoResep_edit').val(NoResep);
			//$('#TanggalResep_edit').val(TanggalResep);
			//$('#NoRM_edit').val(NoRM);
			//$('#NamaLengkap_edit').val($('#nama_lengkap').val());		
			$('#IdObat_edit').val(IdObat);
			$('#NamaObat_edit').val(NamaObat);
			$('#Harga_edit').val(Harga);
			$('#Jumlah_edit').val(Jumlah);
			$('#TotalHarga_edit').val(TotalHarga);
		}
        function simpan_edit_trx(){
            var IdResep = $('#IdResep_edit').val();
            var IdObat_asli = $('#IdObat_edit_asli').val();
            //var NoResep = $('#NoResep_edit').val();
            //var TanggalResep = $('#TanggalResep_edit').val()
            //var NoRM = $('#NoRM_edit').val();
            //var NamaLengkap = $('#NamaLengkap_edit').val();
            var IdObat = $('#IdObat_edit').val();
            var NamaObat = $('#NamaObat_edit').val();
            var Harga = $('#Harga_edit').val();
            var Jumlah = parseInt( $('#Jumlah_edit').val() );
            var TotalHarga = $('#TotalHarga_edit').val();
            //var Stok = parseInt( $('#Stok_edit').val() );

            if(Jumlah == '' || Jumlah == '0'){
				$('#pesan_error_edit_trx').show();
				$('#pesan_error_edit_trx').html('Jumlah barang tidak boleh kosong');
                $('#Jumlah_edit').focus();
            }
            else{
				$('#edit_trx').modal('hide');
				cetak_alert2('Proses edit data ...');
                $.ajax({
                     url: "{{ url('apotek_keluar/edit_transaksi/'.$slug) }}",
                     type: "POST",
                     data : "IdResep="+IdResep+"&IdObat_asli="+IdObat_asli+"&IdObat="+IdObat+"&NamaObat="+NamaObat+"&Harga="+Harga+"&Jumlah="+Jumlah+"&TotalHarga="+TotalHarga,
                     success:function(res){
                          if(res == 'sukses'){
                               $('#pesan_error2').hide();
							   cetak_alert('Data berhasil diperbaharui');
							   setTimeout(function(){$("#pesan_error").hide()}, 4000);
                          }
                          else{
                               $('#pesan_error2').hide();
							   cetak_alert(res);
							   setTimeout(function(){$("#pesan_error").hide()}, 4000)
                          }
                          list_transaksi();
						  $('#obat_baru').show();
						  $('#obat_edit').hide();

						  $('#nama_obat').focus();
                     }
                 });
            }
        }

        function hapus_transaksi(id_resep,kodobat,no_rm,tanggal_resep){ 
			cetak_alert2('Proses menghapus data ...');
            var r = confirm('Hapus transaksi ?');
            if (r == true) {
                $.ajax({
                    url: "{{ url('apotek_keluar/hapus_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "id_resep="+id_resep+"&kodobat="+kodobat,
                    success:function(res){
                        list_transaksi();
						$('#pesan_error2').hide();
                        cetak_alert('Data berhasil dihapus');
						setTimeout(function(){$("#pesan_error").hide()}, 4000)
                    }
                });
            }
			else{
				$('#pesan_error2').hide();
			}
            
            $('#nama_obat').focus();
        }

        function cetak_alert2(str){
            $('#pesan_error2').show();
            $('#pesan_error2').html(str);
        }

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }

        function buat_excel(mode){
			var noreg = $("#no_register").val();
			//cetak_alert2("{{ url('apotek_keluar/excel') }}/"+mode+"/"+noreg);
			window.location.href = "{{ url('apotek_keluar/excel') }}/"+mode+"/"+noreg;
		}

        function buat_pdf(){
			var noreg = $("#no_register").val();
			//cetak_alert("{{ url('apotek_keluar/pdf') }}/"+noreg);
			window.location.href = "{{ url('apotek_keluar/pdf') }}/"+noreg;
		}

    </script>
@stop