<?php if(!defined('__MAGIC__')) exit; 
?>
<table class="table_latest">
<colgroup>
  <col width="130"/>
  <col/>
  <col width="80"/>
  <col width="80"/>
</colgroup>
<thead>
  <tr>
    <th class="first">게시판명</th>
    <th>제목</th>
    <th>글쓴이</th>
    <th class="last">일시</th>
  </tr>
</thead>
<tbody>
<?php if(sizeof($this->list)==0) {?>
  <tr><td colspan="4" class="no_contents">게시글이 없습니다</td></tr>
<?php }?>
<?php foreach($this->list as $k=>$v) { ?>
  <tr <?php echo $v['class']?'class="'.$v['class'].'"':''?>>
    <td class="center first"><?php echo $v['bo_subject']?></td>
    <td><a href="<?php echo $v['link']?>"><?php echo $v['subject']?></a></td>
    <td><?php echo $v['wr_writer']?></td>
    <td class="center last"><?php echo $v['datetime']?></td>
  </tr>
<?php }?>
</tbody>
</table>
