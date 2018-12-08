@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}

    <style type="text/css">
        input:focus{ 
            background-color: #FFFF99;
        }
        button:focus{
            border: 2px dotted blue;
        }
        .ui-autocomplete-loading { background:url('{{ url('img/load_gif.gif') }}') no-repeat right center }
    </style>
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
                            Update Harga Jual Barang
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Update Harga Jual Barang
                    </h3>
                    <?php $error = Session::get('error'); ?>
                    @if(isset($error))
                    <div id="pesan_error" class="alert alert-error">
                        {{ $error }}
                    </div>
                    @endif

                    <?php $success = Session::get('success'); ?>
                    @if( Session::get('success') )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
	        	</div>
                <div class="span12">
                    
                </div>
                @if( isset($data) )
                {{ Form::model($data, array('route' => array( $slug.'.update', $primary_id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Nama Obat</label>
                                        <div class="controls">
                                            <input type="text" id="namaobat" name="namaobat" class="no-primary"
                                                disabled="disabled" value="<?php echo $data2->namaobat; ?>">
                                            <br />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Harga Beli</label>
                                        <div class="controls">
                                            <input type="text" id="hargabeli" name="hargabeli" class="no-primary"
                                                disabled="disabled" value="<?php echo $data2->hargabeli; ?>">
                                            <br />
                                        </div>
                                    </div>
                                    <br />          
                                    <div class="control-group">
                                        <label class="control-label">Persentase Harga Jual Pasien Umum</label>
                                        <div class="controls">
                                            <input style="width: 50px" size="8" type="text" id="persentase_umum" name="persentase_umum" class="no-primary" value="<?php echo number_format( floatval($data->persentase_umum) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label">Pembulatan Harga Jual Umum</label>
                                        <div class="controls">
                                            <select name="pembulatan_umum" id="pembulatan_umum" class="span6 no-primary">
                                                @foreach($pembulatan as $k)
                                                    @if($k == $data->pembulatan_umum)
                                                        <option selected="selected" value="{{ $k }}">{{ $k }}</option>
                                                    @else
                                                         <option value="{{ $k }}">{{ $k }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Harga Jual Umum</label>
                                        <div class="controls">
                                            <input type="text" id="harga_jual_umum" name="harga_jual_umum" class="no-primary" 
                                                value="<?php echo $data->harga_jual_umum; ?>" />
                                            <br />
                                        </div>
                                    </div>
                                    <br /> <br />
                                    <div class="control-group">
                                        <label class="control-label">Persentase Harga Jual Pasien BPJS</label>
                                        <div class="controls">
                                            <input style="width: 50px" size="8" type="text" id="persentase_bpjs" name="persentase_bpjs" class="no-primary" value="<?php echo number_format( floatval($data->persentase_bpjs) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div>                                 
                                    <div class="control-group">
                                        <label class="control-label">Pembulatan Harga Jual BPJS</label>
                                        <div class="controls">
                                            <select name="pembulatan_bpjs" id="pembulatan_bpjs" class="span6 no-primary">
                                                @foreach($pembulatan as $k)
                                                    @if($k == $data->pembulatan_bpjs)
                                                        <option selected="selected" value="{{ $k }}">{{ $k }}</option>
                                                    @else
                                                         <option value="{{ $k }}">{{ $k }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label">Harga Jual BPJS</label>
                                        <div class="controls">
                                            <input type="text" id="harga_jual_bpjs" name="harga_jual_bpjs" class="no-primary" 
                                                value="<?php echo $data->harga_jual_bpjs; ?>" />
                                            <br />
                                        </div>
                                    </div><br /><br />
                                    <div class="control-group">
                                        <label class="control-label">Persentase Harga Jual Pasien Asuransi Swasta</label>
                                        <div class="controls">
                                            <input style="width: 50px" size="8" type="text" id="persentase_asuransi" name="persentase_asuransi" class="no-primary" value="<?php echo number_format( floatval($data->persentase_asuransi) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div>                               
                                    <div class="control-group">
                                        <label class="control-label">Pembulatan Harga Jual Asuransi</label>
                                        <div class="controls">
                                            <select name="pembulatan_asuransi" id="pembulatan_asuransi" class="span6 no-primary">
                                                @foreach($pembulatan as $k)
                                                    @if($k == $data->pembulatan_asuransi)
                                                        <option selected="selected" value="{{ $k }}">{{ $k }}</option>
                                                    @else
                                                         <option value="{{ $k }}">{{ $k }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div> 

                                    <div class="control-group">
                                        <label class="control-label">Harga Jual Asuransi</label>
                                        <div class="controls">
                                            <input type="text" id="harga_jual_asuransi" name="harga_jual_asuransi" class="no-primary" 
                                                value="<?php echo $data->harga_jual_asuransi; ?>" />
                                            <br />
                                        </div>
                                    </div><br /><br />
                                    <div class="control-group">
                                        <label class="control-label">Persentase Harga Jual Pasien PT / Perusahaan</label>
                                        <div class="controls">
                                            <input style="width: 50px" size="8" type="text" id="persentase_pt" name="persentase_pt" class="no-primary" value="<?php echo number_format( floatval($data->persentase_pt) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div>                             
                                    <div class="control-group">
                                        <label class="control-label">Pembulatan Harga Jual PT</label>
                                        <div class="controls">
                                            <select name="pembulatan_pt" id="pembulatan_pt" class="span6 no-primary">
                                                @foreach($pembulatan as $k)
                                                    @if($k == $data->pembulatan_pt)
                                                        <option selected="selected" value="{{ $k }}">{{ $k }}</option>
                                                    @else
                                                         <option value="{{ $k }}">{{ $k }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Harga Jual PT</label>
                                        <div class="controls">
                                            <input type="text" id="harga_jual_pt" name="harga_jual_pt" class="no-primary" 
                                                value="<?php echo $data->harga_jual_pt; ?>" />
                                            <br />
                                        </div>
                                    </div><br /><br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="background:red;color:#FFF;padding:10px;">
                    <h3>Catatan Pembulatan</h3>
                    <br />
                                            Pilih 0 jika tidak ingin ada pembulatan <br />
                                            Pilih 1 untuk pembulatan harga tanpa angka desimal <br />
                                            Pilih 50 untuk pembulatan harga menjadi kelipatan 50 apabila tidak genap 0 <br />
                                            Pilih 100 untuk pembulatan harga menjadi kelipatan 100 apabila tidak genap 0 <br />
                    </div>
                    <br />
                    <div class="row-fluid formsep">
                        <div class="span12">
                            <div class="">
                                <input type="hidden" id="tipe" name="tipe" value="tambah">
                                <input type="hidden" id="id_transaksi" name="id_transaksi" value="0">
                                <button id="btn_simpan" type="submit" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                <button type="button" class="btn btn-danger"><i class="splashy-document_a4_marked"></i> Batal</button>
                                
                            </div>
                        </div>
                    </div>           
                {{ Form::close() }}
                @else
                    <div class="row-fluid formsep">
                        <div class="span12">
                        Data tidak ditemukan
                        </div>
                    </div>
                @endif
	   	</div>
	</div>
</div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('#persentase_umum').change(function(){
                doChange('umum');
            })

            $('#pembulatan_umum').change(function(){
                doChange('umum');
            })

            $('#persentase_bpjs').change(function(){
                doChange('bpjs');
            })

            $('#pembulatan_bpjs').change(function(){
                doChange('bpjs');
            })

            $('#persentase_asuransi').change(function(){
                doChange('asuransi');
            })

            $('#pembulatan_asuransi').change(function(){
                doChange('asuransi');
            })

            $('#persentase_pt').change(function(){
                doChange('pt');
            })

            $('#pembulatan_pt').change(function(){
                doChange('pt');
            })

            function doChange(_type){
                var _persentase = $('#persentase_'+_type).val();
                var _hargabeli  = $('#hargabeli').val();
                var _pembulatan = $('#pembulatan_'+_type).val();

                var _hargajual  = parseFloat( _hargabeli ) * parseFloat( _persentase );

                if( _pembulatan == 0 ){
                    _hargajual  = parseFloat( _hargajual ).toFixed(2);
                }
                else if( _pembulatan == 1 ){
                    _hargajual = Math.ceil( _hargajual );
                }
                else if( _pembulatan == 50 ){
                    _hargajual = Math.ceil( _hargajual );

                    var _temp   = _hargajual;
                    var _temp2  = 0;
                    while ( _temp >= 50 ){
                        _temp   = _temp - 50;
                        _temp2  = _temp2 + 50;
                    }

                    if( _temp != 0 ){
                        _temp   = 50 - _temp;
                    }

                    _hargajual  = _hargajual + _temp;
                    
                }
                else if( _pembulatan == 100 ){
                    _hargajual = Math.ceil( _hargajual );

                    var _temp   = _hargajual;
                    var _temp2  = 0;
                    while ( _temp >= 100 ){
                        _temp   = _temp - 100;
                        _temp2  = _temp2 + 100;
                    }

                    if( _temp != 0 ){
                        _temp   = 100 - _temp;
                    }

                    _hargajual  = _hargajual + _temp;
                    
                }

                $('#harga_jual_'+_type).val(_hargajual);
            }
        });
    </script>
@stop