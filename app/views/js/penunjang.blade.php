	<script type="text/javascript">
		jQuery(document).ready(function(){
	        $('.no-primary').each(function(){
	        	$(this).attr('disabled','disabled');
	        })

	        $(".chzn_a").chosen({
                allow_single_deselect: true
            });

            $('#cari_rawat_jalan').on('shown', function () {
                $("#tbl_pasien_jalan_filter input").focus();
            });

            $('#cari_rawat_inap').on('shown', function () {
                $("#tbl_pasien_inap_filter input").focus();
            });

            $('#cari_ugd').on('shown', function () {
                $("#tbl_ugd_filter input").focus();
            });

	    })

		function pasien_find(val,opt){
			if(opt == 'jalan'){
				target_url = "{{ url('rest/rawat_jalan_byreg') }}";
			}
			else if(opt == 'ugd'){
				target_url = "{{ url('rest/ugd_byreg') }}";
			}
			else {
				target_url = "{{ url('rest/rawat_inap_byreg') }}";
			} 

            $('#opt').val(opt);
            $.ajax({
                url: target_url+'/'+val,
                dataType: "json",
                success: function(res){
	                if(res == false)
	                    alert('Data pasien tidak ditemukan');
	                else{
	                	$('#id_norm').val(res[0].NoRM);
                        $('#no_rm').val(res[0].NoRM);
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
            var opt        = $('#opt').val();
            if( opt == 'RI' ){
                target_url = "{{ url('penunjang/list_tindakan_inap/'.$slug) }}";
            }
            else{
                target_url = "{{ url('penunjang/list_tindakan/'.$slug) }}";
            }
            
            $.ajax({
                url: target_url+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#tindakan_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            var slug = "{{ $slug }}";
                            var _html ='<tr><td>'+data.Tindakan+'</td><td>'+data.TanggalTindak+'</td><td>'+data.Gol+'</td>';
                            _html += "<td>"+data.JenisRawat+"</td>";
                            if( slug == data.JenisRawat){
                                 _html   += '<td><a href="javascript:void(0)" onclick="hapus_tindakan('+"'"+data.IdDetailTindak+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                            }
                            else{
                                _html   += '<td>-</td>'
                            }
                           
                            _html   +=    '</tr>';
                            $('#tindakan_list tbody').append(_html);
                        });
                    }
                }
            });
        }

        function pilih_tindakan(IdTindakan,Tindakan,Gol){
            tambah_tindakan(IdTindakan,Tindakan,Gol)
        }

        function tambah_tindakan(id_tindakan,tindakan,gol){
            $('#tindakan_message > .content').html('Proses.....');
            var tanggal_tindakan = $('#txt_tanggal_tindakan').val();
            var tanggal_masuk = $('#txt_tanggal_masuk').val();
            var NoReg = $('#id_reg').val();
            var id_norm = $('#id_norm').val();
            var id_reg = $('#id_jalan').val();
            var tipe    = $('#cmb_golongan_pasien').val();
            var opt     = $('#opt').val();
            if(tanggal_tindakan != '' && tindakan != '')
            {
                $.ajax({
                    url: "{{ url('penunjang/tambah_tindakan') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_tindakan="+id_tindakan+"&tanggal_tindakan="+
                            tanggal_tindakan+"&norm="+id_norm+"&tanggal_masuk="+tanggal_masuk+
                            "&id_reg="+id_reg+"&penjamin="+tipe+
                            "&opt="+opt+
                            "&tindakan="+tindakan+"&gol="+gol+"&jenis_rawat={{ $slug }}",
                    success:function(res){
                        list_tindakan();

                        $('#tindakan_message').addClass('alert-success');
                        $('#tindakan_message').removeClass('alert-error');
                        $('#tindakan_message > .content').html('Berhasil menambah tindakan');
                    }
                });
            }
            else{
                $('#tindakan_message').removeClass('alert-success');
                $('#tindakan_message').addClass('alert-error');
                $('#tindakan_message > .content').html('Mohon isikan tanggal tindakan');
                $('#txt_tanggal_tindakan').focus();
            }
            
        }

        function hapus_tindakan(idTindakan){
            var r       = confirm("Hapus Tindakan");
            var opt     = $('#opt').val();
            if (r == true) {
                if( opt == 'RI' ){
                    $.ajax({
                        url: "{{ url('rawat_inap/hapus_tindakan') }}",
                        type: "POST",
                        data : "id_tindakan="+idTindakan,
                        success:function(res){
                            list_tindakan();
                        }
                    });
                }
                else{
                    $.ajax({
                        url: "{{ url('pasien/hapus_tindakan') }}",
                        type: "POST",
                        data : "id_tindakan="+idTindakan,
                        success:function(res){
                            list_tindakan();
                        }
                    });
                }
                
            } else {
                
            }
            
        }

        function tambah_diagnosa(id_diagnosa,short,long){
            var NoReg = $('#id_reg').val();
            var txt_nama = $('#txt_nama').val();
            var id_norm = $('#id_norm').val();
            //alert(NoReg+' '+IdDokter+ ' '+('#txt_nama').val()+' '+$('#id_norm').val());
            $('#cari_dokter').modal('hide');
            $.ajax({
                url: "{{ url('rawat_jalan/tambah_diagnosa') }}",
                type: "POST",
                data : "noreg="+NoReg+"&id_diagnosa="+id_diagnosa+"&nama="+txt_nama+"&norm="+id_norm+
                        "&short="+short+"&long="+long,
                success:function(res){
                    $('#cari_diagnosa').modal('hide');
                    list_diagnosa();
                }
            });
        }

        function list_diagnosa(){
            var val = $('#id_reg').val();
            $.ajax({
                url: "{{ url('rawat_jalan/list_diagnosa') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#diagnosa_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#diagnosa_list tbody').append('<tr><td>'+data.IdDiag+'</td><td>'+data.ShortDiagnoisDesc+'</td><td>'+data.LongDiagnosisDesc+'</td>'+
                                '<td><a href="javascript:void(0)" onclick="hapus_diagnosa('+"'"+data.IdDiag+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td></tr>');
                        });
                    }
                }
            });
        }

        function hapus_diagnosa(id){
            var NoReg = $('#id_reg').val();
            var r = confirm("Apakah anda ingin menghapus Diagnosa");
            if (r == true) {
                $.ajax({
                    url: "{{ url('rawat_jalan/hapus_diagnosa') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_diagnosa="+id,
                    success:function(res){
                        list_diagnosa();
                    }
                });
            }
        }
	</script>