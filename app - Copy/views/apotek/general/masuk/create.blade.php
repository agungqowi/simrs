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
                            <a href="{{ url('apotek_masuk/'.$slug) }}">Apotek</a>
                        </li>
                        <li>
                            <a href="{{ url('apotek_masuk/'.$slug) }}">{{ $title }}</a>
                        </li>
                        <li>
                            Transaksi Masuk
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Transaksi Masuk
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
                <div class="span12">
                    
                </div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid formSep">
                        <div class="span4">           
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="nowdate span10">
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Kode Supplier<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="kode_supplier" name="kode_supplier" class="span10 edit-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Supplier<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="nama_supplier" id="nama_supplier">
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
                                <button type="button" id="btn_input_baru" class="btn btn-success"><i class="splashy-add"></i> Input Obat Baru</button>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label">Kode Obat</label>
                                        <div class="controls">
                                            <input type="text" id="kode_obat" name="kode_obat" class="no-primary">
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label">Nama Obat</label>
                                        <div class="controls">
                                            <input type="text" id="nama_obat" name="nama_obat" class="no-primary">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Jenis Obat</label>
                                        <div class="controls">
                                            <select name="jenis_obat" id="jenis_obat" class="span12 no-primary">
                                                @foreach($jenis_obat as $j=>$k)
                                                    <option value="{{ $k->kodejenis }}">{{ $k->namajenis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label">Komposisi</label>
                                        <div class="controls">
                                            <input type="text" id="komposisi" name="komposisi" class="no-primary">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Stok Awal</label>
                                        <div class="controls">
                                            <input type="text" id="stok_awal" name="stok_awal" class="span7 no-primary" style="text-align: right">
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
                                        <label class="control-label">Harga Beli</label>
                                        <div class="controls">
                                            <input type="text" id="harga_beli" name="harga_beli" class="span12" style="text-align: right">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Harga Jual</label>
                                        <div class="controls">
                                            <input type="text" id="harga" name="harga" class="span12" style="text-align: right">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Kadaluarsa</label>
                                        <div class="controls">
                                            <input type="text" id="masa" name="masa" class="span8 nowdate">
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
                                <input type="hidden" id="id_transaksi" name="id_transaksi" value="0">
                                <button id="btn_simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                <button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
                                <button id="btn_tambah" type="button" onclick="tambah_baru()" class="btn btn-success"><i class="splashy-add"></i> Tambah</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row-fluid">
                        <div class="span12">
                        <table id="resep_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Satuan</th>
                                    <th>Harga Beli</th>
									<th>Harga Jual</th>
                                    <th>Stok Awal</th>
                                    <th>Jumlah Beli</th>
                                    <th>Total Stok</th>
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
                                "sAjaxSource": "{{ url('apotek_obat/detaildatatable/'.$slug) }}",
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
                $(this).attr('disabled','disabled');
            });

            $('.edit-primary').each(function(){
                $(this).attr('disabled','disabled');
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
            $('#jumlah').on('input', function() {
                var jumlah = $('#jumlah').val();
                var harga_beli= $('#harga_beli').val();
                var val = jumlah * harga_beli;
                $('#total').val( val );
            });

            $('#nama_supplier').change(function(){
                $('#kode_supplier').val( $(this).val() )
            });

            $('#btn_simpan').click(function(){
                tambah_transaksi();
            });

            $('#no_bukti').focusout(function() {
                //list_transaksi();
            });

            $('#tanggal_masuk').focusout(function() {
                //list_transaksi();
            });

            $('#tanggal_masuk').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#nama_supplier').focus();
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

            $('#satuan').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#harga').focus();
                }  
            });

            $('#harga').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#masa').focus();
                }  
            });

            $('#masa').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#jumlah').focus();
                }  
            });

            

            $('#btn_input_baru').click(function(){
                input_baru();
                $('#nama_obat').focus();
            });

            $('#tanggal_masuk').focus();

            $('#jumlah').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    tambah_transaksi();
                }  
            });

            $('#cari_obat').on('shown', function () {
                $("#tbl_obat_filter input").focus();
            });

            setInterval(function () {$('#pesan_error').hide();}, 5000);
        });

        function input_baru(){
            $('.no-primary').each(function(){
                $(this).attr('disabled',false);
            });

            $('#kode_obat').val('NEW');
            $('#kode_obat').attr('disabled','disabled');

            $('#stok_awal').val('0');
            $('#stok_awal').attr('disabled','disabled');
			
			$('#total').val('');
			$('#total').attr('disabled','disabled');
			
            $('#nama_obat').val('');
			$('#jenis_obat').val('');
            $('#harga').val('');
			//$('#harga_beli').attr('disabled','disabled');
			$('#harga_beli').val('');
			$('#satuan').val('');
			$('#komposisi').val('');
            $('#masa').val('');
            $('#jumlah').val('');

            
        }

        function tambah_baru(){
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

            $('#kode_obat').val('');
            $('#kode_obat').attr('disabled','disabled');

            $('#stok_awal').val('0');
            $('#stok_awal').attr('disabled','disabled');
            
            $('#total').val('');
            $('#total').attr('disabled','disabled');

            $('#nama_obat').val('');
            $('#jenis_obat').val('');
            $('#harga').val('');
            //$('#harga_beli').attr('disabled','disabled');
            $('#harga_beli').val('');
            $('#satuan').val('');
            $('#komposisi').val('');
            $('#masa').val('');
            $('#jumlah').val('');

            $('#id_transaksi').val('0');
            $('#tipe').val('tambah');

            $('#btn_simpan').val('Simpan');
            $("btn_cari_obat").focus();
        }
/*
        function pilih_pasien(id){
            $('.edit-primary').each(function(){
                $(this).attr('disabled','disabled');
            })            
            pasien_find(id)
        }

        function pasien_find(val){
            $.ajax({
                url: "{{ url('apotek_keluar/check_pasien') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    if(res == false)
                        alert('Data transaksi pasien tidak ditemukan');
                    else{
                        $('#id_reg').val(res.NoReg);
                        $('#no_rm').val(res.NoRM);
                        $('#nama_lengkap').val(res.Nama);
                        if( res.TglMasuk != '' || res.TglMasuk != '-'){
                            var _tglArray = res.TglMasuk.split("-");
                            $('#tanggal_masuk').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
                        }
                        else{
                            $('#tanggal_masuk').val(' ');
                        }
                        $('#jenis_rawat').val( res.JenisRawat );
                        $('#no_register').val( res.NoReg );
                        $('#cari_pasien').modal('hide');
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
            
            $('#simpan').click(function(){
                tambah_transaksi();
            })
        }
*/
        function pilih_obat(id,nama,jenis,komposisi,satuan,masa,stok,harga,harga_beli){
            $('#kode_obat').val(id);
            $('#nama_obat').val(nama);
            $('#jenis_obat').val(jenis);
            $('#komposisi').val(komposisi);
            $('#satuan').val(satuan);
            $('#masa').val(masa);
            $('#stok_awal').val(stok);
            $('#harga').val(harga);
			$('#harga_beli').val(harga_beli);
			$('#harga_beli').attr('disabled','disabled');
			
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            })

            $('#cari_obat').modal('hide');
            $('#jumlah').attr('disabled',false);

            $('#jumlah').focus();
            $('#id_transaksi').val('0');
            $('#tipe').val('tambah');
        }

        function list_transaksi(){
            var tanggal_masuk = $('#tanggal_masuk').val();
            cetak_alert2('Mohon tunggu');
            if(tanggal_masuk != ''){
                $.ajax({
                    url: "{{ url('apotek_masuk/list_transaksi/'.$slug) }}",
                    dataType: "json",
                    type: "POST",
                    data : "tanggal_masuk="+tanggal_masuk,
                    success: function(res){
                        $('#resep_list tbody').html('');
                        if(res == false){

                        }
                        else{
                            $.each(res, function (key, data) {
                                $('#resep_list tbody').append('<tr><td>'+data.kodobat+'</td>'+
                                        '<td>'+data.namaobat+'</td>'+
                                        '<td>'+data.satuan+'</td>'+
										'<td class="align-right">'+data.hargabeli+'</td>'+
                                        '<td class="align-right">'+data.harga+'</td>'+
                                        '<td class="align-right">'+(data.sisa - data.masuk)+'</td>'+
                                        '<td class="align-right">'+data.masuk+'</td>'+
                                        '<td class="align-right">'+data.sisa+'</td>'+
                                        '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.no+"',"+
                                        "'"+data.noba+"'"+')">'+
                                        '<i class="splashy-error_x"></i></a>'+
                                        '</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="edit_transaksi('+
                                        "'"+data.no+"',"+
                                        "'"+data.kodobat+"',"+
                                        "'"+data.namaobat+"',"+
                                        "'"+data.kodejenis+"',"+
                                        "'"+data.satuan+"',"+
                                        "'"+data.hargabeli+"',"+
                                        "'"+data.harga+"',"+
                                        "'"+data.komposisi+"',"+
                                        "'"+data.masa+"',"+
                                        "'"+(data.sisa - data.masuk)+"',"+
                                        "'"+data.tanggal+"',"+
                                        "'"+data.noba+"',"+
                                        "'"+data.dariuntuk+"',"+
                                        "'"+data.masuk+"',"+
                                        "'"+data.sisa+"'"+')">'+
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
                $('#btn_tambah').attr('disabled','disabled');
                tambah_baru();
                
            }
            
        }

        function tambah_transaksi(){
            var id_obat = $('#kode_obat').val();
            var jumlah = $('#jumlah').val();
            var harga = $('#harga').val();
			var harga_beli = $('#harga_beli').val();
			var satuan = $('#satuan').val();
			var komposisi = $('#komposisi').val();			
            var stok_awal = $('#stok_awal').val()
            var masa = $('#masa').val();
            var total = $('#total').val();
            var tanggal_masuk = $('#tanggal_masuk').val();
            var no_bukti = "";
            var nama_supplier = $('#nama_supplier').val();
            var nama_obat = $('#nama_obat').val();
            var kode_supplier = $('#kode_supplier').val();
			var jenis_obat = $('#jenis_obat').val();
            var id_transaksi = $('#id_transaksi').val();
            var tipe = $('#tipe').val();

            cetak_alert('Mohon tunggu');


            $.ajax({
                url: "{{ url('apotek_masuk/tambah_transaksi/'.$slug) }}",
                type: "POST",
                data : "no_bukti="+no_bukti+"&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&tanggal_masuk="+tanggal_masuk+
                        "&total="+total+"&stok_awal="+stok_awal+"&masa="+masa+"&nama_supplier="+nama_supplier+
                        "&kode_supplier="+kode_supplier+"&nama_obat="+nama_obat+"&satuan="+satuan+"&komposisi="+komposisi+
						"&jenis_obat="+jenis_obat+"&harga_beli="+harga_beli+"&id_transaksi="+id_transaksi+"&tipe="+tipe,
                success:function(res){
                    if(res == 'sukses'){
                        if(tipe=='edit')
                            cetak_alert('Data berhasil diupdate');
                        else
                            cetak_alert('Data berhasil ditambahkan');
                        $('#kode_obat').val('');
                        $('#nama_obat').val('');
						$('#jenis_obat').val('');
                        $('#harga').val('');
						$('#harga_beli').val('');
						$('#satuan').val('');
						$('#komposisi').val('');
                        $('#total').val('');
                        $('#stok_awal').val('');
                        $('#masa').val('');
                        $('#jumlah').val('');
                        $('#tipe').val('tambah');
                        $('#id_transaksi').val('0');


                    }
                    else{
                        alert(res);
                    }
                    list_transaksi();
                    $('#btn_cari_obat').focus();
                }

                
            });
        }

        function edit_transaksi(no,kodobat,namaobat,kodejenis,satuan,hargabeli,harga,komposisi,masa,stok,tanggal,noba,dariuntuk,masuk,sisa){
            $('#kode_obat').val(kodobat);
            $('#nama_obat').val(namaobat);
            $('#jenis_obat').val(kodejenis);
            $('#komposisi').val(komposisi);
            $('#satuan').val(satuan);
            var _masa = masa.split('-');
            $('#masa').val(_masa[2]+'/'+_masa[1]+'/'+_masa[0]);
            $('#stok_awal').val(stok);
            $('#harga').val(harga);
            $('#harga_beli').val(hargabeli);
            $('#harga_beli').attr('disabled','disabled');

            $('#kode_supplier').val(dariuntuk);

            $('#jumlah').val(masuk);

            $('#nama_supplier').val(dariuntuk);
            
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            })

            $('#cari_obat').modal('hide');
            $('#jumlah').attr('disabled',false);

            $('#id_transaksi').val(no);
            $('#tipe').val('edit');

            $('#jumlah').focus();

            $('#btn_simpan').val('Update');
            $('#btn_tambah').attr('disabled',false);
        }

        function hapus_transaksi(no,noba){
            var r = confirm('Hapus transaksi ?');
            if (r == true) {
                cetak_alert2('Mohon tunggu');
                $('#pesan_error').hide();
                $.ajax({
                    url: "{{ url('apotek_masuk/hapus_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "no="+no+"&noba="+noba,
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


    </script>
@stop