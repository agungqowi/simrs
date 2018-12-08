@extends('print')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
@stop

@section('content')
    <div id="contentwrapper">
        <div class="print_content">
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                    <div class="row-fluid" id="printarea">
                        
                        <div class="row-fluid">
                        <table width="100%" border="1">
                        <thead>
                            <tr>
                                <th width="10%">Tanggal / Jam</th>
                                <th width="30%">ANAMNESA</th>
                                <th width="25%">DIAGNOSA</th>
                                <th width="15%">KODE ICD</th>
                                <th width="20%">TERAPI TTD DAN NAMA DOKTER</th>
                            </tr>
                            <tr height="700px">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </thead>
                        </table>
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
    {{ HTML::script('js/jquery.printElement.min.js') }}
@stop
