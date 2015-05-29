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

}	
