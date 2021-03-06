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
                            <a href="{{ url('report/poli_bulan') }}">Laporan</a>
                        </li>
                        <li>
                            Rawat Jalan per Bulan
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Rawat Jalan
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
                        {{ Form::open(array('url' => 'report/poli_bulan_view' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6"> 
                                <div class="control-group">
                                    <label class="control-label">Bulan</label>
                                    <div class="controls">
                                        <select name="bulan" id="bulan" class="span4 no-primary">
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tahun</label>
                                    <div class="controls">
                                        <select name="tahun" id="tahun" class="span4 no-primary">
                                            <?php $now = date('Y'); ?>
                                            @for($i=0;$i<=20;$i++)
                                                <option value="{{ $now-$i }}">{{ $now-$i }}</option>
                                            @endfor
                                        </select>
                                    
                                    </div>
                                </div>
                                <div class="control-group"> 
                                    @if($single == 'true') 
                                        style="display:none" 
                                    @endif
                                
                                    <label class="control-label">Poli</label>
                                    <div class="controls">
                                        <select name="poli" id="poli">
                                            @if($single == 'true')
                                                @if(isset($poli->NamaPoli))
                                                    <option value="{{ $poli->NamaPoli }}">{{ $poli->NamaPoli }}</option>
                                                @endif
                                            @else
                                                @foreach($poli as $r)
                                                    <option value="{{ $r->NamaPoli }}">{{ $r->NamaPoli }}</option>
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
            $('#btn_preview').click(function(){
                do_proses();
            })
        });

        function do_proses(){
            var tahun = $('#tahun').val();
            if( tahun==''){
                $('#tahun').focus();
            }
            else{
                $('#reg1_form').submit();
            }
        }
    </script>
@stop
