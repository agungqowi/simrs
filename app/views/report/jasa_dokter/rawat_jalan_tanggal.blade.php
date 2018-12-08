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
                            <a href="{{ url('report/jasa_dokter/rawat_jalan_tanggal') }}">Laporan Jasa Dokter</a>
                        </li>
                        <li>
                            Rawat Jalan
                        </li>
                        <li>
                            Per Tanggal
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Jasa Dokter Rawat Jalan
                        </h3>
                        <div class="row-fluid">
                            <div class="span12">
                            </div>
                        </div>
                        <br />
                        {{ Form::open(array('url' => 'report/jasa_dokter_view/rawat_jalan_tanggal' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span6"> 
                                <div class="control-group">
									<div class="row-fluid">
										<div class="span4">
											
										</div>
										<div class="span4">
											<label><input type="radio" name="inlineRadioOptions" id="Radio1" value="tanggal" style="margin-top:-3px" checked="checked"> Per Tanggal</label>
										</div>
										<div class="span4">
											<label><input type="radio" name="inlineRadioOptions" id="Radio2" value="periode" style="margin-top:-3px"> Periode</label>
										</div>
									</div>
									
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="dari">Tanggal</label>
                                    <div class="controls">
                                        <input type="text" name="dari_tanggal" id="dari_tanggal" class="date span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group" id="sampai" style="display:none">
                                    <label class="control-label">Sampai Tanggal</label>
                                    <div class="controls">
                                        <input type="text" name="sampai_tanggal" id="sampai_tanggal" class="date span10 no-primary">
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
            var dari_tanggal = $('#dari_tanggal').val();
            var sampai_tanggal = $('#sampai_tanggal').val();
			var radio = $("input[name='inlineRadioOptions']:checked").val();
			
           if( dari_tanggal==''){
                $('#dari_tanggal').focus();
            }
            else{
				if(radio == 'tanggal'){
					$('#sampai_tanggal').val(dari_tanggal);
					//$('#sampai').show();
					$('#reg1_form').submit();
				}
				else{
					if(sampai_tanggal=='' ){
						$('#sampai_tanggal').focus();
					}
					else{
						$('#reg1_form').submit();
				 	}
				}
            }
       }
    </script>
@stop
