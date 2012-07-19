<?php if(!defined('__MAGIC__')) exit;
$rows = $this->Config('rows');
$page = GV::Page()?GV::Page():1;
$tot = $this->Sql('list_cnt');
$from = (intval($page)-1)*intval($rows)+1;
$to = $from+$rows-1;
if($tot<$to) $to = $tot;

$link_prev = '';
$link_next = '';
if($tot>$rows) {
	if($page>1) $link_prev = Url::Get(array('page'=>$page-1));
	if($to<$tot) $link_next = Url::Get(array('page'=>$page+1));
}
?>
<?php if($this->CurrentState()!='view' && $tot>$rows){?>
<?php echo $tot?>개 중 <?php echo $from?>-<?php echo $to?>&nbsp;
<button <?php echo $link_prev?'':'disabled="disabled"'?> onclick="location.href = '<?php echo $link_prev?>';return false">&nbsp;&lt;&nbsp;</button>
<button <?php echo $link_next?'':'disabled="disabled"'?> onclick="location.href = '<?php echo $link_next?>';return false">&nbsp;&gt;&nbsp;</button>
<?php }?>