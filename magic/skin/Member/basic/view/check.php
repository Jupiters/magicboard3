<?php if(!defined("__MAGIC__")) exit; ?>

<div class="sub_title"><h2>비밀번호확인</h2></div>

<form method="post" action="">
  <div id="check_password">

    <div class="top_box">
      <img class="icon" src="<?php echo $this->path_img('icon_check.gif')?>"/>
      <h3>비밀번호 확인</h3>
    </div>
    <p>&nbsp;</p>
    <p>회원님의 개인정보를 수정 합니다.</p>
    <p>패스워드를 입력하신 후 정보를 수정하실 수 있습니다.</p>
    <p>&nbsp;</p>
    <table class="table_member3">
      <colgroup>
        <col width="150px"/>
        <col/>
      </colgroup>
      <tbody>
        <tr>
          <th>아이디</th>
          <td><?php echo $this->mb_id?></td>
        </tr>
        <tr class="important">
          <th>비밀번호</th>
          <td><input class="require" alt="비밀번호" size="10" type="password" name="passwd"/></td>
        </tr>
      </tbody>
    </table>
    <div class="center">
      <input type="image" src="<?php echo $this->path_img('btn_ok.gif')?>" alt="확인"/>
    </div>
  </div>
</form>

