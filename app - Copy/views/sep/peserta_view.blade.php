@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
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
                            <a href="{{ url('sep/peserta/'.$slug) }}">Data Peserta</a>
                        </li>
                        <li>
                            {{ $title }}
                        </li>
                    </ul>
                </div>
            </nav>
			
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Data Peserta Dengan {{ $title }} : <font color="#0000FF">{{ $dasar }}</font>
                        </h3>
						@if($meta==200)
						<div class="row-fluid">
							<div class="span3">
								<div class="control-group">
									<label class="control-label">No Kartu BPJS</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['noKartu'] }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label">Tanggal Cetak Kartu</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['tglCetakKartu'])) }}" />
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Data Peserta</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">NIK</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['nik'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Peserta</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['nama'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Pisa</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $show['pisa'] }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Jenis Kelamin</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['sex'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Lahir</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['tglLahir'])) }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Kode Jenis Peserta</label>
									<div class="controls">
										<input type="text" id="jumlah" name="jumlah" class="span12 no-primary" value="{{ $show['jenisPeserta']['kdJenisPeserta'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Jenis Peserta</label>
									<div class="controls">
										<input type="text" id="total" name="total" class="span12 no-primary" value="{{ $show['jenisPeserta']['nmJenisPeserta'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Kode Kelas Tanggungan</label>
									<div class="controls">
										<input type="text" id="jumlah" name="jumlah" class="span12 no-primary" value="{{ $show['kelasTanggungan']['kdKelas'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Kelas</label>
									<div class="controls">
										<input type="text" id="total" name="total" class="span12 no-primary" value="{{ $show['kelasTanggungan']['nmKelas'] }}" />
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Data Provider</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Kode Provider</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['provUmum']['kdProvider'] }}" />
									</div>
								</div>  
								<div class="control-group">
									<label class="control-label">Nama Provider</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['provUmum']['nmProvider'] }}" />
									</div>
								</div>  
							</div>                          
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Kode Cabang</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['provUmum']['kdCabang'] }}" />
									</div>
								</div>                            
								<div class="control-group">
									<label class="control-label">Nama Cabang</label>
									<div class="controls">
										<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" value="{{ $show['provUmum']['nmCabang'] }}" />
									</div>
								</div>                            
							</div>
						</div>
						@else
							Data Tidak Ditemukan<br/><a href="{{ url('sep/rujukan/'.$slug) }}" class="btn btn-primary" role="button">Kembali Cari Data</a>
						@endif
                    </div>
                </div>
          
        </div>
    </div>
@stop

@section('js')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
			$('.no-primary').each(function(){
				$(this).attr('disabled','disabled');
			});
        });
   </script>
@stop
