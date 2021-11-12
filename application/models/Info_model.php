<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Info_model extends My_Model
{

    /**
     * 테이블명
     */
    public $_table = 'info';

    /**
     * 사용되는 테이블의 프라이머리키
     */
    public $primary_key = 'id'; // 사용되는 테이블의 프라이머리키


    function __construct()
    {
        parent::__construct();
    }

    public function item($key)
	{
		$this->db->select(
			'id,
			code,
			w_year,
			w_month,
			w_date,
			w_time,
			w_zipcode,
			w_addr1,
			w_addr2,
			w_addr3,
			w_addr4,
			w_lat,
			w_lng,
			w_tel,
			b_name,
			g_name,
			CAST(AES_DECRYPT(UNHEX(b_parents),\''.KKEY.'\') AS CHAR(1000)) as b_parents,
			CAST(AES_DECRYPT(UNHEX(g_parents),\''.KKEY.'\') AS CHAR(1000)) as g_parents,
			CAST(AES_DECRYPT(UNHEX(b_hp),\''.KKEY.'\') AS CHAR(1000)) as b_hp,
			CAST(AES_DECRYPT(UNHEX(g_hp),\''.KKEY.'\') AS CHAR(1000)) as g_hp,
			CAST(AES_DECRYPT(UNHEX(b_account),\''.KKEY.'\') AS CHAR(1000)) as b_account,
			CAST(AES_DECRYPT(UNHEX(g_account),\''.KKEY.'\') AS CHAR(1000)) as g_account,
			invitation_txt,
			invitation_sub_txt,
			illust,
			illu_order,
			reg_date'
		);
		$this->db->from($this->_table);

		$this->db->where(array('code'=>$key));

		$qry = $this->db->get();

		/*var_dump($this->db->last_query());*/

		$result = $qry->row_array();
		return $result;
	}

}
