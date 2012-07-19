<?php if(!defined("__MAGIC__")) exit;
$root = Magic::Inst()->Action('root_list');
foreach($root as $v) {
	if($v['m_id']=='mobile') {
		$url = $v['link'];
		if($v['m_redirection']) {
			$url = htmlspecialchars_decode($v['m_redirection']);
		}
		break;
	}
}
?>
<script>
$.mobile.changePage("<?php echo $url?>");
</script>

