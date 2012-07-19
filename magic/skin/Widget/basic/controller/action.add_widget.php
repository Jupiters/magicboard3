<?php if(!defined("__MAGIC__")) exit; 

// 삽입된 위젯 번호
$key = $att[1];

/*
 * 위젯호출 부분의 데이터를 변경함
 * 삽입된 위젯번호를 부여함
 */
$params = $this->Config('add_widget');
$wg_table = GV::String($params['table']);
$wg_key = GV::Number($params['key']);
$wg_key_name = GV::String($params['key_name']);
$wg_field = GV::String($params['field']);
$wg_pos = GV::Number($params['pos']);

// 기존 데이터 불러오기
$content = array_pop(DB::Get()->sql_fetch("
	SELECT {$wg_field}
	FROM {$wg_table}
	WHERE {$wg_key_name}='{$wg_key}'
"));

// 패턴을 이용하여 [[Widget]]구문을 분리함
$pattern = "/(\[\[Widget)([^\]]*)(\]\])/";
$split = preg_split($pattern, $content);
preg_match_all($pattern, $content, $match, PREG_PATTERN_ORDER);

/*
 * 분리된 컨텐츠들을 합침
 * 합치면서 삽입된 위젯 번호를 추가해줌
 */
$result = '';
for($i=0; $i<count($match[0]); $i++) {
	$result.= $split[$i];
	if($i==$wg_pos) {
		$result.='[[Widget|'.$key.']]';
	} else {
		$result.=$match[0][$i];
	}
}
$result.=$split[$i]; // 마지막으로 남은 contents

// 데이터 업데이트
DB::Get()->sql_query("
	UPDATE {$wg_table}
	SET {$wg_field}='{$result}'
	WHERE {$wg_key_name}='{$wg_key}'
	LIMIT 1
");


