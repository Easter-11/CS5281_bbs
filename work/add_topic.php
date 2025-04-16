<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE"); 
header("Content-type: text/html; charset=utf-8"); 
  /**************************************/
  /*		文件名：add_topic.php		*/
  /*		功能：发表文章程序			*/
  /**************************************/

  require('../config.inc.php');

  if (!$_SESSION['username'])
  {
	//如果用户未登录，显示错误信息
	include('../includes/header.inc.php');	//头文件
?>
<h2>Create a new post</h2>

<h3>Unregistered User</h3>
<p>Sorry, please <a href="create_user.php">register </a>a new user, or <a href="logon_form.php">login</a>。
</p>

<?php 
	include('../includes/footer.inc.php');		//尾文件

  } else {

	//获得用户信息
	$username = $_SESSION['username'];
	$sql = "SELECT * from forum_user WHERE username='$username'";
	$result = $mysqli->query($sql);
	$info = $result->fetch_array();

	//取得传递来的值
	//标题
    
	   $topic= $_POST['topic'];	
      
	//正文
  
	 $detail= $_POST['detail'];	
    
	//发帖人
    
	$name	= $_SESSION['username'];
    
	//电子邮件地址
    
	$email	= $info['email'];
 
	//是否置顶
   
	$sticky	= $_POST['sticky'];
    
	//是否锁定
    
//	$locked	= $_POST['locked'];
    
	//数据合法性检查
	if (!$topic)
	{
		ExitMessage("Please enter a title!");
	}
	if (!$detail)
	{
		ExitMessage("Please enter the text!");
	}
     
	//判断是否为锁定状态
//	if ($locked == "on" && $name == ADMIN_USER) { 
//		$locked = 1; 
//	}
//	else {
//		$locked = 0; 
//	}

	//判断是否置顶状态
	if ($sticky == "on" && $name == ADMIN_USER) {
		$sticky = 1;
	} 
	else {
		$sticky = 0;
	}

	//将数据插入数据库
	$sql="INSERT INTO forum_topic(topic, detail, name,email,datetime,sticky) VALUES('$topic', '$detail', '$name', '$email',NOW(),'$sticky')";
	$result=$mysqli->query($sql);
	if($result)
	{
		//成功后，跳转页面到论坛主页面
		header("Location: main_forum.php");
	}
	else 
	{
		ExitMessage("Database error!");
	}
}
?>
