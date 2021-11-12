<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MakeSelf extends My_Controller
{

	public function __construct()
	{
		parent::__construct();

		/**
		 * 라이브러리를 로딩합니다
		 */
		$this->load->library(array('form_validation', 'email'));

		/**
		 * 모델로딩
		 */
		$this->load->model(array('Info_model', 'Gallery_model', 'Comment_model', 'Cate_model'));
	}

	/**
	 * 상품 목록
	 * @param string $key	모바일청첩장/일러스트청첩장 구분
	 */
	public function index($key='mobile')
	{
		$view = array();
		$view['view'] = array();

		$view['view']['layout_title'] = $this->myconfig->item('layout_title');

		$where = array('gubun'=>$key);
		$lists = $this->Cate_model->lists($where, null, null);

		$view['view']['key'] = $key;
		$view['view']['lists'] = $lists;

		$layoutconfig = array(
			'path' => 'makeself',
			'layout' => 'layout',
			'skin' => 'index',
			'layout_dir' => $this->myconfig->item('layout_default'),
			'mobile_layout_dir' => $this->myconfig->item('layout_default'),
			'skin_dir' => $this->myconfig->item('skin_default'),
			'mobile_skin_dir' => $this->myconfig->item('skin_default'),
		);
		$view['layout'] = $this->managelayout->front($layoutconfig, $this->myconfig->get_device_view_type());

		$this->data = $view;
		$this->layout = element('layout_skin_file', element('layout', $view));
		$this->view = element('view_skin_file', element('layout', $view));
	}

	/**
	 * 상품 제작
	 * @param string $key	모바일청첩장/일러스트청첩장 구분
	 * @param string $item
	 */
	public function register($key='mobile', $item)
	{
		if(empty($item) || $item=='$1'){
			show_404();
		}

		$view = array();
		$view['view'] = array();

		$view['view']['layout_title'] = $this->myconfig->item('layout_title');
		$view['view']['key'] = $key;

		$cate = $this->Cate_model->get_one($item);

		$view['view']['cate'] = $cate;

		$layoutconfig = array(
			'path' => 'makeself',
			'layout' => 'layout',
			'skin' => 'register',
			'layout_dir' => $this->myconfig->item('layout_default'),
			'mobile_layout_dir' => $this->myconfig->item('layout_default'),
			'skin_dir' => $this->myconfig->item('skin_default'),
			'mobile_skin_dir' => $this->myconfig->item('skin_default'),
		);
		$view['layout'] = $this->managelayout->front($layoutconfig, $this->myconfig->get_device_view_type());

		$this->data = $view;
		$this->layout = element('layout_skin_file', element('layout', $view));
		$this->view = element('view_skin_file', element('layout', $view));
	}
}
