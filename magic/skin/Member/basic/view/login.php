<?php if(!defined('__MAGIC__')) exit;
$title = Config::Inst()->hp_title;
?>

<div class="sub_title"><h2><?php echo $title?> 회원로그인</h2></div>

<div id="login">
  <div class="banner"><a href="http://www.webmona.com/" class="popup"><img src="<?php echo $this->path_img('banner.jpg')?>"/></a></div>
  <div class="form">
    <div class="box">
      <form method="post" action="<?php echo $this->Link('login_check')?>">
        <div><img src="<?php echo $this->path_img('ment.gif')?>" alt="보안로그인"/></div>
        <input style="float:right" type="image" src="<?php echo $this->path_img('login_button.gif')?>" tabindex="3"/>
        <input class="id require" type="text" name="mb_id" tabindex="1" alt="아이디" title="아이디입력"/>
        <input class="pw require" type="password" name="mb_passwd" tabindex="2" alt="비밀번호" title="비밀번호입력"/>
        <div class="save_id"><input id="save_id" type="checkbox"/>&nbsp;<label for="save_id">회원아이디 저장</label></div>
        <div class="links"><a href="<?php echo $this->Link('find_pw')?>">비밀번호 찾기</a> | <strong><a href="<?php echo $this->Link('regist')?>">회원가입</a></strong></div>
      </form>
    </div>
  </div>
  <div class="ment">
    <p>아직 <?php echo $title?> 회원이 아니세요? <a href="<?php echo $this->Link('regist')?>"><strong>회원가입</strong></a>을 하시면</p>
    <p><strong><?php echo $title?> 회원만의 특별한 서비스</strong>를 누리실수 있습니다.</p>
    <p><?php echo $title?>엔 최고의 서비스들이 있습니다. 다양하고 멋진 서비스로, <?php echo $title?> 회원만의 특권을 누려보세요!!</p>
  </div>
</div>

<script>
$(function(){
	// 로그인 아이디 저장
	$("#save_id").change(function(){
		if($(this).attr("checked")) {
			if(confirm("공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제해 주세요.\n그래도 사용하시겠습니까?")) {
        $("#login input[name='mb_id']").focus();
			} else {
				$(this).removeAttr("checked");
			}
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

  $("form").submit(function(){
		if($(this).attr("checked")) {
      $.cookie('magicboard_login_id', $("#login input[name='mb_id']").val());
		} else {
			$.cookie('magicboard_login_id', '');
		}
  });
});
</script>
