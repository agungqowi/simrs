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
        					<a href="{{ action('DokterController@index') }}">Dokter</a>
        				</li>
        				<li>
        					Edit Dokter
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Edit Dokter
                        <div style="float:right;" class="">
                            <a href="{{ URL::to('dokter') }}" class="btn btn-warning"><i class="splashy-zoom"></i> List Dokter</a>
                        </div>
                    </h3>
                    @if( $errors->first('txt_nama_dokter') )
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('txt_nama_dokter') }}
						</div>
	        		@endif
	        	</div>
	        	
	        	{{ Form::open( array('route' => array('dokter.update', $dokter->IdDokter), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                    <div class="row-fluid formSep">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input type="text" name="txt_nama_dokter" id="txt_nama_dokter" class="span10 no-primary" value="{{ $dokter->NamaDokter }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Kelamin<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="cmb_jenkel" id="cmb_jenkel" class="no-primary">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">No Telp<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="txt_no_telp" id="txt_no_telp" type="text" class="span10 no-primary" value="{{ $dokter->NoTelp }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Alamat<span class="f_req">*</span></label>
                                <div class="controls">
                                    <textarea name="txt_alamat" class="span10" id="txt_alamat"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Keterangan</label>
                                <div class="controls">
                                    <textarea name="txt_keterangan" class="span10" id="txt_keterangan">{{ $dokter->Keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Spesialisasi</label>
                                <div class="controls">
                                    <input name="txt_spesialisasi" id="txt_spesialisasi" type="text" class="span10 no-primary" value="{{ $dokter->Spesialisasi }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">NIP</label>
                                <div class="controls">
                                    <input name="txt_nrp" id="txt_nrp" type="text" class="span10 no-primary" value="{{ $dokter->NRP }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ URL::to('dokter') }}" class="btn">Batal</a>
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
        });
    </script>
@stop