<?php if(!defined('__MAGIC__')) exit; 
$list = $this->Sql('list');
$rows = $this->Config('rows');
?>
<table class="basic_table" border="1" cellspacing="0" summary="최근게시글" style="margin-top:10px">
<caption>최근게시글</caption>
<thead>
<tr>
<th><a href="<?php echo $this->Config('bo_location')?>"><?php echo $this->Config('bo_subject')?></a></th>
</tr>
</thead>
<tbody class="hover">
<?php for($i=0; $i<$rows; $i++) { $v = $list[$i]; ?>
<tr><td class="left">
<?php if(isset($v) && is_array($v)) { ?>
<a href="<?php echo $this->Link('subject',$v['wr_no'])?>">
<?php echo $v['wr_subject']?>
<?php if($v['cnt_comment']!=0) { ?>&nbsp;<span class="comment">(<?php echo $v['cnt_comment']?>)</span><?php }?>
</a>
<?php } else {?>
게시글이 없습니다.
<?php }?>
</td></tr>
<?php }?>
</tbody>
</table>