<?php if(!defined('__MAGIC__')) exit;
$head = PageElement::Inst('head')->html();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php echo $head?></head>
<body>
<div id="top">
<h1><img src="<?php echo $this->path_img('logo.png')?>"></h1>
</div><!-- #top -->

<div id="tabs" class="ui-form">
	<ul>
		<li><a href="#tab-1">권한오류</a></li>
	</ul>
	<div id="tab-1">
		<p>설치 폴더의 권한을 확인하세요.</p>
		<div class="tip">
			<p><strong>경로:</strong> <?php echo Path::MB()?></p>
			<p><strong>권한:</strong> 707(쓰기권한)</p>
		</div>
		<p>위와같은 경로에 쓰기권한이 필요합니다.</p>
		<p class="warn"><strong>권한설정법:</strong> chmod 707 <?php echo Path::MB()?></p>
		<p>권한을 조절하셨다면 아래 재설치 버튼을 클릭하세요.</p>
		<div class="buttonset right">
		<input type="button" class="button hover next" value="재설치" onclick="location.href = '<?php echo Path::Root()?>';"/>
		</div>
	</div>
</div><!-- #tabs -->
<div id="footer">
<address>Copyright (c) Since 2009-2012. All rights reserved by <a class="popup" href="http://www.webmona.com/">Webmona.</a></address>
</div>
</body>
</html>
