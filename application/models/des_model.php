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


	}