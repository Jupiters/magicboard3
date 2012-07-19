<?php if(!defined('__MAGIC__')) exit;
include_once $this->path_view('top.php');
?>

<!-- 비밀번호확인 -->
<form method="post" action="<?php echo Url::Get('', GV::check)?>">
<table class="basic_table">
<thead>
<tr><th>비밀번호 확인</th></tr>
</thead>
<tbody>
<tr>
<td>
<input type="password" name="<?php echo GV::password?>"/>
<input type="image" src="<?php echo $this->path_img('btn_ok.gif')?>" alt="확인"/>
</td>
</tr>
</tbody>
</table>
</form>
