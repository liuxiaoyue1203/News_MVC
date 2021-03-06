<?php
	// 登录操作 
	class authModel{
		private $auth='';//当前管理员的信息		
		public function __construct(){
			if(isset($_SESSION['auth'])&&(!empty($_SESSION['auth']))){
				$this->auth=$_SESSION['auth'];	
			}	
		}
		
		public function getauth(){
			return $this->auth;
		}
		
		// 登录验证的一些列业务逻辑
		public function loginsubmit(){
			if(empty($_POST['username'])||empty($_POST['password'])){
				return false;
			}
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);	
			if($this->auth=$this->checkuser($username,$password)){
				$_SESSION['auth']=$this->auth;
				return true;
			}else{
				return false;	
			}
		}
		
		// 用户的验证操作	
		private function checkuser($username,$password){
			$adminobj=M('admin');
			$auth=$adminobj->findOne_by_username($username);
			if((!empty($auth))&&$auth['password']==$password){
				return $auth;
			}else{
				return false;
			}
		}
		
		// 退出登录
		public function logout(){
			unset($_SESSION['auth']);
			$this->auth='';
		}

	}
?>