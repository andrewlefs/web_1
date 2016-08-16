<div class="page-header"><h1><?php echo $title;?></h1></div>
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
	'value' => $category['id'],
	'required' => 'required',
);
$short_title = array(
	'name' => 'short_title',
	'class' => 'form-control',
	'id' => 'short_title',
	'value' => $category['short_title'],
	'required' => 'required',
);

$title = array(
	'name' => 'title',
	'class' => 'form-control',
	'id' => 'title',
	'value' => $category['title'],
	'required' => 'required',
);

$description = array(
	'name'	=> 'description',
	'id'	=> 'description',
	'value'	=> $category['description'],
	'class' => 'form-control',
	'rows' => '3',
	'placeholder' => 'Miêu tả ngắn gọn khoảng 2-3 dòng.',
	'required' => 'required',
);

$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Lưu lại',
    'type' => 'submit',
	'style' => 'padding: 5px; width: 100%',
);
?>
<?php echo form_open(''.ADMIN_URL.'category_save', $form_style); ?>

	<?php echo form_input($id); ?>
	<div class="form-group">
		<?php echo form_label('Tiêu đề ngắn', $short_title['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($short_title); ?>
		<span class="help-block">Viết khoảng 2 từ. Ví dụ: Giới thiệu, Dịch vụ...</span>
		<span class="help-block"><?php echo form_error($short_title['name']); ?><?php echo isset($errors[$short_title['name']])?$errors[$short_title['name']]:''; ?></span>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo form_label('Tiêu đề', $title['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($title); ?>
		<span class="help-block">Tiêu đề này dài, ví dụ : Giới thiệu về website của chúng tôi</span>
		<span class="help-block"><?php echo form_error($title['name']); ?><?php echo isset($errors[$title['name']])?$errors[$title['name']]:''; ?></span>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo form_label('Kích hoạt mục này', 'active', $label_style); ?>
		<div class="col-sm-6">
			<select class="form-control" name="active">
			<option value="1" <?php if($category['active'] == 1){echo 'selected';}?>>Có</option>
			<option value="0" <?php if($category['active'] == 0){echo 'selected';}?>>Không</option>
			</select>
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
	<div class="col-sm-offset-3 col-sm-6">
		<?php echo form_button($button_data); ?>
	</div>
	</div>
<?php echo form_close(); ?>
