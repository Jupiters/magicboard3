<?php if(!defined('__MAGIC__')) exit;

$key = GV::Number($this->KN());
$board = Board::Inst($this->bo_id);
$v = $this->Sql('fetch', $key);
$comments = Comment::Inst('mbasic'
	)->wr_no($key
	)->bo_no($board->bo_no
	)->html(
);

// 파일 정보를 가져옴
$file = File::Inst()->wr_no($key);
?>
<div data-role="navbar" data-iconpos="top">
<ul><?php include($this->path_view('buttons.php'))?></ul>
</div>

<h2><?php echo $v['wr_subject']?></h2>
<p class="right"><?php echo $v['wr_writer']?> <?php echo $v['wr_datetime']?></p>

<?php if(sizeof($file->Action('images', $this->Config('img_width')))!=0) {?>
<div style="margin-bottom:20px"><?php foreach ($file->Action('images', $this->Config('img_width')) as $vv) {?>
<div style="margin-bottom:5px">
<img src="<?php echo $vv['link']?>" width="<?php echo $vv['width']?>" height="<?php echo $vv['height']?>"/>
</div>
<?php }?></div>
<?php }?>

<div style="line-height:1.6;min-height:200px"><?php echo $v['wr_content']?></div>

<div><?php echo $comments?></div>
<div data-role="navbar" data-iconpos="top">
<ul><?php include($this->path_view('buttons.php'))?></ul>
</div>
