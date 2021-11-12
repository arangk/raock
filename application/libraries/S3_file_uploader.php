<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', 0);

define('S3_KEY', 'AKIA2H25GA7RG5L5UIGO');
define('S3_SECRET_KEY', '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');
define('BUCKET', 'aptkeeper-userfiles-mobilehub-180956973');
include_once('aws/aws-autoloader.php');

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

/**
 * S3_file_uploader class
 * 2020.02.26 - ARK
 */
class S3_file_uploader extends CI_Controller
{
    function __construct()
    {

    }

    /**
     * 파일(||이미지) 업로드
     * @param string $file_url
     * @param string $s3_path
     * @param string $file_type
     * @return \Aws\Result(bool)
     */
    function s3_upload_file($file_url = '', $s3_path = '', $file_type = '')
    {
        $param = Array(
            'region' => 'ap-northeast-2',
            'version' => 'latest',
            'credentials' => array(
                'key' => S3_KEY,
                'secret' => S3_SECRET_KEY,
            )
        );
        $s3 = new Aws\S3\S3Client($param);

        $put_data = array(
            'ACL' => 'public-read',
            'SourceFile' => $file_url,
            'Bucket' => BUCKET,
            'Key' => $s3_path,
            'ContentType' => $file_type
        );

        $result = $s3->putObject($put_data);

        return $result;
    }

    /**
     * 파일(||이미지) 삭제
     * @param string $s3_path
     * @return \Aws\Result
     */
    function s3_delete_file($s3_path=''){
        $param = Array(
            'region' => 'ap-northeast-2',
            'version' => 'latest',
            'credentials' => array(
                'key' => S3_KEY,
                'secret' => S3_SECRET_KEY,
            )
        );
        $s3 = new Aws\S3\S3Client($param);

        $put_data = array(
            'Bucket' => BUCKET,
            'Key' => $s3_path,
        );

        $result = $s3->deleteObject($put_data);

        return $result;
    }

    /**
     * 파일명 생성
     * @param $file_ext 파일 확장자
     * @return string
     */
    function get_file_name($file_ext=''){
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz".date('Ymdhsi');
        $str = str_shuffle($str);
        $str = substr($str, 0 , 8);

        return substr(date('Ymdhsi'), 2, 7).$str.'.'.$file_ext;
    }
}
