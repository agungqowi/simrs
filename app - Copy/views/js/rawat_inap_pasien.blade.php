	<script type="text/javascript">
		jQuery(document).ready(function(){
	        $('.no-primary').each(function(){
	        	$(this).attr('disabled','disabled');
	        })

	        $(".chzn_a").chosen({
                allow_single_deselect: true
            });

            $('#no_rm').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                	pasien_find( '' , $('#no_rm').val() );
                }
                    
            });

            <?php if(isset($reg) && $reg != '0' ): ?>
                pasien_find('<?php echo $reg ?>');
            <?php endif; ?>

            $('#btn_pasien_pulang').click(function(){
                pasien_pulang();
            });

            $('#btn_koreksi_ruangan').click(function(){
                do_koreksi_ruangan();
            });

            $('#btn_pindah_ruangan').click(function(){
                do_pindah_ruangan();
            })

            $('#btn_hapus').click(function(){
                var _id = $('#id_inap').val();
                hapus_riwayat( _id );
            })

            $('#cari_pasien').on('shown', function () {
                $("#tbl_pasien_filter input").focus();
            });

            $('#cari_pasien_belum_pulang').on('shown', function () {
                $("#tbl_pasien_belum_pulang_filter input").focus();
            });

            $('#btn_order_lab_modal').click(function(){
                $('#orderlab_content').modal('show');

                $('#orderlab_pesan').html('<u>Formulir Permintaan pemeriksaan lab (Baru)</u>')
            });

            $('#btn_order_rad_modal').click(function(){
                $('#orderrad_content').modal('show');

                $('#orderrad_pesan').html('<u>Formulir Permintaan pemeriksaan rontgen (Baru)</u>')
            });

            $('#btn_order_lab').click(function(){
                proses_orderlab('0');
                var _image  = "{{ url('img/load_gif.gif') }}";
                $('#orderlab_error').html("<img src='"+_image+"' />")
            });

            $('#btn_order_rad').click(function(){
                proses_orderrad('0');
                var _image  = "{{ url('img/load_gif.gif') }}";
                $('#orderrad_error').html("<img src='"+_image+"' />")
            });

            $('#qty_tindakan').change(function(){
                ubahTotalTindakan();
            });

            $('#btn_tindakan_tambah').click(function(){
                tambah_tindakan();
            });

            $('#ordergizi_pesan').hide();
            $('#btn_order_gizi').click(function(){
                proses_orderGizi();
            });
	    })

		function pasien_find(val,norm){
            var _url = "";
            if(val ==''){
               _url= $('#btn_order_gizi').click(function(){
                proses_orderGizi();
            });"{{ url('rest/rawat_inap_norm') }}"+'/'+norm;
            }
            else{
                _url= "{{ url('rest/rawat_inap_belum') }}"+'/'+val;
            }
            $.ajax({
                url: _url,
                dataType: "json",
                success: function(res){
	                if(res == false)
	                    alert('Pasien tidak berada dalam daftar rawat inap atau kode register yang dipilih salah');
	                else{
	                	$('#id_reg').val(res[0].NoReg);
                        $('#txt_no_reg').val(res[0].NoReg);
                        $('#txt_sep').val(res[0].Sep);
	                	$('#id_norm').val(res[0].NoRM);
                        $('#id_inap').val(res[0].IdInap);
                        $('#no_rm').val(res[0].NoRM);
	                    $('#txt_nama').val(res[0].Nama);
	                    $('#cmb_jenkel').val(res[0].Jkel);
	                    if( res[0].Tanggal != '' || res[0].Tanggal != '-'){
	                        var _tglArray = res[0].Tanggal.split("-");
	                        $('#txt_tanggal_masuk').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
	                    }
	                    else{
	                        $('#txt_tanggal_masuk').val(' ');
	                    }

                        if( res[0].StatusPulang == '0'){
                            $('#txt_keterangan').val('Pasien masih berada di ruangan');
                        }
                        else{
                            var _tglKeluar = res[0].TanggalPulang.split('-');
                            var tgl_keluar = _tglKeluar[2]+'/'+_tglKeluar[1]+'/'+_tglKeluar[0];
                            $('#txt_keterangan').val('Pasien sudah dipindahkan/pulang pada tanggal '+ tgl_keluar);
                        }

                        $('#id_reg_jalan').val(res[0].IdInap);
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

	                    $('#txt_ruangan').val(res[0].Ruangan + ' '+ res[0].Kelas + ' Nomor:' +  res[0].NoKamar);
                        $('#koreksi_ruangan_lama').val( $('#txt_ruangan').val() );
                        $('#pindah_ruangan_lama').val( $('#txt_ruangan').val() );
                        $('#id_ruangan').val(res[0].IdRuangan);
                        $('#nama_ruangan').val(res[0].Ruangan);

	                    $('#cmb_golongan_pasien').val(res[0].CaraBayar);
	                    dataSet();
	                    dokter_rawat();
	                    list_tindakan();
                        list_diagnosa();
                        list_ruangan();
                        list_lab();
                        list_gizi();
                        //listVisite();
                        
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
	                		$('#dokter_list tbody').append('<tr><td>'+data.NamaDokter+'</td><td>'+data.nama+'</td><td>'+data.Kategori+'</td>'+
	                			'<td><a href="javascript:void(0)" onclick="hapus_dokter('+"'"+data.NoReg+"'"+','+"'"+data.IDDokter+"'"+')"><i class="splashy-error_x"></i>'+
	                			'</a></td></tr>');
	                	});
	             	}
	            }
	        });

            listDokterVisite();
        }

        function hapus_dokter(NoReg,IdDokter){
            var r = confirm("Apakah anda ingin menghapus dokter");
            if (r == true) {
            	$.ajax({
                    url: "{{ url('rawat_inap/hapus_dokter') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_dokter="+IdDokter,
                    success:function(res){
                    	dokter_rawat();
                    }
                });
            }
        }

    	function pilih_pasien(id_reg,id_norm){
            $('#cari_pasien').modal('hide');
            $('#cari_pasien_belum_pulang').modal('hide');
            //$('#no_rm').val(id_norm);
            pasien_find(id_reg,id_norm);
        }

        function pilih_dokter(IdDokter,NamaDokter){
            $('#id_dokter').val(IdDokter),
            $('#txt_pilih_dokter').val(NamaDokter);
            $('#cari_dokter').modal('hide');
        }

        function pilih_dokterTindakan(IdDokter,NamaDokter){
            $('#id_dokter_tindakan').val(IdDokter),
            $('#txt_dokter_tindakan').val(NamaDokter);
            $('#cari_dokter_tindakan').modal('hide');
        }

        function pilih_perawatTindakan(IdPerawat,NamaPerawat){
            $('#id_perawat_tindakan').val(IdPerawat),
            $('#txt_perawat_tindakan').val(NamaPerawat);
            $('#cari_perawat_tindakan').modal('hide');
        }

        function tambah_dokter(){
        	var NoReg = $('#id_reg').val();
        	var txt_nama = $('#txt_nama').val();
        	var id_norm = $('#id_norm').val();
            var id_dokter = $('#id_dokter').val();
            var kategori = $('#kategori_dokter').val();

            if(id_dokter == ''){
                alert('Pilih Dokter terlebih dahulu');
                $('#cari_dokter').modal('show');
            }
            else{

                $.ajax({
                    url: "{{ url('rawat_inap/tambah_dokter') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_dokter="+id_dokter+"&nama="+txt_nama+"&norm="+id_norm+"&kategori="+kategori,
                    success:function(res){
                        dokter_rawat();
                    }
                });
            }
        }

        function list_tindakan(){
        	var val = $('#id_reg').val();
            $.ajax({
                url: "{{ url('rawat_inap/list_tindakan') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#tindakan_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        var total_tarif     = 0;
                        $.each(res, function (key, data) {
                            var slug = $('#nama_ruangan').val();
                            var _html ='<tr><td>'+data.Tindakan+'</td><td>'+data.TanggalTindak+'</td><td>'+data.NamaDokter+'</td><td>'+data.NamaPerawat+'</td>';
                            var harga_satuan       = data.HargaSatuan;
                            total_tarif            = total_tarif + data.Tarif;
                            _html += "<td style='text-align:right;'>"+harga_satuan+"</td>";
                            _html += "<td style='text-align:right;'>"+data.Qty+"</td>";
                            _html += "<td style='text-align:right;'>"+data.Tarif+"</td>";
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

        function pilih_tindakan(IdTindakan,Tindakan,Gol,Tarif){
            $('#id_tindakan').val(IdTindakan);
            $('#nama_tindakan').val(Tindakan);
            $('#gol_tindakan').val(Gol);
            $('#txt_tarif').val(Tarif);
            $('#qty_tindakan').val(1);
            $('#txt_total').val(Tarif);

            ubahTotalTindakan();

            $('#cari_tindakan').modal('hide');
        }

        function tambah_tindakan(){
            $('#tindakan_message').show();
            $('#tindakan_message > .content').html('Proses.....');
            var tanggal_tindakan    = $('#txt_tanggal_tindakan').val();
            var tanggal_masuk       = $('#txt_tanggal_masuk').val();
            var NoReg               = $('#id_reg').val();
            var id_norm             = $('#id_norm').val();
            var id_tindakan         = $('#id_tindakan').val();
            var gol                 = $('#gol_tindakan').val();
            var id_dokter           = $('#id_dokter_tindakan').val();
            var id_perawat          = $('#id_perawat_tindakan').val();
            var jam_tindakan        = $('#jam_tindakan').val();
            var tindakan            = $('#nama_tindakan').val();

            if(tanggal_tindakan != '' && id_tindakan != '')
            {
                $.ajax({
                    url: "{{ url('rawat_inap/tambah_tindakan') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_tindakan="+id_tindakan+"&tanggal_tindakan="+
                            tanggal_tindakan+"&norm="+id_norm+"&tanggal_masuk="+tanggal_masuk+
                            "&qty="+$('#qty_tindakan').val()+
                            "&id_dokter="+id_dokter+"&jam_tindakan="+jam_tindakan+"&id_perawat="+id_perawat+
                            "&tindakan="+tindakan+"&gol="+gol+"&jenis_rawat="+$('#nama_ruangan').val(),
                    success:function(res){
                        list_tindakan();

                        $('#tindakan_message').addClass('alert-success');
                        $('#tindakan_message').removeClass('alert-error');
                        $('#tindakan_message > .content').html('Berhasil menambah tindakan');

                        $('#id_dokter_tindakan').val('');
                        $('#id_perawat_tindakan').val('');
                        $('#nama_tindakan').val('');
                        $('#id_tindakan').val('');
                        $('#qty_tindakan').val('1');
                        $('#txt_tarif').val('');
                        $('#txt_total').val('');

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

        function hapus_tindakan(IdTindakan){
            var r = confirm("Apakah anda ingin menghapus tindakan");
            if (r == true) {
                $.ajax({
                    url: "{{ url('rawat_inap/hapus_tindakan') }}",
                    type: "POST",
                    data : "id_tindakan="+IdTindakan,
                    success:function(res){
                        list_tindakan();

                        $.sticky("Tindakan berhasil dihapus", {speed : 'slow', autoclose : true, position: "top-right", type: "st-info" });
                    }
                });
            }
        }

        function pasien_pulang(){
            var tanggal_pulang = $('#tgl_pulang').val();
            var jam_pulang = $('#jam_pulang').val();
            var kondisi_pulang = $('#kondisi_pulang').val();
            var cara_pulang = $('#cara_pulang').val();
            var id_register = $('#id_reg').val();
            var no_rm = $('#no_rm').val();
            var tanggal_masuk = $('#txt_tanggal_masuk').val();
            var id_ruangan = $('#id_ruangan').val();
            var id_inap = $('#id_inap').val();

            $.ajax({
                url: "{{ url('rawat_inap/pasien_pulang') }}",
                type: "POST",
                data : "tanggal_pulang="+tanggal_pulang+"&jam_pulang="+jam_pulang+"&id_ruangan="+id_ruangan+
                        "&kondisi_pulang="+kondisi_pulang+"&cara_pulang="+cara_pulang+
                        "&id_register="+id_register+"&no_rm="+no_rm+"&tanggal_masuk="+tanggal_masuk+
                        "&id_inap="+id_inap,
                success:function(res){
                    if(res == 'false'){
                        alert('Pasien tidak dapat dipulangkan, cek tanggal pulang dan tanggal masuk');
                    }
                    else{
                        location.reload();
                    }
                    //alert('Pasien berhasil dipulangkan');
                    
                }
            });
        }

        function pilih_diagnosa(id_diagnosa,_short,_long){
            $('#id_diagnosa').val( id_diagnosa );
            $('#txt_pilih_diagnosa').val( _short );
            $('#long_diagnosa').val(_long)
            $('#cari_diagnosa').modal('hide');
        }

        function tambah_diagnosa(){
            var NoReg       = $('#id_reg').val();
            var txt_nama    = $('#txt_nama').val();
            var id_norm     = $('#id_norm').val();
            var id_diagnosa = $('#id_diagnosa').val();
            var tanggal_diagnosa    = $('#tanggal_diagnosa').val();
            var status_diagnosa     = $('#status_diagnosa').val();
            var _short      = $('#txt_pilih_diagnosa').val();
            var _long       = $('#long_diagnosa').val();
            //alert(NoReg+' '+IdDokter+ ' '+('#txt_nama').val()+' '+$('#id_norm').val());
            $.ajax({
                url: "{{ url('diagnosa/tambah_diagnosa') }}",
                type: "POST",
                data : "noreg="+NoReg+"&id_diagnosa="+id_diagnosa+"&nama="+txt_nama+"&norm="+id_norm+
                        "&short="+_short+"&long="+_long+"&tanggal="+tanggal_diagnosa+"&status="+status_diagnosa+"&jenis_rawat="+$('#nama_ruangan').val(),
                success:function(res){
                    $('#cari_diagnosa').modal('hide');

                    $('#id_diagnosa').val( '' );
                    $('#txt_pilih_diagnosa').val( '' );
                    $('#long_diagnosa').val( '' )
                    $('#status_diagnosa').val('')

                    list_diagnosa();
                }
            });
        }

        function list_diagnosa(){
            var val     = $('#id_reg').val();
            var _jenis  = $('#nama_ruangan').val();
            $.ajax({
                url: "{{ url('diagnosa/list_diagnosa') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#diagnosa_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            var _html ="<tr>";
                            _html += '<td>'+data.IdDiag+'</td>';
                            _html += '<td>'+data.ShortDiagnoisDesc+'</td>';
                            _html += '<td>'+data.tanggal+'</td>';
                            _html += '<td>'+data.status+'</td>';
                            _html += '<td>'+data.JenisRawat+'</td>';

                            if( _jenis == data.JenisRawat){
                                _html += '<td><a href="javascript:void(0)" onclick="hapus_diagnosa('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i></a></td>';
                            }
                            else{
                                _html += "<td>-</td>";
                            }                            
                            _html += "</tr>";
                            $('#diagnosa_list tbody').append(_html);
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
                    url: "{{ url('diagnosa/hapus_diagnosa') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_diagnosa="+id,
                    success:function(res){
                        list_diagnosa();
                    }
                });
            }
        }

        function ubahTotalTindakan(){
            var qty     = parseInt( $('#qty_tindakan').val() );
            var tarif   = parseInt( $('#txt_tarif').val() );
            var total   = qty * tarif;

            $('#txt_total').val( total );
        }

        function list_ruangan(){
            var val = $('#id_reg').val();
            $.ajax({
                url: "{{ url('rawat_inap/list_ruangan') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#koreksi_list tbody').html('');
                    $('#pindah_list tbody').html('');
                    if(res == false){}
                    else{
                        $.each(res, function (key, data) {
                            $('#koreksi_list tbody').append('<tr><td>'+data.Tanggal+'</td><td>'+data.RuanganLama+'</td><td>'+data.RuanganBaru+'</td>'+
                                '<td></td></tr>');
                        });

                        $.each(res, function (key, data) {
                            $('#pindah_list tbody').append('<tr><td>'+data.Tanggal+'</td><td>'+data.RuanganLama+'</td><td>'+data.RuanganBaru+'</td>'+
                                '<td></td></tr>');
                        });
                    }
                }
            });

            $('#tbl_koreksi_ruangan').dataTable().fnReloadAjax();
            $('#tbl_pindah_ruangan').dataTable().fnReloadAjax();
        }

        function pilih_ruangan(id_ruangan,nama,kelas,no_kamar){
            $('#koreksi_ruangan_baru').val(nama + ' '+kelas+' No Kamar:'+no_kamar);
            $('#id_koreksi_ruangan_baru').val(id_ruangan);
            $('#nama_koreksi_ruangan_baru').val(nama);
            $('#kelas_koreksi_ruangan_baru').val(kelas);
            $('#no_koreksi_ruangan_baru').val(no_kamar);
            $('#koreksi_ruangan').modal('hide');
        }

        function do_koreksi_ruangan(){
            var NoReg = $('#id_reg').val();
            var txt_nama = $('#txt_nama').val();
            var id_norm = $('#id_norm').val();
            var id_ruangan_lama = $('#id_ruangan').val();
            var nama_ruangan_lama = $('#nama_ruangan').val();            
            var id_ruangan_baru = $('#id_koreksi_ruangan_baru').val();
            var nama_ruangan_baru = $('#nama_koreksi_ruangan_baru').val();
            var kelas_ruangan_baru = $('#kelas_koreksi_ruangan_baru').val();
            var no_ruangan_baru = $('#no_koreksi_ruangan_baru').val();
            var tanggal = $('#txt_tanggal_masuk').val();

            if(id_ruangan_baru == ''){
                alert('Pilih Ruangan terlebih dahulu');
            }
            else{
                $.ajax({
                    url: "{{ url('rawat_inap/tambah_koreksi_ruangan') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&nama="+txt_nama+"&norm="+id_norm+"&id_ruangan_lama="+id_ruangan_lama+
                            "&nama_ruangan_lama="+nama_ruangan_lama+"&id_ruangan_baru="+id_ruangan_baru+
                            "&nama_ruangan_baru="+nama_ruangan_baru+"&tanggal="+tanggal+
                            "&kelas_ruangan_baru="+kelas_ruangan_baru+"&no_ruangan_baru="+no_ruangan_baru,
                    success:function(res){
                        /*refresh ruangan*/
                        alert('Koreksi Ruangan berhasil');
                        list_ruangan();
                        /*Ubah field data lama*/
                        $('#id_ruangan').val( $('#id_koreksi_ruangan_baru').val() );
                        $('#nama_ruangan').val( $('#nama_koreksi_ruangan_baru').val() );
                        $('#txt_ruangan').val( $('#koreksi_ruangan_baru').val() )
                        $('#koreksi_ruangan_lama').val( $('#txt_ruangan').val() );

                        /*hapus field data baru*/
                        $('#id_koreksi_ruangan_baru').val('');
                        $('#nama_koreksi_ruangan_baru').val('');
                        $('#koreksi_ruangan_baru').val('');
                        $('#kelas_koreksi_ruangan_baru').val('');
                        $('#no_koreksi_ruangan_baru').val('');
                    }
                });
            }
        }

        function pilih_pindah_ruangan(id_ruangan,nama,kelas,no_kamar){
            $('#pindah_ruangan_baru').val(nama + ' '+kelas+' No Kamar:'+no_kamar);
            $('#id_pindah_ruangan_baru').val(id_ruangan);
            $('#nama_pindah_ruangan_baru').val(nama);
            $('#kelas_pindah_ruangan_baru').val(kelas);
            $('#no_pindah_ruangan_baru').val(no_kamar);
            $('#pindah_ruangan').modal('hide');
        }

        function do_pindah_ruangan(){
            var NoReg = $('#id_reg').val();
            var txt_nama = $('#txt_nama').val();
            var id_norm = $('#id_norm').val();
            var id_ruangan_lama = $('#id_ruangan').val();
            var nama_ruangan_lama = $('#nama_ruangan').val();            
            var id_ruangan_baru = $('#id_pindah_ruangan_baru').val();
            var nama_ruangan_baru = $('#nama_pindah_ruangan_baru').val();
            var kelas_ruangan_baru = $('#kelas_pindah_ruangan_baru').val();
            var no_ruangan_baru = $('#no_pindah_ruangan_baru').val();
            var tanggal = $('#pindah_tanggal').val();
            var tanggal_masuk = $('#txt_tanggal_masuk').val();
            var id_inap = $('#id_inap').val();

            if(tanggal == ''){
                alert('Pilih tanggal terlebih dahulu');
            }
            else if(id_ruangan_baru == ''){
                alert('Pilih Ruangan terlebih dahulu');
            }
            else{
                $.ajax({
                    url: "{{ url('rawat_inap/tambah_pindah_ruangan') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&nama="+txt_nama+"&norm="+id_norm+"&id_ruangan_lama="+id_ruangan_lama+
                            "&nama_ruangan_lama="+nama_ruangan_lama+"&id_ruangan_baru="+id_ruangan_baru+
                            "&nama_ruangan_baru="+nama_ruangan_baru+"&tanggal="+tanggal+
                            "&kelas_ruangan_baru="+kelas_ruangan_baru+"&no_ruangan_baru="+no_ruangan_baru+
                            "&tanggal_masuk="+tanggal_masuk+"&id_inap="+id_inap,
                    success:function(res){
                        if(res == 'false'){
                            alert("Tidak dapat melakukan pindah ruangan, mohon periksa tanggal pindah");
                        }
                        else{
                            /*refresh ruangan*/
                            alert('Pindah Ruangan berhasil');
                            list_ruangan();

                            //location.reload();

                            /*
                            $('#tbl_pindah_ruangan').dataTable().fnReloadAjax();
                            $('#tbl_pasien').dataTable().fnReloadAjax();
                            $('#tbl_pasien_belum_pulang').dataTable().fnReloadAjax();

                            pasien_find( $('#id_inap').val() , $('#id_norm').val() );
                            $('#id_pindah_ruangan_baru').val('');
                            $('#nama_pindah_ruangan_baru').val('');
                            $('#pindah_ruangan_baru').val('');
                            $('#kelas_pindah_ruangan_baru').val('');
                            $('#no_pindah_ruangan_baru').val('');
                            */

                            /*Ubah field data lama*/
                            /*
                            $('#id_ruangan').val( $('#id_pindah_ruangan_baru').val() );
                            $('#nama_ruangan').val( $('#nama_pindah_ruangan_baru').val() );
                            $('#txt_ruangan').val( $('#pindah_ruangan_baru').val() )
                            $('#koreksi_ruangan_lama').val( $('#txt_ruangan').val() );
                            */

                            /*hapus field data baru*/
                           
                        }
                        
                    }
                });
            }
        }

        function hapus_riwayat(_id)
        {
            var r = confirm("Apakah anda ingin menghapus riwayat pasien ini?");
            if(r){
                $.ajax({
                    url: "{{ url('pasien/hapus_riwayat') }}",
                    data : "id="+_id+"&type=inap",
                    dataType: "json",
                    type : "POST",
                    success: function(res){
                        $.sticky("Riwayat pasien berhasil dihapus", {speed : 'slow', autoclose : true, position: "top-right", type: "st-info" });

                        setTimeout(function(){
                                 window.location.href = "{{ url('registrasi_harian/rawat_inap') }}";
                            }, 3000);;
                    }
                });
            }
        }

        function listDokterVisite(){
            var val = $('#id_reg').val();
            $.ajax({
                url: "{{ url('rawat_inap/list_dokter_visite') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#dokter_visite').html('<option value="">-</option>');
                    $('#dokter_pengirim').html('<option value="">-</option>');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            var _html = "<option value='"+data.IDDokter+"'>"+data.NamaDokter+"</option>";
                            $('#dokter_visite').append(_html);
                            $('#dokter_pengirim').append(_html);
                        });
                    }
                }
            });
        }

        function listVisite(){
            var val = $('#id_reg').val();
            $.ajax({
                url: "{{ url('rawat_inap/list_visite') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#dokter_visite_list tbody').html('');
                    if(res == false){}
                    else{

                        $.each(res, function (key, data) {

                            var _html = '<tr><td>'+data.NamaDokter+'</td><td>'+data.Tanggal+'</td><td>'+data.Jam+'</td><td>'+data.Catatan+'</td>';

                            _html += '<td><a href="javascript:void(0)" onclick="hapusVisite('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i></a></td></tr>';

                            $('#dokter_visite_list tbody').append( _html );
                        });
                    }
                }
            });
        }

        function hapusVisite(_id)
        {
            var r = confirm("Apakah anda ingin menghapus visite ini?");
            if(r){
                $.ajax({
                    url: "{{ url('rawat_inap/hapus_visite') }}",
                    data : "id="+_id,
                    dataType: "json",
                    type : "POST",
                    success: function(res){
                        $.sticky("Riwayat visite berhasil dihapus", {speed : 'slow', autoclose : true, position: "top-right", type: "st-info" });
                        //location.reload();

                        listVisite();
                    }
                });
            }
        }

        function tambahVisite(){
            var NoReg               = $('#id_reg').val();
            var dokter_visite       = $('#dokter_visite').val();
            var tanggal_visite      = $('#tanggal_visite').val();
            var jam_visite          = $('#jam_visite').val();
            var catatan_visite      = $('#catatan_visite').val();
            //alert(NoReg+' '+IdDokter+ ' '+('#txt_nama').val()+' '+$('#id_norm').val());
            $.ajax({
                url: "{{ url('rawat_inap/tambah_visite') }}",
                type: "POST",
                data : "noreg="+NoReg+"&dokter_visite="+dokter_visite+"&tanggal_visite="+tanggal_visite+
                        "&jam_visite="+jam_visite+"&catatan_visite="+catatan_visite,
                success:function(res){
                    $('#cari_diagnosa').modal('hide');

                    $('#dokter_visite').val( '' );
                    $('#catatan_visite').val( '' );
                    $('#jam_visite').val( '' )

                    listVisite();
                }
            });
        }

        function proses_orderlab(_force){
            var number_lab      = $('input[name="data_lab[]"]:checked').length;
            var noreg           = $('#id_reg').val();
            var id_pemeriksaan  = $('#id_pemeriksaan').val();
            var ids             = $('#ids_pemeriksaan').val();
            var tanggal         = $('#tanggal_lab').val();
            var id_reg_jalan    = $('#id_reg_jalan').val();
            if( number_lab > 0 && noreg != ''){
                $('#lab_noreg').val(noreg);
                console.log('ss');
                var data_lab    = { 'lab[]' : [] };
                var loop_data   = $("input[name='data_lab[]']:checked");
                console.log('cc');
                var proses_order    = 0;

                $(loop_data).each(function(){
                    data_lab['lab[]'].push( $(this).val() );
                });

                data_lab['noreg']           = noreg;
                data_lab['id_reg_jalan']    = $('#id_inap').val();
                data_lab['id_pemeriksaan']  = id_pemeriksaan;
                data_lab['asal']            = 'Ruangan '+ $('#nama_ruangan').val();
                data_lab['norm']            = $('#no_rm').val();
                data_lab['jenis_rawat']     = 'RI';
                data_lab['nama']            = $('#txt_nama').val();
                data_lab['tanggal']         = tanggal;

                if( _force == '1' ){
                    proses_order = 1;
                }
                else{
                    if( id_pemeriksaan == '' && ids != '' ){
                        
                        var r = confirm("Pasien telah melakukan permintaan pemeriksaan lab sebelumnya, apakah anda akan memproses permintaan ini?" );
                            
                        if (r == true) {
                            $.ajax({
                                url: "{{ url('lab/permintaan') }}",
                                type: "POST",
                                dataType: "json",
                                data : data_lab,
                                success:function(res){
                                    if(res.status == 'success'){
                                        $('#orderlab_error').html(res.pesan);
                                    }
                                    else{
                                        $('#orderlab_error').html(res.pesan);
                                    }

                                    list_lab();
                                }
                            });
                        }
                    }
                    else{
                        proses_order = 1;
                    }
                }
                    
                console.log('dd');
                if( proses_order == 1 ){
                    $.ajax({
                        url: "{{ url('lab/permintaan') }}",
                        type: "POST" ,
                        dataType: "json",
                        data : data_lab,
                        success:function(res){
                            if(res.status == 'success'){
                                $('#orderlab_error').html(res.pesan);
                            }
                            else{
                                $('#orderlab_error').html(res.pesan);
                            }

                            list_lab();
                        }
                    });
                }
                    
            }
            else{
                $('orderlab_error').html("Mohon pilih pemeriksaan lab terlebih dahulu");
            }
        }

        function list_lab(){
            var val = $('#id_reg').val();
            var _image  = "{{ url('img/load_gif.gif') }}";

            $('#ids_pemeriksaan').val('');
            $('#orderlab_list tbody').html('<tr><td align="center" colspan="4"><img src="'+_image+'"</td></tr>');
            $.ajax({
                url: "{{ url('rawat_jalan/list_lab') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#orderlab_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#ids_pemeriksaan').val(data.id);
                            var _status = "Menunggu antrian";
                            /*
                            var _action = '<td><a href="javascript:void(0)" onclick="edit_lab('+"'"+data.id+"'"+')"><i class="splashy-pencil"></i>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="hapus_lab('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                                */
                             var _action = '<td><a href="javascript:void(0)" onclick="hapus_lab('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                            if( data.status == '0'){

                            }
                            else if(data.status == '1'){
                                _status = "Sedang di proses";
                                _action = '<td></td>';
                            }
                            else if(data.status == '2'){
                                _status = "Pemeriksaan selesai";
                                _action = '<td></td>';
                            }

                            $('#orderlab_list tbody').append('<tr><td>'+data.tanggal+'</td><td>'+data.kategori+'</td><td>'+_status+'</td>'+ _action+'</tr>');
                        });
                    }
                }
            });
        }

        function hapus_lab(id_hapus){
            if(id_hapus != ""){
                var r = confirm("Apakah anda ingin menghapus data permintaan lab \nNo RM:"+$('#no_rm').val()+"\nNama:"+$('#txt_nama').val()+"\nPoli:"+$('#txt_poli').val() );
                if (r == true) {
                    $.ajax({
                        url: "{{ url('ugd/hapus_lab') }}",
                        type: "POST",
                        dataType: "json",
                        data : "id="+id_hapus,
                        success:function(res){
                            $.sticky(res.pesan, {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });

                            list_lab();
                        }
                    });
                }
            }
        }

        function proses_orderrad(_force){
            var number_rad      = $('input[name="data_rad[]"]:checked').length;
            var noreg           = $('#id_reg').val();
            var id_pemeriksaan  = $('#id_radiologi').val();
            var ids             = $('#ids_radiologi').val();
            var tanggal         = $('#tanggal_rad').val();
            if( number_rad > 0 && noreg != ''){
                $('#rad_noreg').val(noreg);
                var data_lab    = { 'rad[]' : [] };
                var loop_data   = $("input[name='data_rad[]']:checked");
                console.log('cc');
                var proses_order    = 0;

                $(loop_data).each(function(){
                    data_lab['rad[]'].push( $(this).val() );
                });

                data_lab['noreg']           = noreg;
                data_lab['id_pemeriksaan']  = id_pemeriksaan;
                data_lab['asal']            = 'Ruangan ' + $('#nama_ruangan').val();
                data_lab['norm']            = $('#no_rm').val();
                data_lab['nama']            = $('#txt_nama').val();
                data_lab['tanggal']         = tanggal;
                data_lab['jenis_rawat']     = 'RJ';

                if( _force == '1' ){
                    proses_order = 1;
                }
                else{
                    if( id_pemeriksaan == '' && ids != '' ){
                        
                        var r = confirm("Pasien telah melakukan permintaan pemeriksaan radiologi sebelumnya, apakah anda akan memproses permintaan ini?" );
                            
                        if (r == true) {
                            $.ajax({
                                url: "{{ url('radiologi/permintaan') }}",
                                type: "POST",
                                dataType: "json",
                                data : data_lab,
                                success:function(res){
                                    if(res.status == 'success'){
                                        $('#orderrad_error').html(res.pesan);
                                    }
                                    else{
                                        $('#orderrad_error').html(res.pesan);
                                    }

                                    list_rad();
                                }
                            });
                        }
                    }
                    else{
                        proses_order = 1;
                    }
                }
                    
                if( proses_order == 1 ){
                    $.ajax({
                        url: "{{ url('radiologi/permintaan') }}",
                        type: "POST" ,
                        dataType: "json",
                        data : data_lab,
                        success:function(res){
                            if(res.status == 'success'){
                                $('#orderrad_error').html(res.pesan);
                            }
                            else{
                                $('#orderrad_error').html(res.pesan);
                            }

                            list_rad();
                        }
                    });
                }
                    
            }
            else{
                $('orderrad_error').html("Mohon pilih pemeriksaan radiologi terlebih dahulu");
            }
        }

        function list_rad(){
            var val = $('#id_reg').val();
            var _image  = "{{ url('img/load_gif.gif') }}";

            $('#ids_radiologi').val('');
            $('#orderrad_list tbody').html('<tr><td align="center" colspan="4"><img src="'+_image+'"</td></tr>');
            $.ajax({
                url: "{{ url('ugd/list_rad') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#orderrad_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#ids_radiologi').val(data.id);
                            var _status = "Menunggu antrian";
                            /*
                            var _action = '<td><a href="javascript:void(0)" onclick="edit_lab('+"'"+data.id+"'"+')"><i class="splashy-pencil"></i>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="hapus_lab('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                                */
                             var _action = '<td><a href="javascript:void(0)" onclick="hapus_rad('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                            if( data.status == '0'){

                            }
                            else if(data.status == '1'){
                                _status = "Sedang di proses";
                                _action = '<td></td>';
                            }
                            else if(data.status == '1'){
                                _status = "Hasil sudah keluar";
                                _action = '<td></td>';
                            }

                            $('#orderrad_list tbody').append('<tr><td>'+data.tanggal+'</td><td>'+data.kategori+'</td><td>'+_status+'</td>'+ _action+'</tr>');
                        });
                    }
                }
            });
        }

        function hapus_rad(id_hapus){
            if(id_hapus != ""){
                var r = confirm("Apakah anda ingin menghapus data permintaan Radiologi \nNo RM:"+$('#no_rm').val()+"\nNama:"+$('#txt_nama').val()+"\nPoli:"+$('#txt_poli').val() );
                if (r == true) {
                    $.ajax({
                        url: "{{ url('ugd/hapus_rad') }}",
                        type: "POST",
                        dataType: "json",
                        data : "id="+id_hapus,
                        success:function(res){
                            $.sticky(res.pesan, {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });

                            list_rad();
                        }
                    });
                }
            }
        }

        function proses_orderGizi(){
            var id_order_gizi   = $('#id_inap').val();
            var tanggal         = $('#tanggal_gizi').val();
            var pagi            = $('#makan_pagi').val();
            var siang           = $('#makan_siang').val();
            var malam           = $('#makan_sore').val();

            $('#ordergizi_pesan').show();
           // $('#ordergizi_pesan').html('Mohon isi tanggal terlebih dahulu');
            var _image  = "{{ url('img/load_gif.gif') }}";
            $('#ordergizi_pesan').removeClass('alert-success');
            $('#ordergizi_pesan').removeClass('alert-error');

            $('#ordergizi_pesan').html("<img src='"+_image+"' />");

            if( tanggal_gizi == '' ){
                $('#tanggal_gizi').focus();
                $('#ordergizi_pesan').addClass('alert-error');
                $('#ordergizi_pesan').html('Mohon isi tanggal terlebih dahulu');
            }
            else{
                $.ajax({
                    url: "{{ url('rawat_inap/order_gizi') }}",
                    type: "POST",
                    dataType: "json",
                    data : "id="+id_order_gizi+"&tanggal="+tanggal+"&pagi="+pagi+"&siang="+siang+"&sore="+malam,
                    success:function(res){
                        $('#ordergizi_pesan').addClass('alert-'+res.status);
                        $('#ordergizi_pesan').html(res.pesan);                        
                        list_gizi();
                    },
                    error:function(e,m,t){
                        $('#ordergizi_pesan').addClass('alert-error');
                        $('#ordergizi_pesan').html('Terjadi kesalahan koneksi ke server');
                    }
                });
            }
        }

        function list_gizi(){
            var val     = $('#id_inap').val();
            var _image  = "{{ url('img/load_gif.gif') }}";

            $('#ordermakan_list tbody').html('<tr><td align="center" colspan="4"><img src="'+_image+'"</td></tr>');
            $.ajax({
                url: "{{ url('rawat_inap/list_gizi') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#ordermakan_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#ids_radiologi').val(data.id);
                            var _status = "Menunggu antrian";
                            /*
                            var _action = '<td><a href="javascript:void(0)" onclick="edit_lab('+"'"+data.id+"'"+')"><i class="splashy-pencil"></i>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="hapus_lab('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                                */
                             var _action = '<td><a href="javascript:void(0)" onclick="hapus_rad('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                            if( data.status == '0'){

                            }
                            else if(data.status == '1'){
                                _status = "Sedang di proses";
                                _action = '<td></td>';
                            }
                            else if(data.status == '1'){
                                _status = "Hasil sudah keluar";
                                _action = '<td></td>';
                            }

                            $('#ordermakan_list tbody').append('<tr><td>'+data.Tanggal+'</td><td>'+data.PagiNama+'</td><td>'+data.SiangNama+'</td><td>'+data.SoreNama+'</td>'+'</tr>');
                        });
                    }
                }
            });
        }

	</script>