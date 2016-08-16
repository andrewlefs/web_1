<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php 
if($posts == NULL)
{
	echo '<h2>Không có bài nào</h2>';
}
else
{ 
?>
<div class="page-header">
	<h1><?php echo $title;?></h1>
	</div>
	<table class="table table-bordered">
		<tr>
			<th>Tiêu đề</th>
			<th width="50%">Tóm tắt</th>
			<th>Thao tác</th>
		</tr>
		<?php foreach($posts AS $post)
		{ 
		?>
			<tr >
				<td>
					<?php echo $post['title'];?>
				</td>
				<td>
					<?php echo $post['description'];?>
				</td>
				<td>
					<a href="<?php echo ''.$this->config->base_url().'post/'.$this->news->friendly_url($post['title']).'-'.$post['id'].'';?>" target="_blank">Xem</a> | 
					<a href="<?php echo ''.ADMIN_URL.'post_edit/'.$post['id'].'';?>">Sửa</a> | 
					<?php if($post['id'] > 0){ ?><a href="<?php echo ''.ADMIN_URL.'post_delete/'.$post['id'].'';?>">Xóa</a><?php } ?>
				</td>
			</tr>
		<?php 
		} ?>
		</table>
<?php } ?>