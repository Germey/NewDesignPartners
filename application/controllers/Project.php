<?php
/*
	名称：项目控制器
	作者：崔庆才
	时间：2015/5/28
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {


	private $qiniu;
	private $format;


	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		require_once(APPPATH."third_party/qiniu.class.php");
		require_once(APPPATH."third_party/format.class.php");
		$this->qiniu = new Qiniu();
		$this->format = new Format();
		$this->load->model("proj_model","proj");

	}

	/* 读取项目列表 */
	public function all($id = 0) {

		$this->loadHeader();
		$this->loadProjectsList($id);
		$this->loadFooter();

	}

	/* 入口方法 */
	public function index() {

		$this->all(0);

	}

	/* 读取项目列表 */
	public function loadProjectsList($id) {

		$projects = $this->proj->getAllProjects();
		$pageAll = count($projects);
		$pagenum = 3;
		$config['total_rows'] = $pageAll;
		$config['per_page'] = $pagenum;
		$config['num_links'] = 2;
		$config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '下页';
        $config['prev_link'] = '上页';
		$config['base_url'] = site_url()."/project/all";
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$start = $id;
		$result = $this->proj->getLimitProjects($start,$pagenum);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->qiniu->getUrlByKey($result[$i]['image']);
			$result[$i]['day_des'] = $this->format->desTwoDays(date("Y-m-d",time()), $result[$i]['end_date']);
			$joined = 0;
			if (isset($_SESSION['id'])) {
				$joined = $this->proj->isJoined($result[$i]['id'],$_SESSION['id']);
			}
			$result[$i]['joined'] = $joined;
			/* 是否已经关注 */
			$attention = 0;
			if(isset($_SESSION['id'])){
				$attention = $this->proj->isAttention($result[$i]['id'],$_SESSION['id']);
			}
			$result[$i]['attention'] = $attention;
		}
		$data['projects'] = $result;
		$data['paginations'] = $this->pagination->create_links();
		$this->load->view("project/project",$data);

	}

	/* 加载头部 */
	private function loadHeader() {

		$this->load->view('header');

	}

	/* 加载尾部 */
	private function loadFooter() {

		$this->load->view('footer');

	}

	/* 获取项目详情 */
	public function details($id) {

		$this->loadHeader();
		if (!$this->proj->projExists($id)) {
			$data['content'] = "项目不存在";
			$data['redirect'] = "main";
			$this->load->view("message", $data);
		} else {
			$result = $this->proj->getDetailsByid($id);
			$result['large_image'] = $this->qiniu->getUrlByKey($result['large_image']);
			$result['company_logo'] = $this->qiniu->getUrlByKey($result['company_logo']);
			$keys = array_keys($result);
			$addPArray = array("brief","details");
			foreach ($keys as $key) {
				$result[$key] = $this->format->htmtocode($result[$key], in_array($key, $addPArray));
			}
			/* 获得加入该项目的设计师 */
			$designers = $this->proj->getJoinedDesigners($id);
			for($i=0;$i<count($designers);$i++) {
				$designers[$i]['image'] = $this->qiniu->getUrlByKey($designers[$i]['image']);
			}
			/* 是否已经加入 */
			$joined = 0;
			if(isset($_SESSION['id'])){
				$joined = $this->proj->isJoined($id,$_SESSION['id']);
			}
			/* 是否已经关注 */
			$attention = 0;
			if(isset($_SESSION['id'])){
				$attention = $this->proj->isAttention($id,$_SESSION['id']);
			}
			$data['project'] = $result;
			$data['designers'] = $designers;
			$data['joined'] = $joined;
			$data['attention'] = $attention;
			$this->load->view("project/details", $data);
		}
		$this->loadFooter();

	}


	/* 发布项目 - 基本信息 */
	public function publishBase() {

		$this->loadHeader();
		if (!isset($_SESSION['id'])) {
			$this->load->view("login/login");
		} else {
			$data['upToken'] = $this->getUptoken();
			$data['id'] = $_SESSION['id'];
			$this->load->view("project/publishbase", $data);
		}
		$this->loadFooter();

	}

	/* 发布项目 - 保存项目基本信息 */
	public function storeBase() {

		/* 如果未登录 */
		if (!isset($_SESSION['id'])) {
			$this->load->view("login/login");
		/* 如果秘钥不匹配 */
		} else {
			$data = $_POST;
			$result = $this->proj->storeBase($data);
			if ($result) {
				echo $result;
			} else {
				echo "0";
			}
		}

	}


	/* 发布项目 - 详细信息 */
	public function publishDetails($proj_id) {

		$this->loadHeader();
		if (!isset($_SESSION['id'])) {
			$this->load->view("login/login");
		} else {
			$own = $this->proj->checkOwnProj($proj_id, $_SESSION['id']);
			if (!$own) {
				$data['content'] = "您无权修改此项目";
				$data['redirect'] = "main";
				$this->load->view("message", $data);
			} else {
				$data['proj_id'] = $proj_id;
				$this->load->view("project/publishdetail", $data);
			}
			
		}
		$this->loadFooter();

	}

	/* 发布项目 - 保存项目详细信息 */
	public function storeDetails() {

		/* 如果未登录 */
		if (!isset($_SESSION['id'])) {
			$this->load->view("login/login");
		/* 如果秘钥不匹配 */
		} else {
			$data = $_POST;
			$result = $this->proj->storeDetails($data);
			if ($result) {
				echo $result;
			} else {
				echo "0";
			}
		}

	}

	/* 发布项目 - 公司信息 */
	public function publishCompany($proj_id) {

		$this->loadHeader();
		if (!isset($_SESSION['id'])) {
			$this->load->view("login/login");
		} else {
			$data['upToken'] = $this->getUptoken();
			$data['id'] = $_SESSION['id'];
			$data['proj_id'] = $proj_id;
			$this->load->view("project/publishcompany", $data);
		}
		$this->loadFooter();

	}


	/* 发布项目 - 保存项目公司信息 */
	public function storeCompany() {

		/* 如果未登录 */
		if (!isset($_SESSION['id'])) {
			$this->load->view("login/login");
		/* 如果秘钥不匹配 */
		} else {
			$data = $_POST;
			$result = $this->proj->storeCompany($data);
			if ($result) {
				echo $result;
			} else {
				echo "0";
			}
		}

	}


	/* 传入资源名称，ajax请求使用 */
	public function getImageUrlByKey() {

		$key = $_POST['key'];
		$privateUrl = $this->qiniu->getUrlByKey($key);
		echo $privateUrl;
		
	}

	/* 获取上传凭证 */
	public function getUptoken() {

		return $this->qiniu->getUptoken();

	}


}	

