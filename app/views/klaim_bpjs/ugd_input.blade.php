@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    <style type="text/css">
        input:focus{ 
            background-color: yellow;
        }
        input.success{
            background-color: #FFA000;
        }
    </style>
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
                            <a href="{{ url('klaim_bpjs/ugd') }}">Jasa Dokter</a>
                        </li>
                        <li>
                            UGD
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Input Klaim BPJS UGD
                    </h3>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
                        </div>
                    @endif 
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <h2>{{ Session::get('success') }}</h2>
                        </div>
                    @endif
                    <div class="row-fluid">
                        <div>
                            <div class="span2">Dari Tanggal</div>
                            <div class="span2">{{ Input::get('dari') }}</div>
                        </div>
                        <br />
                        <div>
                            <div class="span2">Sampai Tanggal</div>
                            <div class="span2">{{ Input::get('sampai') }}</div>
                        </div>
                        <br />
                        <div>
                            <div class="span2">Pasien</div>
                            <div class="span2">BPJS</div>
                        </div>
                    </div>
                    <br />
                        <input type="hidden" name="dari" value="{{ Input::get('dari') }}">
                        <input type="hidden" name="sampai" value="{{ Input::get('sampai') }}">
                        <div class="row-fluid">
                            @if(isset($pasien))
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No Reg</th>
                                        <th>No RM</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th width="120px">Total Klaim</th>
                                        <th>Jenis Pasien</th>
                                        <th>Dokter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pasien as $p)
                                    <tr class="{{ $p->NoRegUGD }} {{ $p->NoRM }} {{ $p->Nama }}">
                                        <td>{{ $p->NoRegUGD }}</td>
                                        <td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                        <td>
                                            @if($p->TotalKlaim=='' || empty($p->TotalKlaim))
                                                <?php $p->TotalKlaim = 0; ?>
                                            @endif
                                            <input style="width:80px" class="numeric total-klaim" data-noreg="{{ $p->NoRegUGD }}" required type="text" style="width:100px" name="klaim['{{ $p->NoRegUGD }}']" id="klaim_{{ $p->NoRegUGD }}" value="{{ $p->TotalKlaim }}" />
                                        </td>
                                        <td>{{ $p->GolPasien }}</td>
                                        <td>
                                            @foreach( $helper->getDokterByNoReg($p->NoRegUGD) as $s )
                                                {{ $s->NamaDokter .'<br />'}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="row-fluid">
                           <!-- <button type="submit" class="btn btn-success">Proses</button> -->
                        </div>
                </div>
            </div>
            
        </div>
    </div>

@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
            $.extend(jQuery.validator.messages, {
                required: "Mohon isi field ini"
            });
            $('#klaim_form').validate({

            });

            $('.total-klaim').each(function(){
                $(this).bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    $(this).removeClass('success');
                    $(this).parent().find('.icon-ok').remove();
                    if(code == 13) { //Enter keycode
                        var NoReg = $(this).attr('data-noreg');
                        var Klaim = $(this).val();
                        var InputId = $(this).attr('id');
                        $.ajax({
                            url: "{{ url('klaim_bpjs/rawat_jalan_one') }}",
                            type: "POST",
                            data : "noreg="+NoReg+"&klaim="+Klaim,
                            success:function(res){
                                if(res == 'success'){
                                    $('#'+InputId).after('<i class="icon-ok"></i>');
                                    $('#'+InputId).addClass('success');
                                }                               
                            }
                        });
                        $(this).parent().parent().next().find('.total-klaim').focus();
                    }
                });
            });
        });
    </script>
@stop
