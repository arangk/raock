<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', 0);

define('SERVER_KEY', 'AAAAtktNeRE:APA91bF0dq59Gyxe3L4PXMGnDSeJYRxphMD20bQdvQpl47qq3XV2kg7gP7tS7r9y1CpW7xyeVOtX16NrpZg-_QoH8VsPPAzIpD5BI8XcSYDHBwz8kfoN91hiuOFIw2IA5gA7pwNKnvVm');
//define('SERVER_KEY', 'AIzaSyDggV49ayL8LGrjAVmYEdh5x3ni3u13s3g');

// apns
define('APNS_KEYFILE', 'AuthKey_542F5FL7TD.p8');
define('APNS_KEYID', '542F5FL7TD');
define('APNS_TEAMID', '4B6PZPD2C5');
define('APNS_TOPIC', 'kr.sit.APTKeeper');


/**
 * Google Firebase push
 * create 2020.08.18 - ARK
 * update apns push 2021.03.22 - ARK
 */
class Push_token extends CI_Controller
{
    function __construct(){ }

    /**
     * 푸시 보내기
     * @param $token
     * @param $msg
     * @return bool|string
     */
    function send_notification($token, $msg)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        if(gettype($token) == 'string')
        {
            $fields = array(
                'to' => $token,
                'data' => $msg
            );
        } else {
            $fields = array(
                'registration_ids' => $token,
                'data' => $msg
            );
        }
        
        $key = SERVER_KEY;
        $headers = array(
            'Authorization:key='.$key,
            'Content-Type:application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        return $result;
    }

    function send_apns($tokens, $alert, $data, $gubun='')
    {
        $url = "https://api.development.push.apple.com";
		//$url = "https://api.push.apple.com";

		//$message = '{"aps":{"alert":"%s","sound":"default"}, "data":%s}';
        if($gubun == 12){
            $message = '{"aps":{"alert":%s,"badge":0,"sound":"alarm.aiff", "mutable-content": 1}, "push_data":%s}';
        } else {
            $message = '{"aps":{"alert":%s,"badge":0,"sound":"alarm.aiff"}, "push_data":%s}';    
        }
        
       // $message = '{"aps":{"alert":"dasdas","badge":0,"sound":"default","category":"CustomSamplePush","mutable-content":"1"}}';

        $message = sprintf($message, json_encode($alert, JSON_UNESCAPED_UNICODE), json_encode($data, JSON_UNESCAPED_UNICODE));

        $key = openssl_pkey_get_private('file://'.APNS_KEYFILE);
        $header = ['alg' => 'ES256', 'kid' => APNS_KEYID];
        $claims = ['iss' => APNS_TEAMID, 'iat' => time()];
        $header_encoded = $this->base64($header);
        $claims_encoded = $this->base64($claims); 

        $signature = '';
        openssl_sign($header_encoded . '.' . $claims_encoded, $signature, $key, 'sha256');
        $jwt = $header_encoded . '.' . $claims_encoded . '.' . base64_encode($signature);

		// only needed for PHP prior to 5.5.24
        if (!defined('CURL_HTTP_VERSION_2_0')) {
            define('CURL_HTTP_VERSION_2_0', 3);
        }

        $http2ch = curl_init();

        $error = array();

        for ($i = 0; $i < count($tokens); $i++) {
            $options = array(
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
                CURLOPT_URL => "$url/3/device/$tokens[$i]",
                CURLOPT_PORT => 443,
                CURLOPT_HTTPHEADER => array(
                    "apns-topic:".APNS_TOPIC,
                    "authorization: bearer $jwt"
                ),
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => $message,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HEADER => 1
            );
            curl_setopt_array($http2ch, $options);

            $result = curl_exec($http2ch);
            if ($result === FALSE) {
                throw new Exception("Curl failed: " . curl_error($http2ch));
            }

            $status = curl_getinfo($http2ch, CURLINFO_HTTP_CODE);
            if($status!=200){
				// 오류 나면
                array_push($error, $result);
            }
        }
        $final = array(
            'result' => F_SUCCESS
        );
        if(!empty($error)){
            $final = array(
                'result' => F_SUCCESS_REJECT,
                'error' => $error
            );
        }
        return $final;
    }

    function send_t_apns($tokens, $alert, $data, $gubun = '')
    {
        //$url = "https://api.development.push.apple.com";
        $url = "https://api.push.apple.com";

        //$message = '{"aps":{"alert":"%s","sound":"default"}, "data":%s}';
        if($gubun == 12){
            $message = '{"aps":{"alert":%s,"badge":0,"sound":"alarm.aiff", "mutable-content": 1}, "push_data":%s}';
        } else {
            $message = '{"aps":{"alert":%s,"badge":0,"sound":"alarm.aiff"}, "push_data":%s}';    
        }
    // $message = '{"aps":{"alert":"dasdas","badge":0,"sound":"default","category":"CustomSamplePush","mutable-content":"1"}}';

        $message = sprintf($message, json_encode($alert, JSON_UNESCAPED_UNICODE), json_encode($data, JSON_UNESCAPED_UNICODE));

        $key = openssl_pkey_get_private('file://'.APNS_KEYFILE);
        $header = ['alg' => 'ES256', 'kid' => APNS_KEYID];
        $claims = ['iss' => APNS_TEAMID, 'iat' => time()];
        $header_encoded = $this->base64($header);
        $claims_encoded = $this->base64($claims);

        $signature = '';
        openssl_sign($header_encoded . '.' . $claims_encoded, $signature, $key, 'sha256');
        $jwt = $header_encoded . '.' . $claims_encoded . '.' . base64_encode($signature);

        // only needed for PHP prior to 5.5.24
        if (!defined('CURL_HTTP_VERSION_2_0')) {
            define('CURL_HTTP_VERSION_2_0', 3);
        }

        $http2ch = curl_init();

        $error = array();

        for ($i = 0; $i < count($tokens); $i++) {
            $options = array(
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
                CURLOPT_URL => "$url/3/device/$tokens[$i]",
                CURLOPT_PORT => 443,
                CURLOPT_HTTPHEADER => array(
                    "apns-topic:".APNS_TOPIC,
                    "authorization: bearer $jwt"
                ),
                CURLOPT_POST => TRUE,
                CURLOPT_POSTFIELDS => $message,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HEADER => 1
            );
            curl_setopt_array($http2ch, $options);

            $result = curl_exec($http2ch);
            if ($result === FALSE) {
                throw new Exception("Curl failed: " . curl_error($http2ch));
            }

            $status = curl_getinfo($http2ch, CURLINFO_HTTP_CODE);
            if($status!=200){
                // 오류 나면
                array_push($error, $result);
            }
        }
        $final = array(
            'result' => F_SUCCESS
        );
        if(!empty($error)){
            $final = array(
                'result' => F_SUCCESS_REJECT,
                'error' => $error
            );
        }
        return $final;
    }

    function base64($data) {
        return rtrim(strtr(base64_encode(json_encode($data)), '+/', '-_'), '=');
    }
}
