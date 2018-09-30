<?php 
	require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
	/**
	* Kiểm tra tình trạng User
	*/
	class CheckUser{
		function __construct(){	
		}

		function checkRightUser($email){
			$r = new DatabaseBlog;
			if($r ->checkRightAcount($email) == 1){
				return 1;
			} else {
				return 0;
			}
		}
	}
?>