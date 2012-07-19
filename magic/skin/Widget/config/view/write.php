<?php if(!defined('__MAGIC__')) exit;
$data = $this->data; // 변수명 단축 
$list = Config::Inst()->Sql('list');
foreach($list as $k=>$v) {
  if(in_array($v['cf_id'], $data['cf_id'])) {
    $list[$k]['selected'] = true;
  }
}
?>

<form id="widgetConfig" method="post" action="<?php echo $this->action?>">
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
  <th>환경변수선택</th>
  <td class="select-2column">
    <div class="double-line">
      <select size="10" id="selector">
<?php foreach ($list as $v) { if(!$v['selected']) {?>
        <option value="<?php echo $v['cf_id']?>" <?php echo $v['selected']?>><?php echo $v['cf_desc']?></option>
<?php }}?>
      </select>
      &gt;
      <select name="cf_id[]" size="10" multiple="multiple">
<?php foreach ($list as $v) { if($v['selected']){?>
        <option value="<?php echo $v['cf_id']?>" <?php echo $v['selected']?>><?php echo $v['cf_desc']?></option>
<?php }}?>
      </select>
    </div>
    <div>
      <p>- 좌측 환경변수명을 클릭하면 우측으로 선택됩니다.</p>
      <p>- 우측 환경변수명을 클릭하면 선택이 제거됩니다.</p>
    </div>
  </td>
</tr>
</tbody>
</table>

<div id="widget_buttons">
  <a><img src="<?php echo $this->btn_cancel?>"/></a>&nbsp;
  <input type="image" src="<?php echo $this->btn_ok?>" alt="확인"/>
</div><!-- #widget_buttons -->

</form>

<script>
$(function(){
  // =>
  $("#selector").click(function(){
    for(i=0;$(this).length;i++) {
      if($(this).get(0)[i].selected==true) {
        $("select[name='cf_id[]']").append($(this).get(0)[i]);
        break;
      }
    }
  });
  // <=
  $("select[name='cf_id[]']").click(function(){
    for(i=0;$(this).length;i++) {
      if($(this).get(0)[i].selected==true) {
        $("#selector").append($(this).get(0)[i]);
        break;
      }
    }
  });
  $("#widgetConfig").submit(function(){
    var select = $("select[name='cf_id[]']").get(0);
    if(select.length==0) {
      alert("환경변수를 선택하세요");
      return false;
    }
    for(i=0;select.length;i++) {
      select[i].selected=true;
    }
  });
});
</script>

