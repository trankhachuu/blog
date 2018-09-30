<?php 

require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');

$noidung_status = $_POST['noidungstatus'];
$link_dinhkem = $_POST['dinhkem'];
$hinhdinhkem = $_POST['hinhanh'];

$r= new DatabaseBlog;
if($r->addNewStatus($noidung_status, $link_dinhkem, $hinhdinhkem) == 1){
	echo "Thành công";
} else {
	echo "Thất bại";
}


?>