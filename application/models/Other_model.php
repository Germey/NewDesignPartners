<?php
/*
	名称：其他处理数据库模型
	作者：崔庆才
	时间：2015/6/7
*/
	class Other_model extends CI_Model{

		/* 获得关于页面内容 */
		public function getAbout(){

			$sql = "select * from data";
			$result = $this->db->query($sql);
			return $result->result_array();
			
		}
		
		
	}