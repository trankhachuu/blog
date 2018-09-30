<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');

/**
* Class lấy nội dung bài viết ra màn hình
*/
class GetContentTopic{
	private $baiviet_id;
	private $data;

	private $tieudebaiviet;
	private $noidungbaiviet;
	private $ngaydang;
	private $chuyenmucdang;
	private $thanhviendang;
	private $hinhanhdaidien;

	function __construct($baiviet_id){
		$this->baiviet_id = $baiviet_id;
	}

	function run(){
		$getdata = new DatabaseBlog;
		$data = $getdata->getAllContentTopic($this->baiviet_id);

		$this->tieudebaiviet = $data['tieudebaiviet'];
		$this->noidungbaiviet = $data['noidungbaiviet'];
		$this->ngaydang = $data['ngaydang'];
		$this->chuyenmucdang = $data['chuyenmucdang'];
		$this->thanhviendang = $data['thanhviendang'];
		$this->hinhanhdaidien = $data['hinhanhdaidien'];
	}

	function getTieuDeBaiViet(){
		return $this->tieudebaiviet;
	}

	function getNoiDungBaiViet(){
		return $this->noidungbaiviet;
	}

	function getNgayDang(){
		return $this->ngaydang;
	}

	function getChuyenMucDang(){
		return $this->chuyenmucdang;
	}
	function getThanhVienDang(){
		return $this->thanhviendang;
	}

	function getHinhDaiDien(){
		return $this->hinhanhdaidien;
	}

}




?>