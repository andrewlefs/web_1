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
$active_key = array(
	'name'	=> 'active_key',
	'id'	=> 'active_key',
	'size'	=> 30,
	'class' => 'form-control',
	'required' => 'required',
);

?>
Mã kích hoạt đã được gửi đến điện thoại của bạn.<br><br>
<?php echo form_open(''.$this->config->base_url().'auth/activate', $form_style); ?>

	<div class="form-group">
		<?php echo form_label('Mã kích hoạt:', $active_key['id'],$label_style); ?>
		<div class="col-sm-5">
		<?php echo form_input($active_key); ?>
		<span class="help-block"><?php echo form_error($active_key['name']); ?><?php echo isset($errors[$active_key['name']])?$errors[$active_key['name']]:''; ?></span>
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