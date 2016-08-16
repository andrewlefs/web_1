<?php 
if($posts == NULL)
{
	echo '<h1>Chưa có bài viết nào thuộc chuyên mục này</h1>';
}
else{
foreach($posts AS $post) { ?>

	<div class="post_item">
		<h2 class="sidebar_title"><?php echo anchor('post/'.$this->news->friendly_url($post['title']).'-'.$post['id'].'',$post['title']);?></h2>
		<a href="<?php echo ''.$this->config->base_url().'post/'.$this->news->friendly_url($post['title']).'-'.$post['id'].'';?>">
		<img src="<?php echo $post['image'];?>" alt="<?php echo $post['title'];?>" title="<?php echo $post['title'];?>" class="post_image"/>
		</a>
		<?php echo $post['description'];?>
		<span class="pull-right"><a href="<?php echo ''.$this->config->base_url().'post/'.$this->news->friendly_url($post['title']).'-'.$post['id'].'';?>" type="button" class="btn btn-danger btn-xs">Xem tiếp ...</button></a>
	</div>
<?php } }?>