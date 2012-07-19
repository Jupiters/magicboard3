<?php if(!defined('__MAGIC__')) exit;
$link_list = $this->href_list;
?>
<form method="post" class="page" action="<?php echo $this->action?>">
<input type="hidden" name="wr_writer" value="페이지"/>

<div style="padding:5px; border:1px solid #ccc;margin-bottom:5px">
  <strong>단락제목</strong>
  <input type="text" name="wr_subject" value="<?php echo $data['wr_subject']?>" style="width:470px"/>
</div>
<div style="padding:5px; border:1px solid #ccc;margin-bottom:5px">
  <strong>제목굵기</strong>
  <select name="wr_category">
    <option value="h2" <?php echo $data['wr_category']=='h2'?'selected':''?>>H2</option>
    <option value="h3" <?php echo $data['wr_category']=='h3'?'selected':''?>>H3</option>
    <option value="h4" <?php echo $data['wr_category']=='h4'?'selected':''?>>H4</option>
    <option value="h5" <?php echo $data['wr_category']=='h5'?'selected':''?>>H5</option>
    <option value="h6" <?php echo $data['wr_category']=='h6'?'selected':''?>>H6</option>
  </select>
</div>
<div style="margin-bottom:10px"><?php echo $this->editor?></div>
<div class="center">
  <input class="button" type="submit" value="확인"/>
  <input type="button" class="button" onclick="location.href='<?php echo $link_list?>'" value="취소"/>
</div>
</form>


