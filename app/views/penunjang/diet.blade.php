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
                            <a href="{{ action('DashboardController@index') }}">
                                @if(isset($parent))
                                    {{ $parent }}
                                @else
                                    Penunjang
                                @endif
                            </a>
                        </li>
                        <li>
                            @if(isset($title))
                                {{ $title }}
                            @else
                                Gizi
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Form 
                            @if(isset($title))
                                {{ $title }}
                            @else
                                Gizi
                            @endif
                    </h3>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
                        </div>
                    @endif
                    
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <input type="hidden" name="id_reg" id="id_reg" value="" />
                    <input type="hidden" name="id_inap" id="id_inap" value="" />
                    <input type="hidden" name="id_norm" id="id_norm" value="" />
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No RM</label>
                                <div class="controls">
                                    <input type="text" id="no_rm" name="txt_no_rm" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" id="txt_nama" name="txt_nama" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Jenis Kelamin</label>
                                <div class="controls">
                                    <select id="cmb_jenkel" name="cmb_jenkel" class="no-primary">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Masuk</label>
                                <div class="controls">
                                    <input type="text" id="txt_tanggal_masuk" name="txt_tanggal_masuk" class="tanggal span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <div class="controls">
                                    <input type="text" id="txt_tanggal_lahir" name="txt_tanggal_lahir" class="tanggal span10 no-primary">
                                </div>
                            </div>
                            
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">No Registrasi</label>
                                <div class="controls">
                                    <input type="text" id="temp_reg" name="temp_reg" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Alamat</label>
                                <div class="controls">
                                    <textarea id="txt_alamat" name="txt_alamat" class="span10 no-primary"> </textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Golongan Pasien</label>
                                <div class="controls">
                                    <select id="cmb_golongan_pasien" name="cmb_golongan_pasien" class="no-primary">
                                        <option>BPJS</option>
                                        <option>Swasta</option>
                                        <option>Jamkesda</option>
                                    </select>
                                </div>
                            </div>
                            <div id="poli_group" class="control-group opt-group">
                                <label class="control-label">Poli</label>
                                <div class="controls">
                                    <input type="text" id="txt_poli" name="txt_poli" class="span10 no-primary">
                                </div>
                            </div>
                            <div id="ruangan_group" class="control-group opt-group">
                                <label class="control-label">Ruangan</label>
                                <div class="controls">
                                    <input type="text" id="txt_ruangan" name="txt_ruangan" class="span10 no-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <div class="row-fluid formSep">
                        <div class="span12">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li  class="active"><a href="#diettab" data-toggle="tab">Diet</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-content">

                                    <div class="tab-pane active" id="diettab">
                                        <form method="POST" class="form-horizontal">
                                        <div>
                                            <div class="control-group">
                                                <label class="control-label">Pilih Diet</label>
                                                <div class="controls">
                                                    <select name="diet" id="diet">
                                                        <option value="">-</option>
                                                        <?php $diets    = DB::table('tbdiet')->get(); ?>
                                                        @foreach($diets as $d)
                                                            <option value="{{ $d->id }}">{{ $d->NamaDiet }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <button type="button" id="btn_dokter_simpan" onclick="tambah_diet()" class="btn btn-success extra-fields">Simpan</button>
                                                </div>
                                            </div>
                                        </div> <br />
                                        <table id="diet_list" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Diet</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    
    <script type="text/javascript">
    jQuery(document).ready(function($){
        $('.no-primary').each(function(){
            $(this).attr('disabled' , 'disabled');
        });

        <?php echo "pasien_find('$data->IdInap', 'RI')"; ?>

        function pasien_find(val,opt){
            
            target_url = "{{ url('rest/rawat_inap_belum') }}";
            $.ajax({
                url: target_url+'/'+val,
                dataType: "json",
                success: function(res){
                    if(res == false)
                        alert('Data pasien tidak ditemukan');
                    else{
                        $('#id_inap').val(res[0].IdInap);
                        $('#id_norm').val(res[0].NoRM);
                        $('#no_rm').val(res[0].NoRM);
                        $('#txt_nama').val(res[0].Nama);
                        $('#cmb_jenkel').val(res[0].Jkel)
                        if( res[0].Tanggal != '' || res[0].Tanggal != '-'){
                            var _tglArray = res[0].Tanggal.split("-");
                            $('#txt_tanggal_masuk').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
                        }
                        else{
                            $('#txt_tanggal_masuk').val(' ');
                        }
                        $('#txt_tempat_lahir').val(res[0].TempatLahir);
                        if( res[0].TanggalLahir != '' || res[0].TanggalLahir != '-'){
                            var _tglArray = res[0].TanggalLahir.split("-");
                            $('#txt_tanggal_lahir').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
                        }
                        else{
                            $('#txt_tanggal_lahir').val(' ');
                        }
                        $('#txt_alamat').val(res[0].Jalan);
                        $('#txt_kelurahan').val(res[0].Kelurahan);
                        $('#txt_kecamatan').val(res[0].Kecamatan);
                        $('#txt_kota').val(res[0].KotaKab);
                        $('#txt_provinsi').val(res[0].Provinsi);

                        $('.opt-group').hide();
                        if(opt == 'RJ'){
                            $('#id_reg').val(res[0].NoRegJalan);
                            $('#poli_group').show();
                            $('#txt_poli').val(res[0].Poli);    
                            $('#txt_ruangan').val('');                      
                        }
                        else if(opt == 'IGD'){
                            $('#id_reg').val(res[0].NoRegUGD);
                            $('#txt_poli').val('');
                            $('#txt_ruangan').val('');
                        }
                        else{
                            $('#id_reg').val(res[0].NoReg);
                            $('#ruangan_group').show();
                            $('#txt_poli').val('');
                            $('#txt_ruangan').val(res[0].Ruangan + ' '+ res[0].Kelas + ' Nomor:' +  res[0].NoKamar);
                        }
                        

                        $('#cmb_golongan_pasien').val(res[0].GolPasien);

                        $('#temp_reg').val( $('#id_reg').val() );
                        list_diet();
                    }
                },
                error:function(res){
                    alert('Connection failed');
                }
            })
        }
    });

    function tambah_diet(){
        var id_inap     = $('#id_inap').val();
        var id_diet     = $('#diet').val();
        if( id_inap != '' && id_diet != '' ){
            $.ajax({
                url: "{{ url('gizi/tambah_diet') }}",
                type: "POST",
                dataType: "json",
                data : "id_inap="+id_inap+"&id_diet="+id_diet,
                success:function(res){
                    if(res.status == 'success'){
                        $.sticky("Data diet berhasil di update", {speed : 'slow', autoclose : true, position: "top-right", type: "st-info" });
                    }
                    else{
                        $.sticky(res.pesan, {speed : 'slow', autoclose : true, position: "top-right", type: "st-info" });
                    }
                    list_diet();
                }
            });
        }
        
    }

    function list_diet(){
        var val = $('#id_inap').val();
            var _image  = "{{ url('img/load_gif.gif') }}";

            $('#diet').val('');
            $('#diet_list tbody').html('<tr><td align="center" colspan="4"><img src="'+_image+'"</td></tr>');
            $.ajax({
                url: "{{ url('gizi/list_diet') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    $('#diet_list tbody').html('');
                    if(res == false){

                    }
                    else{
                        $.each(res, function (key, data) {
                            $('#diet').val(data.IdDiet);


                            $('#diet_list tbody').append('<tr><td>'+data.NamaDiet+'</td>'+'</tr>');
                        });
                    }
                }
            });
    }
    </script>
@stop