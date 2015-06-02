<?php
/*
	名称：成功案例数据库模型
	作者：崔庆才
	时间：2015/6/2
*/
	class Sample_model extends CI_Model {
		
		
		/* 获取特定的成功事例 */
		public function getLimitSamples($start,$pageNum) {

			$sql = "select * from sample limit ".$start.",".$pageNum;
			$result = $this->db->query($sql);
			return $result->result_array();

		}


		/* 获取成功实例详情 */
		public function getDetailsByid($id) {

			$sql = "select * from sample where id = $id";
			$result = $this->db->query($sql)->result_array();
			return $result[0];

		}


		/* 判断这个事例是否存在 */
		public function sampleExists($id) {

			$sql = "select * from sample where id = $id";
			$result = $this->db->query($sql);
			if ($result) {
				return true;
			} else {
				return false;
			}

		}

	}