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
    <input type="text" name="wg_width" class="require" alt="위젯너비" size="4" value="<?php echo $data['wg_width']?>"/>&nbsp;
    <input type="radio" name="wg_width_unit" value="px" id="unit1" <?php echo $data['wg_width_unit']=='px'?'checked':''?>/>&nbsp;<label for="unit1">px</label>
    <input type="radio" name="wg_width_unit" value="%" id="unit2" <?php echo $data['wg_width_unit']=='%'?'checked':''?>/>&nbsp;<label for="unit2">%</label>
  </td>
</tr>
<tr>
  <th>게시판</th>
  <td>
    <div class="double-line">
      <select name="bo_no" alt="게시판">
<?php foreach ($this->board_list as $v) {?>
        <option value="<?php echo $v['bo_no']?>" <?php echo $v['selected']?>><?php echo $v['bo_subject']?></option>
<?php }?>
      </select>
      <span>기존 게시판을 선택할 수 있습니다.</span>
    </div>
    <div>
      <input type="text" size="15" name="bo_subject" class="require" alt="게시판"/>&nbsp;<span>새로운 게시판명을 입력하세요.</span>
    </div>
  </td>
</tr>
<tr>
  <th>스킨 선택</th>
  <td>
    <select name="skin" class="require" alt="게시판 스킨">
<?php foreach ($this->skin_list as $v) {?>
      <option value="<?php echo $v['skin']?>" <?php echo $v['selected']?>><?php echo $v['name']?></option>
<?php }?>
    </select>
    게시판 스킨을 선택합니다.
  </td>
</tr>
<tr>
  <th>이미지 너비</th>
  <td><input type="text" name="img_width"  class="require" alt="이미지너비" size="4" value="<?php echo $data['img_width']?>"/>&nbsp;px&nbsp;게시글 보기에서 표시되는 이미지의 너비입니다.</td>
</tr>
<tr>
  <th>목록 개수</th>
  <td><input type="text" name="rows"  class="require" alt="목록 개수" size="2" value="<?php echo $data['rows']?>"/>&nbsp;목록보기에서 한페이지에 표시되는 개수 입니다.</td>
</tr>
<tr>
  <th>컬럼표시</th>
  <td>
    <div class="notice">!! 클릭하여 좌우로 드래그하면 순서를 변경할 수 있습니다.</div>
    <div class="notice">!! 변경된 순서는 목록표시에 반영됩니다.</div>
    <ul class="columns">
      <?php foreach($data['columns'] as $k=>$v) {?>
      <li><input type="checkbox" name="columns[]" value="<?php echo $k?>" id="col_<?php echo $k?>" <?php echo $v?'checked':''?>/>&nbsp;<label for="col_<?php echo $k?>"><?php echo $this->Config('columns_name',$k)?></label></li>
      <?php }?>
    </ul>
  </td>
</tr>
<tr>
  <th>공지표시</th>
  <td>
    <input type="checkbox" name="show_notice" value="1" id="show_notice" <?php echo $data['show_notice']?'checked':''?>/>
    &nbsp;<label for="show_notice">목록보기에 공지사항을 표시합니다.</label>
  </td>
</tr>
<tr>
  <th>댓글사용</th>
  <td>
    <input type="checkbox" name="use_comment" value="1" id="use_comment" <?php echo $data['use_comment']?'checked':''?>/>
    &nbsp;<label for="use_comment">게시글 보기에 댓글표시합니다.</label>
  </td>
</tr>
<tr>
  <th>목록보기</th>
  <td>
    <input type="checkbox" name="list_view" value="1" id="list_view" <?php echo $data['list_view']?'checked':''?>/>
    &nbsp;<label for="list_view">게시글 보기에서 하단에 목록을 표시해 줍니다.</label>
  </td>
</tr>
</tbody>
</table>

<div id="widget_buttons">
  <a><img src="<?php echo $this->btn_cancel?>"/></a>&nbsp;
  <input type="image" src="<?php echo $this->btn_ok?>" alt="확인"/>
</div><!-- #widget_buttons -->

</form>


<style>
td div.notice { margin-bottom:5px; color:#ff8400; }
ul.columns li { float:left; margin-right:5px; }
ul.columns li label { cursor:w-resize; }
</style>

<script type="text/javascript">
$(function(){
  // 새로운 게시판 생성
  $("select[name='bo_no']").change(function(){
    if($(this).val()=='') {
      $("input[name='bo_subject']").removeAttr("disabled");
      $("input[name='bo_subject']").focus();
    } else {
      $("input[name='bo_subject']").attr("disabled", "disabled");
    }
  });
  // 수정시 게시판이 선택되어 있다면 게시판명 필드를 disable 시킨다
  if($("select[name='bo_no']").val()=='') {
    $("input[name='bo_subject']").removeAttr("disabled");
    $("input[name='bo_subject']").focus();
  } else {
    $("input[name='bo_subject']").attr("disabled", "disabled");
  }
  $("ul.columns").sortable();
  $("input[name='columns[]']").click(function(){
    if($(this).attr("value")=="wr_subject") {
      alert("제목은 필수항목입니다.");
      $(this).attr("checked","checked");
      return false;
    }
  });
});
</script>
