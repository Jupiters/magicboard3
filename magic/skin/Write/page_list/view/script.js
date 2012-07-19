
$(function(){
  $(".page_list_sortable").sortable({
    revert:true,
    handle:"a.move",
    stop:function(event, ui){
      $.ajax({
        type: "post",
        url: $(ui.item[0]).find("a.move").attr("href"),
        data: $(".order").serialize()
      });
    }
  });

  $(".page_list_sortable div.page_list_content").each(function(){
    $(this).hover(
      function(){
        $(this).find(".move").css("left",$(this).width()/2-33);
        $(this).find(".move").css("top",$(this).height()/2-27);
        $(this).find(".move").fadeIn(1200);
      },
      function(){
        $(this).find(".move").fadeOut(700);
      }
    );
  });


  // 수정버튼에 컨텐츠 높이 추가
  $(".page_list_sortable a.modify").each(function(){
    var height = $(this).parents(".page_list_content").height();
    $(this).attr("href", $(this).attr("href")+"&height="+height);
  });

  // 삭제버튼에 메시지
  $(".page_list_sortable a.delete").click(function(){
    if(confirm("삭제한 데이터는 복구할 수 없습니다.\n신중하게 선택하세요.")) {
      return true;
    }
    return false;
  });
});
