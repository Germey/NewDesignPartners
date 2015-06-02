<?php
/*
	名称：成功案例控制器
	作者：崔庆才
	时间：2015/6/2
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Sample extends CI_Controller {



	private $qiniu;


	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		require_once(APPPATH."third_party/qiniu.class.php");
		$this->qiniu = new Qiniu();
		$this->load->model("sample_model","sam");

	}


	/* 获取详情 */
	public function details($id) {

		$this->loadHeader();
		if (!$this->sam->sampleExists($id)) {
			$data['content'] = "该成功案例不存在";
			$data['redirect'] = "main";
			$this->load->view("message", $data);
		} else {
			$result = $this->sam->getDetailsByid($id);
			$result['image'] = $this->qiniu->getUrlByKey($result['image']);
			$result['large_image'] = $this->qiniu->getUrlByKey($result['large_image']);
			$result['company_logo'] = $this->qiniu->getUrlByKey($result['company_logo']);
			$data['sample'] = $result;
			$this->load->view("sample/details", $data);
		}
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


}	
