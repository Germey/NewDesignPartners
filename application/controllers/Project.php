<?php
/*
	名称：项目控制器
	作者：崔庆才
	时间：2015/5/28
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {


	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
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
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
			$result[$i]['large_image'] = $this->getUrlByKey($result[$i]['large_image']);
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
			/* 获得加入该项目的设计师 */
			$designers = $this->proj->getJoinedDesigners($id);
			for($i=0;$i<count($designers);$i++){
				$designers[$i]['image'] = $this->getUrlByKey($designers[$i]['image']);
			}
			/* 是否已经加入 */
			$joined = 0;
			if(isset($_SESSION['id'])){
				$joined = $this->proj->isJoined($id,$_SESSION['id']);
			}
			$result['image'] = $this->getUrlByKey($result['image']);
			$result['large_image'] = $this->getUrlByKey($result['large_image']);
			$data['project'] = $result;
			$data['designers'] = $designers;
			$data['joined'] = $joined;
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
	public function publishCompany() {

		$this->loadHeader();
		if (!isset($_SESSION['id'])) {
			$this->load->view("login/login");
		} else {
			$this->load->view("project/publishcompany");
		}
		$this->loadFooter();

	}

	/* 获取AccsssKey */
	private function getAccessKey() {

		$accessKey = 'IOImn35KC5pRX7Ov3scxbYkvNk6oIxB7zWsBRp16';
		return $accessKey;

		
	}
	
	/* 获取secretKey */
	private function getSecretKey() {

		$secretKey = 's29vc9tlCvs23wRh7QScYTuzCDmIbUSi4EroKj1z';
		return $secretKey;

	}
	
	/* 传入资源名称，返回资源URL */
	private function getUrlByKey($key,$bucket = "designpartners") {
	
		/* 从七牛云存储获取URL */
		require_once(dirname(__FILE__)."/../../qiniu/rs.php");
		$domain = $bucket.".qiniudn.com";
		$accessKey = $this->getAccessKey();
		$secretKey = $this->getSecretKey();
		Qiniu_SetKeys($accessKey, $secretKey);  
		$baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);
		$getPolicy = new Qiniu_RS_GetPolicy();
		$privateUrl = $getPolicy->MakeRequest($baseUrl, null);
		return $privateUrl;
		
	}


	/* 传入资源名称，ajax请求使用 */
	public function getImageUrlByKey() {
		
		$key = $_POST['key'];
		/* 从七牛云存储获取URL */
		require_once(dirname(__FILE__)."/../../qiniu/rs.php");
		$bucket = "designpartners";
		$domain = $bucket.".qiniudn.com";
		$accessKey = $this->getAccessKey();
		$secretKey = $this->getSecretKey();
		Qiniu_SetKeys($accessKey, $secretKey);  
		$baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);
		$getPolicy = new Qiniu_RS_GetPolicy();
		$privateUrl = $getPolicy->MakeRequest($baseUrl, null);
		echo $privateUrl;
		
	}

	/* 获取上传凭证 */
	private function getUptoken() {
	
		require_once(dirname(__FILE__)."/../../qiniu/rs.php");
		//远程存储空间名称
		$bucket = 'designpartners';
		$accessKey = $this->getAccessKey();
		$secretKey = $this->getSecretKey();
		Qiniu_SetKeys($accessKey, $secretKey);
		$putPolicy = new Qiniu_RS_PutPolicy($bucket);
		$putPolicy->ReturnBody = '{"key": $(key),"bucket": $(bucket)}';
		$upToken = $putPolicy->Token(null);
		return $upToken;
		
	}



}	

