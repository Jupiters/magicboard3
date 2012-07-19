<?php if(!defined("__MAGIC__")) exit;
$m = Member::Inst();
?>

<form method="post" action='<?php echo $m->Link('login_check')?>'>
<input name="prev_url" type="hidden" value='<?php echo Url::This()?>'/>

<table>
  <tbody>
    <tr>
      <th>아이디</th>
      <td><input type="text" name="mb_id" class="require" tabindex="1" alt="아이디" style="ime-mode:disabled"/></td>
      <td><input type="checkbox" id="save_id" tabindex="4"/><label for="save_id">&nbsp;저장</label></td>
    </tr>
    <tr>
      <th>비밀번호</th>
      <td><input type="password" name="mb_passwd" class="require" tabindex="2" alt="비밀번호"/></td>
      <td><input type="image" src="<?php echo $this->path_img('btn_login.gif')?>" tabindex="3"/></td>
    </tr>
  </tbody>
</table>

<div class="bottom">
  <a href="<?php echo $m->Link('find_passwd')?>">비밀번호 찾기</a>&nbsp;&nbsp;
  <a href="<?php echo $m->Link('regist')?>">회원가입</a>
</div>

</form>
