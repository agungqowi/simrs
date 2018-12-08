@extends('layout')

@section('css')
    @parent
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
        					<a href="{{ action('DashboardController@index') }}">Tarif Dokter</a>
        				</li>
        				<li>
        					Bulk
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Bulk Tarif Dokter
	        			
	        		</h3>
                    <?php
                        $tarif_field = array(
                            'TarifKonsul'   => 'Tarif Konsul', 
                            'TarifVisite'   => 'Tarif Visite',
                            'PKonsul'       => '% Konsul' , 
                            'PVisite'       => '% Visite', 
                            'PTindakan'     => '% Tindakan', 
                            'PPenunjang'    => '% Penunjang' ,
                            'PUsg'          => '% USG' ,
                            'PEmergency'    => '% Emergency');
                    ?>
                    <?php $success = Session::get('success'); ?>
                    @if( Session::get('success') )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif

                    <div class="row-fluid">
                        <form action="{{ url('tarif_dokter/bulk') }}" method="POST">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kategori Dokter</th>
                                <th>
                                <table  class="table">
                                    <tr>
                                        <th>Jenis</th>
                                        @foreach($tarif_field as $t => $f)
                                            <th>{{ $f }}</th>
                                        @endforeach
                                    </tr>
                                </table>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokter as $d)
                            <tr>
                                <td>{{ $d->NamaJenis }}</td>
                                <td>
                                @foreach($pasien as $p)
                                <table class="table">
                                    <tr>
                                        <td>{{ $p->Nama }}</td>
                                        <?php
                                            $data  = DB::table('tarif_dokter_bulk')->where('IdJenis',$p->Id)
                                                    ->where('IdKategoriDokter',$d->Id)->first();
                                        ?>
                                        @foreach($tarif_field as $t => $f)
                                            @if( isset($data->$t) )
                                                <?php $value = $data->$t; ?>
                                            @else
                                                <?php $value = 0; ?>
                                            @endif
                                            <th><input style="width:70px" type="text" name="tarif['{{ $d->Id }}']['{{ $p->Id }}']['{{ $t }}']" id="tarif['{{ $d->Id }}']['{{ $p->Id }}']['{{ $t }}']"
                                            value="{{ $value }}"></th>
                                        @endforeach
                                    </tr>
                                </table>
                                @endforeach
                                </td>                               
                            </tr>
                            @endforeach
                        </tbody>
                        </table>

                        <button class="btn btn-primary"/><i class="splashy-gem_okay"></i> Proses</form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    @include('js/rawat_jalan_pasien')
    
@stop