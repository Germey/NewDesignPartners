<?php
/*
	名称：注册控制器
	作者：崔庆才
	时间：2015/5/25
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	
	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		$this->load->model("reg_model","reg");

	}

	/* 入口 */
	public function index() {

		$this->loadHeader();
		$this->loadRegister();
		$this->loadFooter();

	}

	/* 加载头部 */
	private function loadHeader() {

		$this->load->view('header');

	}

	/* 加载尾部 */
	private function loadFooter() {

		$this->load->view('footer');

	}

	/* 加载注册页面 */
	private function loadRegister()	{
		$this->load->view('register/register');
	}

	/* 获取验证码 */
	public function getCode(){
		require_once(APPPATH."third_party/code.class.php");
		$code=new Code(80, 30, 4);
		$code->showImage();   //输出到页面中供 注册或登录使用
		$_SESSION["checkcode"]=$code->getCheckCode();  //将验证码保存到服务器中
	} 

	/* 判断验证码是否正确 */
	public function codeCheck(){
		$code = $_POST['checkcode'];
		$sessionCode = $_SESSION["checkcode"];
		/* 不区分大小写比较验证码 */
		if(strcasecmp($code,$sessionCode)==0){
			echo 1;
		}else{
			echo 0;
		}
	}


	/* 注册 */
	public function register() {
		
		//获取四个内容
		$name = htmlspecialchars($this->input->post("name"), ENT_QUOTES);
		$email = htmlspecialchars($this->input->post("email"), ENT_QUOTES);
		$phone = htmlspecialchars($this->input->post("phone"), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post("password"), ENT_QUOTES);
		//赋值到一个数组中
		$data['name'] = $name;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['password'] = $password;
		//加载设计师模型
		$this->load->model("des_model","des");
		$emailResult= $this->des->getByEmail($email);
		$phoneResult = $this->des->getByPhone($phone);
		//读取头部
		$this->loadHeader();
		if ((!$emailResult) && (!$phoneResult)) {
			$bool = $this->des->register($data);
			/* 判断是否注册成功 */
			if($bool){
			/* 注册成功 */
				$id = $this->des->getIdByEmail($email);
				$b = $this->send_email($email,$id,md5($password));
				
			}else{
			/* 注册失败 */
				
			}
			
		}else{
		/* 已经注册过了 */

		}
		/* 读取尾部 */
		$this->loadFooter();
		
	}
}
