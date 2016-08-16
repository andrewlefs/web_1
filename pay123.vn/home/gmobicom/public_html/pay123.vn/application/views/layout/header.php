<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title; ?></title>
	<link href="../theme/images/favicon.ico" type="image/ico" rel="shortcut icon" />
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
	<meta charset="utf-8"/>
    <!-- Bootstrap -->
    <link href="/theme/css/bootstrap.min.css" rel="stylesheet">
	<link href="/theme/css/extra.css" rel="stylesheet">
	<link href="/theme/css/non-responsive.css" rel="stylesheet">
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/theme/js/bootstrap.min.js"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	
  </head>
  <body>
<?php 
$home = 'selected';
if($this->uri->segment(1) != NULL)
{
	$home ='';
}
$selected[$this->uri->segment(1)] = 'selected';
$selected[$this->uri->segment(2)] = 'selected';
?>


  <div class="bao container">
	<div class="header">
		<div class="container">
		<div class="row">
			<div class="col-md-6">
				<a href="/" title="<?php echo $title;?>"><img class="logo" src="/theme/images/logo.png" title="<?php echo $title;?>" alt="<?php echo $title;?>"/></a>
			</div>
			<div class="col-md-6 header_news">
				<ul>
				<?php $posts = $this->news_model->get_all_post(2,3);
				foreach ($posts AS $post)
				{ ?>
					<li><h3><a href="<?php echo ''.$this->config->base_url().'post/'.$this->news_model->friendly_url($post['title']).'-'.$post['id'].'';?>"><?php echo $post['title'];?></a></h3></li>
				<?php } ?>
				</ul>
			</div>
		</div>
		</div>
    <nav class="navbar navbar-default" role="navigation">
	<div class="container">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<h1><a class="navbar-brand" href="/"><?php echo "Trang chủ"; ?></a></h1>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
		  <li><a href="<?php echo ''.$this->config->base_url().'cart/history';?>" class="<?php if(isset($selected['history']) AND $selected['history'] !== NULL)  { echo $selected['history'];};?>"><?php echo "Lịch sử giao dịch"; ?></a></li>
		  <li><a href="../huongdan" class="<?php if(isset($selected['huongdan']) AND $selected['huongdan'] !== NULL)  { echo $selected['huongdan'];};?>"><?php echo "Hướng dẫn"; ?></a></li>
		  <li><a href="../chietkhau" class="<?php if(isset($selected['chietkhau']) AND $selected['chietkhau'] !== NULL)  { echo $selected['chietkhau'];};?>"><?php echo "Chiết khấu"; ?></a></li>
		  <li><a href="../lienhe" class="<?php if(isset($selected['lienhe']) AND $selected['lienhe'] !== NULL)  { echo $selected['lienhe'];};?>" ><?php echo "Liên hệ"; ?></a></li>
		  <!--<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="nofollow"><?php echo $menu_taikhoan; ?><b class="caret"></b></a>
			<ul class="dropdown-menu">
			  <li><a href="#"  rel="nofollow"><?php //echo $menu_dangki; ?></a></li>
			  <li><a href="#"  rel="nofollow"><?php //echo $menu_dangnhap; ?></a></li>
			  <li class="divider"></li>
			  <li><a href="#"  rel="nofollow"><?php //echo $menu_quenpass; ?></a></li>

			</ul>
		  </li> */-->
		</ul>
		<!-- <form class="navbar-form navbar-left" role="search">
		  <div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>-->

		<ul class="nav navbar-nav navbar-right">
		<?php  if(isset($user_id) AND $user_id > 0) { ?>
			 <li><a >Xin chào! <?php echo $username;?></a></li>
		  <li class="dropdown">
			<a href="#" data-toggle="dropdown"><img src="http://pay123.vn/theme/images/tt.png"></a>
			<ul class="dropdown-menu">
			  <li><a href="<?php echo ''.$this->config->base_url().'auth/change_password';?>">Đổi mật khẩu</a></li>
			  <li class="divider"></li>
			  <li><a href="<?php echo ''.$this->config->base_url().'auth/logout';?>" >Thoát</a></li>
			</ul>
		  </li>
		<?php } else {?>
			<li><a href="<?php echo ''.$this->config->base_url().'auth';?>"><?php echo $menu_dangnhap; ?></a></li>
			<li><a href="<?php echo ''.$this->config->base_url().'auth/register';?>"><?php echo $menu_dangki; ?></a></li>
		<?php } ?>
		</ul>
	  </div><!-- /.navbar-collapse -->
	</div>
	</nav>
	<div style="float:right; line-height: 32px; height: 35px;padding-right: 5px; margin-top: -3px;">
		<a href="tel:0983128783" class="s_hotline"><img src="/theme/images/hotlineonline.jpg" /> 0983.128.783    </a>
		<a href="ymsgr:sendim?hotro_pay123" class="s_yahoo"><img src="/theme/images/yahooonline.png" /> Hỗ trợ Yahoo    </a>
		<a href="skype:sambk03" class="s_skype"><img src="/theme/images/skypeonline.png" /> Hỗ trợ Skype    </a>
	</div>
	</div>
	<div class="container">