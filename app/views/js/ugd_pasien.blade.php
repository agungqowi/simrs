	<script type="text/javascript">
        var IdRegUGD = "";
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
                	pasien_find( $('#no_rm').val() );
                }
                    
            });

            $('#cari_pasien').on('shown', function () {
                $("#tbl_pasien_filter input").focus();
            });

            $('#btn_hapus').click(function(){
                hapus_pasien();
            });

            <?php if( isset($reg) ): ?>
                pasien_find('<?php echo $reg ?>');
            <?php endif; ?>

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
	    })

        function hapus_pasien(){
            if(IdRegUGD != ""){
                var r = confirm("Apakah anda ingin menghapus data UGD  \nNo RM:"+$('#no_rm').val()+"\nNama:"+$('#txt_nama').val() );
                if (r == true) {
                    $.ajax({
                        url: "{{ url('ugd/hapus_pasien') }}",
                        type: "POST",
                        data : "idreg="+IdRegUGD,
                        success:function(res){
                            $.sticky("Data UGD pasien berhasil dihapus", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                            setTimeout(function(){location.reload()}, 3000);;
                        }
                    });
                }
            }
        }

		function pasien_find(val){
            $.ajax({
                url: "{{ url('rest/ugd') }}"+'/'+val,
                dataType: "json",
                success: function(res){
	                if(res == false)
	                    alert('Data pasien tidak ditemukan');
	                else{
                        IdRegUGD = res[0].IdRegUGD;
	                	$('#id_reg').val(res[0].NoRegUGD);
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

	                    $('#txt_ruangan').val(res[0].Ruangan + ' '+ res[0].Kelas + ' Nomor:' +  res[0].NoKamar);

	                    $('#cmb_golongan_pasien').val(res[0].GolPasien);
	                    dataSet();
	                    dokter_rawat();
	                    list_tindakan();
                        list_diagnosa();
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
	                		$('#dokter_list tbody').append('<tr><td>'+data.NamaDokter+'</td><td>'+data.Spesialisasi+'</td><td>'+data.Kategori+'</td>'+
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

    	function pilih_pasien(id){
            $('#cari_pasien').modal('hide');
            //$('#no_rm').val(id);
            pasien_find(id);
        }

        function pilih_dokter(IdDokter,NamaDokter){
            $('#id_dokter').val(IdDokter),
            $('#txt_pilih_dokter').val(NamaDokter);
            $('#cari_dokter').modal('hide');
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
                    url: "{{ url('ugd/tambah_dokter') }}",
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
                url: "{{ url('pasien/list_tindakan') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                	$('#tindakan_list tbody').html('');
	                if(res == false){

	                }
	                else{
	                	$.each(res, function (key, data) {
                            var slug = "igd";
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
        	tambah_tindakan(IdTindakan,Tindakan , Gol);
        }

        function tambah_tindakan(id_tindakan,tindakan , gol){
        	$('#tindakan_message > .content').html('Proses.....');
            var tanggal_tindakan = $('#txt_tanggal_tindakan').val();
            var tanggal_masuk = $('#txt_tanggal_masuk').val();
            var NoReg = $('#id_reg').val();
            var id_norm = $('#id_norm').val();
            if(tanggal_tindakan != '' && tindakan != '')
            {
                $.ajax({
                    url: "{{ url('pasien/tambah_tindakan') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_tindakan="+id_tindakan+"&tanggal_tindakan="+
                            tanggal_tindakan+"&norm="+id_norm+"&tanggal_masuk="+tanggal_masuk+
                            "&tindakan="+tindakan+"&gol="+gol+"&jenis_rawat=igd",
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
            //alert(NoReg+' '+IdDokter+ ' '+('#txt_nama').val()+' '+$('#id_norm').val());
            $.ajax({
                url: "{{ url('diagnosa/tambah_diagnosa') }}",
                type: "POST",
                data : "noreg="+NoReg+"&id_diagnosa="+id_diagnosa+"&nama="+txt_nama+"&norm="+id_norm+
                        "&short="+_short+"&long="+_long+"&tanggal="+tanggal_diagnosa+"&status="+status_diagnosa+"&jenis_rawat=igd",
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
            var _jenis  = 'igd';
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

        function proses_orderlab(_force){
            var number_lab      = $('input[name="data_lab[]"]:checked').length;
            var noreg           = $('#id_reg').val();
            var id_pemeriksaan  = $('#id_pemeriksaan').val();
            var ids             = $('#ids_pemeriksaan').val();
            var tanggal         = $('#tanggal_lab').val();
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
                data_lab['asal']            = 'Poli '+ $('#txt_poli').val();
                data_lab['norm']            = $('#no_rm').val();
                data_lab['jenis_rawat']     = 'RJ';
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
                url: "{{ url('ugd/list_lab') }}"+'/'+val,
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
                data_lab['asal']            = 'IGD';
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
	</script>