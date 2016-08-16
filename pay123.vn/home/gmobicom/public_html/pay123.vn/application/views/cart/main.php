<div id="cart_detail">

<script>
function itemUpdate(id, action, numbers)
	{
		if (isNaN(numbers) || numbers > 3 || numbers < 0) 
		{
			alert("Số lượng thẻ phải là một số nhỏ hơn 3");
			return false;
		}
		else
		{
			$.ajax({
				type: 'post',
				url: 'cart/callbackdetail',
				dataType: 'html',
				data: {'id':id,'action':action,'numbers':numbers,'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>'}, 
				success: function (a) {
					$('#cart_detail').html(a);
					addCart('','update');
				},
				});
		}
	} 
	
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
		});
	}
	
	function count_up(id) {
        var t = parseInt(document.getElementById("number"+id).value);
        if (t != 0) {
            if (t >= 1 && t<=2) {
                t += 1;
            }
			else
			{
				alert('Chỉ được chọn tối đa 3 thẻ');
			}
        }
        else {
            document.getElementById("number"+id).value = 1;
		}
		document.getElementById("number"+id).value = t;
		itemUpdate(id,'numbers', t);
    }
	
    function count_down(id) {
        var t = parseInt(document.getElementById("number"+id).value);
        if (t != 0) {
            if (t > 1) {
                t -= 1;
            }
            else {
                t = 1;
            }
        }
        else {
            document.getElementById("number"+id).value = 1;
        }
        document.getElementById("number"+id).value = t;
		itemUpdate(id,'numbers', t);
    }

	function checkInp()
	{
	  var x=document.forms["myForm"]["age"].value;
	  if (isNaN(x)) 
	  {
		alert("Must input numbers");
		return false;
	  }
	}
</script>
<div class="col-md-9" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab" style="border-bottom: 0">
  <li><a href="" data-toggle="tab">Thanh toán</a></li>
  <li><a href="./gioithieu">Giới thiệu</a></li>
  <li><a href="./huongdan">Hướng dẫn</a></li>
  <li><a href="./chietkhau">Chiết khấu</a></li>
</ul>
<div class="pay-info" style="padding-bottom: 0px;">
<legend><span class="glyphicon glyphicon-info-sign"> </span> Xác nhận giỏ hàng</legend>
<table class="table table-bordered">
<thead>
<tr class="active" style="background-color: #29AAE3">
	<th style="background-color: #428bca; color: #FFF;">TT</th>
	<th style="background-color: #428bca;  color: #FFF;">Loại thẻ</th>
	<th style="background-color: #428bca;  color: #FFF;">Mệnh giá</th>
	<th style="background-color: #428bca;  color: #FFF;">Số lượng</th>
	<th align="center" style="background-color: #428bca;  color: #FFF;width: 25%;">Thành tiền</th>
	<th style="background-color: #428bca; color: #FFF;">Xóa</th>
</tr>
</thead>
	<?php 
	$i = 1;
	foreach($cart AS $item)
	{ ?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo number_format($item['price']/96.600*100);?> đ</td>
			<td style="text-align: center; position: relative;">
			<input type="number" id="number<?php echo $item['id']?>" value="<?php echo $item['qty'];?>" min="1" max="3" step="1" size="3" cols="3" maxlength="1" style="width: 66px; height: 23px;" 
			onchange="itemUpdate('<?php echo $item['id']?>','numbers',this.value);" />
			<div style="display: inline-block; position: absolute; top: 8px;padding-left: 8px;">
				<span  style="cursor: pointer; display: block; height: 13px" onclick="count_up('<?php echo $item['id']?>')"><img src="http://pay123.vn/theme/images/up.png" width="15px" height="10px"/></span>
				<span style="cursor: pointer; display: block; height: 13px"  onclick="count_down('<?php echo $item['id']?>')"><img src="http://pay123.vn/theme/images/down.png"  width="15px" height="10px"/></span>
			</div>
			</td>
			<td style="width: 25%"><?php echo number_format($item['qty'] * $item['price']);?> đ</td>
			<td><span class="remove"><span class="glyphicon glyphicon-remove" style="cursor: pointer" title="Xóa" onclick="itemUpdate('<?php echo $item['id']?>','remove','0')"></span></span></td>
		</tr>
	<?php $i++;} ?>
<tr class="active">
	<td style="background: #DDD"></td>
	<td style="background: #DDD"></td>
	<td style="background: #DDD"></td>
	<td style="background: #DDD; text-align: right"><strong style="color:#FF0000">Tổng:</strong>
	<td style="background: #DDD"><span style="color:#FF0000"><?php echo number_format($this->cart->total());?> VNĐ</span></td>
	<td style="background: #DDD"></td>
</tr>
</table>


<a href="http://pay123.vn/cart/callpay" class="btn btn-danger pull-right"> Thanh toán</a>
<a class="btn btn-danger pull-right" href="<?php echo ''.$this->config->base_url().'cart/troy';?>">Xóa hết    </a>
<br><br> 

</div>
<?php if(!isset($user_id) OR $user_id <= 0) { ?>

<?php } else {?>

<!-- 
<div class="pay-info">
<fieldset>
<legend><span class="glyphicon glyphicon-info-sign"> </span> Thông tin thanh toán</legend>
<div class="row">
  <div class="col-md-3" style="text-align: right">Email mua thẻ: </div>
  <div class="col-md-6"><strong><?php echo $user['email'];?></strong></div>
</div>
<div class="row">
  <div class="col-md-3" style="text-align: right">Nội dung thanh toán: </div>
  <div class="col-md-6"><strong>Thanh toán tiền mua mã thẻ</strong></div>
</div>
<div class="row">
  <div class="col-md-3" style="text-align: right">Số tiền thanh toán: </div>
  <div class="col-md-6"><strong><?php echo number_format($this->cart->total());?> VNĐ</strong></div>
</div>
</fieldset>
</div>

<div class="pay-info">
<fieldset>

Bỏ trừ quỹ <legend><span class="glyphicon glyphicon-edit"> </span> Trừ quỹ</legend>

	
<?php /*?>	<div class="row">
		<div class="col-md-3" style="text-align: right">Bạn đang có:</div> 
		<div class="col-md-6">
			<strong><?php echo number_format($user['credit']);?>đ</strong>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3" style="text-align: right">Số tiền cần trả:</div> 
		<div class="col-md-6">
			<strong><?php $tien = $this->cart->total(); echo number_format($tien);?>đ</strong>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3" style="text-align: right">Số tiền sẽ còn:</div> 
		<div class="col-md-6">
			<strong><?php $tiencon = $user['credit'] - $this->cart->total(); echo number_format($tiencon);?>đ</strong>
		</div>
	</div><?php */?>

	
Tạm tắt để tập trung vào cái thanh toán bằng thẻ ATM bên dưới.
<?php
//Tạm tắt cái thanh toán quỹ đi đã
//$tien = $this->cart->total(); 
//$tiencon = $user['credit'] - $this->cart->total(); ?>
<?php 
//if($user['credit'] < $tien){
//	echo '<p class="alert alert-danger">Bạn không đủ tiền trong quỹ để mua thẻ. Vui lòng chọn hình thức thanh toán online bên dưới.</p>'; 
//}
//else{
//	echo '<p class="alert alert-success">Chúc mừng! Bạn có thể mua thẻ ngay bây giờ. <a class="btn btn-success" href="'.$this->config->base_url() .'cart/checkout">Thanh toán</a></p> ';
//}

?>

</fieldset>
</div>
-->	
<?php } ?>
</div>
</div>