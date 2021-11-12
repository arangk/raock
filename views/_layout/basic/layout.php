<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=element('layout_title', $view)?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/images/basic/favicon.ico')?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/default.css"/>

    <link rel="stylesheet" type="text/css"
          href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/ui-lightness/jquery-ui.css"/>

    <?php echo $this->managelayout->display_css(); ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript">
        // 자바스크립트에서 사용하는 전역변수 선언
        var cb_url = "<?php echo trim(site_url(), '/'); ?>";
        var cb_cookie_domain = "<?php echo config_item('cookie_domain'); ?>";
        var cb_charset = "<?php echo config_item('charset'); ?>";
        var cb_time_ymd = "<?php echo cdate('Y-m-d'); ?>";
        var cb_time_ymdhis = "<?php echo cdate('Y-m-d H:i:s'); ?>";
        var is_member = "";
        var cb_device_type = "<?php echo $this->myconfig->get_device_type() === 'mobile' ? 'mobile' : 'desktop' ?>";
        var cb_csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/basic.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/js.cookie.js'); ?>"></script>
    <script src="https://kit.fontawesome.com/cde80c3577.js" crossorigin="anonymous"></script>
    <?php echo $this->managelayout->display_js(); ?>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<div class="header-left"><a class="home" href="/">스튜디오<span>라옥</span></a></div>
		<div class="header-right">
			<ul>
				<li id="mobile"><a href="/">모바일 청첩장</a></li>
				<li id="illust"><a href="<?=base_url('makeself/illust')?>">일러스트 청첩장</a></li>
			</ul>
		</div>
	</div>
    <!-- 본문 시작 -->
    <?php if (isset($yield)) echo $yield; ?>
    <!-- 본문 끝 -->
    <script type="text/javascript">
		(function(){
			$('.header-right').find('ul').find('li#<?=element('key', $view)?>').addClass('active');
		})(jQuery);
        /*var scroll_event = false;
        var scroll_idx = 1;

        (function () {
            $('html').on('mousewheel', function(e){
                //e.preventDefault();
                e.stopPropagation();

                var wheel = e.originalEvent.wheelDelta;
                //var h = $('.content .li').height()+1;
				var h = $('.content').find('#main'+scroll_idx).height();
				var position = $('.content').find('#main'+scroll_idx).position().top;

				//h+=position;

				console.log(h);
				console.log(scroll_event);
				console.log(wheel);
				var scroll_top = h*scroll_idx;

                if(wheel>0 && scroll_event == false && scroll_idx >= 2){
                    scroll_event = true;
                    scroll_idx--;

                    $('.content').stop().animate(                        {
                            scrollTop:scroll_top
                        },
                        {
                            duration:500,
                            complete: function(){
                                scroll_event = false;
                            }
                        });
                }else if(wheel<0 && scroll_event==false && scroll_idx < 4) {
                    scroll_event = true;
                    scroll_idx++;

					$('.content').stop().animate(
                        {
                            scrollTop:scroll_top
                        },
                        {
                            duration:500,
                            complete: function(){
                                scroll_event = false;
                            }
                        });
                }
            });
        })(jQuery);*/
    </script>
</div>
</body>
</html>
