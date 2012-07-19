<?php if(!defined('__MAGIC__')) exit; 
$view = $this->view;
$action = $this->action;
$skinList = Layout::Inst()->SkinList();
$root_list = $this->root_list;
$main_list = $this->list;

?>

<form method="post" action="<?php echo $action?>">
<input type="hidden" name="m_no" value="<?php echo $view['m_no']?>"/>
<input type="hidden" id="m_parent" name="m_parent" value="<?php echo $view['m_parent']?>"/>

<table class="table_admin2">
  <colgroup>
    <col width="150px">
    <col>
  </colgroup>
  <thead>
    <tr><th colspan="2">메뉴설정</th></tr>
  </thead>

  <tbody>
    <tr>
      <th>메뉴아이디</th>
      <td><input type="text" name="m_id" value="<?php echo $view['m_id']?>"/></td>
    </tr>
    <tr>
      <th>상위메뉴 선택</th>
      <td>
        <select name="root">
          <option value="">메뉴그룹 추가</option>
    <?php foreach ($root_list as $k=>$v) {?>
          <option value="<?php echo $v['m_no']?>" <?php echo $view['root']['m_no']==$v['m_no']?'selected':''?>><?php echo $v['m_id']?></option>
    <?php }?>
        </select>

    <?php foreach ($main_list as $k=>$v) {?>
        <select name="main" class="main" id="root_<?php echo $k?>" <?php echo $k==$view['root']['m_no']?'':'style="display:none" disabled="true" '?>>
          <option value="">없음</option>
    <?php foreach($v as $vv) {?>
          <option value="<?php echo $vv['m_no']?>" <?php echo $view['main']['m_no']==$vv['m_no']?'selected':''?>><?php echo $vv['m_id']?></option>
    <?php }?>
        </select>
    <?php }?>
      </td>
    </tr>
    <tr>
      <th>레이아웃 선택</th>
      <td>
      <select name="m_layout" title="<?php echo Path::Root()?>">
        <option value="">없음</option>
  <?php foreach ($skinList as $v) {?>
        <option value="<?php echo $v['skin']?>" <?php echo $view['m_layout']==$v['skin']?'selected':''?>><?php echo $v['name']?></option>
  <?php }?>
      </select>
      - 레이아웃을 선택하시면 아래 미리보기로 볼 수 있습니다.
      </td>
    </tr>
    <tr>
      <th>메뉴이미지</th>
      <td><input type="text" name="m_image" value="<?php echo $view['m_image']?>"/></td>
    </tr>
    <tr>
      <th>페이지이동</th>
      <td>
      <input type="text" class="tp_bottom" name="m_redirection" value="<?php echo $view['m_redirection']?>" size="40" title="이동할 페이지 주소를 적어 주세요<br/>http://를 포함한 외부주소를 적을시 새창으로 뜹니다"/>&nbsp;
      <input type="checkbox" id="redirect" value="<?php echo $view['child_first']['link']?>"/><label for="redirect">&nbsp;하위첫번째 페이지로 바로 이동</label>
      </td>
    </tr>
    <tr>
      <th>메뉴숨기기</th>
      <td><input type="checkbox" id="m_hidden" name="m_hidden" value="1" <?php echo $view['m_hidden']?'checked':''?>/><label for="m_hidden">&nbsp;메뉴를 홈페이지에서 표시하지 않습니다.</label></td>
    </tr>
    <tr>
      <th>메뉴설명</th>
      <td><input type="text" name="m_desc" value="<?php echo $view['m_desc']?>"/></td>
    </tr>
  </tbody>
</table>

<div id="menu_buttons">
  <input class="adjust_button_line" type="image" src="<?php echo Layout::Inst('admin')->path_img('btn_ok.gif')?>" alt="확인"/>
  <a href="<?php echo $this->Link('list')?>"><img src="<?php echo Layout::Inst('admin')->path_img('btn_list.gif')?>" alt="목록"/></a>
  <?php if($view) {?><a href="<?php echo $this->Link('delete', $view['m_no'])?>" onclick="return confirm('정말로 삭제 하시겠습니까?\n삭제한 데이터는 복구할 수 없습니다.')"><img src="<?php echo Layout::Inst('admin')->path_img('btn_delete.gif')?>" alt="삭제"/></a><?php }?>
</div>

<iframe id="preview" name="preview" src="" width="100%" height="1000px" frameborder="0"></iframe>

</form>

<script>
  function preview() {
    var r=$("select[name='root']").get(0);
    for(i=0; i<r.length; i++) {
      if(r[i].selected) {
        if($(r[i]).attr("value")) {
          r = r[i].innerText;
        } else {
          r = '';
        }
        break;
      }
    }
    var id1=$("select[name='main'][disabled!='true']").get(0);
    if(id1)
    for(i=0; i<id1.length; i++) {
      if(id1[i].selected) {
        if($(id1[i]).attr("value")) {
          id1 = id1[i].innerText;
        } else {
          id1 = '';
        }
        break;
      }
    }
    var path = $("select[name='m_layout']").attr("title");
    if(r) {
      path += "?r="+r;
      if(id1) { 
        path += "&id1="+id1;
        path += "&id2="+$("input[name='m_id']").val();
      } else {
        path += "&id1="+$("input[name='m_id']").val();
      }
    }
    else {
      path += "?r="+$("input[name='m_id']").val();
    }
    path += "&preview_layout="+$("select[name='m_layout']").val();
    $("iframe[name='preview']").attr("src", encodeURI(path));
  }
  // 최상위 메뉴 변경시 메인메뉴 리셋
  $("select[name='root']").change(function(){
    $("select.main").each(function(){
      $(this).css('display','none');
      $(this).attr('disabled', 'true');
    });
    $("#root_"+$(this).val()).each(function(){
      $(this).css('display','');
      $(this).removeAttr('disabled');
    });
  });
  // 추가/수정시 레이아웃 선택했을때 미리보기 업데이트
  $("select[name='m_layout']").change(function(){
    preview();
  });
  // 페이지이동 체크박스
  $("#redirect").click(function(){
    if($(this).attr("checked")) {
      $("input[name='m_redirection']").val($(this).val());
    } else {
      $("input[name='m_redirection']").val("");
    }
  });
  $(function(){
    preview();
  });
</script>

