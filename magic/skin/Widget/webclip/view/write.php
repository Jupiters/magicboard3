<?php if(!defined('__MAGIC__')) exit;
$key_name = $this->KN();
$key = GV::Number($key_name);
$action = $this->Link('insert');
if($key) {
	$action = $this->Link('update');
}

$view = $this->view;
$skin_list = PageElement::Inst()->SkinList();
?>

<form id="widgetWrite" method="post" action="<?php echo $action?>">

<table class="table_widget">
<tbody>
<tr>
	<th>위젯 너비</th>
	<td class="left">
	<input type="text" name="wg_width" size="4" value="<?php echo $view['wg_width']?>"/>&nbsp;
	<input type="radio" name="wg_width_unit" value="px" id="unit1" <?php echo $view['wg_width_unit']=='px'?'checked':''?>/>
	<label for="unit1">px</label>
	<input type="radio" name="wg_width_unit" value="%" id="unit2" <?php echo $view['wg_width_unit']=='%'?'checked':''?>/>
	<label for="unit2">%</label>
	</td>
</tr>
<tr>
	<th>스킨 선택</th>
	<td class="left">
	<select name="skin">
	<option value="">선택하세요</option>
	<?php foreach ($skin_list as $v) {?>
	<option value="<?php echo $v['skin']?>" <?php echo $view['skin']==$v['skin']?'selected':''?>><?php echo $v['name']?></option>
	<?php }?>
	</select>
	</td>
</tr>
</tbody>
</table>
<div style="padding:20px 0" class="center">
<input class="button" type="submit" value="적용"/>
</div>
</form>

