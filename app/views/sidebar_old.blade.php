		<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
				
				<div class="">
					<div class="">
						<div>
					
							<div class="sidebar_inner">
								<?php
									if(isset($group->slug)){
	                                    $slug = $group->slug;
	                                }
	                                else{
	                                    $slug = "";
	                                }
	                                
	                                if(isset($group->permissions)){
	                                    $p=$group->permissions; 
	                                }
	                                else{
	                                    $p = "";
	                                }
	                                
								?>
								<div style="padding:10px;">
									<img style="max-height:80px;" height="80px" src="{{ url('img/logo.gif') }}" />
								</div>
								<div id="side_accordion" class="accordion">
								@if( $p == 'all' || strpos($p, 'register_') !== FALSE )
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-application_windows_add"></i> Pendaftaran
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseOne">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													@if( $p == 'all' || strpos($p, 'register_all') !== FALSE || strpos($p, 'register_inap') !== FALSE  )
			                                            <li><a href="{{ url('rawat_inap/register') }}">Rawat Inap</a></li>
			                                        @endif

			                                        @if( $p == 'all' || strpos($p, 'register_all') !== FALSE || strpos($p, 'register_jalan') !== FALSE  )
			                                            <li><a href="{{ url('rawat_jalan/register') }}">Rawat Jalan</a></li>
			                                        @endif

			                                        @if( $p == 'all' || strpos($p, 'register_all') !== FALSE || strpos($p, 'register_ugd') !== FALSE  )
			                                            <li><a href="{{ url('ugd/register') }}">IGD</a></li>
			                                        @endif

			                                        @if( $p == 'all' || strpos($p, 'register_') !== FALSE )
			                                            <li><a href="{{ url('sep/update_norm') }}">Update Nomor SEP</a></li>
			                                        @endif

			                                        @if( $p == 'all' || strpos($p, 'register_') !== FALSE )
			                                            <li><a href="{{ url('history_pasien') }}">Rekam Medis</a></li>
			                                        @endif

			                                        @if( $p == 'all' || strpos($p, 'register_') !== FALSE )
			                                            <li><a href="{{ url('pasien/cetak_kartu') }}">Cetak Kartu</a></li>
			                                        @endif
												</ul>
											</div>
										</div>
									</div>
								@endif

								@if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_inap') !== FALSE  )
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseInap" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-contact_blue"></i> Rawat Inap
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseInap">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													@if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_inap') !== FALSE  )
			                                            <li><a href="{{ url('rawat_inap/pasien') }}">Tindakan & Diagnosa Rawat Inap</a></li>
			                                        @endif
			                                        @if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_inap') !== FALSE  )
			                                            <li><a href="{{ url('report/tanggal_inap/rincian_rawat_inap') }}">Rincian Rawat Inap</a></li>
			                                        @endif
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_inap') !== FALSE  )
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseJalan" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-contact_blue"></i> Rawat Jalan
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseJalan">
											<div class="accordion-inner">
												<ul class="nav nav-list">
			                                        @if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_jalan') !== FALSE  )
			                                            <li><a href="{{ url('rawat_jalan/pasien') }}">Tindakan & Diagnosa Rawat Jalan</a></li>
			                                        @endif
			                                        @if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_jalan') !== FALSE  )
			                                            <li><a href="{{ url('report/rawat_jalan') }}">Lap Pasien Rawat Jalan</a></li>
			                                        @endif

			                                        
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_ugd') !== FALSE  )
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseUgd" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-contact_blue"></i> IGD
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseUgd">
											<div class="accordion-inner">
												<ul class="nav nav-list">
			                                        @if( $p == 'all' || strpos($p, 'pasien_all') !== FALSE || strpos($p, 'pasien_ugd') !== FALSE  )
			                                            <li><a href="{{ url('ugd/pasien') }}">Tindakan & Diagnosa IGD</a></li>
			                                        @endif
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' || strpos($p, 'penunjang_') !== FALSE )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseLab" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-document_a4_new"></i> Laboratorium
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseLab">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													@if( $p == 'all' || strpos($p, 'penunjang_lab') !== FALSE )
			                                            <li><a href="{{ url('lab/hasil') }}">Tindakan, Diagnosa dan hasil lab</a></li>
			                                            <li><a href="{{ url('lab_kategori') }}">Kategori pemeriksaan</a></li>
			                                            <li><a href="{{ url('lab_pemeriksaan') }}">Daftar Pemeriksaan</a></li>
			                                        @endif
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' || strpos($p, 'penunjang_') !== FALSE )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseRadiologi" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-document_a4_new"></i> Radiologi
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseRadiologi">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													@if( $p == 'all' || strpos($p, 'penunjang_lab') !== FALSE )
			                                            <li><a href="{{ url('radiologi') }}">Tindakan, Diagnosa dan hasil Radiologi</a></li>
			                                            <li><a href="{{ url('radiologi_pemeriksaan') }}">Jenis pemeriksaan</a></li>
			                                        @endif
												</ul>
											</div>
										</div>
									</div>
                                @endif


                                @if( $p == 'all' || strpos($p, 'penunjang_') !== FALSE )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapsePenunjang" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-document_a4_new"></i> Penunjang
											</a>
										</div>

										<div class="accordion-body collapse" id="collapsePenunjang">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													@if( $p == 'all' || strpos($p, 'penunjang_lab') !== FALSE )
			                                            <li><a href="{{ url('penunjang/pa') }}">Lab Patologi Anatomi</a></li>
			                                            <li><a href="{{ url('penunjang/fisioterapi') }}">Fisioterapi</a></li>
			                                        @endif
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' || strpos($p, 'unit_') !== FALSE )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseUnit" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-document_a4_new"></i> Unit Khusus
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseUnit">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													@if( $p == 'all' || strpos($p, 'unit_') !== FALSE )
			                                            <li><a href="{{ url('unit/hemodialisa') }}">Hemodialisa</a></li>
			                                            <li><a href="{{ url('unit/icu') }}">ICU</a></li>
			                                            <li><a href="{{ url('unit/ok') }}">OK</a></li>
			                                        @endif
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' || strpos($p, 'billing') !== FALSE )
                                	<!-- 
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseInvoice" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-group_green_edit"></i> Tagihan
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseInvoice">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li><a href="{{ url('invoice/rawat_jalan') }}">Rawat Jalan</a></li>
			                                        <li><a href="{{ url('invoice/rawat_inap') }}">Rawat Inap</a></li>
			                                        <li><a href="{{ url('invoice/ugd') }}">UGD</a></li>
												</ul>
											</div>
										</div>
									</div>
									-->
                                @endif

                                @if( $p == 'all' || strpos($p, 'billing') !== FALSE )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseBilling" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-group_green_edit"></i> Kasir
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseBilling">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li><a href="{{ url('billing/rawat_jalan') }}">Rawat Jalan</a></li>
			                                        <li><a href="{{ url('billing/rawat_inap') }}">Rawat Inap (Sudah Pulang)</a></li>
			                                        <li><a href="{{ url('invoice/rawat_inap') }}">Rawat Inap (Belum Pulang)</a></li>
			                                        <li><a href="{{ url('billing/ugd') }}">IGD</a></li>
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseMaster" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-box"></i> Master Data
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseMaster">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li><a href="{{ URL::to('dokter') }}">Dokter</a></li>
			                                        <li><a href="{{ URL::to('perawat') }}">Perawat</a></li>
			                                        <li><a href="{{ URL::to('poli') }}">Poli</a></li>
			                                        <li><a href="{{ URL::to('diagnosa') }}">Diagnosa</a></li>
												</ul>
											</div>
										</div>
									</div>
                                @endif

                                @if( $p == 'all' )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseMasterRuang" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-box"></i> Master Ruangan
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseMasterRuang">
											<div class="accordion-inner">
												<ul class="nav nav-list">													
			                                        <li><a href="{{ URL::to('kategori_ruangan') }}">Kategori Ruangan</a></li>
			                                        <li><a href="{{ URL::to('kelas_ruangan') }}">Kelas Ruangan</a></li>
			                                        <li><a href="{{ URL::to('ruangan') }}">Ruangan dan Tarif</a></li>
												</ul>
											</div>
										</div>
									</div>
								@endif

								@if( $p == 'all' )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseMasterTarif" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-box"></i> Master Tarif Tindakan
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseMasterTarif">
											<div class="accordion-inner">
												<ul class="nav nav-list">
			                                        <li><a href="{{ URL::to('tindakan_jenis') }}">Jenis Rawat Tindakan</a></li>
			                                        <li><a href="{{ URL::to('kategori_tindakan') }}">Kategori Tindakan</a></li>
			                                        <li><a href="{{ URL::to('tindakan') }}">Tarif Tindakan</a></li>
			                                        <li><a href="{{ URL::to('tindakan/bulk') }}">Input Bulk Tindakan</a></li>
												</ul>
											</div>
										</div>
									</div>
								@endif

								@if( $p == 'all' )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseInventory" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-contact_blue"></i> Asset dan Inventori
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseInventory">
											<div class="accordion-inner">
												<ul class="nav nav-list">
			                                        <li><a href="{{ URL::to('asset_kategori') }}">Kategori</a></li>
			                                        <li><a href="{{ URL::to('asset_merk') }}">Merk</a></li>
			                                        <li><a href="{{ URL::to('asset_pemilik') }}">Penanggung Jawab</a></li>
			                                        <li><a href="{{ URL::to('asset_inventori') }}">Inventori</a></li>
												</ul>
											</div>
										</div>
									</div>
								@endif

								@if( $p == 'all' )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseKepegawaian" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-contact_blue"></i> Kepegawaian
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseKepegawaian">
											<div class="accordion-inner">
												<ul class="nav nav-list">
			                                        <li><a href="{{ URL::to('sispeg_jabatan') }}">Jabatan</a></li>
			                                        <li><a href="{{ URL::to('sispeg_pangkat') }}">Pangkat</a></li>
			                                        <li><a href="{{ URL::to('sispeg_pegawai') }}">Pegawai</a></li>
			                                        <li><a href="{{ URL::to('sispeg_mutasi') }}">Mutasi Jabatan</a></li>
			                                        <li><a href="{{ URL::to('sispeg_pindah') }}">Pindah Kerja</a></li>
			                                        <li><a href="{{ URL::to('sispeg_kenaikan') }}">Kenaikan Pangkat</a></li>
			                                        <li><a href="{{ URL::to('sispeg_pensiun') }}">Pensiun</a></li>
												</ul>
											</div>
										</div>
									</div>
								@endif

								@if( $p == 'all' )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseAccounting" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-contact_blue"></i> Akuntansi Keuangan
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseAccounting">
											<div class="accordion-inner">
												<ul class="nav nav-list">
			                                        <li><a href="{{ URL::to('akun_rekening') }}">Akun Semua Rekening</a></li>
			                                        <li><a href="{{ URL::to('akun_pendapatan') }}">Akun Pendapatan Tindakan</a></li>
			                                        <li><a href="{{ URL::to('akun_transaksi') }}">Transaksi</a></li>
			                                        <li><a href="{{ URL::to('akun_mutasi') }}">Mutasi Harian</a></li>
			                                        <li><a href="{{ URL::to('akun_statement') }}">Detail Statement</a></li>
												</ul>
											</div>
										</div>
									</div>
								@endif

                                @if( $p == 'all' )
                                	<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseUser" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="splashy-contact_blue"></i> User
											</a>
										</div>

										<div class="accordion-body collapse" id="collapseUser">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li><a href="{{ URL::to('user') }}">Manajemen User</a></li>
												</ul>
											</div>
										</div>
									</div>
                                @endif

								</div>
							</div>
							   
						</div>
					</div>
				</div>