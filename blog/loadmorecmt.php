<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

/**
*Hổ trợ load thêm bình luận
*/

$page = $_POST['pagecmt'];
$baiviet_id = $_POST['baiviet_id'];

require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
$r = new DatabaseBlog;
echo $r->loadMoreCmt($baiviet_id, $page);

?>	