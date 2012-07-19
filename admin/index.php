<?php
include_once('_path.php');

$latest = Latest::Inst('all')->Rows(20)->html();

$menu = AdminMenu::Inst();
$parent_list = $menu->ParentList();

// 버전
/*
$fd = fopen (Path::mb('HISTORY'), "r");
fgets($fd, 10240);
$version = fgets($fd, 1024); // 둘째줄
fclose($fd);
//*/

ob_start();
?>
<div id="container">

<div id="side_index">
<div class="menu">
<ul>
<?php foreach ($parent_list as $k=>$v) {?>
	<li><img src="<?php echo Path::img('icon0'.$k.'.gif')?>" width="26" height="26"><a href="<?php echo $menu->path('menu_'.$k.'.php')?>"><?php echo $v?></a>
	<ul class="ui-corner-all">
	<?php
	$child_list = $menu->ChildList($k);
	foreach ($child_list as $kk=>$vv) {
	?>
		<li><a  href="menu_<?php echo $k?>_<?php echo $kk?>.php"><?php echo $vv?></a></li>
	<?php }?>
	</ul>
	</li>
<?php }?>
</ul>
</div>

</div><!-- End side -->

<div id="content_index">
<div class="title"><h2>최근등록된글</h2></div>
<?php echo $latest?>
</div><!-- End content -->
</div><!-- container -->

<?php
$contents = ob_get_contents();
ob_end_clean();

echo Layout::Inst('admin_index'
	)->Contents(array($contents)
	)->html(
);
