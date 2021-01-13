<label for="ProName">Tên Sản Phẩm:</label><br>
<input type="text" id="ProName"><br>
<label for="ProPrice">Tên Sản Phẩm:</label><br>
<input type="number" id="ProPrice"><br><br>
<button onclick="ajaxInsertDB()">Submit</button>
<script type="text/javascript">
$(document).ready(	
	function(){

	}
);
function ajaxInsertDB() {
	$.ajax({
	    type: "POST",
	    url: '<?php echo $forminsertproduc; ?>', 
	    data: {ProName: $("#ProName").val(),ProPrice: $("#ProPrice").val()},
	    dataType: 'json',
	}).done(function(data){
		var kq=data.id;
		if(kq > 0)
		{
			window.location.href='<?php echo $urlIndex; ?>';
		}
	});
}
</script>
