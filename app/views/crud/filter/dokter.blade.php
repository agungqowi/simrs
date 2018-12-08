<?php $filter_dokter = DB::table('tbdaftardokter')->get(); ?>
<div class="span2">
	Dokter
	<select name="fl_dokter" id="fl_dokter" class="select2">
		<option value="">-Semua-</option>
		@foreach($filter_dokter as $fd)
			<option value="{{ $fd->IdDokter }}">{{ $fd->NamaDokter }}</option>
		@endforeach
	</select>
</div>