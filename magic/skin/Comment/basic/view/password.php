<?php if(!defined('__MAGIC__')) exit;?>

<div id="comments">
<form class="ui-form" method="post" action="">
<table class="basic_table">
<thead><tr><th>패스워드 확인</th></tr></thead>
<tbody>
<tr>
	<td class="center buttonset">
	<?php if($_POST['password']) {?><p class="wrong_password">비밀번호가 틀렸습니다.</p><?php }?>
	<input type="password" name="password" size="8" class="bottom" title="삭제하려면 비밀번호를 입력하세요"/>
	<input type="submit" value="확인"/><input type="button" value="취소" onclick="location.href='<?php echo $this->Link('list')?>'"/>
	</td>
</tr>
</tbody>
</table>
</form>
</div>
