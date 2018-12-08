<script type="text/javascript">
	function doSave(ids, e){
		var code = e.keyCode || e.which;
		if(code == 13) {
			var val 	= $('#'+ids).val();
			var _class 	= $('#'+ids).attr('data-class');
			var id 		= $('#'+ids).attr('data-id');
			if( _class == 'stok-op'){
				$.ajax({
					url: "{{ url('apotek_opname/update_stok') }}",
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
			else{
				$.ajax({
					url: "{{ url('apotek_opname/update_het') }}",
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
		
	}
</script>