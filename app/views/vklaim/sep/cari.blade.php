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
                            <a href="{{ url('vklaim/sep/cari') }}">Data Peserta</a>
                        </li>
                        <li>
                             Cari SEP
                        </li>
                    </ul>
                </div>
            </nav>
			
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Data Peserta Dengan SEP : <font color="#0000FF"></font>
                        </h3>
						<div class="row-fluid">
							<div id="pesan_error" class="span12 alert alert-info" style="display:none;font-weight:bold;"></div>
						</div>
						<div class="row-fluid">							
							<div class="span6">
								<div class="control-group">
									<label class="control-label">No SEP</label>
									<div class="controls">
										<div class="input-append">
	                                        <input class="span8" name="no_sep" id="no_sep" type="text">
	                                        <button class="btn btn-warning" id="btn_cari_pasien" type="button"><i class="splashy-zoom"></i></button>
	                                    </div>
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group" align="right">
									<label class="control-label">Ketik HAPUS untuk menghapus</label>
									<div class="controls">
										<div class="input-append">
											<input type="text" id="text_hapus" name="text_hapus" class="span6">
											<button class="btn btn-danger" disabled="disabled" id="btn_hapus" type="button"><i class="splashy-error_x"></i>Hapus SEP</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Data Peserta</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">No Kartu BPJS</label>
									<div class="controls">
										<input type="text" id="no_kartu" name="no_kartu" class="span12 no-primary" value="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal SEP</label>
									<div class="controls">
										<input type="text" id="tgl_sep" name="tgl_sep" class="span12 no-primary" value="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">No RM</label>
									<div class="controls">
										<input type="text" id="norm" name="norm" class="span12 no-primary" value="" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Nama Peserta</label>
									<div class="controls">
										<input type="text" id="nama" name="nama" class="span12 no-primary" value="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Kelamin</label>
									<div class="controls">
										<input type="text" id="jenkel" name="jenkel" class="span12 no-primary" value="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Lahir</label>
									<div class="controls">
										<input type="text" id="tgl_lahir" name="tgl_lahir" class="span12 no-primary" value="" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Nama Jenis Peserta</label>
									<div class="controls">
										<input type="text" id="jenis_peserta" name="jenis_peserta" class="span12 no-primary" value="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Kelas</label>
									<div class="controls">
										<input type="text" id="kelas" name="kelas" class="span12 no-primary" value="" />
									</div>
								</div>
							</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Poli dan Kelas Perawatan</h4></label>
								</div>   
								<div class="control-group">
									<label class="control-label">Nama Poli</label>
									<div class="controls">
										<input type="text" id="poli" name="poli" class="span12 no-primary" value="" />
									</div>
								</div>
							</div>                          
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Tanggal Pulang</label>
									<div class="controls">
										<input type="text" id="tanggal_pulang" name="tanggal_pulang" class="span12 no-primary" 
										value="" />
									</div>
								</div>                            
								<div class="control-group">
									<label class="control-label">Catatan</label>
									<div class="controls">
										<input type="text" id="catatan" name="catatan" class="span12 no-primary" value="" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Diagnosa</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Nama Diagnosa</label>
									<div class="controls">
										<input type="text" id="diagnosa" name="diagnosa" class="span12 no-primary" value="" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Pelayanan</label>
									<div class="controls">
										<input type="text" id="jenis_pelayanan" name="jenis_pelayanan" class="span12 no-primary" value="" />
									</div>
								</div>  
							</div>
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
			$('.no-primary').each(function(){
				$(this).attr('disabled','disabled');
			});

			$('#btn_cari_pasien').click(function(){
				doCari();
			});

			$('#no_sep').bind('keydown',function(e){
				var code = e.keyCode || e.which
				if(code == 13) {
					doCari()
				}
			});

			function doCari(){
				var sep 	= $('#no_sep').val();
				cetak_alert('Mohon tunggu');
				if( sep != '' ){
					$.ajax({
		                url: "{{ url('vklaim/sep/cari/') }}"+'/'+sep,
		                dataType: "json",
		                timeout: 5000,
		                success: function(res){
		                	var meta	= res.metaData;
		                	if( meta.code == '200' ){
		                		var r 	= res.response;
		                		var pes = r.peserta;
		                		$('#tgl_sep').val( r.tglSep );
		                		$('#diagnosa').val( r.diagnosa );
		                		$('#jenis_pelayanan').val( r.jnsPelayanan );


		                		$('#nama').val( pes.nama );
		                		$('#tgl_lahir').val( pes.tglLahir );
		                		$('#norm').val( pes.noMr );
		                		$('#no_kartu').val( pes.noKartu );
		                		$('#kelas').val( pes.hakKelas );
		                		$('#jenis_peserta').val( pes.jnsPeserta );
		                		$('#kelamin').val( pes.kelamin );

		                		$('#poli').val( r.poli );

		                		cetak_alert('Data berhasil ditemukan');

		                		$("#btn_hapus").attr('disabled',false);
		                	}
		                	else{
		                		cetak_alert('Data tidak ditemukan');
		                		$('.no-primary').each(function(){
									$(this).val('');
								});

								$("#btn_hapus").attr('disabled','disabled');
		                	}
		                },
		                error: function(x, t, m) {
		                	if(t==="timeout") {
		                		cetak_alert("Timeout ke server BPJS");
		                	} else {
		                		cetak_alert(t);
		                	}

		                	$('.no-primary').each(function(){
								$(this).val('');
							});

							$("#btn_hapus").attr('disabled','disabled');
                        }
		            });
				}
				else{
					$('#no_sep').focus();
				}
				
			}

			function cetak_alert(str){
	            $('#pesan_error').show();
	            $('#pesan_error').html(str);
	        }

	        $('#btn_hapus').click(function(){
	        	var _hapus 	= $('#text_hapus').val();
	        	var sep 	= $('#no_sep').val();
	        	cetak_alert('Mohon tunggu');
	        	if( _hapus == 'HAPUS' ){
	        		$.ajax({
		                url: "{{ url('vklaim/sep/hapus') }}",
		                dataType: "json",
		                timeout: 5000,
		                type: "POST",
                    	data : "sep="+sep,
		                success: function(res){
		                	var meta	= res.metaData;
		                	if( meta.code == '200' ){
		                		cetak_alert(res.response+' berhasil dihapus');

		                		('.no-primary').each(function(){
									$(this).val('');
								});
		                	}
		                	else{
		                		cetak_alert(res.response);
		                	}
		                }
		            });
	        	}
	        	else{
	        		cetak_alert('Ketik HAPUS untuk menghapus SEP');
	        		$('#text_hapus').focus();
	        	}
	        })
        });
   </script>
@stop
