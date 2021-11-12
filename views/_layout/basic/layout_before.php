<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=11">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>배달아울렛</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css"
          href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/default.css"/>

    <!-- 폰트 -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/earlyaccess/nanumgothic.css"/>
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Nanum+Gothic|Nanum+Myeongjo|Noto+Sans+KR|Noto+Serif+KR|Yeon+Sung&display=swap" rel="stylesheet">

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
    <div class="nav-header">
        <div class="left-zone">
            <?php
            $title_url = element(0, explode('/', uri_string()));
            ?>
            <a href="<?= base_url() ?>">
                <i class="fas fa-pizza-slice"></i>
                <?= element('layout_title', $view) ?>
            </a>
        </div>

        <div class="right-zone">
            <a class="animate-3"><i class="far fa-bell"></i></a>
            <a class="animate-3<?=element('menu_dir1', $layout)=='configuration'?' active':'';?>" href="<?=base_url('configuration')?>"><i class="fas fa-cogs"></i></a>

            <div class="profile">
                <span class="profile_name"><?=element('mem_nickname', $member)?></span>
                <!--<span class="profile_img">최</span>-->
            </div>

            <!--<a class="animate-3"><i class="fas fa-bars"></i></a>-->
        </div>
    </div>
    <!-- start nav -->
    <nav class="nav-default">
        <ul class="nav">
            <?php
            foreach (element('my_page_menu', $layout) as $__akey => $__aval) {
                /*if ($__akey == 'charge') {
                    if (!$this->session->userdata('level')) {
                        continue;
                    }
                }*/
                ?>
                <li class="nav-first-level nav_menuname_<?php echo $__akey; ?> <?php echo (element('menu_dir1', $layout) === $__akey) ? 'active' : ''; ?> ">
                    <a data-toggle="menu_collapse"
                       href="<?= element('menu', $__aval) ? '#collapse' . $__akey : base_url($__akey) ?>/<?= element('shop', $view) ? element('id', element('shop', $view)[0]) : '' ?>"
                       aria-expanded="false" aria-controls="menu_collapse<?php echo $__akey; ?>"
                       onClick="changemenu('<?php echo $__akey; ?>');"
                       class="<?php echo (element('menu_dir1', $layout) === $__akey) ? '' : 'collapsed'; ?>">
                        <i class="fa <?php echo element(1, element('__config', $__aval)); ?>"></i>
                        <span class="nav-label"><?php echo element(0, element('__config', $__aval)); ?></span>
                        <?php if (element('menu', $__aval)) { ?>
                            <i class="fa <?php echo (element('menu_dir1', $layout) === $__akey) ? 'fa-angle-down' : 'fa-angle-left'; ?> menu-arrow-icon <?php echo $__akey; ?>"></i>
                        <?php } ?>
                    </a>
                    <?php if (element('menu', $__aval)) { ?>
                        <ul class="nav nav-second-level menu_collapse collapse <?php echo (element('menu_dir1', $layout) === $__akey) ? 'in' : ''; ?>"
                            id="menu_collapse<?php echo $__akey; ?>" <?php echo (element('menu_dir1', $layout) === $__akey) ? '' : 'style="height:0;"'; ?>>
                            <?php
                            foreach (element('menu', $__aval) as $menukey => $menuvalue) {
                                if (element(2, $menuvalue) === 'hide') {
                                    continue;
                                }
                                // 수신번호 일괄등록(엑셀업로드) 와 그룹관리의 경우 리셀러에게만 오픈 - 상점은 권한 없음
                                if ($menukey == 'uploads' || $menukey == 'group') {
                                    if (!$this->session->userdata('level')) {
                                        continue;
                                    }
                                }
                                ?>
                                <li <?php echo (element('menu_dir2', $layout) === $menukey) ? 'class="active"' : ''; ?>>
                                    <a href="<?= base_url($__akey . '/' . $menukey) ?>/<?= element('reseller', $view) ? element('id', element('reseller', $view)[0]) : '' ?>"><?= element(0, $menuvalue) ?></a>
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
    <script type="text/javascript">
        //<![CDATA[
        $('#menu_collapse<?php echo element('menu_dir1', $layout); ?>').collapse('show');

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
    <?php if (isset($yield)) echo $yield; ?>
    <!-- 본문 끝 -->
</div>
</body>
</html>