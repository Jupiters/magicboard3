<?php if(!defined("__MAGIC__")) exit; ?>

<div class="sub_title"><h2>회원 비밀번호 수정</h2></div>
<form class="ui-form" method="post" action="<?php echo $this->Link('update_passwd', $this->mb_no)?>">
<input type="hidden" name="passwd" value="<?php echo GV::Password('passwd', 'POST')?>"/>

<div id="modify_password">
<table class="basic_table">
<colgroup>
	<col width="150px">
	<col>
</colgroup>
<tbody>
<tr>
	<th>기존비밀번호</th>
	<td class="left"><input type="password" name="old_passwd" value=""/></td>
</tr>
<tr>
	<th>비밀번호</th>
	<td class="left"><input type="password" name="mb_passwd" value=""/></td>
</tr>
<tr>
	<th>비밀번호 확인</th>
	<td class="left"><input type="password" name="mb_passwd_check" value=""/></td>
</tr>
<tr>
	<th>자동등록 방지코드</th>
	<td class="left"><?php echo Captcha::Inst()->html()?></td>
</tr>
</tbody>
</table>

<div class="center"><input class="button" type="submit" value="확인"/></div>
</div>

</form>
