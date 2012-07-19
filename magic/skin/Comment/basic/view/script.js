

$(function() {
	/*
	 * 댓글 입력폼 토글
	 * Ajax를 이용해서 입력폼을 가져옴
	 * 가져오고나서 DefineEvent()함수를 다시 호출해서 이벤트를 다시 등록한다.
	 */
	$("#comments .reply").click(function() {
		var input = $(this).parentsUntil("ul").children("ul").children("li.input");
		var url = $(this).attr('href');
		if(input.html()=='') {
			$.ajax({
				type:'post',
				url:url,
				data:null,
				success:function(data) {
					input.html(data);
					input.toggle("blind", '', 200, function(){
						$(this).find("textarea").focus();
					});
					DefineButton();
					DefineTooltip();
				}
			});
		} else {
			input.toggle("blind", '', 200, function(){
				$(this).find("textarea").focus();
			});
		}
		return false;
	});
	
	/*
	 * 댓글의 댓글 입력폼 토글
	 */
	$("#comments ul.children .reply").click(function() {
		var input = $(this).parentsUntil("ul").siblings("li.input");
		var url = $(this).attr('href');
		if(input.html()=='') {
			$.ajax({
				type:'post',
				url:url,
				data:null,
				success:function(data) {
					input.html(data);
					input.toggle("blind", '', 200, function(){
						$(this).find("textarea").focus();
					});
					DefineButton();
					DefineTooltip();
				}
			});
		} else {
			input.toggle("blind", '', 200, function(){
				$(this).find("textarea").focus();
			});
		}
		return false;
	});
	/*
	 * 댓글입력...
	 * 텍스트 사라지게함
	 */
	$("#comments textarea").live("focus",function() {
		if($(this).siblings("input[name='edit']").val()==0) {
			$(this).val("");
		}
	});
	/*
	 * 댓글입력...
	 * 텍스트 나타나게함
	 */
	$("#comments textarea").live("focusout",function() {
		if($(this).siblings("input[name='edit']").val()==0) {
			$(this).val("댓글입력...");
		}
	});
	
	/*
	 * 입력폼 자동 스트레칭
	 * 엔터칠때마다 입력폼이 늘어남
	 */
	$("#comments textarea").live("keyup", function() {
		$(this).siblings("input[name='edit']").val(1);
		var rows = $(this).val().match(/\n/g).length+1;
		if(rows<=2) rows=2;
		$(this).attr("rows", rows);
	});
	
	/*
	 * 댓글 submit 검사
	 * 폼의 내용검사
	 */
	$("#comments form").live("submit",function(){
		if(
			$(this).find("input[name='edit']").val()==0 ||
			$(this).find("textarea").val()=='')
		{
			alert("내용을 입력하세요.");
			$(this).find("textarea").focus();
			return false;
		}
	});
	
	/*
	 * 삭제 다이얼로그
	 */
	$("#comments .delete").click(function() {
    if(confirm("삭제한 댓글은 복구할 수 없습니다.\n정말로 삭제 하시겠습니까?")) {
      return true;
    }
		return false;
	});
	
});
