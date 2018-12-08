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
                            <a href="{{ url('sep/buat') }}">SEP</a>
                        </li>
                        <li>
                            Buat SEP
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Pembuatan SEP
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
                    <div id="pesan_error" class="alert alert-error" style="display:none;font-weight:bold;"></div>
					@if( $pesan != '' )
						<div id="" class="alert alert-error" style="font-weight:bold">{{ $pesan }}</div>
					@endif
					<div id="info" class="alert alert-info" role="alert" style="font-weight:bold">
					  Semua data harap diisi dengan benar agar tidak terjadi kesalahan database pasien.
					</div>
	        	</div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">No Kartu BPJS</label>
                                <div class="controls">
                                    <input type="text" id="no_kartu" name="no_kartu" class="span12">
                                </div>
                            </div>
						</div>
						<div class="span4">
                            <div class="control-group">
                                <label class="control-label">Tanggal SEP (Kedatangan)</label>
                                <div class="controls">
                                    <input type="text" id="tanggal_sep" name="tanggal_sep" class="span12 nowdate">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">No Rujukan</label>
                                <div class="controls">
                                    <input type="text" id="no_rujukan" name="no_rujukan" class="span12">
                                </div>
                            </div>
						</div>
						<div class="span4">
                            <div class="control-group">
                                <label class="control-label">Tanggal Rujukan</label>
                                <div class="controls">
                                    <input type="text" id="tanggal_rujukan" name="tanggal_rujukan" class="nowdate span12">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
						<div class="span6">
                            <div class="control-group">
                                <label class="control-label">PPK Rujukan</label>
                                <div class="controls">
                                    <input type="text" id="ppk_rujukan" name="ppk_rujukan" class="span10 no-primary">
									<input type="hidden" id="id_ppk_rujukan" name="id_ppk_rujukan" class="span10 no-primary">
                                    <button class="btn btn-warning" id="btn_rujukan" type="button"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">PPK Pelayanan</label>
                                <div class="controls">
                                    <input type="text" id="ppk_pelayanan" name="ppk_pelayanan" class="span10 no-primary" value="{{ Config::get('settings.ppk_pelayanan'); }}">
									<input type="hidden" id="id_ppk_pelayanan" name="id_ppk_pelayanan" class="span10 no-primary" value="{{ Config::get('settings.id_ppk_pelayanan'); }}">
                                    <!--button class="btn btn-warning" id="btn_pelayanan" type="button"><i class="splashy-zoom"></i></button-->
                                </div>
                            </div>
						</div>
						<div class="span4">
                            <div class="control-group">
                                <label class="control-label">Jenis Pelayanan</label>
                                <div class="controls">
                                    <select name="jenis_pelayanan" id="jenis_pelayanan" class="span12 no-primary">
                                         @foreach($jenis_pelayanan as $j=>$k)
                                             <option value="{{ $k->KDJNSPEL }}">{{ $k->NMJNSPEL }}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
						<div class="span6">
                            <div class="control-group">
                                <label class="control-label">Poli</label>
                                <div class="controls">
                                    <input type="text" id="poli" name="poli" class="span10 no-primary">
									<input type="hidden" id="id_poli" name="id_poli" class="span10 no-primary">
                                    <button class="btn btn-warning" id="btn_poli" type="button"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Kelas Perawatan</label>
                                <div class="controls">
                                    <select name="kelas_rawat" id="kelas_rawat" class="span12 no-primary">
                                         @foreach($kelas_rawat as $a=>$b)
                                             <option value="{{ $b->KdKlsRwt }}">{{ $b->NmKlsRwt }}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
						</div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">         
                            <div class="control-group">
                                <label class="control-label">Diagnosa Awal</label>
                                <div class="controls">
                                    <input type="text" id="diagnosa" name="diagnosa" class="span10 no-primary">
									<input type="hidden" id="id_diagnosa" name="id_diagnosa" class="span10 no-primary">
                                    <button class="btn btn-warning" id="btn_diagnosa" type="button"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">         
                            <div class="control-group">
                                <label class="control-label">Catatan</label>
                                <div class="controls">
                                    <input type="text" id="catatan" name="catatan" class="span12">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">User</label>
                                <div class="controls">
                                    <input type="text" id="user" name="user" class="span12">
                                </div>
                            </div>
						</div>
						<div class="span4">
                            <div class="control-group">
                                <label class="control-label">No MR</label>
                                <div class="controls">
                                    <input type="text" id="no_mr" name="no_mr" class="span12">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid formsep">
                        <div class="span12">
                            <div align="center">
                                <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Buat</button>
                                <button id="reset" type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
	   	</div>
	</div>

    <div class="modal hide fade modal-admin" id="cari_diagnosa" tabindex="-1" role="dialog" aria-labelledby="cari_diagnosaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_diagnosaLabel">Daftar Diagnosa Awal</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_diagnosa" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                        </colgroup>
                        <thead>
                            <tr>
								<th align="center" valign="middle" class="head1">Pilih</th>
								<th align="center" valign="middle" class="head2">Kode Diagnosa</th>
                                <th align="center" valign="middle" class="head3">Deskripsi Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_diagnosa').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/diagnosaSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_diagnosa_filter input").focus();
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

    <div class="modal hide fade modal-admin" id="cari_poli" tabindex="-1" role="dialog" aria-labelledby="cari_poliLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_poliLabel">Daftar Poli</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_poli" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                        </colgroup>
                        <thead>
                            <tr>
								<th align="center" valign="middle" class="head1">Pilih</th>
								<th align="center" valign="middle" class="head2">Kode Poli</th>
                                <th align="center" valign="middle" class="head3">Nama Poli</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_poli').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/poliSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_poli_filter input").focus();
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

    <div class="modal hide fade modal-admin" id="cari_rujukan" tabindex="-1" role="dialog" aria-labelledby="cari_rujukanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_rujukanLabel">Daftar PPK Rujukan</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_rujukan" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                        </colgroup>
                        <thead>
                            <tr>
								<th align="center" valign="middle" class="head1">Pilih</th>
								<th align="center" valign="middle" class="head2">Kode Provider</th>
                                <th align="center" valign="middle" class="head3">Nama Provider</th>
                                <th align="center" valign="middle" class="head4">Alamat</th>
                                <th align="center" valign="middle" class="head5">Kota/ Kabupaten</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_rujukan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/ppkRujukanSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_rujukan_filter input").focus();
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

    <div class="modal hide fade modal-admin" id="cari_pelayanan" tabindex="-1" role="dialog" aria-labelledby="cari_pelayananLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pelayananLabel">Daftar PPK Pelayanan</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_pelayanan" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                        </colgroup>
                        <thead>
                            <tr>
								<th align="center" valign="middle" class="head1">Pilih</th>
								<th align="center" valign="middle" class="head2">Kode Provider</th>
                                <th align="center" valign="middle" class="head3">Nama Provider</th>
                                <th align="center" valign="middle" class="head4">Alamat</th>
                                <th align="center" valign="middle" class="head5">Kota/ Kabupaten</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                     /*   jQuery(document).ready(function(){
                            oTable = $('#tbl_pelayanan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/ppkPelayananSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_pelayanan_filter input").focus();
                                }
                                
                            });
                        }); */
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
            $('#simpan').click(function(){
                bikin_sep();
            });
			
            $('#reset').click(function(){
                reset_all_data();
            });
			
            $('#btn_diagnosa').click(function(){
                $('#cari_diagnosa').modal('show');
            });

            $('#cari_diagnosa').on('shown', function () {
                $("#tbl_diagnosa_filter input").focus();
            });
			
            $('#btn_poli').click(function(){
                $('#cari_poli').modal('show');
            });

            $('#cari_poli').on('shown', function () {
                $("#tbl_poli_filter input").focus();
            });
			
            $('#btn_rujukan').click(function(){
                $('#cari_rujukan').modal('show');
            });

            $('#cari_rujukan').on('shown', function () {
                $("#tbl_rujukan_filter input").focus();
            });
			
            $('#btn_pelayanan').click(function(){
                $('#cari_pelayanan').modal('show');
            });

            $('#cari_pelayanan').on('shown', function () {
                $("#tbl_pelayanan_filter input").focus();
            });
        });

        function reset_all_data(){
            $('#no_kartu').val('');
            //$('#tanggal_sep').val('');
            $('#tanggal_rujukan').val('0');
            $('#no_rujukan').val('');
            $('#ppk_rujukan').val('');
            //$('#ppk_pelayanan').val('');
            $('#jenis_pelayanan').val('');
            $('#catatan').val('');
            $('#diagnosa_awal').val('');
            $('#poli').val('');
            $('#kelas_rawat').val('');
            $('#user').val('');
            $('#no_mr').val('');
			$('#info').show();
			$('#pesan_error').hide();
		}
		   
        function pilih_diagnosa(id,nama){
			$('#id_diagnosa').val(id);
			$('#diagnosa').val(nama);
			$('#cari_diagnosa').modal('hide');
		}

        function pilih_poli(id,nama){
			$('#id_poli').val(id);
			$('#poli').val(nama);
			$('#cari_poli').modal('hide');
		}

        function pilih_ppk_rujukan(id,nama){
			$('#id_ppk_rujukan').val(id);
			$('#ppk_rujukan').val(nama);
			$('#cari_rujukan').modal('hide');
		}

        function pilih_ppk_pelayanan(id,nama){
			$('#id_ppk_pelayanan').val(id);
			$('#ppk_pelayanan').val(nama);
			$('#cari_pelayanan').modal('hide');
		}

        function bikin_sep(){
            var no_kartu = $('#no_kartu').val();
            var tanggal_sep = $('#tanggal_sep').val();
            var tanggal_rujukan = $('#tanggal_rujukan').val();
            var no_rujukan = $('#no_rujukan').val();
            var ppk_rujukan = $('#id_ppk_rujukan').val();
            var ppk_pelayanan = $('#id_ppk_pelayanan').val();
            var jenis_pelayanan = $('#jenis_pelayanan').val();
            var catatan = $('#catatan').val();
            var diagnosa_awal = $('#id_diagnosa').val();
            var poli = $('#id_poli').val();
            var kelas_rawat = $('#kelas_rawat').val();
            var user = $('#user').val();
            var no_mr = $('#no_mr').val();
			
            if(no_kartu == ''){
                cetak_alert('Nomor Kartu BPJS tidak boleh kosong');
                $('#no_kartu').focus();
            }
            else if(no_rujukan == ''){
                cetak_alert('Nomor Rujukan tidak boleh kosong');
                $('#no_rujukan').focus();
            }
            else{
                $.ajax({
                    url: "{{ url('sep/buat_proses') }}",
                    type: "POST",
                    data :  "no_kartu="+no_kartu+"&tanggal_sep="+tanggal_sep+"&tanggal_rujukan="+tanggal_rujukan+
							"&no_rujukan="+no_rujukan+"&ppk_rujukan="+ppk_rujukan+"&ppk_pelayanan="+ppk_pelayanan+
							"&jenis_pelayanan="+jenis_pelayanan+"&catatan="+catatan+"&diagnosa_awal="+diagnosa_awal+
							"&poli="+poli+"&kelas_rawat="+kelas_rawat+"&user="+user+"&no_mr="+no_mr,
                    success:function(res){
                        if(res != 'sukses'){
							$('#info').hide();
							var panjang = res;
		 					if (panjang.length > 19){
								cetak_alert(res);
							}
							else{
								cetak_alert('Pembuatan SEP Berhasil.<br />No SEP : '+res);
								//detail_sep(res);
							}
                        }
                        else{
							$('#info').hide();
                            cetak_alert(res);
                        }
                    }
                });
           }
        }

        function detail_sep(data){
           window.location.href = "detail_view/"+data;
        }

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }


    </script>
@stop