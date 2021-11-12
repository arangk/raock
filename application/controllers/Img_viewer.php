<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Img_viewer extends My_Controller {

    /**
     * 이미지 뷰어
     * create 2020.07.03 ARK
     */
	public function index()
	{
		$this->load->view('img');
	}
}
