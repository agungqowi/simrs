@extends('layout')

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
                            Jasa Dokter
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Perhitungan Jasa Dokter
                    </h3>
                    <br />
                    {{ Form::open(array('url' => '' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <div class="row-fluid formSep">
                        <div class="span6"> 
                            <div class="control-group">
                                <label class="control-label">Total Klaim</label>
                                <div class="controls">
                                    <input type="text" id="total_klaim" name="total_klaim" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Biaya Obat</label>
                                <div class="controls">
                                    <input type="text" name="biaya_obat" id="biaya_obat" class="span10">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Biaya Tindakan</label>
                                <div class="controls">
                                    <input type="text" id="biaya_tindakan" name="biaya_tindakan" class="span10 no-primary">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Biaya Ruangan</label>
                                <div class="controls">
                                    <input type="text" id="biaya_ruangan" name="biaya_ruangan" class="span10 no-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <button type="button" id="btn_hitung_jasa" class="btn btn-inverse no-primary"><i class="splashy-check"></i> Hitung Pembagian Jasa</button>
                        </div>
                    </div>
                    {{ Form::close() }}

                    <div id="hasil_hitung">

                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="cari_pasien" tabindex="-1" role="dialog" aria-labelledby="cari_pasienLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cari_pasienLabel">Pencarian Pasien</h4>
                    </div>
                    <div class="modal-body">
                    
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn_hitung_jasa').click(function(){
                hitung_jasa();
            })
        })
        function hitung_jasa(){
            var sisa = $('#total_klaim').val() - $('#biaya_obat').val() -  $('#biaya_tindakan').val() - $('#biaya_ruangan').val();

            var jasa_medis  = 36*sisa/100;
            var operasional = 64*sisa/100;

            var medis_paramedis = 68*jasa_medis/100;
            var pengelola = 32*jasa_medis/100;


            var medis = 66*medis_paramedis/100;
            var paramedis = 34*medis_paramedis/100;

            $('#hasil_hitung').html(' ');
            $('#hasil_hitung').append('<br />- Medis Pengelola : ' + jasa_medis);
            $('#hasil_hitung').append('<br />-- Medis Paramedis : ' + medis_paramedis);
            $('#hasil_hitung').append('<br />--- Medis : ' + medis);
            $('#hasil_hitung').append('<br />--- Paramedis : ' + paramedis);
            $('#hasil_hitung').append('<br />-- Pengelola : ' + pengelola);
            $('#hasil_hitung').append('<br />- Operasional : ' + operasional);

        }
    </script>
@stop
