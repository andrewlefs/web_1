<div class="col-md-9" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="" data-toggle="tab">Kích hoạt</a></li>
  <li><a href="../gioithieu">Giới thiệu</a></li>
  <li><a href="../huongdan">Hướng dẫn</a></li>
  <li><a href="../chietkhau">Chiết khấu</a></li>
</ul>

<div class="pay-info">
<BR />
<?php
$form_style = array(
	'class' => 'form-horizontal',
	'role' => 'form'
);
$label_style = array(
	'class' => 'col-sm-3 control-label'
);
$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Kích hoạt',
    'type' => 'submit',
	'style' => 'padding: 5px;width: 30%; display: block;'
);
$reset_key = array(
	'name'	=> 'reset_key',
	'id'	=> 'reset_key',
	'size'	=> 30,
	'class' => 'form-control',
	'required' => 'required',
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'size'	=> 30,
	'class' => 'form-control',
	'required' => 'required',
	'type' => 'password',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'size'	=> 30,
	'class' => 'form-control',
	'required' => 'required',
	'type' => 'password',
);

?>
Bạn hãy nhập mã số vừa được nhận tại điện thoại.<br><br>
<?php echo form_open(''.$this->config->base_url().'auth/reset_password', $form_style); ?>

	<div class="form-group">
		<?php echo form_label('Mã xác nhận', $reset_key['id'],$label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($reset_key); ?>
		<span class="help-block"><?php echo form_error($reset_key['name']); ?><?php echo isset($errors[$reset_key['name']])?$errors[$reset_key['name']]:''; ?></span>
		</div>
	</div>

	<div class="form-group">
		<?php echo form_label('Mật khẩu mới ', $new_password['id'],$label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($new_password); ?>
		<span class="help-block"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Nhập lại mật khẩu ', $confirm_new_password['id'],$label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($confirm_new_password); ?>
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
</div>
</div>