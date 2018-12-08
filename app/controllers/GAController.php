<?php

class GAController extends Controller {

	protected $rs_title		= 'RSU Gladish';
	protected $rs_alamat 	= '';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function getSingleData( $table , $where = array() , $select = "" ){
		$single = DB::table($table);
		foreach( $where as $key => $value ){
			$single->where($key,$value);
		}
		

		if( $select == "" ){
			$result = $single->first();
		}
		else
			$result = $single->pluck( $select );

		return $result;
	}

	protected function getTableData( $table , $select = array() , $where = array() , $orderBy = array() ){
		$data = DB::table($table);
		if( count($where) > 0 ){
			foreach( $where as $key => $value ){
				$data->where($key,$value);
			}
		}

		if( count($orderBy) > 0 ){
			foreach( $orderBy as $key => $value ){
				$data->orderBy($key,$value);
			}
		}


		$data = $data->get();
		return $data;
	}

	protected function getTableDataComplex( $table , $select = array() , $where = array() , $orderBy = array() ){
		$data = DB::table($table);
		if( count($where) > 0 ){
			foreach( $where as $value ){
				$data->where($value[0] , $value[1] , $value[2]);
			}
		}

		if( count($orderBy) > 0 ){
			foreach( $orderBy as $key => $value ){
				$data->orderBy($key,$value);
			}
		}


		$data = $data->get();
		return $data;
	}

	protected function inputDataBaru( $table , $data = array() ){
		$insert = DB::table( $table )->insertGetId( $data );
		return $insert;
	}

	protected function updateDataBaru( $table , $data = array() , $where = array()){
		$update = DB::table( $table );
		foreach( $where as $key => $value ){
			$update->where($key,$value);
		}
		$result = $update->update( $data );
		return $result;
	}

	protected function getCountData( $table , $where = array() ){
		$single = DB::table($table);
		foreach( $where as $key => $value ){
			$single->where($key,$value);
		}
		
		$result = $single->count();

		return $result;
	}

	protected function deleteSingleData( $table , $where = array() ){
		$single = DB::table($table);
		foreach( $where as $key => $value ){
			$single->where($key,$value);
		}
		
		$result = $single->delete();

		return $result;
	}

	protected function getDropdownTable( $table , $k , $v , $where = array() , $order = array() ){
		$single = DB::table($table);
		foreach( $where as $w ){
			$single->where($w[0],$w[1],$w[2]);
			
		}

		if( count($order) > 0 ){
			$single->orderBy( $order[0] , $order[1] );
		}
		
		$results = $single->get();

		if( count($results) > 0 ){
			$result = array();
			foreach( $results as $row ){
				$result[ $row->$k ] = $row->$v;
			}
		}
		else{
			$result = array();
		}
		return $result;
	}

	protected function getComplexDropdownTable( $table , $k , $where = array() , $orderBy = array() ){
		$single = DB::table($table);
		foreach( $where as $key => $value ){
			$single->where($key,$value);
		}

		if( count($orderBy) > 0 ){
			foreach($orderBy as $o){
				$single->orderBy($o[0] , $o[1]);
			}
		}
		
		$results = $single->get();

		if( count($results) > 0 ){
			$result = array();
			foreach( $results as $row ){
				$result[ $row->$k ] = $row;
			}
		}
		else{
			$result = array();
		}


		return $result;
	}


	public function getDatatable($param){
		$table 		= $param['table'];
		$columns 	= $param['columns'];
		$joins 		= $param['joins'];
		$primary 	= $param['primary'];
		$leftjoin 	= $param['leftjoin'];
		$wheres 	= $param['wheres'];
		if( isset($param['whereins']) ){
			$whereins 	= $param['whereins'];
		}
		$filters 	= $param['filters'];
		$select 	= $param['select'];
		$order 		= $param['order'];

		$data 		= DB::table( $table );
		if( isset($joins) && count($joins) > 0 ){
			foreach( $joins as $join ){
				$data->join( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($leftjoin) && count($leftjoin) > 0 ){
			foreach( $leftjoin as $join ){
				$data->leftJoin( $join[0], $join[1], '=', $join[2] );
			}
		}

		if( isset($wheres) && count($wheres) > 0 ){
			foreach( $wheres as $where ){
				if($where[1] == 'raw'){
					$date = date('Y-m-d');
					$data->whereRaw( $where[0] );
				}
				else{
					$data->where( $where[0], $where[1], $where[2] );
				}				
			}
		}

		if( isset($whereins) && count($whereins) > 0 ){
			foreach( $whereins as $where ){				
				$data->whereIn( $where[0], $where[1] );
			}
		}

		if( isset($filters) && count($filters) > 0 ){
			$betwen_tanggal = 0;
			foreach( $filters as $fa => $fb ){
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

		if( isset($select) && count($select) > 0 ){
			$data->select( $select );
		}

		if( isset($order) ){
			$data->orderBy( $order[0] ,$order[1] );
		}

		
		$table =  Datatable::query($data);
		$array 		= array();

		$this->primary 	= $primary;

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
				else{
					return ' ';
				}
			}
			else{
				if(!empty($key)){
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
							$primary 	= $this->primary;
							if( isset($model->$key) && !empty($model->$key) ){
								$actions 	= $model->$key;

								if( isset($this->custom_action) ){
				        			$action = $this->custom_action;
				        			if( count($action) > 0 ){
				        				foreach($action as $ac){
				        					$alt 			= $class = "";
				        					$target 		= $ac['target'];
				        					$targets		= explode('{primary}', $ac['target']);
				        					$blank 			= "";
				        					if( isset($ac['blank']) )
				        						$blank		= "target = '_BLANK'";

				        					if(isset($ac['alt'])){
				        						$alt 		= $ac['alt'];
				        						$class 		= "class='tootip_l'";
				        					}
				        					if( count($targets) > 1 ){
				        						$target 	= $targets[0].$model->$primary.$targets[1];
				        					}
				        					$actions = '<a '.$blank.' '.$class.' title="'.$alt.'" href="'.url($target).'">'.$model->$key.'</a>';
				        				}
				        			}
				        		}

								return $actions;
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
		if(isset($param['search'])){
			$table = $table->searchColumns( $param['search'] );
		}
		else if( method_exists($this ,'getSearchColumn')){
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

		 

}
