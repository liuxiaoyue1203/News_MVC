<?php
	//�˶Ե�¼��Ϣ
	class authModel{
		private $auth='';//��ǰ����Ա����Ϣ
		
		public function __construct(){
			if(isset($_SESSION['auth'])&&(!empty($_SESSION['auth']))){
				$this->auth=$_SESSION['auth'];	
			}	
		}
		
		public function getauth(){
			return $this->auth;
		}
		
		//��¼��֤��һЩ��ҵ���߼�
		public function loginsubmit(){
			if(empty($_POST['username'])||empty($_POST['password'])){
				return false;
			}
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);	
			//�û�����֤����
			if($this->auth=$this->checkuser($username,$password)){
				$_SESSION['auth']=$this->auth;
				return true;
			}else{
				return false;	
			}
		}
		
		
		private function checkuser($username,$password){
			$adminobj=M('admin');
			$auth=$adminobj->findOne_by_username($username);
			if((!empty($auth))&&$auth['password']==$password){
				return $auth;
			}else{
				return false;
			}
		}

	}
?>