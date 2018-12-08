<?php $filter_jenis = DB::table('tbtindakanjenis')->get(); ?>
<div class="span2">
	Jenis Rawat <br />
	<select name="fl_jenis_tindakan" id="fl_jenis_tindakan" class="select2 span12">
		<option value="">-Semua-</option>
		@foreach($filter_jenis as $fs)
			<option value="{{ $fs->id }}">{{ $fs->nama_jenis }}</option>
		@endforeach
	</select>
</div>