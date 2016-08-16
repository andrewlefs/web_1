<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ''.$this->config->base_url().'theme/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">
	  <link href="<?php echo ''.$this->config->base_url().'theme/css/configuration.css';?>" rel="stylesheet">
    <link href="<?php echo ''.$this->config->base_url().'theme/css/global.css';?>" rel="stylesheet">
	

    <!-- Custom styles for this template -->
    <style>body{padding-top: 50px;}</style>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo ADMIN_URL;?>"><span style="margin-left: -10px"><span class="glyphicon glyphicon-list"></span> BẢNG ĐIỀU KHIỂN&nbsp;</span></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo ADMIN_URL;?>">Cài đặt chung</a></li>
            <li><a href="<?php echo ADMIN_URL;?>users">Thành viên</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Thống kê <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo ADMIN_URL;?>thongkengay">Thống kê theo ngày</a></li>
                <li><a href="<?php echo ADMIN_URL;?>thongketuan">Thống kê theo tuần</a></li>
                <li><a href="<?php echo ADMIN_URL;?>thongkethang">Thống kê theo tháng</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo $this->config->base_url();?>" target="_blank"><span class="glyphicon glyphicon-home"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">