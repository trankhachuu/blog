<?php 
	/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
/**
* Lấy thông tin thành viên
*/
class GetInfoAccount{
	private $email;
	private $id;
	private $tenthanhvien;
	private $diachi;
	private $quyen;
	private $ngaysinh;
	private $gioitinh;

	private $run;

	function __construct($email){
		$this->email = $email;
		$run = new DatabaseBlog;
		$data = $run->getAllInfoAccount($email);
		$this->id = $data['thanhvien_id'];
		$this->tenthanhvien = $data['tenthanhvien'];
		$this->diachi = $data['diachi'];
		$this->quyen = $data['quyen'];
		$this->ngaysinh = $data['ngaysinh'];
		$this->gioitinh = $data['gioitinh'];
	}

	function getTenThanhVien(){
		return $this->tenthanhvien;
	} 

	function getIDThanhVien(){
		return $this->id;
	}

	function getDiaChiThanhVien(){
		return $this->diachi;
	}

	function getQuyenThanhVien(){
		return $this->quyen;
	}

	function getNgaySinhThanhVien(){
		return $this->ngaysinh;
	}

	function getGioiTinhThanhVien(){
		return $this->gioitinh;
	}

}

 ?>