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
                            <a href="{{ action('DashboardController@index') }}">Kasir</a>
                        </li>
                        <li>
                            Pembayaran
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Pembayaran
                        <div style="float:right;">
                            <a href="{{ URL::to('dp/create') }}" class="btn btn-success"><i class="splashy-contact_grey_add"></i> Tambah Baru Pembayaran</a>

                            <a href="{{ URL::to('deposit') }}" class="btn btn-primary"><i class="splashy-view_outline_detail"></i> Daftar Pembayaran</a>
                        </div>
                    </h3>

                    <?php $error = Session::get('error'); ?>
                    @if(isset($error))
                    <div id="pesan_error" class="alert alert-error">
                        {{ $error }}
                    </div>
                    @endif

                    <?php $success = Session::get('success'); ?>
                    @if( Session::get('success') )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif

                    <div class="row-fluid">
                        <div class="span12">
                            
                        </div>
                    </div>
                    <br />
                    {{ Form::open(array('url' => 'billing/dp' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid formSep">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No Reg</label>
                                <div class="controls">
                                    <input type="text" name="no_reg" id="no_reg" class="span5" readonly value="{{ $data->no_reg }}">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cari_pasien"><i class="splashy-zoom"></i> Cari Pasien</button>
                                </div>
                            </div> 
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input type="text" name="no_rm" id="no_rm" class="span5" readonly value="{{ $data->no_rm }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" name="txt_nama" id="txt_nama" class="span10 no-primary" readonly value="{{ $data->nama }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Pasien</label>
                                <div class="controls">
                                    <input type="text" name="txt_jenis_pasien" id="txt_jenis_pasien" class="span10 no-primary" readonly value="{{ $data->jenis_pasien }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" id="txt_tanggal_masuk" name="txt_tanggal_masuk" class="span10 no-primary" readonly value="{{ $data->tanggal_masuk }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Deposit / DP</label>
                                <div class="controls">
                                    <input type="text" id="tanggal_bayar" name="tanggal_bayar" class="span10 no-primary cruddate" value="{{ $data->tanggal_deposit }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Metode Pembayaran</label>
                                <div class="controls">
                                    <select name="metode_pembayaran" id="metode_pembayaran">
                                        <option value="">-</option>
                                        @if(isset($metode) && count($metode) > 0)                                            
                                            @foreach($metode as $m)
                                                <?php $selected = ""; ?>
                                                @if($m->metode_pembayaran == $data->metode_pembayaran)
                                                    <?php $selected = "selected='selected'"; ?>
                                                @endif
                                                <option {{ $selected }} value="{{ $m->metode_pembayaran }}">{{ $m->metode_pembayaran }}</option>
                                            @endforeach
                                        @endif                                        
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jumlah Deposit / DP</label>
                                <div class="controls">
                                    <input type="text" name="jumlah" id="jumlah" class="span10 no-primary" value="{{ $data->jumlah }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Keterangan</label>
                                <div class="controls">
                                    <textarea name="keterangan" id="keterangan" class="span10 no-primary">{{ $data->keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                <input type="hidden" name="no_id" id="no_id" value="{{ $no_id }}">
                                <button type="submit" id="btn_pasien_rawat" class="btn btn-inverse no-primary">
                                    <i class="splashy-check"></i> Simpan
                                </button>
                                @if($no_id != 0)
                                    <a type="button" id="btn_cetak" class="btn btn-primary no-primary" href="{{ URL::to('deposit/print/'.$no_id) }}">
                                        <i class="splashy-printer"></i> Cetak
                                    </a>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            
                        </div>
                    </div>
                    {{ Form::close() }}

                    {{ Form::open(array('url' => '' , 'id'=>'reg2_form', 'class' => 'form-horizontal' , 'style' => 'display:none')) }}
                    <div class="row-fluid">
                        <div class="span5"> 
                        </div>
                    </div>
                    {{ Form::close() }}
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
                                <col class="con6" />
                                <col class="con7" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal Masuk</th>
                                    <th align="center" valign="middle" class="head4">Ruangan</th>
                                    <th align="center" valign="middle" class="head5">Kelas</th>
                                    <th align="center" valign="middle" class="head6">No Kamar</th>
                                    <th align="center" valign="middle" class="head7">No Reg</th>
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
                                    "sAjaxSource": "{{ url('rawat_inap/datatablebelumpulang/all' ) }}",
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

        function pilih_pasien(no_rm,id_reg,nama,tanggal_masuk,tanggal_keluar,jenis_pasien){
            $('#no_rm').val(no_rm);
            $('#no_reg').val(id_reg);
            $('#txt_nama').val(nama);
            $('#txt_tanggal_masuk').val(tanggal_masuk);
            $('#txt_tanggal_keluar').val(tanggal_keluar);
            $('#txt_jenis_pasien').val(jenis_pasien);
            $('#cari_pasien').modal('hide');
            $('#btn_pasien_rawat').attr('disabled',false);
        }
    </script>
@stop
