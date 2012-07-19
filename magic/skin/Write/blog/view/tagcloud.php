<?php if(!defined('__MAGIC__')) exit; 
$breadcrumb = PageElement::Inst('breadcrumb')->html();
// 태그
$tags = Tag::Inst('basic', $this->bo_no)->SetConfig('hide_count','',0)->html();
?>

<!--Start Container 5-->
<div id="container_5">
<!--Start Blogs Container-->
<div id="blogs_container">
<!--Start Blogs Container Blogs Container Top-->
<div id="blogs_container_top">
<!--Start Blogs Container Blogs Container Bottom-->
<div id="blogs_container_bottom">

<div style="float:right;margin-right:20px"><?php include $this->path_view('buttons.php');?></div>

<!--Start Breadcrumb-->
<?php echo $breadcrumb?>
<!--End Breadcrumb-->

<!--Start Blog Content-->
<div id="blog_content">

<div class="tag_cloud" style="margin-left:55px;margin-bottom:10px">
  <h1 style="margin-bottom:10px">태그구름</h1>
  <p style="margin-bottom:20px">사용된 모든 태그들을 보여줍니다.</p>
  <div><?php echo $tags?></div>
  <div><a class="button" href="<?php echo Url::Get('',array($this->Config('mode','name'),'ca1','ca2','tag','wr_no'))?>">목록으로 가기</a></div>
</div>

</div><!--End Blog Content-->

<?php include $this->path_view('side.php')?>

</div><!--End Blogs Container Bottom-->
</div><!--End Blogs Container Top-->
</div><!--End Blogs Container-->
</div><!--End Container 5-->

