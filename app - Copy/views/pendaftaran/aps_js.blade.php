<script type="text/javascript">
	
		$(document).ready(function(){
			var _tempID = "";
 			$('.no-primary').each(function(){
				$(this).attr('disabled','disabled');
			});

 			$('#btn_pasien_baru').click(function(){
            	pasien_baru();
            });

            $('#btn_baru').click(function(){
            	pasien_baru();
            });

            $('#cmb2_poli').select2();

            refreshPasien();

        	setInterval(function(){
        		refreshPasien();
        	}, 5000);
                
		});

		function pilih_desa(id,nama_desa,nama_kecamatan,nama_kabupaten,nama_provinsi){
            $('#id_desa').val(id);
            $('#txt_kelurahan').val(nama_desa);
            $('#txt_kecamatan').val(nama_kecamatan);
            $('#txt_kota').val(nama_kabupaten);
            $('#txt_provinsi').val(nama_provinsi);
            $('#cari_kelurahan').modal('hide');
        }

        function pasien_baru(){
            $('.no-primary').each(function(){
                $(this).attr('disabled',false);
            });

            $(':text.no-primary').each(function(){
                $(this).val('');
            });

            $('#no_reg_jalan').val('0');

            $('#txt_nama').val('');
            $('#txt_nama').attr('disabled',false);

            $('#btn_daftar').html('Daftar');
            

            
            _baru = "ya";

            $('#tipe_pasien').val('baru');

            $('#txt_pekerjaan').val('');
            $('#txt_kelurahan').val('');
            $('#id_desa').val('');
            $('#txt_kecamatan').val('');
            $('#txt_kota').val('');
            $('#txt_provinsi').val('');

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            var hours = today.getHours();
            var minutes = today.getMinutes();
            var seconds = today.getSeconds()
            if (hours < 10){
                hours = "0" + hours;
            }

            if (minutes < 10){
                minutes = "0" + minutes;
            }

            if (seconds < 10){
                seconds = "0" + seconds;
            }

            if(dd<10) {
                dd='0'+dd
            } 

            if(mm<10) {
                mm='0'+mm
            }
            //$('#cmb_tanggal_lahir').val(dd).trigger('change');
            //$('#cmb_bulan_lahir').val(mm).trigger('change');
            $//('#cmb_tahun_lahir').val(yyyy).trigger('change');
            $('#txt_tanggal_lahir').val(dd+'/'+mm+'/'+yyyy)
            $('#txt2_jam_masuk').val(hours+':'+minutes+':'+seconds);

            $('#btn_daftar').attr('disabled',false);
            $('#btn_baru').attr('disabled',false);
            $('.btn-cetak').attr('disabled','disabled');

            $('#pesan_error').hide();
        }

        $('#btn_daftar').click(function(){
        	var _nama		= $('#txt_nama').val();

        	var _jenkel 	= $('#cmb_jenkel').val();
        	var _tanggal 	= $('#txt_tanggal_lahir').val();

        	var _penunjang 	= $('#cmb2_poli').val();

        	cetak_alert('Mohon tunggu');

        	if( _nama.length < 3 ){
        		cetak_alert('Nama tidak boleh kosong');
        		$('#txt_nama').focus();
        	}
        	else if( _penunjang == "" ){
        		cetak_alert('Unit tidak boleh kosong');
        		$('#cmb2_poli').focus();
        	}
        	else{
        		$.ajax({
	        		url: "{{ url('pendaftaran/aps') }}",
	        		type: "POST",
	        		dataType: "json",
	        		data : $('#reg1_form').serialize(),
	        		success:function(nres){
	        			if(nres.pesan != 'sukses'){
	        				pesan = nres.pesan;

	        				$('#btn_daftar').attr('disabled',false);
	        				$('#btn_batal').attr('disabled',false);
	        			}
	        			else{
	        				pesan = "Pendaftaran pasien berhasil";
	        				$('#btn_cetak3').attr('target','{{ url("/pendaftaran/aps_struk/") }}/'+nres.noreg);
	        			}
	        			cetak_alert(pesan);
                        $.sticky(pesan, {speed : 3000, autoclose : true, position: "top-right", type: "st-info" });

                        refreshPasien();
	        		},
	        		error: function(x,e,m){
                        cetak_alert(e)
                    }
	        	});
        	}

        });

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }

        function refreshPasien(){
            $.ajax({
                url: "{{ url('pendaftaran/aps/list_pasien') }}",
                dataType: "json",
                success: function(res){
                    $('#tbl_pasien_hari tbody').html('');
                    if(res == false){
                        $('#tbl_pasien_hari > tbody').html('<tr><td colspan="4">Tidak ada pasien yang ditampilkan</td></tr>');
                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#tbl_pasien_hari tbody').append('<tr>'+
                                '<td><a href="#" onclick="ubahPendaftaran('+data.id+')">'+data.Nama+'</a></td>'+
                                '<td><a href="#" onclick="ubahPendaftaran('+data.id+')">'+data.NamaPenunjang+'</a></td>'+
                                '</tr>');
                        });
                    }
                }
            });
        }
</script>