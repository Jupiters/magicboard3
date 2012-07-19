<?php if(!defined('__MAGIC__')) exit; 
$link  = htmlspecialchars_decode($this->Link('list'));
?>

<script>
$.mobile.changePage("<?php echo $link?>");
</script>


