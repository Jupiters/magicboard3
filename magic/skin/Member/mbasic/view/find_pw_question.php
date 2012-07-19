<?php if(!defined('__MAGIC__')) exit;
$v = $this->Sql('fetch_by_id', GV::Id('mb_id'));
?>

<div class="title"><h2>회원서비스</h2></div>

<form method="post" action="<?php echo $this->Link('find_pw_question_check')?>"> 
<input type="hidden" name="mb_no" value="<?php echo $v['mb_no']?>"/>
<table class="basic_table" border="1" cellspacing="0">
<thead>
	<tr><th>비밀번호 찾기 질문</th></tr>
</thead>
<tbody>
<tr>
	<td>
		<p>질문 : <?php echo $v['mb_question']?></p>
		<input type="text" class="text" name="mb_answer"/>
		<input type="image" src="<?php echo $this->path_img('find_password_btn.gif')?>"/>
	</td>
</tr>
</tbody>
</table>
</form>
