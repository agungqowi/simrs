@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
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
                            <a href="{{ action('DashboardController@index') }}">
                                @if(isset($parent))
                                    {{ $parent }}
                                @else
                                    Penunjang
                                @endif
                            </a>
                        </li>
                        <li>
                            @if(isset($title))
                                {{ $title }}
                            @else
                                Laboratorium
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Form 
                            @if(isset($title))
                                {{ $title }}
                            @else
                                Laboratorium
                            @endif
                    </h3>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
                        </div>
                    @endif
                    
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="no_reg" id="no_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <input type="hidden" name="opt" id="opt" value="" />
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input type="text" id="no_rm" name="txt_no_rm" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" id="txt_nama" name="txt_nama" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <div class="controls">
                                    <select id="cmb_jenkel" name="cmb_jenkel" class="no-primary">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" id="txt_tanggal_masuk" name="txt_tanggal_masuk" class="tanggal span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <div class="controls">
                                    <input type="text" id="txt_tanggal_lahir" name="txt_tanggal_lahir" class="tanggal span10 no-primary">
                                </div>
                            </div>
                            
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No Registrasi</label>
                                <div class="controls">
                                    <input type="text" id="temp_reg" name="temp_reg" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Alamat</label>
                                <div class="controls">
                                    <textarea id="txt_alamat" name="txt_alamat" class="span10 no-primary"> </textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Golongan Pasien</label>
                                <div class="controls">
                                    <input type="text" id="cmb_golongan_pasien" name="cmb_golongan_pasien" class="span10 no-primary">
                                </div>
                            </div>
                            <div id="poli_group" class="control-group opt-group">
                                <label class="control-label">Poli</label>
                                <div class="controls">
                                    <input type="text" id="txt_poli" name="txt_poli" class="span10 no-primary">
                                </div>
                            </div>
                            <div id="ruangan_group" class="control-group opt-group">
                                <label class="control-label">Ruangan</label>
                                <div class="controls">
                                    <input type="text" id="txt_ruangan" name="txt_ruangan" class="span10 no-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#hasiltab" data-toggle="tab">Hasil Lab</a></li>
                                    <li><a href="#tindakantab" data-toggle="tab">Tindakan</a></li>
                                    <li><a href="#diagnosatab" data-toggle="tab">Diagnosa</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="hasiltab">
                                        <h4>Hasil Tes Laboratorium</h4>
                                        <form class="form-horizontal" method="POST" action="" id="form_hasil" name="form_hasil">
                                        <input type="hidden" name="id_lab" id="id_lab" value="" />
                                        <div>
                                            <div class="control-group">
                                                <label class="control-label">Tanggal</label>
                                                <div class="controls">
                                                <input type="text" name="hasil_tanggal" id="hasil_tanggal" class="cruddate">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Jam</label>
                                                <div class="controls">
                                                <input type="text" class="jam" id="hasil_jam" name="hasil_jam" >

                                                </div>
                                            </div><br />
                                            <div class="control-group">
                                                <label class="control-label">Pemeriksaan</label>
                                                <div class="controls">
                                                    <div id="hasil_container">
                                                        <button id="btn_pemeriksaan_baru" type="button" class="btn btn-primary"><i class="splashy-application_windows_add"></i>Tambah Pemeriksaan</button>
                                                        <div class="pemeriksaan-baru">
                                                            <select class="select2" id="select_pemeriksaan">
                                                                <?php $pmr  = DB::table('lab_pemeriksaan')->where('pemeriksaan','1')->orderBy('nama_jasa',"ASC")->get(); ?>
                                                                <option value="0">-Pilih pemeriksaan-</option>
                                                                @if( isset($pmr) && count($pmr) > 0 )
                                                                    @foreach($pmr as $pm)
                                                                        <option value="{{ $pm->kode_jasa }}">{{ $pm->nama_jasa }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <button id="btn_tambah_pemeriksaan" type="button" class="btn btn-success"><i class="splashy-application_windows_add"></i>Tambah</button>
                                                        </div>
                                                        <table id="table_hasil" class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Nama Pemeriksaan</th>
                                                            <th>Hasil</th>
                                                            <th>Satuan</th>
                                                            <th>Rujukan</th>
                                                            <th>Keterangan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div><br />
                                            <div class="control-group">
                                                <label class="control-label">Dokter</label>
                                                <div class="controls">
                                                    <input type="hidden" id="id_dokter" name="id_dokter">
                                                    <input type="text" name="txt_pilih_dokter" id="txt_pilih_dokter" readonly="readonly" class="span5">
                                                    <button type="button" id="btn_dokter_tambah" data-toggle="modal" data-target="#cari_dokter" class="btn btn-success extra-fields" disabled="disabled">...</button>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Pemeriksa</label>
                                                <div class="controls">
                                                    <select name="pemeriksa" id="pemeriksa">
                                                        <option value="0">-</option>
                                                        <?php $pemeriksa    = DB::table('lab_operator')->get(); ?>
                                                        @if( isset($pemeriksa) && count($pemeriksa) > 0 )
                                                            @foreach($pemeriksa as $o)
                                                                <option value="{{ $o->id }}">{{ $o->Nama }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Kesimpulan</label>
                                                <div class="controls">
                                                    <textarea class="span10" id="kesimpulan" name="kesimpulan"></textarea>
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin-top:20px">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <button type="button" class="btn btn-primary extra-fields" disabled="disabled" id="btn_hasil_simpan"><i class="splashy-check"></i> Simpan</button>
                                                    @if(isset($id))
                                                        <?php $url_cetak = url('lab/cetak/'.$id); $target = "_BLANK"; ?>
                                                    @else
                                                        <?php $url_cetak = ""; $target = ""; ?>
                                                    @endif
                                                    <a href="{{ $url_cetak }}" target="{{ $target }}" class="btn btn-warning extra-fields" disabled="disabled" id="btn_cetak_lab"><i class="splashy-printer"></i> Cetak</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <br />
                                        <div>
                                            <input type="hidden" id="hasil_noreg" name="hasil_noreg" />
                                            <input type="hidden" id="hasil_norm" name="hasil_norm" />
                                            <input type="hidden" id="hasil_nama" name="hasil_nama" />
                                            
                                        </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tindakantab">
                                        <div>
                                            <button type="button" id="btn_tindakan_pilih" data-toggle="modal" data-target="#cari_tindakan" class="btn btn-success extra-fields" disabled="disabled">Tambah Tindakan</button>
                                                
                                        </div> <br />
                                        <H3>Daftar Tindakan</H3>
                                        <table id="tindakan_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Tindakan</th>
                                                    <th>Tanggal</th>
                                                    <th>Gol</th>
                                                    <th>Jenis Rawat</th>
                                                    <th>x</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="diagnosatab">
                                        {{ Form::open(array('url' => '' , 'id'=>'diagnosa_form', 'class' => 'form-horizontal')) }}
                                        <div>
                                            <div class="control-group">
                                                <label class="control-label">Pilih Diagnosa</label>
                                                <div class="controls">
                                                    <input type="text" id="id_diagnosa" disabled="disabled" size="6" style="width:70px">
                                                    <input type="text" name="txt_pilih_diagnosa" id="txt_pilih_diagnosa" disabled="disabled" class="span5">
                                                    <button type="button" id="btn_diagnosa_tambah" data-toggle="modal" data-target="#cari_diagnosa" class="btn btn-success extra-fields" disabled="disabled">...</button>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Tanggal Diagnosa</label>
                                                <div class="controls">
                                                    <input type="text" name="tanggal_diagnosa" id="tanggal_diagnosa" class="nowdate">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Status</label>
                                                <div class="controls">
                                                    <select id="status_diagnosa">
                                                        <option value="">-</option>
                                                        <option value="Diagnosa Awal">Diagnosa Awal</option>
                                                        <option value="Diagnosa Akhir">Diagnosa Akhir</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" id="long_diagnosa">
                                            <div class="control-group">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <button type="button" id="btn_diagnosa_simpan" onclick="tambah_diagnosa()" class="btn btn-success extra-fields" disabled="disabled">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <table id="diagnosa_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID Diagnosis</th>
                                                    <th>Keterangan</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                    <th>Jenis Rawat</th>
                                                    <th>x</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
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
                                    <th align="center" valign="middle" class="head8">Jalan</th>
                                    <th align="center" valign="middle" class="head9">Kelurahan</th>
                                    <th align="center" valign="middle" class="head10">Kota / Kab</th>
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
                                    "sAjaxSource": "{{ url('rawat_inap/popup_table_byreg') }}",
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
                                    <th align="center" valign="middle" class="head4">Poli</th
                                    <th align="center" valign="middle" class="head6">Jalan</th>
                                    <th align="center" valign="middle" class="head7">Kelurahan</th>
                                    <th align="center" valign="middle" class="head8">Kota / Kab</th>
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
                                    "sAjaxSource": "{{ url('rawat_jalan/popup_table_byreg') }}",
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
        <div class="modal hide fade" id="cari_dokter" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Dokter</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_dokter" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">Nama Dokter</th>
                                    <th align="center" valign="middle" class="head2">Spesialisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_dokter').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('dokter/simpletable') }}",
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
        <div class="modal hide fade modal-admin" id="cari_tindakan" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Tambah Tindakan</h4>
                    </div>
                    <div class="modal-body">
                        <div id="tindakan_message" class="alert"><div class="content"></div></div>
                        <div class="control-group">
                            <span>Tanggal</span>
                            <input type="text" class="nowdate" id="txt_tanggal_tindakan" name="txt_tanggal_tindakan" />
                        </div>
                        <table id="tbl_tindakan" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                                <col class="con5" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">IdTindak</th>
                                    <th align="center" valign="middle" class="head2">Tindakan</th>
                                    <th align="center" valign="middle" class="head3">Gol</th>
                                    <th align="center" valign="middle" class="head4">Kel</th>
                                    <th align="center" valign="middle" class="head4">Tarif</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                
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

        <div class="modal hide fade" id="cari_diagnosa" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Diagnosa</h4>
                    </div>
                    <div class="modal-body">
                        <table id="tbl_diagnosa" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">Id Diagnosis</th>
                                    <th align="center" valign="middle" class="head2">Short Diagnosis Desc</th>
                                    <th align="center" valign="middle" class="head3">Long Diagnosis Desc</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_diagnosa').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('diagnosa/simpletable') }}",
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

@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    @include('js/laboratorium')
    
    <script type="text/javascript">
    jQuery(document).ready(function($){
        
    });
    </script>
@stop