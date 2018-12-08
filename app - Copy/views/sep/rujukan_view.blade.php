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
                            <a href="{{ url('sep/rujukan/data/'.$slug) }}">Data Rujukan</a>
                        </li>
                        <li>
                            {{ $title }}
                        </li>
                    </ul>
                </div>
            </nav>
			
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Data Rujukan Dengan {{ $title }} : <font color="#0000FF">{{ $dasar }}</font>
                        </h3>
						@if($meta==200)
						<div class="row-fluid">
							<div class="span3">
								<div class="control-group">
									<label class="control-label">No Rujukan</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['noKunjungan'] }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label">Tanggal Rujukan</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['tglKunjungan'])) }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label">No Kartu BPJS</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $show['peserta']['noKartu'] }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label">Tanggal Cetak Kartu</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['peserta']['tglCetakKartu'])) }}" />
									</div>
								</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>Data Penerbit Rujukan</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Rujukan</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['provKunjungan']['kdProvider'] }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Rujukan</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['provKunjungan']['nmProvider'] }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Cabang</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $show['provKunjungan']['kdCabang'] }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Cabang</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $show['provKunjungan']['nmCabang'] }}" />
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
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['peserta']['nik'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Peserta</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['peserta']['nama'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Kelamin</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $jk }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Lahir</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['peserta']['tglLahir'])) }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Jenis Peserta</label>
									<div class="controls">
										<input type="text" id="jumlah" name="jumlah" class="span12 no-primary" value="{{ $show['peserta']['jenisPeserta']['kdJenisPeserta'] }}" />
									</div>
								</div-->
								<div class="control-group">
									<label class="control-label">Nama Jenis Peserta</label>
									<div class="controls">
										<input type="text" id="total" name="total" class="span12 no-primary" value="{{ $show['peserta']['jenisPeserta']['nmJenisPeserta'] }}" />
									</div>
								</div>
								<!--div class="control-group">
									<label class="control-label">Kode Kelas Tanggungan</label>
									<div class="controls">
										<input type="text" id="jumlah" name="jumlah" class="span12 no-primary" value="{{ $show['peserta']['kelasTanggungan']['kdKelas'] }}" />
									</div>
								</div-->
								<div class="control-group">
									<label class="control-label">Nama Kelas</label>
									<div class="controls">
										<input type="text" id="total" name="total" class="span12 no-primary" value="{{ $show['peserta']['kelasTanggungan']['nmKelas'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Kelompok Peserta (PISA)</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $pisa }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Provider</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['peserta']['provUmum']['kdProvider'] }}" />
									</div>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Provider</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['peserta']['provUmum']['nmProvider'] }}" />
									</div>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Cabang</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['peserta']['provUmum']['kdCabang'] }}" />
									</div>
								</div-->                            
								<div class="control-group">
									<label class="control-label">Nama Cabang</label>
									<div class="controls">
										<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" value="{{ $show['peserta']['provUmum']['nmCabang'] }}" />
									</div>
								</div>                            
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Data Penyakit</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Keluhan</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $show['keluhan'] }}" />
									</div>
								</div>
								<!--div class="control-group">
									<label class="control-label">Kode Diagnosa</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['diagnosa']['kdDiag'] }}" />
									</div>
								</div-->
								<div class="control-group">
									<label class="control-label">Nama Diagnosa</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['diagnosa']['nmDiag'] }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">pem Fisik Lain</label>
									<div class="controls">
										<input type="text" id="jumlah" name="jumlah" class="span12 no-primary" value="{{ $show['pemFisikLain'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Catatan</label>
									<div class="controls">
										<input type="text" id="total" name="total" class="span12 no-primary" value="{{ $show['catatan'] }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Tingkat Pelayanan</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['tktPelayanan']['kdTktPelayanan'] }}" />
									</div>
								</div-->                            
								<div class="control-group">
									<label class="control-label">Nama Tingkat Pelayanan</label>
									<div class="controls">
										<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" value="{{ $show['tktPelayanan']['nmTktPelayanan'] }}" />
									</div>
								</div>                            
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Data RS Rujukan</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Provider</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $show['provRujukan']['kdProvider'] }}" />
									</div>
								</div-->
								<div class="control-group">
									<label class="control-label">Nama Provider</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['provRujukan']['nmProvider'] }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Cabang</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['provRujukan']['kdCabang'] }}" />
									</div>
								</div-->
								<div class="control-group">
									<label class="control-label">Nama Cabang</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['provRujukan']['nmCabang'] }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Poli</label>
									<div class="controls">
										<input type="text" id="jumlah" name="jumlah" class="span12 no-primary" value="{{ $show['poliRujukan']['kdPoli'] }}" />
									</div>
								</div-->
								<div class="control-group">
									<label class="control-label">Nama Poli</label>
									<div class="controls">
										<input type="text" id="total" name="total" class="span12 no-primary" value="{{ $show['poliRujukan']['nmPoli'] }}" />
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
