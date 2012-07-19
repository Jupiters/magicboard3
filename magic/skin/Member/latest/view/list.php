<?php if(!defined('__MAGIC__')) exit;
?>

<table class="table_latest">
<colgroup>
  <col width="200px">
  <col width="200px">
  <col width="120px">
  <col width="120px">
  <col width="200px">
  <col/>
</colgroup>

<thead>
  <tr>
    <th class="first">아이디</th>
    <th>별명</th>
    <th>등급</th>
    <th>레벨</th>
    <th>가입일</th>
    <th class="last">메모</th>
  </tr>
</thead>

<tbody>
<?php foreach($this->list as $v) {?>
  <tr>
    <td class="center first"><?php echo $v['mb_id']?></td>
    <td class="center"><?php echo $v['mb_nick']?></td>
    <td class="center"><?php echo Member::Inst()->Config('grade',$v['mb_grade'])?></td>
    <td class="center"><?php echo $v['mb_level']?></td>
    <td class="center"><?php echo $v['mb_datetime']?></td>
    <td class="center last"><?php echo $v['mb_memo']?></td>
  </tr>
<?php }?>
</tbody>
</table>


