<div class="span3">
	Poli <br />
	<select name="fl_poli" id="fl_poli" class="select2">
		
		<?php
			$all_poli = 'no';
			$user = Auth::user();
			$group = DB::table('groups')->where('id',$user->group_id)->first();
			if( isset($group->poli) && !empty($group->poli)){
				$poli = json_decode($group->poli);
				$list_poli 	= DB::table('tbpoli')->whereIn('IdPoli' , $poli)->get();
				$group_name 	= $group->name;
				$u 	= strtolower($user->name);
				$g 	= strtolower($group_name);
				if( $u == 'admin' || $g == 'admin' || $u == 'administrator' || $g == 'administrator'){
					$all_poli = 'yes';
				}
			}
			else{
				$list_poli 	= DB::table('tbpoli')->get();
				$all_poli	= 'yes';
			}
		?>
		@if( $all_poli == 'yes' )
			<option value="">-Semua Poli-</option>
		@endif

		@foreach($list_poli as $fp)
			<option value="{{ $fp->IdPoli }}">{{ $fp->NamaPoli }}</option>
		@endforeach
	</select>
</div>
