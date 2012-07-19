<?php if(!defined('__MAGIC__')) exit;
$menu_main = Magic::Inst()->Action('menu_main');
$menu_sub = Magic::Inst()->Action('menu_sub'); 
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
	<div data-theme="b" data-role="header">
		<h1><?php echo Config::Inst()->hp_title?></h1>
		<a href="<?php echo $root['link']?>" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<?php if(Member::Inst()->Action('is_login')) {?>
		<a href="<?php echo Member::Inst('mbasic')->Link('logout')?>" data-transition="fade">Logout</a>
		<?php } else {?>
		<a href="<?php echo Path::Root('?r=mobile_member')?>" data-transition="fade">Login</a>
		<?php }?>
		<!-- 상단 네비게이션 -->
		<div data-role="navbar">
		<ul>
		<?php foreach($menu_main as $v) {?>
			<li><a href="<?php echo $v['link']?>" <?php echo $v['active']?'class="ui-btn-active"':''?>><?php echo $v['m_id']?></a></li>
		<?php } ?>
		</ul>
		</div>
	</div>
	<div data-role="content">
		<ul data-role="listview" data-divider-theme="b" data-inset="false">
		<?php foreach($menu_sub as $v) {?>
			<li data-theme="c"><a href="<?php echo $v['link']?>" data-transition="slide"><?php echo $v['m_id']?></a></li>
		<?php }?>
		</ul>
	</div>
	<div data-theme="b" data-role="footer">
		<div data-role="navbar">
		<ul>
		<?php foreach($menu_main as $v) {?>
			<li><a href="<?php echo $v['link']?>" <?php echo $v['active']?'class="ui-btn-active"':''?>><?php echo $v['m_id']?></a></li>
		<?php } ?>
		</ul>
		</div>
		<h3>All rights reserved by Webmona</h3>
	</div>
</div>
</body>
</html>
