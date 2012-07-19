<?php if(!defined('__MAGIC__')) exit; 

$mode_name = $this->Config('mode', 'name');
$mode = GV::String($mode_name);
$key_name = $this->Table('pri_key');
$list = $this->Sql('list');

include $this->path_view('top.php');
include $this->path_view('side.php');
?>
<form method="post" action="">
<input type="hidden" name="ret_url" value="<?php echo $this->Link('list_inbox')?>"/>
<div id="msg_body">
<?php include $this->path_view('menu.php')?>

<table id="msg_list">
<?php foreach($list as $k=>$v) { ?>
<tr class="<?php echo $v['msg_state']&$this->Config('state','read')?'read':''?>">
<td width="15"><input type="checkbox" name="check[]" value="<?php echo $v['msg_no']?>"/></td>
<td width="10" style="padding:5px 0"><img src="<?php echo $this->path_img('star_'.($this->IsState('star', $v['msg_state'])?'on':'off').'.gif')?>"/></td>
<td><a href="<?php echo $this->Link('subject', $v['msg_no'])?>"><b style="color:#000"><?php echo $v['msg_writer']?></b>&nbsp;<span style="color:#ccc;letter-spacing:-3px;font-size:8pt">&gt;&gt;&gt;</span>&nbsp;<?php echo $v['msg_content']?></a></td>
<td width="40"><?php echo Util::GetDate($v['msg_datetime'])?></td>
</tr>
<?php }?>
<?php if(sizeof($list)==0) {?><tr><td class="no_contents">쪽지가 없습니다.</td></tr><?php } else {?>
<?php for($i=0; $i<$this->Config('rows')-sizeof($list);$i++) { ?>
<tr class="blank"><td colspan="5"></td></tr>
<?php }?>
<?php }?>
</table>

<?php include $this->path_view('menu.php')?>
</div><!-- #msg_body -->
</form>
