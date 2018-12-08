<div class="span3">
	Poli
	<select name="fl_poli" id="fl_poli" class="select2">
		<option value="">-Semua Poli-</option>
		<?php
			$user = Auth::user();
			$group = DB::table('groups')->where('id',$user->group_id)->first();
			if( isset($group->poli) && !empty($group->poli)){
				$poli = json_decode($group->poli);
				$list_poli 	= DB::table('tbpoli')->whereIn('IdPoli' , $poli)->get();
			}
			else{
				$list_poli 	= DB::table('tbpoli')->get();
			}
		?>
		@foreach($list_poli as $fp)
			<option value="{{ $fp->IdPoli }}">{{ $fp->NamaPoli }}</option>
		@endforeach
	</select>
</div>
