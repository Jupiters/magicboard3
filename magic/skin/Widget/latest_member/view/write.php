<?php if(!defined('__MAGIC__')) exit;
$data = $this->data; // 변수명 단축 
?>

<form id="widgetWrite" method="post" action="<?php echo $this->action?>">
<input type="hidden" name="wg_skin" value="<?php echo $data['wg_skin']?>"/>

<table class="table_widget">
<tbody>
<tr>
  <th>위젯 너비</th>
  <td>
    <input type="text" name="wg_width" size="4" class="require" alt="위젯너비" value="<?php echo $data['wg_width']?>"/>&nbsp;
    <input type="radio" name="wg_width_unit" value="px" id="unit1" <?php echo $data['wg_width_unit']=='px'?'checked':''?>/>&nbsp;<label for="unit1">px</label>
    <input type="radio" name="wg_width_unit" value="%" id="unit2" <?php echo $data['wg_width_unit']=='%'?'checked':''?>/>&nbsp;<label for="unit2">%</label>
  </td>
</tr>
<tr>
  <th>신규회원스킨 선택</th>
  <td>
    <select name="skin" class="require" alt="신규회원스킨">
<?php foreach ($this->skin_list as $v) {?>
      <option value="<?php echo $v['skin']?>" <?php echo $v['selected']?>><?php echo $v['name']?></option>
<?php }?>
    </select>
    <span>신규회원 스킨을 선택합니다.</span>
  </td>
</tr>
<tr>
  <th>목록 개수</th>
  <td><input type="text" name="rows" size="2" class="require" alt="목록개수" value="<?php echo $data['rows']?>"/>&nbsp;목록보기에서 한페이지에 표시되는 개수 입니다.</td>
</tr>
</tbody>
</table>

<div id="widget_buttons">
  <a><img src="<?php echo $this->btn_cancel?>"/></a>&nbsp;
  <input type="image" src="<?php echo $this->btn_ok?>" alt="확인"/>
</div><!-- #widget_buttons -->

</form>

