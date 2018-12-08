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
        					<a href="{{ URL::to( $slug ) }}">List {{ $title }}</a>
        				</li>
        				<li>
        					<?php if( isset($type) && $type == 'edit'){ echo 'Ubah '; } ?> {{ $title }}
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">
                        <?php if( isset($type) && $type == 'edit'){ echo 'Ubah '; } ?> {{ $title }}

                        <div style="float:right">
                            @if($disable_add == false)
                                <a href="{{ URL::to($slug.'/create') }}" class="btn btn-success"><i class="splashy-contact_grey_add"></i> Tambah Baru {{ $title }}</a>
                            @endif
                            <a href="{{ URL::to($slug) }}" class="btn btn-primary"><i class="splashy-view_outline_detail"></i> Daftar {{ $title }}</a>
                        </div>
                    </h3>
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

                    <?php $success = Session::get('success'); ?>
                    @if( Session::get('success') )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif

                    @if( isset($type) && $type == 'edit')
                        {{ Form::model($data, array('route' => array( $slug.'.update', $primary_id), 'method' => 'PUT' , 'class' => 'form-horizontal')) }}
                    @else
                        {{ Form::open(array('id'=>'reg1_form', 'class' => 'form-horizontal','url'=> URL::to($slug) )) }}
                    @endif
	        		
                    <div class="row-fluid formSep">
                        <div class="span{{ $form_span }}">
                        <?php $i = 0; $first = ""; ?>
                        @foreach( $forms as $fo)
                            <?php $required = ""; ?>
                            @if($fo['type'] == 'hidden')
                                <input type="hidden" name="{{ $fo['name'] }}" id="{{ $fo['id'] }}">
                            @else
                                <div class="control-group">
                                    <label class="control-label">
                                        {{ $fo['label'] }}
                                        @if( isset( $fo['required'] ) && $fo['required'] == 'required' )
                                            <span class="f_req">*</span>
                                            <?php $required = 'required'; ?>
                                        @endif
                                    </label>

                                    <div class="controls">
                                        @if( isset($type) && $type == 'edit')
                                            <?php $value = $data->$fo['name']; ?>
                                        @else
                                            <?php $value = ''; ?>
                                        @endif

                                        <?php $temp_value =  Input::old( $fo['name'] ); ?>
                                        @if( !empty($temp_value) )
                                            <?php $value = $temp_value; ?>
                                        @endif 

                                        <?php $disabled = "" ; ?>
                                        @if( isset( $fo['disabled'] ) && ( $fo['disabled'] == 'disabled' ) )
                                            <?php $disabled = " readonly "; ?>
                                        @endif

                                        @if( isset($fo['class']) )
                                            <?php $class = " class='".$fo['class']."' "; ?>
                                        @else
                                            <?php $class = ""; ?>
                                        @endif

                                        @if( $fo['type'] == 'text' )
                                            <input {{ $disabled }} data-index={{ $i }} {{ $required }} type="text" name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary"
                                                value="{{ $value }}" >
                                                
                                        @elseif( $fo['type'] == 'hidden' )
                                            <input {{ $disabled }} data-index={{ $i }} {{ $required }} type="hidden" name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary"
                                                value="{{ $value }}" >

                                        @elseif( $fo['type'] == 'password' )
                                            <input {{ $disabled }} data-index={{ $i }} {{ $required }} type="password" name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary" >

                                        @elseif( $fo['type'] == 'number' )
                                            <input {{ $disabled }} data-index={{ $i }} min="0" {{ $required }} type="number" name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary"
                                                value="{{ $value }}" >

                                        @elseif( $fo['type'] == 'textarea')
                                            <textarea {{ $disabled }} data-index={{ $i }} {{ $required }} name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary">{{ $value }}</textarea>

                                        @elseif( $fo['type'] == 'select')
                                            @if( isset( $fo['disabled'] ) && ( $fo['disabled'] == 'disabled' ) )
                                                <?php $disabled = " disabled='disabled' "; ?>
                                                <input type="hidden" name="{{ $fo['name'] }}" value="{{ $value }}">
                                            @endif

                                            <select {{ $class }} {{ $disabled }} data-index={{ $i }} {{ $required }} name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary">
                                                <option value="">-Pilih {{ $fo['label'] }} -</option>
                                                @if( count($fo['options']) > 0 )
                                                    @foreach( $fo['options'] as $key => $val )
                                                        <?php $selected = ""; ?>
                                                        <?php if( $value == $key ){ $selected="selected='selected'"; } ?>
                                                        <option {{ $selected }} value="{{ $key }}"> {{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @elseif( $fo['type'] == 'select2')
                                            @if( isset( $fo['disabled'] ) && ( $fo['disabled'] == 'disabled' ) )
                                                <?php $disabled = " disabled='disabled' "; ?>
                                                <input type="hidden" name="{{ $fo['name'] }}" value="{{ $value }}">
                                            @endif

                                            <select {{ $class }} {{ $disabled }} data-index={{ $i }} {{ $required }} name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary select2">
                                                <option value="">-Pilih {{ $fo['label'] }} -</option>
                                                @if( count($fo['options']) > 0 )
                                                    @foreach( $fo['options'] as $key => $val )
                                                        <?php $selected = ""; ?>
                                                        <?php if( $value == $key ){ $selected="selected='selected'"; } ?>
                                                        <option {{ $selected }} value="{{ $key }}"> {{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @elseif( $fo['type'] == 'selectdb')
                                            <select {{ $disabled }} data-index={{ $i }} {{ $required }} name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span8 no-primary">
                                                <option value="">-Pilih {{ $fo['label'] }} -</option>
                                                @if( count($fo['options']) > 0 )
                                                    @foreach( $fo['options'] as $key => $val )
                                                        <?php $selected = ""; ?>
                                                        <?php if( $value == $key ){ $selected="selected='selected'"; } ?>
                                                        <option {{ $selected }} value="{{ $key }}"> {{ $val }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            <div class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true" id="div_{{ $fo['id'] }}">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="cari_pasienLabel">Tambah {{ $fo['label'] }}</h4>
                                                </div>
                                                <div class="modal-body">

                                                    @if( isset( $fo['forms']) )
                                                        <?php $i = 1; ?>
                                                        @foreach($fo['forms'] as $m1=>$m2)
                                                            <div class="row-fluid">
                                                                <div class="span2">
                                                                {{ $m2 }}
                                                                </div>
                                                                <div class="span2">
                                                                <input type="text" data-text="{{ $m1 }}" name="popup__{{ $fo['id'] }}_{{ $i }}" id="popup__{{ $fo['id'] }}_{{ $i }}">
                                                                </div>
                                                            </div>
                                                            <?php $i++; ?>
                                                        @endforeach
                                                    @endif

                                                    @if( isset( $fo['tables']) && count($fo['tables']) > 0)
                                                        <?php $tb = $fo['tables']; ?>
                                                        <input type="hidden" name="table_{{ $fo['id'] }}" id="table_{{ $fo['id'] }}" value="{{ $tb[0] }}">
                                                        <input type="hidden" name="key_{{ $fo['id'] }}" id="key_{{ $fo['id'] }}" value="{{ $tb[1] }}">
                                                        <input type="hidden" name="value_{{ $fo['id'] }}" id="value_{{ $fo['id'] }}" value="{{ $tb[2] }}">
                                                    @endif
                                                    <div class="row-fluid">
                                                        <div class="span2">
                                                        </div>

                                                        <div class="span2">
                                                            <input type="button" class="btn btn-success" value="tambah" name="tambah_{{ $fo['id'] }}" id="tambah_{{ $fo['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            <input type="button" class="btn btn-success" value="+" id="btn_{{ $fo['id'] }}" />

                                            <script type="text/javascript">
                                            jQuery(document).ready(function($){
                                                $("#btn_{{ $fo['id'] }}").click(function(){
                                                    $('#div_{{ $fo["id"] }}').modal('show');
                                                });

                                                $("#tambah_{{ $fo['id'] }}").click(function(){
                                                    var _url = "{{ URL::to('crud/save_ajax') }}";
                                                    var _total = {{ count($fo['forms']) }};
                                                    var _text = "";
                                                    var _flag{{ $fo['id'] }} = 0;
                                                    for(i=1;i<=_total;i++){
                                                        _text += "&key"+i+"="+$("#popup__{{ $fo['id'] }}_"+i).attr('data-text')+"&val"+i+"="+$("#popup__{{ $fo['id'] }}_"+i).val();
                                                        if( $("#popup__{{ $fo['id'] }}_"+i).val() == ""){
                                                            $("#popup__{{ $fo['id'] }}_"+i).focus();
                                                            _flag{{ $fo['id'] }}++;
                                                        }
                                                    }
                                                    var _data = "table="+$("#table_{{ $fo['id'] }}").val()+"&total="+_total+_text;
                                                    if(_flag{{ $fo['id'] }} == 0){
                                                        
                                                        var _key = "";
                                                        $.post(_url , _data , function(response){
                                                            if( response != "" ){
                                                                $('#div_{{ $fo["id"] }}').modal('hide');
                                                            }
                                                            _key = response;    

                                                            var _url2 = "{{ URL::to('crud/load_ajax') }}";
                                                            var _data2 = "table="+$("#table_{{ $fo['id'] }}").val()+"&key="+$("#key_{{ $fo['id'] }}").val()+"&value="+$("#value_{{ $fo['id'] }}").val();
                                                            $.post(_url2 , _data2 , function(res){
                                                                var _res = $.parseJSON(res);
                                                                $("#{{ $fo['id'] }}").html('<option value="">-Pilih {{ $fo["label"] }}-</option>');
                                                                $.each(_res, function(i, item){
                                                                    if(item.key == _key){
                                                                        var _append = "<option selected='selected' value='"+item.key+"'>"+item.value+"</option>";
                                                                    }
                                                                    else{
                                                                        var _append = "<option value='"+item.key+"'>"+item.value+"</option>"
                                                                    }
                                                                    $("#{{ $fo['id'] }}").append(_append);
                                                                });
                                                            });                                                       
                                                        });

                                                        
                                                        
                                                    }
                                                    else{
                                                        //alert(_data);
                                                    }
                                                    

                                                    
                                                });
                                            });
                                            </script>
                                        @elseif( $fo['type'] == 'date' )
                                            @if( $value != '' )
                                                <?php $values = explode('-' , $value); ?>
                                                <?php $value = $values[2].'/'.$values[1].'/'.$values[0]; ?>
                                            @endif
                                            <input {{ $disabled }} data-index={{ $i }} {{ $required }} type="text" name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="tanggal span10 no-primary"
                                                value="{{ $value }}" >

                                        @elseif( $fo['type'] == 'nowdate' )
                                            <input {{ $disabled }} data-index={{ $i }} {{ $required }} type="text" name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="cruddate span10 no-primary"
                                                value="{{ $value }}" >

                                        @elseif( $fo['type'] == 'selectcomplex')                                            
                                            <select {{ $class }} {{ $disabled }} data-index={{ $i }} {{ $required }} name="{{ $fo['name'] }}" id="{{ $fo['id'] }}" class="span10 no-primary">
                                                <option value="">-Pilih {{ $fo['label'] }} -</option>
                                                @if( count($fo['options']) > 0 )
                                                    @foreach( $fo['options'] as $key => $val )
                                                        <?php $selected = ""; ?>
                                                        <?php if( $value == $key ){ $selected="selected='selected'"; } ?>
                                                        <?php $opt = ""; $opcontent = ""; ?>
                                                        @foreach( $fo['keys'] as $ka => $kb )
                                                            <?php $opt .= " $ka= '".$val->$kb."' " ; ?>
                                                        @endforeach


                                                        @foreach( $fo['content'] as $ca )
                                                            <?php $opcontent .= $val->$ca." " ; ?>
                                                        @endforeach
                                                        <option {{ $selected }} {{ $opt }}> {{ $opcontent }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            <script type="text/javascript">
                                            jQuery(document).ready(function($){
                                                $("#{{ $fo['id'] }}").change(function(){
                                                    @foreach($fo['change'] as $kch => $vch)
                                                        $('{{ $vch }}').val( $("#{{ $fo['id'] }}").find(':selected').attr("{{ $kch }}") );
                                                    @endforeach
                                                });
                                            });
                                            </script>

                                        @elseif( $fo['type'] == 'multiple')                                          
                                            <div class="span12">
                                                <br />
                                                <div class="span12">
                                                    <a href="javascript:void(0)" id="all_{{ $fo['id'] }}">Pilih Semua</a> || 
                                                    <a href="javascript:void(0)" id="deselect_{{ $fo['id'] }}">Hapus Semua</a>
                                                </div> 
                                                @if( count($fo['options']) > 0 )
                                                    <?php $ki = 1; 
                                                        if($value == ""){ 
                                                            $values = array(); 
                                                        }
                                                        else{
                                                            $values = json_decode($value);
                                                        }
                                                    ?>
                                                    @foreach( $fo['options'] as $key => $val )
                                                        <?php $selected = ""; ?>
                                                        <?php if( isset($values) && count($values) > 0 ){ if( in_array($key, $values) ) { $selected="checked='checked'"; } } ?>
                                                        <div class="span3">
                                                            <input {{ $selected }} type="checkbox" class="multi_{{ $fo['id'] }}" {{ $disabled }} data-index={{ $i }} name="{{ $fo['name'] }}[]" id="{{ $fo['id'].'_'.$ki }}" value="{{ $key }}" /> {{ $val }}
                                                        </div>
                                                        <?php $ki++; ?>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <script type="text/javascript">
                                            jQuery(document).ready(function($){
                                                $("#all_{{ $fo['id'] }}").click(function(){
                                                    $(".multi_{{ $fo['id'] }}").attr('checked' , 'checked');
                                                });

                                                $("#deselect_{{ $fo['id'] }}").click(function(){
                                                    $(".multi_{{ $fo['id'] }}").attr('checked' , false);
                                                });
                                            });
                                            </script>

                                        @elseif( $fo['type'] == 'multiple_menu')                                          
                                            <div class="span12">
                                                <br />
                                                <div class="span12">
                                                    <a href="javascript:void(0)" id="all_{{ $fo['id'] }}">Pilih Semua</a> || 
                                                    <a href="javascript:void(0)" id="deselect_{{ $fo['id'] }}">Hapus Semua</a>
                                                </div> <br /><br />
                                                @if( count($fo['options']) > 0 )
                                                    <?php $ki = 1; $ji = 1;
                                                        if($value == ""){ 
                                                            $values = array(); 
                                                        }
                                                        else{
                                                            $values = json_decode($value);
                                                        }
                                                    ?>
                                                    <div class="accordion" id="accordion_multi_{{ $i }}"> 
                                                    @foreach( $fo['options'] as $key => $val )
                                                        <?php $selected = ""; ?>
                                                        <?php if( isset($values) && count($values) > 0 ){ if( in_array($val->role, $values) ) { $selected="checked='checked'"; } } ?>
                                                        <?php if( isset($fo['separator']) ){
                                                            if($ki == 1){
                                                                $cseparator = $val->$fo['separator'];
                                                            }

                                                        }?>
                                                        <div class="accordion-group">
                                                            <div class="accordion-heading">
                                                                <a href="#acs_{{ $fo['id'].'_'.$ji }}" data-parent="#accordion_multi_{{ $i }}" data-toggle="collapse" class="accordion-toggle">
                                                                    {{ $val->nama_menu }}
                                                                </a>
                                                            </div>
                                                            <div class="accordion-body collapse" id="acs_{{ $fo['id'].'_'.$ji }}">
                                                                <div class="accordion-inner row-fluid">
                                                                    <input {{ $selected }} type="checkbox" class="multi_{{ $fo['id'] }}" {{ $disabled }} data-index={{ $i }} name="{{ $fo['name'] }}[]" id="{{ $fo['id'].'_'.$ki }}" value="{{ $val->role }}" /> {{ $val->nama_menu }}
                                                                    <hr />
                                                                    <div class="span12" style="margin-left:20px;">
                                                                    <?php $subs = DB::table( 'tbmenu' )->where('parent' , $val->id)->get(); ?>
                                                                    @foreach($subs as $s)
                                                                        <div class="span3">
                                                                            <input {{ $selected }} type="checkbox" class="multi_{{ $fo['id'] }}" {{ $disabled }} data-index={{ $i }} name="{{ $fo['name'] }}[]" id="{{ $fo['id'].'_'.$ki }}" value="{{ $s->role }}" /> {{ $s->nama_menu }}
                                                                        </div>
                                                                        <?php $ki++; ?>
                                                                    @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $ji++; ?>
                                                    @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <script type="text/javascript">
                                            jQuery(document).ready(function($){
                                                $("#all_{{ $fo['id'] }}").click(function(){
                                                    $(".multi_{{ $fo['id'] }}").attr('checked' , 'checked');
                                                });

                                                $("#deselect_{{ $fo['id'] }}").click(function(){
                                                    $(".multi_{{ $fo['id'] }}").attr('checked' , false);
                                                });
                                            });
                                            </script>
                                        @endif

                                        @if( $i == 0)
                                            <?php $first = $fo['id']; ?>
                                        @endif
                                    </div>

                                </div>
                                <?php $i++; ?>
                            @endif
                            
                        @endforeach
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary"><i class="splashy-check"></i> Simpan</button>
                                    <button type="button" id="btn_batal" class="btn"><i class="splashy-error_x"></i> Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
	        	</div>
        	</div>
		</div>
	</div>
@stop

@section('js')
	@parent
    <script type="text/javascript">
    jQuery(document).ready(function($){
        $('#btn_batal').click(function(){
            window.location.href = "{{ url($slug) }}";
        });

        $('#<?php echo $first; ?>').focus();

        
    });

    jQuery(window).load(function($){

    });
    </script>
    @if(isset($custom_js))
        @include('js/'.$custom_js)
    @endif
@stop