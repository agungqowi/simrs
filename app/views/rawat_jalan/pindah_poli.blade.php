@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
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
        					<a href="{{ action('DashboardController@index') }}">Info Pasien</a>
        				</li>
        				<li>
        					Poli / IGD
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">pendaftaran Pasien Poli / IGD
	        		</h3>
                     <?php $error = Session::get('error'); ?>
                    @if( Session::get('error') )
                        <div class="alert alert-error">
                            {{ $error }}
                        </div>
                    @endif

                    <?php $success = Session::get('success'); ?>
                    @if( Session::get('success') )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    {{ Form::open(array('url' => 'pendaftaran_harian/register/'.$data->IdRegJalan , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_reg_jalan" id="id_reg_jalan" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input readonly value="{{ $data->NoRM }}" type="text" id="no_rm" name="txt_no_rm" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">No Register</label>
                                <div class="controls">
                                    <input readonly type="text" value="{{ $data->NoRegJalan }}" id="no_register" name="txt_no_register" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input readonly type="text" value="{{ $data->Nama }}" id="txt_nama" name="txt_nama" class="span10 no-primary">
                                </div>
                            </div>
                            <?php
                                $tanggals   = explode('-' , $data->Tanggal);
                                $tanggal    = $tanggals[2].'/'.$tanggals[1].'/'.$tanggals[0];
                            ?>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" value="{{ $tanggal }}" id="tanggal" name="tanggal" class="nowdate span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Poli</label>
                                <div class="controls">
                                    <select id="poli" name="poli" class="select2">
                                        @if(count($poli) > 0)
                                            @foreach($poli as $p)
                                                @if($p->IdPoli == $data->IdPoli)
                                                     <option selected="" value="{{ $p->IdPoli }}">{{ $p->NamaPoli }}</option>
                                                @else
                                                    <option value="{{ $p->IdPoli }}">{{ $p->NamaPoli }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Dokter</label>
                                <div class="controls">
                                    <select id="dokter" name="dokter" class="select2">
                                        <option value="">-Pilih Dokter-</option>
                                        @if(count($dokter) > 0)
                                            @foreach($dokter as $p)
                                                @if($p->IdDokter == $data->IdDokter)
                                                     <option selected="" value="{{ $p->IdDokter }}">{{ $p->NamaDokter }}</option>
                                                @else
                                                    <option value="{{ $p->IdDokter }}">{{ $p->NamaDokter }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <button type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-success">
                                         Ubah
                                    </button>
                                    <a href="{{ url('pendaftaran_harian') }}" class="btn btn-warning"> Kembali</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection