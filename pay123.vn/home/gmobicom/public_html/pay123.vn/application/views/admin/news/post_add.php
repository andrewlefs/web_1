<div class="page-header"><h1><?php echo $title;?></h1></div>
<script type="text/javascript" src="<?php echo $this->config->base_url();?>theme/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
tinyMCE.init({
        mode : "specific_textareas",
        editor_selector : "mceEditor",
		language : 'vi_VN',
		content_css : "<?php echo $this->config->base_url();?>theme/css/tinymce.css",
		plugins: [
		"advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks",
		"insertdatetime media table contextmenu paste"
	  ],
});
</script>

<?php
$label_style = array(
	'class' => 'col-sm-3 control-label'
);
$form_style = array(
	'class' => 'form-horizontal',
	'role' => 'form',
);
$id = array(
	'name' => 'id',
	'class' => 'form-control',
	'id' => 'id',
	'type' => 'hidden',
	'readonly' => 'readonly',
	'value' => $post['id'],
	'required' => 'required',
);
$title = array(
	'name' => 'title',
	'class' => 'form-control',
	'id' => 'title',
	'value' => $post['title'],
	'required' => 'required',
);
$image = array(
	'name'	=> 'image',
	'id'	=> 'image',
	'value'	=> $post['image'],
	'class' => 'form-control',
	'placeholder' => 'Điền chính xác địa chỉ hình ảnh.',
	'type' => 'url',
	'required' => 'required',
);
$description = array(
	'name'	=> 'description',
	'id'	=> 'description',
	'value'	=> $post['description'],
	'class' => 'form-control',
	'rows' => '3',
	'placeholder' => 'Miêu tả ngắn gọn khoảng 2-3 dòng.',
	'required' => 'required',
);

$content = array(
	'name'	=> 'content',
	'id'	=> 'content',
	'value'	=> $post['content'],
	'class' => 'form-control mceEditor',
	'placeholder' => 'Nhập vào nội dung của bài viết.',
);

$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Lưu lại',
    'type' => 'submit',
	'style' => 'padding: 5px; width: 100%',
);
?>
<?php echo form_open(''.ADMIN_URL.'post_save', $form_style); ?>

	<?php echo form_input($id); ?>
	<div class="form-group">
		<?php echo form_label('Tiêu đề', $title['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($title); ?>
		<span class="help-block"><?php echo form_error($title['name']); ?><?php echo isset($errors[$title['name']])?$errors[$title['name']]:''; ?></span>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo form_label('Thuộc danh mục', 'category_id', $label_style); ?>
		<div class="col-sm-6">
			<select class="form-control" name="category_id">
			<?php foreach($categories AS $category) { ?>
			<option value="<?php echo $category['id'];?>" <?php if($category['active'] == 0) {echo 'disabled';} elseif($post['category_id'] ==  $category['id']){echo 'selected';}?>><?php echo  $category['short_title'];?> <?php if($category['active'] == 0) {echo '(bị xóa tạm thời)';};?></option>
			<?php } ?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo form_label('URL hình ảnh', $image['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($image); ?>
		<span class="help-block"><?php echo form_error($image['name']); ?><?php echo isset($errors[$image['name']])?$errors[$image['name']]:''; ?></span>
		</div>
	</div>
			
	<div class="form-group">
		<?php echo form_label('Miêu tả ngắn gọn', $description['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_textarea($description); ?>
		<span class="help-block"><?php echo form_error($description['name']); ?><?php echo isset($errors[$description['name']])?$errors[$description['name']]:''; ?></span>
		</div>
	</div>
	
	<div class="form-group">
	<?php echo form_label('Nội dung chi tiết: ', $content['id'], $label_style); ?>
	</div>
	<div class="col-sm-11">
	<?php echo form_textarea($content); ?>
	<span class="help-block"><?php echo form_error($content['name']); ?><?php echo isset($errors[$content['name']])?$errors[$content['name']]:''; ?></span>
	</div>	

	<div class="form-group">
	<div class="col-sm-offset-3 col-sm-6">
		<?php echo form_button($button_data); ?>
	</div>
	</div>
<?php echo form_close(); ?>
