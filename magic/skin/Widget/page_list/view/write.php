<?php if(!defined('__MAGIC__')) exit;

// 기존 데이터 불러옴
$data = $this->data;
?>

<form id="widgetWrite" method="post" action="<?php echo $this->action?>">
<input type="hidden" name="bo_no" value="<?php echo $data['bo_no']?>"/>

<table class="table_widget">
<tbody>
<tr>
	<th>페이지너비</th>
	<td>
    <input type="text" name="wg_width" size="4" class="require" alt="페이지너비" value="<?php echo $data['wg_width']?>" title="특수한 경우를 제외하곤 100%를 사용합니다."/>&nbsp;
    <input type="radio" name="wg_width_unit" value="px" id="unit1" <?php echo $data['wg_width_unit']=='px'?'checked':''?>/>&nbsp;<label for="unit1">px</label>
    <input type="radio" name="wg_width_unit" value="%" id="unit2" <?php echo $data['wg_width_unit']=='%'?'checked':''?>/>&nbsp;<label for="unit2">%</label>
    &nbsp;<span>- 페이지가 표시될 곳의 너비를 뜻합니다.</span>
	</td>
</tr>
<tr>
  <th>페이지스킨</th>
  <td>
    <select name="skin" class="require" alt="페이지스킨">
<?php foreach ($this->skin_list as $v) {?>
      <option value="<?php echo $v['skin']?>" <?php echo $v['selected']?>><?php echo $v['name']?></option>
<?php }?>
    </select>
    페이지스킨을 선택합니다.
  </td>
</tr>
<tr>
	<th>에디터 선택</th>
	<td>
    <select name="editor" class="require" alt="에디터">
      <option value="">선택하세요</option>
<?php foreach ($this->editor_list as $v) {?>
      <option value="<?php echo $v['skin']?>" <?php echo $data['editor']==$v['skin']?'selected':''?>><?php echo $v['name']?></option>
<?php }?>
    </select>
	</td>
</tr>
<tr>
	<th>에디터 사이즈</th>
	<td>
    <label>너비</label>&nbsp;<input class="require" alt="에디터 너비" type="text" name="editor_width" size="3" value="<?php echo $data['editor_width']?>"/>
    <label>높비</label>&nbsp;<input class="require" alt="에디터 높이" type="text" name="editor_height" size="3" value="<?php echo $data['editor_height']?>"/>
	</td>
</tr>
</tbody>
</table>

<div id="widget_buttons">
  <a><img src="<?php echo $this->btn_cancel?>"/></a>&nbsp;
  <input type="image" src="<?php echo $this->btn_ok?>" alt="확인"/>
</div><!-- #widget_buttons -->

</form>

