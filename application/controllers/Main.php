<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends My_Controller {

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
		$this->load->model(array('Info_model', 'Gallery_model', 'Comment_model'));
	}

	public function index($key)
	{
		if(empty($key)){
			show_404();
		}
		$view = array();
		$view['view'] = array();

		$view['view']['key'] = $key;

		$view['view']['layout_title'] = $this->myconfig->item('layout_title');

		//$info = $this->Info_model->get_one(null, null, array('key'=>$key));
		$info = $this->Info_model->item($key);

		if(empty($info)){
			show_404();
		}
		$where = array(
			'info_id'=>element('id', $info)
		);
		$gallery = $this->Gallery_model->lists($where, null, null);

		$view['view']['info'] = $info;
		$view['view']['gallery'] = $gallery;

		// comment
		$comment = $this->Comment_model->lists($where);
		$comment_t = $this->Comment_model->total($where);
		$total = (int)($comment_t/7);

		$view['view']['comment'] = $comment;
		$view['view']['total'] = $total<=0?1:$total;

		// 달력
		$calendar = $this->_calendar(element('w_date', $info), element('w_month', $info), element('w_year', $info));
		$view['view']['calendar'] = $calendar;

		$layoutconfig = array(
			'path' => 'main',
			'layout' => 'layout',
			'skin' => 'main',
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
	 * 달력 생성
	 * @param string $day
	 * @param string $month
	 * @param string $year
	 * @return array
	 */
	public function _calendar($day = '', $month = '', $year = '')
	{
		// 오늘 날짜
		$thisyear = date('Y'); // 4자리 연도
		$thismonth = date('n'); // 0을 포함하지 않는 월
		$today = date('j'); // 0을 포함하지 않는 일

		// $year, $month 값이 없으면 현재 날짜
		$year = $year ? $year : $thisyear;
		$month = $month ? $month : $thismonth;
		$day = $day ? $day : $today;

		if($month == 'undefined'){
			$month = $thismonth;
		}

		$prev_month = $month - 1;
		$next_month = $month + 1;
		$prev_year = $next_year = $year;
		if ($month == 1) {
			$prev_month = 12;
			$prev_year = $year - 1;
		} else if ($month == 12) {
			$next_month = 1;
			$next_year = $year + 1;
		}
		$preyear = $year - 1;
		$nextyear = $year + 1;

		$predate = date("Y-m-d", mktime(0, 0, 0, $month - 1, 1, $year));
		$nextdate = date("Y-m-d", mktime(0, 0, 0, $month + 1, 1, $year));

		// 1. 총일수 구하기
		$max_day = date('t', mktime(0, 0, 0, $month, 1, $year)); // 해당월의 마지막 날짜
		$prev_last_day = date('t', mktime(0, 0, 0, $prev_month, 1, $year));

		// 2. 시작요일 구하기
		$start_week = date("w", mktime(0, 0, 0, $month, 1, $year)); // 일요일 0, 토요일 6

		// 3. 총 몇 주인지 구하기
		$total_week = ceil(($max_day + $start_week) / 7);

		// 4. 마지막 요일 구하기
		$last_week = date('w', mktime(0, 0, 0, $month, $max_day, $year));

		$time_table = array(
			'thisyear' => $thisyear,
			'thismonth' => $thismonth,
			'today' => $today,
			'year' => $year,
			'month' => $month,
			'day' => $day,
			'prev_month' => $prev_month,
			'next_month' => $next_month,
			'preyear' => $preyear,
			'nextyear' => $nextyear,
			'predate' => $predate,
			'nextdate' => $nextdate,
			'max_day' => $max_day,
			'prev_last_day' => $prev_last_day,
			'start_week' => $start_week,
			'total_week' => $total_week,
			'last_week' => $last_week
		);

		return $time_table;
	}
}
