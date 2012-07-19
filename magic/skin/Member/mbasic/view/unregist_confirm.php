<?php if(!defined("__MAGIC__")) exit;
$m = $this;
?>

<div class="sub_title"><h2>회원탈퇴</h2></div>
<form class="ui-form" method="post" action="<?php echo $this->Link('unregist', $m->mb_no)?>">
<input type="hidden" name="passwd" value="<?php echo GV::Password('passwd', 'POST')?>"/>

<div id="member_unregist">

<p>회원탈퇴 후 모든 정보는 폐기처분 되며 어떠한 정보도 데이터베이스에 남겨두지 않습니다.</p>
<p>회원탈퇴를 하게되면 더이상 서비스는 받을수 없게 되며, 게시물 등의 권한도 모두 없어지게 됩니다.</p>
<p>회원탈퇴를 하기 위해서는 간단히 탈퇴사유를 적어주세요.</p>
	
<table class="basic_table">
<colgroup>
	<col width="120px">
	<col>
</colgroup>
<tbody>
<tr>
	<th>회원아이디</th>
	<td><?php echo $m->mb_id?></td>
</tr>
<tr>
	<th>회원별명</th>
	<td><?php echo $m->mb_nick?></td>
</tr>
<tr>
	<th>이메일</th>
	<td><?php echo $m->mb_email?></td>
</tr>
<tr>
	<th>탈퇴사유</th>
	<td><textarea style="width:300px" name="mb_memo" cols="20000" rows="4" cols="40"></textarea></td>
</tr>
<tr>
	<th>비밀번호 확인</th>
	<td><input type="password" name="mb_passwd"/></td>
</tr>
<tr>
	<th>자동등록<br/>방지코드</th>
	<td><?php echo Captcha::Inst()->html()?></td>
</tr>
</tbody>
</table>

<div class="center"><input class="button" type="submit" value="탈퇴"/></div>
</div>

</form>
