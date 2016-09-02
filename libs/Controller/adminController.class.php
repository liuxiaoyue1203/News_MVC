<?php
	class adminController{

		public $auth;

		
		public function __construct(){
			$authobj=M('auth');
			$this->auth=$authobj->getauth();
			if(empty($this->auth)&&(PC::$method!='login')){
				$this->showmessage('请登录后操作','admin.php?controller=admin&method=login');	
			}
			
			
		}
		
		// 后台首页 newsnum:表示新闻总数
		public function index(){
			$newsobj = M('news');
			$newsnum = $newsobj->count();
			VIEW::assign(array('newsnum'=>$newsnum));
			VIEW::display('admin/index.html'); 
		}
		
	  // 登录处理
		public function login(){
			if(!isset($_POST['submit'])){
				VIEW::display('admin/login.html');
			}else{
				$this->checklogin();
			}
		}
		
		// 退出登录
		public function logout(){
				$authobj=M('auth');
				$authobj->logout();
				$this->showmessage('退出成功！', 'admin.php?controller=admin&method=login');
		}

	  // 添加新闻
		public function newsadd(){
			if(empty($_POST)){// 没有数据时显示添加、修改界面
				if(isset($_GET['id'])){
					$data=M('news')->getnewsinfo($_GET['id']);	
				}else{
					$data=array();	
				}
				VIEW::assign(array('data'=>$data));
				VIEW::display('admin/newsadd.html');
			}else{// 得到newsadd.html提交的数据后，进入添加、修改的处理程序
				$this->newssubmit();
			}
		}
		
		// 新闻列表
		public function newslist(){
			$newsobj = M('news');
			$data=$newsobj->findAll_orderby_dateline();
			VIEW::assign(array('data'=>$data));
			VIEW::display('admin/newslist.html');
		}

		// 根据id删除新闻
		public function newsdel(){
			if(intval($_GET['id'])){
				$newsobj = M('news');
				$newsobj->del_by_id(intval($_GET['id']));
				// 可以优化，对删除结构进行判断
				$this->showmessage('删除新闻成功！', 'admin.php?controller=admin&method=newslist');
			}
		}

		
		private function checklogin(){
			
			$authobj = M('auth');
			if($authobj->loginsubmit()){
				$this->showmessage('登录成功！', 'admin.php?controller=admin&method=index');
			}else{
				$this->showmessage('登录失败！', 'admin.php?controller=admin&method=login');
			}
		}


		private function newssubmit(){
			$newsobj=M('news');
			$result= $newsobj->newssubmit($_POST);
			if($result==0){
				$this->showmessage('请把新闻标题、内容填写完整再提交！', 'admin.php?controller=admin&method=newsadd&id='.$_POST['id']);
			}elseif($result==1){
				$this->showmessage('发布成功！', 'admin.php?controller=admin&method=newslist');
			}elseif($result==2){
				$this->showmessage('修改成功！', 'admin.php?controller=admin&method=newslist');
			}
		}

		private function showmessage($info, $url){
			echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}
	}
?>