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
                            <a href="{{ action('SepController@index') }}">Peserta</a>
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
							<col class="con8" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">No Kartu Peserta</th>
                                <th align="center" valign="middle" class="head2">Nama Peserta</th>
                                <th align="center" valign="middle" class="head3">Komposisi</th>
                                <th align="center" valign="middle" class="head4">Satuan</th>
                                <th align="center" valign="middle" class="head5">Jenis Obat</th>
                                <th align="center" valign="middle" class="head6">Stok</th>
                                <th align="center" valign="middle" class="head7">Harga</th>
								<th align="center" valign="middle" class="head7">Actions</th>
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
                                "sAjaxSource": "{{ url('apotek_obat/datatable/'.$slug) }}",
                                "bServerSide": true,
                                "aoColumnDefs" : [
                                    {
                                        "aTargets" : [ 5 ],
                                        "sClass" : "align-right"
                                    },
                                    {
                                        "aTargets" : [ 6 ],
                                        "sClass" : "align-right"
                                    },
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
    <div class="modal hide fade" id="hapus_data" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pasienLabel">Hapus <span class="hapus-title"></span></h4>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data <span class="hapus-title"></span></p>
                    <p>
                        <a href="javascript:void(0)" onclick="action_hapus_data(0,'0')" class="btn btn-primary">Ya</a>
                        <a href="javascript:void(0)" onclick="hide_modal('hapus_data')" class="btn btn-warning">Tidak</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{ Form::open(array('url' => 'askes_obat/', 'id' => 'delete_form', 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        <input type="hidden" id="url_delete" value="{{ url('askes_obat') }}">
        <input type="submit" style="display:none">
    {{ Form::close() }}

    <div class="modal hide fade modal-admin" id="edit_data" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pasienLabel">Edit Data Obat</h4>
                </div>
                <div class="modal-body">
					 <div id="pesan_error" class="alert alert-error" style="display:none; font-weight:bold;">
					 </div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Kode Obat Gudang</label>
                                <div class="controls">
                                    <input type="text" id="id_obat_gudang" name="id_obat_gudang" class="span12 no-primary">
									<input type="text" id="id_obat_gudang_old" name="id_obat_gudang_old" class="span12 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kode Obat</label>
                                <div class="controls">
                                    <input type="text" id="id_obat" name="id_obat" class="span12 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Obat</label>
                                <div class="controls">
                                    <input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Komposisi</label>
                                <div class="controls">
                                    <input type="text" id="komposisi" name="komposisi" class="span12 no-primary" />
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Satuan</label>
                                <div class="controls">
                                    <input type="text" id="satuan" name="satuan" class="span12 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Obat<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="jenis_obat" id="jenis_obat" class="span12 no-primary">
                                         @foreach($jenis_obat as $j=>$k)
                                             <option value="{{ $k->kodejenis }}">{{ $k->namajenis }}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kadaluarsa</label>
                                <div class="controls">
                                    <input type="text" id="masa" name="masa" class="span12 no-primary" />
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Stok</label>
                                <div class="controls">
                                    <input type="text" id="stok" name="stok" class="span10 no-primary" style="text-align: right">
                                </div>
                            </div>  
                            <div class="control-group">
                                <label class="control-label">Harga Jual</label>
                                <div class="controls">
                                    <input type="text" id="harga" name="harga" class="span10 no-primary" style="text-align: right">
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
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
        var temp_id = "";
		var oTable;
        $(document).ready(function(){
            $('.datatable-id').each(function(){
                //$(this).attr('data-provi9uhug ides' , 'rowlink');
            })
            $('#simpan').click(function(){
                ubah_data();
            });
			$('#btn_reset').click(function() {
				 hide_modal('edit_data');
			});
        });

        function edit_data(id_obat,id_obat_gudang,nama_obat,kode_obat,jenis_obat,komposisi,satuan,masa,harga,stok){
            $('#edit_data').modal('show');
            $("#edit_data").draggable();
			$("#pesan_error").hide();
			$('#id_obat').val(id_obat);
			$('#id_obat').attr('disabled',true);
            $('#nama_obat').val(nama_obat);
			$('#jenis_obat').prepend('<option value="'+kode_obat+'" selected="selected">'+jenis_obat+'</option>');
			$('#komposisi').val(komposisi);
            $('#satuan').val(satuan);
			$('#masa').val(masa);
            $('#harga').val(harga);
            $('#stok').val(stok);
			$('#stok').attr('disabled',true);
			$('#id_obat_gudang').val(id_obat_gudang);
			$('#id_obat_gudang_old').val(id_obat_gudang);
        }

        function ubah_data(){
            var id_obat = $('#id_obat').val();
            var harga = $('#harga').val();
            var harga_beli = $('#harga_beli').val();
            var nama_obat = $('#nama_obat').val();
			var masa = $('#masa').val();
			var satuan = $('#satuan').val();
			var komposisi = $('#komposisi').val();
			var jenis_obat = $('#jenis_obat').val();
			var id_obat_gudang = $('#id_obat_gudang').val();
			var id_obat_gudang_old = $('#id_obat_gudang_old').val();
			
			if(id_obat_gudang_old == ''){
                $.ajax({
                    url: "{{ url('apotek_obat/check_id/'.$slug) }}",
                    type: "POST",
                    data : "id_obat_gudang="+id_obat_gudang,
                    success:function(resa){
                        if(resa != 'kosong'){
							hide_modal('edit_data');
                            cetak_alert2(resa);
							//$('#tbl_obat').dataTable().fnReloadAjax();
                        }
                    }
                });
			}
			
							$.ajax({
								 url: "{{ url('apotek_obat/editdatatable/'.$slug) }}",
								 type: "POST",
								 data : "&id_obat="+id_obat+"&harga="+harga+"&nama_obat="+nama_obat+"&id_obat_gudang="+id_obat_gudang+
										"&masa="+masa+"&satuan="+satuan+"&komposisi="+komposisi+"&jenis_obat="+jenis_obat,
								 success:function(res){
									  if(res == 'sukses'){
										  $('#tbl_obat').dataTable().fnReloadAjax();
										  hide_modal('edit_data');
										  cetak_alert2('Data berhasil diupdate');
										  setTimeout(function(){$("#pesan_error2").hide()}, 4000)
									  }
									  else{
										  cetak_alert(res);
									  }
								 }
							});
			
        }

        function hapus_data(id,param){
            temp_id = id;
            $('.hapus-title').html(param+' dengan ID '+id);
            $('#hapus_data').modal('show');
        }

        function action_hapus_data(){
            $('#hapus_data').modal('hide');
            var url = $('#url_delete').val()+'/'+temp_id;
            $('#delete_form').attr( 'action' , url );
            $('#delete_form').submit();
            temp_id = "";
        }

        function hide_modal(name){
            $('#'+name).modal('hide');
        }
		
        function cetak_alert2(str){
            $('#pesan_error2').show();
            $('#pesan_error2').html(str);
        }

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }
    </script>
@stop