<?php if(!defined('__MAGIC__')) exit;
$v = $this->view;
if(!$v) {
	$v = Widget::Inst()->Action(
		'data_explode',
		$this->wg_no
	);
	// 컬럼 데이터를 사용하기 쉽게 분리
	if($v['columns']) {
		$columns = explode('|', $v['columns']);
		$v['columns'] = array();
		foreach ($columns as $k => $vv) {
			$v['columns'][$vv] = 1;
		}
	}
}
if($v['bo_no']) {
  echo Write::Inst($v['skin'], $v['bo_no']			///< 스킨, 게시판 번호
    )->SetConfig('img_width', '', $v['img_width']	///< 게시글 이미지 너비
    )->SetConfig('rows', '', $v['rows']				///< 목록 출력 개수
    )->SetConfig('columns', '', $v['columns']		///< 컬럼 출력 옵션
    )->SetConfig('list_view', '', $v['list_view']	///< 뷰페이지 목록보기
    )->SetConfig('use_comment', '', $v['use_comment']///< 댓글 사용
    )->SetConfig('show_notice', '', $v['show_notice']///< 공지보이기
    )->html(
  );
}
