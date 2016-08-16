<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="page-header">
<h1><?php echo $title;?></h1>
</div>
	
<strong>Sắp xếp: </strong>

<a href="<?php echo $this->config->base_url();echo $this->uri->slash_segment(1);echo $this->uri->slash_segment(2);?>"  class="btn btn-default">Mặc định</a>

<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
<a href="<?php echo $this->config->base_url();echo $this->uri->slash_segment(1);echo $this->uri->slash_segment(2);?>gia" class="btn btn-primary">Đơn giá</a>

<!-- Indicates a successful or positive action -->
<a href="<?php echo $this->config->base_url();echo $this->uri->slash_segment(1);echo $this->uri->slash_segment(2);?>count" class="btn btn-success">Số lượng</a>

<!-- Contextual button for informational alert messages -->
<a href="<?php echo $this->config->base_url();echo $this->uri->slash_segment(1);echo $this->uri->slash_segment(2);?>doanhthu" class="btn btn-info">Doanh thu</a>

<br><br>
<table class="table table-bordered">
<tr>
	<th>Loại thẻ</th>
	<th>Đơn giá</th>
	<th>Số lượng</th> 
	<th>Doanh thu</th>
</td>
<?php foreach ($cards AS $card)
{ ?>
<tr>
	<td><?php echo ucfirst($card['loai']);?></td>
	<td><?php echo number_format($card['gia']);?>đ</td>
	<td><?php echo number_format($card['count']);?></td>
	<td><?php echo number_format($card['doanhthu']);?>đ</td>
</tr>	
<?php } ?>
</table>