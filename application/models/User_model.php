<?php 
/**
 * 用户通用模型
 */
class User_model extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->load->database(); // 连接到数据库
		$this->load->helper("Json");
	}

	/**
	 * 验证用户登录信息
	 * @return [type] [description]
	 */
	public function check_login($username,$password){
		
		if(empty($username) || empty($username)){
			ajax_back(404,"用户名,密码不能为空!");
		}

		$query = $this->db->get_where("web_member_userinfo",array("username"=>$username),1);
		$userinfo = $this->res_getone($query);
		
		if(empty($userinfo)){
			ajax_back(404,"找不到该用户,立即注册?");
		}

		// 验证密码
		

		// 登录操作
		
		echo "欢迎您,".$username;

	}

	/**
	 * 从结果中获取一个结果
	 * @return [type] [description]
	 */
	public function res_getone($query,$index = 0){

		if($query === NULL) {
			return NULL;
		}

		$res = $query->result_array();
		if(is_array($res) && isset($res[$index])){
			return $res[$index];
		}else{
			return $res;
		}

	}

	/**
	 * 从结果中获取结果
	 * @return [type] [description]
	 */
	public function res_get($query){

		if($query === NULL) {
			return NULL;
		}

		return $query->result_array();
	}

}
 ?>