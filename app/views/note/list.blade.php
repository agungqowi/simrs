@extends('layout')

@section('content')
<div id="contentwrapper">
    <div class="main_content">
		<div class="row-fluid">
			<div class="span12">
				<h3 class="heading">Notes</h3>
				@if(Session::has('success'))
				    <div class="alert alert-success">
						<a class="close" data-dismiss="alert">×</a>
				        {{ Session::get('success') }}
				    </div>
				@endif
				<div>
					<a href="{{ action('NoteController@create') }}" class="btn btn-gebo">Add New Note</a>
				</div><br />
				<table class="table table-bordered table-striped table_vam" id="dt_gal">
					<thead>
						<tr>
							<th class="table_checkbox"><input type="checkbox" name="select_rows" class="select_rows" data-tableid="dt_gal" /></th>
							<th>Title</th>
							<th>Created Date</th>
							<th>Updated Date</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					@foreach($notes as $key => $value)
						<tr id="list-id-{{ $value->id }}">
							<td><input type="checkbox" name="row_sel" class="row_sel" /></td>
							<td>
								<a href="{{ URL::to('notes/' . $value->id) }}" class="sepV_a" title="View">
									{{ $value->title }}
								</a>
							</td>
							<td>{{ $value->created_at }}</td>
							<td>{{ $value->updated_at }}</td>
							<td>
								<a href="{{ URL::to('notes/' . $value->id . '/edit') }}" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a>
								<a href="{{ URL::to('notes/' . $value->id) }}" class="sepV_a" title="View"><i class="icon-eye-open"></i></a>
								<a href="#" class="url_delete" data-id="{{ $value->id }}" title="Delete"><i class="icon-trash"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<!-- hide elements (for later use) -->
					<div class="hide">
						<!-- actions for datatables -->
						<div class="dt_gal_actions">
							<div class="btn-group">
								<button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="#" class="delete_rows_dt" data-tableid="dt_gal"><i class="icon-trash"></i> Delete</a></li>
								</ul>
							</div>
						</div>
						<!-- confirmation box -->
						<div id="confirm_dialog" class="cbox_content">
							<div class="sepH_c tac"><strong>Are you sure you want to delete this row(s)?</strong></div>
							<div class="tac">
								<a href="#" class="btn btn-gebo confirm_yes">Yes</a>
								<a href="#" class="btn confirm_no">No</a>
							</div>
						</div>

						<div id="confirm_dialog_single" class="cbox_content">
							<div class="sepH_c tac"><strong>Are you sure you want to delete this row?</strong></div>
							<div class="tac">
								<a href="#" class="btn btn-gebo confirm_yes">Yes</a>
								<a href="#" class="btn confirm_no">No</a>
							</div>
						</div>
					</div>
	</div>
</div>
@stop

@section('js')
	@parent

	{{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
			<!-- additional sorting for datatables -->
	{{ HTML::script('lib/datatables/jquery.dataTables.sorting.js') }}
            <!-- datatables bootstrap integration -->
    {{ HTML::script('lib/datatables/jquery.dataTables.bootstrap.min.js') }}
    <script type="text/javascript">
    	$(document).ready(function(){

			$('.select_rows').click(function () {
				var tableid = $(this).data('tableid');
	    	    $('#'+tableid).find('input[name=row_sel]').attr('checked', this.checked);
			});

			$(".delete_rows_simple").on('click',function (e) {
				e.preventDefault();
				var tableid = $(this).data('tableid');
                if($('input[name=row_sel]:checked', '#'+tableid).length) {
                    $.colorbox({
                        initialHeight: '0',
                        initialWidth: '0',
                        href: "#confirm_dialog",
                        inline: true,
                        opacity: '0.3',
                        onComplete: function(){
                            $('.confirm_yes').click(function(e){
                                e.preventDefault();
                                $('input[name=row_sel]:checked', '#'+tableid).closest('tr').fadeTo(300, 0, function () { 
                                    $(this).remove();
                                    $('.select_rows','#'+tableid).attr('checked',false);
                                });
                                $.colorbox.close();
                            });
                            $('.confirm_no').click(function(e){
                                e.preventDefault();
                                $.colorbox.close(); 
                            });
                        }
                    });
                }
			});
			
			function delete_row(){
				$(".delete_rows_dt").on('click',function (e) {
					e.preventDefault();
					var tableid = $(this).data('tableid'),
	                    oTable = $('#'+tableid).dataTable();
	                if($('input[name=row_sel]:checked', '#'+tableid).length) {
	                    $.colorbox({
	                        initialHeight: '0',
	                        initialWidth: '0',
	                        href: "#confirm_dialog",
	                        inline: true,
	                        opacity: '0.3',
	                        onComplete: function(){
	                            $('.confirm_yes').click(function(e){
	                                e.preventDefault();
	                                $('input[name=row_sel]:checked', oTable.fnGetNodes()).closest('tr').fadeTo(300, 0, function () {
	                                    $(this).remove();
										oTable.fnDeleteRow( this );
	                                    $('.select_rows','#'+tableid).attr('checked',false);
	                                });
	                                $.colorbox.close();
	                            });
	                            $('.confirm_no').click(function(e){
	                                e.preventDefault();
	                                $.colorbox.close(); 
	                            });
	                        }
	                    });
	                }    
				});
			}
			

			$('#dt_gal').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
				"sDom": "<'row'<'span6'<'dt_actions'>l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
               "sPaginationType": "bootstrap",
                "aaSorting": [[ 2, "asc" ]],
				"aoColumns": [
					{ "bSortable": false },
					{ "bSortable": false },
					{ "sType": "date" },
					{ "sType": "date" },
					{ "bSortable": false }
				]
			});
           	$('.dt_actions').html($('.dt_gal_actions').html());
           	delete_row();
    	});
	</script>

@stop

