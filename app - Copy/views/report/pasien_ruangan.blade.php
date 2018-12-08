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
                            <a href="{{ url('report/pasien_ruangan') }}">Laporan</a>
                        </li>
                        <li>
                            Pasien Rawat Inap
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Pasien Rawat Inap
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
                        {{ Form::open(array('url' => 'report/pasien_ruangan_view' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6">
                                <div class="control-group">
                                    @if($single == 'true') 
                                        style="display:none" 
                                    @endif
                                
                                    <label class="control-label">Ruangan</label>
                                    <div class="controls">
                                        <select name="ruangan" id="ruangan">
                                            @if($single == 'true')
                                                @if(isset($ruangan->NamaRuangan))
                                                    <option value="{{ $ruangan->NamaRuangan }}">{{ $ruangan->NamaRuangan }}</option>
                                                @endif
                                            @else
                                                <option value="all">-Semua Ruangan-</option>
                                                @foreach($ruangan as $r)
                                                    <option value="{{ $r->NamaRuangan }}">{{ $r->NamaRuangan }}</option>
                                                @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="button" id="btn_preview" class="btn btn-inverse no-primary"><i class="splashy-check"></i> Proses</button>
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
			var tanggal_awal = $('#dari_tanggal').val();
            $('#btn_preview').click(function(){
				$('#label_dari').hide();
				$('#label_sampai').hide();
                do_proses();
            });
            $('#Radio1').click(function(){
                $('#sampai').hide();
				$('#dari').html('Tanggal');
            });
            $('#Radio2').click(function(){
                $('#sampai').show();
				$('#dari').html('Dari Tanggal');
				$('#sampai_tanggal').val('');
            });
        });
        
        function do_proses(){
            $('#reg1_form').submit();
       }
    </script>
@stop
