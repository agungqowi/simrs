@extends('layout')

@section('content')
<div id="contentwrapper">
    <div class="main_content">
		<div class="row-fluid">
			<div class="span12">
				<h2 class="heading">Calendar <a href="{{ URL::to('calendar/create') }}" class="btn btn-gebo">Add New Schedule</a></h2>
				<div id="calendar"></div>
			</div>
		</div>
	</div>
</div>
@stop

@section('js')
	@parent
	<script type="text/javascript">
		$(document).ready(function() {
			gebo_calendar.regular();
			gebo_calendar.google();
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
	</script>
@stop