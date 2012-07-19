
$(function(){
	$("img.zsfImg").live("click", function(){
		$("img.zsfImg").each(function(){
			var src = $(this).attr("src");
			src = src.substr(0,src.indexOf("?",0));
			src+="?re&zsfimg="+new Date().getTime();
			$(this).attr("src", src);
		});
	});
	
	/*
	 * 뒤로가기 눌렀을때에도 갱신되도록
	 */
	$("img.zsfImg").each(function(){
		var src = $(this).attr("src");
		src = src.substr(0,src.indexOf("?",0));
		src+="?re&zsfimg="+new Date().getTime();
		$(this).attr("src", src);
	});
	
	/*
	 * ajax를 통해서 미리 검사하는 로직..
	 * 나중에 하자..
	$("input[name='zsfCode']").live("blur", function(){
		var src = $(this).attr("src");
		//var input = $(this).parentsUntil("ul").siblings("li.input");
		src = src.substr(0,src.indexOf("?",0));
		src+="?re&zsfimg="+new Date().getTime();
		$(this).attr("src", src);
		
		$("img.zsfImg").each(function(){
			$.ajax({
				type:'post',
				url:'',
				data:null,
				success:function(data) {
					input.html(data);
					input.toggle("blind", '', 200, function(){
						$(this).find("textarea").focus();
					});
				}
			});
		});
	});
	 */
});
