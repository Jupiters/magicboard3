
$(function(){
	$("form.page").submit(function(){
		// cheditor가 로드되어 있는지 체크하고 실행함
		if(typeof doSubmit == 'function') { doSubmit($(this)); } 
		// form 체크
		if($(this).find("input[name='wr_content']").val()=='') { alert("내용을 입력하세요"); return false; }
		return true;
	});
});