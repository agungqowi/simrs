@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
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
                            <a href="{{ url('sep/hapus_data') }}">Hapus Data</a>
                        </li>
                        <li>
                            SEP
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Hapus Data SEP
                    </h3>
                    <div id="pesan_error" class="alert alert-error" style="display:none;font-weight:bold;"></div>
					@if( $pesan != '' )
						<div id="" class="alert alert-error" style="font-weight:bold">{{ $pesan }}</div>
					@endif
	        	</div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No SEP</label>
                                <div class="controls">
                                    <input type="text" id="no_sep" name="no_sep" class="span12">
                                </div>
                            </div>
						</div>
                    </div>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">PPK Pelayanan</label>
                                <div class="controls">
                                    <input type="text" id="" name="" class="span12 no-primary" value="{{ Config::get('settings.ppk_pelayanan'); }}">
									<input type="hidden" id="ppk_pelayanan" name="ppk_pelayanan" class="span10 no-primary" value="{{ Config::get('settings.id_ppk_pelayanan'); }}">
                                </div>
                            </div>
						</div>
                    </div>
                    <div class="row-fluid formsep">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="controls">
                                <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Hapus</button>
                                <button id="reset" type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Reset</button>
                                </div>
                            </div>
						</div>
                    </div>
                {{ Form::close() }}
	   	</div>
	</div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        var oTable;
        $(document).ready(function() {
            $('#simpan').click(function(){
                bikin_sep();
            });
            $('#reset').click(function(){
                reset_all_data();
            });
			$("#ppk_pelayanan").autocomplete({
                 source: "{{ url('sep/ppk_pelayanan_autocomplete') }}",
                 minLength:4
            });
        });

        function reset_all_data(){
            $('#no_sep').val('');
            $('#ppk_pelayanan').val('');
			$('#pesan_error').hide();
		}
		
        function bikin_sep(){
            var no_sep = $('#no_sep').val();
            var ppk_pelayanan = $('#ppk_pelayanan').val();
			
            if(no_sep == ''){
                cetak_alert('Nomor SEP tidak boleh kosong');
                $('#no_sep').focus();
            }
            else if(ppk_pelayanan == ''){
                cetak_alert('PPK Pelayanan tidak boleh kosong');
                $('#ppk_pelayanan').focus();
            }
            else{
                $.ajax({
                    url: "{{ url('sep/hapus_data_proses') }}",
                    type: "POST",
                    data :  "no_sep="+no_sep+"&ppk_pelayanan="+ppk_pelayanan,
                    success:function(res){
                        if(res != 'sukses'){
							cetak_alert('Hapus Data SEP berhasil.');
                        }
                        else{
                            cetak_alert(res);
                        }
                    }
                });
           }
        }

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }


    </script>
@stop