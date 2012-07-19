
$(function(){

  // 메뉴 너비와 화살표 위치 설정
  $("#menu div.submenu").each(function(){
    var width = 0;
    $(this).find("li").each(function(){ 
      width+=$(this).width()+20;
    });
    if($("#menu").offset().left+$("#menu").width()<$(this).offset().left+width) {
      var gab = ($("#menu").offset().left+$("#menu").width()) - ($(this).siblings("a").offset().left+$(this).siblings("a").width());
      $(this).css("left", "auto");
      $(this).css("right", "-"+gab+"px");
    }
  });

  // 페이지 로딩시 기본적으로 펼칠 메뉴
  function ShowActiveMenu() {
    $("#menu div.submenu").each(function(){
      if(!$(this).hasClass("activelink")) {
        $(this).clearQueue().stop().width("0px");
      } else {
        var width = 0;
        $(this).find("li").each(function(){ width+=$(this).width()+20; });
        $(this).animate( {width:width+"px"}, 300);
      }
    });
  }

  // 메뉴위로 마우스가 올라갔을 때
  $("#menu > ul > li > a").hover(
    function(){
      // 모든 서브메뉴 사라지기
      // 다른 모든 에니메이션을 멈추고 에니메이션 큐에 있는 것들까지 모두 제거함
      $("#menu div.submenu").each(function(){ $(this).clearQueue().stop().width("0px"); });
      // 현재 마우스 오버된 서브메뉴를 나타나게 함
      var submenu = $(this).siblings("div.submenu");
      var width = 0;
      submenu.find("li").each(function(){ width+=$(this).width()+20; });
      submenu.delay(100).animate( {width:width+"px"}, 300);
    },
    function(){}
  );

  // 메뉴영역을 벗어났을 때
  // 엑티브 메뉴만 펼침
  $("#menu").hover(
    function(){},
    function(){ ShowActiveMenu(); }
  );
  ShowActiveMenu(); // 엑티브 메뉴 고침
});

