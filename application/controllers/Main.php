<?php
/*
	名称：主页控制器
	作者：崔庆才
	时间：2015/5/25
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		$this->load->model("proj_model","proj");
		$this->load->model("wkshop_model","wkshop");

	}

	/* 入口 */
	public function index() {

		$this->loadHeader();
		$this->loadCarousel();
		$this->loadProjOverview();
		$this->loadWkshopOverview();
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

	/* 加载轮播图 */
	private function loadCarousel() {

		$this->load->view('main/carousel');

	}

	/* 加载项目概览 */
	private function loadProjOverview()	{

		$result = $this->proj->loadProjOverview();
		$var['projects'] = $result;
		$this->load->view("main/project",$var);

	}

	/* 加载工作坊训练营预览 */
	private function loadWkshopOverview(){
	
		$result = $this->wkshop->getLimitWorkShops(0,3);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
		}
		$var['workshops'] = $result;
		$this->load->view("main/workshop",$var);
		
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
