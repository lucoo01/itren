<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('ajax_back'))
{
	/**
	 * ajax 请求标准化返回
	 *
	 * @param	int $status_code
	 * @param	string $message
	 * @param	string $callback 回调函数
	 * @return	mixed	depends on what the array contains
	 */
	function ajax_back($status_code = 404, $message = " ajax_back error !", $callback='')
	{
		$norm_data = array(
			'status_code'	=> $status_code,
			'mesage'		=> $message,
			'callback'		=> $callback,
		);
		echo json_encode($norm_data);
		exit();
	}
}