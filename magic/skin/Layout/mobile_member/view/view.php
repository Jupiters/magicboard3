<?php if(!defined('__MAGIC__')) exit;
$m = Member::Inst('mbasic');
$head = PageElement::Inst('head')->html();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php echo $head?></head>
<body>
<div data-role="page">
<div data-theme="a" data-role="header">
<h3><?php echo Config::Inst()->hp_title?></h3>
<a href="<?php echo Path::Root('?r=mobile')?>" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
<?php if(Member::Inst()->Action('is_login')) {?>
<a href="<?php echo Member::Inst('mbasic')->Link('logout')?>" data-transition="fade">Logout</a>
<?php } else {?>
<a href="<?php echo Path::Root('?r=mobile_member')?>" data-transition="fade">Login</a>
<?php }?>
</div>
<div data-role="content"><?php echo $m->html()?></div>
<div data-theme="a" data-role="footer"><h3>All rights reserved by Webmona</h3></div>
</div>
</body>
</html>
