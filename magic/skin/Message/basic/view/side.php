<?php if(!defined('__MAGIC__')) exit; 
$state_x = GV::Number('state_x');
$state_o = GV::Number('state_o');

$active=array();
if($state_x==20) $active[0] = true;
if($state_x==16&&$state_o==8) $active[1] = true;
if($state_x==16&&$state_o=='') $active[2] = true;
if($state_o==16) $active[3] = true;
?>
<ul id="msg_menu">
<li><a href="<?php echo $this->Link('write')?>">쪽지쓰기</a></li>
<li <?php echo $active[0]?'class="active"':''?>><a href="<?php echo $this->Link('list_inbox')?>">받은쪽지함</a></li>
<li <?php echo $active[1]?'class="active"':''?>><a href="<?php echo $this->Link('list_star')?>">별표쪽지함</a></li>
<li <?php echo $active[2]?'class="active"':''?>><a href="<?php echo $this->Link('list_all')?>">전체쪽지함</a></li>
<li <?php echo $active[3]?'class="active"':''?>><a href="<?php echo $this->Link('list_trash')?>">휴지통</a></li>
</ul>
