<?php if(!defined('__MAGIC__')) exit;
// 스킨폴더/guidline_for_design.php 파일을 참고하세요
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php echo $this->head?></head>
<body>
  <div id="header">
    <?php echo $this->header?>
  </div><!-- #header -->
  <div id="menu">
    <?php echo $this->menu?>
  </div><!-- #menu -->
  <div id="container">
    <div id="contents">
      [[contents]]
    </div><!-- #contents -->
    <div id="side">
      <?php echo $this->side?>
    </div><!-- #side -->
  </div><!-- #container -->
  <div id="footer">Copyright (c) Since 2009-2012. All rights reserved by <a href="http://www.webmona.com/">Webmona.</a></div>
</body>
</html>
