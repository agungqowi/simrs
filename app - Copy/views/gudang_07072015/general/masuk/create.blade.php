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
                            <a href="{{ url('gudang_masuk/'.$slug) }}">Gudang</a>
                        </li>
                        <li>
                            <a href="{{ url('gudang_masuk/'.$slug) }}">{{ $title }}</a>
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
                                <label class="control-label">No Bukti<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="no_bukti" name="no_bukti" class="span10">
                                </div>
                            </div>                           
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk<span class="f_req">*</span></label>
                                <div class="controls">
                                   <div class="input-append date">
                                      <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="tanggal span10">
                                      <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
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
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cari_obat"><i class="splashy-zoom"></i> Cari Obat</button>
                                <button type="button" id="btn_input_baru" class="btn btn-success"><i class="splashy-add"></i> Input Baru</button>
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
                                                    <option value="{{ $k->kodegudang }}">{{ $k->namagudang }}</option>
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
                                            <input type="text" id="masa" name="masa" class="span8 tanggal">
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
                    <div class="row-fluid formsep">
                        <div class="span12">
                            <div class="">
                                <button id="btn_simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                <button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
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
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
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
                                "sAjaxSource": "{{ url('gudang_obat/detaildatatable/'.$slug) }}",
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
                                ]
                                
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
/*
            $('#jumlah').change(function(){
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

            $('#no_bukti').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    list_transaksi();     
                }
                    
            });

            $('#btn_input_baru').click(function(){
                input_baru();
                $('#nama_obat').focus();
            })
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
			$('#harga_beli').val('');
			$('#satuan').val('');
			$('#komposisi').val('');
            $('#masa').val('');
            $('#jumlah').val('');
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

            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            })

            $('#cari_obat').modal('hide');
            $('#jumlah').attr('disabled',false);
        }

        function list_transaksi(){
            var no_bukti = $('#no_bukti').val();
            var tanggal_masuk = $('#tanggal_masuk').val();
            if(no_bukti != ''){
                $.ajax({
                    url: "{{ url('gudang_masuk/list_transaksi/'.$slug) }}",
                    dataType: "json",
                    type: "POST",
                    data : "no_bukti="+no_bukti+"&tanggal_masuk="+tanggal_masuk,
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
                                        '<i class="splashy-error_x"></i></a></td>'+
                                        '</tr>');
                            });
                        }

                    },
                    error:function(res){
                        alert('Connection failed');
                    }
                });
                $('#tbl_obat').dataTable().fnReloadAjax();
            }
            
        }

        function tambah_transaksi(){
            var id_obat = $('#kode_obat').val();
            var jumlah = $('#jumlah').val();
            var harga = $('#harga').val();
            var stok_awal = $('#stok_awal').val()
            var masa = $('#masa').val();
            var total = $('#total').val();
            var tanggal_masuk = $('#tanggal_masuk').val();
            var no_bukti = $('#no_bukti').val();
            var nama_supplier = $('#nama_supplier').val();
            var nama_obat = $('#nama_obat').val();
            var kode_supplier = $('#kode_supplier').val();
			var harga_beli = $('#harga_beli').val();
			var satuan = $('#satuan').val();
			var komposisi = $('#komposisi').val();			
			var jenis_obat = $('#jenis_obat').val();


            $.ajax({
                url: "{{ url('gudang_masuk/tambah_transaksi/'.$slug) }}",
                type: "POST",
                data : "no_bukti="+no_bukti+"&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&tanggal_masuk="+tanggal_masuk+
                        "&total="+total+"&stok_awal="+stok_awal+"&masa="+masa+"&nama_supplier="+nama_supplier+
                        "&kode_supplier="+kode_supplier+"&nama_obat="+nama_obat+"&satuan="+satuan+"&komposisi="+komposisi+
						"&jenis_obat="+jenis_obat+"&harga_beli="+harga_beli,
                success:function(res){
                    if(res == 'sukses'){
                        cetak_alert('Data berhasil ditambahkan');
                        $('#kode_obat').val('');
                        $('#nama_obat').val('');
                        $('#harga').val('');
                        $('#total').val('');
                        $('#stok_awal').val('');
                        $('#masa').val('');
                        $('#komposisi').val('');
                        $('#jumlah').val('');
						$('#jenis_obat').val('');
						$('#harga_beli').val('');
						$('#satuan').val('');
                    }
                    else{
                        alert(res);
                    }
                    list_transaksi();
                }
            });
        }

        function hapus_transaksi(no,noba){
            var r = confirm('Hapus transaksi ?');
            if (r == true) {
                $.ajax({
                    url: "{{ url('gudang_masuk/hapus_transaksi/'.$slug) }}",
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


    </script>
@stop