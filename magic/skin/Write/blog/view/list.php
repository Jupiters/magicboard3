<?php if(!defined('__MAGIC__')) exit; 
$list = $this->Sql('list');
$breadcrumb = PageElement::Inst('breadcrumb')->html();
?>

<div id="blog_wrap">

<div style="float:right;margin-right:20px"><?php include $this->path_view('buttons.php');?></div>

<!--Start Breadcrumb-->
<?php echo $breadcrumb?>
<!--End Breadcrumb-->

<!--Start Blog Content-->
<div id="blog_content">

<script>
$(function(){
  $(".list_top h3 a").click(function(){
    $(".list_top ul.list_style_2").toggle('slow');
    return false;
  });
});
</script>

<style>
div.list_top ul li a span.cnt {font-family:Tahoma;font-weight:normal;font-size:.8em;color:#EE5A00}
</style>

<div class="list_top" style="margin-left:55px;margin-bottom:10px">
  <h3><a href="#list_style_2">목록 보기</a></h3>
  <ul class="list_style_2" style="display:none">
<?php foreach ($list as $v) {// 심플리스트
	$category = explode('|',$v['wr_category']);
?>
    <li><a href="<?php echo $v['wr_subject']['href']?>"><?php echo implode('&gt;',$category)?> : <?php echo $v['wr_subject']['text']?>&nbsp;<span class="cnt">(<?php echo $v['cmt_count']?>)</span></a></li>
<?php }?>
  </ul>
</div>

<?php foreach ($list as $v) {
	$imgs = File::Inst()->wr_no($v['wr_no'])->Action('images', 120, 120); // 썸네일 불러오기
	$category = explode('|',$v['wr_category']);
	$link_category = Url::Get(array('ca1'=>$category[0], 'ca2'=>$category[1]));
?>
<span class="blog_date"><?php echo date("n", strtotime($v['wr_datetime']))?>월<br /><?php echo date("j", strtotime($v['wr_datetime']))?>일</span>

<!--Start Blog Div-->
<div class="blog_div">

	<div class="blog_heading">
	<h3><a href="<?php echo $v['wr_subject']['href']?>"><?php echo $v['wr_subject']['text']?></a></h3>
	<p>Posted in <a href="<?php echo $link_category?>" class="category_name"><?php echo implode('-',$category)?></a> by <b><?php echo $v['wr_writer']?></b></p>
	</div><!--End Blog Heading-->

	<p class="blog_comments"><?php echo $v['cmt_count']?></p>
	<br clear="all" />

	<div class="blog_title_border">
	<p><a href="<?php echo $v['wr_subject']['href']?>"><?php // 이미지 출력 에디터로 업로드된 이미지도 출력됨 있으면 출력 없으면 출력안함
	if(sizeof($imgs)!=0) {?><img src="<?php echo $imgs[0]['link']?>" class="bloglistimg" width="<?php echo $imgs[0]['width']?>" height="<?php echo $imgs[0]['height']?>" alt="<?php echo $v['wr_subject']['text']?>"/>
	<?php }
	echo strip_tags(preg_replace("/(<br[^>]+\>)/i",'&nbsp;',$v['wr_content'])); // 내용출력
	?></a></p>
	</div><!--End Blog Title Border-->

</div><!--End Blog Div-->
<?php }?>

<!--Start Pagination-->
<?php //echo Paging::Inst('dppia_blog')->rows($this->Config('rows'))->tot($this->Sql('list_cnt'))->html()?>
<!--End Pagination-->

</div><!--End Blog Content-->

<?php //include $this->path_view('side.php')?>

</div><!-- #blog_wrap -->

