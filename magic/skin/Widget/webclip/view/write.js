
$(function(){
	
	$("form#widgetWrite").submit(function(){
		if($(this).find('select[name="skin"]').val()=='') {
			alert("스킨을 선택하세요");
			$(this).find('select[name="skin"]').focus();
			return false;
		}
	});
});
