<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php 
if($categories == NULL)
{
	echo '<h2>Không có danh mục nào</h2>';
	echo '<a href="'.ADMIN_URL.'category_add" class="btn btn-success">Thêm danh mục</a>';
}
else
{ 
?>
	<div class="page-header">
	<h1><?php echo $title;?></h1>
	</div>
	<?php echo '<a href="'.ADMIN_URL.'category_add" class="btn btn-success">Thêm danh mục</a><br><br>';?>
	<table class="table table-bordered">
		<tr>
			<th>Tiêu đề</th>
			<th>Tiêu đề đầy đủ</th>
			<th style="width: 40%">Mô tả ngắn gọn</th>
			<th>Thao tác</th>
		</tr>
		<?php foreach($categories AS $category)
		{ 
		?>
			<tr >
				<td>
					<?php echo $category['short_title'];?>
				</td>
				<td>
					<?php echo $category['title'];?>
				</td>
				<td>
					<?php echo $category['description'];?>
				</td>
				<td>
					<a href="<?php echo ''.ADMIN_URL.'category/'.$category['id'].'';?>">Xem</a> | 
					<a href="<?php echo ''.ADMIN_URL.'category_edit/'.$category['id'].'';?>">Sửa</a> | 
					<?php if($category['id'] > 0){ ?><a href="<?php echo ''.ADMIN_URL.'category_delete/'.$category['id'].'';?>">Tạm xóa</a><?php } ?>
				</td>
			</tr>
		<?php 
		}
		if(isset($deleted_categories))
		{		
			foreach($deleted_categories AS $del_category)
			{ ?>
			<tr class="danger">
					<td>
						<?php echo $del_category['short_title'];?>
					</td>
					<td>
						<?php echo $del_category['title'];?>
					</td>
					<td>
						<?php echo $del_category['description'];?>
					</td>
					<td>
						<a href="<?php echo ''.ADMIN_URL.'category_undel/'.$del_category['id'].'';?>">Khôi phục</a> |
						<a href="<?php echo ''.ADMIN_URL.'category_harddel/'.$del_category['id'].'';?>">Xóa hẳn</a>
					</td>
				</tr>
			<?php 
			} 
		}?>
	</table>
	* Màu hồng là các Danh mục đã bị xóa tạm thời.
<?php } ?>

