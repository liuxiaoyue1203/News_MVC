<?php
	header("Content-type: text/html; charset=utf-8");
	//url��ʽ  index.php?controller=��������&method=������
	session_start();
	require_once('config.php');
	require_once('framework/pc.php');
	PC::run($config);
?>