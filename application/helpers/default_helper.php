<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 기본 헬퍼
 * 2020.10.06 - ARK
 */

/**
 * 서버 연결
 */
if (!function_exists('connect_server')) {
    function connect_server($url = '', $data = '')
    {
        $CI =& get_instance();

        $ch = curl_init();

        $url .= '?access_token='. $CI->config->item('oauth_access_token');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        $tmp_result = explode('{', $response);
        $tmp_s_result = '';
        foreach ($tmp_result as $key => $value) {
            if ($key != 0) {
                $tmp_s_result .= '{' . $value;
            }
        }
        $result = json_decode($tmp_s_result, true);

        return $result;

        curl_close($ch);
    }
}

// 발송 
if (!function_exists('connect_sms')){
    function connect_sms($url = '')
    {
        $CI =& get_instance();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        $tmp_result = explode('{', $response);
        $tmp_s_result = '';
        foreach ($tmp_result as $key => $value) {
            if ($key != 0) {
                $tmp_s_result .= '{' . $value;
            }
        }
        $result = json_decode($tmp_s_result, true);
        return $result;

        curl_close($ch);
    }
}

/**
 * 휴대폰 하이픈 설정
 */
if (!function_exists('phone_format')){
    function phone_format($phone, $hyphen = 1)
    {
        if ($hyphen) {
            $preg = "$1-$2-$3";
        } else {
            $preg = "$1$2$3";
        }

        $phone = preg_replace("/[^0-9]/", "", $phone);

        if (substr($phone,0,2)=='02'){
            $pattern = "/([0-9]{2})([0-9]{3,4})([0-9]{4})$/";
        }else if (strlen($phone)=='8' && (substr($phone,0,2)=='15' || substr($phone,0,2)=='16' || substr($phone,0,2)=='18')){
            // 지능망 번호이면
            $pattern = "/([0-9]{4})([0-9]{4})$/";
            $preg = "$1-$2";
        }else {
            $pattern = "/([0-9]{3})([0-9]{3,4})([0-9]{4})$/";
        }

        $phone = preg_replace(
            $pattern,
            $preg,
            $phone
        );

        return $phone;
    }
}

/**
 * query string 유무 판단
 * create 2020.10.13 - ARK
 */
if(!function_exists('chk_qry'))
{
    function mk_qry($url)
    {
        $CI =& get_instance();

        $qry = $CI->input->server('QUERY_STRING');
        $chk_str = explode('=', $url);
        $changed = false;

        if($qry){
            $tmp_qry = explode('&', $qry);

            foreach ($tmp_qry as $key=>$val){
                if(explode('=', $val)[0]== $chk_str[0]) {
                    // 기존 쿼리스트링 존재
                    $tmp_qry[$key] = $chk_str[0].'='.$chk_str[1];
                    $changed = true;
                }
            }

            if($changed == false){
                // 기존 쿼리스트링 존재하지 않음
                $url = $qry.'&'.$url;
            }else{
                $url = implode('&', $tmp_qry);
            }
        }

        return '?'.$url;
    }
}

/**
 * 권역명 조회
 * create 2021.02.17 - ARK
 */
if(!function_exists('get_name_area'))
{
	function get_name_area($id)
	{
		$CI =& get_instance();

		$CI->load->model('Life_in_model');

		$result = $CI->Life_in_model->get_one($id, 'so_name');

		if($result){
			return element('so_name', $result);
		}else{
			return false;
		}
	}
}
