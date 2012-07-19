<?php if(!defined('__MAGIC__')) exit; ?>

<div class="sub_title"><h2>회원가입</h2></div>

<form method="post" action="<?php echo $this->Link('insert')?>" onsubmit="fsubmit_write(this); return false;">

<div id="regist">

  <div class="sub_title_box">
    <h3>회원정보</h3>
    <span>회원정보를 입력하세요</span>
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
      <th class="require">아이디</th>
      <td>
        <input type="text" size="12" name="mb_id" class="require" alt="아이디"/>
        <span class="desc"> - 영문과 숫자의 조합으로 입력하세요</span>
      </td>
    </tr>
    <tr>
      <th class="require">비밀번호</th>
      <td><input size="20" type="password" name="mb_passwd" class="require" alt="비밀번호"/></td>
    </tr>
    <tr>
      <th class="require">비밀번호 확인</th>
      <td><input size="20" type="password" name="confirm_passwd" class="require" alt="비밀번호확인"/></td>
    </tr>
    <tr>
      <th class="require">비밀번호 분실시 질문</th>
      <td>
        <div class="gab_line">
          <select id="select_question" style="font-famiily:Gulim" onchange="this.form.mb_question.value=this.value;">
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
            <option value="친구들 별명중 가장 웃겼던 별명은?">친구들 별명중 가장 웃겼던 별명은?</option>
            <option value="">직접입력</option>
          </select>
        </div>
        <div>
          <input size="40" type="text" name="mb_question" class="require" alt="비밀번호 분실 시 질문"/>
        </div>
      </td>
    </tr>
    <tr>
      <th class="require">비밀번호 분실시 답변</th>
      <td><input size="18" type="text" name="mb_answer" class="require" alt="비밀번호 분실 시 답변"/></td>
    </tr>
    <tr>
      <th class="require">이름</th>
      <td>
        <input type="text" size="10" name="mb_nick" class="require"/>
        <span class="desc"> - 본인확인 용도 이외의 목적으로 사용되지 않습니다.</span>
      </td>
    </tr>
    <tr>
      <th class="require">별명</th>
      <td>
        <input type="text" size="10" name="mb_name" class="require"/>
        <span class="desc"> - 홈페이지 및 각종 게시판에서 사용됩니다.</span>
      </td>
    </tr>
    <tr>
      <th class="require">이메일</th>
      <td>
        <input type="text" size="25" name="mb_email" class="require"/>
        &nbsp;&nbsp;<b>수신동의</b>&nbsp;&nbsp;<input class="check" type="checkbox" name="mb_mailing"/> 동의 합니다.
      </td>
    </tr>
    <tr>
      <th class="require">자동등록 방지코드</th>
      <td>
        <?php echo Captcha::Inst()->html()?>
        <span class="desc"> - 로봇에 의한 자동회원 가입을 방지합니다.</span>
      </td>
    </tr>
  </tbody>
  </table>

  <div class="center">
    <input type="image" class="adjust_button_line" src="<?php echo $this->path_img('btn_regist.gif')?>" alt="회원가입"/>
    <a href="<?php echo Path::Root()?>"><img src="<?php echo $this->path_img('btn_cancel.gif')?>" alt="취소"/></a>
  </div>

</div><!-- #regist -->

</form>

