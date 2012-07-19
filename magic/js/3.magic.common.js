/*
 * 버튼 스타일
 * -------------------------------
 * 각종 버튼 스타일 정의
 * jquery-ui 버튼
 */
function DefineButton() {
  $(".button").each(function(){
    $(this).button();
    // active될 버튼
    if($(this).hasClass("hover")) {
      $(this).addClass('ui-state-hover').unbind('mouseout');
    }
    // active가 필요없는 fixed
    if($(this).hasClass("fixed")) {
      $(this).unbind('mouseover').unbind('mouseout');
    }
    // 작은 버튼
    if($(this).hasClass("small")) {
      $(this).addClass("ui-button-small");
    }
    // 텍스트 제거
    if($(this).hasClass("no-text")) {
      $(this).button("option", "text", false);
    }
    /*
     * 아이콘 정리
     * 추가되면 배열에 이름만 적어주면 됨
     */
    var icons = [
      'ui-icon-carat-1-n',
      'ui-icon-carat-1-ne',
      'ui-icon-carat-1-e',
      'ui-icon-carat-1-se',
      'ui-icon-carat-1-s',
      'ui-icon-carat-1-sw',
      'ui-icon-carat-1-w',
      'ui-icon-carat-1-nw',
      'ui-icon-carat-2-n-s',
      'ui-icon-carat-2-e-w',
      'ui-icon-triangle-1-n',
      'ui-icon-triangle-1-ne',
      'ui-icon-triangle-1-e',
      'ui-icon-triangle-1-se',
      'ui-icon-triangle-1-s',
      'ui-icon-triangle-1-sw',
      'ui-icon-triangle-1-w',
      'ui-icon-triangle-1-nw',
      'ui-icon-triangle-2-n-s',
      'ui-icon-triangle-2-e-w',
      'ui-icon-arrow-1-n',
      'ui-icon-arrow-1-ne',
      'ui-icon-arrow-1-e',
      'ui-icon-arrow-1-se',
      'ui-icon-arrow-1-s',
      'ui-icon-arrow-1-sw',
      'ui-icon-arrow-1-w',
      'ui-icon-arrow-1-nw',
      'ui-icon-arrow-2-n-s',
      'ui-icon-arrow-2-ne-sw',
      'ui-icon-arrow-2-e-w',
      'ui-icon-arrow-2-se-nw',
      'ui-icon-arrowstop-1-n',
      'ui-icon-arrowstop-1-e',
      'ui-icon-arrowstop-1-s',
      'ui-icon-arrowstop-1-w',
      'ui-icon-arrowthick-1-n',
      'ui-icon-arrowthick-1-ne',
      'ui-icon-arrowthick-1-e',
      'ui-icon-arrowthick-1-se',
      'ui-icon-arrowthick-1-s',
      'ui-icon-arrowthick-1-sw',
      'ui-icon-arrowthick-1-w',
      'ui-icon-arrowthick-1-nw',
      'ui-icon-arrowthick-2-n-s',
      'ui-icon-arrowthick-2-ne-sw',
      'ui-icon-arrowthick-2-e-w',
      'ui-icon-arrowthick-2-se-nw',
      'ui-icon-arrowthickstop-1-n',
      'ui-icon-arrowthickstop-1-e',
      'ui-icon-arrowthickstop-1-s',
      'ui-icon-arrowthickstop-1-w',
      'ui-icon-arrowreturnthick-1-w',
      'ui-icon-arrowreturnthick-1-n',
      'ui-icon-arrowreturnthick-1-e',
      'ui-icon-arrowreturnthick-1-s',
      'ui-icon-arrowreturn-1-w',
      'ui-icon-arrowreturn-1-n',
      'ui-icon-arrowreturn-1-e',
      'ui-icon-arrowreturn-1-s',
      'ui-icon-arrowrefresh-1-w',
      'ui-icon-arrowrefresh-1-n',
      'ui-icon-arrowrefresh-1-e',
      'ui-icon-arrowrefresh-1-s',
      'ui-icon-arrow-4',
      'ui-icon-arrow-4-diag',
      'ui-icon-extlink',
      'ui-icon-newwin',
      'ui-icon-refresh',
      'ui-icon-shuffle',
      'ui-icon-transfer-e-w',
      'ui-icon-transferthick-e-w',
      'ui-icon-folder-collapsed',
      'ui-icon-folder-open',
      'ui-icon-document',
      'ui-icon-document-b',
      'ui-icon-note',
      'ui-icon-mail-closed',
      'ui-icon-mail-open',
      'ui-icon-suitcase',
      'ui-icon-comment',
      'ui-icon-person',
      'ui-icon-print',
      'ui-icon-trash',
      'ui-icon-locked',
      'ui-icon-unlocked',
      'ui-icon-bookmark',
      'ui-icon-tag',
      'ui-icon-home',
      'ui-icon-flag',
      'ui-icon-calendar',
      'ui-icon-cart',
      'ui-icon-pencil',
      'ui-icon-clock',
      'ui-icon-disk',
      'ui-icon-calculator',
      'ui-icon-zoomin',
      'ui-icon-zoomout',
      'ui-icon-search',
      'ui-icon-wrench',
      'ui-icon-gear',
      'ui-icon-heart',
      'ui-icon-star',
      'ui-icon-link',
      'ui-icon-cancel',
      'ui-icon-plus',
      'ui-icon-plusthick',
      'ui-icon-minus',
      'ui-icon-minusthick',
      'ui-icon-close',
      'ui-icon-closethick',
      'ui-icon-key',
      'ui-icon-lightbulb',
      'ui-icon-scissors',
      'ui-icon-clipboard',
      'ui-icon-copy',
      'ui-icon-contact',
      'ui-icon-image',
      'ui-icon-video',
      'ui-icon-script',
      'ui-icon-alert',
      'ui-icon-info',
      'ui-icon-notice',
      'ui-icon-help',
      'ui-icon-check',
      'ui-icon-bullet',
      'ui-icon-radio-off',
      'ui-icon-radio-on',
      'ui-icon-pin-w',
      'ui-icon-pin-s',
      'ui-icon-play',
      'ui-icon-pause',
      'ui-icon-seek-next',
      'ui-icon-seek-prev',
      'ui-icon-seek-end',
      'ui-icon-seek-start',
      'ui-icon-seek-first',
      'ui-icon-stop',
      'ui-icon-eject',
      'ui-icon-volume-off',
      'ui-icon-volume-on',
      'ui-icon-power',
      'ui-icon-signal-diag',
      'ui-icon-signal',
      'ui-icon-battery-0',
      'ui-icon-battery-1',
      'ui-icon-battery-2',
      'ui-icon-battery-3',
      'ui-icon-circle-plus',
      'ui-icon-circle-minus',
      'ui-icon-circle-close',
      'ui-icon-circle-triangle-e',
      'ui-icon-circle-triangle-s',
      'ui-icon-circle-triangle-w',
      'ui-icon-circle-triangle-n',
      'ui-icon-circle-arrow-e',
      'ui-icon-circle-arrow-s',
      'ui-icon-circle-arrow-w',
      'ui-icon-circle-arrow-n',
      'ui-icon-circle-zoomin',
      'ui-icon-circle-zoomout',
      'ui-icon-circle-check',
      'ui-icon-circlesmall-plus',
      'ui-icon-circlesmall-minus',
      'ui-icon-circlesmall-close',
      'ui-icon-squaresmall-plus',
      'ui-icon-squaresmall-minus',
      'ui-icon-squaresmall-close',
      'ui-icon-grip-dotted-vertical',
      'ui-icon-grip-dotted-horizontal',
      'ui-icon-grip-solid-vertical',
      'ui-icon-grip-solid-horizontal',
      'ui-icon-gripsmall-diagonal-se',
      'ui-icon-grip-diagonal-se'
    ];
    for (var i in icons) {
      if($(this).hasClass(icons[i])) { // 글쓰기 연필
        // icon-right가 있으면 오른쪽에 아이콘을 생성함
        if($(this).hasClass('icon-right')) $(this).button("option", "icons", {secondary:icons[i]});
        else $(this).button("option", "icons", {primary:icons[i]});
      }
    }
  });
  $(".buttonset").buttonset();
}

/*
 * 툴팁 스타일
 */
function DefineTooltip() {
  $("input[title], a.tp[title]").each(function(){
    var showOn = 'focus';
    var style = 'tip-darkgray';
    if($(this)[0].tagName=='A') {
      showOn = 'hover';
    }
    if($(this).hasClass("tp-right")) {
      $(this).poshytip({
        className: style,
        showOn: showOn,
        alignTo: 'target',
        alignX: 'right',
        alignY: 'center',
        offsetX: 5
      });
    } else if($(this).hasClass("tp-left")) {
      $(this).poshytip({
        className: style,
        showOn: showOn,
        alignTo: 'target',
        alignX: 'left',
        alignY: 'center',
        offsetX: 5
      });
    } else if($(this).hasClass("tp-bottom")) {
      $(this).poshytip({
        className: style,
        showOn: showOn,
        alignTo: 'target',
        alignX: 'center',
        alignY: 'bottom',
        offsetY: 5
      });
    } else if($(this).hasClass("tp-inner-left")) {
      $(this).poshytip({
        className: style,
        showOn: showOn,
        alignTo: 'target',
        alignX: 'inner-left',
        offsetX: 0,
        offsetY: 5
      });
    } else if($(this).hasClass("tp-top-center")) {
      $(this).poshytip({
        className: style,
        showOn: showOn,
        alignTo: 'target',
        alignX: 'center',
        offsetX: 0,
        offsetY: 5
      });
    } else {
      $(this).poshytip({
        className: style,
        showOn: showOn,
        alignTo: 'target',
        alignX: 'inner-left',
        offsetX: 0,
        offsetY: 5
      });
    }
  });
  
}

$(function() {
  
  /*
   * 팁 박스
   * class=tip만 선언하면 자동으로 아이콘과 레이아웃을 추가해준다
  var icon = $("<div></div>")
        .html($("<span style=\"float:left;clear:left;margin:3px 5px 0 0\"></span>")
        .addClass("ui-icon ui-icon-info").html("&nbsp;"));
  $(".tip").addClass("ui-widget");
  $(".tip").each(function(index){
    $(this).html(
      $("<div style=\"padding:0 5px\"></div>").addClass("ui-state-highlight ui-corner-all").html(
        $(this).children("p").each(function(){
          $(this).html(icon.html()+ $(this).html());
        })
      )
    );
  });
   */

  
  /*
   * 즐겨찾기 추가
   * -------------------------
   * a태그에 class=copy
   * 선언하면 자동으로 추가해줌
   */
  $("a.copy").each(function(){
    $(this).zclip({
      path: './magic/js/swf/ZeroClipboard.swf',
      copy: $(this).attr("href"),
      afterCopy: function(){
        alert("게시글의 주소가 복사되었습니다.\n사용하고 싶은 텍스트 입력창에\nCtrl+V를 눌러서 사용하세요.");
      },
      clickAfter:false
    });
  });
  //$("a.copy").click(function(){return false});
  
  /*
   * 즐겨찾기 추가
   * -------------------------
   * a태그에 class=add_favorite
   * 선언하면 자동으로 추가해줌
   */
  $("a.add_favorite").click(function(){
    var url = $(this).attr("href");
    var title = $(this).attr("title");
    if (window.sidebar) { // firefox 
      window.sidebar.addPanel(title, url, ""); 
    } else if(window.opera && window.print) { // opera 
      var elem = document.createElement('a'); 
      elem.setAttribute('href',url); 
      elem.setAttribute('title',title); 
      elem.setAttribute('rel','sidebar'); 
      elem.click(); 
    } else if(document.all) { // ie
      window.external.AddFavorite(url, title); 
    }
  });
  
  /*
   * 팝업 설정
   * -------------------------
   * a태그에 class=popup
   * 선언하면 자동으로 팝업창으로 뜨도록 함
   */
  $("a.popup").click(function(){
    var width = $(this).attr("width");
    var height = $(this).attr("height");
    var link = $(this).attr("href");
    var option = '';
    if(width && height) option = "width="+width+",height="+height;
    window.open(link, "", option);
    return false;
  });
  
  
  /*
   * 모든 form에 autocomplete="off"
   */
  $("form").each(function(){
    $(this).attr("autocomplete", "off");
  });
  
  /*
   * 모든폼에서 동작하는 필수입력 검사
   * alt로 필드명을 정해주면됨
   */
  $("form").submit(function(){
    // cheditor가 로드되어 있는지 체크하고 실행함
    if(typeof doSubmit == 'function') { doSubmit($(this)[0]); } 
    var ret=true;
    // form 체크
    $(this).find("input.require, textarea.require, select.require").each(function(){
      if(ret && $(this).val()=='' && !$(this).attr("disabled")) {
        var text = $(this).attr("alt");
        alert(text+"을(를) 입력하세요");
        $(this).focus();
        ret = false;
      }
    });
    return ret;
  });

	/*
	 * 위젯 삭제버튼 : 다이얼로그화
	 */
	$(".widget a.wg_delete").click(function(){
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		var dialog = "<div class=\"left\" title=\"위젯삭제\">정말로 삭제하시겠습니까?<br/>삭제한 데이터는 복구할 수 없습니다.</div>";
		var link = $(this).attr("href");
		$(dialog).dialog({
			resizable:false,
			modal: true,
			buttons: {
				"삭제": function() {
					$(this).dialog("close");
					location.href = link;
				},
				"취소": function() {
					$(this).dialog("close");
				}
			}
		});
		return false;
	});

  $("input[type='text'],input[type='password']").each(function(){
    $(this).addClass('txt');
  });

  // 위젯에 마우스가 올라갔을때 버튼 보이기
  $(".widget").each(function(){

    // 위젯버튼 위치설정
    $(this).children(".widget_btn").css('left', $(this).width()/2-60);
    $(this).children(".widget_btn").css('top', $(this).height()/2-10);

    if($(this).children(".widget_btn").length!=0) {
      $(this).hover(
        function(){
          $(this).addClass('widget_active');
          $(this).children(".widget_btn").fadeIn(500);
        },
        function(){
          $(this).removeClass('widget_active');
          $(this).children(".widget_btn").fadeOut(100);
        }
      );
    }

  });

	$("a.bookmark").click(function(e){
		var url = $(this).attr("href");
		var title = $(this).attr("title");
	    if(document.all && window.external) { // ie
	        window.external.AddFavorite(url, title);
	    } else if(window.sidebar) { // firefox
	        window.sidebar.addPanel(title, url, "");
	    } else if(window.opera && window.print) { // opera
	        var elem = document.createElement('a');
	        elem.setAttribute('href',url);
	        elem.setAttribute('title',title);
	        elem.setAttribute('rel','sidebar');
	        elem.click(); // this.title=document.title;
	    } else {
			alert('브라우저가 즐겨찾기를 지원하지 않습니다.');
	    }
		return false;
	});
  
	$("a.homepage").click(function(e){
		var url = $(this).attr("href");
		if (document.all) {
			document.body.style.behavior = 'url(#default#homepage)';
			document.body.setHomePage(url);
		} else if (window.sidebar) {
			if (window.netscape) {
				try {
					netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
				} catch (e) {
					var strTemp = '';
					strTemp += "this action was aviod by your browser,";
					strTemp += "if you want to enable,please enter about:config in your address line,";
					strTemp += "and change the value of signed.applets.codebase_principal_support to true";
					alert(strTemp);
				}
			}
			var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
			prefs.setCharPref('browser.startup.homepage', url);
		} else {
			alert('브라우저가 시작페이지 지정을 지원하지 않습니다.');
		}
		return false;
	});
  
  
  DefineButton();
  DefineTooltip();
});

