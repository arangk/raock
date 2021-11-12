<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Login
 * 로그인
 * 2020.12.16 - ARK
 */
class Login extends My_Controller
{
	public function __construct()
	{
		parent::__construct();

		/**
		 * 라이브러리를 로딩합니다
		 */
		$this->load->library(array('form_validation', 'email'));

		if (!function_exists('password_hash')) {
			$this->load->helper('password');
		}
	}

	public function index()
	{
		/**
		 * 로그인 되어 있다면
		 */
		if ($this->session->userdata('user_id')) {
			redirect(base_url('contract/list'));
		}
		$view = array();
		$view['view'] = array();

		$view['view']['layout_title'] = $this->myconfig->item('layout_title');

		$this->load->model(array('Apt_model', 'So_user_model'));

		/**
		 * 전송된 데이터의 유효성 체크
		 */
		$config = array(
			array(
				'field' => 'id',
				'label' => '아이디',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'pw',
				'label' => '비밀번호',
				'rules' => 'trim|required',
			),
		);

		$this->form_validation->set_rules($config);
		$form_validation = $this->form_validation->run();

		if ($form_validation === false) {
			$layoutconfig = array(
				'path' => 'login',
				'layout' => 'layout_login',
				'skin' => 'login',
				'layout_dir' => $this->myconfig->item('layout_default'),
				'mobile_layout_dir' => $this->myconfig->item('layout_default'),
				'skin_dir' => $this->myconfig->item('skin_default'),
				'mobile_skin_dir' => $this->myconfig->item('skin_default'),
			);
			$view['layout'] = $this->managelayout->front($layoutconfig, $this->myconfig->get_device_view_type());
			$this->data = $view;
			$this->layout = element('layout_skin_file', element('layout', $view));
			$this->view = element('view_skin_file', element('layout', $view));
		} else {
			$msg = null;
			$chk_id = $this->input->post('id');

			try {
				$user = $this->So_user_model->get_one(
					null,
					null,
					array(
						'user_id' => $chk_id,
					)
				);

				$id = element('user_id', $user);
				$pw = element('password', $user);

				// 일반 로그인
				$pw_ch = password_verify($this->input->post('pw'), $pw);
				if ($chk_id != $id) {
					throw new Exception("아이디 정보가 다릅니다.", F_SUCCESS_REJECT);
				}

				if (!$pw_ch) {
					throw new Exception("비밀번호를 다시 확인하세요.", F_SUCCESS_REJECT);
				}

				// 로그인 성공
				$save_data = array(
					'id' => element('id', $user),
					'user_id' => element('user_id', $user),
					'name' => element('name', $user),
					'level' => element('level', $user)
				);
				if(!empty(element('a_area', $user))){
					$save_data['a_area'] = element('a_area', $user);
				}
				$this->session->set_userdata($save_data);
				redirect('/');

			} catch (Exception $e) {
				$this->session->set_flashdata('errors', $e);
				$msg = $e->getMessage();
				alert($msg, '/');
			}
		}
	}
}
