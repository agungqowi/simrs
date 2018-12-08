@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
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
        					<a href="{{ action('UserController@index') }}">User</a>
        				</li>
        				<li>
        					List
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Daftar User
                        <div style="float:right;" class="">
                            <a href="{{ URL::to('user/create') }}" class="btn btn-success"><i class="splashy-contact_grey_add"></i> Tambah User Baru</a>
                        </div>
                    </h3>
	        	</div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                <?php $success = Session::get('success'); ?>
                   	@if( Session::get('success') )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                {{ Datatable::table()->addColumn('ID User','Username','Name','Group' , 'Password','Actions')
                        ->setUrl(URL::to('user/datatable'))->render() }}
                </div>
	        </div>
	   	</div>
	</div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.datatable-id').each(function(){
                //$(this).attr('data-provides' , 'rowlink');
            })
        });
    </script>
@stop