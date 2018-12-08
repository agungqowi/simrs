@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    {{ HTML::script('lib/datatables/extras/TableTools/media/js/ZeroClipboard.js') }}
    {{ HTML::script('lib/datatables/extras/TableTools/media/js/TableTools.js') }}


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
        					<a href="{{ URL::to( $slug ) }}">{{ $title }}</a>
        				</li>
        				<li>
        					List
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Daftar {{ $title }}
                        <div style="float:right;" class="">
                            @if(isset($disable_add) && $disable_add == false)
                                <?php $url_add = $slug.'/create'; ?>
                                @if($custom_add)
                                    <?php $url_add = $custom_add; ?>
                                @endif
                                <a href="{{ URL::to( $url_add ) }}" class="btn btn-success"><i class="splashy-contact_grey_add"></i> Tambah {{ $title }}</a>
                            @endif
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
                	<table id="tbl_list" class="table table-striped table-bordered table-hover">
                		<colgroup>
                			<?php for($i=0;$i<count($column);$i++):?>
                				<col class="con{{ $i }}" />
                			<?php endfor; ?>
                			<col class="con{{ $i }}" />
                		</colgroup>
                        <thead>
                        <tr>
                        	<?php $j=0; foreach ($column as $key => $value): ?>
                        		<th align="center" valign="middle" class="head{{ $j }}">{{ $value }}</th>
                        	<?php $j++; endforeach; ?>
                        		<th align="center" valign="middle" class="head{{ $j }}">Opsi</th>
                        </tr>
                       	</thead>
                       	<tbody>
                       	</tbody>
                   	</table>
                        <?php if( isset($pref) && !empty($pref) ){ $datatable_url = url($slug.'/datatable/'.$pref); } else{ $datatable_url = url($slug.'/datatable'); } ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                            	// dynamic table
                                oTable = jQuery('#tbl_list').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ $datatable_url }}",
                                    "bServerSide": true ,
                                    "sDom": 'T<"clear">lfrtip' ,
                                    "oTableTools": {
                                        "aButtons": [
                                            {
                                                "sExtends": "xls",
                                                "sButtonText": "Simpan ke Excel"
                                            },
                                            {
                                                "sExtends": "pdf",
                                                "sButtonText": "Simpan ke PDF",
                                                "sPdfOrientation": "landscape",
                                                "sPdfMessage": "{{ $title }}"
                                            }
                                        ]
                                    }

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
                        <a href="javascript:void(0)" onclick="action_hapus_data()" class="btn btn-primary">Ya</a>
                        <a href="javascript:void(0)" onclick="hide_modal('hapus_data')" class="btn btn-warning">Tidak</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{ Form::open(array('url' => 'tindakan/', 'id' => 'delete_form', 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        <input type="hidden" id="url_delete" value="{{ url($slug) }}">
        <input type="submit" style="display:none">
    {{ Form::close() }}
@stop

@section('js')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            $('.datatable-id').each(function(){
                //$(this).attr('data-provides' , 'rowlink');
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