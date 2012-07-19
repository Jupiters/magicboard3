<?php if(!defined('__MAGIC__')) exit; ?>

<form method="post" action="<?php echo $this->Link('login_check')?>">

<div data-role="fieldcontain">
<fieldset data-role="controlgroup">
<label for="mb_id">아이디</label>
<input id="mb_id" name="mb_id" placeholder="" value="" type="text"/>
</fieldset>
</div>

<div data-role="fieldcontain">
<fieldset data-role="controlgroup">
<label for="mb_passwd">비밀번호</label>
<input id="mb_passwd" name="mb_passwd" placeholder="" value="" type="password" />
</fieldset>
</div>

<input type="submit" data-icon="check" data-iconpos="left" value="로그인" />
</form>

