<?php if(!defined("__MAGIC__")) exit; 

/*
 * 미니 네비게이션 생성
 */
$hierarachy = Magic::Inst()->Action('hierarachy');
foreach ($hierarachy as $k=>$v) {
	$hierarachy[$k] = '<a href="'.$v['link'].'">'.$v['m_id'].'</a>';
}

$this->mini_nav = implode(' &gt; ', array_reverse($hierarachy));
