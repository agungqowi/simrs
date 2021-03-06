@extends('layout')

@section('content')
	<!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
                    
					<div class="row-fluid">
						<div class="span12 tac">
							<ul class="ov_boxes">
								<li>
									<div class="p_bar_up p_canvas"><span style="display: none;">3,3,3,3,3,3</span><canvas width="50" height="32"></canvas></div>
									<div class="ov_text">
										<strong>{{ number_format($pasien_all) }}</strong>
										Pasien Terdaftar
									</div>
								</li>
								<li>
									<div class="p_bar_down p_canvas"><span style="display: none;">3,3,3,3,3,3</span><canvas width="50" height="32"></canvas></div>
									<div class="ov_text">
										<strong>{{ number_format($pasien_inap) }}</strong>
										Pasien Rawat Inap
									</div>
								</li>
								<li>
									<div class="p_line_up p_canvas"><span style="display: none;">3,3,3,3,3,3</span><canvas width="50" height="32"></canvas></div>
									<div class="ov_text">
										<strong>{{ number_format($pasien_jalan) }}</strong>
										Pasien Rawat Jalan
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							@if(isset($menu_d))
								<ul class="dshb_icoNav tac">
								@foreach($menu_d as $d)
									<li><a href="{{ url($d['url']) }}" style="background-image: url(img/gCons/{{ $d['icon'] }})"><span class="{{ $d['span_class'] }}">{{ $d['span_content'] }}</span> {{ $d['title'] }}</a></li>
								@endforeach		
								</ul>
							@endif
						</div>
					</div>                    
                    <div class="row-fluid">
                        <div class="span12">
							<h3 class="heading">Pencarian Pasien Rawat Inap</h3>
							<form class="form-inline" id="cari_pasien_form">
								<div class="span3">
								  <select class="span12 search-query" name="cari_berdasarkan" id="cari_dashboard_param">
								  	<option value="">-Cari Berdasarkan-</option>
								  	<option value="Nama">Nama</option>
								  	<option value="NoRM">No RM</option>
								  	<option value="Jalan">Alamat</option>
								  	<option value="NamaPJ">Nama Penanggung Jawab</option>
								  </select>
								</div>
								<div class="input-append span9">
									<input id="cari_dashboard_text" class="span6" id="appendedPrependedDropdownButton" type="text">
									<button id="cari_dashboard_button" type="button" class="btn">Cari</button>
								</div>
							</form>
							<br /><br />
							<table id="cari_dashboard_result" class="table table-hover">
								<thead>
									<tr>
										<th>No RM</th>
										<th>Nama</th>
										<th>Tanggal Masuk</th>
										<th>Tanggal Pulang</th>
										<th>Ruangan</th>
										<th>Alamat</th>
										<th>Umur</th>
										<th>Nama PJ</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
                        </div>
                        <!--
                        <div class="span4" id="user-list" style="display:none">
							<h3 class="heading">Ruangan</h3>
							<div class="row-fluid">
								<div class="input-prepend">
									<span class="add-on ad-on-icon"><i class="icon-user"></i></span><input type="text" class="user-list-search search" placeholder="Cari Ruangan" />
								</div>
								<ul class="nav nav-pills line_sep">
									<li class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#">Urutkan Berdasarkan <b class="caret"></b></a>
										<ul class="dropdown-menu sort-by">
											<li><a href="javascript:void(0)" class="sort" data-sort="sl_name">Nama</a></li>
											<li><a href="javascript:void(0)" class="sort" data-sort="sl_status">Status</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" href="#">Tampilkan <b class="caret"></b></a>
										<ul class="dropdown-menu filter">
											<li class="active"><a href="javascript:void(0)" id="filter-none">Semua</a></li>
											<li><a href="javascript:void(0)" id="filter-online">Tersedia</a></li>
											<li><a href="javascript:void(0)" id="filter-offline">Penuh</a></li>
										</ul>
									</li>
								</ul>
							</div>
							<ul class="list user_list">
								@foreach($ruangan as $u => $s)
									@if ($s->id != $user->id)
										<li>
											@if($s->status==1)
												<?php $status = 'Penuh'; ?>
												<?php $label = 'label-important'; ?>
											@else
												<?php $status = 'Tersedia'; ?>
												<?php $label = 'label-success'; ?>
											@endif
											<span class="label {{ $label }} pull-right sl_status">{{ $status }}</span>
											<a href="{{ URL::to('user/'.$s->id) }}" class="sl_name">{{ $s->NamaRuangan }} No. Kamar {{ $s->NoKamar }}</a><br />
											<small class="s_color sl_email">{{ $s->Kelas }}</small>
										</li>
									@endif
								@endforeach
							</ul>
							<div class="pagination"><ul class="paging bottomPaging"></ul></div>
                        </div>
                        -->
                    </div>
                        
                </div>
            </div>
@stop

@section('js')
	@parent
	<script type="text/javascript">
		$(document).ready(function() {
			//gebo_calendar.regular();
			//gebo_calendar.google();
			gebo_flist.init();

			gebo_peity.init();
			//* resize elements on window resize
			var lastWindowHeight = $(window).height();
			var lastWindowWidth = $(window).width();
			$(window).on("debouncedresize",function() {
				if($(window).height()!=lastWindowHeight || $(window).width()!=lastWindowWidth){
					lastWindowHeight = $(window).height();
					lastWindowWidth = $(window).width();
					//* rebuild calendar
					$('#calendar').fullCalendar('render');
					$('#calendar_google').fullCalendar('render');
				}
			});
			$('#cari_dashboard_param').focus();

			$('#cari_pasien_form').submit(function(event){
				event.preventDefault();
				cari_pasien();
			});

			$('#cari_dashboard_button').click(function(){
				cari_pasien();
			});

			function cari_pasien(){
				var _param = $('#cari_dashboard_param').val();
				var _text = $('#cari_dashboard_text').val();

				if(_param == ''){
					$('#cari_dashboard_param').focus()
				}
				else if(_text == ''){
					$('#cari_dashboard_text').focus();
				}
				else{
					var _url = "{{ url('dashboard_cari') }}";
					$('#cari_dashboard_result tbody').html('<tr><td align="center" colspan="6"><img src="'+"{{ url('img/ajax_loader.gif') }}"+'" /></td></tr>');
					$.ajax({
               			url: _url,
               			dataType: "json",
               			data: "param="+_param+"&text="+_text,
                		success: function(res){
	                		if(res.gagal == 'yes'){
	                			$('#cari_dashboard_result tbody').html('<tr><td colspan="6">Data tidak ditemukan</td></tr>');
	                		}
	                		else{
	                			$('#cari_dashboard_result tbody').html('');
	                			$.each(res, function (key, data) {
	                				var _keluar = "-";
	                				if(data.TanggalPulang != '0000-00-00'){
	                					_keluar = data.TanggalPulang;
	                				}
	                				$('#cari_dashboard_result tbody').append('<tr><td>'+data.NoRM+'</td><td>'+data.Nama+'</td>'+
	                					'<td>'+data.Tanggal+'</td>'+'<td>'+_keluar+'</td>'+'<td>'+data.Ruangan+'</td>'+
	                					'<td>'+data.Jalan+'</td>'+'<td>'+data.umur+'</td>'+'<td>'+data.NamaPJ+'</td>'+'</tr>');
	                			});
	                			
	                		}
	                	}
	                });
				}
			}
		});
		
		//* calendar
		gebo_calendar = {
			regular: function() {
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
				var calendar = $('#calendar').fullCalendar({
					header: {
						left: 'prev next',
						center: 'title,today',
						right: 'month,agendaWeek,agendaDay'
					},
					buttonText: {
						prev: '<i class="icon-chevron-left cal_prev" />',
						next: '<i class="icon-chevron-right cal_next" />'
					},
					aspectRatio: 2,
					selectable: true,
					selectHelper: true,
					editable: false,
					theme: false,
					events: { // Render the events in the calendar
			            url: '{{ URL::to("calendar/seelist") }}', // Get the URL of the json feed
			            type: 'POST', // Send post data
			            error: function() {
			                alert('There was an error while fetching events.'); // Error alert
			            }
			        },
			        eventClick: function(calEvent, jsEvent, view) {
				        // change the border color just for fun
				        $(this).css('border-color', 'red');

				    },
					eventColor: '#bcdeee'
				})
			},
			google: function() {
				var calendar = $('#calendar_google').fullCalendar({
					header: {
						left: 'prev next',
						center: 'title,today',
						right: 'month,agendaWeek,agendaDay'
					},
					buttonText: {
						prev: '<i class="icon-chevron-left cal_prev" />',
						next: '<i class="icon-chevron-right cal_next" />'
					},
					aspectRatio: 3,
					theme: false,
					events: {
						url:'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic',
						title: 'Italian Holidays',
						color: '#bcdeee'
					},
					eventClick: function(event) {
						// opens events in a popup window
						window.open(event.url, 'gcalevent', 'width=700,height=600');
						return false;
					}
					
				})
			}
		};

		//* filterable list
		gebo_flist = {
			init: function(){
				//*typeahead
				var list_source = [];
				$('.user_list li').each(function(){
					var search_name = $(this).find('.sl_name').text();
					//var search_email = $(this).find('.sl_email').text();
					list_source.push(search_name);
				});
				$('.user-list-search').typeahead({source: list_source, items:5});
				
				var pagingOptions = {};
				var options = {
					valueNames: [ 'sl_name', 'sl_status', 'sl_email' ],
					page: 10,
					plugins: [
						[ 'paging', {
							pagingClass	: "bottomPaging",
							innerWindow	: 1,
							left		: 1,
							right		: 1
						} ]
					]
				};
				var userList = new List('user-list', options);
				
				$('#filter-online').on('click',function() {
					$('ul.filter li').removeClass('active');
					$(this).parent('li').addClass('active');
					userList.filter(function(item) {
						if (item.values().sl_status == "Tersedia") {
							return true;
						} else {
							return false;
						}
					});
					return false;
				});
				$('#filter-offline').on('click',function() {
					$('ul.filter li').removeClass('active');
					$(this).parent('li').addClass('active');
					userList.filter(function(item) {
						if (item.values().sl_status == "Penuh") {
							return true;
						} else {
							return false;
						}
					});
					return false;
				});
				$('#filter-none').on('click',function() {
					$('ul.filter li').removeClass('active');
					$(this).parent('li').addClass('active');
					userList.filter();
					return false;
				});
				
				$('#user-list').on('click','.sort',function(){
						$('.sort').parent('li').removeClass('active');
						if($(this).parent('li').hasClass('active')) {
							$(this).parent('li').removeClass('active');
						} else {
							$(this).parent('li').addClass('active');
						}
					}
				);
			}
		};

		//* small charts
		gebo_peity = {
			init: function() {
				$.fn.peity.defaults.line = {
					strokeWidth: 1,
					delimeter: ",",
					height: 32,
					max: null,
					min: 0,
					width: 50
				};
				$.fn.peity.defaults.bar = {
					delimeter: ",",
					height: 32,
					max: null,
					min: 0,
					width: 50
				};
				$(".p_bar_up").peity("bar",{
					colour: "#6cc334"
				});
				$(".p_bar_down").peity("bar",{
					colour: "#e11b28"
				});
				$(".p_line_up").peity("line",{
					colour: "#b4dbeb",
					strokeColour: "#3ca0ca"
				});
				$(".p_line_down").peity("line",{
					colour: "#f7bfc3",
					strokeColour: "#e11b28"
				});
			}
		};
	</script>
@stop