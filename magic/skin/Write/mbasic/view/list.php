<?php if(!defined('__MAGIC__')) exit; 
$list = $this->Sql('list');
$config = Board::Inst()->bo_no($this->bo_no);
?>

<div data-role="navbar" data-iconpos="top">
<ul><?php echo Paging::Inst('mbasic'
	)->rows($this->Config('rows')
	)->tot($this->Sql('list_cnt')
	)->html(
)?>
<?php include($this->path_view('buttons.php'))?></ul>
</div>

<ul data-role="listview" data-divider-theme="b" data-inset="true">
<li data-role="list-divider" role="heading"><?php echo $config->bo_subject?></li>
<?php foreach($list as $v) { ?>
<li data-theme="c">
<a href="<?php echo $v['wr_subject']['href']?>" data-transition="slide"><?php echo $v['wr_subject']['text']?></a>
</li>
<?php }?>
<?php if(sizeof($list)==0) {?><li><a href="#">게시글이 없습니다.</a></li><?php }?>
</ul>

<div data-role="navbar" data-iconpos="top">
<ul><?php echo Paging::Inst('mbasic'
	)->rows($this->Config('rows')
	)->tot($this->Sql('list_cnt')
	)->html(
)?>
<?php include($this->path_view('buttons.php'))?></ul>
</div>

