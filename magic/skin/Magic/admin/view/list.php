<?php if(!defined('__MAGIC__')) exit;
$list = $this->list;
?>

<form method="post" action="<?php echo $this->Link('update_order')?>">
<?php foreach($list as $v) {?>
<div class="menu_group">
	<h3><a href="<?php echo $this->Link('modify', $v['m_no'], $v['m_id'])?>"><?php echo $v['m_desc']?></a></h3>
	<div class="menu_tree">
    <ul>
<?php foreach ($v['children'] as $main) { ?>
      <li><input type="hidden" name="order[]" value="<?php echo $main['m_no']?>"/>
        <a href="<?php echo $this->Link('modify', $main['m_no'])?>"><?php echo $main['m_id']?></a>
        <ul>
<?php foreach ($main['children'] as $sub) {?>
            <li><input type="hidden" name="order[]" value="<?php echo $sub['m_no']?>"/>
              <a href="<?php echo $this->Link('modify', $sub['m_no'])?>"><?php echo $sub['m_id']?></a>
            </li>
<?php }?>
        </ul>
      </li>
<?php }?>
    </ul>
	</div>
</div>
<?php }?>
</form>

<div id="add_menu">
  <a href="<?php echo $this->Link('write')?>"><img src="<?php echo $this->path_img('btn_add_menu.gif')?>" alt="메뉴추가"/></a>
</div>

<ul class="tip">
  <li>클릭하여 드래그하면 메뉴 순서가 바뀝니다.</li>
  <li>메뉴명을 클릭하면 <strong>레이아웃</strong>등의 세부적인 수정이 가능합니다.</li>
  <li>새로운 메뉴를 추가하려면 <strong>[메뉴추가]</strong>버튼을 누르세요.</li>
</ul>

<script>
	$(".menu_tree").each(function(){
		$(this).jstree({
			"crrm" : { 
				"move" : {
					"check_move" : function (m) { 
						var p = this._get_parent(m.o);
						if(!p) return false;
						p = p == -1 ? this.get_container() : p;
						if(p === m.np) return true;
						if(p[0] && m.np[0] && p[0] === m.np[0]) return true;
						return false;
					}
				}
			},
			"themes" : {
				"theme" : "classic",
				"dots" : true,
				"icons" : false
			},
			"dnd" : {
				"drop_target" : false,
				"drag_target" : false
			},
			"plugins" : [ "themes", "html_data", "crrm", "dnd" ]
		})
		// 모든 노드 펼치기
		.bind("loaded.jstree", function(){
			$(this).jstree("open_all");
		})
		// ajax를 이용해서 메뉴순서 업로드
		.bind("move_node.jstree", function() {
			var form = $("form[method='post']");
			$.ajax({
				type:'post',
				url:form.attr("action"),
				data:form.serialize()
			});
		});
	});
</script>
