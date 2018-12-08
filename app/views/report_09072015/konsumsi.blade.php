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
                            <a href="{{ url('report/konsumsi') }}">Laporan</a>
                        </li>
                        <li>
                            Konsumsi Pasien
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Konsumsi Harian Pasien
                        </h3>
                        <div class="row-fluid">
                            <div class="span12">
                                
                            </div>
                        </div>
                        <br />
                        {{ Form::open(array('url' => 'report/konsumsi_view' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6"> 
                                <div class="control-group">
                                    <label class="control-label">Tanggal</label>
                                    <div class="controls">
                                        <input type="text" name="tanggal" id="tanggal" class="date span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group"> 
                                    <label class="control-label">Ruangan</label>
                                    <div class="controls">
                                        <select name="ruangan" id="ruangan">
                                            <option value="all">-Semua Ruangan-</option>
                                            @foreach($ruangan as $r)
                                                <option value="{{ $r->NamaRuangan }}">{{ $r->NamaRuangan }}</option>
                                            @endforeach
                                        </select>
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
            var tanggal = $('#tanggal').val();
            if( tanggal==''){
                $('#tanggal').focus();
            }
            else{
                $('#reg1_form').submit();
            }
        }
    </script>
@stop
