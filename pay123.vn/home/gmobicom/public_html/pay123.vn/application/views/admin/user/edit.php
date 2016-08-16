<div class="page-header"><h1><?php echo $title;?></h1></div>
<?php
$label_style = array(
	'class' => 'col-sm-3 control-label'
);
$form_style = array(
	'class' => 'form-horizontal',
	'role' => 'form',
);
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'value' => $user['username'],
	'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Tài khoản nên viết liền, ko dấu, ko viết hoa',
	'required' => 'required',
);
$userid = array(
	'name' => 'id',
	'type' => 'hidden',
	'value' => $user['id'],
	'required' => 'required',
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> $user['email'],
	'maxlength'	=> 80,
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Điền chính xác địa chỉ email.',
	'required' => 'required',
);
$phone = array(
	'name'	=> 'phone',
	'id'	=> 'phone',
	'value'	=> $user['phone'],
	'maxlength'	=> 15,
	'size'	=> 30,
	'type' => 'number',
	'class' => 'form-control',
	'placeholder' => 'Chúng tôi sẽ liên hệ chủ yếu qua SĐT này.',
	'required' => 'required',
);


$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => '',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'class' => 'form-control',
	'placeholder' => 'Nếu không thay đổi thì bỏ trống.',
);

if($user['banned'] == '1'){
	$banned = array(
	'name'	=> 'banned',
	'id'	=> 'banned',
	'value' => '1',
	'checked' => '',
	'type' => 'checkbox',
	);
}
else{
	$banned = array(
	'name'	=> 'banned',
	'id'	=> 'banned',
	'value' => '1',
	'type' => 'checkbox',
	);
}

$ban_reason = array(
	'name'	=> 'ban_reason',
	'id'	=> 'ban_reason',
	'value' => '',
	'class' => 'form-control',
	'placeholder' => 'Lý do cấm.',
	'value'	=> $user['ban_reason'],
);
$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Lưu lại',
    'type' => 'submit',
	'style' => 'padding: 5px;width: 100%',
);
?>
<?php echo form_open(''.ADMIN_URL.'user_save', $form_style); ?>

	<?php echo form_input($userid); ?>
	<div class="form-group">
		<?php echo form_label('Tên tài khoản', $username['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($username); ?>
		<span class="help-block"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></span>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo form_label('Địa chỉ Email', $email['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($email); ?>
		<span class="help-block"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
		</div>
	</div>

	
	
	<div class="form-group">
		<?php echo form_label('Mật khẩu', $password['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($password); ?>
		<span class="help-block"><?php echo form_error($password['name']); ?></span>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		<div class="checkbox">
			<label>
				<?php echo form_input($banned); ?> Cấm thành viên này
			</label>
		</div>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo form_label('Lý do cấm', $ban_reason['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ban_reason); ?>
		<span class="help-block"><?php echo form_error($ban_reason['name']); ?></span>
		</div>
	</div>
  
	<div class="form-group">
	<div class="col-sm-offset-3 col-sm-6">
		<?php echo form_button($button_data); ?>
	</div>
	</div>
<?php echo form_close(); ?>
