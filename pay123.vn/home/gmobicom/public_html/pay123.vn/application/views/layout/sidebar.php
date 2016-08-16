<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	  <div class="list-group">
		<h2><a href="<?php echo $this->config->base_url();?>?tab=mobile" class="list-group-item active"> <?php echo $card_mobile;?></a></h2>
		<h3><a href="<?php echo $this->config->base_url();?>?tab=viettel" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'viettel'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_mobile1;?></a></h3>
		<h3><a href="<?php echo $this->config->base_url();?>?tab=mobifone" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'mobifone'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_mobile2;?></a></h3>
		<h3><a href="<?php echo $this->config->base_url();?>?tab=vinaphone" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'vinaphone'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_mobile3;?></a></h3>
	  </div>
	  <div class="list-group">
		<h2><a href="<?php echo $this->config->base_url();?>?tab=game" class="list-group-item active"><?php echo $card_game;?></a></h2>
		<h3><a href="<?php echo $this->config->base_url();?>?tab=gate" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'gate'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_game1;?></a></h3>
		<h3><a href="<?php echo $this->config->base_url();?>?tab=vcoin" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'vcoin'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_game2;?></a></h3>
		<h3><a href="<?php echo $this->config->base_url();?>?tab=zing" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'zing'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_game3;?></a></h3>
       <h3> <a href="<?php echo $this->config->base_url();?>?tab=oncash" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'oncash'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_game4;?></a></h3>
       <h3> <a href="<?php echo $this->config->base_url();?>?tab=vgold" class="list-group-item <?php if(isset($_GET['tab']) AND $_GET['tab'] == 'vgold'){echo 'selected';};?>"><img src="<?php echo $this->config->base_url();?>theme/images/arrow-left.png"/></span> <?php echo $card_game5;?></a></h3>
	  </div>
	  <div class="list-group" id="cart">
		<h2><a href="#" class="list-group-item active"><?php echo $shop_gio;?></a></h2>
		<div class="list-group-item">
		
			<p class="cart_list_item" id="cart_list_item" style="padding: 0"><?php //echo $shop_rong;?>
			<?php $this->load->view('layout/cart'); ?>
				
			</p>
			
		</div>
	  </div>
	  
	<div class="list-group" id="cart">
		<h2><a href="#" class="list-group-item active">Facebook</a></h2>
		<div class="list-group-item" style="padding: 0">
		<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Ffacebook.com%2Fpay123.vn&amp;width=215&amp;height=200&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=588719434510274" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:215px; height:200px;" allowTransparency="true"></iframe>
	  </div>
	  </div>
</div>


