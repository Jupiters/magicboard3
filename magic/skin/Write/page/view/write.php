<?php if(!defined('__MAGIC__')) exit;
$v = $this->Sql('fetch', $this->wr_no);
$editor = Editor::Inst('wr_content',$this->Config('editor', 'name')
	)->db_edit($v['wr_content']
	)->width($this->Config('editor', 'width')
	)->height($this->Config('editor', 'height')
	)->html(
);
?>
<form method="post" class="page" action="<?php echo $this->Link('update')?>">
<input type="hidden" name="wr_no" value="<?php echo $v['wr_no']?>"/>
<input type="hidden" name="wr_writer" value="페이지"/>
  <div><?php echo $editor?></div>

  <div class="center">
    <input type="image" class="adjust_button_line" src="<?php echo $this->path_img('btn_modify.gif')?>" value="수정"/>
    <a href="<?php echo $this->Link('list')?>"><img src="<?php echo $this->path_img('btn_cancel.gif')?>" alt="취소"/></a>
  </div>

</form>


