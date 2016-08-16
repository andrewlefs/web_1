
<script>
function addCart(id,action)
	{
		$.ajax({
			type: 'post',
			url: 'cart/callback',
			dataType: 'html',
			data: {'id':id,'action':action,'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>'}, 
			success: function (a) {
				$('#cart_list_item').html(a);
			},
			complete: function () {
				var image_thumb = '#image_thumb_' +id;

				var image = $(image_thumb).offset();
				var cart  = $('#cart').offset();

				$(image_thumb).before('<span class="' + $(image_thumb).attr('class') + '" id="temp" style="position: absolute; top:0px; left:0px;"></span>');

				params = { 
					top : cart.top - image.top+ 'px',
					left : cart.left -image.left +'px',
					opacity : 0.0,
					width : $('#cart').width(),
					height : $('#cart').height()
				};

				$('#temp').animate(params, 'slow', false, function () {
					$('#temp').remove();
				});
			}
		});  
	}
</script>
<?php 
				
$tab = '';
if(isset($_GET['tab']))
{
	$tab = $_GET['tab'];
}
$mang_mobile = array('viettel', 'mobifone', 'vinaphone');
$mang_game = array('gate', 'vcoin', 'zing','oncash','vgold');
$m_first = 1;
if($tab =='game'){$m_first = 0;}
if($tab == 'mobile'){$m_first = 1;} 
if(in_array($tab, $mang_mobile))
{
	$active[$tab] = 'active';
	$boss2 = 'active';

}
elseif(in_array($tab, $mang_game))
{
	$active[$tab] = 'active';
	$boss1 = 'active';
	$m_first = 0;
}
if(!in_array($tab, $mang_game) AND !in_array($tab, $mang_mobile))
{
	$boss1 = 'active';
	$boss2 = 'active';
}

?>
<div class="col-md-9 g-home" role="main">
<?php if($m_first ==1) { ?>
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="<?php if(isset($boss1)){echo $boss1;}?>"><a href="#home" data-toggle="tab"><?php echo $this->lang->line('card_mobile');?></a></li>
  <li class="<?php if(isset($active['viettel'])){echo $active['viettel'];}?>"><a href="#viettel" data-toggle="tab"><?php echo $this->lang->line('card_mobile1');?></a></li>
  <li class="<?php if(isset($active['mobifone'])){echo $active['mobifone'];}?>"><a href="#mobifone" data-toggle="tab"><?php echo $this->lang->line('card_mobile2');?></a></li>
  <li  class="<?php if(isset($active['vinaphone'])){echo $active['vinaphone'];}?>"><a href="#vinaphone" data-toggle="tab"><?php echo $this->lang->line('card_mobile3');?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane <?php if(isset($boss1)){echo $boss1;}?>" id="home">
	<?php 
	foreach($rand_cards AS $rand => $gia)
	{ ?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<?php }	?>

  </div>
  <div class="tab-pane <?php if(isset($active['viettel'])){echo $active['viettel'];};?>" id="viettel">
	<?php foreach($viettel AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>

  <div class="tab-pane <?php if(isset($active['mobifone'])){echo $active['mobifone'];};?>" id="mobifone">
	<?php foreach($mobi AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia); ?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?> 
  </div> 
  <div class="tab-pane <?php if(isset($active['vinaphone'])){echo $active['vinaphone'];};?>" id="vinaphone">
	<?php foreach($vina AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
 
</div>
<div class="ngan"></div>
<?php } ?>

<ul class="nav nav-tabs game" id="gameTab">
  <li class="<?php if(isset($boss2)){echo $boss2;}?>"><a href="#game" data-toggle="tab"><?php echo $this->lang->line('card_game');?></a></li>
  <li  class="<?php if(isset($active['gate'])){echo $active['gate'];}?>"><a href="#gate" data-toggle="tab"><?php echo $this->lang->line('card_game1');?></a></li>
  <li class="<?php if(isset($active['vcoin'])){echo $active['vcoin'];}?>"><a href="#vcoin" data-toggle="tab"><?php echo $this->lang->line('card_game2');?></a></li>
  <li class="<?php if(isset($active['zing'])){echo $active['zing'];}?>"><a href="#zing" data-toggle="tab"><?php echo $this->lang->line('card_game3');?></a></li>
  <li class="<?php if(isset($active['oncash'])){echo $active['oncash'];}?>"><a href="#oncash" data-toggle="tab"><?php echo $this->lang->line('card_game4');?></a></li>
  <li class="<?php if(isset($active['vgold'])){echo $active['vgold'];}?>"><a href="#vgold" data-toggle="tab"><?php echo $this->lang->line('card_game5');?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane <?php if(isset($boss2)){echo $boss2;}?>" id="game">
	<?php 
	foreach($rand_games AS $rand => $gia)
	{ ?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<?php }	?>
  </div>
  <div class="tab-pane <?php if(isset($active['gate'])){echo $active['gate'];};?>" id="gate">
	<?php foreach($gate AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane <?php if(isset($active['vcoin'])){echo $active['vcoin'];};?> " id="vcoin">
	<?php foreach($vcoin AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane <?php if(isset($active['zing'])){echo $active['zing'];};?>" id="zing">
	<?php foreach($zing AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane <?php if(isset($active['oncash'])){echo $active['oncash'];};?>" id="oncash">
	<?php foreach($oncash AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane <?php if(isset($active['vgold'])){echo $active['vgold'];};?> " id="vgold">
	<?php foreach($vgold AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>

</div>
<div class="ngan"></div>

<?php if($m_first ==0) { ?>
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="<?php if(isset($boss1)){echo $boss1;}?>"><a href="#home" data-toggle="tab"><?php echo $this->lang->line('card_mobile');?></a></li>
  <li class="<?php if(isset($active['viettel'])){echo $active['viettel'];}?>"><a href="#viettel" data-toggle="tab"><?php echo $this->lang->line('card_mobile1');?></a></li>
  <li class="<?php if(isset($active['mobifone'])){echo $active['mobifone'];}?>"><a href="#mobifone" data-toggle="tab"><?php echo $this->lang->line('card_mobile2');?></a></li>
  <li  class="<?php if(isset($active['vinaphone'])){echo $active['vinaphone'];}?>"><a href="#vinaphone" data-toggle="tab"><?php echo $this->lang->line('card_mobile3');?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane <?php if(isset($boss1)){echo $boss1;}?>" id="home">
	<?php 
	foreach($rand_cards AS $rand => $gia)
	{ ?>
	<div class="col-xs-6 col-sm-3">
	
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<?php }	?>

  </div>
  <div class="tab-pane <?php if(isset($active['viettel'])){echo $active['viettel'];};?>" id="viettel">
	<?php foreach($viettel AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>

  <div class="tab-pane <?php if(isset($active['mobifone'])){echo $active['mobifone'];};?>" id="mobifone">
	<?php foreach($mobi AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia); ?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?> 
  </div> 
  <div class="tab-pane <?php if(isset($active['vinaphone'])){echo $active['vinaphone'];};?>" id="vinaphone">
	<?php foreach($vina AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<span class="card <?php echo $rand;?>" id="image_thumb_<?php echo $rand;?>" class="img-responsive"></span>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>','add')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
 
</div>
<?php } ?>

</div>