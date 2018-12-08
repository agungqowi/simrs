@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
	<style type="text/css">
	</style>
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
                            Detail
                        </li>
        			</ul>
        		</div>
        	</nav>
        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Data Rekam Medis Pasien</h3>
	        	</div>
            </div>
			{{ Form::open(array('url' => '' , 'id'=>'coba', 'class' => 'form-horizontal')) }}
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
                                <label class="control-label">No. Telp.</label>
                                <div class="controls">
                                    <input type="text" id="NoTelp_det" name="NoTelp_det" class="span12 no-primary" value="{{ $pasien->NoTelp }}"  />
                                </div>
                            </div>
						</div>
					</div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label">Tmp. Lahir</label>
                                <div class="controls">
                                    <input type="text" id="TempatLahir_det" name="TempatLahir_det" class="span12" value="{{ $pasien->TempatLahir }}" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tgl. Lahir</label>
                                <div class="controls">
                                    <input type="text" id="TanggalLahir_det" name="TanggalLahir_det" class="span12" value="{{ $TanggalLahir }}"  />
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
                            <div class="control-group">
                                <label class="control-label">Agama</label>
                                <div class="controls">
                                    <input type="text" id="Agama_det" name="Agama_det" class="span12 no-primary" value="{{ $pasien->Agama }}"  />
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
                            <div class="control-group">
                                <label class="control-label">Pekerjaan</label>
                                <div class="controls">
                                    <input type="text" id="Pekerjaan_det" name="Pekerjaan_det" class="span12 no-primary" value="{{ $pasien->Pekerjaan }}"  />
                                </div>
                            </div>
						</div>
					</div>
			{{ Form::close() }}
            <div class="row-fluid">
                <div class="span12">
					<div class="accordion" id="accordionid">
						<div class="accordion-group">
							<div class="accordion-heading">
						  		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="index.html#data" onclick="ndelik()">
									<h5>Detail Biodata Pasien</h5>
						  		</a>
							</div>
							<div id="data" class="collapse">
						  		<div class="accordion-inner">
									{{ Form::open(array('url' => '' , 'id'=>'reg3_form', 'class' => 'form-horizontal')) }}
										<div class="row-fluid">
											<div class="span8">
												<div class="control-group">
													<label class="control-label">Nama</label>
													<div class="controls">
														<input type="text" id="Nama_det" name="Nama_det" class="span12 no-primary" value="{{ $pasien->Nama }}"  />
													</div>
												</div>
											</div>
											<div class="span4">
												<div class="control-group">
													<label class="control-label">Jenis Kelamin</label>
													<div class="controls">
														<input type="text" id="Jkel_det" name="Jkel_det" class="span12 no-primary" value="{{ $pasien->Jkel }}"  />
													</div>
												</div>
											</div>
										</div>
										<div class="row-fluid">
											<div class="span12">
												<div class="control-group">
													<label class="control-label">Alamat</label>
													<div class="controls">
														<input type="text" id="Jalan_det" name="Jalan_det" class="span12" value="{{ $pasien->Jalan.' '.$pasien->Kelurahan.' '.$pasien->Kecamatan.' '.$pasien->KotaKab.' '.$pasien->Provinsi }}" />
													</div>
												</div>
											</div>
										</div>
										<div class="row-fluid">
											<div class="span4">
												<div class="control-group">
													<label class="control-label">Tmp. Lahir</label>
													<div class="controls">
														<input type="text" id="TempatLahir_det" name="TempatLahir_det" class="span12" value="{{ $pasien->TempatLahir }}" />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Tgl. Lahir</label>
													<div class="controls">
														<input type="text" id="TanggalLahir_det" name="TanggalLahir_det" class="span12" value="{{ $TanggalLahir }}"  />
													</div>
												</div>
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
												<div class="control-group">
													<label class="control-label">Pekerjaan</label>
													<div class="controls">
														<input type="text" id="Pekerjaan_det" name="Pekerjaan_det" class="span12 no-primary" value="{{ $pasien->Pekerjaan }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">No. Telp.</label>
													<div class="controls">
														<input type="text" id="NoTelp_det" name="NoTelp_det" class="span12 no-primary" value="{{ $pasien->NoTelp }}"  />
													</div>
												</div>
											</div>
											<div class="span4">	
												<div class="control-group">
													<label class="control-label">Agama</label>
													<div class="controls">
														<input type="text" id="Agama_det" name="Agama_det" class="span12 no-primary" value="{{ $pasien->Agama }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Suku</label>
													<div class="controls">
														<input type="text" id="Suku_det" name="Suku_det" class="span12 no-primary" value="{{ $pasien->Suku }}"  />
													</div>
												</div>
											</div>
										</div>
										<hr />
										<div class="row-fluid">
											<div class="span4">							
												<div class="control-group">
													<label class="control-label">Gol. Pasien</label>
													<div class="controls">
														<input type="text" id="GolPasien_det" name="GolPasien_det" class="span12 no-primary" value="{{ $pasien->GolPasien }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Sub Gol Pasien</label>
													<div class="controls">
														<input type="text" id="SubGolPasien_det" name="SubGolPasien_det" class="span12 no-primary" value="{{ $pasien->SubGolPasien }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">No BPJS</label>
													<div class="controls">
														<input type="text" id="NoBPJS_det" name="NoBPJS_det" class="span12 no-primary" value="{{ $pasien->NoBPJS }}"  />
													</div>
												</div>
											</div>
											<div class="span4">	
												<div class="control-group">
													<label class="control-label">Gol. Askes</label>
													<div class="controls">
														<input type="text" id="GolAskes_det" name="GolAskes_det" class="span12 no-primary" value="{{ $pasien->GolAskes }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Gol. No. Askes</label>
													<div class="controls">
														<input type="text" id="GolNoAskes_det" name="GolNoAskes_det" class="span12 no-primary" value="{{ $pasien->GolNoAskes }}"  />
													</div>
												</div>
											</div>
											<div class="span4">	
												<div class="control-group">
													<label class="control-label">No Jamkesmas</label>
													<div class="controls">
														<input type="text" id="NoJamkesmas_det" name="NoJamkesmas_det" class="span12 no-primary" value="{{ $pasien->NoJamkesmas }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">No Jamkesda</label>
													<div class="controls">
														<input type="text" id="NoJamkesda_det" name="NoJamkesda_det" class="span12 no-primary" value="{{ $pasien->NoJamkesda }}"  />
													</div>
												</div>
											</div>
										</div>
										<hr />
										<div class="row-fluid">
											<div class="span4">							
											   <div class="control-group">
													<label class="control-label">Gol. Dinas</label>
													<div class="controls">
														<input type="text" id="GolDinas_det" name="GolDinas_det" class="span12 no-primary" value="{{ $pasien->GolDinas }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">No SEP Dinas</label>
													<div class="controls">
														<input type="text" id="NoSEPDinas_det" name="NoSEPDinas_det" class="span12 no-primary" value="{{ $pasien->NoSEPDinas }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">NRPNIP</label>
													<div class="controls">
														<input type="text" id="NRPNIP_det" name="NRPNIP_det" class="span12 no-primary" value="{{ $pasien->NRPNIP }}"  />
													</div>
												</div>
											</div>
											<div class="span4">
												<div class="control-group">
													<label class="control-label">Gol. Kesatuan</label>
													<div class="controls">
														<input type="text" id="GolKes_det" name="GolKes_det" class="span12 no-primary" value="{{ $pasien->GolKes }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Kesatuan</label>
													<div class="controls">
														<input type="text" id="Kesatuan_det" name="Kesatuan_det" class="span12 no-primary" value="{{ $pasien->Kesatuan }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Pangkat Gol.</label>
												  <div class="controls">
														<input type="text" id="PangkatGol_det" name="PangkatGol_det" class="span12 no-primary" value="{{ $pasien->PangkatGol }}"  />
													</div>
												</div>
											</div>
											<div class="span4">
												<div class="control-group">
													<label class="control-label">Hubungan</label>
													<div class="controls">
														<input type="text" id="Hub_det" name="Hub_det" class="span12 no-primary" value="{{ $pasien->Hub }}"  />
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">Jenis Hub.</label>
													<div class="controls">
														<input type="text" id="Jenishub_det" name="Jenishub_det" class="span12 no-primary" value="{{ $pasien->Jenishub }}"  />
													</div>
												</div>
											</div>
										</div>
										<hr />
										<div class="row-fluid">
											<div class="span4">							
												<div class="control-group">
													<label class="control-label">Gol. Swasta</label>
													<div class="controls">
														<input type="text" id="GolSwasta_det" name="GolSwasta_det" class="span12 no-primary" value="{{ $pasien->GolSwasta }}"  />
													</div>
												</div>
											</div>
											<div class="span4">	
											   <div class="control-group">
													<label class="control-label">No Kartu Swasta</label>
													<div class="controls">
														<input type="text" id="NoKartuSwasta_det" name="NoKartuSwasta_det" class="span12 no-primary" value="{{ $pasien->NoKartuSwasta }}"  />
													</div>
												</div>
											</div>
											<div class="span4">	
												<div class="control-group">
													<label class="control-label">Nama Perusahaan</label>
													<div class="controls">
														<input type="text" id="NamaPerusahaan_det" name="NamaPerusahaan_det" class="span12 no-primary" value="{{ $pasien->NamaPerusahaan }}"  />
													</div>
												</div>
											</div>
										</div>
									{{ Form::close() }}
						  		</div>
							</div>
					  	</div>
						
						<div class="accordion-group">
							<div class="accordion-heading">
						  		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="index.html#inap">
									<h5>Rawat Inap ({{ $inap }})</h5>
						  		</a>
							</div>
							<div id="inap" class="collapse">
						  		<div class="accordion-inner">
									<table id="tbl_inap" class="table table-striped table-bordered table-hover">
										<colgroup>
											<col class="con1" />
											<col class="con2" />
											<col class="con3" />
											<col class="con4" />
											<col class="con5" />
											<col class="con6" />
											<col class="con7" />
											<col class="con8" />
										</colgroup>
										<thead>
											<tr>
												<th align="center" valign="middle" class="head1">Tanggal</th>
												<th align="center" valign="middle" class="head2">Ruangan</th>
												<th align="center" valign="middle" class="head3">Kelas</th>
												<th align="center" valign="middle" class="head4">No Kamar</th>
												<th align="center" valign="middle" class="head5">Dokter</th>
												<th align="center" valign="middle" class="head6">Diagnosa</th>
												<th align="center" valign="middle" class="head7">Biaya</th>
												<th align="center" valign="middle" class="head8">Detail</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
									
									<script type="text/javascript">
										$(document).ready(function(){
										   var oTable = $('#tbl_inap').dataTable({
												"sPaginationType": "full_numbers",
												"bProcessing": false,
												"sAjaxSource": "{{ url('history_pasien/view_inap/'.$NoRM) }}",
												"bServerSide": true,
												"aoColumnDefs" : [
													{
														"aTargets" : [ 7 ],
														"sClass" : "center"
													}
												]
											});
									   });
									</script>
						  		</div>
							</div>
					  	</div>
						<div class="accordion-group">
							<div class="accordion-heading">
						  		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="index.html#jalan">
									<h5>Rawat Jalan ({{ $jalan }})</h5>
						  		</a>
							</div>
							<div id="jalan" class="collapse">
						  		<div class="accordion-inner">
									<table id="tbl_jalan" class="table table-striped table-bordered table-hover">
										<colgroup>
											<col class="con1" />
											<col class="con2" />
											<col class="con3" />
											<col class="con4" />
											<col class="con5" />
										</colgroup>
										<thead>
											<tr>
												<th align="center" valign="middle" class="head1">Tanggal</th>
												<th align="center" valign="middle" class="head2">Poli</th>
												<th align="center" valign="middle" class="head3">Dokter</th>
												<th align="center" valign="middle" class="head4">Diagnosis</th>
												<th align="center" valign="middle" class="head5">Detail</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
									
									<script type="text/javascript">
										$(document).ready(function(){
										   var oTable = $('#tbl_jalan').dataTable({
												"sPaginationType": "full_numbers",
												"bProcessing": false,
												"sAjaxSource": "{{ url('history_pasien/view_jalan/'.$NoRM) }}",
												"bServerSide": true,
												"aoColumnDefs" : [
													{
														"aTargets" : [ 4 ],
														"sClass" : "center"
													}
												]
											});
									   });
									</script>
						  		</div>
							</div>
					  	</div>
						<div class="accordion-group">
							<div class="accordion-heading">
						  		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionid" href="index.html#ugd">
									<h5>Rawat UGD ({{ $ugd }})</h5>
						  		</a>
							</div>
							<div id="ugd" class="collapse">
						  		<div class="accordion-inner">
									<table id="tbl_ugd" class="table table-striped table-bordered table-hover">
										<colgroup>
											<col class="con1" />
											<col class="con2" />
											<col class="con3" />
											<col class="con4" />
										</colgroup>
										<thead>
											<tr>
												<th align="center" valign="middle" class="head1">Tanggal</th>
												<th align="center" valign="middle" class="head2">Dokter</th>
												<th align="center" valign="middle" class="head3">Diagnosa</th>
												<th align="center" valign="middle" class="head4">Detail</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
									
									<script type="text/javascript">
										$(document).ready(function(){
										   var oTable = $('#tbl_ugd').dataTable({
												"sPaginationType": "full_numbers",
												"bProcessing": false,
												"sAjaxSource": "{{ url('history_pasien/view_ugd/'.$NoRM) }}",
												"bServerSide": true,
												"aoColumnDefs" : [
													{
														"aTargets" : [ 3 ],
														"sClass" : "center"
													}
												]
											});
									   });
									</script>
						  		</div>
							</div>
					  	</div>




					</div>
				</div>
			</div>
			
	   	</div>
	</div>
<input type="hidden" id="secret" name="secret" value="show" />
{{ Form::open(array('url' => 'history_pasien/view_rawat', 'method' => 'POST', 'id'=>'view_rawat_form')) }}
<input type="hidden" name="NoRM_rawat" id="NoRM_rawat" />
<input type="hidden" name="NoReg_rawat" id="NoReg_rawat" />
<input type="hidden" name="Tanggal_rawat" id="Tanggal_rawat" />
<input type="hidden" name="Ruangan_rawat" id="Ruangan_rawat" />
<input type="hidden" name="Kelas_rawat" id="Kelas_rawat" />
<input type="hidden" name="NoKamar_rawat" id="NoKamar_rawat" />
<input type="hidden" name="Dokter_rawat" id="Dokter_rawat" />
<input type="hidden" name="jenis_rawat" id="jenis_rawat" />
<input type="hidden" name="Diagnosis_rawat" id="Diagnosis_rawat" />
{{ Form::close() }}
@stop

@section('js')
    @parent
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
	{{ HTML::script('lib/datatables/fnReloadAjax.js') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
	{{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
			$('#close_modal_det').click(function() {
				 hide_modal('detail_data');
			});
        });

		function detailRawatInap(NoRM,NoReg,Tanggal,Ruangan,Kelas,NoKamar,Dokter,Diagnosis){
			$('#NoRM_rawat').val(NoRM);
			$('#NoReg_rawat').val(NoReg);
			$('#Tanggal_rawat').val(Tanggal);
			$('#Ruangan_rawat').val(Ruangan);
			$('#Kelas_rawat').val(Kelas);
			$('#NoKamar_rawat').val(NoKamar);
			$('#Dokter_rawat').val(Dokter);
			$('#Diagnosis_rawat').val(Diagnosis);
			$('#jenis_rawat').val('inap');
			$('#view_rawat_form').submit();
		}

		function detailRawatJalan(NoRM,NoReg,Tanggal,Poli,Dokter,Diagnosis){
			$('#NoRM_rawat').val(NoRM);
			$('#NoReg_rawat').val(NoReg);
			$('#Tanggal_rawat').val(Tanggal);
			$('#Ruangan_rawat').val(Poli);
			$('#Dokter_rawat').val(Dokter);
			$('#Diagnosis_rawat').val(Diagnosis);
			$('#jenis_rawat').val('jalan');
			$('#view_rawat_form').submit();
		}

		function detailRawatUgd(NoRM,NoReg,Tanggal,Dokter,Diagnosis){
			$('#NoRM_rawat').val(NoRM);
			$('#NoReg_rawat').val(NoReg);
			$('#Tanggal_rawat').val(Tanggal);
			$('#Dokter_rawat').val(Dokter);
			$('#Diagnosis_rawat').val(Diagnosis);
			$('#jenis_rawat').val('igd');
			$('#view_rawat_form').submit();
		}

        function detail_data(NoRM,Nama,Jkel,TempatLahir,TanggalLahir,Usia,Jalan,Kelurahan,Kecamatan,KotaKab,Provinsi,Agama,Pekerjaan,NoTelp,Status){
            
			$.ajax({
				url: "{{ url('history_pasien/count_year') }}",
				type: "POST",
				data : 	"NoRM="+NoRM,
				success:function(res){
					$('#isi_riwayat').html(res);
					$('#detail_data').modal('show');
				}
			});

			$('#view_det').attr('href','history_pasien/view/'+NoRM);
			$('#Nama_det').val(Nama);
			if(Jkel=='L')$('#Jkel_det').val('Laki-laki');
			else $('#Jkel_det').val('Perempuan');
			$('#TempatLahir_det').val(TempatLahir);
			$('#TanggalLahir_det').val(TanggalLahir);
			$('#Usia_det').val(Usia);
			$('#Jalan_det').val(Jalan+' '+Kelurahan+' '+Kecamatan+' '+KotaKab+' '+Provinsi);
			$('#Agama_det').val(Agama);
			$('#Pekerjaan_det').val(Pekerjaan);
			$('#NoTelp_det').val(NoTelp);
			$('#Status_det').val(Status);
        }

        function show_modal(name){
            $('#'+name).modal('show');
        }

        function hide_modal(name){
            $('#'+name).modal('hide');
        }

        function cetak_alert_modal_add(str){
            $('#error_msg_modal_add').show();
            $('#error_msg_modal_add').html(str);
        }

        function cetak_alert_modal_edit(str){
            $('#error_msg_modal_edit').show();
            $('#error_msg_modal_edit').html(str);
        }

        function cetak_info(str){
            $('#info_msg').show();
            $('#info_msg').html(str);
        }

        function cetak_alert(str){
            $('#error_msg').show();
            $('#error_msg').html(str);
        }
		
        function ndelik(){
            var val = $('#secret').val();
			if (val == 'show'){
				$('#coba').hide();
				$('#secret').val('hide');
			}
			else{
				$('#coba').show();
				$('#secret').val('show');
			}
        }
		
		
		function trim(s){
			string = s;
			string = string.replace(/^s+|s+$/g,"");
			while(string.indexOf("  ")>0){
				string = string.split("  ").join(" ");
			}
			return string;
		}
    </script>
@stop