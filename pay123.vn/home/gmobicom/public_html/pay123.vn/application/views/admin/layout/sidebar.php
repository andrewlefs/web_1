<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

  <div class="sidebar_block">
  <h3><span class="glyphicon glyphicon-user"></span> Thành viên</h3>
  <ul>
    <li><a href="<?php echo ADMIN_URL;?>users">Danh sách thành viên</a></li>
  </ul>
  </div>
  
  <div class="sidebar_block">
  <h3><span class="glyphicon glyphicon-edit"></span> Quản lý Thẻ</h3>
  <ul>
    <li><a href="<?php echo ADMIN_URL;?>list_card"> Danh sách Thẻ</a></li>
	<li><a href="<?php echo ADMIN_URL;?>add_card"> Nhập mới Thẻ</a></li>
	<li><a href="<?php echo ADMIN_URL;?>report_card"> Báo hết Thẻ</a></li>
  </ul>
  </div>
 
  <div class="sidebar_block">
  <h3><span class="glyphicon glyphicon-edit"></span> Tin tức</h3>
  <ul>
    <li><a href="<?php echo ADMIN_URL;?>category/2">Danh sách bài viết</a></li>
	<li><a href="<?php echo ADMIN_URL;?>post_add">Thêm mới bài viết</a></li>
  </ul>
  </div>
 
  <div class="sidebar_block">
  <h3><span class="glyphicon glyphicon-edit"></span> Thống kê</h3>
  <ul>
    <li><a href="<?php echo ADMIN_URL;?>thongkengay"> Thống kê ngày</a></li>
	<li><a href="<?php echo ADMIN_URL;?>thongketuan"> Thống kê tuần</a></li>
	<li><a href="<?php echo ADMIN_URL;?>thongkethang"> Thống kê tháng</a></li>
  </ul>
  </div>
