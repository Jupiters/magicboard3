<?php if(!defined('__MAGIC__')) exit;

$search = new Search();
$search->Size(30);

?>
<!-- 로고 -->
<a href="<?php echo $this->Link('list_inbox')?>"><img class="flt_l" src="<?php echo $this->path_img('msg_title.jpg')?>" alt="title"/></a>

<!-- 쪽지 검색 -->
<div class="flt_l" style="margin:34px 0 0 5px">
<?php echo $search->Html('쪽지 검색', '취소', '검색어를 입력하세요')?>
</div>

<div class="clr_b"></div>