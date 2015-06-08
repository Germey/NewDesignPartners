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
	
	/* 读取登录表单 */
	private function loadLogin(){

		$this->load->view("login/login");

	}
	
	/* 处理表单提交的数据 */
	public function login() {

		$email = $this->input->post("email");
		$email = htmlspecialchars($email, ENT_QUOTES);
		$password = $this->input->post("password");
		$password = htmlspecialchars($password, ENT_QUOTES);
		$result = $this->des->getByEmail($email);
		/* 判断是否登录成功 */
		$this->loadHeader();
		if ((isset($_SESSION['email'])) && ($_SESSION['email'] == $email)) {	
			/* 已经登录 */
			$data['content'] = "当前您已在线";
			$data['redirect'] = "main";
			$this->load->view("message",$data);
		} else if ($result) {
			if ($result[0]['password'] == md5($password)) {
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $password;
				$_SESSION['name'] = $result[0]['name'];
				$_SESSION['id'] = $result[0]['id'];
				/* 登录成功 */
				$data['content'] = "恭喜您登录成功";
				$data['redirect'] = "back";
				$this->load->view("message",$data);
			} else {
				/* 密码错误 */
				$data['content'] = "密码错误，登录失败";
				$data['redirect'] = "login";
				$this->load->view("message",$data);
			}
		}
		else{
			/* 用户不存在 */
			$data['content'] = "用户不存在";
			$data['redirect'] = "login";
			$this->load->view("message",$data);
		}
		$this->loadFooter();

	}
	
	/* 检查邮箱是否已经注册 */
	public function emailRegistered() {

		$email = $_POST['email'];
		$email = htmlspecialchars($email, ENT_QUOTES);
		$result = $this->des->emailExists($email);
		if ($result) {
			echo "true";
		} else {
			echo "false";
		}

	}

	/* 检查密码是否正确 */
	public function passwordCheck() {

		$email = $_POST['email'];
		$email = htmlspecialchars($email, ENT_QUOTES);
		$password = $_POST['password'];
		$password = htmlspecialchars($password, ENT_QUOTES);
		$result = $this->des->getByEmail($email);
		if (!$result) {
			echo "false";
		} else {
			if ($result[0]['password'] == md5($password)) {
				echo "true";
			} else {
				echo "false";
			}
		}

	}

	
	/* 退出登录 */
	public function logout(){
		
		unset($_SESSION['email']);
		unset($_SESSION['name']);
		unset($_SESSION['password']);
		unset($_SESSION['id']);
		$this->loadHeader();
		if(!isset($_SESSION['email'])){
			$data['content'] = "用户已退出";
			$data['redirect'] = "main";
		}else{
			$data['content'] = "退出失败，请重试";
			$data['redirect'] = "main";
		}
		$this->load->view("message",$data);
		$this->loadFooter();
		
	}
	
}