

$(function() {
	
	/*
	 * 댓글 submit 검사
	 * 폼의 내용검사
	 */
	$("#comments form").live("submit",function(){
		
		var cmt_writer = $(this).find("input[name='cmt_writer']");
		if(cmt_writer.attr("name")=="cmt_writer") {
			if(cmt_writer.val()=='') {
				alert("글쓴이를 입력하세요.");
				cmt_writer.focus();
				return false;
			}
		}
		
		var cmt_password = $(this).find("input[name='cmt_password']");
		if(cmt_password.attr("name")=="cmt_password") {
			if(cmt_password.val()=='') {
				alert("비밀번호를 입력하세요.");
				cmt_password.focus();
				return false;
			}
		}
		
		var zsf = $(this).find("input[name='zsfCode']");
		if(zsf.attr("name")=="zsfCode") {
			if(zsf.val()=='') {
				alert("자동등록방지 코드를 입력하세요.");
				zsf.focus();
				return false;
			}
		}
		
		if(
			$(this).find("input[name='edit']").val()==0 ||
			$(this).find("textarea").val()=='')
		{
			alert("내용을 입력하세요.");
			$(this).find("textarea").focus();
			return false;
		}
	});
	
});
