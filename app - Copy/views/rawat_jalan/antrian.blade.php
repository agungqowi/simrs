@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
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
        					<a href="{{ action('DashboardController@index') }}">Info Pasien</a>
        				</li>
        				<li>
        					Antrian Poli / IGD
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Antrian Poli / IGD
	        		</h3>
	        		@if( $errors->first('title') || $errors->first('note') )
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('title') }}
							{{ $errors->first('note') }}
						</div>
	        		@endif
                    
                    <div>
                        <table id="tbl_pasien" class="table table-striped table-bordered table-hover">
                                        <colgroup>
                                            <col class="con1" />
                                            <col class="con2" />
                                            <col class="con3" />
                                            <col class="con4" />
                                            <col class="con6" />
                                            <col class="con7" />
                                            <col class="con8" />
                                            <col class="con9" />
                                            <col class="con10" />
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th align="center" valign="middle" class="head1">NoRM</th>
                                                <th align="center" valign="middle" class="head2">Nama</th>
                                                <th align="center" valign="middle" class="head3">Tanggal</th>
                                                <th align="center" valign="middle" class="head4">Poli</th>
                                                <th align="center" valign="middle" class="head6">Jalan</th>
                                                <th align="center" valign="middle" class="head7">Kelurahan</th>
                                                <th align="center" valign="middle" class="head8">Kota / Kab</th>
                                                <th align="center" valign="middle" class="head9">No Reg</th>
                                                <th align="center" valign="middle" class="head10">Proses</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                    <script type="text/javascript">
                                        jQuery(document).ready(function(){
                                            // dynamic table
                                            oTable = jQuery('#tbl_pasien').dataTable({
                                                "language": {
                                                    "url": "{{ url('js/Indonesian.json') }}"
                                                },
                                                "sPaginationType": "full_numbers",
                                                "bProcessing": false,
                                                "sAjaxSource": "{{ url('rawat_jalan/datatable_antrian') }}",
                                                "bServerSide": true
                                            
                                            });
                                        // custom values are available via $values array
                                        });
                                    </script>
                    </div>

	        	</div>
        	</div>
		</div>
	</div>	

@stop

@section('js')
	@parent
	{{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
	@include('js/rawat_jalan_pasien')
	
@stop