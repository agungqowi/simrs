@extends('print')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
	<style>
		label {
			padding-top: -2.5px;
			margin-bottom: -2.5px;
			font-weight:500;
			font-size:12px;
		}

	</style>
@stop

@section('content')
        <div class="print_content" style="margin-top:-60px">
                <div class="row-fluid id="printarea"">
                        @if($meta==200)
                    <div class="span12">
						<div class="row-fluid">
							<div class="span4">
								<img src="{{ url('img/logo_bpjs.png') }}" width="262px" />
							</div>
							<div class="span5" align="center" style="">
                                <label style="font-weight:bold; font-size:15px">SURAT ELEGIBILITAS PESERTA</label>
                                <label style="font-weight:bold; font-size:15px; margin-bottom:5px;">{{ $rs_title }}d</label>
							</div>
						</div>
						
						<div class="row-fluid">
							<div class="span3">
									<label>No. SEP</label>
									<label>Tgl. SEP</label>
							</div>
							<div class="span4" style="margin-left:-35px">
									<label style="font-size:15px">: {{ $show['noSep'] }}</label>
									<label>: {{ date( "d/m/Y", strtotime($show['tglSep'])) }}</label>
							</div>
						</div>
						
						<div class="row-fluid">
							<div class="span3">
									<label>No. Kartu</label>
									<label>Nama Peserta</label>
									<label>Tgl. Lahir</label>
									<label>Jns. Kelamin</label>
									<label>Poli Tujuan</label>
									<label>Asal Faskes Tk. I</label>
							</div>
							<div class="span3" style="margin-left:-35px; margin-right:100px;">
									<label>: {{ $show['peserta']['noKartu'] }}</label>
									<label>: {{ $show['peserta']['nama'] }}</label>
									<label>: {{ date( "d/m/Y", strtotime($show['peserta']['tglLahir'])) }}</label>
									<label>: {{ $jk }}</label>
									<label>: {{ $show['poliTujuan']['nmPoli'] }}</label>
									<label>: {{ $show['provRujukan']['nmProvider'] }}</label>
							</div>
							<div class="span2" style="margin-left:40px;">
									<label>Peserta</label>
									<label>&nbsp;</label>
									<label>COB</label>
									<label>Jns. Rawat</label>
									<label>Kls. Rawat</label>
							</div>
							<div class="span4" style="margin-left:-20px; margin-right:-40px;">
									<label>: {{ $show['peserta']['jenisPeserta']['nmJenisPeserta'] }}</label>
									<label>&nbsp;</label>
									<label>: </label>
									<label>: {{ $show['jnsPelayanan'] }}</label>
									<label>: {{ $show['klsRawat']['nmKelas'] }}</label>
							</div>
						</div>
						
						<div class="row-fluid">
							<div class="span3">
									<label>Diagnosa Awal</label>
							</div>
							<div class="span5" style="margin-left:-35px; margin-right:30px;">
							<?php if(strlen($show['diagAwal']['nmDiag']<45)){ ?>
									<label>: {{ $show['diagAwal']['nmDiag'] }}</label>
							<?php } else { ?>
									<label>: {{ $show['diagAwal']['nmDiag'] }}</label>
									<label>: {{ $show['diagAwal']['nmDiag'] }}</label>
							<?php } ?>
							</div>
							<div class="span2" style="margin-right:10px;">
									<label>Pasien/</label>
									<label>Keluarga Pasien
							</div>
							<div class="span2" style="margin-right:-40px;">
									<label>Petugas</label>
									<label>BPJS Kesehatan</label>
							</div>
						</div>

						<div class="row-fluid">
							<div class="span3">
									<label style=" margin-bottom:3px;">Catatan</label>
							</div>
							<div class="span5" style="margin-left:-35px">
									<label>: {{ $show['catatan'] }}</label>
							</div>
						</div>

						<div class="row-fluid">
							<div class="span8" style="margin-right:-30px">
									<label style="font-size:9px; font-style:italic; margin-bottom: -5px;">*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan.</label>
									<label style="font-size:9px; font-style:italic; padding-top: -5px;">*SEP bukan sebagai bukti penjaminan peserta</label>
							</div>
							<div class="span4" style="margin-left:-20px">
									<label>&nbsp;</label>
									<label>&nbsp;</label>
							</div>
						</div>

						<div class="row-fluid">
							<div class="span8">
									<label style="font-size:11px">Cetakan ke 3 - 4/10/2015 10:20:33 AM</label>
							</div>
							<div class="span2" style="margin-left:-5px; margin-right:10px;">
									<hr style="border-color: #333333 -moz-use-text-color #FFFFFF;" />
							</div>
							<div class="span2">
									<hr style="border-color: #333333 -moz-use-text-color #FFFFFF;" />
							</div>
						</div>


                    </div>
                        @else
                            <h3>Data tidak ditemukan</h3>
                        @endif
            </div>
        </div>
    
@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('js/jquery.printElement.min.js') }}
@stop
