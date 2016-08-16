<div class="col-md-9" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="" data-toggle="tab">Đăng nhập</a></li>
  <li><a href="../gioithieu">Giới thiệu</a></li>
  <li><a href="../huongdan">Hướng dẫn</a></li>
  <li><a href="../chietkhau">Chiết khấu</a></li>
</ul>

<div class="pay-info">
** Nếu quên mật khẩu bạn có thể <a href="../auth/forgot_password">Lấy lại mật khẩu</a>.
</div>

<div class="pay-info">
<BR />
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'class' => 'form-control',
	'required' => 'required',
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Tên tài khoản';
} else if ($login_by_username) {
	$login_label = 'Tài khoản';
} else {
	$login_label = 'Email';
}

$form_style = array(
	'class' => 'form-horizontal',
	'role' => 'form'
);
$label_style = array(
	'class' => 'col-sm-3 control-label'
);
$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Đăng nhập',
    'type' => 'submit',
	'style' => 'padding: 5px;width: 30%; display: block;'
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'class' => 'form-control',
	'required' => 'required',
	
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'type' => 'hidden',
	'checked'	=> 'checked',
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	'class' => 'form-control',
);
?>

<?php echo form_open(''.$this->config->base_url().'auth/login', $form_style); ?>

	<div class="form-group">
		<?php echo form_label($login_label, $login['id'],$label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($login); ?>
		<span class="help-block"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
		</div>
		
  </div>
	<div class="form-group">
		<?php echo form_label('Mật khẩu', $password['id'], $label_style); ?>
		<div class="col-sm-5">
		<?php echo form_password($password); ?>
		<span class="help-block"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
		</div>
		
	</div>

	<?php if ($show_captcha) {
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
		<?php echo form_error('recaptcha_response_field'); ?>
		<?php echo $recaptcha_html; ?>
	</div>
	<?php } else { ?>
	<div class="form-group">
		
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		
	</div>
	<div class="form-group">
		<?php echo form_label('Confirmation Code', $captcha['id'], $label_style); ?>
		<?php echo form_input($captcha); ?>
		<?php echo form_error($captcha['name']); ?>
	</div>
	<?php }
	} ?>
<?php echo form_checkbox($remember); ?> 
	
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		  <?php echo form_button($button_data); ?>
		  Bạn chưa có tài khoản? <a href="../auth/register">Đăng ký</a>. 
		</div><br />
		

	</div>

<?php echo form_close(); ?>

</div>



</div>