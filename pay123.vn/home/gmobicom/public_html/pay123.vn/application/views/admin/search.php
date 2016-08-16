<?php $this->load->model('card_model', 'card'); ?>
<div class="page-header">    
<h1><?php echo $title;?></h1>
</div>
<form action="" method="GET">	<b style="width: 100px; display: inline-block">
Nickname: </b><input type="text" name="user_id" value="<?php if(isset($_GET['user_id'])){echo $_GET['user_id'];};?>" /> 	
Seri: </b><input type="text" name="seri" value="<?php if(isset($_GET['seri'])){echo $_GET['seri'];};?>" /> 	
Mã thẻ: </b><input type="text" name="ma" value="<?php if(isset($_GET['ma'])){echo $_GET['ma'];};?>" /> 	
<button type="submit" name="submit" value="search">	Tìm kiếm</button>
</form>
<table class="table"><tr>	
<th>ID thẻ</th>	
<th>Loại thẻ</th>	
<th>Seri thẻ</th>	
<th>Mã thẻ</th>	
<th>Ngày nhập</th>	
<th>Ngày xuất</th>	
<th>Username</th>
</tr><?php if(isset($cards) AND $cards != NULL) {foreach($cards AS $card) { ?><tr>
<td><?php echo $card['id'];?></td><td><?php echo $card['loai'];?></td>
<td><?php echo water($card['seri']);?></td>
<td><span <?php $ma = substr($card['ma'], 0, -3);if(count($this->card->timma($ma)) > 1) { echo 'style="color:red"';}?>>
<?php  echo water($card['ma']);?></span></td>
<td><?php echo date("d-m-Y H:i", $card['ngaynhap']);?></td><td><?php if($card['ngayxuat']){echo date("d-m-Y H:i", $card['ngayxuat']);};?></td>
<td><?php echo $card['username'];?></td></td> <?php } } ?>
