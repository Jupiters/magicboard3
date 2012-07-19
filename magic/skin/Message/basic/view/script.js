

function explode(delimiter, string, limit)
{
	// http://kevin.vanzonneveld.net
	// +     original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +     improved by: kenneth
	// +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +     improved by: d3x
	// +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// *     example 1: explode(' ', 'Kevin van Zonneveld');
	// *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
	// *     example 2: explode('=', 'a=bc=d', 2);
	// *     returns 2: ['a', 'bc=d']

	var emptyArray = { 0: '' };

	// third argument is not required
	if ( arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined' ) { return null; }
	if ( delimiter === '' || delimiter === false || delimiter === null ) { return false; }
	if ( typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object' ) { return emptyArray; }
	if ( delimiter === true ) { delimiter = '1'; }

	if (!limit) {
		return string.toString().split(delimiter.toString());
	} else {
		// support for limit argument
		var splitted = string.toString().split(delimiter.toString());
		var partA = splitted.splice(0, limit - 1);
		var partB = splitted.join(delimiter.toString());
		partA.push(partB);
		return partA;
	}
}


function successSave(result)
{
	// alert(result);
	var message = document.getElementById('message');
	var message_text = document.getElementById('message_text');
	var success = explode(':', result)[0];
	var ret_msg = explode('<', explode(':', result)[1])[0];

	if(success=='true')
	{
		message_text.innerHTML = '&gt; 임시저장이 완료 되었습니다.';
		message.className = 'success';
		document.getElementById('wr_no').value = ret_msg;
		document.getElementById('write_form').action = link_update;
		self.close();
	}
	else
	{
		message_text.innerHTML = ret_msg;
		message.className = 'failure';
	}
	var loading = document.getElementById('loading');
	loading.style.display = "none";
}

function save(form, url)
{
	if(!gmail.kevinpark1981.ajax) alert('ajax 개체가 없습니다. "Ajax/ajax.js" 가 필요합니다. ');

	var loading = document.getElementById('loading');
	loading.style.display = "block";
	var message = document.getElementById('message_text');
	message.innerHTML = '&gt; 임시저장 중입니다.';

	// cheditor가 동작하기 위해서
	// cheditor를 사용하지 않는 게시판을 위해 예외처리
	try { myeditor.outputBodyHTML(); } catch (err) {}

	var ajax = gmail.kevinpark1981.ajax;
    var header = Array(["Content-Type", "application/x-www-form-urlencoded; charaset=utf-8"]);
    ajax.getText('POST', url, function(result){successSave(result)}, form, header);
}

function del_write(url)
{
	if(confirm('삭제된 쪽지는 복구할수 없습니다.\n삭제 하시겠습니까?')) { location.href = url; }
}

function popup_select(url)
{
	window.open(url, "popup", "scrollbars = yes, status = 1, height=350, width=150, resizeable = 0");
}

function set_receiver(no, id, nick)
{
	var obj = document.getElementById('mb_receivers');
	var receiver = nick + '(' + no + ')';
	if(obj.value != '') receiver = ', ' + receiver;
	obj.value += receiver;
}

function toggleSet(obj)
{
	elements = document.getElementsByName('check[]');
	for(i=0; i<elements.length; i++) elements.item(i).checked = obj.checked;
}

function ShowWrSubject()
{
	document.getElementById('show_wr_subject').style.display = 'none';
	document.getElementById('wr_subject').style.display = 'block';
}

function goArchive(url)
{
	if(confirm("선택한 메시지를 보관함으로 이동하시겠습니까?"))
	{
		form = document.getElementById('msg_list_form');
		form.action = url;
		form.submit();
	}
}

function FindForm(obj) {
	if(!obj) return false;
	if(obj.nodeName == 'FORM') return obj;
	return FindForm(obj.parentElement);
}