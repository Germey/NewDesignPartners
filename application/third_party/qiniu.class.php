<?php 
/*
	类：七牛云存储相关类
	时间：2015/6/2
	作者：崔庆才
*/

	class Qiniu {


		/* 构造方法，加载模型 */
		public function __construct() {

		}


		/* 获取AccsssKey */
		private function getAccessKey() {

			$accessKey = 'IOImn35KC5pRX7Ov3scxbYkvNk6oIxB7zWsBRp16';
			return $accessKey;

			
		}
		
		/* 获取secretKey */
		private function getSecretKey() {

			$secretKey = 's29vc9tlCvs23wRh7QScYTuzCDmIbUSi4EroKj1z';
			return $secretKey;

		}
		
		/* 传入资源名称，返回资源URL */
		public function getUrlByKey($key,$bucket = "designpartners") {
		
			/* 从七牛云存储获取URL */
			require_once(dirname(__FILE__)."/../../qiniu/rs.php");
			if ($key == "") return "";
			$domain = $bucket.".qiniudn.com";
			$accessKey = $this->getAccessKey();
			$secretKey = $this->getSecretKey();
			Qiniu_SetKeys($accessKey, $secretKey);  
			$baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);
			$getPolicy = new Qiniu_RS_GetPolicy();
			$privateUrl = $getPolicy->MakeRequest($baseUrl, null);
			return $privateUrl;
			
		}


		/* 获取上传凭证 */
		public function getUptoken() {
		
			require_once(dirname(__FILE__)."/../../qiniu/rs.php");
			//远程存储空间名称
			$bucket = 'designpartners';
			$accessKey = $this->getAccessKey();
			$secretKey = $this->getSecretKey();
			Qiniu_SetKeys($accessKey, $secretKey);
			$putPolicy = new Qiniu_RS_PutPolicy($bucket);
			$putPolicy->ReturnBody = '{"key": $(key),"bucket": $(bucket)}';
			$upToken = $putPolicy->Token(null);
			return $upToken;
			
		}

	}