<?php if(!defined('__MAGIC__')) exit;
$link_list = $this->href_list;
?>
<form method="post" class="page" action="<?php echo $this->action?>">
<input type="hidden" name="wr_no" value="<?php echo $data['wr_no']?>"/>
<input type="hidden" name="wr_writer" value="페이지"/>

<div style="padding:5px; border:1px solid #ccc;margin-bottom:5px">
  <strong>단락제목</strong>
  <input type="text" name="wr_subject" value="<?php echo $data['wr_subject']?>" style="width:470px"/>
</div>
<div style="padding:5px; border:1px solid #ccc;margin-bottom:5px">
  <strong>모양선택</strong>
  <select name="wr_category">
    <option value="" <?php echo $data['wr_category']=='basic'?'selected':''?>>기본스타일</option>
    <option value="underline" <?php echo $data['wr_category']=='underline'?'selected':''?>>밑줄있는 스타일</option>
  </select>
</div>
<div style="margin-bottom:10px"><?php echo $this->editor?></div>
<div class="center">
  <input class="button" type="submit" value="확인"/>
  <input type="button" class="button" onclick="location.href='<?php echo $link_list?>'" value="취소"/>
</div>
</form>


