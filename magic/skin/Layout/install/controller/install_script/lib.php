<?php

/*
 * 테이블 생성
 */
function CreateTable($tbn, $inst) {
	$msg='';
	$check = $inst->CheckInstall($tbn, $inst->Table());
	if($check==='create') {
		$inst->Install($tbn, $inst->Table(), $check);
		$msg = '['.$tbn.'] 테이블을 생성하였습니다.';
	} else {
		$msg = '<span style="color:red">['.$tbn.'] 테이블이 이미 생성되어 있습니다.</span>';
	}
	return $msg;
}

/*
 * dbconfig.php 파일 생성
 */
function CreateDBConfig($prefix, $host, $user, $pass, $db) {
	$file = @fopen(Path::dbconfig(), "w");
	fwrite($file, "<?php if(!defined('__MAGIC__')) exit; \n");
	fwrite($file, "\$prefix = \"$prefix\";\n");
	fwrite($file, "\$mysql_host = \"$host\";\n");
	fwrite($file, "\$mysql_user = \"$user\";\n");
	fwrite($file, "\$mysql_password = \"$pass\";\n");
	fwrite($file, "\$mysql_db = \"$db\";\n");
	fclose($file);
	@chmod(Path::dbconfig(), 0606);
}


/*
 * 데이터 정렬
 * 2차메뉴까지 지원함
 */
function Realign($data) {
	$result = array();
	$raw_data = array_filter(explode("\n", $data));
	foreach($raw_data as $k=>$v) {
		// 최상위 루트
		if(strpos($v, '+')===false) {
			$row = explode('=',$v);
			$result[trim($row[0])] = $row;
		// 1차메뉴
		// 최상위 메뉴를 찾아라!!
		} else if(strpos($v, '++')===false) {
			$key='';
			while($k>=0) {
				if(strpos($raw_data[$k], '+')===false) {
					$key = trim(array_shift(explode('=',$raw_data[$k])));
					break;
				}
				$k--;
			}
			$_1 = explode('=',$v);
			$_1[0] = substr(trim($_1[0]),1);
			$result[$key]['children'][$_1[0]] = $_1;
		// 2차메뉴
		// 1차메뉴를 찾아라!!
		} else {
			$key1='';
			while($k>=0) {
				if(strpos($raw_data[$k], '++')===false) {
					$key1 = substr(trim(array_shift(explode('=',$raw_data[$k]))),1);
					break;
				}
				$k--;
			}
			$key2='';
			while($k>=0) {
				if(strpos($raw_data[$k], '+')===false) {
					$key2 = trim(array_shift(explode('=',$raw_data[$k])));
					break;
				}
				$k--;
			}
			$_2 = explode('=',$v);
			$_2[0] = substr(trim($_2[0]),2);
			$result[$key2]['children'][$key1]['children'][$_2[0]] = $_2;
		}
	}
	return $result;
}

/*
 * 데이터베이스에 기본 데이터 입력
 * 제귀함수
 * 입력 데이터 형식
 * [최상위][data1]
 * [최상위][data2]
 * [최상위][children][1차]][data3]
 * [최상위][children][1차]][data3]
 * [최상위][children][1차]][children][2차][data]
 * [최상위][children][1차]][children][2차][data]
 * [최상위][children][1차]][children][2차][data]
 */
function InsertDefaultData($data, $parent=0) {

	// 자식은 복사해놓기
	$children = $data['children'];
	unset($data['children']);

	// 메뉴도 복사해 놓기
	$menu = explode(':',$data[0]);
	unset($data[0]);

	// array_pop 하면서 데이터 입력
	$_key=array();
	while($_data = array_pop($data)) {
		$_key = Insert($_data,$_key);
	}

	// 최종적으로 메뉴삽입 $parent를 활용
	$clear = array(
		'm_id'=>trim($menu[0]),
		'm_layout'=>trim($menu[1]),
		'm_parent'=>$parent,
		'm_hidden'=>$menu[2]
		//'m_contents'=>'[[Widget|'.$_key[0].']]'
	);
	$clear['m_contents'] = '';
	foreach($_key as $v) {
		$clear['m_contents'].= '[[Widget|'.$v.']]';
	}
	$parent = DB::Get()->InsertEx(DB::Get()->prefix().'magic', $clear);

	// 자식이 있다면 부모아이디를 추가하면서 호출함
	if(is_array($children) && sizeof($children)) {
		foreach($children as $v) {
			InsertDefaultData($v, $parent);
		}
	}
}

/*
 * 배열로 된 데이터를 입력 받으면
 * 데이터를 하나씩 입력 한다
 * $parent는 부모메뉴의 값이다
 * 0번은 메뉴아이디 나머지는 입력해야할 값
 */
function Insert($data, $key=array()) {
	$ret=array();
	// $data의 마지막에 + 기호가 있다면 앞의 결과($key)와 합쳐서 반환함
	if(strpos($data,'+')!==false) {
		$ret[] = $key[0];
		$data = substr($data,0,-1);
	}
	$_data = explode(':', $data);
	// 타입에 맞도록 데이터 입력
	switch($_data[0]) {
		case 'widget':// 위젯 입력
			$_clear['wg_skin'] = $_data[1];
			$_clear['wg_width'] = '100';
			$_clear['wg_width_unit'] = '%';
			if($_data[1]=='page') {
				$_clear['wg_param'] = 'wr_no='.$key[0].'[]editor=cheditor[]editor_width=100%[]editor_height=500px';
			} else if($_data[1]=='write') {
				if($_data[2]=='mobile') {
					$_clear['wg_param'] = 'skin=mbasic[]img_width=500[]rows=20[]columns=wr_datetime|wr_subject|wr_writer|wr_hit[]use_comment=1[]show_notice=1[]bo_no='.$key[0];
				} else {
					$_clear['wg_param'] = 'skin=basic[]img_width=500[]rows=20[]columns=wr_datetime|wr_subject|wr_writer|wr_hit[]use_comment=1[]show_notice=1[]bo_no='.$key[0];
				}
			} else if($_data[1]=='webclip') {
				$_clear['wg_param'] = 'skin='.$_data[2];
			}
			$ret[] = DB::Get()->InsertEx(Widget::Inst()->TBN(), $_clear);
		break;
		case 'write': // 게시글 입력 파일이 있다면 파일 내용을, 없다면 받은 키 값으로 위젯호출 구문을 적어넣는다
			$_path = __DIR__.'/page/'.$_data[1];
			if(is_file($_path)) {
				$contents = addslashes(implode('',file($_path)));
			} else {
				$contents = '';
				rsort($key);
				foreach($key as $v) {
					$contents.='[[Widget|'.$v.']]';
				}
			}
			$_clear['bo_no'] = 0;
			$_clear['wr_subject'] = 'page';
			$_clear['wr_content'] = $contents;
			$ret[] = DB::Get()->InsertEx(Write::Inst()->TBN(), $_clear);
		break;
		case 'board': // 게시판 입력
			$_clear['bo_subject'] = $_data[1];
			$_clear['bo_editor'] = 'cheditor';
			$ret[] = DB::Get()->InsertEx(Board::Inst()->TBN(), $_clear);
		break;
	}
	return $ret;
}




