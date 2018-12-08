
	<script type="text/javascript">
        var IdRegJalan = "";
        var IdPoli="";
		jQuery(document).ready(function(){
	        $('.no-primary').each(function(){
	        	$(this).attr('readonly','readonly');
	        })

	        $(".chzn_a").chosen({
                allow_single_deselect: true
            });

            $('#no_rm').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                	pasien_find( $('#no_rm').val() );
                }
                    
            });

            $('#cari_pasien').on('shown', function () {
                $("#tbl_pasien_filter input").focus();
            });

            $('#btn_hapus').click(function(){
                hapus_pasien();
            })

            $('#btn_poli_tambah').click(function(){
                $('#tambah_poli').attr('disabled','disabled');
                tambah_poli();
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

            $('#btn_ruangan_simpan').click(function(){
                proses_rujukruangan('0');
                var _image  = "{{ url('img/load_gif.gif') }}";
                $('#rujukruangan_error').html("<img src='"+_image+"' />")
            });

            $('#btn_tindakan_tambah').click(function(){
                tambah_tindakan();
            });

            $('#qty_tindakan').change(function(){
                ubahTotalTindakan();
            });

            $('.selesai-periksa').hide();

            $('#selesai_periksa').change(function(){
                doSelesaiPeriksa();
            });

            $('.jam').each(function(){
                var val = $(this).val();

                if( val == '' ){
                    var d = new Date();
                    var h = addZero(d.getHours());
                    var m = addZero(d.getMinutes());
                    var s = addZero(d.getSeconds());
                    $(this).val( h + ":" + m + ":" + s );
                }
            });

            $('#btn_selesai_periksa').click(function(){
                prosesSelesaiPeriksa();
            });

            pilihRS();
            $('#pilih_rs').change(function(){
                pilihRS();
            });

            $('#btn_obat').click(function(){
                $('#cari_obat').modal('show');
            });

            $('#cari_obat').on('shown', function () {
                $("#tbl_obat_filter input").focus();
            });
	    })

        function hapus_pasien(){
            if(IdRegJalan != ""){
                var r = confirm("Apakah anda ingin menghapus data rawat jalan  \nNo RM:"+$('#no_rm').val()+"\nNama:"+$('#txt_nama').val() );
                if (r == true) {
                    $.ajax({
                        url: "{{ url('rawat_jalan/hapus_pasien') }}",
                        type: "POST",
                        data : "idreg="+IdRegJalan,
                        success:function(res){
                            if( res == 'gagal' ){
                                $.sticky("Pasien yang telah bayar tidak diizinkan dihapus", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                            }
                            else{
                                $.sticky("Data rawat jalan pasien berhasil dihapus", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                                setTimeout(function(){
                                     window.location.href = "{{ url('registrasi_harian') }}";
                                }, 3000);;
                            }
                            
                        }
                    });
                }
            }
        }



		function pasien_find(val){
            $('#id_reg_jalan').val(val);
            $.ajax({
                url: "{{ url('rest/rawat_jalan') }}"+'/'+val,
                dataType: "json",
                success: function(res){
	                if(res == false){
	                    alert('Data pasien tidak ditemukan');
                        IdRegJalan =  "";
                    }
	                else{
                        IdRegJalan =  res[0].IdRegJalan;
	                	$('#id_reg').val(res[0].NoRegJalan);
                        $('#no_register').val(res[0].NoRegJalan);
	                	$('#id_norm').val(res[0].NoRM);
                        $('#no_rm').val(res[0].NoRM);
	                    $('#txt_nama').val(res[0].Nama);
	                    $('#cmb_jenkel').val(res[0].Jkel)
	                    if( res[0].Tanggal != '' || res[0].Tanggal != '-'){
	                        var _tglArray = res[0].Tanggal.split("-");
	                        $('#txt_tanggal_masuk').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
                            $('#txt_tanggal_tindakan').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
	                    }
	                    else{
	                        $('#txt_tanggal_masuk').val(' ');
                            $('#txt_tanggal_tindakan').val(' ');
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
                        IdPoli = res[0].IdPoli;
	                    $('#txt_poli').val(res[0].Poli);
                        $('#txt_no_bpjs').val(res[0].NoBPJS);
                        $('#selesai_periksa').val(res[0].status);
                        doSelesaiPeriksa();
	                    $('#cmb_golongan_pasien').val(res[0].CaraBayar);

                        $('#poli_lain').val(res[0].poli_rujuk);
	                    dataSet();
	                    dokter_rawat();
	                    list_tindakan();
                        list_diagnosa();
                        list_poli();
                        list_lab();
                        list_rad();
                        list_ranap();
                        list_transaksi();
                	}
                },
                error:function(res){
                    alert('Connection failed');
                }
            })
        }
        <?php if( isset($reg) ): ?>
        pasien_find('<?php echo $reg ?>');
        <?php endif; ?>

        function dataSet(){
            //$('#no_rm').attr('disabled','disabled');
            //$('.no-primary').attr('disabled',false);
            $('.extra-fields').each(function(){
            	$(this).attr('readonly',false);
                $(this).attr('disabled',false);
            });
        }

        function dataNotSet(){
            $('#no_rm').attr('readonly',false);
            $('#no_rm').attr('disabled',false);
            $('.no-primary').attr('readonly','readonly');
        }

        function dokter_rawat(){
        	var val = $('#id_reg').val();
        	$.ajax({
                url: "{{ url('rest/dokter_rawat_jalan') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                	$('#dokter_list tbody').html('');
	                if(res == false){

	                }
	                else{
                        var total_konsul = 0;
	                	$.each(res, function (key, data) {
                            if( $('#tipe_poli').val() == '3' ){
                                var jam_kerja = "";
                                if(data.LuarJam == 0){
                                    jam_kerja   = 'Jam Kerja';
                                }
                                else{
                                    jam_kerja   = 'Luar Jam Kerja';
                                }
                                $('#dokter_list tbody').append('<tr><td>'+data.Dokter+'</td><td>'+jam_kerja+
                                    '</td><td>'+data.Poli+'</td>'+'<td><a href="javascript:void(0)" onclick="hapus_dokter('+"'"+data.IdRegJalan+"'"+','+"'"+data.IDDokter+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td></tr>');
                            }
                            else{
                                $('#dokter_list tbody').append('<tr><td>'+data.Dokter+'</td><td>'+data.Poli+
                                    '</td>'+'<td><a href="javascript:void(0)" onclick="hapus_dokter('+"'"+data.IdRegJalan+"'"+','+"'"+data.IDDokter+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td></tr>');
                            }
	                		
	                	});


                        hitungTotal();
	             	}
	            }
	        });
        }

        function hitungTotal(){
            var total_tarif     = $('#total_tarif').html();

            var total_all       = parseInt( total_tarif );

            $('#total_all').html(total_all);

            $.ajax({
                url: "{{ url('rawat_jalan/update_total') }}",
                type: "POST",
                data : "id_reg="+IdRegJalan+"&total="+total_all,
                success:function(res){
                    
                }
            });

        }

        function hapus_dokter(NoReg,IdDokter){
        	$.ajax({
                url: "{{ url('rawat_jalan/hapus_dokter') }}",
                type: "POST",
                data : "noreg="+NoReg+"&id_dokter="+IdDokter,
                success:function(res){
                	dokter_rawat();
                }
            });
        }

    	function pilih_pasien(id){
            $('#cari_pasien').modal('hide');
            //$('#no_rm').val(id);
            pasien_find(id);

            $('.alert-success').hide();
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

        function pilih_dokter(IdDokter,NamaDokter){
            $('#id_dokter').val(IdDokter),
            $('#txt_pilih_dokter').val(NamaDokter);
            $('#cari_dokter').modal('hide');
        }

        function ubahTotalTindakan(){
            var qty     = parseInt( $('#qty_tindakan').val() );
            var tarif   = parseInt( $('#txt_tarif').val() );
            var total   = qty * tarif;

            $('#txt_total').val( total );
        }

        function tambah_dokter(){
            var NoReg = $('#id_reg').val();
            var txt_nama = $('#txt_nama').val();
            var id_norm = $('#id_norm').val();
            var id_dokter = $('#id_dokter').val();
            var kategori = $('#kategori_dokter').val();
            var jam_kerja   = 0;
            if(id_dokter == ''){
                alert('Pilih Dokter terlebih dahulu');
                $('#cari_dokter').modal('show');
            }
            else{

                if( $('#tipe_poli').val() == '3' ){
                    jam_kerja   = $('#jam_kerja').val();
                }

                $.ajax({
                    url: "{{ url('rawat_jalan/tambah_dokter') }}",
                    type: "POST",
                    data : "noreg="+IdRegJalan+"&id_dokter="+id_dokter+"&nama="+txt_nama+"&norm="+
                            id_norm+"&kategori="+kategori+"&jam_kerja="+jam_kerja,
                    success:function(res){
                        dokter_rawat();
                    }
                });
            }
        }

        function list_tindakan(){
        	var val = $('#id_reg').val();
        	$.ajax({
                url: "{{ url('pasien/list_tindakan') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                	$('#tindakan_list tbody').html('');
	                if(res == false){

	                }
	                else{
                        var total_tarif = 0;
	                	$.each(res, function (key, data) {
                            var slug = $('#txt_poli').val();
                            var _html ='<tr><td>'+data.Tindakan+'</td><td>'+data.TanggalTindak+'</td>'+
                            '<td>'+data.NamaDokter+'</td><td>'+data.NamaPerawat+'</td>';
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

                        $('#total_tarif').html(total_tarif)
                        hitungTotal();
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

        function changeTotal(){
            var tarif   = parseInt( $('#txt_tarif').val() );
            var qty     = parseInt( $('#qty_tindakan').val() );

            var total   = tarif * qty;
            $('#txt_total').val(total);
        }

        function tambah_tindakan(){
            $('#tindakan_message > .content').html('Proses.....');
        	var tanggal_tindakan   = $('#txt_tanggal_tindakan').val();
        	var tanggal_masuk      = $('#txt_tanggal_masuk').val();
            var id_dokter          = $('#id_dokter_tindakan').val();
            var id_perawat         = $('#id_perawat_tindakan').val();
            var id_tindakan        = $('#id_tindakan').val();
            var tindakan           = $('#nama_tindakan').val();
            var gol                = $('#gol_tindakan').val();
            var jam_tindakan       = $('#jam_tindakan').val();

        	var NoReg = $('#id_reg').val();
        	var id_norm = $('#id_norm').val();
        	if(tanggal_tindakan != '' && tindakan != '')
        	{
        		$.ajax({
                    url: "{{ url('rawat_jalan/tambah_tindakan') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_tindakan="+id_tindakan+"&tanggal_tindakan="+
                            tanggal_tindakan+"&norm="+id_norm+"&tanggal_masuk="+tanggal_masuk+
                            "&id_reg="+IdRegJalan+"&qty="+$('#qty_tindakan').val()+
                            "jam_tindakan="+jam_tindakan+
                            "&id_dokter="+id_dokter+"&id_perawat="+id_perawat+
                            "&tindakan="+tindakan+"&gol="+gol+"&jenis_rawat="+$('#txt_poli').val(),
                    success:function(res){
                        list_tindakan();

                        $('#id_dokter_tindakan').val('');
                        $('#id_perawat_tindakan').val('');
                        $('#nama_tindakan').val('');
                        $('#id_tindakan').val('');
                        $('#qty_tindakan').val('1');
                        $('#txt_tarif').val('');
                        $('#txt_total').val('');


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

        function hapus_tindakan(IdTindakan){
            var r = confirm("Apakah anda ingin menghapus tindakan");
            if (r == true) {
                $.ajax({
                    url: "{{ url('rawat_jalan/hapus_tindakan') }}",
                    type: "POST",
                    data : "id_tindakan="+IdTindakan,
                    success:function(res){
                        list_tindakan();
                    }
                });
            }
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
            var _keterangan   = $('#keterangan_diagnosa').val();
            //alert(NoReg+' '+IdDokter+ ' '+('#txt_nama').val()+' '+$('#id_norm').val());
            if( id_diagnosa == '' || id_diagnosa == '0' ){
                $('#cari_diagnosa').modal('show');
            }
            else{
                $.ajax({
                    url: "{{ url('diagnosa/tambah_diagnosa') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_diagnosa="+id_diagnosa+"&nama="+txt_nama+"&norm="+id_norm+"&keterangan="+_keterangan+"&asal=rj"+
                            "&short="+_short+"&long="+_long+"&tanggal="+tanggal_diagnosa+"&status="+status_diagnosa+"&jenis_rawat="+$('#txt_poli').val(),
                    success:function(res){
                        $('#cari_diagnosa').modal('hide');

                        $('#id_diagnosa').val( '' );
                        $('#txt_pilih_diagnosa').val( '' );
                        $('#long_diagnosa').val( '' )
                        $('#status_diagnosa').val('');                    
                        $('#keterangan_diagnosa').val('')

                        list_diagnosa();
                    }
                });
            }
            
        }

        function list_diagnosa(){
            var val     = $('#id_reg').val();
            var _jenis  = $('#txt_poli').val();
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
                            _html += '<td>'+data.Keterangan+'</td>';
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

        function tambah_poli(){
            var NoReg = $('#id_reg').val();
            var poli_lain = $("#poli_lain").val();
            if(poli_lain != ''){
                $.ajax({
                    url: "{{ url('rawat_jalan/tambah_poli') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_poli="+poli_lain,
                    success:function(res){
                        if(res == 'ada'){
                            $.sticky("Data pasien pada poli yang dituju sudah ada", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                        }
                        else if(res=='sukses'){
                            list_poli();
                            $.sticky("Data rujuk poli pasien berhasil ditambah", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                        }
                        else{
                            $.sticky(res, {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                        }
                    }
                });
            }
            else{
                $("#poli_lain").focus();
            }

            $('#tambah_poli').attr('disabled',false);
        }

        function list_poli(){
            var val = $('#id_reg').val();
            $.ajax({
                url: "{{ url('rawat_jalan/list_poli') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#poli_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#poli_list tbody').append('<tr><td>'+data.IdPoli+'</td><td>'+data.Poli+'</td>'+
                                '<td><a href="javascript:void(0)" onclick="hapus_poli('+"'"+data.IdRegJalan+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td></tr>');
                        });
                    }
                }
            });
        }

        function hapus_poli(id_hapus){
            if(id_hapus != ""){
                var r = confirm("Apakah anda ingin menghapus data rawat jalan  \nNo RM:"+$('#no_rm').val()+"\nNama:"+$('#txt_nama').val()+"\nPoli:"+$('#txt_poli').val() );
                if (r == true) {
                    $.ajax({
                        url: "{{ url('rawat_jalan/hapus_poli') }}",
                        type: "POST",
                        data : "idreg="+id_hapus+"&no_reg="+$('#no_register').val(),
                        success:function(res){
                            $.sticky("Data poli pasien berhasil dihapus", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                            if(id_hapus == IdRegJalan)
                                setTimeout(function(){location.reload()}, 3000);;
                        }
                    });
                }
            }
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
                data_lab['id_pemeriksaan']  = id_pemeriksaan;
                data_lab['asal']            = $('#txt_poli').val();
                data_lab['norm']            = $('#no_rm').val();
                data_lab['jenis_rawat']     = 'RJ';
                data_lab['nama']            = $('#txt_nama').val();
                data_lab['tanggal']         = tanggal;
                data_lab['id_reg_jalan']    = id_reg_jalan;

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
                                    list_tindakan();
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
                        url: "{{ url('rawat_jalan/hapus_lab') }}",
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
                data_lab['asal']            = 'Poli '+ $('#txt_poli').val();
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
                url: "{{ url('rawat_jalan/list_rad') }}"+'/'+val,
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
                        url: "{{ url('rawat_jalan/hapus_rad') }}",
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

        function proses_rujukruangan(id){
            var id_ruangan      = $('#id_ruangan').val();
            var id_reg          = $('#id_reg').val();
            var nama_ruangan    = $('#nama_ruangan').val();
            var jam_rujuk       = $('#jam_rujuk').val();
            var tanggal_rujuk   = $('#tanggal_rujuk').val();

            var proses      = true;

            if(proses){
                 $.ajax({
                        url: "{{ url('rawat_jalan/rujuk_ruangan') }}",
                        type: "POST",
                        dataType: "json",
                        data : "id="+id_reg+"&id_ruangan="+id_ruangan+"&tanggal_rujuk="+tanggal_rujuk+
                                "&jam_rujuk="+jam_rujuk,
                        success:function(res){
                            if(res.status == 'success'){
                                $('#rujukruangan_error').html('<div class="alert alert-success">'+"Pasien telah dirujuk ke Ruang "+nama_ruangan+"</div>");
                            }
                            else{
                                $('#rujukruangan_error').html('<div class="alert alert-error">'+res.pesan+"</div>");
                            }

                            setTimeout(function(){ list_ranap(); }, 3000);
                            
                        }
                    });
            }
        }

        function pilih_ruangan(id_ruangan,nama,kelas,no_kamar){
            $('#nama_ruangan').val(nama + ' '+kelas+' No Kamar:'+no_kamar);
            $('#id_ruangan').val(id_ruangan);
            $('#rujuk_ruangan').modal('hide');
        }

        function list_ranap(){
            var val = $('#id_reg').val();
            var _image  = "{{ url('img/load_gif.gif') }}";

            $('#rujukruangan_error').html("<img src='"+_image+"' />")

            $.ajax({
                url: "{{ url('rawat_jalan/list_rawatinap') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    if(res.status == false){
                        $('#rujukruangan_error').html("");

                    }
                    else{
                        $('#rujukruangan_error').html('<div class="alert alert-warning">'+res.pesan+'</div>');
                        $('#nama_ruangan').val(res.ruangan);
                        //$('#btn_ruangan_simpan').attr('disabled' , 'disabled');
                        $('#btn_ruangan_simpan').html('Koreksi Ruangan');
                    }
                }
            });
        }

        function rujukPesan(str){

        }

        function doSelesaiPeriksa(){
            $('.selesai-periksa').hide();

            var val = $('#selesai_periksa').val();

            if( val == '2' ){
                $('#rujukruangan').show();
            }
            else if( val == '5' ){
                $('#tambahpoli').show();
            }
            else if( val == '6' ){
                $('#rujukrs').show();
            }
        }

        function addZero(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function prosesSelesaiPeriksa(){
            var jam_periksa     = $('#jam_periksa').val();
            var jam_selesai     = $('#jam_selesai').val();
            var selesai_periksa = $('#selesai_periksa').val();
            var poli_lain       = $('#poli_lain').val();
            var pilih_rs        = $('#pilih_rs').val();
            var cmb_rs          = $('#cmb_rs').val();
            var input_rs        = $('#input_rs').val();

            var id_reg          = $('#id_reg').val();

            if( selesai_periksa == '2' ){
                proses_rujukruangan();
            }
            else if( selesai_periksa == '5' ){
                tambah_poli();
            }
            $.ajax({
                    url: "{{ url('rawat_jalan/selesai_periksa') }}",
                    type: "POST",
                    dataType: "json",
                    data :  "jam_periksa="+jam_periksa+"&jam_selesai="+jam_selesai+"&selesai_periksa="+selesai_periksa+
                            "&poli_lain="+poli_lain+"&pilih_rs="+pilih_rs+
                            "&cmb_rs="+cmb_rs+"&input_rs="+input_rs+"&id="+IdRegJalan,
                    success:function(res){
                        if(res.status == false){
                            $('#selesaiperiksa_error').html("");

                        }
                        else{
                            $('#selesaiperiksa_error').html('<div class="alert alert-warning">'+res.pesan+'</div>');
                        }
                    }
            });

        }

        function pilihRS(){
            var pilih_rs        = $('#pilih_rs').val();
            $('.pilih-rs').hide();
            $('#'+pilih_rs).show();
        }

        function cetak_alert2(str){
            $('#pesan_error2').show();
            $('#pesan_error2').html(str);
        }


        function tambah_eresep(){
            var jumlah = parseInt( $('#jumlah_obat').val() );
            var harga = $('#harga').val();
            var val = jumlah * harga;
            $('#total').val( val );

            var no_reg          = $('#no_register').val();
            var id_obat         = $('#id_obat').val();
            var total           = $('#total').val();
            var tanggal_resep   = $('#txt_tanggal_masuk').val()
            var no_rm           = $('#no_rm').val();
            var tanggal_masuk   = $('#txt_tanggal_masuk').val();
            var jenis_rawat     = $('#jenis_rawat').val();
            var nama_obat       = $('#nama_obat').val();
            var stok            = parseInt( $('#stok').val() );
            var nama_lengkap    = $('#txt_nama').val();
            var id_reg          = $('#id_reg_jalan').val();
            var id_resep    = $('#id_resep').val();
            var kategori_obat   = $('#kategori_obat').val();
            var penjamin        = $('#cmb_golongan_pasien').val();
            var dosis           = $('#dosis').val();
            var penggunaan      = $('#penggunaan').val();
            cetak_alert2('Proses input data ...');
            $('#pesan_error').hide();

            if(stok < jumlah){
                cetak_alert('Stok obat tidak mencukupi untuk quantity sebanyak '+jumlah+', stok obat saat ini '+stok);
                $('#stok').focus();
            }
            else if(jumlah == '' || jumlah == '0'){
                cetak_alert('Jumlah barang tidak boleh kosong');
                $('#jumlah').focus();
            }
            else{

                $.ajax({
                    url: "{{ url('apotek_eresep/check_resep/apotek_askes') }}",
                    type: "POST",
                    data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah+"&id_resep="+id_resep,
                    success:function(resa){
                        if(resa == 'ada'){
                            var r = confirm("Transaksi obat dengan jumlah yang sama sudah ada,  apakah anda ingin tetap meneruskan?");
                            if (r == true) {
                                
                                $.ajax({
                                    url: "{{ url('apotek_eresep/tambah_eresep/apotek_askes') }}",
                                    type: "POST",
                                    data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+
                                            "&tanggal_masuk="+tanggal_masuk+"&id_resep="+id_resep+
                                            "&total="+total+"&no_rm="+no_rm+"&jenis_rawat=RJ"+
                                            "&kategori_obat="+kategori_obat+"&penjamin="+penjamin+
                                            "&penggunaan="+penggunaan+"&id_reg="+id_reg+
                                            "&tanggal_resep="+tanggal_resep+"&nama_obat="+nama_obat+"&stok="+stok+
                                            "&dosis="+dosis+"&nama_lengkap="+nama_lengkap,
                                    success:function(res){
                                        res     = $.parseJSON(res);
                                        if(res.pesan == 'sukses'){
                                            $('#id_resep').val(res.id_resep);
                                            list_transaksi();
                                            $('#pesan_error2').hide();
                                            cetak_alert('Data berhasil ditambahkan');
                                            $('#id_obat').val('');
                                            $('#nama_obat').val('');
                                            $('#harga').val('');
                                            $('#total').val('');
                                            $('#stok').val('');
                                            $('#dosis').val('');
                                            $('#penggunaan').val('');
                                            $('#jumlah').val('');
                                            setTimeout(function(){$("#pesan_error").hide()}, 4000);

                                            editMode();
                                            //$('#tbl_obat').dataTable().fnReloadAjax();
                                        }
                                        else{
                                            $('#pesan_error2').hide();
                                            cetak_alert(res);
                                        }
                                        $('#nama_obat').focus();
                                    }
                                });
                            }
                            else{
                                $('#pesan_error2').hide();
                            }
                        }
                        else{
                            
                            $.ajax({
                                url: "{{ url('apotek_eresep/tambah_eresep/apotek_askes') }}",
                                type: "POST",
                                data : "no_reg="+no_reg+"&id_obat="+id_obat+"&jumlah="+jumlah+"&harga="+harga+
                                        "&tanggal_masuk="+tanggal_masuk+"&id_resep="+id_resep+
                                        "&total="+total+"&no_rm="+no_rm+"&jenis_rawat=RJ"+
                                        "&kategori_obat="+kategori_obat+"&penjamin="+penjamin+
                                        "&penggunaan="+penggunaan+"&id_reg="+id_reg+
                                        "&tanggal_resep="+tanggal_resep+"&nama_obat="+nama_obat+"&stok="+stok+
                                        "&dosis="+dosis+"&nama_lengkap="+nama_lengkap,
                                success:function(res){
                                    res     = $.parseJSON(res);
                                    if(res.pesan == 'sukses'){                                      
                                        $('#id_resep').val(res.id_resep);
                                        list_transaksi();
                                        $('#pesan_error2').hide();
                                        cetak_alert('Data berhasil ditambahkan');
                                        $('#id_obat').val('');
                                        $('#nama_obat').val('');
                                        $('#harga').val('');
                                        $('#total').val('');
                                        $('#stok').val('');
                                        $('#penggunaan').val('');
                                        $('#jumlah').val('');
                                        //$('#tbl_obat').dataTable().fnReloadAjax();
                                        setTimeout(function(){$("#pesan_error").hide()}, 4000);

                                        editMode();
                                    }
                                    else{
                                        $('#pesan_error2').hide();
                                        cetak_alert(res.pesan);
                                    }
                                    $('#id_resep').val(res.id_resep);
                                    $('#nama_obat').focus();
                                }
                            });
                        }
                    }
                });
                
            }
        }
        function list_transaksi(){
            var id_reg = $('#id_reg_jalan').val();
            if(id_reg == '')
                id_reg = 'zxasqwopsds';
            $('#pdf_excel').hide();
            $('#load_list').show();
            $.ajax({
                url: "{{ url('apotek_eresep/list_transaksi_byreg/apotek_askes') }}"+'/'+id_reg,
                dataType: "json",
                success: function(res){
                    $('#resep_list tbody').html('');
                    if(res == false){
                        $('#load_list').hide();
                    }
                    else{
                        $.each(res, function (key, data) {
                            var TipeObat = "";
                            $('$id_resep').val(data.id_resep)
                            if( data.Tipe == 'P' ){
                                TipeObat = "Paten";
                            }
                            else if(data.Tipe == 'R1'){
                                TipeObat = "Racikan 1";
                            }
                            else if(data.Tipe == 'R2'){
                                TipeObat = "Racikan 2";
                            }
                            else if(data.Tipe == 'R3'){
                                TipeObat = "Racikan 3";
                            }
                            else if(data.Tipe == 'R4'){
                                TipeObat = "Racikan 4";
                            }
                            else if(data.Tipe == 'R5'){
                                TipeObat = "Racikan 5";
                            }
                            $('#resep_list tbody').append('<tr>'+
                                    '<td>'+data.tgl+'</td>'+
                                    '<td>'+data.NamaObat+'</td>'+
                                    '<td>'+TipeObat+'</td>'+
                                    '<td class="align-right">'+data.Harga+'</td>'+
                                    '<td class="align-right">'+data.Jumlah+'</td>'+
                                    '<td class="align-right">'+data.TotalHarga+'</td>'+
                                    '<td class="align-left">'+data.Dosis+'</td>'+
                                    '<td class="align-left">'+data.Penggunaan+'</td>'+
                                    '<td>'+data.Apotek+'</td>'+
                                    '<td><a href="javascript:void(0)" onclick="hapus_transaksi('+"'"+data.id+"',"+
                                        "'"+data.IdObat+"',"+
                                        "'"+data.NoRM+"',"+
                                        "'"+data.TanggalResep+"'"+')">'+
                                        '<i class="splashy-error_x"></i>'+
                                        '</a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="edit_transaksi('+"'"+data.id+"',"+
                                        "'"+data.IdResep+"',"+
                                        "'"+data.tgl+"',"+
                                        "'"+data.NoRM+"',"+
                                        "'"+data.IdObat+"',"+
                                        "'"+data.NamaObat+"',"+
                                        "'"+data.Harga+"',"+
                                        "'"+data.Jumlah+"',"+
                                        "'"+data.TotalHarga+"'"+')">'+
                                        '<i class="splashy-folder_modernist_edit"></i>'+
                                        '</a></td></tr>');
                        });
                        $('#load_list').hide();
                        $('#pdf_excel').show();

                        $('#btn_cetak').attr('href' , "{{ url('apotek_keluar/cetak_transaksi') }}/"+id_reg);
                    }
                },
                error:function(res){
                    alert('Connection failed');
                }
            });
        }
	</script>