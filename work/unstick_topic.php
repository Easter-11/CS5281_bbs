<?php
  /**************************************/
  /*		文件名：unstick_topic.php	*/
  /*		功能：取消“置顶”操作		*/
  /**************************************/

  require('../config.inc.php');

  //判断是否为管理员
  if ($_SESSION['username'] == ADMIN_USER)
  {
	//取得文章ID
	$id=$_POST['id'];

	//取消“置顶”的SQL语句
	$sql = "UPDATE forum_topic SET sticky='0' WHERE id='$id'";

	$result=$mysqli->query($sql);

	if($result)
	{
		//跳转页面
		header("Location: view_topic.php?id=$id");
	}
	else {
		ExitMessage("Database operation error!");
	}

  } else {
	ExitMessage("You don't have administrative privileges!");
  }
?>
