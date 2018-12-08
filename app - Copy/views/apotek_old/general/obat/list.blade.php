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
                            <a href="{{ action('AskesObatController@index') }}">Apotek</a>
                        </li>
                        <li>
                            <a href="{{ url('apotek_obat/'.$slug) }}">{{ $title }}</a>
                        </li>
        				<li>
        					<a href="{{ action('AskesObatController@index') }}">Obat</a>
        				</li>
        				<li>
        					List
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Daftar Obat 
                    </h3>
                    <!--
                        <a href="{{ url('askes_obat/create') }}" class="btn">Tambah Obat</a>
                    -->
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
                    <table id="tbl_obat" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                            <col class="con6" />
                            <col class="con7" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">ID Obat</th>
                                <th align="center" valign="middle" class="head2">Nama Obat</th>
                                <th align="center" valign="middle" class="head3">Komposisi</th>
                                <th align="center" valign="middle" class="head4">Satuan</th>
                                <th align="center" valign="middle" class="head5">Jenis Obat</th>
                                <th align="center" valign="middle" class="head6">Stok</th>
                                <th align="center" valign="middle" class="head7">Harga</th>
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
                                "sAjaxSource": "{{ url('apotek_obat/datatable/'.$slug) }}",
                                "bServerSide": true,
                                "aoColumnDefs" : [
                                    {
                                        "aTargets" : [ 5 ],
                                        "sClass" : "align-right"
                                    },
                                    {
                                        "aTargets" : [ 6 ],
                                        "sClass" : "align-right"
                                    }
                                ]
                                
                            });
                        });
                    </script>
                </div>
	        </div>
	   	</div>
	</div>
    <div class="modal hide fade" id="hapus_data" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pasienLabel">Hapus <span class="hapus-title"></span></h4>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus data <span class="hapus-title"></span></p>
                    <p>
                        <a href="javascript:void(0)" onclick="action_hapus_data(0,'0')" class="btn btn-primary">Ya</a>
                        <a href="javascript:void(0)" onclick="hide_modal('hapus_data')" class="btn btn-warning">Tidak</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{ Form::open(array('url' => 'askes_obat/', 'id' => 'delete_form', 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        <input type="hidden" id="url_delete" value="{{ url('askes_obat') }}">
        <input type="submit" style="display:none">
    {{ Form::close() }}
@stop

@section('js')
    @parent
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
    <script type="text/javascript">
        var temp_id = "";
        $(document).ready(function(){
            $('.datatable-id').each(function(){
                //$(this).attr('data-provi9uhug ides' , 'rowlink');
            })
        });

        function hapus_data(id,param){
            temp_id = id;
            $('.hapus-title').html(param+' dengan ID '+id);
            $('#hapus_data').modal('show');
        }

        function action_hapus_data(){
            $('#hapus_data').modal('hide');
            var url = $('#url_delete').val()+'/'+temp_id;
            $('#delete_form').attr( 'action' , url );
            $('#delete_form').submit();
            temp_id = "";
        }

        function hide_modal(name){
            $('#'+name).modal('hide');
        }
    </script>
@stop