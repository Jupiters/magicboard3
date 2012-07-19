<?php if(!defined('__MAGIC__')) exit; 

include $this->path_view('top.php');
include $this->path_view('side.php');
?>
<div id="msg_body">


<form method="post" action="<?php echo $this->Link('insert')?>">
<!-- 상단버튼 -->
<div style="margin:5px">
<input type="submit" value="보내기" class="btn"/>
<input type="button" value="취소" class="btn" onclick="location.href = '<?php echo $this->Link('list')?>'"/>
</div>

<table id="msg_write">
<tbody>
<tr>
<th width="80">받는사람</th>
<td class="gray_9"><input type="text" name="receivers" size="20" value="<?php echo $_GET['receivers']?>" class="txt"/> - 여러명 쪽지발송시 아이디를 콤마(,)로 분리 </td>
</tr>

<tr>
<th>제목</th>
<td><input type="text" name="msg_subject" size="64" value="<?php echo $view['msg_subject']?>" class="txt"/></td>
</tr>

</tbody>
</table>

<div style="padding-left:5px"><textarea style="width:545px;border:1px solid #ccc;padding:5px" name="msg_content" rows="10" cols="10000"></textarea></div>
<!-- 하단버튼 -->
<div style="margin:5px">
<input type="submit" value="보내기" class="btn"/>
<input type="button" value="취소" class="btn" onclick="location.href = '<?php echo $this->Link('list')?>'"/>
</div>

</form>


</div><!-- #msg_body -->