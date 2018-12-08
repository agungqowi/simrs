@extends('layout')

@section('css')
	@parent
	{{ HTML::style('lib/datepicker/datepicker.css') }}
@stop

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
        					<a href="{{ URL::to('calendar') }}">Calendar</a>
        				</li>
        				<li>
        					Create new Schedule
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Create new Schedule</h3>
	        		@if($errors->has())
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							@foreach ($errors->all() as $error)
								<div>{{ $error }}</div>
							@endforeach
						</div>
	        		@endif
	        		{{ Form::open(array('url' => 'calendar' , 'id'=>'calendar_form')) }}
	        			<div>
							<label>Title</label>
							<input type="text" name="title" class="span8" value="{{ Input::old('title') }}">
						</div>
						<div class="formSep">
								<label>Start from</label>
								<div class="row-fluid">
									<div class="span2">
										<div class="input-append date" id="date_start">
											<input value="{{ Input::old('date_start') }}" name="date_start" readonly="readonly" class="span10" type="text"/><span class="add-on"><i class="splashy-calendar_day_up"></i></span>
										</div>
									</div>
									<div class="span2">
										<input value="{{ Input::old('time_start') }}" type="text" name="time_start" class="span10 timepicker"/>
									</div>
								</div>
									
						</div>
						<div class="row-fluid formSep">
							<label>Until</label>
							<div class="row-fluid">
								<div class="span2">
									<div class="input-append date" id="date_end">
										<input value="{{ Input::old('date_end') }}" name="date_end" readonly="readonly" class="span10" type="text" /><span class="add-on"><i class="splashy-calendar_day_down"></i></span>
									</div>
								</div>
								<div class="span2">
									<input value="{{ Input::old('time_end') }}" type="text" name="time_end" class="span10 timepicker">
								</div>
						</div>
						<div class="formSep">
							<label>Description</label>
							<textarea name="description" id="wysiwg_full" cols="30" rows="10">{{ Input::old('description') }}</textarea>
						</div>
						
						<div class="formSep">
							<input type="submit" value="Submit" class="btn btn-primary" />
							<a href="{{ URL::to('project') }}" class="btn">Cancel</a>
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
	{{ HTML::script('lib/datepicker/bootstrap-datepicker.min.js') }}
	{{ HTML::script('lib/datepicker/bootstrap-timepicker.min.js') }}
	<script type="text/javascript">
		$(document).ready(function(){
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
			$('#date_start').datepicker({format: "mm/dd/yyyy"}).on('changeDate', function(ev){
				var dateText = $(this).data('date');
				
				var endDateTextBox = $('#date_end input');
				if (endDateTextBox.val() != '') {
					var testStartDate = new Date(dateText);
					var testEndDate = new Date(endDateTextBox.val());
					if (testStartDate > testEndDate) {
						endDateTextBox.val(dateText);
					}
				}
				else {
					endDateTextBox.val(dateText);
				};
				$('#date_end').datepicker('setStartDate', dateText);
				$('#date_start').datepicker('hide');
			});
			$('#date_end').datepicker({format: "mm/dd/yyyy"}).on('changeDate', function(ev){
				var dateText = $(this).data('date');
				var startDateTextBox = $('#date_start input');
				if (startDateTextBox.val() != '') {
					var testStartDate = new Date(startDateTextBox.val());
					var testEndDate = new Date(dateText);
					if (testStartDate > testEndDate) {
						startDateTextBox.val(dateText);
					}
				}
				else {
					startDateTextBox.val(dateText);
				};
				$('#date_start').datepicker('setEndDate', dateText);
				$('#date_end').datepicker('hide');
			});

			$('.timepicker').timepicker({
				defaultTime: 'current',
				minuteStep: 1,
				disableFocus: true,
				template: 'dropdown',
				showMeridian: false
			});
		});
	</script>
@stop