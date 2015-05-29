<?php
/*
	名称：项目数据库模型
	作者：崔庆才
	时间：2015/5/25
*/
	class Proj_model extends CI_Model{

		/* 获得项目概览 四个项目 */
		public function loadProjOverview() {

			$sql = "select * from project limit 0,4";
			$result = $this->db->query($sql);
			return $result->result_array();
			
		}
		
		/* 获取所有的项目信息 */
		public function getAllProjects() {

			$sql = "select * from project";
			$result = $this->db->query($sql);
			return $result->result_array();

		}


		/* 获取特定的项目 */
		public function getLimitProjects($start,$pageNum) {

			$sql = "select * from project limit ".$start.",".$pageNum;
			$result = $this->db->query($sql);
			return $result->result_array();

		}

	}