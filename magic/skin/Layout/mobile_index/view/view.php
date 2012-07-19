<?php if(!defined('__MAGIC__')) exit;
$menu_main = Magic::Inst()->Action('menu_main');
$list_all = Magic::Inst()->Sql('list');
$root = Magic::Inst()->Action('root');
$head = PageElement::Inst('head')->html();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php echo $head?>
</head>
<body>
<div data-role="page">
<div data-theme="a" data-role="header">
<h3><?php echo Config::Inst()->hp_title?></h3>
<a href="<?php echo $root['link']?>" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
<?php if(Member::Inst()->Action('is_login')) {?>
<a href="<?php echo Member::Inst('mbasic')->Link('logout')?>" data-transition="fade">Logout</a>
<?php } else {?>
<a href="<?php echo Path::Root('?r=mobile_member')?>" data-transition="fade">Login</a>
<?php }?>
<!-- 상단 네비게이션 -->
<div data-role="navbar" data-iconpos="left">
<ul>
<?php foreach($menu_main as $v) {?>
<li><a href="<?php echo $v['link']?>" data-theme="" data-icon="" <?php echo $v['active']?'class="ui-btn-active"':''?>><?php echo $v['m_id']?></a></li>
<?php } ?>
</ul>
</div>
</div>

<div data-role="content">
<ul data-role="listview" data-divider-theme="b" data-inset="true">
<?php foreach($menu_main as $v) {?>
<li data-role="list-divider" role="heading"><?php echo $v['m_id']?></li>

<?php foreach($list_all as $vv) {
	if($vv['m_parent']==$v['m_no']) {
	?>
<li data-theme="c"><a href="<?php echo Path::Root("?r={$root['m_id']}&id1={$v['m_id']}&id2={$vv['m_id']}")?>" data-transition="slide"><?php echo $vv['m_id']?></a></li>
<?php } } ?>

<?php } ?>
</ul>
</div>
<div data-theme="a" data-role="footer"><h3>All rights reserved by Webmona</h3></div>
</div>
</body>
</html>
