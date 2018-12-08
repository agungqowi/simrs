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
	        		<h3>{{ $title }}</h3>
                </div>
            </div>
            <form>
            <div class="row-fluid">
                <div class="span12">
	        		<div class="span2">
	        			<label>Kode Akun</label>
                        <?php $jenis = ""; $saldo = 0;?>
	        		</div>
                    <div class="span3">
                        <select name="kode_akun" class="select2">
                            <option value="">-Pilih Akun-</option>
                            @foreach($akun as $ak)
                                <option <?php if($ak->id == $kode_akun){echo"selected='selected'";$jenis=$ak->balance;} ?> value="{{ $ak->id }}">{{ $ak->kode_akun.' '.$ak->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="span2">
                        <label>Periode</label>
                    </div>
	        		<div class="span3">
	        			<input type="text" name="mulai" value="{{ $mulai }}" class="cruddate" class="span2">
	        		</div>
                    <div class="span3">
                        <input type="text" name="sampai" value="{{ $sampai }}" class="cruddate" class="span2">
                    </div>
	        		<input type="submit" class="span1 btn btn-primary" value="Submit">
                </div>
                </form>
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
                                    @if( $d->trans_tipe == $jenis )
                                        <?php $saldo = $saldo + $d->jumlah; ?>
                                    @else                                       
                                        <?php $saldo = $saldo - $d->jumlah; ?>
                                    @endif

	                        		@foreach ($column as $k => $v)
	                        			@if( $k == 'jumlah')
	                        				<td style="text-align:right">{{ number_format($d->$k) }}</td>
                                        @elseif($k == 'saldo')
                                            <td style="text-align:right">{{ number_format($saldo) }}</td>
	                        			@else
	                        				<td>{{ $d->$k }}</td>
	                        			@endif

	                        		@endforeach

	                        		
                        		</tr>
                        	@endforeach
                        @endif

                       	</tbody>
                   	</table>
                </div>
	        </div>
	   	</div>
	</div>

@stop

@section('js')
    @parent
    <script type="text/javascript">
    jQuery(document).ready(function($){
        $('.select2').select2();
    });
    </script>
@stop
