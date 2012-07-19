<?php if(!defined("__MAGIC__")) exit; 
$list = $this->Sql('list');

$t=sizeof($list);
$i=0;
foreach($list as $k=>$v) {
  $list[$k]['class']='';
  if($k%2!=0) $list[$k]['class'].= ' odd';
  if($t==++$i) $list[$k]['class'].= ' last';
  $list[$k]['link'] = $this->Link('subject', $v['wr_no'], $v['last_id']);
  $list[$k]['subject'] = ($v['wr_parent_no']!=0?'[댓글]&nbsp;':'').($v['wr_is_secret']==1?'비밀글입니다.':$v['wr_subject']);
  $list[$k]['datetime'] = Util::GetDate($v['wr_datetime']);
}

$this->list = $list;

