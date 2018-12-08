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
                            <a href="{{ url('tindakan') }}">Tindakan</a>
                        </li>
                        <li>
                            Edit Tindakan
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Edit Tindakan
                        <div style="float:right;" class="">
                            <a href="{{ URL::to('tindakan') }}" class="btn btn-warning"><i class="splashy-zoom"></i> List Tindakan</a>
                        </div>
                    </h3>
                    <?php $validation=array('jenis_tindakan' , 'kelompok' , 'tarif'); ?>
                    @foreach($validation as $v)
                        @if( $errors->first($v) )
                            <div class="alert alert-error">
                                <a class="close" data-dismiss="alert">×</a>
                                {{ $errors->first($v) }}
                            </div>
                        @endif
                    @endforeach
                </div>
                {{ Form::open( array('route' => array('tindakan.update', $tindakan->IdTindakan), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                    <div class="row-fluid formSep">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Jenis Tindakan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" name="jenis_tindakan" id="jenis_tindakan" class="span10 no-primary" value="{{ $tindakan->Tindakan }}">
                                </div>
                            </div>  
                            <div class="control-group">
                                <label class="control-label">Golongan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="golongan" id="golongan" class="no-primary">
                                        <option>UGD</option>
                                        <option>BEDAH</option>
                                        <option>OK</option>
                                        <option>GIGI</option>
                                        <option>THT</option>
                                        <option>KULKEL</option>
                                        <option>SYARAF</option>
                                        <option>JIWA</option>
                                        <option>MATA</option>
                                        <option>RADIOLOGI</option>
                                        <option>LAB</option>
                                        <option>KEBIDANAN</option>
                                        <option>PENYAKIT DALAM</option>
                                        <option>GIZI</option>
                                        <option>FISIOTERAPI</option>
                                        <option>UNIT STROKE</option>
                                        <option>PERINATOLOGI</option>
                                        <option>Rawat Inap</option>
                                        <option>PA</option>
                                        <option>Alat</option>
                                        <option>Rumah Duka</option>
                                        <option>Umum</option>
                                        <option>Surat</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="golongan_hide" value="{{ $tindakan->Gol }}" >
                            <div class="control-group">
                                <label class="control-label">Kelompok<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="kelompok" id="kelompok" type="text" class="span10 no-primary" value="{{ $tindakan->Kel }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tarif<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="tarif" id="tarif" type="text" class="span10 no-primary" value="{{ $tindakan->Tarif }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ url('tindakan') }}" class="btn">Batal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
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

            var _val = $('#golongan_hide').val();
            $('#golongan').val(_val);
        });
    </script>
@stop