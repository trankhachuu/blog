<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

require_once(dirname(__FILE__).'/../include/section.php');

unset($_SESSION['status_login']);
unset($_SESSION['email']);
header('LOCATION:../index.php');
	
?>