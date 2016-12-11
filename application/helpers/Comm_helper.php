<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('get_client_ip'))
{

	/**
     * 获取当前访问客户端IP地址
     * @return string
     */
    function get_client_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        }
        return $ip;
    }
}


if( ! function_exists('dstrlen'))
{
	/**
     * 获取字符长度
     *
     */
    function dstrlen($str, $charset = 'utf-8') {
        if(strtolower($charset) != 'utf-8') {
        return strlen($str);
        }
        $count = 0;
        for($i = 0; $i < strlen($str); $i++){
        $value = ord($str[$i]);
        if($value > 127) {
            $count++;
            if($value >= 192 && $value <= 223) $i++;
            elseif($value >= 224 && $value <= 239) $i = $i + 2;
            elseif($value >= 240 && $value <= 247) $i = $i + 3;
        }
        $count++;
        }
        return $count;
    }
}


if( ! function_exists(''))
{
	/**
     * 生成指定长度的随机字符串
     * @param {String} $len 随机字符串的长度
     *
     * @return {String} 生成的随机字符串
     *
     */
    function randomStr($len, $rand = 0) {
        $randomStr = date("ymd");
        $randomStr = substr($randomStr, 1);
        for ($i = 0; $i < $len - 5; $i++) {
	        switch ($rand) {
	            case 0 :
	                $randomStr .= chr(mt_rand(48, 57)); // 0-9
	                break;
	            case 1 :
	                $randomStr .= chr(mt_rand(65, 90)); // a-z
	                break;
	            case 2 :
	                $randomStr .= chr(mt_rand(97, 122)); // A-Z
	                break;
	            default:
	                break;
	        }
        }
        return $randomStr;
    }
}


