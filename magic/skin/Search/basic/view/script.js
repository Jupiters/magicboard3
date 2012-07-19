
$(function(){
	/*
	 * 검색어 입력폼에서 엔터키 입력시
	 */
	$(".search input[name='stx']").each(function(){
		$(this).keypress(function(e){
			var code = null;
			code = (e.keyCode ? e.keyCode:e.which);
			if(code == 13) {
				var url = $(this).parent("form").attr('action');
				var stx = $(this).parent("form").children("input[name='stx']");
				if(stx.val()=='') {
					alert('검색어를 입력하세요.');
					stx.focus();
					return false;
				}
				if(url.indexOf("?") == -1) url+='?';
				location.href = url+"&stx="+stx.val();
				return false;
			}
		});
	});

	/*
	 * 검색버튼 클릭 시 펼침
	 */
  $(".search .btn_search2").each(function(){
    $(this).click(function(){
      if($(this).siblings("div.hidden").css("width")=="0px") {
        $(this).hide();
        $(this).siblings("input.btn_search").show();
        $(this).siblings("div.hidden").animate({width:"173px"});
        $(this).parent("form").find("input[name='stx']").focus();
      } else {
        var url = $(this).parent("form").attr('action');
        var stx = $(this).parent("form").find("input[name='stx']");
        if(stx.val()=='') {
          alert('검색어를 입력하세요.');
          stx.focus();
          return false;
        }
        if(url.indexOf("?") == -1) url+='?';
        location.href = url+"&stx="+stx.val();
      }
    });

    if($(this).parent("form").find("input[name='stx']").val()=='') {
      $(this).siblings("div.hidden").css("width","0px");
      $(this).show();
      $(this).siblings("input.btn_search").hide();
    } else {
      $(this).siblings("div.hidden").css("width","173px");
      $(this).hide();
      $(this).siblings("input.btn_search").show();
    }
  });

	/*
	 * 검색취소버튼 클릭 시 닫음
	 */
  $(".search .btn_cancel").each(function(){
    $(this).click(function(){
      if($(this).siblings("input[name='stx']").val()=='') {
        $(this).parent("div.hidden").siblings(".btn_search2").show();
        $(this).parent("div.hidden").siblings(".btn_search").hide();
        $(this).parent("div.hidden").animate({width:"0px"});
        return false;
      }
    });
  });

	/*
	 * 검색입력 검사
	 */
  $(".search form").submit(function(){
    var url = $(this).attr('action');
    var stx = $(this).find("input[name='stx']");
    if(stx.val()=='') {
      alert('검색어를 입력하세요.');
      stx.focus();
      return false;
    }
    if(url.indexOf("?") == -1) url+='?';
    location.href = url+"&stx="+stx.val();
  });

});
