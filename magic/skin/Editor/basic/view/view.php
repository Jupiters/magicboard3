<?php if(!defined('__MAGIC__')) exit;
$name = $this->name;
$width = $this->Config('width');
$height = $this->Config('height');
$rows = $this->Config('rows');
$cols = $this->Config('cols');
$class = $this->Config('class');
$contents = $this->contents;
?>
<textarea name="<?php echo $name?>" rows="<?php echo $rows?>" cols="<?php echo $cols?>" class="txteditor <?php echo $class?>" style="width:<?php echo $width?>;height:<?php echo $height?>"><?php echo $contents?></textarea>