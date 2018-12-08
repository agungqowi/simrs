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
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
					<input type="hidden" id="masa" name="masa" value="" />
					<input type="hidden" id="komposisi" name="komposisi" value="" />
				 	<input type="hidden" id="jenis_obat" name="jenis_obat" value="" />
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No Bukti<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="no_bukti" name="no_bukti" class="span6">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="tanggal_bukti" name="tanggal_bukti" class="nowdate span6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span10">         
                            <div class="control-group">
                                <label class="control-label">Pelanggan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="pelanggan" id="pelanggan" class="span3">
                                    <option value="">-</option>
                                        @foreach($pelanggan as $p)
                                            <option value="{{ $p->kodeplg }}">{{ $p->namaplg }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid" id="obat_baru">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Kode Obat</label>
                                <div class="controls">
                                    <input type="text" id="id_obat" name="id_obat" class="span7 no-primary">
                                    <button class="btn btn-warning" id="btn_obat" type="button" data-toggle="modal" data-target="#cari_obat"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Obat</label>
                                <div class="controls">
                                    <input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Satuan</label>
                                <div class="controls">
                                    <input type="text" id="satuan" name="satuan" class="span12 no-primary">
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
                            <div class="control-group">
                                <label class="control-label">Harga Beli</label>
                                <div class="controls">
                                    <input type="text" id="harga_beli" name="harga_beli" class="span10 no-primary" style="text-align: right">
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
                    <div class="row-fluid" id="obat_edit" style="display:none">
                        <div class="span12">
                                <input type="hidden" name="no_bukti_edit" id="no_bukti_edit" />
                                <input type="hidden" name="IdObat_edit_asli" id="IdObat_edit_asli" />
                                
                                <input type="hidden" name="id_bukti" id="id_bukti" />
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
                    <div class="row-fluid formsep">
                        <div class="span12">
                            <div class="">
                                <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                <button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
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
                                    <th>Id Obat</th>
                                    <th>Pelanggan</th>
                                    <th>Nama Obat</th>
                                    <th>Satuan</th>
                                    <th>Harga Jual</th>
									<th>Harga Beli</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Stok Akhir</th>
                                    <th>x</th>
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
@stop

@section('js')
    @parent
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        var oTable;
        $(document).ready(function() {
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

            $('#jumlah').on('input', function() {
                var jumlah = $('#jumlah').val();
                var harga = $('#harga').val();
                var val = jumlah * harga;
                $('#total').val( val );
            });

            $('#jumlah').keypress(function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#no_resep').val() != '' ){
                        tambah_transaksi();
                    }
                } 
            })

            $('#simpan').click(function(){
                tambah_transaksi();
            });

            $('#no_bukti').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#no_bukti').val() != '' ){
                        $('#tanggal_bukti').focus();
                        list_transaksi();
                    }
                            
                }                    
            });

            $('#no_bukti').focus();
            go_next('tanggal_bukti','pelanggan');
            $('#pelanggan').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#cari_obat').modal('show');
                }  
            });

            $('#tanggal_resep').bind('keypress' , function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#tanggal_resep').val() != '' ){
                        $('#cari_pasien').modal('show');
                    }
                            
                }
            });

            $('#cari_obat').on('shown', function () {
                $("#tbl_obat_filter input").focus();
            });

             $('#no_resep').change(function(){
                list_transaksi();
             })

            load_datatable();
        });

        function load_datatable(){
            oTable = $('#tbl_obat').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
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
            
            $('#no_rm').val(id);
            pasien_find(id,opt);
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

        function go_next(source,dest){
            $('#'+source).bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { 
                    if( $('#'+source).val() != '' ){
                        $('#'+dest).focus();
                    }
                            
                }                    
            });
        }

       	function pilih_obat(id,nama,jenis_obat,komposisi,satuan,masa,stok,harga,harga_beli){
            if(stok == 0){
                alert('Stok obat kosong');
            }
            else{
                $('#id_obat').val(id);
                $('#nama_obat').val(nama);
				$('#jenis_obat').val(jenis_obat);
				$('#komposisi').val(komposisi);
                $('#satuan').val(satuan);
				$('#masa').val(masa);
                $('#stok').val(stok);
                $('#harga').val(harga);
                $('#harga_beli').val(harga_beli);

                $('#jumlah').attr('disabled',false);

                $('#cari_obat').modal('hide');
                $('#jumlah').focus();
            }
            
        }

        function list_transaksi(){
            var id_reg = $('#no_bukti').val();
            if(id_reg == '')
                id_reg = 'zxasqwopsds';

            cetak_alert2('Mohon tunggu');

            $.ajax({
                url: "{{ url('gudang_keluar/list_transaksi/'.$slug) }}"+'/'+id_reg,
                dataType: "json",
                success: function(res){
                    $('#resep_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                                $('#resep_list tbody').append('<tr><td>'+data.kodobat+'</td>'+
                                        '<td>'+data.dariuntuk+'</td>'+
                                        '<td>'+data.namaobat+'</td>'+
                                        '<td>'+data.satuan+'</td>'+
                                        '<td class="align-right">'+data.harga+'</td>'+
										'<td class="align-right">'+data.hargabeli+'</td>'+
                                        '<td class="align-right">'+(data.sisa + data.keluar)+'</td>'+
                                        '<td class="align-right">'+data.keluar+'</td>'+
                                        '<td class="align-right">'+data.sisa+'</td>'+
                                        '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.no+"',"+
                                        "'"+data.nobp+"'"+')">'+
                                        '<i class="splashy-error_x"></i></a></td>'+
                                        '</tr>');
                            });
                    }
										//cek data.no itu isi nya apa??/
                    $('#pesan_error2').hide();
                },
                error:function(res){
                    alert('Connection failed');
                    $('#pesan_error2').hide();
                }
            });
            $('#tbl_obat').dataTable().fnReloadAjax();
        }

        function tambah_transaksi(){
            var no_reg = $('#no_register').val();
            var id_obat = $('#id_obat').val();
            var harga = $('#harga').val();
            var harga_beli = $('#harga_beli').val();
            var total = $('#total').val();
            var no_resep = $('#no_bukti').val();
            var tanggal_resep = $('#tanggal_bukti').val()
            var no_rm = $('#pelanggan').val();
            var tanggal_masuk = $('#tanggal_masuk').val();
            var jenis_rawat = $('#jenis_rawat').val();
            var nama_obat = $('#nama_obat').val();
            var nama_lengkap = $('#pelanggan').children(':selected').text();
            var jumlah = $('#jumlah').val();
            var stok = $('#stok').val();
			var masa = $('#masa').val();
			var satuan = $('#satuan').val();
			var komposisi = $('#komposisi').val();
			var jenis_obat = $('#jenis_obat').val();
			cetak_alert('Mohon tunggu');


            if(no_resep == ''){
                cetak_alert('Nomor Bukti tidak boleh kosong');
                $('#no_resep').focus();
            }
            else if(masa == 0){
                cetak_alert('Masa Berlaku Obat Habis');
                $('#no_resep').focus();
            }
            else if(tanggal_resep == ''){
                cetak_alert('Tanggal Bukti tidak boleh kosong');
                $('#tanggal_resep').focus();
            }
            else if(no_rm == ''){
                cetak_alert('Pelanggan tidak boleh kosong');
            }
            else if(stok-jumlah < 0){
                cetak_alert('Stok obat tidak mencukupi untuk quantity sebanyak '+jumlah+', stok obat saat ini '+stok);
                $('#jumlah').focus();
            }
            else  
			if(jumlah == '' || jumlah == '0'){
                cetak_alert('Jumlah barang tidak boleh kosong');
                $('#jumlah').focus();
            }
            else{

                $.ajax({
                    url: "{{ url('gudang_keluar/check_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah,
                    success:function(resa){
                        if(resa == 'ada'){
                            var r = confirm("Transaksi obat dengan jumlah yang sama sudah ada,  apakah anda ingin tetap meneruskan?");
                            if (r == true) {
                                $.ajax({
                                    url: "{{ url('gudang_keluar/tambah_transaksi/'.$slug) }}",
                                    type: "POST",
                                    data : "id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&tanggal_masuk="+tanggal_masuk+"&masa="+masa+
                                            "&total="+total+"&no_bukti="+no_resep+"&pelanggan="+no_rm+"&harga_beli="+harga_beli+
                                            "&tanggal_bukti="+tanggal_resep+"&nama_obat="+nama_obat+"&stok="+stok+"&nama_lengkap="+nama_lengkap+
											"&satuan="+satuan+"&komposisi="+komposisi+"&jenis_obat="+jenis_obat,
                                    success:function(res){
                                        if(res == 'sukses'){
                                            cetak_alert('Data berhasil ditambahkan');
                                            $('#id_obat').val('');
                                            $('#nama_obat').val('');
                                            $('#harga').val('');
                                            $('#total').val('');
                                            $('#stok').val('');
                                            $('#jumlah').val('');
											$('#satuan').val('');
											$('#harga_beli').val('');

                                            //$('#tbl_obat').dataTable().fnReloadAjax();
                                        }
                                        else{
                                            cetak_alert(res);
                                        }
                                        list_transaksi();
                                        $('#btn_obat').focus();
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
                                data : "&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&tanggal_masuk="+tanggal_masuk+"&harga_beli="+harga_beli+
                                        "&total="+total+"&no_bukti="+no_resep+"&pelanggan="+no_rm+"&jenis_rawat="+jenis_rawat+"&masa="+masa+
										"&tanggal_bukti="+tanggal_resep+"&nama_obat="+nama_obat+"&stok="+stok+"&nama_lengkap="+nama_lengkap+
										"&satuan="+satuan+"&komposisi="+komposisi+"&jenis_obat="+jenis_obat,
                                success:function(res){
                                    if(res == 'sukses'){
                                        cetak_alert('Data berhasil ditambahkan');
			
                                        $('#id_obat').val('');
                                        $('#nama_obat').val('');
                                        $('#harga').val('');
                                        $('#total').val('');
                                        $('#stok').val('');
                                        $('#jumlah').val('');
										$('#satuan').val('');
										$('#harga_beli').val('');

                                        //$('#tbl_obat').dataTable().fnReloadAjax();
                                    }
                                    else{
                                        cetak_alert(res);
                                    }
                                    list_transaksi();
                                    $('#btn_obat').focus();
                                }
                            });
                        }
                    }
                });
                
            }
        }

        function edit_transaksi(IdResep,NoResep,TanggalResep,NoRM,IdObat,NamaObat,Harga,Jumlah,TotalHarga){ 
            
            $('#obat_baru').hide();
            $('#obat_edit').show();
            $('#Jumlah_edit').focus();
            //$('#edit_trx').modal('show');
            $('#no_bukti_asli').val(IdResep);
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
            var IdResep = $('#no_bukti_asli').val();
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

        function hapus_transaksi(no,noba){
            var r = confirm('Hapus transaksi ?');
            if (r == true) {
                $.ajax({
                    url: "{{ url('gudang_keluar/hapus_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "no="+no+"&noba="+noba,
                    success:function(res){
                        cetak_alert('Data berhasil dihapus');
                        list_transaksi();
                    }
                });
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


    </script>
@stop