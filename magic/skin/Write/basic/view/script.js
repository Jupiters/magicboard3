
$(function(){

	function create_select(list, base_url, parent, show, depth) {

		var select = $("<select class='ca'></select>").change(function(){
			if($(this).val()!='') {
				location.href=$(this).val();
			}
		})
		.append($("<option value='"+base_url+"'>전체</option>"));

		if(parent) { select.attr("id", parent.data); }
		if(show) select.css("display", "");
		else select.css("display", "none");

		for(var i=0; i<list.length; i++) {
			// 다중분류는 나중에
			if(list[i].children) {
				if(list[i].data == $("input[name='ca"+depth+"']").val()) {
					create_select(list[i].children, base_url+"&ca"+depth+"="+list[i].data, list[i], true, depth+1);
				} else {
					create_select(list[i].children, base_url+"&ca"+depth+"="+list[i].data, list[i], null, depth+1);
				}
			}
			var option = $("<option value='"+base_url+"&ca"+depth+"="+list[i].data+"'>"+list[i].data+"</option>");
			if(list[i].data == $("input[name='ca"+depth+"']").val()) {
				option.attr("selected", "selected");
			}
			select.append(option);
		}
		$("#category").prepend(select);
	}

	$("input[name='bo_category']").each(function(){
		var ca = eval('('+$(this).val()+')');
		var base_url = $("input[name='base_url']").val();
    create_select(ca, base_url, null, true, 1);
	});

  $("input[name='check_toggle']").click(function(){
    var checked = $(this).attr("checked");
    $("input[name='chk[]']").each(function(){
      if(checked) $(this).attr("checked", "checked");
      else $(this).removeAttr("checked");
    });
  });

  $("a.delete_selected").click(function(){

    if($("input[name='chk[]']:checked").size()==0) {
      alert("삭제할 글을 선택하세요");
      return false;
    }

    if(confirm("삭제하면 복구할수 없습니다.\n정말로 삭제 하시겠습니까?")) {
      $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        data: $("input[name='chk[]']").serialize(),
        success: function(data){
          location.reload();
        }
      });
    }
    return false;
  });

});
