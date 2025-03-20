<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE"); 
header("Content-type: text/html; charset=utf-8"); 
  /**************************************/
  /*		文件名：view_profile.php		*/
  /*		功能：查看用户资料页面		*/
  /**************************************/
  require('../config.inc.php');

  // 取得用户ID，防止SQL注入
  $id = mysqli_real_escape_string($mysqli, $_GET['id']);

  // 取得用户信息
  $sql = "SELECT * FROM forum_user WHERE username=?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $rows = $result->fetch_assoc();

  if (!$rows) {
    ExitMessage("用户记录不存在！", "index.php");
  }

  // 计算用户发表的帖子数量
  $sql = "SELECT COUNT(*) FROM forum_topic WHERE name=?";
  $stmt_q = $mysqli->prepare($sql);
  $stmt_q->bind_param("s", $id);
  $stmt_q->execute();
  $result_q = $stmt_q->get_result();
  $num_count_q = $result_q->fetch_row()[0];

  // 计算用户的回复数量
  $sql = "SELECT COUNT(*) FROM forum_reply WHERE reply_name=?";
  $stmt_a = $mysqli->prepare($sql);
  $stmt_a->bind_param("s", $id);
  $stmt_a->execute();
  $result_a = $stmt_a->get_result();
  $num_count_a = $result_a->fetch_row()[0];

  // 总计用户发表的帖子和回复
  $num_count = $num_count_q + $num_count_a;
?>

<?php include('../includes/header.inc.php'); ?>
<div class="user_info">
<h2>查看 <b><?php echo htmlspecialchars($rows['username']); ?></b> 个人资料:</h2>

<?php
  // 格式化电子邮件地址
  $mail = $rows['email'];
  // 邮箱地址的格式化（如果需要）
  //$mail = str_replace("@", " [at] ", $mail);
  //$mail = str_replace(".", " [dot] ", $mail);
?>

<fieldset>
  <legend>个人资料</legend>
  <br>
  <table width="300">
    <tr>
      <td width="100"><strong>真实姓名:</strong></td>
      <td width="200"><?php echo htmlspecialchars($rows['realname']); ?></td>
    </tr>
    <tr>
      <td><strong>电子邮件:</strong></td>
      <td><?php echo htmlspecialchars($mail); ?></td>
    </tr>
    <tr>
      <td><strong>发贴数量:</strong></td>
      <td><?php echo $num_count; ?></td>
    </tr>
  </table>
  <br>
  <input type="button" value="返回首页" onclick="location.href='main_forum.php'">
</fieldset>
</div>
<?php include('../includes/footer.inc.php'); ?>
