<?php if(!defined('__MAGIC__')) exit;
$head = PageElement::Inst('head')->html();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php echo $head?></head>
<body>

<div id="top">
<h1><img src="<?php echo $this->path_img('logo.png')?>" title="<?php echo $title?>"></h1>
</div><!-- #top -->

<div id="tabs" class="ui-form">
	<ul>
		<li><a href="#tab-1">설치결과</a></li>
	</ul>
	<div id="tab-1">
		<p class="warn">매직보드를 설치를 완료하였습니다.</p>
		<div class="tip"><?php foreach ($this->msg as $v) {?><p><?php echo $v?></p><?php }?></div>
		<div class="buttonset right">
		<input type="button" class="button hover next" value="홈으로 이동" onclick="location.href='<?php echo Path::root()?>';"/>
		</div>
	</div>
</div><!-- #tabs -->
<div id="footer">
<address>Copyright (c) Since 2009-2012. All rights reserved by <a class="popup" href="http://www.webmona.com/">Webmona.</a></address>
</div>
</body>
</html>
