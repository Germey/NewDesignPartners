<?php
/*
	名称：设计师控制器
	作者：崔庆才
	时间：2015/5/28
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Designer extends CI_Controller {

	
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

	/* 加载个人信息页面 */
	private function loadDesignerDetail() {

		$this->load->view("designer/details");

	}
}
