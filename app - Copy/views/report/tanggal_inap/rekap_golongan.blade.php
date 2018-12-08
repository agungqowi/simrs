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
                            <a href="{{ url('report/rawat_inap') }}">Laporan</a>
                        </li>
                        <li>
                            {{ $title }}
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan {{ $title }}
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
                        {{ Form::open(array('url' => 'report/tanggal_inap/rekap_golongan_view' ,'method' => 'POST' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                        <div class="row-fluid formSep">
                            <div class="span7"> 
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
                                    <div class="controls" id="ganti_dari">
										<input type="text" name="dari_tanggal" id="dari_tanggal" class="date span7 no-primary tanggal">
										<font id="label_dari" color="#FF0000" style="font-weight:bold; display:none"></font>
                                    </div>
                                </div>
                                <div class="control-group" id="sampai" style="display:none">
                                    <label class="control-label">Sampai Tanggal</label>
                                    <div class="controls">
                                        <input type="text" name="sampai_tanggal" id="sampai_tanggal" class="date span7 no-primary tanggal">
										<font id="label_sampai" color="#FF0000" style="font-weight:bold; display:none"></font>
                                    </div>
                                </div>
                                @if($jenis == 'rawat_inap')
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
                                @endif

                                @if($jenis == 'rawat_jalan')
                                <div class="control-group"> 
                                    <label class="control-label">Poli</label>
                                    <div class="controls">
                                        <select name="poli" id="poli">
                                            <option value="all">-Semua Poli-</option>
                                            @foreach($poli as $p)
                                                <option value="{{ $p->IdPoli }}">{{ $p->NamaPoli }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif

                                <input type="hidden" id="jenis_pelayanan" name="jenis_pelayanan" value="{{ $jenis }}">
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
            var dari_tanggal = $('#dari_tanggal').val();
            var sampai_tanggal = $('#sampai_tanggal').val();
			var radio = $("input[name='inlineRadioOptions']:checked").val();
			var res = dari_tanggal.split('/');
			var ress = sampai_tanggal.split('/');
			var today = new Date();
            var yyyy = today.getFullYear();
			var minYear = 2000;
			
			if(radio == 'tanggal'){
				if( dari_tanggal == ''){
					$('#label_dari').show();
					$('#label_dari').html('&nbsp;&nbsp;Siliahkan Pilih Tanggal');
					$('#dari_tanggal').focus();
				}
				else if(res[2] > yyyy || res[2] < minYear){
					$('#label_dari').show();
					$('#label_dari').html('<br />Inputan Tanggal Tidak Sesuai atau<br />Melebihi Tanggal Hari Ini,<br />Harap Cek Ulang Tanggal<br />');
					
				}
				else{
					$('#label_dari').hide();
					$('#label_dari').html('');
					$('#sampai_tanggal').val(dari_tanggal);
					//$('#sampai').show();
					$('#reg1_form').submit();
				}
			}
			else{
				if(sampai_tanggal==''){
					$('#sampai_tanggal').focus();
					$('#label_sampai').show();
					$('#label_sampai').html('&nbsp;&nbsp;Siliahkan Pilih Tanggal');
				}
				else if(ress[2] > yyyy || res[2] < minYear){
					$('#label_sampai').show();
					$('#label_sampai').html('<br />Inputan Sampai Tanggal Tidak Sesuai atau<br />Melebihi Tanggal Hari Ini,<br />Harap Cek Ulang Tanggal<br />');
				}
				else{
					$('#label_sampai').hide();
					$('#label_sampai').html('');
					$('#reg1_form').submit();
			 	}
			}
            
       }
    </script>
@stop
