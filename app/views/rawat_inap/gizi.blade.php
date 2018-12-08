@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
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
        					Rawat Inap
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Form Makan Pasien
	        		</h3>
                </div>
                <div class="span6">
                    <form class="form-horizontal" id="form_gizi" method="GET">
                        <div class="control-group">
                            <label class="control-label">Tanggal</label>
                            <div class="controls">
                                <input type="text" name="tanggal_gizi" id="tanggal_gizi" class="nowdate">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php

            ?>
            <div class="row-fluid">
                <table class="table table-border">
                    <thead>
                        <tr>
                           <th>No RM</th>
                           <th>Nama</th>
                           <th>Tanggal Masuk</th>
                           <th>Ruangan</th>
                           <th>Kelas</th>
                           <th>Pagi</th>
                           <th>Siang</th>
                           <th>Sore</th>
                           <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @if( isset($pasien) && count($pasien) > 0 )
                            @foreach($pasien as $p)
                                <tr>
                                    <td>{{ $p->NoRM }}</td>
                                    <td>{{ $p->Nama }}</td>
                                    <td>{{ $p->Tanggal }}</td>
                                    <td>{{ $p->Ruangan }}</td>
                                    <td>{{ $p->Kelas }}</td>
                                    <?php $check    = DB::table( 'pasien_makan' )
                                                    ->where( 'IdInap' ,$p->IdInap )
                                                    ->where( 'Tanggal' , $tanggal )
                                                    ->first();

                                    ?>
                                    @if( isset($check->id) && !empty($check->id) )
                                        <td>{{ $check->PagiNama }}</td>
                                        <td>{{ $check->SiangNama }}</td>
                                        <td>{{ $check->SoreNama }}</td>
                                    @else
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <input type="hidden" name="tanggal_pilih" id="tanggal_pilih" value="{{ $tanggal_pilih }}">
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        jQuery(document).ready(function(){
            $('#tanggal_gizi').change(function(){
                $('#form_gizi').submit();
            });


                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!

                        var tanggal_pilih   = $('#tanggal_pilih').val();

                        var yyyy = today.getFullYear();
                        var _yyyy = yyyy-100;
                        $('#tanggal_gizi').datepicker({
                            format: "dd/mm/yyyy",
                            todayBtn: true,
                            todayHighlight: true,
                            language: "id",
                            autoclose: true,
                            maskInput: true,
                            startDate: dd+'/'+mm+'/'+_yyyy,
                            endDate: dd+'/'+mm+'/'+yyyy,
                        });

                        //$(this).inputmask("99/99/9999",{placeholder:"dd/mm/yyyy"});
                        $('#tanggal_gizi').css('background-color','#FFFFFF');
                        $('#tanggal_gizi').css('cursor','default');

                        $('#tanggal_gizi').val( tanggal_pilih );
                        $('#tanggal_gizi').qtip({
                            content: {
                                text: 'Format tanggal dd/mm/yyyy'
                            }, 
                            show: {
                                event: 'focus'
                            },
                            hide: {
                               event: 'blur'
                            }
                        });
                        $('#tanggal_gizi').blur(function(){
                            $(this).nextAll().remove()
                            var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
                            var Val_date=$(this).val();
                               if(Val_date.match(dateformat)){
                              var seperator1 = Val_date.split('/');
                              var seperator2 = Val_date.split('-');

                              if (seperator1.length>1)
                              {
                                  var splitdate = Val_date.split('/');
                              }
                              else if (seperator2.length>1)
                              {
                                  var splitdate = Val_date.split('-');
                              }
                              var dd = parseInt(splitdate[0]);
                              var mm  = parseInt(splitdate[1]);
                              var yy = parseInt(splitdate[2]);
                              var ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
                              if (mm==1 || mm>2)
                              {
                                  if (dd>ListofDays[mm-1])
                                  {
                                      $(this).focus();
                                    $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                                  }
                              }
                              if (mm==2)
                              {
                                  var lyear = false;
                                  if ( (!(yy % 4) && yy % 100) || !(yy % 400))
                                  {
                                      lyear = true;
                                  }
                                  if ((lyear==false) && (dd>=29))
                                  {
                                      $(this).focus();
                                    $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                                  }
                                  if ((lyear==true) && (dd>29))
                                  {
                                      $(this).focus();
                                    $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                                  }
                              }
                          }
                          else
                          {
                              $(this).focus();
                              $(this).after('<span class="alert alert-error">Tanggal salah</span>');
                          }
                        });
        });
    </script>
@stop
