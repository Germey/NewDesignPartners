<?php
/*
	名称：训练营数据库模型
	作者：崔庆才
	时间：2015/5/25
*/
	class Wkshop_model extends CI_Model{

		public function getLimitWorkShops($start,$pageNum){
			$sql = "select * from workshop limit ?,?";
			$data[0] = $start;
			$data[1] = $pageNum;
			$result = $this->db->query($sql,$data);
			return $result->result_array();
		}
		
	}