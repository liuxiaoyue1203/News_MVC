<?php
	$config = array(
		'viewconfig' => array(                             
			'left_delimiter' => '{',  'right_delimiter' => '}',  'template_dir' => 'tpl',  'compile_dir' => 'data/template_c', 'cache_dir'=>'data/cache', 'caching'=> false, 'cache_lifetime'=>120),
		'dbconfig' => array(
			'dbhost' => 'localhost', 'dbuser'=>'root', 'dbpsw' => '123456' , 'dbname' => 'newsreport', 'dbcharset' => 'utf8')
	);
?>
