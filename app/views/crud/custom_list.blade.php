@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::style('lib/datatables2/Buttons-1.3.1/css/buttons.dataTables.min.css') }}
    {{ HTML::script('lib/datatables2/datatables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    {{ HTML::script('lib/datatables2/Buttons-1.3.1/js/dataTables.buttons.min.js') }}
    {{ HTML::script('lib/datatables2/Buttons-1.3.1/js/buttons.colVis.min.js') }}
    {{ HTML::script('lib/datatables2/Buttons-1.3.1/js/buttons.print.js') }}
    {{ HTML::script('lib/datatables2/Buttons-1.3.1/js/buttons.html5.min.js') }}
    {{ HTML::script('lib/datatables2/pdfmake.min.js') }}
    {{ HTML::script('lib/datatables2/vfs_fonts.js') }}


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
                    @if( isset($filter) && $filter )
                        <div class="row-fluid filter-list">
                        <form class="form-horizontal">
                        <?php $carray = array(); ?>
                        @foreach($filter as $fi => $fb)
                            @include('crud/filter/'.$fi)
                            <?php $carray[] = '"'.$fi.'": '.'$("#'.$fi.'").val()'; ?>
                            <input type="hidden" class="filter-table" id="filter_{{ $fi }}"  value="fl_{{ $fi }}">
                        @endforeach
                        <?php $cstring = implode(',', $carray); ?>
                        <?php //echo '<script>var _objs = {'.$cstring.'};alert(_objs.'.$fi.')</script>';?>
                        </form>
                        </div>
                    @endif

                	<table id="tbl_list" class="table table-striped table-hover">
                		<colgroup>
                			<?php for($i=0;$i<count($column);$i++):?>
                				<col class="con{{ $i }}" />

                			<?php endfor; ?>
                			<col class="con{{ $i }}" />
                		</colgroup>
                        <thead>
                        <tr>
                        	<?php $j=0; foreach ($column as $key => $value): ?>
                                @if( is_array($value) )
                                    <th align="center" valign="middle" class="head{{ $j }}">{{ $value['title'] }}</th>
                                @else
                                    <th align="center" valign="middle" class="head{{ $j }}">{{ $value }}</th>
                                @endif
                        		
                        	<?php $j++; endforeach; ?>
                            @if(isset($disable_action) && $disable_action == false)
                                <th align="center" valign="middle" class="head{{ $j }}">Opsi</th>
                            @endif
                        </tr>
                       	</thead>
                       	<tbody>
                       	</tbody>
                   	</table>
                        <script type="text/javascript">
                            jQuery(document).ready(function(){

                                var _obj = new Object()
                            	// dynamic table
                                var oTable = jQuery('#tbl_list').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": true,
                                    "sAjaxSource": "{{ $datatable_url }}",
                                    "fnServerParams": function ( aoData ) {
                                        $('.filter-table').each(function(){
                                            var _val = $(this).val();
                                            aoData.push({ "name" : _val , "value" : $('#'+_val).val() });
                                        })
                                    },
                                    "bServerSide": true ,
                                    "bSearchable": true,
                                    lengthMenu: [
                                        [ 10, 25, 50, -1 ],
                                        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                                    ],
                                    dom: 'T<"clear">Bfrtip',
                                    buttons: [
                                        'pageLength',
                                        'print' ,
                                        {
                                            extend: 'pdfHtml5',
                                            title : ' {{ $rs_title }}' ,
                                            message : '{{ $title }}'
                                        }
                                    ]

                                });

                                $('.filter-table').each(function(){
                                    var _val = $(this).val();
                                    $('#'+_val).change(function(){
                                        oTable.fnDraw(false);
                                    })
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