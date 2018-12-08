<?php

class CrudController extends \BaseController {

	protected $form_span = '6';
	private $custom_url = false;

	public function index()
	{	
		$data 		= $this->getTableData( $this->table );
		$column 	= $this->getColumns();

		$js_include = $filter = $custom_action = $custom_add = $disable_add = $disable_edit = $disable_delete = $disable_action = false;

		if(isset($this->disable_add))
			$disable_add = $this->disable_add;

		if(isset($this->disable_edit))
			$disable_edit = $this->disable_edit;

		if(isset($this->disable_delete))
			$disable_delete = $this->disable_delete;

		if(isset($this->custom_add))
			$custom_add = $this->custom_add;

		if(isset($this->disable_action))
			$disable_action = $this->disable_action;

		if(isset($this->filter))
			$filter = $this->filter;

		if(isset($this->custom_action))
			$custom_action = $this->custom_action;


		if(isset($this->js_include))
			$js_include = $this->js_include;

		return View::make('crud.list', 
			array(
				'data' 		=> $data , 
				'column' 	=> $column ,
				'title'		=> $this->title,
				'slug'		=> $this->slug,
				'controller'=> $this->controller,
				'disable_edit'		=> $disable_edit,
				'disable_delete' 	=> $disable_delete,
				'disable_add'		=> $disable_add,
				'disable_action'	=> $disable_action,
				'filter'			=> $filter,
				'custom_add'		=> $custom_add,
				'js_include'		=> $js_include
			)
		);
	}

	public function datatable(){
		$data 		= DB::table( $this->table );
		if( isset($this->join) && count($this->join) > 0 ){
			foreach( $this->join as $join ){
				$data->join( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($this->leftjoin) && count($this->leftjoin) > 0 ){
			foreach( $this->leftjoin as $join ){
				$data->leftJoin( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($this->where) && count($this->where) > 0 ){
			foreach( $this->where as $where ){
				if($where[1] == 'raw'){
					$date = date('Y-m-d');
					$data->whereRaw( $where[0] );
				}
				else{
					$data->where( $where[0], $where[1], $where[2] );
				}				
			}
		}

		if( isset($this->orWhere) && count($this->orWhere) > 0 ){
			foreach( $this->orWhere as $where ){
				$data->orWhere( $where[0], $where[1], $where[2] );
			}
		}

		if( isset($this->filter) && count($this->filter) > 0 ){
			$betwen_tanggal = 0;
			foreach( $this->filter as $fa => $fb ){
				if($fa == 'dari_tanggal' || $fa == 'sampai_tanggal'){
					if( $betwen_tanggal == 0 ){
						$tanggal1 = explode('/', Input::get('fl_dari_tanggal') );
						$tanggal2 = explode('/', Input::get('fl_sampai_tanggal') );

						$dari_tanggal = $tanggal1[2].'-'.$tanggal1[1].'-'.$tanggal1[0];
						$sampai_tanggal = $tanggal2[2].'-'.$tanggal2[1].'-'.$tanggal2[0];
						$data->whereBetween($fb , array( $dari_tanggal , $sampai_tanggal ));
					}
					$betwen_tanggal++;
				}
				else{
					$value_filter = Input::get('fl_'.$fa);
					if( empty($value_filter) || $value_filter == '-' ){

					}
					else{
						$data->where( $fb, '=' , $value_filter );
					}
					
				}				
			}
		}

		if( isset($this->select) && count($this->select) > 0 ){
			$data->select( $this->select );
		}

		if( isset($this->order) ){
			$order = $this->order;
			$data->orderBy( $order[0] ,$order[1] );
		}

		$columns 	= $this->getColumns();
		
		
		$table =  Datatable::query($data);
		$array 		= array();
		foreach( $columns as $key => $value){
			if( is_array($value) ){
				if($value['type'] == 'select'){
					$property 	= array('key' => $key , 'value' => $value);
					$table = $table->addColumn($key,function($model) use($property){
						$key 	= $property['key'];
						$value 	= $property['value'];
						$return = '';
						foreach($value['value'] as $a => $b){
							if($a == $model->$key){
								$return = $b;
							}
						}
						return $return;
        			});
				}
				else if($value['type'] == 'date'){
					$table = $table->addColumn( $key ,function($model) use($key){
							if( isset($model->$key) && !empty($model->$key) ){
								$tanggal 	= explode('-' , $model->$key);
								return $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0];
							}
							else{
								return ' ';
							}
					});
				}
				else if($value['type'] == 'datetime'){
					$table = $table->addColumn( $key ,function($model) use($key){
							if( isset($model->$key) && !empty($model->$key) ){
								$datetime 	= explode(' ' , $model->$key);
								$tanggal 	= explode('-' , $datetime[0]);
								return $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0].' '.$datetime[1];
							}
							else{
								return ' ';
							}
					});
				}
				else if($value['type'] == 'currency'){
					$table = $table->addColumn( $key ,function($model) use($key){
							if( isset($model->$key) && !empty($model->$key) ){
								$nilai 		= round($model->$key);
								$currency 	= number_format($nilai);
								return $currency;
							}
							else{
								return ' ';
							}
					});
				}
				else if($value['type'] == 'inputtext'){
					$datas = array('key' => $key , 'value' => $value , 'primary' => $this->primary);
					$table = $table->addColumn( $key ,function($model) use($datas){
							$key 	= $datas['key'];
							$primary= $datas['primary'];
							if( isset($model->$key) ){
								$value 	= $datas['value'];
								$name 	= $key."['".$model->$primary."']";
								$return = '<input type="text" id="'.$key.'_'.$model->$primary.'" 
								data-id="'.$model->$primary.'"
								data-class="'.$value['class'].'"
								name="'.$name.'" class="'.$value['class'].'" 
								onkeydown=doSave("'.$key.'_'.$model->$primary.'",event)
								value="'.$model->$key.'" />';

								return $return;
							}
							else{
								return ' ';
							}
					});
				}
				else{
					return ' ';
				}
			}
			else{
				if(isset($key)){
					if($key == 'Tanggal'){
						$table = $table->addColumn( $key ,function($model) use($key){
							if( isset($model->$key) && !empty($model->$key) ){
								$tanggal 	= explode('-' , $model->key);
								return $tanggal[2].'/'.$tanggal[1].'/'.$tanggal[0];
							}
							else{
								return ' ';
							}
						});
					}
					else{
						$table = $table->addColumn( $key ,function($model) use($key){
							if( isset($model->$key) ){
								return $model->$key;
							}
							else{
								return ' ';
							}
						});
					}					
				}
				else{
					return ' ';
				}
			}
			$array[] 	= $key;
		}
		if( method_exists($this ,'getSearchColumn')){
			$searchs 	= $this->getSearchColumn();
			$table 		= $table->searchColumns( $searchs );	
		}
		else{
			$table = $table->searchColumns( $array );	
		}
		
		if(!isset($this->disable_action))
			$this->disable_action = false;
		if(!$this->disable_action){
			$table = $table->addColumn('actions',function($model)
        	{
        		$primary 	= $this->primary;
        		if( isset($this->custom_edit) ){
        			$edit = '<a class="tootip_l" title="Ubah" href="'.url($this->custom_edit.'/'.$model->$primary).'"><i class="splashy-document_letter_edit"></i></a>';
        		}
        		else{
        			$edit = '<a class="tootip_l" title="Ubah" href="'.url($this->slug.'/'.$model->$primary.'/edit').'"><i class="splashy-document_letter_edit"></i></a>';
        		}
        		
        		$delete = '<a class="tootip_l" title="Hapus" href="javascript:void(0)" onclick="hapus_data('."'".$model->$primary."',' '".')"><i class="splashy-gem_remove"></i></a>';
        		
        		
        		if(isset($this->disable_edit) && $this->disable_edit == true){
        			$edit 	= "";
        		}

        		if( isset($this->disable_delete) && $this->disable_delete == true){
        			$delete = "";
        		}

        		$actions = "";
        		if( isset($this->custom_action) ){
        			$action = $this->custom_action;
        			if( count($action) > 0 ){
        				foreach($action as $ac){
        					$alt 		= $class = "";
        					$target 	= $ac['target'];
        					$targets	= explode('{primary}', $ac['target']);

        					if(isset($ac['alt'])){
        						$alt 		= $ac['alt'];
        						$class 		= "class='tootip_l'";
        					}
        					if( count($targets) > 1 )
        						$target 	= $targets[0].$model->$primary.$targets[1];
        					$actions .= '&nbsp;&nbsp;'.'<a '.$class.' title="'.$alt.'" href="'.url($target).'"><i class="'.$ac['icon'].'"></i></a>';
        				}
        			}
        		}

            	return $edit.'&nbsp;&nbsp;'.$delete.$actions;
        	});
		}
		$table = $table->make();

        return $table;
	}

	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$forms 	= $this->form_add();
		$custom_add = $disable_add = $disable_edit = $disable_delete = false;

		if(isset($this->disable_add))
			$disable_add = $this->disable_add;

		if(isset($this->disable_edit))
			$disable_edit = $this->disable_edit;

		if(isset($this->disable_delete))
			$disable_delete = $this->disable_delete;

		if(isset($this->custom_add))
			$custom_add = $this->custom_add;

		return View::make('crud.create' , 
			array(	
				'forms' 			=> $forms,
				'title'				=> $this->title,
				'slug'				=> $this->slug,
				'form_span'			=> $this->form_span,
				'controller'		=> $this->controller,
				'disable_edit'		=> $disable_edit,
				'disable_delete' 	=> $disable_delete,
				'disable_add'		=> $disable_add,
				'custom_add'		=> $custom_add
			)
		);
	}


	public function custom_form($forms)
	{
		$custom_url = $custom_add = $disable_add = $disable_edit = $disable_delete = false;

		if(isset($this->disable_add))
			$disable_add = $this->disable_add;

		if(isset($this->disable_edit))
			$disable_edit = $this->disable_edit;

		if(isset($this->disable_delete))
			$disable_delete = $this->disable_delete;

		if(isset($this->custom_add))
			$custom_add = $this->custom_add;

		return View::make('crud.create' , 
			array(	
				'forms' 			=> $forms,
				'title'				=> $this->title,
				'slug'				=> $this->slug,
				'url'				=> $this->custom_url,
				'form_span'			=> $this->form_span,
				'controller'		=> $this->controller,
				'disable_edit'		=> $disable_edit,
				'disable_delete' 	=> $disable_delete,
				'disable_add'		=> $disable_add,
				'custom_add'		=> $custom_add
			)
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$forms 	= $this->form_add();
		$rules	= array();
		$data 	= array();

		$slug 	= $this->slug;
		foreach( $forms as $fo ){
			if( isset($fo['required']) && $fo['required'] == 'required' ){
				$rules[ $fo['name'] ] = 'required';
			}

			$data[ $fo['name'] ] = Input::get( $fo['name'] );

			if( $fo['type'] == 'date' ){
				$dates 					= explode( '/' , Input::get( $fo['name'] ) );
				if( isset($dates) && count($dates) > 1 )
					$data[ $fo['name'] ]  	= $dates['2'].'-'.$dates[1].'-'.$dates[0];
			}
			else if( $fo['type'] == 'password' ){
				$data[ $fo['name'] ] = Hash::make( Input::get( $fo['name'] ) );
			}
			else if( $fo['type'] == 'multiple' ){
				$data[ $fo['name'] ] = json_encode( Input::get( $fo['name'] ) );
			}
			else if( $fo['type'] == 'multiple_menu' ){
				$data[ $fo['name'] ] = json_encode( Input::get( $fo['name'] ) );
			}
		}

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to( $this->slug.'/create' )
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$input 			= true;
			$primary_unique = false;
			if( isset( $this->unique ) && count( $this->unique ) > 0 ){
				$data_unique	= array();
				foreach( $this->unique as $un ){
					$data_unique[ $un ] = Input::get( $un );
				}
				//die();
				$exist = $this->getSingleData( $this->table , $data_unique ,"" );
				if( $exist )
					$input = false;
			}

			if( isset( $this->unique ) && count( $this->unique ) == 1 ){
				$temp_un = $this->unique;
				if( $temp_un[0] == $this->primary )
					$primary_unique = true;
			}

			if( $input ){
				$id = $this->inputDataBaru( $this->table , $data );
				$insert_id = $id;
				if($primary_unique){
					$id  		= true;
					$insert_id 	= Input::get($this->primary);
				}
				if( $id ){
					if( isset($this->oninsert) && !empty($this->oninsert)){
						foreach( $this->oninsert as $o1 => $o2 ){
							if( $o1 == 'update' ){
								$otable = $o2[0];
								$odatas = $o2[1];
								$wheres = $o2[2];

								$odata = array();
								if( isset($odatas) && count($odatas) > 0 ){
									foreach($odatas as $od1 => $od2 ){
										foreach($od2 as $oe1 => $oe2 ){
											if( $oe1 == 'this' ){
												$temp_content = $this->$oe2;
											}
											else if( $oe1 == 'element' ){
												$temp_content = Input::get($oe2);
											}
											else{
												$temp_content = $oe2;
											}
										}
										$odata[ $od1 ] = $temp_content;
									}
								}

								$owhere = array();
								if( isset($wheres) && count($wheres) > 0 ){
									foreach($wheres as $od1 => $od2 ){
										foreach($od2 as $oe1 => $oe2 ){
											if( $oe1 == 'this' ){
												$temp_content = $this->$oe2;
											}
											else if( $oe1 == 'element' ){
												$temp_content = Input::get($oe2);
											}
											else{
												$temp_content = $oe2;
											}
										}
										$owhere[ $od1 ] = $temp_content;
									}
								}

								$this->updateDataBaru( $otable , $odata , $owhere );
							}
						}
					}
					return Redirect::to($slug.'/'.$insert_id.'/edit')->with('success', 'Berhasil menambahkan '.$this->title);
				}
				else{
					return Redirect::to($slug.'/create')->with('error', 'Gagal menambahkan '. $this->title)
					->withInput(); // send back the input (not the password) so that we can repopulate the form;
				}
			}
			else{
				return Redirect::to($slug.'/create')->with('error', 'Error Duplikasi data '. $this->title)
				->withInput(); // send back the input (not the password) so that we can repopulate the form;
			}
			
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$note = Note::find($id);

		return View::make('golongan.show')->with('note', $note);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the note
		$data 	= $this->getSingleData( $this->table , array( $this->primary => $id ) );
		$primary= $this->primary;
		$forms 	= $this->form_edit();

		$custom_add = $disable_add = $disable_edit = $disable_delete = false;

		if(isset($this->disable_add))
			$disable_add = $this->disable_add;

		if(isset($this->disable_edit))
			$disable_edit = $this->disable_edit;

		if(isset($this->disable_delete))
			$disable_delete = $this->disable_delete;

		if(isset($this->custom_add))
			$custom_add = $this->custom_add;

		// show the edit form and pass the note
		if( isset($data->$primary) ){
			return View::make('crud.create' , 
				array(
					'data' 		=> $data,
					'forms' 	=> $forms,			
					'title'		=> $this->title,
					'slug'		=> $this->slug,
					'controller'=> $this->controller,
					'type'		=> 'edit',
					'form_span'	=> $this->form_span,
					'primary_id'=> $data->$primary,
					'disable_edit'		=> $disable_edit,
					'disable_delete' 	=> $disable_delete,
					'disable_add'		=> $disable_add,
					'custom_add'		=> $custom_add
				)
			);
		}
		else{
			return View::make('crud.404');
		}
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$forms 	= $this->form_edit();
		$rules	= array();
		$data 	= array();

		$slug 	= $this->slug;
		foreach( $forms as $fo ){
			if( isset($fo['required']) && $fo['required'] == 'required' ){
				$rules[ $fo['name'] ] = 'required';
			}

			$data[ $fo['name'] ] = Input::get( $fo['name'] );

			if( $fo['type'] == 'date' ){
				$dates 					= explode( '/' , Input::get( $fo['name'] ) );
				if( isset($dates) && count($dates) > 1 )
					$data[ $fo['name'] ]  	= $dates['2'].'-'.$dates[1].'-'.$dates[0];
			}
			else if( $fo['type'] == 'password' ){
				$v = Input::get( $fo['name'] );
				if( !empty($v) )
					$data[ $fo['name'] ] = Hash::make( Input::get( $fo['name'] ) );
				else
					unset( $data[$fo['name']] );
			}
			else if( $fo['type'] == 'multiple' ){
				$vs = Input::get( $fo['name'] );
				if( empty($vs) ){
					$vs = array();
				}
				$data[ $fo['name'] ] = json_encode( $vs );
			}
			else if( $fo['type'] == 'multiple_menu' ){
				$vs = Input::get( $fo['name'] );
				if( empty($vs) ){
					$vs = array();
				}
				$data[ $fo['name'] ] = json_encode( $vs );
			}
		}

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to( $this->slug.'/'.$id.'/edit' )
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {
			$input = true;

			if( isset($this->unique) && count( $this->unique ) > 0 ){
				$ori_data 		= $this->getSingleData( $this->table , array( $this->primary => $id ) ,"" );
				$data_unique	= array();

				$flag_unique	= 0;

				foreach( $this->unique as $un ){
					$data_unique[ $un ] = Input::get( $un );
					if( $ori_data->$un != $data[ $un ] ){
						$flag_unique = 1;
					}
				}
				//die();
				if( $flag_unique == 1 ){
					$exist = $this->getSingleData( $this->table , $data_unique ,"" );
					if( $exist )
						$input = false;
				}
				
			}

			if( $input ){
				$res = $this->updateDataBaru( $this->table , $data , array( $this->primary => $id ) );
				if( $res ){
					return Redirect::to($slug.'/'.$id.'/edit')->with('success', 'Berhasil mengubah '.$this->title);
				}
				else{
					return Redirect::to($slug.'/'.$id.'/edit')->with('error', 'Gagal mengubah '. $this->title)
					->withInput(); // send back the input (not the password) so that we can repopulate the form;
				}
			}
			else{
				return Redirect::to($slug.'/'.$id.'/edit')->with('error', 'Error Duplikasi data '. $this->title)
				->withInput(); // send back the input (not the password) so that we can repopulate the form;
			}
			
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$count = 0;
		//Cek apakah sudah pernah ada transaksi jika iya, dokter tidak bisa dihapus
		if( isset( $this->table_trans) )
			$count = $this->getCountData( $this->table_trans , array( $this->field_trans => $id ) );

		if($count > 0){
			return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' tidak diizinkan untuk dihapus');
		}
		else{
			if (isset($this->ondestroy) && !empty($this->ondestroy)){
				foreach($this->ondestroy as $o1 => $o2) {
					if ($o1 == 'update') {
						$otable = $o2[0];
						$odatas = $o2[1];
						$wheres = $o2[2];
						$odata = array();
						if (isset($odatas) && count($odatas) > 0){
							foreach($odatas as $od1 => $od2) {
								foreach($od2 as $oe1 => $oe2) {
									if ($oe1 == 'this') {
										$temp_content = $this->$oe2;
									}
									else if ($oe1 == 'element'){
										$temp_content = Input::get($oe2);
									}
									else{
										$temp_content = $oe2;
									}
								}

								$odata[$od1] = $temp_content;
							}
						}

						$owhere = array();
						if (isset($wheres) && count($wheres) > 0){
							foreach($wheres as $od1 => $od2){

								foreach($od2 as $oe1 => $oe2){

									if ($oe1 == 'this'){
										$temp_content = $this->$oe2;
									}
									else if ($oe1 == 'element'){
										$temp_content = Input::get($oe2);
									}
									else if ($oe1 == 'table'){										
										$temp_table = $oe2[0];
										$temp_field 	= $oe2[1];
										foreach($oe2[2] as $of1 => $of2){
											foreach($of2 as $og1 => $og2){
												$tempc = "";
												if ($og1 == 'this'){
													$temp_c = $this->$og2;
												}
												else if ($og1 == 'element'){
													$temp_c = Input::get($og2);
												}
												else if ($og1 == 'id'){
													$temp_c = $id;
												}
												else{
													$temp_c = $og2;
												}

											}
											$temp_where[$of1] = $temp_c;
										}

										$single = $this->getSingleData( $temp_table , $temp_where );
										
										$temp_content = $single->$temp_field;
									}
									else {
										$temp_content = $oe2;
									}
								}

								$owhere[$od1] = $temp_content;
							}
						}

						$this->updateDataBaru($otable, $odata, $owhere);
					}
				}
			}

			$this->deleteSingleData( $this->table , array( $this->primary => $id ) );
			return Redirect::to( $this->slug )->with('success', 'Data '.$this->title.' berhasil dihapus');
		}
	}

	public function save_ajax(){
		$table = $_POST['table'];
		$total = intval( $_POST['total'] );

		$data = array();
		for($i=1;$i<=$total;$i++){
			$data[ $_POST['key'.$i] ] =  $_POST['val'.$i];
		}

		$id = DB::table($table)->insertGetId($data);
		echo($id);

		die();
	}

	public function load_ajax(){
		$table = $_POST['table'];
		$key = $_POST['key'];
		$value = $_POST['value'];

		$return = $this->getDropdownTable( $table , $key , $value );
		$ret = array();
		if( count($return) > 0){
			foreach($return as $k => $v ){
				$array = array();

				$array['key'] = $k;
				$array['value'] = $v;

				array_push($ret, $array);
			}
		} 
		echo json_encode($ret);
		die();
	}
}
