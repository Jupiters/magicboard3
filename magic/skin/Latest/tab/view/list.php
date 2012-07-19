<?php if(!defined('__MAGIC__')) exit; 
$rows = $this->Config('rows');
$list = array();
foreach($this->bo_no as $v) {
  $_list = $this->Sql('list',$v);
  for($i=0; $i<$rows; $i++) {
    if(!$_list[$i]['wr_subject']) {
      $_list[$i]['wr_subject'] = '게시글이 없습니다.';
    } else {
      $_list[$i]['link'] = $_list[$i]['last_id'].'&wr_no='.$_list[$i]['wr_no'];
    }
  }
  $list[] = $_list;
}
?>

<ul id="tab">
<?php foreach($list as $k=>$v) {?>
  <li <?php echo $k==0?'class="active"':''?>><?php echo $v[0]['bo_subject']?></li>
<?php }?>
</ul>

<div id="board_list">
<?php foreach($list as $k=>$board) { ?>
  <ul class="list" <?php echo $k==0?'':'style="display:none"'?>>
  <?php foreach($board as $k=>$v) {
	$imgs = File::Inst()->wr_no($v['wr_no'])->Action('images', 94, 71); // 썸네일 불러오기
    ?>
    <?php if($k==0) {?>
    <li class="first">
      <?php if($imgs[0]) {?>
      <img src="<?php echo $imgs[0]['link']?>" width="94" height="71"/>
      <?php }?>
      <a href="<?php echo $v['link']?>">
        <h3>
          <?php echo $v['wr_subject']?>
          <?php if($v['cnt_comment']!=0) {?>
          <span class="comment">(<?php echo $v['cnt_comment']?>)</span>
          <?php }?>
        </h3>
        <p><?php echo strip_tags($v['wr_content'])?></p>
      </a>
    </li>
    <?php } else {?>
    <li>
      <span class="datetime"><?php echo array_shift(explode(' ',$v['wr_datetime']))?></span>
      <a href="<?php echo $v['link']?>">
        <?php echo $v['wr_subject']?>
        <?php if($v['cnt_comment']!=0) {?>
        <span class="comment">(<?php echo $v['cnt_comment']?>)</span>
        <?php }?>
      </a>
    </li>
    <?php }?>
  <?php }?>
  </ul>
<?php }?>
</div>


