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
                            Daftar Supplier Obat {{ $obat->namaobat }}
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Daftar Supplier Obat {{ $obat->namaobat }}
                        
                    </h3>
                    <div id="pesan_error" class="alert alert-error" style="display:none;">
                        
                    </div>
	        	</div>
                
                    <h4 align="center">Data Obat</h4>
                        {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Kode Obat</label>
                                        <div class="controls">
                                            <input disabled="disabled" value="{{ $obat->kodobat }}" type="text" id="kode_obat" name="kode_obat" class="no-primary span10">
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label">Nama Obat</label>
                                        <div class="controls">
                                            <input disabled="disabled" value="{{ $obat->namaobat }}" type="text" id="nama_obat" name="nama_obat" class="no-primary span10">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Komposisi</label>
                                        <div class="controls">
                                            <input disabled="disabled" value="{{ $obat->komposisi }}" type="text" id="komposisi" name="komposisi" class="no-primary span10">
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Satuan</label>
                                        <div class="controls">
                                            <input disabled="disabled" value="{{ $obat->satuan }}" type="text" id="satuan" name="satuan" class="span10 no-primary">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Stok</label>
                                        <div class="controls">
                                            <input disabled="disabled" value="{{ $obat->stok }}" type="text" id="stok" name="stok" class="span3 no-primary" style="text-align: right">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Kadaluarsa</label>
                                        <div class="controls">
                                            <?php
                                                $masas  = explode('-',$obat->masa);
                                                $masa   = $masas[2].'/'.$masas[1].'/'.$masas[0];
                                            ?>
                                            <input disabled="disabled" value="{{ $masa }}" type="text" id="masa" name="masa" class="span8">
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                    {{ Form::close() }}
                    
                    <h4 class="heading" align="">Daftar Supplier</h4>
                    <div class="">
                        <div>
                            <button type="button" id="btn_tindakan_pilih" data-toggle="modal" data-target="#cari_supplier" class="btn btn-success extra-fields">Tambah Supplier</button>
                        </div> <br />
                        <table id="supplier_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th align="center">x</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                
	   	    </div>
        <div class="modal hide fade modal-admin" id="cari_supplier" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Supplier</h4>
                    </div>
                    <div class="modal-body">
                        <table id="tbl_supplier" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">Nama Supplier</th>
                                    <th align="center" valign="middle" class="head2">Alamat</th>
                                    <th align="center" valign="middle" class="head3">No Telp</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_supplier').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('gudang_obat/simpletable_supplier') }}",
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
</div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        jQuery(document).ready(function($){
            list_supplier();
        })
    	function tambah_supplier(_id){
            var _kodobat = $('#kode_obat').val();
            $.ajax({
                url: "{{ url('gudang_obat/tambah_supplier') }}",
                type: "POST",
                data : "kodobat="+_kodobat+"&supplier="+_id,
                success:function(res){
                    list_supplier();
                }
            });
        }

        function list_supplier(){
            var val = $('#kode_obat').val();
            $.ajax({
                url: "{{ url('gudang_obat/list_supplier') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#supplier_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#supplier_list tbody').append('<tr><td>'+data.namasupp+'</td><td>'+data.alamat+'</td><td>'+data.notelp+'</td>'+
                                '<td><a href="javascript:void(0)" onclick="hapus_supplier('+"'"+data.kodesupp+"'"+','+"'"+data.kodobat+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td></tr>');
                        });
                    }
                }
            });
        }

        function hapus_supplier(kodesupp,kodobat){
            var r = confirm("Apakah anda ingin menghapus kode supplier "+kodesupp);
            if (r == true) {
                $.ajax({
                    url: "{{ url('gudang_obat/hapus_supplier') }}",
                    type: "POST",
                    data : "kodesupp="+kodesupp+"&kodobat="+kodobat,
                    success:function(res){
                        list_supplier();
                    }
                });
            }
        }

    </script>
@stop