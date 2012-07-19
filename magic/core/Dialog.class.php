<?php
class Dialog
{
	private static $debug = false;
	private static $replace = false;
	private static $close = false;
	private static $level = 1;
	
	private static $header = array(
		"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\"> \n"
	);
	
	private static $head = array(
		"<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"> \n"
	);
	
	private static function html($script) {
		$html='';
		foreach (self::$header as $v) {
			$html.= $v;
		}
		$html.= "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"ko\">\n";
		$html.= "<head>\n";
		foreach (self::$head as $v) {
			$html.= $v;
		}
		$html.= "<script type=\"text/javascript\">\n//<![CDATA[\n";
		$html.= $script;
		$html.= "\n//]]>\n</script>\n";
		$html.= "</head>\n";
		$html.= "<body>\n";
		$html.= "</body>\n";
		$html.= "</html>\n";
		return $html;
	}
	
	private static function GetJsAlert($msg) {
		return "alert(\"{$msg}\"); \n";
	}
	
	private static function GetJsGo($url='') {
		if (!$url) {
			return "history.go(-1);\n";
		} else {
			$url=htmlspecialchars_decode($url);
			if (self::$replace) return "location.replace('{$url}');\n";
			else return "location.href = '{$url}';\n";
		}
	}
	
	private static function GetJsClose() {
		return "self.close();\n";
	}
	
	// 개행할때에 \n으로 개행 가능하게 하기 - 2008-08-17
	// 참고링크 : http://www.usenet-forums.com/php-general/52236-php-function-prepare-text-javascript-alert-box.html
	private static function checkMsg($msg) {
		if (self::$debug)
		{
			$dbg_msg='';
			foreach (Debug::Short(self::$level) as $v) {
				$dbg_msg.=$v."\n";
			}
			$msg = $dbg_msg."\n".$msg;
		}
		$msg = preg_replace('/(\r\n|\r|\n)/', '\n', addslashes($msg));
		return $msg;
	}
	
	// 경고메세지를 경고창으로
	public static function Alert($msg, $url='') {
		$msg = self::checkMsg($msg);
		echo self::html(
			self::GetJsAlert($msg).
			(self::$close==true?self::GetJsClose():self::GetJsGo($url))
		);
		exit;
	}
	
	public static function AlertDbg($msg, $url='') {
		self::$debug = true;
		self::Alert($msg, $url);
	}
	
	public static function alertNReplace($msg, $url='') {
		self::$replace = true;
		self::Alert($msg, $url);
	}

	public static function alertGoHome($msg) {
		self::Alert($msg, Path::Group());
	}
	
	public static function alertNClose($msg) {
		self::$close = true;
		self::Alert($msg, '');
	}	
}

