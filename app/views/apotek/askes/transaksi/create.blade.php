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
                            <a href="{{ url('askes_transaksi') }}">Apotek</a>
                        </li>
                        <li>
                            <a href="{{ url('askes_transaksi') }}">Askes</a>
                        </li>
                        <li>
                            Transaksi
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Transaksi
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
	        	</div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No Resep<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="no_resep" name="no_resep" class="span6">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Resep<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="tanggal_resep" name="tanggal_resep" class="tanggal span6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid formsep">
                        <div class="span6">                            
                            <div class="control-group">
                                <label class="control-label">No RM<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" id="no_rm" name="txt_no_rm" class="span6 no-primary">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#cari_pasien"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="span10 no-primary">
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
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" id="tanggal_masuk" name="tanggal_masuk" class="tanggal span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">No Register</label>
                                <div class="controls">
                                    <input type="text" id="no_register" name="no_register" class="span10 no-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Kode Obat</label>
                                <div class="controls">
                                    <input type="text" id="id_obat" name="id_obat" class="span8 no-primary">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#cari_obat"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Obat</label>
                                <div class="controls">
                                    <input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary">
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
                                <label class="control-label">Harga</label>
                                <div class="controls">
                                    <input type="text" id="harga" name="harga" class="span10 no-primary" style="text-align: right">
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
                            <div class="">
                                <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                <button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                        <table id="resep_list" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No Resep</th>
                                    <th>Tanggal Resep</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
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
    <div class="modal hide fade modal-admin" id="cari_pasien" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_pasien" class="table table-striped table-bordered table-hover">
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
                                <th align="center" valign="middle" class="head1">NoRM</th>
                                <th align="center" valign="middle" class="head2">Nama</th>
                                <th align="center" valign="middle" class="head3">Jkel</th>
                                <th align="center" valign="middle" class="head4">TempatLahir</th>
                                <th align="center" valign="middle" class="head5">TanggalLahir</th>
                                <th align="center" valign="middle" class="head6">Jalan</th>
                                <th align="center" valign="middle" class="head7">NoBPJS</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            oTable = $('#tbl_pasien').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('pasien/datatable') }}",
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

            $('#jumlah').change(function(){
                var jumlah = $('#jumlah').val();
                var harga = $('#harga').val();
                var val = jumlah * harga;
                $('#total').val( val );
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
                                "sAjaxSource": "{{ url('askes_obat/detaildatatable') }}",
                                "bServerSide": true
                                
            });
        }

        function pilih_pasien(id){
            $('.edit-primary').each(function(){
                $(this).attr('disabled','disabled');
            })
            pasien_find(id)
        }

        function pasien_find(val){
            $.ajax({
                url: "{{ url('askes_transaksi/check_pasien') }}"+'/'+val,
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

        function pilih_obat(id,nama,jenis,komposisi,satuan,masa,stok,harga){
            $('#id_obat').val(id);
            $('#nama_obat').val(nama);
            $('#harga').val(harga);
            $('#stok').val(stok);

            $('#cari_obat').modal('hide');
        }

        function list_transaksi(){
            var no_reg = $('#no_register').val();

            $.ajax({
                url: "{{ url('askes_transaksi/list_transaksi') }}"+'/'+no_reg,
                dataType: "json",
                success: function(res){
                    $('#resep_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#resep_list tbody').append('<tr><td>'+data.NoResep+'</td>'+
                                    '<td>'+data.TanggalResep+'</td>'+
                                    '<td>'+data.NamaObat+'</td>'+
                                    '<td>'+data.Harga+'</td>'+
                                    '<td>'+data.Jumlah+'</td>'+
                                    '<td>'+data.TotalHarga+'</td>'+
                                    '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.IdResep+"',"+
                                        "'"+data.NoRM+"',"+
                                        "'"+data.NoResep+"',"+
                                        "'"+data.TanggalResep+"',"+')">'+
                                    '<i class="splashy-error_x"></i>'+
                                '</a></td></tr>');
                        });
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
            var jumlah = $('#jumlah').val();
            var harga = $('#harga').val();
            var total = $('#total').val();
            var no_resep = $('#no_resep').val();
            var tanggal_resep = $('#tanggal_resep').val()
            var no_rm = $('#no_rm').val();
            var tanggal_masuk = $('#tanggal_masuk').val();
            var jenis_rawat = $('#jenis_rawat').val();
            var nama_obat = $('#nama_obat').val();
            var stok = $('#stok').val();
            var nama_lengkap = $('#nama_lengkap').val();

            $.ajax({
                url: "{{ url('askes_transaksi/tambah_transaksi') }}",
                type: "POST",
                data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+"&tanggal_masuk="+tanggal_masuk+
                        "&total="+total+"&no_resep="+no_resep+"&no_rm="+no_rm+"&jenis_rawat="+jenis_rawat+
                        "&tanggal_resep="+tanggal_resep+"&nama_obat="+nama_obat+"&stok="+stok+"&nama_lengkap="+nama_lengkap,
                success:function(res){
                    if(res == 'sukses'){
                        alert('Data berhasil ditambahkan');
                        $('#id_obat').val('');
                        $('#nama_obat').val('');
                        $('#harga').val('');
                        $('#total').val('');
                        $('#stok').val('');
                        $('#jumlah').val('');

                        //$('#tbl_obat').dataTable().fnReloadAjax();
                    }
                    else{
                        alert(res);
                    }
                    list_transaksi();
                }
            });
        }

        function hapus_transaksi(id_resep,no_rm,no_resep,tanggal_resep){
            $.ajax({
                url: "{{ url('askes_transaksi/hapus_transaksi') }}",
                type: "POST",
                data : "id_resep="+id_resep,
                success:function(res){
                    alert('Data berhasil dihapus');
                    list_transaksi();
                }
            });
        }


    </script>
@stop