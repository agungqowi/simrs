<?php $filter_kategori = DB::table('radiologi_pemeriksaan')->where('gr_rad' , '-')->get(); ?>
<div class="span2">
	Kategori <br />
	<select name="fl_kategori_lab" id="fl_kategori_lab" class="select2">
		<option value="">-Semua-</option>
		@foreach($filter_kategori as $fd)
			<option value="{{ $fd->kd_rad }}">{{ $fd->nama_rad }}</option>
		@endforeach
	</select>
</div>