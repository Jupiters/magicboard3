<?php if(!defined('__MAGIC__')) exit;

$m = $this;
$file = File::Inst()->mb_no($m->mb_no);
$picture = $m->Action('picture');
?>

<div class="sub_title"><h2>회원페이지</h2></div>

<div id="member_view">

  <div id="mypage_box">
    <p class="welcom">Welcom to <?php echo Config::Inst()->hp_title?></p>
    <p class="title">MY PAGE</p>
    <p class="ment"><span><?php echo $m->mb_nick?>님의 <b>마이페이지</b> 입니다.</span> 오늘도 <?php echo Config::Inst()->hp_title?>와 함께 좋은 하루되세요!</p>
  </div>

  <h3><strong><?php echo $m->mb_nick?></strong>님의 회원정보</h3>

  <table class="table_member2">
    <colgroup>
      <col width="150px">
      <col>
      <col width="150px">
      <col>
    </colgroup>

    <tbody>
    <tr>
      <th>회원아이디</th>
      <td><?php echo $m->mb_id?></td>
      <th>회원별명</th>
      <td><?php echo $m->mb_nick?></td>
    </tr>
    <tr>
      <th>이메일</th><td><?php echo $m->mb_email?></td>
      <th>회원가입일</th><td><?php echo $m->mb_datetime?></td>
    </tr>
    <tr>
      <th>메모</th>
      <td colspan="3"><?php echo $m->mb_memo?></td>
    </tr>
    </tbody>
  </table>

  <div class="center">
    <a href="<?php echo $this->Link('modify')?>"><img src="<?php echo $this->path_img('btn_modify.gif')?>" alt="회원정보수정"/></a>
    <a href="<?php echo $this->Link('modify_passwd')?>"><img src="<?php echo $this->path_img('btn_modify_password.gif')?>" alt="비밀번호수정"/></a>
    <a href="<?php echo $this->Link('unregist_confirm')?>"><img src="<?php echo $this->path_img('btn_unregist.gif')?>" alt="회원탈퇴"/></a>
  </div>

</div><!-- #member_view -->

