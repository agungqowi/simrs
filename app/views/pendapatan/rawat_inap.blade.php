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
                            <a href="{{ url('pendapatan/tanggal/rawat_inap') }}">Pendapatan</a>
                        </li>
                        <li>
                            Rawat Inap
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="row-fluid">
                <div class="span12">
                    <h3 class="heading">Pendapatan Rawat Inap
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
                        <br />
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
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jenis Pasien</th>
                                        <th>Dokter</th>
                                        <th>Ruangan</th>
                                        <th>Total Biaya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $total_all      = 0; ?>
                                @foreach($pasien as $p)
                                    <tr class="{{ $p->NoReg }} {{ $p->NoRM }} {{ $p->Nama }}">
                                        <td>{{ $p->NoReg }}</td>
                                        <td>{{ $p->NoRM }}</td>
                                        <td>{{ $p->Nama }}</td>
                                        <td>{{ $p->Tanggal }}</td>
                                        <td>{{ $p->TanggalPulang }}</td>
                                        <td>{{ $p->CaraBayar }}</td>
                                        <td>
                                            @foreach( $helper->getDokterByNoReg($p->NoReg) as $s )
                                                {{ $s->NamaDokter .'<br />'}}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach( $helper->getRuanganByNoReg($p->NoReg) as $r )
                                                {{ $r->Ruangan .'<br />'}}
                                            @endforeach
                                        </td>
                                        <td style="text-align: right" align="right">
                                            <?php 
                                                $total_tindakan = 0;
                                                $total_obat = 0; 
                                                $total_ruangan = 0;
                                                $gol = "";
                                                $ruangan = true;
                                                $gol_loop = 0;
                                                $total_gol = 0;
                                                $total_visite = 0;

                                                

                                                $registrasi     = $p;

                                                $tindakan = DB::table('tbtindakanranap')->where('NoReg' , $p->NoReg)
                                                            ->orderBy('GOL')->get();

                                                $penjualan  = DB::table('apo_penjualan')->where('NoReg' ,  $p->NoReg)->first();
                                                if( isset($penjualan->id) ){
                                                    $obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , $penjualan->id)->get();
                                                }
                                                else{
                                                    $obat = DB::table('apo_penjualan_detail')->where('id_penjualan' , '0')->get();
                                                }
                                            ?>

                                            @if($ruangan)
                                                    <?php $visite   = DB::table('dokter_visite')->where('NoReg' , $registrasi->NoReg)->get(); ?>
                                                    @if(count($visite) > 0)
                                                        @foreach($visite as $v)
                                                            <?php $total_visite = $total_visite + $v->Tarif; ?>
                                                        @endforeach
                                                    @endif
                                                    <?php $inap = DB::table('tbpasieninap')->where('NoReg','=',$p->NoReg)->get(); ?>

                                                    @foreach($inap as $k)
                                                        <?php
                                                            $tanggal_masuk      = $k->Tanggal;
                                                            $tanggal_pulang     = $k->TanggalPulang;
                                                            $diff = abs(strtotime( $tanggal_pulang ) - strtotime( $tanggal_masuk ));
                                                            $years = floor($diff / (365*60*60*24));
                                                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                            $days++;
                                                            $tarif = $k->TarifRuangan;
                                                            $biaya_ruangan =  intVal( $tarif ) *  intVal( $days );
                                                        ?>
                                                        @if(isset($reg[$k->Tanggal]))
                                                            <?php $ruangan = $reg[$k->Tanggal]; ?>
                                                        @else
                                                            <?php $ruangan = ""; ?>
                                                        @endif
                                                        <?php 
                                                            $total_ruangan = $total_ruangan + $biaya_ruangan;

                                                        ?>
                                                    @endforeach
                                            @endif
                                            @if(count($tindakan) > 0)
                                                @foreach($tindakan as $t)
                                                    @if($gol != $t->Gol)
                                                        <?php $total_gol = 0 ?>
                                                    @else

                                                    @endif
                                                    <?php $total_tindakan = $total_tindakan + $t->Tarif; ?>
                                                    <?php $total_gol = $total_gol + $t->Tarif; ?>
                                                    <?php $gol_loop++; $gol=$t->Gol;?>
                                                    
                                                @endforeach
                                            @endif
                                            @if(isset($obat))
                                                    @foreach($obat as $o)
                                                        <?php $total_obat = $total_obat + $o->TotalHarga; ?>
                                                    @endforeach
                                            @endif
                                            <?php $total = $total_ruangan + $total_tindakan + $total_obat+$total_visite; ?>
                                            {{ number_format($total) }}

                                            <?php $total_all    += $total; ?>
                                        </td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="8">
                                        Total Pendapatan
                                        </td>
                                        <td style="text-align: right">
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
                            url: "{{ url('klaim_bpjs/rawat_inap_one') }}",
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
