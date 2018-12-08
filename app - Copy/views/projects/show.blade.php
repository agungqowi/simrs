@extends('layout')

@section('content')
	<div id="contentwrapper">
		<div class="main_content">
			<nav>
        		<div id="jCrumbs" class="breadCrumb module">
        			<ul>
        				<li>
        					<a href="{{ URL::to('dashboard') }}"><i class="icon-home"></i></a>
        				</li>
        				<li>
        					<a href="{{ URL::to('project') }}">List Projects</a>
        				</li>
        				<li>
        					Show Project
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">{{ $project->project_name }}</h3>
	        		<div class="formSep">
						<span>Status : </span>
						@if($project->project_status=='2')
							On Going
						@elseif($project->project_status=='1')
							Done
						@elseif($project->project_status=='0')
							Not started
						@endif
					</div>
					<div class="formSep">
						<label>Description</label>
						<p>{{ $project->project_desc }}</p>
					</div>
					<div class="formSep">
						<div class="row-fluid">
							<div class="span3">
								<label>Start date</label>
								<p>{{ $project->project_start_date }}</p>
							</div>
							<div class="span3">
								<label>End date</label>
								<p>{{ $project->project_end_date }}</p>
							</div>
						</div>
					</div>
                    <div class="formSep">
                    <a href="{{ URL::to('project') }}" class="btn btn-info">Back</a>
                    </div>
	        	</div>
        	</div>
		</div>
	</div>
@stop