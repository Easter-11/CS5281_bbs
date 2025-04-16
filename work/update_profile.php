<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE"); 
header("Content-type: text/html; charset=utf-8"); 
  /**************************************/
  /*		文件名：update_profile.php	*/
  /*		功能：用户资料修改页面		*/
  /**************************************/

  require('../config.inc.php');
  include ('../includes/header.inc.php');
  if (!$_SESSION['username']) {
	ExitMessage("Please <b>log in</b> to execute this request.", "logon_form.php");
  }

  //用户名
  $username=$_SESSION['username'];
  //电子邮件
  $email=$_POST['email'];
  //真实姓名
  $realname=$_POST['realname'];
  //用户密码
  $password=$_POST['password'];

  if (!$password) 
  {
	//如果密码为空，则密码项不予更新
	$sql="UPDATE forum_user 
			SET email = '$email', 
			realname = '$realname' 
		  WHERE username = '$username'";
  } else {
	//如果输入了新的密码，则密码项也予以更新
	$password = $password;
	$sql="UPDATE forum_user 
			SET password = '$password', 
			email = '$email', 
			realname = '$realname' 
		  WHERE username = '$username'";
  }

  $result=$mysqli->query($sql);

  if($result){
?>
<div class="updateUser">
<h2>Profile updated successfully</h2>

<p>
Your profile has been updated successfully.
	Please<a href="main_forum.php"> back</a> home。
</p>
</div>

<?php
  }
  else {
	ExitMessage("The record does not exist!");
  }
include ('../includes/footer.inc.php');
?>
