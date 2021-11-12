<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Managelayout class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 레이아웃을 관리하는 class 입니다.
 */
class Managelayout extends CI_Controller
{

	private $css = array();
	private $js = array();

	function __construct()
	{

	}


	/**
	 * 관리자페이지 레이아웃관리합니다
	 */
	function admin($config = array(), $device_view_type = '')
	{
		$data = array();
		$CI = & get_instance();
		$tmp = dir(APPPATH . 'config');
		$menu_files = array();
		while ($entry = $tmp->read()) {
			if (!preg_match('/^admin_menu_([0-9]{3}).*\.php$/', $entry, $m))
				continue;

			$entry = substr($entry , 0, -4);
			$menu_files[] = $entry;
		}
		if ($menu_files) {
			asort($menu_files);
		}
		$data['admin_page_menu'] = array();
		foreach($menu_files as $file){
			$CI->load->config($file);
			$res = config_item('admin_page_menu');
			$data['admin_page_menu'] += config_item('admin_page_menu');
		}


        if (uri_string() !== config_item('uri_segment_admin')) {
            list($data['menu_dir0'], $data['menu_dir1'], $data['menu_dir2']) = explode('/', uri_string());
        } else {
            $data['menu_dir0'] = '';
            $data['menu_dir1'] = '';
            $data['menu_dir2'] = '';
        }

        /**
         * 메뉴 이름 가져오기 - 2020.02.17 ARK
         */
        foreach ($data['admin_page_menu'] as $key=>$val){
            if($data['menu_dir1'] == $key){
                $data['menu_dir1_name'] = element(0, element('__config', $val));
                foreach (element('menu', $val) as $s_key=>$s_val){
                    if($data['menu_dir2'] == $s_key){
                        $data['menu_dir2_name'] = element(0, $s_val);
                    }
                }
            }
        }

        if ($CI->uri->segment(1) === config_item('uri_segment_admin') && $CI->uri->segment(2) === 'preview') {
            return $this->preview($config);
        }

        $layoutdirname = $device_view_type === 'mobile' ? element('mobile_layout_dir', $config) : element('layout_dir', $config);
        if (empty($layoutdirname)) {
            $layoutdirname = 'basic';
        }
        $layout = 'admin/_layout/' . $layoutdirname;
        $data['layout_skin_path'] = $layout;
        $data['layout_skin_url'] = base_url( VIEW_DIR . $data['layout_skin_path']);

        $default_layout = '_layout/' . $layoutdirname;
        $data['layout_default_skin_path'] = $default_layout;
        $data['layout_default_skin_url'] = base_url( VIEW_DIR . $data['layout_default_skin_path']);

        $layout .= '/';
        if (element('layout', $config)) {
            $layout .= element('layout', $config);
        }
        $data['layout_skin_file'] = $layout;

        $skindir = $device_view_type === 'mobile' ? element('mobile_skin_dir', $config) : element('skin_dir', $config);
        if (empty($skindir)) {
            $skindir = 'basic';
        }
        $skin = '';
        if (element('path', $config)) {
            $skin .= element('path', $config) . '/';
        }
        $skin .= $skindir;
        $data['view_skin_path'] = $skin;
        $data['view_skin_url'] = base_url( VIEW_DIR . $data['view_skin_path']);
        $skin .= '/';
        if (element('skin', $config)) {
            $skin .= element('skin', $config);
        }
        $data['view_skin_file'] = $skin;

        return $data;
	}

	/**
	 * 레이아웃관리합니다
	 */
	function front($config = array(), $device_view_type = '')
	{
		$data = array();
		$CI = & get_instance();

        $tmp = dir(APPPATH . 'config');
        $menu_files = array();
        while ($entry = $tmp->read()) {
            if (!preg_match('/^my_menu_([0-9]{3}).*\.php$/', $entry, $m))
                continue;

            $entry = substr($entry , 0, -4);
            $menu_files[] = $entry;
        }
        if ($menu_files) {
            asort($menu_files);
        }
        $data['my_page_menu'] = array();
        foreach($menu_files as $file){
            $CI->load->config($file);
            $res = config_item('my_page_menu');
            $data['my_page_menu'] += config_item('my_page_menu');
        }
        /*if (uri_string() !== config_item('uri_segment_admin')) {
            list($data['menu_dir1'], $data['menu_dir2']) = explode('/', uri_string());
        } else {
            $data['menu_dir1'] = '';
            $data['menu_dir2'] = '';
        }*/
        list($data['menu_dir1'], $data['menu_dir2']) = explode('/', uri_string());
        /**
         * 메뉴 이름 가져오기 - 2020.02.17 ARK
         */
        foreach ($data['my_page_menu'] as $key=>$val){
            if($data['menu_dir1'] == $key){
                $data['menu_dir1_name'] = element(0, element('__config', $val));
                foreach (element('menu', $val) as $s_key=>$s_val){
                    if($data['menu_dir2'] == $s_key){
                        $data['menu_dir2_name'] = element(0, $s_val);
                    }
                }
            }
        }

		if ($CI->uri->segment(1) === config_item('uri_segment_admin') && $CI->uri->segment(2) === 'preview') {
			return $this->preview($config);
		}

		$layoutdirname = $device_view_type === 'mobile' ? element('mobile_layout_dir', $config) : element('layout_dir', $config);
		if (empty($layoutdirname)) {
			$layoutdirname = 'basic';
		}
		$layout = '_layout/' . $layoutdirname;
		$data['layout_skin_path'] = $layout;
		$data['layout_skin_url'] = base_url( VIEW_DIR . $data['layout_skin_path']);
		$layout .= '/';
		if (element('layout', $config)) {
			$layout .= element('layout', $config);
		}
		$data['layout_skin_file'] = $layout;

		$skindir = $device_view_type === 'mobile' ? element('mobile_skin_dir', $config) : element('skin_dir', $config);
		if (empty($skindir)) {
			$skindir = 'basic';
		}
		$skin = '';
		if (element('path', $config)) {
			$skin .= element('path', $config) . '/';
		}
		$skin .= $skindir;
		$data['view_skin_path'] = $skin;
		$data['view_skin_url'] = base_url( VIEW_DIR . $data['view_skin_path']);
		$skin .= '/';
		if (element('skin', $config)) {
			$skin .= element('skin', $config);
		}
		$data['view_skin_file'] = $skin;

		return $data;
	}

	/**
	 * 프리뷰 페이지를 위한 레이아웃관리입니다
	 */
	function preview($config = array())
	{

		$data = array();
		$CI = & get_instance();

		if ($CI->input->get('is_mobile')) {
			$CI->cbconfig->set_device_view_type('mobile');
		} else {
			$CI->cbconfig->set_device_view_type('pc');
		}

		$device_view_type = $CI->cbconfig->get_device_view_type();
		$layoutdirname = $CI->input->get('layout');
		if (empty($layoutdirname)) {
			$layoutdirname = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_layout_default') : $CI->cbconfig->item('layout_default');
		}
		if (empty($layoutdirname)) {
			$layoutdirname = 'basic';
		}
		$layout = '_layout/' . $layoutdirname;
		$data['layout_skin_path'] = $layout;
		$data['layout_skin_url'] = base_url( VIEW_DIR . $data['layout_skin_path']);
		$layout .= '/';
		if (element('layout', $config)) {
			$layout .= element('layout', $config);
		}
		$data['layout_skin_file'] = $layout;

		$skindir = $CI->input->get('skin');
		if (empty($skindir)) {
			$skindir = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_skin_default') : $CI->cbconfig->item('skin_default');
		}
		if (empty($skindir)) {
			$skindir = 'basic';
		}
		$skin = '';
		if (element('path', $config)) {
			$skin .= element('path', $config) . '/';
		}
		$skin .= $skindir;
		$data['view_skin_path'] = $skin;
		$data['view_skin_url'] = base_url( VIEW_DIR . $data['view_skin_path']);
		$skin .= '/';
		if (element('skin', $config)) {
			$skin .= element('skin', $config);
		}
		$data['view_skin_file'] = $skin;

		$user_sidebar = $CI->input->get('sidebar');
		if ($user_sidebar === '1') {
			$data['use_sidebar'] = '1';
		} elseif ($user_sidebar === '2') {
			$data['use_sidebar'] = '';
		} else {
			$user_sidebar = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_sidebar_default') : $CI->cbconfig->item('sidebar_default');
			if ($user_sidebar === '1') {
				$data['use_sidebar'] = '1';
			} elseif ($user_sidebar === '2') {
				$data['use_sidebar'] = '';
			} else {
				$data['use_sidebar'] = '';
			}
		}

		// 메뉴관리
		$CI->load->model('Menu_model');
		$data['menu'] = $CI->Menu_model->get_all_menu($device_view_type);

		return $data;
	}


	/**
	 * css를 추가합니다
	 */
	function add_css($file = '')
	{
		if (empty($file)) {
			return;
		}
		array_push($this->css, $file);
	}


	/**
	 * js를 추가합니다
	 */
	function add_js($file = '')
	{
		if (empty($file)) {
			return;
		}
		array_push($this->js, $file);
	}


	/**
	 * 추가된 css를 리턴합니다
	 */
	function display_css()
	{
		$return = '';
		$_css = $this->css;
		if ($_css) {
			foreach ($_css as $val) {
				$return .= '<link rel="stylesheet" type="text/css" href="' . $val . '" />';
			}
		}
		return $return;
	}


	/**
	 * 추가된 js를 리턴합니다
	 */
	function display_js()
	{
		$return = '';
		$_js = $this->js;
		if ($_js) {
			foreach ($_js as $val) {
				$return .= '<script type="text/javascript" src="' . $val . '"></script>';
			}
		}
		return $return;
	}
}
