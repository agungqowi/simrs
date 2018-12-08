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
                            <a href="{{ url('sep/update_norm') }}">Update Nomor SEP</a>
                        </li>
                        <li>
                            SEP
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Update Nomor SEP
                        <div class="cari-group">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#cari_rawat_inap"><i class="splashy-zoom"></i> Rawat Inap</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#cari_rawat_jalan"><i class="splashy-zoom"></i> Rawat Jalan</button>
                        </div>
                    </h3>
                    <div id="pesan_error" class="alert alert-info" style="display:none;font-weight:bold;"></div>
					@if( $pesan != '' )
						<div id="" class="alert alert-error" style="font-weight:bold">{{ $pesan }}</div>
					@endif
	        	</div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input type="text" id="no_rm" name="no_rm" readonly class="span5">
                                </div>
                            </div>
						</div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Nama</label>
                                <div class="controls">
                                    <input type="text" id="nama" name="nama" readonly class="span5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Tanggal masuk</label>
                                <div class="controls">
                                    <input type="text" id="tanggal" name="tanggal" readonly class="span5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Jenis Pelayanan</label>
                                <div class="controls">
                                    <input type="text" id="jenis_pelayanan" name="jenis_pelayanan" readonly class="span5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Poli</label>
                                <div class="controls">
                                    <input type="text" id="poli" name="jenis_pelayanan" readonly class="span5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Ruangan</label>
                                <div class="controls">
                                    <input type="text" id="ruangan" name="jenis_pelayanan" readonly class="span5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">No SEP</label>
                                <div class="controls">
                                    <input type="text" id="no_sep" name="no_sep" class="span5">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#cari_sep"><i class="splashy-zoom"></i> SEP</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">No Kartu BPJS</label>
                                <div class="controls">
                                    <input type="text" id="no_kartu" name="no_kartu" readonly class="span5">
                                </div>
                            </div>
                        </div>
                    </div>

					<input type="hidden" id="id_reg" name="id_reg" class="span10 no-primary" value="">
                                
                    <div class="row-fluid formsep">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="controls">
                                <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                <button id="reset" type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Reset</button>
                                </div>
                            </div>
						</div>
                    </div>
                {{ Form::close() }}
	   	</div>
	</div>

        <div class="modal hide fade modal-admin" id="cari_rawat_inap" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_pasien_inap" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                                <col class="con5" />
                                <col class="con6" />
                                <col class="con7" />
                                <col class="con8" />
                                <col class="con9" />
                                <col class="con10" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal</th>
                                    <th align="center" valign="middle" class="head4">Ruangan</th>
                                    <th align="center" valign="middle" class="head5">Kelas</th>
                                    <th align="center" valign="middle" class="head6">No Kamar</th>
                                    <th align="center" valign="middle" class="head7">NoReg</th>
                                    <th align="center" valign="middle" class="head8">Sep</th>
                                    <th align="center" valign="middle" class="head9">Gol Pasien</th>
                                    <th align="center" valign="middle" class="head10">No BPJS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_pasien_inap').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('rawat_inap/popup_table_full') }}",
                                    "bServerSide": true
                                
                                });
                            // custom values are available via $values array
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
        <div class="modal hide fade modal-admin" id="cari_rawat_jalan" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_pasien_jalan" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
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
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal Masuk</th>
                                    <th align="center" valign="middle" class="head4">Poli</th>
                                    <th align="center" valign="middle" class="head5">No Reg</th>
                                    <th align="center" valign="middle" class="head6">Sep</th>
                                    <th align="center" valign="middle" class="head7">Gol Pasien</th>
                                    <th align="center" valign="middle" class="head8">No BPJS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_pasien_jalan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('rawat_jalan/popup_table_full') }}",
                                    "bServerSide": true
                                
                                });
                            // custom values are available via $values array
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
        <div class="modal hide fade modal-admin" id="cari_sep" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian SEP</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_sep" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                                <col class="con5" />
                                <col class="con6" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">No SEP</th>
                                    <th align="center" valign="middle" class="head2">Tanggal SEP</th>
                                    <th align="center" valign="middle" class="head3">Tanggal Pulang</th>
                                    <th align="center" valign="middle" class="head4">Jenis Pelayanan</th>
                                    <th align="center" valign="middle" class="head5">Kode Poli</th>
                                    <th align="center" valign="middle" class="head6">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        var oTable;
        $(document).ready(function() {
            $('#simpan').click(function(){
                update_sep();
            });
            $('#reset').click(function(){
                reset_all_data();
            });
        });

        function reset_all_data(){
            $('#no_sep').val('');
            $('#tanggal_pulang').val('');
            $('#ppk_pelayanan').val('');
			$('#pesan_error').hide();
		}
		
        function update_sep(){
            var no_reg = $('#id_reg').val();
            var sep = $('#no_sep').val();
            var jenis_pelayanan = $('#jenis_pelayanan').val();
            cetak_alert('Mohon tunggu, data sedang di proses');
            $.ajax({
                url: "{{ url('sep/update_sep') }}",
                type: "POST",
                data : "no_reg="+no_reg+"&sep="+sep+"&jenis_pelayanan="+jenis_pelayanan,
                success:function(res){
                    if(res == 0){
                        cetak_alert('Update SEP Gagal, tidak ada data baru yang diupdate');
                    }
                    else{
                        
                        cetak_alert('Update SEP Berhasil');
                    }
                    //alert('Pasien berhasil dipulangkan');
                    
                }
            });
        }

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }

        function pasien_find(val,opt){
            if(opt == 'jalan'){
                target_url = "{{ url('rest/rawat_jalan_byreg') }}";
            }
            else if(opt == 'ugd'){
                target_url = "{{ url('rest/ugd_byreg') }}";
            }
            else {
                target_url = "{{ url('rest/rawat_inap_byreg') }}";
            }
            $.ajax({
                url: target_url+'/'+val,
                dataType: "json",
                success: function(res){
                    if(res == false)
                        alert('Data pasien tidak ditemukan');
                    else{
                        $('#no_rm').val(res[0].NoRM);
                        $('#nama').val(res[0].Nama);
                        if( res[0].Tanggal != '' || res[0].Tanggal != '-'){
                            var _tglArray = res[0].Tanggal.split("-");
                            $('#tanggal').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
                        }
                        else{
                            $('#tanggal').val(' ');
                        }
                        if(opt == 'jalan'){
                            $('#id_reg').val(res[0].NoRegJalan);
                            $('#jenis_pelayanan').val('Rawat Jalan');
                            $('#poli').val(res[0].Poli);
                            $('#ruangan').val('-');        
                        }
                        else if(opt == 'ugd'){
                            $('#id_reg').val(res[0].NoRegUGD);
                            $('#jenis_pelayanan').val('UGD'); 
                            $('#poli').val('-');
                            $('#ruangan').val('-');         
                        }
                        else{
                            $('#id_reg').val(res[0].NoReg);
                            $('#jenis_pelayanan').val('Rawat Inap');
                            $('#poli').val('-');
                            $('#ruangan').val(res[0].Ruangan);          
                        }
                        

                        $('#no_kartu').val(res[0].NoBPJS);
                        $('#no_sep').val(res[0].Sep);

                        sepList(res[0].NoBPJS);
                    }
                },
                error:function(res){
                    alert('Connection failed');
                }
            })
        }

        function sepList(val){
            $('#tbl_sep tbody').html('<tr><td align="center" colspan="7">Mohon tunggu, data sedang di proses</td></tr>');
             $.ajax({
                url: "{{ url('api/sep/list') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    if(res == ''){
                        $('#tbl_sep tbody').html('<tr><td align="center" colspan="7">Data SEP tidak ditemukan</td></tr>');
                    }
                    else{
                        $('#tbl_sep tbody').html('');
                        $.each(res, function (key, data) {
                            if(data.JNSPELSJP == '1'){
                                _jenis = "Rawat Inap";
                            }
                            else{
                                _jenis = 'Rawat Jalan';
                            }
                            $('#tbl_sep tbody').append('<tr>'+
                                '<td><a href="javascript:void(0)" onclick="inputSep('+"'"+data.NOSJP+"'"+')" class="btn btn-primary">Pilih</a></td>'+
                                '<td>'+data.NOSJP+'</td>'+
                                '<td>'+data.TGLSJP+'</td>'+
                                '<td>'+data.TGLPLGSJP+'</td>'+
                                '<td>'+_jenis+'</td>'+
                                '<td>'+data.POLITUJSJP+'</td>'+
                                '<td>'+data.CATKHSSJP+'</td>'+
                                '</tr>');
                        });
                    }
                    
                },
                error:function(res){
                    $('#tbl_sep tbody').html('<tr><td align="center" colspan="7">Timeout. Data SEP tidak ditemukan</td></tr>');
                }
            });
        }

        function inputSep(vas){
            $('#no_sep').val(vas);
            $('#cari_sep').modal('hide');
        }

        function pilih_pasien(id,opt){
            if(opt == 'ugd'){
                $('#cari_ugd').modal('hide');
            }
            else if(opt=='jalan'){
                $('#cari_rawat_jalan').modal('hide');
            }
            else{
                $('#cari_rawat_inap').modal('hide');
                $('#no_rm').val(id);
            }
            
            pasien_find(id,opt);
        }


    </script>
@stop