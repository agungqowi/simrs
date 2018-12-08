@extends('layout')

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
        					<a href="{{ action('DashboardController@index') }}">Info Pasien</a>
        				</li>
        				<li>
        					Rawat Inap
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Form Pasien Rawat Inap<a class="btn btn-gebo" href="#">Pencarian pasien</a></h3>
	        		@if( $errors->first('title') || $errors->first('note') )
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('title') }}
							{{ $errors->first('note') }}
						</div>
	        		@endif
                    
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div class="span6">
    	        			<div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <div class="controls">
                                    <select>
                                        <option>Laki-laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tempat Lahir</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Golongan Pasien</label>
                                <div class="controls">
                                    <select id="golongan_pasien">
                                        <option>BPJS</option>
                                        <option>Swasta</option>
                                        <option>Jamkesda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ruangan</label>
                                <div class="controls">
                                    <select>
                                        <option>-</option>
                                        <option>Anggrek No Kamar 1</option>
                                        <option>Anggrek No Kamar 2</option>
                                        <option>Anggrek No Kamar 3</option>
                                        <option>Anggrek No Kamar 4</option>
                                        <option>Anggrek No Kamar 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Dokter</label>
                                <div class="controls">
                                    <select>
                                        <option>-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            
                            <div class="control-group">
                                <label class="control-label">Alamat</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kelurahan</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kecamatan</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kota</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Provinsi</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                        </div>
                        <div class="span12">
                            <div class="btn-group">
                                <button class="btn btn-primary">Dokter</button>
                                <button class="btn btn-info">Tindakan</button>
                                <button class="btn btn-success">Diagnosa</button>
                                <button class="btn btn-danger">Periksa</button>
                            </div>

                            <div class="btn-group">
                                <button class="btn btn-primary">Koreksi Ruangan</button>
                                <button class="btn btn-info">Pindah Ruangan</button>
                                <button class="btn btn-success">Pasien Pulang</button>
                                <button class="btn btn-danger">Tampil</button>
                            </div>
                        </div>
                    </div>
					{{ Form::close() }}

                    {{ Form::open(array('url' => '' , 'id'=>'reg2_form', 'class' => 'form-horizontal' , 'style' => 'display:none')) }}
                    <div class="row-fluid">
                        <div class="span6"> 
                            <div class="control-group">
                                <label class="control-label">ID Register</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tempat Lahir</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jam Masuk</label>
                                <div class="controls">
                                    <input type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ruangan</label>
                                <div class="controls">
                                    <select>
                                        <option>-</option>
                                        <option>Anggrek No Kamar 1</option>
                                        <option>Anggrek No Kamar 2</option>
                                        <option>Anggrek No Kamar 3</option>
                                        <option>Anggrek No Kamar 4</option>
                                        <option>Anggrek No Kamar 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Keterangan</label>
                                <div class="controls">
                                    <textarea class="wysiwg_full span10"></textarea>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary">Submit</button>
                                <button class="btn">Batal</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
	        	</div>
        	</div>
		</div>
	</div>
@stop

@section('js')
	@parent
	{{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
	<script type="text/javascript">
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

            jQuery(document).ready(function(){
                $('#btn_pasien_rawat').click(function(){
                    $('#reg1_form').hide();
                    $('#reg2_form').show();
                })
            })
	</script>
@stop