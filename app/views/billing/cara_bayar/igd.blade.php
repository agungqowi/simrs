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
                            <a href="{{ url('billing_carabayar') }}">Ubah Cara Bayar</a>
                        </li>
                        <li>
                            Pasien IGD
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Ubah Cara Bayar Pasien IGD
                    </h3>
                    <div id="pesan_error" class="alert alert-info" style="display:none;font-weight:bold;"></div>
					@if( isset($pesan)  && $pesan != '' )
						<div id="" class="alert alert-error" style="font-weight:bold">{{ $pesan }}</div>
					@endif
	        	</div>
                {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">No Reg</label>
                                <div class="controls">
                                    <input type="text" id="noreg" name="noreg" value="{{ $data->NoRegUGD }}" readonly class="span5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input type="text" id="no_rm" name="no_rm" value="{{ $data->NoRM }}" readonly class="span5">
                                </div>
                            </div>
						</div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Nama</label>
                                <div class="controls">
                                    <input type="text" id="nama" name="nama" readonly class="span5" value="{{ $data->Nama }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <div class="controls">
                                    <input type="text" id="tanggal_lahir" name="tanggal_lahir" readonly class="span5" value="{{ $data->TanggalLahir }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Tanggal masuk</label>
                                <div class="controls">
                                    <input type="text" id="tanggal" name="tanggal" readonly class="span5" value="{{ $data->Tanggal.' '.$data->Jam }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <label class="control-label">Cara Bayar</label>
                                <div class="controls">
                                    <input type="hidden" name="cara_bayar" id="cara_bayar" value="{{ $data->CaraBayar }}">
                                    <select id="cmb_cara_bayar" name="cmb_cara_bayar" class="no-primary">
                                        <?php $ar_cara = array('BPJS' , 'Umum' , 'Asuransi Swasta' , 'KIS' ); ?>
                                        <option value="">-</option>
                                        @foreach($ar_cara as $c)
                                            <?php $select = ""; ?>
                                            @if($c == $data->CaraBayar)
                                                <option selected="selected" value="{{ $c }}">{{ $c }}</option>
                                            @else 
                                                <option value="{{ $c }}">{{ $c }}</option>
                                            @endif

                                        @endforeach

                                        <?php $rekanan = DB::table('tbrekanan')->get(); ?>
                                        <?php $asuransi = DB::table('tbasuransi')->get(); ?>

                                        @if(isset($rekanan) && count($rekanan) > 0)
                                            @foreach($rekanan as $r)
                                                @if( $r->nama_rekanan == $data->CaraBayar )
                                                    <option selected="selected" value="{{ $r->nama_rekanan }}">{{ $r->nama_rekanan }}</option>
                                                @else
                                                    <option value="{{ $r->nama_rekanan }}">{{ $r->nama_rekanan }}</option>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if(isset($asuransi) && count($asuransi) > 0)
                                            @foreach($asuransi as $as)
                                                @if( $as->nama_asuransi == $data->CaraBayar )
                                                    <option selected="selected" value="{{ $as->nama_asuransi }}">{{ $as->nama_asuransi }}</option>
                                                @else
                                                    <option value="{{ $as->nama_asuransi }}">{{ $as->nama_asuransi }}</option>
                                                @endif
                                            @endforeach
                                        @endifion>
                                        <option>Jamkesda</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

					<input type="hidden" id="id_reg" name="id_reg" class="span10 no-primary" value="{{ $data->NoRegUGD }}">
                                
                    <div class="row-fluid formsep">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="controls">
                                <button id="simpan" type="button" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                <button id="reset" type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Kembali</button>
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
                updateData();
            });
            $('#reset').click(function(){
                window.location.href = '<?php echo url("/billing_carabayar/igd"); ?>';
            });
        });

        function reset_all_data(){
            $('#no_sep').val('');
            $('#tanggal_pulang').val('');
            $('#ppk_pelayanan').val('');
			$('#pesan_error').hide();
		}
		
        function updateData(){
            var no_reg = $('#id_reg').val();
            var cara_bayar = $('#cara_bayar').val();
            var cara_bayar2 = $('#cmb_cara_bayar').val();

            if( cara_bayar2 == '' ){
                cetak_alert('Cara bayar tidak boleh kosong');
            }
            else if(cara_bayar2 == cara_bayar){
                cetak_alert('Cara bayar tidak berubah, mohon pilih cara bayar');
            }
            else{
                cetak_alert('Mohon tunggu, data sedang di proses');
                $.ajax({
                    url: "{{ url('billing_carabayar/igd') }}",
                    type: "POST",
                    data : "no_reg="+no_reg+"&cara_bayar="+cara_bayar+"&cara_bayar2="+cara_bayar2,
                    success:function(res){
                        if(res == 0){
                            cetak_alert('Update cara bayar berhasil');
                        }
                        else{
                            
                            cetak_alert('Update cara bayar gagal');
                        }
                        //alert('Pasien berhasil dipulangkan');
                        
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