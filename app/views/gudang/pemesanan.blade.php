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
                            Surat Pemesanan / Purchase Order
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Surat Pemesanan / Purchase Order
                        <div style="float:right;" class="">
                            <a href="{{ URL::to($slug.'/create') }}" class="btn btn-success btn-top" id="btn_new"><i class="splashy-contact_grey_add"></i> Input Baru {{ $title }}</a>
                            <a href="{{ URL::to($slug) }}" class="btn btn-primary btn-top" id="btn_list"><i class="splashy-view_outline_detail"></i> Daftar {{ $title }}</a>
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
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid formSep">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">No Surat Pemesanan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="no_surat" name="no_surat" class="span10">
                                </div>
                            </div>           
                            <div class="control-group">
                                <label class="control-label">Tanggal Pemesanan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" name="tanggal_pemesanan" id="tanggal_pemesanan" class="nowdate span10">
                                </div>
                            </div>

                            <div class="control-group" style="display:none;">
                                <label class="control-label">Kode Supplier<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="nama_supplier" name="nama_supplier" class="span10 edit-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Supplier<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="kode_supplier" id="kode_supplier">
                                        <option value="-">-</option>
                                        @foreach($supplier as $s)
                                            <option value="{{ $s->kodesupp }}">{{ $s->namasupp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div class="control-group">
                                <div class="controls">
                                <button type="button" id="btn_cari_obat" class="btn btn-warning" data-toggle="modal" data-target="#cari_obat"><i class="splashy-zoom"></i> Cari Obat</button>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Kode Barang</label>
                                        <div class="controls">
                                            <input type="text" id="kode_obat" name="kode_obat" class="no-primary">
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label">Nama Barang</label>
                                        <div class="controls">
                                            <input type="text" id="nama_obat" name="nama_obat" class="no-primary">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Satuan Jual</label>
                                        <div class="controls">
                                            <input type="text" id="satuan" name="satuan" class="span10 no-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Satuan Beli</label>
                                        <div class="controls">
                                            <select name="satuan_beli" id="satuan_beli" class="">
                                            <?php $satuans  = DB::table('apo_satuan')->get(); ?>
                                            @foreach($satuans as $s)
                                                <option value="{{ $s->id }}">{{ $s->NamaSatuan }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Jumlah Pemesanan<span class="f_req">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="jumlah" name="jumlah" class="span3" style="text-align: right">
                                        </div>
                                    </div>
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
                                <button id="btn_simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Proses</button>
                                <button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
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
                                    <th>Jumlah</th>
                                    <th align="center">x</th>
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
/*
            $('#jumlah').on('input', function() {
                var jumlah = $('#jumlah').val();
                var harga = $('#harga').val();
                var val = jumlah * harga;
                $('#total').val( val );
            });
*/

            $('#kode_supplier').change(function(){
                $('#nama_supplier').val( $('#kode_supplier :selected').text() )
            });

            $('#btn_simpan').click(function(){
                tambah_transaksi();
            });

            $('#no_bukti').focusout(function() {
            });

            $('#tanggal_masuk').focusout(function() {
                list_transaksi();
            });

            $('#tanggal_masuk').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#jenis_pembayaran').focus();
                    list_transaksi();
                }  
            });

            $('#nama_supplier').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#cari_obat').modal('show');
                }  
            });

            $('#nama_obat').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#jenis_obat').focus();
                }  
            });

            $('#jenis_obat').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#komposisi').focus();
                }  
            });

            $('#komposisi').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#satuan').focus();
                }  
            });

            $('#jumlah').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    tambah_transaksi();
                }  
            });


            $('#btn_input_baru').click(function(){
                input_baru();
                $('#nama_obat').focus();
            });

            $('#no_surat').focus();

            $('#cari_obat').on('shown', function () {
                $("#tbl_obat_filter input").focus();
            });

            setInterval(function () {$('#pesan_error').hide();}, 5000);
        });

        function input_baru(){
            $('.no-primary').each(function(){
                $(this).attr('readonly',false);
            });

            $('#kode_obat').val('NEW');
            $('#kode_obat').attr('readonly','true');

            $('#stok_awal').val('0');
			
			$('#total').val('');
			$('#total').attr('readonly','true');
			
            $('#nama_obat').val('');
			$('#jenis_obat').val('');
            $('#harga').val('');
			//$('#harga_beli').attr('readonly','true');
			$('#harga_beli').val('');
			$('#satuan').val('');
			$('#komposisi').val('');
            $('#masa').val('');
            $('#jumlah').val('');

            
        }

        function tambah_baru(){
            $('.no-primary').each(function(){
                $(this).attr('readonly','true');
            });

            $('#kode_obat').val('');
            $('#kode_obat').attr('readonly','true');

            $('#stok_awal').val('0');
            $('#stok_awal').attr('readonly','true');

            $('#nama_obat').val('');
            $('#jenis_obat').val('');
            $('#satuan').val('');
            $('#komposisi').val('');
            $('#masa').val('');
            $('#jumlah').val('');

            $('#id_transaksi').val('0');
            $('#tipe').val('tambah');

            $('#btn_simpan').val('Proses');
            $("btn_cari_obat").focus();
        }

        function pilih_obat(id,nama,jenis,komposisi,satuan,masa,stok,harga,harga_beli){
            $('#kode_obat').val(id);
            $('#nama_obat').val(nama);
            $('#satuan').val(satuan);
            $('#stok_awal').val(stok);
			
            $('.no-primary').each(function(){
                $(this).attr('readonly','true');
            })

            $('#cari_obat').modal('hide');
            $('#jumlah').attr('readonly',false);

            $('#jumlah').focus();
            $('#id_transaksi').val('0');
            $('#tipe').val('tambah');
        }

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
                                $('#resep_list tbody').append('<tr>'+
                                        '<td>'+data.namaobat+'</td>'+
                                        '<td>'+data.satuan_beli+'</td>'+
                                        '<td class="align-right">'+data.jumlah+'</td>'+
                                        '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.id_detail+"'"+')">'+
                                        '<i class="splashy-error_x"></i></a>'+
                                        '</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="edit_transaksi('+
                                        "'"+data.id_detail+"',"+
                                        "'"+data.kodobat+"',"+
                                        "'"+data.namaobat+"',"+
                                        "'"+data.satuan+"',"+
                                        "'"+data.id_satuan_beli+"',"+
                                        "'"+data.jumlah+"'"+')">'+
                                        '<i class="splashy-folder_modernist_edit"></i>'+
                                        '</td></tr>');
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

        function tambah_transaksi(){
            var id_pemesanan = $('#id_pemesanan').val();
            cetak_alert('Mohon tunggu');
            var no_surat            = $('#no_surat').val();
            var tanggal_pemesanan   = $('#tanggal_pemesanan').val();
            var nama_supplier       = $('#nama_supplier').val();
            var jumlah              = $('#jumlah').val();
            var kode_obat           = $('#kode_obat').val();
            if( no_surat == '' ){
                $('#no_surat').focus();
                cetak_alert('Mohon isi nomor surat pemesanan');
            }
            else if( tanggal_pemesanan == '' ){
                $('#tanggal_pemesanan').focus();
                cetak_alert('Masukkan tanggal pemesanan');
            }
            else if( nama_supplier == '-' ){
                $('#nama_supplier').focus();
                cetak_alert('Pilih supplier');
            }
            else if( (jumlah == '' || jumlah == '0') && ( kode_obat != '' ) ){
                $('#jumlah').focus();
                cetak_alert('Masukkan jumlah pemesanan');
            }
            else{
                $.ajax({
                    url: "{{ url('gudang_pemesanan/tambah_transaksi/') }}",
                    type: "POST",
                    data : $('#reg1_form').serialize(),
                    success:function(res){
                        res = $.parseJSON(res);
                        if(res.pesan == 'sukses'){
                            if(tipe=='edit')
                                cetak_alert('Data berhasil diupdate');
                            else
                                cetak_alert('Data berhasil ditambahkan');
                            $('#kode_obat').val('');
                            $('#nama_obat').val('');
                            $('#jenis_obat').val('');
                            $('#satuan').val('');
                            $('#komposisi').val('');
                            $('#stok_awal').val('');
                            $('#jumlah').val('');
                            $('#tipe').val('tambah');
                            $('#id_transaksi').val('0');

                            if( id_pemesanan == 0 ){
                                $('#id_pemesanan').val(res.id_pemesanan)
                            }

                        }
                        else{
                            alert(res.pesan);
                        }
                        list_transaksi();
                        $('#btn_cari_obat').focus();
                    }

                    
                });
            }
        }

        function edit_transaksi(id_detail,kodobat,namaobat,satuan,id_satuan_beli,jumlah){
            $('#id_transaksi').val(id_detail);
            $('#kode_obat').val(kodobat);
            $('#nama_obat').val(namaobat);
            $('#satuan').val(satuan);
            $('#satuan_beli').val(id_satuan_beli);
            $('#jumlah').val(jumlah);

            $('#jumlah').focus();

            $('#btn_simpan').val('Update');
            $('#btn_tambah').attr('readonly',false);
        }

        function hapus_transaksi(id_transaksi){
            var r = confirm('Hapus transaksi ?');
            if (r == true) {
                cetak_alert2('Mohon tunggu');
                $('#pesan_error').hide();
                $.ajax({
                    url: "{{ url('gudang_pemesanan/hapus_transaksi/') }}",
                    type: "POST",
                    data : "id_transaksi="+id_transaksi,
                    success:function(res){
                        cetak_alert('Data berhasil dihapus');
                        $('#pesan_error2').hide();
                        setTimeout(function(){$("#pesan_error").hide()}, 4000)
                        list_transaksi();
                    }
                });
                $('#btn_cari_obat').focus();
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