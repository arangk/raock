<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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

    <link rel="stylesheet" type="text/css"
          href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/ui-lightness/jquery-ui.css"/>

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
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/basic.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/js.cookie.js'); ?>"></script>
    <script src="https://kit.fontawesome.com/cde80c3577.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php if($this->input->get('img')){ ?>
        <img src="<?=$this->config->item('s3_server'). $this->input->get('img') ?>"/>
    <?php }?>
</body>
</html>