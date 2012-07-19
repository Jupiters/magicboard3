<?php if(!defined("__MAGIC__")) exit;

$list = $this->Sql('view');
include $this->path_view('top.php');
include $this->path_view('side.php');
?>
<div id="msg_body">
<?php include $this->path_view('menu.php')?>

<div style="font-weight:bold;clear:both;border-top:1px solid #e4dfff;border-bottom:1px solid #ccc;background-color:#fff;padding:10px;color:#000">[<?php echo $list[0]['mb_nick']?>]님과의 대화 - <?php echo $list[0]['msg_subject']?>
<?php if(!$this->IsState('archive',$list[0]['msg_state'])){?>
&nbsp;<span class="subject_label">받은쪽지함&nbsp;<a href="<?php echo $this->Link('state_add', $this->Config('state', 'archive'))?>">X</a></span>
<?php }?>
<?php if($this->IsState('star',$list[0]['msg_state'])){?>
&nbsp;<span class="subject_label">별표쪽지함&nbsp;<a href="<?php echo $this->Link('state_remove', $this->Config('state', 'star'))?>">X</a></span>
<?php }?>
<?php if($this->IsState('trash',$list[0]['msg_state'])){?>
&nbsp;<span class="subject_label">휴지통&nbsp;<a href="<?php echo $this->Link('state_remove', $this->Config('state', 'trash'))?>">X</a></span>
<?php }?>
</div> 
<?php foreach($list as $k => $v) {?>
<div style="background-color:#fff" class="message <?php echo $this->IsState('sent', $v['msg_state'])?'txt_l':'txt_r'?>">
<div class="gray_c"><?php echo $this->IsState('sent', $v['msg_state'])?'':'['.$list[0]['mb_nick'].']&nbsp;'?><?php echo $v['msg_datetime']?></div>
<div><?php echo $v['html']?></div>
</div>
<?php }?>

<div style="background-color:#f3f7ef;text-align:left">
<form method="post" action="<?php echo $this->Link('insert')?>"> 
<input type="hidden" name="msg_subject" value="<?php echo $list[0]['msg_subject']?>"/>
<input type="hidden" name="receivers" value="<?php echo $list[0]['mb_id']?>"/>
<input type="hidden" name="comment" value="1"/>
<textarea style=" width:450px; margin:5px; padding:5px; border:1px solid #ccc " name="msg_content" rows="5" cols="10000"></textarea>
<input style="width:80px;height:80px" type="submit" value="답장"/>
</form>
</div>

</div><!-- #msg_body -->