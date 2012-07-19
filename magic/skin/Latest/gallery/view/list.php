<?php if(!defined('__MAGIC__')) exit; 
$list = $this->Sql('list');
File::Inst()->Protection();
?>
<style type="text/css">
<!--
#slidebox{position:relative; border:1px solid #ccc}
#slidebox, #slidebox .content{width:149px;}
#slidebox, #slidebox .container, #slidebox .content{height:150px;}
#slidebox{overflow:hidden;}
#slidebox .container{position:relative; left:0;}
#slidebox .content{background:#eee; float:left;}
#slidebox .content div{padding:15px 28px; height:100%; font-family:Verdana, Geneva, sans-serif; font-size:13px;}
#slidebox .next, #slidebox .previous{position:absolute; z-index:2; display:block; width:16px; height:27px;}
#slidebox .next{right:0; margin-right:10px; background:url(<?php echo Path::img('slidebox_next.png')?>) no-repeat left top;}
#slidebox .next:hover{background:url(<?php echo Path::img('slidebox_next_hover.png')?>) no-repeat left top;}
#slidebox .previous{margin-left:10px; background:url(<?php echo Path::img('slidebox_previous.png')?>) no-repeat left top;}
#slidebox .previous:hover{background:url(<?php echo Path::img('slidebox_previous_hover.png')?>) no-repeat left top;}
#slidebox .thumbs{position:absolute; z-index:2; bottom:10px; right:10px;}
#slidebox .thumbs .thumb{display:block; margin-left:5px; float:left; font-family:맑은 고딕; font-size:11px; font-weight:bold; text-decoration:none; padding:1px 5px; background:url(<?php echo Path::img('slidebox_thumb.png')?>); color:#fff;}
#slidebox .thumbs .thumb:hover{background:#fff; color:#614aea;}
#slidebox .selected_thumb{background:#fff; color:#614aea; display:block; margin-left:5px; float:left; font-family:맑은 고딕; font-size:11px; font-weight:bold; text-decoration:none; padding:1px 5px; }
-->
</style>
<script type="text/javascript">
$(document).ready(function() {
	var autoPlayTime=5000;
	autoPlayTimer = setInterval( autoPlay, autoPlayTime);
	function autoPlay(){
		Slidebox('next');
	}
	$('#slidebox .next').click(function () {
		Slidebox('next','stop');
	});
	$('#slidebox .previous').click(function () {
		Slidebox('previous','stop');
	});
	var yPosition=($('#slidebox').height()-$('#slidebox .next').height())/2;
	$('#slidebox .next').css('top',yPosition);
	$('#slidebox .previous').css('top',yPosition);
	$('#slidebox .thumbs a:first-child').removeClass('thumb').addClass('selected_thumb');
	$("#slidebox .content").each(function(i){
		slideboxTotalContent=i*$('#slidebox').width();	
		$('#slidebox .container').css("width",slideboxTotalContent+$('#slidebox').width());
	});
});

function Slidebox(slideTo,autoPlay){
    var animSpeed=200; //animation speed
    var easeType='easeInOutExpo'; //easing type
	var sliderWidth=$('#slidebox').width();
	var leftPosition=$('#slidebox .container').css("left").replace("px", "");
	if( !$("#slidebox .container").is(":animated")){
		if(slideTo=='next'){ //next
			if(autoPlay=='stop'){
				clearInterval(autoPlayTimer);
			}
			if(leftPosition==-slideboxTotalContent){
				$('#slidebox .container').animate({left: 0}, animSpeed, easeType); //reset
				$('#slidebox .thumbs a:first-child').removeClass('thumb').addClass('selected_thumb');
				$('#slidebox .thumbs a:last-child').removeClass('selected_thumb').addClass('thumb');
			} else {
				$('#slidebox .container').animate({left: '-='+sliderWidth}, animSpeed, easeType); //next
				$('#slidebox .thumbs .selected_thumb').next().removeClass('thumb').addClass('selected_thumb');
				$('#slidebox .thumbs .selected_thumb').prev().removeClass('selected_thumb').addClass('thumb');
			}
		} else if(slideTo=='previous'){ //previous
			if(autoPlay=='stop'){
				clearInterval(autoPlayTimer);
			}
			if(leftPosition=='0'){
				$('#slidebox .container').animate({left: '-'+slideboxTotalContent}, animSpeed, easeType); //reset
				$('#slidebox .thumbs a:last-child').removeClass('thumb').addClass('selected_thumb');
				$('#slidebox .thumbs a:first-child').removeClass('selected_thumb').addClass('thumb');
			} else {
				$('#slidebox .container').animate({left: '+='+sliderWidth}, animSpeed, easeType); //previous
				$('#slidebox .thumbs .selected_thumb').prev().removeClass('thumb').addClass('selected_thumb');
				$('#slidebox .thumbs .selected_thumb').next().removeClass('selected_thumb').addClass('thumb');
			}
		} else {
			var slide2=(slideTo-1)*sliderWidth;
			if(leftPosition!=-slide2){
				clearInterval(autoPlayTimer);
				$('#slidebox .container').animate({left: -slide2}, animSpeed, easeType); //go to number
				$('#slidebox .thumbs .selected_thumb').removeClass('selected_thumb').addClass('thumb');
				var selThumb=$('#slidebox .thumbs a').eq((slideTo-1));
				selThumb.removeClass('thumb').addClass('selected_thumb');
			}
		}
	}
}
</script>

<table class="basic_table" border="1" cellspacing="0" summary="최근게시글" style="margin-top:10px">
<caption>최근게시글</caption>
<thead>
<tr>
<th><a href="<?php echo $this->Config('bo_location')?>"><?php echo $this->Config('bo_subject')?></a></th>
</tr>
</thead>
</table>
<div id="slidebox">
<div class="next"></div>
<div class="previous"></div>
<div class="thumbs">
<?php foreach ($list as $k => $v) {?>
<a href="#" onClick="Slidebox('<?php echo $k+1?>');return false" class="thumb"><?php echo $k+1?></a>
<?php }?>
</div>
<div class="container">
<?php foreach ($list as $k => $v) {?>
<div class="content" style="background-image:url('<?php echo File::Inst()->Link('thumb', $v['file_no'], 149, 150)?>')">
<div><?php echo $v['wr_subject']?></div>
</div>
<?php }?>
</div>
</div>
