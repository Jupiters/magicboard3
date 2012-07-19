<?php if(!defined('__MAGIC__')) exit;
$data = $this->data; // 변수명 단축 
?>

<form id="widgetLatest" method="post" action="<?php echo $this->action?>">
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
  <th>게시판</th>
  <td class="select-2column">
    <div class="double-line">
      <select size="10" id="selector">
<?php foreach ($this->board_list as $v) { if(!$v['selected']) {?>
        <option value="<?php echo $v['bo_no']?>"><?php echo $v['bo_subject']?></option>
<?php }}?>
      </select>
      &gt;
      <select name="bo_no[]" size="10" multiple="multiple">
<?php foreach ($this->board_list as $v) { if($v['selected']) {?>
        <option value="<?php echo $v['bo_no']?>"><?php echo $v['bo_subject']?></option>
<?php }}?>
      </select>
    </div>
    <p>- 탭방식 일때에만 여러개의 게시판을 선택할 수 있습니다.</p>
  </td>
</tr>
<tr>
  <th>최신글스킨 선택</th>
  <td>
    <select name="skin" class="require" alt="최신글스킨">
<?php foreach ($this->skin_list as $v) {?>
      <option value="<?php echo $v['skin']?>" <?php echo $v['selected']?>><?php echo $v['name']?></option>
<?php }?>
    </select>
    <span>최근게시글 스킨을 선택합니다.</span>
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

<script>
$(function(){
  // =>
  $("#selector").click(function(){
    for(i=0;$(this).length;i++) {
      if($(this).get(0)[i].selected==true) {
        $("select[name='bo_no[]']").append($(this).get(0)[i]);
        break;
      }
    }
  });
  // <=
  $("select[name='bo_no[]']").click(function(){
    for(i=0;$(this).length;i++) {
      if($(this).get(0)[i].selected==true) {
        $("#selector").append($(this).get(0)[i]);
        break;
      }
    }
  });
  $("#widgetLatest").submit(function(){
    var select = $("select[name='bo_no[]']").get(0);
    if(select.length==0) {
      alert("게시판을 선택하세요");
      return false;
    }
    for(i=0;select.length;i++) {
      select[i].selected=true;
    }
  });
});
</script>
