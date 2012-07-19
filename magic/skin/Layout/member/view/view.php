<?php if(!defined('__MAGIC__')) exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php echo $this->head?></head>
<body>
  <div id="logo"><a href="<?php echo Path::Root()?>"><img src="<?php echo $this->path_img('logo.jpg')?>"></a></div>
  <div id="container">
    <?php echo $this->contents?>
  </div><!-- #container -->
  <div id="footer">Copyright (c) Since 2009-2012. All rights reserved by <a href="http://www.webmona.com/">Webmona.</a></div>
</body>
</html>
