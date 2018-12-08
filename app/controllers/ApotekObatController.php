<?php

class ApotekObatController extends \BaseController {

    public $pref = "as";
    public $title = 'Askes';
    public $slug = 'askes';
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($pref='askes')
    {
        $this->setPref($pref);
        $jenis_obat = DB::table($this->pref.'jenisobat')->get();
        return View::make('apotek.general.obat.list', array(
            'jenis_obat' => $jenis_obat,
            'pref' => $this->pref,
            'title' => $this->title,
            'slug' => $this->slug
        ));
    }

    public function setPref($pref)
    {
        if($pref == 'dinas'){
            $this->pref = 'di';
            $this->title = 'Dinas';
            $this->slug = 'dinas';
        }
        else if($pref == 'swasta'){
            $this->pref = 'sw';
            $this->title = 'Swasta';
            $this->slug = 'swasta';
        }
        else if($pref == 'ok'){
            $this->pref = 'ok';
            $this->title = 'OK';
            $this->slug = 'ok';
        }
        else{
            $this->pref = 'as';
            $this->title = 'Askes';
            $this->slug = 'askes';
        }
    }

    /**
     * @param void
     * @return array
     */
    public function datatable($pref='askes')
    {
        $this->pref = "apo_";
        $perawat = DB::table($this->pref.'obat')->join($this->pref.'jenisobat', $this->pref.'obat.kodejenis', '=', $this->pref.'jenisobat.kodejenis');
        return Datatable::query($perawat)
            ->addColumn('kodobat',function($model)
            {
                //return '<a href="'.url('apotek_obat/'.$model->kodobat.'/edit').'">'.$model->kodobat.'</a>';
                return $model->kodobat.' / '.$model->idobatgudang;
            })
            ->showColumns('namaobat','komposisi','satuan','namajenis','stok')
            ->addColumn('harga', function($model)
            {
                return number_format($model->harga);
            })
            ->addColumn('actions',function($model)
            {
                //return '<a href="'.url('apotek_obat/'.$model->kodobat.'/edit').'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;'.
                //'<a href="javascript:void(0)" onclick="hapus_data('."'".$model->kodobat."','Obat askes'".')"><i class="splashy-gem_remove"></i></a>';
                //return '<a href="'.url('apotek_obat/editdatatable/'.$model->kodobat.'/'.$this->slug).'"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;';
                return '<a href="javascript:void(0)" onclick="edit_data('."'".$model->kodobat."',
                                                                        '".$model->idobatgudang."',
                                                                        '".$model->namaobat."',
                                                                        '".$model->kodejenis."',
                                                                        '".$model->namajenis."',
                                                                        '".$model->komposisi."',
                                                                        '".$model->satuan."',
                                                                        '".date( "d/m/Y", strtotime($model->masa))."',
                                                                        '".$model->harga."',
                                                                        '".$model->stok."'".')"><i class="splashy-document_letter_edit"></i></a>&nbsp;&nbsp;';
            })
            ->searchColumns('kodobat','namaobat','namajenis','stok')
            ->orderColumns('kodobat','namaobat','namajenis','stok')->make();
    }

    /**
     * @param void
     * @return array
     */
    public function editdatatable($pref='askes')
    {
        $this->setPref($pref);
        $resep = DateTime::createFromFormat('d/m/Y', Input::get('masa'));
        /*
        echo 'idobat';
        var_dump(Input::get('id_obat'));
        echo '-masa';
        var_dump($resep->format('Y-m-d'));
        echo '-harga';
        var_dump(Input::get('harga'));
        echo '-id_gudang';
        var_dump(Input::get('id_obat_gudang'));
        echo '-jenisobat';
        var_dump(Input::get('jenis_obat'));
        echo '-satuan';
        var_dump(Input::get('satuan'));
        echo '-komposiis';
        var_dump(Input::get('komposisi'));
        echo '-namaobat';
        var_dump(Input::get('nama_obat'));
        */
        $ubah_data = DB::table($this->pref.'obat')->where('kodobat', Input::get('id_obat'))->update(
                        array('harga' => Input::get('harga'),
                                'idobatgudang' => Input::get('id_obat_gudang'),
                                'kodejenis' => Input::get('jenis_obat'),
                                'namaobat' => Input::get('nama_obat'),
                                'satuan' => Input::get('satuan'),
                                'masa' => $resep->format('Y-m-d'),
                                'komposisi' => Input::get('komposisi')
                            )
                        );
        if($ubah_data){
            echo 'sukses';
        }
        else{
            echo 'Data Gagal Diupdate';
        }
    }

    public function checkid($pref = 'askes')
    {
        $this->setPref($pref);
        $idobatgudang = Input::get('id_obat_gudang');
        $data = DB::table($this->pref.'obat')->where('idobatgudang', $idobatgudang)->first();

        if($data)
            return 'Id Obat Gudang ('.$data->idobatgudang.') Telah Terpakai Oleh Id Obat : '.$data->kodobat.'.<br />Harap Pilih Obat Gudang Yang Lain.';
        else
            return 'kosong';
            
    }

    /**
     * @param void
     * @return array
     */
    public function detaildatatable_edit($pref='askes')
    {
        $this->pref = "apo_";
        $perawat = DB::table($this->pref.'detailobat')
                    ->where('tempat' , $pref);

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
        $perawat = DB::table($this->pref.'detailobat')->where('tempat' , $pref);
        return Datatable::query($perawat)
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.number_format($model->harga_jual_umum).'</a>';
            })
            ->searchColumns('kodobat','namaobat','namajenis')
            ->orderColumns('kodobat','namaobat','namajenis')->make();
    }

    public function detaildatatable_apotek($pref='askes')
    {
        $this->pref = "apo_";
        //$pref   = "apotek_".$pref;
        $perawat = DB::table($this->pref.'detailobat')
                    ->where('tempat' , $pref);
        return Datatable::query($perawat)
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
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
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.number_format($model->harga_jual_umum).'</a>';
            })
            ->searchColumns('kodobat','namaobat','namajenis')
            ->orderColumns('kodobat','namaobat','namajenis')->make();
    }

    public function detailObat($pref='apotek_askes')
    {
        $this->pref = "apo_";
        $perawat = DB::table($this->pref.'detailobat')
                    ->where('apo_detailobat.tempat' , 'apotek_askes');
        return Datatable::query($perawat)
            ->addColumn('pilih',function($model)
            {
                return '<a class="btn" onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
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
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
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
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
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
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
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
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
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
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
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
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">-</a>';
            })
            ->addColumn('harga',function($model)
            {
                return '<a onclick="pilih_obat('.
                            "'".$model->kodobat."',".
                            "'".$model->namaobat."',".
                            "'',".
                            "'".$model->komposisi."',".
                            "'".$model->satuan."',".
                            "'".date( "d/m/Y", strtotime($model->masa))."',".
                            "'".$model->stok."',".
                            "'".$model->harga_jual_umum."',".
                            "'".$model->hargabeli."'".
                        ')" href="#">'.number_format($model->harga_jual_umum).'</a>';
            })
            ->searchColumns('kodobat','namaobat')
            ->orderColumns('kodobat','namaobat')->make();
    }




    public function last_id($pref='askes'){
        $this->setPref($pref);
        $last = DB::table($this->pref.'obat')->orderBy('kodobat','desc')->first();
        $lastid = intval($last->kodobat) + 1;
        echo $lastid;
    }


    public function bulkUpdate(){
        $list       = DB::table('apo_obat')->get();
        $apotek     = 'apotek_askes';
        foreach($list as $l){
            $check  = DB::table('apo_detailobat')->where('tempat',$apotek)->where('kodobat' , $l->kodobat)->first();

            $data           = array();
            $harga          = $l->harga;
            $harga_beli     = $l->hargabeli;

            $pembulatan     = 50;

            if( $harga_beli == 0 ){
                $persen         = 0;
            }
            else{
                $persen         = floatval($harga) / floatval($harga_beli);
                $persen         = round($persen , 2);
            }

            $data['stok']                   = 100;

            $data['harga_jual_umum']        = $harga;
            $data['harga_jual_bpjs']        = $harga;
            $data['harga_jual_asuransi']    = $harga;
            $data['harga_jual_pt']          = $harga;

            $data['persentase_umum']        = $persen;
            $data['persentase_bpjs']        = $persen;
            $data['persentase_asuransi']    = $persen;
            $data['persentase_pt']          = $persen;

            $data['pembulatan_umum']        = $pembulatan;
            $data['pembulatan_bpjs']        = $pembulatan;
            $data['pembulatan_asuransi']    = $pembulatan;
            $data['pembulatan_pt']          = $pembulatan;


            if(isset($check->id)){
                $update = DB::table('apo_detailobat')->where('id' , $check->id)
                        ->update($data);
            }
            else{
                $data['kodobat']    = $l->kodobat;
                $data['tempat']     = $apotek;
                $insert = DB::table('apo_detailobat')->insert($data);
            }
        }
    }

    public function syncUpdate(){
        $list   = DB::table('apo_detailobat')->get();
        foreach($list as $l){
            $data   = DB::table('apo_obat')->where('kodobat' , $l->kodobat)->first();

            $nama       =   "";
            $kodejenis  =   "";
            $namajenis  =   "";
            $komposisi  =   "";
            $satuan     =   "";
            $hargabeli  =   "";
            $masa     =   "0000-00-00";

            if( isset($data->namaobat) )
                $nama   = $data->namaobat;

            if( isset($data->kodejenis) )
                $kodejenis   = $data->kodejenis;

            if( isset($data->komposisi) )
                $komposisi  = $data->komposisi;

            if( isset($data->satuan) )
                $satuan     = $data->satuan;

            if( isset($data->masa) )
                $masa     = $data->masa;

            if( isset($data->hargabeli) )
                $hargabeli     = $data->hargabeli;


            $jenis  = DB::table('apo_jenisobat')->where('kodejenis', $kodejenis)->first();

            if( isset($jenis->namajenis) )
                $namajenis   = $jenis->namajenis;


            $update     = DB::table('apo_detailobat')->where('id', $l->id)->update(
                array(
                        'namaobat'  => $nama ,
                        'kodejenis' => $kodejenis ,
                        'namajenis' => $namajenis ,
                        'komposisi' => $komposisi ,
                        'satuan'    => $satuan ,
                        'masa'      => $masa ,
                        'hargabeli' => $hargabeli ,
                )
            );

            echo $nama." Berhasil di update <br />";

        }
    }

    public function tarifR(){
        $check = DB::table('tarif_resep')->where('id' , 1)->first();
        if( isset($check->id) && !empty($check->id) ){

        }
        else{
            $insert = DB::table('tarif_resep')->insert(['id' => 1]);
            $check = DB::table('tarif_resep')->where('id' , 1)->first();
        }

        return View::make('tarif.resep' , array( 'data' => $check ) );
    }

    public function doTarifR($id=""){
        $check = DB::table('tarif_resep')->where('id' , 1)->first();

        $input = Input::all();
        $data = array();
        foreach($input as $key => $value){
            if( $key != 'tahun' && $key != 'submit' ){
                if($key == 'logo' ){

                }
                else{
                    $data[$key] = $value;
                }
                
            }
        }

        DB::table('tarif_resep')->where('id' , 1)->update($data);
        return Redirect::to('apotek_obat/tarif')->with('success', 'Berhasil mengubah Tarif Resep');
    }
}
