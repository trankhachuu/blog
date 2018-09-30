<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

require_once(dirname(__FILE__).'/../function/CreateNewToPic.php');
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
require_once(dirname(__FILE__).'/../function/checkUser.php');
$title = "Chỉnh sửa bài viết";
require_once(dirname(__FILE__).'/../include/head.php');

$checkQuyen = new CheckUser;
if(isset($_SESSION['status_login']) && $checkQuyen->checkRightUser($_SESSION['email']) == 1){

#Get dử liệu đầu vào form
	if(isset($_GET['id_post'])){
		$getInfo = new DatabaseBlog;
		$data_cu = $getInfo->getAllContentTopic($_GET['id_post']);

		$data;
		$value = array(	'tenbaiviet' => $data_cu['tieudebaiviet'],
			'hinhanhdaidien' => $data_cu['hinhanhdaidien'], 
			'noidungbaiviet' => $data_cu['noidungbaiviet'], 
			'chuyenmucdang' => $data_cu['chuyenmucdang'], 
			'idchuyenmuc' => $data_cu['idchuyenmuc']
		);
	} else {
		echo '<div class="container"><div class="alert alert-warning">
		<strong>Noo!</strong> ?id_post={POST_ID}
		</div></div>';
	}

#Sử lí form
	if(isset($_POST['submit'])){
		$chuyenmuc = $_POST['chuyenmuc'];
		$tieudebaiviet = $_POST['tenbaiviet'];
		$noidungbaiviet = $_POST['noidungbaiviet'];
		$hinhanhdaidien = $_POST['hinhanhdaidien'];

	#Đóng gói dử liệu trên form thành mảng
		$data = array(	'tieudebaiviet' => $tieudebaiviet,
			'noidungbaiviet' => $noidungbaiviet, 
			'hinhdaidien' => $hinhanhdaidien,
			'chuyenmuc' => $chuyenmuc);

	#Giửi gói array lên Class Daatabase
		$post = new CreateNewToPic;
		if($post->edit($data, $_GET['id_post']) == 1){
	#Nếu trả về  1 - Thành công
			echo '<div class="container"><div class="alert alert-success">
			<strong>Yeeh!</strong> Đã lưu lại thay đổi
			</div></div>';
		} else {
	#Trả về 0 - Thất bại
			echo '<div class="container"><div class="alert alert-warning">
			<strong>Ohh!</strong> Lổi , vui lòng thử lại.
			</div></div>';
		}


	#Set lại dử liệu mới vào form
		$getTenChuyenMuc = new DatabaseBlog;
		$value = array(	'tenbaiviet' => $tieudebaiviet,
			'noidungbaiviet' => $noidungbaiviet, 
			'hinhanhdaidien' => $hinhanhdaidien, 
			'idchuyenmuc' => $chuyenmuc,
			'chuyenmucdang' => $getTenChuyenMuc->getTenChuyenMuc($chuyenmuc)

		);
	}	

#Hiện form
	if(isset($_GET['id_post'])){
		$r = new CreateNewToPic;
		$r->form_edit($value, $_GET['id_post']);
	} else {

	}

	
} else {
	header('LOCATION:../');
}



require_once(dirname(__FILE__).'/../include/foot.php');

?>