<?php if(!defined('__MAGIC__')) exit; 
$list = $this->Sql('list');
?>
<form method="post" action="<?php echo $this->Link('insert')?>">
<table class="table_admin">
  <colgroup>
    <col width="50px">
    <col>
    <col width="100px">
    <col width="80px">
  </colgroup>
  <thead>
    <tr>
      <th>번호</th>
      <th>게시판 이름</th>
      <th>게시글삭제</th>
      <th>관리</th>
    </tr>
  </thead>
<tbody>
  <tr class="add">
    <th>추가</th>
    <th class="left" colspan="2"><input type="text" size="50" name="bo_subject" value=""/></th>
    <th><input type="image" src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_insert.gif')?>" alt="게시판추가"/></th>
  </tr>
<?php foreach($list as $k=>$v) {?>
  <tr>
    <td class="center"><div class="rline"><?php echo $v['bo_no']?></div></td>
    <td><div class="rline"><?php echo $v['bo_subject']?></div></td>
    <td class="center"><div class="rline">
      <span><?php echo $v['cnt']?>개&nbsp;</span>
      <a href="<?php echo $this->Link('delete_contents', $v['bo_no'])?>" onclick="return DelContents()"><img src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_delete_contents_icon.gif')?>" alt="게시글삭제"/></a>
    </div></td>
    <td class="center"><div class="rline_last">
      <a href="<?php echo $this->Link('modify', $v['bo_no'])?>" onclick="Go(this.href)"><img src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_modify_icon.gif')?>" alt="수정"/></a>
      <a href="<?php echo $this->Link('delete', $v['bo_no'])?>" onclick="return DelBoard();"><img src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_delete_icon.gif')?>" alt="삭제"/></a>
    </div></td>
  </tr>
<?php }?>
</tbody>

</table>
</form>

<script>
function DelBoard() {
	if(confirm("게시판을 정말 삭제하시겠습니까?\n삭제한 게시판은 복구할 수 없습니다.")) return true;
	return false;
}

function DelContents() {
	if(confirm("게시글을 모두 삭제하시겠습니까?\n게시글의 모든 파일과 내용은 삭제됩니다.\n삭제한 게시글은 복구할 수 없습니다.")) return true;
	return false;
}
</script>
