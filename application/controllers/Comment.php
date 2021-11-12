<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends My_Controller {

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
        $this->load->model(array('Comment_model'));
    }

	public function index()
	{
		if($this->input->post()){
			$insert_data = array(
				'info_id' => $this->input->post('info_id'),
				'name' => $this->input->post('name'),
				'comment' => $this->input->post('comment')
			);
			$result = $this->Comment_model->insert($insert_data);
			if(!$result){
				$msg = "남기기 도중 오류가 발생하였습니다. 관리자에게 문의하세요.";
			}else{
				$msg = "덧글 남기기가 완료되었습니다.";
			}
		}else{
			$msg = "잘못된 접근 방식입니다.";
		}
		alert($msg, $_SERVER['HTTP_REFERER'].'#sub');
	}
}
