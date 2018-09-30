<?php 
/**
 * @copyright   Copyright (C) 2017 CuongPhuong
 * @author      Phương Văn Cường
 */
require_once(dirname(__FILE__).'/../function/DatabaseBlog.php');
?>


<div class="container">
	<div class="row">
		<?php require_once(dirname(__FILE__).'/slider.php');?>
		<div class="col-md-9">
			<section>
				<?php require_once(dirname(__FILE__).'/timeline.php');?>
				<article>
					<div class="phdr">Bài viết của tôi</div>
					<div class="baiviet">
						<?php
						$getTopic = new DatabaseBlog;
						$getTopic->getAllToPic();
						?>
					</div>
					<div style="text-align: center;"><button class="btn" id="btn-loadmore-baiviet">Tải thêm</button></div>

					<script type="text/javascript">
						$(document).ready(function(){
							var page = 1;
							$('#btn-loadmore-baiviet').click(function(){
								var data = "page=" + page;
								$.ajax({
									type: "POST", 
									url: "../blog/loadmorepost.php", 
									data: data, 
									cache: false, 
									success: function(server_return){
										if(server_return != 0){
											$('.baiviet').append(server_return);
											page++;
										} else {
											alert("Bạn đã ở bài viết cuối cùng");
										}
									}
								});
							});

						});
					</script>
				</article>
			</section>
		</div>
	</div>
</div>
