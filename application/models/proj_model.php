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

		/* 获取项目详情 */
		public function getDetailsByid($id) {

			$sql = "select * from project where id = $id";
			$result = $this->db->query($sql)->result_array();
			return $result[0];

		}

		/* 获取加入某个项目的设计师 */
		public function getJoinedDesigners($id){
			$sql = "select * from proj_designer a,designer b where a.designer_id = b.id and a.project_id = ?";
			$result = $this->db->query($sql,$id);
			return $result->result_array();
		}


		/* 判断这个项目是否存在 */
		public function projExists($id) {

			$sql = "select * from project where id = $id";
			$result = $this->db->query($sql);
			if ($result) {
				return true;
			} else {
				return false;
			}

		}

		/* 传入设计师id和项目id判断设计师是否加入 */
		public function isJoined($projId,$desId){
			$join = 0;
			$sql = "select * from proj_designer where project_id = ? and designer_id = ?";
			$datas[0] = $projId;
			$datas[1] = $desId;
			$r = $this->db->query($sql,$datas)->result_array();
			$result = 0;
			if($r){
				/* 已经加入了该项目 */
				$join = 1;
			}else{
				/* 未加入该项目 */
				$join = 0;
			}
			return $join;
		}
	}