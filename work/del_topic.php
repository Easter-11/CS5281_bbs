<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8"); 
  /**************************************/
  /*		文件名：del_topic.php		*/
  /*		功能：删除文章内容操作		*/
  /**************************************/

  require('../config.inc.php');

  //判断是否为管理员
  if ($_SESSION['username'] == ADMIN_USER) 
  {
	// get data that sent from form 
	$id=$_GET['id'];

	//删除文章
	$sql = "DELETE FROM forum_topic WHERE id=$id";
	$result=$mysqli->query($sql);

	//删除回复内容
	$sql2 = "DELETE FROM forum_reply WHERE topic_id=$id";
	$result2=$mysqli->query($sql2); 

	if($result AND $result2)
	{
		//页面跳转
		header("Location: main_forum.php");
	}
	else {
		ExitMessage("Database operation error!");
	}
  } else {

	ExitMessage("You don't have administrative privileges!");
  }
?>

