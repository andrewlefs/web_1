<div class="col-md-9 g-home" role="main">
<ul class="nav nav-tabs mobile" id="mobileTab">
  <li class="active"><a href="" data-toggle="tab">Khuyến mại</a></li>
  <li><a href="./gioithieu">Giới thiệu</a></li>
  <li><a href="./huongdan">Hướng dẫn</a></li>
  <li><a href="./chietkhau">Chiết khấu</a></li>
</ul>


<div class="pay-info">
	<h1><?php echo $post['title'];?></h1>

<p class="post_description">
	<strong><?php echo $post['description'];?></strong>
</p>

<div class="post_content">
	<img src="<?php echo $post['image'];?>" alt="<?php echo $post['title'];?>" title="<?php echo $post['title'];?>" class="post_image"/>
	<?php echo $post['content'];?>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=604990066238674";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</div>
</div>