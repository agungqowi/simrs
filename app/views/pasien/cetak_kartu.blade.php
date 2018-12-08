@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    {{ HTML::script('lib/datatables/fnReloadAjax.js') }}
    {{ HTML::style('css/custom-theme/jquery-ui-1.10.0.custom.css') }}
    <style type="text/css">
    #text_rs{
        font-size: 15px;
        position: absolute;
        text-align: center;
        top: 20px;
        line-height: 25px;
        width: 100%;
    }

    #text_norm{
        font-size: 17px;
        position: absolute;
        top: 170px;
        left: 20px;
        font-weight: bold;
    }

    #text_barcode{
        font-size: 17px;
        position: absolute;
        top: 170px;
        left: 300px;
        font-weight: bold;
        padding: 5px;
        background: #FFFFFF;
    }


    #text_nama{
        font-size: 17px;
        position: absolute;
        top: 200px;
        left: 20px;
        font-weight: bold;
    }

    @media print
    {
        body * { visibility: hidden; }
        body{ height: 200px;}
        #dzie_element * { visibility: visible; }
        #dzie_element { position: absolute; top: 40px; left: 30px; }
    }
    </style>
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
                            <a href="{{ action('DashboardController@index') }}">Pasien</a>
                        </li>
                        <li>
                            Cetak Kartu
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Cetak Kartu Pasien
                        <div style="float:right;" class="">
                            <button class="btn btn-warning btn-top" data-toggle="modal" data-target="#cari_pasien"><i class="splashy-zoom"></i> Cari Pasien</button>
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
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#pasientab" data-toggle="tab">Pasien</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="pasientab">
                                <div class="row-fluid formSep">
                                    <div class="span6"> 
                                        <div class="control-group">
                                            <label class="control-label">No RM</label>
                                            <div class="controls">
                                                <input type="text" id="no_rm" class="span10" readonly>
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
                                            <label class="control-label">Tanggal Lahir</label>
                                            <div class="controls">
                                                <input id="txt_tanggal_lahir" type="text" class="span10 no-primary date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span6">
                                        
                                        <div class="control-group">
                                            <label class="control-label">Alamat</label>
                                            <div class="controls">
                                                <textarea id="txt_alamat" type="text" class="span10 no-primary"></textarea>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="width:500px;height:314px;overflow:hidden;position:relative;">
                        <div id="dzie_element" style="position:relative;top:0;left:0;width:100%;height:100%;">
                            <img id="gambar_kartu" src="{{ url('img/kartu/1.jpg') }}" style="width:500px;position: absolute;">
                            <div id="text_nama"></div>
                            <div id="text_norm"></div>
                            <div id="text_rs">{{ $rs_title }} <br />{{ $rs_alamat }}</div>
                            <div id="text_barcode"></div>
                        </div>
                    </div><br />
                    <div class="row-fluid">
                        <div class="span12">
                            <a style="display:none;" id="btn_cetak" class="btn btn-primary"><i class="splashy-check"></i> Cetak Kartu</a>
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
                                    <th align="center" valign="middle" class="head8">No BPJS</th>
                                    <th align="center" valign="middle" class="head9">No KTP</th>
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
    {{ HTML::script('js/forms/jquery.inputmask.min.js') }}
    {{ HTML::script('js/html2canvas.js') }}
    <script type="text/javascript">
        var element = $("#dzie_element"); // global variable
        var getCanvas; // global variable

        jQuery(document).ready(function($){
            $('.no-primary').attr('readonly' , true);

            $( "#no_cari" ).focus();
            $('#no_cari').bind('keypress',function(e){
                var code = e.keyCode || e.which;
                if(code == 13) { //Enter keycode
                    if( $('#no_cari').val() != ''){
                        pasien_find( $('#no_cari').val() );
                        _tempID = $('#no_cari').val();
                    }                        
                }
                    
            });

            

            $('#no_cari').focusout(function() {
                if( $('#no_cari').val() == '' ){

                }
                else{
                    if( _tempID != $('#no_cari').val() ){
                        pasien_find( $('#no_cari').val() );
                        _tempID = $('#no_cari').val()
                    }
                }               
                    
            });
            
            $('#btn_cetak').click(function(){
                //location.href= $(this).attr('href');
            })
        })

        function pilih_pasien(id){
            $('#cari_pasien').modal('hide');
            $('#no_rm').val(id);
            pasien_find(id);
        }

        function pasien_find(val){
            $.ajax({
                url: "{{ url('rest/pasien') }}"+'/'+val,
                dataType: "json",
                success: function(res){
                    _kartu = '';
                    if(res == false){   
                            $(':text.no-primary').each(function(){
                                $(this).val('');
                            });

                            var _norm = $('#no_cari').val();
                            if( _norm.length < 2){
                                $('#no_cari').focus();
                                $('.no-primary').each(function(){
                                    $(this).attr('disabled','disabled');
                                });
                            }
                            else{
                                $('.no-primary').each(function(){
                                    $(this).attr('disabled',false);
                                });
                                $('#txt_nama').focus();
                                
                            }
                    }
                    else{
                        $('#no_rm').val( res[0].NoRM );
                        $('#txt_nama').val(res[0].Nama);
                        $('#cmb_jenkel').val(res[0].Jkel)
                        if( res[0].TanggalLahir != '' || res[0].TanggalLahir != '-'){
                            var _tglArray = res[0].TanggalLahir.split("-");
                            $('#txt_tanggal_lahir').val(_tglArray[2]+'/'+_tglArray[1]+'/'+_tglArray[0]);
                        }
                        else{
                            $('#txt_tanggal_lahir').val(' ');
                        }
                        
                        $('#txt_alamat').val(res[0].Jalan + ' ' + res[0].Kelurahan+' '+res[0].Kecamatan);
                        $('#cmb_golongan_pasien').val(res[0].GolPasien);

                        $('#text_nama').html( "Nama &nbsp;: " + res[0].Nama);
                        $('#text_norm').html( "No RM : " + res[0].NoRM );
                        <?php $target_url = url('pasien/barcode/'); ?>
                        $.ajax({
                            url: "{{ $target_url }}"+'/'+res[0].NoRM,
                            success:function(resa){
                                $('#text_barcode').html( '<img src="data:image/png;base64,'+resa+'" alt="barcode"   />' );

                                html2canvas(element, {
                                 onrendered: function (canvas) {
                                        getCanvas = canvas;
                                        var imgageData = getCanvas.toDataURL("image/png");
                                        // Now browser starts downloading it instead of just showing it
                                        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                                        $("#btn_cetak").attr("download", res[0].NoRM+".png").attr("href", newData);
                                     }
                                 });
                            }
                        });

                        $('#btn_cetak').show();
                        
                    }
                },
                error:function(res){
                    alert('Connection failed');
                }
            })
        }
    </script>
@stop
