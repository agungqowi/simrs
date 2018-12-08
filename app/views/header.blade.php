            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <ul class="nav user_menu pull-right">
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ url('img/user_avatar.png') }}" alt="" class="user_avatar" /> {{ $user->name }} <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
										<li><a href="{{ url('logout') }}">Log Out</a></li>
                                    </ul>
                                </li>
                            </ul>
							<ul class="nav" id="mobile-nav">
                                <li>
                                    <a href="{{ URL::to('dashboard') }}">
                                        <i class="splashy-home_green"></i> SIM RS
                                    </a>
                                </li>
                                <?php
                                    if(isset($group->slug)){
                                        $slug = $group->slug;
                                    }
                                    else{
                                        $slug = "";
                                    }
                                    
                                    if(isset($group->permissions)){
                                        $p= json_decode( $group->permissions );
                                    }
                                    else{
                                        $p = array();
                                    }

                                    if( empty($p) )
                                        $p = array();

                                    if( count($p) == 0 && $slug == 'admin'){
                                        $lists = DB::table('tbmenu')->get();
                                        if(isset($lists) && count($lists) > 0){
                                            $p = array();
                                            foreach($lists as $li){
                                                $p[] = $li->role;
                                            }
                                        }
                                    }
                                    
                                ?>

                                <?php $menus = DB::table('tbmenu')->where('parent' , 0)->where('menu_atas' , 1)->orderBy('urutan','ASC')->get(); ?>
                                
                                @if(isset($menus) && count($menus) > 0)

                                    @foreach($menus as $m)
                                        @if(in_array($m->role , $p))
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                    <i class="{{ $m->icon }}"></i> {{ $m->nama_menu }} <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <?php $subs = DB::table('tbmenu')->where('parent' , $m->id)->where('status' , 1)->orderBy('urutan','ASC')->get(); ?>
                                                    @if(isset($subs) && count($subs) > 0)
                                                        @foreach($subs as $s)
                                                            @if(in_array($s->role , $p))
                                                                <li>
                                                                    <a href="{{ url($s->url) }}"><i class="{{ $s->icon }}"></i> 
                                                                        {{ $s->nama_menu }} 
                                                                        <?php $subs2 = DB::table('tbmenu')->where('parent' , $s->id)->orderBy('urutan','ASC')->get(); ?>
                                                                        @if( count($subs2) > 0)
                                                                            <b class="caret-right"></b>
                                                                        @endif
                                                                    </a>
                                                                    @if( count($subs2) > 0)
                                                                        <ul class="dropdown-menu">
                                                                        @foreach($subs2 as $sc)
                                                                                <li>
                                                                                    <a href="{{ url($sc->url) }}"><i class="{{ $sc->icon }}"></i> 
                                                                                        {{ $sc->nama_menu }} 
                                                                                    </a>
                                                                                </li>
                                                                        @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif

                                <?php $p = 'all'; ?>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <i class="splashy-documents_new"></i> Laporan <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'pasien_jalan') !== FALSE  )
                                            <li><a href="javascript:void(0)">Rawat Jalan<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('report/rawat_jalan') }}">Lap Pasien Rawat Jalan</a></li>
                                                    <li><a href="{{ url('report/poli_bulan') }}">Lap Rekap Bulanan</a></li>
                                                    <!--
                                                    <li><a href="{{ url('report/tanggal/morbiditas') }}">Morbiditas</a></li>
                                                    -->
                                                </ul>
                                            </li>
                                        @endif


                                        @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'pasien_inap') !== FALSE  )
                                            <li><a href="javascript:void(0)">Rawat Inap<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('report/tanggal_inap/rincian_rawat_inap') }}">Rincian Rawat Inap</a></li>
                                                    <li><a href="{{ url('report/pasien_ruangan') }}">Pasien di Ruangan</a></li>
                                                    <li><a href="{{ url('report/rekap_golongan/rawat_inap') }}">Rekap Golongan Pasien</a></li>
                                                </ul>
                                            </li>
                                        @endif

                                        @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'pasien_ugd') !== FALSE  )
                                            <li style="display:none;"><a href="javascript:void(0)">UGD<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('report/ugd') }}">Pasien UGD</a></li>
                                                    <li><a href="{{ url('report/rekap_golongan/ugd') }}">Rekap Golongan Pasien</a></li>
                                                </ul>
                                            </li>
                                        @endif

                                            <li><a href="javascript:void(0)">Diagnosis<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('report/bulan/penyakit') }}">Lap Penyakit Teratas</a></li>
                                                </ul>
                                            </li>

                                        @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'unit_') !== FALSE  )
                                            <li><a href="javascript:void(0)">Unit<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'unit_hemodialisa') !== FALSE  )
                                                        <li style="display:none;"><a href="{{ url('report/penunjang_tanggal/hemodialisa') }}">Lap Hemodialisa</a></li>
                                                    @endif
                                                    @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'unit_icu') !== FALSE  )
                                                        <li style="display:none;"><a href="{{ url('report/penunjang_tanggal/icu') }}">Lap ICU</a></li>
                                                    @endif
                                                    @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'unit_ok') !== FALSE  )
                                                        <li><a href="{{ url('report/penunjang_tanggal/ok') }}">Lap OK</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif

                                        @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'penunjang_') !== FALSE  )
                                            <li><a href="javascript:void(0)">Penunjang<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'penunjang_lab') !== FALSE )
                                                        <li><a href="{{ url('report/penunjang_tanggal/lab') }}">Laboratorium</a></li>
                                                    @endif
                                                    @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'penunjang_radiologi') !== FALSE )
                                                        <li><a href="{{ url('report/penunjang_tanggal/radiologi') }}">Radiologi</a></li>
                                                    @endif
                                                    @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'penunjang_pa') !== FALSE )
                                                        <li style="display:none;"><a href="{{ url('report/penunjang_tanggal/pa') }}">PA</a></li>
                                                    @endif
                                                    <!--<li><a href="{{ url('penunjang/gizi') }}">Gizi</a></li>-->
                                                    @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'penunjang_fisioterapi') !== FALSE )
                                                        <li style="display:none;"><a href="{{ url('report/penunjang_tanggal/fisioterapi') }}">Fisioterapi</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif


                                        @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'gizi') !== FALSE  )
                                            <li style="display:none;"><a href="{{ url('report/gizi') }}">Unit Gizi</a></li>
                                            <li style="display:none;"><a href="{{ url('report/konsumsi') }}">Makan Pasien</a></li>
                                        @endif
                                        
                                        
                                        @if( $p == 'all' || strpos($p, 'report') !== FALSE || strpos($p, 'apotik_') !== FALSE  )
                                            <li><a href="javascript:void(0)">Stok Obat & Alkes<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('report/stok_obat/apotek_askes') }}">Apotek</a></li>
                                                    <li><a href="{{ url('report/stok_obat/gudang') }}">Gudang</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ url('report/distribusi_obat/gudang') }}">Distribusi Obat & Alkes </a></li>
                                            <li><a href="{{ url('report/retur_obat/apotek_askes') }}">Retur Obat & Alkes </a></li>
                                            <li><a href="{{ url('report/pembelian_obat/gudang') }}">Pembelian Obat & Alkes </a></li>
                                            <li><a href="{{ url('report/penjualan_obat/gudang') }}">Penjualan Obat & Alkes </a></li>
                                            <li><a href="javascript:void(0)">Penjualan Obat Alkes<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ url('report/penjualan_obat/gudang') }}">Per Transaksi</a></li>
                                                    <li><a href="{{ url('report/penjualan_perobat/gudang') }}">Per Obat</a></li>
                                                </ul>
                                            </li>
                                        @endif
                                        <!--
                                        @if($p == 'all')
                                            <li><a href="javascript:void(0)">Jasa Dokter<b class="caret-right"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0)">Rawat Jalan<b class="caret-right"></b></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="{{ url('report/jasa_dokter/rawat_jalan_tanggal') }}">Per Tanggal</a></li>
                                                            <li><a href="{{ url('report/jasa_dokter/rawat_jalan') }}">Per Pasien</a></li>
                                                            <li><a href="{{ url('report/jasa_dokter/rawat_jalan_dokter') }}">Per Dokter</a></li>
                                                        </ul>
                                                    </li>
                                                                
                                                    <li><a href="javascript:void(0)">Rawat Inap<b class="caret-right"></b></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="{{ url('report/jasa_dokter/rawat_inap') }}">Per Pasien</a></li>
                                                            <li><a href="{{ url('report/jasa_dokter/rawat_inap_dokter') }}">Per Dokter</a></li>
                                                        </ul>
                                                    </li>
                                                                
                                                    <li><a href="javascript:void(0)">UGD<b class="caret-right"></b></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="{{ url('report/jasa_dokter/ugd') }}">Per Pasien</a></li>
                                                            <li><a href="{{ url('report/jasa_dokter/ugd_dokter') }}">Per Dokter</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                        
                                        <li><a href="{{ url('report/rawat_inap') }}">Lap Rawat Inap</a></li>
                                        <li><a href="{{ url('report/ugd') }}">Lap UGD</a></li>
                                        <li><a href="{{ url('report/poli') }}">Lap Per Poli</a></li>
                                        -->
                                        <!--
                                        <li><a href="#">Lap Kondisi Pasien</a></li>
                                        -->
                                    </ul>
                                </li>
							</ul>
                        </div>
                    </div>
                </div>
                
            </header>