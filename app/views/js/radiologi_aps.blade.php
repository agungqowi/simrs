    <script type="text/javascript">
        jQuery(document).ready(function(){
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            })

            $(".chzn_a").chosen({
                allow_single_deselect: true
            });

            <?php if(isset($id)): ?>
                $('#id_lab').val('<?php echo $id ?>');
                dataSet();
                loadTindakan();
                list_tindakan();
            <?php endif; ?>

        });

        function loadTindakan(){
            var tipe = "UMUM";
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

        function list_tindakan(opt){
            var val = $('#id_reg').val();
            var target_url = '';
            var opt        = $('#opt').val();
            target_url = "{{ url('penunjang/list_tindakan_aps/radiologi') }}";
            
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
                            _html   += '<td><a href="javascript:void(0)" onclick="hapus_tindakan('+"'"+data.IdDetailTindak+"'"+')"><i class="splashy-error_x"></i>'+
                                '</a></td>';
                           
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
                        url: "{{ url('penunjang/hapus_tindakan_aps') }}",
                        type: "POST",
                        data : "id_tindakan="+idTindakan,
                        success:function(res){
                            list_tindakan();
                        }
                    });
                }
                else{
                    $.ajax({
                        url: "{{ url('penunjang/hapus_tindakan_aps') }}",
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
    </script>