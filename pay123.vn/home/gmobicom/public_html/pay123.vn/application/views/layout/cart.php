
<!--Nếu có nhiều hơn 5 sản phẩm thì hiện cả nút thanh toán ở trên và dưới cùng cho người dùng tiện nhìn-->
<?php  if(count($this->cart->contents()) > 5)
{ ?>
	
<?php };
foreach ($this->cart->contents() as $items)
{
	echo '<span class="card_item" id="cart_item_'.$items['id'].'"><span class="card_name"><span class="glyphicon glyphicon-check"></span> ';
	echo ucfirst($items['id']);
	echo '</span><strong class="cart_number"> ';
	echo $items['qty'];
	echo '</strong> thẻ.</span><br>'; 
}?>
<?php  if(count($this->cart->contents()) > 0)
{ ?>
<span class="extra_center">
<?php /*
<a class="btn btn-danger" href="<?php echo ''.$this->config->base_url().'cart/troy';?>">Xóa hết</a>
*/ ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" style="margin-top: 10px;" href="<?php echo ''.$this->config->base_url().'cart';?>">Thanh toán</a></span>
<?php }
else
{
	echo 'Giỏ hàng đang trống';
}
?>