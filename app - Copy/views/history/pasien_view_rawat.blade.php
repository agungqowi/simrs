@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
@stop

@section('content')
	<div id="contentwrapper">
		<div class="main_content">
			<nav>
        		<div id="jCrumbs" class="breadCrumb module">
        			<ul>
        				<li>
        					<a href="{{ url('/') }}"><i class="icon-home"></i></a>
        				</li>
                        <li>
                            <a href="{{ url('history_pasien') }}">Rekam Medis</a>
                        </li>
                        <li>
                            <a href="{{ url('history_pasien/view/'.$NoRM) }}">Perawatan</a>
                        </li>
                        <li>
                            Detail
                        </li>
        			</ul>
        		</div>
        	</nav>
        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Data Rekam Medis Pasien Rawat {{ $tipe=='' ? 'Inap' : $tipe }}
                    </h3>
	        	</div>
            </div>
            {{ Form::open(array('url' => '' , 'id'=>'reg3_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="control-group">
                                <label class="control-label">Nama</label>
                                <div class="controls">
									<input type="text" id="Nama_det" name="Nama_det" class="span12 no-primary" value="{{ $pasien->Nama }}"  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Alamat</label>
                                <div class="controls">
                                    <input type="text" id="Jalan_det" name="Jalan_det" class="span12" value="{{ $pasien->Jalan.' '.$pasien->Kelurahan.' '.$pasien->Kecamatan.' '.$pasien->KotaKab.' '.$pasien->Provinsi }}" />
                                </div>
                            </div>
						</div>
						<div class="span4">
                            <div class="control-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <div class="controls">
                                    <input type="text" id="Jkel_det" name="Jkel_det" class="span12 no-primary" value="{{ $pasien->Jkel=='L' ? 'Laki-Laki' : 'Perempuan' }}"  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Pekerjaan</label>
                                <div class="controls">
                                    <input type="text" id="Pekerjaan_det" name="Pekerjaan_det" class="span12 no-primary" value="{{ $pasien->Pekerjaan }}"  />
                                </div>
                            </div>
						</div>
					</div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Tmp./Tgl. Lahir</label>
                                <div class="controls">
                                    <input type="text" id="TempatLahir_det" name="TempatLahir_det" class="span12" value="{{ $pasien->TempatLahir }}, {{ $TanggalLahir }}" />
                                </div>
                            </div>
						</div>
						<div class="span4">	
                            <div class="control-group">
                                <label class="control-label">Usia</label>
                                <div class="controls">
                                    <input type="text" id="Usia_det" name="Usia_det" class="span12" value="{{ $usia }}" />
                                </div>
                            </div>
						</div>
						<div class="span4">							
                            <div class="control-group">
                                <label class="control-label">Status</label>
                                <div class="controls">
                                    <input type="text" id="Status_det" name="Status_det" class="span12 no-primary" value="{{ $pasien->Status }}"  />
                                </div>
                            </div>
						</div>
					</div>
					<hr />
                    <div class="row-fluid">
                        <div class="span4">
                           <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
								<?php 
								 		$Tanggal_rawat = DateTime::createFromFormat('Y-m-d', $Tanggal);
										$Tanggal_display = $Tanggal_rawat->format('d/m/Y');
								?>
                                    <input type="text" id="" name="" class="span12 no-primary" value="{{ $Tanggal_display }}"  />
                                </div>
                            </div>
						</div>
						@if($tipe!='Ugd')
						<div class="span4">	
                            <div class="control-group">
                                <label class="control-label">{{ $tipe=='Jalan' ? 'Poli' : 'Ruangan' }}</label>
                                <div class="controls">
                                    <input type="text" id="" name="" class="span12 no-primary" value="{{ $Ruangan }}"  />
                                </div>
                            </div>
						</div>
						@endif
						@if($tipe=='')
						<div class="span4">							
                            <div class="control-group">
                                <label class="control-label">Kelas/ No Kamar</label>
                                <div class="controls">
                                    <input type="text" id="" name="" class="span12 no-primary" value="{{ $Kelas }}/ {{ $NoKamar }}"  />
                                </div>
                            </div>
						</div>
						@endif
					</div>
                    <div class="row-fluid">
						<div class="span4">	
                            <div class="control-group">
                                <label class="control-label">Dokter</label>
                                <div class="controls">
                                    @if(isset($Dokter) && count($Dokter) > 0 )
                                        <ul>
                                        @foreach($Dokter as $d)
                                            <li>{{ $d->NamaDokter.' ('.$d->Kategori.')' }}</li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
						</div>
						<div class="span8">							
                            <div class="control-group">
                                <label class="control-label">Diagnosa</label>
                                <div class="controls">
                                    @if(isset($Diagnosis) && count($Diagnosis) > 0 )
                                        <ul>
                                        @foreach($Diagnosis as $d)
                                            <li>{{ $d->IdDiag.' '.$d->ShortDiagnoisDesc.' ('.$d->JenisRawat.')' }}</li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
						</div>
					</div>

					<div class="row-fluid">
						<div class="span12">
							<table id="tbl_perawatan" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th align="center" valign="middle" class="head1">Tanggal</th>
										<th align="center" valign="middle" class="head2">Tindakan</th>
										<th align="center" valign="middle" class="head3">Daftar Obat (Jumlah)</th>
									</tr>
								</thead>
								<tbody id="isi_perawatan">
									<tr>
										<td colspan="3"><img align="center" src="{{ url('img/load_gif.gif') }}" />&nbsp;&nbsp;Sedang Memproses Data...</td>
									</tr>
								</tbody>
							</table>
						</div>
                    </div>
                </div>
            {{ Form::close() }}
	   	</div>
	</div>
	
@stop

@section('js')
    @parent
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
	{{ HTML::script('lib/datatables/fnReloadAjax.js') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
	{{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
			$.ajax({
				url: "{{ url('history_pasien/view_rawat_data') }}",
				type: "POST",
				data : 	"NoRM={{ $NoRM }}&NoReg={{ $NoReg }}&Tanggal={{ $Tanggal }}",
				success:function(res){
					$('#isi_perawatan').html(res);
				}
			});
        });
    </script>
@stop