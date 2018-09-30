<?php 
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
$page = $_POST['page'];
$page = 1;
$loadMore = new DatabaseBlog;
echo $loadMore->loadMoreTopic($page);


?>
