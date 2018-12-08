@extends('print')

@section('content')
    <div id="contentwrapper">
        <div class="main_content">
            <div class="row-fluid">
                <div class="span12">

                    <h3 class="heading"><div class="row-fluid">
                        <div class="span12">
                            <div align="center">{{ $rs_title }}</div>
                            <div align="center">{{ $rs_alamat }}</div>
                        </div>
                    </div>
                    </h3>


                    <div class="row-fluid">
                        <div class="span12">
                            <h4 align="center">Bukti Pembayaran Deposit / Down Payment</h4>
                        </div>
                    </div>
                    <br />
                    {{ Form::open(array('url' => 'billing/dp' , 'id'=>'reg1_form', 'class' => 'form-horizontal')) }}
                    <table width="100%" border="0" colspan="2" class="report">
                        <tr>
                            <td>No Reg</td>
                            <td>:</td>
                            <td>{{ $data->no_reg }}</td>
                        </tr>
                        <tr>
                            <td>No RM</td>
                            <td>:</td>
                            <td>{{ $data->no_rm }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Deposit</td>
                            <td>:</td>
                            <td>{{ $data->tanggal_deposit }}</td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>:</td>
                            <td>{{ $data->metode_pembayaran }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Deposit / DP</td>
                            <td>:</td>
                            <td>{{ number_format( $data->jumlah ) }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $data->keterangan }}</td>
                        </tr>
                    </table>
                    <div class="row-fluid">
                        <div class="span12">
                            <p style="font-size:9px">Dicetak pada <?php echo date('d-m-Y H:i:s'); ?>
                        </div>
                    </div>
                    {{ Form::close() }}

                    {{ Form::open(array('url' => '' , 'id'=>'reg2_form', 'class' => 'form-horizontal' , 'style' => 'display:none')) }}
                    <div class="row-fluid">
                        <div class="span5"> 
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            
        </div>
    </div>