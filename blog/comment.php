<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

/**
* Sử lí khi người dùng giửi bình luận
*/
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
require_once(dirname(__FILE__).'/../include/section.php');
require_once(dirname(__FILE__).'/../function/getInfoAccount.php');


#Bắt nội dung giửi lên
$baiviet_id = $_POST['post'];

$noidung = $_POST['nd_bl'];

$thanhvien_id;
if(isset($_SESSION['email'])){
	$email_tv = $_SESSION['email'];
	$getInfo = new GetInfoAccount($email_tv);
	$thanhvien_id = $getInfo->getIDThanhVien();
} else {
	echo "Thất bại";
}

$r = new DatabaseBlog;
if($r->addNewComment($noidung, $baiviet_id, $thanhvien_id) == 1){
	echo 1;
	$cmt_str = '<div class="ds-cmt">'.$r->getCommentToTopic($baiviet_id).'</div>';
	echo $cmt_str;
} else {
	echo "Thất bại";
}

 ?>