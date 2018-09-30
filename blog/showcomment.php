<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */
 
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
/**
* Show all cmt, hiển thị comment khi hàm show() được gọi
*/
class ShowComment{
	private $baiviet_id;
	private $last_cmt;
	
	function __construct($baiviet_id){
		$this->baiviet_id = $baiviet_id;
	}

	function show(){
		echo '<div class="khung-cmt"><div class="khung-loading"></div><div class="ds-cmt">';
		$r = new DatabaseBlog;
		echo $r->getCommentToTopic($this->baiviet_id);
		echo '</div></div>';
	}

	function getLastID(){
		$r = new DatabaseBlog;
		if($r->getLastIDComment($this->baiviet_id) == 0){
			return 0;
		} else {
			return $r->getLastIDComment($this->baiviet_id);
		}
	}
}
 ?>
