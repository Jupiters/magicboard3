<?php if(!defined("__MAGIC__")) exit;

$pic_width = Config::Inst()->mb_pic_width;
$pic_height = Config::Inst()->mb_pic_height;
$list = File::Inst()->mb_no($this->mb_no)->Action('images', $pic_width, $pic_height);

if(is_array($list) && sizeof($list)!=0) {
  $pic['is'] = true;
  $pic['file_no'] = $list[0]['file_no'];
	$pic['link'] = $list[0]['link'];
} else {
  $pic['is'] = false;
	$pic['link'] = $this->path_img('noimg.gif');
}


$m = $this;
?>

<div class="sub_title"><h2>회원서비스</h2></div>

<form method="post" action="<?php echo $m->Link('update')?>" enctype="multipart/form-data" onsubmit="fsubmit_modify(this); return false;" >
<input type="hidden" name="passwd" value="<?php echo GV::Password('passwd', 'POST')?>"/>
<input type="hidden" name="mb_no" value="<?php echo $m->mb_no?>"/>

<div id="member_modify">

  <div class="sub_title_box">
    <h3>회원정보</h3>
    <span>회원님의 개인정보 입니다.</span>
    <img class="icon" src="<?php echo $this->path_img('icon_member.gif')?>"/>
  </div>

  <table class="table_member">
    <colgroup>
      <col width="200px">
      <col>
    </colgroup>
    <tbody>
    <tr class="info">
      <th colspan="2">표시는 필수입력 사항입니다.</th>
    </tr>
    <tr>
      <th class="require">회원아이디</th>
      <td><?php echo $m->mb_id?></td>
    </tr>
    <tr>
      <th class="require">이름</th>
      <td>
        <input type="text" class="require" name="mb_name" value="<?php echo $m->mb_name?>" alt="이름"/>
      </td>
    </tr>
    <tr>
      <th class="require">별명</th>
      <td>
        <input type="text" class="require" name="mb_nick" value="<?php echo $m->mb_nick?>" alt="별명"/>
      </td>
    </tr>
    <tr>
      <th class="require">비밀번호 분실질문</th>
      <td>
        <div class="gab_line">
          <select id="select_question" onchange="this.form.mb_question.value=this.value;">
            <option value="">선택하십시오.</option>
            <option value="내가 좋아하는 캐릭터는?">내가 좋아하는 캐릭터는?</option>
            <option value="타인이 모르는 자신만의 신체비밀이 있다면?">타인이 모르는 자신만의 신체비밀이 있다면?</option>
            <option value="자신의 인생 좌우명은?">자신의 인생 좌우명은?</option>
            <option value="초등학교 때 기억에 남는 짝꿍 이름은?">초등학교 때 기억에 남는 짝꿍 이름은?</option>
            <option value="유년시절 가장 생각나는 친구 이름은?">유년시절 가장 생각나는 친구 이름은?</option>
            <option value="가장 기억에 남는 선생님 성함이나 별명은?">가장 기억에 남는 선생님 성함이나 별명은?</option>
            <option value="친구들에게 공개하지 않은 어릴 적 별명이 있다면?">친구들에게 공개하지 않은 어릴 적 별명이 있다면?</option>
            <option value="다시 태어나면 되고 싶은 것은?">다시 태어나면 되고 싶은 것은?</option>
            <option value="가장 감명깊게 본 영화는?">가장 감명깊게 본 영화는?</option>
            <option value="읽은 책 중에서 좋아하는 구절이 있다면?">읽은 책 중에서 좋아하는 구절이 있다면?</option>
            <option value="기억에 남는 추억의 장소는?">기억에 남는 추억의 장소는?</option>
            <option value="인상 깊게 읽은 책 이름은?">인상 깊게 읽은 책 이름은?</option>
            <option value="자신의 보물 제1호는?">자신의 보물 제1호는?</option>
            <option value="받았던 선물 중 기억에 남는 독특한 선물은?">받았던 선물 중 기억에 남는 독특한 선물은?</option>
            <option value="자신이 두번째로 존경하는 인물은?">자신이 두번째로 존경하는 인물은?</option>
            <option value="좋아하는 이모의 성함은?">좋아하는 이모의 성함은?</option>
            <option value="좋아하는 고모부의 성함은?">좋아하는 고모부의 성함은?</option>
            <option value="친구들 병명중 가장 웃겼던 별명은?">친구들 병명중 가장 웃겼던 별명은?</option>
            <option value="">직접입력</option>
          </select>
        </div>
        <div>
          <input size="40" type="text" name="mb_question" value="<?php echo $m->mb_question?>" class="require" alt="비밀번호 분실질문"/>
        </div>
      </td>
    </tr>
    <tr>
      <th class="require">비밀번호 분실답변</th>
      <td><input size="18" type="text" name="mb_answer" value="<?php echo $m->mb_answer?>" class="require" alt="비밀번호 분실답변"/></td>
    </tr>
    <tr>
      <th class="require">이메일</th>
      <td><input type="text" size="25" name="mb_email" value="<?php echo $m->mb_email?>" class="require" alt="이메일"/></td>
    </tr>
    <tr>
      <th>메모</th>
      <td><textarea name="mb_memo" cols="50" rows="4"><?php echo $m->mb_memo?></textarea></td>
    </tr>
    <tr>
      <th>회원사진</th>
      <td class="mb_picture">
        <img src="<?php echo $pic['link']?>" width="<?php echo $pic_width?>" height="<?php echo $pic_height?>"/>
        <?php if($pic['is']) {?>
        <p><input type="checkbox" id="fd" name="<?php echo File::Inst()->Config('form_name','del')?>[]" value="<?php echo $pic['file_no']?>"/>&nbsp;<label for="fd">삭제 : 체크후 수정하면 회원사진을 삭제합니다.</label></p>
        <?php }?>
        <p><input type="file" size="65" name="<?php echo File::Inst()->Config('form_name', 'file')?>[]"/></p>
        <br clear="both"/>
        <div class="desc"> - 사진의 적정 크기: 가로 <?php echo $pic_width?>pixel/세로 <?php echo $pic_height?>pixel</div>
      </td>
    </tr>
    <tr>
      <th class="require">자동등록 방지코드</th>
      <td><?php echo Captcha::Inst()->html()?></td>
    </tr>
    </tbody>
  </table>

  <div class="center">
    <input type="image" src="<?php echo $this->path_img('btn_modify.gif')?>" value="수정"/>
  </div>
</div>

</form>

