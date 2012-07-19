<?php if(!defined('__MAGIC__')) exit;
$name = $this->name;
$width = $this->Config('width');
$height = $this->Config('height');
$rows = $this->Config('rows');
$cols = $this->Config('cols');
$class = $this->Config('class');
$contents = $this->contents;
?>
<textarea
	id="<?php echo $name?>"
	name="<?php echo $name?>"
	rows="<?php echo $rows?>"
	cols="<?php echo $cols?>"
	class="require <?php echo $class?>"
	style="width:<?php echo $width?>;height:<?php echo $height?>"
	alt="내용"
><?php echo $contents?></textarea>


<script type="text/javascript"> 
//<![CDATA[
var myeditor; // cheditor instance
function doSubmit (theform) {
	var edt = myeditor.outputBodyHTML();
	return true;
}
myeditor = new cheditor();
myeditor.config.editorHeight = '<?php echo $height?>';
myeditor.config.editorWidth = '<?php echo $width?>';
myeditor.inputForm = '<?php echo $name?>';
myeditor.run();
//]]>
</script>