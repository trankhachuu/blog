<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
$title ="Đăng nhập/Đăng kí - PhuongVanCuong blog";

#Sử lí dử liệu t newt_form()

function suliDangNhap(){
	#** Đăng nhập
	if(isset($_POST['dangnhap'])){
		$email = $_POST['email'];
		$matkhau = $_POST['matkhau'];

		if($email == '' && $matkhau == ''){
			echo '<div class="container"><div class="alert alert-warning"><strong>Lổi!</strong> Tên đăng nhập và mật khẩu không được để trống</div></div>';
		} else {
			$r = new DatabaseBlog();
			$check = $r->checkLogin($email, $matkhau);
			if($check == 0){
				echo '<div class="container"><div class="alert alert-danger"><strong>Lổi!</strong> Tên đăng nhập hoặc mật khẩu không chính sác</div></div>';
			} else if($check == 1){
				$_SESSION['status_login'] = true;
				$_SESSION['email'] = $email;
				echo '<div class="container"><div class="alert alert-success"><strong>Good!</strong> Đăng nhập thành công</div></div>';
				header('LOCATION:../');
			}
		}
	}
}

function suliDangKi(){
	#SuliDang Ki
	if(isset($_POST['dangki'])){
		$email = $_POST['email'];
		$matkhau = $_POST['matkhau'];
		$tenthanhvien = $_POST['tenthanhvien'];
		$nhaplaimatkhau = $_POST['nhaplaimatkhau'];

		if($email == '' || $matkhau == '' || $tenthanhvien ='' || $nhaplaimatkhau ==''){
			echo '<div class="container"><div class="alert alert-warning"><strong>Lổi!</strong> Vui lòng cho chúng tôi biết một số thông tin</div></div>';
		} else {
			$r = new DatabaseBlog();
			$check = $r->checkMail($email);
			if($check == 1){
				echo '<div class="container"><div class="alert alert-warning"><strong>Lổi!</strong> Email này đã được dùng cho một tài khoản đăng kí</div></div>';
			} else if($check == 0){
				if($matkhau == $nhaplaimatkhau){
					if($r->registerAcount($email, $tenthanhvien, $matkhau) == 1){echo 'Thanh cong';} else {echo 'Dang ki that bai , thu lai sau';}
				} else {
					echo '<div class="container"><div class="alert alert-warning"><strong>Lổi!</strong> Mật khẩu không khớp</div></div>';
				}
			}
		}
	}

}

function showForm(){
	echo'<script type="text/javascript">
	$(document).ready(function(){
		$(".register-form").hide(); 
		$(".btn-register-show").hide();
		$(".register-tips").click(function(){
			$(".register-form").show(200);
			$(".btn-register-show").show();
			$(".foot-login").hide();
			$(".hide-login").hide(0);
		});
	});
	</script>
	<style type="text/css">
	.form-control{
		margin-bottom: 5px;
	}
	</style>
	<div class="container login_form">
	<h2><center>Đăng nhập/Đăng kí</center></h2>
	<form class="form-signin" action="../user/dangnhap.php" method="POST">

	<input type="text" name="tenthanhvien" class="form-control register-form" placeholder="Nhập họ tên thành viên"/>

	<input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ Email"/>

	<input type="password" name="matkhau" class="form-control" placeholder="Nhập mật khẩu"/>

	<input type="password" name= "nhaplaimatkhau" class="form-control register-form" placeholder="Nhập lại mật khẩu"/>

	<div class="foot-login">
	<div class="checkbox hide-login">
	<label>
	<input type="checkbox" value="remember-me" name="submit"> Nhớ đăng nhập
	</label>
	</div>
	<div class="register-tips">Chưa có tài khoản</div>

	</div>

	<button class="btn btn-login hide-login" type="input" name="dangnhap">Đăng nhập</button>
	<button class="btn btn-login btn-register-show" type="input" name="dangki">Đăng kí</button>

	
	</form>
	</div>';
}

?>


<?php 
require_once(dirname(__FILE__).'/../include/head.php');
if(!isset($_SESSION['status_login'])){
	suliDangKi();
	suliDangNhap();
	showForm();
} else {
	header("LOCATION:../index.php");
}

require_once(dirname(__FILE__).'/../include/foot.php') 
?>