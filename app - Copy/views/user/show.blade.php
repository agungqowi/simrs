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
        					Profile
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Profile</h3>
	        		<div class="row-fluid">
	        			<div class="span12">
							<div class="vcard">
								<img class="thumbnail" src="http://www.placehold.it/80x80/EFEFEF/AAAAAA" alt="" />
								<ul>
									<li class="v-heading">
										User info
									</li>
									<li>
										<span class="item-key">Full name</span>
										<div class="vcard-item">{{ $profile->name }}</div>
									</li>
									<li>
										<span class="item-key">Email</span>
										<div class="vcard-item">{{ $profile->email }}</div>
									</li>
									<li>
										<span class="item-key">Address</span>
										<div class="vcard-item">{{ $profile->address }}</div>
									</li>
									<li>
										<span class="item-key">Phone</span>
										<div class="vcard-item">{{ $profile->phone }}</div>
									</li>
									<li>
										<span class="item-key">Gtalk</span>
										<div class="vcard-item">{{ $profile->gtalk }}</div>
									</li>
									<li>
										<span class="item-key">Skype</span>
										<div class="vcard-item">{{ $profile->skype }}</div>
									</li>
									<li>
										<span class="item-key">Whats App</span>
										<div class="vcard-item">{{ $profile->whatsapp }}</div>
									</li>

									<li class="v-heading">
										User images
									</li>
									<li>
										<div class="sepH_a item-list clearfix">
										</div>
									</li>
									<li class="v-heading">
										Contribute Projects
									</li>
									<li>
										<ul class="unstyled sepH_b item-list">
											<?php $i=0; ?>
											@foreach($projects as $key => $value)
												<li @if($i > 5) class="item-list-more" @endif >
													{{ $value->project_name }}
												</li>
												<?php $i++; ?>
											@endforeach
										</ul>
										@if(count($projects) > 5)
											<a href="#" data-items="5" class="item-list-show btn btn-mini">Show 5 more...</a>
										@endif
									</li>
								</ul>
							</div>
						</div>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</div>
@stop

@section('js')
	@parent
	<script type="text/javascript">
		$(document).ready(function() {
			$('.item-list-show').click(function(e) {
				var items = $(this).data('items');
				var hiddenItems = $(this).prev('.item-list').find('.item-list-more').filter(':hidden');
				hiddenItems.each( function(i) {
					if( i < items ) {
						$(this).show();
					}
				});
				e.preventDefault();
				if(hiddenItems.length <= items) {
					$(this).hide();
				};
			});
		});

	</script>
@stop