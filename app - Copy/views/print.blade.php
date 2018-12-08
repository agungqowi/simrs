<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>RS_<?php echo time() ?></title>
        @section('css')
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
            {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
            {{ HTML::style('bootstrap/css/bootstrap-responsive.min.css') }}
            {{ HTML::style('css/eastern_blue.css') }}
            {{ HTML::style('lib/jBreadcrumbs/css/BreadCrumb.css') }}
            {{ HTML::style('lib/qtip2/jquery.qtip.min.css') }}
            {{ HTML::style('lib/colorbox/colorbox.css') }}
            {{ HTML::style('lib/google-code-prettify/prettify.css') }}
            {{ HTML::style('lib/sticky/sticky.css') }}
            {{ HTML::style('img/splashy/splashy.css') }}
            {{ HTML::style('img/flags/flags.css') }}
            {{ HTML::style('lib/fullcalendar/fullcalendar_gebo.css') }}
            {{ HTML::style('lib/datatables/css/jquery.dataTables2.css') }}
            {{ HTML::style('css/style.css') }}
            {{ HTML::script('js/jquery.min.js') }}

            <style type="text/css">
                body{font-size: 10px;}
            </style>
	
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
		
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            {{ HTML::script('js/ie/html5.js') }}
			{{ HTML::script('js/ie/respond.min.js') }}
			{{ HTML::script('lib/flot/excanvas.min.js') }}
        <![endif]-->
        @show
    </head>
    <body class="">
		<div id="" class="clearfix">
			<!-- header -->
            @yield('content')
			<!-- sidebar -->

            @section('js')
			{{ HTML::script('js/jquery_cookie.min.js') }}
			<!-- main bootstrap js -->
			{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
			<!-- bootstrap plugins -->
			{{ HTML::script('js/bootstrap.plugins.min.js') }}
            <!-- dashboard functions -->
            <script type="text/javascript">
                $(window).load(function(){
                    window.print();
                })
            </script>
            @show
		
		</div>
	</body>
</html>