<?php if(!defined('__MAGIC__')) exit;

$key = GV::Number($this->KN());
$board = Board::Inst($this->bo_id);
$v = $this->Sql('fetch', $key);
$comments = Comment::Inst(
	)->wr_no($key
	)->bo_no($board->bo_no
	)->html(
);

// 파일 정보를 가져옴
$file = File::Inst()->wr_no($key)->Protection();
?>

<div id="write_view">
<div class="title">
  <div class="title_bg_left">
  <div class="title_bg_right">
  <h2>
    <?php if($v['wr_category']) {?>
    <span class="category"><?php echo array_pop(explode('|',$v['wr_category']))?> | </span>
    <?php }?>
    <?php echo $v['wr_subject']?>
    <span class="hit">조회: <?php echo $v['wr_hit']?></span>
  </h2>
  <p class="writer">
    <span class="datetime"><?php echo $v['wr_datetime']?></span>
    <?php echo $v['wr_writer']?>
  </p>
  </div>
  </div>

  <!-- 링크 -->
  <?php if($v['wr_link']) {?><p class="link right">
    <a href="<?php echo $v['wr_link']?>" class="popup" title="새창으로 열림"><?php echo $v['wr_link']?></a>
  </p><?php }?>
</div>

<!-- 업로드된 파일목록 -->
<?php if($file->Action('count')!=0) { ?>
<p class="files"><?php foreach ($file->Action('files') as $vv) {?>
  <span style="white-space:nowrap;line-height:1.6">
    <img src="<?php echo $this->path_img('write_icon_file.gif')?>" alt="download"/>
    <a href="<?php echo $file->Link('download',$vv['file_no'])?>" class="popup tp" title="<?php echo number_format($vv['file_size'])?> bytes (<?php echo $vv['file_download']?>)"><?php echo $vv['file_name']?></a>
  </span>
<?php }?></p>
<?php }?>

<!-- 글내용 -->
<div class="content">
  <?php if(sizeof($file->Action('images', $this->Config('img_width')))!=0) {?>
  <div class="center" style="margin-bottom:20px"><?php foreach ($file->Action('images', $this->Config('img_width')) as $vv) {?>
  <div style="margin-bottom:5px">
  <img src="<?php echo $vv['link']?>" width="<?php echo $vv['width']?>" height="<?php echo $vv['height']?>"/>
  </div>
  <?php }?></div>
  <?php }?>
  <?php echo $v['wr_content']?>
  <?php if($this->tags){?>
  <div id="tags">
  <?php foreach($this->tags as $vv) { ?>
      <a href="<?php echo $vv['link']?>"><?php echo $vv['name']?></a>&nbsp;
  <?php }?>
  </div>
  <?php }?>
</div>

</div><!-- #write_view -->

<?php if($this->Config('use_comment')) {?>
<div><?php echo $comments?></div>
<?php }?>

<div style="text-align:right">
  <a style="float:left" href="<?php echo $this->Link('list')?>"><img src="<?php echo $this->path_img('btn_list.gif')?>" alt="목록"/></a>
  <?php include $this->path_view('buttons.php');?>
</div>

<?php if($this->Config('list_view')) {?>
<div style="padding-top:20px; clear:both;">
<?php include $this->path_view('list.php');?>
</div>
<?php }?>
