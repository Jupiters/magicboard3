<?php
class Debug 
{
	public static function GetLog($start=1, $level=2) {
		$trace = debug_backtrace();
		$trace = array_slice($trace, $start,$level);
		return $trace;
	}

	public static function Short($level=1) {
		$log = self::GetLog(4, $level);
		$msg = array();
		foreach($log as $v) {
			$msg[] = $v['class'].'::'.$v['function'].'('.$v['line'].')';
		}
		return $msg;
	}
}
