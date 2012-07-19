<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();	// 테이블명
$tbn_member = Member::TBN();	// 멤버 테이블명
$clear = GV::Clear($tbn);	// 깨끗한 결과값

/*
 * 쪽지 댓글(답장)이 아닐 시 receivers 변수에 받는사람들 목록이 있음
 * receivers 에 콤마로 분리되어 있다.
 */
if($_POST['receivers']) {
	$receivers = explode(',', $_POST['receivers']);
	$sql = "
	SELECT mb_no, mb_nick
	FROM {$tbn_member}
	WHERE 0
	";
	foreach($receivers as $k => $v) {
		$sql.=" OR mb_id='{$v}' ";
	}
	$sql_result = DB::Get()->sql_query_list($sql);
}

/*
 * 본인의 아이디는 제거
 */
if(!$sql_result) $sql_result = array();
foreach ($sql_result as $k=>$v) {
	if($v['mb_no']==Member::No()) {
		unset($sql_result[$k]);
	}
}

/*
 * 필수 입력 검사
 */
if(count($sql_result)==0) Dialog::alert('받는사람을 입력해 주세요.');
if(!$clear['msg_content']) Dialog::alert('내용을 입력해 주세요.');
/*
 * 공통 기본 정보들 자동입력
 */
$clear['msg_datetime'] = Util::GetDatetime();
$clear['msg_ip'] = "INET_ATON('".Util::GetRealIPAddr()."')";

foreach ($sql_result as $v) {
	$with = $v['mb_no']; ///< 대화상대
	$with_name = $v['mb_nick']; ///< 대화상대 이름
	$mb_no = Member::No(); ///< 로그인한 회원본인
	$mb_nick = Member::Nick(); ///< 로그인한 회원 이름
	
	// 댓글
	if($_POST['comment']) {
		/*
		 * 보낸편지함 입력
		 * ------------
		 * 글쓴이에게 메시지 입력
		 * 1:1 대화만 가능하기 때문에
		 * 여러명에게 보낼시 보낸 숫자만큼 보낸편지함으로 보낸다.
		 * 보낸 편지함은 기본적으로 읽음으로 표시함
		 */
		
		$msg_parent = GV::Number('msg_no');
		$clear['msg_parent'] = 0;
		
		
		// 대화의 갯수를 구함
		$sql = "
			SELECT count(msg_no)+1
			FROM {$tbn}
			WHERE mb_no={$mb_no} AND (msg_no={$msg_parent} OR msg_parent={$msg_parent})
		";
		$cnt = array_pop(DB::Get()->sql_fetch($sql));
		
		// 대화입력
		$clear['mb_no'] = $mb_no;
		$clear['msg_state'] = $this->State('sent')|$this->State('read');
		$clear['msg_with'] = $with;
		$clear['msg_writer'] = $with_name.'('.$cnt.')';
		$msg_no = DB::Get()->InsertEx($tbn, $clear, array('msg_ip'));
		
		// 메시지 그룹의 부모를 방금 입력한 메시지로 변경
		$sql = "
			UPDATE {$tbn} SET msg_parent={$msg_no}
			WHERE mb_no={$mb_no} AND (msg_no={$msg_parent} OR msg_parent={$msg_parent})
		";
		DB::Get()->sql_query($sql);
		
		/*
		 * 메시지 보내기
		 * ----------
		 * 받는이에게 메시지 입력
		 * 제목을 비교하여 메시지 그룹을 분류한다.
		 * 기존 그룹에 댓글 등록시 부모 메시지를 읽지 않음으로 표시한다.
		 * 기존 그룹이 삭제되었거나 첫 메시지 일 경우에 부모 메시지로 설정하여 전송함
		 */
		
		// 대화상대가 현재 대화를 가지고 있는지 파악 - 제목으로 검색
		$sql = "
		SELECT msg_no
		FROM {$tbn}
		WHERE
			mb_no={$with} AND
			msg_parent=0 AND
			msg_subject='{$clear['msg_subject']}'
		LIMIT 1
		";
		$msg_parent = 0;
		if($sql_result = DB::Get()->sql_fetch($sql)) {
			$msg_parent = array_pop($sql_result);
		}
		
		// 대화의 갯수를 구함
		$cnt=1;
		if($msg_parent) {
			$sql = "
				SELECT count(msg_no)+1
				FROM {$tbn}
				WHERE mb_no={$with} AND (msg_no={$msg_parent} OR msg_parent={$msg_parent})
			";
			$cnt = array_pop(DB::Get()->sql_fetch($sql));
		}
		
		$clear['mb_no'] = $with;
		$clear['msg_with'] = $mb_no;
		$clear['msg_state'] = 0;
		$clear['msg_writer'] = $with_name.'('.$cnt.')';
		$msg_with_no = DB::Get()->InsertEx($tbn, $clear, array('msg_ip'));
		
		// 메시지 그룹의 부모를 방금 입력한 메시지로 변경
		if($msg_parent) {
			$sql = "
				UPDATE {$tbn} SET msg_parent={$msg_with_no}
				WHERE mb_no={$with} AND (msg_no={$msg_parent} OR msg_parent={$msg_parent})
			";
			DB::Get()->sql_query($sql);
		}
		
		Url::Go($this->Link('view', $msg_no));
	} else {
		/*
		 * 원글 입력
		 * 원글 부모는 무조건 0이다
		 */
		$clear['msg_parent'] = 0;
		
		/*
		 * 보낸편지함 입력
		 * ------------
		 * 글쓴이에게 메시지 입력
		 * 1:1 대화만 가능하기 때문에
		 * 여러명에게 보낼시 보낸 숫자만큼 보낸편지함으로 보낸다.
		 * 보낸 편지함은 기본적으로 읽음으로 표시하고 보관한다.(받은쪽지함에 표시하지 않기위해)
		 */
		$clear['mb_no'] = $mb_no;
		$clear['msg_state'] = $this->State('sent')|$this->State('read')|$this->State('archive');
		$clear['msg_with'] = $with;
		$clear['msg_writer'] = $with_name.'(1)';
		$msg_no = DB::Get()->InsertEx($tbn, $clear, array('msg_ip'));
		
		/*
		 * 메시지 보내기
		 * ----------
		 * 받는이에게 메시지 입력
		 * 기존 그룹이 삭제되었거나 첫 메시지 일 경우에 부모 메시지로 설정하여 전송함
		 */
		$clear['mb_no'] = $with;
		$clear['msg_state'] = 0;
		$clear['msg_with'] = $mb_no;
		$clear['msg_writer'] = $mb_nick.'(1)';
		DB::Get()->InsertEx($tbn, $clear, array('msg_ip'));
		
		// 쪽지 입력 후 받은 쪽지함으로 이동 
		Url::Go($this->Link('list_inbox'));
	}
}
