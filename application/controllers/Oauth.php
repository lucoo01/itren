<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oauth extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->helper('url'); // 导入URL辅助类
		$this->load->model("user_model");
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	/**
	 * 显示登录界面
	 * @return [type] [description]
	 */
	public function login(){

		$this->load->view('templates/header');
		$this->load->view('login');
		$this->load->view('templates/footer');
	}

	/**
	 * 验证用户名,密码
	 * @return [type] [description]
	 */
	public function check_login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$this->user_model->check_login($username,$password);
	}

}
