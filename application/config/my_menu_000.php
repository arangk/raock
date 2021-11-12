<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['my_page_menu']['situation'] =
    array(
        '__config'          => array('통합 현황', 'icon-default'),
        'menu'              => array(
            'contract' => array('계약진행현황',''),
            'statistics' => array('통계현황',''),
        ),
    );
