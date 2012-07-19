<?php if(!defined('__MAGIC__')) exit; ?>
<div id="widget_header">
	<select>
<?php foreach ($this->widget_list as $k=>$v) {?>
    <?php if($k){?><optgroup LABEL="<?php echo $k?>"><?php }?>
<?php foreach ($v as $vv) {?>
      <option value="<?php echo $vv['link']?>" <?php echo $vv['selected']?>><?php echo $vv['name']?></option>
<?php }?>
    <?php if($k){?></optgroup><?php }?>
<?php }?>
	</select>
</div><!-- #widget_header -->

<div id="widget_contents">
<?php echo $this->contents?>
</div><!-- #widget_contents -->

<script type="text/javascript">
$(function(){
	// 상단 위젯 변경시 URL변경
	$("#widget_header select").change(function(){
		location.href=$(this).val();
	});
  // 위젯하단 취소버튼
  $("#widget_buttons a").click(function(){
    self.close();
  });
	// 윈도우 사이즈 변경
	window.resizeTo(633, 550);
});
</script>
