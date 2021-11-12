<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Comment_model extends My_Model
{

    /**
     * 테이블명
     */
    public $_table = 'comment';

    /**
     * 사용되는 테이블의 프라이머리키
     */
    public $primary_key = 'id'; // 사용되는 테이블의 프라이머리키


    function __construct()
    {
        parent::__construct();
    }

	/**
	 * 목록 조회
	 * @param string $where
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function lists($where = '', $limit = 7, $offset = 0)
	{

		$this->db->from($this->_table);

		if ($where) {
			$this->db->where($where);
		}

		if ($limit) {
			$this->db->limit($limit, $offset);
		}

		$qry = $this->db->get();

		/*var_dump($this->db->last_query());*/

		$result = $qry->result_array();
		return $result;
	}

	/**
	 * 전체 데이터 수
	 * @param string $where
	 * @return mixed
	 */
	public function total($where=''){
		$this->db->from($this->_table);

		if($where){
			$this->db->where($where);
		}

		$result = $this->db->count_all_results();

		return $result;
	}

}
