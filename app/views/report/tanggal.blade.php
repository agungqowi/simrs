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
                            <a href="{{ action('DashboardController@index') }}">Laporan</a>
                        </li>
                        <li>
                            {{ ucfirst( $target ) }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan {{ ucfirst( $target ) }}
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
                        {{ Form::open(array('url' => 'report/'.$target ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6"> 
                                <div class="control-group">
                                    <label class="control-label">Dari tanggal</label>
                                    <div class="controls">
                                        <input type="text" name="dari_tanggal" id="dari_tanggal" class="date span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Sampai tanggal</label>
                                    <div class="controls">
                                        <input type="text" name="sampai_tanggal" id="sampai_tanggal" class="date span10 no-primary">
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
            var dari_tanggal = $('#dari_tanggal').val();
            var sampai_tanggal = $('#sampai_tanggal').val();
            if( dari_tanggal==''){
                $('#dari_tanggal').focus();
            }
            else if(sampai_tanggal=='' ){
                $('#sampai_tanggal').focus();
            }
            else{
                $('#reg1_form').submit();
            }
        }
    </script>
@stop
