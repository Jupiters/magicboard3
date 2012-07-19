
$(function(){
  $(".page_list_sortable").sortable({
    revert:true,
    handle:"a.ui-icon-arrowthick-2-n-s",
    stop:function(event, ui){
      $.ajax({
        type: "post",
        url: $(ui.item[0]).find("a.ui-icon-arrowthick-2-n-s").attr("href"),
        data: $(".order").serialize()
      });
    }
  });

  // 수정버튼에 컨텐츠 높이 추가
  $(".page_list_sortable a.modify").each(function(){
    var height = $(this).parents(".content").height();
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
