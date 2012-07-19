<?php if(!defined('__MAGIC__')) exit;
$list = array();
foreach($this->Sql('list') as $v) {
	if(in_array($v['cf_id'], $this->update)) {
		$list[$v['cf_id']] = $v;
	}
}
?>
<form method="post" action="<?php echo $this->Link('update')?>">

  <table class="table_admin">
    <colgroup>
      <col width="200px">
      <col width="200px">
      <col>
    </colgroup>
<?php if($this->Config('show_title')) {?>
    <thead>
    <tr>
      <th>변수명</th>
      <th>변수값</th>
      <th>설명</th>
    </tr>
    </thead>
<?php }?>

    <tbody>
<?php foreach($list as $k=>$v) {
    if($v['cf_type']=='str') {
?>
    <tr>
      <th class="left"><?php echo $v['cf_id']?><input type="hidden" name="cf_id[]" value="<?php echo $v['cf_id']?>"/></th>
      <td><input type="text" name="cf_value[]" size="20" value="<?php echo $v['cf_value']?>"/></td>
      <td><input type="text" name="cf_desc[]" size="80" value="<?php echo $v['cf_desc']?>"/></td>
    </tr>
<?php } else if($v['cf_type']=='text') { ?>
    <tr>
      <th class="left" colspan="3"><?php echo $v['cf_id']?> - <?php echo $v['cf_desc']?>
        <input type="hidden" name="cf_id[]" value="<?php echo $v['cf_id']?>"/>
        <input type="hidden" name="cf_desc[]" value="<?php echo $v['cf_desc']?>"/>
      </th>
    </tr>
    <tr>
      <td colspan="3"><textarea style="width:100%" name="cf_value[]" cols="20000" rows="40"><?php echo $v['cf_value']?></textarea></td>
    </tr>
<?php } else if($v['cf_type']=='radio') { ?>
<?php } else if($v['cf_type']=='check') { ?>
<?}
} ?>
    </tbody>
  </table>

<ul class="tip">
  <li><strong>디자인 &amp; 프로그래밍 참고사항</strong></li>
  <li>변수사용법 : Config::Inst()-&gt;변수명 </li>
  <li>예제 : &lt;?php echo Config::Inst()-&gt;hp_title?&gt;</li>
  <li>결과 : <?php echo Config::Inst()->hp_title?> </li>
</ul>

<div class="center"><input type="image" src="<?php echo $this->btn_modify?>" alt="수정"/></div>

</form>

