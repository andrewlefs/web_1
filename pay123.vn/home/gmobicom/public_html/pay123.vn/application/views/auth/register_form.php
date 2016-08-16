<div class="col-md-9" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="" data-toggle="tab">Đăng ký</a></li>
  <li><a href="../gioithieu">Giới thiệu</a></li>
  <li><a href="../huongdan">Hướng dẫn</a></li>
  <li><a href="../chietkhau">Chiết khấu</a></li>
</ul>

<div class="pay-info">
<div class="page-header"><h3>Đăng kí thành viên</h3></div>

<?php

if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'class' => 'form-control',
		'required' => 'required',
	);
}

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
	'value'	=> set_value('email'),
	'size'	=> 30,
	'class' => 'form-control',
	'type' => 'number',
	'minlength' => '10',
	'maxlength' => '11',
	'placeholder' => 'Nhập chính xác để kích hoạt',
	'required' => 'required',
);
$phone = array(
	'name'	=> 'phone',
	'id'	=> 'phone',
	'maxlength'	=> 10,
	'class' => 'form-control',
	'type' => 'number',
	'readonly' => 'readonly',
	'placeholder' => 'Số ĐT đúng để bảo đảm quyền lợi của bạn',
	'required' => 'required',
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'required' => 'required',
	'size'	=> 30,
	'class' => 'form-control',
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'required' => 'required',
	'size'	=> 30,
	'class' => 'form-control',
);
$code = array(
	'name'	=> 'code',
	'id'	=> 'code',
	'maxlength'	=> 10,
	'class' => 'form-control',
	'onkeyUp' => 'checkPhone(this.value)',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	'class' => 'form-control',
);

$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Đăng ký',
    'type' => 'submit',
	'style' => 'padding: 5px;width: 30%; display: block;'
);
?>
<?php echo form_open(''.$this->config->base_url().'auth/register', $form_style); ?>

	<?php if ($use_username) { ?>
	<div class="form-group">
		<?php echo form_label('Tên tài khoản', $username['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($username); ?>
		<span class="help-block"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></span>
		</div>
	</div>
	<?php } ?>
	

	<div class="form-group">
		<?php echo form_label('Mật khẩu', $password['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_password($password); ?>
		<span class="help-block"><?php echo form_error($password['name']); ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Nhập lại mật khẩu', $confirm_password['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_password($confirm_password); ?>
		<span class="help-block"><?php echo form_error($confirm_password['name']); ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Số điện thoại', $email['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($email); ?>
		<span class="help-block"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
		</div>
	</div>
	<!--
	24/12/2013 Bỏ phần xác nhận
	Thay thế email thành số đt
	<div class="form-group">
		<?php //echo form_label('Mã xác nhận', $code['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php //echo form_input($code); ?>
		<span class="help-block" id="txtHint"></span>
		<span class="help-block"><?php //echo form_error($code['name']); ?><?php //echo isset($errors[$code['name']])?$errors[$code['name']]:''; ?></span>
		<span style="font-size:12px">Soạn tin <strong>IBO</strong> gửi <strong>8085</strong> để lấy mã xác nhận ( phí: 500 vnđ )<br>
		Số điện thoại sẽ tự động được điền nếu đúng mã xác nhận</span>
		</div>
	</div>
		<div class="form-group">
		<?php //echo form_label('Số ĐT', $password['id'], $label_style); ?>
		<div class="col-sm-5">
			<?php //echo form_input($phone); ?>
		</div>
	</div>
	-->
	

	<?php if ($captcha_registration) {
		if ($use_recaptcha) { ?>
	<div class="form-group">
		
			<div id="recaptcha_image"></div>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		
	</div>
	<div class="form-group">
		
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		
		<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
		<span class="help-block"><?php echo form_error('recaptcha_response_field'); ?></span>
		<?php echo $recaptcha_html; ?>
	</div>
	<?php } else { ?>
	<div class="form-group">
		
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		
	</div>
	<div class="form-group">
		<?php echo form_label('Confirmation Code', $captcha['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($captcha); ?>
		<span class="help-block"><?php echo form_error($captcha['name']); ?></span>
		</div> 
		
	</div>
	<?php }
	} ?>
	<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo form_button($button_data); ?>
	</div>
	</div>
<?php echo form_close(); ?>
</div>
</div>