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
                            <a href="{{ url('sep/rujukan/daftar_pasien') }}">Data Peserta</a>
                        </li>
                        <li>
                            Rujukan
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Data Peserta Rujukan per Tanggal
                        </h3>
                        @if( $errors->first('title') || $errors->first('note') )
                            <div class="alert alert-error">
                                <a class="close" data-dismiss="alert">×</a>
                                {{ $errors->first('title') }}
                                {{ $errors->first('note') }}
                            </div>
                        @endif
						<div id="pesan_error" class="alert alert-error" style="display:none; font-weight:bold;">
							
						</div>
                        <br />
                        {{ Form::open(array('url' => 'sep/rujukan/daftar_pasien_view' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span8"> 
                                <div class="control-group">
                                    <label class="control-label">Tanggal Rujukan</label>
                                    <div class="controls">
                                        <input type="text" name="tanggal" id="tanggal" class="date span6 no-primary">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Banyak Data yang ditampilkan</label>
                                    <div class="controls">
                                        <input type="text" name="jumlah" id="jumlah" class="span6 no-primary">
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
		 	var jumlah = $('#jumlah').val();
            var tanggal = $('#tanggal').val()

		 	if(jumlah == ''){
		   		cetak_alert('Jumlah Data yang akan ditampilkan tidak boleh kosong');
				$('#jumlah').focus();
				setTimeout(function(){$("#pesan_error").hide()}, 4000);
		 	}
            else if(tanggal == ''){
                cetak_alert('Tanggal Rujukan tidak boleh kosong');
                $('#tanggal').focus();
				setTimeout(function(){$("#pesan_error").hide()}, 4000);
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
