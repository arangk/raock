<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends My_Controller
{
    public function __construct()
    {
        parent::__construct();

        /**
         * 로그인 하지 않은 사용자는 로그아웃 페이지 접근 금지
         */
        $this->allow = array('login');
    }

    public function index()
    {
        if ($this->session->userdata('user_id')) {
            $this->session->sess_destroy();
            redirect(base_url());
        } else {
            alert('잘못된 접근 방법입니다');
        }
    }
}
