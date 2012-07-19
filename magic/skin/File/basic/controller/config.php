<?php if(!defined("__MAGIC__")) exit; 

$cfg = array();

$cfg['mode']['name']		= 'fileMode';
$cfg['mode']['list']		= 'list';
$cfg['mode']['insert']		= 'insert';
$cfg['mode']['write']		= 'write';
$cfg['mode']['delete']		= 'delete';

$cfg['max_upload'] = 2;

$cfg['form_name']['file'] = 'upload_file';
$cfg['form_name']['del'] = 'delete_file';

// 업로드될 파일 경로
// 마지막에 / 붙여주어야함
$cfg['upload_path'] = '/magic/data/file/';

