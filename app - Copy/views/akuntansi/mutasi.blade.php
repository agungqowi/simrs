@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
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
	        		<h3>Mutasi</h3>
	        		<form>
	        		<div class="span2">
	        			<label>Tanggal Transaksi</label>
	        		</div>
	        		<div class="span3">
	        			<input type="text" name="tanggal" value="{{ $tanggal }}" class="cruddate" class="span3">
	        		</div>
	        		<input type="submit" class="span1 btn btn-primary" value="Submit">
	        		</form>
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
                    <?php $debit = $kredit = $selisih = 0; ?>
                	<table id="tbl_list" class="table table-striped table-bordered table-hover">
                		<colgroup>
                			<?php for($i=0;$i<count($column);$i++):?>
                				<col class="con{{ $i }}" />
                			<?php endfor; ?>
                		</colgroup>
                        <thead>
                        <tr>
                        	<?php $j=0; foreach ($column as $key => $value): ?>
                        		<th align="center" valign="middle" class="head{{ $j }}">{{ $value }}</th>
                        	<?php $j++; endforeach; ?>
                        </tr>

                       	</thead>
                       	<tbody>
                       	@if(isset($data) && count($data) > 0 )
                        	@foreach($data as $d)
                        		<tr>
	                        		@foreach ($column as $k => $v)
	                        			@if( $k == 'jumlah')
	                        				<td style="text-align:right">{{ number_format($d->$k) }}</td>
	                        			@else
	                        				<td>{{ $d->$k }}</td>
	                        			@endif

	                        		@endforeach

	                        		@if( $d->trans_tipe == 'D' )
	                        			<?php $debit = $debit + $d->jumlah; ?>
	                        		@else	                        			
	                        			<?php $kredit = $kredit + $d->jumlah; ?>
	                        		@endif
                        		</tr>
                        	@endforeach
                        @endif

                        <?php $selisih = $debit - $kredit; ?>
                       	</tbody>
                   	</table>
                </div>
                <div class="span12">
                	<div class="span2">
                		Debit
                	</div>
                	<div class="span4">
                		 <input type="text" value="{{ number_format($debit) }}" readonly>
                	</div>
                </div>
                <div class="span12">
                	<div class="span2">
                		Kredit
                	</div>
                	<div class="span4">
                		 <input type="text" value="{{ number_format($kredit) }}" readonly>
                	</div>
                </div>
                <div class="span12">
                	<div class="span2">
                		Selisih
                	</div>
                	<div class="span4">
                		 <input type="text" value="{{ number_format($selisih) }}" readonly>
                	</div>
                </div>
	        </div>
	   	</div>
	</div>

@stop
