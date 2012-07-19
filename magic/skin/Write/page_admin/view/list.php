<?php if(!defined('__MAGIC__')) exit;
?>

<?php if(sizeof($this->list)==0) {?>
<div class="no_contents">
<p>단락추가 버튼이 보이지 않는다면</p>
<p>페이지[Off] 버튼을 눌러 단락을 추가하세요.</p>
</div>
<?}?>

<div class="page_list_sortable">
<?php foreach($this->list as $v) {?>
  <div class="content">
<?php if($v['href_modify']){?>
    <div class="buttons">
      <a href="<?php echo $v['href_modify']?>" class="button modify">단락수정</a>
      <a href="<?php echo $v['href_delete']?>" class="button delete">단락삭제</a>
      <a href="<?php echo htmlspecialchars_decode($this->Link('update_order'))?>" class="button ui-icon-arrowthick-2-n-s no-text">드래그하여 순서를 변경할 수 있습니다.</a>
    </div>
<?php }?>
    <?php echo $v['content']?>
  </div>
<?php }?>
</div>

<?php if($this->mode_write) include($this->path_view('write.php'))?>

<?php if($this->href_write){?>
<div class="right"><a href="<?php echo $this->href_write?>" class="button ui-icon-pencil">단락추가</a></div>
<?php }?>

