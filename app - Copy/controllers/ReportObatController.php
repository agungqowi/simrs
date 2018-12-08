<?php

class ReportObatController extends \ReportController {

	public function distribusiObat($pref='askes')
	{	
		$this->title = 'Gudang';
		$this->slug = 'gudang';
		return View::make('report.obat.distribusi' , 
			array(
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function distribusiObat_view($pref='askes'){
		$this->pref = "apo_";
		$this->title = 'Gudang';
		$this->slug = $pref;

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$data = DB::table($this->pref.'distribusi')->join($this->pref.'obat' , $this->pref.'distribusi.kodobat' , '=' , $this->pref.'obat.kodobat')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->where('dari' , $pref)->where('keterangan' , 'distribusi')
				->select('*' , DB::raw('DATE_FORMAT(tanggal, "%d/%m/%Y") AS tgl'))
				->orderBy($this->pref.'distribusi.tanggal' , 'ASC')
				->get();

		return View::make('report.obat.distribusi_view' , 
			array(
				'data' => $data,
				'dari_tanggal' => Input::get('dari_tanggal') ,
				'sampai_tanggal' => Input::get('sampai_tanggal'),
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function returObat($pref='askes')
	{	
		$this->title = 'Apotek';
		if($pref == 'apotek_askes'){
			$this->title = 'Apotek Askes';
		}
		$this->slug = $pref;
		return View::make('report.obat.retur' , 
			array(
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function returObat_view($pref='askes'){
		$this->pref = "apo_";
		$this->title = 'Apotek';
		if($pref == 'apotek_askes'){
			$this->title = 'Apotek Askes';
		}
		$this->slug = $pref;

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$data = DB::table($this->pref.'distribusi')->join($this->pref.'obat' , $this->pref.'distribusi.kodobat' , '=' , $this->pref.'obat.kodobat')
				->whereBetween('tanggal', array($dari_tanggal, $sampai_tanggal))
				->where('dari' , $pref)->where('keterangan' , 'retur')
				->select('*' , DB::raw('DATE_FORMAT(tanggal, "%d/%m/%Y") AS tgl'))
				->orderBy($this->pref.'distribusi.tanggal' , 'ASC')
				->get();

		return View::make('report.obat.retur_view' , 
			array(
				'data' => $data,
				'dari_tanggal' => Input::get('dari_tanggal') ,
				'sampai_tanggal' => Input::get('sampai_tanggal'),
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function pembelianObat($pref='askes')
	{	
		$this->title = 'Gudang';
		if($pref == 'gudang'){
			$this->title = 'Gudang';
		}
		$this->slug = $pref;

		$judul = 'Pembelian Obat & Alkes';
		$target = 'pembelian_obat_view';
		return View::make('report.obat.tanggal' , 
			array(
				'title' => $this->title,
				'target' => $target,
				'judul' => $judul,
				'slug' => $this->slug
			)
		);
	}

	public function pembelianObat_view($pref='askes'){
		$this->pref = "apo_";
		$this->title = 'Gudang';
		$this->slug = $pref;

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$data = DB::table($this->pref.'pembelian')->join($this->pref.'obat' , $this->pref.'pembelian.kodobat' , '=' , $this->pref.'obat.kodobat')
				->join($this->pref.'supplier' , $this->pref.'pembelian.kodesupp' , '=' , $this->pref.'supplier.kodesupp')
				->whereBetween('tanggal_beli', array($dari_tanggal, $sampai_tanggal))
				->select('*' , DB::raw('DATE_FORMAT(tanggal_beli, "%d/%m/%Y") AS tgl'))
				->orderBy($this->pref.'pembelian.tanggal_beli' , 'ASC')
				->get();

		return View::make('report.obat.pembelian_view' , 
			array(
				'data' => $data,
				'dari_tanggal' => Input::get('dari_tanggal') ,
				'sampai_tanggal' => Input::get('sampai_tanggal'),
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}

	public function penjualanObat($pref='askes')
	{	
		$this->title = 'Apotek';
		if($pref == 'apotek_askes'){
			$this->title = 'Apotek Askes';
		}
		$this->slug = $pref;

		$judul = 'Penjualan Obat & Alkes';
		$target = 'penjualan_obat_view';
		return View::make('report.obat.tanggal' , 
			array(
				'title' => $this->title,
				'target' => $target,
				'judul' => $judul,
				'slug' => $this->slug
			)
		);
	}

	public function penjualanObat_view($pref='askes'){
		$this->pref = "apo_";
		$this->title = 'Apotek';
		$this->slug = $pref;

		$date = DateTime::createFromFormat('d/m/Y', Input::get('dari_tanggal'));
		$dari_tanggal = $date->format('Y-m-d');

		$date = DateTime::createFromFormat('d/m/Y', Input::get('sampai_tanggal'));
		$sampai_tanggal = $date->format('Y-m-d');

		$data = DB::table('apo_penjualan_detail')
				->join($this->pref.'obat' , 'apo_penjualan_detail.IdObat' , '=' , $this->pref.'obat.kodobat')
				->join('apo_penjualan','apo_penjualan.id' , '=' , 'apo_penjualan_detail.id_penjualan')
				->whereBetween('TanggalResep', array($dari_tanggal, $sampai_tanggal))
				->select('apo_penjualan_detail.*' , DB::raw('DATE_FORMAT(TanggalResep, "%d/%m/%Y") AS tgl') , 'apo_penjualan.JenisRawat')
				->orderBy('apo_penjualan_detail.TanggalResep' , 'ASC')
				->get();

		return View::make('report.obat.penjualan_view' , 
			array(
				'data' => $data,
				'dari_tanggal' => Input::get('dari_tanggal') ,
				'sampai_tanggal' => Input::get('sampai_tanggal'),
				'title' => $this->title,
				'slug' => $this->slug
			)
		);
	}
}