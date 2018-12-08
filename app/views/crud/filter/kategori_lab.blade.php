<?php $filter_kategori = DB::table('lab_pemeriksaan')->where('group_jasa' , '0101')->get(); ?>
<div class="span2">
	Kategori <br />
	<select name="fl_kategori_lab" id="fl_kategori_lab" class="select2">
		<option value="">-Semua-</option>
		@foreach($filter_kategori as $fd)
			<option value="{{ $fd->kode_jasa }}">{{ $fd->nama_jasa }}</option>
		@endforeach
	</select>
</div>