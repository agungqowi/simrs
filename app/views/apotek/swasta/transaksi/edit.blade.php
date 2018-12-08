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
                            <a href="{{ action('AskesObatController@index') }}">Apotek</a>
                        </li>
                        <li>
                            <a href="{{ action('AskesObatController@index') }}">Askes</a>
                        </li>
                        <li>
                            <a href="{{ action('AskesObatController@index') }}">Obat</a>
                        </li>
                        <li>
                            Edit
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Edit Obat Askes
                        <div style="float:right;" class="">
                            <a href="{{ URL::to('askes_obat') }}" class="btn btn-warning"><i class="splashy-zoom"></i> List Obat</a>
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
	        	</div>
	        	
	        	{{ Form::open( array('route' => array('askes_obat.update', $obat->kodobat), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                    <div class="row-fluid formSep">
                        <div class="span6">              
                            <div class="control-group">
                                <label class="control-label">Nama Obat<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="nama_obat" id="nama_obat" type="text" class="span10 no-primary" value="{{ $obat->namaobat }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Obat<span class="f_req">*</span></label>
                                <div class="controls">
                                    <select name="jenis_obat" id="jenis_obat" class="no-primary">
                                        @foreach($jenis_obat as $j=>$k)
                                            <option value="{{ $k->kodejenis }}">{{ $k->namajenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Komposisi<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="komposisi" id="komposisi" type="text" class="span10 no-primary" value="{{ $obat->komposisi }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Satuan<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="satuan" id="satuan" type="text" class="span10 no-primary" value="{{ $obat->satuan }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Harga<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="harga" id="harga" type="text" class="span10 no-primary" value="{{ $obat->harga }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Masa<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="masa" id="masa" type="text" class="span10 no-primary tanggal" value="{{ date( 'd/m/Y', strtotime($obat->masa) ) }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Stok<span class="f_req">*</span></label>
                                <div class="controls">
                                    <input name="stok" id="stok" type="text" class="span10 no-primary" value="{{ $obat->stok }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ url('askes_obat') }}" class="btn">Batal</a>
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