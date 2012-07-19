<?php if(!defined('__MAGIC__')) exit; ?>

<div class="sub_title"><h2>회원가입</h2></div>
<form method="post" class="ui-form" action="<?php echo $this->Link('insert')?>" onsubmit="fsubmit_write(this); return false;">

<div id="regist">
<table class="basic_table">
<caption class="right">[* 필수입력]</caption>
<colgroup>
	<col width="150px">
	<col>
</colgroup>
<tbody>
<tr>
	<th>아이디&nbsp;<span class="require">(*)</span></th>
	<td class="left"><input type="text" size="12" name="mb_id"/></td>
</tr>
<tr>
	<th>비밀번호&nbsp;<span class="require">(*)</span></th>
	<td class="left"><input size="20" type="password" name="mb_passwd"/></td>
</tr>
<tr>
	<th>비밀번호 확인&nbsp;<span class="require">(*)</span></th>
	<td class="left"><input size="20" type="password" name="confirm_passwd"/></td>
</tr>
<tr>
	<th>비밀번호 분실시<br/>질문&nbsp;<span class="require">(*)</span></th>
	<td class="left">
	<div>
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
		<input size="40" type="text" name="mb_question"/>
	</div>
	</td>
</tr>
<tr>
	<th>비밀번호 분실시<br/>답변&nbsp;<span class="require">(*)</span></th>
	<td class="left"><input size="18" type="text" name="mb_answer"/></td>
</tr>
<?php if(Config::Inst()->regist_field_nick!='false'){?>
<tr>
	<th>별명<?php if(Config::Inst()->regist_field_nick=='require') echo '&nbsp;<span class="require">(*)</span>';?></th>
	<td class="left">
		<input type="text" size="10" <?php if(Config::Inst()->regist_field_nick=='require') echo 'class="require"';?> name="mb_nick"/>
	</td>
</tr>
<?php }?>
<?php if(Config::Inst()->regist_field_email!='false'){?>
<tr>
	<th>이메일<?php if(Config::Inst()->regist_field_email=='require') echo '&nbsp;<span class="require">(*)</span>';?></th>
	<td class="left">
		<input type="text" size="25" <?php if(Config::Inst()->regist_field_email=='require') echo 'class="require"';?> name="mb_email"/>
		&nbsp;&nbsp;<b>수신동의</b>&nbsp;&nbsp;<input class="check" type="checkbox" name="mb_mailing"/> 동의 합니다.
	</td>
</tr>
<?php }?>
<?php if(Config::Inst()->regist_field_signature!='false'){?>
<tr>
	<th>서명</th>
	<td class="left">
		<textarea cols="50" rows="5" <?php if(Config::Inst()->regist_field_memo=='require') echo 'class="require"';?> name="mb_memo"></textarea>
		<?php if (Config::Inst()->regist_field_memo=='require') echo '<span class="require">&nbsp;[필수입력]</span>'?>
	</td>
</tr>
<?php }?>
<tr>
	<th>자동등록<br/>방지코드&nbsp;<span class="require">(*)</span></th>
	<td class="left"><?php echo Captcha::Inst()->MsgPos('right')->html()?></td>
</tr>
</tbody>
</table>

<div class="center buttonset">
<input class="button hover" type="submit" value="회원가입"/><input class="button" type="button" value="취소" onclick="location.href='<?php echo Path::Group()?>'"/>
</div>
</div>

</form>
