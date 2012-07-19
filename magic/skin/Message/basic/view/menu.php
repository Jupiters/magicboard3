<?php if(!defined('__MAGIC__')) exit;
$msg_no = GV::Number('msg_no');
$state_x = GV::Number('state_x');
$state_o = GV::Number('state_o');
?>
<div style="float:right;margin:5px 5px 0 0"><?php include $this->path_view('paging.php')?></div>
<ul id="msg_sub_menu">
<?php if($this->CurrentState()=='list'){?>
<li style="margin:3px 3px 0 3px"><input type="checkbox" onclick="toggleSet(this)" title="전체선택"/></li>
<?php }?>

<?php if($this->CurrentState()=='view'){?>
<li><button onclick="location.href ='<?php echo $this->Link('list')?>'">목록</button></li>
<?php }?>

<?php if(!($state_x==16&&$state_o==8) && $state_o!=16){?>
<li><button onclick="f = FindForm(this); if(f) {f.action = '<?php echo $this->Link('star')?>'; f.submit();} else location.href ='<?php echo $this->Link('star', $msg_no)?>'">별표</button></li>
<?php }?>

<?php if($state_o==16){?>
<li><button onclick="f = FindForm(this); if(f) {f.action = '<?php echo $this->Link('restore')?>'; f.submit();} else location.href ='<?php echo $this->Link('restore', $msg_no)?>'">복구</button></li>
<li><button onclick="f = FindForm(this); if(f) {f.action = '<?php echo $this->Link('delete')?>'; f.submit();} else location.href ='<?php echo $this->Link('delete', $msg_no)?>'">완전삭제</button></li>
<?php }?>
<?php if(($state_x==16&&$state_o==8) || $state_x==20){?>
<li><button onclick="f = FindForm(this); if(f) {f.action = '<?php echo $this->Link('archive')?>'; f.submit();} else location.href ='<?php echo $this->Link('archive', $msg_no)?>'">보관</button></li>
<?php }?>
<?php if($state_o!=16){?>
<li><button onclick="f = FindForm(this); if(f) {f.action = '<?php echo $this->Link('trash')?>'; f.submit();} else location.href ='<?php echo $this->Link('trash', $msg_no)?>'">삭제</button></li>
<?php }?>
</ul>
