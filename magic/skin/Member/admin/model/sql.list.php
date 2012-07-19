<?php if(!defined("__MAGIC__")) exit; 

$tbn = $this->TBN();
$rows = $this->Config('rows');
$page = Paging::Inst()->CurrentPage();

$sql = "
	SELECT *
	FROM {$tbn}
	WHERE mb_passwd<>''
";
$sql.= Search::Inst()->Sql(array('mb_nick','mb_id'));

$sql.= "
	ORDER BY mb_datetime desc
";

$limit = '0,'.$rows;
if($page!='') $limit = ((intval($page)-1)*intval($rows)).','.intval($rows);
$sql.="
	LIMIT {$limit}
";

$sql_result = DB::Get()->sql_query_list($sql);
