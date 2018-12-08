<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @if(isset($title))
            <title>{{ $title }}</title>
        @else
            <title>Sistem Informasi Manajemen RS</title>
        @endif
        @section('css')
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
            {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
            {{ HTML::style('bootstrap/css/bootstrap-responsive.min.css') }}
            {{ HTML::style('css/green.css') }}
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
            {{ HTML::style("lib/printjs/print.min.css") }}
            {{ HTML::style('css/style.css') }}
            {{ HTML::style('css/custom.css') }}
            {{ HTML::script('js/jquery-2.2.4.min.js') }}
            {{ HTML::style('css/select2.min.css') }}

            <style type="text/css">
                .scroll-table {
                    width: 400px;
                }

                .scroll-table tr {
                    width: 100%;
                }

                .scroll-table thead th {
                    height: 30px;
                    /*text-align: left;*/
                }

                .scroll-table tbody {
                    overflow-y: scroll;
                    height: 300px;
                    position: absolute;
                    width: inherit;
                }
            </style>
			
	
            <!-- Favicon -->
            <link rel="shortcut icon" href="{{ url('favicon.ico') }}" />
		
            <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            {{ HTML::script('js/ie/html5.js') }}
			{{ HTML::script('js/ie/respond.min.js') }}
			{{ HTML::script('lib/flot/excanvas.min.js') }}
            <![endif]-->
        @show
    </head>
    <body class="">
		<div id="loading_layer" style="display:none"><img src="{{ url('img/ajax_loader.gif') }}" alt="" /></div>
		
		<div id="maincontainer" class="clearfix">
			<!-- header -->
            @include('header')
            @include('sidebar')

            @yield('content')
            
			<!-- sidebar -->

            @section('js')
            
            {{ HTML::script('js/jquery-migrate.min.js') }}
            {{ HTML::script('js/moment.min.js') }}
            {{ HTML::script('js/combodate.js') }}
			<!-- smart resize event -->
			{{ HTML::script('js/jquery.debouncedresize.min.js') }}
			<!-- hidden elements width/height -->
			{{ HTML::script('js/jquery.actual.min.js') }}
			<!-- js cookie plugin -->
			{{ HTML::script('js/jquery_cookie.min.js') }}
			<!-- main bootstrap js -->
			{{ HTML::script('bootstrap/js/bootstrap.min.js') }}
			<!-- bootstrap plugins -->
			{{ HTML::script('js/bootstrap.plugins.min.js') }}
			<!-- tooltips -->
			{{ HTML::script('lib/qtip2/jquery.qtip.min.js') }}
			<!-- jBreadcrumbs -->
			{{ HTML::script('lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js') }}
			<!-- lightbox -->
            {{ HTML::script('lib/colorbox/jquery.colorbox.min.js') }}
            <!-- fix for ios orientation change -->
			{{ HTML::script('js/ios-orientationchange-fix.js') }}
			<!-- scrollbar -->
			{{ HTML::script('lib/antiscroll/antiscroll.js') }}
			{{ HTML::script('lib/antiscroll/jquery-mousewheel.js') }}
			<!-- to top -->
			{{ HTML::script('lib/UItoTop/jquery.ui.totop.min.js') }}
			<!-- mobile nav -->
			{{ HTML::script('js/selectNav.js') }}
			
			{{ HTML::script('lib/jquery-ui/jquery-ui-1.10.0.custom.min.js') }}
            <!-- touch events for jquery ui-->
            {{ HTML::script('js/forms/jquery.ui.touch-punch.min.js') }}
            <!-- multi-column layout -->
            {{ HTML::script('js/jquery.imagesloaded.min.js') }}
            {{ HTML::script('js/jquery.wookmark.js') }}
            <!-- responsive table -->
            {{ HTML::script('js/jquery.mediaTable.min.js') }}
            <!-- small charts -->
            {{ HTML::script('js/jquery.peity.min.js') }}
            <!-- calendar -->
            {{ HTML::script('lib/fullcalendar/fullcalendar.min.js') }}
            <!-- sortable/filterable list -->
            {{ HTML::script('lib/list_js/list.min.js') }}
            {{ HTML::script('lib/list_js/plugins/paging/list.paging.js') }}
            {{ HTML::script('js/forms/jquery.inputmask.min.js') }}
            {{ HTML::script('lib/datepicker/bootstrap-datepicker.min.js') }}
            {{ HTML::script('lib/datepicker/locales/bootstrap-datepicker.id.min.js') }}
            {{ HTML::script('js/select2.min.js') }}
            {{ HTML::script('lib/printjs/print.min.js') }}


            <!-- dashboard functions -->

            {{ HTML::script('lib/sticky/sticky.min.js') }}
            
            <script type="text/javascript">
                $('.dropdown-menu li').each(function(){
                    var $this = $(this);
                    if($this.children('ul').length) {
                        $this.addClass('sub-dropdown');
                        $this.children('ul').addClass('sub-menu');
                    }
                });
                
                $('.sub-dropdown').on('mouseenter',function(){
                    $(this).addClass('active').children('ul').addClass('sub-open');
                }).on('mouseleave', function() {
                    $(this).removeClass('active').children('ul').removeClass('sub-open');
                })

                $(document).ready(function(){
                    $('.tanggal').each(function(){
                        //$(this).datepicker({format: "dd/mm/yyyy"});
                        $(this).inputmask("99/99/9999",{placeholder:"dd/mm/yyyy"});
                        /**
                        $(this).combodate({
                            format:'dd/mm/yyyy',
                            template:'D MMM YYYY',
                            smartDays:true
                        });
                        **/
                    });

                    $('.select2').select2();

                    $('.date').each(function(){
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!

                        var yyyy = today.getFullYear();
                        var _yyyy = yyyy-100;
                        $(this).datepicker({
                            format: "dd/mm/yyyy",
                            todayBtn: true,
                            todayHighlight: true,
                            language: "id",
                            autoclose: true,
                            maskInput: true,
                            startDate: dd+'/'+mm+'/'+_yyyy,
                            endDate: dd+'/'+mm+'/'+yyyy,
                        });

                        $(this).prop('readonly', true);
                        $(this).css('cursor','default');
                    });

                    $('.cruddate').each(function(){
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!

                        var yyyy = today.getFullYear();
                        var _yyyy = yyyy-100;
                        var _yyyk = yyyy+20;
                        $(this).datepicker({
                            format: "yyyy-mm-dd",
                            todayBtn: true,
                            todayHighlight: true,
                            language: "id",
                            autoclose: true,
                            maskInput: true,
                            startDate: _yyyy+'-'+mm+'-'+dd,
                            endDate: _yyyk+'-'+mm+'-'+dd,
                        });

                        $(this).prop('readonly', true);
                        $(this).css('cursor','default');
                    });

                    $('.nowdate').each(function(){
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!

                        var yyyy = today.getFullYear();
                        var _yyyy = yyyy-100;
                        $(this).datepicker({
                            format: "dd/mm/yyyy",
                            todayBtn: true,
                            todayHighlight: true,
                            language: "id",
                            autoclose: true,
                            maskInput: true,
                            startDate: dd+'/'+mm+'/'+_yyyy,
                            endDate: dd+'/'+mm+'/'+yyyy,
                        });

                        //$(this).inputmask("99/99/9999",{placeholder:"dd/mm/yyyy"});
                        $(this).css('background-color','#FFFFFF');
                        $(this).css('cursor','default');

                        $(this).val( nowDate() );
                        $(this).qtip({
                            content: {
                                text: 'Format tanggal dd/mm/yyyy'
                            }, 
                            show: {
                                event: 'focus'
                            },
                            hide: {
                               event: 'blur'
                            }
                        });
                        $(this).blur(function(){
                            $(this).nextAll().remove()
                            var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
                            var Val_date=$(this).val();
                               if(Val_date.match(dateformat)){
                              var seperator1 = Val_date.split('/');
                              var seperator2 = Val_date.split('-');

                              if (seperator1.length>1)
                              {
                                  var splitdate = Val_date.split('/');
                              }
                              else if (seperator2.length>1)
                              {
                                  var splitdate = Val_date.split('-');
                              }
                              var dd = parseInt(splitdate[0]);
                              var mm  = parseInt(splitdate[1]);
                              var yy = parseInt(splitdate[2]);
                              var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
                              if (mm==1 || mm>2)
                              {
                                  if (dd>ListofDays[mm-1])
                                  {
                                      $(this).focus();
                                    $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                                  }
                              }
                              if (mm==2)
                              {
                                  var lyear = false;
                                  if ( (!(yy % 4) && yy % 100) || !(yy % 400))
                                  {
                                      lyear = true;
                                  }
                                  if ((lyear==false) && (dd>=29))
                                  {
                                      $(this).focus();
                                    $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                                  }
                                  if ((lyear==true) && (dd>29))
                                  {
                                      $(this).focus();
                                    $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                                  }
                              }
                          }
                          else
                          {
                              $(this).focus();
                              $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                          }
                        });
                    });

                    function nowDate()
                    {
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!

                        var yyyy = today.getFullYear();
                        if(dd<10){
                            dd='0'+dd
                        } 
                        if(mm<10){
                            mm='0'+mm
                        } 
                        var today = dd+'/'+mm+'/'+yyyy;

                        return today;
                    }

                    $('.jam').each(function(){
                        //$(this).datepicker({format: "dd/mm/yyyy"});
                        $(this).inputmask("99:99:99",{placeholder:"jj:mm:dd"});
                    });

                    $('.input-append.date').each(function(){
                        $(this).datepicker({
                            format: "dd/mm/yyyy",
                            todayBtn: true,
                            autoclose: true,
                            todayHighlight: true
                        });
                    });

                    //* sidebar
                    gebo_sidebar.init();
                    gebo_sidebar.make_active();
                    gebo_sidebar.make_scroll();
                    gebo_sidebar.update_scroll();
                });

                function isDate(txtDate)
                {
                    var currVal = txtDate;
                    if(currVal == '')
                        return false;
                  
                    //Declare Regex  
                    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; 
                    var dtArray = currVal.match(rxDatePattern); // is format OK?

                    if (dtArray == null)
                        return false;

                    //Checks for dd/mm/yyyy format.
                    dtDay = dtArray[1];
                    dtMonth= dtArray[3];
                    dtYear = dtArray[5];   

                    if (dtMonth < 1 || dtMonth > 12)
                        return false;
                    else if (dtDay < 1 || dtDay> 31)
                        return false;
                    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
                        return false;
                    else if (dtMonth == 2)
                    {
                        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
                        if (dtDay> 29 || (dtDay ==29 && !isleap))
                            return false;
                    }
                    return true;
                }

                gebo_sidebar = {
                    init: function() {
                        // sidebar onload state
                        if($(window).width() > 979){
                            if(!$('body').hasClass('sidebar_hidden')) {
                                if( $.cookie('gebo_sidebar') == "hidden") {
                                    //$('body').addClass('sidebar_hidden');
                                    //$('.sidebar_switch').toggleClass('on_switch off_switch').attr('title','Show Sidebar');
                                }
                            } else {
                                //$('.sidebar_switch').toggleClass('on_switch off_switch').attr('title','Show Sidebar');
                            }
                        } else {
                            $('body').addClass('sidebar_hidden');
                            $('.sidebar_switch').removeClass('on_switch').addClass('off_switch');
                        }
                        //* sidebar visibility switch
                        $('.sidebar_switch').click(function(){
                            $('.sidebar_switch').removeClass('on_switch off_switch');
                            if( $('body').hasClass('sidebar_hidden') ) {
                                $.cookie('gebo_sidebar', null);
                                $('body').removeClass('sidebar_hidden');
                                $('.sidebar_switch').addClass('on_switch').show();
                                $('.sidebar_switch').attr( 'title', "Hide Sidebar" );
                            } else {
                                $.cookie('gebo_sidebar', 'hidden');
                                $('body').addClass('sidebar_hidden');
                                $('.sidebar_switch').addClass('off_switch');
                                $('.sidebar_switch').attr( 'title', "Show Sidebar" );
                            }
                            $(window).resize();
                        });
                        //* prevent accordion link click
                        $('.sidebar .accordion-toggle').click(function(e){e.preventDefault()});
                    },
                    info_box: function(){
                        var s_box = $('.sidebar_info');
                        var s_box_height = s_box.actual('height');
                        s_box.css({
                            'height'        : s_box_height
                        });
                        $('.push').height(s_box_height);
                        $('.sidebar_inner').css({
                            'margin-bottom' : '-'+s_box_height+'px',
                            'min-height'    : '100%'
                        });
                    },
                    make_active: function() {
                        var thisAccordion = $('#side_accordion');
                        thisAccordion.find('.accordion-heading').removeClass('sdb_h_active');
                        var thisHeading = thisAccordion.find('.accordion-body.in').prev('.accordion-heading');
                        if(thisHeading.length) {
                            thisHeading.addClass('sdb_h_active');
                        }
                    },
                    make_scroll: function() {
                        antiScroll = $('.antiScroll').antiscroll().data('antiscroll');
                    },
                    update_scroll: function() {
                        if($('.antiScroll').length) {
                            if( $(window).width() > 979 ){
                                $('.antiscroll-inner,.antiscroll-content').height($(window).height() - 40);
                            } else {
                                $('.antiscroll-inner,.antiscroll-content').height('400px');
                            }
                            antiScroll.refresh();
                        }
                    }
                };
            </script>
            @show
		
		</div>
        <div align="center" style="background:#000;color:#FFF;padding:10px;">
        @if($license == $nlicense)
            <span id="license"><a style="color:#FFF" href="{{ URL::to('license') }}">License is valid</a></span>
        @else
            <span id="license"><a style="color:red" href="{{ URL::to('license') }}">License is not valid</a></span>
        @endif
        
        </div>
	</body>
</html>