@extends('layout')

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
        					<a href="{{ action('DashboardController@index') }}">List {{ $title }}</a>
        				</li>
        				<li>
        					<?php if( isset($type) && $type == 'edit'){ echo 'Ubah '; } ?> {{ $title }}
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading"><?php if( isset($type) && $type == 'edit'){ echo 'Ubah '; } ?> {{ $title }}</h3>
	        		@if( $errors->first('title') || $errors->first('note') )
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('title') }}
							{{ $errors->first('note') }}
						</div>
	        		@endif

                    <?php $error = Session::get('error'); ?>
                    @if( Session::get('error') )
                        <div class="alert alert-error">
                            {{ $error }}
                        </div>
                    @endif

	        	</div>
            </div>
            <div class="row">
                <div class="span6">
                    <form action="" method="GET" id="form_cat" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" >Jenis Pelayanan</label>
                            <div class="controls">
                                <select name="jenis" id="jenis">
                                <option value="0">-Semua Pelayanan-</option>
                                @if( isset( $jenis ) && count($jenis) > 0 )
                                    @foreach( $jenis as $je => $ji )
                                        @if( $je == $j)
                                            <option selected="selected" value="{{ $je }}">{{ $ji }}</option>
                                        @else
                                            <option value="{{ $je }}">{{ $ji }}</option>
                                        @endif
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Pilih Kategori</label>
                            <div class="controls">
                                <select name="categories" id="categories">
                                <option value="0">-Semua Kategori-</option>
                                @if( isset( $categories ) && count($categories) > 0 )
                                    @foreach( $categories as $key => $val )
                                        @if( $key == $category)
                                            <option selected="selected" value="{{ $key }}">{{ $val }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @endif
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="span12">
                @if( isset($data) && count($data) > 0 )
                    <table id="bulk_table" class="table table-striped">
                        @if(isset($column) && count($column) > 0)
                            <?php $wd = 90 / count( $column); $input = "style = 'width:80px'; " ?>
                            <thead>
                            <tr>
                            @foreach($column as $c)
                                <th>{{ $c['label'] }}</th>
                            @endforeach
                            </tr>
                            </thead>
                        @endif

                        <tbody>
                        @foreach($data as $d)
                            <tr>
                            @if(isset($column) && count($column) > 0)
                                @foreach($column as $fo)
                                    @if( isset( $fo['required'] ) && $fo['required'] == 'required' )
                                        <?php $required = 'required'; ?>
                                    @endif

                                    <td width="{{ $wd }}%">
                                        <?php $value    = $d->$fo['id']; ?>
                                        <?php $i        = $d->$primary; ?>
                                        <?php $name     = $fo['name']."['".$i."']"; ?>
                                        <?php $el_id    = $fo['name']."_".$i; ?>
                                        @if( $fo['type'] == 'text' )
                                            <input {{ $input }} data-name="{{ $fo['name'] }}" data-index={{ $i }} {{ $required }} type="text" name="{{ $name }}" id="{{ $el_id  }}" class="no-primary"
                                                value="{{ $value }}" >
                                        @elseif( $fo['type'] == 'number' )
                                            <input style="width:70px;text-align:right;" data-name="{{ $fo['name'] }}" data-index={{ $i }} min="0" {{ $required }} type="number" name="{{ $name }}" id="{{ $el_id  }}" class="no-primary"
                                                value="{{ $value }}" >
                                        @elseif( $fo['type'] == 'textarea')
                                            <textarea style="min-width:150px" data-name="{{ $fo['name'] }}" data-index={{ $i }} {{ $required }} name="{{ $name }}" id="{{ $el_id  }}" class="no-primary">{{ $value }}</textarea>
                                        @elseif( $fo['type'] == 'select')
                                            <select {{ $input }} data-name="{{ $fo['name'] }}" data-index={{ $i }} {{ $required }} name="{{ $name }}" id="{{ $el_id  }}" class="no-primary">
                                                <option value="">-Pilih {{ $fo['label'] }} -</option>
                                                @if( count($fo['options']) > 0 )
                                                    @foreach( $fo['options'] as $key => $val )
                                                        <?php $selected = ""; ?>
                                                        <?php if( $value == $key ){ $selected="selected='selected'"; } ?>
                                                        <option {{ $selected }} value="{{ $key }}"> {{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @elseif( $fo['type'] == 'date' )
                                            @if( $value != '' )
                                                <?php $values = explode('-' , $value); ?>
                                                <?php $value = $values[2].'/'.$values[1].'/'.$values[0]; ?>
                                            @endif
                                            <input {{ $input }} data-name="{{ $fo['name'] }}" data-index={{ $i }} {{ $required }} type="text" name="{{ $name }}" id="{{ $el_id }}" class="tanggal no-primary"
                                                value="{{ $value }}" >
                                        @endif

                                    </td>
                                @endforeach
                            @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div>Tidak ada yang dapat ditampilkan</div>
                @endif
                </div>
            </div>
		</div>
	</div>
@stop

@section('js')
	@parent

    <script type="text/javascript">
    jQuery(document).ready(function($){
        $('#categories').change(function(){
            var _id = $(this).val();
            $('#form_cat').submit();
        });

        $('#jenis').change(function(){
            var _id = $(this).val();
            $('#form_cat').submit();
        });
    });
    </script>
@stop