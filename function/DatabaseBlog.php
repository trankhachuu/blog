<?php

/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

/**
 * Database
 */

class DatabaseBlog {
	private $host = "localhost";
	private $username = "root";
	private $pass = "";
	private $database_name = "blog";
	private $conn;

	function __construct(){
		$this->conn = mysqli_connect($this->host, $this->username, $this->pass, $this->database_name) or die("Không thể kết nối tới Database");
		mysqli_query($this->conn, "set names 'utf8'");
	}

	#Get data to Database

	function getTenChuyenMuc($idchuyenmuc){
		$sql = "SELECT tenchuyenmuc FROM chuyenmuc WHERE chuyenmuc_id = '".$idchuyenmuc."'";
		$query = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($query) == 0){
			return "Chọn chuyên mục";
		} else {
			$row = mysqli_fetch_array($query);
			return $row['tenchuyenmuc'];
		}
	}

	function getAllToPic() {
		$sql = "SELECT * FROM baiviet ORDER BY baiviet_id DESC LIMIT 10";
		$query = mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($query) == 0) {
			echo "Chưa có dòng dử liệu nào";
		} else {
			while ($row = mysqli_fetch_array($query)) {
				echo'<div class="list">
				<div class="content-left">'.$row['ngaydang'];
				if(isset($_SESSION['status_login']) && isset($_SESSION['email'])){
					$info = $this->getAllInfoAccount($_SESSION['email']);
					if($info['quyen'] == 1 && isset($_SESSION['status_login'])){
						echo '<div class="update">
						<div class="edit"><a href="../control/edit.php?id_post='.$row['baiviet_id'].'"><img src="https://png.icons8.com/map-editing/ios7/30/ffffff"></a></div>
						<div class="remove"><a href="../control/remove.php?id_post='.$row['baiviet_id'].'"><img src="https://png.icons8.com/delete-filled/ios7/30/ffffff"></a></div>
						</div>';
					}
				}
				
				echo '</div>
				<div class="content-right">

				<div class="title-baiviet"><a href="../blog/view.php?id_post='.$row['baiviet_id'].'">'.$row['tieudebaiviet'].'</a></div>
				<div class="mota_baiviet">'.substr($row['noidungbaiviet'], 0, 501)."...".'</div>
				<div class="content-img">
				<img src="'.$row['hinhanhdaidien'].'" style="max-width:100%;"/>
				</div>
				</div>
				</div>';
			}
		}
	}

	function loadMoreTopic($page){
		$baiVietDaShow = ($page * 10);
		$sql = "SELECT * from baiviet";
		$query = mysqli_query($this->conn, $sql);
		$data = "";
		if(mysqli_num_rows($query) > $baiVietDaShow){
			#Còn bài viết trong database 
			$sql = "SELECT * FROM baiviet ORDER BY baiviet_id DESC LIMIT ".$baiVietDaShow.", 10";
			$query = mysqli_query($this->conn, $sql);
			
			if(mysqli_num_rows($query) > 0){
				while ($row = mysqli_fetch_array($query)) {
					$data= $data.'<div class="list">
					<div class="content-left">'.$row['ngaydang'];
					session_start();
					if(isset($_SESSION['status_login']) && isset($_SESSION['email'])){
						$info = $this->getAllInfoAccount($_SESSION['email']);
						if($info['quyen'] == 1){
							$data= $data. '<div class="update">
							<div class="edit"><a href="../control/edit.php?id_post='.$row['baiviet_id'].'"><img src="https://png.icons8.com/map-editing/ios7/30/ffffff"></a></div>
							<div class="remove"><a href="../control/remove.php?id_post='.$row['baiviet_id'].'"><img src="https://png.icons8.com/delete-filled/ios7/30/ffffff"></a></div>
							</div>';
						}
					} else {
					}

					$data= $data. '</div>
					<div class="content-right">

					<div class="title-baiviet"><a href="../blog/view.php?id_post='.$row['baiviet_id'].'">'.$row['tieudebaiviet'].'</a></div>
					<div class="mota_baiviet">'.substr($row['noidungbaiviet'], 0, 501)."...".'</div>
					<div class="content-img">
					<img src="'.$row['hinhanhdaidien'].'" style="max-width:100%;"/>
					</div>
					</div>
					</div>';
				}
			} else {
				return 0;
			}
		} else {
			#Hết bài viết trong database
			return 0;
		}
		return $data;

	}

	function getTopicByCat($chuyenmuc_id) {
		$sql = "SELECT * FROM baiviet WHERE chuyenmuc_id = '".$chuyenmuc_id."'";
		$query = mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($query) == 0) {
			echo "Chưa có dòng dử liệu nào";
		} else {
			while ($row = mysqli_fetch_array($query)) {
				echo'<div class="list">
				<div class="content-left">'.$row['ngaydang'].'
				</div>
				<div class="content-right">
				<div class="content-img">
				<img src="'.$row['hinhanhdaidien'].'"/>
				</div>
				<div class="title-baiviet"><a href="">'.$row['tieudebaiviet'].'</a></div>
				<div class="mota_baiviet">'.$row['noidungbaiviet'].'</div>
				</div>
				</div>';
			}
		}
	}

	function getAllContentTopic($id_post){
		$sql = "SELECT * FROM baiviet WHERE baiviet_id ='".$id_post."'";
		$query = mysqli_query($this->conn, $sql);
		$data;
		if(mysqli_num_rows($query) == 0){
			echo '<center>Bài viết này không còn tồn tại</center>';
			return 0;
		} else {
			$row = mysqli_fetch_array($query);


			$thanhvien_id = $row['thanhvien_id'];
			$query_user = mysqli_query($this->conn, "SELECT tenthanhvien FROM thanhvien WHERE thanhvien_id = '".$thanhvien_id."'");
			$row_user = mysqli_fetch_array($query_user);
			$tenthanhvien = $row_user['tenthanhvien'];

			$chuyenmuc_id = $row['chuyenmuc_id'];
			$query_chuyenmuc = mysqli_query($this->conn, "SELECT tenchuyenmuc FROM chuyenmuc WHERE chuyenmuc_id = '".$chuyenmuc_id."'");	
			$row_chuyenmuc = mysqli_fetch_array($query_chuyenmuc);
			$tenchuyenmuc = $row_chuyenmuc['tenchuyenmuc'];


			$data = array(	'tieudebaiviet' => $row['tieudebaiviet'],
				'noidungbaiviet' => $row['noidungbaiviet'], 
				'hinhanhdaidien' => $row['hinhanhdaidien'], 
				'thanhviendang' => $tenthanhvien, 
				'chuyenmucdang' => $tenchuyenmuc,
				'idchuyenmuc' => $chuyenmuc_id, 
				'ngaydang' => $row['ngaydang']);
		}
		return $data;
	}

	function getAllCatToSelected(){
		$sql = "SELECT * FROM chuyenmuc";
		$data="";
		$query = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($query) == 0){
			echo 'Không có dòng dử liệu nào trong bảng';
		} else {
			while ($row = mysqli_fetch_array($query)) {
				$data = $data.'<option value="'.$row['chuyenmuc_id'].'">'.$row['tenchuyenmuc'].'</option>';
			}
		}
		return $data;
	}

	function getAllInfoAccount($email){
		$sql = "SELECT * FROM thanhvien WHERE email = '".$email."'";
		$query = mysqli_query($this->conn, $sql);

		$row = mysqli_fetch_array($query);

		$data = array(	'thanhvien_id' => $row['thanhvien_id'],
			'tenthanhvien' => $row['tenthanhvien'],
			'quyen' => $row['quyen'],
			'ngaysinh' => $row['ngaysinh'],
			'gioitinh' => $row['gioitinh'],
			'diachi' => $row['diachi']
		);
		return $data;
	}

	function getCommentToTopic($baiviet_id){
		$sql = "SELECT * FROM binhluan WHERE baiviet_id = '".$baiviet_id."' ORDER BY binhluan_id DESC LIMIT 10";
		$query = mysqli_query($this->conn, $sql);
		$data="";
		if(mysqli_num_rows($query) == 0){
			echo 'Không có dòng dử liệu nào';
		} else {
			while($row = mysqli_fetch_array($query)){
				$tvThanhVien = "SELECT tenthanhvien FROM thanhvien WHERE thanhvien_id = '".$row['thanhvien_id']."'";
				$row_ThanhVien = mysqli_fetch_array(mysqli_query($this->conn, $tvThanhVien));

				$data = $data.'<div class="list-cmt clearfix">
				<div class="avartar"><img src=""></div>
				<div class="noidung-cmt">
				<div class="head-cmt"> <div class="author-cmt">'.$row_ThanhVien['tenthanhvien'].'</div>'
				.$row['noidungbinhluan'].'</div>
				<div class="foot-cmt">'.$row['ngaybinhluan'].'</div>
				</div>
				</div>';
			}
		}
		return $data;
	}


	function loadMoreCmt($baiviet_id, $page){
		$data="";
		$pageDaLoad = $page * 10;
		$sql = "SELECT * from binhluan WHERE baiviet_id = '".$baiviet_id."'";
		$query = mysqli_query($this->conn , $sql);
		if(mysqli_num_rows($query) > $pageDaLoad){
			$sql = "SELECT * from binhluan WHERE baiviet_id = '".$baiviet_id."' ORDER BY binhluan_id DESC LIMIT ".$pageDaLoad.", 10";
			$query2 = mysqli_query($this->conn, $sql);
			while($row = mysqli_fetch_array($query2)){
				$tvThanhVien = "SELECT tenthanhvien FROM thanhvien WHERE thanhvien_id = '".$row['thanhvien_id']."'";
				$row_ThanhVien = mysqli_fetch_array(mysqli_query($this->conn, $tvThanhVien));


				$data = $data.'<div class="list-cmt clearfix">
				<div class="avartar"><img src=""></div>
				<div class="noidung-cmt">
				<div class="head-cmt"> <div class="author-cmt">'.$row_ThanhVien['tenthanhvien'].'</div>'
				.$row['noidungbinhluan'].'</div>
				<div class="foot-cmt">'.$row['ngaybinhluan'].'</div>
				</div>
				</div>';
			}
			return $data;
		} else {
			return 0;
		}
		
	}

	function getLastIDComment($baiviet_id){

		$sql = "SELECT binhluan_id FROM binhluan WHERE baiviet_id = '".$baiviet_id."' ORDER BY binhluan_id DESC LIMIT 1";

		$query = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($query) == 0){
			echo 0;
		} else {
			$row = mysqli_fetch_array($query);
			return $row['binhluan_id'];
		}
	}

	#Set to Database

	function setTopic($data){
		$date = getdate();

		$sql = "INSERT INTO `baiviet` (`baiviet_id`, `tieudebaiviet`, `noidungbaiviet`, `hinhanhdaidien`, `thanhvien_id`, `chuyenmuc_id`, `ngaydang`) VALUES (NULL, '".$data['tieudebaiviet']."', '".$data['noidungbaiviet']."', '".$data['hinhdaidien']."', '1', '".$data['chuyenmuc']."', '".$date['year']."-".$date['mon']."-".$date['mday']."')";

		if(mysqli_query($this->conn, $sql)){
			return 1;
		} else {
			return 0;
		}
	}

	function editTopic($data, $idbaiviet){
		$sql = "UPDATE `baiviet` SET `tieudebaiviet` = '".$data['tieudebaiviet']."', `noidungbaiviet` = '".$data['noidungbaiviet']."', `hinhanhdaidien` = '".$data['hinhdaidien']."', `chuyenmuc_id` = '".$data['chuyenmuc']."' WHERE `baiviet`.`baiviet_id` = ".$idbaiviet.";";

		$query = mysqli_query($this->conn, $sql);

		if($query){
			return 1;
		} else {
			return 0;
		}
	}

	function removeTopic($idbaiviet){
		#Xóa Comment
		$sql = "SELECT * FROM binhluan WHERE baiviet_id = '".$idbaiviet."'";
		if(mysqli_num_rows(mysqli_query($this->conn, $sql)) != 0){
			$sql = "DELETE FROM `binhluan` WHERE `binhluan`.`baiviet_id` = '".$idbaiviet."'";
			if(mysqli_query($this->conn, $sql)){
				echo 'Khoong xoa duoc binh luan';
			}
		}

		#Xóa Topic
		$sql = "DELETE FROM `baiviet` WHERE `baiviet`.`baiviet_id` = '".$idbaiviet."'";
		$query = mysqli_query($this->conn, $sql);
		if($query){
			return 1;
		} else {
			return $sql;
		}
	}

	function checkLogin($email, $pass){
		$sql = "SELECT * FROM thanhvien WHERE email = '".$email."' AND matkhau = '".$pass."'";
		$query = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($query) == 0){
			return 0;
		} else {
			return 1;
		}
	}

	function checkMail($email){
		$sql = "SELECT * FROM thanhvien WHERE email = '".$email."'";
		$query = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($query) == 0){
			return 0;
		} else {
			return 1;
		}
	}

	function registerAcount($email, $tenthanhvien, $matkhau){
		$sql = "INSERT INTO `thanhvien` (`thanhvien_id`, `tenthanhvien`, `email`, `matkhau`, `quyen`, `ngaysinh`, `gioitinh`, `diachi`) VALUES (NULL, '".$tenthanhvien."', '".$email."', '".$matkhau."', '0', NULL, NULL, NULL);";
		$query = mysqli_query($this->conn, $sql);
		if($query){
			return 1;
		} else {
			return 0;
		}
	}

	function checkRightAcount($email){
		$sql = "SELECT quyen FROM thanhvien WHERE email = '".$email."'";

		$query = mysqli_query($this->conn, $sql);

		$row = mysqli_fetch_array($query);

		if($row['quyen'] == 1){
			return 1;
		} else if($row['quyen'] == 0){
			return 0;
		}
	}

	function addNewComment($noidungbinhluan, $baiviet_id, $thanhvien_id){
		$date = getdate();
		$sql = "INSERT INTO `binhluan` (`binhluan_id`, `noidungbinhluan`, `ngaybinhluan`, `baiviet_id`, `thanhvien_id`) VALUES (NULL, '".$noidungbinhluan."', '".$date['year']."-".$date['mon']."-".$date['mday']."', '".$baiviet_id."', '".$thanhvien_id."');";

		$query = mysqli_query($this->conn, $sql);

		if($query){
			return 1;
		} else {
			return 0;
		}
	}

	function loadNewCmt($baiviet_id, $last_id_cmt){
		$sql = "SELECT * FROM binhluan WHERE baiviet_id = '".$baiviet_id."' AND binhluan_id > ".$last_id_cmt." ORDER BY binhluan_id DESC";
		$query = mysqli_query($this->conn, $sql);
		$data="";
		if(mysqli_num_rows($query) == 0){
			return 0;
		} else {
			while($row = mysqli_fetch_array($query)){
				$tvThanhVien = "SELECT tenthanhvien FROM thanhvien WHERE thanhvien_id = '".$row['thanhvien_id']."'";
				$row_ThanhVien = mysqli_fetch_array(mysqli_query($this->conn, $tvThanhVien));


				$data = $data.'<div class="list-cmt clearfix">
				<div class="avartar"><img src=""></div>
				<div class="noidung-cmt">
				<div class="head-cmt"> <div class="author-cmt">'.$row_ThanhVien['tenthanhvien'].'</div>'
				.$row['noidungbinhluan'].'</div>
				<div class="foot-cmt">'.$row['ngaybinhluan'].'</div>
				</div>
				</div>';
			}
			return $data;
		}
	}

	#____________________________________________Time Line ________________________________________________

	function getTimeLine(){
		$sql = "SELECT * FROM tamtrang ORDER BY tamtrang_id DESC LIMIT 5";
		$query = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($query) != 0){
			$data="";
			while($row = mysqli_fetch_array($query)){

				$daypost = $row['ngaydang'];

				$year=explode("-", $daypost)[0];
				$month = explode("-", $daypost)[1];
				$day = explode("-", $daypost)[2];

				$data = $data.'<div class="time-line">
				<div class="dong-time-line">
				<div class="time-group">
				<div class="even-time">'.$day.'/'.$month.'<br>'.$year.'</div>
				<div class="icon-timeline"></div>
				</div>
				<div class="noidung-timeline">
				<div class="giodang">at '.$row['giodang'].'</div>
				'.$row['noidung'];




				if($row['hinhdinhkem'] != '' && strlen($row['hinhdinhkem'] != '') < 5){
					$hinh = explode("~", $row['hinhdinhkem']);
					if(count($hinh) != 0){
					#Có ảnh thì làm ở đây đó là chuyện m đã biết rồi máy à , giờ là việc của t  , t làm đây nha, pp m
						if(count($hinh) == 1){
							$data = $data."<div class='block-images'>
							<div class='row'>
							<div class='col-3'></div>
							<div class='col-6'>
							<div class='col-6-img' style='background-image: url(".$hinh[0].");'>
							<div class='blur-hover'></div>
							</div>
							</div>
							<div class='col-3'></div>
							</div>
							</div>";

						} else if(count($hinh) == 2){
							$data = $data.'<div class="block-images"><div class="row">';
							for($i = 0 ; $i < 2 ; $i ++){
								$data = $data."<div class='col-6'>
								<div class='col-6-img' style='background-image: url(".$hinh[$i].");'><div class='blur-hover'></div>
								</div>
								</div>";
							}
							$data = $data.'</div></div>';

						} else {
							$data = $data.'<div class="block-images"><div class="row">';
							for($i = 0 ; $i < 2 ; $i++){
								$sohinh = count($hinh) - 2;
								if($i == 0){
									$data = $data."<div class='col-6'>
									<div class='col-6-img' style='background-image: url(".$hinh[0].");'><div class='blur-hover'></div>
									</div>
									</div>";
								}
								if($i == 1){
									$data = $data."<div class='col-6'>
									<div class='col-6-img' style='background-image: url(".$hinh[1].");'><div class='blur-hover' style='background-color: rgba(124, 124, 124, 0.5); text-align: center; line-height: 349px; font-size: 65px; color: red'>".$sohinh."</div>
									</div>
									</div>";
								}
							}
							$data = $data.'</div></div>';
						}

					}
				}

				if(strlen($row['linkdinhkem']) < 5){
					$data = $data.'<div class="link-dinhkem"><a href="'.$row['linkdinhkem'].'">Link đây thưa thí chủ</a></div>';
				}


				# Đóng nội dung
				$data = $data.'</div>
				</div>
				</div>';
			}
			return $data;
		}else {
			return 'Có cái coin card gì ở đây đâu mà dòm';
		}
	}


	function addNewStatus($noidung, $link, $images){

		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$date = getdate();
		$sql = "INSERT INTO `tamtrang` (`tamtrang_id`, `noidung`, `ngaydang`, `giodang`, `hinhdinhkem`, `linkdinhkem`, `filedinhkem`, `thanhvien_id`) VALUES (NULL, '".$noidung."', '".$date['year']."-".$date['mon']."-".$date['mday']."', '".$date['hours'].":".$date['minutes'].":".$date['seconds']."', '".$images."', '".$link."', NULL, '1');";
		


		if(mysqli_query($this->conn, $sql)){
			return 1;
		} else {
			return 0;
		}

	}

	function loadMoreStatus($page){
		$countTopic = ($page * 5) - 5;
		$sql = "SELECT * from tamtrang";
		$query = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($query) <= $countTopic){
			return 0;
		} else {
			$sql = "SELECT * from tamtrang ORDER BY tamtrang_id DESC LIMIT ".$countTopic." , 5";
			$query = mysqli_query($this->conn, $sql);
			if(mysqli_num_rows($query) == 0){
				return 0;
			} else {
				$data="";
				while($row = mysqli_fetch_array($query)){

					$daypost = $row['ngaydang'];

					$year=explode("-", $daypost)[0];
					$month = explode("-", $daypost)[1];
					$day = explode("-", $daypost)[2];

					$data = $data.'<div class="time-line">
					<div class="dong-time-line">
					<div class="time-group">
					<div class="even-time">'.$day.'/'.$month.'<br>'.$year.'</div>
					<div class="icon-timeline"></div>
					</div>
					<div class="noidung-timeline">
					<div class="giodang">at '.$row['giodang'].'</div>
					'.$row['noidung'];

					if($row['hinhdinhkem'] != '' && strlen($row['hinhdinhkem'] != '') < 5){
						$hinh = explode("~", $row['hinhdinhkem']);
						if(count($hinh) != 0){
					#Có ảnh thì làm ở đây đó là chuyện m đã biết rồi máy à , giờ là việc của t  , t làm đây nha, pp m
							if(count($hinh) == 1){
								$data = $data."<div class='block-images'>
								<div class='row'>
								<div class='col-3'></div>
								<div class='col-6'>
								<div class='col-6-img' style='background-image: url(".$hinh[0].");'>
								<div class='blur-hover'></div>
								</div>
								</div>
								<div class='col-3'></div>
								</div>
								</div>";

							} else if(count($hinh) == 2){
								$data = $data.'<div class="block-images"><div class="row">';
								for($i = 0 ; $i < 2 ; $i ++){
									$data = $data."<div class='col-6'>
									<div class='col-6-img' style='background-image: url(".$hinh[$i].");'><div class='blur-hover'></div>
									</div>
									</div>";
								}
								$data = $data.'</div></div>';

							} else {
								$data = $data.'<div class="block-images"><div class="row">';
								for($i = 0 ; $i < 2 ; $i++){
									$sohinh = count($hinh) - 2;
									if($i == 0){
										$data = $data."<div class='col-6'>
										<div class='col-6-img' style='background-image: url(".$hinh[0].");'><div class='blur-hover'></div>
										</div>
										</div>";
									}
									if($i == 1){
										$data = $data."<div class='col-6'>
										<div class='col-6-img' style='background-image: url(".$hinh[1].");'><div class='blur-hover' style='background-color: rgba(124, 124, 124, 0.5); text-align: center; line-height: 349px; font-size: 65px; color: red'>".$sohinh."</div>
										</div>
										</div>";
									}
								}
								$data = $data.'</div></div>';
							}

						}
					}

					if(strlen($row['linkdinhkem']) < 5){
						$data = $data.'<div class="link-dinhkem"><a href="'.$row['linkdinhkem'].'">Link đây thưa thí chủ</a></div>';
					}
				# Đóng nội dung
					$data = $data.'</div>
					</div>
					</div>';
				}
				return $data;
			}
		}
	}

}

?>