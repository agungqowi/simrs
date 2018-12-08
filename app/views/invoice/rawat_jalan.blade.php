@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
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
                            <a href="{{ action('DashboardController@index') }}">Pembayaran</a>
                        </li>
                        <li>
                            Rawat Jalan
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Biaya Rawat Jalan
                        </h3>
                        @if( $errors->first('title') || $errors->first('note') )
                            <div class="alert alert-error">
                                <a class="close" data-dismiss="alert">×</a>
                                {{ $errors->first('title') }}
                                {{ $errors->first('note') }}
                            </div>
                        @endif

                        <div class="row-fluid">
                            <div class="span12">
                                
                            </div>
                        </div>
                        <br />
                        {{ Form::open(array('url' => 'billing/rawat_jalan_post' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6"> 
                                <div class="control-group">
                                    <label class="control-label">No RM</label>
                                    <div class="controls">
                                        <input readonly type="text" id="no_rm" class="span6">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#cari_pasien"><i class="splashy-zoom"></i> Cari Pasien</button>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">No Reg</label>
                                    <div class="controls">
                                        <input readonly type="text" name="no_reg" id="no_reg" class="span10">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Nama Lengkap</label>
                                    <div class="controls">
                                        <input readonly type="text" name="nama" id="txt_nama" class="span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Poli</label>
                                    <div class="controls">
                                        <input readonly type="text" name="txt_poli" id="txt_poli" class="span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tanggal</label>
                                    <div class="controls">
                                        <input readonly type="text" name="tanggal" id="txt_tanggal" class="span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Cetak Obat</label>
                                    <div class="controls">
                                        <select name="cetak_obat" id="cetak_obat">
                                            <option value="total">Total Saja</option>
                                            <option value="semua">Semua obat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button disabled="disabled" type="submit" id="btn_pasien_rawat" class="btn btn-inverse no-primary"><i class="splashy-check"></i> Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
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
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal</th>
                                    <th align="center" valign="middle" class="head4">Poli</th>
                                    <th align="center" valign="middle" class="head4">No Reg</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <?php $uname = ucfirst($user->username); ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_pasien').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('rawat_jalan/datatable_keluar' ) }}",
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
@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
        });

        function pilih_pasien(no_rm,id_reg,nama,poli,tanggal){
            $('#no_rm').val(no_rm);
            $('#no_reg').val(id_reg);
            $('#txt_nama').val(nama);
            $('#txt_poli').val(poli);
            $('#txt_tanggal').val(tanggal);

            $('#cari_pasien').modal('hide');
            $('#btn_pasien_rawat').attr('disabled',false);
        }
    </script>
@stop
