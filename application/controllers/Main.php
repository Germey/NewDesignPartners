<?php
/*
	名称：主页控制器
	作者：崔庆才
	时间：2015/5/25
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {


	private $qiniu;

	/* 构造方法，加载模型 */
	public function __construct() {

		parent::__construct();
		require_once(APPPATH."third_party/qiniu.class.php");
		$this->qiniu = new Qiniu();
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
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->qiniu->getUrlByKey($result[$i]['image']);
		}
		$var['projects'] = $result;
		$this->load->view("main/project",$var);

	}

	/* 加载工作坊训练营预览 */
	private function loadWkshopOverview(){
	
		$result = $this->wkshop->getLimitWorkShops(0,3);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->qiniu->getUrlByKey($result[$i]['image']);
		}
		$var['workshops'] = $result;
		$this->load->view("main/workshop",$var);
		
	}



}
