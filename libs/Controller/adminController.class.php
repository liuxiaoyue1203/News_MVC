﻿<?php
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
			if(!isset($_POST['submit'])){
				$data = $this->getnewsinfo();
				VIEW::assign(array('data'=>$data));
				VIEW::display('admin/newsadd.html');
			}else{
				$this->newssubmit();
			}
		}
		
		//管理新闻
		public function newslist(){
			$data = $this->getnewslist();
			VIEW::assign(array('data'=>$data));
			VIEW::display('admin/newslist.html');
		}

		
		public function newsdel(){
			if($_GET['id']){
				$this->delnews();
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

		

		private function getnewslist(){
			$newsobj = M('news');
			return $newsobj->findAll_orderby_dateline();
		}

		private function delnews(){
			$newsobj = M('news');
			return $newsobj->del_by_id($_GET['id']);
		}

		private function newssubmit(){
			extract($_POST);				
			if(empty($title)||empty($content)){
				$this->showmessage('请把新闻标题、内容填写完整再提交！', 'admin.php?controller=admin&method=newsadd');
			}
			$title = daddslashes($title);
			$content = daddslashes($content);
			$author = daddslashes($author);
			$from = daddslashes($from);
			$newsobj = M('news');
			$data = array(
				'title'=>$title,
				'content'=>$content,
				'author'=>$author,
				'from'=>$from,
				'dateline'=>time()
			);
			if($_POST['id']!=''){
				$newsobj ->update($data, intval($_POST['id']));
				$this->showmessage('修改成功！', 'admin.php?controller=admin&method=newslist');
			}else{
				$newsobj ->insert($data);
				$this->showmessage('发布成功！', 'admin.php?controller=admin&method=newslist');
			}
		}

		private function showmessage($info, $url){
			echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}
	}
?>