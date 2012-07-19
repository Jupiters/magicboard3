$(function(){

  // 메인화면 탭 최신글 컨트롤
  $("ul#tab li").click(function(){
    var tab_list = $("ul#tab").get(0).children;
    var current_index=0;
    for(i=0; i<tab_list.length; i++) {
      if($(this).get(0)!=tab_list[i]) {
        $(tab_list[i]).removeClass("active");
      } else {
        $(this).addClass("active");
        current_index=i;
      }
    }
    var board_list = $("#board_list").get(0).children;
    for(i=0; i<board_list.length; i++) {
      if(current_index!=i) {
        $(board_list[i]).hide();
      } else {
        $(board_list[i]).fadeIn(1000);
      }
    }
  });

/*
  // 상단메뉴 컨트롤
  $("#menu ul.list li a").hover(function(){
    var mainmenu_list = $("#menu .list").get(0).children;
    var_current_index=0;
    for(i=0; i<mainmenu_list.length; i++) {
      if($(this).parent().get(0)==mainmenu_list[i]) {
        current_index=i;
        break;
      }
    }
    var submenu_list = $("#submenu_list").get(0).children;
    for(i=0; i<submenu_list.length; i++) {
      $(submenu_list[i]).hide();
    }
    //$("#submenu_list").css("left", 259+(current_index*137)+"px")
    $(submenu_list[current_index]).fadeIn(1000);
  },
  function(){}// 마우스 빠져나갈때 이벤트 제거
  );
  //*/

});
