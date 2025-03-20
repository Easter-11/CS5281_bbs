<?php
header("Content-type: text/html; charset=utf-8");
/**************************************/
/*		文件名：logon_form.php		*/
/*		功能：用户登录程序			*/
/**************************************/

require('../config.inc.php');
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_POST["submit"]) && $_POST['submit']) {
  // 获取用户名
  $username = ClearSpecialChars($_POST['username']);
  // 获取密码
  $password = $_POST['password'];

  // 检查用户名和密码是否为空
  if (empty($username) || empty($password)) {
    ExitMessage("用户名和密码不能为空！", "logon_form.php");
  }

  // 使用预处理语句防止SQL注入
  $sql = "SELECT * FROM forum_user WHERE username=?";
  $stmt = $mysqli->prepare($sql);

  if ($stmt === false) {
    die("查询准备失败: " . $mysqli->error);
  }

  // 绑定参数
  $stmt->bind_param("s", $username); // "s" 表示一个字符串参数

  // 执行查询
  $stmt->execute();

  // 获取查询结果
  $result = $stmt->get_result();

  // 检查用户名和密码是否匹配
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    $hashedPassword = md5($password); // 使用 MD5 进行哈希
    $res = password_verify($hashedPassword, $row['password']);

    // 验证密码
    if ($hashedPassword===$row['password']) {
      // 将用户名存入SESSION中
      $_SESSION['username'] = $row['username'];
      // 跳转到论坛主页面
      header("Location: main_forum.php");
      exit;
    } else {
      ExitMessage("用户名或者密码错误！", "logon_form.php");
    }
  } else {
    ExitMessage("用户名或者密码错误！", "logon_form.php");
  }

  // 关闭语句
  $stmt->close();
} else {
  // 公用头部页面
  include('../includes/header.inc.php');
?>

  <div id="Login_in">
    <h2 style="text-align:center; margin-top:50px;">用户登录</h2>
    <form method="post" action="logon_form.php">
      <table width="600">
        <tr>
          <td width="100">用户名：</td>
          <td><input name="username" type="text" required></td>
          <td width="300">
            <p class="msg"><i class="ati"></i>请输入用户名</p>
          </td>
        </tr>
        <tr>
          <td>密　码：</td>
          <td><input name="password" type="password" required></td>
          <td>
            <p class="msg"><i class="ati"></i>请输入密码</p>
          </td>
        </tr>
      </table>
      <section class="button">
        <input type="submit" name="submit" value="登录" class="button">
      </section>
    </form>
  </div>

<?php
}

// 公用尾部页面
include('../includes/footerLogin.inc.php');

// 关闭数据库连接
$mysqli->close();
?>