<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo element('view_skin_url', $layout); ?>/css/makeself.css"/>

<div class="register">
	<div class="notice">
		<p class="title">
			<?=element('key', $view)=='mobile'?'모바일':'일러스트'?> 청첩장
			&nbsp;>&nbsp;
			<?=element('name', element('cate', $view))?>
		</p>
		<input type="submit" value="제작완료"/>
	</div>
	<div class="content">
		<div class="table">
			<!-- 메인 -->
			<div class="item">
				<p class="item_title">메인</p>
				<div class="item_inner">
					<span>옵션</span>
					<div>
						<select name="main_option">
							<option value="1">사진(기본옵션)</option>
							<option value="2">일러스트(선택옵션)</option>
						</select>
					</div>
				</div>
				<div class="item_inner" id="main_value">
					<span>사진선택</span>
					<div>
						<label>
							<span class="main_thumb">업로드</span>
							<input type="file" name="main_value"/>
						</label>
					</div>
					<p class="moment animate-3">※ 일러스트로 제작 할 사진을 업로드해주세요.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	(function(){
		$('select[name=main_option]').on('change', function(){
			var selected = $(this).find('option:selected').val(),
				target = $('#main_value').find('.moment');

			if(selected==1){
				target.hide();
			}else{
				target.show();
			}
		})
	})(jQuery);
</script>
