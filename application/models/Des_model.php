<?php
/*
	名称：设计师数据库模型
	作者：崔庆才
	时间：2015/5/25
*/
	class Des_model extends CI_Model{

		/* 根据邮件获取内容 */
		public function getByEmail($email){

			$sql = "select * from designer where email = '".$email."'";
			$result = $this->db->query($sql);
			return $result->result_array();

		}

		/* 根据手机号获取内容 */
		public function getByPhone($phone){

			$sql = "select * from designer where phone = '".$phone."'";
			$result = $this->db->query($sql);
			return $result->result_array();

		}

		/* 注册插入信息 */
		public function register($data){

			$sql = "insert into designer(name,email,phone,password) values(?,?,?,md5(?))";
			$result = $this->db->query($sql,$data);
			return $result;

		}

		/* 通过邮件来获取用户代号 */
		public function getIdByEmail($email){
			
			$sql = "select * from designer where email = ?";
			$result = $this->db->query($sql,$email)->result_array();
			return $result[0]['id'];
			
		}
		
		/* 检查邮箱是否存在 */
		public function emailExists($email) {

			$sql = "select * from designer where email = '$email'";
			$result = $this->db->query($sql)->result_array();
			if ($result) {
				return true;
			} else {
				return false;
			}

		}

		/* 检查手机是否存在 */
		public function phoneExists($phone) {

			$sql = "select * from designer where phone = '$phone'";
			$result = $this->db->query($sql)->result_array();
			if ($result) {
				return true;
			} else {
				return false;
			}
			
		}

		/* 通过用户ID获得个人信息 */
		public function getInfoById($id) {

			$sql = "select * from designer where id = '$id'";
			$result = $this->db->query($sql)->result_array();
			if ($result) {
				return $result[0];
			} else {
				return null;
			}
			
		}

		/* 通过用户id获取用户已经加入的项目 */
		public function getJoinedProjectsById($id) {
			$sql = "select * from proj_designer a,project b where a.project_id = b.id and a.designer_id = ".$id;
			$result = $this->db->query($sql)->result_array();
			return $result;
		}

		/* 获得所有的设计师 */
		public function getAllDesigners(){
			$sql = "select * from designer";
			$result = $this->db->query($sql);
			return $result->result_array();
		}

		/* 获得特定的设计师 */
		public function getLimitDesigners($start, $pageNum) {
			$sql = "select * from designer limit ".$start.",".$pageNum;
			$result = $this->db->query($sql);
			return $result->result_array();
		}


		/* 关注项目 */
		public function followProj($uid, $projId) {

			$sql = "insert into proj_designer(project_id,designer_id) values ($projId,$uid)";
			$result = $this->db->query($sql);
			return $result;

		}

		/* 取消关注项目 */
		public function unFollowProj($uid, $projId) {

			$sql = "delete from proj_designer where project_id = $projId and designer_id = $uid";
			$result = $this->db->query($sql);
			return $result;

		}

	}