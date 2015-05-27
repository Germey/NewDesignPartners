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
		$this->load->model("des_model","des");

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
		/* 输出到页面中供 注册或登录使用 */
		$code->showImage();   
		/* 将验证码保存到服务器中 */
		$_SESSION["checkcode"]=$code->getCheckCode();  
	
	} 

	/* 判断验证码是否正确 */
	public function codeCheck(){

		$code = $_POST['checkcode'];
		$sessionCode = $_SESSION["checkcode"];
		/* 不区分大小写比较验证码 */
		if(strcasecmp($code,$sessionCode)==0){
			echo "true";
		}else{
			echo "false";
		}

	}

	/* 检查邮箱是否已存在 */
	public function emailExists() {

		$email = $_POST['email'];
		$email = htmlspecialchars($email, ENT_QUOTES);
		$result = $this->des->emailExists($email);
		if ($result) {
			echo "false";
		} else {
			echo "true";
		}

	}


	/* 检查手机是否已存在 */
	public function phoneExists() {

		$phone = $_POST['phone'];
		$phone = htmlspecialchars($phone, ENT_QUOTES);
		$result = $this->des->phoneExists($phone);
		if ($result) {
			echo "false";
		} else {
			echo "true";
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
			if ($bool) {
				/* 注册成功 */
				$id = $this->des->getIdByEmail($email);
				//$sendResult = $this->send_email($email,$id,md5($password));
				$var['content'] = "恭喜你注册成功";
				$this->load->view("message",$var);
			} else {
				/* 注册失败 */
				$var['content'] = "对不起，服务器出了点问题，注册失败，请重试。";
				$this->load->view("message",$var);	
			}
		} else {
			/* 已经注册过了 */
			$var['content'] = "亲，请不要重复注册";
			$this->load->view("message",$var);	
		}
		/* 读取尾部 */
		$this->loadFooter();
		
	}
}
