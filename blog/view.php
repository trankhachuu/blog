<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */

require_once(dirname(__FILE__).'/../function/ViewToPic.php');

$run = new GetContentTopic($_GET['id_post']);

$run->run();

$title = $run->getTieuDeBaiViet() ." - Phương Văn Cường";

require_once(dirname(__FILE__).'/../include/head.php');

?>

<div class="container">
	<div class="row">
		<!--Col -md -3-->
		<?php require_once(dirname(__FILE__).'/../include/slider.php') ?>
		<!--/Col- md- 3-->
		<div class="col-md-9" style="margin-top: 5px; margin-bottom: 9px;">
			<nav class="breadcrumb">
				<a class="breadcrumb-item" href="#">Home</a>
				<a class="breadcrumb-item" href="#"><?php echo $run->getChuyenMucDang(); ?></a>
				<span class="breadcrumb-item active"><?php echo $run->getTieuDeBaiViet(); ?></span>
			</nav>
			<!--Tiêu đề-->

			<?php echo '<div class="phdr">'.$run->getTieuDeBaiViet(). '</div>';
			?>
			<!--Link-->
			<div style="padding: 5px; text-align: right; font-weight: bold; color: #333; padding-right: 50px; border-bottom: solid 1px rgba(9, 9, 9, 0.1); margin-bottom: 5px;"><?php echo $run->getThanhVienDang() . " - ". $run->getNgayDang() ?> </div>

			<!--Nội dung-->
			<div class="content-post">
				<center><img src=<?php echo $run->getHinhDaiDien() ?> style="max-width: 100%;"></center>

				<p><?php echo $run->getNoiDungBaiViet(); ?></p>
			</div>
			<!--Bình loạn-->

			<div class="phdr">Bình luận</div>
			<div class="comment clearfix">
				<div class="comment-left">
					<img src = "https://cdn.pixabay.com/photo/2016/08/20/05/38/avatar-1606916_640.png"/>
				</div>
				<div class="comment-right">
					<div id="form">
						<textarea class="input-comment form-control" name="noidungbinhluan" id="noidung"></textarea>
						<button class="btn btn-comment" name="submit" id="submit">Bình luận</button>
					</div>
				</div>
			</div>
			<?php 
			require_once(dirname(__FILE__).'/../blog/showcomment.php');
			#Hiển thị bình luận
			$r_cmt = new ShowComment($_GET['id_post']);
			$r_cmt->show();

			?>

			<div style="text-align: center;"><button class="btn" id= "btn_loadNewCmt">Tải thêm bình luận</button></div>
		</div>
	</div>


</div>

<script type="text/javascript">
	//Giửi bình luận về server
	var soTrang=1;
	var isLoad = false;
	var isSubmit = false;
	var lastID = <?php echo $r_cmt->getLastID() ?>;
	var baiviet_id = <?php echo $_GET['id_post']; ?>;
	$(document).ready(function(){
		$("#submit").click(function(){
			if(isSubmit == false){
				isSubmit = true;
				var noidungbinhluan = $('#noidung').val();
				var data ='post=' + String(baiviet_id)+ '&nd_bl=' + noidungbinhluan;

				if(noidungbinhluan == ''){
					alert("Nội dung không được để trắng như vậy nhé");
				} else {
					var aaaa = "<div class='loading' style='text-align: center'><img width = '50px' src='../images/loader.gif'></div>";
					$('.khung-loading').append(aaaa);

					$.ajax({
						type: "POST", 
						url: "../blog/comment.php",
						data: data, 
						cache: false, 
						success: function(server_return){
							if(server_return.substr(0, 1) == "1"){
								setTimeout(function(){
									$('.ds-cmt').remove();
									$('.loading').remove().fadeTo(200, 1);
									$('.khung-cmt').append(server_return.substr(1, server_return.length)).fadeTo(200, 1);
								}, 1000);


							} else {
								setTimeout(function(){
									alert("Không thể đăng bình luận. Vui lòng thử lại!!");
									$('.loading').remove();
								},1000);
							}

						}
					});

					setTimeout(function() {isSubmit = false}, 5000);
				}
			} else {
				alert("Mổi bình luận cách nhau 5s nhé");
			}
		});
		// ajax Sử lí bình luận theo thời gian thực
		setInterval(function(){
			var nd_post = 'id_post='+String(baiviet_id) + '&last_id_cmt=' + lastID;
			$.ajax({
				type: "POST", 
				url: "../blog/loadNewCmt.php", 
				data: nd_post, 
				cache: false, 
				success: function(data){

					if(data != ''){
						var idDau = 0;

						var idCuoi = data.indexOf("%cuong%");

						var dataDau = idCuoi + data.substring(idCuoi, idCuoi + 7).length;

						var dataCuoi = data.length;

						var idMoi = data.substring(0, idCuoi);
						
						$('.ds-cmt').prepend(data.substring(dataDau, dataCuoi));
						lastID = idMoi;
					}

				}
			});
		}, 1000);

		// Sử lí load more comment
		
		$('#btn_loadNewCmt').click(function(){
			if(isLoad == false){
				isLoad = true;
				var data_load = 'baiviet_id=' + String(baiviet_id) + '&pagecmt='+ soTrang;
				$.ajax({
					type: "POST", 
					url: "../blog/loadmorecmt.php",
					data: data_load, 
					cache: false,
					success: function(server_return){
						setTimeout(function() {
							if(server_return != 0){
								soTrang++;
								$('.ds-cmt').append(server_return);
								isLoad = false;
							} else {
								alert("Bạn đã ở trang cuối cùng");
								isLoad = false;
							}
						}, 500);
					}
				});
			} else {
				alert('Đang có truy vấn cần sử lí');
			}
		});
		

	});

</script>
<?php

require_once(dirname(__FILE__).'/../include/foot.php');

?>