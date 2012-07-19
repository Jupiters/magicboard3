/*
 * 회원약관확인 폼 확인
 */
function fsubmit_agree(form) {
	if(!form.terms.checked)
	{
		alert("홈페이지 이용약관에 동의해야 가입 하실 수 있습니다.");
		return;
	}

	if(!form.privacy.checked)
	{
		alert("개인정보 취급방침의 내용에 동의해야 회원가입 하실 수 있습니다.");
		return;
	}

	form.submit();
}

/*
 * 회원가입폼 확인
 */
function fsubmit_write(form) {
	if(form.mb_id.value == '') { alert("아이디를 입력하세요."); return; } 
	if(form.mb_passwd.value == '') { alert("비밀번호를 입력하세요."); return; } 
	if(form.mb_passwd.value != form.confirm_passwd.value) { alert("비밀번호가 일치하지 않습니다."); return; } 
	if(form.mb_question.value == '') { alert("비밀번호 분실시 질문을 입력하세요."); return; } 
	if(form.mb_answer.value == '') { alert("비밀번호 분실시 답변을 입력하세요."); return; } 
	if(form.mb_nick && form.mb_nick.className == 'require' && form.mb_nick.value == '') { alert("별명을 입력하세요."); return; } 
	if(form.mb_email && form.mb_email.className == 'require' && form.mb_email.value == '') { alert("이메일을 입력하세요."); return; } 
	if(form.mb_memo && form.mb_memo.className == 'require' && form.mb_memo.value == '') { alert("서명을 입력하세요."); return; } 
	if(form.zsfCode.value == '') { alert("자동등록 방지코드를 입력하세요."); return; } 
	
	form.submit();
}

/*
 * 회원정보수정폼 확인
 */
function fsubmit_modify(form) {
	if(form.mb_question.value == '') { alert("비밀번호 분실시 질문을 입력하세요."); return; } 
	if(form.mb_answer.value == '') { alert("비밀번호 분실시 답변을 입력하세요."); return; } 
	if(form.mb_nick && form.mb_nick.className == 'require' && form.mb_nick.value == '') { alert("별명을 입력하세요."); return; } 
	if(form.mb_email && form.mb_email.className == 'require' && form.mb_email.value == '') { alert("이메일을 입력하세요."); return; } 
	if(form.mb_memo && form.mb_memo.className == 'require' && form.mb_memo.value == '') { alert("서명을 입력하세요."); return; } 
	if(form.zsfCode.value == '') { alert("자동등록 방지코드를 입력하세요."); return; } 
	form.submit();
}

$(function(){
	// 로그인 아이디 저장
	$("#save_id").change(function(){
		if($(this).attr("checked")) {
			if(confirm("공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제해 주세요.\n그래도 사용하시겠습니까?")) {
				if($("#login input[name='mb_id']").val()) {
					$.cookie('magicboard_login_id', $("#login input[name='mb_id']").val());
				} else {
					$("#login input[name='mb_id']").focus();
				}
			} else {
				$(this).removeAttr("checked");
			}
		} else {
			$.cookie('magicboard_login_id', '');
		}
	});
	$("#login input[name='mb_id']").keypress(function(){
		$("#save_id").removeAttr("checked");
	});
	
	// 아이디가 저장되어 있을 경우
	if($.cookie('magicboard_login_id')) {
		$("#login input[name='mb_id']").val($.cookie('magicboard_login_id'));
		$("#save_id").attr("checked","checked");
	}
});