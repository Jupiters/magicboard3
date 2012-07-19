<?php if(!defined('__MAGIC__')) exit; 
$stx = GV::String($this->Config('key'));
$msg = $this->Config('msg');
?>
<div class="search">
<form method="post" class="" action="<?php echo Url::This()?>">
  <div class="hidden">
    <a class="btn_cancel" href="<?php echo $this->Link('cancel')?>"><img src="<?php echo $this->path_img('btn_search_cancel.gif')?>"/></a>
    <input type="text" size="10" name="<?php echo $this->Config('key')?>" <?php echo $msg?'title="'.$msg.'"':''?> value="<?php echo $stx?>"/>
  </div>
  <img class="btn_search2" src="<?php echo $this->path_img('btn_search2.gif')?>" alt="검색"/>
  <input type="image" class="btn_search" src="<?php echo $this->path_img('btn_search.gif')?>" alt="검색"/>
</form>
</div>
