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
                            <a href="{{ url('sep/detail') }}">Data Peserta</a>
                        </li>
                        <li>
                             Detail SEP
                        </li>
                    </ul>
                </div>
            </nav>
			
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Data Peserta Dengan SEP : <font color="#0000FF">{{ $nomor }}</font>
                        </h3>
						@if($meta==200)
						<div class="row-fluid">
							<div class="span3">
								<div class="control-group">
									<label class="control-label">No SEP</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['noSep'] }}" />
									</div>
								</div>
							</div>
							<div class="span3">
								<div class="control-group">
									<label class="control-label">Tanggal Terbit SEP</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['tglSep'])) }}" />
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
									<label class="control-label">No Kartu BPJS</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['peserta']['noKartu'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Cetak Kartu</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['peserta']['tglCetakKartu'])) }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">NIK</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['peserta']['nik'] }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Nama Peserta</label>
									<div class="controls">
										<input type="text" id="nama_obat" name="nama_obat" class="span12 no-primary" value="{{ $show['peserta']['nama'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Kelompok Peserta (PISA)</label>
									<div class="controls">
										<input type="text" id="satuan" name="satuan" class="span12 no-primary" value="{{ $pisa }}" />
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
							</div>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Data Provider Peserta</h4></label>
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
							</div>                          
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
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
									<label class="control-label"><h4>Keterangan Rujukan</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">No Rujukan</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['noRujukan'] }}" />
									</div>
								</div>  
								<div class="control-group">
									<label class="control-label">Tanggal Rujukan</label>
									<div class="controls">
										<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['tglRujukan'])) }}" />
									</div>
								</div>                            
							</div>                          
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Tanggal Pulang</label>
									<div class="controls">
										<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" value="{{ date( "d/m/Y", strtotime($show['tglPulang'])) }}" />
									</div>
								</div>                            
								<div class="control-group">
									<label class="control-label">Catatan</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['catatan'] }}" />
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Diagnosa</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Diagnosa</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['diagAwal']['kdDiag'] }}" />
									</div>
								</div-->
								<div class="control-group">
									<label class="control-label">Nama Diagnosa</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['diagAwal']['nmDiag'] }}" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Pelayanan</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['jnsPelayanan'] }}" />
									</div>
								</div>  
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Provider Rujukan</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Provider</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['provRujukan']['kdProvider'] }}" />
									</div>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Provider</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['provRujukan']['nmProvider'] }}" />
									</div>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Cabang</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['provRujukan']['kdCabang'] }}" />
									</div>
								</div-->                            
								<div class="control-group">
									<label class="control-label">Nama Cabang</label>
									<div class="controls">
										<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" value="{{ $show['provRujukan']['nmCabang'] }}" />
									</div>
								</div>                            
							</div>                          
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Prov Pelayanan</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Provider</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['provPelayanan']['kdProvider'] }}" />
									</div>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Provider</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['provPelayanan']['nmProvider'] }}" />
									</div>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Cabang</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['provPelayanan']['kdCabang'] }}" />
									</div>
								</div-->                            
								<div class="control-group">
									<label class="control-label">Nama Cabang</label>
									<div class="controls">
										<input type="text" id="harga_beli" name="harga_beli" class="span12 no-primary" value="{{ $show['provPelayanan']['nmCabang'] }}" />
									</div>
								</div>                            
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Poli dan Kelas Perawatan</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Poli</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['poliTujuan']['kdPoli'] }}" />
									</div>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Poli</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['poliTujuan']['nmPoli'] }}" />
									</div>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Kelas</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['klsRawat']['kdKelas'] }}" />
									</div>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Kelas</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['klsRawat']['nmKelas'] }}" />
									</div>
								</div>  
							</div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>Status SEP</h4></label>
								</div>  
								<!--div class="control-group">
									<label class="control-label">Kode Status SEP</label>
									<div class="controls">
										<input type="text" id="stok" name="stok" class="span12 no-primary" value="{{ $show['statSep']['kdStatSep'] }}" />
									</div>
								</div>  
							</div>                          
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div-->  
								<div class="control-group">
									<label class="control-label">Nama Status SEP</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['statSep']['nmStatSep'] }}" />
									</div>
								</div>  
							</div>
							<div class="span4">
								<div class="control-group">
									<label class="control-label"><h4>&nbsp;</h4></label>
								</div>  
								<div class="control-group">
									<label class="control-label">Jumlah Tagihan</label>
									<div class="controls">
										<input type="text" id="harga" name="harga" class="span12 no-primary" value="{{ $show['byTagihan'] }}" />
									</div>
								</div>  
							</div>
						</div>
						@else
							Data Tidak Ditemukan<br/><a href="{{ url('sep/detail/') }}" class="btn btn-primary" role="button">Kembali Cari Data</a>
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
