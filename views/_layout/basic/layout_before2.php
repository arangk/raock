<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AptKeeper</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/basic/aptkeeper.ico') ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="//cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/default.css"/>

    <link rel="stylesheet" type="text/css"
          href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/ui-lightness/jquery-ui.css"/>

    <?php echo $this->managelayout->display_css(); ?>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.concat.min.js"></script>
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

<div class="layout_header">
    <?php
    $title_url = element(0, explode('/', uri_string()));
    ?>
    <div class="left-zone">
        <a class="logo" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/images/basic/logo_big.png') ?>"/>
        </a>
    </div>
    <div class="right-zone">
		<p id="img"><img src="<?= base_url('assets/images/basic/header_profile.png') ?>"></p>
		<p id="name"><?= $this->session->userdata('name') ?>님 <span>로그인 되었습니다.</span></p>
		<p id="my"><a href="<?=base_url('my')?>">내정보</a></p>
		<p id="logout"><a href="<?= base_url('logout') ?>">로그아웃</a></p>
    </div>
</div>

<div class="wrapper">
    <!-- start nav -->
    <div class="left">
        <nav class="nav-default">
            <ul class="nav">
                <li></li>
                <?php
                // var_dump(element('my_page_menu',$layout));
                foreach (element('my_page_menu', $layout) as $__akey => $__aval) {
                    if ($__akey == 'account' || $__akey == 'situation') {
                        if ($this->session->userdata('level')>3) {
                            continue;
                        }
                    }
					if ($__akey == 'area'|| $__akey == 'apt' || $__akey == 'service' || $__akey == 'system_notice' || $__akey == 'smartpass') {
						if ($this->session->userdata('level')>1) {
							continue;
						}
					}
                    ?>
                    <li class="nav-first-level nav_menuname_<?php echo $__akey; ?> <?php echo (element('menu_dir1', $layout) === $__akey) ? 'active' : ''; ?> ">
                        <a data-toggle="menu_collapse"
                           href="<?= element('menu', $__aval) ? '#collapse' . $__akey : base_url($__akey) ?>"
						   aria-expanded="false" aria-controls="menu_collapse<?php echo $__akey; ?>"
						   onClick="changemenu('<?php echo $__akey; ?>');"
						   class="<?php echo (element('menu_dir1', $layout) === $__akey) ? '' : 'collapsed'; ?>">
                            <span class="nav-label"><?php echo element(0, element('__config', $__aval)); ?></span>
                        </a>
                        <?php if (element('menu', $__aval)) { ?>
                            <ul class="nav nav-second-level menu_collapse collapse <?php echo (element('menu_dir1', $layout) === $__akey) ? 'in' : ''; ?>"
                                id="menu_collapse<?php echo $__akey; ?>" <?php echo (element('menu_dir1', $layout) === $__akey) ? '' : 'style="height:0;"'; ?>>
                                <?php
                                foreach (element('menu', $__aval) as $menukey => $menuvalue) {
                                    if (element(2, $menuvalue) === 'hide' || ($menukey === 'download' && $this->session->userdata('a_area') > 1)) {
                                        continue;
                                    }
                                    ?>
                                    <li <?php echo (element('menu_dir2', $layout) === $menukey) ? 'class="active"' : ''; ?>
                                            data-md2="<?=element('menu_dir2', $layout)?>"
                                            data-mk="<?=$menukey?>">
                                        <a href="<?= base_url($__akey . '/' . $menukey) ?>"><?= element(0, $menuvalue) ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        <?php } ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </div>

    <script type="text/javascript">
        //<![CDATA[
        <?php if(element('menu_dir1', $layout) != 'vote/2/1'){ ?>
        $('#menu_collapse<?php echo element('menu_dir1', $layout); ?>').collapse('show');
        <?php } ?>

        function changemenu(menukey) {
            if ($('#menu_collapse' + menukey).parent().hasClass('active')) {
                close_admin_menu();
            } else {
                open_admin_menu(menukey);
            }
        }

        function close_admin_menu() {
            $('.menu_collapse').collapse('hide');
            $('.nav-first-level').removeClass('active');
            $('.menu-arrow-icon').removeClass('fa-angle-down').addClass('fa-angle-left');
        }

        function open_admin_menu(menukey) {
            close_admin_menu();
            $('.nav-first-level.nav_menuname_' + menukey).addClass('active');
            $('.menu-arrow-icon.' + menukey).removeClass('fa-angle-left').addClass('fa-angle-down');
            $('#menu_collapse' + menukey).collapse('toggle');
        }

        //]]>
    </script>
    <!-- end nav -->

    <!-- 본문 시작 -->
    <div class="content_wrapper contract_wrapper">
    <?php if (isset($yield)) echo $yield; ?>
    <!-- 본문 끝 -->
    </div>

    <div class="progress_panel">
        <div>
            <span></span>
            <p>데이터 처리중입니다.</p>
            <p>잠시만 기다려주세요.</p>
        </div>
    </div>
</div>
</body>
</html>
