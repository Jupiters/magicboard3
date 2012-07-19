<?php if(!defined('__MAGIC__')) exit;
$v = $this->Sql('fetch', GV::Number($this->KN()));
?>

<form method="post" action="<?php echo $this->Link('update')?>" enctype="multipart/form-data">
<input type="hidden" name="mb_no" value="<?php echo $v['mb_no']?>"/>
<input type="hidden" name="mb_id" value="<?php echo $v['mb_id']?>"/>
<input type="hidden" name="mb_passwd_check" value="<?php echo $v['mb_passwd']?>"/>

<table class="table_admin2">
  <colgroup>
    <col width="150px">
    <col>
  </colgroup>
  <thead class="type2">
    <tr><th colspan="2">회원정보</th></tr>
  </thead>
  <tbody>
  <tr>
    <th>회원번호</th>
    <td><?php echo $v['mb_no']?></td>
  </tr>
  <tr>
    <th>아이디</th>
    <td><?php echo $v['mb_id']?></td>
  </tr>
  <tr>
    <th>패스워드</th>
    <td class="left"><input class="tp_right" type="password" name="mb_passwd" value="" title="수정시에만 입력"/></td>
  </tr>
  <tr>
    <th>회원별명</th>
    <td><input type="text" name="mb_nick" value="<?php echo $v['mb_nick']?>"/></td>
  </tr>
  <tr>
    <th>비밀번호<br/>분실질문</th>
    <td>
      <select id="select_question" onchange="this.form.mb_question.value=this.value;">
        <option value="">선택하십시오.</option>
        <option value="내가 좋아하는 캐릭터는?">내가 좋아하는 캐릭터는?</option>
        <option value="타인이 모르는 자신만의 신체비밀이 있다면?">타인이 모르는 자신만의 신체비밀이 있다면?</option>
        <option value="자신의 인생 좌우명은?">자신의 인생 좌우명은?</option>
        <option value="초등학교 때 기억에 남는 짝꿍 이름은?">초등학교 때 기억에 남는 짝꿍 이름은?</option>
        <option value="유년시절 가장 생각나는 친구 이름은?">유년시절 가장 생각나는 친구 이름은?</option>
        <option value="가장 기억에 남는 선생님 성함은?">가장 기억에 남는 선생님 성함은?</option>
        <option value="친구들에게 공개하지 않은 어릴 적 별명이 있다면?">친구들에게 공개하지 않은 어릴 적 별명이 있다면?</option>
        <option value="다시 태어나면 되고 싶은 것은?">다시 태어나면 되고 싶은 것은?</option>
        <option value="가장 감명깊게 본 영화는?">가장 감명깊게 본 영화는?</option>
        <option value="읽은 책 중에서 좋아하는 구절이 있다면?">읽은 책 중에서 좋아하는 구절이 있다면?</option>
        <option value="기억에 남는 추억의 장소는?">기억에 남는 추억의 장소는?</option>
        <option value="인상 깊게 읽은 책 이름은?">인상 깊게 읽은 책 이름은?</option>
        <option value="자신의 보물 제1호는?">자신의 보물 제1호는?</option>
        <option value="받았던 선물 중 기억에 남는 독특한 선물은?">받았던 선물 중 기억에 남는 독특한 선물은?</option>
        <option value="자신이 두번째로 존경하는 인물은?">자신이 두번째로 존경하는 인물은?</option>
        <option value="아버지의 성함은?">아버지의 성함은?</option>
        <option value="어머니의 성함은?">어머니의 성함은?</option>
        <option value="">직접입력</option>
      </select>
      <input size="40" type="text" name="mb_question" value="<?php echo $v['mb_question']?>"/>
    </td>
  </tr>
  <tr>
    <th>비밀번호<br/>분실답변</th>
    <td><input size="18" type="text" name="mb_answer" value="<?php echo $v['mb_answer']?>"/></td>
  </tr>
  <tr>
    <th>이메일</th>
    <td>
      <input type="text" size="50" name="mb_email" value="<?php echo $v['mb_email']?>"/>
    </td>
  </tr>
  <tr>
    <th>레벨</th>
    <td><input type="text" size="2" name="mb_level" value="<?php echo $v['mb_level']?>"/></td>
  </tr>
  <tr>
    <th>등급</th>
    <td>
      <input id="mb_grade1" type="radio" name="mb_grade" value="member" <?php if($v['mb_grade']=='member') echo 'checked';?>/>
      <label for="mb_grade1">회원</label>
      <input id="mb_grade2" type="radio" name="mb_grade" value="manager" <?php if($v['mb_grade']=='manager') echo 'checked';?>/>
      <label for="mb_grade2">운영자</label>
      <input id="mb_grade3" type="radio" name="mb_grade" value="admin" <?php if($v['mb_grade']=='admin') echo 'checked';?>/>
      <label for="mb_grade3">관리자</label>
    </td>
  </tr>
  <tr>
    <th>회원가입일</th>
    <td>
    <input type="text" name="mb_datetime" value="<?php echo $v['mb_datetime']?>"/>
    <input id="mb_datetime_now" type="checkbox" name="mb_datetime_now" value="1"/>
    <label for="mb_datetime_now">지금으로 변경</label>
    </td>
  </tr>
  <tr>
    <th>서명</th>
    <td><textarea name="mb_memo" rows="4" cols="40"><?php echo $v['mb_memo']?></textarea></td>
  </tr>
  </tbody>
</table>

<div class="center">
  <input class="adjust_button_line" type="image" src="<?php echo Layout::Inst('admin')->path_img('btn_modify.gif')?>"  alt="수정"/>
  <a onclick="location.href='<?php echo $this->Link('list')?>'"><img src="<?php echo Layout::Inst('admin')->path_img('btn_cancel.gif')?>" alt="취소"/>
</div>

</form>
