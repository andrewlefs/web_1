<div class="page-header"><h1><?php echo ''.$title.' - '.$_GET["the"].'';?></h1></div>
<?php
$label_style = array(
	'class' => 'col-sm-3 control-label'
);
$form_style = array(
	'class' => 'form-horizontal',
	'role' => 'form',
);
$loai = array(
	'name'	=> 'loai',
	'id'	=> 'loai',
	'class' => 'form-control',
	'placeholder' => 'Loại thẻ',
	'value' => $_GET['the'],
	'required' => 'required',
	'type' => 'hidden'
);

$seri = array(
	'name'	=> 'seri',
	'id'	=> 'seri',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	'required' => 'required',
);

$ma = array(
	'name'	=> 'ma',
	'id'	=> 'ma',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	'required' => 'required',
);

$seri2 = array(
	'name'	=> 'seri2',
	'id'	=> 'seri2',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma2 = array(
	'name'	=> 'ma2',
	'id'	=> 'ma2',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri3 = array(
	'name'	=> 'seri3',
	'id'	=> 'seri3',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma3 = array(
	'name'	=> 'ma3',
	'id'	=> 'ma3',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri4 = array(
	'name'	=> 'seri4',
	'id'	=> 'seri4',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma4 = array(
	'name'	=> 'ma4',
	'id'	=> 'ma4',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri5 = array(
	'name'	=> 'seri5',
	'id'	=> 'seri5',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma5 = array(
	'name'	=> 'ma5',
	'id'	=> 'ma5',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri6 = array(
	'name'	=> 'seri6',
	'id'	=> 'seri6',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma6 = array(
	'name'	=> 'ma6',
	'id'	=> 'ma6',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri7 = array(
	'name'	=> 'seri7',
	'id'	=> 'seri7',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma7 = array(
	'name'	=> 'ma7',
	'id'	=> 'ma7',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri8 = array(
	'name'	=> 'seri8',
	'id'	=> 'seri8',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma8 = array(
	'name'	=> 'ma8',
	'id'	=> 'ma8',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri9 = array(
	'name'	=> 'seri9',
	'id'	=> 'seri9',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma9 = array(
	'name'	=> 'ma9',
	'id'	=> 'ma9',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$seri10 = array(
	'name'	=> 'seri10',
	'id'	=> 'seri10',
	'class' => 'form-control',
	'placeholder' => 'SERI THẺ',
	
);

$ma10 = array(
	'name'	=> 'ma10',
	'id'	=> 'ma10',
	'class' => 'form-control',
	'placeholder' => 'MÃ THẺ',
	
);

$button_data = array(
	'class' =>  'btn btn-primary',
	'content' => 'Lưu lại',
    'type' => 'submit',
	'style' => 'padding: 5px;width: 100%',
);
?>

<?php echo form_open(''.ADMIN_URL.'add_save', $form_style); ?>

	<?php echo form_input($loai); ?>
	

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 1', $ma['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma); ?>
		<span class="help-block"><?php echo form_error($ma['name']); ?><?php echo isset($errors[$ma['name']])?$errors[$ma['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
	
		<?php echo form_label('Seri thẻ 1', $seri['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri); ?>
		<span class="help-block"><?php echo form_error($seri['name']); ?><?php echo isset($errors[$seri['name']])?$errors[$seri['name']]:''; ?></span>
		</div>
	</div>
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 2', $ma2['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma2); ?>
		<span class="help-block"><?php echo form_error($ma2['name']); ?><?php echo isset($errors[$ma2['name']])?$errors[$ma2['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 2', $seri2['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri2); ?>
		<span class="help-block"><?php echo form_error($seri2['name']); ?><?php echo isset($errors[$seri2['name']])?$errors[$seri2['name']]:''; ?></span>
		</div>
	</div>
	
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 3' , $ma3['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma3); ?>
		<span class="help-block"><?php echo form_error($ma3['name']); ?><?php echo isset($errors[$ma3['name']])?$errors[$ma3['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 3', $seri3['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri3); ?>
		<span class="help-block"><?php echo form_error($seri3['name']); ?><?php echo isset($errors[$seri3['name']])?$errors[$seri3['name']]:''; ?></span>
		</div>
	</div>
	
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 4', $ma4['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma4); ?>
		<span class="help-block"><?php echo form_error($ma4['name']); ?><?php echo isset($errors[$ma4['name']])?$errors[$ma4['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 4', $seri4['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri4); ?>
		<span class="help-block"><?php echo form_error($seri4['name']); ?><?php echo isset($errors[$seri4['name']])?$errors[$seri4['name']]:''; ?></span>
		</div>
	</div>
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 5', $ma5['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma5); ?>
		<span class="help-block"><?php echo form_error($ma5['name']); ?><?php echo isset($errors[$ma5['name']])?$errors[$ma5['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 5', $seri5['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri5); ?>
		<span class="help-block"><?php echo form_error($seri5['name']); ?><?php echo isset($errors[$seri5['name']])?$errors[$seri5['name']]:''; ?></span>
		</div>
	</div>
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 6', $ma6['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma6); ?>
		<span class="help-block"><?php echo form_error($ma6['name']); ?><?php echo isset($errors[$ma6['name']])?$errors[$ma6['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 6', $seri6['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri6); ?>
		<span class="help-block"><?php echo form_error($seri6['name']); ?><?php echo isset($errors[$seri6['name']])?$errors[$seri6['name']]:''; ?></span>
		</div>
	</div>
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 7', $ma7['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma7); ?>
		<span class="help-block"><?php echo form_error($ma7['name']); ?><?php echo isset($errors[$ma7['name']])?$errors[$ma7['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 7', $seri7['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri7); ?>
		<span class="help-block"><?php echo form_error($seri7['name']); ?><?php echo isset($errors[$seri7['name']])?$errors[$seri7['name']]:''; ?></span>
		</div>
	</div>
	
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 8', $ma8['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma8); ?>
		<span class="help-block"><?php echo form_error($ma8['name']); ?><?php echo isset($errors[$ma8['name']])?$errors[$ma8['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 8', $seri8['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri8); ?>
		<span class="help-block"><?php echo form_error($seri8['name']); ?><?php echo isset($errors[$seri8['name']])?$errors[$seri8['name']]:''; ?></span>
		</div>
	</div>
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 9', $ma9['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma9); ?>
		<span class="help-block"><?php echo form_error($ma9['name']); ?><?php echo isset($errors[$ma9['name']])?$errors[$ma9['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 9', $seri9['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri9); ?>
		<span class="help-block"><?php echo form_error($seri9['name']); ?><?php echo isset($errors[$seri9['name']])?$errors[$seri9['name']]:''; ?></span>
		</div>
	</div>
	<br>

	
	<div class="form-group">
		<?php echo form_label('Mã thẻ 10', $ma10['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($ma10); ?>
		<span class="help-block"><?php echo form_error($ma10['name']); ?><?php echo isset($errors[$ma10['name']])?$errors[$ma10['name']]:''; ?></span>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Seri thẻ 10', $seri10['id'], $label_style); ?>
		<div class="col-sm-6">
		<?php echo form_input($seri10); ?>
		<span class="help-block"><?php echo form_error($seri10['name']); ?><?php echo isset($errors[$seri10['name']])?$errors[$seri10['name']]:''; ?></span>
		</div>
	</div>
	
	<div class="form-group">
	<div class="col-sm-offset-3 col-sm-6">
		<?php echo form_button($button_data); ?>
	</div>
	</div>
<?php echo form_close(); ?>
