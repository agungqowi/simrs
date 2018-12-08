@extends('layout')

@section('css')
    @parent
    {{ HTML::style('lib/datatables/extras/TableTools/media/css/TableTools.css') }}
    {{ HTML::style('lib/chosen/chosen.css') }}
    {{ HTML::script('lib/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('lib/chosen/chosen.jquery.min.js') }}
    <style type="text/css">
        input:focus{ 
            background-color: yellow;
        }
        input.success{
            background-color: #FFA000;
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
                            <a href="{{ url('/pendapatan/tanggal/rawat_jalan') }}">Pendapatan</a>
                        </li>
                        <li>
                            Rawat Jalan
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Total Pendapatan Rawat Jalan
                    </h3>
                    @if( $errors->first('title') || $errors->first('note') )
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert">×</a>
                            {{ $errors->first('title') }}
                            {{ $errors->first('note') }}
                        </div>
                    @endif 
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <h2>{{ Session::get('success') }}</h2>
                        </div>
                    @endif
                    <div class="row-fluid">
                        <div>
                            <div class="span2">Dari Tanggal</div>
                            <div class="span2">{{ Input::get('dari') }}</div>
                        </div>
                        <br />
                        <div>
                            <div class="span2">Sampai Tanggal</div>
                            <div class="span2">{{ Input::get('sampai') }}</div>
                        </div>
                    </div>
                    <br />
                        <input type="hidden" name="dari" value="{{ Input::get('dari') }}">
                        <input type="hidden" name="sampai" value="{{ Input::get('sampai') }}">
                        <div class="row-fluid">
                            @if(isset($pasien))
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No Reg</th>
                                        <th>No RM</th>
                                        <th>Nama</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Jenis Pasien</th>
                                        <th>Dokter</th>
                                        <th>Poli</th>
                                        <th width="120px">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $total_all = 0; ?>
                                @foreach($pasien as $p)
                                    <tr class="{{ $p->NoRegJalan }} {{ $p->NoRM }} {{ $p->Nama }}">
                                        <td>{{ $p->NoRegJalan }}</td>
                                        <td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                        <td>{{ $p->CaraBayar }}</td>
                                        <td>{{ $p->Dokter }}</td>
                                        <td>
                                            {{ $p->Poli }}
                                        </td>
                                        <td style="text-align: right" align="right">
                                        <?php 
                                        $registrasi     = $p;
                                        $total_konsul   = 0;
                                        $total_tindakan = 0;
                                        $total_obat = 0; 
                                        $total_ruangan = 0;
                                        $total_administrasi = 0;

                                        if($registrasi->CaraBayar == 'BPJS' || $registrasi->CaraBayar=='KIS'){
                                            $idJenis = '1';
                                        }
                                        else{
                                            $idJenis = '2';
                                        }

                                        $tarif  = DB::table('tarif_dokter_bulk')->where('IdKategoriDokter' , '2')->
                                        where('IdJenis' , $idJenis)->first();

                                        if( isset($tarif->IdKategoriDokter) ){
                                            $total_konsul   = $tarif->TarifKonsul;
                                        }

                                        $tindakan = DB::table('tbdetailtindakan')->where('NoReg' , $p->NoRegJalan)
                                                    ->where('StatusBayar' , '1')
                                                    ->get();
                                        $penjualan  = DB::table('apo_penjualan')->where('NoReg' , $p->NoRegJalan)->first();
                                        if( isset($penjualan->id) ){
                                            $obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();

                                            $total_obat   = $penjualan->total;
                                        }
                                        else{
                                            $obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
                                        }
                                        ?>
                                        @if(isset($tindakan))
                                                @foreach($tindakan as $t)
                                                    <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                                @endforeach
                                        @endif
                                        
                                        <?php $total = floatval( $total_tindakan ) + floatval( $total_obat ); ?>

                                        <?php $total_all += $total; ?>
                                        {{ number_format($total) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="7">Total Pendapatan</td>
                                    <td align="right" style="text-align: right">
                                    {{ number_format($total_all) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <div class="row-fluid">
                           <!-- <button type="submit" class="btn btn-success">Proses</button> -->
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
                required: "Mohon isi field ini"
            });
            $('#klaim_form').validate({

            });

            $('.total-klaim').each(function(){
                $(this).bind('keypress',function(e){
                    var code = e.keyCode || e.which;
                    $(this).removeClass('success');
                    $(this).parent().find('.icon-ok').remove();
                    if(code == 13) { //Enter keycode
                        var NoReg = $(this).attr('data-noreg');
                        var Klaim = $(this).val();
                        var InputId = $(this).attr('id');
                        $.ajax({
                            url: "{{ url('klaim_bpjs/rawat_jalan_one') }}",
                            type: "POST",
                            data : "noreg="+NoReg+"&klaim="+Klaim,
                            success:function(res){
                                if(res == 'success'){
                                    $('#'+InputId).after('<i class="icon-ok"></i>');
                                    $('#'+InputId).addClass('success');
                                }                               
                            }
                        });
                        $(this).parent().parent().next().find('.total-klaim').focus();
                    }
                });
            });
        });
    </script>
@stop
