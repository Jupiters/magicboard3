<?php
/*!
 *	\class		Widget
 *	\author		Kevin Park (kevinpark1981<>gmail.com)
 *	\author		Computer Science in Inje Univ.
 *	\version	1.0
 *	\date		2009.10.16
 *	\brief		위젯 클래스
 *				위젯 단위의 기능들을 스킨 형식으로 제작하여 소스 수정없이
 *				홈페이지를 변경 가능하도록 하기위한 클래스
 *	\bug 
 *	\warning 
 *	\update		2012.01.27 - 위젯 클래스 시작
 */
class Widget extends Module
{
	protected static $inst=array();	///< 모듈 인스턴스 
	protected $wg_no;				///< 위젯 번호
	
	public static function Inst($skin='basic', $wg_no=0) {
		if(!isset(self::$inst[$skin.$wg_no])) {
			$class_name = __CLASS__;
			self::$inst[$skin.$wg_no] = new $class_name($skin, $wg_no);
		}
		return self::$inst[$skin.$wg_no];
	}
	
	protected function __construct($skin='basic', $wg_no=0) {
		$this->wg_no = $wg_no;
		parent::__construct(__CLASS__, $skin);
	}
	
	/*
	 * 위젯 번호 설정
	 */
	public function wg_no($value) {
		return self::Inst($this->skin, $value);
	}
	
	/*
	 * 위젯 구문을 찾아서 위젯 스킨을 불러옴
	 * 변환된 내용을 반환하줌
	 * ----
	 * 이전에는 SpotElement에서 비슷한 역할을 하였지만
	 * 위젯을 도입하면서 SpotElement는 제거되고 위젯으로 대체됨
	 */
	public function Parse($tbn, $key_name, $key, $field, $content, $index=null) {
		
		/*
		 * 위젯호출 문법 패턴
		 * [[Widget|503]] 이런식으로 된 문자열을 파싱함
		 */
		$pattern = "/(\[\[Widget)([^\]]*)(\]\])/";
		
		/*
		 * 위젯과 위젯이 아닌 문자열을 분리
		 * 나중에 분리된 문자열과 변환된 위젯 스킨을 합하여 반환함
		 */
		$split = preg_split($pattern, $content);
		
		/*
		 * 위젯구문을 구해낸다
		 * [2]파라미터에 위젯 번호또는 빈 내용이 들어있다.
		 * 매치된 전체 문장: $match[0][$i]
		 * $match[2][$i] - 내용
		 */
		preg_match_all($pattern, $content, $match, PREG_PATTERN_ORDER);

		// 파싱 결과가 저장될 배열
		$result_parse=array();
		//$read_pos=0;
		/*
		 * 매칭된 문장의 갯수만큼 루프를 돌면서 변환함
		 * 위젯이 설정되지 않았을 경우 : 링크로 스킨 변경 팝업창을 호출 하도록 함
		 * 위젯이 이미 설정되어 있는 경우 : 위젯 스킨을 호출하여 HTML로 출력해줌
		 */
		for($i=0; $i<count($match[0]); $i++) {
			$wg_no = array_pop(explode('|',$match[2][$i]));
			//$read_pos += strlen($split[$i]);
			
			/*
			 * 위젯 번호가 ?인 경우
			 * wg_no를 get으로 받아옴
			 */
			if($wg_no=='?') $wg_no=GV::Number('wg_no');
				
			// 위젯 번호가 있을 경우
			// 위젯 번호가 있지만 삭제된 경우 패스함
			if(intval($wg_no) && Widget::Inst()->wg_no($wg_no)->Sql('fetch', $wg_no)) {
        // 페이지게시판 중첩으로 입력되었을 경우
        if($this->old!=$wg_no) {
          $this->old = $wg_no;
          $result_parse[$i] = Widget::Inst()->wg_no($wg_no)->html();
        }
			// 위젯 입력모드일 경우
			} else if(GV::String($this->Mode('name'))) {
				$result_parse[$i] = $this->html();
			// 위젯 번호가 없을 경우
			} else {
				if(Member::Inst()->Action('is_admin')) {
					$result_parse[$i] = '<a class="button popup ui-icon-plusthick" href="'
						   .$this->Link(
						   		'write',
						   		$index?$index:$i,			// 위젯 인덱스
						   		$tbn,
						   		$key_name,
						   		$key,
						   		$field
						   	)
						   .'" width="618" height="400">위젯추가</a>';
				}
			}
			//$read_pos += strlen($match[0][$i]);
		}

		
		// 변환되어 저장될 결과값
		$result = '';
		/*
		 * 파싱된 결과 값과 기존의 html을 합친다.
		 * head는 가장 마지막에 html()함수가 호출되어야 모든 스크립트/스타일들이 인크루드 되기 때문에
		 * 이렇게 시간차를 두고 호출한다.
		 */
		foreach ($result_parse as $k=>$v) {
			if(is_object($v)) {
				$v=$v->html();
			}
			$result.= $split[$k].$v;
		}
		// 마지막으로 남은 html을 합쳐줌
		$result.=$split[$i];

		
		return $result;
	}
	
}
