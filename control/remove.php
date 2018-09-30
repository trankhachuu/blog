<?php 

require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
require_once(dirname(__FILE__).'/../function/checkUser.php');
require_once(dirname(__FILE__).'/../include/section.php');

$checkQuyen = new CheckUser;
if(isset($_SESSION['status_login']) && $checkQuyen->checkRightUser($_SESSION['email']) == 1){
	if(isset($_GET['id_post'])){
		$r = new DatabaseBlog;
		if($r->removeTopic($_GET['id_post']) == 1){
			header('LOCATION:../');
		} else{
			header('LOCATION:../blog/view.php?id_post='.$_GET['id_post'].'&error=not_dell_comment');
		}
	} else {
		echo 'Not set id';
	}
} else {
	
	header('LOCATION:../');
}
