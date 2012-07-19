<?php if(!defined('__MAGIC__')) exit;
$list = $this->Sql('list');
?>

<table class="table_admin">
  <colgroup>
    <col width="80px">
    <col>
    <col width="200px">
    <col width="80px">
  </colgroup>
  <thead>
    <tr>
      <th>번호</th>
      <th>아이디</th>
      <th>탈퇴일</th>
      <th>비고</th>
    </tr>
  </thead>
  <tbody>
<?php if(sizeof($list)==0) {?>
  <tr><td colspan="4" class="no_contents">데이터가 없습니다</td></tr>
<?php }?>
<?php foreach($list as $k=>$v) { ?>
  <tr>
    <td class="center"><div class="rline"><?php echo $v['mb_no']?></div></td>
    <td><div class="rline"><?php echo $v['mb_id']?></td>
    <td class="center"><div class="rline"><?php echo $v['mb_leave']?></div></td>
    <td class="center">
      <a href="<?php echo $this->Link('delete',$v['mb_no'])?>" onclick="return confirm('회원정보를 완전 삭제합니다.\n복구 할수 없습니다.')"><img src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_delete.gif')?>" alt="삭제"/></a>
    </td>
  </tr>
<?php } ?> 
  </tbody>
</table>

<!-- 검색 -->
<?php echo Search::Inst()->Html()?>

<div class="center">
<?php echo Paging::Inst(
	)->rows($this->Config('rows')
	)->tot($this->Sql('list_cnt')
	)->html(
)?>
</div>
