	<script type="text/javascript">
		jQuery(document).ready(function(){
	        $('.no-primary').each(function(){
	        	$(this).attr('disabled','disabled');
	        })

	        $(".chzn_a").chosen({
                allow_single_deselect: true
            });

	    })

		function pasien_find(val,opt){
			if(opt == 'jalan'){
				target_url = "{{ url('rest/rawat_jalan') }}";
			}
			else if(opt == 'ugd'){
				target_url = "{{ url('rest/ugd') }}";
			}
			else {
				target_url = "{{ url('rest/rawat_inap') }}";
			} 
            $.ajax({
                url: target_url+'/'+val,
                dataType: "json",
                success: function(res){
	                if(res == false)
	                    alert('Data pasien tidak ditemukan');
	                else{
	                	$('#id_norm').val(res[0].NoRM);
	                    $('#txt_nama').val(res[0].Nama);
	                    $('#cmb_jenkel').val(res[0].Jkel)
	                    if( res[0].Tanggal != '' || res[0].Tanggal != '-'){
	                        var _tglArray = res[0].Tanggal.split("-");
	                        $('#txt_tanggal_masuk').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
	                    }
	                    else{
	                        $('#txt_tanggal_masuk').val(' ');
	                    }
	                    $('#txt_tempat_lahir').val(res[0].TempatLahir);
	                    if( res[0].TanggalLahir != '' || res[0].TanggalLahir != '-'){
	                        var _tglArray = res[0].TanggalLahir.split("-");
	                        $('#txt_tanggal_lahir').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
	                    }
	                    else{
	                        $('#txt_tanggal_lahir').val(' ');
	                    }
	                    $('#txt_alamat').val(res[0].Jalan);
	                    $('#txt_kelurahan').val(res[0].Kelurahan);
	                    $('#txt_kecamatan').val(res[0].Kecamatan);
	                    $('#txt_kota').val(res[0].KotaKab);
	                    $('#txt_provinsi').val(res[0].Provinsi);

	                    $('.opt-group').hide();
	                    if(opt == 'jalan'){
	                		$('#id_reg').val(res[0].NoRegJalan);
	                    	$('#poli_group').show();
	                    	$('#txt_poli').val(res[0].Poli);	
	                    	$('#txt_ruangan').val('');                    	
	                    }
	                    else if(opt == 'ugd'){
	                		$('#id_reg').val(res[0].NoRegUGD);
	                    	$('#txt_poli').val('');
	                    	$('#txt_ruangan').val('');
	                    }
	                    else{
	                		$('#id_reg').val(res[0].NoReg);
	                    	$('#ruangan_group').show();
	                    	$('#txt_poli').val('');
	                    	$('#txt_ruangan').val(res[0].Ruangan + ' '+ res[0].Kelas + ' Nomor:' +  res[0].NoKamar);
	                    }
	                    

	                    $('#cmb_golongan_pasien').val(res[0].GolPasien);
	                    dataSet();
	                    list_tindakan(opt);
                	}
                },
                error:function(res){
                    alert('Connection failed');
                }
            })
        }

        function dataSet(){
            //$('#no_rm').attr('disabled','disabled');
            //$('.no-primary').attr('disabled',false);
            $('.extra-fields').each(function(){
            	$(this).attr('disabled',false);
            	$(this).attr('readonly',false);
            });
        }

        function dataNotSet(){
            $('#no_rm').attr('disabled',false);
            $('.no-primary').attr('disabled','disabled');
        }

        function dokter_rawat(){
        	var val = $('#id_reg').val();
        	$.ajax({
                url: "{{ url('rest/dokter_rawat_inap') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                	$('#dokter_list tbody').html('');
	                if(res == false){

	                }
	                else{
	                	$.each(res, function (key, data) {
	                		$('#dokter_list tbody').append('<tr><td>'+data.NamaDokter+'</td><td>'+data.Spesialisasi+'</td>'+
	                			'<td><a href="javascript:void(0)" onclick="hapus_dokter('+"'"+data.NoReg+"'"+','+"'"+data.IDDokter+"'"+')"><i class="splashy-error_x"></i>'+
	                			'</a></td></tr>');
	                	});
	             	}
	            }
	        });
        }

        function hapus_dokter(NoReg,IdDokter){
        	$.ajax({
                url: "{{ url('rawat_inap/hapus_dokter') }}",
                type: "POST",
                data : "noreg="+NoReg+"&id_dokter="+IdDokter,
                success:function(res){
                	dokter_rawat();
                }
            });
        }

    	function pilih_pasien(id,opt){
    		if(opt == 'ugd'){
    			$('#cari_ugd').modal('hide');
    		}
    		else if(opt=='jalan'){
    			$('#cari_rawat_jalan').modal('hide');
    		}
    		else{
    			$('#cari_rawat_inap').modal('hide');
    		}
            
            $('#no_rm').val(id);
            pasien_find(id,opt);
        }

        function tambahkan_dokter(IdDokter){
        	var NoReg = $('#id_reg').val();
        	var txt_nama = $('#txt_nama').val();
        	var id_norm = $('#id_norm').val();
        	//alert(NoReg+' '+IdDokter+ ' '+('#txt_nama').val()+' '+$('#id_norm').val());
        	$('#cari_dokter').modal('hide');
        	$.ajax({
                url: "{{ url('rawat_inap/tambah_dokter') }}",
                type: "POST",
                data : "noreg="+NoReg+"&id_dokter="+IdDokter+"&nama="+txt_nama+"&norm="+id_norm,
                success:function(res){
                	dokter_rawat();
                }
            });
        }

        function list_tindakan(opt){
        	var val = $('#id_reg').val();
        	var target_url = '';
        	if(opt == 'jalan'){
        		target_url = "{{ url('rawat_jalan/list_tindakan') }}";
        	}
        	else if(opt == 'ugd'){
        		target_url = "{{ url('ugd/list_tindakan') }}";
        	}
        	else{
        		
        	}
        	target_url = "{{ url('pasien/list_tindakan') }}";
        	$.ajax({
                url: target_url+'/'+val,
                dataType: "json",
                success: function(res){
                	$('#tindakan_list tbody').html('');
	                if(res == false){

	                }
	                else{
	                	$.each(res, function (key, data) {
	                		$('#tindakan_list tbody').append('<tr><td>'+data.Tindakan+'</td><td>'+data.TanggalTindak+'</td><td>'+data.Gol+'</td>'+
	                			'<td><a href="javascript:void(0)" onclick="hapus_tindakan('+"'"+data.IdDetailTindak+"'"+')"><i class="splashy-error_x"></i>'+
	                			'</a></td></tr>');
	                	});
	             	}
	            }
	        });
        }

        function pilih_tindakan(IdTindakan,Tindakan,Gol){
        	$('#txt_jenis_tindakan').val(Tindakan);
        	$('#txt_id_tindakan').val(IdTindakan);
        	$('#txt_gol_tindakan').val(Gol)
            $('#cari_tindakan').modal('hide');
        }

        function tambah_tindakan(){
        	var id_tindakan = $('#txt_id_tindakan').val();
        	var tanggal_tindakan = $('#txt_tanggal_tindakan').val();
        	var tanggal_masuk = $('#txt_tanggal_masuk').val();
        	var tindakan = $('#txt_jenis_tindakan').val();
        	var gol = $('#txt_gol_tindakan').val()
        	var NoReg = $('#id_reg').val();
        	var id_norm = $('#id_norm').val();
        	if(tanggal_tindakan != '' && tindakan != '')
        	{
        		$.ajax({
	                url: "{{ url('pasien/tambah_tindakan') }}",
	                type: "POST",
	                data : "noreg="+NoReg+"&id_tindakan="+id_tindakan+"&tanggal_tindakan="+
	                		tanggal_tindakan+"&norm="+id_norm+"&tanggal_masuk="+tanggal_masuk+
	                		"&tindakan="+tindakan+"&gol="+gol+"&jenis_rawat=Laboratorium",
	                success:function(res){
	                	$('#txt_id_tindakan').val(' ')
	                	$('#txt_jenis_tindakan').val(' ')
	                	$('#txt_tanggal_tindakan').val(' ')
	                	list_tindakan();
	                }
	            });
        	}
        	
        }

        function hapus_tindakan(idTindakan){
        	var r = confirm("Hapus Tindakan");
			if (r == true) {
			    $.ajax({
	                url: "{{ url('pasien/hapus_tindakan') }}",
	                type: "POST",
	                data : "id_tindakan="+idTindakan,
	                success:function(res){
	                	list_tindakan();
	                }
	            });
			} else {
			    
			}
        	
        }
	</script>