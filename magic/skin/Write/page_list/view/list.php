<?php if(!defined('__MAGIC__')) exit;
?>

<div class="page_list_sortable">
<?php foreach($this->list as $v) {?>
  <div class="page_list_content">
    <?php echo $v['content']?>
<?php if($v['href_modify']){?>
    <div class="page_buttons">
      <a href="<?php echo $v['href_modify']?>" class="modify tp" title="단락수정"><img src="<?php echo $this->path_img('btn_modify.gif')?>" alt="단락수정"/></a></a>
      <a href="<?php echo $v['href_delete']?>" class="delete tp" title="단락삭제"><img src="<?php echo $this->path_img('btn_delete.gif')?>" alt="단락삭제"/></a></a>
    </div>
    <a class="move tp" href="<?php echo htmlspecialchars_decode($this->Link('update_order'))?>" title="드래그하여 단락순서를 변경할 수 있습니다."><img src="<?php echo $this->path_img('btn_move.gif')?>" alt="단락이동"/></a>
<?php }?>
  </div>
<?php }?>
</div>

<?php if(sizeof($this->list)==0) {?>
<div class="no_contents">
  <p>단락추가 버튼을 클릭하여 단락을 추가하세요.</p>
  <p>단락추가 버튼이 안보이면 상단의 페이지수정[Off] 버튼을 클릭하여 페이지수정 모드를 켜세요.</p>
  <p>페이지 자체를 삭제하기 위해서는 위젯수정[Off] 버튼을 클릭하여 위젯 삭제를 하시면 됩니다.</p>
</div>
<?php }?>

<?php if($this->mode_write) include($this->path_view('write.php'))?>

<?php if($this->href_write){?>
<div class="right"><a href="<?php echo $this->href_write?>"><img src="<?php echo $this->path_img('btn_add.gif')?>" alt="단락추가"/></a></div>
<?php }?>

