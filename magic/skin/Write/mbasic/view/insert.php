<?php if(!defined('__MAGIC__')) exit; ?>

<script>
$.mobile.changePage("<?php echo htmlspecialchars_decode($this->Link('view', $this->key))?>");
</script>
