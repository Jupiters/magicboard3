<?php if(!defined('__MAGIC__')) exit;
$action = $this->Link('insert');
?>

<form method="post" action="<?php echo $action?>" enctype="multipart/form-data">
<label for="wr_subject">제목</label>
<input type="text" name="wr_subject" id="wr_subject" value=""/>
<label for="wr_content">내용</label>
<textarea id="wr_content" name="wr_content"></textarea>
<input type="submit" value="확인"/>
</form>

