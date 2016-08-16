<div class="col-md-9" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="" data-toggle="tab">Giao dịch</a></li>
  <li><a href="../gioithieu">Giới thiệu</a></li>
  <li><a href="../huongdan">Hướng dẫn</a></li>
  <li><a href="../chietkhau">Chiết khấu</a></li>
</ul>
<div class="pay-info">
<?php if(!isset($user_id) OR $user_id <= 0) { ?>
<p><strong>Bạn cần <?php echo anchor('auth/login', 'Đăng nhập','Đăng nhập');?> mới có thể xem được lịch sử giao dịch của mình.</strong></p>
<?php }

elseif(!isset($history) OR $history == NULL)
{
	echo 'Chưa có giao dịch nào';
}
else{ ?>

<table class="table table-striped">
<thead>
<tr class="active" style="background-color: #428bca">
	<th>TT</th>
	<th>Loại thẻ</th>
	<th>Mệnh giá</th>
	<th>Seri</th>
	<th>Mã thẻ</th>
	<th>Thời gian</th>
</tr>

</thead>
	<?php 
	$i = 1;
	foreach($history AS $item)
	{ ?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo ucfirst($item['loai']);?></td>
			<td><?php echo number_format($item['gia']/96.600*100);?> đ</td>
			<td><?php echo water($item['seri']);?> </td>
			<td><?php echo water($item['ma']);?> </td>
			<td><?php echo date("H:ia d/m", $item['ngayxuat']);?>
		</tr>
	<?php $i++;} ?>
</table>
<?php } ?>
</div> 
</div> 