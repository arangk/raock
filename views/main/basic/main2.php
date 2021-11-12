<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo element('view_skin_url', $layout); ?>/css/main.css"/>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

<?php
$info = element('info', $view);
$gallery = element('gallery', $view);

setlocale(LC_ALL, "ko_KR.utf-8");
$wedding_day = strtotime(element('w_year', $info) . '-' . element('w_month', $info) . '-' . element('w_date', $info));
$wedding_time = strtotime(element('w_time', $info));

$time_table = element('calendar', $view);
$day = 1;
$n_day = 0;
?>
<span class="tt"></span>
<div id="content">
	<div class="li" id="main1">
		<p class="invitation">- · Wedding Invitation · -</p>
		<p class="title"><?= element('invitation_txt', $info) ?></p>
		<p class="sub_title"><?= element('invitation_sub_txt', $info) ?></p>
		<p class="date_title"><?= strftime('%Y년 %m월 %d일 %A', $wedding_day) ?> <?= strftime('%p %I:%M', $wedding_time) ?></p>

		<img class="illust" src="<?= base_url('uploads/' . element('illust', $info)) ?>"/>
		<label class="left">
			<span>신랑</span>
			<span><?= mb_substr(element('g_name', $info), 1) ?></span>
		</label>
		<label class="right">
			<span>신부</span>
			<span><?= mb_substr(element('b_name', $info), 1) ?></span>
		</label>
	</div>
	<div class="li" id="main2">
		<div class="intro">
			<p class="title">
				<span>Invite</span>
				<span>초대합니다</span>
			</p>
			<div>
				<p>사랑이란 믿음 하나로</p>
				<p>서로를 아끼고 의지하며 예쁘게 살겠습니다.</p>
				<p>내가 아닌 우리로 빛날 오늘,</p>
				<p>귀한 걸음으로 저희의 시작을 축복해주세요.</p>
				<p>감사합니다.</p>
			</div>
			<div>
				<p>
					<span><?=element('g_parents', $info)?></span>
					<span><?=element('g_name', $info)?></span>
					<span><a class="animate-3" href="tel:<?=phone_format(element('g_hp', $info), 0)?>"><i class="fas fa-phone-alt"></i></a></span>
				</p>
				<p>
					<span><?=element('b_parents', $info)?></span>
					<span><?=element('b_name', $info)?></span>
					<span><a class="animate-3" href="tel:<?=phone_format(element('b_hp', $info), 0)?>"><i class="fas fa-phone-alt"></i></a></span>
				</p>
			</div>
		</div>
		<div class="gratefulness">
			<p class="title">
				<span>Gratefulness</span>
				<span>마음 전하는 곳</span>
			</p>
			<div>
				<p>
					<span>신랑</span>
					<span><?=element('g_name', $info)?></span>
					<span><?=element('g_account', $info)?></span>
				</p>
				<p>
					<span>신부</span>
					<span><?=element('b_name', $info)?></span>
					<span><?=element('b_account', $info)?></span>
				</p>
			</div>
		</div>
	</div>
	<div class="li" id="main3">
		<div class="gallery">
			<p class="title">
				<span>Gallery</span>
				<span>사진 갤러리</span>
			</p>
			<div id="primary-slider" class="splide">
				<div class="splide__track">
					<ul class="splide__list">
					<?php foreach ($gallery as $key=>$val){ ?>
						<li class="splide__slide">
							<img class="<?=element('direction', $val)==1?'height':'width'?>" src="<?=base_url('uploads/'.element('name',$val))?>"
						</li>
					<?php } ?>
					</ul>
				</div>
			</div>
			<div id="secondary-slider" class="splide">
				<div class="splide__track">
					<ul class="splide__list js-thumbnails">
						<?php foreach ($gallery as $key=>$val){ ?>
							<li class="splide__slide" role="buttom">
								<img class="<?=element('direction', $val)==1?'height':'width'?>" src="<?=base_url('uploads/'.element('name',$val))?>"
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="li" id="main4">
		<div class="location">
			<p class="title">
				<span>Location</span>
				<span>오시는길</span>
			</p>
			<div id="map"></div>

			<div class="map_info">
				<p><?=element('w_addr2', $info)?> <?=element('w_addr3', $info)?></p>
				<p><?=element('w_addr1', $info)?></p>
				<p><?=element('w_tel', $info)?></p>
			</div>
			<ul>
				<li><a id="navi" onclick="navi();">카카오내비</a></li>
			</ul>
		</div>
	</div>
	<div class="li" id="main5">
		<div class="calendar">
			<p><?= element('month', $time_table) ?>월 <?= element('day', $time_table) ?>일</p>
			<table>
				<thead>
				<tr>
					<td>일</td>
					<td>월</td>
					<td>화</td>
					<td>수</td>
					<td>목</td>
					<td>금</td>
					<td>토</td>
				</tr>
				</thead>
				<tbody>
				<?php for ($i = 1; $i <= element('total_week', $time_table); $i++) { ?>
					<tr>
						<?php for ($j = 0; $j < 7; $j++) { ?>
							<td class="<?= $day == element('day', $time_table) ? ' click_date' : '' ?>">
								<!-- 날짜 출력 -->
								<?php if (!(($i == 1 && $j < element('start_week', $time_table)) || ($i == element('total_week', $time_table) && $j > element('last_week', $time_table)))) { ?>
									<span class="date"><?= $day < 10 ? "0" . $day : $day ?></span>
									<?php if ($day == element('day', $time_table)) { ?>
										<span class="w_date">♡Wedding Date♡</span>
										<img src="<?= base_url('uploads/sample/highlight.png') ?>">
									<?php }
									$day++;
									if ($i == element('total_week', $time_table) && $j == element('last_week', $time_table)) {
										$day = 1;
									}
								} ?>
							</td>
						<?php } ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=b22cad0e95643f0dc67e28da701f54d1&libraries=services,clusterer,drawing"></script>

<script type="text/javascript">
	Kakao.init('b22cad0e95643f0dc67e28da701f54d1');
	Kakao.isInitialized();

	var scroll_event = false;
	var scroll_idx = 1;

	(function () {
		var secondarySlider = new Splide( '#secondary-slider', {
			fixedWidth  : 100,
			height      : 60,
			gap         : 10,
			cover       : true,
			rewind: true,
			isNavigation: false,
			pagination : false,
			arrows     : false,
			focus       : 'center',
			breakpoints : {
				'600': {
					fixedWidth: 66,
					height    : 40,
				}
			},
		} ).mount();

		var primarySlider = new Splide( '#primary-slider', {
			type       : 'fade',
			heightRatio: 1,
			pagination : false,
			arrows     : true,
			cover      : true,
		} ); // do not call mount() here.

		primarySlider.sync( secondarySlider ).mount();

		$( '.js-thumbnails li' ).click(function(){
			var idx = $(this).attr('id').slice(-1);
			secondarySlider.go(idx-1);
		});

		var mapContainer = document.getElementById('map'), // 지도를 표시할 div
				mapOption = {
					center: new kakao.maps.LatLng(36.6260368, 127.4694802), // 지도의 중심좌표
					level: 3 // 지도의 확대 레벨
				};

		// 지도를 생성합니다
		var map = new kakao.maps.Map(mapContainer, mapOption);

		// 주소-좌표 변환 객체를 생성합니다
		var geocoder = new kakao.maps.services.Geocoder();

		// 주소로 좌표를 검색합니다
		geocoder.addressSearch('<?=element('w_addr1', $info)?>', function(result, status) {

			// 정상적으로 검색이 완료됐으면
			if (status === kakao.maps.services.Status.OK) {

				var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

				// 결과값으로 받은 위치를 마커로 표시합니다
				var marker = new kakao.maps.Marker({
					map: map,
					position: coords
				});

				// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
				map.setCenter(coords);

				// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
				var zoomControl = new kakao.maps.ZoomControl();
				map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);
			}
		});

		$("html").on("scroll touchmove mousewheel ", function (e) {
			var target = $('#content').scrollTop();
			var standard = $(window).height();

			//console.log(target);
			//console.log(standard);

			if(target>(standard/9)){
				//$('.illust').animate({opacity:0}, 300);
			}else if(target<=(standard/4)){
				//$('.illust').animate({opacity:1}, 300);
			}
		});
	})(jQuery);

	function navi() {
		Kakao.Navi.start({
			name: '<?=element('w_addr2', $info)?>',
			x: Number('<?=element('w_lng', $info)?>'),
			y: Number('<?=element('w_lat', $info)?>'),
		});
	}
</script>
