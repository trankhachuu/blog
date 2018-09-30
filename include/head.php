<?php
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */
require_once(dirname(__FILE__).'/../include/section.php');
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
require_once(dirname(__FILE__).'/../function/getInfoAccount.php');
echo 	'<!DOCTYPE html>'.
"\n" . 	'<html lang="en">' .
"\n" . 	'<head>' .
"\n" . 	'<meta charset="UTF-8">' .
"\n" . 	'<title>'. $title .'</title>' .

"\n" . 	'<link rel="stylesheet" href="../style/4.0/css/bootstrap.min.css">' .
"\n" . 	'<link rel="stylesheet" href="../style/4.0/css/style.css">' .

"\n" . 	'<script src="../style/4.0/js/jquery-3.2.1.min.js"></script>' .
"\n" . 	'<script src="../style/4.0/js/search.js"></script>' .


"\n" . 	'<meta name="viewport" content="width=device-width, initial-scale=1.0">' .
"\n" . 	'<meta name="keywords" content="blog phuongvancuong, phuongvancuong, blog cá nhân">' .
"\n" . 	'<meta name="description" content="Blog cá nhân Phương Văn Cường">' .
"\n" . 	'</head>' .
"\n" . 	'<body>';

// Tìm kiếm trên trang của tui
?>
<nav class="fixed-top navbar navbar-dark" style="background-color: rgba(255, 255, 255, 0.7); padding: 0;">
	<div class="container container_nav" style="padding: 0; line-height: 50px;">
		<a href="/"><img src="../images/logo-search.png" height="35px"></a>
		<button class="show_nav btn"><img src="https://image.flaticon.com/icons/png/512/52/52152.png" height="20px"></button>
		<ul class="menu-bar clearfix">
			<li><a href="">Menu 1</a></li>
			<li><a href="">Menu 1</a></li>
			<?php 
			if(isset($_SESSION['status_login'])){
				echo '<li><a href="">';

				$r_info = new getInfoAccount($_SESSION['email']);
				$name = explode(" ",$r_info->getTenThanhVien());
				if($name[count($name) - 1] == ''){
					echo $_SESSION['email'];
				} else {
					echo $name[count($name) - 1];
				}
				echo '</a>
				<ul class="sub-menu-bar">
				<li><a href="../user/dangxuat.php">Đăng xuất</a></li>';

				$r = new DatabaseBlog;
				if($r->checkRightAcount($_SESSION['email']) == 1){
					echo '<li><a href="../control/post.php">Đăng bài</a></li>';
				}
				echo '</ul></li>';
			} else {echo '<li><a href="../user/dangnhap.php">Đăng nhập</a></li>';
		} 
		?>
	</ul>
</div>

</nav>

<div class="container" style="margin-top: 50px">
	<div class="row">
		<div class="col-md-3">

		</div>
		<div class="col-md-9">
			<form class="form-search">
				<input type="text" name="key" placeholder="Nhập từ khóa tìm kiếm" class="timkiem">
				<button type="button" class="btn show-button hide-btn"></button>
			</form>
		</div>
	</div>

</div>