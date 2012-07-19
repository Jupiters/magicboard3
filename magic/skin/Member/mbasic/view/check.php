<?php if(!defined("__MAGIC__")) exit; ?>

<div class="sub_title"><h2>비밀번호확인</h2></div>

<form class="ui-form" method="post" action="">
<div id="check_password">
<p>&nbsp;</p>
<p>회원님의 개인정보를 수정 합니다.</p>
<p>패스워드를 입력하신 후 정보를 수정하실 수 있습니다.</p>
<p>&nbsp;</p>
<p>아이디: <?php echo $this->mb_id?></p>
<p>
	<input class="text" size="10" type="password" name="passwd"/>
	<input class="button small" type="submit" value="확인"/>
</p>
</div>
</form>

