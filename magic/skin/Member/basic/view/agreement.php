<?php if(!defined('__MAGIC__')) exit;
?>

<div class="sub_title"><h2>회원가입약관</h2></div>
<form method="post" action="">

  <div id="agree">
    <div class="ment">
      <p>저희 사이트를 방문해 주셔서 감사드립니다.</p>
      <p>회원가입을 위해서는 아래 약관과 개인정보취급방침에 동의하셔야 절차가 진행됩니다.</p>
    </div>

    <h2>홈페이지 이용약관</h2>
    <textarea cols="10000" rows="10" readonly><?php echo Config::Inst()->termsofuse?></textarea>
    <input name="terms" type="checkbox" value="1"/>&nbsp;<label>위 내용을 숙지 하였으며 이에 동의합니다.</label>

    <h2>개인정보 수집 및 이용에 대한 안내</h2>
    <textarea cols="10000" rows="10" readonly><?php echo Config::Inst()->privacyofuse?></textarea>
    <input name="privacy" type="checkbox" value="1"/>&nbsp;<label>위 내용을 숙지 하였으며 이에 동의합니다.</label>

    <div class="buttons">
      <input type="image" class="adjuse_button_line" src="<?php echo $this->path_img('btn_agree.gif')?>" alt="동의"/>
      <a href="<?php echo Path::Root()?>"><img src="<?php echo $this->path_img('btn_agree_cancel.gif')?>" alt="동의하지 않습니다"/></a>
    </div>

  </div>

</form>


<script>
/*
 * 회원약관확인 폼 확인
 */
$(function(){
  $("form").submit(function(){
    if(!$(this).find("input[name='terms']").attr("checked")) {
      alert("홈페이지 이용약관에 동의해야 가입 하실 수 있습니다.");
      return false;;
    }
    if(!$(this).find("input[name='privacy']").attr("checked")) {
      alert("개인정보 취급방침의 내용에 동의해야 회원가입 하실 수 있습니다.");
      return false;
    }
  });
});
</script>

