@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::style('lib/chosen/chosen.css') }}
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
                            <a href="{{ url('jasa_dokter/rawat_inap') }}">Jasa Dokter</a>
                        </li>
                        <li>
                            Rawat Inap
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Pembagian Jasa Dokter || Rawat Inap
                    </h3>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
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
                    </div>
                    <form action="{{ url('jasa_dokter/rawat_inap_view') }}" method="POST" id="klaim_form">
                        <div class="row-fluid">
                            @if(isset($pasien))
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No Reg</th>
                                        <th>No RM</th>
                                        <th>Nama</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Total Klaim</th>
                                        <th>Jenis Pasien</th>
                                        <th>Dokter</th>
                                        <th>Ruangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pasien as $p)
                                    <tr>
                                        <td>{{ $p->NoReg }}</td>
                                        <td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                        <td><input class="numeric" required type="text" style="width:100px" name="klaim['{{ $p->NoReg }}']" id="klaim_{{ $p->NoReg }}" value="{{ $p->TotalKlaim }}" /></td>
                                        <td>{{ $p->GolPasien }}</td>
                                        <td>
                                            @foreach( $helper->getDokterByNoReg($p->NoReg) as $s )
                                                {{ $s->NamaDokter .'<br />'}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach( $helper->getRuanganByNoReg($p->NoReg) as $r )
                                                {{ $r->Ruangan .'<br />'}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="row-fluid">
                            <button type="submit" class="btn btn-success">Proses</button>
                        </div>
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>

@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    {{ HTML::script('js/jquery.numeric.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
            $.extend(jQuery.validator.messages, {
                required: "Mohon isi field ini"
            });
             $('.numeric').numeric();
            $('#klaim_form').validate({

            });
        });
    </script>
@stop
