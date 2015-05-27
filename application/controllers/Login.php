<?php
/*
 	名称：登录控制器
	作者：崔庆才
	时间：2015/5/25
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		$this->load->model("des_model","des");

	}

	/* 入口 */
	public function index() {

		$this->loadHeader();
		$this->loadLogin();
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
	
	//读取登录表单
	protected  function loadLogin(){

		$this->load->view("login/login");

	}
	

	//处理表单提交的数据
	public function log(){

		$email = $this->input->post("email");
		$password = $this->input->post("password");
		//加载设计师模型
		$this->load->model("des_model","des");
		$result = $this->des->login($email);
		//判断是否登录成功
		$this->loadHeader();
		if((isset($_SESSION['email']))&&($_SESSION['email']==$email))
		{	//已经登录
			$data['success'] = 2;
			$this->load->view("login/message",$data);
		}else if($result){
			if($result[0]->password == md5($password)){
				$_SESSION['email']=$email;
				$_SESSION['password']=$password;
				$_SESSION['name']=$result[0]->name;
				$_SESSION['id']=$result[0]->id;
				//登录成功
				$data['success'] = 1;
				$this->load->view("login/message",$data);
			}else{
				//密码错误
				$data['wrong'] = 1;
				$this->load->view("login/login",$data);
			}
		}
		else{
			//用户不存在
			$data['success'] = 3;
			$this->load->view("login/message",$data);
		}
		$this->loadFooter();
	}
	
	//检验Email是否可用
	public function email_check(){
	
		$email = $_POST['email'];
		$this->load->model("des_model","des");
		$result = $this->des->checkEmail($email);
		if(!(preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$email))){//正则表达式匹配邮箱格式是否正确
			echo "1";//邮箱格式不正确
		}else if(!$result){
			echo "2";
		}
	}
	
	//退出登录
	public function logout(){
		
		unset($_SESSION['email']);
		unset($_SESSION['name']);
		unset($_SESSION['password']);
		unset($_SESSION['id']);
		$this->loadHeader();
		if(!isset($_SESSION['email'])){
			$data['success'] = 4;
		}else{
			$data['success'] = 5;
		}
		$this->load->view("login/message",$data);
		$this->loadFooter();
		
	}
	
}