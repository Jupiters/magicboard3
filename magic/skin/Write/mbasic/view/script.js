
$(function(){
	$("select.category").change(function(){
		if($(this).val()!='') {
			location.href=$(this).val();
		}
	});
});
