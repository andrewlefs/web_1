<div class="col-md-9" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="" data-toggle="tab">Quên mật khẩu</a></li>
  <li><a href="../gioithieu">Giới thiệu</a></li>
  <li><a href="../huongdan">Hướng dẫn</a></li>
  <li><a href="../chietkhau">Chiết khấu</a></li>
</ul>

<div class="pay-info">
<div class="page-header"><h4>Quên mật khẩu</h4></div>

<?php
$label_style = array(
	'class' => 'col-sm-3 control-label'
);

$form_style = array(
	'class' => 'form-horizontal',
	'role' => 'form'
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value' => set_value('email'),
	'size'	=> 30,
	'class' => 'form-control',
	'type' => 'number',
	'minlength' => '10',
	'required' => 'required',
	'maxlength' => '11',
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Số điện thoại';
} else {
	$login_label = 'Số điện thoại';
}

$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Tiến hành',
    'type' => 'submit',
	'style' => 'padding: 5px;width: 30%; display: block;'
);
?>
<?php echo form_open(''.$this->config->base_url().'auth/forgot_password', $form_style); ?>

	<div class="form-group">
		<?php echo form_label($login_label, $email['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($email); ?>
		<span class="help-block"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
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