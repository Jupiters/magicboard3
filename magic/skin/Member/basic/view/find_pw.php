<?php if(!defined('__MAGIC__')) exit; ?>

<div class="sub_title"><h2>비밀번호 찾기</h2></div>
<form method="post" action="<?php echo $this->Link('find_pw_question')?>"> 

<div id="member_view">
  <div id="find_pw">
    <img class="icon" src="<?php echo $this->path_img('icon_secret.gif')?>" alt="find_pw"/>
    <p>회원가입시 입력했던 아이디를 입력하세요</p>
    <table>
    <tbody>
      <tr>
        <th>아이디</th>
        <td><input type="text" class="require" alt="답변" name="mb_id"/></td>
      </tr>
    </tbody>
    </table>
    <input type="image" src="<?php echo $this->path_img('btn_ok.gif')?>" alt="확인"/>
  </div>
</div>

</form>
