<?php if(!defined('__MAGIC__')) exit;
$list = $this->Sql('list');
?>

<form method="post" action="<?php echo $this->Link('insert')?>">

<table class="table_admin">
  <colgroup>
    <col width="80px"/>
    <col width="150px"/>
    <col width="220px"/>
    <col width="80px"/>
    <col width="80px"/>
    <col/>
    <col width="100px"/>
  </colgroup>
  <thead>
    <tr>
      <th>번호</th>
      <th>아이디</th>
      <th>별명</th>
      <th>등급</th>
      <th>레벨</th>
      <th>가입일</th>
      <th>비고</th>
    </tr>
  </thead>
<tbody>
<tr class="add">
	<th>추가</th>
	<th class="left"><input class="require" alt="아이디" type="text" name="mb_id" size="15"/></th>
	<th class="left"><input class="require" alt="별명" type="text" name="mb_nick" size="25"/></th>
	<th class="center">회원</th>
	<th class="center">2</th>
	<th>&nbsp;</th>
	<th class="center"><input type="image" src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_reg.gif')?>" alt="등록"/></th>
</tr>
<?php foreach($list as $k=>$v) { ?>
<tr>
	<td class="center"><div class="rline"><?php echo $v['mb_no']?></div></td>
	<td><div class="rline"><?php echo $v['mb_id']?></div></td>
	<td><div class="rline"><?php echo $v['mb_nick']?></div></td>
	<td class="center"><div class="rline"><?php echo $this->Config('grade',$v['mb_grade'])?></div></td>
	<td class="center"><div class="rline"><?php echo $v['mb_level']?></div></td>
	<td class="center"><div class="rline"><?php echo $v['mb_datetime']?></div></td>
	<td class="center"><div class="rline_last">
    <a href="<?php echo $this->Link('modify',$v['mb_no'])?>"><img src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_modify_icon.gif')?>" alt="수정"/></a>
    <a href="<?php echo $this->Link('unregist',$v['mb_no'])?>" onclick="return confirm('회원을 탈퇴 시키겠습니까?\n한번 탈퇴한 회원은 복구 할수 없습니다.\n신중히 생각해주세요.')"><img src="<?php echo Layout::Inst('admin')->path_img('btn_table_admin_delete_icon.gif')?>" alt="탈퇴"/></a>
	</div></td>
</tr>
<?php } ?> 
</tbody>
</table>
</form>

<!-- 검색 -->
<?php echo Search::Inst()->Html()?>

<div class="center">
<?php echo Paging::Inst(
	)->rows($this->Config('rows')
	)->tot($this->Sql('list_cnt')
	)->html(
)?>
</div>
