<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<div class="page-header">
	<h1><?php echo $title;?></h1>
	</div>
	
	<strong>Tìm kiếm: </strong>
	<form method="GET" class="form-inline" action="" role="form">
		<div class="form-group">
			<label class="sr-only" for="email">Số ĐT</label>
			<input type="number" class="form-control" id="email" name="email" <?php if(isset($_GET['email'])){echo 'value="'.$_GET['email'].'"';};?> placeholder="Số ĐT">
		</div>
	<div class="form-group">
		<label class="sr-only" for="username">Tên đăng nhập</label>
		<input type="text" class="form-control" id="username" name="username" <?php if(isset($_GET['username'])){echo 'value="'.$_GET['username'].'"';};?> placeholder="Tên đăng nhập">
	</div>
		<button type="submit" class="btn btn-success">Tìm kiếm</button>
	</form>
	Bạn có thể điền 1 trong 3 hoặc cả 3 thông tin.
	<br><br>
	<table class="table table-bordered">
		<tr>
			<th>Tài khoản</th>
			<th>Số ĐT</th>
			<th>Thao tác</th>
		</tr>
		<?php foreach($users AS $user)
		{ 
		?>
			<tr>
				<td>
					<?php echo  $user['username'];?>
				</td>
				<td>
					<?php echo $user['email'];?>
				</td>
				<td>
					<a href="<?php echo ''.ADMIN_URL.'user_edit/'.$user['id'].''?>">Sửa</a> 
				</td>
			</tr>
		<?php } ?>
	</table>
	<div class="center-block text-center ">
	<ul class="pagination">
		<li class="<?php if($page<=1){echo 'disabled';}?>"><span><a href="<?php echo ''.ADMIN_URL.'users/'.($page-1).'';?>">&laquo;</a></span></li>
		<?php for($i=1; $i<=$count_page; $i++) {?>
		<li class="<?php if ($page == $i){echo 'active';}?>"><span><a style="color: #000;display: block;width: 100%" href="<?php echo ''.ADMIN_URL.'users/'.$i.'';?>"><?php echo $i;?></a></span></li>
		<?php } ?>
		<li class="<?php if($page == $count_page){echo 'disable';}?>"><a href="<?php echo ''.ADMIN_URL.'users/'.($page+1).'';?>">&raquo;</a></li>
	</ul>
	</div>

