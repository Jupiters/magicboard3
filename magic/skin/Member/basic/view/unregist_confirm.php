<?php if(!defined("__MAGIC__")) exit;
$m = $this;
?>

<div class="sub_title"><h2>회원탈퇴</h2></div>
<form method="post" action="<?php echo $this->Link('unregist', $m->mb_no)?>">
<input type="hidden" name="passwd" value="<?php echo GV::Password('passwd', 'POST')?>"/>

<div id="member_unregist">

  <div class="top_box">
    <img class="icon" src="<?php echo $this->path_img('icon_unregist.gif')?>"/>
    <h3>회원 탈퇴</h3>
  </div>
  <p>&nbsp;</p>
  <p>회원 탈퇴에 앞서 아래의 사항을 반드시 숙지하시기 바랍니다.</p>
  <p>&nbsp;</p>
  <p>1. 회원탈퇴 후 모든 정보는 폐기처분 되며 어떠한 정보도 데이터베이스에 남겨두지 않습니다.</p>
  <p>2. 회원탈퇴를 하게되면 더이상 서비스는 받을수 없게 되며, 게시물 등의 권한도 모두 없어지게 됩니다.</p>
  <p>3. 회원탈퇴를 하기 위해서는 간단히 탈퇴사유를 적어주세요.</p>
  <p>&nbsp;</p>
	
  <table class="table_member3">
    <colgroup>
      <col width="200px">
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
      <th>비밀번호</th>
      <td><input type="password" name="mb_passwd"/></td>
    </tr>
    <tr>
      <th>자동등록 방지코드</th>
      <td><?php echo Captcha::Inst()->html()?></td>
    </tr>
    </tbody>
  </table>

  <div class="center"><input type="image" src="<?php echo $this->path_img('btn_unregist_ok.gif')?>" alt="탈퇴"/></div>
</div>

</form>
