@extends('layout')

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
                            <a href="{{ url('report/gizi') }}">Laporan</a>
                        </li>
                        <li>
                            Unit Gizi
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Unit Gizi
                        </h3>
                        <div class="row-fluid">
                            <div class="span12">
                                
                            </div>
                        </div>
                        <br />
                        {{ Form::open(array('url' => 'report/gizi_view' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6"> 
                                <div class="control-group">
                                    <label class="control-label">Bulan</label>
                                    <div class="controls">
										<select id="bulan" name="bulan">
											<option value = "0">Semua Bulan</option>
											<option value = "1">Januari</option>
											<option value = "2">Februari</option>
											<option value = "3">Maret</option>
											<option value = "4">April</option>
											<option value = "5">Mei</option>
											<option value = "6">Juni</option>
											<option value = "7">Juli</option>
											<option value = "8">Agustus</option>
											<option value = "9">September</option>
											<option value = "10">Oktober</option>
											<option value = "11">November</option>
											<option value = "12">Desember</option>
										</select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tahun</label>
                                    <div class="controls">
										<select id="tahun" name="tahun">
											<option value = "0">Semua Tahun</option>
										@for($i=0; $i<=5; $i++)
											<option value = "<?=date('Y')-$i?>"><?=date('Y')-$i?></option>
										@endfor
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn_preview').click(function(){
                $('#reg1_form').submit();
            })
        });
    </script>
@stop
