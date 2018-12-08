<?php

class LabPemeriksaanController extends \CrudController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public $title 		= 'Tabel Pemeriksaan Lab';
	public $table 		= 'lab_pemeriksaan';
	public $slug 		= 'lab_pemeriksaan';
	public $controller 	= 'LabPemeriksaanController';
	public $primary 	= 'kode_jasa';
	public $table_trans = 'lab_detailperiksa';
	public $field_trans = 'id_pemeriksaan';

	public $join 		= array(
							array('lab_pemeriksaan as L2' , 'L2.kode_jasa' , 'lab_pemeriksaan.group_jasa')
	);

	public $where 		= array(
								array('lab_pemeriksaan.group_jasa' , '!=' , '000')
	);

	public $select 		= array('lab_pemeriksaan.*' , 'L2.nama_jasa as nama_kategori');

	public $filter 			= array( 
										'kategori_lab' => 'lab_pemeriksaan.group_jasa'
							);

	public function getColumns(){
		$column = array();

		$column['nama_jasa'] 	 	= 'Nama';
		$column['nama_kategori'] 	= 'Kategori';
		$column['unit'] 	 		= 'Satuan';
		$column['nilai_normal'] 	= 'Nilai Normal';

		return $column;
	}

	public function getSearchColumn(){
		$column 	= array('lab_pemeriksaan.nama_jasa');
		return $column;
	}

	public function form_add(){
		$forms	= array();

		$array 	= array();
		$where 	= array( array('pemeriksaan' ,'=', '0') );
		$options 	= $this->getDropdownTable( 'lab_pemeriksaan' , 'kode_jasa' , 'nama_jasa' , $where);
		$array['id'] 		= 'group_jasa';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'group_jasa';
		$array['label'] 	= 'Kategori';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_jasa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_jasa';
		$array['label'] 	= 'Nama Pemeriksaan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'unit';
		$array['type'] 		= 'text';
		$array['name'] 		= 'unit';
		$array['label'] 	= 'Satuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal';
		$array['label'] 	= 'Nilai normal';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_bayi';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_bayi';
		$array['label'] 	= 'Nilai normal bayi perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_bayi';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_bayi';
		$array['label'] 	= 'Nilai normal bayi laki-laki';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_balita';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_balita';
		$array['label'] 	= 'Nilai normal balita perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_balita';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_balita';
		$array['label'] 	= 'Nilai normal balita laki-laki';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_anak';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_anak';
		$array['label'] 	= 'Nilai normal anak perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_anak';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_anak';
		$array['label'] 	= 'Nilai normal anak laki-laki';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_dewasa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_dewasa';
		$array['label'] 	= 'Nilai normal dewasa perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_dewasa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_dewasa';
		$array['label'] 	= 'Nilai normal dewasa laki-laki';
		array_push($forms , $array);

		$options 			= array('0' => 'Tidak' , '1' => 'Ya');
		$array['id'] 		= 'pemeriksaan';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'pemeriksaan';
		$array['label'] 	= 'Pemeriksaan';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 			= array('0' => 'Tidak' , '1' => 'Ya');
		$array['id'] 		= 'permintaan';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'permintaan';
		$array['label'] 	= 'Order Lab';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}

	public function form_edit(){
		$forms	= array();

		$array 	= array();
		$where 	= array( array('pemeriksaan' ,'=', '0') );
		$options 	= $this->getDropdownTable( 'lab_pemeriksaan' , 'kode_jasa' , 'nama_jasa' , $where);
		$array['id'] 		= 'group_jasa';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'group_jasa';
		$array['label'] 	= 'Kategori';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nama_jasa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nama_jasa';
		$array['label'] 	= 'Nama Pemeriksaan';
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'unit';
		$array['type'] 		= 'text';
		$array['name'] 		= 'unit';
		$array['label'] 	= 'Satuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal';
		$array['label'] 	= 'Nilai normal';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_bayi';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_bayi';
		$array['label'] 	= 'Nilai normal bayi perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_bayi';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_bayi';
		$array['label'] 	= 'Nilai normal bayi laki-laki';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_balita';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_balita';
		$array['label'] 	= 'Nilai normal balita perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_balita';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_balita';
		$array['label'] 	= 'Nilai normal balita laki-laki';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_anak';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_anak';
		$array['label'] 	= 'Nilai normal anak perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_anak';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_anak';
		$array['label'] 	= 'Nilai normal anak laki-laki';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_pr_dewasa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_pr_dewasa';
		$array['label'] 	= 'Nilai normal dewasa perempuan';
		array_push($forms , $array);

		$array 	= array();
		$array['id'] 		= 'nilai_normal_lk_dewasa';
		$array['type'] 		= 'text';
		$array['name'] 		= 'nilai_normal_lk_dewasa';
		$array['label'] 	= 'Nilai normal dewasa laki-laki';
		array_push($forms , $array);

		$options 			= array('0' => 'Tidak' , '1' => 'Ya');
		$array['id'] 		= 'pemeriksaan';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'pemeriksaan';
		$array['label'] 	= 'Pemeriksaan';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);

		$options 			= array('0' => 'Tidak' , '1' => 'Ya');
		$array['id'] 		= 'permintaan';
		$array['type'] 		= 'select';
		$array['class'] 	= 'select2';
		$array['name'] 		= 'permintaan';
		$array['label'] 	= 'Order Lab';
		$array['options'] 	= $options;
		$array['required'] 	= 'required';
		array_push($forms , $array);

		return $forms;
	}
}