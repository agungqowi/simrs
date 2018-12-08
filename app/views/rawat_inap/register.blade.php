@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
    {{ HTML::style('css/custom-theme/jquery-ui-1.10.0.custom.css') }}
    {{ HTML::script('lib/printlabel/jsLabel2PDF.js') }}
    {{ HTML::script('lib/printlabel/external/base64.js') }}
    {{ HTML::script('lib/printlabel/external/sprintf.js') }}
@stop

@section('content')
	<div id="contentwrapper">
		<div class="main_content">
			<nav style="display:none">
        		<div id="jCrumbs" class="breadCrumb module">
        			<ul>
        				<li>
        					<a href="{{ action('DashboardController@index') }}"><i class="icon-home"></i></a>
        				</li>
        				<li>
        					<a href="{{ action('DashboardController@index') }}">Pendaftaran</a>
        				</li>
        				<li>
        					Rawat Inap
        				</li>
        			</ul>
        		</div>
        	</nav>

        	<div class="row-fluid">
	        	<div class="span12">
	        		<h3 class="heading">Pendaftaran Rawat Inap
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
                        <div id="success_alert" class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif

                    <?php $salah = Session::get('salah'); ?>
                    @if( $salah )
                        <div class="alert alert-error">
                            {{ $salah }}
                        </div>
                    @endif
                
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid">
                        <div style="float:right;" class="span7"> 
                            <div class="control-group">
                                <label class="control-label">Cari Berdasarkan No RM</label>
                                <div class="controls">
                                    <input type="text" id="no_cari" class="span10">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabbable">
                        <h4 align="center">Data Pasien</h4><br />
                        <div class="tab-content">
                            <div class="tab-pane active" id="pasientab">
                                <div class="row-fluid formSep">
                                    <div class="span6"> 
                	        			<div class="control-group">
                                            <label class="control-label">No RM</label>
                                            <div class="controls">
                                                <input type="text" id="no_rm" class="span5" readonly>
                                                <input type="checkbox" id="manual" name="manual" value="manual"> Manual
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Nama Lengkap</label>
                                            <div class="controls">
                                                <input type="text" id="txt_nama" class="span10 no-primary">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">No KTP</label>
                                            <div class="controls">
                                                <input type="text" id="txt_no_ktp" class="span10 no-primary">
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
                                                <select id="cmb_tanggal_lahir" name="cmb_tanggal_lahir" class="span2 no-primary" style="float:left">
                                                    @for($i=1;$i<=31;$i++)
                                                        <?php
                                                            if(strlen($i) < 2)
                                                                $j = "0".$i;
                                                            else
                                                                $j = $i;
                                                        ?>
                                                        @if($i == 29)
                                                            <option class="nonfeb kabisat" value="{{ $j }}">{{ $j }}</option>
                                                        @elseif($i == 30)
                                                            <option class="nonfeb" value="{{ $j }}">{{ $j }}</option>
                                                        @elseif($i == 31)
                                                            <option class="nonfeb maxdate" value="{{ $j }}">{{ $j }}</option>
                                                        @else
                                                            <option value="{{ $j }}">{{ $j }}</option>
                                                        @endif
                                                    @endfor
                                                    
                                                </select>
                                                <select id="cmb_bulan_lahir" name="cmb_bulan_lahir" class="span4 no-primary" style="float:left">
                                                    <?php
                                                        $bulan  = array(
                                                                        '01' => 'Januari' ,
                                                                        '02' => 'Februari' ,
                                                                        '03' => 'Maret' ,
                                                                        '04' => 'April' ,
                                                                        '05' => 'Mei' ,
                                                                        '06' => 'Juni' ,
                                                                        '07' => 'Juli' ,
                                                                        '08' => 'Agustus' ,
                                                                        '09' => 'September' ,
                                                                        '10' => 'Oktober' ,
                                                                        '11' => 'November' ,
                                                                        '12' => 'Desember'

                                                        );
                                                    ?>
                                                    @foreach($bulan as $b => $u)
                                                        <option value="{{ $b }}">{{ $u }}</option>
                                                    @endforeach
                                                </select>
                                                <select id="cmb_tahun_lahir" name="cmb_tahun_lahir" class="span3 no-primary" style="float:left;">
                                                    <?php $start    = intval( date('Y') ) - 110 ; ?>
                                                    <?php $tengah   = intval( date('Y') ) - 40 ; ?>
                                                    <?php $sampai   = intval( date('Y') ) ; ?>
                                                    @for($i=$sampai;$i>=$start;$i-- )
                                                        @if($i == $tengah)
                                                            <option selected="selected" value="{{ $i }}">{{ $i }}</option>
                                                        @else
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endif
                                                    @endfor
                                                </select>
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
                                                    <option>Cerai</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Pendidikan</label>
                                            <div class="controls">
                                                <select id="cmb_pendidikan" class="no-primary">
                                                    <option>-</option>
                                                    <option>SD</option>
                                                    <option>SMP</option>
                                                    <option>SMA</option>
                                                    <option>D1</option>
                                                    <option>D3</option>
                                                    <option>S1</option>
                                                    <option>S2</option>
                                                    <option>S3</option>
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
                                            <label class="control-label">Jaminan Pasien</label>
                                            <div class="controls">
                                                <select id="cmb_golongan_pasien" class="no-primary">
                                                    <option value="">-</option>
                                                    <option>BPJS</option>
                                                    <option>Umum</option>
                                                    <option>Rekanan</option>
                                                    <option>Asuransi Swasta</option>
                                                    <option>KIS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Sub Golongan Pasien</label>
                                            <div class="controls">
                                                <select id="cmb_sub_golongan" class="no-primary">
                                                    <option value="">-</option>
                                                    <option value="Dinas">Dinas</option>
                                                    <option value="BPJS Mandiri">BPJS Mandiri</option>
                                                    <option value="PBI">PBI</option>
                                                    <option value="BPJS Ketenagakerjaan">BPJS Ketenagakerjaan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group bpjs-group">
                                            <label class="control-label">Kelas BPJS</label>
                                            <div class="controls">
                                                <select id="cmb_kelas_bpjs" class="no-primary">
                                                    <option value="">-</option>
                                                    <option value="Kelas 1">Kelas 1</option>
                                                    <option value="Kelas 2">Kelas 2</option>                                                    
                                                    <option value="Kelas 3">Kelas 3</option>
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

                                        <div id="rekanan_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">Nama Perusahaan</label>
                                                <div class="controls">
                                                    <select id="cmb_perusahaan" class="no-primary">
                                                        <?php $rekanan = DB::table('tbrekanan')->get(); ?>
                                                        <option>-</option>
                                                        @if(isset($rekanan) && count($rekanan) > 0)
                                                            @foreach($rekanan as $r)
                                                                 <option value="{{ $r->id }}">{{ $r->nama_rekanan }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">No Kartu</label>
                                                <div class="controls">
                                                    <input id="txt_rekanan_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="asuransi_group" class="sub-group">
                                            <div class="control-group">
                                                <label class="control-label">Nama Asuransi</label>
                                                <div class="controls">
                                                    <select id="cmb_perusahaan" class="no-primary">
                                                        <?php $asuransi = DB::table('tbasuransi')->get(); ?>
                                                        <option>-</option>
                                                        @if(isset($asuransi) && count($asuransi) > 0)
                                                            @foreach($asuransi as $as)
                                                                 <option value="{{ $as->id }}">{{ $as->nama_asuransi }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">No Kartu</label>
                                                <div class="controls">
                                                    <input id="txt_asuransi_kartu" type="text" class="span10 no-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 align="center">Data Penanggung Jawab</h4><br />
                        <div class="row-fluid formSep">
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">Nama</label>
                                    <div class="controls">
                                        <input type="text" id="NamaPJ" class="span10 no-primary">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Alamat</label>
                                    <div class="controls">
                                        <textarea id="AlamatPJ" class="span10 no-primary"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label">Hubungan dengan Pasien</label>
                                    <div class="controls">
                                        <select id="HubPJ" name="HubPJ" class="no-primary">
                                            <option value="">-</option>
                                            <option>Suami</option>
                                            <option>Istri</option>
                                            <option>Ayah</option>
                                            <option>Ibu</option>
                                            <option>Anak</option>
                                            <option>Saudara Kandung</option>
                                            <option>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Telp</label>
                                    <div class="controls">
                                        <input type="text" id="TelpPJ" class="span10 no-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <button type="button" id="btn_pasien_rawat" class="btn btn-primary no-primary"><i class="splashy-check"></i> Registrasi Rawat Inap</button>
                            <button type="button" id="btn_update" class="btn btn-success no-primary"><i class="splashy-calendar_month_edit"></i> Update Data Pasien</button>
                            <button type="button" id="btn_riwayat" class="btn btn-success" disabled="disabled"><i class="splashy-printer"></i> Riwayat SEP</button>
                            <button type="button" id="btn_hapus" class="btn btn-danger no-primary"><i class="splashy-error_x"></i> Hapus Pasien</button>
                        </div>
                    </div>
					{{ Form::close() }}

                    {{ Form::open(array('action' => 'RawatInapController@store' , 'id'=>'reg2_form', 'class' => 'form-horizontal' , 'style' => 'display:none')) }}
                    
                        
                    <div class="row-fluid">
                        <div class="span7"> 
                            <div class="control-group" style="display:none;">
                                <label class="control-label">ID Register</label>
                                <div class="controls">
                                    <input id="txt2_id_register" type="text" class="span7">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input id="txt2_no_rm" name="txt2_no_rm" type="text" class="span10" readonly>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">No Register Poli</label>
                                <div class="controls">
                                    <input id="txt2_id_register_poli" name="txt2_id_register_poli" type="text" class="" disabled="disabled">
                                    <button type="button" id="btn_poli" class="btn btn-warning" data-toggle="modal" data-target="#cari_pasien_poli"><i class="splashy-zoom"></i> Cari</button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input id="txt2_nama" name="txt2_nama" type="text" class="span10" readonly>
                                </div>
                            </div>
                            <div class="control-group bpjs">
                                <label class="control-label">No Rujukan</label>
                                <div class="controls">
                                    <input id="no_rujukan" name="no_rujukan" type="text" class="span8" >
                                </div>
                            </div>
                            <div class="control-group bpjs">
                                <label class="control-label">Tanggal Rujukan</label>
                                <div class="controls">
                                    <input id="tanggal_rujukan" name="tanggal_rujukan" type="text" class="span8 nowdate">
                                </div>
                            </div>
                            <div class="control-group bpjs">
                                <label class="control-label">PPK Rujukan</label>
                                <div class="controls">
                                    <input type="text" id="ppk_rujukan" name="ppk_rujukan" class="span8 no-primary">
                                    <input type="hidden" id="id_ppk_rujukan" name="id_ppk_rujukan" class="span10 no-primary">
                                    <button class="btn btn-warning" id="btn_rujukan" type="button"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input id="txt2_tanggal_masuk" name="txt2_tanggal_masuk" type="text" class="span8 nowdate">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jam Masuk</label>
                                <div class="controls">
                                    <input id="txt2_jam_masuk"  name="txt2_jam_masuk" type="text" class="span8">
                                </div>
                            </div>
                            <div class="control-group bpjs">
                                <label class="control-label">Diagnosa Awal</label>
                                <div class="controls">
                                    <input type="text" id="diagnosa" name="diagnosa" class="span8 no-primary">
                                    <input type="hidden" id="id_diagnosa" name="id_diagnosa" class="span10 no-primary">
                                    <button class="btn btn-warning" id="btn_diagnosa" type="button"><i class="splashy-zoom"></i></button>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cara Bayar</label>
                                <div class="controls">
                                    <select id="cmb_cara_bayar" name="cmb_cara_bayar" class="no-primary">
                                        <option value="">-</option>
                                        <option>BPJS</option>
                                        <option>Umum</option>
                                        <option>Asuransi Swasta</option>
                                        <option>KIS</option>
                                        @if(isset($rekanan) && count($rekanan) > 0)
                                            @foreach($rekanan as $r)
                                                <option value="{{ $r->nama_rekanan }}">{{ $r->nama_rekanan }}</option>
                                            @endforeach
                                        @endif

                                        @if(isset($asuransi) && count($asuransi) > 0)
                                            @foreach($asuransi as $as)
                                                <option value="{{ $as->nama_asuransi }}">{{ $as->nama_asuransi }}</option>
                                            @endforeach
                                        @endifion>
                                        <option>Jamkesda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" style="display:none;">
                                <label class="control-label">Tempat Lahir</label>
                                <div class="controls">
                                    <input id="txt2_tempat_lahir" name="txt2_tempat_lahir" type="text" class="span8">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Dokter</label>
                                <div class="controls">
                                    <select data-placeholder="Pilih Dokter" id="cmb2_dokter" name="cmb2_dokter" class="chzn_a">
                                        <option value="">-</option>
                                        @foreach($dokter as $d => $da)
                                            <option value="{{ $da->IdDokter }}">
                                                {{ $da->NamaDokter }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ruangan</label>
                                <div class="controls">
                                    <select data-placeholder="Pilih Ruangan" id="cmb2_ruangan" name="cmb2_ruangan" class="chzn_a">
                                    @if(count( $ruangan) > 0 ) 
                                        @foreach($ruangan as $u => $s)
                                            <option value="{{ $s->IdRuang }}">
                                                {{ $s->NamaRuangan.'--'.$s->NamaKelas.'--' }} No Kamar. {{ $s->NoKamar }} No TT. {{ $s->NoTT }} 
                                            </option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Keterangan</label>
                                <div class="controls">
                                    <textarea id="txt2_keterangan" name="txt2_keterangan" class=" span8"></textarea>
                                </div>
                            </div>
                            <div class="control-group sep">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <input type="checkbox" name="chk_sep" id="chk_sep" value="yes"> Buat Nomor SEP
                                </div>
                            </div>
                            <br />                        
                            <input type="hidden" id="no_kartu" name="no_kartu" />                           
                            <input type="hidden" id="jenis_pelayanan" name="jenis_pelayanan" value="1" />                           
                            <input type="hidden" id="buat_sep" name="buat_sep" value="yes" />
                            <input type="hidden" id="id_ppk_pelayanan" name="id_ppk_pelayanan" class="span10 no-primary" value="{{ Config::get('settings.id_ppk_pelayanan'); }}">
                            <input type="hidden" id="ppk_pelayanan" name="ppk_pelayanan" class="span10 no-primary" value="{{ Config::get('settings.ppk_pelayanan'); }}">
                            <div id="hidden_fields">
                                
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" id="btn_daftar" class="btn btn-primary">Daftar</button>
                                    <button type="button" id="btn_batal" class="btn">Batal</button>
                                    <a href="" disabled="disabled" id="btn_cetak" class="btn btn-warning">Cetak SEP</a>
                                    <a href="{{ url('rawat_inap/register') }}" disabled="disabled" id="btn_baru" class="btn btn-warning">Tambah baru</a> <br /><br />
                                    <button type="button" id="btn_cetak1" class="btn btn-primary no-primary"><i class="splashy-printer"></i> Cetak Label</button>
                                    <button type="button" id="btn_cetak2" class="btn btn-success no-primary"><i class="splashy-printer"></i> Cetak label Map</button>    
                                    <button type="button" id="btn_cetak3" disabled="disabled" class="btn btn-success"><i class="splashy-printer" ></i> Cetak struck</button>                          
                                </div>
                            </div>
                            <div class="control-group formSep">
                                <div>
                                   
                                </div>
                            </div>

                            <div id="pesan_error" class="alert alert-info" style="display:none;font-weight:bold;"></div>
                        </div>
                        <div class="span5">
                            <div id="info_bjps">
                                <h4>Info BPJS</h4>
                                <div>

                                </div>
                                <br /><br />
                            </div>
                            <h4>Riwayat Pasien</h4>
                            <table id="tbl_history_pasien" class="scroll-table  table table-striped table-bordered table-hover">
                                <colgroup>
                                    <col class="con1" />
                                    <col class="con2" />
                                    <col class="con3" />
                                    <col class="con4" />
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th align="center" valign="middle" class="head1">No Reg</th>
                                        <th align="center" valign="middle" class="head2">Tanggal</th>
                                        <th align="center" valign="middle" class="head3">Ruangan</th>
                                        <th align="center" valign="middle" class="head4"></th>
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
                                <col class="con8" />
                                <col class="con9" />
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
                                    <th align="center" valign="middle" class="head7">Gol</th>
                                    <th align="center" valign="middle" class="head7">NoBPJS</th>
                                    <th align="center" valign="middle" class="head7">No KTP</th>
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
                                    "bServerSide": true,
                                    "fnInitComplete": function() {
                                        $("#tbl_pasien_filter input").focus();
                                    }
                                
                                });
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

            <div class="modal hide fade modal-admin" id="cari_pasien_poli" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Registrasi Poli</h4>
                    </div>
                    <div class="modal-body">
                       <table id="tbl_pasien_poli" class="table table-striped table-bordered table-hover">
                            <colgroup>
                                <col class="con0" />
                                <col class="con1" />
                                <col class="con2" />
                                <col class="con3" />
                                <col class="con4" />
                                <col class="con5" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th align="center" valign="middle" class="head0">Pilih</th>
                                    <th align="center" valign="middle" class="head1">No Reg</th>
                                    <th align="center" valign="middle" class="head1">NoRM</th>
                                    <th align="center" valign="middle" class="head2">Nama</th>
                                    <th align="center" valign="middle" class="head3">Tanggal masuk</th>
                                    <th align="center" valign="middle" class="head4">Poli</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
            <!-- end modal -->
        </div>
	</div>

    <div class="modal hide fade modal-admin" id="cari_rujukan" tabindex="-1" role="dialog" aria-labelledby="cari_rujukanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_rujukanLabel">Daftar PPK Rujukan</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_rujukan" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">Pilih</th>
                                <th align="center" valign="middle" class="head2">Kode Provider</th>
                                <th align="center" valign="middle" class="head3">Nama Provider</th>
                                <th align="center" valign="middle" class="head4">Alamat</th>
                                <th align="center" valign="middle" class="head5">Kota/ Kabupaten</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_rujukan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/ppkRujukanSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_rujukan_filter input").focus();
                                }
                                
                            });
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal hide fade modal-admin" id="cari_pelayanan" tabindex="-1" role="dialog" aria-labelledby="cari_pelayananLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_pelayananLabel">Daftar PPK Pelayanan</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_pelayanan" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                            <col class="con4" />
                            <col class="con5" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">Pilih</th>
                                <th align="center" valign="middle" class="head2">Kode Provider</th>
                                <th align="center" valign="middle" class="head3">Nama Provider</th>
                                <th align="center" valign="middle" class="head4">Alamat</th>
                                <th align="center" valign="middle" class="head5">Kota/ Kabupaten</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <script type="text/javascript">
                     /*   jQuery(document).ready(function(){
                            oTable = $('#tbl_pelayanan').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/ppkPelayananSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_pelayanan_filter input").focus();
                                }
                                
                            });
                        }); */
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal hide fade modal-admin" id="cari_diagnosa" tabindex="-1" role="dialog" aria-labelledby="cari_diagnosaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="cari_diagnosaLabel">Daftar Diagnosa Awal</h4>
                </div>
                <div class="modal-body">
                    <table id="tbl_diagnosa" class="table table-striped table-bordered table-hover">
                        <colgroup>
                            <col class="con1" />
                            <col class="con2" />
                            <col class="con3" />
                        </colgroup>
                        <thead>
                            <tr>
                                <th align="center" valign="middle" class="head1">Pilih</th>
                                <th align="center" valign="middle" class="head2">Kode Diagnosa</th>
                                <th align="center" valign="middle" class="head3">Deskripsi Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            oTable = $('#tbl_diagnosa').dataTable({
                                    "language": {
                                        "url": "{{ url('js/Indonesian.json') }}"
                                    },
                                "sPaginationType": "full_numbers",
                                "bProcessing": false,
                                "sAjaxSource": "{{ url('sep/rujukan/diagnosaSearch') }}",
                                "bServerSide": true,
                                "fnInitComplete": function() {
                                   $("#tbl_diagnosa_filter input").focus();
                                }
                                
                            });
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div style="display:none">
        <div id="print1" align="center">

        </div>
        <div id="print2" align="center">

        </div>
        <div id="print3" align="center">

        </div>
        <div id="print4" align="center">

        </div>

    </div>
@stop

@section('js')
	@parent
	{{ HTML::script('lib/tiny_mce/jquery.tinymce.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
    {{ HTML::script('lib/datepicker/bootstrap-datepicker.min.js') }}
    @include('js/rawat_inap_register')
@stop
