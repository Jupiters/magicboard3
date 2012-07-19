<?php if(!defined("__MAGIC__")) exit; ?>

<div class="sub_title"><h2>회원 비밀번호 수정</h2></div>
<form method="post" action="<?php echo $this->Link('update_passwd', $this->mb_no)?>">
<input type="hidden" name="passwd" value="<?php echo GV::Password('passwd', 'POST')?>"/>

<div id="modify_password">

  <div class="top_box">
    <img class="icon" src="<?php echo $this->path_img('icon_modify_password.gif')?>"/>
    <h3>회원 비밀번호수정</h3>
  </div>
  <p>&nbsp;</p>
  <p>회원님의 비밀번호를 수정할 수 있습니다.</p>
  <p>기존 비밀번호를 입력하신 후 새로운 비밀번호를 입력하세요.</p>
  <p>&nbsp;</p>

  <table class="table_member3">
    <colgroup>
      <col width="150px">
      <col>
    </colgroup>
    <tbody>
    <tr class="important">
      <th>기존비밀번호</th>
      <td><input type="password" name="old_passwd" value="" class="require" alt="기존비밀번호"/></td>
    </tr>
    <tr class="important">
      <th>새로운 비밀번호</th>
      <td><input type="password" name="mb_passwd" value="" class="require" alt="새로운 비밀번호"/></td>
    </tr>
    <tr class="important">
      <th>비밀번호 확인</th>
      <td><input type="password" name="mb_passwd_check" value="" class="require" alt="비밀번호 확인"/></td>
    </tr>
    <tr>
      <th>자동등록 방지코드</th>
      <td><?php echo Captcha::Inst()->html()?></td>
    </tr>
    </tbody>
  </table>

  <div class="center"><input type="image" src="<?php echo $this->path_img('btn_ok.gif')?>"  value="확인"/></div>
</div>

</form>
