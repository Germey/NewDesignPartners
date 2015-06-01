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
		$this->load->model("proj_model","proj");
	}

	/* 读取设计师列表 */
	public function all($id = 0) {

		$this->loadHeader();
		$this->loadDesignersList($id);
		$this->loadFooter();

	}

	/* 入口 */
	public function index() {

		$this->all(0);

	}


	/* 获取设计师详情 */
	public function details($id) {

		$this->loadHeader();
		$this->loadDesignerDetail($id);
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
	private function loadDesignerDetail($id) {

		$id = htmlspecialchars($id, ENT_QUOTES);
		$result = $this->des->getInfoById($id);
		/* 如果用户信息存在 */
		if ($result) {
			$result['image'] = $this->getUrlByKey($result['image']);
			$var['info'] = $result;
			$this->load->view("designer/details",$var);
		} else {
			$var['content'] = "用户信息不存在";
			$var['redirect'] = "main";
			$this->load->view("message",$var);
		}
		
	}

	/* 关注项目　*/
	public function followProjOrNot() {

		$projId = $_POST['proj_id'];
		if (!isset($_SESSION['id'])) {
			echo "-1";
		} else {
			$followed = $this->proj->isJoined($projId,$_SESSION['id']);
			if(!$followed) {
				$result = $this->des->followProj($_SESSION['id'], $projId);
				if ($result) {
					echo "1";
				} else {
					echo "0";
				}
			} else {
				$result = $this->des->unFollowProj($_SESSION['id'], $projId);
				if ($result) {
					echo "3";
				} else {
					echo "2";
				}
			}
			
		}

	}


	/* 获得已经加入的项目 */
	public function getJoinedProjects() {

		$id = $_POST['id'];
		$id = htmlspecialchars($id, ENT_QUOTES);
		$result = $this->des->getJoinedProjectsById($id);
		echo json_encode($result);

	}

	/* 设计师列表 */
	public function loadDesignersList($id) {

		$designers = $this->des->getAllDesigners();
	    $pageAll = count($designers);
		$pagenum = 6;
		$config['total_rows'] = $pageAll;
		$config['per_page'] = $pagenum;
		$config['num_links'] = 3;
		$config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '下页';
        $config['prev_link'] = '上页';
		$this->load->helper("url");
		$config['base_url'] = site_url()."/designer/all";
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$start = $id;
		$result = $this->des->getLimitDesigners($start,$pagenum);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
		}
		$data['designers'] = $result;
		$data['paginations'] = $this->pagination->create_links();
		$this->load->view("designer/designer",$data);

	}

	/* 修改信息 */
	public function changeInfo($id = 0){
	
		$this->loadHeader();
		/* 没有登录 */
		if (!(isset($_SESSION['id']))) {
			$this->load->view('login/login');
		/* 用户不对应 */
		} else if ($_SESSION['id'] != $id) {
			$data['content'] = "您无权修改其他人的信息";
			$this->load->view('designer/message',$data);
		}else{
			$info = $this->des->getInfoById($id);
			$info['image'] = $this->getUrlByKey($info['image']);
			$data['info'] = $info;
			$this->load->view("designer/changeinfo",$data);
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
}
