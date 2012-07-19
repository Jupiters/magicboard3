<?php if(!defined('__MAGIC__')) exit; 
$list = $this->Sql('list', $this->wr_no);
$cnt = $this->Sql('list_cnt', $this->wr_no);
?>

<h3 style="margin-bottom:10px">댓글 <?php echo number_format($cnt)?>개</h3>

<?php foreach ($list as $v) { ?>
<div style="line-height:1.5;border:1px solid #ccc;padding:5px;margin-bottom:10px">
<?php if($this->Can('delete', $v['cmt_no'])){?><a style="float:right" href="<?php echo $this->Link('delete', $v['cmt_no'])?>" class="delete">삭제</a><?php }?>
<h4 style="margin-bottom:5px"><?php echo $v['cmt_writer']?> - <?php echo $v['cmt_datetime_text']?></h4>
<div>
<?php echo $v['cmt_content']?>
</div>
<?php if(isset($v['children'])){?>
<?php foreach ($v['children'] as $vv) {?>
<div style="line-height:1.5;margin:10px;border:1px solid #ccc;padding:5px;margin-left:10px">
	<?php if($this->Can('delete', $vv['cmt_no'])){?><a style="float:right" href="<?php echo $this->Link('delete', $vv['cmt_no'])?>" class="delete">삭제</a><?php }?>
	<h4 style="margin-bottom:5px"><?php echo $vv['cmt_writer']?> - <?php echo $vv['cmt_datetime_text']?></h4>
	<p><?php echo $vv['cmt_content']?></p>
</div>
<?php }?>
<?php }?>
</div>
<?php }?>

<div style="margin-bottom:20px"><?php include $this->path_view('form.php')?></div>

