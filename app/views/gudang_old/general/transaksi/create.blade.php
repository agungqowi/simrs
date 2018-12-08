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
		#resep_list th{
			text-align: center;
			vertical-align:middle;
		}
		table th {
			width: auto !important;
		}
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
                            <a href="{{ url('gudang_keluar/'.$slug) }}">Gudang</a>
                        </li>
                        <li>
                            <a href="{{ url('gudang_keluar/'.$slug) }}">{{ $title }}</a>
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
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">No Bukti<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="no_bukti" name="no_bukti" class="span12">
                                </div>
                            </div>
                        </div>
                        <div class="span4">         
                            <div class="control-group">
                                <label class="control-label">Tanggal<span class="f_req">*</span></label>
                                <div class="controls">
									<input type="text" class="span12 nowdate" name="tanggal_bukti" id="tanggal_bukti">
                                </div>
                            </div>
                        </div>
                        <div class="span4">         
                            <div class="control-group">
                                <label class="control-label">Pelanggan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="pelanggan" id="pelanggan" class="span12">
                                    <option value="-">Pilih Pelanggan</option>
                                        @foreach($pelanggan as $p)
                                            <option value="{{ $p->kodeplg }}">{{ $p->namaplg }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row-fluid formSep">
                        <div class="span12">
							<div class="row-fluid" id="trx_baru">
								 <div class="span12">
									<div class="row-fluid">
										<div class="span4">
											<div class="control-group" style="margin-right:-100px;">
												<label class="control-label">Nama Obat</label>
												<div class="controls" id="obat_lama">
													<button class="btn btn-warning" id="btn_obat" type="button" data-toggle="modal" data-target="#cari_obat"><i class="splashy-zoom"></i></button>
													<input type="text" id="nama_obat" name="nama_obat" class="span8" placeholder="Ketik Nama Obat" />
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Kode Obat</label>
												<div class="controls">
													<input type="text" id="id_obat" name="id_obat" class="no-primary">
												</div>
											</div>                                    
											<!--div class="control-group">
												<label class="control-label">Jenis Obat</label>
												<div class="controls">
													<select name="jenis_obat" id="jenis_obat">
														@foreach($jenis_obat as $j=>$k)
															<option value="{{ $k->kodegudang }}">{{ $k->namagudang }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Komposisi</label>
												<div class="controls">
													<input type="text" id="komposisi" name="komposisi">
												</div>
											</div-->
											<div class="control-group">
												<label class="control-label">Satuan</label>
												<div class="controls">
													<input type="text" id="satuan" name="satuan" class="no-primary">
												</div>
											</div>
										</div>
										<div class="span4">
											<!--div class="control-group">
												<label class="control-label">Kadaluarsa</label>
												<div class="controls">
													<input type="text" id="masa" name="masa" class="span12 tanggal">
												</div>
											</div-->
											<div class="control-group">
												<label class="control-label">Stok</label>
												<div class="controls">
													<input type="text" id="stok" name="stok" class="span12 no-primary" style="text-align: right">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Harga Beli</label>
												<div class="controls">
													<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" style="text-align: right">
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
												<label class="control-label">Harga Jual</label>
												<div class="controls">
													<input type="text" id="harga" name="harga" class="span12 no-primary" style="text-align: right">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Jumlah Pembelian<span class="f_req">*</span></label>
												<div class="controls">
													<input type="text" id="jumlah" name="jumlah" class="span12" style="text-align: right">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Total Bayar</label>
												<div class="controls">
													<input type="text" id="total" name="total" class="span12 no-primary" style="text-align: right">
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span6">
											<div align="left" id="pdf_excel" style="display:none">
												<button type="button" class="btn btn-info" onclick="buat_pdf()" value="create_pdf"><i class="splashy-document_a4_edit"></i> Create PDF</button>
												<button type="button" class="btn btn-success" onclick="buat_excel('Excel5')" value="create_pdf"><i class="splashy-calendar_week_add"></i> Excel 2003</button>
												<button type="button" class="btn btn-success" onclick="buat_excel('Excel2007')" value="create_pdf"><i class="splashy-calendar_week_add"></i> Excel 2007</button>
											</div>  
											<div align="left" id="load_list" style="display:none">
												<img src="{{ url('img/load_gif.gif') }}" /> Loading Data ...
											</div>
										</div>
										<div class="span6">
											<div align="right">
												<button id="btn_simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
												<button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row-fluid" id="trx_edit" style="display:none">
								 <div class="span12">
									<div class="row-fluid">
										<div class="span4">
											<div class="control-group" style="margin-right:-100px;">
												<label class="control-label">Nama Obat</label>
												<div class="controls">
													<button type="button" id="cari_edit" class="btn btn-warning" onkeypress="cari_obat_edit()" onclick="cari_obat_edit()"><i class="splashy-zoom"></i></button>
													<input type="text" id="nama_obat_edit" name="nama_obat_edit" class="span8" placeholder="Ketik Nama Obat" />
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Kode Obat</label>
												<div class="controls">
													<input type="text" id="id_obat_edit" name="id_obat_edit" class="no-primary">
													<input type="hidden" id="no_trx" name="no_trx" class="no-primary">
													<input type="hidden" name="id_obat_edit_asli" id="id_obat_edit_asli" />
													<input type="hidden" name="jumlah_edit_asli" id="jumlah_edit_asli" />
												</div>
											</div>                                    
											<!--div class="control-group">
												<label class="control-label">Jenis Obat</label>
												<div class="controls">
													<select name="jenis_obat_edit" id="jenis_obat_edit">
														@foreach($jenis_obat as $j=>$k)
															<option value="{{ $k->kodegudang }}">{{ $k->namagudang }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Komposisi</label>
												<div class="controls">
													<input type="text" id="komposisi_edit" name="komposisi_edit">
												</div>
											</div-->
										</div>
										<div class="span4">
											<!--div class="control-group">
												<label class="control-label">Kadaluarsa</label>
												<div class="controls">
													<input type="text" id="masa_edit" name="masa_edit" class="span12 tanggal">
												</div>
											</div-->
											<div class="control-group">
												<label class="control-label">Satuan</label>
												<div class="controls">
													<input type="text" id="satuan_edit" name="satuan_edit" class="span12">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Stok Awal</label>
												<div class="controls">
													<input type="text" id="stok_edit" name="stok_edit" class="span12 no-primary" style="text-align: right">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Harga Beli</label>
												<div class="controls">
													<input type="text" id="harga_beli_edit" name="harga_beli_edit" class="span12" style="text-align: right">
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
												<label class="control-label">Harga Jual</label>
												<div class="controls">
													<input type="text" id="harga_edit" name="harga_edit" class="span12" style="text-align: right">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Jumlah Pembelian<span class="f_req">*</span></label>
												<div class="controls">
													<input type="text" id="jumlah_edit" name="jumlah_edit" class="span12" style="text-align: right">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Total Bayar</label>
												<div class="controls">
													<input type="text" id="total_edit" name="total_edit" class="span12 no-primary" style="text-align: right">
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span6">
											<div align="left" id="pdf_excel" style="display:none">
											</div>  
											<div align="left" id="load_list" style="display:none">
												<img src="{{ url('img/load_gif.gif') }}" /> Loading Data ...
											</div>
										</div>
										<div class="span6">
											<div align="right">
												<button id="btn_edit" type="button" class="btn btn-primary" onclick="simpan_edit()"><i class="splashy-check"></i> Update</button>
												<button type="button" class="btn btn-danger" onclick="batal_edit()"><i class="splashy-document_a4_marked"></i> Batal</button>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12">
                        <table id="resep_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Satuan</th>
                                    <th>Harga Jual</th>
									<th>Harga Beli</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Stok Akhir</th>
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
</div>
    <div class="modal hide fade modal-admin" id="cari_obat" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pasienLabel">Pencarian Obat</h4>
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
                                <th align="center" valign="middle" class="head6">Jenis Obat</th>
                                <th align="center" valign="middle" class="head4">Satuan</th>
                                <th align="center" valign="middle" class="head5">Stok</th>
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

    <div class="modal hide fade modal-admin" id="cari_obat_edit" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pasienLabel">Pencarian Obat</h4>
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
                                <th align="center" valign="middle" class="head6">Jenis Obat</th>
                                <th align="center" valign="middle" class="head4">Satuan</th>
                                <th align="center" valign="middle" class="head5">Stok</th>
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
			$('#no_bukti').focus();
            $('#no_bukti').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#no_bukti').val() != '' ){
                        $('#tanggal_bukti').focus();
                        list_transaksi();
                    }
                }                    
            });

            $('#tanggal_bukti').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#tanggal_bukti').val() != '' )
                        $('#pelanggan').focus();
                }
                if(code == 27 || code == 38)
					$('#no_bukti').focus();
            });


            $('#pelanggan').change(function(){
				$('#nama_obat').focus();
            });

            $('#pelanggan').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 32)
					$('#tanggal_bukti').focus();
            });

			$(function(){
				$( "#nama_obat" ).autocomplete({
					source: "{{URL('gudang_keluar/getdata/'.$slug)}}",
					minLength: 3,
					select: function(event, ui) {
						$('#id_obat').val(ui.item.kodobat);
						$('#nama_obat').val(ui.item.id);
						$('#stok').val(ui.item.stok);
						$('#harga').val(ui.item.harga);
						var hargaobat = ui.item.harga;
						if (hargaobat == '0')
							$('#harga').attr('disabled',false);
						
						//$('#komposisi').val(ui.item.komposisi);
						//$('#masa').val(ui.item.masa);
						$('#satuan').val(ui.item.satuan);
						$('#harga_beli').val(ui.item.hargabeli);
						
						//$("#jenis_obat option[value='"+ui.item.kodegudang+"']").remove();
						//$("#jenis_obat").prepend('<option value="'+ui.item.kodegudang+'" selected="selected">'+ui.item.namagudang+'</option>');
						
						//$('#jenis_obat').focus();
						$('#jumlah').focus();
						
					}
				});
			}); 
			
            $('#nama_obat').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 27 || code == 38)
					$('#pelanggan').focus();
            });

/*            $('#jenis_obat').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#komposisi').focus();
                if(code == 32)
					$('#nama_obat').focus();
            });

            $('#komposisi').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#masa').focus();
                if(code == 27 || code == 38)
					$('#jenis_obat').focus();
            });

            $('#masa').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#satuan').focus();
                if(code == 27 || code == 38)
					$('#komposisi').focus();
            });

            $('#satuan').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#harga_beli').focus();
                if(code == 27 || code == 38)
					$('#masa').focus();
            });

            $('#harga_beli').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#harga').focus();
                if(code == 27 || code == 38)
					$('#satuan').focus();
            });

            $('#harga').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#jumlah').focus();
                if(code == 27 || code == 38)
					$('#harga_beli').focus();
            });
*/
            $('#jumlah').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13){
					tambah_transaksi();
                }
				else if(code == 27 || code == 38){
					//$('#harga').focus();
					$('#nama_obat').focus();
				}
            });

            $('#jumlah').on('input', function() {
                var jumlah = $('#jumlah').val();
                var harga = $('#harga').val();
                var val = jumlah * harga;
                $('#total').val( val );
            });
			
            $('#btn_simpan').click(function(){
                tambah_transaksi();
            });

            $('#reg1_form').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    validClass: 'valid',
                    highlight: function(element) {
                        $(element).closest('div').addClass("f_error");
                    },
                    unhighlight: function(element) {
                        $(element).closest('div').removeClass("f_error");
                    },
                    errorPlacement: function(error, element) {
                        $(element).closest('div').append(error);
                    },
                    rules: {
                        txt_nama: { required: true, minlength: 3 },
                        txt_no_telp: { required: true, minlength: 3 }
                    },
                    invalidHandler: function(form, validator) {
                        $.sticky("There are some errors. Please corect them and submit again.", {autoclose : 5000, position: "top-right", type: "st-error" });
                    },
            });

            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

            $('.edit-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

			$(function(){
				$( "#nama_obat_edit" ).autocomplete({
					source: "{{URL('gudang_masuk/getdata/'.$slug)}}",
					minLength: 3,
					select: function(event, ui) {
						//$('#jenis_obat_edit').focus();
						$('#jumlah_edit').focus();
						$('#jumlah_edit').val('');
						$('#total_edit').val('');
						$('#id_obat_edit').val(ui.item.kodobat);
						$('#nama_obat_edit').val(ui.item.id);
						$('#stok_edit').val(ui.item.stok);
						$('#harga_edit').val(ui.item.harga);
						
						var hargaobat = ui.item.harga;
						if (hargaobat == '0')
							$('#harga_edit').attr('disabled',false);
						
						//$('#komposisi_edit').val(ui.item.komposisi);
						//$('#masa_edit').val(ui.item.masa);
						$('#satuan_edit').val(ui.item.satuan);
						$('#harga_beli_edit').val(ui.item.hargabeli);
						
						//$("#jenis_obat_edit option[value='"+ui.item.kodegudang+"']").remove();
						//$("#jenis_obat_edit").prepend('<option value="'+ui.item.kodegudang+'" selected="selected">'+ui.item.namagudang+'</option>');
					}
				});
			}); 


/*           $('#jenis_obat_edit').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#komposisi_edit').focus();
                if(code == 32)
					$('#nama_obat_edit').focus();
            });

            $('#komposisi_edit').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#masa_edit').focus();
                if(code == 27 || code == 38)
					$('#jenis_obat_edit').focus();
            });

            $('#masa_edit').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#satuan_edit').focus();
                if(code == 27 || code == 38)
					$('#komposisi_edit').focus();
            });

            $('#satuan_edit').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#harga_beli_edit').focus();
                if(code == 27 || code == 38)
					$('#masa_edit').focus();
            });

            $('#harga_beli_edit').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#harga_edit').focus();
                if(code == 27 || code == 38)
					$('#satuan_edit').focus();
            });

            $('#harga_edit').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					$('#jumlah_edit').focus();
                if(code == 27 || code == 38)
					$('#harga_beli_edit').focus();
            });
*/
            $('#jumlah_edit').on('input', function() {
                var jumlah = $('#jumlah_edit').val();
                var harga = $('#harga_edit').val();
                var val = jumlah * harga;
                $('#total_edit').val( val );
            });

            $('#jumlah_edit').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13)
					simpan_edit();
                if(code == 27 || code == 38)
					//$('#harga_edit').focus();
					$('#nama_obat_edit').focus();
            });
			
            load_datatable();
        });

        function load_datatable(){
            oTable = $('#tbl_obat').dataTable({
                "sPaginationType": "full_numbers",
                "bProcessing": false,
                "sAjaxSource": "{{ url('gudang_obat/detaildatatable/'.$slug ) }}",
                "bServerSide": true,
                "aoColumnDefs" : [
                    {
                        "aTargets" : [ 6 ],
                        "sClass" : "align-right"
                    },
                    {
                        "aTargets" : [ 7 ],
                        "sClass" : "align-right"
                    }
                ]
                                
            });

            aTable = $('#tbl_obat_edit').dataTable({
                "sPaginationType": "full_numbers",
                "bProcessing": false,
                "sAjaxSource": "{{ url('gudang_obat/detaildatatable_edit/'.$slug ) }}",
                "bServerSide": true,
                "aoColumnDefs" : [
                    {
                        "aTargets" : [ 6 ],
                        "sClass" : "align-right"
                    },
                    {
                        "aTargets" : [ 7 ],
                        "sClass" : "align-right"
                    }
                ]
                                
            });
        }

        function cari_obat_edit(){
			$('#cari_obat_edit').modal('show');
		}

         function pilih_obat_edit(id,nama,jenis,namajenis,komposisi,satuan,masa,stok,harga,harga_beli){
 			//$('#jenis_obat_edit').focus();
			$('#jumlah_edit').focus();
			
			$('#jumlah_edit').val('');
			$('#total_edit').val('');
			$('#id_obat_edit').val(id);
			$('#nama_obat_edit').val(nama);
			$('#stok_edit').val(stok);
			$('#harga_edit').val(harga);

			var hargaobat = harga;
			if (hargaobat == '0')
				$('#harga_edit').attr('disabled',false);			
			
			//$('#komposisi_edit').val(komposisi);
			//$('#masa_edit').val(masa);
			$('#satuan_edit').val(satuan);
			$('#harga_beli_edit').val(harga_beli);
			
			//$("#jenis_obat_edit option[value='"+jenis+"']").remove();
			//$("#jenis_obat_edit").prepend('<option value="'+jenis+'" selected="selected">'+namajenis+'</option>');
			$('#cari_obat_edit').modal('hide');
        }

      	function pilih_obat(id,nama,jenis,namajenis,komposisi,satuan,masa,stok,harga,harga_beli){
 			//$('#jenis_obat').focus();
			$('#jumlah').focus();
			
            $('#id_obat').val(id);
            $('#nama_obat').val(nama);

			//$("#jenis_obat option[value='"+jenis+"']").remove();
			//$("#jenis_obat").prepend('<option value="'+jenis+'" selected="selected">'+namajenis+'</option>');
			
            //$('#komposisi').val(komposisi);
            $('#satuan').val(satuan);
            //$('#masa').val(masa);
            $('#stok').val(stok);
            $('#harga').val(harga);
			
			var hargaobat = harga;
			if (hargaobat == '0')
				$('#harga').attr('disabled',false);			
			
			$('#harga_beli').val(harga_beli);

            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            })
			
            $('#cari_obat').modal('hide');
			//$('#jenis_obat').focus();
        }

        function list_transaksi(){
            $('#load_list').show();
			var id_reg = $('#no_bukti').val();
            if(id_reg == '')
                id_reg = 'zxasqwopsds';

            $.ajax({
                url: "{{ url('gudang_keluar/list_transaksi/'.$slug) }}"+'/'+id_reg,
                dataType: "json",
                success: function(res){
                    $('#resep_list tbody').html('');
                    if(res == false){
						$('#load_list').hide();
                    }
                    else{
                        $.each(res, function (key, data) {
                                $('#resep_list tbody').append('<tr><td>'+data.kodobat+'</td>'+
                                        '<td>'+data.namaobat+'</td>'+
                                        '<td>'+data.satuan+'</td>'+
                                        '<td class="align-right">'+data.harga+'</td>'+
										'<td class="align-right">'+data.hargabeli+'</td>'+
                                        '<td class="align-right">'+(data.sisa + data.keluar)+'</td>'+
                                        '<td class="align-right">'+data.keluar+'</td>'+
                                        '<td class="align-right">'+data.sisa+'</td>'+
                                        '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.no+"',"+
											"'"+data.namaobat+"',"+
											"'"+data.kodobat+"',"+
											"'"+data.nobp+"'"+')">'+
											'<i class="splashy-error_x"></i></a>'+
											'&nbsp;&nbsp;<a href="javascript:void(0)" onclick="edit_transaksi('+"'"+data.no+"',"+
											"'"+data.namaobat+"',"+
											"'"+data.kodobat+"',"+
											"'"+data.kodegudang+"',"+
											"'"+data.namagudang+"',"+
											"'"+data.komposisi+"',"+
											"'"+data.masa+"',"+
											"'"+data.satuan+"',"+
											"'"+data.sisa+"',"+
											"'"+data.harga+"',"+
											"'"+data.hargabeli+"',"+
											"'"+data.keluar+"'"+')">'+
											'<i class="splashy-folder_modernist_edit"></i></a>'+
                                        '</td></tr>');
                            });
							$('#load_list').hide();
                    }
										
                },
                error:function(res){
                    alert('Connection failed');
                }
            });
            $('#tbl_obat').dataTable().fnReloadAjax();
        }

        function tambah_transaksi(){
            var id_obat = $('#id_obat').val();
            var jumlah = $('#jumlah').val();
            var harga = $('#harga').val();
            var stok = $('#stok').val();
			//var masa = $('#masa').val();
            var total = $('#total').val();
            var tanggal_bukti = $('#tanggal_bukti').val()
            var no_bukti = $('#no_bukti').val();
            var pelanggan = $('#pelanggan').val();
            var harga_beli = $('#harga_beli').val();
			var satuan = $('#satuan').val();
			//var komposisi = $('#komposisi').val();
			//var jenis_obat = $('#jenis_obat').val();
			var nama_obat = $('#nama_obat').val();
			
            if(no_bukti == ''){
                cetak_alert('Nomor Bukti tidak boleh kosong');
                $('#no_resep').focus();
            }
            else if(tanggal_bukti == ''){
                cetak_alert('Tanggal Bukti tidak boleh kosong');
                $('#tanggal_bukti').focus();
            }
            else if(pelanggan == '-'){
                cetak_alert('Harap pilih pelanggan');
                $('#pelanggan').focus();
            }
            else if(nama_obat == ''){
                cetak_alert('Nama Obat tidak boleh kosong');
                $('#nama_obat').focus();
            }
            else if(harga == '0'){
                cetak_alert('Harga Obat tidak boleh nol');
                $('#harga').focus();
            }
/*            else if(komposisi == ''){
                cetak_alert('Komposisi Obat tidak boleh kosong');
                $('#komposisi').focus();
            }
            else if(masa == ''){
                cetak_alert('Kadaluarsa Obat tidak boleh kosong');
                $('#masa').focus();
            }
            else if(satuan == ''){
                cetak_alert('Satuan Obat tidak boleh kosong');
                $('#satuan').focus();
            }
*/            else if(stok-jumlah < 0){
                cetak_alert('Stok obat tidak mencukupi untuk quantity sebanyak '+jumlah+', stok obat tersedia '+stok);
                $('#jumlah').focus();
            }
            else if(jumlah == '' || jumlah == '0'){
                cetak_alert('Jumlah barang tidak boleh kosong atau nol');
                $('#jumlah').focus();
            }
            else{
				$("#pesan_error").hide();
				$('#load_list').show();
                $.ajax({
                    url: "{{ url('gudang_keluar/check_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "no_bukti="+no_bukti+"&id_obat="+id_obat+"&jumlah="+jumlah+"&tanggal_bukti="+tanggal_bukti+"&pelanggan="+pelanggan,
                    success:function(resa){
                        if(resa == 'ada'){
                            var r = confirm("Transaksi obat dengan jumlah yang sama sudah ada,  apakah anda ingin tetap meneruskan?");
                            if (r == true) {
                                $.ajax({
                                    url: "{{ url('gudang_keluar/tambah_transaksi/'.$slug) }}",
                                    type: "POST",
                                    data : "id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&stok="+stok+"&total="+total+
                                            "&tanggal_bukti="+tanggal_bukti+"&no_bukti="+no_bukti+"&pelanggan="+pelanggan+"&harga_beli="+harga_beli+
											"&satuan="+satuan+"&nama_obat="+nama_obat,
//                                    data : "id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&stok="+stok+"&masa="+masa+"&total="+total+
//                                           "&tanggal_bukti="+tanggal_bukti+"&no_bukti="+no_bukti+"&pelanggan="+pelanggan+"&harga_beli="+harga_beli+
//											"&satuan="+satuan+"&komposisi="+komposisi+"&jenis_obat="+jenis_obat+"&nama_obat="+nama_obat,
                                    success:function(res){
                                        if(res == 'sukses'){
                                            cetak_alert('Data berhasil ditambahkan');
											setTimeout(function(){$("#pesan_error").hide()}, 4000);
											$('#load_list').hide();
                                            kosongkan();
                                        }
                                        else{
                                            cetak_alert(res);
                                        }
                                        list_transaksi();
                                        $('#nama_obat').focus();
                                    }
                                });
								
                            }
                            else{
								
                            }
                        }
                        else{
                            $.ajax({
                                url: "{{ url('gudang_keluar/tambah_transaksi/'.$slug) }}",
                                type: "POST",
                                data : "id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&stok="+stok+"&total="+total+
                                       "&tanggal_bukti="+tanggal_bukti+"&no_bukti="+no_bukti+"&pelanggan="+pelanggan+"&harga_beli="+harga_beli+
									   "&satuan="+satuan+"&nama_obat="+nama_obat,
                                success:function(res){
                                    if(res == 'sukses'){
                                        cetak_alert('Data berhasil ditambahkan');
										$('#load_list').hide();
                                        kosongkan();
                                    }
                                    else{
                                        cetak_alert(res);
                                    }
                                    list_transaksi();
                                    $('#nama_obat').focus();
                                }
                            });							
                        }
                    }
                });
                
            }
        }

        function edit_transaksi(no,namaobat,kodobat,kodegudang,namagudang,komposisi,masa,satuan,sisa,harga,hargabeli,keluar){ 			
			$('#trx_baru').hide();
			$('#trx_edit').show();
			$('#jumlah_edit').focus();
			
			$('#no_trx').val(no);
			$('#id_obat_edit').val(kodobat);
			$('#id_obat_edit_asli').val(kodobat);
			
			$('#nama_obat_edit').val(namaobat);
			$('#harga_edit').val(harga);
			
			var hargaobat = harga;
			if (hargaobat == '0')
				$('#harga_edit').attr('disabled',false);			
			
			$('#stok_edit').val(parseInt(sisa)+parseInt(keluar));
			//$('#masa_edit').val(masa);
			//$('#komposisi_edit').val(komposisi);
			$('#jumlah_edit').val(keluar);
			$('#jumlah_edit_asli').val(keluar);
			
			$('#total_edit').val(keluar*harga);
			
			$('#harga_beli_edit').val(hargabeli);
			$('#satuan_edit').val(satuan);

			//$("#jenis_obat_edit option[value='"+kodegudang+"']").remove();
			//$("#jenis_obat_edit").prepend('<option value="'+kodegudang+'" selected="selected">'+namagudang+'</option>');
		}

		function batal_edit(){
			$('#trx_baru').show();
			$('#trx_edit').hide();

			kosongkan();
		}

		function kosongkan(){
			$('#kode_obat').val('');
			$('#nama_obat').val('');
			$('#harga').val('');
			$('#total').val('');
			$('#stok_awal').val('');
			//$('#masa').val('');
			//$('#komposisi').val('');
			$('#jumlah').val('');
			//$('#jenis_obat').val('');
			$('#harga_beli').val('');
			$('#satuan').val('');
		}

        function simpan_edit(){
			var no_trx = $('#no_trx').val();
			var id_obat_edit = $('#id_obat_edit').val();
			var id_obat_edit_asli = $('#id_obat_edit_asli').val();
			var nama_obat_edit = $('#nama_obat_edit').val();
			var jumlah_edit = $('#jumlah_edit').val();
			var jumlah_edit_asli = $('#jumlah_edit_asli').val();
			var harga_edit = $('#harga_edit').val();
			var stok_edit = $('#stok_edit').val();
			//var masa_edit = $('#masa_edit').val();
			//var komposisi_edit = $('#komposisi_edit').val();
			var total_edit = $('#total_edit').val();
			var harga_beli_edit = $('#harga_beli_edit').val();
			var satuan_edit = $('#satuan_edit').val();
			//var jenis_obat_edit = $('#jenis_obat_edit').val();
			
			if(nama_obat_edit == ''){
				cetak_alert('Nama Obat tidak boleh kosong');
				$('#nama_obat_baru').focus();
			}			
/*            else if(komposisi_edit == ''){
                cetak_alert('Komposisi Obat tidak boleh kosong');
				$('#komposisi_edit').focus();
            }
            else if(masa_edit == ''){
                cetak_alert('Kadaluarsa Obat tidak boleh kosong');
                $('#masa_edit').focus();
            }
*/            else if(satuan_edit == ''){
                cetak_alert('Satuan Obat tidak boleh kosong');
                $('#satuan_edit').focus();
            }
            else if(harga_edit == '' || harga_edit == '0'){
                cetak_alert('Harga Jual Obat tidak boleh kosong atau nol');
                $('#harga_edit').focus();
            }
            else if(harga_beli_edit == ''){
                cetak_alert('Harga Beli Obat tidak boleh kosong');
                $('#harga_beli_edit').focus();
            }
            else if(stok_edit-jumlah_edit < 0){
                cetak_alert('Stok obat tidak mencukupi untuk quantity sebanyak '+jumlah_edit+', stok obat tersedia '+stok_edit);
                $('#jumlah_edit').focus();
            }
			else if(jumlah_edit == '' || jumlah_edit == '0'){
				cetak_alert('Jumlah barang tidak boleh kosong atau nol');
                $('#jumlah_edit').focus();
            }
            else{
                $("#pesan_error").hide();
				$.ajax({
                     url: "{{ url('gudang_keluar/edit_transaksi/'.$slug) }}",
                     type: "POST",
					 data : "no_trx="+no_trx+"&id_obat_edit="+id_obat_edit+"&jumlah_edit="+jumlah_edit+"&harga_edit="+harga_edit+
							"&stok_edit="+stok_edit+"&jumlah_edit_asli="+jumlah_edit_asli+
							"&total_edit="+total_edit+"&harga_beli_edit="+harga_beli_edit+"&satuan_edit="+satuan_edit+
							"&id_obat_edit_asli="+id_obat_edit_asli+"&nama_obat_edit="+nama_obat_edit,
//					 data : "no_trx="+no_trx+"&id_obat_edit="+id_obat_edit+"&jumlah_edit="+jumlah_edit+"&harga_edit="+harga_edit+
//							"&stok_edit="+stok_edit+"&masa_edit="+masa_edit+"&komposisi_edit="+komposisi_edit+"&jumlah_edit_asli="+jumlah_edit_asli+
//							"&total_edit="+total_edit+"&harga_beli_edit="+harga_beli_edit+"&satuan_edit="+satuan_edit+
//							"&id_obat_edit_asli="+id_obat_edit_asli+"&jenis_obat_edit="+jenis_obat_edit+"&nama_obat_edit="+nama_obat_edit,
                     success:function(res){
                          if(res == 'sukses'){
							   cetak_alert('Data berhasil diperbaharui');
							   setTimeout(function(){$("#pesan_error").hide()}, 4000)
                          }
                          else{ 
							   cetak_alert(res);
							   setTimeout(function(){$("#pesan_error").hide()}, 4000)
                          }
                          list_transaksi();
						  $('#trx_baru').show();
						  $('#trx_edit').hide();

						  $('#nama_obat').focus();
                     }
                 });
           }
        }

        function hapus_transaksi(no,nama,kodobat,nobp){
            var r = confirm('Hapus transaksi?\nKode Obat : '+kodobat+'\nNama Obat : '+nama);
            if (r == true) {
                $.ajax({
                    url: "{{ url('gudang_keluar/hapus_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "no="+no+"&nobp="+nobp,
                    success:function(res){
                        if(res=='sukses'){
							cetak_alert('Data berhasil dihapus');
							list_transaksi();
						}
                    }
                });
            }
        }

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }


    </script>
@stop