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

		/* 判断这个项目是否存在 */
		public function wkshopExists($id) {

			$sql = "select * from workshop where id = $id";
			$result = $this->db->query($sql);
			if ($result) {
				return true;
			} else {
				return false;
			}

		}

		/* 获取加入某个训练营的设计师 */
		public function getJoinedDesigners($id){

			$sql = "select * from workshop_designer a,designer b where a.designer_id = b.id and a.workshop_id = ?";
			$result = $this->db->query($sql,$id);
			return $result->result_array();

		}


		/* 获取训练营详情 */
		public function getDetailsByid($id) {

			$sql = "select * from workshop where id = $id";
			$result = $this->db->query($sql)->result_array();
			return $result[0];

		}


		/* 传入设计师id和训练营id判断设计师是否加入 */
		public function isJoined($wkshopId, $desId) {
			$join = 0;
			$sql = "select * from workshop_designer where workshop_id = ? and designer_id = ?";
			$datas[0] = $wkshopId;
			$datas[1] = $desId;
			$r = $this->db->query($sql,$datas)->result_array();
			$result = 0;
			if($r){
				/* 已经加入了该训练营 */
				$join = 1;
			}else{
				/* 未加入该训练营 */
				$join = 0;
			}
			return $join;
		}
	}