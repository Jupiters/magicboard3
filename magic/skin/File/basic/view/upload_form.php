<?php if(!defined('__MAGIC__')) exit;
// $this->Config('show') <-- 한꺼번에 보여지는 파일 수 0 이면 최대
$max = $this->Config('max_upload') - $this->Action('count');
?>

<!-- 파일업로드 폼  -->
<?php if($max <= 0) { // 1개 이상의 파일을 업로드 가능하다면 파일입력 폼 출력  ?>
<div>모든 파일을 업로드 했습니다.</div>
<?php }?>
<?php for($i=0; $i<$max; $i++) {?>
<div style="margin-bottom:5px"><input type="file" size="65" name="<?php echo $this->Config('form_name', 'file')?>[]"/></div>
<?php }?>
