@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}

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
                            Penerimaan Barang
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Penerimaan Barang
                        <div style="float:right;" class="">
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
                <div class="span12">
                    
                </div>
                {{ Form::open(array('url' => url('gudang_penerimaan/belum/'.$id_pemesanan) , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid formSep">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">No Surat Pemesanan<span class="f_req">*</span></label>
                                <div class="controls">
                                    {{ $data->no_pemesanan }}
                                </div>
                            </div>           
                            <div class="control-group">
                                <label class="control-label">Tanggal Pemesanan<span class="f_req">*</span></label>
                                <div class="controls">
                                    {{ $data->tanggal_pemesanan }}
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Supplier<span class="f_req">*</span></label>
                                <div class="controls">
                                    {{ $data->namasupp }}
                                </div>
                            </div>        
                            <div class="control-group">
                                <label class="control-label">Tanggal Terima<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" name="tanggal_terima" id="tanggal_terima" class="nowdate span10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div id="pesan_error2" class="alert alert-info">
                            </div>
                        </div>
                    </div>


                    <div class="row-fluid formsep">
                        <div class="span12">
                            <div class="">
                                <input type="hidden" id="tipe" name="tipe" value="tambah">
                                <input type="hidden" id="id_pemesanan" name="id_pemesanan" value="<?php echo $id_pemesanan; ?>">
                                <input type="hidden" id="id_transaksi" name="id_transaksi" value="0">
                            </div>
                        </div>
                    </div>            
                    
                    <div class="row-fluid formsep">
                        <div class="span12">
                        <table id="resep_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Jumlah Pesan</th>
                                    <th>Sisa Kekurangan</th>
                                    <th>Jumlah Datang Sekarang</th>
                                    <th align="center">x</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </div>        
                    <div class="row-fluid formsep">
                        <div class="span12">
                            <div class="">
                                <button id="btn_simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Proses Terima Barang</button>
                            </div>
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
                            oTable = $('#tbl_obat').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('gudang_obat/detaildatatable') }}",
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

        $(document).ready(function() {
        	

            $('.no-primary').each(function(){
                $(this).attr('readonly','true');
            });

            $('.edit-primary').each(function(){
                $(this).attr('readonly','true');
            });

            $('#pesan_error2').hide();


            $('#btn_simpan').click(function(){
                var _pesan = "";
                $('.detail-masuk').each(function(){
                    var _id = $(this).attr('data-id');

                    var val1    = $(this).val();
                    var val2    = $('#sisa_'+_id).val();

                    if( val1 > val2 ){
                        _pesan = "Data yang dimasukkan melebihi sisa yang diizinkan <br />";
                        $(this).focus();
                    }
                });

                if(_pesan == ""){
                    $('#reg1_form').submit();
                }
                else{
                    cetak_alert(_pesan);
                }
                
            });

            setInterval(function () {$('#pesan_error').hide();}, 5000);
        });
        function list_transaksi(){
            var id_pemesanan = $('#id_pemesanan').val();
            cetak_alert2('Mohon tunggu');
            if(id_pemesanan != ''){
                $.ajax({
                    url: "{{ url('gudang_pemesanan/list_transaksi/') }}",
                    dataType: "json",
                    type: "POST",
                    data : "id_pemesanan="+id_pemesanan,
                    success: function(res){
                        $('#resep_list tbody').html('');
                        if(res == false){

                        }
                        else{
                            $.each(res, function (key, data) {
                                var _disabled = "";
                                if(data.sisa == 0){
                                    _disabled = 'disabled="disabled"';
                                }

                                $('#resep_list tbody').append('<tr>'+
                                        '<td>'+data.namaobat+'</td>'+
                                        '<td>'+data.satuan_beli+'</td>'+
                                        '<td class="align-right">'+data.jumlah+'</td>'+
                                        '<td class="align-right">'+data.sisa+'</td>'+
                                        '<td class="align-right">'+
                                        '<input type="hidden" id="sisa_'+data.id_detail+'" name="sisa['+data.id_detail+']" value="'+data.sisa+'" />'+
                                        '<input type="text" data-id="'+data.id_detail+'" style="max-width:100px;" '+_disabled+' name="masuk['+data.id_detail+']" class="detail-masuk" />'+
                                        '</td><td></td></tr>');
                            });

                        }
                        $('#pesan_error2').hide();

                    },
                    error:function(res){
                        alert('Connection failed');
                    }
                });
                $('#tbl_obat').dataTable().fnReloadAjax();
                //$('#btn_cari_obat').focus();
                $('#btn_tambah').attr('readonly','true');
                tambah_baru();
                
            }
            
        }


        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }

        function cetak_alert2(str){
            $('#pesan_error2').show();
            $('#pesan_error2').html( '<img src="{{ url('img/load_gif.gif') }}" />' + str);
        }

        function getData(id){
            $.ajax({
                url: "{{ url('gudang_pemesanan/detail') }}",
                type: "POST",
                data : "id="+id,
                success:function(res){
                    res     = $.parseJSON(res);
                    $('#no_surat').val(res.no_pemesanan);
                    var _masa = res.tanggal_pemesanan.split('-');
                    $('#tanggal_pemesanan').val(_masa[2]+'/'+_masa[1]+'/'+_masa[0]);
                    $('#kode_supplier').val(res.kodesupp);
                    $('#nama_supplier').val(res.namasupp);
                    list_transaksi();
                }
            });
            $('#id_pemesanan').val(id);
        }


        @if($id_pemesanan != 0)
            getData('{{ $id_pemesanan }}');
        @endif

    </script>
@stop