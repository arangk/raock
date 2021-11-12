<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo element('view_skin_url', $layout); ?>/css/makeself.css"/>

<div class="lists">
	<div class="notice">
		<p class="title">아름다운 날 소중한 분들께 마음을 전하는 특별한 방법♡</p>
		<ul class="sub_title">
			<li>#일러스트청첩장</li>
			<li>#모바일청첩장</li>
			<li>#카카오페이</li>
			<li>#셀프제작</li>
			<li>#스튜디오라옥</li>
		</ul>
	</div>
	<ul class="content">
	<?php foreach (element('lists', $view) as $key=>$list){
		$price = str_replace(',','',element('price', $list));
		$discount = $price * (1-element('discount', $list)/100);
		?>
		<li>
			<div class="content_wrapper">
				<div class="thumb">
					<?php if(!empty(element('thumbnail', $list))){ ?>
						<img src="<?=base_url('/assets/thumb/'.element('thumbnail', $list))?>"/>
					<?php }else{ ?>
						<img src="<?=base_url('/assets/thumb/default.jpg')?>"/>
					<?php }?>
					<div class="hover animate-5">
						<div class="hover_wrapper">
							<p>네이버에서 구매 후 제작하기를 진행해주세요 :)</p>
							<div class="btn_panel">
								<a>구매하기</a>
								<a href="<?=base_url('makeself/register/'.element('key', $view).'/'.element('id', $list))?>">제작하기</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="content_wrapper">
				<div class="info">
					<div class="price">
						<span class="normal"><?= number_format($price) ?></span>
						<span class="discount"><?= number_format($discount) ?>&nbsp;원</span>
					</div>
					<div class="name"><?= element('name', $list) ?></div>
				</div>
			</div>
		</li>
	<?php } ?>
	</ul>
</div>

<script type="text/javascript">
	(function(){

	})(jQuery);
</script>
