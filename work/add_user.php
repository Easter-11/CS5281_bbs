<?php
ini_set("error_reporting", "E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");
/**********************************/
/*	   文件名：add_user.php		*/
/*	   功能：添加注册用户记录	*/
/**********************************/
require('../config.inc.php');

//取得提交的数据，并做清理
include('../includes/header.inc.php');
//用户名
$username  = ClearSpecialChars($_POST['username']);
//密码
$password  = $_POST['password'];
//电子邮件地址
$email    = ClearSpecialChars($_POST['email']);
//真实姓名
$realname  = ClearSpecialChars($_POST['realname']);

//检验数据的合法性
if (!$username) {
  ExitMessage('Please enter your username!');
}
if (!$password) {
  ExitMessage('Please enter your password!');
}
if (!$email) {
  ExitMessage('Please enter your email!');
} elseif (!checkEmail($email)) {
  ExitMessage('Email format error!');
}

//对密码进行MD5加密
$password = $_POST['password'];

// 判断用户是否已经存在
$sql = "SELECT * FROM forum_user WHERE username='$username'";
$result = $mysqli->query($sql);

// 检查查询是否成功
if ($result === false) {
  die("Query failed: " . $mysqli->error);
}

// 获取查询结果的行数
$num_rows = $result->num_rows;

if ($num_rows > 0) {
  ExitMessage("This user already exists! Click back to re-register!");
}

//创建用户
$password = md5($password);  // 对用户输入的密码进行md5加密

$sql = "INSERT INTO forum_user (username, password, email, realname, regdate)
        VALUES('$username', '$password', '$email', '$realname', NOW())";

$result = $mysqli->query($sql);


if ($result) {
?>
  <div class="addUser">
    <h2>Create User</h2>

    <p>Your user account has been created,please click<a href="logon_form.php"> here </a>log in.</p>
  </div>
<?php
} else {
  ExitMessage("Database error!");
}
?>