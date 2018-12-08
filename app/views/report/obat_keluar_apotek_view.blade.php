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
                            <a href="{{ url('report/obat_keluar') }}">Laporan Apotek</a>
                        </li>
                        <li>
                            Obat Keluar
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="form_content">
                <div class="row-fluid">
                    <div class="span12">
                        <h3 class="heading">Laporan Obat Keluar Apotek
                        <span style="float:right;">
                            <a href="javascript:void(0)" onclick="do_print()" class="btn btn-primary">
                                <i class="splashy-printer"></i> Cetak
                            </a>
                            <a href="{{ url('report/obat_keluar_excel/Excel5') }}?dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2003
                            </a>
                            <a href="{{ url('report/obat_keluar_excel/Excel2007') }}?dari_tanggal={{ $dari_tanggal }}&sampai_tanggal={{ $sampai_tanggal }}" class="btn btn-primary">
                                <i class="splashy-calendar_week_add"></i> Excel 2007
                            </a>
                        </span>
                        </h3>
                        @if( $errors->first('title') || $errors->first('note') )
                            <div class="alert alert-error">
                                <a class="close" data-dismiss="alert">×</a>
                                {{ $errors->first('title') }}
                                {{ $errors->first('note') }}
                            </div>
                        @endif
						@if(count($pasien) > 0)
							<div class="row-fluid" id="printarea">
								<div class="span12">
									
									<h3 align="center">{{ $rs_title }}</h3>
									<h4 align="center">{{ $rs_alamat }}</h4>
									<br />
									<h3>Laporan Obat Keluar Apotek</h3>
									<div>
										<table>
											<tr>
												<td>Dari Tanggal</td>
												<td>:</td>
												<td>{{ $dari_tanggal2 }}</td>
											</tr>
											<tr>
												<td>Sampai Tanggal</td>
												<td>:</td>
												<td>{{ $sampai_tanggal2 }}</td>
											</tr>
										</table>
									</div><br />
									<table width="100%" border="1" class="report">
										<tr style="background:#999999; font-weight:bold;">
											<td align="center">No</td>
											<td align="center">No RM</td>
											<td align="center">Nama</td>
											<td align="center">Tgl. Masuk</td>
											<td align="center">Jenis Rawat</td>
											<td align="center">Gol. Pasien</td>
											<td align="center">No Resep</td>
											<td align="center">Tgl. Resep</td>
											<td align="center">Nama Obat</td>
											<td align="center">Harga</td>
											<td align="center">Satuan</td>
											<td align="center">Sub Total</td>
										</tr>
									@foreach($pasien as $pas => $ien)
									<?php $no++; ?>
										@if($ien->NoResep==$nores)
											<tr>
												<td colspan="8">&nbsp;</td>
												<td>{{ $ien->NamaObat }}</td>
												<td align="right">{{ $ien->Harga }}</td>
												<td align="right">{{ $ien->Jumlah }}</td>
												<td align="right">{{ $ien->TotalHarga }}</td>
											</tr>
											<?php $sub2 += $sub;
												  $sub4 = $sub2 + $ien->TotalHarga; ?>
											@if($nums!=$num)
											<tr style="background:#E2E2E2; font-weight:bold;">
												<td colspan="11">Total</td>
												<td align="right">{{ $sub4 }}</td>
											</tr>
											@endif
										@else
										<?php $sub2 += $sub; ?>
											@if($nores != '')
												<tr style="background:#E2E2E2; font-weight:bold;">
													<td colspan="11">Total</td>
													<td align="right">{{ $sub2 }}</td>
												</tr>
												<tr>
													<td colspan="12">&nbsp;</td>
												</tr>
											@endif
										<?php $sub = '';
											  $sub2 = '';
											  $num++; ?>
											<tr>
												<td>{{ $num }}</td>
												<td>{{ $ien->NoRM }}</td>
												<td>{{ $ien->Nama }}</td>
												<td>{{ $ien->TanggalMasuk }}</td>
												<td>{{ $ien->JenisRawat }}</td>
												<td>{{ $ien->GolPasien }}</td>
												<td>{{ $ien->NoResep }}</td>
												<td>{{ $ien->TanggalResep }}</td>
												<td>{{ $ien->NamaObat }}</td>
												<td align="right">{{ $ien->Harga }}</td>
												<td align="right">{{ $ien->Jumlah }}</td>
												<td align="right">{{ $ien->TotalHarga }}</td>
											</tr>
										@endif
										<?php $nums = $num;
											  $nores = $ien->NoResep;
											  $sub = $ien->TotalHarga; ?>
										@if($lastElementKey == $no)
											<tr style="background:#E2E2E2; font-weight:bold;">
												<td colspan="11">Total</td>
												<td align="right">{{ $sub + $sub2; }}</td>
											</tr>
										@endif
									@endforeach
										<tr style="background:#CCCCCC; font-weight:bold;">
											<td colspan="12"><b>Jumlah Transaksi : {{ number_format($num) }}</b></td>
										</tr>
									</table>
								</div>
							</div>
                        @else
                            <h3>Data tidak ditemukan</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    @parent
    {{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('js/jquery.printElement.min.js') }}
    <script type="text/javascript">


        function do_print(){
            var css = "";
            $('link').each(function(){
                css += '<link media="all" type="text/css" rel="stylesheet" href="' + $(this).attr('href') + '">';
            })
            w=window.open(null, 'Print_Page', 'scrollbars=yes');
            w.document.write( css + $('#printarea').html() );
            w.document.close();
            
            setInterval(function () { w.print(); }, 1000);
        }
    </script>
@stop
