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
                            Retur Barang
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Retur Barang
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
                                <label class="control-label">Tanggal Distribusi<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="nowdate span10">
                                </div>
                            </div>        
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Tujuan<span class="f_req">*</span></label>
                                <div class="controls">
                                   <select name="tujuan" id="tujuan">
                                       <option value="gudang">Gudang</option>
                                   </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div class="control-group">
                                <div class="controls">
                                <button type="button" id="btn_cari_obat" class="btn btn-warning" data-toggle="modal" data-target="#cari_obat"><i class="splashy-zoom"></i> Cari Barang</button>
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
                                        <label class="control-label">Jenis Barang</label>
                                        <div class="controls">
                                            <select name="jenis_obat" id="jenis_obat" class="span12 no-primary">
                                                @foreach($jenis_obat as $j=>$k)
                                                    <option value="{{ $k->kodejenis }}">{{ $k->namajenis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Komposisi</label>
                                        <div class="controls">
                                            <input type="text" id="komposisi" name="komposisi" class="no-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Satuan</label>
                                        <div class="controls">
                                            <input type="text" id="satuan" name="satuan" class="span12 no-primary">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Kadaluarsa</label>
                                        <div class="controls">
                                            <input type="text" id="masa" name="masa" class="span8 tanggal no-primary">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Stok Apotek</label>
                                        <div class="controls">
                                            <input type="text" id="stok_awal" name="stok_awal" class="span7 no-primary" style="text-align: right">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Stok yang diretur<span class="f_req">*</span></label>
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
                                    <th>Nama Obat</th>
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
                                "sAjaxSource": "{{ url('apotek_obat/detailobat/'.$slug) }}",
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
    	function hitungTotal(){

        }
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
            $('#jumlah').on('input', function() {

            });

            $('#btn_simpan').click(function(){
                tambah_transaksi();
            });

            $('#tanggal_masuk').on('changeDate', function(e) {
                list_transaksi();
                $('#tujuan').focus();
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
                    $('#masa').focus();
                }  
            });

            $('#masa').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#harga_beli').focus();
                }  
            });

            $('#harga_beli').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    $('#jumlah').focus();
                }  
            });

            $('#jumlah').on('input',function(){
            	var _ppn = parseInt( $('#jumlah').val() ) * parseInt( $('#harga_beli').val() ) / 10;
                $('#ppn').val( _ppn );
            });

            $('#jumlah').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                	var _ppn = parseInt( $('#jumlah').val() ) * parseInt( $('#harga_beli').val() ) / 10;
                   tambah_transaksi();
                }  
            });

            $('#tanggal_masuk').focus();

            $('#cari_obat').on('shown', function () {
                $("#tbl_obat_filter input").focus();
            });

            setInterval(function () {$('#pesan_error').hide();}, 5000);
        });

        function tambah_baru(){
            $('.no-primary').each(function(){
                $(this).attr('readonly','true');
            });

            $('#kode_obat').val('');
            $('#kode_obat').attr('readonly','true');

            $('#stok_awal').val('0');
            $('#stok_awal').attr('readonly','true');
            
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

            $('#id_transaksi').val('0');
            $('#tipe').val('tambah');

            $('#btn_simpan').val('Simpan');
            $("btn_cari_obat").focus();
        }
/*
        function pilih_pasien(id){
            $('.edit-primary').each(function(){
                $(this).attr('readonly','true');
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
                            $(this).attr('readonly',false);
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
            var tanggal_masuk = $('#tanggal_masuk').val();
            cetak_alert2('Mohon tunggu');
            if(tanggal_masuk != ''){
                $.ajax({
                    url: "{{ url('askes_retur/list_transaksi/') }}",
                    dataType: "json",
                    type: "POST",
                    data : "tanggal_masuk="+tanggal_masuk,
                    success: function(res){
                        $('#resep_list tbody').html('');
                        if(res == false){

                        }
                        else{
                            $.each(res, function (key, data) {
                            	var total = (parseInt(data.jumlah) * parseInt(data.hargabeli) ) + parseInt(data.ppn) - parseInt(data.diskon) ;
                                $('#resep_list tbody').append('<tr>'+
                                        '<td>'+data.namaobat+'</td>'+
                                        '<td>'+data.satuan+'</td>'+
                                        '<td class="align-right">'+data.jumlah+'</td>'+
                                        '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.id+"'"+')">'+
                                        '<i class="splashy-error_x"></i></a>'+
                                        '</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="edit_transaksi('+
                                        "'"+data.id+"',"+
                                        "'"+data.kodobat+"',"+
                                        "'"+data.namaobat+"',"+
                                        "'"+data.kodejenis+"',"+
                                        "'"+data.satuan+"',"+
                                        "'"+data.hargabeli+"',"+
                                        "'"+data.hargabeli+"',"+
                                        "'"+data.komposisi+"',"+
                                        "'"+data.tanggal_expire+"',"+
                                        "'"+(data.stok_obat)+"',"+
                                        "'"+data.tanggal_beli+"',"+
                                        "'"+data.kodesupp+"',"+
                                        "'"+data.ppn+"',"+
                                        "'"+data.diskon+"',"+
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

            cetak_alert('Mohon tunggu');

            var _jumlah = parseInt( $('#jumlah').val() );
            var _stok   = parseInt( $('#stok_awal').val() );

            if( _jumlah > _stok ){
                cetak_alert('Stok tidak mencukupi');
            }
            else{
                $.ajax({
                    url: "{{ url('askes_retur/tambah_transaksi/'.$slug) }}",
                    type: "POST",
                    data : $('#reg1_form').serialize(),
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
            
        }

        function edit_transaksi(no,kodobat,namaobat,kodejenis,satuan,hargabeli,harga,komposisi,masa,stok,tanggal,dariuntuk,ppn,diskon,masuk){
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
            $('#harga_beli').attr('readonly','true');

            $('#kode_supplier').val(dariuntuk);

            $('#jumlah').val(masuk);

            var _tt = parseInt(masuk) + parseInt(stok);
            $('#stok_awal').val(_tt);

            $('#nama_supplier').val(dariuntuk);
            $('#diskon').val(diskon);
            $('#ppn').val(ppn);
            
            $('.no-primary').each(function(){
                $(this).attr('readonly','true');
            })

            $('#cari_obat').modal('hide');
            $('#jumlah').attr('readonly',false);

            $('#id_transaksi').val(no);
            $('#tipe').val('edit');

            $('#jumlah').focus();

            $('#btn_simpan').val('Update');
            $('#btn_tambah').attr('readonly',false);

            hitungTotal();
        }

        function hapus_transaksi(no,noba){
            var r = confirm('Hapus transaksi ?');
            if (r == true) {
                cetak_alert2('Mohon tunggu');
                $('#pesan_error').hide();
                $.ajax({
                    url: "{{ url('askes_retur/hapus_transaksi/'.$slug) }}",
                    type: "POST",
                    data : "no="+no,
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