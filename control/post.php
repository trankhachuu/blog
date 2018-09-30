<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

require_once(dirname(__FILE__).'/../function/CreateNewToPic.php');
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
require_once(dirname(__FILE__).'/../function/checkUser.php');
$title = "Đăng bài viết mới";
require_once(dirname(__FILE__).'/../include/head.php');

$checkQuyen = new CheckUser;
if(isset($_SESSION['status_login']) && $checkQuyen->checkRightUser($_SESSION['email']) == 1){

#Sử lí form
	$data;
	$value = array(	'tenbaiviet' => 'Tên bài viết ...',
		'hinhanhdaidien' => 'http://', 
		'noidungbaiviet' => 'Nội dung',
		'idchuyenmuc' => '', 
		'chuyenmucdang' => 'Chọn chuyên mục');
	if(isset($_POST['submit'])){
		$chuyenmuc = $_POST['chuyenmuc'];
		$tieudebaiviet = $_POST['tenbaiviet'];
		$noidungbaiviet = $_POST['noidungbaiviet'];
		$hinhanhdaidien = $_POST['hinhanhdaidien'];
		$idchuyenmuc = $_POST['chuyenmuc'];

		$getTenChuyenMuc = new DatabaseBlog;

		$chuyenmucdang = $getTenChuyenMuc->getTenChuyenMuc($idchuyenmuc);

		$data = array(	'tieudebaiviet' => $tieudebaiviet,
			'noidungbaiviet' => $noidungbaiviet, 
			'hinhdaidien' => $hinhanhdaidien,
			'chuyenmuc' => $chuyenmuc);
		$post = new CreateNewToPic;
		if($post->post($data) == 1){
			echo '<div class="container"><div class="alert alert-success">
			<strong>Yeeh!</strong> Bài viết đã được lưu lại
			</div></div>';
		} else {
			echo '<div class="container"><div class="alert alert-warning">
			<strong>Lổi!</strong> Lổi , vui lòng thử lại.
			</div></div>';
		}

		$value = array(	'tenbaiviet' => $tieudebaiviet,
			'noidungbaiviet' => $noidungbaiviet, 
			'hinhanhdaidien' => $hinhanhdaidien
		);

		$value = array(	'tenbaiviet' => $tieudebaiviet,
			'noidungbaiviet' => $noidungbaiviet, 
			'hinhanhdaidien' => $hinhanhdaidien,
			'idchuyenmuc' => $idchuyenmuc, 
			'chuyenmucdang' => $chuyenmucdang
		);
	}	
#End form
	$r = new CreateNewToPic;
	$r->form($value);

} else {
	header('LOCATION:../');
}
require_once(dirname(__FILE__).'/../include/foot.php');

?>