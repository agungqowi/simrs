	<script type="text/javascript">
            var poli_table;
            var ugd_table;
            var _kartu;
            var _baru = "no";
			function openKCFinder(field_name, url, type, win) {
                alert("Field_Name: " + field_name + "nURL: " + url + "nType: " + type + "nWin: " + win); // debug/testing
                tinyMCE.activeEditor.windowManager.open({
                    file: '/file-manager/browse.php?opener=tinymce&type=' + type,
                    title: 'KCFinder',
                    width: 700,
                    height: 500,
                    resizable: "yes",
                    inline: true,
                    close_previous: "no",
                    popup_css: false
                }, {
                    window: win,
                    input: field_name
                });
                return false;
            };
            $('textarea.wysiwg_full').tinymce({
                // Location of TinyMCE script
                script_url 							: '{{ url("lib/tiny_mce/tiny_mce.js") }}',
                // General options
                theme 								: "advanced",
                plugins 							: "autoresize,style,table,advhr,advimage,advlink,emotions,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,xhtmlxtras,template,advlist",
                // Theme options
                theme_advanced_buttons1 			: "undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",
                theme_advanced_buttons2 			: "forecolor,backcolor,|,cut,copy,paste,pastetext,|,bullist,numlist,link,image,media,|,code,preview,fullscreen",
                theme_advanced_buttons3 			: "",
                theme_advanced_toolbar_location 	: "top",
                theme_advanced_toolbar_align 		: "left",
                theme_advanced_statusbar_location 	: "bottom",
                theme_advanced_resizing 			: false,
                font_size_style_values 				: "8pt,10px,12pt,14pt,18pt,24pt,36pt",
                init_instance_callback				: function(){
                    function resizeWidth() {
                        document.getElementById(tinyMCE.activeEditor.id+'_tbl').style.width='100%';
                    }
                    resizeWidth();
                    $(window).resize(function() {
                        resizeWidth();
                    })
                },
                // file browser
                file_browser_callback: function openKCFinder(field_name, url, type, win) {
                    tinyMCE.activeEditor.windowManager.open({
                        file: 'file-manager/browse.php?opener=tinymce&type=' + type + '&dir=image/themeforest_assets',
                        title: 'KCFinder',
                        width: 700,
                        height: 500,
                        resizable: "yes",
                        inline: true,
                        close_previous: "no",
                        popup_css: false
                    }, {
                        window: win,
                        input: field_name
                    });
                    return false;
                }
            });

            $(document).ready(function(){
                var _tempID = "";
                $('.no-primary').each(function(){
                    $(this).attr('disabled','disabled');
                });

                $('#reg2_form').submit(function(){
                    //return false;
                });

                $('#btn_cetak1').click(function(){
                    /*
                    jQuery.CreateTemplate("inches",8.268,11.693,0.3815,0.5965,2.5,1.5,3,2,0.0,0.0);
                    jQuery.CreateLabel();
                    jQuery.AddText(0.5,0.9, $('#txt_nama').val(),16);
                    jQuery.DrawPDF('');

                    jQuery.CreateTemplate("inches",8.268,11.693,0.3815,0.5965,2.5,1.5,3,2,0.0,0.0);
                    jQuery.CreateLabel();
                    jQuery.AddText(0.5,0.9, $('#NamaPJ').val(),14);
                    jQuery.DrawPDF('');

                    jQuery.CreateTemplate("inches",8.268,11.693,0.3815,0.5965,2.5,1.5,3,2,0.0,0.0);
                    jQuery.CreateLabel();
                    jQuery.AddText(0.5,0.9, $('#no_rm').val(),14);
                    jQuery.DrawPDF('finish');
                    */                    
                    window.open( '{{ url("pasien/label_map") }}/' + $('#txt2_no_rm').val() );

                });

                $('#btn_cetak2').click(function(){
                    /*
                    jQuery.CreateTemplate("inches",8.268,11.693,0.3815,0.5965,2.5,1.5,1,1,0.0,0.0);
                    jQuery.CreateLabel();
                    jQuery.AddText(0.5,0.9, "Nama : " + $('#txt_nama').val(),13);
                    jQuery.AddText(0.5,0.70,"No RM : " + $('#no_rm').val(),13);
                    jQuery.AddText(0.5,0.50,"TL : " + $('#txt_tanggal_lahir').val(),13);
                    jQuery.DrawPDF('');
                    */
                    window.open( '{{ url("pasien/label") }}/' + $('#txt2_no_rm').val() )
                });

                $('#btn_cetak3').click(function(){
                    var _val = $("#btn_cetak3").attr('target');
                    window.open( _val );
                });

                $('#cmb_golongan_pasien').change(function(){
                    var _val = $(this).val();

                    $('#cmb_cara_bayar').val(_val);
                });

                /*
                $('#no_rm').qtip({
                    content: {
                        text: 'No RM harus 6 digit'
                    }, 
                    show: {
                        event: 'focus'
                    },
                    hide: {
                       event: 'blur'
                    }
                });
    */
                $('#btn_pasien_rawat').click(function(){
                    if( $('#txt_nama').val() != '' ){
                        

                        $('#txt2_id_register').attr('disabled','disabled');

                        $('#txt2_nama').val( $('#txt_nama').val() );
                        $('#txt2_tempat_lahir').val( $('#txt_tempat_lahir').val() );
                        $('#txt2_nama').val( $('#txt_nama').val() );

                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!
                        var yyyy = today.getFullYear();

                        var hours = today.getHours();
                        var minutes = today.getMinutes();
                        var seconds = today.getSeconds()
                        if (minutes < 10){
                            minutes = "0" + minutes
                        }

                        if (seconds < 10){
                            seconds = "0" + seconds
                        }

                        if(dd<10) {
                            dd='0'+dd
                        } 

                        if(mm<10) {
                            mm='0'+mm
                        } 

                        today = dd+'/'+mm+'/'+yyyy;
                        $('#no_kartu').val( _kartu );
                        $('#tanggal_rujukan').val(today);
                        $('#txt2_tanggal_masuk').val(today);
                        $('#txt2_jam_masuk').val(hours+':'+minutes+':'+seconds);
                        $('#hidden_fields').html('');
                        $("form#reg1_form :input").each(function(){
                            var input = $(this);
                            $('#hidden_fields').append('<input type="hidden" id="new_'+input.attr('id')+'" name="new_'+input.attr('id')+'" value="'+input.val()+'" />');
                        });

                        if( _baru == 'ya' ){
                            if( $('#manual').is(':checked') ){
                                $('#txt2_no_rm').val( $('#no_rm').val() );
                            }
                            else{
                                $('#txt2_no_rm').val('');
                            }
                            
                            $.ajax({
                                 url: "{{ url('pasien/tambah_baru') }}",
                                 type: "POST",
                                 dataType : "json" ,
                                 data : $('#reg2_form').serialize(),
                                 success:function(nres){
                                    if( nres.status == 'berhasil'){
                                        cetak_alert("Nomor RM pasien "+nres.norm);
                                        $('#no_rm').val(nres.norm);
                                        $('#txt2_no_rm').val(nres.norm);

                                        $('#reg1_form').hide();
                                        $('#reg2_form').show();

                                        $('.btn-top').each(function(){
                                            $(this).hide();
                                        })
                                    }
                                    else{
                                        $.sticky("Nomor RM telah digunakan", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                                       
                                    }
                                   
                                },
                                error:function(x,t,m){
                                    cetak_alert("Pendaftaran pasien gagal");
                                    $('#btn_daftar').attr('disabled',false);
                                    $('#btn_batal').attr('disabled',false);
                                }
                            });
                        }
                        else{
                            $('#reg1_form').hide();
                            $('#reg2_form').show();

                            $('.btn-top').each(function(){
                                $(this).hide();
                            })
                        }

                        

                    }
                    else{
                        $('#txt_nama').focus();
                    }
                    
                });

                $('#btn_batal').click(function(){
                    $('#reg1_form').show();
                    $('#reg2_form').hide();

                    $('.btn-top').each(function(){
                        $(this).show();
                    })
                });
                

                $( "#no_cari" ).focus();
                $('.sub-group').hide();

                $('#no_cari').bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        if( $('#no_cari').val() != ''){
                            pasien_find( $('#no_cari').val() );
                            _tempID = $('#no_cari').val();
                        }                        
                    }
                    
                });

                $('#no_cari').focusout(function() {
                    if( $('#no_cari').val() == '' ){

                    }
                    else{
                        if( _tempID != $('#no_cari').val() ){
                            pasien_find( $('#no_cari').val() );
                            _tempID = $('#no_cari').val()
                        }
                    }               
                    
                });
    
                $('#cmb_golongan_pasien').change(function(){
                    golongan_pasien();
                    sub_golongan_pasien();
                });

                $('#cmb_sub_golongan').change(function(){
                    sub_golongan_pasien();
                })

                $('#btn_reset_data').click(function(){
                    reset_data();
                });

                $(".chzn_a").chosen({
                    allow_single_deselect: true
                });
                
                $('#btn_pasien_baru').click(function(){
                    pasien_baru();
                });

                golongan_pasien();

                $('#cari_pasien').on('shown', function () {
                    $("#tbl_pasien_filter input").focus();
                });

                $('#btn_hapus').click(function(){
                    var r = confirm("Apakah anda ingin menghapus pasien ini?");
                    if(r){
                        var norm = $('#no_rm').val();         
                        $.ajax({
                            url: "{{ url('pasien/soft_delete') }}",
                            type: "POST",
                            data : "norm="+norm,
                            success:function(res){
                                //alert(res);
                                $.sticky("Data pasien berhasil dihapus", {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                                reset_data();
                                $('#tbl_pasien').dataTable().fnReloadAjax();
                            }
                        });
                    }
                });

                $('#btn_update').click(function(){
                    $('#hidden_fields').html('');
                    $("form#reg1_form :input").each(function(){
                        var input = $(this);
                        $('#hidden_fields').append('<input type="hidden" id="new_'+input.attr('id')+'" name="new_'+input.attr('id')+'" value="'+input.val()+'" />');
                    });
                    var datastring = $("#reg2_form").serialize();
                    $.ajax({
                        type: "POST",
                        url: "{{ url('pasien/update_data') }}",
                        data: datastring,
                        success: function(data) {
                            $.sticky(data, {speed : 'slow', autoclose : false, position: "top-right", type: "st-info" });
                        },
                        error: function(){
                            $.sticky("Error occured", {speed : 'slow', autoclose : true, position: "top-right", type: "st-info" });
                        }
                    });

                    $('#tbl_pasien').dataTable().fnReloadAjax();
                });

                $('#btn_diagnosa').click(function(){
                    $('#cari_diagnosa').modal('show');
                });

                $('#cari_diagnosa').on('shown', function () {
                    $("#tbl_diagnosa_filter input").focus();
                });

                $('#btn_rujukan').click(function(){
                    $('#cari_rujukan').modal('show');
                });

                $('#cari_rujukan').on('shown', function () {
                    $("#tbl_rujukan_filter input").focus();
                });

                $('#btn_pasien_rawat').click(function(){
                     $('#no_rujukan').focus();
                });

                $('#no_rujukan').bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        $('#tanggal_rujukan').focus();
                    }
                });

                $('#tanggal_rujukan').bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        $('#ppk_rujukan').focus();
                    }
                });

                $("#ppk_rujukan").autocomplete({
                    source: "{{URL('sep/getppkdata/')}}",
                    minLength: 2,
                    select: function(event, ui) {
                        $('#id_ppk_rujukan').val(ui.item.id);
                        $('#txt2_tanggal_masuk').focus();
                    }
                });

                $('#ppk_rujukan').bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        $('#txt2_tanggal_masuk').focus();
                    }
                });

                $('#txt2_tanggal_masuk').bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        $('#txt2_jam_masuk').focus();
                    }
                });

                $('#txt2_jam_masuk').bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        $('#diagnosa').focus();
                    }
                });

                $("#diagnosa").autocomplete({
                    source: "{{URL('sep/getdiagnosadata/')}}",
                    minLength: 2,
                    select: function(event, ui) {
                        $('#id_diagnosa').val(ui.item.id);
                        $('.chzn-container').mousedown();
                    }
                });

                $('#diagnosa').bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    if(code == 13) { //Enter keycode
                        $('.chzn-container').mousedown();
                    }
                });

                $('#btn_riwayat').click(function(){
                    if(_kartu == '' || _kartu == '-'){

                    }
                    else{
                        var _temp = "{{ url('sep/list_view') }}/"+_kartu;
                        document.location = _temp;
                    }
                    
                })

                $('#btn_daftar').click(function(){
                    var cek_bpjs = $('#cmb_golongan_pasien').val();
                    var no_kartu = $('#no_kartu').val();

                    cetak_alert('Mohon tunggu');

                    if(no_kartu == '-')
                        no_kartu = '';
                    var _buat = $('#buat_sep').val();

                    //_buat = 'no';

                    $('#btn_daftar').attr('disabled','disabled');
                    $('#btn_batal').attr('disabled','disabled');
                    $('#btn_baru').attr('disabled','disabled');
                    $('#btn_cetak').attr('disabled','disabled');

                    if( _buat == 'yes' && $('#chk_sep').is(':checked') ){
                        var tanggal_sep = $('#txt2_tanggal_masuk').val();
                        var tanggal_rujukan = $('#tanggal_rujukan').val();
                        var no_rujukan = $('#no_rujukan').val();
                        var ppk_rujukan = $('#id_ppk_rujukan').val();
                        var ppk_pelayanan = $('#id_ppk_pelayanan').val();
                        var jenis_pelayanan = $('#jenis_pelayanan').val();
                        var catatan = $('#txt2_keterangan').val();
                        var diagnosa_awal = $('#id_diagnosa').val();
                        var poli = "";
                        var kelas_rawat = $('#kelas_rawat').val();
                        var user = "";
                        var no_mr = ""
                        
                        if(no_kartu == ''){
                            cetak_alert('Nomor Kartu BPJS tidak boleh kosong');
                            $('#no_kartu').focus();
                            $('#btn_daftar').attr('disabled',false);
                            $('#btn_batal').attr('disabled',false);
                        }
                        else if(no_rujukan == ''){
                            cetak_alert('Nomor Rujukan tidak boleh kosong');
                            $('#no_rujukan').focus();
                            $('#btn_daftar').attr('disabled',false);
                            $('#btn_batal').attr('disabled',false);
                        }
                        else{
                            $.ajax({
                                url: "{{ url('sep/buat_proses') }}",
                                type: "POST",
                                data :  "no_kartu="+no_kartu+"&tanggal_sep="+tanggal_sep+"&tanggal_rujukan="+tanggal_rujukan+
                                        "&no_rujukan="+no_rujukan+"&ppk_rujukan="+ppk_rujukan+"&ppk_pelayanan="+ppk_pelayanan+
                                        "&jenis_pelayanan="+jenis_pelayanan+"&catatan="+catatan+"&diagnosa_awal="+diagnosa_awal+
                                        "&poli="+poli+"&kelas_rawat="+kelas_rawat+"&user="+user+"&no_mr="+no_mr,
                                success:function(res){
                                    if(res != 'sukses'){
                                        var pesan = "";
                                        var panjang = res;
                                        if (panjang.length > 21){
                                            cetak_alert(res);
                                            $('#btn_daftar').attr('disabled',false);
                                            $('#btn_batal').attr('disabled',false);
                                        }
                                        else{
                                            $('#btn_cetak').attr('disabled',false);
                                            $('#btn_cetak').attr('href','{{ url("/sep/pdf_sep/") }}/'+res)
                                            pesan = 'Pembuatan SEP Berhasil.<br />No SEP : '+res;
                                            cetak_alert(pesan+" ..<br />Pendaftaran pasien berhasil");
                                        }
                                    }
                                    else{
                                        cetak_alert(res);
                                        $('#btn_daftar').attr('disabled',false);
                                        $('#btn_batal').attr('disabled',false);
                                    }
                                },
                                error: function(x, t, m) {
                                    if(t==="timeout") {
                                        cetak_alert("got timeout");
                                    } else {
                                        cetak_alert(t);
                                    }
                                    $('#btn_daftar').attr('disabled',false);
                                    $('#btn_batal').attr('disabled',false);
                                }
                            });
                        }
                    }
                    else{
                        $.ajax({
                            url: "{{ url('rawat_inap') }}",
                            type: "POST",
                            dataType: "json",
                            data : $('#reg2_form').serialize(),
                            success:function(nres){
                                if(nres.pesan != 'sukses'){
                                    pesan = nres.pesan;
                                        
                                    $('#btn_daftar').attr('disabled',false);
                                    $('#btn_batal').attr('disabled',false);
                                }
                                else{
                                    pesan = "Pendaftaran pasien berhasil";
                                    $('#btn_cetak3').attr('disabled',false);
                                    $('#btn_cetak3').attr('target','{{ url("/rawat_inap/struk/") }}/'+nres.noreg);
                                }

                                cetak_alert(pesan);
                                $.sticky(pesan, {speed : 3000, autoclose : true, position: "top-right", type: "st-info" });
                                
                            },
                            error:function(x,t,m){
                                cetak_alert(m);
                                $('#btn_daftar').attr('disabled',false);
                                $('#btn_batal').attr('disabled',false);
                            }
                        });
                    }

                    $('#btn_baru').attr('disabled',false);
                });

                $("#manual").change(function(){
                    if( $('#manual').is(':checked') ){
                        $('#no_rm').attr('readonly' , false);
                        $('#no_rm').focus();
                        $('#no_rm').attr('maxLength' , '6');
                    }
                    else{
                        $('#no_rm').attr('readonly' , 'readonly');
                        $('#no_rm').attr('maxLength' , '20');
                    }
                })
            });

        var subgol = '';

        function pilih_diagnosa(id,nama){
            $('#id_diagnosa').val(id);
            $('#diagnosa').val(nama);
            $('#cari_diagnosa').modal('hide');
        }

        function pilih_ppk_rujukan(id,nama){
            $('#id_ppk_rujukan').val(id);
            $('#ppk_rujukan').val(nama);
            $('#cari_rujukan').modal('hide');
        }

        function pasienInfo(){
            var _golPasien = $('#cmb_golongan_pasien').val();
            $('#info_bjps').hide();
            if(_golPasien == 'BPJS'){
                //cetak_alert('Mohon Tunggu')
                $.ajax({
                    url: "{{ url('sep/peserta_info') }}"+'/'+_kartu,
                    dataType: "json",
                    success: function(res){
                        if(res.response == '404'){
                            //cetak_alert('Data pasien tidak ditemukan pada database BPJS lokal');
                            $('#buat_sep').val('no');
                            $('#info_bjps').hide();
                            $('#info_bjps div').html('');
                            //$('#btn_riwayat').attr('disabled','disabled');
                            $('#chk_sep').attr('checked', false);
                            $('.sep').hide();
                        }
                        else{
                            //cetak_alert('Pasien terdaftar di BPJS lokal dengan nama '+res.nama);
                            $('#buat_sep').val('yes');
                            $('#info_bjps').show();
                            $('#info_bjps div').html('Nomor Kartu : '+res.noKartu+'<br />Jenis Pasien : '+res.jenisPeserta.nmJenisPeserta+
                                '<br />Kelas Tanggungan : '+res.kelasTanggungan.nmKelas);
                            //$('#btn_riwayat').attr('disabled',false);
                            $('#chk_sep').attr('checked', true);
                            $('.sep').show();
                        }
                    },
                    error: function(){
                        //cetak_alert('Data pasien tidak ditemukan pada database BPJS lokal (RTO)');
                        $('#buat_sep').val('no');
                        $('#info_bjps').hide();
                        $('#info_bjps div').html('');
                        //$('#btn_riwayat').attr('disabled','disabled');
                        $('#chk_sep').attr('checked', false);
                        $('.sep').hide();
                    }
                });
            }
            else{
                //cetak_alert('Pasien masuk golongan '+_golPasien);
                $('#buat_sep').val('no');
                $('#chk_sep').attr('checked', false);
                $('.sep').hide();
            }
        }

        function dataSet(){
            //$('#no_rm').attr('disabled','disabled');
            $('.no-primary').attr('disabled',false);
        }

        function dataNotSet(){
            $('#no_rm').attr('disabled',false);
            $('.no-primary').attr('disabled','disabled');
        }

        function golongan_pasien(){
            var _gol = $('#cmb_golongan_pasien').val();
            if(_gol == 'BPJS'){
                $('#cmb_sub_golongan').show();
            }
            else if(_gol == 'Swasta'){
                $('#cmb_sub_golongan').hide();

            }
            else if(_gol == 'Jamkesda'){
                $('#cmb_sub_golongan').hide();
            }
            else{
                $('#cmb_sub_golongan').hide();
            }
        }

        function capitaliseFirstLetter(str) {
            if( str != '' ){
                str = str.toLowerCase();
                return str.charAt(0).toUpperCase() + str.slice(1);
            }
            else{
                return '';
            }
        }

        function sub_golongan_pasien(){
            var _gol = $('#cmb_golongan_pasien').val();
            subgol = '';
            if(_gol == 'BPJS'){
                var _subgol = $('#cmb_sub_golongan').val();
                if(_subgol == 'Askes'){
                    $('.sub-group').hide();
                    $('#askes_group').show();
                    subgol = 'askes';
                }
                else if(_subgol == 'Dinas'){
                    $('.sub-group').hide();
                    $('#dinas_group').show();
                    subgol = 'dinas';
                }
                else if(_subgol == 'BPJS Mandiri'){
                    $('.sub-group').hide();
                    $('#mandiri_group').show();
                    subgol = 'mandiri';
                }
                else if(_subgol == 'Jamkesmas'){
                    $('.sub-group').hide();
                    $('#jamkesmas_group').show();
                    subgol = 'jamkesmas';
                }
                else{
                    $('.sub-group').hide();
                }
            }
            else if(_gol == 'Swasta'){
                $('.sub-group').hide();
                $('#swasta_group').show();
                subgol = 'swasta';
            }
            else if(_gol == 'Jamkesda'){
                $('.sub-group').hide();
                $('#jamkesda_group').show();
                subgol = 'jamkesda';
            }
            else{
                $('.sub-group').hide();
                subgol = '';
            }
        }

        function pasien_find(val){
            $.ajax({
                url: "{{ url('rest/pasien') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                if(res == false){   
                    //alert('No RM belum digunakan');
                    $(':text.no-primary').each(function(){
                        $(this).val('');
                    });

                    var _norm = $('#no_cari').val();
                    if( _norm.length < 2){
                        $('#no_cari').focus();
                        $('.no-primary').each(function(){
                            $(this).attr('disabled','disabled');
                        });
                    }
                    else{
                        $('.no-primary').each(function(){
                            $(this).attr('disabled',false);
                        });
                        $('#txt_nama').focus();
                        $('#txt2_no_rm').val( $('#no_rm').val() );

                        $('#btn_poli').attr('disabled','disabled');
                        $('#btn_ugd').attr('disabled','disabled');

                        golongan_pasien();
                        sub_golongan_pasien();

                        $('#btn_update').attr('disabled','disabled');
                        $('#btn_hapus').attr('disabled','disabled');
                        
                    }
                }
                else{
                    first_reset();
                    $('#btn_poli').attr('disabled',false);
                    $('#btn_ugd').attr('disabled',false);

                    $('#btn_update').attr('disabled',false);
                    $('#btn_hapus').attr('disabled',false);

                    $('#no_rm').val( res[0].NoRM );
                    $('#txt2_no_rm').val( $('#no_rm').val() );
                    $('#txt_nama').val(res[0].Nama);
                    $('#txt_no_ktp').val(res[0].NoKTP);

                    $('#cmb_jenkel').val(res[0].Jkel)
                    $('#txt_tempat_lahir').val(res[0].TempatLahir);
                    if( res[0].TanggalLahir != '' || res[0].TanggalLahir != '-'){
                        var _tglArray = res[0].TanggalLahir.split("-");
                            $('#cmb_tanggal_lahir').val(_tglArray[2]);
                            $('#cmb_bulan_lahir').val(_tglArray[1]);
                            $('#cmb_tahun_lahir').val(_tglArray[0]);
                    }
                    else{
                        
                    }
                    
                    $('#txt_alamat').val(res[0].Jalan);
                    $('#txt_kelurahan').val(res[0].Kelurahan);
                    $('#txt_kecamatan').val(res[0].Kecamatan);
                    $('#txt_kota').val(res[0].KotaKab);
                    $('#txt_provinsi').val(res[0].Provinsi);
                    $('#txt_suku').val(res[0].Suku);
                    //alert(capitaliseFirstLetter(res[0].Agama));
                    if(res[0].Agama != '' || res[0].Agama != '-'){
                        $('#cmb_agama').val( capitaliseFirstLetter(res[0].Agama) );
                    }
                    else{
                        $('#cmb_agama').val('-');
                    }
                    
                    $('#txt_no_telp').val(res[0].NoTelp);
                    $('#cmb_status').val(res[0].Status);
                    $('#txt_pekerjaan').val(res[0].Pekerjaan);                    
                    $('#cmb_pendidikan').val(res[0].Pendidikan);
                    $('#cmb_golongan_pasien').val(res[0].GolPasien);
                    $('#cmb_cara_bayar').val(res[0].GolPasien);
                    golongan_pasien();
                    $('#cmb_sub_golongan').val(res[0].SubGolPasien);
                    $('#cmb_kelas_bpjs').val(res[0].KelasAskes);
                    sub_golongan_pasien();
                     _kartu = '';
                    if(subgol != ''){                        
                        if(subgol == 'askes'){
                            _kartu = res[0].NoBPJS;
                        }
                        else if(subgol == 'swasta'){
                            $('#cmb_swasta_golongan').val(res[0].GolSwasta);
                            $('#cmb_perusahaan').val(res[0].NamaPerusahaan);
                            _kartu = res[0].NoKartuSwasta;
                        }
                        else if(subgol == 'jamkesmas'){
                            _kartu = res[0].NoJamkesmas;
                        }
                        else if(subgol == 'jamkesda'){
                            _kartu = res[0].NoJamkesda;
                        }
                        else if(subgol == 'dinas'){
                            _kartu = res[0].NoBPJS;
                        }
                        else{
                            _kartu = res[0].NoBPJS;
                        }

                        $('#txt_'+subgol+'_kartu').val(_kartu);
                    }
                    if(_kartu == '' || _kartu == '-'){
                        $("#btn_riwayat").attr('disabled','disabled');
                    }
                    else{
                        $("#btn_riwayat").attr('disabled',false);
                    }
                    $('#txt_dinas_nip').val(res[0].NRPNIP);
                    $('#cmb_dinas_golongan').val(res[0].GolDinas); 
                    $('#cmb_dinas_hubungan').val(res[0].Hub);
                    $('#cmb_dinas_jenis_hubungan').val(res[0].JenisHub); 
                    $('#cmb_dinas_pangkat').val(res[0].PangkatGol);
                    $('#cmb_golongan_kesatuan').val(res[0].GolKes); 
                    $('#txt_dinas_kesatuan').val(res[0].Kesatuan); 
                    $('#NamaPJ').val(res[0].NamaPJ); 
                    $('#AlamatPJ').val(res[0].AlamatPJ); 
                    $('#HubPJ').val(res[0].HubPJ); 
                    $('#TelpPJ').val(res[0].TelpPJ); 

                    $('#manual').attr('checked' , false);
                    $('#manual').attr('disabled' , 'disabled');
                    $('#no_rm').attr('readonly' , 'readonly');
                    _baru = "no";

                    get_reg_jalan();
                    get_reg_ugd();
                    dataSet();
                    get_history();
                    pasienInfo();
                }
                },
                error:function(res){
                    alert('Connection failed');
                }
            })
        }

        function reset_data(){
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

            $(':text.no-primary').each(function(){
                $(this).val('');
            });

            $('#no_rm').val('');
            $('#no_rm').attr('disabled',false);
            $('#pesan_error').hide();
            $('#no_rm').focus();

        }

        function first_reset(){
            $('.no-primary').each(function(){
                $(this).attr('disabled','disabled');
            });

            $(':text.no-primary').each(function(){
                $(this).val('');
            });
        }

        function pilih_pasien(id){
            $('#cari_pasien').modal('hide');
            $('#no_rm').val(id);
            pasien_find(id);

            $('#success_alert').hide();
        }

        function pasien_baru(){
            $('.no-primary').each(function(){
                $(this).attr('disabled',false);
            });

            $(':text.no-primary').each(function(){
                $(this).val('');
            });

            $('#no_rm').val('');
            $('#no_cari').val('');
            //$('#no_cari').attr('disabled',false);
            $('#txt_nama').focus();
            _baru = "ya";

            $('#manual').attr('disabled' , false);
            golongan_pasien();
            sub_golongan_pasien();
        }

        function get_reg_jalan()
        {
            $('#txt2_id_register_poli').val('');
            var no_rm = $('#no_rm').val();
            // dynamic table
            if(poli_table)
                poli_table.fnDestroy();

            poli_table = jQuery('#tbl_pasien_poli').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                        "sPaginationType": "full_numbers",
                        "bProcessing": false,
                        "sAjaxSource": "{{ url('rawat_jalan/popup_table_bynorm') }}"+'/'+no_rm,
                        "bServerSide": true
            });
        }

        function pilih_pasien_jalan(id,desc)
        {
            $('#txt2_id_register_poli').val(id);
            $('#txt2_id_register_ugd').val('');
            $('#cari_pasien_poli').modal('hide');
        }

        function get_reg_ugd()
        {
            $('#txt2_id_register_ugd').val('');
            var no_rm = $('#no_rm').val();
            // dynamic table
            if(ugd_table)
                ugd_table.fnDestroy();
            ugd_table = jQuery('#tbl_pasien_ugd').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                        "sPaginationType": "full_numbers",
                        "bProcessing": false,
                        "sAjaxSource": "{{ url('ugd/popup_table_bynorm') }}"+'/'+no_rm,
                        "bServerSide": true
            });
        }

        function pilih_pasien_ugd(id,desc)
        {
            $('#txt2_id_register_ugd').val(id);
            $('#txt2_id_register_poli').val('');
            $('#cari_pasien_ugd').modal('hide');
        }

        function get_history()
        {
            var val = $('#no_rm').val();
            $.ajax({
                url: "{{ url('pasien/history/inap') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#tbl_history_pasien tbody').html('');
                    if(res == false){
                        $('#tbl_history_pasien > tbody').html('<tr><td colspan="4">Tidak ada riwayat yang ditampilkan</td></tr>');
                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#tbl_history_pasien tbody').append('<tr><td>'+data.NoReg+'</td>'+
                                '<td>'+data.Tanggal+'</td><td>'+data.Ruangan+'</td>'+'</tr>');
                        });
                    }
                }
            });
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
                        get_history();
                    }
                });
            }
        }

        function cetak_alert(str){
            $('#pesan_error').show();
            $('#pesan_error').html(str);
        }
	</script>