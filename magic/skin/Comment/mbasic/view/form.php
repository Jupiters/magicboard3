<?php if(!defined("__MAGIC__")) exit; 
$parent_no = GV::Number('parent_no');
?>

<?php if($this->Can('write')) {?>
<form method="post" action="<?php echo $this->Link('insert')?>">
<input type="hidden" name="edit" value="0"/>
<input type="hidden" name="wr_no" value="<?php echo $this->wr_no?>"/>
<input type="hidden" name="cmt_parent_no" value="<?php echo $parent_no?>"/>
<div data-role="fieldcontain">
<fieldset data-role="controlgroup">
<textarea name="cmt_content" rows="2" style="width:100%" placeholder=""></textarea>
</fieldset>
</div>
<input type="submit" data-icon="plus" data-iconpos="left" value="댓글입력" data-mini="true" />
</form>
<?php } else {?>
<p class="auth">댓글쓰기 권한이 없습니다.</p>
<?php }?>
