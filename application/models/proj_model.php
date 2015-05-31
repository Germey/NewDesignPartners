<?php
/*
	名称：项目数据库模型
	作者：崔庆才
	时间：2015/5/25
*/
	class Proj_model extends CI_Model{

		/* 获得项目概览 四个项目 */
		public function loadProjOverview() {

			$sql = "select * from project where valid = 1 limit 0,4 ";
			$result = $this->db->query($sql);
			return $result->result_array();
			
		}
		
		/* 获取所有的项目信息 */
		public function getAllProjects() {

			$sql = "select * from project where valid = 1";
			$result = $this->db->query($sql);
			return $result->result_array();

		}


		/* 获取特定的项目 */
		public function getLimitProjects($start,$pageNum) {

			$sql = "select * from project where valid = 1 limit $start,$pageNum";
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
		public function isJoined($projId,$desId) {
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

		/* 储存项目基本详细 */
		public function storeBase($data) {
			$name = $data['proj_name'];
			$location = $data['proj_loc'];
			$image = $data['proj_pic'];
			$brief = $data['proj_des'];
			$ser_kind = $data['ser_kind'];
			$des_kind = $data['des_kind'];
			$publish_id = $data['uid'];
			$sql = "insert into project (name,location,image,brief,ser_kind,des_kind,publish_id) values ('$name','$location','$image','$brief','$ser_kind','$des_kind',$publish_id)";
			$result = $this->db->query($sql);
			if ($result) {
				$id = $this->db->insert_id();
				return $id;
			} else {
				return false;
			}
			
		}
		
		/* 储存项目基本详细 */
		public function storeDetails($data) {
			
			$details = $data['proj_detail'];
			$des_need = $data['des_need'];
			$res_need = $data['res_need'];
			$start_time = $data['start_time'];
			$end_time = $data['end_time'];
			$proj_id = $data['proj_id'];
			$budget = $data['budget'];
			$sql = "update project set details = '$details',des_need = '$des_need',res_need = '$res_need',start_date = '$start_time',end_date = '$end_time',fin_need = $budget where id = $proj_id";
			$result = $this->db->query($sql);
			if ($result) {
				return $proj_id;
			} else {
				return false;
			}
			
		}


		/* 储存项目公司详细 */
		public function storeCompany($data) {
			
			$company_name = $data['company_name'];
			$company_location = $data['company_location'];
			$charge_person = $data['charge_person'];
			$charge_phone = $data['charge_phone'];
			$charge_email = $data['charge_email'];
			$company_logo = $data['company_logo'];
			$proj_id = $data['proj_id'];
			$sql = "update project set company_name = '$company_name',company_location = '$company_location',charge_person = '$charge_person',charge_phone = '$charge_phone',charge_email = '$charge_email',company_logo = '$company_logo',valid = 1 where id = $proj_id";
			echo $sql;
			$result = $this->db->query($sql);
			if ($result) {
				return $proj_id;
			} else {
				return false;
			}
			
		}

		/* 查看是不是这个用户发布的项目 */
		public function checkOwnProj($proj_id, $uid) {

			$sql = "select * from project where id = $proj_id and publish_id = $uid";
			$result = $this->db->query($sql)->result_array();
			if ($result) {
				return true;
			} else {
				return false;
			}

		}
		
	}