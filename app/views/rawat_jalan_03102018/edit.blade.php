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
        					<a href="{{ action('DashboardController@index') }}">Pendaftaran</a>
        				</li>
        				<li>
        					Rawat Jalan
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Pendaftaran Rawat Jalan
                        <div style="float:right;" class="">
                            <button class="btn btn-warning btn-top" data-toggle="modal" data-target="#cari_pasien"><i class="splashy-zoom"></i> Cari Pasien</button>
                            <button class="btn btn-success btn-top" id="btn_pasien_baru"><i class="splashy-contact_grey_add"></i> Input Pasien Baru</button>
                            <button type="button" id="btn_reset_data" class="btn btn-top"><i class="splashy-arrow_state_grey_left"></i> Reset Data</button>
                        </div>
                    </h3>
	        		@if( $errors->first('txt2_nama') || $errors->first('txt2_tanggal_masuk') )
	        			<div class="alert alert-error">
							<a class="close" data-dismiss="alert">×</a>
							{{ $errors->first('txt2_nama') }}
							{{ $errors->first('txt2_tanggal_masuk') }}
						</div>
	        		@endif
                    <?php $success = Session::get('success'); ?>
                    @if( $success )
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif

                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#pasientab" data-toggle="tab">Pasien</a></li>
                            <li><a href="#penjabtab" data-toggle="tab">Penanggung Jawab</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="pasientab">
                                <div class="row-fluid formSep">
                                    <div class="span6"> 
                	        			<div class="control-group">
                                            <label class="control-label">No RM</label>
                                            <div class="controls">
                                                <input type="text" id="no_rm" class="span10" maxlength="6">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nama Lengkap</label>
                                            <div class="controls">
                                                <input type="text" id="txt_nama" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Jenis Kelamin</label>
                                            <div class="controls">
                                                <select id="cmb_jenkel" class="no-primary">
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tempat Lahir</label>
                                            <div class="controls">
                                                <input id="txt_tempat_lahir" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Tanggal Lahir</label>
                                            <div class="controls">
                                                <input id="txt_tanggal_lahir" type="text" class="span10 no-primary tanggal">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Suku</label>
                                            <div class="controls">
                                                <input id="txt_suku" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Agama</label>
                                            <div class="controls">
                                                <select id="cmb_agama" class="no-primary">
                                                    <option>-</option>
                                                    <option>Islam</option>
                                                    <option>Protestan</option>
                                                    <option>Katolik</option>
                                                    <option>Hindu</option>
                                                    <option>Budha</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Pekerjaan</label>
                                            <div class="controls">
                                                <input id="txt_pekerjaan" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Status</label>
                                            <div class="controls">
                                                <select id="cmb_status" class="no-primary">
                                                    <option>-</option>
                                                    <option>Kawin</option>
                                                    <option>Belum Kawin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        
                                        <div class="control-group">
                                            <label class="control-label">Alamat</label>
                                            <div class="controls">
                                                <input id="txt_alamat" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Kelurahan</label>
                                            <div class="controls">
                                                <input id="txt_kelurahan" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Kecamatan</label>
                                            <div class="controls">
                                                <input id="txt_kecamatan" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Kota</label>
                                            <div class="controls">
                                                <input id="txt_kota" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Provinsi</label>
                                            <div class="controls">
                                                <input id="txt_provinsi" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">No Telp (Rumah / HP)</label>
                                            <div class="controls">
                                                <input id="txt_no_telp" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Golongan Pasien</label>
                                            <div class="controls">
                                                <select id="cmb_golongan_pasien" class="no-primary">
                                                    <option value="">-</option>
                                                    <option>BPJS</option>
                                                    <option>Swasta</option>
                                                    <option>Jamkesda</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Sub Golongan Pasien</label>
                                            <div class="controls">
                                                <select id="cmb_sub_golongan" class="no-primary">
                                                    <option value="">-</option>
                                                    <option value="Askes">Askes</option>
                                                    <option value="Dinas">Dinas</option>
                                                    <option value="BPJS Mandiri">BPJS Mandiri</option>
                                                    <option value="Jamkesmas">Jamkesmas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="askes_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">Golongan Askes</label>
                                                <div class="controls">
                                                    <select id="cmb_askes_golongan" class="no-primary">
                                                        <option value="">-</option>
                                                        <option value="Kemhan">Kemhan</option>
                                                        <option value="Non Kemhan">Non Kemhan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">No Kartu</label>
                                                <div class="controls">
                                                    <input id="txt_askes_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="dinas_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">Penggolongan Dinas</label>
                                                <div class="controls">
                                                    <select id="cmb_dinas_golongan" class="no-primary">
                                                        <option value="">-</option>
                                                        <option>TNI AD</option>
                                                        <option>TNI AU</option>
                                                        <option>TNI AL</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Hubungan</label>
                                                <div class="controls">
                                                    <select id="cmb_dinas_hubungan" class="no-primary">
                                                        <option value="">-</option>
                                                        <option>Militer</option>
                                                        <option>PNS</option>
                                                        <option>Keluarga</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Jenis Hubungan</label>
                                                <div class="controls">
                                                    <select id="cmb_dinas_jenis_hubungan" class="no-primary">
                                                        <option value="">-</option>
                                                        <option>Anak</option>
                                                        <option>Suami</option>
                                                        <option>Istri</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Pangkat / Golongan</label>
                                                <div class="controls">
                                                    <select id="cmb_dinas_pangkat" class="no-primary">
                                                        <option value="">-</option>
                                                        <option>Prada</option>
                                                        <option>Pratu</option>
                                                        <option>Praka</option>
                                                        <option>Kopda</option>
                                                        <option>Koptu</option>
                                                        <option>Kopka</option>
                                                        <option>Serda</option>
                                                        <option>Sertu</option>
                                                        <option>Serka</option>
                                                        <option>Serma</option>
                                                        <option>Pelda</option>
                                                        <option>Peltu</option>
                                                        <option>Letda</option>
                                                        <option>Lettu</option>
                                                        <option>Kapten</option>
                                                        <option>Mayor</option>
                                                        <option>Letkol</option>
                                                        <option>Kolonel</option>
                                                        <option>I/A</option>
                                                        <option>I/B</option>
                                                        <option>I/C</option>
                                                        <option>I/D</option>
                                                        <option>II/A</option>
                                                        <option>II/B</option>
                                                        <option>II/C</option>
                                                        <option>II/D</option>
                                                        <option>III/A</option>
                                                        <option>III/B</option>
                                                        <option>III/C</option>
                                                        <option>III/D</option>
                                                        <option>IV/A</option>
                                                        <option>IV/B</option>
                                                        <option>IV/C</option>
                                                        <option>IV/D</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">NRP / NIP</label>
                                                <div class="controls">
                                                    <input id="txt_dinas_nip" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Golongan Kesatuan</label>
                                                <div class="controls">
                                                    <select id="cmb_golongan_kesatuan">
                                                        <option value="">-</option>
                                                        <option>Sat Ops</option>
                                                        <option>Sat Lain</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Kesatuan</label>
                                                <div class="controls">
                                                    <input id="txt_dinas_kesatuan" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">No Kartu BPJS</label>
                                                <div class="controls">
                                                    <input id="txt_dinas_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="mandiri_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">No Kartu</label>
                                                <div class="controls">
                                                    <input id="txt_mandiri_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="jamkesmas_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">No Kartu</label>
                                                <div class="controls">
                                                    <input id="txt_jamkesmas_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="jamkesda_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">No Kartu</label>
                                                <div class="controls">
                                                    <input id="txt_jamkesda_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="swasta_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">Golongan Swasta</label>
                                                <div class="controls">
                                                    <select id="cmb_swasta_golongan" class="no-primary">
                                                        <option value="">-</option>
                                                        <option value="Rekanan">Rekanan</option>
                                                        <option value="Umum">Umum</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Nama Perusahaan</label>
                                                <div class="controls">
                                                    <select id="cmb_perusahaan" class="no-primary">
                                                        <option>-</option>
                                                        <option>Nayaka</option>
                                                        <option>In Health</option>
                                                        <option>Gandum</option>
                                                        <option>Krebet</option>
                                                        <option>Molindo</option>
                                                        <option>Indolacto</option>
                                                        <option>Bringin Live</option>
                                                        <option>PT. KAI</option>
                                                        <option>PT. Cakra/Pindad</option>
                                                        <option>PG Krebet</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">No Kartu</label>
                                                <div class="controls">
                                                    <input id="txt_swasta_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="penjabtab">
                                <div class="row-fluid">
                                    <div class="span6"> 
                                        <div class="control-group">
                                            <label class="control-label">Nama</label>
                                            <div class="controls">
                                                <input type="text" id="jab_nama" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Jenis Kelamin</label>
                                            <div class="controls">
                                                <select id="jab_jenkel" class="no-primary">
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Pekerjaan</label>
                                            <div class="controls">
                                                <input id="jab_pekerjaan" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Hubungan dengan pasien</label>
                                            <div class="controls">
                                                <input id="jab_hubungan" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        
                                        <div class="control-group">
                                            <label class="control-label">Alamat</label>
                                            <div class="controls">
                                                <input id="jab_alamat" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Kelurahan</label>
                                            <div class="controls">
                                                <input id="jab_kelurahan" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Kecamatan</label>
                                            <div class="controls">
                                                <input id="jab_kecamatan" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Kota</label>
                                            <div class="controls">
                                                <input id="jab_kota" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Provinsi</label>
                                            <div class="controls">
                                                <input id="jab_provinsi" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">No Telp (Rumah / HP)</label>
                                            <div class="controls">
                                                <input id="jab_no_telp" type="text" class="span10 no-primary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <button type="button" id="btn_pasien_rawat" class="btn btn-primary no-primary"><i class="splashy-check"></i> Masuk Rawat Inap</button>
                            <button type="button" id="btn_update" class="btn btn-success no-primary"><i class="splashy-calendar_month_edit"></i> Update Data Pasien</button>
                            <button type="button" id="btn_hapus" class="btn btn-danger no-primary"><i class="splashy-error_x"></i> Hapus Pasien</button>
                        </div>
                    </div>
					{{ Form::close() }}

                    {{ Form::open(array('action' => 'RawatJalanController@store' , 'id'=>'reg2_form', 'class' => 'form-horizontal' , 'style' => 'display:none')) }}
                    <div class="row-fluid">
                        <div class="span6"> 
                            <div class="control-group">
                                <label class="control-label">ID Register</label>
                                <div class="controls">
                                    <input id="txt2_id_register" type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input id="txt2_nama" name="txt2_nama" type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tempat Lahir</label>
                                <div class="controls">
                                    <input id="txt2_tempat_lahir" name="txt2_tempat_lahir" type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input id="txt2_tanggal_masuk" name="txt2_tanggal_masuk" type="text" class="span10 tanggal">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jam Masuk</label>
                                <div class="controls">
                                    <input id="txt2_jam_masuk"  name="txt2_jam_masuk" type="text" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Poli</label>
                                <div class="controls">
                                    <select data-placeholder="Pilih Poli" id="cmb2_poli" name="cmb2_poli" class="chzn_a">
                                        @foreach($poli as $u => $s)
                                            <option value="{{ $s->IdPoli }}">
                                                {{ $s->NamaPoli }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Pengunjung</label>
                                <div class="controls">
                                    <select id="cmb2_pengunjung" name="cmb2_pengunjung">
                                        <option>Baru</option>
                                        <option>Lama</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Kunjungan</label>
                                <div class="controls">
                                    <select id="cmb2_kunjungan" name="cmb2_kunjungan">
                                        <option>Baru</option>
                                        <option>Lama</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Keterangan</label>
                                <div class="controls">
                                    <textarea id="txt2_keterangan" name="txt2_keterangan" class=" span10"></textarea>
                                </div>
                            </div>                            
                            <input type="hidden" id="txt2_no_rm" name="txt2_no_rm" />
                            <div id="hidden_fields">
                                
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" id="btn_batal" class="btn">Batal</button>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <h4>Riwayat Pasien</h4>
                            <table id="tbl_history_pasien" class="table table-striped table-bordered table-hover">
                                <colgroup>
                                    <col class="con1" />
                                    <col class="con2" />
                                    <col class="con3" />
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th align="center" valign="middle" class="head1">No Reg</th>
                                        <th align="center" valign="middle" class="head2">Tanggal</th>
                                        <th align="center" valign="middle" class="head4">Poli</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4">Tidak ada riwayat yang ditampilkan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ Form::close() }}
	        	</div>
        	</div>
            <!-- Modal -->
            <div class="modal hide fade modal-admin" id="cari_pasien" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                        <table id="tbl_pasien" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                                <col class="con5" />
                                <col class="con6" />
                                <col class="con7" />
                                <col class="con7" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Jkel</th>
                                    <th align="center" valign="middle" class="head4">TempatLahir</th>
                                    <th align="center" valign="middle" class="head5">TanggalLahir</th>
                                    <th align="center" valign="middle" class="head6">Jalan</th>
                                    <th align="center" valign="middle" class="head7">NoBPJS</th>
                                    <th align="center" valign="middle" class="head7">NRP NIP</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                // dynamic table
                                oTable = jQuery('#tbl_pasien').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                    "sPaginationType": "full_numbers",
                                    "bProcessing": false,
                                    "sAjaxSource": "{{ url('pasien/datatable') }}",
                                    "bServerSide": true
                                
                                });
                            // custom values are available via $values array
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
		</div>
	</div>
@stop

@section('js')
	@parent
	{{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('lib/datepicker/bootstrap-datepicker.min.js') }}
    @include('js/rawat_jalan_register')
@stop
