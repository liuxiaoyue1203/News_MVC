<?php
	//新闻处理的业务逻辑
	class newsModel{

		public $_table = 'news';
		
		// 根据id读取新闻信息
		public function getnewsinfo($id){
			if(empty($id)){
				return array();
			}else{
				$id = intval($id); // 防止sql注入
				$sql='select * from '.$this->_table.' where id='.$id;
				return DB::findOne($sql);
			}
		}
		
		// 处理、保存newsadd.html提交的新闻信息
		public function newssubmit($data){
			extract($data);				
			if(empty($title)||empty($content)){
				return 0;
				//提示message属于表现层的东西
				
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
				DB::update($this->_table,$data,'id='.$id);
				return 2;			
			}else{
				DB::insert($this->_table,$data);
				return 1;
				
			}
		}

		function findAll_orderby_dateline(){
			$sql = 'select * from '.$this->_table.' order by dateline desc';
			return DB::findAll($sql);
		}

		function findOne_by_id($id){
			$sql = 'select * from '.$this->_table.' where id='.$id;
			return DB::findOne($sql);
		}

		function del_by_id($id){
			return DB::del($this->_table, 'id='.$id);
		}

		function count(){
			$sql = 'select count(*) from '.$this->_table;
			return DB::findResult($sql, 0, 0);
		}

		function insert($data){
			return DB::insert($this->_table, $data);
		}

		function update($data, $id){
			return DB::update($this->_table, $data, 'id='.$id);
		}
	}
?>