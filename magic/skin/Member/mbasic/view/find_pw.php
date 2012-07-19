<?php if(!defined('__MAGIC__')) exit; ?>

<div class="sub_title"><h2>비밀번호 찾기</h2></div>
<form class="ui-form" method="post" action="<?php echo $this->Link('find_pw_question')?>"> 

<div id="find_pw">
<p>아이디를 입력하세요</p>
<input type="text" class="text" name="mb_id"/>
<input class="button small" type="submit" value="확인"/>
</div>
</form>
