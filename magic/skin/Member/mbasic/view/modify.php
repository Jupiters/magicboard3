<?php if(!defined("__MAGIC__")) exit;
$m = $this;
$picture = $m->Action('picture');
?>

<div class="sub_title"><h2>회원서비스</h2></div>
<form class="ui-form" method="post" action="<?php echo $m->Link('update')?>" enctype="multipart/form-data" onsubmit="fsubmit_modify(this); return false;" >
<input type="hidden" name="passwd" value="<?php echo GV::Password('passwd', 'POST')?>"/>
<input type="hidden" name="mb_no" value="<?php echo $m->mb_no?>"/>

<div id="member_modify">
<table class="basic_table">
<caption class="right">[* 필수입력란]</caption>
<colgroup>
	<col width="120px">
	<col>
</colgroup>
<tbody>
<tr>
	<th>회원아이디</th>
	<td class="left"><?php echo $m->mb_id?></td>
</tr>
<tr>
	<th>별명&nbsp;<span class="require">(*)</span></th>
	<td class="left">
		<input type="text" class="require" name="mb_nick" value="<?php echo $m->mb_nick?>" />
	</td>
</tr>
<tr>
	<th>비밀번호<br/>분실질문&nbsp;<span class="require">(*)</span></th>
	<td class="left">
	<div>
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
		<input size="40" type="text" name="mb_question" value="<?php echo $m->mb_question?>"/>
	</div>
	</td>
</tr>
<tr>
	<th>비밀번호<br/>분실답변&nbsp;<span class="require">(*)</span></th>
	<td class="left"><input size="18" type="text" name="mb_answer" value="<?php echo $m->mb_answer?>"/></td>
</tr>
<tr>
	<th>이메일<?php if(Config::Inst()->regist_field_email=='require') echo '&nbsp;<span class="require">(*)</span>';?></th>
	<td class="left">
		<input type="text" size="25" <?php if(Config::Inst()->regist_field_email=='require') echo 'class="require"';?> name="mb_email" value="<?php echo $m->mb_email?>"/>
	</td>
</tr>
<tr>
	<th>서명<?php if (Config::Inst()->regist_field_memo=='require') echo '&nbsp;<span class="require">(*)</span>'; ?></th>
	<td class="left">
		<textarea name="mb_memo"<?php if(Config::Inst()->regist_field_memo=='require') echo 'class="require"';?>  cols="50" rows="4"><?php echo $m->mb_memo?></textarea>
	</td>
</tr>
<tr>
	<th>회원사진</th>
	<td class="left">
	
	<?php if($picture[0]){?>
	<div class="pic flt_l">
	<img src="<?php //echo File::Inst()->Link('thumb', $picture[0]['file_no'],100,100)?>" width="<?php echo $picture_width?>" height="<?php echo $picture_height?>"/>
	<div><input type="checkbox" name="<?php //echo File::Inst()->Config('form_name','del')?>[]" value="<?php //echo $picture[0]['file_no']?>"/>&nbsp;삭제</div>
	</div>
	<?php }?>
	
	<div class="clr_b">&gt; 사진의 적정 크기: 가로 <?php echo $picture_width?>pixel/세로 <?php echo $picture_height?>pixel &gt; 다른사이즈는 자동변환 됩니다.</div>
	<div style="margin-bottom:5px"><input type="file" size="65" name="<?php echo File::Inst()->Config('form_name', 'file')?>[]"/></div>
	</td>
</tr>
<tr>
	<th>자동등록<br/>방지코드&nbsp;<span class="require">(*)</span></th>
	<td class="left"><?php echo Captcha::Inst()->MsgPos('right')->html()?></td>
</tr>
</tbody>
</table>

<div class="center">
<input class="button hover" type="submit" value="수정"/>
</div>
</div>

</form>
