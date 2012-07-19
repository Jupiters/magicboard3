
$(function() {
	$( "#tabs" ).tabs({
		cookie: {
			// store cookie for a day, without, it would be a session cookie
			expires: 1
		},
		// 상단의 탭 선택시 데이터 유효성 검사
		select: function(event, ui){
			
			switch(ui.index) {
			case 4:
				var title = $("#tabs input[name='hp_title']");
				if(!title.val()) {
					alert("[홈페이지명] 정보를 입력하세요.");
					title.focus();
					return false;
				}
			case 3:
				var id = $("#tabs input[name='admin_id']");
				if(!id.val()) {
					alert("[아이디]정보를 입력하세요.");
					id.focus();
					return false;
				}
				
				var pass = $("#tabs input[name='admin_pass']");
				if(!pass.val()) {
					alert("[비밀번호]정보를 입력하세요.");
					pass.focus();
					return false;
				}
				
				var pass_confirm = $("#tabs input[name='admin_pass_confirm']");
				if(pass.val()!=pass_confirm.val()) {
					alert("[비밀번호]와[비밀번호확인]이 일치하지 않습니다.");
					pass.focus();
					return false;
				}
				
				var name = $("#tabs input[name='admin_name']");
				if(!name.val()) {
					alert("[이름]정보를 입력하세요.");
					name.focus();
					return false;
				}
				
			case 2:
				var host = $("#tabs input[name='mysql_host']");
				if(!host.val()) {
					alert("[Host]정보를 입력하세요.");
					host.focus();
					return false;
				}
				
				var user = $("#tabs input[name='mysql_user']");
				if(!user.val()) {
					alert("[User]정보를 입력하세요.");
					user.focus();
					return false;
				}
				
				var pass = $("#tabs input[name='mysql_pass']");
				if(!pass.val()) {
					alert("[Password]정보를 입력하세요.");
					pass.focus();
					return false;
				}
				
				var db = $("#tabs input[name='mysql_db']");
				if(!db.val()) {
					alert("[DB]정보를 입력하세요.");
					db.focus();
					return false;
				}
				
				var prefix = $("#tabs input[name='db_prefix']");
				if(!prefix.val()) {
					alert("[DB Prefix]정보를 입력하세요.");
					prefix.focus();
					return false;
				}
				
				$.ajax({
					type: "POST",
					url: './?installMode=check_db',
					data: $("form").serialize(),
					success: function(data) {
						if(data) {
							alert(data);
							$('#tabs').tabs('select', 1);
						} else {
							$("#tabs input[name='mysql_host']").attr('readonly','readonly');
							$("#tabs input[name='mysql_user']").attr('readonly','readonly');
							$("#tabs input[name='mysql_pass']").attr('readonly','readonly');
							$("#tabs input[name='mysql_db']").attr('readonly','readonly');
							//$("#tabs input[name='db_prefix']").attr('readonly','readonly');
							//alert("데이터베이스 접속 정보가 확인 되었습니다.");
						}
					}
				});
				
			case 1:
				if(!$("#tabs input[name='agree']").is(":checked")) {
					alert("라이센스에 동의하셔야 합니다.");
					return false;
				}
				break;
			}
		}
	});
});


