<?php
/*
	名称：训练营数据库模型
	作者：崔庆才
	时间：2015/5/25
*/
	class Wkshop_model extends CI_Model {
		
		/* 获取所有的项目信息 */
		public function getAllWorkshops() {

			$sql = "select * from workshop";
			$result = $this->db->query($sql);
			return $result->result_array();

		}


		/* 获取特定的项目 */
		public function getLimitWorkshops($start,$pageNum) {

			$sql = "select * from workshop limit ".$start.",".$pageNum;
			$result = $this->db->query($sql);
			return $result->result_array();

		}
	}