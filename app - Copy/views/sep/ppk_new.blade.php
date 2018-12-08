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
                            <a href="{{ url('sep/rujukan/ppk_new') }}">Data PPK</a>
                        </li>
                        <li>
                            Rujukan dan Pelayanan
                        </li>
                    </ul>
                </div>
            </nav>
        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Data PPK Rujukan dan Pelayanan
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
					<div id="pesan_error2" class="alert alert-error" style="display:none; font-weight:bold;">
					</div>

                    <table id="tbl_obat" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                        </colgroup>
                        <thead>
                            <tr>
								<th align="center" valign="middle" class="head1">Kode Provider</th>
                                <th align="center" valign="middle" class="head2">Nama Provider</th>
                                <th align="center" valign="middle" class="head3">Alamat</th>
                                <th align="center" valign="middle" class="head4">Kota/ Kabupaten</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            oTable = $('#tbl_obat').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/ppk_new_view') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_obat_filter input").focus();
                                }
                            });
                        });
                    </script>
                </div>
	        </div>
	   	</div>
	</div>
	
@stop

@section('js')
    @parent
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
	{{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>
@stop