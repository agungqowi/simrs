@extends('layout')

@section('content')
	<div id="contentwrapper">
		<div class="main_content">
			<nav>
        		<div id="jCrumbs" class="breadCrumb module">
        			<ul>
        				<li>
        					<a href="{{ url('dashboard/') }}"><i class="icon-home"></i></a>
        				</li>
        				<li>
        					<a href="{{ url('user/') }}">List User</a>
        				</li>
        				<li>
        					Tambah User
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Tambah User</h3>
	        		@if( $errors->first('username') || $errors->first('email')   || $errors->first('password'))
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('username') }}
							{{ $errors->first('email') }}
                            {{ $errors->first('password') }}
						</div>
	        		@endif
                    <div id="pesan_error" style="display:none;"></div> 
	        		{{ Form::open(array('url' => 'user' , 'id'=>'user_form')) }}
	        			<div>
							<label>Username</label>
							<input type="text" name="username" id="username" />
						</div>
                        <div>
                            <label>Password</label>
                            <input type="text" name="password" id="password" />
                        </div>
                        <div>
                            <label>Konfirmasi Password</label>
                            <input type="text" name="cpassword" id="cpassword" />
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="text" name="email" id="email" />
                        </div>
                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" id="name" />
                        </div>                        
                        <div class="formSep">
                            <label>Grup</label>
                            <select name="grup" id="grup">
                                @if(isset($grup) && !empty($grup))
                                    @foreach($grup as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
						<div >
							<input type="button" id="btnsubmit" value="Submit" class="btn btn-primary" />
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
            $('textarea#wysiwg_full').tinymce({
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
            $('#btnsubmit').click(function(){
                $('#pesan_error').hide();
                if( $('#username').val() == '' ){
                    cetak_error('Username harus diisi');
                }  
                else if( $('#password').val() == '' ){
                    cetak_error('Password harus diisi');
                }
                else if( $('#password').val() != $('#cpassword').val() ){
                    cetak_error('Password dan Konfirmasi Password tidak sama');
                }
                else{
                    $('#user_form').submit();
                }
            });

            function cetak_error(str){
                $('#pesan_error').html('<div class="alert alert-error">'+str+'</div>');
                $('#pesan_error').show();
            }  
        })
	</script>
@stop