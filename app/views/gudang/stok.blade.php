<script type="text/javascript">
	function doSave(id, e){
		var code = e.keyCode || e.which;
		if(code == 13) {
			var val 	= $('#'+id).val();
			var id 		= $('#'+id).attr('data-id');
			$.ajax({
				url: "{{ url('gudang_opname/update_stok') }}",
				type: "POST",
				data : "id="+id+"&value="+val,
				success(e){
					$('#'+id).css('background-color' , 'yellow');
					jQuery('#tbl_list').dataTable().fnDraw(false);
				},
				error(e,m){

				}
			});
			
		}
		
	}
</script>