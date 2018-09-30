
<?php
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
?>
<article>
	<div id="status_load">
		<script type="text/javascript">
			$(document).ready(function(){
				$('.link').hide();
				$('.hinhanh').hide();
				$('.hide-btn-post').hide();

				$('.show-link').click(function(){
					$('.link').show(200);
					$('.hide-btn-post').show(200);
				});

				$('.show-hinhanh').click(function(){
					$('.hinhanh').show(200);
					$('.hide-btn-post').show(100);
				});

				$('.hide-btn-post').click(function(){
					$('.hinhanh').hide(500);
					$('.link').hide(500);
					$('.hide-btn-post').hide(100);
				});

				$('#submit').click(function(){
					var noidungstatus = $('#noidungstatus').val();
					var link = $('#dinhkem').val();
					var hinhanh = $('#hinhanh').val();



					var data = 'noidungstatus=' + String(noidungstatus) + '&dinhkem=' + dinhkem + '&hinhanh=' + hinhanh;
					if(noidungstatus == ''){
						alert('Không viết gì mà đăng cái coin card');
					} else if(noidungstatus.length < 10){
						alert('Cố gắn viết thêm ' + String(10 - noidungstatus.length) + ' kí tự nửa !!');
					} else{
						$.ajax({
							type : "POST", 
							url : "../status/addstatus.php", 
							data : data, 
							cache : false, 
							success: function(server_return){
								alert(server_return);
							}
						});
					}
				})
			});	

		</script>
		<?php 
		$ktQuyen = new DatabaseBlog;
		if(isset($_SESSION['email']))
			$quyen = $ktQuyen->checkRightAcount($_SESSION['email']);
		else
			$quyen = 0;
		if(isset($_SESSION['status_login']) && $quyen == 1) {
			echo '<div class="time-line">
			<div class="dong-time-line dangbai">
			<div class="post-avatar">
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNLzZszQbQf6jkknIGI8A3rj-0BoEngyi9156njfrCjPED9_b2vw" class="avatar">
			</div>
			<div class="content-post-timeline">

			<div class ="post_feeling ">
			<textarea class="form-control form-post-feeling" id = "noidungstatus" placeholder="status"></textarea>
			<div class="cuongdaik">
			<input type="text" id="dinhkem" class="post-phu link" placeholder="link">
			<input type="hinhanh" id="hinhanh" class="post-phu hinhanh" placeholder="img">
			<button class="btn btn-edit-post" id="submit"></button>
			</div>
			</div> 
			</div>

			<div class="btn-post-feeling">
			<span class="btn-span show-link"></span>
			<span class="btn-span show-hinhanh"></span>
			<span class="btn-span hide-btn-post"></span>
			</div>

			</div>
			</div>';
		} else {
			echo "<div class='time-line'>
			<div class='dong-time-line dangbai'>
			<div class='post-avatar-user'>
			<div class='avatar-images' style='background-image: url(/images/avatar.jpg);'></div>
			</div>
			<div class='content-post-timeline'>

			<div class ='post_feeling post-bottom'>
			<div class='cover-images' style='background-image: url(images/cover.jpg');''><h2 class='author'>(Coder)</h2></div>
			</div>
			</div>

			</div>
			</div>";
		}

		?>

		<?php $r=new DatabaseBlog; 
		echo $r->getTimeLine();?>
	</div>

	<div style="text-align: center;"><button class="btn" id="loadmorestt"><img class='img_loadmore' src='../images/loader.gif' height="20px;"> Xem thêm chia sẽ của tôi</button></div>
</article>

<script type="text/javascript">
	$(document).ready(function(){
		$('.img_loadmore').hide();
		var page = 1;
		var load = false;
		$("#loadmorestt").click(function(){
			$("#loadmorestt").addClass('disabled');
			if(load == false){
				load = true;
				$('.img_loadmore').show();
				var data = 'page=' + page;
				$.ajax({
					type: "POST", 
					url: "../status/loadmorestt.php", 
					data: data, 
					cache: false, 
					success: function(server_return){
						setTimeout(function() {
							load = false;
							$("#loadmorestt").removeClass('disabled');
							if(server_return != 0){
								$('#status_load').append(server_return);
								$('.time-line').slideDown(500);
								page++;
								$('.img_loadmore').hide();
							} else {
								alert("Bạn đã ở trang cuối cùng");
								$('.img_loadmore').hide();
							}
						}, 1000);
					}
				});
			}
		});
	});
</script>