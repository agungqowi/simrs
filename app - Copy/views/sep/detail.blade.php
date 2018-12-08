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
                            <a href="{{ url('sep/detail') }}">Data Peserta</a>
                        </li>
                        <li>
                             Detail SEP
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Detail Data Peserta SEP
                        </h3>
						<div id="pesan_error" class="alert alert-error" style="display:none; font-weight:bold;">

						</div>
                        <br />
                        {{ Form::open(array('url' => 'sep/detail_view/sep', 'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6"> 
                                <div class="control-group">
                                    <label class="control-label">No SEP</label>
                                    <div class="controls">
                                        <input type="text" name="nomor" id="nomor" class="span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="button" id="btn_preview" class="btn btn-inverse no-primary"><i class="splashy-check"></i> Preview</button>
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
@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn_preview').click(function(){
                do_proses();
            })
        });

        function do_proses(){
		 	var nomor = $('#nomor').val();
		 	if (nomor.length < 19){
		   		cetak_alert('Data yang anda masukkan salah, mohon ulangi kembali');
				$('#nomor').focus();
				setTimeout(function(){$("#pesan_error").hide()}, 4000)
		 	}
            else{
                $('#reg1_form').submit();
            }
        }
		
         function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }

   </script>
@stop
