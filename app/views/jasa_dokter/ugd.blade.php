@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
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
                            <a href="{{ url('jasa_dokter/rawat_jalan') }}">Pembagian Jasa</a>
                        </li>
                        <li>
                            Per UGD
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Pembagian Jasa per UGD
                    </h3>

                    <div class="row-fluid">
                        <div class="span12">
                            <form action="{{ url('jasa_dokter/ugd_view') }}" method="get" class="form-horizontal" id="form_jasa">
                                <div class="control-group">
                                    <label class="control-label">Dari Tanggal</label>
                                    <div class="controls">
                                        <div class="input-append date" id="dari">
                                            <input required class="span8" name="dari" type="text" /><span class="add-on"><i class="splashy-calendar_day_up"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Sampai Tanggal</label>
                                    <div class="controls">
                                        <div class="input-append date" id="sampai">
                                            <input required class="span8" name="sampai" type="text" /><span class="add-on"><i class="splashy-calendar_day_up"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                    <button type="submit" id="btn_proses" name="btn_proses" class="btn btn-primary"> Proses</button>
                                    </div>
                                </div>
                            </form>
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
    {{ HTML::script('lib/validation/jquery.validate.min.js') }}
    <script type="text/javascript">
        $(document).ready(function(){
            $.extend(jQuery.validator.messages, {
                required: "Area ini harus diisi."
            });
            $('#form_jasa').validate({
                onkeyup: false,
                errorClass: 'error',
                validClass: 'valid',
                highlight: function(element) {
                    $(element).closest('div').addClass("f_error");
                },
                unhighlight: function(element) {
                    $(element).closest('div').removeClass("f_error");
                },
                errorPlacement: function(error, element) {
                    // Set positioning based on the elements position in the form
                    var elem = $(element);
                    
                    // Check we have a valid error message
                    if(!error.is(':empty')) {
                        if( (elem.is(':checkbox')) || (elem.is(':radio')) ) {
                            // Apply the tooltip only if it isn't valid
                            elem.filter(':not(.valid)').parent('label').parent('div').find('.error_placement').qtip({
                                overwrite: false,
                                content: error,
                                position: {
                                    my: 'left bottom',
                                    at: 'center right',
                                    viewport: $(window),
                                    adjust: {
                                        x: 6
                                    }
                                },
                                show: {
                                    event: false,
                                    ready: true
                                },
                                hide: false,
                                style: {
                                    classes: 'ui-tooltip-red ui-tooltip-rounded' // Make it red... the classic error colour!
                                }
                            })
                            // If we have a tooltip on this element already, just update its content
                            .qtip('option', 'content.text', error);
                        } else {
                            // Apply the tooltip only if it isn't valid
                            elem.filter(':not(.valid)').qtip({
                                overwrite: false,
                                content: error,
                                position: {
                                    my: 'bottom left',
                                    at: 'right',
                                    viewport: $(window),
                                    adjust: { x: -8, y: 6 }
                                },
                                show: {
                                    event: false,
                                    ready: true
                                },
                                hide: false,
                                style: {
                                    classes: 'ui-tooltip-red ui-tooltip-rounded' // Make it red... the classic error colour!
                                }
                            })
                            // If we have a tooltip on this element already, just update its content
                            .qtip('option', 'content.text', error);
                        };
                        
                    }
                    // If the error is empty, remove the qTip
                    else {
                        if( (elem.is(':checkbox')) || (elem.is(':radio')) ) {
                            elem.parent('label').parent('div').find('.error_placement').qtip('destroy');
                        } else {
                            elem.qtip('destroy');
                        }
                    }
                }
            });
            $('#btn_proses').click(function(){
                
            });

            $('#dari').datepicker({format: "mm/dd/yyyy"}).on('changeDate', function(ev){
                var dateText = $(this).data('date');
                
                var endDateTextBox = $('#sampai input');
                if (endDateTextBox.val() != '') {
                    var testStartDate = new Date(dateText);
                    var testEndDate = new Date(endDateTextBox.val());
                    if (testStartDate > testEndDate) {
                        endDateTextBox.val(dateText);
                    }
                }
                else {
                    endDateTextBox.val(dateText);
                };
                $('#sampai').datepicker('setStartDate', dateText);
                $('#dari').datepicker('hide');
            });
            $('#sampai').datepicker({format: "mm/dd/yyyy"}).on('changeDate', function(ev){
                var dateText = $(this).data('date');
                var startDateTextBox = $('#dari input');
                if (startDateTextBox.val() != '') {
                    var testStartDate = new Date(startDateTextBox.val());
                    var testEndDate = new Date(dateText);
                    if (testStartDate > testEndDate) {
                        startDateTextBox.val(dateText);
                    }
                }
                else {
                    startDateTextBox.val(dateText);
                };
                $('#dari').datepicker('setEndDate', dateText);
                $('#sampai').datepicker('hide');
            });

            $(".chzn_a").chosen({
                allow_single_deselect: true
            });
        });

        function pilih_pasien(no_rm,id_reg,nama,tanggal_masuk,tanggal_keluar,jenis_pasien){
            $.ajax({
                url: "{{ url('jasa_dokter/check_klaim') }}"+'/'+id_reg,
                dataType: "json",
                success: function(res){
                    $('#klaim').val(res.TotalKlaim);
                },
                error:function(){

                }
            });
            $('#no_rm').val(no_rm);
            $('#no_reg').val(id_reg);
            $('#txt_nama').val(nama);
            $('#txt_tanggal_masuk').val(tanggal_masuk);
            $('#txt_tanggal_keluar').val(tanggal_keluar);
            $('#txt_jenis_pasien').val(jenis_pasien);
            $('#cari_pasien').modal('hide');
            $('#btn_preview').attr('disabled',false);
        }

        function simpan_klaim(){
            var no_reg = $('#no_reg').val();
            var total_klaim = $('#klaim').val();
            if(total_klaim != 0){
                $.ajax({
                    url: "{{ url('jasa_dokter/simpan_klaim') }}",
                    type: "POST",
                    data : "no_reg="+no_reg+"&total_klaim="+total_klaim,
                    success: function(res){
                       $('#reg1_form').submit(); 
                    },
                    error:function(){

                    }
                });
            }
            else{
                $('#klaim').focus();
            }
        }
    </script>
@stop
