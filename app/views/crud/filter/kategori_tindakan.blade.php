<?php $filter_kategori = DB::table('tbkategoritindakan')->get(); ?>
<div class="span2">
	Kategori <br />
	<select name="fl_kategori_tindakan" id="fl_kategori_tindakan" class="select2 span12">
		<option value="">-Semua-</option>
		@foreach($filter_kategori as $fd)
			<option value="{{ $fd->id }}">{{ $fd->nama }}</option>
		@endforeach
	</select>
</div>