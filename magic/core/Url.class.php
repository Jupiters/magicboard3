<?php
/*
--------------------------------------------------------------------------------------
  writer : Kevin Park(박경종:똥싼너구리)
  mail : kevinpark1981~googlemail
--------------------------------------------------------------------------------------
  url class
-------------------------------------------------------------------------------------- 
*/
class Url 
{
	protected static $url_this='';
	
	/*
		현재 주소 표시줄의 값들을 연결하여 그대로 반환함
	*/
	public static function This() {
		if(!self::$url_this) {
			$path = Path::This();
			$qstr='';
			foreach($_GET as $k=>$v) $qstr.=$k.'='.urlencode($v).'&amp;';
			if($qstr=substr($qstr, 0, -5)) $path.='?';
			self::$url_this = $path.$qstr;
		}
		return self::$url_this;
	}

	public static function extractFactor($url) {
		$url = str_replace('index.php', '', $url);

		$factor = array();
		if(strpos($url, '?')!==false) {
			$factor['path'] = array_shift(explode('?', $url));
			$qstr = explode('&', array_pop(explode('?', $url)));
		} else {
			$factor['path'] = $url;
			$qstr = array();
		}

		if(substr($factor['path'], 0,1)!='/' && substr($factor['path'], 0,1)!='.')
			$factor['path'] = '/'.$factor['path'];

		$factor['qstr'] = array();
		foreach($qstr as $k => $v) {
			$q = explode('=', $v);
			$factor['qstr'][$q[0]] = $q[1];
		}
		return $factor;
	}

	/*
		설정에 따른 URL 생성 함수
		$options = 입력할 옵션
		$excepts = 제거할 옵션
		$path = 경로, 없으면 기본적으로 현재 주소
	*/
	public static function Get($options=array(), $excepts=array(), $path='', $post=false, $used_script=false) {
		if(!strrpos($path, './')) $path=Path::This($path);

		$qstr=Url::QstrEx($excepts, $options, $post);

		$amp='&amp;';
		if($used_script) $amp='&';

		$opt='';
		$created=false;
		if(is_array($options) && sizeof($options)!=0)
		{
			if($qstr!='') $opt=$amp; // qstr에 결과 값이 있고, options가 있다면? &를 붙이고 시작함 
			reset($options);
			foreach($options as $k=>$v)
			{
				if($v!='')
				{
					if($created) $opt.=$amp;
					$opt.=$k.'='.urlencode($v);
					$created=true;
				}
			}
		}
    if(strpos($path,'?')===false) {
      if($qstr!='' || $opt!='')
        $qstr='?'.$qstr;
    } else {
        $qstr='&amp;'.$qstr;
    }
		return $path.$qstr.$opt;
	}

	public static function GetJava($options=array(), $excepts=array(), $path='', $post=false) {
		return self::Get($options, $excepts, $path, $post, true);
	}


	/*
		Query String 생성 
		제외하고 싶은 목록은 가변인자로 넘겨주면 그것을 검사해 쿼리스트링을 생성함
		연관배열과 순차배열을 모두 지원하도록 변경 each를 이용함
		static 함수에서 멤버 함수로 변경 꼭 필요하면 상속해서 사용해야함
		2008-12-25 : 가변인자에 배열도 인자로 넘길수 있도록 변경
	*/
	public static function QstrEx($excepts, $options, $post) {
		$qstr = '';
		$created = false;
		reset($_GET);
		foreach($_GET as $k=>$v)
		{
			if(is_array($excepts)) { if(in_array($k, $excepts)) continue; }
			else if($excepts==$k) continue;

			if(is_array($options)) { if(array_key_exists($k, $options)) continue; }
			else if($options==$k) continue;

			if($v!='')
			{
				if($created) $qstr.='&amp;';
				$qstr .= $k.'='.urlencode($v);
				$created=true;
			}
		}

		if($post)
		{
			reset($_POST);
			foreach($_POST as $k=>$v)
			{
				if(is_array($excepts)) { if(in_array($k, $excepts)) continue; }
				else if($excepts==$k) continue;

				if(is_array($options)) { if(array_key_exists($k, $options)) continue; }
				else if($options==$k) continue;

				if($v!='')
				{
					if($created) $qstr.='&amp;';
					$qstr .= $k.'='.urlencode($v);
					$created=true;
				}
			}
		}
		return $qstr;
	}

	public static function AddQuery($path, $query) {
		if(strpos($path, '?')) return $path.'&'.$query;
		else return $path.'?'.$query;
	}


	// URL이동
	public static function Go($path='') {
		$path = str_replace('&amp;', '&', $path);
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
		echo '<script type="text/javascript">';
		echo 'location.href="'.$path.'";';
		echo '</script>';
		exit;
	}

	// URL이동
	public static function GoReplace($path='') {
		$path = str_replace('&amp;', '&', $path);
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
		echo '<script type="text/javascript">';
		echo 'location.replace("'.$path.'");';
		echo '</script>';
		exit;
	}

	// 창 닫기
	public static function SelfClose($message='') {
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
		echo '<script type="text/javascript">';
		if($message) echo "alert('{$message}');";
		echo 'self.close();';
		echo '</script>';
		exit;
	}

	public static function GoRoot() {
		self::Go(Path::Root());
	}
	
	public static function GoHome() {
		self::Go(Path::Group());
	}
	
	public static function GoThis($file='') {
		self::Go(self::This($file));
	}
	
	public static function GoPrev() {
		self::Go(self::GetPrev());
	}
	
	public static function SetPrev() {
		$_SESSION['prev_url']=self::This();
	}
	
	public static function GetPrev() {
		return $_SESSION['prev_url'];
	}

	/*
		Query String 생성 
		새로운 함수
		Query String으로 생성하고 싶은 것을,
		파라미터로 배열이나, 변수로 넘겨주면 그것을 이용해 쿼리스트링을 생성한다.
		- 참고함수 : func_get_args, func_num_args, func_get_arg(1)
	*/
	/*
	public static function Qstr( 가변인자 )
	{
		$qstr = '';
		$created = false;

		$args = func_get_args();

		for($i=0; $i<sizeof($args); $i++)
		{
			if(is_array($args[$i]))
			{
				// 연관배열도 지원
				reset($args[$i]);
				for($ii=0; $arr = each($args[$i]); $ii++)
				{
					$q_value = Page::GetParam($arr['value']);
					if($q_value!='')
					{
						if($created) $qstr.='&';
						$qstr .= "{$arr['value']}=$q_value";
						$created=true;
					}
				}

			}
			else
			{
				$q_value = Page::GetParam($args[$i]);
				if($q_value!='')
				{
					if($created) $qstr.='&';
					$qstr .= "{$args[$i]}=$q_value";
					$created=true;
				}
			}
		}
		return $qstr;
	}
	//*/

}// end of class
