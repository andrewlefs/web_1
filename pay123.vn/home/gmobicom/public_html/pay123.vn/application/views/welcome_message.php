<script>

function addCart(id)
	{
		$.ajax({
			type: 'post',
			url: 'index.php',
			dataType: 'html',
			data: {id:id}, 
			success: function (html) {
				$('#cart_list_item').html(html);
			},
			complete: function () {
				var image_thumb = '#image_thumb_' +id;

				var image = $(image_thumb).offset();
				var cart  = $('#cart').offset();

				$(image_thumb).before('<img src="' + $(image_thumb).attr('src') + '" id="temp" style="position: absolute; top:0px; left:0px;" />');

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
<div class="col-md-9 g-home" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="#home" data-toggle="tab"><?php echo $this->lang->line('card_mobile');?></a></li>
  <li><a href="#mobile1" data-toggle="tab"><?php echo $this->lang->line('card_mobile1');?></a></li>
  <li><a href="#mobile2" data-toggle="tab"><?php echo $this->lang->line('card_mobile2');?></a></li>
  <li><a href="#mobile3" data-toggle="tab"><?php echo $this->lang->line('card_mobile3');?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="home">
	<?php 
	foreach($rand_cards AS $rand => $gia)
	{ ?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"   src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<?php }	?>

  </div>
  <div class="tab-pane" id="mobile1">
	<?php foreach($viettel AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane" id="mobile2">
	<?php foreach($mobi AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia); ?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?> 
  </div> 
  <div class="tab-pane" id="mobile3">
	<?php foreach($vina AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
</div>

<script>
  $(function () {
    $('#gameTab a:first').tab('show')
  });

</script>

<div class="ngan"></div>
<ul class="nav nav-tabs game" id="gameTab">
  <li class="active"><a href="#game" data-toggle="tab"><?php echo $this->lang->line('card_game');?></a></li>
  <li><a href="#game1" data-toggle="tab"><?php echo $this->lang->line('card_game1');?></a></li>
  <li><a href="#game2" data-toggle="tab"><?php echo $this->lang->line('card_game2');?></a></li>
  <li><a href="#game3" data-toggle="tab"><?php echo $this->lang->line('card_game3');?></a></li>
  <li><a href="#game4" data-toggle="tab"><?php echo $this->lang->line('card_game4');?></a></li>
  <li><a href="#game5" data-toggle="tab"><?php echo $this->lang->line('card_game5');?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane in active" id="game">
	<?php 
	foreach($rand_games AS $rand => $gia)
	{ ?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"   src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<?php }	?>
  </div>
  <div class="tab-pane " id="game1">
	<?php foreach($gate AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane " id="game2">
	<?php foreach($vcoin AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane " id="game3">
	<?php foreach($zing AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane" id="game4">
	<?php foreach($oncash AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
  <div class="tab-pane " id="game5">
	<?php foreach($vgold AS $rand => $gia)
	{?>
	<div class="col-xs-6 col-sm-3">
		<img id="image_thumb_<?php echo $rand;?>" class="img-responsive"  src="theme/card/<?php echo $rand;?>.png" alt="the <?php echo $rand;?>" title="<?php echo $this->lang->line('card_mobile'); echo " ".$rand."";?>"/>
		<div class="price"><?php echo number_format($gia) ;?>đ</div>
		<button type="button" class="btn btn-danger" onclick="addCart('<?php echo $rand;?>')"><?php echo $this->lang->line('title_buy');?></button>
	</div>
	<? } ?>
  </div>
</div>

<script>
  $(function () {
    $('#gameTab a:first').tab('show')
  })
</script>

</div>