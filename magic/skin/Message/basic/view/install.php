<?php if(!defined("__MAGIC__")) exit; 
$check = $this->CheckInstall($this->TBN(), $this->Table());

if($_GET['install']=='excute') {
	$this->Install($this->TBN(), $this->Table(), $check);
	Url::Go(Url::Get('',array('install',$this->Mode('name'))));
}
?>
<div style="padding:20px;line-height:1.6">
<?php if($check=='create') {?>
쪽지 모듈이 설치되지 않았습니다.
<?php } else {?>
<p>쪽지 모듈의 버전이 달라서 변경되어야 할 부분이 있습니다.</p>
<p style="font-weight:bold">데이터베이스 자료가 망실될수 있으니 백업후 신중히 실행해 주세요</p>

<div style="margin-top:20px"><strong>추가필드</strong></div>
<ul style="list-style:none">
<?php if(count($check['add'])==0){?><li>없습니다</li><?php }?>
<?php foreach ($check['add'] as $k=>$v) {?>
<li><?php echo $k?> - <?php echo $v['type']?></li>
<?php }?>
</ul>
<div style="margin-top:20px"><strong>변경필드</strong></div>
<ul style="list-style:none">
<?php if(count($check['change'])==0){?><li>없습니다</li><?php }?>
<?php foreach ($check['change'] as $k => $v) {?>
<li><?php echo $k?> - <?php echo $v['type']?></li>
<?php }?>
</ul>
<div style="margin-top:20px"><strong>삭제필드</strong></div>
<ul style="list-style:none">
<?php if(count($check['drop'])==0){?><li>없습니다</li><?php }?>
<?php foreach ($check['drop'] as $v) {?>
<li><?php echo $v?></li>
<?php }?>
</ul>
<?php }?>

<button style="margin-top:20px;" onclick="location.href='<?php echo Url::Get(array('install'=>'excute'))?>'">설치 및 변경</button>
</div>