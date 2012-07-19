<?php if(!defined("__MAGIC__")) exit; 

/*
 * 데이터베이스에 입력하기 위한 데이터로 변환함
 * wg_skin,wg_width,wg_width_unit를 제외한 모든 변수는
 * wg_param에 구조화하여 집어 넣는다.
 * 
 * input-> : 
 * array(
 * 'key'=>'value',
 * 'key'=>'value',
 * 'key'=>'value',
 * 'key'=>'value',
 * 'key'=>'value'
 * )
 * <-output
 * key=value[]key=value[]key=value[]key=value[]key=value[]key=value
 */
$data = $att[1];

$result = array();
$result['wg_skin'] = Filter::Inst()->Get('string',$data['wg_skin']);	// 위젯 종류
$result['wg_width'] = Filter::Inst()->Get('number',$data['wg_width']);// 위젯너비
$result['wg_width_unit'] = $data['wg_width_unit'];		// 위젯너비 단위

// 필드는 제거
unset($data['wg_width']);
unset($data['wg_width_unit']);
if(!$result['wg_skin']) unset($result['wg_skin']);// 스킨을 다른 스킨으로 선택하지 않았으면 제거
unset($data['wg_skin']);

// key=value로 변환
foreach ($data as $k=>$v) {
	$data[$k] = $k.'='.$v;
}

// 한줄로 정리
$result['wg_param'] = implode('[]', $data);

