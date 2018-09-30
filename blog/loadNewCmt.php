<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

 /**
 * Sử lí load Comment theo thời gian thực
 */
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');

$baiviet_id = $_POST['id_post'];
$last_id_cmt = $_POST['last_id_cmt'];

$r = new DatabaseBlog;


if($r->loadNewCmt($baiviet_id, $last_id_cmt) =='0'){
} else {
	echo $r->getLastIDComment($baiviet_id)."%cuong%".$r->loadNewCmt($baiviet_id, $last_id_cmt);
}

?>