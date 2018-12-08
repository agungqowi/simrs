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
        					<a href="{{ action('NoteController@index') }}">List Notes</a>
        				</li>
        				<li>
        					Show Note
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Show Note</h3>

	        		<div class="formSep">
						<label>Title</label>
						<p>{{ $note->title }}</p>
					</div>
					<div class="formSep">
						<label>Note</label>
						<p>{{ $note->note }}</p>
					</div>
                    <div class="formSep">
                    <a href="{{ URL::to('notes') }}" class="btn btn-info">Back</a>
                    </div>
	        	</div>
        	</div>
		</div>
	</div>
@stop

@section('js')
	@parent
@stop