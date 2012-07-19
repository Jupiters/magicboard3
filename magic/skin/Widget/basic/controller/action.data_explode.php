<?php if(!defined("__MAGIC__")) exit; 

/*
 * 1개의 레코드를 받아서 wg_param을 분리한다.
 * 구분자는 []로 구분되어 있고,
 * 내부 key=value 셋은 =로 구분되어 있다
 * input : key=value[]key=value[]key=value[]key=value[]key=value[]key=value
 * output : 
 * array(
 * 'key'=>'value',
 * 'key'=>'value',
 * 'key'=>'value',
 * 'key'=>'value',
 * 'key'=>'value'
 * )
 */
$wg_no = $att[1];
$recoard = $this->Sql('fetch', $wg_no);
$params = explode('[]',$recoard['wg_param']);

$result = $recoard;
foreach ($params as $v) {
	$kv = explode('=', $v);
	$result[$kv[0]] = $kv[1];
}

$result['wg_width'] = $recoard['wg_width'];
$result['wg_width_unit'] = $recoard['wg_width_unit'];

