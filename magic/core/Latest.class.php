<?php
class Latest extends Module
{
  protected static $inst=array();
  protected $bo_no;
  
  public static function Inst($skin='basic', $bo_no='') {
    if(is_array($bo_no)) $key_name = $skin.implode('',$bo_no);
    else $key_name = $skin.$bo_no;
    if(!isset(self::$inst[$key_name])) {
      $class_name = __CLASS__;
      self::$inst[$key_name] = new $class_name($skin, $bo_no);
    }
    return self::$inst[$key_name];
  }
  
  protected function __construct($skin, $bo_no='') {
    $this->bo_no = $bo_no;
    parent::__construct(__CLASS__, $skin);
  }

  public function Rows($rows) {
    $this->SetConfig('rows','',$rows);
    return $this;
  }
  
  public function Cols($value) {
    $this->SetConfig('cols','',$value);
    return $this;
  }
}
