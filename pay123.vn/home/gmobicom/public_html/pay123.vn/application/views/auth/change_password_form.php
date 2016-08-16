<div class="col-md-9" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="" data-toggle="tab">Đổi mật khẩu</a></li>
  <li><a href="../gioithieu">Giới thiệu</a></li>
  <li><a href="../huongdan">Hướng dẫn</a></li>
  <li><a href="../chietkhau">Chiết khấu</a></li>
</ul>


<div class="page-header"><h4>Đổi mật khẩu của bạn</h4></div>
<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
	'class' => 'form-control',
	'required' => 'required',
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control',
	'required' => 'required',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'class' => 'form-control',
	'required' => 'required',
);
$label_style = array(
	'class' => 'col-sm-3 control-label',
);
$form_style = array(
	'class' => 'form-horizontal',
	'role' => 'form'
);
$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Cập nhật',
    'type' => 'submit',
	'style' => 'padding: 5px;width: 30%; display: block;'
);
?>
<?php echo form_open(''.$this->config->base_url().'auth/change_password', $form_style); ?>

	<div class="form-group">
		<?php echo form_label('Mật khẩu cũ', $old_password['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_password($old_password); ?>
		<span class="help-block"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?$errors[$old_password['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Mật khẩu mới', $new_password['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_password($new_password); ?>
		<span class="help-block"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Nhập lại lần nữa', $confirm_new_password['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_password($confirm_new_password); ?>
		<span class="help-block"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></span>
		</div>
	</div>
		<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		  <?php echo form_button($button_data); ?>
		</div>
	</div>
<?php echo form_close(); ?>
</div>