<?php $filter_jenis = DB::table('apo_jenisobat')->orderBy('kodejenis' , 'ASC')->get(); ?>
<div class="span2">
	Jenis Alkes Obat <br />
	<select name="fl_kategori_obat" id="fl_kategori_obat" class="select2 span12">
		<option value="">-Semua-</option>
		@foreach($filter_jenis as $fs)
			<option value="{{ $fs->id }}">{{ $fs->namajenis }}</option>
		@endforeach
	</select>
</div>