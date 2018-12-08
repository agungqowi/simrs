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
                            Pengaturan Harga Jual Barang
                        </li>
                    </ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Pengaturan Harga Jual Barang
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
                {{ Form::open(array('url' => 'askes_obat/harga' , 'id'=>'reg1_form', 'class' => 'form-horizontal' ,'method' => 'post')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Persentase Harga Jual Pasien Umum</label>
                                        <div class="controls">
                                            <input type="text" id="hju" name="hju" class="no-primary" value="<?php echo number_format( floatval($harga->hju) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div> <br />
                                    <div class="control-group">
                                        <label class="control-label">Harga Jual Pasien BPJS</label>
                                        <div class="controls">
                                            <input type="text" id="hjb" name="hjb" class="no-primary" value="<?php echo number_format( floatval($harga->hjb) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div> <br />
                                    <div class="control-group">
                                        <label class="control-label">Harga Jual Pasien Asuransi Swasta</label>
                                        <div class="controls">
                                            <input type="text" id="hja" name="hja" class="no-primary" value="<?php echo number_format( floatval($harga->hja) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div> <br />
                                    <div class="control-group">
                                        <label class="control-label">Harga Jual Pasien PT / Perusahaan</label>
                                        <div class="controls">
                                            <input type="text" id="hjp" name="hjp" class="no-primary" value="<?php echo number_format( floatval($harga->hjp) , 2); ?>">
                                            <br />* Gunakan titik untuk persentase, contoh (1.1)
                                        </div>
                                    </div> <br />
                                    <div class="control-group">
                                        <label class="control-label">Pembulatan</label>
                                        <div class="controls">
                                            <select name="pembulatan" id="pembulatan" class="span12 no-primary">
                                                @foreach($pembulatan as $k)
                                                    @if($k == $harga->pembulatan)
                                                        <option selected="selected" value="{{ $k }}">{{ $k }}</option>
                                                    @else
                                                         <option value="{{ $k }}">{{ $k }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <br />
                                            Pilih 0 jika tidak ingin ada pembulatan <br />
                                            Pilih 1 untuk pembulatan harga tanpa angka desimal <br />
                                            Pilih 50 untuk pembulatan harga menjadi kelipatan 50 apabila tidak genap 0 <br />
                                            Pilih 100 untuk pembulatan harga menjadi kelipatan 100 apabila tidak genap 0 <br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
	   	</div>
	</div>
</div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    
@stop