<?php 
$page = $_POST['page'];

require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
$r = new DatabaseBlog;

$data = $r->loadMoreStatus($page + 1);

echo $data;

 ?>