<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stat hook class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

class _Log
{

    function checkPermission()
    {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');
        if(isset($CI->allow) && (is_array($CI->allow) === false OR in_array($CI->router->method, $CI->allow) === false))
        {
            if (!$CI->session->userdata('user_id')) // 로그인 여부를 세션을 이용해 체크한다.
            {
                $url = 'login';
                /*if($CI->input->get('go_url')){
                    $url .= '?go_url='.$CI->input->get('go_url');
                }*/
                $CI->session->set_userdata(array(
                    'redirect_url'  => $_SERVER['REDIRECT_URL']
                ));

                redirect($url); // 로그인창으로 강제 이동
            }
        }
    }
}
