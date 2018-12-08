    <script type="text/javascript">
        jQuery(document).ready(function(){
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            })

            $(".chzn_a").chosen({
                allow_single_deselect: true
            });

            <?php if(isset($id)): ?>
                $('#id_lab').val('<?php echo $id ?>')
                <?php if(isset($data->jenis_rawat) && ($data->jenis_rawat) == 'APS'): ?>

                <?php else: ?>
                    pasien_find('<?php echo $data->id_reg ?>' , '<?php echo $data->jenis_rawat ?>')
                <?php endif; ?>                
            <?php endif; ?>

            $('.pemeriksaan-baru').hide();
            $('#btn_pemeriksaan_baru').show();

            $('#btn_pemeriksaan_baru').click(function(){
                $('.pemeriksaan-baru').show();
                $('#btn_pemeriksaan_baru').hide();
            });

            $('#btn_tambah_pemeriksaan').click(function(){
                tambahPemeriksaan();
            });
        })

        function pasien_find(val,opt){
            if(opt == 'RJ'){
                target_url = "{{ url('rest/rawat_jalan') }}";
            }
            else if(opt == 'IGD'){
                target_url = "{{ url('rest/ugd_byreg') }}";
            }
            else {
                target_url = "{{ url('rest/rawat_inap_byid') }}";
            } 
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
                        if(opt == 'RJ'){
                            $('#id_reg').val(res[0].NoRegJalan);
                            $('#id_jalan').val(val);
                            $('#poli_group').show();
                            $('#txt_poli').val(res[0].Poli);    
                            $('#txt_ruangan').val('');                      
                        }
                        else if(opt == 'IGD'){
                            $('#id_reg').val(res[0].NoRegUGD);
                            $('#txt_poli').val('');
                            $('#txt_ruangan').val('');
                        }
                        else{
                            $('#id_reg').val(res[0].NoReg);
                            $('#id_jalan').val(val);
                            $('#ruangan_group').show();
                            $('#txt_poli').val('');
                            $('#txt_ruangan').val(res[0].Ruangan + ' '+ res[0].Kelas + ' Nomor:' +  res[0].NoKamar);
                        }

                        $('#opt').val(opt);
                        

                        $('#cmb_golongan_pasien').val(res[0].CaraBayar);

                        $('#temp_reg').val( $('#id_reg').val() );
                        dataSet();
                        list_tindakan(opt);
                        list_diagnosa();
                        list_periksa();
                        dokter_rawat();

                        var tipe    = res[0].CaraBayar;
                        if( tipe == 'BPJS' ){
                            oTable = jQuery('#tbl_tindakan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('tindakan/penunjangbpjs/'.$slug) }}",
                                    "bServerSide": true
                                
                                });
                        }
                        else{
                                oTable = jQuery('#tbl_tindakan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('tindakan/penunjangtable/'.$slug) }}",
                                    "bServerSide": true
                                
                                });
                        }
                            
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
                    url: "{{ url('rawat_jalan/tambah_dokter') }}",
                    type: "POST",
                    data : "noreg="+NoReg+"&id_dokter="+id_dokter+"&nama="+txt_nama+"&norm="+id_norm+"&kategori="+kategori,
                    success:function(res){
                        dokter_rawat();
                    }
                });
            }
        }

        function dokter_rawat(){
            
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
                        "&short="+_short+"&long="+_long+"&tanggal="+tanggal_diagnosa+"&status="+status_diagnosa+"&jenis_rawat={{ $slug }}",
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
            var _jenis  = '{{ $slug }}';
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

        function list_periksa(){
            var val     = $('#id_lab').val();

            $.ajax({
                url: "{{ url('lab/data_periksa') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    if(res.status == 'ada'){
                        var _hasil = res.data;
                        $('#hasil_tanggal').val(_hasil.tanggal_periksa)
                        $('#hasil_jam').val(_hasil.jam)
                        $('#id_dokter').val(_hasil.IdDokterLab)
                        $('#txt_pilih_dokter').val(_hasil.NamaDokterLab)
                        $('#kesimpulan').val(_hasil.kesimpulan)
                        $('#pemeriksa').val(_hasil.id_pemeriksa)
                    }
                    else{

                    }
                }
            });

            $.ajax({
                url: "{{ url('lab/list_periksa') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#table_hasil tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            var _html ="<tr>";
                            _html += '<td>'+data.nama_jasa+'</td>';
                            _html += '<td><input type="text" name="hasil['+data.id+']" value="'+data.hasil+'" /></td>';
                            _html += '<td>'+data.satuan+'</td>';
                            _html += '<td>'+data.nilai_normal+'</td>';
                            _html += '<td><input type="text" name="catatan['+data.id+']" value="'+data.catatan+'" /></td>';

                            _html += '<td><a href="javascript:void(0)" onclick="hapus_periksa('+"'"+data.id+"'"+')"><i class="splashy-error_x"></i></a></td>';

                            _html += "</tr>";
                            $('#table_hasil tbody').append(_html);
                        });
                    }
                }
            });
        }

        $('#btn_hasil_simpan').click(function(){
            var NoReg       = $('#id_reg').val();
            var txt_nama    = $('#txt_nama').val();
            var id_norm     = $('#id_norm').val();
            var id_lab      = $('#id_lab').val();

            $('#hasil_nama').val(txt_nama);
            $('#hasil_noreg').val(NoReg);
            $('#hasil_norm').val(id_norm);

            var txt_form = $('#form_hasil').serialize();
            $.ajax({
                url: "{{ url('lab/hasil') }}",
                type: "POST",
                data : txt_form,
                success:function(res){
                    $.sticky("Data hasil lab berhasil di simpan", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                }
            });
        });

        function tambahPemeriksaan(){
            var id_norm     = $('#id_norm').val();
            var id_lab      = $('#id_lab').val();
            var id_detail   = $('#select_pemeriksaan').val();
            $.ajax({
                url: "{{ url('lab/tambah_pemeriksaan') }}",
                type: "POST",
                data : "id_lab="+id_lab+"&id_detail="+id_detail,
                dataType : "JSON" ,
                success:function(res){
                    if( res.status == 'berhasil' ){
                        $.sticky("Data pemeriksaan lab berhasil di tambah", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });

                        $('.pemeriksaan-baru').hide();
                        $('#btn_pemeriksaan_baru').show();
                        
                        list_periksa();
                    }
                    else if( res.status == 'ada' ){
                        $.sticky("Data pemeriksaan lab sudah ada", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                    }
                    else{
                        $.sticky(res.status, {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                    }
                    
                }
            });
        }

        function hapus_periksa(id){
            var id_lab = $('#id_lab').val();
            var r = confirm("Apakah anda ingin menghapus item pemeriksaan ini");
            if (r == true) {
                $.ajax({
                    url: "{{ url('lab/hapus_periksa') }}",
                    type: "POST",
                    dataType: "JSON",
                    data : "id_lab="+id_lab+"&id="+id,
                    success:function(res){
                        if( res.status == 'berhasil' ){
                            $.sticky("Item pemeriksaan berhasil dihapus", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                        }
                        else{
                            $.sticky(res.status, {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                        }
                        list_periksa();
                    }
                });
            }
        }
    </script>