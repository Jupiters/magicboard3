<?php if(!defined('__MAGIC__')) exit;
$list = $this->Sql('group', $this->bo_no);
shuffle($list);
?>
<style>
#side_tags { margin-bottom:20px; }
#side_tags a { float:left; height:18px; padding:2px 3px; margin-right:3px; margin-bottom:2px; }

#side_tags a.tag_cnt_1,
#side_tags a.tag_cnt_2
{ color:#666 }

#side_tags a.tag_cnt_3,
#side_tags a.tag_cnt_4
{ color:#fff; font-size:14px; font-weight:bold; background-color:#acb768 }

#side_tags a.tag_cnt_5,
#side_tags a.tag_cnt_6,
#side_tags a.tag_cnt_7
{ color:#fff; font-size:14px; font-weight:bold; background-color:#788b0b }

#side_tags a.tag_cnt_8,
#side_tags a.tag_cnt_9,
#side_tags a.tag_cnt_max
{ color:#fff; font-size:16px; font-weight:bold; background-color:#4b5608 }
</style>

<div id="side_tags">
<?php foreach($list as $v) { if($v['cnt']<=$this->Config('hide_count')) continue;?>
  <a class="tag_cnt_<?php echo $v['cnt']>10?'max':$v['cnt']?>" href="<?php echo Url::Get(array('tag'=>$v['tag_name']),array('ca1','ca2','wr_no','writeMode','pg'))?>"><?php echo $v['tag_name']?></a>
<?php }?>
<br clear="all" />
</div>



