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
                            <a href="{{ url('finance/tanggal/'.$slug) }}">Laporan</a>
                        </li>
                        <li>
                            Pendapatan
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Pendapatan {{ $title }}
                    </h3>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
                        </div>
                    @endif

                    <div class="row-fluid">
                        <div class="span12">
                            <form action="{{ url('finance_report/'.$slug.'_input') }}" method="get" class="form-horizontal" id="form_jasa">
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
                                    <label class="control-label">Dokter</label>
                                    <div class="controls">
                                        <?php $dokter   = DB::table('tbdaftardokter')->orderBy('NamaDokter','ASC')->get(); ?>
                                        @if( count($dokter) > 0 )
                                            <select name="dokter" id="dokter" class="select2">
                                                <option value="0">-Semua-</option>
                                                @foreach($dokter as $d)
                                                    <option value="{{ $d->IdDokter }}">{{ $d->NamaDokter }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>                                
                                <div class="control-group">
                                    <label class="control-label">Cara Bayar</label>
                                    <div class="controls">
                                        <select name="cara_bayar" id="cara_bayar">
                                            <option value="0">-Semua-</option>
                                            <option value="UMUM">UMUM</option>
                                            <option value="BPJS">BPJS</option>
                                        </select>
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
    </script>
@stop
