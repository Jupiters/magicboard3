<?php if(!defined('__MAGIC__')) exit; 

$table = $this->Table();
$key_name = $table['pri_key'];
$key = GV::Number($key_name);
if($key) { $v = $this->FetchByKey($key); }
$skinlist = Editor::Inst('basic')->SkinList();
?>
<form method="post" action="<?php echo $this->Link('update')?>">
<input type="hidden" name="bo_no" value="<?php echo $v['bo_no']?>"/>

<table class="table_admin2">
  <colgroup>
    <col width="170px">
    <col>
  </colgroup>
  <thead class="type2">
    <tr><th colspan="2">기본설정</th></tr>
  </thead>
  <tbody>
  <tr>
    <th>게시판 이름</th>
    <td><input type="text" size="50" name="bo_subject" value="<?php echo $v['bo_subject']?>"/></td>
  </tr>
  <tr>
    <th>에디터 선택</th>
    <td>
    <select name="bo_editor">
<?php foreach ($skinlist as $vv) {?>
    <option value="<?php echo $vv['skin']?>" <?php echo $v['bo_editor']==$vv['skin']?'selected':''?>><?php echo $vv['name']?></option>
<?php }?>
    </select>
    - 에디터는 /editor/ 폴더안에 있는 에디터의 종류별로 선택 가능하다.
    </td>
  </tr>
  </tbody>
</table>

<table class="table_admin2">
  <colgroup>
    <col width="170px">
    <col>
  </colgroup>
  <thead class="type3">
    <tr><th colspan="2">출력옵션</th></tr>
  </thead>
  <tbody>
  <tr>
    <th>비밀글 사용</th>
    <td>
      <input type="checkbox" name="bo_use_secret" <?php echo $v['bo_use_secret']?'checked':''?> value="1"/>
      - 비밀 게시글을 작성할 수 있다.
    </td>
  </tr>
  <tr>
    <th>링크 사용</th>
    <td>
      <input type="checkbox" name="bo_use_link" <?php echo $v['bo_use_link']?'checked':''?> value="1"/>
      - 체크 시 게시글에서 링크를 사용하도록 할 수 있다.
    </td>
  </tr>
  </tbody>
</table>

<table class="table_admin2">
  <colgroup>
    <col width="170px">
    <col>
  </colgroup>
  <thead class="type3">
    <tr><th colspan="2">권한설정</th></tr>
  </thead>
  <tbody>
  <tr>
    <th>목록보기 레벨</th>
    <td>
    <input type="text" size="5" name="bo_level_list" value="<?php echo $v['bo_level_list']?>"/>
    - 해당 레벨 이상이면 목록을 볼수 있다.
    </td>
  </tr>
  <tr>
    <th>글보기 레벨</th>
    <td>
    <input type="text" size="5" name="bo_level_view" value="<?php echo $v['bo_level_view']?>"/>
    - 해당 레벨 이상이면 게시글을 볼수 있다.
    </td>
  </tr>
  <tr>
    <th>글쓰기 레벨</th>
    <td>
    <input type="text" size="5" name="bo_level_write" value="<?php echo $v['bo_level_write']?>"/>
    - 해당 레벨 이상이면 글을 작성할 수 있다.
    </td>
  </tr>
  <tr>
    <th>글수정 레벨</th>
    <td>
    <input type="text" size="5" name="bo_level_modify" value="<?php echo $v['bo_level_modify']?>"/>
    - 해당 레벨 이상이면 글을 수정할 수 있다.
    </td>
  </tr>
  <tr>
    <th>글삭제 레벨</th>
    <td>
    <input type="text" size="5" name="bo_level_delete" value="<?php echo $v['bo_level_delete']?>"/>
    - 해당 레벨 이상이면 글을 삭제할 수 있다.
    </td>
  </tr>
  <tr>
    <th>삭제불가 댓글수</th>
    <td>
    <input type="text" size="5" name="bo_del_comment" value="<?php echo $v['bo_del_comment']?>"/>
    - 댓글이 해당 개수 이상이면 삭제할 수 없다.
    </td>
  </tr>
  <tr>
    <th>수정불가 댓글수</th>
    <td>
    <input type="text" size="5" name="bo_mod_comment" value="<?php echo $v['bo_mod_comment']?>"/>
    - 댓글이 해당 개수 이상이면 수정할 수 없다.
    </td>
  </tr>
  </tbody>
</table>

<table class="table_admin2">
  <colgroup>
    <col width="170px">
    <col>
  </colgroup>
  <thead class="type3">
    <tr><th colspan="2">분류설정</th></tr>
  </thead>
  <tbody>
  <tr>
    <th>분류 사용</th>
    <td>
      <input type="checkbox" name="bo_use_category" <?php echo $v['bo_use_category']?'checked':''?> value="1"/>
      - 체크 시 분류를 사용할 수 있다. (분류는 2단,3단.. 무한대 깊이로 분류를 설정할 수 있다.)
    </td>
  </tr>
  <tr>
    <th>분류</th>
    <td>
    <div>
      <p>- 분류선택: 방향키(up/down/left/right)</p>
      <p>- 이름변경: 더블클릭/F2 </p>
      <p>- 분류순서변경: 드래그엔드랍 (상위 하위 분류간에도 위치 변경가능하다.)</p>
      <p>- 분류삭제: DEL키</p>
    </div>
    <div id="bo_category" style="padding:10px"></div>
    <div>
      <a href="#" onclick="$('#bo_category').jstree('create','#bo_category', 'last', '새로운 분류명을 입력하세요'); return false;"><img src="<?php echo Layout::Inst('admin')->path_img('btn_category_add.gif')?>" alt="분류추가"/></a>
      <a href="#" onclick="$('#bo_category').jstree('remove'); return false;"><img src="<?php echo Layout::Inst('admin')->path_img('btn_category_delete.gif')?>" alt="분류제거"/></a>
    </div>
    <script>
    $(function () {

      function update_tree() {
        $.ajax({
            url: "<?php echo urldecode(htmlspecialchars_decode($this->Link('category_update')))?>",
            type: "POST",
            data: {bo_category:JSON.stringify($("#bo_category").jstree("get_json", [], []))}
        });
      }

      $("#bo_category").jstree({ 
        "json_data" : {
          "ajax" : {
            "url" : "<?php echo urldecode(htmlspecialchars_decode($this->Link('category_data')))?>",
            "data" : function (n) {
              return {id:n.attr ? n.attr("id") : 0};
            }
          }
        },
        "plugins" : [ "themes", "json_data", "ui", "crrm", "dnd", "hotkeys" ]
      })
      // 모든 노드 펼치기
      .bind("loaded.jstree", function(){
        $(this).jstree("open_all");
      })
      .bind("move_node.jstree", function(){
        update_tree();
      })
      .bind("remove.jstree", function(){
        update_tree();
      })
      .bind("create.jstree", function(){
        update_tree();
      })
      .bind("rename.jstree", function(){
        update_tree();
      })
      .bind("dblclick.jstree", function (e, data) {
        $("#bo_category").jstree("rename");
      });

    });
    </script>
    </td>
  </tr>
  </tbody>
</table>

<table class="table_admin2">
  <colgroup>
    <col width="170px">
    <col>
  </colgroup>
  <thead class="type3">
    <tr><th colspan="2">파일설정</th></tr>
  </thead>
  <tbody>
  <tr>
    <th>파일 사용</th>
    <td>
    <input type="checkbox" name="bo_use_file" <?php echo $v['bo_use_file']?'checked':''?> value="1"/>
    - 파일을 업로드할 수 있다.
    </td>
  </tr>
  <tr>
    <th>파일 개수</th>
    <td>
    <input type="text" size="5" name="bo_file_num" value="<?php echo $v['bo_file_num']?>"/>
    - 파일 업로드 가능한 최대 개수
    </td>
  </tr>
  <tr>
    <th>파일 목록보기 레벨</th>
    <td>
    <input type="text" size="5" name="bo_file_level_list" value="<?php echo $v['bo_file_level_list']?>"/>
    - 해당 레벨 이상일때에 파일을 볼 수 있다.
    </td>
  </tr>
  <tr>
    <th>파일 다운로드 레벨</th>
    <td>
    <input type="text" size="5" name="bo_file_level_down" value="<?php echo $v['bo_file_level_down']?>"/>
    - 해당 레벨 이상일때에 파일을 다운로드할 수 있다.
    </td>
  </tr>
  <tr>
    <th>파일 업로드 레벨</th>
    <td>
    <input type="text" size="5" name="bo_file_level_upload" value="<?php echo $v['bo_file_level_upload']?>"/>
    - 해당 레벨 이상일때에 파일을 업로드할 수 있다.
    </td>
  </tr>
  </tbody>
</table>

<table class="table_admin2">
  <colgroup>
    <col width="170px">
    <col>
  </colgroup>
  <thead class="type3">
    <tr><th colspan="2">댓글설정</th></tr>
  </thead>
  <tbody>
  <tr>
    <th>비밀댓글 사용</th>
    <td>
    <input type="checkbox" name="bo_comment_use_secret" <?php echo $v['bo_comment_use_secret']?'checked':''?> value="1"/>
    - 비밀 댓글 사용
    </td>
  </tr>
  <tr>
    <th>댓글쓰기 레벨</th>
    <td>
    <input type="text" size="5" name="bo_comment_level_write" value="<?php echo $v['bo_comment_level_write']?>"/>
    - 해당 레벨 이상일때 댓글을 작성가능하다.
    </td>
  </tr>
  <tr>
    <th>댓글삭제 레벨</th>
    <td>
    <input type="text" size="5" name="bo_comment_level_delete" value="<?php echo $v['bo_comment_level_delete']?>"/>
    - 해당 레벨 이상일때 댓글을 삭제가능하다.
    </td>
  </tr>
  </tbody>
</table>

<div class="center">
  <input class="adjust_button_line" type="image" src="<?php echo Layout::Inst('admin')->path_img('btn_modify.gif')?>" value="수정"/>
  <a href="<?php echo $this->Link('list')?>"><img src="<?php echo Layout::Inst('admin')->path_img('btn_cancel.gif')?>" alt="취소"/></a>
</div>

</form>
