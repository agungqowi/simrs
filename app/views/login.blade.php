<!doctype html>
<html lang="en" class="login_page">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>Login :: SIMRS</title>
		{{ HTML::style('bootstrap/css/bootstrap.min.css') }}
            {{ HTML::style('bootstrap/css/bootstrap-responsive.min.css') }}
            {{ HTML::style('css/tamarillo.css') }}
            {{ HTML::style('lib/jBreadcrumbs/css/BreadCrumb.css') }}
            {{ HTML::style('lib/qtip2/jquery.qtip.min.css') }}
            {{ HTML::style('lib/colorbox/colorbox.css') }}
            {{ HTML::style('lib/google-code-prettify/prettify.css') }}
            {{ HTML::style('lib/sticky/sticky.css') }}
            {{ HTML::style('img/splashy/splashy.css') }}
            {{ HTML::style('img/flags/flags.css') }}
            {{ HTML::style('lib/fullcalendar/fullcalendar_gebo.css') }}
            {{ HTML::style('lib/datatables/css/jquery.dataTables2.css') }}
            {{ HTML::style("lib/datepicker/datepicker.css") }}
            {{ HTML::style('css/style.css') }}
            {{ HTML::style('css/custom.css') }}

	</head>
	<body>

		<div class="login_box">
			<?php $dasar = DB::table('data_dasar')->where('id' , 1)->first(); ?>
			{{ Form::open(array('url' => 'login' , 'id'=>'login_form')) }}
			<div class="inner_box">
				<div class="top_b"> {{ $dasar->nama_rumah_sakit}} 
				<img style="height:50px;float: right;" src="{{ url('img/'.$dasar->logo) }}" /></div>
				@if( $errors->first('username') || $errors->first('password') ) 
					<div class="alert alert-info alert-login">
						{{ $errors->first('username') }}
						{{ $errors->first('password') }}
					</div>
				@endif
				<div class="cnt_b">
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on">
								<i class="icon-user"></i>
							</span>
							{{ Form::text('username', Input::old('username'), array('placeholder' => 'Username')) }}
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on">
								<i class="icon-lock"></i>
							</span>
							{{ Form::password('password' , array('placeholder' => 'Password')) }}
						</div>
					</div>
					<div class="formRow clearfix">
						<label class="checkbox">
							<input type="checkbox" /> Remember me
						</label>
					</div>
				</div>
				<div class="btm_b clearfix">
					<button class="btn btn-success pull-right" type="submit">Login</button>
					<span style="display:none" class="link_reg"><a href="#pass_form">Forgot password?</a></span>
				</div> 
			</div>
			{{ Form::close() }}
			
			<form action="dashboard.html" method="post" id="pass_form" style="display:none">
				<div class="top_b">Can't sign in?</div>    
					<div class="alert alert-info alert-login">
					Please enter your email address. You will receive a link to create a new password via email.
				</div>
				<div class="cnt_b">
					<div class="formRow clearfix">
						<div class="input-prepend">
							<span class="add-on">@</span><input type="text" placeholder="Your email address" />
						</div>
					</div>
				</div>
				<div class="btm_b tac">
					<button class="btn btn-inverse" type="submit">Request New Password</button><br />
					<span class="linkform">Never mind, <a href="#login_form">send me back to the sign-in screen</a></span>
				</div>
			</form>
			
			
		</div>


	{{ javascript_include_tag() }}

		<script>
            $(document).ready(function(){
                
				//* boxes animation
				form_wrapper = $('.login_box');
				function boxHeight() {
					form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);	
				};
				form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
                $('.linkform a,.link_reg a').on('click',function(e){
					var target	= $(this).attr('href'),
						target_height = $(target).actual('height');
					$(form_wrapper).css({
						'height'		: form_wrapper.height()
					});	
					$(form_wrapper.find('form:visible')).fadeOut(400,function(){
						form_wrapper.stop().animate({
                            height	 : target_height,
							marginTop: ( - (target_height/2) - 24)
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
							$(form_wrapper).css({
								'height'		: ''
							});	
                        });
					});
					e.preventDefault();
				});
				
				//* validation
				$('#login_form').validate({
					onkeyup: false,
					errorClass: 'error',
					validClass: 'valid',
					rules: {
						username: { required: true, minlength: 2 },
						password: { required: true, minlength: 3 }
					},
					highlight: function(element) {
						$(element).closest('div').addClass("f_error");
						setTimeout(function() {
							boxHeight()
						}, 200)
					},
					unhighlight: function(element) {
						$(element).closest('div').removeClass("f_error");
						setTimeout(function() {
							boxHeight()
						}, 200)
					},
					errorPlacement: function(error, element) {
						$(element).closest('div').append(error);
					}
				});
            });
        </script>

	</body>
</html>