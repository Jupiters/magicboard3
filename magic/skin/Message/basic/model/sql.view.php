<?php if(!defined("__MAGIC__")) exit; 

$msg_no = GV::Number('msg_no');
$tbn_msg = $this->TBN();
$tbn_member = Member::TBN();

$sql = "
SELECT
	msg_no,
	msg_parent
FROM {$tbn_msg}
WHERE msg_no={$msg_no}
LIMIT 1
";
$sql_result = DB::Get()->sql_fetch($sql);
if($sql_result['msg_parent']) {
	Url::Go($this->Link('view', $sql_result['msg_parent']));
}

$sql = "
SELECT
	A.*,
	B.mb_nick,
	B.mb_id
FROM `{$tbn_msg}` A 
	INNER JOIN `{$tbn_member}` B ON A.msg_with = B.mb_no
WHERE 
	(A.msg_no={$msg_no} AND A.msg_parent=0) OR
	A.msg_parent={$msg_no}
	ORDER BY A.msg_datetime
";
$sql_result = DB::Get()->sql_query_list($sql);

// 읽음으로 표시
$sql = "
UPDATE `{$tbn_msg}`
	SET msg_state=msg_state|{$this->Config('state', 'read')}
WHERE
	msg_no={$msg_no}
";
DB::Get()->sql_query($sql);

foreach ($sql_result as $k=>$v) {
	$sql_result[$k]['html'] = '';
	/*
		파일 다운로드 링크 & 이미지 뷰
		나중에 파일을 지원하게 되면 사용함
	if($v['msg_file']) {
		// 파일 타입 검사
		$file_type = substr($v['msg_file'], strrpos($v['msg_file'], '.')+1);
		$file_type = strtolower($file_type);
	
		if($file_type == 'jpg' || $file_type == 'gif' || $file_type == 'png') {
			$sql_result[$k]['html'].='<img src="'.Path::Group($v['msg_file']).'"/>';
		} else {
			$sql_result[$k]['html'].='<a href="'.$this->Link('download',$v['msg_no']).'">다운로드</a>';
		}
	}
	//*/
	$sql_result[$k]['html'].= nl2br(htmlspecialchars($v['msg_content']));
}
