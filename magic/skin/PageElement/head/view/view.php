<?php if(!defined('__MAGIC__')) exit;
$title = implode(' - ', $this->Config('title'));
$author = $this->Config('author');
$keywords = $this->Config('keywords');
$description = $this->Config('description');
?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8;"/>
<meta name="generator" content="magicboard">
<meta name="title" content="<?php echo $title?>">
<meta name="description" content="<?php echo $description?>">
<meta name="keywords" content="<?php echo $keywords?>">
<meta name="author" content="<?php echo $author?>">
<title><?php echo $title?></title>
<?php
foreach($this->Config('script') as $v) {
	echo $v."\n";
}
foreach($this->Config('style') as $v) {
	echo $v."\n";
}
?>
