<?php if(!defined('__MAGIC__')) exit; 
$src = $this->path_view('zmSpamFree.php?zsfimg='.time());
$msg = $this->Config('msg');
$position = $this->Config('position');
?>
<img src="<?php echo $src?>" class="zsfImg" alt="ZSF" title="새로고침" style="cursor:pointer"/>
<input
	type="text" size="4" maxlength="10" name="zsfCode" id="zsfCode"
  class="require <?php echo $position?$position:''?>"
	<?php echo $msg?'title="'.$msg.'"':''?>
	alt="자동등록방지코드"
/>
