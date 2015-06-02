<?php
/*
	名称：项目控制器
	作者：崔庆才
	时间：2015/5/28
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Workshop extends CI_Controller {



	private $qiniu;


	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		require_once(APPPATH."third_party/qiniu.class.php");
		$this->qiniu = new Qiniu();
		$this->load->model("wkshop_model","wkshop");

	}

	/* 读取训练营列表 */
	public function all($id = 0) {

		$this->loadHeader();
		$this->loadWorkshopsList($id);
		$this->loadFooter();

	}

	/* 入口方法 */
	public function index() {

		$this->all(0);

	}


	/* 获取训练营详情 */
	public function details($id) {

		$this->loadHeader();
		if (!$this->wkshop->wkshopExists($id)) {
			$data['content'] = "训练营不存在";
			$data['redirect'] = "main";
			$this->load->view("message", $data);
		} else {
			$result = $this->wkshop->getDetailsByid($id);
			/* 获得加入该训练营的设计师 */
			$designers = $this->wkshop->getJoinedDesigners($id);
			for($i=0;$i<count($designers);$i++){
				$designers[$i]['image'] = $this->qiniu->getUrlByKey($designers[$i]['image']);
			}
			/* 是否已经加入 */
			$joined = 0;
			if(isset($_SESSION['id'])){
				$joined = $this->wkshop->isJoined($id,$_SESSION['id']);
			}
			$result['image'] = $this->qiniu->getUrlByKey($result['image']);
			$result['large_image'] = $this->qiniu->getUrlByKey($result['large_image']);
			$data['workshop'] = $result;
			$data['designers'] = $designers;
			$data['joined'] = $joined;
			$this->load->view("workshop/details", $data);
		}
		$this->loadFooter();

	}

	/* 读取项目列表 */
	public function loadWorkshopsList($id) {

		$workshops = $this->wkshop->getAllWorkshops();
		$pageAll = count($workshops);
		$pagenum = 3;
		$config['total_rows'] = $pageAll;
		$config['per_page'] = $pagenum;
		$config['num_links'] = 2;
		$config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '下页';
        $config['prev_link'] = '上页';
		$config['base_url'] = site_url()."/workshop/all";
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$start = $id;
		$result = $this->wkshop->getLimitWorkshops($start,$pagenum);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->qiniu->getUrlByKey($result[$i]['image']);
			$result[$i]['large_image'] = $this->qiniu->getUrlByKey($result[$i]['large_image']);
		}
		$data['workshops'] = $result;
		$data['paginations'] = $this->pagination->create_links();
		$this->load->view("workshop/workshop",$data);

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
