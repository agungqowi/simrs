<?php

class GudangObatController extends \BaseController {

	public function supplier($id){
        $obat   = DB::table('apo_obat')->where('kodobat' ,$id)->first();

        if( !isset($obat->kodobat) )
            die('Maaf data tidak ditemukan');

        return View::make('gudang.supplier' , array(
            'obat'      => $obat
        ));
    }

    public function simpletable_supplier(){
        $data   = DB::table('apo_supplier');
        return Datatable::query($data)
            ->addColumn('Pilih',function($model)
            {
                return '<a class="btn" onclick="tambah_supplier('."'".$model->kodesupp."'".')" href="javascript:void(0)">Pilih</a>';
            })
            ->addColumn('kodesupp',function($model)
            {
                return '<a onclick="tambah_supplier('."'".$model->kodesupp."'".')" href="javascript:void(0)">'.$model->kodesupp.'</a>';
            })
            ->addColumn('namasupp',function($model)
            {
                return '<a onclick="tambah_supplier('."'".$model->kodesupp."'".')" href="javascript:void(0)">'.$model->namasupp.'</a>';
            })
            ->addColumn('alamat',function($model)
            {
                return '<a onclick="tambah_supplier('."'".$model->kodesupp."'".')" href="javascript:void(0)">'.$model->alamat.'</a>';
            })
            ->addColumn('notelp',function($model)
            {
                return '<a onclick="tambah_supplier('."'".$model->kodesupp."'".')" href="javascript:void(0)">'.$model->notelp.'</a>';
            })
            ->searchColumns('kodesupp','namasupp','alamat','notelp')
            ->orderColumns('kodesupp','namasupp','alamat','notelp')->make();
    }

    /**
     * @param void
     * @return array
     */
    public function detaildatatable_edit($pref='askes')
    {
        $this->pref = "apo_";
        $perawat = DB::table($this->pref.'obat');

        return Datatable::query($perawat)
            ->addColumn('pilih',function($model)
            {
                return '<a class="btn" onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="javascript:void(0)">Pilih</a>';
            })
            ->addColumn('kodobat',function($model)
            {
                return '<a onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->kodobat.'</a>';
            })
            ->addColumn('namaobat',function($model)
            {
                return '<a onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->namaobat.'</a>';
            })
            ->addColumn('komposisi',function($model)
            {
                return '<a onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->komposisi.'</a>';
            })
            ->addColumn('satuan',function($model)
            {
                return '<a onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->satuan.'</a>';
            })
            ->addColumn('stok',function($model)
            {
                return '<a onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->stok.'</a>';
            })
            ->addColumn('namajenis',function($model)
            {
                return '<a onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->namajenis.'</a>';
            })
            ->addColumn('harga',function($model)
            {
                return '<a onclick="pilih_obat_edit('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.number_format($model->harga_jual_umum).'</a>';
            })
            ->searchColumns('kodobat','namaobat','namajenis')
            ->orderColumns('kodobat','namaobat','namajenis')->make();
    }

    public function detaildatatable($pref='askes')
    {
        $this->pref = "apo_";
        $pref   = "apotek_".$pref;
        $data = DB::table($this->pref.'obat')
                    ->leftJoin('apo_jenisobat' , 'apo_obat.kodejenis' , '=' ,'apo_jenisobat.id');
        return Datatable::query($data)
            ->addColumn('pilih',function($model)
            {
                return '<a class="btn" onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="javascript:void(0)">Pilih</a>';
            })
            ->addColumn('kodobat',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->kodobat.'</a>';
            })
            ->addColumn('namaobat',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->namaobat.'</a>';
            })
            ->addColumn('komposisi',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->komposisi.'</a>';
            })
            ->addColumn('satuan',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->satuan.'</a>';
            })
            ->addColumn('stok',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->stok.'</a>';
            })
            ->addColumn('namajenis',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.$model->namajenis.'</a>';
            })
            ->addColumn('harga',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'".$model->kodejenis."',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.number_format($model->harga).'</a>';
            })
            ->searchColumns('kodobat','namaobat','namajenis')
            ->orderColumns('kodobat','namaobat','namajenis')->make();
    }

    public function list_supplier($id){
        if($id==0){
            echo 'false';
        }
        else{
            $data = DB::table('apo_obat_supplier')->join('apo_supplier','apo_obat_supplier.kodesupp' ,'=' , 'apo_supplier.kodesupp' )
            ->select('apo_supplier.*','apo_obat_supplier.kodobat')
            ->where('apo_obat_supplier.kodobat', '=', $id)->get();
            echo(json_encode($data));
        }
    }

    public function tambah_supplier()
    {
        
        $data = DB::table('apo_obat_supplier')->insert(
            array(
                'kodobat' => Input::get('kodobat'),
                'kodesupp' => Input::get('supplier')
            )
        );
    }

    public function hapus_supplier()
    {
        $kodesupp = Input::get('kodesupp');
        $kodobat = Input::get('kodobat');
        $data = DB::table('apo_obat_supplier')->where('kodesupp' , '=' , $kodesupp)->where('kodobat' , '=' , $kodobat)->delete();
        echo $data;
    }

    public function resep($id){
        $resep  = DB::table('apo_obat')->where('kodobat' , $id)->first();
        if( isset($resep->aturan_pakai) ){
            die( $resep->aturan_pakai );
        }
        else{
            die('-');
        }
    }

}
