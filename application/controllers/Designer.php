<?php
/*
	名称：设计师控制器
	作者：崔庆才
	时间：2015/5/28
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Designer extends CI_Controller {

	

	private $qiniu;
	private $format;


	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		require_once(APPPATH."third_party/qiniu.class.php");
		require_once(APPPATH."third_party/format.class.php");
		$this->qiniu = new Qiniu();
		$this->format = new Format();
		$this->load->model("des_model","des");
		$this->load->model("proj_model","proj");
		$this->load->model("wkshop_model","wkshop");
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
			$result['image'] = $this->qiniu->getUrlByKey($result['image']);
			$var['info'] = $result;
			$this->load->view("designer/details",$var);
		} else {
			$var['content'] = "用户信息不存在";
			$var['redirect'] = "main";
			$this->load->view("message",$var);
		}
		
	}

	/* 关注项目　*/
	public function addAttentionProjOrNot() {

		$projId = $_POST['proj_id'];
		if (!isset($_SESSION['id'])) {
			echo "-1";
		} else {
			$attention = $this->proj->isAttention($projId,$_SESSION['id']);
			if(!$attention) {
				$result = $this->des->addAttentionProj($_SESSION['id'], $projId);
				if ($result) {
					echo "1";
				} else {
					echo "0";
				}
			} else {
				$result = $this->des->removeAttentionProj($_SESSION['id'], $projId);
				if ($result) {
					echo "3";
				} else {
					echo "2";
				}
			}
			
		}

	}


	/* 关注训练营　*/
	public function addAttentionWkshopOrNot() {

		$wkshopId = $_POST['wkshop_id'];
		if (!isset($_SESSION['id'])) {
			echo "-1";
		} else {
			$attention = $this->wkshop->isAttention($wkshopId,$_SESSION['id']);
			if(!$attention) {
				$result = $this->des->addAttentionWkshop($_SESSION['id'], $wkshopId);
				if ($result) {
					echo "1";
				} else {
					echo "0";
				}
			} else {
				$result = $this->des->removeAttentionWkshop($_SESSION['id'], $wkshopId);
				if ($result) {
					echo "3";
				} else {
					echo "2";
				}
			}
			
		}

	}

	/* 加入项目 */
	public function joinProj() {

		$projId = $_POST['proj_id'];
		if (!isset($_SESSION['id'])) {
			echo "-1";
		} else {
			$joined = $this->proj->isJoined($projId,$_SESSION['id']);
			if(!$joined) {
				$result = $this->des->joinProj($_SESSION['id'], $projId);
				if ($result) {
					echo "1";
				} else {
					echo "0";
				}
			} else {
				echo "2";
			}
			
		}
	}


	/* 加入项目 */
	public function joinWkshop() {

		$wkshopId = $_POST['wkshop_id'];
		if (!isset($_SESSION['id'])) {
			echo "-1";
		} else {
			$joined = $this->wkshop->isJoined($wkshopId,$_SESSION['id']);
			if(!$joined) {
				$result = $this->des->joinWkshop($_SESSION['id'], $wkshopId);
				if ($result) {
					echo "1";
				} else {
					echo "0";
				}
			} else {
				echo "2";
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
			$result[$i]['image'] = $this->qiniu->getUrlByKey($result[$i]['image']);
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
			$info['image'] = $this->qiniu->getUrlByKey($info['image']);
			$data['info'] = $info;
			$this->load->view("designer/changeinfo",$data);
		}
		$this->loadFooter();
		
	}

	
}
