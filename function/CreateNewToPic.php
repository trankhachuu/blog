<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');

/**
* Chức năng thêm bài viết mới 
*/
class CreateNewToPic{
	private $data;
	
	function __construct(){
		# code...
	}

	function form_edit($value, $idbaiviet){
		$r = new DatabaseBlog;
		$this->data = $r->getAllCatToSelected();

		echo '<div class="container">'.
		"\n" .'<form action="../control/edit.php?id_post='.$idbaiviet.'" method="post">'.
		// "\n" . '<script type="text/javascript" src="../plugins/ckeditor/ckeditor.js"></script>'.
		"\n" . '<script type="text/javascript" src="../plugins/bbeditor/ed.js"></script>'.
		"\n" . '<div class="component">' .
		"\n" . '<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="chuyenmuc">'.
		"\n" . '<option value="'.$value['idchuyenmuc'].'" selected>'.$value['chuyenmucdang'].'</option>';

		echo $this->data;

		echo '</select>' .
		"\n" . '<button class="btn btn-primary" name="submit">Giửi bài viết</button>' .
		"\n" . '</div>' .
		"\n" . '<input name = "tenbaiviet" class="form-control" type="text" value="'.$value['tenbaiviet'].'" id="example-text-input">'.
		"\n" . '<input name = "hinhanhdaidien" class="form-control" type="text" value="'.$value['hinhanhdaidien'].'" id="example-text-input">'.
		"\n" . ''.
		"\n" . ''.
		"\n" . ''.
		// "\n" . '<textarea name="noidungbaiviet" id="editor1" rows="10" cols="80">'.$value['noidungbaiviet'].'</textarea>'.
		// "\n" . '<script>CKEDITOR.replace("editor1");</script>'.
		"\n" . '<script>edToolbar("noidungbaiviet"); </script>'.
		"\n" . '<textarea name="noidungbaiviet" id="noidungbaiviet" class="ed form-control" style="min-height: 299px">'.$value['noidungbaiviet'].'</textarea>'.
		"\n" . '</form>'.
		"\n" . '</div>';

	}

	function form($value){
		$r = new DatabaseBlog;
		$this->data = $r->getAllCatToSelected();

		echo '<div class="container">'.
		"\n" .'<form action="../control/post.php" method="post">'.
		"\n" . '<script type="text/javascript" src="../plugins/bbeditor/ed.js"></script>'.
		"\n" . '<div class="component">' .
		"\n" . '<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="chuyenmuc">'.
		"\n" . '<option value="'.$value['idchuyenmuc'].'" selected>'.$value['chuyenmucdang'].'</option>';

		echo $this->data;

		echo '</select>' .
		"\n" . '<button class="btn btn-primary" name="submit">Giửi bài viết</button>' .
		"\n" . '</div>' .
		"\n" . '<input name = "tenbaiviet" class="form-control" type="text" value="'.$value['tenbaiviet'].'" id="example-text-input">'.
		"\n" . '<input name = "hinhanhdaidien" class="form-control" type="text" value="'.$value['hinhanhdaidien'].'" id="example-text-input">'.
		"\n" . ''.
		"\n" . ''.
		"\n" . ''.
		"\n" . '<script>edToolbar("noidungbaiviet"); </script>'.
		"\n" . '<textarea name="noidungbaiviet" id="noidungbaiviet" class="ed form-control" style="min-height: 299px">'.$value['noidungbaiviet'].'</textarea>'.
		"\n" . '</form>'.
		"\n" . '</div>';

	}

	function setDataToForm($data){

	}

function post($data /*array*/){
	$r = new DatabaseBlog;
	if($r->setTopic($data) == 1){
		return 1;
	} else {
		return 0;
	}
}

function edit($data, $idbaiviet){
	$r = new DatabaseBlog;
	if($r->editTopic($data, $idbaiviet) == 1){
		return 1;
	} else {
		return 0;
	}
}
}

?>